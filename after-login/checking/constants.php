<?php 
		//start session
		session_start();
		define('SITEURL', '');
		define('LOCALHOST',  'localhost');
		define('DB_USERNAME',  'root');
		define('DB_PASSWORD', '');
		define('DB_NAME', '');

		$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD); //database connections

		$db_select = mysqli_select_db($conn, DB_NAME) or die (mysqli_error()); //connecting database
?>