<?

namespace backend\helpers;

class Funcs
{
	public static function is_serial($string)
	{
    return (@unserialize($string) !== false);
	}
	
	public static function is_json($string)
	{
 		json_decode($string);
 		$jsonLastError = json_last_error();
 		return ($jsonLastError === JSON_ERROR_NONE);
	}

	// $dir  - path to the root Folder (started in)
  // $arr  - array for the Entries
  // $type - entry Type: 'F' or 'D' (default = 'F')
  // $dirs - array for the Folders (default = array(), item '.' means $dir)
  // $exts - array for the file Extensions (default = array())
  function getFolderTree($dir, $arr, $type='F', $dirs=array(), $exts=array(), $currentFolderOnly=false)
  {
		if(count($exts) > 0) {
			for($i=0;$i<count($exts);$i++) {
				$exts[$i] = strtolower($exts[$i]);
			}
		}
		
		$type = strtoupper($type);
		if(substr($dir,strlen($dir)-1,1) != '/') $dir .= '/';

		$d = dir($dir);
    while($entry = $d->read()) {
     	$ft = filetype($dir.$entry);
     	if(!$currentFolderOnly && ($ft == 'dir') && ($entry != '.') && ($entry != '..') && (empty($dirs) || !empty($dirs) && isfolderinlist($dir.$entry, $dirs))) {
     		//echo 'entry = '.$entry.'<br>';
     	 	$arr = array_merge($arr, $this->getFolderTree($dir.$entry, array(), 'D', $dirs, $exts));
     	 	if($type != 'F') {
     	 		$arr[] = $dir.$entry;
     	 	} else {
     	 		$arr = array_merge($arr, $this->getFolderTree($dir.$entry, array(), 'F', $dirs, $exts));
     	 	}
     	}
      if(($ft == 'file') && ($type == 'F')) {
      	if(empty($exts) || !empty($exts) && in_array($this->getfext(strtolower($entry)), $exts)) {
     	 		$arr[] = $dir.$entry;
     	 	}
     	}
    }
    $d->close();
    return $arr;
  }

  function deleteNotEmptyDir($dir, $currentFolderOnly=false)
	{
		$files = $this->getFolderTree($dir, array(), 'F', array(), array(), $currentFolderOnly);
		foreach($files as $fn) {
			@unlink($fn);
		}
		if(!$currentFolderOnly) {
			$dirs = $this->getFolderTree($dir, array(), "D");
			foreach($dirs as $dr) {
				@rmdir($dr);
			}
		}
		return;
	}

	public function deleteEmptyDir($dir)
	{
		$it = new \RecursiveDirectoryIterator($dir);
		$files = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::CHILD_FIRST);
		foreach($files as $file) {
    	if($file->getFilename() === '.' || $file->getFilename() === '..') {
        continue;
    	}
    	$ddd = $file->getRealPath();
    	if($file->isDir()) {
        if($this->is_empty_folder($ddd)) {
        	@rmdir($ddd);
        }
    	}
		}
		if($this->is_empty_folder($dir)) {
			@rmdir($dir);
		}
	}

	public static function makedir($fn, $dirOnly=false)
	{
		$result = true;

		$path = $fn;
		if(!$dirOnly) {
			$pathInfo = pathinfo($fn);
   		//$path = $this->getstrippedpath($pathInfo["dirname"]);
   		$path = $pathInfo["dirname"];
   	}
   	$path = str_replace("\\", "/", $path);
   	$arr_fld = explode("/", $path);
   	$num_fld = (int)count($arr_fld);
   	$str_fld = "";
   	for($i=0;$i<$num_fld;$i++) {
   		$item = trim($arr_fld[$i]);
   		if(!empty($item)) {
   			$str_fld .= $item."/";
   			if(!file_exists($str_fld)) {
   				if(!@mkdir($str_fld)) {
   					$result = false;
   					break;
   				}
   			}
   		}
   	}
   	return $result;
	}

	public function is_empty_folder($directory = "")
	{
		return (count(scandir($directory)) <= 2);
	}

	public static function stripTags($str)
	{
    $str = stripslashes($str);
    $str = preg_replace("'<[^>]+>'U", "", $str);
 		return $str;
	}
		
	public static function getRealIP()
	{
		global $_SERVER;
		$realip = '';
		if(!empty($_SERVER)) {
			$realip = $_SERVER["REMOTE_ADDR"];
			if(empty($realip)) {
				if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
					$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
				} elseif(!empty($_SERVER["HTTP_CLIENT_IP"])) {
					$realip = $_SERVER["HTTP_CLIENT_IP"];
				}
			}
		} else {
			$realip = getenv('REMOTE_ADDR');
			if(empty($realip)) {
				$http_x_forwarded_for = getenv('HTTP_X_FORWARDED_FOR');
				$http_client_ip       = getenv('HTTP_CLIENT_IP');
				if(!empty($http_x_forwarded_for)) {
					$realip = $http_x_forwarded_for;
				} elseif(!empty($http_client_ip)) {
					$realip = $http_client_ip;
				}
			}
		}
		return $realip;
	}

	public static function formatDate($strFormat, $date)
	{
		return date($strFormat, strtotime($date)); 
	} 

	public static function strDifferBetweenDates($date1, $date2, $type="dt")
	{
		//-- type "TimeStamp": means a numeric value of time (like: 1644308542)
		if($type === "ts") {
			$tm1 = $date1;
			$tm2 = $date2;
		} else {
		//-- type "DateTime": means a string value of date (like: "Y-d-m H:i:s")
			$tm1 = strtotime($date1);
			$tm2 = strtotime($date2);
		}

		$dtCurrent = \DateTime::createFromFormat('U', $tm2);
		$dtCreate = \DateTime::createFromFormat('U', $tm1);
		$diff = $dtCurrent->diff($dtCreate);

		$numYears = ($diff->y % 10);
		$strYears = "лет";
		if($numYears > 0 && $numYears < 5) {
			$strYears = "гд";
		}

		//$interval = $diff->format("%y years %m months %d days %h hours %i minutes %s seconds");
		//$interval = preg_replace('/(^0| 0) (years|months|days|hours|minutes|seconds)/', '', $interval);
		$interval = $diff->format("%y ".$strYears." %m мес %d дн %h час %i мин %s сек");
		$interval = preg_replace('/(^0| 0) ('.$strYears.'|мес|дн|час|мин|сек)/', '', $interval);

		return $interval;
	} 

}
