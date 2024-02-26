<?php /* Template Name: Blog Page */?>

<?php get_header('2021'); ?>

<?php the_post();?>
    
    <!-- Blog Super title Layout-->
    <?php if(!empty(get_field('header_title'))): ?>
        <div class="blog-post-container">
            <div class="container">
                <div class="header header-blog-super-title">
                   <h1><?php the_field('header_title') ?></h1>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- Blog Super title Layout -->


    <!-- Blog Super Doctor Profile Layout-->
    <?php if(!empty(get_field('selfie'))): ?>
        <div class="doctor-profile-container white">
            <div class="container">
                <div class="doctor-profile">
                    <div class="selfie">
                        <img src="<?php the_field('selfie') ?>" alt="Doctor Profile">
                        <div class="networks">
                            <ul>
                                <?php if(!empty(get_field('website'))): ?>     <li><a href="<?php the_field('website') ?>" target="_blank"><img src="<?php echo IMAGES ?>/icons/doctor-profile/click.svg"></a></li>      <?php endif; ?>
                                <?php if(!empty(get_field('email'))): ?>       <li><a href="mailto:<?php the_field('email') ?>" target="_blank"><img src="<?php echo IMAGES ?>/icons/doctor-profile/mail.svg"></a></li>  <?php endif; ?>
                                <?php if(!empty(get_field('facebook'))): ?>    <li><a href="<?php the_field('facebook') ?>" target="_blank"><img src="<?php echo IMAGES ?>/icons/doctor-profile/facebook.svg"></a></li>  <?php endif; ?>
                                <?php if(!empty(get_field('linkedin'))): ?>    <li><a href="<?php the_field('linkedin') ?>" target="_blank"><img src="<?php echo IMAGES ?>/icons/doctor-profile/linkedin.svg"></a></li>  <?php endif; ?>
                                <?php if(!empty(get_field('twitter'))): ?>     <li><a href="<?php the_field('twitter') ?>" target="_blank"><img src="<?php echo IMAGES ?>/icons/doctor-profile/twitter.svg"></a></li>    <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <h1><?php the_field('name') ?></h1>
                        <h2><?php the_field('title') ?></h2>
                        <p><?php the_field('description') ?></p>
                        <div class="call-to-action">
                            <?php if(!empty(get_field('link_full_bio'))): ?> <a href="<?php the_field('link_full_bio') ?>">View Full Bio</a> <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- Blog Super Doctor Profile Layout -->

    <!-- Blog Post Page Header Layout -->
    <?php 
        $cover = get_field('post_cover_page');
        $loop = new WP_Query( array(
            'post__in' => array($cover),
            'posts_per_page' => 1
        ));
        while ( $loop -> have_posts()) : $loop->the_post();
        
            $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $url = wp_get_attachment_url( $post_thumbnail_id ); 
    ?>
        <div class="blog-post-page-header post-<?php echo $cover ?>"> 
            <img src="<?php echo $url ?>" alt="">

            <div class="description description-static">
                <div class="centering">
                    <a href="<?php the_permalink() ?>"><h1><?php the_title() ?></h1></a>
                    <div class="footer">

                        <?php if(!get_field('display_author')): ?>
                            <div><?php echo get_avatar(get_the_author_meta('email'), '32') ?></div>
                        <?php endif ?>

                        <span class="author"><?php echo get_the_author() ?></span><span class="date"><?php the_time('M j, Y') ?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
    <?php wp_reset_query() ?>
    <!-- Blog Post Page Header Layout -->
    

    <?php the_content() ?>
   
    <!-- Blog Posts Page Container Layout -->
    <div class="blog-posts-page-container">            
        <div class="container">
            <div class="header">
                <h1><?php the_field('title_grid')?></h1>
            </div>

            <div class="body">
                <?php  
                    $post_type = get_field('post_type');

                    if ( get_bloginfo( 'name' ) == 'Doctorpedia') {

                        query_posts(array(
                            'post_type' => $post_type,
                            'category_name'  => 'post',
                            'posts_per_page' => -1
                        ));

                    } else {
                        query_posts(array(
                            'post_type' => $post_type,
                            'posts_per_page' => -1
                        ));
                    }
                    
                    
                    
                while ( have_posts() ) : the_post(); ?>

                    <?php $url = get_the_post_thumbnail_url(get_the_ID(), 'medium')  ?>
                    <?php if(!$url){ $url = get_field('image'); } ?>

                    <!-- Blog Post Preview -->
                    <div class="blog-post-preview">
                        <a href="<?php the_permalink() ?>" style="background-image:url(<?php echo $url ?>)" class="trim"></a>
                            
                            <?php $subt = (get_field('subtitle'))? get_field('subtitle') : 'Reviews: '.str_replace('_',' ',ucwords($post_type)); ?>
                            
                            <div class="content">
                                <a href="<?php the_permalink() ?>">
                                    <?php if(get_field('subtitle')): ?>
                                        <h3><?php the_field('subtitle')?></h3>
                                    <?php endif; ?>
                                    <h2><?php the_title() ?></h2>
                                </a>
                            </div>
                            <div class="footer">
                                <?php if($post_type != 'video_play'): ?>
                                    <?php if(!get_field('display_author')): ?>
                                        <div class="post-author"><?php echo get_avatar(get_the_author_meta('email'), '32') ?></div>
                                        <span><?php the_author() ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- End Blog Post Preview -->
                <?php endwhile; ?>
                <?php wp_reset_query(); ?>
            </div>
        </div>
        <hr>
        <p class="link-to-home"><a href="/"><strong>Home</strong></a></p>

    </div>
    <!-- End Blog Posts Page Container Module -->


<?php get_footer(); ?>
