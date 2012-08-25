<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0; user-scalable=no">

		<link href="/summit/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
		<link href="/summit/bootstrap/css/bootstrap-responsive.min.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		
    <div class="container">
    	<div class="row">
    		
    		<form>
	    		<h1>Bus Stop <small>Check-In</small></h1>
	    		<label>University</label>
	    		<select id="schools" name="school_id">
	    			<option value="">--</option>
					</select>
	    		<label>Student</label>
	    		<!--<input name="student_name" type="text" data-provide="typeahead" data-items="7" autocomplete="off" disabled />-->
	    		<select id="students" name="student_id">
	    			<option value="">--</option>
					</select>
	    		<p>&nbsp;</p>
	    		<!--<a class="btn btn-large btn-block btn-primary" type="button">Check In</a>
	    		<a class="btn btn-large btn-block" type="button" href="bus/add_student">Add New Student &amp; Check In</a>-->
	    		<input type="hidden" name="checkin_type" value="bus" />
	    		<button type="submit" class="btn btn-primary">Check In</button>
					<a class="btn btn-large btn-block" type="button" href="bus/add_student">Add New Student &amp; Check In</a>
    		</form>
    	</div>
    </div>
    
		<script src="/summit/media/js/jquery-1.7.2.min.js"></script>
		<script src="/summit/bootstrap/js/bootstrap.min.js"></script>
		<script>
		$(document).ready(function(){
			
			$.ajax({
			  type: "GET",
			  url: "api/1/schools.json?type='university'"
			  
			}).done(function( json ) {
			  $(json).each(function(){
				  $('#schools').append('<option value="' + this.school_id +'">' + this.name + '</option>'); 
			  });
			});
			
			$('#schools').change(function() { 
				
				$.ajax({
				  type: "GET",
				  url: "api/1/students.json",
				  data: { school_id:$(this).val() }
				  
				}).done(function( json ) {
				
					if(json) {
					  /* var source = [];
					  $(json).each(function() {
						  source.push(this.first_name + ' ' + this.last_name + ' (' + this.email + ')');
					  });
					  $('input[name="student_name"]').data('source',source).attr('disabled',false); */
					  $(json).each(function() {
					  	$('#students').append('<option value="' + this.student_id +'">' + this.first_name + ' ' + this.last_name + ' (' + this.email + ') </option>');
					  });
				  } else {
					  //$('input[name="student_name"]').attr('disabled',true);
				  }
				});
				
			});
			
			$('form').submit(function(e){
				e.preventDefault();
				
				$.ajax({
				  type: "POST",
				  url: "api/1/checkins.json",
				  data: $(this).serialize()
				  
				}).done(function(response) { 
					
					if(response.success) {
						alert('Student checked in');
						window.location = '/summit/bus';
					} else {
						alert('Error: Please select a registered university');
					}
				});
				
			});
			
		});
		</script>
	</body>
</html>