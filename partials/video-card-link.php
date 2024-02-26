<div class="slider-single-item slider-item-click" onclick="openModalNew('<?php echo $link_video; ?>')">

    <div class="trim" style="background-image:url(<?php echo $placeholder_image['url']; ?>);">
        <button class="play-video-btn" onclick="openModalNew('<?php echo $link_video; ?>')">
            <img class="icon-play"  src="<?php echo IMAGES ?>/icons/play-button.svg" alt="play"> 
        </button>
    </div>

    <div class="slider-single-item-content">
        <h2 class="slider-single-title"><?php echo $title; ?></h2>
    </div>

    <div class="slider-single-item-footer">
        <?php if ($show_author) : ?>
            <img class="content-author-img rounded-circle" src="<?php echo get_avatar_url($author['ID'], '49'); ?>" alt="<?php echo  $author['display_name'];?>">
            <div class="name">
                <p><?php echo $author['display_name'];?></p>
                <span><?php echo get_specialties_expert($author['ID']); ?></span>
            </div>
        <?php endif; ?>
    </div>

</div>