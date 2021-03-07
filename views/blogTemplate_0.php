<!--blog_post-->
      <div class="u-blog-post u-container-style u-repeater-item u-white u-repeater-item-1">
        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1"><!--blog_post_header-->
          <?php if ($title0): ?><h4 class="u-blog-control u-text u-text-1">
            <?php if ($titleLink0): ?><a class="u-post-header-link" href="<?php echo $titleLink0; ?>"><?php endif; ?><?php echo $title0; ?><?php if ($titleLink0): ?></a><?php endif; ?>
          </h4><?php endif; ?><!--/blog_post_header--><!--blog_post_image-->
          <?php if ($image0) : ?><a class="u-blog-control u-expanded-width u-image u-image-default u-image-1" href="<?php $link = $titleLink0 ? $titleLink0 : $readmoreLink0; if($link): echo $link; endif; ?>"><img alt="" class="u-blog-control u-expanded-width u-image u-image-default u-image-1" src="<?php echo $image0; ?>"></a><?php else: ?><div class="hidden-image"></div><?php endif; ?><!--/blog_post_image--><!--blog_post_content-->
          <div class="u-blog-control u-post-content u-text u-text-2"><?php echo $content0; ?></div><!--/blog_post_content--><!--blog_post_readmore-->
          <?php if ($readmoreLink0): ?><a href="<?php echo $readmoreLink0; ?>" class="u-blog-control u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-none u-btn-1"><?php echo $readmore0; ?></a><?php endif; ?><!--/blog_post_readmore-->
        </div>
      </div><!--/blog_post--><!--blog_post-->
      <!--/blog_post--><!--blog_post-->
      <!--/blog_post-->