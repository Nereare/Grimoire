<?php
require "header.php";

// The user must be logged in to be able to create/edit a page
if ( $auth->isLoggedIn() ) {
  // Check if the minimum required fields were sent
  if ( isset( $_GET["id"] ) &&
       isset( $_GET["action"] ) &&
       isset( $_GET["first_name"] ) &&
       isset( $_GET["last_name"] ) &&
       isset( $_GET["location"] ) &&
       isset( $_GET["birth"] ) &&
       isset( $_GET["header"] ) &&
       isset( $_GET["systems"] ) &&
       isset( $_GET["gm"] ) &&
       isset( $_GET["player"] ) &&
       isset( $_GET["homebrewer"] ) &&
       isset( $_GET["about"] ) ) {
    // Get profile data
    $profile["id"]          = $_GET["id"];
    $profile["first_name"]  = $_GET["first_name"];
    $profile["last_name"]   = $_GET["last_name"];
    $profile["location"]    = $_GET["location"];
    $profile["birth"]       = $_GET["birth"];
    $profile["header"]      = $_GET["header"];
    $profile["systems"]     = $_GET["systems"];
    $profile["gm"]          = $_GET["gm"];
    $profile["player"]      = $_GET["player"];
    $profile["homebrewer"]  = $_GET["homebrewer"];
    $profile["about"]       = $_GET["about"];

    // Create Profile instance with user ID
    $prof = new \Nereare\Grimoire\Profile($db, $profile["id"]);

    // Run profile creation/update
    switch ( $_GET["action"] ) {
      case "edit":
        // Update profile information
        $prof->update(
          $profile["first_name"],
          $profile["last_name"],
          $profile["location"],
          $profile["birth"],
          $profile["systems"],
          $profile["about"],
          $profile["gm"],
          $profile["player"],
          $profile["homebrewer"],
          $profile["header"]
        );
        break;
      default:
        // Create profile information
        $prof->create(
          $profile["first_name"],
          $profile["last_name"],
          $profile["location"],
          $profile["birth"],
          $profile["systems"],
          $profile["about"],
          $profile["gm"],
          $profile["player"],
          $profile["homebrewer"],
          $profile["header"]
        );
        break;
    }
  }
} else {
  die("1");
}
