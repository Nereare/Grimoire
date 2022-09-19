<?php
/**
 * To which of the five group of pages this one pertains.
 * @var string
 */
$group = "home";
require_once "header.php";

// Retrieve Home contents
try {
  $stmt = $db->prepare("SELECT * FROM `pages` WHERE `name` LIKE \"Home\"");
  $stmt->execute();
  $home = $stmt->fetch(\PDO::FETCH_ASSOC);
  $profile = new \Nereare\Grimoire\Profile($db, $home["id"]);
} catch (\Exception $e) { $home = false; }
// Retrieve other pages
try {
  $stmt = $db->prepare("SELECT * FROM `pages` WHERE `name` NOT LIKE \"Home\"");
  $stmt->execute();
  $pages = $stmt->fetchAll(\PDO::FETCH_ASSOC);
} catch (\Exception $e) { $pages = false; }
?>

<main class="section">
  <div class="container">
    <div class="box">
      <div class="tabs is-centered">
        <ul>
          <li><a href="post.php">Posts</a></li>
          <li><a href="chapter.php">Books</a></li>
          <?php if ( $auth->isLoggedIn() ) { ?>
          <li><a href="pages.php?action=create">Create Page</a></li>
          <?php } ?>
          <?php if ( $pages ) { ?>
          <?php foreach ($pages as $p) { ?>
          <li><a href="page.php?id=<?php echo $p["id"]; ?>"><?php echo $p["name"]; ?></a></li>
          <?php } ?>
          <?php } ?>
        </ul>
      </div>

      <div class="content">
      <?php if ( $home ) { ?>
        <h1>
          <?php if ( $auth->isLoggedIn() ) { ?>
          <a class="button" href="pages.php?action=edit&id=<?php echo $home["id"]; ?>">
            <span class="icon">
              <i class="mdi mdi-text-box-edit mdi-24px"></i>
            </span>
          </a>
          <?php } ?>
          <span><?php echo $home["name"]; ?></span>
        </h1>
        <?php echo $md->text( $home["body"] ); ?>
      </div>
      <nav class="breadcrumb is-centered" aria-label="breadcrumbs">
        <ul>
          <li class="is-active"><a>By <?php echo $profile->get("first_name") . " " . $profile->get("last_name"); ?></a></li>
          <li class="is-active"><a>Created <?php echo (date("Y-m-d") == $home["published"]) ? "today" : date("l, F j, Y", strtotime( $home["published"] ) ); ?></a></li>
          <?php if ( $home["edited"] ) { ?>
          <li class="is-active"><a>Last edited <?php echo (date("Y-m-d") == $home["edited"]) ? "today" : date("l, F j, Y", strtotime( $home["edited"] ) ); ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } else { ?>
        <h1>
          <?php if ( $auth->isLoggedIn() ) { ?>
          <a class="button" href="pages.php?action=create&name=Home">
            <span class="icon">
              <i class="mdi mdi-text-box-plus mdi-24px"></i>
            </span>
          </a>
          <?php } ?>
          <span>Home</span>
        </h1>
        <p>
          Quibusdam aliqua o occaecat philosophari. Nisi litteris do quid amet, incurreret
          do veniam se aut export litteris, sed labore offendit. Quorum mandaremus eiusmod
          qui quorum incurreret te imitarentur ab aut amet voluptate cupidatat, est ex
          despicationes est doctrina fore quae do dolor ea quae litteris est laborum,
          ullamco tamen mentitum, iis eram laborum deserunt. Eu illum transferrem.Ex
          dolore a elit, quamquam qui sunt mandaremus. Aut quem mandaremus philosophari ea
          aut ullamco fidelissimae ea in irure nostrud reprehenderit, sunt excepteur ab
          coniunctione e doctrina nisi laboris, in consequat exercitation, admodum
          exercitation est commodo, eu culpa offendit. Quid pariatur ad imitarentur,
          quamquam enim ubi quamquam domesticarum. Culpa laborum offendit.
        </p>
        <p>
          Ubi quae excepteur proident, fabulas firmissimum ita senserit ea a amet et aute,
          quamquam quorum aliquip ad commodo aut dolor admodum, et magna cernantur
          transferrem ea an expetendis reprehenderit in aliqua laboris admodum. Incididunt
          domesticarum si voluptate. Appellat ad incididunt, arbitror iis ipsum doctrina
          hic labore hic ubi esse ingeniis, dolor de non esse iudicem.Quorum an arbitror o
          qui te fore quae dolore id ingeniis instituendarum ab appellat ne e ullamco a
          arbitror nam quorum ex vidisse se cillum, export do ita ipsum proident te te
          velit aliqua quorum offendit, occaecat fidelissimae te excepteur. Iudicem quorum
          minim nescius cillum aut eiusmod non aute. Ubi legam ea illum.
        </p>
        <p>
          Summis aut aliquip, a aliqua occaecat praesentibus, minim illustriora litteris
          quorum constias a ita magna ullamco, id cernantur eu quibusdam te amet qui sed
          quem doctrina do te o instituendarum iis non elit commodo. Nostrud legam
          excepteur laboris. Iudicem tempor fore o quae, hic summis cernantur ita
          voluptate veniam aut commodo imitarentur e se aut consectetur. De ut quis
          cernantur a do mentitum reprehenderit.Incurreret tempor expetendis. Ex admodum
          an incididunt se aute proident quo illum esse, an expetendis ea nescius, do
          nulla eiusmod eu dolore eiusmod ut officia, in summis appellat relinqueret quo
          an tamen fore illum mentitum, quid arbitrantur mandaremus aute incididunt.
          Veniam iis doctrina.
        </p>
        <p>
          Ut eu quem mentitum quo quid arbitrantur iudicem nisi pariatur e nam sunt
          deserunt de id mentitum comprehenderit. Iis aute cernantur, singulis elit
          cupidatat voluptate ita probant ita quid, ex velit firmissimum te an ex enim
          fugiat export, anim offendit ne possumus ita senserit quorum laborum, malis e
          admodum. Ex legam probant aut incurreret sint non quibusdam philosophari,
          excepteur imitarentur in pariatur, illum ut ad veniam senserit. Cupidatat e
          noster deserunt iis multos arbitror hic firmissimum.Probant velit fore ullamco
          irure. Nostrud te irure constias iis pariatur anim duis nostrud minim sed fugiat
          iudicem consectetur, te minim occaecat coniunctione. Cillum iis possumus.
        </p>
        <p>
          Fugiat de e fugiat nescius, probant familiaritatem ex consequat, quo summis
          praesentibus, aliquip multos se ingeniis adipisicing, est probant exercitation,
          commodo coniunctione non occaecat, quo irure exquisitaque, aute commodo iis
          cillum aliqua. Iis aliquip ab probant. Aliqua ullamco despicationes, se anim
          cernantur, ipsum cernantur imitarentur, iis esse ipsum ea nostrud, iis quamquam
          cohaerescant, senserit instituendarum e cupidatat, quo dolore se eram an et sint
          cernantur laborum.Et summis quae ea possumus. Mentitum minim sed quibusdam
          efflorescere aut quid laboris e concursionibus. A quid ea fore hic si id dolor
          nulla sint. Culpa sed mentitum ea anim.
        </p>
      <?php } ?>
      </div>
    </div>
  </div>
</main>

<?php
require_once "footer.php";
?>
