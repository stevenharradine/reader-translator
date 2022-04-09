<?php
	$host = "localhost";
	$username = "reader_translator";
	$password = "password";
	$dbname = "reader_translator";

	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$originWord=$_REQUEST['originWord'];	// TODO: sanitize and use post/get
		$originLanguage=$_REQUEST['originLanguage'];	// TODO: sanitize and use post/get
		$destinationWord=$_REQUEST['destinationWord'];	// TODO: sanitize and use post/get
		$destinationLanguage=$_REQUEST['destinationLanguage'];	// TODO: sanitize and use post/get

		//$stmt = $conn->prepare("SELECT destinationWord FROM words where originLanguage=\"$originLanguage\" AND destinationLanguage=\"$destinationLanguage\" AND originWord=\"$originWord\"");
		$sql="INSERT INTO words (originWord, originLanguage, destinationWord, destinationLanguage) VALUES ('$originWord', '$originLanguage', '$destinationWord', '$destinationLanguage');";

		$stmt = $conn->prepare($sql);
		$stmt->execute();

		echo "successful";
	} catch(PDOException $e) {
	  echo "Connection failed: " . $e->getMessage();
	}
?>