<?php defined('C5_EXECUTE') or die("Access Denied.");

$fp = FilePermissions::getGlobal();
$tp = new TaskPermission();
$form = Loader::helper('form');

echo Core::make('helper/concrete/ui')->tabs(array(
    array('slides', t('Value Props'), true),
    array('options', t('Content'))
));
?>

<script>
    var CCM_EDITOR_SECURITY_TOKEN = "<?php echo Core::make('helper/validation/token')->generate('editor'); ?>";
    $(document).ready(function() {
        var ccmReceivingEntry = '';
        var sliderEntriesContainer = $('.ccm-image-slider-entries');
        var _templateSlide = _.template($('#imageTemplate').html());

        var attachDelete = function($obj) {
            $obj.click(function() {
                var deleteIt = confirm('<?php echo t('Are you sure?'); ?>');
                if (deleteIt === true) {
                    $(this).closest('.ccm-image-slider-entry').remove();
                    doSortCount();
                }
            });
        };

        var attachFileManagerLaunch = function($obj) {
            $obj.click(function() {
                var oldLauncher = $(this);
                ConcreteFileManager.launchDialog(function(data) {
                    ConcreteFileManager.getFileDetails(data.fID, function(r) {
                        jQuery.fn.dialog.hideLoader();
                        var file = r.files[0];
                        oldLauncher.html(file.resultsThumbnailImg);
                        oldLauncher.next('.image-fID').val(file.fID);
                    });
                });
            });
        };

        var doSortCount = function() {
            $('.ccm-image-slider-entry').each(function(index) {
                $(this).find('.ccm-image-slider-entry-sort').val(index);
            });
        };

        sliderEntriesContainer.on('change', 'select[data-field=entry-link-select]', function() {
            var container = $(this).closest('.ccm-image-slider-entry');
            switch (parseInt($(this).val())) {
                case 2:
                    container.find('div[data-field=entry-link-page-selector]').addClass('hide-slide-link').removeClass('show-slide-link');
                    container.find('div[data-field=entry-link-url]').addClass('show-slide-link').removeClass('hide-slide-link');
                    break;
                case 1:
                    container.find('div[data-field=entry-link-url]').addClass('hide-slide-link').removeClass('show-slide-link');
                    container.find('div[data-field=entry-link-page-selector]').addClass('show-slide-link').removeClass('hide-slide-link');
                    break;
                default:
                    container.find('div[data-field=entry-link-page-selector]').addClass('hide-slide-link').removeClass('show-slide-link');
                    container.find('div[data-field=entry-link-url]').addClass('hide-slide-link').removeClass('show-slide-link');
                    break;
            }
        });

        <?php if ($rows) {
            foreach ($rows as $row) {
                $linkType = 0;
                if ($row['linkURL']) {
                    $linkType = 2;
                } else if ($row['internalLinkCID']) {
                    $linkType = 1;
               } ?>
               sliderEntriesContainer.append(_templateSlide({
                    fID: '<?php echo $row['fID']; ?>',
                    <?php if (File::getByID($row['fID'])) { ?>
                    image_url: '<?php echo File::getByID($row['fID'])->getThumbnailURL('file_manager_listing'); ?>',
                    <?php } else { ?>
                    image_url: '',
                   <?php } ?>
                    link_url: '<?php echo $row['linkURL']; ?>',
                    link_type: '<?php echo $linkType; ?>',
                    title: '<?php echo addslashes(h($row['title'])); ?>',
                    description: '<?php echo str_replace(array("\t", "\r", "\n"), "", addslashes(h($row['description']))); ?>',
                    sort_order: '<?php echo $row['sortOrder']; ?>'
                }));
                sliderEntriesContainer.find('.ccm-image-slider-entry:last-child div[data-field=entry-link-page-selector]').concretePageSelector({
                    'inputName': 'internalLinkCID[]', 'cID': <?php if ($linkType == 1) { ?><?php echo intval($row['internalLinkCID']); ?><?php } else { ?>false<?php } ?>
                });
            <?php }
        } ?>

        doSortCount();
        sliderEntriesContainer.find('select[data-field=entry-link-select]').trigger('change');

        $('.ccm-add-image-slider-entry').click(function() {
            var thisModal = $(this).closest('.ui-dialog-content');
            sliderEntriesContainer.append(_templateSlide({
                fID: '',
                title: '',
                link_url: '',
                cID: '',
                description: '',
                link_type: 0,
                sort_order: '',
                image_url: ''
            }));

            $('.ccm-image-slider-entry').not('.slide-closed').each(function() {
                $(this).addClass('slide-closed');
                var thisEditButton = $(this).closest('.ccm-image-slider-entry').find('.btn.ccm-edit-slide');
                thisEditButton.text(thisEditButton.data('slideEditText'));
            });
            var newSlide = $('.ccm-image-slider-entry').last();
            var closeText = newSlide.find('.btn.ccm-edit-slide').data('slideCloseText');
            newSlide.removeClass('slide-closed').find('.btn.ccm-edit-slide').text(closeText);

            thisModal.scrollTop(newSlide.offset().top);
            newSlide.find('.redactor-content').redactor({
                minHeight: 200,
                'concrete5': {
                    filemanager: <?php echo $fp->canAccessFileManager(); ?>,
                    sitemap: <?php echo $tp->canAccessSitemap(); ?>,
                    lightbox: true
                }
            });
            attachDelete(newSlide.find('.ccm-delete-image-slider-entry'));
            attachFileManagerLaunch(newSlide.find('.ccm-pick-slide-image'));
            newSlide.find('div[data-field=entry-link-page-selector-select]').concretePageSelector({
                'inputName': 'internalLinkCID[]'
            });
            doSortCount();
        });

        $('.ccm-image-slider-entries').on('click','.ccm-edit-slide', function() {
            $(this).closest('.ccm-image-slider-entry').toggleClass('slide-closed');
            var thisEditButton = $(this).closest('.ccm-image-slider-entry').find('.btn.ccm-edit-slide');
            if (thisEditButton.data('slideEditText') === thisEditButton.text()) {
                thisEditButton.text(thisEditButton.data('slideCloseText'));
            } else if (thisEditButton.data('slideCloseText') === thisEditButton.text()) {
                thisEditButton.text(thisEditButton.data('slideEditText'));
            }
        });

        $('.ccm-image-slider-entries').sortable({
            placeholder: "ui-state-highlight",
            axis: "y",
            handle: "i.fa-arrows",
            cursor: "move",
            update: function() {
                doSortCount();
            }
        });

        attachDelete($('.ccm-delete-image-slider-entry'));
        attachFileManagerLaunch($('.ccm-pick-slide-image'));
        $(function() {  // activate redactors
            $('.redactor-content').redactor({
                minHeight: 200,
                'concrete5': {
                    filemanager: <?php echo $fp->canAccessFileManager(); ?>,
                    sitemap: <?php echo $tp->canAccessSitemap(); ?>,
                    lightbox: true
                }
            });
        });
    });
</script>
<style>
    .ccm-image-slider-block-container .redactor_editor {
        padding: 20px;
    }
    .ccm-image-slider-block-container input[type="text"],
    .ccm-image-slider-block-container textarea {
        display: block;
        width: 100%;
    }
    .ccm-image-slider-block-container .btn-success {
        margin-bottom: 20px;
    }
    .ccm-image-slider-entries {
        padding-bottom: 30px;
    }
    .ccm-image-slider-block-container .slide-well {
        min-height: 20px;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #f5f5f5;
        border: 1px solid #e3e3e3;
        border-radius: 4px;
        -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05);
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05);
        box-shadow: inset 0 1px 1px rgba(0,0,0,0.05);
    }
    .ccm-pick-slide-image {
        padding: 5px;
        cursor: pointer;
        background: #dedede;
        border: 1px solid #cdcdcd;
        text-align: center;
        vertical-align: middle;
        width: 72px;
        height: 72px;
        display: table-cell;
    }
    .ccm-pick-slide-image img {
        max-width: 100%;
    }
    .ccm-image-slider-entry {
        position: relative;
    }
    .ccm-image-slider-entry.slide-closed .form-group {
        display: none;
    }
    .ccm-image-slider-entry.slide-closed .form-group:first-of-type {
        display: block;
        margin-bottom: 0px;
    }
    .ccm-image-slider-entry.slide-closed .form-group:first-of-type label {
        display: none;
    }
    .btn.ccm-edit-slide {
        position: absolute;
        top: 10px;
        right: 127px;
    }
    .btn.ccm-delete-image-slider-entry {
        position: absolute;
        top: 10px;
        right: 41px;
    }
    .ccm-image-slider-block-container i:hover {
        color: #428bca;
    }
    .ccm-image-slider-block-container i.fa-arrows {
        position: absolute;
        top: 6px;
        right: 5px;
        cursor: move;
        font-size: 20px;
        padding: 5px;
    }
    .ccm-image-slider-block-container .ui-state-highlight {
        height: 94px;
        margin-bottom: 15px;
    }
    .ccm-image-slider-entries .ui-sortable-helper {
        -webkit-box-shadow: 0px 10px 18px 2px rgba(54,55,66,0.27);
        -moz-box-shadow: 0px 10px 18px 2px rgba(54,55,66,0.27);
        box-shadow: 0px 10px 18px 2px rgba(54,55,66,0.27);
    }
    .ccm-image-slider-block-container .show-slide-link {
        display: block;
    }
    .ccm-image-slider-block-container .hide-slide-link {
        display: none;
    }
</style>

<?php
/*************************************
 INITIALIZE AND TEST FEATURE IMAGE
**************************************/
$bf = null;

if ($controller->getFileID() > 0) {
	$bf = $controller->getFileObject();
}

$args = array();
?>

<div id="ccm-tab-content-options" class="ccm-tab-content">
  <legend><?php echo t('Featured Content')?></legend>
  <div class="form-group">
    <?php echo $form->label('featureTitle', t('Feature Title'))?>
    <?php echo $form->text('featureTitle', $featureTitle, array('style'=>'width: 100%;')); ?>
  </div>

  <div class="form-group">
    <?php echo $form->label('featureDescription', t('Feature Description'))?>
    <?php echo $form->textarea('featureDescription', $featureDescription, array('style'=>'width: 100%;')); ?>
  </div>
  <div class="form-group">
  	<label class="control-label">Image</label>
  			<div class="ccm-file-selector" data-file-selector="ccm-b-image"></div>
  		<script type="text/javascript">
  		$(function() {
  			$('[data-file-selector=ccm-b-image]').concreteFileSelector({'inputName': 'bfID', 'filters': [{"field":"type","type":1}], 'chooseText': "Choose Image" });
  		});
  		</script>
  </div>

  <div class="form-group">
  	<?php echo $form->label('buttonText', t('Button Text'))?>
  	<?php echo $form->text('buttonText', $buttonText, array('style'=>'width: 60%;')); ?>
  </div>

  <div class="form-group">
  	<?php echo $form->label('buttonLinkType', t('Button Link'))?>
  	<select name="buttonLinkType" id="buttonLinkType" class="form-control" style="width: 80%;">
  		<option value="0" <?php echo (empty($buttonExternalLink) && empty($buttonInternalLinkCID) ? 'selected="selected"' : '')?>><?php echo t('None')?></option>
  		<option value="1" <?php echo (empty($buttonExternalLink) && !empty($buttonInternalLinkCID) ? 'selected="selected"' : '')?>><?php echo t('Another Page')?></option>
  		<option value="2" <?php echo (!empty($buttonExternalLink) ? 'selected="selected"' : '')?>><?php echo t('External URL')?></option>
  	</select>
  </div>

  <div id="buttonLinkTypePage" style="display: none;" class="form-group">
  	<?php echo $form->label('buttonInternalLinkCID', t('Choose Page:'))?>
  	<?php echo Core::make('helper/form/page_selector')->selectPage('buttonInternalLinkCID', $buttonInternalLinkCID); ?>
  </div>

  <div id="buttonLinkTypeExternal" style="display: none;" class="form-group">
  	<?php echo $form->label('buttonExternalLink', t('URL'))?>
  	<?php echo $form->text('buttonExternalLink', $buttonExternalLink, array('style'=>'width: 60%;')); ?>
  </div>
</div>

<script type="text/javascript">
refreshButtonLinkTypeControls = function() {
	var linkType = $('#buttonLinkType').val();
	$('#buttonLinkTypePage').toggle(linkType == 1);
	$('#buttonLinkTypeExternal').toggle(linkType == 2);
}

$(document).ready(function() {
	$('#buttonLinkType').change(refreshButtonLinkTypeControls);

    $('div[data-checkbox-wrapper=constrain-image] input').on('change', function() {
        if ($(this).is(':checked')) {
            $('div[data-fields=constrain-image]').show();
        } else {
            $('div[data-fields=constrain-image]').hide();
        }
    }).trigger('change');
	refreshButtonLinkTypeControls();
});
</script>

<div id="ccm-tab-content-slides" class="ccm-tab-content">
    <div class="ccm-image-slider-block-container">
        <div class="ccm-image-slider-entries">

        </div>
        <div>
            <button type="button" class="btn btn-success ccm-add-image-slider-entry"><?php echo t('Add Value Prop'); ?></button>
        </div>
    </div>
</div>


<script type="text/template" id="imageTemplate">
    <div class="ccm-image-slider-entry slide-well slide-closed">
        <button type="button" class="btn btn-default ccm-edit-slide" data-slide-close-text="<?php echo t('Collapse Value Prop'); ?>" data-slide-edit-text="<?php echo t('Edit Value Prop'); ?>"><?php echo t('Edit Value Prop'); ?></button>
        <button type="button" class="btn btn-danger ccm-delete-image-slider-entry"><?php echo t('Remove'); ?></button>
        <i class="fa fa-arrows"></i>
        <!--div class="form-group">
            <label><?php echo t('Value Prop Image'); ?></label>
            <div class="ccm-pick-slide-image">
                <% if (image_url.length > 0) { %>
                    <img src="<%= image_url %>" />
                <% } else { %>
                    <i class="fa fa-picture-o"></i>
                <% } %>
            </div>
            <input type="hidden" name="<?php echo $view->field('fID'); ?>[]" class="image-fID" value="<%=fID%>" />
        </div-->
        <br/>
        <div class="form-group" >
            <label><?php echo t('Value Prop Title'); ?></label>
            <input type="text" name="<?php echo $view->field('title'); ?>[]" value="<%=title%>" />
        </div>
        <div class="form-group" >
            <label><?php echo t('Value Prop Description'); ?></label>
            <div class="redactor-edit-content"></div>
            <textarea style="display: none" class="redactor-content" name="<?php echo $view->field('description'); ?>[]"><%=description%></textarea>
        </div>
        <!--div class="form-group" >
           <label><?php echo t('Link'); ?></label>
            <select data-field="entry-link-select" name="linkType[]" class="form-control" style="width: 60%;">
                <option value="0" <% if (!link_type) { %>selected<% } %>><?php echo t('None'); ?></option>
                <option value="1" <% if (link_type == 1) { %>selected<% } %>><?php echo t('Another Page'); ?></option>
                <option value="2" <% if (link_type == 2) { %>selected<% } %>><?php echo t('External URL'); ?></option>
            </select>
        </div>
        <div data-field="entry-link-url" class="form-group hide-slide-link">
           <label><?php echo t('URL:'); ?></label>
            <textarea name="linkURL[]"><%=link_url%></textarea>
        </div>
        <div data-field="entry-link-page-selector" class="form-group hide-slide-link">
           <label><?php echo t('Choose Page:'); ?></label>
            <div data-field="entry-link-page-selector-select"></div>
        </div-->
        <input class="ccm-image-slider-entry-sort" type="hidden" name="<?php echo $view->field('sortOrder'); ?>[]" value="<%=sort_order%>"/>
    </div>
</script>
