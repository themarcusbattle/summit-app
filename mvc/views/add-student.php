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
				  <legend>Add Student &amp; Check-In</legend>
				  <label>Name</label>
				  <input class="span3" type="text" placeholder="First" name="first_name">
					<input class="span3" type="text" placeholder="Last" name="last_name">
					<label>School</label>
					<select id="schools" name="school_id">
	    			<option value="">--</option>
					</select>
					<label>Email</label>
					<input class="span3" type="email" placeholder="you@email.com" name="email">
					<label>Cell Phone</label>
				  <input class="span3" type="text" placeholder="1.555.555.5555" name="phone_cell">
				  <p><input type="submit" class="btn btn-large btn-primary" value="Add New Student &amp; Check In" /></p>
				  <a class="btn btn-large btn-block" type="button" href="/summit/bus">Cancel</a>
				</form>
    	</div>
    </div>
    
		<script src="/summit/media/js/jquery-1.7.2.min.js"></script>
		<script src="/summit/bootstrap/js/bootstrap.min.js"></script>
		<script>
		$(document).ready(function(){
			
			$.ajax({
			  type: "GET",
			  url: "/summit/api/1/schools.json?type='university'"
			  
			}).done(function( json ) {
			  $(json).each(function(){
				  $('#schools').append('<option value="' + this.school_id +'">' + this.name + '</option>'); 
			  });
			});
			
			$('form').submit(function(e){
				e.preventDefault();
				
				$.ajax({
				  type: "POST",
				  url: "/summit/api/1/students.json",
				  data: $(this).serialize()
				  
				}).done(function(response) { 
					
					if(response.success) {
						alert('student added!');
						window.location = '/summit/bus';
					} else {
						alert('Error: Student was not added and is not checked into the bus');
					}
				});
				
			});
			
		});
		</script>
	</body>
</html>