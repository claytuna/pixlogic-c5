<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<section class="footer-intro">
<?php
$a = new GlobalArea('Footer Intro');
$a->display();
?>
</section>

<footer class="footer" role="contentinfo">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-2">
        <div class="footer__left">
          <?php
          $a = new GlobalArea('Footer Site Logo');
          $a->display();
          ?>
           <span class="footer__copy">&copy;<?php echo date('Y');?> piXlogic, Inc.</span>
        </div>
      </div>
      <div class="col-xs-12 col-sm-10">
        <div class="footer__right">
          <?php
          $a = new GlobalArea('Footer Content');
          $a->display();
          ?>
        </div>
      </div>
    </div>
  </div>
</footer>

</div><!--END PAGEWRAP CLASS; see header_meta for opening-->

<?php if(!$c->isEditMode()){ ?>
<script type="text/javascript" src="<?php echo $view->getThemePath()?>/js/header.js"></script>
<?php }?>

<?php Loader::element('footer_required'); ?>

</body>
</html>
