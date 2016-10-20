<?php
defined('C5_EXECUTE') or die("Access Denied.");
$al = Core::make('helper/concrete/asset_library');
$fp = FilePermissions::getGlobal();
$tp = new TaskPermission();
$bf = null;
$bfo = null;

if ($controller->getFileID() > 0) {
	$bf = $controller->getFileObject();
}
?>

<fieldset>

    <legend><?php echo t('Image')?></legend>

<div class="form-group">
	<label class="control-label"><?php echo t('Featured Image')?></label>
	<?php echo $al->image('ccm-b-image', 'fID', t('Choose Image'), $bf, $args);?>
</div>

</fieldset>
<hr/>

<fieldset>
    <legend><?php echo t('Content')?></legend>
		<div class="form-group">
			<?php echo $form->label('altText', t('Intro Text'))?>
			<?php echo $form->text('altText', $altText, array('style'=>'width: 60%;')); ?>
		</div>

		<div class="form-group">
		    <?php echo $form->label('title', t('Title'))?>
		    <?php echo $form->text('title', $title, array('style'=>'width: 100%;')); ?>
		</div>

		<div class="form-group" >
				<label><?php echo t('Description'); ?></label>
				<div class="redactor-edit-content"></div>
				<textarea style="display: none" class="redactor-content" name="description"><?php echo $description?></textarea>
		</div>

</fieldset>


<script type="text/javascript">
$(document).ready(function() {
	$('.redactor-content').redactor({
			minHeight: 200,
			'concrete5': {
					filemanager: <?php   echo $fp->canAccessFileManager()?>,
					sitemap: <?php   echo $tp->canAccessSitemap()?>,
					lightbox: true
			}
	});
});
</script>
