<?php

namespace Application\Block\PixTitleGroup;

use Core;
use Database;
use File;
use Page;
use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 350;
    protected $btTable = 'btPixTitleGroup';
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btWrapperClass = 'ccm-ui';

    /**
     * Used for localization. If we want to localize the name/description we have to include this.
     */
    public function getBlockTypeDescription()
    {
        return t("Adds an intro title and a title");
    }

    public function getBlockTypeName()
    {
        return t("Title Group - piXlogic");
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
        $this->set('intro', $this->getIntroText());
        $this->set('title', $this->getTitle());
    }

    public function getIntroText()
    {
        return $this->intro;
    }

    public function getTitle()
    {
        return isset($this->title) ? $this->title : '';
    }
    public function save($args)
    {
        parent::save($args);
    }
}
