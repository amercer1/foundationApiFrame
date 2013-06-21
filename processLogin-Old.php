<?php

session_start();
// pull $_POST values and place them in variables 

$username=$_POST['login'];
$password=$_POST['password'];

// assign them to session cookies variables so that user can be logged in through a session
$_SESSION['login']=$username;
$_SESSION['password']=$password;

// Authentication of a user

//Create a php curl object    
$ch = curl_init();


//Base url for foundation api authentication for php curl  
$auth_url = 'http://foundation.iplantc.org/auth-v1/';

//Set php curl options. 
curl_setopt($ch, CURLOPT_URL,$auth_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POST, true);
$ch_values = "$username:$password";
curl_setopt($ch, CURLOPT_USERPWD, $ch_values);
// Getting results

//Execute the php curl and grab the response 
$response = curl_exec($ch);                                          
$resultStatus = curl_getinfo($ch);                                   

//If response went well, print three forms for user to use.  If not ask for user to re-enter data
if($resultStatus['http_code'] == 200) {
   

	// Take response and turn it into json
  $handled_json = json_decode($response,true);

	//grab the token and place it in a session variable
  $TOKEN=$handled_json['result']['token'];
  $_SESSION['token']=$TOKEN;

  $arr = array('valid' => 1);

  echo json_encode($arr);

  //header( 'Location: page1.php');         

} else if($resultStatus['http_code'] == 401){
 

  $arr = array('valid' => 0);
  echo json_encode($arr); 
   /*
 */
//	header( 'Location: login.php');
} else{

  $arr = array('valid' => 0);

  echo json_encode($arr);
//    echo 'Login Failed '.print_r($resultStatus);
}

//Destroy php curl object
curl_close ($ch);

?>

