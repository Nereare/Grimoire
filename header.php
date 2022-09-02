<?php
require_once "meta.php";
?>
<!DOCTYPE html>
<html lang="<?php echo "FOO"; ?>">
  <head>
    <?php if ( false ) { ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ site.google_analytics }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ site.google_analytics }}');
    </script>
    <?php } ?>

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

    <title><?php echo "FOO"; ?></title>

    <link rel="stylesheet" href="node_modules/@mdi/font/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="node_modules/typeface-libre-baskerville/index.css" />
    <link rel="stylesheet" href="node_modules/typeface-montserrat/index.css" />
    <link rel="stylesheet" href="node_modules/typeface-noto-sans/index.css" />
    <link rel="stylesheet" href="node_modules/typeface-unifrakturcook/index.css" />
    <link rel="stylesheet" href="css/style.css" />

    <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
  </head>

  <body>
    <header class="hero is-primary">
      <div class="hero-head">
        <nav class="navbar">
          <div class="container">
            <div class="navbar-brand">
              <a class="navbar-item">
                <img src="assets/favicon-white.png" alt="Logo">
              </a>
              <span class="navbar-burger" data-target="navbarMenuHeroB">
                <span></span>
                <span></span>
                <span></span>
              </span>
            </div>
            <div id="navbarMenuHeroB" class="navbar-menu">
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
            <?php echo "FOO"; ?>
          </p>
          <p class="subtitle">
            <?php echo "FOO"; ?>
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
