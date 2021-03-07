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
$allItems = $this->items;
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

if ($this->params->get('show_page_heading')) {
    echo '<section class="u-clearfix"><div class="u-clearfix u-sheet"><h1>';
    echo $this->params->get('page_heading');
    echo '</h1></div></section>';
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
        foreach ($allItems as $item) {
            $j = 0;
            $article = $component->article('archive', $item, $item->params);

            ${'title' . $j} = strlen($article->title) ? $this->escape($article->title) : '';
            ${'titleLink' . $j} = strlen($article->titleLink) ? $article->titleLink : '';

            // Readmore button not need on archive blog
            ${'readmore' . $j} = '';
            ${'readmoreLink' . $j} = '';

            ${'shareLink' . $j} = strlen($article->shareLink) ? $article->shareLink : '';
            ${'content' . $j} = $article->intro(funcBalanceTags($article->intro));
            ${'image' . $j} = null;
            ${'tags' . $j} = null;

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