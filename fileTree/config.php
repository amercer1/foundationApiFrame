<?php

session_start();

$username = $_SESSION['login'];
$password = $_SESSION['password'];

$config = array(
  'server' => 'data.iplantcollaborative.org',   // server address TODO
  'port' => 1247,   // irods port
  'path' => "/iplant/home/$username",    // path to access e.g. /iplant/
  'username' => $username, // irods user
  'password' => $password  // irods password TODO
);
?>
