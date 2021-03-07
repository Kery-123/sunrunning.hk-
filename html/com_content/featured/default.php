<?php
defined('_JEXEC') or die;

$styles = dirname(__FILE__) . '/default_styles.php';
if (file_exists($styles)) {
    ob_start();
    include_once dirname(__FILE__) . '/default_styles.php';
    JFactory::getDocument()->addCustomTag(ob_get_clean());
}

$themePath = dirname(dirname(dirname(dirname(__FILE__))));
require_once $themePath . DIRECTORY_SEPARATOR . 'functions.php';


Core::load("Core_Content");

$component = new CoreContent($this, $this->params);
$allItems = array_merge($this->lead_items, $this->intro_items);
$all = count($allItems);

$document = JFactory::getDocument();
$document->bodyClass = 'u-body';
$document->bodyStyle = "";
$document->localFontsFile = "";
$document->backToTop=<<<BACKTOTOP

BACKTOTOP;
?>
<?php

$funcsInfo = array(
   array('repeatable' => true, 'name' => 'blogTemplate_0', 'itemsExists' => true),

);

$funcsStaticInfo = array(
   array('repeatable' => false, 'name' => 'blogTemplate_1', 'count' => 0),

);

echo $component->pageHeading();

if ($this->params->get('page_subheading')) {
    echo '<section class="u-clearfix"><div class="u-clearfix u-sheet"><h2>';
    echo $this->params->get('page_subheading');
    echo '</h2></div></section>';
}

if (count($funcsInfo)) {
    foreach ($funcsInfo as $funcInfo) {
        if (!$funcInfo['itemsExists']) {
            include $themePath . '/views/' . $funcInfo['name'] . '.php';
            continue;
        }
        if (file_exists($themePath . '/views/' . $funcInfo['name'] . '_start.php')) {
            include $themePath . '/views/' . $funcInfo['name'] . '_start.php';
        }

        $imagesEtalonItems = array();
        $imagesJsonPath = $themePath . '/views/images.json';
        if (file_exists($imagesJsonPath)) {
            ob_start();
            include_once $imagesJsonPath;
            $imagesEtalonItems = json_decode(ob_get_clean(), true);
        }
        $imagesEtalonItem = isset($imagesEtalonItems[$funcInfo['name']]) ? $imagesEtalonItems[$funcInfo['name']] : array();

        foreach ($allItems as $item) {
            $j = 0;
            $article = $component->article('featured', $item, $item->params);
            ${'title' . $j} = strlen($article->title) ? $this->escape($article->title) : '';
            ${'titleLink' . $j} = strlen($article->titleLink) ? $article->titleLink : '';
            ${'readmore' . $j} = strlen($article->readmore) ? $article->readmore : '';
            ${'readmoreLink' . $j} = strlen($article->readmoreLink) ? $article->readmoreLink : '';
            ${'shareLink' . $j} = strlen($article->shareLink) ? $article->shareLink : '';
            ${'content' . $j} = $article->intro(funcBalanceTags($article->intro));

            if ($article->images['intro']['image']) {
                $image = $article->images['intro']['image'];
            } else {
                $imagesPostItem = property_exists($item, 'pageIntroImgStruct') ? $item->pageIntroImgStruct : array();
                $image = getProportionImage($imagesPostItem, $imagesEtalonItem);
            }


            ${'image' . $j} = $image;
            ${'tags' . $j} = count($article->tags) > 0 ? implode('', $article->tags) : '';

            ${'metadata' . $j} = array();
            if (strlen($article->author)) {
                ${'metadata' . $j}['author'] = $article->authorInfo($article->author, $article->authorLink);
            }
            if (strlen($article->published)) {
                ${'metadata' . $j}['date'] = $article->publishedDateInfo($article->published);
            }
            if (strlen($article->category)) {
                ${'metadata' . $j}['category'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
            }
            if ($item->params->get('access-edit')) {
                ${'metadata' . $j}['edit'] = $article->editIcon();
            }
            include $themePath . '/views/' . $funcInfo['name'] . '.php';
        }
        if (file_exists($themePath . '/views/' . $funcInfo['name'] . '_end.php')) {
            include $themePath . '/views/' . $funcInfo['name'] . '_end.php';
        }
    }
}

if (count($funcsStaticInfo)) {
    for ($i = 0; $i < count($funcsStaticInfo); $i++) {
        include_once $themePath . '/views/' . $funcsStaticInfo[$i]['name'] . '.php';
    }
}
?>