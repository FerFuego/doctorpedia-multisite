<?php 
// GET Params of father template
$user_id = ( isset($user->ID) ) ? $user->ID : $user['ID']; 

// Partials fields
$x          = (isset($x))? $x : 1;
$metadata   = get_user_meta($user_id);
$avatar     = get_avatar_url($user_id, '32');
$name       = @$metadata['nickname'][0];
$specialty  = get_field('bb_specialties', 'user_' . $user_id)[0]['specialty'];
$phone      = @$metadata['clinic_phone'][0];
$city       = @$metadata['city'][0];
$order      = @$metadata['user_order'][0];
$state      = @$metadata['state'][0];
$nicename   = (isset($user->user_nicename)) ? $user->user_nicename : $user['user_nicename'];
$location   = ($city && $state) ? $city .', '. $state : false;
$address    = get_field('location', 'user_' . $user_id)['address'];
$link       = esc_url(home_url('/doctor-profile/' . $nicename));
$is_verified = @$metadata['is_verified'][0];
$featured_in = have_rows('featured_in', 'user_' . $user_id );
$activity       = @$metadata['c_activity'][0];
$totalVideos    = @$metadata['c_videos'][0];
$totalArticles  = @$metadata['c_articles'][0];
$totalBlogs     = @$metadata['c_blogs'][0];
$totalReviews   = @$metadata['c_reviews'][0];
?>

<div 
    class="expert-card js-expertCard"
    data-id="<?php echo $x; ?>"
    data-order="<?php echo $order; ?>"
    data-activity="<?php echo $activity; ?>"
    data-videos="<?php echo $totalVideos; ?>"
    data-articles="<?php echo $totalArticles; ?>"
    data-blogs="<?php echo $totalBlogs; ?>"
    data-reviews="<?php echo $totalReviews; ?>" >

    <div class="content">

        <div class="expert-card__header">
            <a class="click-avatar" href="<?php echo $link; ?>">
                <div class="avatar" style="background-image: url(<?php echo ($avatar) ? $avatar : ''; ?>);"></div>
            </a>
            <div class="data">
                <a href="<?php echo $link; ?>">
                    <h3><?php echo ($name) ? $name : ''; ?></h3>
                    <p><?php echo ($specialty) ? $specialty : ''; ?></p>
                </a>
            </div>
            <?php if ( $is_verified ) : ?>
                <p class="verified_icon"><img src="<?php echo IMAGES . '/doctor-directory/verified.svg'; ?>" alt="Doctorpedia Verified"></p>
            <?php endif; ?>
        </div>
            
        <?php if(isset($testimonial)):?>
            <div class="expert-card__testimonial">
                <p>"<?php echo $testimonial; ?>"</p>
            </div>
        <?php endif;?>

        <?php if ( $featured_in || $is_verified || $location || $phone ) : ?>

            <div class="expert-card__body">

                <div class="expert-card__body__contact" style="<?php echo ( $featured_in || $is_verified ) ? 'margin-bottom: 12px;' : ''; ?>">
                    
                    <?php if ($location) : ?>
                        <p class="contact__action">
                            <img src="<?php echo IMAGES . '/doctor-directory/map-marker-alt-solid.svg'; ?>" alt="icon"> 
                            <a href="http://maps.google.com/maps?q=<?php echo urlencode($address); ?>" target="_blank">
                                <?php echo $location; ?>
                            </a>
                        </p>
                    <?php endif; ?>

                    <?php if ($phone) : ?>
                        <p>
                            <img src="<?php echo IMAGES . '/doctor-directory/phone-alt-solid.svg'; ?>" alt="icon">
                            <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                        </p>
                    <?php endif ?>
                </div>

                <?php if( have_rows('featured_in', 'user_' . $user_id ) ) : ?>
                    <?php while( have_rows('featured_in', 'user_' . $user_id) ): the_row();  ?>
                        <div class="expert-card__body__verified">
                            <p>
                                <a href="<?php echo get_sub_field('page')['url']; ?>" target="<?php echo get_sub_field('page')['target']; ?>">
                                    <img src="<?php echo IMAGES . '/doctor-directory/iconmonstr-check-mark.svg'; ?>" alt="icon"> 
                                        Featured in <?php echo get_sub_field('page')['title']; ?>
                                </a>
                            </p>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

            </div>

        <?php endif; ?>
        
        <div class="expert-card__footer">

            <?php if ( $totalVideos || $totalArticles || $totalBlogs || $totalReviews ) : ?>

                <div class="expert-card__footer__activities">

                    <?php if ($totalVideos > 0) : ?>
                        <a href="<?php echo $link . '/#videos'; ?>" target="_blank">
                            <p><?php echo $totalVideos; ?></p>
                            <span>Videos</span>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($totalArticles > 0) : ?>
                        <a href="<?php echo $link . '/#article'; ?>" target="_blank">
                            <p><?php echo $totalArticles; ?></p>
                            <span>Articles</span>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($totalBlogs > 0) : ?>
                        <a href="<?php echo $link . '/#blog'; ?>" target="_blank">
                            <p><?php echo $totalBlogs; ?></p>
                            <span>Blogs</span>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($totalReviews > 0) : ?>
                        <a href="<?php echo $link . '/#user-reviews'; ?>" target="_blank">
                            <p><?php echo $totalReviews; ?></p>
                            <span>Reviews</span>
                        </a>
                    <?php endif; ?>

                </div>

            <?php endif; ?>

            <?php if ( $link ) : ?>
                <a href="<?php echo $link; ?>" class="cta-profile-link">View Profile</a>
            <?php endif; ?>
        </div>

    </div>

</div>