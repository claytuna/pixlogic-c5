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

    <legend><?php echo t('Solution Icon')?></legend>
<?php
$args = array();

?>

<div class="form-group">
	<label class="control-label"><?php echo t('Icon')?></label>
	<?php echo $al->image('ccm-b-image', 'fID', t('Choose Image'), $bf, $args);?>
</div>

<div class="form-group">
	<?php echo $form->label('altText', t('Icon Alt Text'))?>
	<?php echo $form->text('altText', $altText, array('style'=>'width: 60%;')); ?>
</div>

</fieldset>
<hr/>

<fieldset>
    <legend><?php echo t('Solution Text')?></legend>

<!--div class="form-group">
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
</div-->

<div class="form-group">
	<?php echo $form->label('title', t('Title'))?>
	<?php echo $form->text('title', $title, array('style'=>'width: 60%;')); ?>
</div>

<div class="form-group">
	<?php echo $form->label('description', t('Description'))?>
	<?php echo $form->textarea('description', $description, array('style'=>'width: 100%;')); ?>
</div>

</fieldset>


<script type="text/javascript">
refreshImageLinkTypeControls = function() {
	var linkType = $('#imageLinkType').val();
	$('#imageLinkTypePage').toggle(linkType == 1);
	$('#imageLinkTypeExternal').toggle(linkType == 2);
}

$(document).ready(function() {
	$('#imageLinkType').change(refreshImageLinkTypeControls);

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
