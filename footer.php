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

    <div class="modal" id="login-modal">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">
            <span class="icon-text">
              <span class="icon">
                <i class="mdi mdi-account"></i>
              </span>
              <span>Login</span>
            </span>
          </p>
        </header>

        <section class="modal-card-body">
          <div class="field">
            <p class="control has-icons-left">
              <input type="text" class="input is-medium" id="login-username" placeholder="Username">
              <span class="icon is-left">
                <i class="mdi mdi-account"></i>
              </span>
            </p>
          </div>

          <div class="field">
            <p class="control has-icons-left">
              <input type="password" class="input is-medium" id="login-password" placeholder="Password">
              <span class="icon is-left">
                <i class="mdi mdi-lock"></i>
              </span>
            </p>
          </div>
        </section>

        <footer class="modal-card-foot">
          <button class="button is-success is-fullwidth" id="login-login">Login</button>
          <button class="button is-fullwidth" id="login-cancel">Cancel</button>
        </footer>
      </div>
    </div>

    <div class="notification is-hidden" id="notification">
      <button class="delete"></button>
      <p>Foo</p>
    </div>
  </body>
</html>
