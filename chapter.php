<?php
/**
 * To which of the five group of pages this one pertains.
 * @var string
 */
$group = "home";
require_once "header.php";

if ( isset( $_GET["id"] ) ) {
  // Retrieve post ID, if set
  $chapter["id"] = $_GET["id"];
  // Retrieve selected post
  try {
    $stmt = $db->prepare("SELECT
                            `chapters`.`id`,
                            `chapters`.`published`,
                            `chapters`.`edited`,
                            `chapters`.`title`,
                            `chapters`.`body`,
                            `chapters`.`previous`,
                            `chapters`.`next`,
                            CONCAT(`users_profiles`.`first_name`, ' ', `users_profiles`.`last_name`) AS `author`,
                            `chapters`.`author` AS `author_id`,
                            `books`.`name` AS `book`,
                            `chapters`.`book` AS `book_id`
                          FROM
                            `chapters`,
                            `books`,
                            `users_profiles`
                          WHERE
                            `chapters`.`book` LIKE `books`.`id` AND
                            `chapters`.`author` LIKE `users_profiles`.`id` AND
                            `chapters`.`id` LIKE :id");
    $stmt->bindParam(":id", $chapter["id"], \PDO::PARAM_INT);
    $stmt->execute();
    $chapter = $stmt->fetch(\PDO::FETCH_ASSOC);
  } catch (\Exception $e) { $chapter = false; }
} elseif ( isset( $_GET["book"] ) ) {
  // Get book ID
  $book["id"] = (int) $_GET["book"];
  // Retrieve book name
  try {
    $stmt = $db->prepare("SELECT `name` FROM `books` WHERE `id` LIKE :id");
    $stmt->bindParam(":id", $book["id"], \PDO::PARAM_INT);
    $stmt->execute();
    $book["name"] = $stmt->fetch(\PDO::FETCH_ASSOC)["name"];
  } catch (\Exception $e) { $book["name"] = "<Unknown Book>"; }
  // Retrieve chapters of a given book
  try {
    $stmt = $db->prepare("SELECT
                            `chapters`.`id`,
                            `chapters`.`published`,
                            `chapters`.`edited`,
                            `chapters`.`title`,
                            GET_EXERPT(`chapters`.`body`) AS `exerpt`,
                            `chapters`.`previous`,
                            `chapters`.`next`,
                            `chapters`.`author` AS `author_id`,
                            `chapters`.`book` AS `book_id`,
                            CONCAT(`users_profiles`.`first_name`, ' ', `users_profiles`.`last_name`) AS `author`
                          FROM
                            `chapters`,
                            `users_profiles`
                          WHERE
                            `chapters`.`author` LIKE `users_profiles`.`id` AND
                            `chapters`.`book` LIKE :book
                          ORDER BY
                            `chapters`.`published` ASC");
    $stmt->bindParam(":book", $book["id"], \PDO::PARAM_INT);
    $stmt->execute();
    $chapters = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  } catch (\Exception $e) { $chapters = false; }
} else {
  // Retrieve books
  try {
    $stmt = $db->prepare("SELECT
                            `books`.`id`,
                            `books`.`name`,
                            COUNT(`chapters`.`id`) AS `chapter_count`
                          FROM
                            `books`
                          LEFT JOIN `chapters` ON `books`.`id` = `chapters`.`book`
                          GROUP BY `books`.`id`, `chapters`.`book`;");
    $stmt->execute();
    $books = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  } catch (\Exception $e) { $books = false; }
}
?>

<main class="section">
  <div class="container">
    <?php if ( isset( $chapter ) && $chapter ) { ?>
    <div class="box">
      <h1 class="title is-3">
        <a class="button" href="chapter.php?book=<?php echo $chapter["book_id"]; ?>">
          <span class="icon">
            <i class="mdi mdi-arrow-left mdi-24px"></i>
          </span>
        </a>
        <?php if ( $auth->isLoggedIn() && $auth->getUserID() == $chapter["author_id"] ) { ?>
        <a class="button" href="chapters.php?action=edit&target=chapter&id=<?php echo $chapter["id"]; ?>">
          <span class="icon">
            <i class="mdi mdi-book-edit-outline mdi-24px"></i>
          </span>
        </a>
        <?php } ?>
        <?php echo $chapter["title"]; ?>
      </h1>
      <nav class="breadcrumb is-centered has-bullet-separator" aria-label="breadcrumbs">
        <ul>
          <li class="is-active"><a>By <?php echo $chapter["author"] != " " ? $chapter["author"] : "User #" . $chapter["author_id"]; ?></a></li>
          <li class="is-active"><a>Publised <?php echo date_format( date_create( $chapter["published"] ),"D, M j Y"); ?></a></li>
          <?php if ( $chapter["edited"] ) { ?>
          <li class="is-active"><a>Last edited <?php echo date_format( date_create( $chapter["edited"] ),"D, M j Y"); ?></a></li>
          <?php } ?>
          <li><a href="chapter.php?book=<?php echo $chapter["book_id"]; ?>"><?php echo $chapter["book"]; ?></a></li>
        </ul>
      </nav>
      <div class="content">
        <?php echo $md->text( str_replace("<!-- Read More -->" . PHP_EOL . PHP_EOL, "", $chapter["body"] ) ); ?>
      </div>
      <div class="columns">
        <div class="column">
        <?php if ( $chapter["previous"] ) { ?>
          <a class="button is-fullwidth is-primary" href="chapter.php?id=<?php echo $chapter["previous"]; ?>">Previous chapter...</a>
        <?php } else { ?>
          <a class="button is-fullwidth is-primary" disabled>No previous chapter</a>
        <?php } ?>
        </div>
        <div class="column">
        <?php if ( $chapter["next"] ) { ?>
          <a class="button is-fullwidth is-primary" href="chapter.php?id=<?php echo $chapter["next"]; ?>">Next chapter...</a>
        <?php } else { ?>
          <a class="button is-fullwidth is-primary" disabled>No next chapter</a>
        <?php } ?>
        </div>
      </div>
    </div>
    <?php } elseif ( isset( $book ) && $book && isset( $chapters ) && $chapters ) { ?>
    <div class="box">
      <h1 class="title is-3">
        <a class="button" href="chapter.php">
          <span class="icon">
            <i class="mdi mdi-arrow-left mdi-24px"></i>
          </span>
        </a>
        <?php if ( $auth->isLoggedIn() ) { ?>
        <a class="button" href="chapters.php?action=edit&target=book&id=<?php echo $book["id"]; ?>">
          <span class="icon">
            <i class="mdi mdi-book-edit mdi-24px"></i>
          </span>
        </a>
        <?php } ?>
        <span><?php echo $book["name"]; ?></span>
      </h1>
      <p class="subtitle is-5">Chapters from the book</p>
      <?php if ( $auth->isLoggedIn() ) { ?>
      <a class="button is-success is-fullwidth mt-4" href="chapters.php?action=create&target=chapter&book=<?php echo $book["id"]; ?>">
        <span class="icon-text">
          <span class="icon">
            <i class="mdi mdi-book-plus-outline mdi-18px"></i>
          </span>
          <span>Create Chapter</span>
        </span>
      </a>
      <?php } ?>
    </div>

    <!-- Chapter list -->
    <?php
    $i = 0;
    $len = count( $chapters );
    foreach ($chapters as $c) {
      $i++;
    ?>
    <?php if ( ($i % 2) == 1 ) { ?>
    <div class="columns">
    <?php } ?>
      <div class="column is-6">
        <div class="card">
          <div class="card-content">
            <!-- Chapter header -->
            <div class="media">
              <div class="media-content">
                <p class="title is-4">
                  <a href="chapter.php?id=<?php echo $c["id"]; ?>">
                    <?php echo $c["title"]; ?>
                  </a>
                </p>
                <p class="subtitle is-6">
                  By <a href="profile.php?id=<?php echo $c["author_id"]; ?>"><?php echo $c["author"] != " " ? $c["author"] : "User #" . $c["author_id"]; ?></a>
                  &bull;
                  <?php echo date_format( date_create( $c["published"] ),"D, M j Y"); ?>
                </p>
              </div>
            </div>
            <!-- Chapter exerpt -->
            <div class="content">
              <?php echo $md->text( $c["exerpt"] ); ?>
            </div>
          </div>
        </div>
      </div>
    <?php if ( ($i % 2) == 0 ) { ?>
    </div>
    <?php } ?>
    <?php } ?>
    <?php } elseif ( isset( $books ) && $books ) { ?>
    <div class="box">
      <h1 class="title is-3">Books</h1>
      <?php if ( $auth->isLoggedIn() ) { ?>
      <a class="button is-success is-fullwidth" href="chapters.php?action=create&target=book">
        <span class="icon-text">
          <span class="icon">
            <i class="mdi mdi-book-plus mdi-18px"></i>
          </span>
          <span>Create Book</span>
        </span>
      </a>
      <?php } ?>
    </div>

    <!-- Book list -->
    <?php
    $i = 0;
    $len = count( $books );
    foreach ($books as $b) {
      $i++;
    ?>
    <?php if ( ($i % 2) == 1 ) { ?>
    <div class="columns">
    <?php } ?>
      <div class="column is-6">
        <div class="card">
          <div class="card-content">
            <!-- Post header -->
            <div class="media">
              <div class="media-content">
                <p class="title is-4">
                  <a href="chapter.php?book=<?php echo $b["id"]; ?>">
                    <?php echo $b["name"]; ?>
                  </a>
                </p>
                <p class="subtitle is-6">
                  Containing <?php echo $b["chapter_count"]; ?> chapter<?php echo ((int) $b["chapter_count"]) > 1 ? "s" : ""; ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php if ( ($i % 2) == 0 ) { ?>
    </div>
    <?php } ?>
    <?php } ?>
    <?php } else { ?>
    <div class="box">
      <p>There are no books or chapters...</p>
      <?php if ( $auth->isLoggedIn() ) { ?>
      <a class="button is-success is-fullwidth mt-4" href="chapters.php?action=create&target=book">
        <span class="icon-text">
          <span class="icon">
            <i class="mdi mdi-book-plus mdi-18px"></i>
          </span>
          <span>Create First Book</span>
        </span>
      </a>
      <?php } ?>
    </div>
    <?php } ?>
  </div>
</main>

<?php
require_once "footer.php";
?>
