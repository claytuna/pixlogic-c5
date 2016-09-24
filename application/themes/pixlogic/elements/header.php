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
              <div class="col-xs-12 col-sm-3">
                  <a class="header-nav__logo" href="/">
                    <i></i>
                  </a>
              </div>
              <div class="col-xs-12 col-sm-9" role="navigation">
                  <?php
                  $a = new GlobalArea('Header Navigation');
                  $a->display();
                  ?>
              </div>
          </div>
      </div>
  </header>

  <?php /*CALLOUT IMG ATTRIBUTE HERE */?>
  <img class="page-title-callout__img" src="" alt="pixlogic callout image"/>

  <div class="page-title-callout__text">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>
          <span class="page-title-callout__intro">intro attr</span>
          <?php
          echo $c->getCollectionName();
          ?>
        </h1>
      </div>
    </div>
  </div>
  </div>

</section>

</div>
