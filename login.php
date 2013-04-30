<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
        <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<script type="text/javascript" src="processLogin.js"></script>

</head>
<body>

<!-- Create a form, action will send all data to process.php with a post method. In process.php you will find user entered
info in $_POST object-->
<div class="span4">

<h2>APP TITLE HERE</h2>
<br />
<form class="form-horizontal" action="processLogin.php" method="post" onsubmit="processLogin()">
 
  <!-- Style div  -->
  <div class="control-group">
     <!-- label  -->
    <label class="control-label" name="login"for="login">iPlant Username</label>
    <div class="controls">
	<!-- username inputbox -->
      <input type="text" name="inputLogin" id="inputLogin" placeholder="Username">
    </div>
  </div>
 

  <!--styel div  -->
 <div class="control-group">
     <!-- lable -->
    <label class="control-label" name="password" for="password">Password</label>
    <div class="controls">
      <!--username password box -->
      <input type="password" name="password" id="inputPassword" placeholder="Password">
    </div>
  </div>
 
 <!-- style div -->
 <div class="control-group">
    <div class="controls">
       <!-- submit button -->
      <button type="submit" class="btn">Sign in</button>
    </div>
  </div>

</form>
</div>

<!-- Close form -->

<?php

session_start();
?>
</body>
</html>
