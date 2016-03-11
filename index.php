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
	} else if (file_exists('app/components/'.$class.'.php')) {
		include ('app/components/'.$class.'.php');
	} else if (file_exists('app/components/fpdf/'.$class.'.php')) {
		include ('app/components/fpdf/'.$class.'.php');
	}

	if (!class_exists($class)) {
		Controller::error(404);
	}
}

$url = explode('/', $_SERVER["REQUEST_URI"]);
$controller = (isset($url[2]) && !empty($url[2])) ? $url[2] . 'Controller' : 'inicioController';
$action 	= (isset($url[3]) && !empty($url[3])) ? $url[3] . 'Action' : 'indexAction';

if (method_exists($controller, $action)) {
	$load = new $controller();
	$load->$action();
} else {
	Controller::error(404);
}
