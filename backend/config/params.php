<?php
return [
	'bsVersion' => '4.x', // this will set globally `bsVersion` to Bootstrap 4.x for all Krajee Extensions
  /*
  'maskMoneyOptions' => [
    'prefix' => '',
    'suffix' => ' р.',
    'affixesStay' => true,
    'thousands' => ',',
    'decimal' => '.',
    'precision' => 2, 
    'allowZero' => true,
    'allowNegative' => true,
  ],
  */
  'FILEINPUT_CONFIG'  => [
      'options' => [
          'accept' => 'image/*',
          'class' => 'upload_image_field file',
          'placeholder' => '',
          'type' => 'file',
          'multiple' => true,
      ],
      'language' => 'ru',
      'pluginOptions' => [
          'showPreview' => true,//false,
          'showUpload' => false,
          'showRemove' => true,
          'showCancel' => true,
          'showClose' => true,
          'placeholder' => false,
          'dropZoneTitle' => 'Выберите файл',
          'mainClass' => 'upload_imageFile',
      ],
  ],
  'VIEWS' => [
      'index' => 'Home',
      'about' => 'About Us'
  ],
  "CMS_USERS_ACCESS" => [
  	"sdesk" => [
  		"links" => [
  			"Переход в SD" => "/sdesk",
  		],
  	],
  ],
];
