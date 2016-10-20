<?php defined('C5_EXECUTE') or die("Access Denied.");

$c = Page::getCurrentPage();
?>
<div class="contact-info">
  <?php
      if (is_object($f)) {
        $image = Core::make('html/image', array($f));
        $tag = $image->getTag();
        print '<div class="contact-info__img">';
        print $tag;
        print '</div>';
      }
  ?>
  <p class="contact-info__text">Contact Us</p>
  <dl>
  <?php
  if ($phone) {
      print '<dt>Call:</dt><dd>';
      echo $phone;
      print '</dd><br/>';
  }
  if ($fax) {
      print '<dt>Fax:</dt><dd>';
      echo $fax;
      print '</dd><br/>';
  }
  if ($infoEmail) {
      print '<dt>Info:</dt><dd>';
      echo $infoEmail;
      print '</dd><br/>';
  }
  if ($salesEmail) {
      print '<dt>Sales:</dt><dd>';
      echo $salesEmail;
      print '</dd><br/>';
  }
  if ($partnerEmail) {
      print '<dt>Partner:</dt><dd><a href="mailto:' . $partnerEmail . '">';
      echo $partnerEmail;
      print '</a></dd><br/>';
  }
  if ($address1) {
      print '<dt>Location:</dt><dd>';
      echo $address1;
      if($address2) { echo $address2; }
      if($cityStateZip) { echo $cityStateZip; }
      if($country) { echo $country; }
      print '</dd>';
  }
  ?>
  </dl>
</div>
