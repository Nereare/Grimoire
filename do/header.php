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

// Load Monolog
$logger = new \Monolog\Logger(
  constant("INSTANCE_DB_NAME")
);
$logger->pushHandler(
  new \Monolog\Handler\StreamHandler(
    "../" . constant("INSTANCE_DB_NAME") . ".log",
    \Monolog\Level::Debug
  )
);
$logger->pushHandler(
  new \Nereare\Grimoire\PDOHandler(
    $db,
    constant("INSTANCE_DB_NAME") . "_log"
  )
);
/**
 * Set helper function for log registering
 * @param string  $level    The level of message. Either "debug", "notice", "warning", "error", "critical", "alert", "emergency", or "info"
 * @param string  $msg      The text to register
 * @param array   $context  An array with miscellaneous data to save
 * @param string  $target   The section of Grimoire the log is about (e.g. "chapter", "page")
 * @param string  $action   The action being taken (e.g. "create", "edit", "delete")
 * @param integer $user     The user ID
 */
function loggy(string $level, string $msg, string $target = "?", string $action = "?", array $context = [], int $user = 0):void {
  global $auth;
  global $logger;
  // Set context
  $context["target"] = $target;
  $context["action"] = $action;
  $context["user"]   = $user;
  // Check if user is placeholder (0) - if not set to current one
  if ( $context["user"] == 0 ) {
    $context["user"] = $auth->getUserId();
  }

  // Run appropriate Monolog method
  switch ($level) {
    // Debug message
    case "debug":
      $logger->debug($msg, $context);
      break;
    // Notice message
    case "notice":
      $logger->notice($msg, $context);
      break;
    // Warning message
    case "warning":
      $logger->warning($msg, $context);
      break;
    // Error message
    case "error":
      $logger->error($msg, $context);
      break;
    // Critical message
    case "critical":
      $logger->critical($msg, $context);
      break;
    // Alert message
    case "alert":
      $logger->alert($msg, $context);
      break;
    // Emergency message
    case "emergency":
      $logger->emergency($msg, $context);
      break;
    // Info message
    default:
      $logger->info($msg, $context);
      break;
  }
}
