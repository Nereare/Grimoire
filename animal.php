<?php
/**
 * To which of the five group of pages this one pertains.
 * @var string
 */
$group = "beings";
require_once "header.php";

if ( isset( $_GET["id"] ) ) {
  // Retrieve animal ID, if set
  $animal["id"] = $_GET["id"];
  // Retrieve selected post
  try {
    $stmt = $db->prepare("SELECT
                            `animals`.`id`,
                            `animals`.`author` AS `author_id`,
                            CONCAT(`users_profiles`.`first_name`, ' ', `users_profiles`.`last_name`) AS `author`,
                            `animals`.`published`,
                            `animals`.`edited`,
                            `animals`.`title`,
                            `animals`.`domain`,
                            `animals`.`kingdom`,
                            `animals`.`phylum`,
                            `animals`.`class`,
                            `animals`.`order`,
                            `animals`.`suborder`,
                            `animals`.`family`,
                            `animals`.`subfamily`,
                            `animals`.`genus`,
                            `animals`.`species`,
                            `animals`.`subspecies`,
                            CONCAT_WS('', `animals`.`domain`, `animals`.`kingdom`, `animals`.`phylum`, `animals`.`class`, `animals`.`order`, `animals`.`suborder`, `animals`.`family`, `animals`.`subfamily`, `animals`.`genus`, `animals`.`species`, `animals`.`subspecies`) AS `linnaean`,
                            `animals`.`feeding`,
                            `animals`.`size_type`,
                            `animals`.`size_unit`,
                            `animals`.`size_min`,
                            `animals`.`size_max`,
                            `animals`.`weight_unit`,
                            `animals`.`weight_min`,
                            `animals`.`weight_max`,
                            CONCAT_WS('', `animals`.`feeding`, `animals`.`size_type`, `animals`.`size_unit`, `animals`.`size_min`, `animals`.`size_max`, `animals`.`weight_unit`, `animals`.`weight_min`, `animals`.`weight_max`) AS `meta_line_1`,
                            `animals`.`habitat`,
                            `animals`.`home_plane`,
                            `iucn`.`name` AS `iucn`,
                            `animals`.`iucn` AS `iucn_abbr`,
                            `animals`.`domestic`,
                            CONCAT_WS('', `animals`.`habitat`, `animals`.`home_plane`, `animals`.`iucn`, `animals`.`domestic`) AS `meta_line_2`,
                            `animals`.`notes`,
                            `animals`.`body`
                          FROM
                            `animals`, `users_profiles`, `iucn`
                          WHERE
                            `animals`.`author` LIKE `users_profiles`.`id` AND
                            `animals`.`iucn` LIKE `iucn`.`abbr` AND
                            `animals`.`id` LIKE :id");
    $stmt->bindParam(":id", $animal["id"], \PDO::PARAM_INT);
    $stmt->execute();
    $animal = $stmt->fetch(\PDO::FETCH_ASSOC);
  } catch (\Exception $e) { $animal = false; }
}
?>

<main class="section">
  <div class="container">
    <?php if ( isset( $animal ) && $animal ) { ?>
    <div class="box">
      <h1 class="title is-3">
        <a class="button" href="beings.php?page=animals">
          <span class="icon">
            <i class="mdi mdi-arrow-left mdi-24px"></i>
          </span>
        </a>
        <?php if ( $auth->isLoggedIn() && $auth->getUserID() == $animal["author_id"] ) { ?>
        <a class="button" href="animals.php?action=edit&id=<?php echo $animal["id"]; ?>">
          <span class="icon">
            <i class="mdi mdi-pencil mdi-24px"></i>
          </span>
        </a>
        <?php } ?>
        <?php echo $animal["title"]; ?>
      </h1>
      <?php if ( $animal["genus"] != "" && $animal["species"] != "" ) { ?>
      <p class="subtitle is-5">
        <?php
        echo "<em>" . $animal["genus"] . " " . $animal["species"];
        if ( $animal["subspecies"] != "" ) { echo " " . $animal["subspecies"]; }
        echo "</em>";
        ?>
      </p>
      <?php } ?>
      <nav class="breadcrumb is-centered has-bullet-separator mb-0" aria-label="breadcrumbs">
        <ul>
          <li><a href="profile.php?id=<?php echo $animal["author_id"]; ?>">By <?php echo $animal["author"] != " " ? $animal["author"] : "User #" . $animal["author_id"]; ?></a></li>
          <li class="is-active"><a>Publised <?php echo date_format( date_create( $animal["published"] ),"D, M j Y"); ?></a></li>
          <?php if ( $animal["edited"] ) { ?>
          <li class="is-active"><a>Last edited <?php echo date_format( date_create( $animal["edited"] ),"D, M j Y"); ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php if ( $animal["linnaean"] != "" ) { ?>
      <nav class="breadcrumb is-centered is-small has-bullet-separator mb-0" aria-label="breadcrumbs">
        <ul>
          <?php if ( $animal["domain"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $animal["domain"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $animal["kingdom"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $animal["kingdom"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $animal["phylum"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $animal["phylum"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $animal["class"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $animal["class"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $animal["order"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $animal["order"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $animal["suborder"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $animal["suborder"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $animal["family"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $animal["family"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $animal["subfamily"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $animal["subfamily"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $animal["genus"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $animal["genus"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $animal["species"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $animal["species"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $animal["subspecies"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $animal["subspecies"]; ?></em></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } ?>
      <?php if ( $animal["meta_line_1"] != "" ) { ?>
      <nav class="breadcrumb is-centered is-small has-bullet-separator mb-0" aria-label="breadcrumbs">
        <ul>
          <?php if ( $animal["feeding"] != "" ) { ?>
          <li class="is-active"><a><?php echo ucfirst( $animal["feeding"] ); ?></a></li>
          <?php } ?>
          <?php if ( $animal["size_type"] != "" && $animal["size_unit"] != "" && $animal["size_min"] != "" && $animal["size_max"] != "" ) { ?>
          <li class="is-active"><a><?php echo $animal["size_min"] . "&mdash;" . $animal["size_max"] . $animal["size_unit"]; ?> (<?php echo $animal["size_type"]; ?>)</a></li>
          <?php } ?>
          <?php if ( $animal["weight_unit"] != "" && $animal["weight_min"] != "" && $animal["weight_max"] != "" ) { ?>
          <li class="is-active"><a><?php echo $animal["weight_min"] . "&mdash;" . $animal["weight_max"] . $animal["weight_unit"]; ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } ?>
      <?php if ( $animal["meta_line_2"] != "" ) { ?>
      <nav class="breadcrumb is-centered is-small has-bullet-separator<?php echo $animal["notes"] != "" ? " mb-0" : ""; ?>" aria-label="breadcrumbs">
        <ul>
          <?php if ( $animal["habitat"] != "" ) { ?>
          <li class="is-active"><a><?php echo $animal["habitat"]; ?></a></li>
          <?php } ?>
          <?php if ( $animal["home_plane"] != "" ) { ?>
          <li class="is-active"><a><?php echo $animal["home_plane"]; ?></a></li>
          <?php } ?>
          <?php if ( $animal["iucn"] != "" ) { ?>
          <li><a href="https://en.wikipedia.org/wiki/IUCN_Red_List#Categories"><?php echo $animal["iucn"]; ?> (IUCN v3.1)</a></li>
          <?php } ?>
          <?php if ( $animal["domestic"] != "" ) { ?>
          <li class="is-active"><a><?php echo $animal["domestic"] ? "Domesticated" : "Not Domesticated"; ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } ?>
      <?php if ( $animal["notes"] != "" ) { ?>
      <nav class="breadcrumb is-centered is-small has-bullet-separator" aria-label="breadcrumbs">
        <ul>
          <?php foreach (explode(",", $animal["notes"]) as $n) { ?>
          <li class="is-active"><a><?php echo $n; ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } ?>
      <div class="content">
        <?php echo $md->text( str_replace("<!-- Read More -->" . PHP_EOL . PHP_EOL, "", $animal["body"] ) ); ?>
      </div>
    </div>
    <?php } else { ?>
    <div class="box">
      <p>There is no animal ID set...</p>
      <?php if ( $auth->isLoggedIn() ) { ?>
      <div class="field">
        <div class="control is-expanded">
          <a class="button is-success is-fullwidth mt-4" href="animals.php?action=create">
            <span class="icon-text">
              <span class="icon">
                <i class="mdi mdi-rodent mdi-18px"></i>
              </span>
              <span>Create Animal</span>
            </span>
          </a>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
  </div>
</main>

<?php
require_once "footer.php";
?>
