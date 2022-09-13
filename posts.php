<?php
/**
 * If this page has a dedicated script file, what is its name without the ".js".
 * @var string
 */
$script = "posts";
require_once "header.php";

if ( $auth->isLoggedIn() ) {
  if ( isset( $_GET["action"] ) ) {
    $action = $_GET["action"];
  } else {
    $action = null;
  }

  $pretitle            = "Create";
  $class               = "plus";
  $post["id"]          = null;
  $post["author"]      = null;
  $post["published"]   = null;
  $post["edited"]      = null;
  $post["title"]       = null;
  $post["tags"]        = null;
  $post["category"]    = null;
  $post["header"]      = null;
  $post["body"]        = null;

  switch ( $action ) {
    case "edit":
      if ( isset( $_GET["id"] ) ) {
        // Get post ID
        $post["id"] = (int) $_GET["id"];
        // Prepare page-retrieving statement
        $stmt = $db->prepare("SELECT * FROM `posts` WHERE `id` = :id");
        $stmt->bindValue(":id", $post["id"], \PDO::PARAM_INT);
        // Execute query and get success/failure
        $ret = $stmt->execute();
        // Get if there is a page
        $newpost = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ( $ret && $newpost ) {
          // Set exhibit variables
          $pretitle = "Edit";
          $class = "edit";
          // Get page data
          $post = $newpost;
        } else { $post["id"] = null; }
      }
      break;
    default:
      if ( isset( $_GET["title"] ) ) { $post["title"] = $_GET["title"]; }
      break;
  }
?>

<main class="section">
  <div class="container">
    <div class="box">
      <h2 class="title is-2">
        <span class="text-icon">
          <span class="icon">
            <i class="mdi mdi-file-<?php echo $class; ?>"></i>
          </span>
          <span><?php echo $pretitle; ?> Post</span>
        </span>
      </h2>

      <div class="field">
        <div class="control has-icons-left">
          <input type="text" class="input is-large" id="title" placeholder="Post title" value="<?php echo $post["title"]; ?>" required>
          <span class="icon is-large is-left">
            <i class="mdi mdi-format-header-pound mdi-36px"></i>
          </span>
        </div>
      </div>

      <div class="field">
        <div class="control">
          <input type="text" class="input" id="tags" data-type="tags" placeholder="Comma-separated tags" value="<?php echo $post["tags"]; ?>">
        </div>
      </div>

      <div class="field">
        <div class="control">
          <input type="text" class="input" id="category" placeholder="Category" value="<?php echo $post["category"]; ?>">
        </div>
      </div>

      <div class="field">
        <div class="control">
          <input type="text" class="input" id="header" placeholder="Header URI" value="<?php echo $post["header"]; ?>">
        </div>
      </div>

      <input type="number" class="is-hidden" id="id" value="<?php echo $post["id"]; ?>">

      <div class="field">
        <div class="control">
          <textarea class="textarea has-fixed-size" id="body" placeholder="The body of the page" required><?php echo $post["body"]; ?></textarea>
        </div>
      </div>

      <div class="field">
        <div class="control is-expanded">
          <button class="button is-success is-fullwidth" id="do">
            <span class="text-icon">
              <span class="icon">
                <i class="mdi mdi-file-<?php echo $class; ?>"></i>
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
