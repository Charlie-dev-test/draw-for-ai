<?php

namespace backend\models\Resources;

use yii\data\ActiveDataProvider;

class ResourcesFormsParamsSearch extends ResourcesFormsParams
{
    public function search($params)
    {
        $query = ResourcesFormsParams::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
                
        $this->load($params);
        
        if(!$this->validate()) {
        
            $query->where('1=0');
            return $dataProvider;
            
        }
        
        unset($params["resourceid"]);
        $query->where = $params;
        $query->orderBy(['orderid'=>SORT_ASC]);
        
        return $dataProvider;        
    }
    
}
