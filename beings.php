<?php
/**
 * To which of the five group of pages this one pertains.
 * @var string
 */
/**
 * If this page has a dedicated script file, what is its name without the ".js".
 * @var string
*/
$script = "beings";
$group = "beings";
require_once "header.php";

// Retrieve starting page
if ( isset( $_GET["page"] ) ) {
  $page = $_GET["page"];
} else {
  $page = "animals";
}

// Retrieve list of creatures
// Animals
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
                          `animals`.`feeding`,
                          `animals`.`size_type`,
                          `animals`.`size_unit`,
                          `animals`.`size_min`,
                          `animals`.`size_max`,
                          `animals`.`weight_unit`,
                          `animals`.`weight_min`,
                          `animals`.`weight_max`,
                          `animals`.`habitat`,
                          `animals`.`home_plane`,
                          `animals`.`iucn`,
                          `animals`.`domestic`,
                          `animals`.`notes`,
                          GET_EXERPT(`animals`.`body`) AS `exerpt`,
                          CONCAT_WS(',', `animals`.`title`, `animals`.`domain`, `animals`.`kingdom`, `animals`.`phylum`, `animals`.`class`, `animals`.`order`, `animals`.`suborder`, `animals`.`family`, `animals`.`subfamily`, `animals`.`genus`, `animals`.`species`, `animals`.`subspecies`, `animals`.`notes`) AS `search_terms`
                        FROM
                          `animals`, `users_profiles`
                        WHERE
                          `animals`.`author` LIKE `users_profiles`.`id`
                        ORDER BY
                          `animals`.`published` ASC");
  $stmt->execute();
  $animals = $stmt->fetchAll(\PDO::FETCH_ASSOC);
} catch (\Exception $e) { $animals = []; }
// Plants
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
                          `plants`.`feeding`,
                          `plants`.`size_type`,
                          `plants`.`size_unit`,
                          `plants`.`size_min`,
                          `plants`.`size_max`,
                          `plants`.`weight_unit`,
                          `plants`.`weight_min`,
                          `plants`.`weight_max`,
                          `plants`.`habitat`,
                          `plants`.`home_plane`,
                          `plants`.`iucn`,
                          `plants`.`domestic`,
                          `plants`.`notes`,
                          GET_EXERPT(`animals`.`body`) AS `exerpt`,
                          CONCAT_WS(',', `plants`.`title`, `plants`.`domain`, `plants`.`kingdom`, `plants`.`clade`, `plants`.`order`, `plants`.`suborder`, `plants`.`family`, `plants`.`subfamily`, `plants`.`genus`, `plants`.`species`, `plants`.`subspecies`, `plants`.`habitat`, `plants`.`home_plane`, `plants`.`notes`) AS `search_terms`
                        FROM
                          `plants`, `users_profiles`
                        WHERE
                          `plants`.`author` LIKE `users_profiles`.`id`
                        ORDER BY
                          `plants`.`published` ASC");
  $stmt->execute();
  $plants = $stmt->fetchAll(\PDO::FETCH_ASSOC);
} catch (\Exception $e) { $plants = []; }
// Monsters
try {
  // FIXME: This query is VERY broken! XD
  $stmt = $db->prepare("SELECT
                          `monsters`.`id`,
                          `monsters`.`author` AS `author_id`,
                          CONCAT(`users_profiles`.`first_name`, ' ', `users_profiles`.`last_name`) AS `author`,
                          `monsters`.`published`,
                          `monsters`.`edited`,
                          `monsters`.`title`,
                          `monsters`.`size_type`,
                          `monsters`.`size_unit`,
                          `monsters`.`size_min`,
                          `monsters`.`size_max`,
                          `monsters`.`weight_unit`,
                          `monsters`.`weight_min`,
                          `monsters`.`weight_max`,
                          `monsters`.`habitat`,
                          `monsters`.`home_plane`,
                          `monsters`.`npc`,
                          `monsters`.`sidekick`,
                          `monsters`.`notes`,
                          `monsters`.`body`,
                          GET_EXERPT(`animals`.`body`) AS `exerpt`,
                          SUM( COUNT(`stat_blocks_35e`.`id`) + COUNT(`stat_blocks_5e`.`id`) ) AS `block_count`,
                          CONCAT_WS(',', `monsters`.`title`, `monsters`.`habitat`, `monsters`.`home_plane`, `monsters`.`notes`) AS `search_terms`
                        FROM
                          `monsters`
                        LEFT JOIN `users_profiles` ON `users_profiles`.`id` LIKE `monsters`.`author`
                        LEFT JOIN `stat_blocks_35e` ON `stat_blocks_35e`.`for` LIKE `monsters`.`id`
                        GROUP BY `stat_blocks_35e`.`for`, `monsters`.`id`
                        LEFT JOIN `stat_blocks_5e` ON `stat_blocks_5e`.`for` LIKE `monsters`.`id`
                        GROUP BY `stat_blocks_5e`.`for`, `monsters`.`id`
                        ORDER BY
                          `monsters`.`published` ASC");
  $stmt->execute();
  $monsters = $stmt->fetchAll(\PDO::FETCH_ASSOC);
} catch (\Exception $e) { $monsters = []; }
?>

<main class="section">
  <div class="container">
    <div class="box">
      <div class="tabs is-centered">
        <ul>
          <li<?php if ( $page == "animals" ) { ?> class="is-active"<?php } ?>><a id="animals">Animals</a></li>
          <li<?php if ( $page == "plants" ) { ?> class="is-active"<?php } ?>><a id="plants">Plants</a></li>
          <li<?php if ( $page == "monsters" ) { ?> class="is-active"<?php } ?>><a id="monsters">Monsters</a></li>
        </ul>
      </div>

      <div<?php if ( $page != "animals" ) { ?> class="is-hidden"<?php } ?> id="title-animals">
        <h1 class="title is-3">
          <span>Animals</span>
        </h1>
        <p class="subtitle is-5">A list of current homebrewed animals</p>
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
        <div class="field">
          <div class="control is-expanded">
            <input type="text" class="input" id="search-animals" placeholder="Enter search terms...">
          </div>
        </div>
      </div>

      <div<?php if ( $page != "plants" ) { ?> class="is-hidden"<?php } ?> id="title-plants">
        <h1 class="title is-3">
          <span>Plants</span>
        </h1>
        <p class="subtitle is-5">A list of current homebrewed plants</p>
        <?php if ( $auth->isLoggedIn() ) { ?>
        <div class="field">
          <div class="control is-expanded">
            <a class="button is-success is-fullwidth mt-4" href="plants.php?action=create">
              <span class="icon-text">
                <span class="icon">
                  <i class="mdi mdi-leaf mdi-18px"></i>
                </span>
                <span>Create Plant</span>
              </span>
            </a>
          </div>
        </div>
        <?php } ?>
      </div>

      <div<?php if ( $page != "monsters" ) { ?> class="is-hidden"<?php } ?> id="title-monsters">
        <h1 class="title is-3">
          <span>Monsters</span>
        </h1>
        <p class="subtitle is-5">A list of current monsters and creatures with associated stat blocks</p>
        <?php if ( $auth->isLoggedIn() ) { ?>
        <div class="field">
          <div class="control is-expanded">
            <a class="button is-success is-fullwidth mt-4" href="monsters.php?action=create">
              <span class="icon-text">
                <span class="icon">
                  <i class="mdi mdi-ghost mdi-18px"></i>
                </span>
                <span>Create Animal</span>
              </span>
            </a>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>

    <div<?php if ( $page != "animals" ) { ?> class="is-hidden"<?php } ?> id="tab-animals">
      <?php if ( count( $animals ) > 0 ) {
      $i = 0;
      $len = count( $animals );
      foreach ($animals as $a) {
        $i++;
      ?>
      <?php if ( ($i % 3) == 1 ) { ?>
      <div class="columns">
      <?php } ?>
        <div class="column is-4 animal" data-search-terms="<?php echo $a["search_terms"]; ?>">
          <div class="card">
            <div class="card-content">
              <!-- Chapter header -->
              <div class="media">
                <div class="media-content">
                  <p class="title is-4">
                    <a href="animal.php?id=<?php echo $a["id"]; ?>">
                      <?php echo $a["title"]; ?>
                    </a>
                  </p>
                  <p class="subtitle is-6">
                    <?php if ( $a["genus"] != "" && $a["species"] != "" ) { ?>
                    <em><?php echo $a["genus"][0] . ". " . $a["species"]; ?><?php echo ($a["subspecies"] != "") ? " " . $a["subspecies"] : ""; ?></em>
                    &bull;
                    <?php } ?>
                    By <a href="profile.php?id=<?php echo $a["author_id"]; ?>"><?php echo $a["author"] != " " ? $a["author"] : "User #" . $a["author_id"]; ?></a>
                  </p>
                </div>
              </div>
              <div class="content">
                <?php echo $md->text( $a["exerpt"] ); ?>
              </div>
            </div>
          </div>
        </div>
      <?php if ( ($i % 3) == 0 || $i == $len ) { ?>
      </div>
      <?php } ?>
      <?php } } else { ?>
        <div class="box">
          <p class="has-text-centered">No animals found...</p>
        </div>
      <?php } ?>
    </div>

    <div<?php if ( $page != "plants" ) { ?> class="is-hidden"<?php } ?> id="tab-plants">
      <?php if ( count( $plants ) > 0 ) {
      $i = 0;
      $len = count( $plants );
      foreach ($plants as $p) {
        $i++;
      ?>
      <?php if ( ($i % 3) == 1 ) { ?>
      <div class="columns">
      <?php } ?>
        <div class="column is-4 plant" data-search-terms="<?php echo $p["search_terms"]; ?>">
          <div class="card">
            <div class="card-content">
              <!-- Chapter header -->
              <div class="media">
                <div class="media-content">
                  <p class="title is-4">
                    <a href="plant.php?id=<?php echo $p["id"]; ?>">
                      <?php echo $p["title"]; ?>
                    </a>
                  </p>
                  <p class="subtitle is-6">
                    <?php if ( $p["genus"] != "" && $p["species"] != "" ) { ?>
                    <em><?php echo $p["genus"][0] . ". " . $p["species"]; ?><?php echo ($p["subspecies"] != "") ? " " . $a["subspecies"] : ""; ?></em>
                    &bull;
                    <?php } ?>
                    By <a href="profile.php?id=<?php echo $p["author_id"]; ?>"><?php echo $p["author"] != " " ? $p["author"] : "User #" . $p["author_id"]; ?></a>
                  </p>
                </div>
              </div>
              <div class="content">
                <?php echo $md->text( $p["exerpt"] ); ?>
              </div>
            </div>
          </div>
        </div>
      <?php if ( ($i % 3) == 0 || $i == $len ) { ?>
      </div>
      <?php } ?>
      <?php } } else { ?>
        <div class="box">
          <p class="has-text-centered">No plants found...</p>
        </div>
      <?php } ?>
    </div>

    <div<?php if ( $page != "monsters" ) { ?> class="is-hidden"<?php } ?> id="tab-monsters">
      <?php if ( count( $monsters ) > 0 ) {
      $i = 0;
      $len = count( $monsters );
      foreach ($monsters as $m) {
        $i++;
      ?>
      <?php if ( ($i % 3) == 1 ) { ?>
      <div class="columns">
      <?php } ?>
        <div class="column is-4 plant" data-search-terms="<?php echo $m["search_terms"]; ?>">
          <div class="card">
            <div class="card-content">
              <!-- Chapter header -->
              <div class="media">
                <div class="media-content">
                  <p class="title is-4">
                    <a href="monster.php?id=<?php echo $m["id"]; ?>">
                      <?php echo $m["title"]; ?>
                    </a>
                  </p>
                  <p class="subtitle is-6">
                    <?php if ( $m["genus"] != "" && $m["species"] != "" ) { ?>
                    <em><?php echo $m["genus"][0] . ". " . $m["species"]; ?><?php echo ($m["subspecies"] != "") ? " " . $m["subspecies"] : ""; ?></em>
                    &bull;
                    <?php } ?>
                    By <a href="profile.php?id=<?php echo $m["author_id"]; ?>"><?php echo $m["author"] != " " ? $m["author"] : "User #" . $m["author_id"]; ?></a>
                  </p>
                </div>
              </div>
              <div class="content">
                <?php echo $md->text( $m["exerpt"] ); ?>
              </div>
            </div>
          </div>
        </div>
      <?php if ( ($i % 3) == 0 || $i == $len ) { ?>
      </div>
      <?php } ?>
      <?php } } else { ?>
        <div class="box">
          <p class="has-text-centered">No monsters found...</p>
        </div>
      <?php } ?>
    </div>
  </div>
</main>

<?php
require_once "footer.php";
?>
