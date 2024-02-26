<?php
$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$objecto_link =  explode('/', $actual_link); 

if($objecto_link[1] != 'resources' && $objecto_link[2] != 'resources'):

    if($objecto_link[1] == 'video_play' || $objecto_link[2] == 'video_play'){
        $post_type = 'video_play';
        $title = 'Videos';
        $link = 'video-hub';
    }else{
        $post_type = 'post';
        $title = 'Articles';
        $link = 'articles';
    }

    if(isset($post_ID)){

        $loop = new WP_Query( array(
            'post_type' => $post_type,
            'post__not_in' => array($post_ID),
            'posts_per_page' => 3,
            'order_by' => 'rand',
        ));

    }else{

        $loop = new WP_Query( array(
            'post_type' => $post_type,
            'posts_per_page' => 3,
            'order_by' => 'rand',
        )); 
    }

    
    if($loop -> have_posts()): ?>
        <!-- Recommended Posts Preview -->
        <div class="blog-posts-preview-container recomended-articles">            
            <div class="container">
                <div class="header">
                    <h1><?php echo ($title == 'Clinical Trials' || $post_type = 'video_play' ) ? 'Related' : 'Recommended'; ?> <?php echo $title; ?></h1>
                </div>
                <div class="body">

                    <?php
                        while ( $loop -> have_posts()) : $loop->the_post();	

                            $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
                            $url = wp_get_attachment_url( $post_thumbnail_id ); 

                            if(empty($url))
                                $url = get_field('image'); ?>
                            
                            <div class="blog-post-preview" id="type-<?php print $post_type.'-'.$category ?>">
                                <a href="<?php the_permalink()?>" style="background-image:url(<?php echo $url?>)" class="trim"></a>
                                <div class="content">
                                    
                                    <?php
                                        if(get_field('subtitle'))
                                            echo '<h3>'.get_field('subtitle').'</h3>';
                                    ?>
                                    
                                    <a href="<?php the_permalink()?>"><h2><?php the_title() ?></h2></a>
                                    
                                </div>
                                <div class="footer">
                                <?php if($title != 'Clinical Trials' && $title != 'Mobile Apps'): ?>
                                    <div class="post-author"><?php echo get_avatar(get_the_author_meta('email'), '32') ?></div>
                                    <span><?php echo get_the_author() ?></span>
                                <?php endif; ?>
                                </div>
                            </div>     

                    <?php 
                        endwhile; 
                    ?>
                    <?php wp_reset_query()?>
                </div>
                <?php if($title != 'Clinical Trials' && $title != 'Videos' && $title != 'Mobile Apps'): ?>
                    <div class="footer-view text-center">
                        <a href="<?php echo esc_url(home_url('/')).$link ?>" class="view-all">View All <?php echo $title ?></a>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <!-- End Recommended Posts Preview --> 
    <?php endif; ?>
<?php endif; ?>