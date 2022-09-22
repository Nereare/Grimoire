<?php
require "header.php";

// The user must be logged in to be able to create/edit an animal
if ( $auth->isLoggedIn() ) {
  // Check if the minimum required fields were sent
  if ( isset( $_GET["action"] ) &&
       isset( $_GET["title"] ) &&
       $_GET["title"] != "" &&
       isset( $_GET["domain"] ) &&
       isset( $_GET["kingdom"] ) &&
       isset( $_GET["phylum"] ) &&
       isset( $_GET["class"] ) &&
       isset( $_GET["order"] ) &&
       isset( $_GET["suborder"] ) &&
       isset( $_GET["family"] ) &&
       isset( $_GET["subfamily"] ) &&
       isset( $_GET["genus"] ) &&
       isset( $_GET["species"] ) &&
       isset( $_GET["subspecies"] ) &&
       isset( $_GET["feeding"] ) &&
       isset( $_GET["size_type"] ) &&
       isset( $_GET["size_min"] ) &&
       isset( $_GET["size_max"] ) &&
       isset( $_GET["size_unit"] ) &&
       isset( $_GET["weight_min"] ) &&
       isset( $_GET["weight_max"] ) &&
       isset( $_GET["weight_unit"] ) &&
       isset( $_GET["habitat"] ) &&
       isset( $_GET["home_plane"] ) &&
       isset( $_GET["iucn"] ) &&
       isset( $_GET["domestic"] ) &&
       isset( $_GET["notes"] ) &&
       isset( $_GET["body"] ) &&
       $_GET["body"] != "" ) {
    // Get today's date
    $animal["now"] = date("Y-m-d");
    // Get post data
    $animal["title"] = trim( $_GET["title"] );
    $animal["domain"] = trim( $_GET["domain"] );
    $animal["kingdom"] = trim( $_GET["kingdom"] );
    $animal["phylum"] = trim( $_GET["phylum"] );
    $animal["class"] = trim( $_GET["class"] );
    $animal["order"] = trim( $_GET["order"] );
    $animal["suborder"] = trim( $_GET["suborder"] );
    $animal["family"] = trim( $_GET["family"] );
    $animal["subfamily"] = trim( $_GET["subfamily"] );
    $animal["genus"] = trim( $_GET["genus"] );
    $animal["species"] = trim( $_GET["species"] );
    $animal["subspecies"] = trim( $_GET["subspecies"] );
    $animal["feeding"] = trim( $_GET["feeding"] );
    $animal["size_type"] = trim( $_GET["size_type"] );
    $animal["size_min"] = trim( $_GET["size_min"] );
    $animal["size_max"] = trim( $_GET["size_max"] );
    $animal["size_unit"] = trim( $_GET["size_unit"] );
    $animal["weight_min"] = trim( $_GET["weight_min"] );
    $animal["weight_max"] = trim( $_GET["weight_max"] );
    $animal["weight_unit"] = trim( $_GET["weight_unit"] );
    $animal["habitat"] = trim( $_GET["habitat"] );
    $animal["home_plane"] = trim( $_GET["home_plane"] );
    $animal["iucn"] = trim( $_GET["iucn"] );
    $animal["domestic"] = (bool) $_GET["domestic"];
    $animal["notes"] = str_replace( array(" ,", ", ", " , "), ",", trim( $_GET["notes"] ) );
    $animal["body"] = trim( $_GET["body"] );
    // Catch $_GET["action"]
    if ( !isset( $_GET["action"] ) ) { $_GET["action"] = "create"; }
    // Build query
    switch ( $_GET["action"] ) {
      case "edit":
        // Get ID
        $animal["id"] = (int) $_GET["id"];
        // Get editor's User ID...
        $animal["editor"] = $auth->getUserId();
        // ...and the original author's ID
        try {
          $stmt = $db->prepare("SELECT `author` FROM `animals` WHERE `id` LIKE :id");
          $stmt->bindParam(":id", $animal["id"], \PDO::PARAM_INT);
          $stmt->execute();
          $animal["author"] = (int) $stmt->fetch(\PDO::FETCH_ASSOC)["author"];
        } catch (\Exception $e) {
          loggy("warning", "Could not retrieve animals's original author", "animal", "access");
          die("1");
        }
        if ( $animal["editor"] == $animal["author"] ) {
          try {
            // Set edit query
            $stmt = $db->prepare("UPDATE `animals`
                                  SET
                                    `author` = :author,
                                    `edited` = :edited,
                                    `title` = :title,
                                    `domain` = :domain,
                                    `kingdom` = :kingdom,
                                    `phylum` = :phylum,
                                    `class` = :class,
                                    `order` = :ordr,
                                    `suborder` = :suborder,
                                    `family` = :family,
                                    `subfamily` = :subfamily,
                                    `genus` = :genus,
                                    `species` = :species,
                                    `subspecies` = :subspecies,
                                    `feeding` = :feeding,
                                    `size_type` = :size_type,
                                    `size_min` = :size_min,
                                    `size_max` = :size_max,
                                    `size_unit` = :size_unit,
                                    `weight_min` = :weight_min,
                                    `weight_max` = :weight_max,
                                    `weight_unit` = :weight_unit,
                                    `habitat` = :habitat,
                                    `home_plane` = :home_plane,
                                    `iucn` = :iucn,
                                    `domestic` = :domestic,
                                    `notes` = :notes,
                                    `body` = :body
                                  WHERE
                                    `id` = :id");
            $stmt->bindValue(":id", $animal["id"], \PDO::PARAM_INT);
            $stmt->bindValue(":author", $animal["author"], \PDO::PARAM_INT);
            $stmt->bindValue(":edited", $animal["now"]);
            $stmt->bindValue(":title", $animal["title"]);
            $stmt->bindValue(":domain", $animal["domain"]);
            $stmt->bindValue(":kingdom", $animal["kingdom"]);
            $stmt->bindValue(":phylum", $animal["phylum"]);
            $stmt->bindValue(":class", $animal["class"]);
            $stmt->bindValue(":ordr", $animal["order"]);
            $stmt->bindValue(":suborder", $animal["suborder"]);
            $stmt->bindValue(":family", $animal["family"]);
            $stmt->bindValue(":subfamily", $animal["subfamily"]);
            $stmt->bindValue(":genus", $animal["genus"]);
            $stmt->bindValue(":species", $animal["species"]);
            $stmt->bindValue(":subspecies", $animal["subspecies"]);
            $stmt->bindValue(":feeding", $animal["feeding"]);
            $stmt->bindValue(":size_type", $animal["size_type"]);
            $stmt->bindValue(":size_min", $animal["size_min"]);
            $stmt->bindValue(":size_max", $animal["size_max"]);
            $stmt->bindValue(":size_unit", $animal["size_unit"]);
            $stmt->bindValue(":weight_min", $animal["weight_min"]);
            $stmt->bindValue(":weight_max", $animal["weight_max"]);
            $stmt->bindValue(":weight_unit", $animal["weight_unit"]);
            $stmt->bindValue(":habitat", $animal["habitat"]);
            $stmt->bindValue(":home_plane", $animal["home_plane"]);
            $stmt->bindValue(":iucn", $animal["iucn"]);
            $stmt->bindValue(":domestic", $animal["domestic"], \PDO::PARAM_BOOL);
            $stmt->bindValue(":notes", $animal["notes"]);
            $stmt->bindValue(":body", $animal["body"]);
          } catch (\Exception $e) { echo $e->getMessage(); }
        } else {
          loggy("warning", "User requesting edit is not the author", "animal", "edit");
          die("1");
        }
        break;
      default:
        // Get user ID
        $animal["author"] = $auth->getUserId();
        // Set create query
        $stmt = $db->prepare("INSERT INTO `animals`
                              (`author`, `published`, `title`, `domain`, `kingdom`, `phylum`, `class`, `order`, `suborder`, `family`, `subfamily`, `genus`, `species`, `subspecies`, `feeding`, `size_type`, `size_min`, `size_max`, `size_unit`, `weight_min`, `weight_max`, `weight_unit`, `habitat`, `home_plane`, `iucn`, `domestic`, `notes`, `body`)
                              VALUES (
                                :author,
                                :published,
                                :title,
                                :domain,
                                :kingdom,
                                :phylum,
                                :class,
                                :ordr,
                                :suborder,
                                :family,
                                :subfamily,
                                :genus,
                                :species,
                                :subspecies,
                                :feeding,
                                :size_type,
                                :size_min,
                                :size_max,
                                :size_unit,
                                :weight_min,
                                :weight_max,
                                :weight_unit,
                                :habitat,
                                :home_plane,
                                :iucn,
                                :domestic,
                                :notes,
                                :body
                              )");
        $stmt->bindValue(":id", $animal["id"], \PDO::PARAM_INT);
        $stmt->bindValue(":author", $animal["author"], \PDO::PARAM_INT);
        $stmt->bindValue(":published", $animal["now"]);
        $stmt->bindValue(":title", $animal["title"]);
        $stmt->bindValue(":domain", $animal["domain"]);
        $stmt->bindValue(":kingdom", $animal["kingdom"]);
        $stmt->bindValue(":phylum", $animal["phylum"]);
        $stmt->bindValue(":class", $animal["class"]);
        $stmt->bindValue(":ordr", $animal["order"]);
        $stmt->bindValue(":suborder", $animal["suborder"]);
        $stmt->bindValue(":family", $animal["family"]);
        $stmt->bindValue(":subfamily", $animal["subfamily"]);
        $stmt->bindValue(":genus", $animal["genus"]);
        $stmt->bindValue(":species", $animal["species"]);
        $stmt->bindValue(":subspecies", $animal["subspecies"]);
        $stmt->bindValue(":feeding", $animal["feeding"]);
        $stmt->bindValue(":size_type", $animal["size_type"]);
        $stmt->bindValue(":size_min", $animal["size_min"]);
        $stmt->bindValue(":size_max", $animal["size_max"]);
        $stmt->bindValue(":size_unit", $animal["size_unit"]);
        $stmt->bindValue(":weight_min", $animal["weight_min"]);
        $stmt->bindValue(":weight_max", $animal["weight_max"]);
        $stmt->bindValue(":weight_unit", $animal["weight_unit"]);
        $stmt->bindValue(":habitat", $animal["habitat"]);
        $stmt->bindValue(":home_plane", $animal["home_plane"]);
        $stmt->bindValue(":iucn", $animal["iucn"]);
        $stmt->bindValue(":domestic", $animal["domestic"], \PDO::PARAM_BOOL);
        $stmt->bindValue(":notes", $animal["notes"]);
        $stmt->bindValue(":body", $animal["body"]);
        break;
    }
    // Execute query
    if ( $stmt->execute() ) {
      // If success
      loggy("debug", "Request executed", "animal", $_GET["action"]);
      echo "0";
      exit();
    } else {
      loggy("warning", "Could not execute request", "animal", $_GET["action"]);
      die("1");
    }
  } else {
    loggy("warning", "Request does not offer the minimum required fields", "animal", "access");
    die("1");
  }
} else {
  loggy("warning", "The user is not logged in", "animal", "access");
  die("1");
}
