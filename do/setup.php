<?php
require "header.php";

function fauxPw($length = 8) {
  $bytes = random_bytes( $length );
  return bin2hex($bytes);
}

// The user must be logged in to be able to use these functions
if ( $auth->isLoggedIn() ) {
  // Run setup action
  switch ( $_GET["action"] ) {
    case "add-user":
      // Create new user
      // Check if current user is ADMIN
      if ( $auth->hasRole( \Delight\Auth\Role::ADMIN ) ) {
        // Check if the minimum required fields were sent
        if ( isset( $_GET["username"] ) &&
             isset( $_GET["email"] ) ) {
          // Get new user data
          $user["username"] = $_GET["username"];
          $user["email"] = $_GET["email"];
          $user["password"] = fauxPw();
          try {
            $user["id"] = $auth->admin()->createUserWithUniqueUsername(
              $user["email"],
              $user["password"],
              $user["username"]
            );
            $profile = new \Nereare\Grimoire\Profile($db, $user["id"]);
            $profile->create("", "", "", "", "", "", "", false, false, false);
            $mail->addAddress($user["email"]);
            $mail->isHTML(true);
            $mail->Subject = "Sign Up - " . constant("INSTANCE_TITLE");
            $mail->Body    = "<div>
              <h2 style='font-family: monospace; font-size: 1.25rem; text-align: center; margin: 0 0 1rem 0;'>
                Welcome to " . constant("INSTANCE_TITLE") . "!
              </h2>
              <p style='font-family: monospace; margin: 0 0 1rem 0;'>
                The admin of this instance of " . constant("APP_NAME") . " has signed you up to join in worldbuilding with them.
              </p>
              <p style='font-family: monospace; margin: 0 0 1rem 0;'>
                Your username is <em>" . $user["username"] . "</em> and your automatically generated password is <em>" . $user["password"] . "</em>.
              </p>
              <p style='font-family: monospace; margin: 0 0 1rem 0;'>
                Although this password is programatically generated and no human has access to it - not even the admin! -, we strongly suggest you change it as soon as you log in.
              </p>
              <p style='font-family: monospace; font-size: 0.5rem; margin: 0; width: 100%; text-align: center;'>
                <a href='" . constant("SITE_BASEURI") . "'>" . constant("INSTANCE_TITLE") . "</a>
                <br>
                An instance of <a href='" . constant("APP_REPO") . "'>" . constant("APP_NAME") . "</a> &mdash; version " . constant("APP_VERSION") . "
              </p>
            </div>";
            $mail->AltBody = "Welcome to " . constant("INSTANCE_TITLE") . "!
            ---
            The admin of this instance of " . constant("APP_NAME") . " has signed you up to join in worldbuilding with them.
            Your username is &lt; " . $user["username"] . " &gt; and your automatically generated password is &lt; " . $user["password"] . " &gt;.
            Visit &lt; " . constant("SITE_BASEURI") . " &gt; to log in.
            Although this password is programatically generated and no human has access to it - not even the admin! -, we strongly suggest you change it as soon as you log in.
            ---
            " . constant("INSTANCE_TITLE") . "
            An instance of " . constant("APP_NAME") . " &mdash; version " . constant("APP_VERSION");
            $mail->send();
            loggy("debug", "Request executed", "setup", "add-user", ["added-user" => $user["id"]]);
            echo "0";
            exit();
          } catch (\Exception $e) {
            loggy("warning", "Could not execute request", "setup", "add-user");
            die(1);
          }
        } else {
          loggy("warning", "Request does not offer the minimum required fields", "setup", "add-user");
          die("1");
        }
      } else {
        loggy("warning", "Requesting user is not Admin", "setup", "add-user");
        die("1");
      }
      break;
    case "ban":
      // Check if required field was sent
      if ( isset( $_GET["id"] ) ) {
        $uid = (int) $_GET["id"];
        // Check if the user requesting the ban is an Admin,
        // but the user to be banned is NOT an Admin
        if ( $auth->hasRole(\Delight\Auth\Role::ADMIN) &&
             !$auth->admin()->doesUserHaveRole($uid, \Delight\Auth\Role::ADMIN) ) {
          try {
            $stmt = $db->prepare("UPDATE `users`
                                  SET `status` = " . \Delight\Auth\Status::BANNED . "
                                  WHERE `id` LIKE :id");
            $stmt->bindParam(":id", $uid, \PDO::PARAM_INT);
            $stmt->execute();
            loggy("debug", "Request executed", "setup", "ban", ["target-user" => $uid]);
            echo "0";
            exit();
          }
          catch (\Exception $e) {
            loggy("warning", "Could not execute request", "setup", "ban", ["target-user" => $uid]);
            die("1");
          }
        } else {
          loggy("warning", "Requesting user is not Admin, or user to delete is", "setup", "ban", ["target-user" => $uid]);
          die("1");
        }
      } else {
        loggy("warning", "Request does not offer the minimum required fields", "setup", "ban");
        die("1");
      }
      break;
    case "unban":
      // Check if required field was sent
      if ( isset( $_GET["id"] ) ) {
        $uid = (int) $_GET["id"];
        // Check if the user requesting the ban is an Admin,
        // but the user to be banned is NOT an Admin
        if ( $auth->hasRole(\Delight\Auth\Role::ADMIN) &&
             !$auth->admin()->doesUserHaveRole($uid, \Delight\Auth\Role::ADMIN) ) {
          try {
            $stmt = $db->prepare("UPDATE `users`
                                  SET `status` = 0
                                  WHERE `id` LIKE :id");
            $stmt->bindParam(":id", $uid, \PDO::PARAM_INT);
            $stmt->execute();
            loggy("debug", "Request executed", "setup", "unban", ["target-user" => $uid]);
            echo "0";
            exit();
          }
          catch (\Exception $e) {
            loggy("warning", "Could not execute request", "setup", "unban", ["target-user" => $uid]);
            die("1");
          }
        } else {
          loggy("warning", "Requesting user is not Admin, or user to delete is", "setup", "unban", ["target-user" => $uid]);
          die("1");
        }
      } else {
        loggy("warning", "Request does not offer the minimum required fields", "setup", "unban");
        die("1");
      }
      break;
    case "delete":
      // Check if required field was sent
      if ( isset( $_GET["id"] ) ) {
        $uid = (int) $_GET["id"];
        // Check if the user requesting the delete is an Admin,
        // but the user to be deleted is NOT an Admin
        if ( $auth->hasRole(\Delight\Auth\Role::ADMIN) &&
             !$auth->admin()->doesUserHaveRole($uid, \Delight\Auth\Role::ADMIN) ) {
          try {
            // Delete user
            $auth->admin()->deleteUserById( $uid );
            loggy("debug", "Request executed", "setup", "delete-user");
            echo "0";
            exit();
          }
          catch (\Exception $e) {
            loggy("warning", "Could not execute request", "setup", "delete-user");
            die("1");
          }
        } else {
          loggy("warning", "Requesting user is not Admin, or user to delete is", "setup", "delete-user");
          die("1");
        }
      } else {
        loggy("warning", "Request does not offer the minimum required fields", "setup", "delete-user");
        die("1");
      }
      break;
    case "password":
      // Change password
      // Check if the minimum required fields were sent
      if ( isset( $_GET["action"] ) &&
           isset( $_GET["new_1"] ) &&
           isset( $_GET["new_2"] ) &&
           isset( $_GET["old"] ) ) {
        // Get password data
        $pw["new_1"] = $_GET["new_1"];
        $pw["new_2"] = $_GET["new_2"];
        $pw["old"] = $_GET["old"];
        // Set password regex pattern
        $pw["pattern"] = "/^[A-Za-z0-9\_\-\?\$\(\)\#\@\.\=]{6,}$/";

        // Check new password validity & old password not being empty
        if ( $pw["new_1"] == $pw["new_2"] &&
             preg_match($pw["pattern"], $pw["new_1"]) &&
             $pw["old"] != "" ) {
          try {
            // Change password
            $auth->changePassword($pw["old"], $pw["new_1"]);
            loggy("debug", "Request executed", "setup", "password");
            echo "0";
            exit();
          } catch (\Exception $e) {
            loggy("warning", "Could not execute request", "setup", "password");
            die("1");
          }
        } else {
          loggy("warning", "Request does not offer the minimum required fields", "setup", "password");
          die("1");
        }
      } else {
        loggy("warning", "Request does not offer the minimum required fields", "setup", "password");
        die("1");
      }
      break;
    default:
      // There MUST be an action
      loggy("warning", "The request did not include an action", "setup", "access");
      die("1");
      break;
  }
} else {
  loggy("warning", "The user is not logged in", "setup", "access");
  die("1");
}
