<?

namespace backend\helpers;

use Yii;
use backend\helpers\Funcs;
use backend\models\AbstractModel;
use backend\models\Resources;

class Getsql
{
  private $inserts = [];
  private $comments = [];
  private $notFoundIdList = [];
  private $idsList = [];
  private $uploadsReplacement = [];

  public function exec($sqlFile=null, $mode=null)
  {
  	Resources::setExportFileNames();

    if(is_null($sqlFile)) {
			$funcs = new Funcs();
			$files = $funcs->getFolderTree(Resources::$EXPORT_FOLDER, []);
			foreach($files as $file) {
				$pathinfo = pathinfo($file);
				$fileName = $pathinfo["basename"];
				if($pathinfo["extension"] === "zip" || $pathinfo["extension"] === "txt") {
					?>
					<a href="<?=Resources::$EXPORT_URL."/".$fileName?>"><?=$fileName?></a><br/>
					<?
				}
				if($pathinfo["extension"] === "sql") {
					$contents = file_get_contents($file);
					$toolTip = "";
					if(preg_match("{\/\*( CompleteCMS.*?)\*\/}si", $contents, $matches)) {
						$toolTip .= htmlentities(trim($matches[1]));
					}
					if(preg_match("{\/\*( Built for.*?)\*\/}si", $contents, $matches)) {
						if(!empty($toolTip)) {
							$toolTip .= ". ";
						}
						$toolTip .= htmlentities(trim($matches[1]));
					}
					$toolTipSpan = "";
					if(!empty($toolTip)) {
						?>
						<span class="fa fa-info-circle" data-toggle="tooltip" title="<?=$toolTip?>"></span>
						<?
					}
					?>
					<a href="?file=<?=$fileName?>"><?=$fileName?></a><br/>
					<?
				}
			}
		}
		$fileName = "";
		if(!is_null($sqlFile)) {
			$fileName = $sqlFile;
		} elseif(!empty($_GET["file"])) {
			$fileName = $_GET["file"];
		}
  	
  	if(!empty($fileName)) {
  		
      $fileIn = Resources::$EXPORT_FOLDER."/".$fileName;
			if(!file_exists($fileIn)) {
				Yii::$app->session->addFlash("danger", "Файл ".$fileName." не найден!");
				return false;
			}
			
			$this->getFile($fileIn);
      
			@ob_start();
			$this->handleSql($mode);
			$inserts = $this->getInserts();
			$comments = $this->getComments();
			foreach($comments as $comment) {
				echo $comment."\n";
			}
			foreach($inserts as $insert) {
				echo $insert["statement"]."\n";
			}
			$output = @ob_get_contents();
			@ob_end_clean();
			//-- overwrite the input file!
			file_put_contents($fileIn, $output);
		}
  }
  
  public function getFile($fileName)
	{
		$this->inserts = [];
		$this->comments = [];

		$lines = file($fileName);
		$correctLines = [];
		$idx = 0;
		foreach($lines as $line) {
			if(preg_match("{.*?\|.*?\|.*?\|.*?\|.*?\|INSERT INTO.*}si", $line)) {
				$correctLines[] = str_replace("\n", "", $line);
				$idx++;
			} else {
				$this->comments[] = str_replace("\n", "", $line);
			}
		}
		$idx = 0;
		foreach($correctLines as $line) {
			$cols = explode("|", $line);
			$this->inserts[$idx] = [
				"idx" => (int)$idx,
				"parent_model" => $cols[0],
				"model" => $cols[1],
				"parentid" => (int)$cols[2],
				"id" => (int)$cols[3],
				"parent_field" => $cols[4],
				"statement" => $cols[5],
				"done" => false,
			];
			if(count($cols) > 6) {
			  $statement = $cols[5];
			  for($i=6;$i<count($cols);$i++) {
			  	$statement .= "|".$cols[$i];
			  }
			  $this->inserts[$idx]["statement"] = $statement;
			}
			$idx++;
		}
		//sort($this->inserts);
	}
	
	public function handleSql($mode=null)
	{
		$this->idsList = [];
		$this->notFoundIdList = [];
		$this->uploadsReplacement = [];
		
		foreach($this->inserts as $insert) {
			if($insert["parentid"] === 0) {
				$idx = $insert["idx"];
				
				//-- insert row...
				$newId = $this->insertRow($insert, 0, $mode);
				
				//-- get current model to look for its children
				$insertModelChildren = $insert["model"];
				$this->getParentModels($insertModelChildren, $insert["id"], $newId, $mode);
			}
		}

		if(!empty($this->notFoundIdList)) {
			$strErrors = "";
			foreach($this->notFoundIdList as $errs) {
				$strErrors .= "<li>".$errs."</li>";
			}
			Yii::$app->session->addFlash("danger", "Не найдены ID для:".$strErrors);
		}


		//-- replace FILE:ID for the files
		foreach($this->inserts as $insert) {
			$idx = $insert["idx"];
			$statement = $insert["statement"];
			if(preg_match_all("{\[\!FILE\:(\d+)\!\]}si", $statement, $matches)) {
				$idList = $matches[1];
				foreach($idList as $oldId) {
					if(!empty($this->uploadsReplacement[$oldId])) {
						$val = $this->uploadsReplacement[$oldId];
						$statement = str_replace("[!FILE:".$oldId."!]", $val, $statement);
					}
				}
				$this->inserts[$idx]["statement"] = $statement;
			}
		}

		/*
		
		*/
	}
	
	private function getParentModels($insertModel, $id, $parentId, $mode=null)
	{
		foreach($this->inserts as $insert) {
			//-- look for the parent model
			if($insert["parent_model"] === $insertModel && $insert["done"] === false) {
			  //-- get old parentid
			  if($insert["parentid"] === $id) {
			  	
			  	//-- insert row...
					$newId = $this->insertRow($insert, $parentId, $mode);

			  	//-- get current model to look for its children
					$insertModelChildren = $insert["model"];
					$this->getParentModels($insertModelChildren, $insert["id"], $newId, $mode);
			  }
			}
		}
	}

	private function insertRow($insert, $parentId, $mode=null)
	{
		$newId = $insert["id"];
		if(is_null($mode)) {
			$newId = $this->getRealId($insert["model"]);
		}
		if(is_null($newId)) {
			if(!in_array($insert["model"], $this->notFoundIdList)) {
				$this->notFoundIdList[] = $insert["model"];
			}
		}
		
		$idx = $insert["idx"];
		$statement = $insert["statement"];

		if($insert["model"] === "backend\\models\\Uploads") {
			$oldId = $insert["id"];
			$this->uploadsReplacement[$oldId] = $newId;
		}

		//$statement = str_replace("[!PARENT_FIELD!]", "[!PARENT_FIELD!]=".$parentId, $statement);
		//$statement = str_replace("[!ID!]", "[!ID!]=".$newId, $statement);
		$statement = str_replace("[!PARENT_FIELD!]", $parentId, $statement);
		$statement = str_replace("[!ID!]", $newId, $statement);
		$this->inserts[$idx]["statement"] = $statement;
		
		//$this->inserts[$idx]["statement"] = $insert["id"]."->".$newId.") ".$this->inserts[$idx]["statement"];
		//-- change current row ID to $newId - it will be the parent ID for the children
		//$this->inserts[$idx]["id"] = $newId;
		//-- change DONE status to TRUE
		$this->inserts[$idx]["done"] = true;
		
		return $newId;
	}

	public function getInserts()
	{
		return $this->inserts;
	}

	private function getRealId($model)
	{
		$nameModel = str_replace("\\", "", $model);
		if(!empty($this->idsList[$nameModel])) {
			$this->idsList[$nameModel]++;
			$maxId = $this->idsList[$nameModel];
		} else {
			//-- get max ID from the table
			$maxId = AbstractModel::getMaxIdStatic($model, 'id') + 1;
			$this->idsList[$nameModel] = $maxId;
		}
		return $maxId;
	}

	private function getComments()
	{
		return $this->comments;
	}

}
