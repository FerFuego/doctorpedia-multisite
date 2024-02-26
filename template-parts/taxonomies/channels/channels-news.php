<!-- Channels News Module VC -->
<div class="blog-posts-preview-container news-channel-container">   

    <div class="container">

        <?php if ( get_sub_field('title_news') ) : ?>

            <div class="header-news">
                <h2><?php echo get_sub_field('title_news'); ?></h2>
            </div>

        <?php endif; ?>

        <div class="body body-fix">

            <div class="block pl-0">

                <?php 
                    $post_card = get_sub_field('post_news'); 
                    $post_link = get_post_permalink( $post_card->ID );
                    $post_description = get_post_meta( $post_card->ID, 'short_description', true);
                ?>

                <div class="blog-post-news" data-slug="<?php echo $post_link; ?>">

                    <a href="<?php echo $post_link; ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post_card->ID, 'large'); ?>)" class="trim lazy"></a>
                
                    <div class="content">
                
                        <a href="<?php echo $post_link; ?>">
                            <h2><?php echo $post_card->post_title; ?></h2>
                        </a>

                        <?php if ( $post_description ) : ?>
                            <p><?php echo $post_description; ?></p>
                        <?php endif; ?>
                
                    </div>
                
                </div>

                <?php wp_reset_postdata() ?>

            </div>

            <div class="block pr-0">

                <?php $obj_items = get_sub_field('articles_news'); ?>

                <?php if ( count($obj_items) > 0 ) : 
                    foreach ( $obj_items as $obj_item ) :
                        
                        $obj_item = $obj_item['post'];
                        $obj_item_link = get_post_permalink( $obj_item->ID );
                        $obj_item_description = get_post_meta( $obj_item->ID, 'short_description', true);
                        $categories = wp_get_post_terms( $obj_item->ID, 'categories-category' ); ?>
                                            
                    <div class="blog-post-preview-news" data-slug="<?php echo $obj_item_link; ?>">
                    
                        <a href="<?php echo $obj_item_link; ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( $obj_item->ID, 'large'); ?>)" class="trim lazy"></a>
                    
                        <div class="content">
                    
                            <a href="<?php echo $obj_item_link; ?>">
                                <h2 style="-webkit-box-orient: vertical;"><?php echo $obj_item->post_title; ?></h2>
                            </a>

                            <?php if ( $obj_item_description ) : ?>
                                <p><?php echo $obj_item_description; ?></p>
                            <?php endif; ?>
                    
                        </div>
                    
                    </div>

                <?php endforeach; 
                endif; ?>

            </div>
            
        </div>

    </div>

</div>

<!-- End Channels News Module VC -->