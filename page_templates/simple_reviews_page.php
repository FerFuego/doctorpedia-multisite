<?php /* Template Name: Simple Reviews */?>

<?php get_header('secondary'); ?>

<?php the_post();?>

<!-- Resources Layout -->
<div class="simple-reviews-page">
    <!-- Secondary Header Module -->
    <div class="secondary-header ">
        <div class="container experts-header">
            <div class="page-title row text-center text-lg-left">
                <div class="col-lg-4 pl-lg-0">
                    <h1><?php the_field('title_section')?></h1>
                </div>
                <div class="col-lg-8 pr-lg-0">
                    <p><?php the_field('description_section')?></p>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Secondary Header Module -->
</div>


<div class="large-container">

<?php the_content() ?>

<!-- Blog Posts Page Container Layout -->
<div class="blog-posts-page-container">

    <?php  $post_type = get_field('post_type'); ?>

    <div class="container container-content">
        <div class="header">
            <h1><?php the_field('title_grid')?></h1>
        </div>
        <div class="container-main">
            <div class="body">
                <?php query_posts('post_type='.$post_type ); ?>
                <?php  while ( have_posts() ) : the_post(); ?>

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

                                <?php if($post_type != 'video_play' && $post_type != 'simple_reviews'): ?>
                                    <div class="post-author"><?php echo get_avatar(get_the_author_meta('email'), '32') ?></div>
                                    <span><?php the_author() ?></span>
                                <?php endif; ?>

                                <?php if($post_type == 'simple_reviews'): ?>
                                    <?php $a = get_field('external_link'); ?>
                                    <a href="<?php echo urldecode($a['url']); ?>" target="<?php echo urldecode($a['target']) ?>"><?php echo urldecode($a['title']) ?></a>
                                <?php endif; ?>

                            </div>
                        </div>
                        <!-- End Blog Post Preview -->
                <?php endwhile; ?>
                <?php wp_reset_query(); ?>
            </div>
        </div>
    </div>
    <hr>
    <p class="link-to-home"><a href="/"><strong>Home</strong></a></p>

</div>
<!-- End Blog Posts Page Container Module -->

<?php get_footer(); ?>