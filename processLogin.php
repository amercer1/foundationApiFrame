<!DOCTYPE html>
<html>
<head>
	<title>Processing</title>
        <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body onload="loadFiles();">
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

  header( 'Location: page1.php');         

} else if($resultStatus['http_code'] == 401){
    
   /*
   echo 'Login Failed ';

    echo'<form class="form-horizontal" action="process.php" method="post">
  <div class="control-group">
    <label class="control-label" name="login"for="login">Email</label>
    <div class="controls">
      <input type="text" name="login" id="login" placeholder="Username">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" name="password" for="password">Password</label>
    <div class="controls">
      <input type="password" name="password" id="inputPassword" placeholder="Password">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Sign in</button>
    </div>
  </div>
</form>';
 */
	header( 'Location: login.php');
} else{

    echo 'Login Failed '.print_r($resultStatus);
}

//Destroy php curl object
curl_close ($ch);

?>

   <script type="text/javascript" src="script.js"></script>
</body>
<html>
