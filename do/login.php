<?php
require "header.php";

// Check if there are the required indexes
if ( !isset( $_GET["username"] ) || !isset( $_GET["password"] ) ) {
  loggy("warning", "Request does not offer the minimum required fields", "login", "login");
  die("1");
}
// Get sent data
$username = $_GET["username"];
$password = $_GET["password"];
// And check them not to be empty
if ( strlen($username) < 1 || strlen($password) < 1 ) {
  loggy("warning", "Request does not offer the minimum required fields", "login", "login");
  die("1");
}

try {
  $auth->loginWithUsername(
    $username,
    $password
  );
  loggy("debug", "Userd logged in", "login", "login");
  echo "0";
} catch (\Exception $e) {
  loggy("warning", "Failed login attempt", "login", "login");
  die("1");
}
