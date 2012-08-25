<?php

	// Include application classes
	include __SITE_PATH . '/app/classes/' . 'controller.class.php';
	include __SITE_PATH . '/app/classes/' . 'registry.class.php';
	include __SITE_PATH . '/app/classes/' . 'router.class.php';
	include __SITE_PATH . '/app/classes/' . 'template.class.php';
	include __SITE_PATH . '/app/classes/' . 'db.class.php';
	include __SITE_PATH . '/app/classes/' . 'api.class.php';
	
	// Auto load model classes
	function __autoload($class_name) {
		$filename = strtolower($class_name) . '.class.php';
		$file = __SITE_PATH . '/mvc/models/' . $filename;
		
		if (file_exists($file) == false) {
			return false;
		}
		
		include ($file);
	}
	
	// create the registry object
	$registry = new registry;	
	
?>
