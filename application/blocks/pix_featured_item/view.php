<?php defined('C5_EXECUTE') or die("Access Denied.");

$c = Page::getCurrentPage();
?>
<div class="featured-item">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">

<?php
    if ($title) {
        print '<h2 class="featured-item__title">';
        echo $title;
        print '</h2>';
    }
    if ($description) {
        print '<div class="featured-item__desc">';
        echo $description;
        print '</div>';
    }
?>
<div class="row">
<div class="col-xs-12 col-sm-6 col-lg-4">
<?php
    if ($valueProps) {
        print '<div class="featured-item__props">';
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
<div class="col-xs-12 col-sm-6 col-lg-8">
<?php
    if (is_object($f)) {
      $image = Core::make('html/image', array($f));
      $tag = $image->getTag();
      print '<div class="featured-item__img">';
      print $tag;
      print '</div>';
    }
?>
</div>
</div>

      </div>
    </div>
  </div>
</div>
