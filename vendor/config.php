<?php

session_start();

define("BANCO", [
	'HOST'=>'localhost',
	'DB'=>'sun_admin',
	'USER'=>'root',
	'PASS'=>''
]);

spl_autoload_register(function($className){
	if (file_exists('vendor'.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.$className.'.php')) {
		require_once('vendor'.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.$className.'.php');
	}
});

?>