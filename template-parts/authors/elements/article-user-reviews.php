<!-- App Reviews -->
<?php // Get Taxonomy data. 
    $taxonomy = wp_get_post_terms( get_the_ID(), 'user-reviews-category' )[0];

    $unique_key = rand();

    if ( ! $taxonomy ) {
        $taxonomy = get_term_by('name', get_field('which_app_are_you_reviewing'), 'user-reviews-category'); 
    }

    $taxonomytype = $taxonomy->taxonomy . '_' . $taxonomy->term_id;
    $name         = $taxonomy->name;
    $image        = get_field( 'image', $taxonomytype );
    $rating       = get_field( 'ratings' ); 
    $rows         = get_field( 'personal' ); ?>

    <div class="container blogging-app-reviewed" id="post_<?php the_ID(); ?>">

        <!-- Header Reviews  -->
        <div class="doctors-app-reviewed__head row"> 

            <div class="pl-3 doctors-app-reviewed__app-col-right doctors-app-reviewed__app-col-right-app d-flex">

                <div class="doctors-app-reviewed__app-logo" style="background-image: url('<?php echo $image; ?>')"></div>

                <div class="doctors-app-reviewed__title-group d-flex align-items-center">
                
                    <h1 class="doctors-app-reviewed__app-title"><?php echo $name; ?></h1>

                </div>

                <p class="doctors-app-reviewed__total-reviews"></p>
            
            </div>

        </div>
        <!-- Header Reviews  -->

        <!-- Body Review -->
        <div class="container doctors-app-reviewed__user-review mt-3 mb-5">

            <div class="row doctors-app-reviewed__group doctors-app-reviewed-mobile d-flex flex-row justify-content-between">

                <div class="doctors-app-reviewed__box-container doctors-app-reviewed__box-container-app d-flex justify-content-between <?php echo ( $rows['doctor'] ) ? 'is_doctor' : ''; ?> align-items-center">
                    
                    <div class="doctors-app-reviewed__box-container__name-app">

                        <div class="doctors-app-reviewed__box-container__doctor-image" style="background-image: url(<?php echo $avatar; ?>);">

                            <div class="doctors-app-reviewed__box-container__float-doctor doctors-app-reviewed__box-container__float-doctor-app">

                                <img src="<?php echo IMAGES; ?>/doctor-logo.svg" alt="Doctor Logo">

                            </div>

                        </div>

                        <div class="dcotors-app-reviewed__box-container__text">

                            <h2 class="doctors-app-reviewed__box-container__name__user-name"><?php echo ( isset($rows['private']) ) ? 'Anonymous' : get_the_author_meta('display_name'); ?></h2>

                            <?php if ( $rows['doctor'] && $rows['specialty'] ) : ?>

                                <p class="doctors-app-reviewed__box-container__name__date id_doctor_specialty"><b><?php echo $rows['specialty']; ?></b></p>

                                <!-- <p class="doctors-app-reviewed__box-container__name__date"><?php //echo get_the_date('F j, g:iA '); ?></p> -->

                            <?php else: ?>

                                <!-- <p class="doctors-app-reviewed__box-container__name__date"><?php //echo get_the_date('F j, g:iA '); ?></p> -->

                                <p class="doctors-app-reviewed__box-container__name__date">User since <?php echo get_the_date('Y'); ?></p>

                            <?php endif; ?>

                        </div>

                    </div>

                    <div class="doctors-app-reviewed__box-container__overall d-flex flex-column">

                        <p class="doctors-app-reviewed__box-container__overall__number"><?php echo number_format( $rating['overall_ranking'], 1, '.', ',' ); ?></p>
                        
                        <div class="doctors-app-reviewed__group d-flex flex-row">

                            <div class="list-stars">
                                <?php 
                                    for ( $i=1; $i < 6; $i++ ) { 

                                        if( $i <= $rating['overall_ranking'] ){

                                            echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg" alt="Star">';

                                        }else{

                                            echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg" alt="Star">';

                                        }
                                    } 
                                ?>                      
                            </div>

                        </div>

                        <h3 class="doctors-app-reviewed__box-container__overall__text pb-1">Overall App Score</h3>

                    </div>

                </div>

            </div>

            <div class="row doctors-app-reviewed__group doctors-app-reviewed__commentaries d-flex flex-row justify-content-between <?php echo ( $rows['doctor'] ) ? 'is_doctor_commetaries' : ''; ?>">

                <div class="order-lg-1 order-2">
                    
                    <?php if ( get_field('comment') ) : ?>

                        <h2 class="doctors-app-reviewed__overall-comment-title mb-2">Overall Comment</h2>

                        <p class="doctors-app-reviewed__overall-comment d-flex flex-column justify-content-between mb-4">

                            <?php echo get_field( 'comment' ); ?>

                        </p>

                    <?php endif; ?>

                    <?php if ( get_field('pros') || get_field('cons') ) : ?>

                        <button type="button" id="js-show-<?php echo $unique_key . get_the_ID(); ?>" onclick="readMore( <?php echo $unique_key . get_the_ID(); ?> )" class="btn-read-more text-left">Read Full Review</button>

                    <?php endif; ?>

                </div>

                <!-- READMORE -->
                <div id="js-more-<?php echo $unique_key . get_the_ID(); ?>" class="doctors-app-reviewed__read-more order-3 d-none">

                    <?php if ( get_field('pros') ) : ?>

                        <h2 class="doctors-app-reviewed__overall-comment-title mb-2">Pros</h2>

                        <p class="doctors-app-reviewed__read-more-commentary mb-4">

                            <?php echo get_field( 'pros' ); ?>

                        </p>

                    <?php endif; ?>

                    <?php if ( get_field('cons') ) : ?>

                        <h2 class="doctors-app-reviewed__overall-comment-title mb-2">Cons</h2>

                        <p class="doctors-app-reviewed__read-more-commentary mb-4">

                            <?php echo get_field( 'cons' ); ?>

                        </p>

                    <?php endif; ?> 

                    <?php if ( get_field('pros') || get_field('cons') ) : ?>

                        <button type="button" onclick="readLess( <?php echo $unique_key . get_the_ID(); ?> )" class="btn-read-more">Read Less...</button>

                    <?php endif; ?>

                </div>
                
            </div>

        </div>
        <!-- End Body Review -->

    </div>
    <!-- End App Reviews -->