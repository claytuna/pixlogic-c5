<?php defined('C5_EXECUTE') or die("Access Denied.");?>

<header class="page-title-callout">
  <div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h1><?php
        $parent = page::getByID($c->getCollectionParentID());
        echo $parent->getCollectionName();
        $introText = $parent->getAttribute('intro_text');
        if($introText){
        echo $parent->getAttribute('intro_text');
        }
      ?></h1>
    </div>
  </div>
  </div>
</header>
