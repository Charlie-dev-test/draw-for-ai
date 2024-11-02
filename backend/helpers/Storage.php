<?php

class Storage
{
	protected $_dbTable;
	
	/**
	 * Сохранить информацию о файле в базу
	 * @param Z_File_Storage_File $file
	 * @return bool
	 */
	public function save(Z_File_Storage_File $file)
	{
		$fileInfo = $file->get();
		$id = $file->get('id');

		$exif = @read_exif_data($fileInfo["fullpath"]."/".$fileInfo["name"], 'EXIF', 0);

		$exifInfo = "";
		if(is_array($exif)) {
			$resultExif = array();
			foreach($exif as $k => $v) {
				if(is_array($v)) {
					$v = implode(" ", $v);
				}
				if($k == "MakerNote") {
					continue;
				}
				if(preg_match("{UndefinedTag}si", $k)) {
					continue;
				}
				$resultExif[$k] = preg_replace("{\'}si", "", $v);
			}
			$exifInfo = serialize($resultExif);
		}

		//$exifInfo = "";

		if($id == null) {
			$item = $this->getModel()->createRow($file->get());
		} else {
			$item = $this->getModel()->fetchRow(array('id=?' => $id));
			$item->setFromArray($file->get());
		}

		$itemArray = $item->toArray();
		unset($itemArray['is_deleted']);
		$itemArray['exif'] = $exifInfo;
		$item->setFromArray($itemArray);

		return $item->save();
	}

	private function convertVideo($fileName)
	{
		if(!file_exists($fileName)) {
			return false;
		}
		
		$path_parts = pathinfo($fileName);
		$ext  = $path_parts["extension"];
		
		if($ext != 'mp4') {
			return false;
		}

		$dir  = $path_parts["dirname"]; 
		$base = $path_parts["basename"];
		$name = $path_parts["filename"];

    $message = "";
    $fileContent = "";

    $mp4 = new Z_File_Video_Mpeg4();
    $makemp4 = $mp4->make($dir.'/'.$base, $dir.'/'.$name.'_s.mp4');
    $fileContent .= $makemp4."\n";

    $h264 = new Z_File_Video_H264();
    $makeh264 = $h264->make($dir.'/'.$base, $dir.'/'.$name.'.mov');
    $fileContent .= $makeh264."\n";

    $ogg = new Z_File_Video_Ogg();
    $makeogg  = $ogg->make($dir.'/'.$base, $dir.'/'.$name.'.ogg');
    $fileContent .= $makeogg."\n";
    
    $webm = new Z_File_Video_Webm();
    $makewebm = $webm->make($dir.'/'.$base, $dir.'/'.$name.'.webm');
    $fileContent .= $makewebm."\n";
    
    $flv = new Z_File_Video_Flv();
    $makeflv  = $flv->make($dir.'/'.$base, $dir.'/'.$name.'.flv');
    $fileContent .= $makeflv."\n";
    
    $thumb = new Z_File_Video_Thumbnail();
    $makepng  = $thumb->make($dir.'/'.$base, $dir.'/'.$name.'.png');
    $fileContent .= $makepng."\n";
    
    $cmd = $dir.'/exec.cmd';
    file_put_contents($cmd, $fileContent);

    if(file_exists($dir.'/exec.cmd')) {
    	
    	//@ob_start();
    	$out = array();
    	$returnVar = "";
    	//-- Maximum execution time of 3000 seconds exceeded ->
			$result = exec($cmd, $out, $returnVar);

			$result = (file_exists($dir."/".$name."_s.mp4") && filesize($dir."/".$name."_s.mp4") > 0);
    	$message .= $result ? "<b>Mpeg4</b> создан!" : "<b>Mpeg4</b> не создан!";
    	$message .= "<br/>";

    	$result = (file_exists($dir."/".$name.".mov") && filesize($dir."/".$name.".mov") > 0);
    	$message .= $result ? "<b>H264</b> создан!" : "<b>H264</b> не создан!";
    	$message .= "<br/>";
    	
    	$result = (file_exists($dir."/".$name.".ogg") && filesize($dir."/".$name.".ogg") > 0);
    	$message .= $result ? "<b>Ogg</b> создан!" : "<b>Ogg</b> не создан!";
    	$message .= "<br/>";

    	$result = (file_exists($dir."/".$name.".webm") && filesize($dir."/".$name.".webm") > 0);
    	$message .= $result ? "<b>WebM</b> создан!" : "<b>WebM</b> не создан!";
    	$message .= "<br/>";

    	$result = (file_exists($dir."/".$name.".flv") && filesize($dir."/".$name.".flv") > 0);
    	$message .= $result ? "<b>Flv</b> создан!" : "<b>Flv</b> не создан!";
    	$message .= "<br/>";
    	
    	$result = (file_exists($dir."/".$name.".png") && filesize($dir."/".$name.".png") > 0);
    	$message .= $result ? "Миниатюра <b>PNG</b> создана!" : "Миниатюра <b>PNG</b> не создана!";

    	//@ob_end_clean();

    	//@unlink($cmd);

    	if(file_exists($dir."/".$name."_s.mp4") && filesize($dir."/".$name."_s.mp4") > 0) {
    		@unlink($dir."/".$name.".mp4");
    		@rename($dir."/".$name."_s.mp4", $dir."/".$name.".mp4");
    	}
    	
    } else {
    	$message .= "BAT-файл не создан!";
    }
			
		Z_FlashMessenger::addMessage($message);
	}

	//-- make copy of the file on the disk, return newFileId
	public function copyNewRowFile($fileId)
	{
		$storageFile = $this->getFile($fileId);
		
		$fullPath = $storageFile->get("fullpath");
		$fileName = $storageFile->get("name");
		$realFileName = $storageFile->get("realname");
		$localName = $fullPath."/".$fileName;

		$newFileId = 0;
		if(file_exists($localName)) {
			$params = array(
				"realname" => $realFileName
			);
			$newFileId = $this->create($localName, $params);
		}
		return $newFileId;
	}

}
