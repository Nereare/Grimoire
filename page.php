<?php
/**
 * To which of the five group of pages this one pertains.
 * @var string
 */
$group = "home";

// Retrieve page ID
if ( isset( $_GET["id"] ) ) {
  $id = $_GET["id"];
  // If the page ID is Home (i.e. 1)
  if ( $id == 1 ) {
    header("Location: .");
  }
} else {
  header("Location: .");
}

require_once "header.php";

// Retrieve page contents
try {
  $stmt = $db->prepare("SELECT * FROM `pages` WHERE `id` LIKE :id");
  $stmt->bindValue(":id", $id);
  $stmt->execute();
  $thispage = $stmt->fetch(\PDO::FETCH_ASSOC);
  $profile = new \Nereare\Grimoire\Profile($db, $thispage["author"]);
} catch (\Exception $e) { $thispage = false; }
// Retrieve all pages
try {
  $stmt = $db->prepare("SELECT * FROM `pages` WHERE `name` NOT LIKE \"Home\"");
  $stmt->execute();
  $pages = $stmt->fetchAll(\PDO::FETCH_ASSOC);
} catch (\Exception $e) { $pages = false; }
?>

<main class="section">
  <div class="container">
    <div class="box">
      <?php if ( $pages || $auth->isLoggedIn() ) { ?>
      <div class="tabs is-centered">
        <ul>
          <?php if ( $auth->isLoggedIn() ) { ?>
          <li><a href="pages.php?action=create">Create Page</a></li>
          <?php } ?>
          <?php if ( $pages ) { ?>
          <?php foreach ($pages as $p) { ?>
          <li class="<?php if ($id == $p["id"]) { ?>is-active<?php } ?>"><a href="page.php?id=<?php echo $p["id"]; ?>"><?php echo $p["name"]; ?></a></li>
          <?php } ?>
          <?php } ?>
        </ul>
      </div>
      <?php } ?>

      <div class="content">
      <?php if ( $thispage ) { ?>
        <h1>
          <?php if ( $auth->isLoggedIn() ) { ?>
          <a class="button" href="pages.php?action=edit&id=<?php echo $thispage["id"]; ?>">
            <span class="icon">
              <i class="mdi mdi-text-box-edit mdi-24px"></i>
            </span>
          </a>
          <?php } ?>
          <span><?php echo $thispage["name"]; ?></span>
        </h1>
        <?php echo $md->text( $thispage["body"] ); ?>
      </div>
      <nav class="breadcrumb is-centered" aria-label="breadcrumbs">
        <ul>
          <li class="is-active"><a>By <?php echo $profile->get("first_name") . " " . $profile->get("last_name"); ?></a></li>
          <li class="is-active"><a>Created <?php echo (date("Y-m-d") == $thispage["published"]) ? "today" : date("l, F j, Y", strtotime( $thispage["published"] ) ); ?></a></li>
          <?php if ( $thispage["edited"] ) { ?>
          <li class="is-active"><a>Last edited <?php echo (date("Y-m-d") == $thispage["edited"]) ? "today" : date("l, F j, Y", strtotime( $thispage["edited"] ) ); ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } else { ?>
        <p>There is no such page...</p>
      <?php } ?>
      </div>
    </div>
  </div>
</main>

<?php
require_once "footer.php";
?>
