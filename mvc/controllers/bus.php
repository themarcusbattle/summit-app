<?php 
class busController extends baseController {
	
	public function index() {
		$this->registry->template->show('checkin');
	}
	
	public function checkin() {
		$this->registry->template->show('checkin');
	}
	
	public function add_student() {
		$this->registry->template->show('add-student');
	}
	
}
?>