<?php defined('C5_EXECUTE') or die("Access Denied.");?>

<div class="cta-hero">
    <div class="row">

      <div class="col-xs-12 col-md-8 col-lg-6">
          <?php
          if($title){
            print '<h1 class="cta-hero__title">'. $title .'</h1>';
          }?>
          <?php
          if($description){
            print '<div class="cta-hero__text"><p>'. $description .'</p></div>';
          }?>
          <div class="cta-hero__cta">
          <div class="row">
            <?php if($altText){?>
            <div class="col-xs-12 col-sm-6">
            <a href="<?php echo $linkURL?>" class="btn btn--primary btn--block"><?php echo $altText?></a>
            </div>
            <?php }?>
            <?php if($altText2){?>
            <div class="col-xs-12 col-sm-6">
            <a href="<?php echo $linkURL2?>" class="btn btn--transparent btn--block"><?php echo $altText2?></a>
            </div>
            <?php }?>
          </div>
          </div>
      </div>
  </div>
</div>
