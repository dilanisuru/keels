<?php
	session_start();
	function getConnection() {
		$connection = new mysqli("localhost:3306","root","" , "keelss" );
		if ($connection->connect_error)
		{
			die("Connection failed:" . $connection->connect_error);
			
		} 
		else {
			return $connection ;	
		}	
	}

?>