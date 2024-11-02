<?

namespace backend\models\Resources;

use yii\data\ActiveDataProvider;

class ResourcesConditionsSearch extends ResourcesConditions
{
    public function search($params)
    {
        $query = ResourcesConditions::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
                
        $this->load($params);
        
        if(!$this->validate()) {
        
            $query->where('1=0');
            return $dataProvider;
            
        }
        
        $query->where = $params;
        $query->orderBy(['orderid'=>SORT_ASC]);
        
        return $dataProvider;        
    }
}
