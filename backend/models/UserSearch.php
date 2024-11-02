<?

namespace backend\models;

use yii\data\ActiveDataProvider;

class UserSearch extends User
{
  
  public function search($params)
  {
    $query = User::find();
    
    $dataProvider = new ActiveDataProvider([
    	'query' => $query,
    ]);
            
    $this->load($params);
    
    $query->andFilterWhere(['id' => $this->id])
    	->andFilterWhere(['like', 'username', $this->username])
      ->andFilterWhere(['like', 'fullname', $this->fullname])
      ->andFilterWhere(['like', 'email', $this->email])
      ->andFilterWhere(['like', 'role', $this->role])
    ;

    if(!is_null(\Yii::$app->user->identity)) {
			$role = \Yii::$app->user->identity->role;
			$rolesDependencies = User::getRolesDependencies();
			if(array_key_exists($role, $rolesDependencies)) {
				$query->andWhere(['in', 'role', $rolesDependencies[$role]]);
			}
		}

    $query->orderBy('role','id');
    
    return $dataProvider;
  }

}
