<?php
/**
 * To which of the five group of pages this one pertains.
 * @var string
 */
$group = "beings";
require_once "header.php";

if ( isset( $_GET["id"] ) ) {
  // Retrieve plant ID, if set
  $plant["id"] = $_GET["id"];
  // Retrieve selected post
  try {
    $stmt = $db->prepare("SELECT
                            `plants`.`id`,
                            `plants`.`author` AS `author_id`,
                            CONCAT(`users_profiles`.`first_name`, ' ', `users_profiles`.`last_name`) AS `author`,
                            `plants`.`published`,
                            `plants`.`edited`,
                            `plants`.`title`,
                            `plants`.`domain`,
                            `plants`.`kingdom`,
                            `plants`.`clade`,
                            `plants`.`order`,
                            `plants`.`suborder`,
                            `plants`.`family`,
                            `plants`.`subfamily`,
                            `plants`.`genus`,
                            `plants`.`species`,
                            `plants`.`subspecies`,
                            CONCAT_WS('', `plants`.`domain`, `plants`.`kingdom`, `plants`.`clade`, `plants`.`order`, `plants`.`suborder`, `plants`.`family`, `plants`.`subfamily`, `plants`.`genus`, `plants`.`species`, `plants`.`subspecies`) AS `linnaean`,
                            `plants`.`feeding`,
                            `plants`.`size_type`,
                            `plants`.`size_unit`,
                            `plants`.`size_min`,
                            `plants`.`size_max`,
                            `plants`.`weight_unit`,
                            `plants`.`weight_min`,
                            `plants`.`weight_max`,
                            CONCAT_WS('', `plants`.`feeding`, `plants`.`size_type`, `plants`.`size_unit`, `plants`.`size_min`, `plants`.`size_max`, `plants`.`weight_unit`, `plants`.`weight_min`, `plants`.`weight_max`) AS `meta_line_1`,
                            `plants`.`habitat`,
                            `plants`.`home_plane`,
                            `iucn`.`name` AS `iucn`,
                            `plants`.`iucn` AS `iucn_abbr`,
                            `plants`.`domestic`,
                            CONCAT_WS('', `plants`.`habitat`, `plants`.`home_plane`, `plants`.`iucn`, `plants`.`domestic`) AS `meta_line_2`,
                            `plants`.`notes`,
                            `plants`.`body`
                          FROM
                            `plants`, `users_profiles`, `iucn`
                          WHERE
                            `plants`.`author` LIKE `users_profiles`.`id` AND
                            `plants`.`iucn` LIKE `iucn`.`abbr` AND
                            `plants`.`id` LIKE :id");
    $stmt->bindParam(":id", $plant["id"], \PDO::PARAM_INT);
    $stmt->execute();
    $plant = $stmt->fetch(\PDO::FETCH_ASSOC);
  } catch (\Exception $e) { $plant = false; }
}
?>

<main class="section">
  <div class="container">
    <?php if ( isset( $plant ) && $plant ) { ?>
    <div class="box">
      <h1 class="title is-3">
        <a class="button" href="beings.php?page=plants">
          <span class="icon">
            <i class="mdi mdi-arrow-left mdi-24px"></i>
          </span>
        </a>
        <?php if ( $auth->isLoggedIn() && $auth->getUserID() == $plant["author_id"] ) { ?>
        <a class="button" href="plants.php?action=edit&id=<?php echo $plant["id"]; ?>">
          <span class="icon">
            <i class="mdi mdi-pencil mdi-24px"></i>
          </span>
        </a>
        <?php } ?>
        <?php echo $plant["title"]; ?>
      </h1>
      <?php if ( $plant["genus"] != "" && $plant["species"] != "" ) { ?>
      <p class="subtitle is-5">
        <?php
        echo "<em>" . $plant["genus"] . " " . $plant["species"];
        if ( $plant["subspecies"] != "" ) { echo " " . $plant["subspecies"]; }
        echo "</em>";
        ?>
      </p>
      <?php } ?>
      <nav class="breadcrumb is-centered has-bullet-separator mb-0" aria-label="breadcrumbs">
        <ul>
          <li><a href="profile.php?id=<?php echo $plant["author_id"]; ?>">By <?php echo $plant["author"] != " " ? $plant["author"] : "User #" . $plant["author_id"]; ?></a></li>
          <li class="is-active"><a>Publised <?php echo date_format( date_create( $plant["published"] ),"D, M j Y"); ?></a></li>
          <?php if ( $plant["edited"] ) { ?>
          <li class="is-active"><a>Last edited <?php echo date_format( date_create( $plant["edited"] ),"D, M j Y"); ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php if ( $plant["linnaean"] != "" ) { ?>
      <nav class="breadcrumb is-centered is-small has-bullet-separator mb-0" aria-label="breadcrumbs">
        <ul>
          <?php if ( $plant["domain"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $plant["domain"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $plant["kingdom"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $plant["kingdom"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $plant["clade"] != "" ) { foreach (explode(",", $plant["clade"]) as $c) { ?>
          <li class="is-active"><a><em><?php echo $c; ?></em></a></li>
          <?php } } ?>
          <?php if ( $plant["order"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $plant["order"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $plant["suborder"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $plant["suborder"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $plant["family"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $plant["family"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $plant["subfamily"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $plant["subfamily"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $plant["genus"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $plant["genus"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $plant["species"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $plant["species"]; ?></em></a></li>
          <?php } ?>
          <?php if ( $plant["subspecies"] != "" ) { ?>
          <li class="is-active"><a><em><?php echo $plant["subspecies"]; ?></em></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } ?>
      <?php if ( $plant["meta_line_1"] != "" ) { ?>
      <nav class="breadcrumb is-centered is-small has-bullet-separator mb-0" aria-label="breadcrumbs">
        <ul>
          <?php if ( $plant["feeding"] != "" ) { ?>
          <li class="is-active"><a><?php echo ucfirst( $plant["feeding"] ); ?></a></li>
          <?php } ?>
          <?php if ( $plant["size_type"] != "" && $plant["size_unit"] != "" && $plant["size_min"] != "" && $plant["size_max"] != "" ) { ?>
          <li class="is-active"><a><?php echo $plant["size_min"] . "&mdash;" . $plant["size_max"] . $plant["size_unit"]; ?> (<?php echo $plant["size_type"]; ?>)</a></li>
          <?php } ?>
          <?php if ( $plant["weight_unit"] != "" && $plant["weight_min"] != "" && $plant["weight_max"] != "" ) { ?>
          <li class="is-active"><a><?php echo $plant["weight_min"] . "&mdash;" . $plant["weight_max"] . $plant["weight_unit"]; ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } ?>
      <?php if ( $plant["meta_line_2"] != "" ) { ?>
      <nav class="breadcrumb is-centered is-small has-bullet-separator<?php echo $plant["notes"] != "" ? " mb-0" : ""; ?>" aria-label="breadcrumbs">
        <ul>
          <?php if ( $plant["habitat"] != "" ) { ?>
          <li class="is-active"><a><?php echo $plant["habitat"]; ?></a></li>
          <?php } ?>
          <?php if ( $plant["home_plane"] != "" ) { ?>
          <li class="is-active"><a><?php echo $plant["home_plane"]; ?></a></li>
          <?php } ?>
          <?php if ( $plant["iucn"] != "" ) { ?>
          <li><a href="https://en.wikipedia.org/wiki/IUCN_Red_List#Categories"><?php echo $plant["iucn"]; ?> (IUCN v3.1)</a></li>
          <?php } ?>
          <?php if ( $plant["domestic"] != "" ) { ?>
          <li class="is-active"><a><?php echo $plant["domestic"] ? "Domesticated" : "Not Domesticated"; ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } ?>
      <?php if ( $plant["notes"] != "" ) { ?>
      <nav class="breadcrumb is-centered is-small has-bullet-separator" aria-label="breadcrumbs">
        <ul>
          <?php foreach (explode(",", $plant["notes"]) as $n) { ?>
          <li class="is-active"><a><?php echo $n; ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } ?>
      <div class="content">
        <?php echo $md->text( str_replace("<!-- Read More -->" . PHP_EOL . PHP_EOL, "", $plant["body"] ) ); ?>
      </div>
    </div>
    <?php } else { ?>
    <div class="box">
      <p>There is no plant ID set...</p>
      <?php if ( $auth->isLoggedIn() ) { ?>
      <div class="field">
        <div class="control is-expanded">
          <a class="button is-success is-fullwidth mt-4" href="plants.php?action=create">
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
