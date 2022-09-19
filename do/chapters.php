<?php
require "header.php";

// The user must be logged in to be able to create/edit a book or chapter
if ( $auth->isLoggedIn() ) {
  // Check if the minimum required fields were sent
  if ( isset( $_GET["action"] ) &&
       in_array($_GET["action"], ["edit", "create"]) &&
       isset( $_GET["target"] ) &&
       in_array($_GET["target"], ["book", "chapter"]) &&
       isset( $_GET["title"] ) ) {
    // Get today's date
    $target["now"] = date("Y-m-d");
    // Get action and target
    $target["action"] = $_GET["action"];
    $target["target"] = $_GET["target"];
    // Get title
    $target["title"] = $_GET["title"];
    // Select target
    if ( $target["target"] == "chapter" ) {
      // Chapter methods
      // Check if remaining data is available - die if not
      if ( !isset( $_GET["book"] ) ||
           !isset( $_GET["body"] ) ||
           !isset( $_GET["previous"] ) ||
           !isset( $_GET["next"] ) ) { die("1"); }
      // Get remaining chapter data
      $target["book"]     = $_GET["book"];
      $target["body"]     = $_GET["body"];
      $target["previous"] = $_GET["previous"];
      $target["next"]     = $_GET["next"];
      // Build query
      switch ( $target["action"] ) {
        case "edit":
          // Check if there is an ID - die if not
          if ( !isset( $_GET["id"] ) ) { die("1"); }
          // Get chapter and editor user IDs
          $target["id"] = $_GET["id"];
          $target["editor"] = $auth->getUserId();
          // Get chapter author
          try {
            $stmt = $db->prepare("SELECT `author` FROM `chapters` WHERE `id` = :id");
            $stmt->bindValue(":id", $target["id"], \PDO::PARAM_INT);
            $stmt->execute();
            $target["author"] = $stmt->fetch(\PDO::FETCH_ASSOC)["author"];
          } catch (\Exception $e) { $target["author"] = null; }
          // Exit if the editor is not the author
          if ( $target["editor"] != $target["author"] ) { die("1"); }
          // Set edit query
          $stmt = $db->prepare("UPDATE `chapters`
                                SET
                                  `book` = :book,
                                  `edited` = :edited,
                                  `title` = :title,
                                  `body` = :body,
                                  `previous` = :previous,
                                  `next` = :nxt
                                WHERE
                                  `id` = :id");
          $stmt->bindValue(":id", $target["id"], \PDO::PARAM_INT);
          $stmt->bindValue(":book", $target["book"], \PDO::PARAM_INT);
          $stmt->bindValue(":edited", $target["now"]);
          $stmt->bindValue(":title", $target["title"]);
          $stmt->bindValue(":body", $target["body"]);
          $stmt->bindValue(":previous", $target["previous"], \PDO::PARAM_INT);
          $stmt->bindValue(":nxt", $target["next"], \PDO::PARAM_INT);
          break;
        default:
          // Get author user ID
          $target["author"] = $auth->getUserId();
          // Set create query
          $stmt = $db->prepare("INSERT INTO `chapters`
                                (`author`, `book`, `published`, `title`, `body`, `previous`, `next`)
                                VALUES (
                                  :author,
                                  :book,
                                  :published,
                                  :title,
                                  :body,
                                  :previous,
                                  :nxt
                                )");
          $stmt->bindValue(":author", $target["author"], \PDO::PARAM_INT);
          $stmt->bindValue(":book", $target["book"], \PDO::PARAM_INT);
          $stmt->bindValue(":published", $target["now"]);
          $stmt->bindValue(":title", $target["title"]);
          $stmt->bindValue(":body", $target["body"]);
          $stmt->bindValue(":previous", $target["previous"], \PDO::PARAM_INT);
          $stmt->bindValue(":nxt", $target["next"], \PDO::PARAM_INT);
          break;
      }
    } else {
      // Book methods
      // Build query
      switch ( $target["action"] ) {
        case "edit":
          // Check if there is an ID - die if not
          if ( !isset( $_GET["id"] ) ) { die("1"); }
          // Get book ID
          $target["id"] = $_GET["id"];
          // Set edit query
          $stmt = $db->prepare("UPDATE `books`
                                SET
                                  `name` = :title
                                WHERE
                                  `id` = :id");
          $stmt->bindValue(":id", $target["id"], \PDO::PARAM_INT);
          $stmt->bindValue(":title", $target["title"]);
          break;
        default:
          // Set create query
          $stmt = $db->prepare("INSERT INTO `books`
                                (`name`)
                                VALUES (:title)");
          $stmt->bindValue(":title", $target["title"]);
          break;
      }
    }
    // Execute query
    if ( $stmt->execute() ) {
      // If success
      echo "0";
      exit();
    } else { die("1"); }
  } else { die("1"); }
} else { die("1"); }
