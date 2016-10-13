<?php
defined('C5_EXECUTE') or die("Access Denied.");
$GLOBALS['hideTitle'] = true;
$this->inc('elements/header.php'); ?>

<main role="main" class="home">
<?php
$a = new Area('Main');
//$a->enableGridContainer();
$a->display($c);
?>
</main>

<?php  $this->inc('elements/footer.php'); ?>
