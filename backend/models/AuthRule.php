<?

namespace backend\models;

use Yii;
use backend\helpers\Funcs;
use backend\controllers\AbstractController;

class AuthRule extends AbstractModel
{
  const TYPE_ACTION = 1;
  const TYPE_MENU = 2;
  const TYPE_SECTION = 3;
  
  /*
  public $actions;
  public $roles;
	public $controllers;
	public $ips;
	public $allow;
  */
  public static function tableName()
  {
      return 'auth_rule';
  }

  public static function getListOfTypes()
  {
    return [
    	self::TYPE_ACTION => "Действие (Action)",
    	self::TYPE_MENU => "Меню (Menu)",
    	self::TYPE_SECTION => "Раздел (Section)",
    ];
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
			'data' => 'Данные',
			'created_at' => 'Создано',
			'updated_at' => 'Изменено',
			'orderid' => 'Сортировка',
			'active' => 'Активность',
			//-- details
			'actions' => 'Действия',
			'roles' => 'Роли',
			'controllers' => 'Контроллеры',
			'menus' => 'Меню',
			'sections' => 'Разделы',
			'ips' => 'IP адреса',
			'allow' => 'Разрешение',
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

    //-- save into the "data" field!
    $data = [];
    $data['actions'] = $this->actions;
		$data['roles'] = $this->roles;
		$data['controllers'] = $this->controllers;
		$data['ips'] = $this->ips;
		$data['menus'] = $this->menus;
		$data['sections'] = $this->sections;
		$data['allow'] = $this->allow;

		if($this->type == self::TYPE_MENU) {
    	$this->actions = [];
    	$this->sections = [];
    }
    if($this->type == self::TYPE_SECTION) {
    	$this->menus = [];
    }
		
		/*
		!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		!!                                                          !!
		!!  MultiCheckbox is handling in AbstractModel::beforeSave  !!
		!!                                                          !!
		!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		$this->data = serialize($data);
		$this->actions = serialize($this->actions);
		$this->roles = serialize($this->roles);
		$this->controllers = serialize($this->controllers);
		$this->menus = serialize($this->menus);
		$this->sections = serialize($this->sections);
		*/
    
		if(Funcs::is_serial(serialize($data))) {
			Yii::$app->session->addFlash("success", "Правила сериализованы корректно!");
		}
		
    return parent::beforeSave($insert);
	}

	/**
	 *
	 * Gets rules for different conditions
	 *
	 * @type - type of rules: TYPE_ACTION or TYPE_MENU or TYPE_SECTION (default: null - for ANY rules)
	 * @role - role or name of rule (default: null - for ANY roles and names)
	 * @useCurrentUser - use or not the user taht currently registered in system (default: false)
	 *
	 */
	public static function getAuthRules($type=null, $role=null, $useCurrentUser=false, $key=null)
	{
		$result = [];

		//if($key !== "debug") {
		//	return $result;
		//}

		if(!is_null($type)) {
			$rows = self::find()->where(['type' => $type, 'active' => 1])->all();
		} else {
			$rows = self::find()->where(['active' => 1])->all();
		}
		if(is_null(Yii::$app->user->identity)) {
			return $result;
		}
		$id = Yii::$app->user->identity->id;

		$currentUserRole = User::getUserRole();
		foreach($rows as $row) {
			//-- name of the rule
			$name = $row->name;
			//-- list of roles
			$roles = $row->roles;
			
			$isFound = true;
			if(Funcs::is_serial($roles)) {
				$rolesAvail = unserialize($roles);
				
				if(!is_array($rolesAvail)) {
					$rolesAvail = [];
				}
				$rolesAvail[] = $name;
				//-- we should use the role,
				//-- but it is not on the list of available roles!
				if(!is_null($role) && !in_array($role, $rolesAvail)) {
					$isFound = false;
				}
				//-- we should use the current user for the specified role,
				//-- but he does not have this one!
				if($useCurrentUser && !is_null($role) && $role !== $currentUserRole) {
					$isFound = false;
				}
				//-- we should use the current user without the role specified,
				//-- but his role is not on the list of available roles!
				if($useCurrentUser && is_null($role) && !in_array($currentUserRole, $rolesAvail)) {
					$isFound = false;
				}
			}
			if($isFound) {
				$data = [];
        if(Funcs::is_serial($row->actions)) {
					$data['actions'] = unserialize($row->actions);
				}
        if(Funcs::is_serial($row->roles)) {
					$data['roles'] = unserialize($row->roles);
				}
        if(Funcs::is_serial($row->sections)) {
					$data['sections'] = unserialize($row->sections);
				}
				$data['allow'] = $row->allow;
				$result[] = $data;
			}
		}
		return $result;
	}

	public static function getAuthRulesForSections()
  {
		$role = null;
		$useCurrentUser = true;
		$result = self::getAuthRules(AuthRule::TYPE_SECTION, $role, $useCurrentUser);
		$sectionRulesList = [];
		foreach($result as $rule) {
			//-- check for the rules are allowed
			if(!empty($rule["sections"]) && !empty($rule["actions"]) && $rule["allow"] == 1) {
				$sections = $rule["sections"];
				$actions = $rule["actions"];
				foreach($sections as $section) {
					if(!array_key_exists($section, $sectionRulesList)) {
						$sectionRulesList[$section] = [];
					}
					$sec = $sectionRulesList[$section];
					$sec = array_merge($sec, $actions);
					$sectionRulesList[$section] = array_unique($sec);
				}
			}
		}
		return $sectionRulesList;
	}

	public static function getFieldsDependencies()
  {
  	$fieldsDependencies = [
  		"field_main" => "type",
  		"field_dependencies" => [
  			self::TYPE_ACTION => [
  				"type" => self::TYPE_ACTION,
  				"name",
  				"roles",
  				"allow",
  				"controllers",
  				"actions",
  				"ips",
  			],
  			self::TYPE_MENU => [
  				"type" => self::TYPE_MENU,
  				"name",
  				"roles",
  				"allow",
  				"menus",
  			],
  			self::TYPE_SECTION => [
  				"type" => self::TYPE_SECTION,
  				"name",
  				"roles",
  				"allow",
  				"actions",
  				"sections",
  			],
  		],
  	];

  	return $fieldsDependencies;
  }

  public static $canUserDoAction = [];
  public static $menuRulesList = [];
  public static function canUseAuthRuled($section=null)
  {
  	//-- check the access to the page!
  	if(!is_null($section) && !empty($section)) {
  		$sectionNameParameter = $section;
  	} else {
			$sectionNameParameter = \Yii::$app->getRequest()->getQueryParam('section');
		}
		$globalControllerId = Yii::$app->controller->id;
		$globalActionId = Yii::$app->controller->action->id;
		if($globalControllerId === "resources" || preg_match("{resources\/.*?}si", $globalControllerId)) {
			$sectionNameParameter = "resources";
		}

  	$accessFound = false;

  	//-- make list of all available actions that user can do
		$methodsList = AbstractController::getAllActions();
		
		self::$canUserDoAction = [];
		foreach($methodsList as $controller => $actionsList) {
			foreach($actionsList as $action) {
				if(!array_key_exists($action, self::$canUserDoAction)) {
					self::$canUserDoAction[$action] = true;
				}
			}
		}
		ksort(self::$canUserDoAction);
		//-- save ROOT permissions
		$rootUserDoAction = self::$canUserDoAction;

		
		//-- get current resource by its section
		$resource = Resources::getResourceByResourceName($sectionNameParameter);
		//-- check sections rules for current user
		$sectionRulesList = AuthRule::getAuthRulesForSections();
		//-- check menus rules for current user
		self::$menuRulesList = array_keys($sectionRulesList);
		
		//-- get all parent resources
		if(!empty($resource->id)) {
	  
			$resourceParent = new Resources();
			$resourceParent->getResourceParents($resource->id, "parentid");
			
			$availableIds = [$resource->id];
			if(!empty($resourceParent->resourcesParentIds)) {
				$availableIds = array_merge($availableIds, $resourceParent->resourcesParentIds);
				$availableIds = array_unique($availableIds);
				//-- check if parents are accessible
				foreach($availableIds as $availableId) {
					if(in_array($availableId, self::$menuRulesList)) {
						$accessFound = true;
						break;
					}
				}
			}
    
			
			//-- check sections rules for current user
			if(array_key_exists($resource->id, $sectionRulesList)) {
				$actionsList = $sectionRulesList[$resource->id];
				foreach(self::$canUserDoAction as $action => $value) {
					if(in_array($action, $actionsList)) {
						//-- FOUND: activate this action for what user can do
						self::$canUserDoAction[$action] = true;
					} else {
						//-- NOT FOUND: deactivate this action (user can NOT do this)
						self::$canUserDoAction[$action] = false;
						if($globalActionId == $action) {
							//-- access denied to this page
							$accessFound = false;
						}
					}
				}
			} else {
				foreach(self::$canUserDoAction as $action => $value) {
					self::$canUserDoAction[$action] = false;
					if($globalActionId == $action) {
						//-- access denied to this page
						$accessFound = false;
					}
				}
			}
	  
		}

		if(IS_ROOT) {
			//-- restore ROOT permissions
			self::$canUserDoAction = $rootUserDoAction;
		}

		return $accessFound;
  }
    
}