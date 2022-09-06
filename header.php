<?php
require "vendor/autoload.php";
require "meta.php";
session_start();

// Try and reach the configuration file
if ( is_readable( "config.php" ) ) {
  // Include configuration file
  require_once( "config.php" );
  $title = constant( "INSTANCE_TITLE" );

  // Try and connect to the database
  try {
    $db = new \PDO(
      "mysql:dbname=" . constant( "INSTANCE_DB_NAME" ) . ";host=localhost;charset=utf8mb4",
      constant( "INSTANCE_DB_USER" ),
      constant( "INSTANCE_DB_PASSWORD" )
    );
  } catch (\PDOException $e) { $notInstalled = true; }
} else {
  $notInstalled = true;
  $title = "Grimoire";
}

if ( !isset($notInstalled) ) {
  $auth = new \Delight\Auth\Auth($db);
  $md   = new Parsedown();
  $md->setSafeMode(true);
}
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="194x194" href="/favicon/favicon-194x194.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#922610">
    <link rel="shortcut icon" href="/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#922610">
    <meta name="msapplication-TileImage" content="/favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="/favicon/browserconfig.xml">
    <meta name="theme-color" content="#922610">

    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="node_modules/@mdi/font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="node_modules/typeface-libre-baskerville/index.css">
    <link rel="stylesheet" href="node_modules/typeface-montserrat/index.css">
    <link rel="stylesheet" href="node_modules/typeface-noto-sans/index.css">
    <link rel="stylesheet" href="node_modules/typeface-unifrakturcook/index.css">
    <link rel="stylesheet" href="node_modules/simplemde/dist/simplemde.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="node_modules/simplemde/dist/simplemde.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="node_modules/@creativebulma/bulma-tagsinput/dist/js/bulma-tagsinput.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="node_modules/uuid/dist/umd/uuidv4.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="js/common.js" charset="utf-8"></script>
  </head>

  <body>
    <?php
    if ( isset($notInstalled) ) { // If the instance is not installed:
    ?>
    <section class="hero is-primary is-fullheight">
      <div class="hero-body">
        <div class="container">
          <div class="columns mb-0 is-centered">
            <div class="column is-6">
              <div class="box">
                <div class="has-text-centered">
                  <figure class="image is-128x128 is-inline-block">
                    <img src="assets/404.png">
                  </figure>
                </div>

                <h2 class="title is-4">
                  <span class="icon-text has-text-primary">
                    <span class="icon">
                      <i class="mdi mdi-alert-circle"></i>
                    </span>
                    <span>Oopsie...</span>
                  </span>
                </h2>

                <div class="content">
                  <p>
                    We apologize for the inconvenience, but it seems this application is not yet installed.
                  </p>
                  <p>
                    Please, contact the domain manager for further information.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php
    exit(0);
    } // If it is installed, show the page
    ?>
    <header class="hero is-primary">
      <div class="hero-head">
        <nav class="navbar">
          <div class="container">
            <div class="navbar-brand">
              <a class="navbar-item" href=".">
                <img src="assets/favicon-white.png" alt="Logo">
              </a>
              <span class="navbar-burger" data-target="navbar">
                <span></span>
                <span></span>
                <span></span>
              </span>
            </div>
            <div id="navbar" class="navbar-menu has-text-centered">
              <div class="navbar-end">
                <span class="navbar-item">
                  <a class="button is-info is-inverted">
                    <span class="icon">
                      <i class="mdi mdi-account mdi-24px"></i>
                    </span>
                    <span><?php echo "FOO"; ?></span>
                  </a>
                </span>
              </div>
            </div>
          </div>
        </nav>
      </div>

      <div class="hero-body">
        <div class="container has-text-centered">
          <p class="title">
            <?php echo $title; ?>
          </p>
          <p class="subtitle">
            <?php echo constant( "INSTANCE_SUBTITLE" ); ?>
          </p>
        </div>
      </div>

      <div class="hero-foot">
        <nav class="tabs is-boxed is-fullwidth">
          <div class="container">
            <ul>
              <li class="is-active">
                <a>Overview</a>
              </li>
              <li>
                <a>Modifiers</a>
              </li>
              <li>
                <a>Grid</a>
              </li>
              <li>
                <a>Elements</a>
              </li>
              <li>
                <a>Components</a>
              </li>
              <li>
                <a>Layout</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
