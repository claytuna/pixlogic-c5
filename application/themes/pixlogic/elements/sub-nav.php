<?php defined('C5_EXECUTE') or die("Access Denied.");?>

<nav class="sub-nav">
  <div class="container">
  <div class="row">
    <div class="col-xs-12">
      <?php
        $bt_main = BlockType::getByHandle('autonav');
        $bt_main->controller->displayPages = 'current';
        $bt_main->controller->orderBy = 'display_asc';
        $bt_main->controller->displaySubPages = 'none';
        $bt_main->render('view');
      ?>
    </div>
  </div>
  </div>
</nav>
