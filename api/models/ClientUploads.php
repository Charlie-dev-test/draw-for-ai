<?php


namespace api\models;



use yii\helpers\BaseFileHelper;
use Yii;

class ClientUploads
{
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
    protected static $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',    'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',    'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',    'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',  'ь' => '',    'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',    'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',    'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',    'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',    'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',  'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );

    public static function getNewFolderName($storageDir, $length = 8, $searchDepth = 5)
    {
        for($j = 0; $j < $searchDepth; $j++) {
            $name = "";
            shuffle(self::$_dirChars);
            for($i = 0; $i < $length; $i++) {
                $name .= self::$_dirChars[$i];
            }
            if(!is_dir($storageDir . '/' . $name)) {
                return $name;
            }
        }
        return false;
    }

    public static function saveFiles($id){
        $backend = Yii::getAlias('@backend/web/data/storage/');
        $folderName = self::getNewFolderName($backend);
        $success = '';
        if (isset($_FILES['Files'])) {
            // Преобразуем массив $_FILES в удобный вид для перебора в foreach.
            $files = array();
            $diff = count($_FILES['Files']) - count($_FILES['Files'], COUNT_RECURSIVE);
            if ($diff == 0) {
                $files = array($_FILES['Files']);
            } else {
                foreach ($_FILES['Files'] as $k => $l) {
                    foreach ($l as $i => $v) {
                        $files[$i][$k] = $v;
                    }
                }
            }
            $path = $backend . $folderName . '/';
            BaseFileHelper::createDirectory($path, $mode = 0775, $recursive = true);
            $result = [];
            foreach ($files as $file) {
                $error ='';
                $success = '';
                // Проверим на ошибки загрузки.
                if (!empty($file['error']) || empty($file['tmp_name'])){
                    return 'Ошибка';
                } else {
                    $result['user_id'] = $id;
                    $result['realname'] = $file['name'];
                    $result['path'] = $folderName;
                    // Оставляем в имени файла только буквы, цифры и некоторые символы.
                    $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
                    $name = mb_eregi_replace($pattern, '-', $file['name']);
                    $name = mb_ereg_replace('[-]+', '-', $name);

                    // Т.к. есть проблема с кириллицей в названиях файлов (файлы становятся недоступны).
                    // Сделаем их транслит:
                    $converter = self::$converter;
                    $name = strtr($name, $converter);
                    $parts = pathinfo($name);

                    if (empty($name) || empty($parts['extension'])) {
                        $error = 'Недопустимое тип файла';
                    } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                        return 'Недопустимый тип файла';
                    } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
                        return  'Недопустимый тип файла';
                    } else {
                        $i = 0;
                        $prefix = '';
                        while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
                            $prefix = '(' . ++$i . ')';
                        }
                        $name = $parts['filename'] . $prefix . '.' . $parts['extension'];

                        // Перемещаем файл в директорию.
                        $result['name'] = $name;
                        if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                            // Далее можно сохранить название файла в БД и т.п.
                            if(count($result) > 0){
                                $pics =  self::recordUpload($result);
                                $success = self::recordFile($pics, $id);
                            } else {
                                return 'Не удалось загрузить файл.';
                            }
                        } else {
                            return 'Не удалось загрузить файл.';
                        }
                    }
                }
            }
        }
        return true;
    }

    public static function recordUpload($data){
        if($data){
            $model = new Uploads();
            if($model->load($data, '')){
                if($model->save()){
                    return $model->id;
                }
            }
        }else {
            return 'Не удалось загрузить файл';
        }
    }

    public static function recordFile($pics, $user_id){
        $data = [
            'parentid' => 0,
            'source_id' => 0,
            'lang_id' => 0,
            'country_id'=> 0,
            'sid' => 'frontend',
            'orderid' => 0,
            'title' => 'Clients',
            'pics' => $pics,
            'active' => 1,
            'user_id' => $user_id
        ];
        $model = new Files();
        if($model->load($data, '')){
            if($model->save()){
                return 'success';
            }
        }
    }
}