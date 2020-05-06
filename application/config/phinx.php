<?php

// Path to the system directory
define('BASEPATH', 'system');
require_once __DIR__ ."/database.php";

if (is_array($db['default'])) {

	$config = $db['default'];

	return
	[
	    'paths' => [
	        'migrations' => '%%PHINX_CONFIG_DIR%%/../db/migrations',
	        'seeds' => '%%PHINX_CONFIG_DIR%%/../db/seeds'
	    ],
	    'environments' => [
	        'default_migration_table' => 'phinxlog',
	        'default_database' => 'default',
	        'default' => [
	            'adapter' => 'mysql',
	            'host' => $config['hostname'],
	            'name' => $config['database'],
	            'user' => $config['username'],
	            'pass' => $config['password'],
	            'port' => '3306',
	            'charset' => 'utf8',
	        ],
	        // 'development' => [
	        //     'adapter' => 'mysql',
	        //     'host' => 'localhost',
	        //     'name' => 'development_db',
	        //     'user' => 'root',
	        //     'pass' => '',
	        //     'port' => '3306',
	        //     'charset' => 'utf8',
	        // ],
	        // 'testing' => [
	        //     'adapter' => 'mysql',
	        //     'host' => 'localhost',
	        //     'name' => 'testing_db',
	        //     'user' => 'root',
	        //     'pass' => '',
	        //     'port' => '3306',
	        //     'charset' => 'utf8',
	        // ]
	    ],
	    'version_order' => 'creation'
	];
	# code...
} else {
	return false;
}
