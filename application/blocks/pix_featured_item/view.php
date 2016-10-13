<?php defined('C5_EXECUTE') or die("Access Denied.");
$navigationTypeText = ($navigationType == 0) ? 'arrows' : 'pages';
$c = Page::getCurrentPage();
if ($c->isEditMode()) { ?>
    <div class="ccm-edit-mode-disabled-item" style="<?php echo isset($width) ? "width: $width;" : '' ?><?php echo isset($height) ? "height: $height;" : '' ?>">
        <div style="padding: 40px 0px 40px 0px"><?php echo t('Grid Content disabled in edit mode.')?></div>
    </div>
<?php  } else { ?>

<div class="fed-grid">
    <div class="container">
        <div class="row">
        <div class="col-xs-12">

        <?php if(count($rows) > 0) { ?>
        <div class="fed-grid__wrapper" id="fed-grid-entry-<?php echo $bID ?>">
          <div class="row">
            <?php foreach($rows as $idx=>$row) { ?>
                <?php if($idx !== 0 && $idx % 3 == 0) { echo '</div><div class="row">';}?>
                  
                <div class="col-xs-12 col-sm-4">
                <?php if($row['linkURL']) { ?>
                    <!--a href="<?php echo $row['linkURL'] ?>" class="mega-link-overlay"></a-->
                <?php } ?>

                <div class="fed-grid__icon">
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

                <div class="fed-grid__content">
                    <?php if($row['title']) { ?>
                    	<p class="fed-grid__title"><?php echo $row['title'] ?></p>
                    <?php } ?>
                    <div class="fed-grid__desc">
                    <?php echo $row['description'] ?>
                    </div>
                </div>

              </div><!--end grid col-->



            <?php } ?>
            </div>
        </div>
        <?php } else { ?>
        <div class="ccm-image-slider-placeholder">
            <p><?php echo t('No Grid Content Entered.'); ?></p>
        </div>
        <?php } ?>

        </div>
        </div>
    </div>
</div>
<?php } ?>
