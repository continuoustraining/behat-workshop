<?php
return [
	'modules' => [
		'Application',
        'DoctrineModule',
        'DoctrineORMModule',
        'Ecommerce'
	],
	'module_listener_options' => [
		'config_glob_paths' => [
			'./config/autoload/{,*.}{global,local}.php',
		],
		'module_paths' => [
			'module',
		]
	],
	'service_manager' => [
		'factories' => [],
	],
];
