<?php
/**
 * If this page has a dedicated script file, what is its name without the ".js".
 * @var string
 */
$script = "profiles";
require_once "header.php";

if ( $auth->isLoggedIn() ) {
  if ( isset( $_GET["action"] ) ) {
    $action = $_GET["action"];
  } else {
    $action = null;
  }

  $pretitle               = "Create";
  $class                  = "plus";
  $profile["id"]          = null;
  $profile["first_name"]  = null;
  $profile["last_name"]   = null;
  $profile["location"]    = null;
  $profile["birth"]       = null;
  $profile["about"]       = null;
  $profile["systems"]     = null;
  $profile["gm"]          = null;
  $profile["player"]      = null;
  $profile["homebrewer"]  = null;
  $profile["header"]      = null;

  switch ( $action ) {
    case "edit":
      if ( isset( $_GET["id"] ) ) {
        // Start profile object
        try {
          $thisprofile = new \Nereare\Grimoire\Profile($db, $_GET["id"]);
          // Set exhibit variables
          $pretitle               = "Edit";
          $class                  = "edit";
          $profile["id"]          = $thisprofile->getUid();
          $profile["first_name"]  = $thisprofile->get("first_name");
          $profile["last_name"]   = $thisprofile->get("last_name");
          $profile["location"]    = $thisprofile->get("location");
          $profile["birth"]       = $thisprofile->get("birth");
          $profile["about"]       = $thisprofile->get("about");
          $profile["systems"]     = $thisprofile->get("systems");
          $profile["gm"]          = $thisprofile->get("gm");
          $profile["player"]      = $thisprofile->get("player");
          $profile["homebrewer"]  = $thisprofile->get("homebrewer");
          $profile["header"]      = $thisprofile->get("header");
          unset( $thisprofile );
        }
        catch (\Exception $e) { $profile = null; }
      }
      break;
    default:
      // Nothing to do here...
      break;
  }
?>

<main class="section">
  <div class="container">
    <div class="box">
      <h2 class="title is-3">
        <span class="icon-text">
          <span class="icon">
            <i class="mdi mdi-account-<?php echo $class; ?>"></i>
          </span>
          <span><?php echo $pretitle; ?> Profile</span>
        </span>
      </h2>

      <div class="field has-addons">
        <div class="control">
          <button class="button is-static" tabindex="-1">Name</button>
        </div>
        <div class="control is-expanded">
          <input class="input" id="firstname" type="text" placeholder="First name" value="<?php echo $profile["first_name"]; ?>">
        </div>
        <div class="control is-expanded">
          <input class="input" id="lastname" type="text" placeholder="Middle and last names" value="<?php echo $profile["last_name"]; ?>">
        </div>
      </div>

      <input type="number" class="is-hidden" value="<?php echo $profile["id"]; ?>">

      <div class="field has-addons">
        <div class="control">
          <button class="button is-static" tabindex="-1">Location</button>
        </div>
        <div class="control is-expanded">
          <input class="input" id="location" type="text" placeholder="Your location" value="<?php echo $profile["location"]; ?>">
        </div>
      </div>

      <div class="field has-addons">
        <div class="control">
          <button class="button is-static" tabindex="-1">Date of Birth</button>
        </div>
        <div class="control is-expanded">
          <input class="input" id="birth" type="date" value="<?php echo $profile["birth"]; ?>">
        </div>
      </div>

      <div class="field has-addons">
        <div class="control">
          <button class="button is-static" tabindex="-1">Header Image</button>
        </div>
        <div class="control is-expanded">
          <input type="text" class="input" id="header" placeholder="URI to the image" value="<?php echo $profile["header"]; ?>">
        </div>
      </div>

      <div class="field">
        <div class="control is-expanded">
          <input type="text" class="input" id="systems" data-type="tags" placeholder="Comma-separated systems" value="<?php echo $profile["systems"]; ?>">
        </div>
      </div>

      <div class="columns">
        <div class="column">
          <div class="field">
            <input type="checkbox" class="switch" id="gm"<?php if ( $profile["gm"] ) { ?> checked<?php } ?>>
            <label for="is-gm">Game Master?</label>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <input type="checkbox" class="switch" id="player"<?php if ( $profile["player"] ) { ?> checked<?php } ?>>
            <label for="is-player">Player?</label>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <input type="checkbox" class="switch" id="homebrewer"<?php if ( $profile["homebrewer"] ) { ?> checked<?php } ?>>
            <label for="is-homebrewer">Homebrewer?</label>
          </div>
        </div>
      </div>

      <div class="field">
        <div class="control">
          <textarea class="textarea has-fixed-size" id="about" placeholder="Tell us something about you"><?php echo $profile["about"]; ?></textarea>
        </div>
      </div>

      <div class="field">
        <div class="control">
          <button class="button is-success is-fullwidth" id="do">
            <span class="icon">
              <i class="mdi mdi-account-check mdi-24px"></i>
            </span>
          </button>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
} else {
?>

<main class="section">
  <div class="container">
    <div class="box">
      <h2 class="title is-2">
        <span class="text-icon">
          <span class="icon">
            <i class="mdi mdi-cancel"></i>
          </span>
          <span>Shoo!</span>
        </span>
      </h2>

      <p>Please, log in to use this page.</p>
    </div>
  </div>
</main>

<?php
}
require_once "footer.php";
?>
