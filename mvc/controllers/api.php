<?php 
class apiController extends baseController {
	
	public function index() {
		
	}
	
	public function students() {
		
		echo "students";
		
	}
	
	public function schools() {
		include(__SITE_PATH . '/mvc/api/api.schools.php');
		
		$api = new schoolsApi();
		
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			
			if(count($this->registry->parts) >= 3) {
				
				$school = $this->registry->db_local->findSchool($_POST);
				
			} else {
				
				$result = $this->registry->db_local->findAllSchools();
				print_r($result);
				
			}
			
		} else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			$students = $this->registry->db_local->addSchool($_POST);
			
		} else if($_SERVER['REQUEST_METHOD'] == 'PUT'){
			
			
		} else if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
			
			
		}
	}
	
	public function majors() {
		echo "majors";
	}
	
	public function home_churches() {
		echo "home churches";
	}
	
}
?>