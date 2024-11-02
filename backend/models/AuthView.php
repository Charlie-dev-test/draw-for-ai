<?

namespace backend\models;

use backend\helpers\Funcs;

class AuthView extends AbstractModel
{
  
  public static function tableName()
  {
      return 'auth_view';
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
  		'id'        => 'ID',
  		'sid'       => 'SID источника',
			'source_id' => 'ID источника',
			'resources' => 'Ресурсы',
  		'roles'     => 'Роли',
			'active'    => 'Активность',
    ];
  }

  public function beforeSave($insert)
  {
    $this->active = !empty($this->active) ? $this->active : 0;
    
    /*
    !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		!!                                                          !!
		!!  MultiCheckbox is handling in AbstractModel::beforeSave  !!
		!!                                                          !!
		!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    if(!empty($this->resources)) {
    	$this->resources = serialize($this->resources);
    }
    if(!empty($this->roles)) {
    	$this->roles = serialize($this->roles);
    }
    	
    if(Funcs::is_serial($this->resources) && Funcs::is_serial($this->roles)) {
			\Yii::$app->session->addFlash("success", "Правила сериализованы корректно!");
		} else {
			$this->resources = "";
			$this->roles = "";
		}
		*/

		$this->model = "";
		$sectionNameParameter = \Yii::$app->getRequest()->getQueryParam('section');
		$row = Resources::getParentResourceBySection($sectionNameParameter);
		if(!empty($row->model)) {
			$this->model = $row->model;
		}
    
    return parent::beforeSave($insert);
	}

  public static function getRoles($model, $source_id)
  {
  	$result = [];

  	$query = self::find()->where(['model' => $model, 'source_id' => $source_id, 'active' => 1]);
  	$rows = $query->all();
  	return $rows;
  }

  public static function canUseAuthViewed($parentResourceModel, $resourceid, $key)
  {
  	$canUseAuthViewed = false;
    
    $userRole = User::getUserRole();
    $authViewRows = self::getRoles($parentResourceModel, $key);
    $isAny = false;
    foreach($authViewRows as $row) {
    	if(!empty($row->model) && $row->model === $parentResourceModel) {
    		$rowResources = unserialize($row->resources);
    		$rowRoles = unserialize($row->roles);
    		
    		if(in_array($resourceid, $rowResources) && in_array($userRole, $rowRoles)) {
    			$canUseAuthViewed = true;
    			$isAny = true;
    		}
    	}
    }
    //-- there are no rows at all => show all links
    if(count($authViewRows) === 0) {
    	$canUseAuthViewed = true;
    }
    
    return $canUseAuthViewed;
  }

}