<?php /* Template Name: New App Reviews */?>

<?php get_header('secondary'); ?>

<?php the_post();?>

<!-- App Reviews Layout -->
<!-- Secondary Header Module -->
<div class="secondary-header">

    <div class="container">
        <img src="<?php echo IMAGES; ?>/clipboard icon.svg" alt="">
        <div class="page-title">
            <h1><?php the_field('title_section')?></h1>
            <p><?php the_field('description_section')?></p>
        </div>
    </div>
</div>
<!-- Secondary Header Module -->

<section class="app-review">

    <div class="container">

        <div class="app-review__head d-flex justify-content-between">
            <h1 class="app-review__title">Apps Reviewed by Users</h1>
            <a href="#" class="btn-download btn-download--teal">Add Review</a>
        </div>

        <!-- START APP ROW -->
        <div class="row d-flex flex-row justify-content-between mb-5">

        <!-- START APP -->
            <div class="app-review-module">
        
                <div class="row">

                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <img class="app-review-module__img" src="<?php echo IMAGES; ?>/apps/relaxlite.jpg" alt="">
                    </div>

                    <div class="col-9">
                        <h2 class="app-review-module__title">Relax Lite</h2>
                        <div class="row">
                            <div class="col-8 col-p-fix-l">

                                <div class="app-review-module__group d-flex flex-row align-items-center mb-2">

                                    <div class="app-review-module__overall-score mr-2"><p>4.0</p></div>

                                    <div class="star-module d-flex flex-row justify-content-center">

                                        <div class="list-stars">
                                            <?php for ($i=1; $i < 6; $i++) { 
                                                if($i <= $v['stars']){
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg">';
                                                }else{
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg">';
                                                }
                                            } ?>
                                        </div>

                                    </div>
            
                                    <a href="#" class="app-review-module__review-link">(145 Reviews)</a>

                                </div>

                                <a href="#" class="app-review-module__review-view-app">View App</a>
                            
                            </div>

                            <div class="col-4">
                                <div class="justify-content-end d-flex flex-column">
                                    <div class="app-review-module__price">
                                        <div class="app-review-module__price-group d-flex align-items-center">
                                            <p class="app-review-module__price-group-price mr-1">Price</p>
                                           <svg class="app-review-module__price-icon" width="8px" height="14px" viewBox="0 0 8 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g id="App-Review" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g id="Artboard" transform="translate(-1.000000, 0.000000)" fill="#DADADA">
                                                        <path d="M8.528,9.24 C8.528,10.936 7.296,11.976 5.424,12.136 L5.424,13.544 L4.24,13.544 L4.24,12.136 C2.24,11.944 1.12,10.712 1.12,8.984 L2.736,8.984 C2.736,10.184 3.52,10.792 4.864,10.792 C6.128,10.792 6.832,10.248 6.832,9.336 C6.832,8.584 6.352,8.184 5.456,7.96 L3.92,7.576 C2.032,7.096 1.392,6.056 1.392,4.872 C1.392,3.336 2.464,2.264 4.24,2.088 L4.24,0.728 L5.424,0.728 L5.424,2.088 C7.136,2.296 8.24,3.32 8.272,4.952 L6.64,4.952 C6.624,4.04 5.936,3.416 4.768,3.416 C3.696,3.416 3.072,3.928 3.072,4.76 C3.072,5.512 3.584,5.88 4.544,6.104 L6.048,6.488 C7.936,6.952 8.528,8.04 8.528,9.24 Z" id="$"></path>
                                                    </g>
                                                </g>
                                            </svg>

                                            <svg class="app-review-module__price-icon" width="8px" height="14px" viewBox="0 0 8 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g id="App-Review" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g id="Artboard" transform="translate(-1.000000, 0.000000)" fill="#DADADA">
                                                        <path d="M8.528,9.24 C8.528,10.936 7.296,11.976 5.424,12.136 L5.424,13.544 L4.24,13.544 L4.24,12.136 C2.24,11.944 1.12,10.712 1.12,8.984 L2.736,8.984 C2.736,10.184 3.52,10.792 4.864,10.792 C6.128,10.792 6.832,10.248 6.832,9.336 C6.832,8.584 6.352,8.184 5.456,7.96 L3.92,7.576 C2.032,7.096 1.392,6.056 1.392,4.872 C1.392,3.336 2.464,2.264 4.24,2.088 L4.24,0.728 L5.424,0.728 L5.424,2.088 C7.136,2.296 8.24,3.32 8.272,4.952 L6.64,4.952 C6.624,4.04 5.936,3.416 4.768,3.416 C3.696,3.416 3.072,3.928 3.072,4.76 C3.072,5.512 3.584,5.88 4.544,6.104 L6.048,6.488 C7.936,6.952 8.528,8.04 8.528,9.24 Z" id="$"></path>
                                                    </g>
                                                </g>
                                            </svg>

                                            <svg class="app-review-module__price-icon" width="8px" height="14px" viewBox="0 0 8 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g id="App-Review" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g id="Artboard" transform="translate(-1.000000, 0.000000)" fill="#DADADA">
                                                        <path d="M8.528,9.24 C8.528,10.936 7.296,11.976 5.424,12.136 L5.424,13.544 L4.24,13.544 L4.24,12.136 C2.24,11.944 1.12,10.712 1.12,8.984 L2.736,8.984 C2.736,10.184 3.52,10.792 4.864,10.792 C6.128,10.792 6.832,10.248 6.832,9.336 C6.832,8.584 6.352,8.184 5.456,7.96 L3.92,7.576 C2.032,7.096 1.392,6.056 1.392,4.872 C1.392,3.336 2.464,2.264 4.24,2.088 L4.24,0.728 L5.424,0.728 L5.424,2.088 C7.136,2.296 8.24,3.32 8.272,4.952 L6.64,4.952 C6.624,4.04 5.936,3.416 4.768,3.416 C3.696,3.416 3.072,3.928 3.072,4.76 C3.072,5.512 3.584,5.88 4.544,6.104 L6.048,6.488 C7.936,6.952 8.528,8.04 8.528,9.24 Z" id="$"></path>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="app-review-module__price-quant">
                                            <p class="app-review-module__price-quant-text">Free</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        

                    </div>

                </div>

                <div class="app-review-module__divider-h d-flex justify-content-center">

                    <div class="app-review-module__divider-h-line"></div>

                </div>

                <div class="row">

                    <div class="col-8 col-p-fix-r col-border">
                        <p class="app-review-module__app-description pb-3">Effective and rapid stress relief in 5 minutes.
                            De-stress with our guided breathing and meditation exercises that use calming music to promote relaxation. It’s an ideal stress management tool, being simple and intuitive. </p>

                            <p class="app-review-module__app-commentary pr-2">“Very easily navigable with simple buttons and clear instructions. Really helps relieve stress almost automatically. ” <br>
                    - Eli Petrovich</p>
                    </div>

                    <div class="col-4 d-flex flex-column justify-content-between">
                        <div class="">
                            
                            <div class="app-review-module__group mb-2">
                                <div class="app-review-module__rating">
                                    <p class="app-review-module__rating-title">Ease of use</p>
                                    <div class="app-review-module__rating-group d-flex">
                                        <p class="app-review-module__rating-group-avg mr-2">5.0</p>
                                        <div class="star-module d-flex flex-row justify-content-center">

                                        <div class="list-stars">
                                            <?php for ($i=1; $i < 6; $i++) { 
                                                if($i <= $v['stars']){
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg">';
                                                }else{
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg">';
                                                }
                                            } ?>
                                        </div>

                                    </div>
                                    </div>

                                </div>

                            </div>
                            <div class="app-review-module__group mb-2">
                                <div class="app-review-module__rating">
                                    <p class="app-review-module__rating-title">Ease of use</p>
                                    <div class="app-review-module__rating-group d-flex">
                                        <p class="app-review-module__rating-group-avg mr-2">5.0</p>
                                         <div class="star-module d-flex flex-row justify-content-center">

                                        <div class="list-stars">
                                            <?php for ($i=1; $i < 6; $i++) { 
                                                if($i <= $v['stars']){
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg">';
                                                }else{
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg">';
                                                }
                                            } ?>
                                        </div>

                                    </div>
                                    </div>

                                </div>

                            </div>
                            <div class="app-review-module__group mb-2">
                                <div class="app-review-module__rating">
                                    <p class="app-review-module__rating-title">Ease of use</p>
                                    <div class="app-review-module__rating-group d-flex">
                                        <p class="app-review-module__rating-group-avg mr-2">5.0</p>
                                         <div class="star-module d-flex flex-row justify-content-center">

                                        <div class="list-stars">
                                            <?php for ($i=1; $i < 6; $i++) { 
                                                if($i <= $v['stars']){
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg">';
                                                }else{
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg">';
                                                }
                                            } ?>
                                        </div>

                                    </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>


                </div>
                
                <div class="app-review-module__btn d-flex flex-row justify-content-end">

                    <a href="#" class="btn-download">View Reviews</a>

                </div>

            </div>
         <!-- END APP -->                                    
           
          <!-- START APP -->
            <div class="app-review-module">
        
                <div class="row">

                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <img class="app-review-module__img" src="<?php echo IMAGES; ?>/apps/relaxlite.jpg" alt="">
                    </div>

                    <div class="col-9">
                        <h2 class="app-review-module__title">Relax Lite</h2>
                        <div class="row">
                            <div class="col-8 col-p-fix-l">

                                <div class="app-review-module__group d-flex flex-row align-items-center mb-2">

                                    <div class="app-review-module__overall-score mr-2"><p>4.0</p></div>

                                    <div class="star-module d-flex flex-row justify-content-center">

                                        <div class="list-stars">
                                            <?php for ($i=1; $i < 6; $i++) { 
                                                if($i <= $v['stars']){
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg">';
                                                }else{
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg">';
                                                }
                                            } ?>
                                        </div>

                                    </div>
            
                                    <a href="#" class="app-review-module__review-link">(145 Reviews)</a>

                                </div>

                                <a href="#" class="app-review-module__review-view-app">View App</a>
                            
                            </div>

                            <div class="col-4">
                                <div class="justify-content-end d-flex flex-column">
                                    <div class="app-review-module__price">
                                        <div class="app-review-module__price-group d-flex align-items-center">
                                            <p class="app-review-module__price-group-price mr-1">Price</p>
                                           <svg class="app-review-module__price-icon" width="8px" height="14px" viewBox="0 0 8 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g id="App-Review" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g id="Artboard" transform="translate(-1.000000, 0.000000)" fill="#DADADA">
                                                        <path d="M8.528,9.24 C8.528,10.936 7.296,11.976 5.424,12.136 L5.424,13.544 L4.24,13.544 L4.24,12.136 C2.24,11.944 1.12,10.712 1.12,8.984 L2.736,8.984 C2.736,10.184 3.52,10.792 4.864,10.792 C6.128,10.792 6.832,10.248 6.832,9.336 C6.832,8.584 6.352,8.184 5.456,7.96 L3.92,7.576 C2.032,7.096 1.392,6.056 1.392,4.872 C1.392,3.336 2.464,2.264 4.24,2.088 L4.24,0.728 L5.424,0.728 L5.424,2.088 C7.136,2.296 8.24,3.32 8.272,4.952 L6.64,4.952 C6.624,4.04 5.936,3.416 4.768,3.416 C3.696,3.416 3.072,3.928 3.072,4.76 C3.072,5.512 3.584,5.88 4.544,6.104 L6.048,6.488 C7.936,6.952 8.528,8.04 8.528,9.24 Z" id="$"></path>
                                                    </g>
                                                </g>
                                            </svg>

                                            <svg class="app-review-module__price-icon" width="8px" height="14px" viewBox="0 0 8 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g id="App-Review" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g id="Artboard" transform="translate(-1.000000, 0.000000)" fill="#DADADA">
                                                        <path d="M8.528,9.24 C8.528,10.936 7.296,11.976 5.424,12.136 L5.424,13.544 L4.24,13.544 L4.24,12.136 C2.24,11.944 1.12,10.712 1.12,8.984 L2.736,8.984 C2.736,10.184 3.52,10.792 4.864,10.792 C6.128,10.792 6.832,10.248 6.832,9.336 C6.832,8.584 6.352,8.184 5.456,7.96 L3.92,7.576 C2.032,7.096 1.392,6.056 1.392,4.872 C1.392,3.336 2.464,2.264 4.24,2.088 L4.24,0.728 L5.424,0.728 L5.424,2.088 C7.136,2.296 8.24,3.32 8.272,4.952 L6.64,4.952 C6.624,4.04 5.936,3.416 4.768,3.416 C3.696,3.416 3.072,3.928 3.072,4.76 C3.072,5.512 3.584,5.88 4.544,6.104 L6.048,6.488 C7.936,6.952 8.528,8.04 8.528,9.24 Z" id="$"></path>
                                                    </g>
                                                </g>
                                            </svg>

                                            <svg class="app-review-module__price-icon" width="8px" height="14px" viewBox="0 0 8 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g id="App-Review" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g id="Artboard" transform="translate(-1.000000, 0.000000)" fill="#DADADA">
                                                        <path d="M8.528,9.24 C8.528,10.936 7.296,11.976 5.424,12.136 L5.424,13.544 L4.24,13.544 L4.24,12.136 C2.24,11.944 1.12,10.712 1.12,8.984 L2.736,8.984 C2.736,10.184 3.52,10.792 4.864,10.792 C6.128,10.792 6.832,10.248 6.832,9.336 C6.832,8.584 6.352,8.184 5.456,7.96 L3.92,7.576 C2.032,7.096 1.392,6.056 1.392,4.872 C1.392,3.336 2.464,2.264 4.24,2.088 L4.24,0.728 L5.424,0.728 L5.424,2.088 C7.136,2.296 8.24,3.32 8.272,4.952 L6.64,4.952 C6.624,4.04 5.936,3.416 4.768,3.416 C3.696,3.416 3.072,3.928 3.072,4.76 C3.072,5.512 3.584,5.88 4.544,6.104 L6.048,6.488 C7.936,6.952 8.528,8.04 8.528,9.24 Z" id="$"></path>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="app-review-module__price-quant">
                                            <p class="app-review-module__price-quant-text">Free</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        

                    </div>

                </div>

                <div class="app-review-module__divider-h d-flex justify-content-center">

                    <div class="app-review-module__divider-h-line"></div>

                </div>

                <div class="row">

                    <div class="col-8 col-p-fix-r col-border">
                        <p class="app-review-module__app-description pb-3">Effective and rapid stress relief in 5 minutes.
                            De-stress with our guided breathing and meditation exercises that use calming music to promote relaxation. It’s an ideal stress management tool, being simple and intuitive. </p>

                            <p class="app-review-module__app-commentary pr-2">“Very easily navigable with simple buttons and clear instructions. Really helps relieve stress almost automatically. ” <br>
                    - Eli Petrovich</p>
                    </div>

                    <div class="col-4 d-flex flex-column justify-content-between">
                        <div class="">
                            
                            <div class="app-review-module__group mb-2">
                                <div class="app-review-module__rating">
                                    <p class="app-review-module__rating-title">Ease of use</p>
                                    <div class="app-review-module__rating-group d-flex">
                                        <p class="app-review-module__rating-group-avg mr-2">5.0</p>
                                        <div class="star-module d-flex flex-row justify-content-center">

                                        <div class="list-stars">
                                            <?php for ($i=1; $i < 6; $i++) { 
                                                if($i <= $v['stars']){
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg">';
                                                }else{
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg">';
                                                }
                                            } ?>
                                        </div>

                                    </div>
                                    </div>

                                </div>

                            </div>
                            <div class="app-review-module__group mb-2">
                                <div class="app-review-module__rating">
                                    <p class="app-review-module__rating-title">Ease of use</p>
                                    <div class="app-review-module__rating-group d-flex">
                                        <p class="app-review-module__rating-group-avg mr-2">5.0</p>
                                         <div class="star-module d-flex flex-row justify-content-center">

                                        <div class="list-stars">
                                            <?php for ($i=1; $i < 6; $i++) { 
                                                if($i <= $v['stars']){
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg">';
                                                }else{
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg">';
                                                }
                                            } ?>
                                        </div>

                                    </div>
                                    </div>

                                </div>

                            </div>
                            <div class="app-review-module__group mb-2">
                                <div class="app-review-module__rating">
                                    <p class="app-review-module__rating-title">Ease of use</p>
                                    <div class="app-review-module__rating-group d-flex">
                                        <p class="app-review-module__rating-group-avg mr-2">5.0</p>
                                         <div class="star-module d-flex flex-row justify-content-center">

                                        <div class="list-stars">
                                            <?php for ($i=1; $i < 6; $i++) { 
                                                if($i <= $v['stars']){
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-red.svg">';
                                                }else{
                                                    echo '<img src="'.IMAGES.'/icons/star-type-1-grey.svg">';
                                                }
                                            } ?>
                                        </div>

                                    </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>


                </div>
                
                <div class="app-review-module__btn d-flex flex-row justify-content-end">

                    <a href="#" class="btn-download">View Reviews</a>

                </div>

            </div>
         <!-- END APP -->  

        </div>
        <!-- END APP ROW -->




        

    </div>

</section>


<?php the_content() ?>

<?php get_footer(); ?>
