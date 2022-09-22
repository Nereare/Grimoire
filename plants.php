<?php
/**
 * If this page has a dedicated script file, what is its name without the ".js".
 * @var string
 */
$script = "plants";
require_once "header.php";

if ( $auth->isLoggedIn() ) {
  if ( isset( $_GET["action"] ) ) {
    $action = $_GET["action"];
  } else {
    $action = null;
  }

  $pretitle              = "Create";
  $plant["id"]           = null;
  $plant["title"]        = null;
  $plant["domain"]       = null;
  $plant["kingdom"]      = null;
  $plant["clade"]        = null;
  $plant["order"]        = null;
  $plant["suborder"]     = null;
  $plant["family"]       = null;
  $plant["subfamily"]    = null;
  $plant["genus"]        = null;
  $plant["species"]      = null;
  $plant["subspecies"]   = null;
  $plant["feeding"]      = null;
  $plant["size_type"]    = null;
  $plant["size_unit"]    = null;
  $plant["size_min"]     = null;
  $plant["size_max"]     = null;
  $plant["weight_unit"]  = null;
  $plant["weight_min"]   = null;
  $plant["weight_max"]   = null;
  $plant["habitat"]      = null;
  $plant["home_plane"]   = null;
  $plant["iucn"]         = null;
  $plant["domestic"]     = null;
  $plant["notes"]        = null;
  $plant["body"]         = null;

  if ( $action == "edit" ) {
    if ( isset( $_GET["id"] ) ) {
      // Get page ID
      $plant["id"] = $_GET["id"];
      try {
        // Prepare page-retrieving statement
        $stmt = $db->prepare("SELECT * FROM `plants` WHERE `id` = :id");
        $stmt->bindValue(":id", $plant["id"], \PDO::PARAM_INT);
        // Execute query and get success/failure
        $ret = $stmt->execute();
        // Get if there is a page
        $newplant = $stmt->fetch(\PDO::FETCH_ASSOC);
      } catch (\Exception $e) { $plant["id"] = null; }
      if ( $ret && $newplant ) {
        // Set exhibit variables
        $pretitle = "Edit";
        // Get page data
        $plant = $newplant;
      } else {
        $plant["id"] = null;
      }
    }
  }

  // Fetch IUCN list
  try {
    $stmt = $db->prepare("SELECT * FROM `iucn`");
    $stmt->execute();
    $iucn = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  } catch (\Exception $e) { $iucn = []; }
?>

<main class="section">
  <div class="container">
    <div class="box">
      <h2 class="title is-2">
        <span class="text-icon">
          <span class="icon">
            <i class="mdi mdi-leaf"></i>
          </span>
          <span><?php echo $pretitle; ?> Animal</span>
        </span>
      </h2>

      <div class="field">
        <div class="control has-icons-left">
          <input type="text" class="input is-large" id="title" placeholder="Animal title" value="<?php echo $plant["title"]; ?>" required>
          <span class="icon is-large is-left">
            <i class="mdi mdi-format-header-pound mdi-36px"></i>
          </span>
        </div>
      </div>

      <input type="number" class="is-hidden" id="id" value="<?php echo $plant["id"]; ?>">

      <div class="columns">
        <div class="column">
          <div class="field">
            <p class="control has-icons-left">
              <input type="text" class="input" id="domain" placeholder="Domain" value="<?php echo $plant["domain"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-numeric-1-box"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input type="text" class="input" id="kingdom" placeholder="Kingdom" value="<?php echo $plant["kingdom"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-numeric-2-box"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input type="text" class="input" id="clade" data-type="tags" placeholder="Clade" value="<?php echo $plant["clade"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-numeric-3-box"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input type="text" class="input" id="order" placeholder="Order" value="<?php echo $plant["order"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-numeric-4-box"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input type="text" class="input" id="suborder" placeholder="Suborder" value="<?php echo $plant["suborder"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-plus-box"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input type="text" class="input" id="family" placeholder="Family" value="<?php echo $plant["family"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-numeric-5-box"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input type="text" class="input" id="subfamily" placeholder="Subfamily" value="<?php echo $plant["subfamily"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-plus-box"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input type="text" class="input" id="genus" placeholder="Genus" value="<?php echo $plant["genus"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-numeric-6-box"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input type="text" class="input" id="species" placeholder="Species" value="<?php echo $plant["species"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-numeric-7-box"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input type="text" class="input" id="subspecies" placeholder="Subspecies" value="<?php echo $plant["subspecies"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-numeric-8-box"></i>
              </span>
            </p>
          </div>
        </div>

        <div class="column">
          <div class="field">
            <div class="control has-icons-left">
              <div class="select is-fullwidth">
                <select id="feeding">
                  <option value=""<?php echo ($plant["feeding"] == null) ? " selected" : "" ?> disabled>Feeding habit...</option>
                  <option value="autotroph"<?php echo ($plant["feeding"] == "autotroph") ? " selected" : "" ?>>Autotroph</option>
                  <option value="heterotroph"<?php echo ($plant["feeding"] == "heterotroph") ? " selected" : "" ?>>Heterotroph</option>
                </select>
              </div>
              <span class="icon is-left">
                <i class="mdi mdi-food"></i>
              </span>
            </div>
          </div>

          <div class="field has-addons">
            <div class="control is-expanded has-icons-left">
              <input type="text" class="input" id="size_type" placeholder="Type" value="<?php echo $plant["size_type"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-ruler"></i>
              </span>
            </div>
            <div class="control">
              <input type="number" class="input" id="size_min" placeholder="Min" value="<?php echo $plant["size_min"]; ?>">
            </div>
            <div class="control">
              <button class="button is-static" tabindex="-1">&ndash;</button>
            </div>
            <div class="control">
              <input type="number" class="input" id="size_max" placeholder="Max" value="<?php echo $plant["size_max"]; ?>">
            </div>
            <div class="control">
              <input type="text" class="input" id="size_unit" placeholder="Unit" value="<?php echo $plant["size_unit"]; ?>">
            </div>
          </div>

          <div class="field has-addons">
            <div class="control is-expanded has-icons-left">
              <input type="number" class="input" id="weight_min" placeholder="Min" value="<?php echo $plant["weight_min"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-weight"></i>
              </span>
            </div>
            <div class="control">
              <button class="button is-static" tabindex="-1">&ndash;</button>
            </div>
            <div class="control">
              <input type="number" class="input" id="weight_max" placeholder="Max" value="<?php echo $plant["weight_max"]; ?>">
            </div>
            <div class="control">
              <input type="text" class="input" id="weight_unit" placeholder="Unit" value="<?php echo $plant["weight_unit"]; ?>">
            </div>
          </div>

          <div class="field">
            <div class="control is-expanded has-icons-left">
              <input type="text" class="input" id="habitat" placeholder="Habitat" value="<?php echo $plant["habitat"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-forest"></i>
              </span>
            </div>
          </div>

          <div class="field">
            <div class="control is-expanded has-icons-left">
              <input type="text" class="input" id="home_plane" placeholder="Home Plane" value="<?php echo $plant["home_plane"]; ?>">
              <span class="icon is-left">
                <i class="mdi mdi-earth"></i>
              </span>
            </div>
          </div>

          <div class="field">
            <div class="control is-expanded has-icons-left">
              <div class="select is-fullwidth">
                <select id="iucn">
                <?php if ( count($iucn) > 0 ) { ?>
                  <option value=""<?php echo $plant["iucn"] == null ? " selected" : ""; ?> disabled>Endangerment Level</option>
                <?php foreach ($iucn as $i) { ?>
                  <option value="<?php echo $i["abbr"]; ?>"<?php echo $plant["iucn"] == $i["abbr"] ? " selected" : ""; ?>><?php echo $i["name"]; ?></option>
                <?php } } else { ?>
                  <option value="DD" selected>No options available</option>
                <?php } ?>
                </select>
              </div>
              <span class="icon is-left">
                <i class="mdi mdi-skull"></i>
              </span>
            </div>
          </div>

          <div class="field">
            <div class="control is-expanded has-icons-left">
              <div class="select is-fullwidth">
                <select id="domestic">
                  <option value="true"<?php echo $plant["domestic"] ? " selected" : ""; ?>>Domesticated</option>
                  <option value="false"<?php echo $plant["domestic"] ? "" : " selected"; ?>>Wild</option>
                </select>
              </div>
              <span class="icon is-left">
                <i class="mdi mdi-dog"></i>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <div class="control is-expanded">
          <input type="text" class="input" id="notes" data-type="tags" placeholder="Comma-separated notes" value="<?php echo $plant["notes"]; ?>">
        </div>
      </div>

      <div class="field">
        <div class="control">
          <textarea class="textarea has-fixed-size" id="body" placeholder="The body of the page" required><?php echo $plant["body"]; ?></textarea>
        </div>
      </div>

      <div class="field">
        <div class="control is-expanded">
          <button class="button is-success is-fullwidth" id="do">
            <span class="text-icon">
              <span class="icon">
                <i class="mdi mdi-leaf"></i>
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
