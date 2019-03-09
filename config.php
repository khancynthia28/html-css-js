<?php
	/* Database credentials. Assuming you are running MySQL
	server with default setting (user 'cynthia_khan' with password P@ssw0rd!) */
	define('DB_SERVER', '192.185.4.123');
	define('DB_USERNAME', 'cynthia_khan');
	define('DB_PASSWORD', 'P@ssw0rd!');
	define('DB_NAME', 'cynthia_DB_School_Records');
 
	/* Attempt to connect to MySQL database */
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
	// Check connection
	if($link === false){
    		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
?>
