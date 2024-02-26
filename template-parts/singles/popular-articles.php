<!-- Popular Article Template Part -->
<?php $rand = rand(); ?>

<?php query_posts(array(
    'post_type' => 'blog',
    'author' => get_the_author_meta('ID'),
    'post__not_in' => array( $post_ID ),
    'posts_per_page' => 3,
    'post_status' => 'publish'
)); ?>

<?php if ( have_posts() ) : ?>

    <div class="blog-posts-preview-container blogging-popular-articles">

        <div class="bg-white"></div>

        <div class="container">

            <div class="header">

                <h2><?php echo get_the_author_meta('display_name'); ?> Articles</h2>

            </div>

            <div class="body featured-article">
                
                <div class="blogging-popular-articles__slider">
                
                    <img src="<?php echo IMAGES ?>/icons/stroke-prev.svg" class="prev prev_<?php echo $rand; ?>">

                    <div id="slider_<?php echo $rand; ?>">

                        <?php while( have_posts() ) : the_post(); ?>
            
                            <div class="blog-post-preview blogging-popular-articles__slider__item" data-slug="<?php echo get_permalink(); ?>">
                    
                                <a href="<?php echo get_permalink(); ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium'); ?>)" class="trim lazy"></a>
                            
                                <div class="single-blogging-item-text">

                                    <!-- Author -->
                                    <div class="content-author-container">
                                        
                                        <img src="<?php echo get_avatar_url(get_the_author_meta('ID'), '66'); ?>" class="rounded-circle">

                                        <div class="content-author-text">
                                        
                                            <h4 class="content-author-title"><?php echo get_the_author(); ?></h4>
                                            
                                            <h5 class="content-author-date"><?php  the_time('F j, Y'); ?></h5>

                                        </div>

                                    </div>
                            
                                    <h2 class="pb-25"><?php the_title(); ?></h2>
                                    
                                    <p><?php echo custom_trim_excerpt( get_the_ID(), null, 30 ); ?></p>
                            
                                </div>
                            
                            </div>
            
                        <?php endwhile; ?>
                    
                    </div>

                    <img src="<?php echo IMAGES ?>/icons/stroke-next.svg" class="next next_<?php echo $rand; ?>">
                    
                    <?php wp_reset_postdata() ?>

                </div>
                
            </div>

        </div>

    </div>

    <script>   
        $("document").ready(function(){
            var divs = document.getElementsByClassName("blog-post-preview").length;

            if (divs <= 3 ) {
                $('.next_<?php echo $rand; ?>').remove();
                $('.prev_<?php echo $rand; ?>').remove();
            }

            $("#slider_<?php echo $rand; ?>").slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                prevArrow: $(".prev_<?php echo $rand; ?>"),
                nextArrow: $(".next_<?php echo $rand; ?>"),
                dots: (divs > 3 ) ? true : ( $(window).width() < 769 ) ? true : false,
                responsive: [
                    {
                        breakpoint: 1930,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 450,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },
                ]
            });
        });
        
        $(window).on("resize", function() {
            $("#slider_<?php echo $rand; ?>").not(".slick-initialized").slick("resize");
        });
    </script>

<?php endif; ?>

<!-- End Popular Article Template Part -->