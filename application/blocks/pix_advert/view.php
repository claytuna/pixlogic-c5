<?php defined('C5_EXECUTE') or die("Access Denied.");

$c = Page::getCurrentPage();
?>
<div class="advert">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">


<div class="row">
<div class="col-xs-12 col-sm-2 col-lg-4">
  <?php
      if (is_object($f)) {
        $image = Core::make('html/image', array($f));
        $tag = $image->getTag();
        print '<div class="advert__img">';
        print $tag;
        print '</div>';
      }
  ?>
</div>
<div class="col-xs-12 col-sm-10 col-lg-8">
  <div class="advert__content">
  <?php
      if ($title) {
          print '<h2 class="advert__title">';
          echo $title;
          print '</h2>';
      }
      if ($description) {
          print '<div class="advert__desc">';
          echo $description;
          print '</div>';
      }
  ?>
  <?php
    if ($valueProps) {
        print '<div class="advert__props">';
        echo $valueProps;
        print '</div>';
    }

    if ($linkURL) {
        print '<a class="btn btn--primary" href="' . $linkURL . '">';
        if ($altText) {
            echo $altText;
        } else {
            echo 'Learn More >>';
        }
        print '</a>';
    }
  ?>
  </div>
</div>
</div>

      </div>
    </div>
  </div>
</div>
