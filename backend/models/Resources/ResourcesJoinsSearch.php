<?php

namespace backend\models\Resources;

use yii\data\ActiveDataProvider;

class ResourcesJoinsSearch extends ResourcesJoins
{
    public function search($params)
    {
        $query = ResourcesJoins::find();
        
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
