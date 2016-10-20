<?php defined('C5_EXECUTE') or die("Access Denied.");

$c = Page::getCurrentPage();
?>
<div class="intro-section">
  <div class="container">
    <div class="row">
    <div class="col-xs-12 col-sm-6 col-lg-8">
      <?php
          if ($altText) {
              print '<p class="intro-section__intro">';
              echo $altText;
              print '</p>';
          }
          if ($title) {
              print '<h2 class="intro-section__title">';
              echo $title;
              print '</h2>';
          }
          if ($description) {
              print '<div class="intro-section__desc">';
              echo $description;
              print '</div>';
          }
      ?>
    </div>
    <div class="col-xs-12 col-sm-6 col-lg-4">
    <?php
        if (is_object($f)) {
          $image = Core::make('html/image', array($f));
          $tag = $image->getTag();
          print '<div class="intro-section__img">';
          print $tag;
          print '</div>';
        }
    ?>
    </div>
    </div>

  </div>
</div>
