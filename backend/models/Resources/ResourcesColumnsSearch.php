<?

namespace backend\models\Resources;

use yii\data\ActiveDataProvider;

class ResourcesColumnsSearch extends ResourcesColumns
{
    public function search($params)
    {
        $query = ResourcesColumns::find();
        
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
