<?php
/**
 * Loop users reviews in App reviewed
 */
global $wp_query;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if ( $_GET['order'] && $_GET['order'] != 'Recent' ) {
    if ( $_GET['order'] == 'Best') {
        $meta_key = 'ratings_overall_ranking';
        $orderby = 'meta_value';
        $order   = 'DESC';
    } else if ( $_GET['order'] == 'Worst') {
        $meta_key = 'ratings_overall_ranking';
        $orderby = 'meta_value';
        $order   = 'ASC';
    } else {
        $meta_key = null;
        $orderby = 'date';
        $order = 'ASC';
    }
} else {
    $meta_key = null;
    $orderby = 'date';
    $order   = 'DESC';
}

$args = array(
    'post_type'     => 'user-reviews',
    'post_status'   => 'publish',
    'tax_query'     => array(
        array(
            'taxonomy'  => 'user-reviews-category',
            'field'     => 'term_id',
            'terms'     => ( $term->term_id ) ? $term->term_id : get_queried_object()->term_id,
        )
    ), 
	'orderby'   => $orderby,
    'meta_key'  => $meta_key,
    'order'     => $order,
    'showposts' => 1000,
    'paged'     => $paged
);

$query = query_posts( $args );

if ( have_posts() ) : ?>

    <div class="container app-reviewed__order">
        <div class="app-reviewed__order__count">
            <?php echo $wp_query->found_posts . ' Reviews'; ?>
        </div>
        <div class="app-reviewed__order__orderby">
            <form method="GET">
                <?php if ( isset($_GET['app']) ) : ?>
                    <input type="hidden" name="app" value="<?php echo $_GET['app']; ?>">
                <?php endif; ?>
                <select name="order" onchange="this.form.submit()">
                    <?php echo ( isset( $_GET['order'] ) ) ? '<option value="' . $_GET['order'] . '">' . $_GET['order'] . '</option>' : '<option value="">Sort by</option>'; ?>
                    <option value="Recent">Recent</option>
                    <option value="Old">Old</option>
                    <option value="Best">Best</option>
                    <option value="Worst">Worst</option>
                </select>
            </form>
        </div>
    </div>

    <?php while ( have_posts() ) : the_post(); $x++; ?>
        <!-- Function return Overall Rating -->
        <?php
            $rating = get_field('ratings');
            $rows = get_field( 'personal' );
        ?>

        <div class="container app-reviewed__user-review pb-5 js-reviews-container" data-id="<?php echo $x; ?>">

            <div class="row app-reviewed__group d-flex flex-row justify-content-between">
                <div class="app-reviewed__box-container d-flex justify-content-between <?php echo ( $rows['doctor'] ) ? 'is_doctor' : ''; ?>">
                    
                    <?php if ( $rows['doctor'] ) : ?>    
                        <div class="app-reviewed__box-container__float-doctor"><img src="<?php echo IMAGES; ?>/doctor-logo.svg" alt="Doctor Logo"></div>
                    <?php endif; ?>
                    
                    <div class="app-reviewed__box-container__name">
                        <h2 class="app-reviewed__box-container__name__user-name"><?php echo ( $rows['private'] ) ? 'Anonymous' : get_the_title(); ?></h2>

                        <?php if ( $rows['doctor'] && $rows['specialty'] ) : ?>
                            <p class="app-reviewed__box-container__name__date id_doctor_specialty"><b><?php echo $rows['specialty']; ?></b></p>
                            <p class="app-reviewed__box-container__name__date"><?php echo get_the_date('F j, g:iA '); ?></p>
                        <?php else: ?>
                            <p class="app-reviewed__box-container__name__date"><?php echo get_the_date('F j, g:iA '); ?></p>
                            <p class="app-reviewed__box-container__name__date">User since <?php echo get_the_date('Y'); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="app-reviewed__box-container__overall d-flex flex-column">
                        <p class="app-reviewed__box-container__overall__number"><?php echo number_format( $rating['overall_ranking'], 1, '.', ',' ); ?></p>
                        
                        <div class="app-reviewed__group d-flex flex-row">
                            <div class="list-stars">
                                <?php for ( $i=1; $i < 6; $i++ ) { 
                                    if( $i <= $rating['overall_ranking'] ){
                                        echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg" alt="Star">';
                                    }else{
                                        echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg" alt="Star">';
                                    }
                                } ?>                      
                            </div>
                        </div>
                        <h3 class="app-reviewed__box-container__overall__text pb-1">Overall App Score</h3>
                    </div>

                    <div class="app-reviewed__box-container__scores-group order-lg-2 order-1">

                        <div class="app-reviewed__rating-box-group">
                            <div class="app-reviewed__rating-box d-flex flex-row justify-content-between">

                                <p class="app-reviewed__rating-box-title">Ease of Use</p>

                                <div class="app-reviewed__rating-box__group d-flex">

                                    <p class="app-reviewed__overall-number"><?php echo ( $rating['ease_use'] ) ? number_format( $rating['ease_use'], 1, '.', ',' ) : '0.0'; ?></p>
                                    
                                    <div class="list-stars">
                                            <?php for ( $i=1; $i < 6; $i++ ) { 
                                                if( $i <= $rating['ease_use'] ){
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg" alt="Star">';
                                                }else{
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg" alt="Star">';
                                                }
                                            } ?>
                                    </div>   

                                </div>

                            </div>

                            <div class="app-reviewed__rating-box d-flex flex-row justify-content-between">

                                <p class="app-reviewed__rating-box-title">Features</p>

                                <div class="app-reviewed__rating-box__group d-flex">

                                    <p class="app-reviewed__overall-number"><?php echo ( $rating['features'] ) ? number_format( $rating['features'], 1, '.', ',' ) : '0.0'; ?></p>
                                    
                                    <div class="list-stars">
                                            <?php for ( $i=1; $i < 6; $i++ ) { 
                                                if( $i <= $rating['features'] ){
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg" alt="Star">';
                                                }else{
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg" alt="Star">';
                                                }
                                            } ?>
                                    </div>   

                                </div>

                            </div>

                            <div class="app-reviewed__rating-box d-flex flex-row justify-content-between">
                                <p class="app-reviewed__rating-box-title">Value for Money</p>
                                
                                <div class="app-reviewed__rating-box__group d-flex">
                                
                                    <p class="app-reviewed__overall-number"><?php echo ( $rating['value_money'] ) ? number_format( $rating['value_money'], 1, '.', ',' ) : '0.0'; ?></p>
                                    
                                    <div class="list-stars">
                                        <?php for ( $i=1; $i < 6; $i++ ) { 
                                            if( $i <= $rating['value_money'] ){
                                                echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg" alt="Star">';
                                            }else{
                                                echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg" alt="Star">';
                                            }
                                        } ?>
                                    </div>   
                                
                                </div>
                                
                            </div>

                            <div class="app-reviewed__rating-box d-flex flex-row justify-content-between">
                                <p class="app-reviewed__rating-box-title">Customer Support</p>
                                
                                <div class="app-reviewed__rating-box__group d-flex">
                                
                                    <p class="app-reviewed__overall-number"><?php echo ( $rating['support'] ) ? number_format( $rating['support'], 1, '.', ',' ) : '0.0'; ?></p>
                                    
                                    <div class="list-stars">
                                        <?php for ( $i=1; $i < 6; $i++ ) { 
                                            if( $i <= $rating['support'] ){
                                                echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg" alt="Star">';
                                            }else{
                                                echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg" alt="Star">';
                                            }
                                        } ?>
                                    </div>   
                                
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row app-reviewed__group app-reviewed__commentaries d-flex flex-row justify-content-between <?php echo ( $rows['doctor'] ) ? 'is_doctor_commetaries' : ''; ?>">

                <div class="order-lg-1 order-2">
                    <h2 class="app-reviewed__overall-comment-title mb-2">Overall Comment</h2>

                    <p class="app-reviewed__overall-comment d-flex flex-column justify-content-between mb-4">
                        <?php the_field( 'comment' ); ?>
                    </p>
                    <button type="button" id="js-show-<?php echo $x; ?>" onclick="readMore( <?php echo $x; ?> )" class="btn-read-more text-left">Read More...</button>
                </div>

                <!-- READMORE -->
                <div id="js-more-<?php echo $x; ?>" class="app-reviewed__read-more order-3 d-none">
                    <h2 class="app-reviewed__overall-comment-title mb-2">Pros</h2>
                    <p class="app-reviewed__read-more-commentary mb-4">
                        <?php the_field( 'pros' ); ?>
                    </p>
        
                    <h2 class="app-reviewed__overall-comment-title mb-2">Cons</h2>
                    <p class="app-reviewed__read-more-commentary mb-4">
                        <?php the_field( 'cons' ); ?>
                    </p>
        
                    <button type="button" onclick="readLess( <?php echo $x; ?> )" class="btn-read-more">Read Less...</button>
                </div>
                
            </div>

        </div>
    <?php endwhile; ?>
    
    <div class="navigation" id="js-reviews-navigation">
        <!-- Pagination with Js -->
    </div>

<?php else : ?>

    <div class="app-reviewed__user-review mt-3 mb-5">
        <div class="row app-reviewed__group d-flex flex-row justify-content-between pt-lg-5 p-3">
            <div class="col-lg-12 col-12 d-flex flex-column">
                <h3 class="app-reviewed__user-name app-reviewed__no-results">This app doesn't have any reviews. You can be the first to review it!</h3>
            </div>
        </div>
    </div>

<?php endif; ?>