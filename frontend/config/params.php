<?php

$sn = $_SERVER["SERVER_NAME"];
$isTestServer = false;
if(preg_match("{test\.}si", $sn) || preg_match("{localhost}si", $sn)) {
	$isTestServer = true;
}

$params = [
    "isTestServer"  => $isTestServer,
    "adminEmail"    => "webdevelopment@tillypad.ru",
    "supportEmail"  => $isTestServer ? "partner@rus.support" : "webdevelopment@tillypad.ru",
    "feedbackEmail" => $isTestServer ? "partner@rus.support" : "webdevelopment@tillypad.ru",
    //'supportEmail' => "support@complete.ru",
    //"feedbackEmail" => "feedback@complete.ru",
    //'supportEmail' => "cc@rus.support",
    //-- using for CMS
  	"STORAGE_UPLOAD_PATH" => "../../backend/web/data/storage/",
  	"STORAGE_DOMAIN" => "https://admin.markup.datamist.ru/",
];

//- add params from BACKEND
$params = array_merge($params, include("../../backend/config/params.php"));

return $params;
