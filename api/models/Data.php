<?php


namespace api\models;

use yii\db\ActiveRecord;

class Data extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_id', 'number'],
            ['citizenship', 'trim'],
            ['dob', 'trim'],
            ['passport', 'trim'],
            ['passport_origin', 'trim'],
            ['passport_date', 'trim'],
            ['address_reg', 'string'],
            ['address_loc', 'string'],
            ['phone', 'string'],
            ['inn', 'string'],
            ['snils', 'string'],
            ['bank_card', 'string'],
            ['bank_card', 'trim'],
            ['bank_account', 'string'],
            ['bank_name', 'string'],
            ['bank_bik', 'string'],
            ['bank_corr', 'string'],
        ];
    }

    public static function tableName()
    {
        return '{{%userdata}}';
    }

    public  static function setUp($arr, $id){
        $data = [];
        $data['user_id'] = $id;
        $data['citizenship'] = $arr['citizenship'];
        $data['dob'] =$arr['dob'];
        $data['passport'] = $arr['passport_series'] . ' ' . $arr['passport_number'];
        $data['passport_origin'] = $arr['passport_origin'];
        $data['passport_date'] = $arr['pass_date'];
        $data['address_reg'] = $arr['address_reg'];
        $data['address_loc'] = $arr['address_loc'];
        $data['phone'] = $arr['phone'];
        $data['inn'] = $arr['inn'];
        $data['snils'] = $arr['snils'];
        $data['bank_card'] = $arr['bank_card'];
        $data['bank_account'] = $arr['bank_account'];
        $data['bank_name'] = $arr['bank_name'];
        $data['bank_bik'] = $arr['bank_bik'];
        $data['bank_corr'] = $arr['bank_corr'];
        $data['active'] = 1;
        $data['orderid'] = 0;
        return $data;
    }
}