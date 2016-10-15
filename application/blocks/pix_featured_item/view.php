<?php defined('C5_EXECUTE') or die("Access Denied.");
$navigationTypeText = ($navigationType == 0) ? 'arrows' : 'pages';
$c = Page::getCurrentPage();
?>

<div class="feature">
    <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <h2 class="feature__title">
              TITLE
            </h2>
            <div class="feature__desc">
              DESC
            </div>
            <?php if (is_object($featureFile)) {
              $image = Core::make('html/image', array($featureFile));
              $tag = $image->getTag();
              print $tag;
            }?>
          </div>
        </div>
        <div class="row">
        <div class="col-xs-12 col-sm-6 col-lg-4">

          <?php if(count($rows) > 0) { ?>

            <ul class="feature__value-props">
            <?php foreach($rows as $idx=>$row) { ?>

                <?php if($row['linkURL']) { ?>
                    <!--a href="<?php echo $row['linkURL'] ?>" class="mega-link-overlay"></a-->
                <?php } ?>

                <!--div class="fed-grid__icon">
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
                </div-->

                <li class="feature__value-prop">
                    <?php if($row['title']) { ?>
                    	<p class="feature__value-prop-title"><?php echo $row['title'] ?></p>
                    <?php } ?>
                    <div class="feature__value-prop-desc">
                    <?php echo $row['description'] ?>
                    </div>
                </li>

            <?php } ?>
            </ul>

          <?php } else { ?>
              <?php if ($c->isEditMode()) { ?><div class="ccm-image-slider-placeholder">
                  <p><?php echo t('No Value Props Entered.'); ?></p>
              </div>
              <?php } ?>
          <?php } ?>

          <a href="" class="btn btn--primary">Learn More</a>
        </div>
      </div>
    </div>
  </div>
