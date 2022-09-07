<?php
/**
 * If this page has a dedicated script file, what is its name without the ".js".
 * @var string
 */
$script = "pages";
require_once "header.php";

if ( $auth->isLoggedIn() ) {
  if ( isset( $_GET["action"] ) ) {
    $action = $_GET["action"];
  } else {
    $action = null;
  }

  $pretitle     = "Create";
  $class        = "plus";
  $page["id"]   = null;
  $page["name"] = null;
  $page["body"] = null;

  switch ( $action ) {
    case "edit":
      if ( isset( $_GET["id"] ) ) {
        // Get page ID
        $page["id"] = $_GET["id"];
        // Prepare page-retrieving statement
        $stmt = $db->prepare("SELECT * FROM `pages` WHERE `id` = :id");
        $stmt->bindValue(":id", $page["id"], \PDO::PARAM_INT);
        // Execute query and get success/failure
        $ret = $stmt->execute();
        // Get if there is a page
        $newpage = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ( $ret && $newpage ) {
          // Set exhibit variables
          $pretitle = "Edit";
          $class = "edit";
          // Get page data
          $page = $newpage;
        } else {
          $page["id"] = null;
        }
      }
      break;
    default:
      if ( isset( $_GET["name"] ) ) { $page["name"] = $_GET["name"]; }
      break;
  }
?>

<main class="section">
  <div class="container">
    <div class="box">
      <h2 class="title is-2">
        <span class="text-icon">
          <span class="icon">
            <i class="mdi mdi-text-box-<?php echo $class; ?>"></i>
          </span>
          <span><?php echo $pretitle; ?> Page</span>
        </span>
      </h2>

      <div class="field">
        <div class="control has-icons-left">
          <input type="text" class="input is-large" id="name" placeholder="Page title / name" value="<?php echo $page["name"]; ?>" required>
          <span class="icon is-large is-left">
            <i class="mdi mdi-format-header-pound mdi-36px"></i>
          </span>
        </div>
      </div>

      <input type="number" class="is-hidden" id="id" value="<?php echo $page["id"]; ?>">

      <div class="field">
        <div class="control">
          <textarea class="textarea has-fixed-size" id="body" placeholder="The body of the page" required><?php echo $page["body"]; ?></textarea>
        </div>
      </div>

      <div class="field">
        <div class="control is-expanded">
          <button class="button is-success is-fullwidth" id="do">
            <span class="text-icon">
              <span class="icon">
                <i class="mdi mdi-text-box-<?php echo $class; ?>"></i>
              </span>
              <span>Save</span>
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
