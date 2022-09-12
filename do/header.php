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

// Load PHPMailer
$mail = new \PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->Host       = constant("APP_MAIL_HOST");
$mail->SMTPAuth   = true;
$mail->Username   = constant("APP_MAIL_USERNAME");
$mail->Password   = constant("APP_MAIL_PASSWORD");
$mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = constant("APP_MAIL_PORT");
$mail->setFrom(constant("APP_MAIL_USERNAME"), constant("APP_NAME"));
