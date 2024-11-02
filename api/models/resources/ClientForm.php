<?php


namespace api\models\resources;

use api\models\Client;

class ClientForm extends Client
{
    public function fields()
    {
        return [
            'username', 'fullname'
        ];
    }

}