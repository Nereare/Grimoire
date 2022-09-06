<?php
require "../vendor/autoload.php";
require "../meta.php";
require "../config.php";
session_start();

// Connect to database
try {
  $db = new \PDO(
    "mysql:dbname=" . constant( "INSTANCE_DB_NAME" ) . ";host=localhost;charset=utf8mb4",
    constant( "INSTANCE_DB_USER" ),
    constant( "INSTANCE_DB_PASSWORD" )
  );
} catch (\PDOException $e) { die("500"); }

// Load PHP Auth
$auth = new \Delight\Auth\Auth($db);
