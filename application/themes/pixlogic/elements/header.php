<?php defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header_meta.php');
$as = new GlobalArea('Header Search');
//$blocks = $as->getTotalBlocksInArea();
//$displayThirdColumn = $blocks > 0 || $c->isEditMode();
?>
<div class="header" id="main-header">

<section class="page-title-callout">

  <header class="header-nav" role="banner">
      <div class="container">
          <div class="row">
              <div class="col-xs-4 col-sm-3">
                  <a class="header-nav__logo" href="/" title="PixLogic - Home">
                    <i class="sr-only">PixLogic - Home</i>
                  </a>
              </div>
              <div class="col-xs-8 col-sm-9" role="navigation">
                  <a class="header-nav__toggle" id="main-nav-toggle" href="#">
                    <i>
                      <span></span>
                    </i>
                    <span>Menu</span>
                  </a>
                  <?php
                  $a = new GlobalArea('Header Navigation');
                  $a->display();
                  ?>
              </div>
          </div>
      </div>
  </header>

<?php
  $headerImageUrl = $view->getThemePath() . '/img/banner-tablet-default.jpg';
  if($c->getAttribute('intro_header_image')) {
    $headerImageUrl = $c->getAttribute('intro_header_image')->getRecentVersion()->getRelativePath();
  } ?>
  <div class="page-title-callout__img" style="background-image:url('<?php echo $headerImageUrl; ?>')"></div>

  <?php if($GLOBALS['hideTitle'] == false){?>
  <div class="page-title-callout__text">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>
          <span class="page-title-callout__intro"><?php if($c->getAttribute('intro_text')) { echo $c->getAttribute('intro_text'); }?></span>
          <?php
          $pageTitleCallout = $c->getCollectionName();
          if($c->getAttribute('intro_title_override')) {
            $pageTitleCallout = $c->getAttribute('intro_title_override');
          }
          echo $pageTitleCallout;
          ?>
        </h1>
      </div>
    </div>
  </div>
  </div>
  <?php } else {?>
    <div class="page-title-callout__alt">
      <div class="container">
      <?php
      $hs = new Area('Header Section');
      $hs->display($c);
      ?>
      </div>
    </div>
  <?php }?>

</section>

</div>
