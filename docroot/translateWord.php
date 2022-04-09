<?php
	$method = "LibreTranslate"; // database | LibreTranslate

	$originWord=$_REQUEST['word'];	// TODO: sanitize and use post/get
	$originLanguage=$_REQUEST['source'];	// TODO: sanitize and use post/get
	$destinationLanguage=$_REQUEST['destination'];	// TODO: sanitize and use post/get

function callAPI($method, $url, $data){
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'APIKEY: 111111111111111111111',
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}

	if ($method == "LibreTranslate") {
$get_data = callAPI('POST', 'http://localhost:5000/translate', '{"q":"'.$originWord.'","source":"'.$originLanguage.'","target":"'.$destinationLanguage.'"}');
$response = json_decode($get_data, true);
$errors = $response['response']['errors'];
$data = $response['response']['data'][0];
echo json_decode($get_data, true)['translatedText'];
	} else if ($method == "database") {
		$host = "localhost";
		$username = "reader_translator";
		$password = "password";
		$dbname = "reader_translator";

		try {
			$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare("SELECT destinationWord FROM words where originLanguage=\"$originLanguage\" AND destinationLanguage=\"$destinationLanguage\" AND originWord=\"$originWord\"");
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($data as $row) { 
				// iterate over values in each row
				foreach($row as $v) { 
					echo $v, "; ";
				}
			}
		} catch(PDOException $e) {
		  echo "Connection failed: " . $e->getMessage();
		}
	}
?>