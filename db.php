<?php 
  //Database configuration 
  $host     = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $dbName     = "test"; 
 
  // Create database connection 
  try {
		$connection = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
	} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
	}
?>