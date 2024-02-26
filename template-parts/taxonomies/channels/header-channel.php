<!-- Header Channels Template Parts -->
<div class="featured-article-channel-container container">

    <?php $post1_title = get_sub_field( 'title' ); ?>

    <?php if ( $post1_title ) : ?>

        <div class="featured-article-channel-header">

            <h1><?php echo $post1_title; ?></h1>

        </div>

    <?php endif; ?>

    <div class="featured-article-channel-body d-flex <?php echo ( get_sub_field( 'orientation' ) == 'right' ) ? 'flex-row-reverse' : ''; ?>">   

        <?php $post1 = get_sub_field('post1'); ?>

        <div class="featured-article-channel-body__big-picture">

            <!-- Big Article -->
            <div class="featured-article-channel-body__big-picture__box lazy" style="background-image:url( <?php echo get_the_post_thumbnail_url( $post1->ID, 'large'); ?>)">

                <a href="<?php echo get_post_permalink( $post1->ID ); ?>">

                    <div class="big_shadow"></div>

                    <div class="content">

                        <h2><?php echo $post1->post_title; ?></h2>

                        <?php $post1_text = get_sub_field( 'text1' ); ?>

                        <?php if ( $post1_text ) : ?> 
                            
                            <p><?php echo $post1_text; ?></p>
                        
                        <?php endif; ?>

                    </div>

                </a>

            </div>
            <!-- End Big Article -->
                

        </div>

        <div class="featured-article-channel-body__column">
            
            <?php $post2 = get_sub_field('post2'); ?>

            <!-- Small Article Top -->
            <div class="featured-article-channel-body__column__box lazy" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post2->ID, 'large'); ?>)">
                
                <a href="<?php echo get_post_permalink( $post2->ID ); ?>">

                    <div class="big_shadow"></div>

                    <div class="content">
                        
                        <h2><?php echo $post2->post_title; ?></h2>

                    </div>

                </a>

            </div>
            <!--End Small Article Top -->


            <?php $post3 = get_sub_field('post3'); ?>

            <!-- Small Article Bottom -->
            <div class="featured-article-channel-body__column__box lazy" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post3->ID, 'large'); ?>)">

                <a href="<?php echo get_post_permalink( $post3->ID ); ?>">

                    <div class="big_shadow"></div>

                    <div class="content">

                        <h2><?php echo $post3->post_title; ?></h2>

                    </div>
                </a>
                
            </div>
            <!--End Small Article Bottom -->

        </div>

    </div>

</div>
<!-- Header Channels Template Parts -->