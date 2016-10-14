<?php defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();?>

<div class="icon-grid-wrapper">
  <div class="container">
    <div class="row">

        <?php if(count($rows) > 0) { ?>

            <?php foreach($rows as $idx=>$row) { ?>

              <div class="col-xs-12 col-sm-6 icon-grid">
                <div class="icon-grid__icon">
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

                <?php if($row['title']) { ?>
                	<p class="icon-grid__title"><?php echo $row['title'] ?></p>
                <?php } ?>

                <?php if($row['description']) { ?>
                	<div class="icon-grid__text"><?php echo $row['description'] ?></div>
                <?php } ?>

              </div><!--end grid col-->
            <?php } ?><!--end foreach-->

        <?php } else { ?>
        <div class="ccm-image-slider-placeholder">
            <p><?php echo t('No Icon Grid Content Entered.'); ?></p>
        </div>
        <?php } ?>

        </div>
    </div>
</div>
