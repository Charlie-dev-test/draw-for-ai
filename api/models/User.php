<?php


namespace api\models;

use yii\db\ActiveRecord;
use Yii;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user}}';
    }

    // отрефакторить функции

    public static function cleanAll($id){
        $client = Client::findOne($id);
        $client = $client->id;
        $uploads = new Uploads();
        $files = new Files();
        $data = new Data();
        $folder = $uploads->find()
            ->andWhere(['user_id' => $client])
            ->asArray()
            ->all();
        $backend = Yii::getAlias('@backend/web/data/storage/');
        for($i=0; $i<count($folder); $i++){
            $path = $backend . $folder[$i]['path'];
            self::recursiveRemoveDir($path);
        }
        $files->deleteAll(['user_id' => $client]);
        $uploads->deleteAll(['user_id' => $client]);
        $data->deleteAll(['user_id' => $client]);
        return true;
    }

    public static function recursiveRemoveDir($dir) {
        if (file_exists($dir)){
            $includes = glob($dir.'/{,.}*', GLOB_BRACE);
            $systemDots = preg_grep('/\.+$/', $includes);
            foreach ($systemDots as $index => $dot) {
                unset($includes[$index]);
            }
            foreach ($includes as $include) {
                if(is_dir($include) && !is_link($include)) {
                    self::recursiveRemoveDir($include);
                }
                else {
                    unlink($include);
                }
            }
            return rmdir($dir);
        }
    }

    public static function clean($id){
        $client = Client::findOne($id);
        $client = $client->id;
        $uploads = new Uploads();
        $files = new Files();
        $data = new Data();
        if (isset($_FILES['Files'])){
            $folder = $uploads->find()
                ->andWhere(['user_id' => $client])
                ->asArray()
                ->all();
            $backend = Yii::getAlias('@backend/web/data/storage/');
            for($i=0; $i<count($folder); $i++){
                $path = $backend . $folder[$i]['path'];
                self::recursiveRemoveDir($path);
            }
            $files->deleteAll(['user_id' => $client]);
            $uploads->deleteAll(['user_id' => $client]);
        }
        return $data->deleteAll(['user_id' => $client]);
    }

    public static function cleanFiles($id){
        $uploads = new Uploads();
        $files = new Files();
        if (isset($_FILES['Files'])){
            $folder = $uploads->find()
                ->andWhere(['user_id' => $id])
                ->asArray()
                ->all();
            $backend = Yii::getAlias('@backend/web/data/storage/');
            for($i=0; $i<count($folder); $i++){
                $path = $backend . $folder[$i]['path'];
                self::recursiveRemoveDir($path);
            }
            $files->deleteAll(['user_id' => $id]);
            $uploads->deleteAll(['user_id' => $id]);
            return true;
        }else return false;
    }
}