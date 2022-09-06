    <footer class="footer">
      <div class="content has-text-centered">
        <p>
          <strong><?php echo $title; ?></strong> by <a href="mailto:<?php echo constant( "INSTANCE_ADMIN_EMAIL" ); ?>"><?php echo constant( "INSTANCE_ADMIN_NAME" ); ?></a>
        </p>
        <p>
          <a href="<?php echo constant("APP_REPO"); ?>">
            <?php echo constant("APP_NAME"); ?>
          </a>
          &copy;
          <?php echo constant("APP_YEAR"); ?>
          <?php echo constant("APP_AUTHOR"); ?>
          &bull;
          Licensed under the
          <a href="<?php echo constant("APP_LICENSE_URI"); ?>">
            <?php echo constant("APP_LICENSE_NAME"); ?>
          </a>
        </p>
      </div>
    </footer>

    <div class="notification is-hidden" id="notification">
      <button class="delete"></button>
      <p>Foo</p>
    </div>
  </body>
</html>
