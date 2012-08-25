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
	    		<h1>Bus Stop <small>The Summit</small></h1>
	    		<select id="schools" name="school_id">
	    			<option value="">--</option>
					</select>
	    		<p><input type="submit" class="btn btn-primary btn-large" value="GO!" /></p>
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
			
			$('form').submit(function(e){
				e.preventDefault();
				
				$.ajax({
				  type: "POST",
				  url: "api/1/schools.json",
				  data: $(this).serialize()
				  
				}).done(function(response) { 
					
					if(response.success) {
						window.location = 'bus/checkin';
					} else {
						alert('Error: Please select a registered university');
					}
				});
				
			});
			
		});
		</script>
	</body>
</html>