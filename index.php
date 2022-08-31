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

    <link rel="stylesheet" href="{{ 'assets/css/style.css' | absolute_url }}" />
    <link rel="stylesheet" href="{{ 'assets/css/stats-block.css' | absolute_url }}" />
    <link rel="stylesheet" href="{{ 'assets/css/boxes.css' | absolute_url }}" />

    <script type="text/javascript" src=""></script>
  </head>

  <body>
    FOO
  </body>
</html>
