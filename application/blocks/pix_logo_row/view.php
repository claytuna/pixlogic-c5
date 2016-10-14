<?php defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();?>

<div class="logo-row-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 logo-row">
        <?php if(count($rows) > 0) { ?>

            <?php foreach($rows as $idx=>$row) { ?>
                <div class="logo-row__logo">
                  <?php
                  $f = File::getByID($row['fID']);
                   if(is_object($f)) {
                      $tag = Core::make('html/image', array($f, false))->getTag();
                      if($row['title']) {
                      	$tag->alt($row['title']);
                      } else {
                        $tag->alt('grid-icon');
                      }
                      print $tag; ?>
                  <?php } ?>
                </div>
            <?php } ?><!--end foreach-->

        <?php } else { ?>
        <div class="ccm-image-slider-placeholder">
            <p><?php echo t('No Icon Grid Content Entered.'); ?></p>
        </div>
        <?php } ?>
          </div><!--end grid col-->
        </div>
    </div>
</div>
