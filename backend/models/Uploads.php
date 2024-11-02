<?php

namespace backend\models;

use Yii;
use backend\models\AbstractModel;
use backend\helpers\Transliterator;

/**
 * Description of Uploads
 */
class Uploads extends AbstractModel
{
	public $fullpath = "";

	protected $_storageDir;
	protected $_storageDomain;
	protected $_storagePath;
	protected $_model;
	protected static $_dirChars = array(
		'a','b','c','d','e','f',
		'g','h','i','j','k','l',
		'm','n','o','p','r','s',
		't','u','v','x','y','z',
		'A','B','C','D','E','F',
		'G','H','I','J','K','L',
		'M','N','O','P','R','S',
		'T','U','V','X','Y','Z',
		'1','2','3','4','5','6',
		'7','8','9','0'
	);


	public function __construct($param = array())
	{
		$presetStoragePath = Yii::$app->params["STORAGE_UPLOAD_PATH"];
		$presetStorageDomain = Yii::$app->params["STORAGE_DOMAIN"];
		$this->_storageDir = isset($param['storage']) ? $param['storage'] : $presetStoragePath;
		$this->_storageDomain = isset($param['domain']) ? $param['domain'] : $presetStorageDomain;
		if(substr($this->_storageDir, -1) == '/') {
    	$this->_storageDir = substr($this->_storageDir, 0, -1);
		}
		$this->_storagePath = $this->_storageDomain.$this->_storageDir;
	}

  public static function tableName()
  {
      return 'z_uploads';
  }
    
    /*
    * @return правила
    */
    public function rules()
    {
        $defaultAttrs = array_keys($this->attributeLabels());
        return [
            [$defaultAttrs, 'default'],
        ];
    }
    
    /*
    * @return атрибуты
    */
    public function attributeLabels()
    {
      return [
        'id' => 'ID',
        'user_id' => 'User ID',
        'realname' => 'Начальное имя файла',
        'path' => 'Путь',
        'name' => 'Имя файла на диске',
        'fullpath' => 'Полный путь',
        'is_deleted' => 'Удален?',
        'exif' => 'EXIF info',
      ];
    }

  public function beforeSave($insert)
  {
    if($insert) {
    	$maxId = $this->getMaxId('id');
    	$this->id = $maxId + 1;
    } else {
      
    }
    $this->is_deleted = !empty($this->is_deleted) ? $this->is_deleted : 0;
    return parent::beforeSave($insert);
	}
  
  public function getStorageDir()
	{
		return $this->_storageDir;
	}

	public function getStorageDomain()
	{
		return $this->_storageDomain;
	}

	public function getStoragePath()
	{
		return $this->_storagePath;
	}

	/**
	 * Получение файла из базы по id
	 * @param int $id
	 * @return Uploads row
	 */
	public function getFile($id)
	{
		$model = Uploads::findOne($id);
		if(!empty($model)) {
    	$model->fullpath = $this->_storageDir.'/'.$model->path;
    }
    return $model;
	}

	/**
	 * получить модель. Если ее нет - создает новую
	 * @return Uploads
	 */
	public function getModel($id=null)
	{
		$model = $this->getFile((int)$id);
		if(!$model) {
			$model = new $this();
		}
		return $model;
	}
  
  /**
	 * копирует файл в папку назначения и создает запись в БД
	 * @param string $localName Путь к файлу
	 * @param array() $param настройки: name
	 * realname - настоящее имя файла
	 * filename - новое имя хранимого файла. Если не указано, пытается сгенериться длиной в 8 знаков с 5ти попыток
	 * @return int id
	 */
	public function create($file, $param=array())
	{
    $success = true;
    $fileName = "???";
    
    $realName = $file->baseName.".".$file->extension;
    $folder = $this->getNewFolderName();
		$name = mb_strtolower(Transliterator::translateCyr($realName), "utf-8");
		$localName = $this->_storageDir.$name;
		$success = $file->saveAs($localName);
		if(!empty($param["is_frontend"])) {
		  $fileName = $this->_storageDir.'/'.$folder.'/'.$name;
		} else {
			if(!$name || !$this->copyFileNewDir($localName, $folder, $name)) {
				$success = false;
			} else {
    		$fileName = $this->_storageDir.'/'.$folder.'/'.$name;
    		//$this->convertVideo($fileName);
    		//$success = $file->saveAs($fileName);
    	}
    }

    $model = $this->getModel();
    $model->user_id = 0;//$auth->getUser()->getId();
		$model->name = $name;
		$model->realname = $realName;
		$model->path = $folder;
		$model->fullpath = $this->_storageDir.'/'.$folder;
		$success = $model->save();
		//yadisk => isset($param['yadisk']) ? 1 : 0,
		//exif => isset($param['exif']) ? $param['exif'] : "",
		//date_modified => $param["date_modified"]

		//Yii::$app->session->addFlash("info", "create(): ".(int)$success);
		
		if($success) {
			Yii::$app->session->addFlash("success", "Успешно: ".$fileName);
		} else {
			Yii::$app->session->addFlash("danger", "Ошибка: ".$fileName);
		}

		return $model;
	}

	/**
	 * Замена сохраненного в базе файла на загружаемый
	 * @param <type> $id
	 * @param <type> $data
	 * @return <type> 
	 */
	public function replace($id, $file)
	{
		$realName = $file->baseName.".".$file->extension;
		
		$this->clearFileDir($id);
		
		$fileModel = $this->getFile($id);
		if(!is_object($fileModel)) {
			return false;
		}
		if(is_file($fileModel->getFullPathName())) {
			unlink($fileModel->getFullPathName());
		}
		
		$success = true;
    $fileName = "???";
    
    
    //$folder = $this->getNewFolderName();
    $folder = $fileModel->path;
		$name = mb_strtolower(Transliterator::translateCyr($realName), "utf-8");
		$localName = $this->_storageDir.$name;
		$success = $file->saveAs($localName);
		if(!$name || !$this->copyFileNewDir($localName, $folder, $name)) {
			$success = false;
		} else {
    	$fileName = $this->_storageDir.'/'.$folder.'/'.$name;
    	//$this->convertVideo($fileName);
    	//$success = $file->saveAs($fileName);
    }

    $model = $this->getModel($id);
    //$model->id = $id;
    $model->user_id = 0;//$auth->getUser()->getId();
		$model->name = $name;
		$model->realname = $realName;
		$model->path = $folder;
		$model->fullpath = $this->_storageDir.'/'.$folder;
		$success = $model->save();
		//yadisk => isset($param['yadisk']) ? 1 : 0,
		//exif => isset($param['exif']) ? $param['exif'] : "",
		//date_modified => $param["date_modified"]
		
		return $model;
	}

	/**
	 * Генерирует новое имя для файла. Проверяет, может ли быть создана персональная директория под этот файл
	 * @param int $length Длина имени создаваемого файла
	 * @param int $searchDepth Количество попыток создания
	 * @return при успехе возвращает доступное имя, при неудаче - false
	 */
	public function getNewFolderName($length = 8, $searchDepth = 5)
	{
  	for($j = 0; $j < $searchDepth; $j++) {
      $name = "";
      shuffle(self::$_dirChars);
      for($i = 0; $i < $length; $i++) {
      	$name .= self::$_dirChars[$i];
      }
      if(!is_dir($this->_storageDir . '/' . $name)) {
				return $name;
			}
    }
    return false;
	}

	/**
	 * Копирует файл в новое место с cозданием персональной папки для файла
	 * @param string $src Путь к файлу-источнику
	 * @param string $destFolder Папка назначения
	 * @param string $destName Имя конечного файла
	 * @return bool
	 */
	protected function copyFileNewDir($src, $destFolder, $destName)
	{
		$dir = $this->_storageDir . '/' .  $destFolder;
		$dirCreated = is_dir($dir) ? true : mkdir($dir);
		if($dirCreated && copy($src, $dir . '/' . $destName)) {
			@unlink($src);
			return true;
		}
		return false;
	}

	public function clearFileDir($id)
	{
		$file = $this->getFile((int)$id);
		if(is_object($file)) {
			$this->_clrdir($file->getFullPathName());
		}
		return true;
	}

	/**
	 * Удаление по id файла его самого и каталога, в котором он хранится
	 * @param int $id идентификатор файла в базе
	 * @return bool
	 */
	public function removeFileDir($id)
	{
		$file = $this->getFile((int)$id);
		if(is_object($file)) {
			//Yii::$app->session->addFlash("danger", "deleting ($id)...");
			$fullName = $file->getFullPathName();
			$result = $file->delete();
	    if($result) {
				$this->_rmdir($fullName);
				//Yii::$app->session->addFlash("danger", "deleting ($id): ".(int)$result." -> ".$fullName);
				return true;
			}
		}
		return false;
	}

	/**
	 * Рекурсивная очистка папки
	 * @param string $dir путь к папке
	 */
	protected function _rmdir($dir)
	{
		$files = glob($dir.'*',GLOB_MARK);
		foreach($files as $file) {
			if(is_dir($file)) {
				$this->_rmdir($file);
			} else {
				unlink($file);
			}
		}
		if(is_dir($dir)) {
			rmdir($dir);
		}
	}

	/**
	 * Рекурсивная очистка папки
	 * @param string $dir путь к папке
	 */
	protected function _clrdir($dir)
	{
		$files = glob($dir.'*', GLOB_MARK);
		foreach($files as $file) {
			if(is_dir($file)) {
				$this->_clrdir($file);
			} else {
				unlink($file);
			}
		}
	}

	public function getFullPathName()
	{
		return $this->fullpath;
	}
	public function getFullFileName()
	{
		return $this->fullpath."/".$this->name;
	}
	public function getFullUrl()
	{
		return $this->getStoragePath()."/".$this->path."/".$this->name;
	}
	
	//-- add all folders into the ZIP-archive
	public function zipAllDirs($dirs, $zipFileName, $add=true)
	{
		//-- Initialize archive object
		$zip = new \ZipArchive();
		//if($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
		if($zip->open($zipFileName, \ZipArchive::CREATE) === true) {
			
			foreach($dirs as $id) {
				$file = $this->getFile((int)$id);
				if(is_object($file)) {
					//Yii::$app->session->addFlash("danger", "zipping ($id)...");
					$rootPath = $file->getFullPathName();
					//$result = $file->delete();
	        if(file_exists($rootPath)) {
						//-- Create recursive directory iterator
						/** @var SplFileInfo[] $files */
						$files = new \RecursiveIteratorIterator(
              new \RecursiveDirectoryIterator($rootPath),
              \RecursiveIteratorIterator::LEAVES_ONLY
						);
          
						foreach($files as $name => $file) {
              //-- Skip directories (they would be added automatically)
              if(!$file->isDir()) {
                //-- Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                $npos = strpos($relativePath, "\\data\\storage\\");
                if($npos !== false) {
                	$relativePath = substr($relativePath, $npos);
                }
                //-- Add current file to archive
                $zip->addFile($filePath, $relativePath);
              }
						}
						//Yii::$app->session->addFlash("danger", "zipping ($id): ".$fullName." (".$file->getFullFileName().")");
					}
				}
			}
			//-- Zip archive will be created only after closing object
			$zip->close();
		}
	}
	
	
	/**
	 * Архивирование по id файла его самого и каталога, в котором он хранится
	 * @param int $id идентификатор файла в базе
	 * @return bool
	 */
	public function zipFileDir($id, $zipFileName, $add=true)
	{
		$file = $this->getFile((int)$id);
		if(is_object($file)) {
			//Yii::$app->session->addFlash("danger", "zipping ($id)...");
			$fullName = $file->getFullPathName();
			//$result = $file->delete();
	    if(file_exists($fullName)) {
				$this->addIntoZip($fullName, $zipFileName, $add);
				//Yii::$app->session->addFlash("danger", "zipping ($id): ".$fullName." (".$file->getFullFileName().")");
				return true;
			}
		}
		return false;
	}
	
	//-- add folder into the ZIP-archive
	public function addIntoZip($rootPath, $zipFileName, $add=true)
	{
		//return false;

		//-- Initialize archive object
		$zip = new \ZipArchive();
		//if($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
		if($zip->open($zipFileName, \ZipArchive::CREATE) === true) {
			//-- Create recursive directory iterator
			/** @var SplFileInfo[] $files */
			$files = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($rootPath),
        \RecursiveIteratorIterator::LEAVES_ONLY
			);
    
			foreach($files as $name => $file) {
        //-- Skip directories (they would be added automatically)
        if(!$file->isDir()) {
          //-- Get real and relative path for current file
          $filePath = $file->getRealPath();
          $relativePath = substr($filePath, strlen($rootPath) + 1);
          $npos = strpos($relativePath, "\\data\\storage\\");
          if($npos !== false) {
          	$relativePath = substr($relativePath, $npos);
          }
          //-- Add current file to archive
          $zip->addFile($filePath, $relativePath);
        }
			}
			//-- Zip archive will be created only after closing object
			$zip->close();
		}
	}

}
