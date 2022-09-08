<?php
/**
 * To which of the five group of pages this one pertains.
 * @var string
 */
$group = "home";
require_once "header.php";

// Check if there is a User ID set
if ( isset( $_GET["id"] ) ) {
  try { $profile = new \Nereare\Grimoire\Profile($db, $_GET["id"]); }
  catch (\Exception $e) { $profile = false; }
} elseif ( isset( $auth ) && $auth->isLoggedIn() ) {
  $profile = new \Nereare\Grimoire\Profile($db, $auth->getUserID());
} else {
  $profile = false;
}
?>

<main class="section">
  <div class="container">
  <?php if ( $profile ) { ?>
    <div class="card">
      <div class="card-image">
        <figure class="image is-3by1">
          <img src="<?php echo ( $profile->get("header") ) ? $profile->get("header") : "https://placekitten.com/1200/400"; ?>" alt="Placeholder image">
        </figure>
      </div>
      <div class="card-content">
        <div class="media">
          <div class="media-left">
            <figure class="image is-48x48">
              <img class="is-rounded" src="https://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $profile->getEmail() ) ) ); ?>?s=48&d=retro" alt="Placeholder image">
            </figure>
          </div>
          <div class="media-content">
            <p class="title is-4">
              <?php if ( $auth->isLoggedIn() &&  $auth->getUserID() == $profile->getUid() ) { ?>
              <a class="button is-small" href="profiles.php?action=edit&id=<?php echo $profile->getUid(); ?>">
                <span class="icon">
                  <i class="mdi mdi-account-edit mdi-18px"></i>
                </span>
              </a>
              <?php } ?>
              <?php echo $profile->get("first_name") . " " . $profile->get("last_name"); ?>
            </p>
            <p class="subtitle is-6">@<?php echo $profile->getUsername(); ?></p>
          </div>
        </div>

        <nav class="breadcrumb is-centered">
          <ul>
            <?php if ( $profile->get("location") != "" ) { ?>
            <li class="is-active">
              <a>
                <span class="icon-text">
                  <span class="icon">
                    <i class="mdi mdi-map-marker"></i>
                  </span>
                  <span><?php echo $profile->get("location"); ?></span>
                </span>
              </a>
            </li>
            <?php } ?>
            <?php if ( $profile->get("birth") != "" ) { ?>
            <li class="is-active">
              <a>
                <span class="icon-text">
                  <span class="icon">
                    <i class="mdi mdi-cake-variant"></i>
                  </span>
                  <span><?php echo $profile->get("birth"); ?></span>
                </span>
              </a>
            </li>
            <?php } ?>
            <?php if ( $profile->get("gm") ) { ?>
            <li class="is-active">
              <a>
                <span class="icon-text">
                  <span class="icon">
                    <i class="mdi mdi-castle"></i>
                  </span>
                  <span>Game Master</span>
                </span>
              </a>
            </li>
            <?php } ?>
            <?php if ( $profile->get("player") ) { ?>
            <li class="is-active">
              <a>
                <span class="icon-text">
                  <span class="icon">
                    <i class="mdi mdi-dice-d20"></i>
                  </span>
                  <span>Player</span>
                </span>
              </a>
            </li>
            <?php } ?>
            <?php if ( $profile->get("homebrewer") ) { ?>
            <li class="is-active">
              <a>
                <span class="icon-text">
                  <span class="icon">
                    <i class="mdi mdi-glass-mug-variant"></i>
                  </span>
                  <span>Homebrewer</span>
                </span>
              </a>
            </li>
            <?php } ?>
          </ul>
        </nav>

        <?php if ( $profile->get("systems") != "" ) { ?>
        <nav class="breadcrumb is-small is-centered has-bullet-separator">
          <ul>
            <?php foreach (explode(",", $profile->get("systems")) as $s) { ?>
            <li class="is-active">
              <a><?php echo $s; ?></a>
            </li>
            <?php } ?>
          </ul>
        </nav>
        <?php } ?>

        <div class="content">
          <?php echo $md->text( $profile->get("about") ); ?>
        </div>
      </div>
    </div>
  <?php } else { ?>
    <div class="box">
      <div class="content">
        <p>There is no such profile.</p>
      </div>
    </div>
  <?php } ?>
  </div>
</main>

<?php
require_once "footer.php";
?>
