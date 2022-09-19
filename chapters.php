<?php
/**
 * If this page has a dedicated script file, what is its name without the ".js".
 * @var string
 */
$script = "chapters";
require_once "header.php";

if ( $auth->isLoggedIn() ) {
  if ( isset( $_GET["action"] ) && isset( $_GET["target"] ) ) {
    $action = $_GET["action"];
    $target = $_GET["target"];
  } else {
    $action = null;
    $target = null;
  }

  $pretitle             = "Create";
  $posttitle            = "Book";
  $class                = "plus";
  $book["id"]           = null;
  $book["name"]         = null;
  $chapter["id"]        = null;
  $chapter["book"]      = null;
  $chapter["title"]     = null;
  $chapter["body"]      = null;
  $chapter["previous"]  = null;
  $chapter["next"]      = null;

  if ( $target == "chapter" ) {
    // Parse CHAPTERs info
    if ( isset( $_GET["id"] ) ) {
      // Get chapter ID
      $chapter["id"] = (int) $_GET["id"];
      try {
        // Prepare chapter-retrieving statement
        $stmt = $db->prepare("SELECT * FROM `chapters` WHERE `id` = :id");
        $stmt->bindValue(":id", $chapter["id"], \PDO::PARAM_INT);
        // Execute query and get success/failure
        $ret = $stmt->execute();
        // Get if there is a chapter
        $newchapter = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ( $ret && $newchapter ) {
          // Set exhibit variables
          $pretitle = "Edit";
          $posttitle = "Chapter";
          $class = "edit-outline";
          // Get chapter data
          $chapter = $newchapter;
        } else { $chapter["id"] = null; }
      } catch (\Exception $e) { $chapter["id"] = null; }
      // Get published chapter list - except current
      try {
        $stmt = $db->prepare("SELECT * FROM `chapters` WHERE `id` NOT LIKE :id");
        $stmt->bindParam(":id", $chapter["id"], \PDO::PARAM_INT);
        $stmt->execute();
        $chapters = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      } catch (\Exception $e) { $chapters = []; }
    } else {
      $class = "plus-outline";
      $posttitle = "Chapter";
      // Get published chapter list
      try {
        $stmt = $db->prepare("SELECT * FROM `chapters`");
        $stmt->execute();
        $chapters = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      } catch (\Exception $e) { $chapters = []; }
    }
    // Get book list
    try {
      $stmt = $db->prepare("SELECT * FROM `books`");
      $stmt->execute();
      $books = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } catch (\Exception $e) { $books = []; }
  } else {
    // Parse BOOKs info
    if ( isset( $book["id"] ) ) {
      // Get book ID
      $book["id"] = (int) $_GET["id"];
      try {
        // Prepare book-retrieving statement
        $stmt = $db->prepare("SELECT * FROM `books` WHERE `id` = :id");
        $stmt->bindValue(":id", $book["id"], \PDO::PARAM_INT);
        // Execute query and get success/failure
        $ret = $stmt->execute();
        // Get if there is a book
        $newbook = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ( $ret && $newbook ) {
          // Set exhibit variables
          $pretitle = "Edit";
          $class = "edit";
          // Get book data
          $book = $newbook;
        } else { $book["id"] = null; }
      } catch (\Exception $e) { $book["id"] = null; }
    }
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
          <span><?php echo $pretitle . " " . $posttitle; ?></span>
        </span>
      </h2>

      <input type="text" class="is-hidden" id="id" value="<?php echo $chapter["id"] ? $chapter["id"] : $book["id"]; ?>">
      <input type="text" class="is-hidden" id="target" value="<?php echo $target; ?>">

      <div class="field">
        <div class="control has-icons-left">
          <input type="text" class="input is-large" id="title" placeholder="<?php echo $posttitle; ?> title" value="<?php echo $chapter["title"] ? $chapter["title"] : $book["name"]; ?>" required<?php echo ( $target == "chapter" && count($books) <=  0) ? " disabled" : ""; ?>>
          <span class="icon is-large is-left">
            <i class="mdi mdi-format-header-pound mdi-36px"></i>
          </span>
        </div>
      </div>

      <?php if ( $target == "chapter" ) { ?>
      <div class="field">
        <div class="control is-expanded has-icons-left">
          <div class="select is-fullwidth">
            <select id="book"<?php echo ( $target == "chapter" && count($books) <=  0) ? " disabled" : ""; ?>>
            <?php if ( count($books) > 0 ) { ?>
              <option value="" selected disabled>Select a book...</option>
            <?php foreach ($books as $b) { ?>
              <option value="<?php echo $b["id"] ?>"><?php echo $b["name"] ?></option>
            <?php } } else { ?>
              <option value="" disabled>No books available...</option>
            <?php } ?>
            </select>
          </div>
          <div class="icon is-left">
            <i class="mdi mdi-book"></i>
          </div>
        </div>
      </div>

      <div class="field">
        <div class="control">
          <textarea class="textarea has-fixed-size" id="body" placeholder="The body of the page" required<?php echo ( $target == "chapter" && count($books) <=  0) ? " disabled" : ""; ?>><?php echo $chapter["body"]; ?></textarea>
        </div>
      </div>

      <div class="columns">
        <div class="column">
          <div class="field">
            <div class="control is-expanded has-icons-left">
              <div class="select is-fullwidth">
                <select id="previous">
                <?php if ( count( $chapters ) > 0 ) { ?>
                  <option value="" selected disabled>Select chapter as previous...</option>
                <?php foreach ($chapters as $c) { ?>
                  <option value="<?php echo $c["id"]; ?>"><?php echo $c["title"]; ?></option>
                <?php } } else { ?>
                  <option value="" selected disabled>No other chapters...</option>
                <?php } ?>
                </select>
              </div>
              <div class="icon is-left">
                <i class="mdi mdi-book-arrow-left-outline"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="field">
            <div class="control is-expanded has-icons-left">
              <div class="select is-fullwidth">
                <select id="next">
                <?php if ( count( $chapters ) > 0 ) { ?>
                  <option value="" selected disabled>Select chapter as next...</option>
                <?php foreach ($chapters as $c) { ?>
                  <option value="<?php echo $c["id"]; ?>"><?php echo $c["title"]; ?></option>
                <?php } } else { ?>
                  <option value="" selected disabled>No other chapters...</option>
                <?php } ?>
                </select>
              </div>
              <div class="icon is-left">
                <i class="mdi mdi-book-arrow-right-outline"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>

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
