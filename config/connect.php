<?php

  ini_set('display_errors', 'On');
	error_reporting(E_ALL);

    // One connection file so that we don't have to have this same code
    // at the top of every page.
/*
    $db = new PDO(
        "mysql:host=localhost;dbname=hw10",
        "sample_user",
        "sample_password"
    );
*/
    try{
      $db = new PDO(
        'mysql:host=localhost;dbname=foundationApiFrame', 'root'
      );
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
    }

?>
