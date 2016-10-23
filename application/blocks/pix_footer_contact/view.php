<?php defined('C5_EXECUTE') or die("Access Denied.");

$c = Page::getCurrentPage();
?>
<div class="footer-contact">
  <p>
    <?php if ($address1) { echo $address1; } ?>
    <?php if ($address2) { print ', '; echo $address2; } ?> |
    <?php if ($cityStateZip) { echo $cityStateZip; } ?> |
    <?php if ($phone) { print '<span class="text--orange">CALL</span> '; echo $phone; } ?>  |
    <?php if ($infoEmail) { print '<span class="text--orange">EMAIL</span> '; echo $infoEmail; } ?>
  </p>
</div>
