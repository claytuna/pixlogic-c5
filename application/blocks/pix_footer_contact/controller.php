<?php

namespace Application\Block\PixFooterContact;

use Core;
use Database;
use File;
use Page;
use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 550;
    protected $btTable = 'btPixFooterContact';
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btWrapperClass = 'ccm-ui';
    protected $btExportFileColumns = array('fID');
    protected $btFeatures = array(
        'image',
    );

    /**
     * Used for localization. If we want to localize the name/description we have to include this.
     */
    public function getBlockTypeDescription()
    {
        return t("Adds a footer contact info block with an phone, email, address");    }

    public function getBlockTypeName()
    {
        return t("Footer Contact Info - piXlogic");
    }

    public function registerViewAssets($outputContent = '')
    {
    }

    public function add()
    {
        $this->requireAsset('core/file-manager');
        $this->requireAsset('core/sitemap');
        $this->requireAsset('redactor');
    }

    public function edit()
    {
        $this->requireAsset('core/file-manager');
        $this->requireAsset('core/sitemap');
        $this->requireAsset('redactor');
    }

    public function view()
    {
        $f = File::getByID($this->fID);
        if (!is_object($f) || !$f->getFileID()) {
            return false;
        }

        // onState image available
        if (is_object($foS)) {
            $imgPath = array();
            $imgPath['default'] = File::getRelativePathFromID($this->fID);
            $this->set('imgPath', $imgPath);
            $this->set('foS', $foS);
        }

        $this->set('f', $f);
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
        $fID = $db->fetchColumn('select fID from btPixFooterContact where bID = ?', array($this->bID), 0);
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

    public function getFileObject()
    {
        return File::getByID($this->fID);
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
        $args['fID'] = ($args['fID'] != '') ? $args['fID'] : 0;
        parent::save($args);
    }
}
