<?php

namespace Application\Block\PixCtaHomeHero;

use Core;
use Database;
use File;
use Page;
use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 550;
    protected $btTable = 'btPixCtaHomeHero';
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btWrapperClass = 'ccm-ui';
    protected $btExportFileColumns = array('fID');
    protected $btExportPageColumns = array('internalLinkCID');
    protected $btFeatures = array(
        'image',
    );

    /**
     * Used for localization. If we want to localize the name/description we have to include this.
     */
    public function getBlockTypeDescription()
    {
        return t("Hero text, desciption, and buttons for homepage.");
    }

    public function getBlockTypeName()
    {
        return t("Home Hero CTA - piXlogic");
    }

    public function registerViewAssets($outputContent = '')
    {
        // Ensure we have JQuery if we have an onState image
        if (is_object($this->getFileOnstateObject())) {
            $this->requireAsset('javascript', 'jquery');
        }
    }

    public function view()
    {
        $f = File::getByID($this->fID);

        $this->set('fImg', File::getByID($this->fID));
        $this->set('f', $f);
        $this->set('altText', $this->getAltText());
        $this->set('altText2', $this->getAltText2());
        $this->set('linkURL', $this->getLinkURL());
        $this->set('linkURL2', $this->getLinkURL2());
    }

    public function getJavaScriptStrings()
    {
        return array(
            'image-required' => t('You must select an image.'),
        );
    }

    public function isComposerControlDraftValueEmpty()
    {
        $f = $this->getFileObject();
        if (is_object($f) && !$f->isError()) {
            return false;
        }

        return true;
    }

    public function getImageFeatureDetailFileObject()
    {
        // i don't know why this->fID isn't sticky in some cases, leading us to query
        // every damn time
        $db = Database::connection();
        $fID = $db->fetchColumn('select fID from btPixCtaHomeHero where bID = ?', array($this->bID), 0);
        if ($fID) {
            $f = File::getByID($fID);
            if (is_object($f) && !$f->isError()) {
                return $f;
            }
        }
    }

    public function getFileID()
    {
        return $this->fID;
    }

    public function getFileOnstateID()
    {
        return $this->fOnstateID;
    }

    public function getFileOnstateObject()
    {
        if ($this->fOnstateID) {
            return File::getByID($this->fOnstateID);
        }
    }

    public function getFileObject()
    {
        return File::getByID($this->fID);
    }

    public function getAltText()
    {
        return $this->altText;
    }

    public function getAltText2()
    {
        return $this->altText2;
    }

    public function getExternalLink()
    {
        return $this->externalLink;
    }

    public function getInternalLinkCID()
    {
        return $this->internalLinkCID;
    }

    public function getLinkURL()
    {
        if (!empty($this->externalLink)) {
            $sec = \Core::make('helper/security');

            return $sec->sanitizeURL($this->externalLink);
        } elseif (!empty($this->internalLinkCID)) {
            $linkToC = Page::getByID($this->internalLinkCID);

            return (empty($linkToC) || $linkToC->error) ? '' : Core::make('helper/navigation')->getLinkToCollection($linkToC);
        } else {
            return '';
        }
    }

    public function getExternalLink2()
    {
        return $this->externalLink2;
    }

    public function getInternalLinkCID2()
    {
        return $this->internalLinkCID2;
    }

    public function getLinkURL2()
    {
        if (!empty($this->externalLink2)) {
            $sec = \Core::make('helper/security');

            return $sec->sanitizeURL($this->externalLink2);
        } elseif (!empty($this->internalLinkCID2)) {
            $linkToC = Page::getByID($this->internalLinkCID2);

            return (empty($linkToC) || $linkToC->error) ? '' : Core::make('helper/navigation')->getLinkToCollection($linkToC);
        } else {
            return '';
        }
    }

    public function validate_composer()
    {
        $f = $this->getFileObject();
        $e = Core::make('helper/validation/error');
        if (!is_object($f) || $f->isError() || !$f->getFileID()) {
            $e->add(t('You must specify a valid image file.'));
        }

        return $e;
    }

    public function save($args)
    {
        $args = $args + array(
            'fID' => 0,
            'fOnstateID' => 0,
            'maxWidth' => 0,
            'maxHeight' => 0,
            'constrainImage' => 0,
            'linkType' => 0,
            'externalLink' => '',
            'internalLinkCID' => 0,
        );
        $args['fID'] = ($args['fID'] != '') ? $args['fID'] : 0;
        $args['fOnstateID'] = ($args['fOnstateID'] != '') ? $args['fOnstateID'] : 0;
        $args['maxWidth'] = (intval($args['maxWidth']) > 0) ? intval($args['maxWidth']) : 0;
        $args['maxHeight'] = (intval($args['maxHeight']) > 0) ? intval($args['maxHeight']) : 0;
        if (!$args['constrainImage']) {
            $args['maxWidth'] = 0;
            $args['maxHeight'] = 0;
        }
        switch (intval($args['linkType'])) {
            case 1:
                $args['externalLink'] = '';
                break;
            case 2:
                $args['internalLinkCID'] = 0;
                break;
            default:
                $args['externalLink'] = '';
                $args['internalLinkCID'] = 0;
                break;
        }
        unset($args['linkType']); //this doesn't get saved to the database (it's only for UI usage)
        parent::save($args);
    }
}
