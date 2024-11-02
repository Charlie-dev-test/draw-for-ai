<?php


namespace api\models;

use yii\helpers\BaseFileHelper;
use Yii;

class Batch
{
    protected static function getFolderList($path){
        $imgArr = scandir($path, 1);
        unset($imgArr[count($imgArr)-1], $imgArr[count($imgArr)-1]);
        return $imgArr;
    }

    protected static function getImgList($path){
        $imgArr = scandir($path, 1);
        unset($imgArr[count($imgArr)-1], $imgArr[count($imgArr)-1]);
        $sortedImg = [];
        foreach ($imgArr as $file){
            $ext = BaseFileHelper::getMimeTypeByExtension($file);
            if($ext === "image/jpeg"){
                array_push($sortedImg, $file);
            }
        }
        return $sortedImg;
    }

    protected static function getTextList($path){
        $textArr = scandir($path, 1);
        unset($textArr[count($textArr)-1], $textArr[count($textArr)-1]);
        $sortedText = [];
        foreach ($textArr as $file){
            $ext = BaseFileHelper::getMimeTypeByExtension($file);
            if($ext === "text/plain"){
                array_push($sortedText, $file);
            }
        }
        return $sortedText;
    }

//    public static function getRawImgName($path){
//        $folders = self::getFolderList($path);
//
//        $listImg = self::getImgList($path);
//        foreach ($folders as $item){
//            $subfolder = $path . "/" . $item;
//            if(is_dir($subfolder)){
//                $sublist = self::getImgList($subfolder);
//                foreach ($sublist as $file){
//                    array_push($listImg, $item . "/" .$file);
//                }
//            }
//        }
//
//        $listText = self::getTextList($path);
//        foreach ($folders as $item){
//            $subfolder = $path . "/" . $item;
//            if(is_dir($subfolder)){
//                $sublist = self::getTextList($subfolder);
//                foreach ($sublist as $file){
//                    array_push($listText, $item . "/" .$file);
//                }
//            }
//        }
//        $temp = [];
//        if(count($listText) > 0) {
//            for($i = 0; $i<count($listImg); $i++){
//                $item = substr($listImg[$i], 0, strrpos($listImg[$i],'.'));
//                foreach ($listText as $doc){
//                    $text = substr($doc, 0, strrpos($doc,'.'));
//                    if(strcmp($item, $text) == 0){
//                        array_push($temp, $listImg[$i]);
//                    }
//                }
//            }
//        }
//
//        $sorted = array_values(array_diff($listImg, $temp));
//        if(count($sorted) > 0){
//            $responce = (object)[];
//            $responce->image = substr($sorted[0], 0, strrpos($sorted[0],'.'));
//            $responce->volume = count($listImg);
//            $responce->count = count($sorted);
//            return $responce;
//        }
//        return false;
//    }

    public static function writeData($storage, $img, $data){
        $string = '';
        $f_hdl = fopen($storage . "/" . $img . ".txt", 'w');
        foreach ($data as $item){
            $string = $item['label_index'] . ' ' . $item['xcenter'] . ' ' . $item['ycenter'] . ' ' . $item['w'] . ' ' . $item['h'];
            fwrite($f_hdl, $string . PHP_EOL);
        }
        fclose($f_hdl);

        return true;
    }

    public static function getList($path){
        $folders = self::getFolderList($path);
        $listImg = self::getImgList($path);
        foreach ($folders as $item){
            $subfolder = $path . "/" . $item;
            if(is_dir($subfolder)){
                $sublist = self::getImgList($subfolder);
                foreach ($sublist as $file){
                    array_push($listImg, $item . "/" .$file);
                }
            }
        }

        $listText = self::getTextList($path);
        foreach ($folders as $item){
            $subfolder = $path . "/" . $item;
            if(is_dir($subfolder)){
                $sublist = self::getTextList($subfolder);
                foreach ($sublist as $file){
                    array_push($listText, $item . "/" .$file);
                }
            }
        }
        $sorted = [];
        foreach ($listImg as $item){
            $paked = (object)[];
            $paked->img = $item;
            $paked->processed = false;
            $paked->isActive = false;
            $img = substr($item, 0, strrpos($item,'.'));
            foreach ($listText as $text){
                $doc = substr($text, 0, strrpos($text,'.'));
                if(strcmp($img, $doc) == 0){
                    $paked->processed = true;
                }
            }
            array_push($sorted, $paked);
        }
        return $sorted;
    }
}