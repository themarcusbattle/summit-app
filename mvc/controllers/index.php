<?php 
class indexController extends baseController {
	
	public function index() {
		$this->registry->template->show('checkin');
	}
	
	public function setSchool() {
		
	}
}
?>