<?php defined('C5_EXECUTE') or die("Access Denied.");
$navigationTypeText = ($navigationType == 0) ? 'arrows' : 'pages';
$c = Page::getCurrentPage();
?>
<div class="featured-article">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="featured-article__main-title"><?php echo $sliderTitle?></h2>

                  <?php if(count($rows) > 0) { ?>
                  <div class="row featured-article__row">
                      <?php foreach($rows as $key=>$row) { ?>
                          <div class="col-xs-12 col-sm-4">
                            <div class="featured-article__content">
                            <?php
                            $page = $row['linkPage'];
                            $url = $row['linkURL'];
                             /*print_r(count($rows))
                             print_r($key)*/?>
                            <?php if(is_object($page)){
                              $thumbnail = $page->getAttribute('thumbnail');
                            }?>

                            <?php if (is_object($thumbnail)): ?>
                                <a href="<?php echo $url ?>" class="featured-article__thumbnail" target="<?php echo $target ?>">
                                    <?php
                                    $img = Core::make('html/image', array($thumbnail));
                                    $tag = $img->getTag();
                                    $tag->addClass('img-responsive');
                                    print $tag;
                                    ?>
                                </a>
                            <?php endif; ?>

                            <div class="featured-article__text">


                            <div class="featured-article__title-group">
                                <?php
                                if(is_object($page)){
                                  $pageName = $page->getCollectionName();
                                }
                                if (isset($pageName) && $pageName): ?>
                                    <a class="featured-article__title" href="<?php echo $url ?>">
                                      <?php echo $pageName ?>
                                    </a>
                                <?php endif; ?>

                                <?php
                                if(is_object($page)){
                                $pageDesc = $page->getCollectionDescription();
                                }
                                if (isset($pageDesc) && $pageDesc): ?>
                                    <div class="featured-article__desc">
                                        <?php echo $pageDesc ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php
                            if(is_object($page)){
                              $collectionDate = strtotime($page->getCollectionDatePublic(), true);
                              $date = date("d/m/Y", $collectionDate);
                              $dateDay = date("d", $collectionDate);
                              $dateMonth = date("M", $collectionDate);
                              $dateYear = date("Y", $collectionDate);
                            }

                            if (isset($collectionDate) && $collectionDate): ?>
                            <div class="featured-article__date">
                              <span class="featured-article__date-month"><?php echo $dateMonth?></span>
                              <span class="featured-article__date-day"><?php echo $dateDay?></span>
                              <span class="featured-article__date-year"><?php echo $dateYear?></span>
                              |
                            </div>
                            <?php endif; ?>

                            <div class="featured-article__read-more">
                                <a href="<?php echo $url?>">
                                  <?php echo t("Read more")?> <span class="featured-article__read-more-arrows">>></span>
                                </a>
                            </div>

                            </div>
                          </div>

                          <?php if($row['linkURL']) { ?>
                              <a href="<?php echo $row['linkURL'] ?>" class="mega-link-overlay"></a>
                          <?php } ?>
                        </div>
                      <?php } ?>
                  </div>
                  <?php } else { ?>
                  <div class="ccm-image-slider-placeholder">
                      <p><?php echo t('No Articles Selected.'); ?></p>
                  </div>
                  <?php } ?>

                  <?php if($btnText) {
                      print '<a class="btn btn--primary btn--center" href="'. $btnURL .'">';
                      echo $btnText;
                      print '</a>';
                  }?>


      </div>
    </div>
  </div>
</div><!--end featured-article-->
