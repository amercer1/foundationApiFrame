<?php

	// Start the php session to be able to pull login and password tokens
	session_start();

	include("config/connect.php"); // connect to the database


	//Grab the relevent session cookie data and place them into variables
	$username=$_SESSION['login'];
	$password=$_SESSION['password'];
	$token=$_SESSION['token'];

	$get_search_terms_query = $db->prepare("
      SELECT * FROM jobinformation WHERE jobinformation.username=:username;
   ");


   $get_search_terms_query->execute(array(
        ':username' => $username
    ));


   $returnArray = array();
   while ($row = $get_search_terms_query -> fetch(PDO::FETCH_ASSOC)){
			 $returnArray[]= $row;
   }

   echo json_encode($returnArray);
?>
