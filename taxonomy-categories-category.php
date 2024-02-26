<?php get_header('2021'); ?>

<?php the_post();?>

<?php if ( !post_password_required() ): ?>
      
    <!-- Categories Page Container Layout -->
    <div class="blog-posts-page-container channels-taxonomy bg-white">

        <?php 
            if(get_queried_object()->parent !== 0) {
                $category_filter = get_queried_object()->parent;
                $category_parent_name = get_term_by('id', $category_filter, 'categories-category')->name;
                $category_parent_slug = get_term_by('id', $category_filter, 'categories-category')->slug;
            } else {
                $category_filter = get_queried_object()->term_id;
                $category_parent_name = get_queried_object()->name;
                $category_parent_slug = get_queried_object()->slug;
            }

            $term_id = get_term_by('id', $category_filter, 'categories-category')->term_id;
            $category_parent_doctor_link = get_term_meta( $term_id, 'show_cta_doctor_corner', true );
            $category_parent_doctor_link_url = get_term_meta( $term_id, 'doctor_corner_url', true );
            $link = $category_parent_doctor_link_url ?: $category_parent_slug."-for-doctors";
        ?>

        <div class="categories-container featured-article-mobile fix-header-mobile">
            
            <div class="header container">

                <div class="header__channels d-flex justify-content-between w-100">
                    <h1><?php echo $category_parent_name; ?></h1>
                    <?php if ($category_parent_doctor_link) : ?>
                        <a href="<?php echo $link; ?>" class="btn-rounded"> 
                            Doctor's Corner 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path class="arrow-desktop" d="M12.1385 7.56094L4.73802 0.180933C4.49555 -0.0607219 4.10299 -0.0603157 3.86093 0.182183C3.61906 0.424651 3.61968 0.817431 3.86218 1.05927L10.8222 8.00003L3.86193 14.9408C3.61946 15.1826 3.61884 15.5752 3.86068 15.8177C3.98202 15.9392 4.14099 16 4.29996 16C4.45852 16 4.61686 15.9396 4.73799 15.8189L12.1385 8.43909C12.2553 8.3229 12.3208 8.16478 12.3208 8.00003C12.3208 7.83528 12.2551 7.67734 12.1385 7.56094Z" fill="#fff"/>
                                <path class="arrow-mobile" d="M12.1385 7.56094L4.73802 0.180933C4.49555 -0.0607219 4.10299 -0.0603157 3.86093 0.182183C3.61906 0.424651 3.61968 0.817431 3.86218 1.05927L10.8222 8.00003L3.86193 14.9408C3.61946 15.1826 3.61884 15.5752 3.86068 15.8177C3.98202 15.9392 4.14099 16 4.29996 16C4.45852 16 4.61686 15.9396 4.73799 15.8189L12.1385 8.43909C12.2553 8.3229 12.3208 8.16478 12.3208 8.00003C12.3208 7.83528 12.2551 7.67734 12.1385 7.56094Z" fill="#df054e"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
                
                <div class="header-subchannels">

                    <?php
                        if ( get_queried_object()->slug ) :

                            $args = array(
                                'taxonomy' => 'categories-category',
                                'child_of'   => $category_filter,
                                'hide_empty' => false,
                                'childless'  => true
                            );

                        else :

                            $args = array( 
                                'taxonomy' => 'categories-category' 
                            );
                            
                        endif; ?>

                        <a href="<?php echo esc_url( home_url( '/channel/' . $category_parent_slug  ) ); ?>" class="header-subchannels__item <?php echo ( get_queried_object()->name == $category_parent_name ) ? 'active' : ''; ?>">All</a>
                        
                        <?php foreach( get_categories( $args ) as $tag ):
                        
                            if ( $tag->category_parent > 0 ) : ?>

                                <a href="<?php echo get_tag_link( $tag->term_id ); ?>" class="header-subchannels__item <?php echo ( $tag->name == get_queried_object()->name ) ? 'active' : ''; ?>"><?php echo $tag->name; ?></a>

                            <?php endif;
                        
                        endforeach; ?>
                
                </div>

            </div>


            <?php
                $category_filter = get_queried_object()->term_id;
                $term_id = get_term_by('id', $category_filter, 'categories-category')->term_id;
                $channels_content = get_term_meta( $term_id, 'channels_content', true );
                $term = get_term( $term_id, 'categories-category', OBJECT);
                
                if( have_rows('channels_content', $term->taxonomy.'_'.$term->term_id ) ): ?>
                
                    <div class="body featured-article-container">

                        <?php while( have_rows('channels_content', $term->taxonomy.'_'.$term->term_id ) ): the_row(); ?>
                        
                            <?php if ( get_row_layout() == 'header-channel' ) : ?>

                                <?php get_template_part( 'template-parts/taxonomies/channels/header-channel' ); ?>

                            <?php elseif ( get_row_layout() == 'highlight-articles-channels' ) : ?>

                                <?php get_template_part( 'template-parts/taxonomies/channels/highlight-article-channel' ); ?>                                

                            <?php elseif ( get_row_layout() == 'channels-list' ) : ?>
                                
                                <?php get_template_part( 'template-parts/taxonomies/channels/channels-list' ); ?>

                            <?php elseif ( get_row_layout() == 'channels-grid' ) : ?>
                                
                                <?php get_template_part( 'template-parts/taxonomies/channels/channels-grid' ); ?>

                            <?php elseif ( get_row_layout() == 'channels-news' ) : ?>
                                
                                <?php get_template_part( 'template-parts/taxonomies/channels/channels-news' ); ?>

                            <?php elseif ( get_row_layout() == 'channels_specialist' ) : ?>
                                
                                <?php get_template_part( 'template-parts/taxonomies/channels/channels-doctors' ); ?>

                            <?php elseif ( get_row_layout() == 'channels_videos' ) : ?>
                                
                                <?php get_template_part( 'template-parts/taxonomies/channels/channels-videos' ); ?>

                            <?php elseif ( get_row_layout() == 'chanels_video_slider' ) : ?>
                                
                                <?php get_template_part( 'template-parts/taxonomies/channels/channels-video-slider' ); ?>

                            <?php elseif ( get_row_layout() == 'channels-contact-cta' ) : ?>

                                <?php get_template_part( 'template-parts/taxonomies/channels/channels-contact-cta' ); ?>
                            
                            <?php elseif ( get_row_layout() == 'channels-patient-journey' ) : ?>
                                
                                <?php get_template_part( 'template-parts/taxonomies/channels/channels-patient-journey' ); ?>

                            <?php endif; ?>
                        
                        <?php endwhile; ?>

                    </div>
                
                </div> <!-- close .categories-container -->

                <?php if ( get_field( 'enable-disable', $term->taxonomy.'_'.$term->term_id ) ) : ?>

                    <div class="blog-posts-page-container tax-categories-category pt-0">

                        <div class="background-white"></div>

                        <div class="container categories-container default-content-post">

                            <div class="header-articles">

                                <h2><?php echo get_field( 'highlight_article_title', $term->taxonomy.'_'.$term->term_id ); ?></h2>
                                
                            </div>

                            <div class="body">

                                <?php 
                                    $args = array(
                                        'tax_query' => array(
                                            array(
                                                    'taxonomy' => 'categories-category',
                                                    'field' => 'slug',
                                                    'terms' => get_queried_object()->slug
                                                )
                                            )
                                        );
                                    query_posts( $args );
                                    
                                    while ( have_posts() ) : the_post(); $count++; 
                                
                                        require(  __DIR__ . '/template-parts/taxonomies/channels/single-article.php' );
                                    
                                    endwhile;
                                    
                                    wp_reset_query();
                                ?>
                                
                            </div>
                            
                        </div>
                    
                    </div>

                <?php endif; ?>
                
            <?php else : ?>

                <div class="blog-posts-page-container tax-categories-category pt-0">

                    <div class="background-white fix-height"></div>

                    <div class="container categories-container default-content-post">

                        <!-- <div class="body fix-width-responsive"> -->
                        <div class="body">

                            <?php 
                                $args = array(
                                    'tax_query' => array(
                                        array(
                                                'taxonomy' => 'categories-category',
                                                'field' => 'slug',
                                                'terms' => get_queried_object()->slug
                                            )
                                        )
                                    );
                                query_posts( $args );
                                
                                while ( have_posts() ) : the_post(); $count++; 
                            
                                    require(  __DIR__ . '/template-parts/taxonomies/channels/single-article.php' );
                                
                                endwhile;
                                
                                wp_reset_query();
                            ?>
                            
                        </div>
                        
                    </div>
                
                </div>

            <?php endif; ?>

        <div class="container">

            <hr>
    
            <p class="link-to-home">
                
                <a href="<?php echo esc_url( home_url( '/channels' ) ); ?>">Back To Channels</a>
            
            </p>

        </div>

    </div>
    <!-- End Categories Page Container Module -->

<?php else: ?>

    <!-- Form Password Protector -->
    <div class="form-password-protector">
        <form method="post" action="<?php echo esc_url( home_url( '/' ) ) . 'wp-login.php?action=postpass'; ?>">
            <p>This post is password protected. To view it please enter your password below:</p><br>
            <p><label for="pwbox-531">Password:<br/>
            <input type="password" size="20" id="pwbox-531" name="post_password"/></label><br/>
            <input type="submit" value="Submit" name="Submit"/></p>
        </form>
    </div>
    <!-- End Form Password Protector -->

<?php endif; ?>

<?php get_footer(); ?>