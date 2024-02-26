<?php /* Template Name: Search Page */ ?>

<?php 
    $rand_0 = rand(999, 9999);
    $rand_1 = rand(999, 9999);
    $rand_2 = rand(999, 9999);
    $rand_3 = rand(999, 9999);
    $rand_4 = rand(999, 9999);
    $loop_0 = new WP_Query();
    $loop_1 = new WP_Query();
    $loop_2 = new WP_Query();
    $loop_3 = new WP_Query();
    $loop_4 = new WP_Query();
    $tag_search = (($_GET['tag'] == 'all') ? '' : $_GET['tag']);
    $selection = ( $_GET['selection'] ) ? explode( ',', filter_input(INPUT_GET, 'selection', FILTER_SANITIZE_URL)) : null;
?>

<?php get_header(); ?>

<div class="search-page">

    <div class="blog-post-container">
    
        <div class="container">

            <div class="header search-header-form">

                <div class="search-results">

                    <h1>Search:</h1>

                    <form method="GET">

                        <input type="text" name="search" id="search" onchange="submit()" placeholder="Type topic or keyword" value="<?php echo $_GET['search'] ?>">

                    </form>

                </div>

                <div class="filter d-none d-md-block">

                    <a href="#"><h2>Filter Results</h2></a>

                </div>

            </div>

            <div class="search-navbar">

                <ul>

                    <li class="border-none refine">Refine Search </li>

                    <li id="all" class="<?php echo (empty($tag_search) ? 'active' : '') ?>">All</li>

                    <?php foreach( get_categories( array('hide_empty' => false ) ) as $category ) : ?> 

                        <li id="<?php echo $category->name; ?>" class="<?php echo ( $tag_search == $category->name ) ? 'active' : ''; ?>"><?php echo $category->name; ?></li>

                    <?php endforeach; ?>

                </ul>

            </div>

        </div>

    </div>

    <!-- Blog Posts -->
    <?php if ( ! $selection || in_array('All', $selection) || in_array('Reviews', $selection) ) : ?>
        <?php
            $loop_0 = new WP_Query( array(
                'post_type' => 'post',
                's'         => $_GET['search'],
                'post_status'=> 'publish',
                'tag'       => array($tag_search),
                'orderby'   => 'title', 
                'order'     => 'ASC'
            ));
        ?>
        <?php if($loop_0->have_posts()): ?>

            <div class="blog-posts-preview-container app-review-container">   

                <div class="container">

                    <div class="header mt-5">

                        <h1>Articles (<?php print $loop_0->found_posts; ?>)</h1>

                        <div class="filter d-md-none">

                            <a href="#"><h2>Filter Results</h2></a>

                        </div>

                    </div>

                    <div class="slider-container">

                        <img src="<?php echo IMAGES; ?>/icons/prev.svg" alt="" class="d-none d-md-block prev prev_<?php echo $rand_0; ?>">

                        <div id="slider-posts" class="featured-article slick_<?php echo $rand_0; ?>">

                            <?php  while ( $loop_0->have_posts()) : $loop_0->the_post(); ?>

                                <div class="blog-post-preview">

                                    <a href="<?php the_permalink()?>">

                                        <img class="post-thumbnail" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>" alt="">

                                    </a>

                                    <div class="content">    

                                        <a href="<?php the_permalink()?>"><h2><?php the_title()?></h2></a>

                                    </div>

                                    <?php if( !empty((get_avatar(get_the_author_meta('email'), '32')) ) ) : ?>

                                        <?php if(!get_field('display_author')): ?>

                                            <div class="footer">

                                                <div class="post-author"><?php echo get_avatar(get_the_author_meta('email'), '32'); ?></div>

                                                <span> <?php echo get_the_author(); ?></span>

                                            </div>

                                        <?php endif ?>

                                    <?php endif; ?>

                                </div>

                            <?php endwhile; ?>

                        </div>

                        <img src="<?php echo IMAGES; ?>/icons/next.svg" alt="" class="d-none d-md-block next next_<?php echo $rand_0; ?>">

                    </div>

                </div>

            </div>

        <?php endif; ?>
    <?php endif; ?>

    <!-- Videos -->
    <?php if ( ! $selection || in_array('All', $selection) || in_array('Playback', $selection) ) : ?>
        <?php
            $loop_1 = new WP_Query( array(
                'post_type' => 'video_play',
                's' => $_GET['search'],
                'post_status' => 'publish',
                'tag'         => array($tag_search),
                'orderby'     => 'title', 
                'order'       => 'ASC'
            ));
        ?>
        <?php if($loop_1->have_posts()):  ?>

            <div class="search-page-videos-slider">

                <div class="container">

                    <h1 class="title">Videos (<?php print $loop_1->found_posts; ?>)</h1>

                    <div class="slider-container">

                        <img src="<?php echo IMAGES; ?>/icons/prev.svg" alt="" class="d-none d-md-block prev prev_<?php echo $rand_1; ?>">

                        <div id="slider-videos" class="slider-videos slides slick_<?php echo $rand_1; ?>">

                            <?php while ( $loop_1->have_posts()) : $loop_1->the_post(); ?>

                                <a href="<?php the_permalink(); ?>">

                                    <div class="slider-single-item">

                                        <div class="trim" style="background-image: url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>);">

                                            <button class="play-video-btn <?php echo (($loop_1->found_posts <= '3') ? ('play-video-btn-lg') : (''))?>">

                                                <img class="icon-play"  src="<?php echo IMAGES;?>/icons/play-button.svg" alt=""> 

                                            </button>

                                        </div>

                                        <div class="slider-single-item-content">

                                            <h2 class="slider-single-title"><?php the_title()?></h2>

                                        </div>

                                        <button class="d-block d-md-none btn-load">Load More</button>

                                    </div>
                                    
                                </a>

                            <?php endwhile; ?>

                        </div>

                        <img src="<?php echo IMAGES ?>/icons/next.svg" alt="" class="d-none d-md-block next next_<?php echo $rand_1; ?>">

                    </div>

                    <hr>

                </div> 

            </div>

        <?php endif; ?>
    <?php endif; ?>

    <!-- Product Reviws -->
    <?php if ( ! $selection || in_array('All', $selection) || in_array('Reviews', $selection) ) : ?>
        <?php 
            $loop_3 = new WP_Query( array(
                'post_type' => 'product_reviews',
                's' => $_GET['search'],
                'post_status' => 'publish',
                'tag' => array($tag_search),
                'orderby'     => 'title', 
                'order'       => 'ASC' 
            ));
        ?>
        <?php  if($loop_3->have_posts()): ?>

            <div class="app-review-container">   

                <div class="container">

                    <div class="header">

                        <h1>Product Reviews (<?php print $loop_3->found_posts; ?>)</h1>

                    </div>
                
                    <div class="slider-container">

                        <img src="<?php echo IMAGES; ?>/icons/prev.svg" alt="" class="d-none d-md-block prev prev_<?php echo $rand_3; ?>">

                            <div id="slider-product-review" class="app-review-article slider-app-review slides slick_<?php echo $rand_3; ?>">

                                <?php while ( $loop_3->have_posts()) : $loop_3->the_post();?>

                                    <div class="app-post-preview">

                                        <a href="<?php the_permalink()?>" class="line-border">
                                        
                                            <img class="post-thumbnail" src="<?php the_field('image')?>" alt="">
                                        
                                        </a>

                                        <div class="content">

                                            <a href="<?php the_permalink()?>"><h2><?php the_title()?></h2></a>

                                            <?php echo cadena::corta(get_field('description'),200)?>

                                        </div>

                                        <div class="footer">

                                            <a href="<?php the_permalink()?>"><h3>Full Review</h3></a>

                                        </div>

                                    </div>

                                <?php endwhile; ?>

                            </div>

                        <img src="<?php echo IMAGES ?>/icons/next.svg" alt="" class="d-none d-md-block next next_<?php echo $rand_3; ?>">

                    </div>
                    
                    <hr>

                </div>

            </div>

        <?php endif; ?>
    <?php endif; ?>

    <!-- message not results -->
    <?php if(!$loop_0->have_posts() && !$loop_1->have_posts() && !$loop_2->have_posts() && !$loop_3->have_posts()): ?>
        <div class="container">
            <div class="no-results">
                <h3>No results found in this search</h3>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php wp_reset_query() ?>

<?php the_content(); ?>

<?php get_footer(); ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $(document).ready(function() {
        $("#slider-posts").slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            prevArrow: $(".prev_<?php echo $rand_0; ?>"),
            nextArrow: $("next_<?php echo $rand_0; ?>"),
            dots: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: "unslick",
                }
            ]
        });
        $("#slider-videos").slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            prevArrow: $(".prev_<?php echo $rand_1; ?>"),
            nextArrow: $("next_<?php echo $rand_1; ?>"),
            dots: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: "unslick",
                }
            ]
        });
        $("#slider-mobile-app").slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            prevArrow: $(".prev_<?php echo $rand_2; ?>"),
            nextArrow: $("next_<?php echo $rand_2; ?>"),
            dots: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: "unslick",
                }
            ]
        });
        $("#slider-product-review").slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            prevArrow: $(".prev_<?php echo $rand_3; ?>"),
            nextArrow: $("next_<?php echo $rand_3; ?>"),
            dots: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: "unslick",
                }
            ]
        });
    });
</script>