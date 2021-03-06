<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require 'config.php';


spl_autoload_register(function($class){
	
	if(file_exists('controllers/'.$class.'.php')) {
            require_once 'controllers/'.$class.'.php';
    } 
    else if(file_exists('models/'.$class.'.php')) {
            require_once 'models/'.$class.'.php';
    } 
    else if(file_exists('core/'.$class.'.php')) {
            require_once 'core/'.$class.'.php';
    }

});

$core = new Core();
$core->start();

?>
