<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>

<main role="main" class="main--padded">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
      <?php
      $a = new Area('Main');
      //$a->enableGridContainer();
      $a->display($c);
      ?>
      </div>
    </div>
  </div>
</main>



<?php  $this->inc('elements/footer.php'); ?>
