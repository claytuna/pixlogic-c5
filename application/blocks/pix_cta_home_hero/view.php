<?php defined('C5_EXECUTE') or die("Access Denied.");?>

<div class="fed-solution-title">
    <div class="row">

      <div class="col-xs-12">
        <div class="fed-solution-title__img">
          <?php
          $iconObj = File::getByID($fImg);
          ?>
          <?php if(is_object($iconObj)) {
              $tag = Core::make('html/image', array($iconObj, false))->getTag();
              if($altText) {
                $tag->alt($altText . '- Event');
              }else{
                $tag->alt("Solution Icon");
              }
              print $tag; ?>
          <?php } ?>
        </div>

        <div class="fed-solution-title__text">
          <?php
          if($title){
            print '<p class="title">'. $title .'</p>';
          }?>
          <?php
          if($description){
            print '<div class="desc"><p>'. $description .'</p></div>';
          }?>
        </div>
      </div>

  </div>
</div>
