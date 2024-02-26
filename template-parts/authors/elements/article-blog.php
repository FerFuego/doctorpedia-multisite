<?php 
    $article_id = get_the_ID(); 

    if ($posttype == "Article" || $posttype == "article") {
        $label = "Read Article"; 
    } else if ($posttype == "Categories" || $posttype == "categories") {
        $posttype = "Channel Article";
        $label = "Read Channel Article";
    } else {
        $label = "Read Blog";
    }

    $article_content = get_field('short_description') ? get_field('short_description') : get_the_content();
?>

<!-- Articles -->
<div class="article-profile" id="post_<?php echo $article_id; ?>">
    
    <!-- Article Head -->
    <div class="article-profile__head">

        <!-- Doctor Image -->
        <a href="<?php echo get_user_permalink( $author_id ); ?>">
            <div class="article-profile__avatar" style="background-image: url(<?php echo $avatar; ?>);"></div>
        </a>

        <div class="article-profile__data">

            <div>
                <!-- Doctor Name -->
                <a class="article-profile__name" href="<?php echo get_user_permalink( $author_id ); ?>"><?php the_author_meta('display_name', $author_id );?></a>
            </div>
            
            <?php 
                if ( is_user_logged_in() && validate_user($author_id) ) :

                    /* Options personal posts */
                    get_template_part( 'template-parts/authors/elements/post', 'cta' );

                else :
                    /* Share Button */
                    get_template_part( 'template-parts/authors/elements/post', 'share' );

            endif; ?>

        </div>

    </div>
    <!-- End Article Head -->

    <!-- Article Image -->
    <a href="<?php echo get_the_permalink($article_id); ?>" target="_blank" class=article-profile__image-link">
        <div class="article-profile__image" style="background-image:url(<?php echo ( get_the_post_thumbnail_url( $article_id ) ) ? get_the_post_thumbnail_url( $article_id, 'large') : IMAGES . '/bg-empty.png'; ?>);"></div>
    </a>
    <!-- End Article Image -->

    <!-- Article body -->
    <div class="article-profile__body">

        <p class="article-profile__body-type"><?php echo ucfirst($posttype); ?></p>

        <h2 class="article-profile__body-title"><?php the_title() ?></h2>
            
        <p class="article-profile__body-description"><?php echo custom_trim_excerpt('', $article_content, 35); ?></p>

        <a class="article-profile__body-cta" href="<?php echo get_the_permalink($article_id); ?>" target="_blank"><?php echo $label; ?></a>

    </div>
    <!-- End Article Body -->

</div>
<!-- End Articles -->