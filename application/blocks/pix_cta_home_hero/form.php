<?php
defined('C5_EXECUTE') or die("Access Denied.");
$al = Core::make('helper/concrete/asset_library');
$bf = null;
$bfo = null;

if ($controller->getFileID() > 0) {
	$bf = $controller->getFileObject();
}
if ($controller->getFileOnstateID() > 0) {
	$bfo = $controller->getFileOnstateObject();

}
?>

<fieldset>
    <legend><?php echo t('Hero CTA content')?></legend>
		<div class="form-group">
			<?php echo $form->label('title', t('Title'))?>
			<?php echo $form->text('title', $title, array('style'=>'width: 100%;')); ?>
		</div>

		<div class="form-group">
			<?php echo $form->label('description', t('Description'))?>
			<?php echo $form->textarea('description', $description, array('style'=>'width: 100%;')); ?>
		</div>

</fieldset>
<hr/>
<fieldset>

    <legend><?php echo t('Hero CTA Buttons')?></legend>
<?php
$args = array();
?>

<div class="form-group">
	<?php echo $form->label('altText', t('Button 1 Text'))?>
	<?php echo $form->text('altText', $altText, array('style'=>'width: 60%;')); ?>
</div>
<div class="form-group">
	<?php echo $form->label('imageLinkType', t('Read More Link'))?>
	<select name="linkType" id="imageLinkType" class="form-control" style="width: 60%;">
		<option value="0" <?php echo (empty($externalLink) && empty($internalLinkCID) ? 'selected="selected"' : '')?>><?php echo t('None')?></option>
		<option value="1" <?php echo (empty($externalLink) && !empty($internalLinkCID) ? 'selected="selected"' : '')?>><?php echo t('Another Page')?></option>
		<option value="2" <?php echo (!empty($externalLink) ? 'selected="selected"' : '')?>><?php echo t('External URL')?></option>
	</select>
</div>

<div id="imageLinkTypePage" style="display: none;" class="form-group">
	<?php echo $form->label('internalLinkCID', t('Choose Page:'))?>
	<?php echo Core::make('helper/form/page_selector')->selectPage('internalLinkCID', $internalLinkCID); ?>
</div>

<div id="imageLinkTypeExternal" style="display: none;" class="form-group">
	<?php echo $form->label('externalLink', t('URL'))?>
	<?php echo $form->text('externalLink', $externalLink, array('style'=>'width: 60%;')); ?>
</div>

<hr/>
<div class="form-group">
	<?php echo $form->label('altText2', t('Button 2 Text'))?>
	<?php echo $form->text('altText2', $altText2, array('style'=>'width: 60%;')); ?>
</div>

<div class="form-group">
	<?php echo $form->label('imageLinkType2', t('Read More Link'))?>
	<select name="linkType" id="imageLinkType2" class="form-control" style="width: 60%;">
		<option value="0" <?php echo (empty($externalLink2) && empty($internalLinkCID2) ? 'selected="selected"' : '')?>><?php echo t('None')?></option>
		<option value="1" <?php echo (empty($externalLink2) && !empty($internalLinkCID2) ? 'selected="selected"' : '')?>><?php echo t('Another Page')?></option>
		<option value="2" <?php echo (!empty($externalLink2) ? 'selected="selected"' : '')?>><?php echo t('External URL')?></option>
	</select>
</div>

<div id="imageLinkTypePage2" style="display: none;" class="form-group">
	<?php echo $form->label('internalLinkCID2', t('Choose Page:'))?>
	<?php echo Core::make('helper/form/page_selector')->selectPage('internalLinkCID2', $internalLinkCID2); ?>
</div>

<div id="imageLinkTypeExternal2" style="display: none;" class="form-group">
	<?php echo $form->label('externalLink2', t('URL'))?>
	<?php echo $form->text('externalLink2', $externalLink2, array('style'=>'width: 60%;')); ?>
</div>

</fieldset>


<script type="text/javascript">
refreshImageLinkTypeControls = function() {
	var linkType = $('#imageLinkType').val();
	$('#imageLinkTypePage').toggle(linkType == 1);
	$('#imageLinkTypeExternal').toggle(linkType == 2);
}

refreshImageLinkTypeControls2 = function() {
	var linkType2 = $('#imageLinkType2').val();
	$('#imageLinkTypePage2').toggle(linkType2 == 1);
	$('#imageLinkTypeExternal2').toggle(linkType2 == 2);
}

$(document).ready(function() {
	$('#imageLinkType').change(refreshImageLinkTypeControls);
	$('#imageLinkType2').change(refreshImageLinkTypeControls2);

    $('div[data-checkbox-wrapper=constrain-image] input').on('change', function() {
        if ($(this).is(':checked')) {
            $('div[data-fields=constrain-image]').show();
        } else {
            $('div[data-fields=constrain-image]').hide();
        }
    }).trigger('change');

	refreshImageLinkTypeControls();
});
</script>
