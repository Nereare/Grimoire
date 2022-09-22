<?php
require "header.php";

// The user must be logged in to be able to create/edit an plant
if ( $auth->isLoggedIn() ) {
  // Check if the minimum required fields were sent
  if ( isset( $_GET["action"] ) &&
       isset( $_GET["title"] ) &&
       $_GET["title"] != "" &&
       isset( $_GET["domain"] ) &&
       isset( $_GET["kingdom"] ) &&
       isset( $_GET["clade"] ) &&
       isset( $_GET["order"] ) &&
       isset( $_GET["suborder"] ) &&
       isset( $_GET["family"] ) &&
       isset( $_GET["subfamily"] ) &&
       isset( $_GET["genus"] ) &&
       isset( $_GET["species"] ) &&
       isset( $_GET["subspecies"] ) &&
       isset( $_GET["feeding"] ) &&
       isset( $_GET["size_type"] ) &&
       isset( $_GET["size_unit"] ) &&
       isset( $_GET["size_min"] ) &&
       isset( $_GET["size_max"] ) &&
       isset( $_GET["weight_unit"] ) &&
       isset( $_GET["weight_min"] ) &&
       isset( $_GET["weight_max"] ) &&
       isset( $_GET["habitat"] ) &&
       isset( $_GET["home_plane"] ) &&
       isset( $_GET["iucn"] ) &&
       isset( $_GET["domestic"] ) &&
       isset( $_GET["notes"] ) &&
       isset( $_GET["body"] ) &&
       $_GET["body"] != "" ) {
    // Get today's date
    $plant["now"] = date("Y-m-d");
    // Get post data
    $plant["title"] = trim( $_GET["title"] );
    $plant["domain"] = trim( $_GET["domain"] );
    $plant["kingdom"] = trim( $_GET["kingdom"] );
    $plant["clade"] = str_replace( array(" ,", ", ", " , "), ",", trim( $_GET["clade"] ) );
    $plant["order"] = trim( $_GET["order"] );
    $plant["suborder"] = trim( $_GET["suborder"] );
    $plant["family"] = trim( $_GET["family"] );
    $plant["subfamily"] = trim( $_GET["subfamily"] );
    $plant["genus"] = trim( $_GET["genus"] );
    $plant["species"] = trim( $_GET["species"] );
    $plant["subspecies"] = trim( $_GET["subspecies"] );
    $plant["feeding"] = trim( $_GET["feeding"] );
    $plant["size_type"] = trim( $_GET["size_type"] );
    $plant["size_unit"] = trim( $_GET["size_unit"] );
    $plant["size_min"] = trim( $_GET["size_min"] );
    $plant["size_max"] = trim( $_GET["size_max"] );
    $plant["weight_unit"] = trim( $_GET["weight_unit"] );
    $plant["weight_min"] = trim( $_GET["weight_min"] );
    $plant["weight_max"] = trim( $_GET["weight_max"] );
    $plant["habitat"] = trim( $_GET["habitat"] );
    $plant["home_plane"] = trim( $_GET["home_plane"] );
    $plant["iucn"] = trim( $_GET["iucn"] );
    $plant["domestic"] = trim( $_GET["domestic"] );
    $plant["notes"] = str_replace( array(" ,", ", ", " , "), ",", trim( $_GET["notes"] ) );
    $plant["body"] = trim( $_GET["body"] );
    // Catch $_GET["action"]
    if ( !isset( $_GET["action"] ) ) { $_GET["action"] = "create"; }
    // Build query
    switch ( $_GET["action"] ) {
      case "edit":
        // Get ID
        $plant["id"] = (int) $_GET["id"];
        // Get editor's User ID...
        $plant["editor"] = $auth->getUserId();
        // ...and the original author's ID
        try {
          $stmt = $db->prepare("SELECT `author` FROM `plants` WHERE `id` LIKE :id");
          $stmt->bindParam(":id", $plant["id"], \PDO::PARAM_INT);
          $stmt->execute();
          $plant["author"] = (int) $stmt->fetch(\PDO::FETCH_ASSOC)["author"];
        } catch (\Exception $e) {
          loggy("warning", "Could not retrieve plants's original author", "plant", "access");
          die("1");
        }
        if ( $plant["editor"] == $plant["author"] ) {
          try {
            // Set edit query
            $stmt = $db->prepare("UPDATE `plants`
                                  SET
                                    `author` = :author,
                                    `edited` = :edited,
                                    `title` = :title,
                                    `domain` = :domain,
                                    `kingdom` = :kingdom,
                                    `clade` = :clade,
                                    `order` = :ordr,
                                    `suborder` = :suborder,
                                    `family` = :family,
                                    `subfamily` = :subfamily,
                                    `genus` = :genus,
                                    `species` = :species,
                                    `subspecies` = :subspecies,
                                    `feeding` = :feeding,
                                    `size_type` = :size_type,
                                    `size_unit` = :size_unit,
                                    `size_min` = :size_min,
                                    `size_max` = :size_max,
                                    `weight_unit` = :weight_unit,
                                    `weight_min` = :weight_min,
                                    `weight_max` = :weight_max,
                                    `habitat` = :habitat,
                                    `home_plane` = :home_plane,
                                    `iucn` = :iucn,
                                    `domestic` = :domestic,
                                    `notes` = :notes,
                                    `body` = :body
                                  WHERE
                                    `id` = :id");
            $stmt->bindValue(":id", $plant["id"], \PDO::PARAM_INT);
            $stmt->bindValue(":author", $plant["author"], \PDO::PARAM_INT);
            $stmt->bindValue(":edited", $plant["now"]);
            $stmt->bindValue(":title", $plant["title"]);
            $stmt->bindValue(":domain", $plant["domain"]);
            $stmt->bindValue(":kingdom", $plant["kingdom"]);
            $stmt->bindValue(":clade", $plant["clade"]);
            $stmt->bindValue(":ordr", $plant["order"]);
            $stmt->bindValue(":suborder", $plant["suborder"]);
            $stmt->bindValue(":family", $plant["family"]);
            $stmt->bindValue(":subfamily", $plant["subfamily"]);
            $stmt->bindValue(":genus", $plant["genus"]);
            $stmt->bindValue(":species", $plant["species"]);
            $stmt->bindValue(":subspecies", $plant["subspecies"]);
            $stmt->bindValue(":feeding", $plant["feeding"]);
            $stmt->bindValue(":size_type", $plant["size_type"]);
            $stmt->bindValue(":size_unit", $plant["size_unit"]);
            $stmt->bindValue(":size_min", $plant["size_min"]);
            $stmt->bindValue(":size_max", $plant["size_max"]);
            $stmt->bindValue(":weight_unit", $plant["weight_unit"]);
            $stmt->bindValue(":weight_min", $plant["weight_min"]);
            $stmt->bindValue(":weight_max", $plant["weight_max"]);
            $stmt->bindValue(":habitat", $plant["habitat"]);
            $stmt->bindValue(":home_plane", $plant["home_plane"]);
            $stmt->bindValue(":iucn", $plant["iucn"]);
            $stmt->bindValue(":domestic", $plant["domestic"], \PDO::PARAM_BOOL);
            $stmt->bindValue(":notes", $plant["notes"]);
            $stmt->bindValue(":body", $plant["body"]);
          } catch (\Exception $e) { echo $e->getMessage(); }
        } else {
          loggy("warning", "User requesting edit is not the author", "plant", "edit");
          die("1");
        }
        break;
      default:
        // Get user ID
        $plant["author"] = $auth->getUserId();
        // Set create query
        $stmt = $db->prepare("INSERT INTO `plants`
                              (`author`, `published`, `title`, `domain`, `kingdom`, `clade`, `order`, `suborder`, `family`, `subfamily`, `genus`, `species`, `subspecies`, `feeding`, `size_type`, `size_unit`, `size_min`, `size_max`, `weight_unit`, `weight_min`, `weight_max`, `habitat`, `home_plane`, `iucn`, `domestic`, `notes`, `body`)
                              VALUES (
                                :author,
                                :published,
                                :title,
                                :domain,
                                :kingdom,
                                :clade,
                                :ordr,
                                :suborder,
                                :family,
                                :subfamily,
                                :genus,
                                :species,
                                :subspecies,
                                :feeding,
                                :size_type,
                                :size_unit,
                                :size_min,
                                :size_max,
                                :weight_unit,
                                :weight_min,
                                :weight_max,
                                :habitat,
                                :home_plane,
                                :iucn,
                                :domestic,
                                :notes,
                                :body
                              )");
        $stmt->bindValue(":author", $plant["author"], \PDO::PARAM_INT);
        $stmt->bindValue(":published", $plant["now"]);
        $stmt->bindValue(":title", $plant["title"]);
        $stmt->bindValue(":domain", $plant["domain"]);
        $stmt->bindValue(":kingdom", $plant["kingdom"]);
        $stmt->bindValue(":clade", $plant["clade"]);
        $stmt->bindValue(":ordr", $plant["order"]);
        $stmt->bindValue(":suborder", $plant["suborder"]);
        $stmt->bindValue(":family", $plant["family"]);
        $stmt->bindValue(":subfamily", $plant["subfamily"]);
        $stmt->bindValue(":genus", $plant["genus"]);
        $stmt->bindValue(":species", $plant["species"]);
        $stmt->bindValue(":subspecies", $plant["subspecies"]);
        $stmt->bindValue(":feeding", $plant["feeding"]);
        $stmt->bindValue(":size_type", $plant["size_type"]);
        $stmt->bindValue(":size_unit", $plant["size_unit"]);
        $stmt->bindValue(":size_min", $plant["size_min"]);
        $stmt->bindValue(":size_max", $plant["size_max"]);
        $stmt->bindValue(":weight_unit", $plant["weight_unit"]);
        $stmt->bindValue(":weight_min", $plant["weight_min"]);
        $stmt->bindValue(":weight_max", $plant["weight_max"]);
        $stmt->bindValue(":habitat", $plant["habitat"]);
        $stmt->bindValue(":home_plane", $plant["home_plane"]);
        $stmt->bindValue(":iucn", $plant["iucn"]);
        $stmt->bindValue(":domestic", $plant["domestic"], \PDO::PARAM_BOOL);
        $stmt->bindValue(":notes", $plant["notes"]);
        $stmt->bindValue(":body", $plant["body"]);
        break;
    }
    // Execute query
    if ( $stmt->execute() ) {
      // If success
      loggy("debug", "Request executed", "plant", $_GET["action"]);
      echo "0";
      exit();
    } else {
      loggy("warning", "Could not execute request", "plant", $_GET["action"]);
      die("1");
    }
  } else {
    loggy("warning", "Request does not offer the minimum required fields", "plant", "access");
    die("1");
  }
} else {
  loggy("warning", "The user is not logged in", "plant", "access");
  die("1");
}
