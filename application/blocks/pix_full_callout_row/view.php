<?php defined('C5_EXECUTE') or die("Access Denied.");?>

<div class="full-callout-row">
  <span class="full-callout-row__angle">
    <i class="full-callout-row__icon"></i>
  </span>
  <div class="container">
    <div class="row">

      <div class="col-xs-12 col-sm-9">
        <div class="full-callout-row__text">
          <?php
          if($description){
            print '<p>'. $description .'</p>';
          }?>
        </div>
      </div>

      <div class="col-xs-12 col-sm-3">
        <div class="full-callout-row__btn">
          <?php if($altText){ ?>
            <a href="<?php echo $linkURL;?>" class="btn btn--primary btn--block"><?php echo $altText; ?></a>
          <?php } ?>
        </div>
      </div>

    </div>
  </div>
</div>
