<?php
namespace api\models\resources;

use api\models\Client;

class ClientResource extends Client
{
    public function fields()
    {
        return [
            'id', 'username', 'access_token', 'offer_token', 'active'
        ];
    }
}