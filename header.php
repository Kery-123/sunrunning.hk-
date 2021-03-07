<?php
    $document = JFactory::getDocument();
?>
    <header class="u-align-center-xs u-clearfix u-header u-white u-header" id="sec-44cb" data-image-width="1688" data-image-height="224">
  <div class="u-clearfix u-sheet u-sheet-1">
    <?php $logoInfo = getLogoInfo(array(
            'src' => "/images/Final_Project_Logo1.png",
            'href' => "https://nicepage.com",
            'default_width' => '202'
        ), true); ?><a href="<?php echo $logoInfo['href']; ?>" class="u-image u-logo u-image-1" data-image-width="920" data-image-height="421">
      <img src="<?php echo $logoInfo['src']; ?>" class="u-logo-image u-logo-image-1" data-image-width="202.6487">
    </a>
    <?php echo CoreStatements::position('hmenu', '', 1, 'hmenu'); ?>
  </div>
</header>
    