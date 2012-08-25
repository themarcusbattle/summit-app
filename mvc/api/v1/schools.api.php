<?php 

class schoolsApi extends Api {
	
	public function index() {
		
		if($_SERVER['REQUEST_METHOD'] == "GET") {
			
			$this->returnData($this->registry->db_local->findAllSchools());
		
		} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
			
			$school = $this->registry->db_local->findSchool($_POST);
		
			if($school) { 
				$_SESSION['cur_school_name'] = $school['name'];
				$_SESSION['cur_school_id'] = $school['school_id'];
				
				$this->returnData(array('success' => true));
			} else {
				$this->returnData(array('success' => false));
			}
		}
		
		
	}
	
	
}

?>