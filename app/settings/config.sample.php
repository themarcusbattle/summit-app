<?php
	// Define which mode your app is in (Acceptable values = test,development,production)
	define ('__APP_MODE', '');
	
	// Initialize any databases you've created in mvc/models
	/* 
		{database type} - acceptable values are (mysql,dblib)
		$registry->{database variable} = 
			new {database class name}('{databasetype}','{host}','{database_name}','{username}','{password}');
	*/
?>