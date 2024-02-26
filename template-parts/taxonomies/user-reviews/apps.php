<div class="row d-flex flex-row justify-content-between mb-5 app-review-module__container">

    <?php 
        global $paged;
        
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $postsPerPage = 10;
        $offset = ( $postsPerPage * $paged ) - $postsPerPage;

        $args = array(
            'taxonomy' => 'user-reviews-category',
            'orderby' => 'id',
            'order' => 'DESC',
            'hide_empty' => 0,
            'number' => $postsPerPage,
            'offset' => $offset,
        );

        $categories = get_categories( $args );
    
        foreach( $categories as $key => $category ): 
            $taxonomytype   = $category->taxonomy . '_' . $category->term_id;
            $appLink        = get_field( 'app_link', $taxonomytype );
            $image          = get_field( 'image', $taxonomytype );
            $price          = get_field( 'price', $taxonomytype );
            $app_comment    = get_field( 'app_comment', $taxonomytype );
            $review_by      = get_field( 'review_by', $taxonomytype );
            $sites_allowed  = get_field( 'wp_multisites', $taxonomytype );
            $ratings        = calcGralRating( $category->term_id ); // Return Prom Ratings
            $overall        = $ratings['rating'];
            $easeUse        = $ratings['ease'];
            $valueMoney     = $ratings['money'];
            $features       = $ratings['features'];
            $support        = $ratings['support'];
            $comment        = getFeaturedUserReviewed( $category->term_id ); //Return Featured User Reviewed 
        ?>

            <div class="app-review-module col-lg-6 col-12 mb-5">

                <div class="row app-review-module__app-container">

                    <div class="col-lg-3 col-2 d-flex justify-content-center align-items-center app-review-module__app-img">

                        <img class="app-review-module__img" src="<?php echo str_replace( [strtolower($current_site),'sites/1/'], ['doctorpedia',''], $image); ?>" alt="<?php echo $category->name; ?>">

                    </div>

                    <div class="col-lg-9 col-6 app-review-module__app-column-right">

                        <a href="<?php echo get_category_link( $category->term_id ); ?>">

                            <h2 class="app-review-module__title"><?php echo $category->name; ?></h2>

                        </a>

                        <div class="row">

                            <div class="col-lg-8 col-12 col-p-fix-l">

                                <div class="app-review-module__stars-group d-flex flex-row align-items-center mb-2">

                                    <div class="app-review-module__stars-inner-group d-flex align-items-center">

                                        <div class="app-review-module__overall-score mr-2">

                                            <p><?php echo number_format( $overall, 1, '.', ',' ); ?></p>

                                        </div>
            
                                        <div class="star-module d-flex flex-row justify-content-center">

                                            <div class="list-stars">

                                                <?php for ($i=1; $i < 6; $i++) { 

                                                    if($i <= $overall){

                                                        echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg" alt="Star">';

                                                    }else{

                                                        echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg" alt="Star">';

                                                    }

                                                } ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <a href="<?php echo get_category_link( $category->term_id ); ?>" class="app-review-module__review-link">( <?php echo $category->count; ?> Reviews)</a>

                                </div>
                            
                            </div>

                            <div class="col-lg-4 col-12 pt-lg-0 pt-3 app-review-module__price-col-fix">

                                <div class="justify-content-end d-flex flex-column">

                                    <div class="app-review-module__price">

                                        <?php if ( $price ): ?>

                                            <div class="app-review-module__price-group d-flex align-items-center">

                                                <p class="app-review-module__price-group-price mr-1">Price</p>

                                                <svg class="app-review-module__price-icon" width="8px" height="14px" viewBox="0 0 8 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                                                    <g id="App-Review" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                                        <g id="Artboard" transform="translate(-1.000000, 0.000000)" fill="#000">

                                                            <path d="M8.528,9.24 C8.528,10.936 7.296,11.976 5.424,12.136 L5.424,13.544 L4.24,13.544 L4.24,12.136 C2.24,11.944 1.12,10.712 1.12,8.984 L2.736,8.984 C2.736,10.184 3.52,10.792 4.864,10.792 C6.128,10.792 6.832,10.248 6.832,9.336 C6.832,8.584 6.352,8.184 5.456,7.96 L3.92,7.576 C2.032,7.096 1.392,6.056 1.392,4.872 C1.392,3.336 2.464,2.264 4.24,2.088 L4.24,0.728 L5.424,0.728 L5.424,2.088 C7.136,2.296 8.24,3.32 8.272,4.952 L6.64,4.952 C6.624,4.04 5.936,3.416 4.768,3.416 C3.696,3.416 3.072,3.928 3.072,4.76 C3.072,5.512 3.584,5.88 4.544,6.104 L6.048,6.488 C7.936,6.952 8.528,8.04 8.528,9.24 Z" id="$"></path>

                                                        </g>

                                                    </g>

                                                </svg>

                                            <p> <?php echo number_format( $price, 2,'.', ',' ); ?> </p>

                                            </div>

                                        <?php else: ?>

                                            <div class="app-review-module__price-quant">

                                                <p class="app-review-module__price-quant-text">Free</p>

                                            </div>

                                        <?php endif; ?>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="app-review-module__divider-h d-flex justify-content-center">

                    <div class="app-review-module__divider-h-line"></div>

                </div>

                <div class="row h-100">

                    <div class="col-md-8 col-12 pr-3 app-review-module__app-description-group">

                        <p class="app-review-module__app-description pb-4">
                            <?php 
                                $desc = strip_tags( $category->category_description, '<p><a><b><br><strong>');

                                if ( strlen( $desc ) > 230 ) {

                                    echo Cadena::corta( $desc, 230);

                                } else {

                                    echo $desc;
                                    
                                }
                            ?>                        
                        </p>

                        <?php if ( $app_comment ) : ?>

                            <div class="app-review-module__app-commentary">

                                <span><?php  echo $app_comment; ?></span> <br> 
                                
                                <div class="user-name">- <?php echo $review_by; ?></div>

                            </div>
                        
                        <?php elseif ( $comment ) : ?>
                            
                            <div class="app-review-module__app-commentary"><?php  echo $comment; ?></div>

                        <?php endif; ?>

                    </div>

                    <div class="col-md-4 col-12 d-flex flex-column justify-content-between">

                        <div class="app-review-module__all-scores">
                            
                            <div class="app-review-module__group mb-2">

                                <div class="app-review-module__rating">

                                    <p class="app-review-module__rating-title">Ease of use</p>

                                    <div class="app-review-module__rating-group d-flex align-items-center">

                                        <p class="app-review-module__rating-group-avg mr-2"><?php echo number_format( $easeUse, 1, '.', ',' ); ?></p>

                                        <div class="star-module d-flex flex-row justify-content-center">

                                            <div class="list-stars">

                                                <?php for ($i=1; $i < 6; $i++) { 

                                                    if($i <= $easeUse){

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

                            <div class="app-review-module__group mb-2">

                                <div class="app-review-module__rating">

                                    <p class="app-review-module__rating-title">Features</p>

                                    <div class="app-review-module__rating-group d-flex align-items-center">

                                        <p class="app-review-module__rating-group-avg mr-2"><?php echo number_format( $features, 1, '.', ',' ); ?></p>

                                        <div class="star-module d-flex flex-row justify-content-center">

                                            <div class="list-stars">

                                                <?php for ($i=1; $i < 6; $i++) { 

                                                    if($i <= $features){

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

                            <div class="app-review-module__group mb-2">

                                <div class="app-review-module__rating">

                                    <p class="app-review-module__rating-title">Value for money</p>

                                    <div class="app-review-module__rating-group d-flex align-items-center">

                                        <p class="app-review-module__rating-group-avg mr-2"><?php echo number_format( $valueMoney, 1, '.', ',' ); ?></p>

                                        <div class="star-module d-flex flex-row justify-content-center">

                                            <div class="list-stars">

                                                <?php for ($i=1; $i < 6; $i++) { 

                                                    if($i <= $valueMoney){

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

                            <div class="app-review-module__group mb-2">

                                <div class="app-review-module__rating">

                                    <p class="app-review-module__rating-title">Customer Support</p>

                                    <div class="app-review-module__rating-group d-flex align-items-center">

                                        <p class="app-review-module__rating-group-avg mr-2"><?php echo number_format( $support, 1, '.', ',' ); ?></p>

                                        <div class="star-module d-flex flex-row justify-content-center">

                                            <div class="list-stars">

                                                <?php for ( $i=1; $i < 6; $i++ ) { 

                                                    if( $i <= $support ){

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
                        
                        <div class="app-review-module__view-rev-parent d-flex justify-content-end">

                            <a href="<?php echo get_category_link( $category->term_id ); ?>" class="btn-download btn-download--reviews">View Reviews</a>

                        </div>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>  

    <div class="col-lg-12 col-12 mb-12 text-center navigation">
        <?php  paginationApp( $postsPerPage ); ?>
    </div>

</div>