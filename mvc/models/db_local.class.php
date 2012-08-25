<?php

class db_local extends Db {
		
	public function addSchool($school) {
		// check to see if school exists
		$school_exists = self::findSchool($_POST['school_name']);
		
		if(!$school_exists) {
			
			// add school
			$stmt = $this->db->prepare("
				INSERT INTO schools (name,city,state,type) VALUE(:a,:b,:c,:d)
			");
			$result = $stmt->execute(array(
				':a' => $_POST['school_name'],
				':b' => $_POST['school_city'],
				':c' => $_POST['school_state'],
				':d' => $_POST['school_type']
			));
			
			if($result) {
				return true;
			} else {
				return false;
			}
			
		} else {
			return false;
		}
		
	}
	
	public function findAllSchools() {
		$stmt = $this->db->query("
			SELECT * FROM schools ORDER BY name ASC
		");
		$result = $stmt->fetchAll();
		
		return $result;
	}
	
	public function findSchool($params) {
	
		$stmt = $this->db->prepare("
			SELECT * FROM schools WHERE school_id = :school_id
		");
		$stmt->execute(array(':school_id' => $params['school_id']));
		
		$result = $stmt->fetch();
		
		return $result;
	}
	
	public function addStudent($params) {
		
		$stmt = $this->db->prepare("
			INSERT INTO students (first_name,last_name,school_id,email,phone_cell)	VALUES (:first_name,:last_name,:school_id,:email,:phone_cell)	
		");
		$result = $stmt->execute(array(
			':first_name' => $params['first_name'],
			':last_name' => $params['last_name'],
			':school_id' => $params['school_id'],
			':email' => $params['email'],
			':phone_cell' => $params['phone_cell']
		));
		
		if($result) {
			return true;
		} else {
			return false;
		}
	}
	
	public function findStudentsBySchool($params) {
		$stmt = $this->db->prepare("
			SELECT * FROM students WHERE school_id = :school_id
		");
		$stmt->execute(array(':school_id' => $params['school_id']));
		$result = $stmt->fetchAll();
		
		return $result;
		
	}
	
	public function addCheckin($params) {
		
		$stmt = $this->db->prepare("
			INSERT INTO checkins (student_id,checkin_type)	VALUES (:student_id,:checkin_type)	
		");
		$result = $stmt->execute(array(
			':student_id' => $params['student_id'],
			':checkin_type' => $params['checkin_type']
		));
		
		if($result) {
			return true;
		} else {
			return false;
		}
	}
	
}

?>
