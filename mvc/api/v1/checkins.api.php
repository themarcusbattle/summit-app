<?php 

class checkinsApi extends Api {
	
	public function index() {
		
		if($_SERVER['REQUEST_METHOD'] == "GET") {
			
		
		} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
			
			$success = $this->registry->db_local->addCheckin($_POST);
			
			if($success) {
				$this->returnData(array('success' => true));
			} else {
				$this->returnData(array('success' => false));
			}
		}
		
		
	}
	
	
}

?>