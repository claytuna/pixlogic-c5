<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage()?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath()?>/css/bootstrap-modified.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <?php echo $html->css($view->getStylesheet('main.less'))?>
    <?php Loader::element('header_required', array('pageTitle' => isset($pageTitle) ? $pageTitle : '', 'pageDescription' => isset($pageDescription) ? $pageDescription : '', 'pageMetaKeywords' => isset($pageMetaKeywords) ? $pageMetaKeywords : ''));?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if(!$c->isEditMode()){ ?>
    <script type="text/javascript" src="<?php echo $view->getThemePath()?>/js/jquery-3.1.1.min.js"></script>
    <?php }?>
</head>
<body>

<div class="pixlogic <?php echo $c->getPageWrapperClass()?>"><!--OPEN PAGEWRAP CLASS; see footer for closing-->
