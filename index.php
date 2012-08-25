<?php
	/*
		Title: Simple PHP Framework w/ API support
		Author: Marcus Battle
		Date: August 8, 2012
	*/
	
	// Define the site path
	$site_path = realpath(dirname(__FILE__));
	define ('__SITE_PATH', $site_path);
	
	// Load app configurations
	include 'app/settings/init.php';
	include 'app/settings/config.php';
	
	// Mode specific settings (i.e. errors turned on for 
	if((__APP_MODE == 'development') || (!__APP_MODE)) {
		error_reporting(E_ALL);
	} else if (__APP_MODE == 'production') {
		error_reporting(0);
	}
	
	// Initialize the app classes
	$registry->router = new router($registry);
	$registry->router->setPath (__SITE_PATH . '/mvc/controllers');
	$registry->template = new template($registry);
	$registry->api = new api($registry);
	
	// Start the session
	session_start();
	
	// load the proper controller
	$registry->router->load();

?>
