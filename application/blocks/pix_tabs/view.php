<?php defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();?>

<div class="tabs-row">

  <div class="tabs-row__title-group">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
          <h2 class="tabs-row__title"><?php print $tabTitle ?></h2>
      </div>
    </div>
  </div>
  </div>

  <div class="container">
    <div class="row">
    <div class="col-xs-12">
      <div class="tabs <?php if($allowIntroText == 1){ echo 'tabs--lg'; } ?>" style="min-height:<?php if($minHeight){ echo $minHeight; } else { echo '510px'; }?>;">

        <?php if(count($rows) > 0) { ?>
            <?php foreach($rows as $idx=>$row) { ?>
               <div class="tab">
                   <input type="radio" id="tab-<?php echo $idx?>" name="tab-group-<?php echo $bID?>" <?php if($idx == '0') { print 'checked'; } ?>>
                   <label for="tab-<?php echo $idx?>">
                     <?php
                      $f = File::getByID($row['fID']);
                      if(is_object($f)) {
                        print '<span class="tab__icon">';
                         $tag = Core::make('html/image', array($f, false))->getTag();
                         $tag->alt('tab-icon');
                         print $tag;
                         print '</span>';
                      } ?>
                     <?php if($allowIntroText == 1){?> <span class="tab__intro"><?php echo $row['titleIntro'] ?></span><br/><?php }?>
                     <?php echo $row['title'] ?>
                   </label>
                   <div class="content">
                      <div class="row">
                        <div class="col-sm-9">
                          <?php echo $row['description'] ?>
                        </div>
                        <div class="col-sm-3">
                          <?php if($row['linkURL']){?>
                          <a href="<?php echo $row['linkURL'] ?>" class="btn btn--primary btn--block">
                            <?php echo $row['linkText'] ? $row['linkText'] : 'Learn More'?>
                          </a>
                          <?php } ?>
                        </div>
                      </div>
                   </div>
               </div>
             <?php } ?><!--end foreach-->

         <?php } else { ?>
           <div class="ccm-image-slider-placeholder">
           <p><?php echo t('No Tabs Added.'); ?></p>
           </div>
         <?php } ?><!--end countrows-->

        </div>
      </div>
    </div>
  </div>

</div>
