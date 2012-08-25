<?php

class router {

	private $registry;
	private $path;
	private $args = array();
	public $file;
	public $controller;
	public $method; 
	public $uri;
	
	function __construct($registry) {
		$this->registry = $registry;
		$this->uri = self::setURI();
	}

	// Set controller directory path
	function setPath($path) {

		// Check if path is a directory
		if (is_dir($path) == false) {
			throw new Exception ('Invalid controller path: `' . $path . '`');
		}
		// set the path
	 	$this->path = $path;
	}

	// Create the uri array
	public function setURI() {
		
		// Get the route from the url 
		$route = (empty($_GET['rt'])) ? '' : $_GET['rt'];
		
		// get the parts of the route
		$uri_parts = explode('/', $route);
		
		// remove the route parameter so that it won't interfere with other classes
		unset($_GET['rt']);
		
		return $uri_parts;
	}
	
	// Load the controller
	public function load() {
		
		// check if api was called
		if($this->uri[0] == 'api') {
		
			$this->registry->api->load();
			
		} else {

			// set the route's controller and assign to $this->file
			$this->getController();
			
			// If the file is not there load 404
			if (is_readable($this->file) == false) {
				$this->file = $this->path.'/error404.php';
				$this->controller = 'error404';
			}
			
			// Include the controller
			include $this->file;
			
			// a new controller class instance ***/
			$class = $this->controller . 'Controller';
			$controller = new $class($this->registry);
			
			/*** check if the action is callable ***/
			if (is_callable(array($controller, $this->method)) == false) {
				$action = 'index';
			
			} else {
				$action = $this->method;
			}
			
			// run the action
			$controller->$action();
		} // end else
		
	}

 	// get the controller
	private function getController() {
		
		if (empty($this->uri[0])) {
			$this->controller = 'index';
		} else {
			$this->controller = $this->uri[0];
		}
	
		// Get the method
		if (empty($this->uri[1])) {
			$this->method = 'index';
		} else {
			$this->method = $this->uri[1];
		}
		
		// set the file path of the controller
		$this->file = $this->path .'/'. $this->controller . '.php';
	}


}

?>