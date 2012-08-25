<?php 

class studentsApi extends Api {
	
	public function index() {
		
		if($_SERVER['REQUEST_METHOD'] == "GET") {
			
			if($_GET['school_id']) {
				$this->returnData($this->registry->db_local->findStudentsBySchool($_GET));
			}
		
		} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
			
			$success = $this->registry->db_local->addStudent($_POST);
			
			if($success) {
				$this->returnData(array('success' => true));
			} else {
				$this->returnData(array('success' => false));
			}
		}
		
		
	}
	
	
}

?>