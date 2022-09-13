<?php
/**
 * To which of the five group of pages this one pertains.
 * @var string
 */
$group = "home";
require_once "header.php";

if ( isset( $_GET["id"] ) ) {
  // Retrieve post ID, if set
  $id = $_GET["id"];
  // Retrieve selected post
  try {
    $stmt = $db->prepare("SELECT `posts`.`id`, `published`, `edited`, `title`, `tags`, `category`, `body`, `header`, CONCAT(`users_profiles`.`first_name`, ' ', `users_profiles`.`last_name`) AS `author`, `posts`.`author` AS `author_id` FROM `posts`, `users_profiles` WHERE `posts`.`author` LIKE `users_profiles`.`id` AND `posts`.`id` LIKE :id");
    $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
    $stmt->execute();
    $post = $stmt->fetch(\PDO::FETCH_ASSOC);
  } catch (\Exception $e) { $post = false; }
} elseif ( isset( $_GET["tag"] ) ) {
  // Retrieve posts' tag, if set
  $tag = $_GET["tag"];
  $tag_q = "%" . $tag . "%";
  // Retrieve posts with given tag
  try {
    $stmt = $db->prepare("SELECT `posts`.`id`, `published`, `edited`, `title`, `tags`, `category`, TRIM(GET_EXERPT(`body`)) AS `exerpt`, `header`, CONCAT(`users_profiles`.`first_name`, ' ', `users_profiles`.`last_name`) AS `author`, `posts`.`author` AS `author_id` FROM `posts`, `users_profiles` WHERE `posts`.`author` LIKE `users_profiles`.`id` AND `tags` LIKE :tag ORDER BY `published` DESC");
    $stmt->bindParam(":tag", $tag_q);
    $stmt->execute();
    $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  } catch (\Exception $e) { $posts = false; }
} elseif ( isset( $_GET["category"] ) ) {
  // Retrieve posts' category, if set
  $category = $_GET["category"];
  $category_q = "%" . $category . "%";
  // Retrieve posts with given category
  try {
    $stmt = $db->prepare("SELECT `posts`.`id`, `published`, `edited`, `title`, `tags`, `category`, TRIM(GET_EXERPT(`body`)) AS `exerpt`, `header`, CONCAT(`users_profiles`.`first_name`, ' ', `users_profiles`.`last_name`) AS `author`, `posts`.`author` AS `author_id` FROM `posts`, `users_profiles` WHERE `posts`.`author` LIKE `users_profiles`.`id` AND `category` LIKE :category ORDER BY `published` DESC");
    $stmt->bindParam(":category", $category_q);
    $stmt->execute();
    $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  } catch (\Exception $e) { $posts = false; }
} else {
  // Retrieve posts
  try {
    $stmt = $db->prepare("SELECT `posts`.`id`, `published`, `edited`, `title`, `tags`, `category`, TRIM(GET_EXERPT(`body`)) AS `exerpt`, `header`, CONCAT(`users_profiles`.`first_name`, ' ', `users_profiles`.`last_name`) AS `author`, `posts`.`author` AS `author_id` FROM `posts`, `users_profiles` WHERE `posts`.`author` = `users_profiles`.`id` ORDER BY `published` DESC");
    $stmt->execute();
    $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  } catch (\Exception $e) { $posts = false; }
}
?>

<main class="section">
  <div class="container">
    <?php if ( isset( $post ) && $post ) { ?>
    <div class="box">
      <h1 class="title is-3">
        <a class="button" href="post.php">
          <span class="icon">
            <i class="mdi mdi-arrow-left mdi-24px"></i>
          </span>
        </a>
        <?php if ( $auth->isLoggedIn() && $auth->getUserID() == $post["author_id"] ) { ?>
        <a class="button" href="posts.php?action=edit&id=<?php echo $post["id"]; ?>">
          <span class="icon">
            <i class="mdi mdi-file-edit mdi-24px"></i>
          </span>
        </a>
        <?php } ?>
        <?php echo $post["title"]; ?>
      </h1>
      <nav class="breadcrumb is-centered has-bullet-separator" aria-label="breadcrumbs">
        <ul>
          <li class="is-active"><a>By <?php echo $post["author"] != " " ? $post["author"] : "User #" . $post["author_id"]; ?></a></li>
          <li class="is-active"><a>Publised <?php echo date_format( date_create( $post["published"] ),"D, M j Y"); ?></a></li>
          <?php if ( $post["edited"] ) { ?>
          <li class="is-active"><a>Last edited <?php echo date_format( date_create( $post["edited"] ),"D, M j Y"); ?></a></li>
          <?php } ?>
          <?php if ( $post["category"] ) { ?>
          <li><a href="post.php?category=<?php echo urlencode( $post["category"] ); ?>"><?php echo $post["category"]; ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php if ( $post["tags"] ) { ?>
      <nav class="breadcrumb is-small is-centered" aria-label="breadcrumbs">
        <ul>
        <?php foreach (explode(",", $post["tags"]) as $t) { ?>
          <li><a href="post.php?tag=<?php echo urlencode(trim($t)); ?>"><?php echo trim($t); ?></a></li>
        <?php } ?>
        </ul>
      </nav>
      <?php } ?>
      <div class="content">
        <?php echo $md->text( str_replace("<!-- Read More -->" . PHP_EOL . PHP_EOL, "", $post["body"] ) ); ?>
      </div>
    </div>
    <?php } elseif ( $posts ) { ?>
    <div class="box">
      <h1 class="title is-3">Posts</h1>
      <?php if ( isset($tag) && $tag ) { ?>
      <p class="subtitle is-5">
        With the <code><?php echo $tag; ?></code> tag
      </p>
      <?php } elseif ( isset($category) && $category ) { ?>
      <p class="subtitle is-5">
        Under the <code><?php echo $category; ?></code> category
      </p>
      <?php } ?>
      <?php if ( $auth->isLoggedIn() ) { ?>
      <a class="button is-success is-fullwidth mt-4" href="posts.php">
        <span class="icon-text">
          <span class="icon">
            <i class="mdi mdi-file-plus mdi-18px"></i>
          </span>
          <span>Create Post</span>
        </span>
      </a>
      <?php } ?>
    </div>

    <!-- Post list -->
    <?php
    $i = 0;
    $len = count( $posts );
    foreach ($posts as $p) {
      $i++;
    ?>
    <?php if ( ($i % 2) == 1 ) { ?>
    <div class="columns">
    <?php } ?>
      <div class="column is-6">
        <div class="card">
          <div class="card-image">
            <figure class="image is-3by1">
              <?php if ( $p["header"] ) { ?>
              <img src="<?php echo $p["header"]; ?>">
              <?php } else { ?>
              <img src="https://picsum.photos/900/300">
              <?php } ?>
            </figure>
          </div>
          <div class="card-content">
            <!-- Post header -->
            <div class="media">
              <div class="media-content">
                <p class="title is-4">
                  <a href="post.php?id=<?php echo $p["id"]; ?>">
                    <?php echo $p["title"]; ?>
                  </a>
                </p>
                <p class="subtitle is-6">
                  By <?php echo $p["author"] != " " ? $p["author"] : "User #" . $p["author_id"]; ?>
                  &bull;
                  <?php echo date_format( date_create( $p["published"] ),"D, M j Y"); ?>
                </p>
              </div>
            </div>
            <!-- Post exerpt -->
            <div class="content">
              <?php echo $md->text( $p["exerpt"] ); ?>
            </div>
            <?php if ( $p["tags"] ) { ?>
            <!-- Post tags -->
            <nav class="breadcrumb is-small is-centered">
              <ul>
              <?php foreach (explode(",", $p["tags"]) as $t) { ?>
                <li><a href="post.php?tag=<?php echo urlencode(trim($t)); ?>"><?php echo trim($t); ?></a></li>
              <?php } ?>
              </ul>
            </nav>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php if ( ($i % 2) == 0 ) { ?>
    </div>
    <?php } ?>
    <?php } ?>

    <?php } else { ?>
    <div class="box">
      <p>There are no posts...</p>
      <?php if ( $auth->isLoggedIn() ) { ?>
      <a class="button is-success is-fullwidth mt-4" href="posts.php">
        <span class="icon-text">
          <span class="icon">
            <i class="mdi mdi-file-plus mdi-18px"></i>
          </span>
          <span>Create First Post</span>
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
