<?php defined('C5_EXECUTE') or die("Access Denied.");
$navigationTypeText = ($navigationType == 0) ? 'arrows' : 'pages';
$c = Page::getCurrentPage();?>

<div class="full-grid-wrapper">
  <div class="container-fluid">
    <div class="row">

        <?php if(count($rows) > 0) { ?>

            <?php foreach($rows as $idx=>$row) { ?>

              <?php
                $colSm = 12;
                $colLg = 12;
                if(count($rows) == 1) {
                  $colLg = 12;
                  $colSm = 12;
                }
                if(count($rows) == 2) {
                  $colLg = 6;
                  $colSm = 6;
                }
                if(count($rows) > 2) {
                  $colLg = 3;
                  $colSm = 6;
                }
              ?>

              <div class="col-xs-12 col-sm-<?php echo $colSm?> col-lg-<?php echo $colLg?> full-grid <?php if($layoutType == 1){ echo 'full-grid--center';}?>">
                <div class="full-grid__icon">
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
                	<p class="full-grid__title"><?php echo $row['title'] ?></p>
                <?php } ?>

                <?php if($row['description']) { ?>
                	<div class="full-grid__text"><?php echo $row['description'] ?></div>
                <?php } ?>

                <?php if($row['linkURL']) { ?>
                  <div class="full-grid__cta">
                    <a href="<?php echo $row['linkURL'] ?>" class="btn btn--primary btn--hollow">
                      <?php echo $row['linkText'] ? $row['linkText'] : 'Learn More'?>
                    </a>
                  </div>
                <?php } ?>

              </div><!--end grid col-->
            <?php } ?><!--end foreach-->

        <?php } else { ?>
        <div class="ccm-image-slider-placeholder">
            <p><?php echo t('No Full Grid Content Entered.'); ?></p>
        </div>
        <?php } ?>

        </div>
    </div>
</div>
