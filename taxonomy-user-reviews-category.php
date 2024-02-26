<?php get_header('2021'); ?>

<?php the_post();?>

<?php
// Get Taxonomy data. 
$taxonomytype = get_queried_object();
$name        = get_queried_object()->name;
$description = get_queried_object()->description;
$long_description = get_field( 'long_description', $taxonomytype );
$appLink     = get_field( 'app_link', $taxonomytype );
$iosLink     = get_field( 'app_ios', $taxonomytype );
$androidLink = get_field( 'app_android', $taxonomytype );
$image       = get_field( 'image', $taxonomytype );
$price       = get_field( 'price', $taxonomytype );
$ratings     = calcGralRating( $taxonomytype->term_id );
$overall     = $ratings['rating'];
$easeUse     = $ratings['ease'];
$valueMoney  = $ratings['money'];
$features    = $ratings['features'];
$cantReviews = $taxonomytype->count;
?>

<div class="container-single-taxonomy-page">
    <!-- Navbar -->
    <div class="single-app-review-navbar">
        <div class="container">
            <h3><a href="<?php echo esc_url( home_url() ); ?>">Back to Home</a> / </h3>
            <a class="styles-none"><?php echo $name; ?></a>
        </div>
    </div>
    <!-- End Navbar -->
    
    <div class="container app-reviewed ">
    
        <!-- Start Header User Reviews  -->
        <?php require_once(  __DIR__ . '/template-parts/taxonomies/user-reviews/header-app.php' ); ?>
        <!-- End Header User Reviews  -->
    
        <!-- Start loop User Reviews -->
        <?php require_once(  __DIR__ . '/template-parts/taxonomies/user-reviews/reviews.php' ); ?>
        <!-- End loop User Reviews -->
    
    </div>
    
    <!-- START MODAL -->
    <?php require_once(  __DIR__ . '/template-parts/taxonomies/user-reviews/modal.php' ); ?>
    <!-- END MODAL -->
    
    <?php the_content() ?>
    
</div>

<?php get_footer(); ?>