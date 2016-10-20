<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');?>

<?php $this->inc('elements/page-title-parent.php');?>
<?php $this->inc('elements/sub-nav.php');?>

<main role="main">
  <div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-8">
      <?php
      $a = new Area('Main');
      //$a->enableGridContainer();
      $a->display($c);
      ?>
    </div>
    <div class="col-xs-12 col-sm-4">
      <?php
      $a = new Area('Right Sidebar');
      //$a->enableGridContainer();
      $a->display($c);
      ?>
    </div>
  </div>
  </div>

</main>

<?php  $this->inc('elements/footer.php'); ?>
