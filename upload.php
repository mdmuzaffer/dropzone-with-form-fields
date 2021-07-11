<?php

include_once 'db.php';


if (!empty($_FILES['file']['name'])) {
	
	$file_name = "";
	$firstname = $_REQUEST['firstname'];
	$email = $_REQUEST['email'];
    $totalFile = count($_FILES['file']['name']);
	for ($i=0; $i < $totalFile ; $i++) {

	    $fileName = $_FILES['file']['name'][$i]; 
	    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
	    $allowExtn = array('png', 'jpeg', 'jpg');

	    if (in_array($extension, $allowExtn)) {
		$newName = rand() . ".". $extension;

		$uploadFilePath = "uploads/".$newName;

		move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFilePath);

		$file_name .= $newName ." , ";	

	    }
	}

	$insert = "INSERT INTO users (`user_id`,`form_id`,`name`,`email`,`attachments`,`created_at`) VALUES ('','45','$firstname','$email','$file_name',NOW())";
	
	if($connection->query($insert)){
		echo "true";
	}
	else{
		echo"false";
	}
}
?>