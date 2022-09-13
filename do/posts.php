<?php
require "header.php";

// The user must be logged in to be able to create/edit a page
if ( $auth->isLoggedIn() ) {
  // Check if the minimum required fields were sent
  if ( isset( $_GET["title"] ) &&
       isset( $_GET["tags"] ) &&
       isset( $_GET["category"] ) &&
       isset( $_GET["header"] ) &&
       isset( $_GET["body"] ) ) {
    // Get today's date
    $post["now"] = date("Y-m-d");
    // Get post data
    $post["title"]     = trim( $_GET["title"] );
    $post["tags"]      = str_replace( array(" ,", ", ", " , "), ",", $_GET["tags"] );
    $post["category"]  = trim( $_GET["category"] );
    $post["header"]    = trim( $_GET["header"] );
    $post["body"]      = $_GET["body"];
    // Catch $_GET["action"]
    if ( !isset( $_GET["action"] ) ) { $_GET["action"] = null; }
    // Build query
    switch ( $_GET["action"] ) {
      case "edit":
        // Get ID
        $post["id"] = (int) $_GET["id"];
        // Get editor's User ID...
        $post["editor"] = $auth->getUserId();
        // ...and the original author's ID
        try {
          $stmt = $db->prepare("SELECT `author` FROM `posts` WHERE `id` LIKE :id");
          $stmt->bindParam(":id", $post["id"], \PDO::PARAM_INT);
          $stmt->execute();
          $post["author"] = (int) $stmt->fetch(\PDO::FETCH_ASSOC)["author"];
        } catch (\Exception $e) { echo $e->getMessage(); }
        if ( $post["editor"] == $post["author"] ) {
          try {
            // Set edit query
            $stmt = $db->prepare("UPDATE `posts`
                                  SET
                                    `title` = :title,
                                    `tags` = :tags,
                                    `category` = :category,
                                    `header` = :header,
                                    `body` = :body,
                                    `edited` = :now
                                  WHERE
                                    `id` = :id");
            $stmt->bindValue(":id", $post["id"], \PDO::PARAM_INT);
            $stmt->bindValue(":title", $post["title"]);
            $stmt->bindValue(":tags", $post["tags"]);
            $stmt->bindValue(":category", $post["category"]);
            $stmt->bindValue(":header", $post["header"]);
            $stmt->bindValue(":body", $post["body"]);
            $stmt->bindValue(":edited", $post["now"]);
          } catch (\Exception $e) { echo $e->getMessage(); }
        } else { die("1"); }
        break;
      default:
        // Get user ID
        $post["author"] = $auth->getUserId();
        try {
          // Set create query
          $stmt = $db->prepare("INSERT INTO `posts`
                                (`author`, `published`, `title`, `tags`, `category`, `header`, `body`)
                                VALUES (
                                  :author,
                                  :published,
                                  :title,
                                  :tags,
                                  :category,
                                  :header,
                                  :body
                                )");
          $stmt->bindValue(":author", $post["author"], \PDO::PARAM_INT);
          $stmt->bindValue(":published", $post["now"]);
          $stmt->bindValue(":title", $post["title"]);
          $stmt->bindValue(":tags", $post["tags"]);
          $stmt->bindValue(":category", $post["category"]);
          $stmt->bindValue(":header", $post["header"]);
          $stmt->bindValue(":body", $post["body"]);
        } catch (\Exception $e) { die("1"); }
        break;
    }
    // Execute query
    if ( $stmt->execute() ) {
      // If success
      echo "0";
      exit();
    } else { die("1"); }
  } else { die("1"); }
} else { die("1"); }
