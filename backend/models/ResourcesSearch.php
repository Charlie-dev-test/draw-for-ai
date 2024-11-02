<?php

namespace backend\models;

use yii\data\ActiveDataProvider;

class ResourcesSearch extends Resources
{
    public function  search($params)
    {
        $query = Resources::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
        			'pageSize' => 10,
    				],
        ]);
                
        $this->load($params);
        
        if(!$this->validate()) {
        
            $query->where('1=0');
            return $dataProvider;
            
        }
        //query filter
        $query->andFilterWhere([
            'id' => $this->id,
            'parentid' => $this->parentid,
        ]);
        
        $query->andFilterWhere(['like', 'title', $this->title])
              ->andFilterWhere(['like', 'model', $this->model]);
        
        $query->orderBy('orderid');
        
        return $dataProvider;
    }
}
