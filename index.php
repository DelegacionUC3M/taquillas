<?php

require_once('config.php');
session_start();

function __autoload($class) {
	str_replace(array('.', '/'), '' , $class);
	if (file_exists('app/controllers/'.$class.'.php')) {
		include ('app/controllers/'.$class.'.php');
	} else if (file_exists('app/models/'.$class.'.php')) {
		include ('app/models/'.$class.'.php');
	} else if (file_exists('app/views/'.$class.'.php')) {
		include ('app/views/'.$class.'.php');
	} else if (file_exists('app/component/'.$class.'.php')) {
		include ('app/component/'.$class.'.php');
	}

	if (!class_exists($class)) {
		Controller::error(404);
	}
}

$controller = (isset($_GET['c']) && !empty($_GET['c'])) ? $_GET['c'] . 'Controller' : 'inicioController';
$action 	= (isset($_GET['a']) && !empty($_GET['a'])) ? $_GET['a'] . 'Action' : 'indexAction';

if (method_exists($controller, $action)) {
	$load = new $controller();
	$load->$action();
} else {
	Controller::error(404);
}
