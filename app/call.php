<?php 

// Auto Load App function
spl_autoload_register(function($class){
	$file = __DIR__ . '\\core\\' . $class . '.php';
	if (file_exists($file)) {
		require 'core/' . $class . '.php';
	}
});

// Auto Load Logic
spl_autoload_register(function($class){
	$file = __DIR__ . '\\logic\\' . $class . '.php';
	if (file_exists($file)) {
		require 'logic/' . $class . '.php';
	}
});

// Load Views (Front End)
include "Views.php";