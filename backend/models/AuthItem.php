<?

namespace backend\models;

class AuthItem extends AbstractModel
{
  public $permissions;

  const TYPE_ROLE = 1;
  const TYPE_PERMISSION = 2;
  
  public static function tableName()
  {
      return 'auth_item';
  }
  
  public function rules()
  {
      $defaultAttrs = array_keys($this->attributeLabels());
      return [
          [$defaultAttrs, 'default'],
      ];
  }
  
  public function attributeLabels()
  {
    return [
  		'id' => 'ID',
  		'name' => 'Имя',
			'type' => 'Тип',
  		'description' => 'Описание',
			'rule_name' => 'Имя правила',
			'data' => 'Данные',
			'created_at' => 'Создано',
			'updated_at' => 'Изменено',
			'permissions' => 'Разрешения',
			'orderid' => 'Сортировка',
			'active' => 'Активность',
    ];
  }

  public function beforeSave($insert)
  {
    if($insert) {
    	$this->created_at = time();
    	$maxId = (int)$this->getMaxId('id');
      $this->id = $maxId + 1;
    } else {
      $this->updated_at = time();
    }
    $this->active = !empty($this->active) ? $this->active : 0;
    return parent::beforeSave($insert);
	}

  public static function getRoles($type=null)
  {
  	$query = self::find()->orderBy('orderid');
  	if(!is_null($type)) {
  		$query->where(['type' => $type]);
  	}
  	$rows = $query->all();
  	return $rows;
  }

}