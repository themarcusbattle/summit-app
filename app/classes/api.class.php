<?php
class api {
	
	protected $registry;
	private $response_type;
	private $version;
	private $api;
	private $method;
	private $file;
	
	public function __construct($registry) {
		$this->registry = $registry;
	}
	
	public function setVersion($version) {
		$this->version = $version;
	}
	
	public function setResponseType() {
		
		// Define the response type
		$uri_end = end($this->registry->router->uri);
		$this->response_type = substr(strrchr($uri_end,'.'),1);
		
		if($this->response_type) {
			
			// remove the extension from the method so that it loads properly
			$response_index = count($this->registry->router->uri) - 1;
			$this->registry->router->uri[$response_index] = str_replace(".".$this->response_type,'',$this->registry->router->uri[$response_index]);
			
		} else {
			echo "no response type defined";
			exit;
		}
	}
	
	public function load() {
		
		// Set the api version to be used
		if(isset($this->registry->router->uri[1])) {
			self::setVersion($this->registry->router->uri[1]);
		} else {
			echo "version must be set";
			exit;
		}
		
		// Define 
		self::setResponseType();
		
		// define which api is going to be used
		if(isset($this->registry->router->uri[2])) {
			$this->api = $this->registry->router->uri[2];
		} else {
			$this->api = NULL;
		}
		
		if(isset($this->api)) {
			
			// load the file
			$this->file = __SITE_PATH . '/mvc/api/v' . $this->version . '/' . $this->api . '.api.php';
			
			if (is_readable($this->file) == true) {
				
				include $this->file;
				
				// a new controller class instance
				$class = $this->api . 'Api';
				$api = new $class($this->registry);
				
				// Assign response type to this api instance 
				$api->response_type = $this->response_type;
				
				// Define the method to be called. If not defined, search for the main function
				if(isset($this->registry->router->uri[3])){
					$this->method = $this->registry->router->uri[3];
				} else {
					$this->method = 'index';
				}
				
				// Attempt to load the defined method
				if (is_callable(array($api, $this->method)) == true) {
				
					$func = $this->method;
					$api->$func();
					
				} else {
					echo "method not found";
				}
				
			} else {
				
				echo "api not found";
			}
			
		} else {
			echo "improper call. please define the object";
		}
	}
	
	public function returnData($result) {
		
		if($this->response_type == 'json') {
			header('Content-type: application/json');
			echo json_encode($result);
		} elseif ($this->response_type == 'xml') {
			echo "xml is currently unavailable";
		} else {
			echo "your reponse type is unsupported";
		}
	}
	
	
}
?>