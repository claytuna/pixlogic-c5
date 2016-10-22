<?php
defined('C5_EXECUTE') or die("Access Denied.");
$al = Core::make('helper/concrete/asset_library');
$fp = FilePermissions::getGlobal();
$tp = new TaskPermission();
$bf = null;

if ($controller->getFileID() > 0) {
	$bf = $controller->getFileObject();
}
?>

<!--fieldset>

  <legend><?php //echo t('Image')?></legend>
	<div class="form-group">
		<label class="control-label"><?php //echo t('Contact Image')?></label>
		<?php //echo $al->image('ccm-b-image', 'fID', t('Choose Image'), $bf, $args);?>
	</div>

</fieldset>
<hr/-->

<fieldset>
    <legend><?php echo t('Phone')?></legend>
		<div class="form-group">
		    <?php echo $form->label('phone', t('Phone'))?>
		    <?php echo $form->text('phone', $phone, array('style'=>'width: 50%;')); ?>
		</div>
		<legend><?php echo t('Email')?></legend>
		<div class="form-group">
		    <?php echo $form->label('infoEmail', t('Info Email'))?>
		    <?php echo $form->text('infoEmail', $infoEmail, array('style'=>'width: 80%;')); ?>
		</div>
		<legend><?php echo t('Address')?></legend>
		<div class="form-group">
		    <?php echo $form->label('address1', t('Address1'))?>
		    <?php echo $form->text('address1', $address1, array('style'=>'width: 80%;')); ?>
		</div>
		<div class="form-group">
		    <?php echo $form->label('address2', t('Address2'))?>
		    <?php echo $form->text('address2', $address2, array('style'=>'width: 80%;')); ?>
		</div>
		<div class="form-group">
		    <?php echo $form->label('cityStateZip', t('City, State, Zip'))?>
		    <?php echo $form->text('cityStateZip', $cityStateZip, array('style'=>'width: 80%;')); ?>
		</div>

</fieldset>
