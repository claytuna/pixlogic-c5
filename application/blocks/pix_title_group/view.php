<?php defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
?>
<div class="title-group">
  <?php
      if ($intro) {
          print '<p class="title-group__intro">';
          echo $intro;
          print '</p>';
      }
      if ($title) {
          print '<h2 class="title-group__title">';
          echo $title;
          print '</h2>';
      }
  ?>
</div>
