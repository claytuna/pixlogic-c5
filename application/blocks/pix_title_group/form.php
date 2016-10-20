<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<fieldset>
    <legend><?php echo t('Content')?></legend>
		<div class="form-group">
		    <?php echo $form->label('intro', t('Intro'))?>
		    <?php echo $form->text('intro', $intro, array('style'=>'width: 60%;')); ?>
		</div>
		<div class="form-group">
		    <?php echo $form->label('title', t('Title'))?>
		    <?php echo $form->text('title', $title, array('style'=>'width: 100%;')); ?>
		</div>

</fieldset>
