<?php
namespace Application\Block\PixFeaturedArticles;

use Concrete\Core\Block\BlockController;
use Database;
use Page;
use Concrete\Core\Editor\LinkAbstractor;
use Core;

class Controller extends BlockController
{
    protected $btTable = 'btPixFeaturedArticles';
    protected $btExportTables = array('btPixFeaturedArticles', 'btPixFeaturedArticlesEntries');
    protected $btInterfaceWidth = "600";
    protected $btWrapperClass = 'ccm-ui';
    protected $btInterfaceHeight = "850";
    protected $btCacheBlockRecord = true;
    protected $btExportFileColumns = array('fID');
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = false;
    protected $btIgnorePageThemeGridFrameworkContainer = true;

    public function getBlockTypeDescription()
    {
        return t("Choose upcoming events pages to feature in a News & Events list.");
    }

    public function getBlockTypeName()
    {
        return t("Featured Articles - piXlogic");
    }

    public function getSearchableContent()
    {
        $content = '';
        $db = Database::get();
        $v = array($this->bID);
        $q = 'select * from btPixFeaturedArticlesEntries where bID = ?';
        $r = $db->query($q, $v);
        foreach ($r as $row) {
            $content .= $row['title'].' ';
            $content .= $row['description'].' ';
        }

        return $content;
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
        $db = Database::get();
        $query = $db->GetAll('SELECT * from btPixFeaturedArticlesEntries WHERE bID = ? ORDER BY sortOrder', array($this->bID));
        $this->set('rows', $query);
    }

    public function composer()
    {
        $this->edit();
    }

    public function registerViewAssets($outputContent = '')
    {
        $al = \Concrete\Core\Asset\AssetList::getInstance();

        $this->requireAsset('javascript', 'jquery');
        $this->requireAsset('responsive-slides');


        $al->register('javascript', 'responsiveslides', 'blocks/image_slider/responsiveslides.js');
        $this->requireAsset('javascript', 'blocks/image_slider/responsiveslides');

        $al->register('css', 'responsiveslides', 'blocks/image_slider/responsiveslides.css');
        $this->requireAsset('css', 'blocks/image_slider/responsiveslides');
    }

    public function getBtnURL()
    {
        if (!empty($this->btnExternalLink)) {
            $sec = \Core::make('helper/security');

            return $sec->sanitizeURL($this->btnExternalLink);
        } elseif (!empty($this->btnInternalLinkCID)) {
            $linkToC = Page::getByID($this->btnInternalLinkCID);

            return (empty($linkToC) || $linkToC->error) ? '' : Core::make('helper/navigation')->getLinkToCollection($linkToC);
        } else {
            return '';
        }
    }

    public function getEntries()
    {
        $db = Database::get();
        $r = $db->GetAll('SELECT * from btPixFeaturedArticlesEntries WHERE bID = ? ORDER BY sortOrder', array($this->bID));
        // in view mode, linkURL takes us to where we need to go whether it's on our site or elsewhere
        $rows = array();
        foreach ($r as $q) {
            if (!$q['linkURL'] && $q['internalLinkCID']) {
                $c = Page::getByID($q['internalLinkCID'], 'ACTIVE');
                $q['linkURL'] = $c->getCollectionLink();
                $q['linkPage'] = $c;
            }
            $q['description'] = LinkAbstractor::translateFrom($q['description']);
            $rows[] = $q;
        }

        return $rows;
    }

    public function view()
    {
        $this->set('rows', $this->getEntries());
        $this->set('btnURL', $this->getBtnURL());
    }

    public function duplicate($newBID)
    {
        parent::duplicate($newBID);
        $db = Database::get();
        $v = array($this->bID);
        $q = 'select * from btPixFeaturedArticlesEntries where bID = ?';
        $r = $db->query($q, $v);
        while ($row = $r->FetchRow()) {
            $db->execute('INSERT INTO btImageSliderEntries (bID, fID, linkURL, title, description, sortOrder, internalLinkCID) values(?,?,?,?,?,?,?)',
                array(
                    $newBID,
                    $row['fID'],
                    $row['linkURL'],
                    $row['title'],
                    $row['description'],
                    $row['sortOrder'],
                    $row['internalLinkCID'],
                )
            );
        }
    }

    public function delete()
    {
        $db = Database::get();
        $db->delete('btPixFeaturedArticlesEntries', array('bID' => $this->bID));
        parent::delete();
    }

    public function validate($args)
    {
    }

    public function save($args)
    {
        switch (intval($args['buttonLinkType'])) {
            case 1:
                $args['btnExternalLink'] = '';
                break;
            case 2:
                $args['btnInternalLinkCID'] = 0;
                break;
            default:
                $args['btnExternalLink'] = '';
                $args['btnInternalLinkCID'] = 0;
                break;
        }
        unset($args['buttonLinkType']); 

        $args['sliderTitle'] = isset($args['sliderTitle']) ? $args['sliderTitle'] : "Upcoming Events";

        $db = Database::get();
        $db->execute('DELETE from btPixFeaturedArticlesEntries WHERE bID = ?', array($this->bID));
        parent::save($args);
        if (isset($args['sortOrder'])) {
            $count = count($args['sortOrder']);
            $i = 0;

            while ($i < $count) {
                $linkURL = $args['linkURL'][$i];
                $internalLinkCID = $args['internalLinkCID'][$i];
                switch (intval($args['linkType'][$i])) {
                    case 1:
                        $linkURL = '';
                        break;
                    case 2:
                        $internalLinkCID = 0;
                        break;
                    default:
                        $linkURL = '';
                        $internalLinkCID = 0;
                        break;
                }

                if (isset($args['description'][$i])) {
                    $args['description'][$i] = LinkAbstractor::translateTo($args['description'][$i]);
                }

                $db->execute('INSERT INTO btPixFeaturedArticlesEntries (bID, fID, title, description, sortOrder, linkURL, internalLinkCID) values(?, ?, ?, ?,?,?,?)',
                    array(
                        $this->bID,
                        intval($args['fID'][$i]),
                        $args['title'][$i],
                        $args['description'][$i],
                        $args['sortOrder'][$i],
                        $linkURL,
                        $internalLinkCID,
                    )
                );
                ++$i;
            }
        }
    }
}
