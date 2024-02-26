<?php if ( get_current_user_id() == $author_id ) : ?>

  <div class="text-box">

    <div class="d-flex flex-row">

      <div class="text-box__drpicture" style="background-image: url(<?php echo $avatar; ?>);"></div>
        
      <div class="text-box__placeholder-text">
    
        <?php if ( wp_is_mobile() ) : ?>
          <a href="javascript:void(0);" class="text-box__content-a autofit" onclick="openPublicationModal()">Post something, Dr. <?php the_author_meta('user_lastname', $author_id); ?>...</a>
        <?php else : ?>
          <textarea name="publish_content" 
                    id="publish_content"
                    class="text-box__content autofit"
                    onclick="focus_profile_share()"
                    onblur="blur_profile_share()"
                    onkeyup="get_site_og()"
                    placeholder="Post something, Dr. <?php the_author_meta('user_lastname', $author_id); ?>...">
          </textarea>
        <?php endif; ?>
        
        <div id="publish-content"></div>

        <a href="javascript:;" id="js-shared-link" class="text-right text-danger text-box__submit" onclick="submit_profile_share();">Post</a>
    
      </div>
      
    </div>

    <div class="text-box__nav">

      <a href="<?php echo esc_url( home_url('/doctor-platform/article-edit/')); ?>" class="text-box__action">

        <img src="<?php echo IMAGES; ?>/icons/article-icon.svg" alt="" class="text-box__icon">

        <span class="hidden-xs">Write an</span>&nbsp;Article

      </a>

      <a href="<?php echo esc_url( home_url('/doctor-platform/app-reviews/')); ?>" class="text-box__action">

        <img src="<?php echo IMAGES; ?>/icons/app-review-icon.svg" alt="" class="text-box__icon">

        Review<span class="hidden-xs">&nbsp;an</span>&nbsp;App

      </a>
      
      <a href="<?php echo esc_url( home_url('/doctor-platform/blog-edit/')); ?>" class="text-box__action">

        <img src="<?php echo IMAGES; ?>/icons/blog-icon.svg" alt="" class="text-box__icon">

        <span class="hidden-xs">Write a</span>&nbsp;Blog

      </a>

      <a href="<?php echo esc_url( home_url('/doctor-platform/video-edit/')); ?>" class="text-box__action">

        <img src="<?php echo IMAGES; ?>/icons/video-icon.svg" alt="" class="text-box__icon">

        <span class="hidden-xs">Upload a</span>&nbsp;Video

      </a>

    </div>

  </div>

<?php endif; ?>