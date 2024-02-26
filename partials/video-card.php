<div class="slider-single-item slider-item-click" onclick="openModalNew('<?php echo get_field('url_vimeo', $video->ID); ?>')">

    <div class="trim" style="background-image:url(<?php echo get_the_post_thumbnail_url($video->ID, 'medium'); ?>);">
        <button class="play-video-btn" onclick="openModalNew('<?php echo get_field('url_vimeo', $video->ID); ?>')">
            <img class="icon-play"  src="<?php echo IMAGES ?>/icons/play-button.svg" alt=""> 
        </button>
    </div>

    <div class="slider-single-item-content">
        <h2 class="slider-single-title"><?php echo $video->post_title; ?></h2>
    </div>

    <div class="slider-single-item-footer">
        <img class="content-author-img rounded-circle" src="<?php echo get_avatar_url($video->post_author, '49'); ?>" alt="<?php the_author_meta('display_name', $video->post_author );?>">
        <div class="name">
            <p><?php the_author_meta('display_name', $video->post_author );?></p>
            <span><?php echo get_specialties_expert($video->post_author); ?></span>
        </div>
    </div>

</div>