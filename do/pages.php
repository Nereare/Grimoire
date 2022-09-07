<?php
require "header.php";

// The user must be logged in to be able to create/edit a page
if ( $auth->isLoggedIn() ) {
  // Check if the minimum required fields were sent
  if ( isset( $_GET["name"] ) &&
       isset( $_GET["body"] ) &&
       isset( $_GET["action"] ) ) {
    // Get today's date
    $page["now"] = date("Y-m-d");
    // Get name and body
    $page["name"] = $_GET["name"];
    $page["body"] = $_GET["body"];
    // Build query
    switch ( $_GET["action"] ) {
      case "edit":
        // Get ID
        $page["id"] = $_GET["id"];
        // Set edit query
        $stmt = $db->prepare("UPDATE `pages`
                              SET
                                `name` = :name,
                                `body` = :body,
                                `edited` = :now
                              WHERE
                                `id` = :id");
        $stmt->bindValue(":id", $page["id"], \PDO::PARAM_INT);
        $stmt->bindValue(":name", $page["name"]);
        $stmt->bindValue(":body", $page["body"]);
        $stmt->bindValue(":now", $page["now"]);
        break;
      default:
        // Get user ID
        $page["author"] = $auth->getUserId();
        // Set create query
        $stmt = $db->prepare("INSERT INTO `pages`
                              (`author`, `name`, `published`, `body`)
                              VALUES (
                                :author,
                                :name,
                                :now,
                                :body
                              )");
        $stmt->bindValue(":author", $page["author"], \PDO::PARAM_INT);
        $stmt->bindValue(":name", $page["name"]);
        $stmt->bindValue(":now", $page["now"]);
        $stmt->bindValue(":body", $page["body"]);
        break;
    }
    // Execute query
    if ( $stmt->execute() ) {
      // If success
      echo "0";
      exit();
    } else {
      // If failure
      die("1");
    }
  }
} else {
  die("1");
}
