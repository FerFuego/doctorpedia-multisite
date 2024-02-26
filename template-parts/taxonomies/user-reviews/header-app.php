<div class="app-reviewed__head row" id="js-app-reviewed-header"> 

    <div class="col-lg-1 app-reviewed__app-img">
        <img class="app-review-module__img" src="<?php echo $image; ?>" alt="<?php echo $category->name; ?>">
    </div>

    <div class="col-lg-8 pl-lg-5 app-reviewed__app-col-right">

        <div class="app-reviewed__title-group d-flex align-items-center">
            <!-- Changed from h2 to h1 -->
            <h1 class="app-reviewed__app-title"><?php echo $name; ?></h1>
        </div>

        <div class="app-reviewed__app-score d-flex align-items-center">

            <div class="app-review__overall-score mr-2">
                <p><?php echo number_format( $overall, 1, '.', ',' ); ?>
            </div>

            <div class="list-stars">
                <?php 
                    for ($i=1; $i < 6; $i++) { 
                        if( $i <= $overall ) {
                            echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg" alt="Star">';
                        } else {
                            echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg" alt="Star">';
                        }
                    } 
                ?>
            </div>

            <div class="app-reviewed__price">

                <?php if( $price ): ?>

                    <div class="app-review-module__price-group d-flex align-items-center">

                        <p class="app-review-module__price-group-price mr-1">Price</p>

                        <svg class="app-review-module__price-icon" width="8px" height="14px" viewBox="0 0 8 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="App-Review" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-1.000000, 0.000000)" fill="#DADADA">
                                    <path d="M8.528,9.24 C8.528,10.936 7.296,11.976 5.424,12.136 L5.424,13.544 L4.24,13.544 L4.24,12.136 C2.24,11.944 1.12,10.712 1.12,8.984 L2.736,8.984 C2.736,10.184 3.52,10.792 4.864,10.792 C6.128,10.792 6.832,10.248 6.832,9.336 C6.832,8.584 6.352,8.184 5.456,7.96 L3.92,7.576 C2.032,7.096 1.392,6.056 1.392,4.872 C1.392,3.336 2.464,2.264 4.24,2.088 L4.24,0.728 L5.424,0.728 L5.424,2.088 C7.136,2.296 8.24,3.32 8.272,4.952 L6.64,4.952 C6.624,4.04 5.936,3.416 4.768,3.416 C3.696,3.416 3.072,3.928 3.072,4.76 C3.072,5.512 3.584,5.88 4.544,6.104 L6.048,6.488 C7.936,6.952 8.528,8.04 8.528,9.24 Z" id="$"></path>
                                </g>
                            </g>
                        </svg>

                        <p><?php echo number_format( $price, 2, '.', ',' ); ?> </p>

                    </div>

                <?php else: ?>

                    <div class="app-review-module__price-quant">
                        <p class="app-review-module__price-quant-text">Free</p>
                    </div>

                <?php endif; ?>

            </div>

        </div>

        <a href="#js-target-reviews" class="app-reviewed__total-reviews">( <?php echo $cantReviews; ?> Reviews)</a>
    
    </div>

    <div class="col-md-4 col-lg-3 app-reviewed__app-col-buttons">

        <div class="app-reviewed__group d-xs-flex d-md-flex d-lg-flex justify-content-between app-reviewed__header-buttons">

            <?php if( $iosLink ): ?>
                <a href="<?php echo $iosLink; ?>" target="_blank" class="btn-download mb-3">Download for iOS</a>
            <?php endif; ?>

            <?php if( $androidLink ): ?>
                <a href="<?php echo $androidLink; ?>" target="_blank" class="btn-download">Download for Android</a>
            <?php endif; ?>

        </div>

    </div>

</div>

<div class="app-reviewed__app-description mb-5">
    <div class="app-reviewed__app-description-text" id="js-HeaderText">
        <?php 
            if ( $long_description ) :
                echo $long_description;
            else :
                echo $description;
            endif; 
        ?>
    </div>
</div>

<div class="app-reviewed__group d-flex flex-md-row justify-content-between group-border align-items-center p-3 pb-md-4" id="js-target-reviews">
    
    <!-- Changed from h1 to h2-->
    <h2 class="app-reviewed__title">User Submitted Reviews</h2>

    <div class="app-reviewed__group  app-reviewed__cont-button  d-flex align-items-center pl-2">
        <a onclick="showModal()" class="btn-download btn-download--teal">Add Review</a>
    </div>
    
</div>