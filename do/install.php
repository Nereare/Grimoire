<?php
require "../vendor/autoload.php";
require "../meta.php";
session_start();

function runExec($query, $msg, $db) {
  try {
    $result = $db->exec($query);
  } catch (\PDOException $e) {
    // Database Error
    return [
      "title" => "Database Error",
      "msg" => $e->getMessage(),
      "state" => "danger",
      "fail" => true
    ];
  }
  if ( $result === false ) {
    // Query Error
    return [
      "title" => "Query Error",
      "msg" => "The query affected no rows.",
      "state" => "danger",
      "fail" => true
    ];
  } else {
    // Success
    return [
      "title" => "Query Success",
      "msg" => $msg,
      "state" => "success",
      "fail" => false
    ];
  }
}

$user_data["mysql_username"]       = $_GET["mysql_username"];
$user_data["mysql_password"]       = $_GET["mysql_password"];
$user_data["db_name"]              = $_GET["db_name"];
$user_data["db_user"]              = $_GET["db_user"];
$user_data["db_password"]          = $_GET["db_password"];
$user_data["email_host"]           = $_GET["email_host"];
$user_data["email_port"]           = $_GET["email_port"];
$user_data["email_username"]       = $_GET["email_username"];
$user_data["email_password"]       = $_GET["email_password"];
$user_data["site_baseuri"]         = $_GET["site_baseuri"];
$user_data["site_name"]            = $_GET["site_name"];
$user_data["site_subtitle"]        = $_GET["site_subtitle"];
$user_data["site_admin_name"]      = $_GET["site_admin_name"];
$user_data["site_admin_email"]     = $_GET["site_admin_email"];
$user_data["user_username"]        = $_GET["user_username"];
$user_data["user_email"]           = $_GET["user_email"];
$user_data["user_password"]        = $_GET["user_password"];
$user_data["user_firstname"]       = $_GET["user_firstname"];
$user_data["user_lastname"]        = $_GET["user_lastname"];
$user_data["user_location"]        = $_GET["user_location"];
$user_data["user_birth"]           = $_GET["user_birth"];
$user_data["user_header"]          = $_GET["user_header"];
$user_data["user_systems"]         = $_GET["user_systems"];
$user_data["user_about"]           = $_GET["user_about"];
$user_data["is_gm"]                = $_GET["is_gm"];
$user_data["is_player"]            = $_GET["is_player"];
$user_data["is_homebrewer"]        = $_GET["is_homebrewer"];

$install = [];
$step = 0;

// Step 0: Check validity of database fields
$db_regex = "/^[A-Za-z][A-Za-z0-9_]{3,31}$/";
$pw_regex = "/^[A-Za-z0-9?!@#$%]{6,32}$/";
// Step 0a: Check database name
if ( strlen( $user_data["db_name"] ) < 4 ||
     strlen( $user_data["db_name"] ) > 32 ||
     !preg_match( $db_regex, $user_data["db_name"] ) ||
     strlen( $user_data["db_user"] ) < 4 ||
     strlen( $user_data["db_user"] ) > 32 ||
     !preg_match( $db_regex, $user_data["db_user"] ) ||
     strlen( $user_data["db_password"] ) < 6 ||
     strlen( $user_data["db_password"] ) > 32 ||
     !preg_match( $pw_regex, $user_data["db_password"] ) ) {
  $install[$step] = [
    "title" => "Database Info Error",
    "msg" => "The given database name, username, or password is not valid.",
    "state" => "danger",
    "fail" => true
  ];
} else {
  $install[$step] = [
    "title" => "Database Info Valid",
    "msg" => "The given database name, username, and password are valid.",
    "state" => "success",
    "fail" => false
  ];
}
if ( $install[$step]["fail"] ) { die( json_encode($install) ); }

$step++;
try {
  // Step 1: Connect to MySQL
  $db = new \PDO(
    "mysql:host=localhost;charset=utf8mb4",
    $user_data["mysql_username"],
    $user_data["mysql_password"]
  );
  // Step 1 - Success
  $install[$step] = [
    "title" => "Connection Successful",
    "msg" => "Connection with given MySQL user established successfully.",
    "state" => "success",
    "fail" => false
  ];
} catch (\PDOException $e) {
  // Step 1 - Error
  $install[$step] = [
    "title" => "Connection Error",
    "msg" => $e->getMessage(),
    "state" => "danger",
    "fail" => true
  ];
}
if ( $install[$step]["fail"] ) { die( json_encode($install) ); }

// Step 2: Create database
$step++;
$install[$step] = runExec(
  "CREATE DATABASE IF NOT EXISTS `" . $user_data["db_name"] . "` CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci",
  "Database created successfully.",
  $db
);
if ( $install[$step]["fail"] ) { die( json_encode($install) ); }

// Step 3: Create user
$step++;
$install[$step] = runExec(
  "CREATE USER IF NOT EXISTS
    '" . $user_data["db_user"] . "'@'localhost'
    IDENTIFIED BY '" . $user_data["db_password"] . "'
    FAILED_LOGIN_ATTEMPTS 3
    PASSWORD_LOCK_TIME 7;",
  "User created successfully.",
  $db
);
if ( $install[$step]["fail"] ) { die( json_encode($install) ); }

// Step 4: Grant user its privileges
$step++;
$install[$step] = runExec(
  "GRANT ALL ON `" . $user_data["db_name"] . "`.* TO '" . $user_data["db_user"] . "'@'localhost';",
  "Privileges granted successfully.",
  $db
);
if ( $install[$step]["fail"] ) { die( json_encode($install) ); }

// Step 5: Select database
$step++;
$install[$step] = runExec(
  "USE `" . $user_data["db_name"] . "`",
  "Database selected successfully.",
  $db
);
if ( $install[$step]["fail"] ) { die( json_encode($install) ); }

// Step 6a: Create tables
$step++;
if ( is_readable( "../schema/1_user.sql" ) &&
     is_readable( "../schema/2_posts.sql" ) ) {
  // Get user tables
  $contents = file_get_contents( "../schema/1_user.sql" );
  $contents = rtrim($contents, ";" . PHP_EOL);
  $user = explode(";" . PHP_EOL . PHP_EOL, $contents);
  // Get posts tables
  $contents = file_get_contents( "../schema/2_posts.sql" );
  $contents = rtrim($contents, ";" . PHP_EOL);
  $posts = explode(";" . PHP_EOL . PHP_EOL, $contents);
  // Get misc tables
  $contents = file_get_contents( "../schema/z1_misc_tables.sql" );
  $contents = rtrim($contents, ";" . PHP_EOL);
  $misc = explode(";" . PHP_EOL . PHP_EOL, $contents);
  // Merge all tables for parsing:
  $tables = array_merge($user, $posts, $misc);
  // Step 6a: Success
  $install[$step] = [
    "title" => "Schema Files Read",
    "msg" => "The schematics files were loaded for execution.",
    "state" => "success",
    "fail" => false
  ];
} else {
  // Step 6a: File failure
  $install[$step] = [
    "title" => "File Error",
    "msg" => "The schematics files could not be found.",
    "state" => "danger",
    "fail" => true
  ];
}
if ( $install[$step]["fail"] ) { die( json_encode($install) ); }

foreach($tables as $i => $v) {
  $step++;
  $install[$step] = runExec(
    $v,
    "Table #{$i} created successfully.",
    $db
  );
  if ( $install[$step]["fail"] ) { die( json_encode($install) ); }
}

// Step 6b: Populate `meta_licenses` table
$inserts = [
  ["Academic Free License v1.1", "AFL-1.1", "https://spdx.org/licenses/AFL-1.1.html"],
  ["Academic Free License v1.2", "AFL-1.2", "https://spdx.org/licenses/AFL-1.2.html"],
  ["Academic Free License v2.0", "AFL-2.0", "https://spdx.org/licenses/AFL-2.0.html"],
  ["Academic Free License v2.1", "AFL-2.1", "https://spdx.org/licenses/AFL-2.1.html"],
  ["Academic Free License v3.0", "AFL-3.0", "https://spdx.org/licenses/AFL-3.0.html"],
  ["Artistic License 1.0", "Artistic-1.0", "https://spdx.org/licenses/Artistic-1.0.html"],
  ["Artistic License 1.0 w/clause 8", "Artistic-1.0-cl8", "https://spdx.org/licenses/Artistic-1.0-cl8.html"],
  ["Artistic License 2.0", "Artistic-2.0", "https://spdx.org/licenses/Artistic-2.0.html"],
  ["Creative Commons Attribution 1.0 Generic", "CC-BY-1.0", "https://spdx.org/licenses/CC-BY-1.0.html"],
  ["Creative Commons Attribution 2.0 Generic", "CC-BY-2.0", "https://spdx.org/licenses/CC-BY-2.0.html"],
  ["Creative Commons Attribution 2.5 Generic", "CC-BY-2.5", "https://spdx.org/licenses/CC-BY-2.5.html"],
  ["Creative Commons Attribution 3.0 Unported", "CC-BY-3.0", "https://spdx.org/licenses/CC-BY-3.0.html"],
  ["Creative Commons Attribution 4.0 International", "CC-BY-4.0", "https://spdx.org/licenses/CC-BY-4.0.html"],
  ["Creative Commons Attribution Non Commercial 1.0 Generic", "CC-BY-NC-1.0", "https://spdx.org/licenses/CC-BY-NC-1.0.html"],
  ["Creative Commons Attribution Non Commercial 2.0 Generic", "CC-BY-NC-2.0", "https://spdx.org/licenses/CC-BY-NC-2.0.html"],
  ["Creative Commons Attribution Non Commercial 2.5 Generic", "CC-BY-NC-2.5", "https://spdx.org/licenses/CC-BY-NC-2.5.html"],
  ["Creative Commons Attribution Non Commercial 3.0 Unported", "CC-BY-NC-3.0", "https://spdx.org/licenses/CC-BY-NC-3.0.html"],
  ["Creative Commons Attribution Non Commercial 4.0 International", "CC-BY-NC-4.0", "https://spdx.org/licenses/CC-BY-NC-4.0.html"],
  ["Creative Commons Attribution Non Commercial No Derivatives 1.0 Generic", "CC-BY-NC-ND-1.0", "https://spdx.org/licenses/CC-BY-NC-ND-1.0.html"],
  ["Creative Commons Attribution Non Commercial No Derivatives 2.0 Generic", "CC-BY-NC-ND-2.0", "https://spdx.org/licenses/CC-BY-NC-ND-2.0.html"],
  ["Creative Commons Attribution Non Commercial No Derivatives 2.5 Generic", "CC-BY-NC-ND-2.5", "https://spdx.org/licenses/CC-BY-NC-ND-2.5.html"],
  ["Creative Commons Attribution Non Commercial No Derivatives 3.0 Unported", "CC-BY-NC-ND-3.0", "https://spdx.org/licenses/CC-BY-NC-ND-3.0.html"],
  ["Creative Commons Attribution Non Commercial No Derivatives 4.0 International", "CC-BY-NC-ND-4.0", "https://spdx.org/licenses/CC-BY-NC-ND-4.0.html"],
  ["Creative Commons Attribution Non Commercial Share Alike 1.0 Generic", "CC-BY-NC-SA-1.0", "https://spdx.org/licenses/CC-BY-NC-SA-1.0.html"],
  ["Creative Commons Attribution Non Commercial Share Alike 2.0 Generic", "CC-BY-NC-SA-2.0", "https://spdx.org/licenses/CC-BY-NC-SA-2.0.html"],
  ["Creative Commons Attribution Non Commercial Share Alike 2.5 Generic", "CC-BY-NC-SA-2.5", "https://spdx.org/licenses/CC-BY-NC-SA-2.5.html"],
  ["Creative Commons Attribution Non Commercial Share Alike 3.0 Unported", "CC-BY-NC-SA-3.0", "https://spdx.org/licenses/CC-BY-NC-SA-3.0.html"],
  ["Creative Commons Attribution Non Commercial Share Alike 4.0 International", "CC-BY-NC-SA-4.0", "https://spdx.org/licenses/CC-BY-NC-SA-4.0.html"],
  ["Creative Commons Attribution No Derivatives 1.0 Generic", "CC-BY-ND-1.0", "https://spdx.org/licenses/CC-BY-ND-1.0.html"],
  ["Creative Commons Attribution No Derivatives 2.0 Generic", "CC-BY-ND-2.0", "https://spdx.org/licenses/CC-BY-ND-2.0.html"],
  ["Creative Commons Attribution No Derivatives 2.5 Generic", "CC-BY-ND-2.5", "https://spdx.org/licenses/CC-BY-ND-2.5.html"],
  ["Creative Commons Attribution No Derivatives 3.0 Unported", "CC-BY-ND-3.0", "https://spdx.org/licenses/CC-BY-ND-3.0.html"],
  ["Creative Commons Attribution No Derivatives 4.0 International", "CC-BY-ND-4.0", "https://spdx.org/licenses/CC-BY-ND-4.0.html"],
  ["Creative Commons Attribution Share Alike 1.0 Generic", "CC-BY-SA-1.0", "https://spdx.org/licenses/CC-BY-SA-1.0.html"],
  ["Creative Commons Attribution Share Alike 2.0 Generic", "CC-BY-SA-2.0", "https://spdx.org/licenses/CC-BY-SA-2.0.html"],
  ["Creative Commons Attribution Share Alike 2.5 Generic", "CC-BY-SA-2.5", "https://spdx.org/licenses/CC-BY-SA-2.5.html"],
  ["Creative Commons Attribution Share Alike 3.0 Unported", "CC-BY-SA-3.0", "https://spdx.org/licenses/CC-BY-SA-3.0.html"],
  ["Creative Commons Attribution Share Alike 4.0 International", "CC-BY-SA-4.0", "https://spdx.org/licenses/CC-BY-SA-4.0.html"],
  ["Creative Commons Zero v1.0 Universal", "CC0-1.0", "https://spdx.org/licenses/CC0-1.0.html"],
  ["Common Public Attribution License 1.0", "CPAL-1.0", "https://spdx.org/licenses/CPAL-1.0.html"],
  ["Common Public License 1.0", "CPL-1.0", "https://spdx.org/licenses/CPL-1.0.html"],
  ["Crossword License", "Crossword", "https://spdx.org/licenses/Crossword.html"],
  ["Educational Community License v1.0", "ECL-1.0", "https://spdx.org/licenses/ECL-1.0.html"],
  ["Educational Community License v2.0", "ECL-2.0", "https://spdx.org/licenses/ECL-2.0.html"],
  ["Glulxe License", "Glulxe", "https://spdx.org/licenses/Glulxe.html"],
  ["Good Luck With That Public License", "GLWTPL", "https://github.com/me-shaon/GLWTPL"],
  ["Hippocratic License", "HL3", "https://firstdonoharm.dev/"],
  ["Historical Permission Notice and Disclaimer", "HPND", "https://spdx.org/licenses/HPND.html"],
  ["Licence Art Libre 1.2", "LAL-1.2", "https://spdx.org/licenses/LAL-1.2.html"],
  ["Licence Art Libre 1.3", "LAL-1.3", "https://spdx.org/licenses/LAL-1.3.html"],
  ["MIT License", "MIT", "https://spdx.org/licenses/MIT.html"],
  ["MIT No Attribution", "MIT-0", "https://spdx.org/licenses/MIT-0.html"],
  ["No Limit Public License", "NLPL", "https://spdx.org/licenses/NLPL.html"],
  ["The Unlicense", "Unlicense", "https://unlicense.org/"],
  ["Universal Permissive License v1.0", "UPL-1.0", "https://spdx.org/licenses/UPL-1.0.html"],
  ["Do What The F*ck You Want To Public License", "WTFPL", "http://www.wtfpl.net/"]
];

$step++;
$count = 0;
try {
  $stmt = $db->prepare( "INSERT INTO `meta_licenses` (`fullname`, `abbr`, `link`) VALUES (:fullname, :abbr, :link)" );
  foreach($inserts as $v) {
    $count++;
    $stmt->bindParam(":fullname", $v[0]);
    $stmt->bindParam(":abbr", $v[1]);
    $stmt->bindParam(":link", $v[2]);
    if ( !$stmt->execute() ) {
      // Step 6b - Query Error
      $install[$step] = [
        "title" => "Query Error",
        "msg" => "The query affected no rows.",
        "state" => "danger"
      ];
      die( json_encode($install) );
    }
  }
} catch (\PDOException $e) {
  // Step 6b - Database Error
  $install[$step] = [
    "title" => "Database Error",
    "msg" => $e->getMessage(),
    "state" => "danger"
  ];
}
// Step 6b - Query Error
$install[$step] = [
  "title" => "Table Populated",
  "msg" => "The query affected {$count} row(s).",
  "state" => "success"
];

// Step 6c - Create placeholder Home page
$step++;
$count = 0;
try {
  $stmt = $db->prepare( "INSERT INTO `pages`
                           (`author`, `name`, `published`, `body`)
                           VALUES (
                             1,
                             \"Home\",
                             :now,
                             \"Lorem ipsum dolor sit amet.\"
                           )" );
  $now = date("Y-m-d");
  $stmt->bindParam(":now", $now);
  $res = $stmt->execute();
  if ( !$res ) {
    // Step 6c - Query Error
    $install[$step] = [
      "title" => "Home Not Created",
      "msg" => "The Home placeholder was not created.",
      "state" => "danger",
      "fail" => true
    ];
  }
} catch (\PDOException $e) {
  // Step 6c - Database Error
  $install[$step] = [
    "title" => "Database Error",
    "msg" => $e->getMessage(),
    "state" => "danger",
    "fail" => true
  ];
}
// Step 6c - Query Error
$install[$step] = [
  "title" => "Home Page Created",
  "msg" => "The Home placeholder was created.",
  "state" => "success",
  "fail" => false
];
if ( $install[$step]["fail"] ) { die( json_encode($install) ); }

$auth = new \Delight\Auth\Auth($db);

try {
  // Step 7: Register Admin user
  $step++;
  $uid = $auth->registerWithUniqueUsername(
    $user_data["user_email"],
    $user_data["user_password"],
    $user_data["user_username"]
  );
}
catch (\Delight\Auth\InvalidEmailException $e) {
  // Step 7 - Invalid Email Error
  $install[$step] = [
    "title" => "Auth Error",
    "msg" => "The email was invalid.",
    "state" => "danger"
  ];
  die( json_encode($install) );
}
catch (\Delight\Auth\InvalidPasswordException $e) {
  // Step 7 - Invalid Password Error
  $install[$step] = [
    "title" => "Auth Error",
    "msg" => "Password is invalid.",
    "state" => "danger"
  ];
  die( json_encode($install) );
}
catch (\Delight\Auth\UserAlreadyExistsException $e) {
  // Step 7 - User Exists Error
  $install[$step] = [
    "title" => "Auth Error",
    "msg" => "The user already exists.",
    "state" => "danger"
  ];
  die( json_encode($install) );
}
catch (\Delight\Auth\TooManyRequestsException $e) {
  // Step 7 - Too Many Requests Error
  $install[$step] = [
    "title" => "Auth Error",
    "msg" => "Too many requests, dear. Take a rest...",
    "state" => "danger"
  ];
  die( json_encode($install) );
}
catch (\Delight\Auth\DuplicateUsernameException $e) {
  // Step 7 - Duplicate Username Error
  $install[$step] = [
    "title" => "Auth Error",
    "msg" => "Username already exists.",
    "state" => "danger"
  ];
  die( json_encode($install) );
}
catch (\Exception $e) {
  // Step 7 - Misc Error
  $install[$step] = [
    "title" => "Auth Error",
    "msg" => "Unknow error.",
    "state" => "danger"
  ];
  die( json_encode($install) );
}
// Step 7 - Success
$install[$step] = [
  "title" => "Auth Successful",
  "msg" => "Admin user (ID $uid) created successfully.",
  "state" => "success"
];

try {
  // Step 8: Set user as Admin
  $step++;
  $auth->admin()->addRoleForUserById(
    $uid,
    \Delight\Auth\Role::ADMIN
  );
  $auth->admin()->addRoleForUserById(
    $uid,
    \Delight\Auth\Role::MANAGER
  );
} catch (\Exception $e) {
  // Step 8 - Error
  $install[$step] = [
    "title" => "Auth Error",
    "msg" => $e->getMessage(),
    "state" => "danger"
  ];
  die( json_encode($install) );
}
// Step 8 - Success
$install[$step] = [
  "title" => "Auth Successful",
  "msg" => "User with ID $uid set as admin successfully.",
  "state" => "success"
];

try {
  // Step 9: Start admin's profile
  $step++;
  $profile = new Nereare\Grimoire\Profile($db, $uid);
} catch (\Exception $e) {
  // Step 9 - Error
  $install[$step] = [
    "title" => "Profile Error",
    "msg" => $e->getMessage(),
    "state" => "danger"
  ];
  die( json_encode($install) );
}
// Step 9 - Success
$install[$step] = [
  "title" => "Profile Successful",
  "msg" => "Profile for user with ID $uid opened successfully.",
  "state" => "success"
];

try {
  // Step 10: Create admin's profile
  $step++;
  $profile->create(
    $user_data["user_firstname"],
    $user_data["user_lastname"],
    $user_data["user_location"],
    $user_data["user_birth"],
    $user_data["user_systems"],
    $user_data["user_about"],
    $user_data["is_gm"],
    $user_data["is_player"],
    $user_data["is_homebrewer"],
    $user_data["user_header"]
  );
} catch (\Exception $e) {
  // Step 10 - Error
  $install[$step] = [
    "title" => "Profile Error",
    "msg" => $e->getMessage(),
    "state" => "danger"
  ];
  die( json_encode($install) );
}
// Step 10 - Success
$install[$step] = [
  "title" => "Profile Successful",
  "msg" => "Profile for user with ID $uid created successfully.",
  "state" => "success"
];

// Step 11 - Set PHPMailer data
$step++;
$admin_code = \Delight\Auth\Auth::createRandomString(64);
$config_file = fopen( "../config.php", "w" );
$config = "<?php
// Site instance data
define(\"INSTANCE_TITLE\",        \"{$user_data["site_name"]}\");
define(\"INSTANCE_SUBTITLE\",     \"{$user_data["site_subtitle"]}\");
define(\"INSTANCE_ADMIN_NAME\",   \"{$user_data["site_admin_name"]}\");
define(\"INSTANCE_ADMIN_EMAIL\",  \"{$user_data["site_admin_email"]}\");

// Database connection data
define(\"INSTANCE_DB_NAME\",      \"{$user_data["db_name"]}\");
define(\"INSTANCE_DB_USER\",      \"{$user_data["db_user"]}\");
define(\"INSTANCE_DB_PASSWORD\",  \"{$user_data["db_password"]}\");

// PHPMailer data
define(\"APP_MAIL_HOST\",         \"{$user_data["email_host"]}\");
define(\"APP_MAIL_PORT\",         \"{$user_data["email_port"]}\");
define(\"APP_MAIL_USERNAME\",     \"{$user_data["email_username"]}\");
define(\"APP_MAIL_PASSWORD\",     \"{$user_data["email_password"]}\");

// Site base link
define(\"SITE_BASEURI\",          \"{$user_data["site_baseuri"]}\");";
fwrite( $config_file, $config );
fclose( $config_file );
// Step 11 - Success
$install[$step] = [
  "title" => "Config File Created",
  "msg" => "The installation script created the mailing configuration file successfully.",
  "state" => "success"
];

// Step 12 - Send welcome email
$step++;
if ( is_readable( "../config.php" ) ) {
  include( "../config.php" );
  $mail = new \PHPMailer\PHPMailer\PHPMailer();
  $mail->isSMTP();
  $mail->Host       = constant("APP_MAIL_HOST");
  $mail->SMTPAuth   = true;
  $mail->Username   = constant("APP_MAIL_USERNAME");
  $mail->Password   = constant("APP_MAIL_PASSWORD");
  $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port       = constant("APP_MAIL_PORT");
  $mail->setFrom(constant("APP_MAIL_USERNAME"), constant("APP_NAME"));
  $mail->addAddress($user_data["user_email"], "Admin");
  $mail->isHTML(true);
  $mail->Subject = "Installation Successful";
  $mail->Body    = "<div>
    <h2 style='font-family: monospace; font-size: 1.25rem; text-align: center; margin: 0 0 1rem 0;'>
      The installation script for your distribution of " . constant("APP_NAME") . " (v" . constant("APP_VERSION") . ") finished successfully!
    </h2>
    <p style='font-family: monospace; margin: 0 0 1rem 0;'>
      The installation of your own distribution of " . constant("APP_NAME") . ", under the name of <code>" . constant("INSTANCE_TITLE") . "</code> went on without problems.
    </p>
    <p style='font-family: monospace; margin: 0 0 1rem 0;'>
      You are the <em>ADMIN</em> of this installation under the username <em>" . $user_data["user_username"] . "</em>.
    </p>
    <p style='font-family: monospace; margin: 0 0 1rem 0;'>
      You may now visit <a href=\"" . constant("SITE_BASEURI") . "\">" . constant("INSTANCE_TITLE") . "</a>.
    </p>
    <p style='font-family: monospace; font-size: 0.5rem; margin: 0; width: 100%; text-align: center;'>
      " . constant("APP_NAME") . " &mdash; version " . constant("APP_VERSION") . "
      <br>
      <a href='" . constant("APP_REPO") . "'>Source</a> available under the <a href='" . constant("APP_LICENSE_URI") . "'>" . constant("APP_LICENSE_NAME") . "</a>
    </p>
  </div>";
  $mail->AltBody = "The installation script for your distribution of " . constant("APP_NAME") . " (v" . constant("APP_VERSION") . ") finished successfully!
  ---
  The installation of your own distribution of " . constant("APP_NAME") . ", under the name of " . constant("INSTANCE_TITLE") . " went on without problems.
  You are the &lt;ADMIN&gt; of this installation under the username &lt;" . $user_data["user_username"] . "&gt;.
  You may now visit " . constant("INSTANCE_TITLE") . " under the URL &lt;" . constant("SITE_BASEURI") . "&gt;.
  ---
  " . constant("APP_NAME") . " - version " . constant("APP_VERSION") . "
  Source available under the " . constant("APP_LICENSE_NAME");
  $mail->send();
  // Step 12 - Success
  $install[$step] = [
    "title" => "Installation Email Sent",
    "msg" => "The installation script emailed the admin successfully.",
    "state" => "success"
  ];
} else {
  // Step 12 - Failure
  $install[$step] = [
    "title" => "Config File Error",
    "msg" => "The mailing configuration file was unreachable.",
    "state" => "danger"
  ];
  die( json_encode($install) );
}

// Step 13 - Success
$step++;
$install[$step] = [
  "title" => "Done",
  "msg" => "App installed. Now you may go to <a href=\".\">the main page</a> to start.",
  "state" => "info"
];

echo json_encode($install);
