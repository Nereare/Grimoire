<?php
/**
 * If this page has a dedicated script file, what is its name without the ".js".
 * @var string
 */
$script = "setup";
require_once "header.php";

// Check if the user is logged in
if ( $auth->isLoggedIn() ) {
  // Retrieve users' list
  try {
    $stmt = $db->prepare("SELECT `id`, `email`, `username` FROM `users`");
    if ( $stmt->execute() ) {
      $user_list = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } else { $user_list = false; }
  } catch (\Exception $e) { $user_list = false; }

  // Get if there is a starter tab
  if ( isset( $_GET["tab"] ) ) { $tab_open = $_GET["tab"]; }
  else { $tab_open = "password"; }
?>

<main class="section">
  <div class="container">
    <div class="box">
      <h2 class="title is-3">
        <span class="icon-text">
          <span class="icon">
            <i class="mdi mdi-cog"></i>
          </span>
          <span>Configuration</span>
        </span>
      </h2>

      <input type="text" class="is-hidden" id="tab-open" value="<?php echo $tab_open; ?>">

      <div class="tabs is-centered">
        <ul>
          <li>
            <a class="tab-link" id="tab-password">
              <span class="icon">
                <i class="mdi mdi-lock" aria-hidden="true"></i>
              </span>
              <span>Password</span>
            </a>
          </li>
          <li>
            <a class="tab-link" id="tab-list-users">
              <span class="icon">
                <i class="mdi mdi-account-multiple" aria-hidden="true"></i>
              </span>
              <span>List Users</span>
            </a>
          </li>
          <?php if ( $auth->hasRole( \Delight\Auth\Role::ADMIN ) ) { ?>
          <li>
            <a class="tab-link" id="tab-add-user">
              <span class="icon">
                <i class="mdi mdi-account-plus" aria-hidden="true"></i>
              </span>
              <span>Create User</span>
            </a>
          </li>
          <?php } ?>
        </ul>
      </div>

      <div class="is-hidden" id="password">
        <p class="help">The password can contain alphanumeric characters as well as some special symbols (<code>_-?$()#@.=</code>), it also must be at least 6 character long.</p>
        <div class="field has-addons">
          <div class="control">
            <button class="button is-static" tabindex="-1">New Password</button>
          </div>
          <div class="control is-expanded">
            <input type="password" class="input" id="new-pw-1" placeholder="New password">
          </div>
        </div>

        <div class="field has-addons">
          <div class="control">
            <button class="button is-static" tabindex="-1">Repeat New Password</button>
          </div>
          <div class="control is-expanded">
            <input type="password" class="input" id="new-pw-2" placeholder="New password, again">
          </div>
        </div>

        <div class="field has-addons">
          <div class="control">
            <button class="button is-static" tabindex="-1">Old Password</button>
          </div>
          <div class="control is-expanded">
            <input type="password" class="input" id="old-pw" placeholder="Old password">
          </div>
        </div>

        <div class="field">
          <div class="control is-expanded">
            <button class="button is-success is-fullwidth" id="do-password">
              <span class="icon-text">
                <span class="icon">
                  <i class="mdi mdi-lock-reset mdi-18px"></i>
                </span>
                <span>Change Password</span>
              </span>
            </button>
          </div>
        </div>
      </div>

      <div class="is-hidden" id="list-users">
        <?php if ( $user_list ) { ?>
        <table class="table is-striped is-hoverable is-fullwidth">
          <thead>
            <tr>
              <th class="has-text-centered">ID</th>
              <th class="has-text-centered">Username</th>
              <th class="has-text-centered">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($user_list as $u) {
              $stmt = $db->prepare("SELECT `status` FROM `users` WHERE `id` LIKE :id");
              $stmt->bindParam(":id", $u["id"], \PDO::PARAM_INT);
              $stmt->execute();
              $status = (int) $stmt->fetch( \PDO::FETCH_ASSOC )["status"];
            ?>
            <tr>
              <td><?php echo $u["id"]; ?></td>
              <td>
                <span class="icon-text">
                  <span class="icon">
                  <?php if ($auth->admin()->doesUserHaveRole($u["id"], \Delight\Auth\Role::ADMIN)) { ?>
                    <i class="mdi mdi-shield-account"></i>
                  <?php } elseif ( $status == \Delight\Auth\Status::BANNED ) { ?>
                    <i class="mdi mdi-account-off"></i>
                  <?php } else { ?>
                    <i class="mdi mdi-account"></i>
                  <?php } ?>
                  </span>
                </span>
                <span>
                  <?php echo $u["username"]; ?>
                  <?php if ( $u["id"] == $auth->getUserID() ) { ?>
                  <span class="has-text-grey-lighter">(You)</span>
                  <?php } ?>
                </span>
              </td>
              <td>
                <div class="field has-addons">
                  <div class="control">
                    <a class="button is-small" href="profile.php?id=<?php echo $u["id"]; ?>">
                      <span class="icon">
                        <i class="mdi mdi-account"></i>
                      </span>
                    </a>
                  </div>
                  <div class="control">
                    <a class="button is-small" href="mailto:<?php echo $u["email"]; ?>">
                      <span class="icon">
                        <i class="mdi mdi-email"></i>
                      </span>
                    </a>
                  </div>
                  <?php if ( $auth->hasRole( \Delight\Auth\Role::ADMIN ) && !$auth->admin()->doesUserHaveRole($u["id"], \Delight\Auth\Role::ADMIN) ) { ?>
                  <?php if ( $status == \Delight\Auth\Status::BANNED ) { ?>
                  <div class="control">
                    <a class="button is-small is-success" id="users-unban" data-user-id="<?php echo $u["id"]; ?>">
                      <span class="icon">
                        <i class="mdi mdi-check"></i>
                      </span>
                    </a>
                  </div>
                  <?php } else { ?>
                  <div class="control">
                    <a class="button is-small is-warning" id="users-ban" data-user-id="<?php echo $u["id"]; ?>">
                      <span class="icon">
                        <i class="mdi mdi-cancel"></i>
                      </span>
                    </a>
                  </div>
                  <?php } ?>
                  <div class="control">
                    <a class="button is-small is-danger" id="users-delete" data-user-id="<?php echo $u["id"]; ?>">
                      <span class="icon">
                        <i class="mdi mdi-delete"></i>
                      </span>
                    </a>
                  </div>
                  <?php } ?>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php } else { ?>
        <p>Something went wrong fetching the user list...</p>
        <?php } ?>
      </div>

      <?php if ( $auth->hasRole( \Delight\Auth\Role::ADMIN ) ) { ?>
      <div class="is-hidden" id="add-user">
        <p class="help">The username, once set, cannot be changed! And it can contain only alphanumeric characters and underlines (<code>_</code>), it must start with a letter (<code>A-Z|a-z</code>), and have at least 6 characters.</p>
        <div class="field has-addons">
          <div class="control">
            <button class="button is-static" tabindex="-1">Username</button>
          </div>
          <div class="control is-expanded">
            <input class="input required" id="user-username" type="text" placeholder="Admin User username">
          </div>
        </div>

        <div class="field has-addons">
          <div class="control">
            <button class="button is-static" tabindex="-1">Email</button>
          </div>
          <div class="control is-expanded">
            <input class="input required" id="user-email" type="email" placeholder="Admin Email">
          </div>
        </div>

        <div class="field">
          <div class="control is-expanded">
            <button class="button is-success is-fullwidth" id="do-add-user">
              <span class="icon-text">
                <span class="icon">
                  <i class="mdi mdi-account-plus mdi-18px"></i>
                </span>
                <span>Add User</span>
              </span>
            </button>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</main>

<?php } else { ?>

<main class="section">
  <div class="container">
    <div class="box">
      <div class="content">
        <p>I see a tiny tiny bird trying to meddle where it is not supposed to be...</p>
      </div>
    </div>
  </div>
</main>

<?php
}
require_once "footer.php";
?>
