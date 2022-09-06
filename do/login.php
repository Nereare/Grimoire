<?php
require "header.php";

// Check if there are the required indexes
if ( !isset( $_GET["username"] ) || !isset( $_GET["password"] ) ) {
  die("1");
}
// Get sent data
$username = $_GET["username"];
$password = $_GET["password"];
// And check them not to be empty
if ( strlen($username) < 1 || strlen($password) < 1 ) {
  die("1");
}

try {
  $auth->loginWithUsername(
    $username,
    $password
  );
  echo "0";
}
catch (\Exception $e) {
  echo $e->getMessage();
  die("1");
}
