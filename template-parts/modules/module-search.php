<?php
//ACF's
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$videos = get_sub_field('videos');
$searchPostTypes = get_sub_field('search_by');

$postTypesToSearch = '';
foreach ($searchPostTypes as $key => $postType) {
    $postTypesToSearch .= count($searchPostTypes) - 1 != $key ? "$postType, " : $postType;
}
?>

<section class="m-search">

    <div class="m-search__container container-big">

        <h1 class="m-search__title"><?php echo $title; ?></h1>

        <h2 class="m-search__subtitle" id="js-form-discover-health-label"><?php echo esc_html($subtitle); ?></h2>

        <div id="js-sr-form-discover-health" class="m-search__search-box" post-types="<?= esc_attr($postTypesToSearch); ?>">

            <input class="m-search__search-box-input done" type="text" minlength="3" size="20" id="js-search-condition" name="condition" placeholder="<?php _e('Search Doctorpedia', 'Doctorpedia'); ?>" required />

            <div id="js-form-discover-health-checkbox">

                <div class="form-discover-health-checkbox">

                    <label for="all" class="incluir">
                        <input type="checkbox" name="selection[]" id="all" value="All" id="js-all-checkbox" checked>
                        <span></span>
                        <b>All</b>
                    </label>

                    <label for="videos" class="incluir">
                        <input type="checkbox" name="selection[]" id="videos" value="Videos">
                        <span></span>
                        <b>Videos</b>
                    </label>

                    <label for="app" class="incluir">
                        <input type="checkbox" name="selection[]" id="app" value="App">
                        <span></span>
                        <b>Apps</b>
                    </label>

                </div>

            </div>

            <button class="m-search__search-box-submit" id="js-discover-health">
                <?php _e('Search', 'Doctorpedia'); ?>
                <img src="<?php echo IMAGES . '/icons/next-pink.svg'; ?>" alt>
                <div class="lds-roller">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </button>

        </div>

    </div>

    <div class="m-search__videos js-search-video-gallery js-staggered">

        <?php
        $index = 0;
        $size = '';
        foreach ($videos as $key => $video) :
            $url = get_field('url_vimeo', $video);
            $img = get_the_post_thumbnail_url($video, 'large');
            $authorId = get_post_field('post_author', $video);
            $authorName = get_the_author_meta('display_name', $authorId);
            $authorAvatar = get_avatar_url($authorId, '32');

            switch ($index) {
                case 0:
                    $size = 'small';
                    $index++;
                    break;
                case 1:
                    $size = 'medium';
                    $index++;
                    break;
                case 2:
                    $size = 'big';
                    $index++;
                    break;
                case 3:
                    $size = 'medium';
                    $index = 0;
                    break;
            }
        ?>
            <article class="m-search__video js-video-slide js-staggered-item" url="<?= esc_attr($url); ?>" slide="<?= esc_attr($key); ?>">

                <div class="m-search__video-wrapper m-search__video-wrapper--<?= esc_attr($size); ?>">

                    <img src="<?= $img; ?>" alt>

                    <div class="video-info">

                        <div class="video-info__author">
                            <img class="video-info__author-avatar" src="<?= esc_url($authorAvatar); ?>" alt>
                            <h5 class="video-info__author-name"><?= esc_html($authorName); ?></h5>
                        </div>

                        <h6 class="video-info__title"><?= get_the_title($video); ?></h4>

                    </div>
                </div>

            </article>
        <?php endforeach; ?>

    </div>

    <div class="m-search__video-modal js-video-modal">
        <div class="m-search__video-modal__container js-container">
            <button class="m-search__video-modal-close js-close-modal"></button>
            <button class="m-search__video-modal-arrow js-prev-video"></button>
            <button class="m-search__video-modal-arrow m-search__video-modal-arrow--next js-next-video"></button>
            <div class="video-info"></div>
        </div>
        <div class="m-search__video-modal-loader js-loader">
            <div class="lds-roller">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

    <div class="m-search__results d-none" id="js-discover-search-resources">
        <div class="m-search__results-container container-big">

            <div class="m-search__results-wrapper">

                <div class="m-search__results-header">

                    <h3 id="js-var-to-search"></h3>

                    <span class="m-search__results-close js-close-dropdown"></span>

                </div>

                <div class="m-search__results-section" id="featured-apps">

                    <div class="slider-container d-none">

                        <h4>Featured Apps ( <span id="js-count-featured-app"></span> )</h4>

                        <div id="js-featured-app" class="m-search__results-posts"></div>

                    </div>

                </div>

                <div class="m-search__results-section m-search__results-section--videos" id="videos">

                    <div class="slider-container d-none">

                        <h4>Videos (<span id="js-count-videos"></span>)</h4>

                        <div id="js-videos" class="m-search__results-posts"></div>

                        <button class="m-search__results-loadmore btn js-load-more-posts" post_type="videos">
                            <?php _e('Show More', 'doctorpedia'); ?>
                        </button>
                    </div>

                </div>

                <div class="m-search__results-section" id="articles">

                    <div class="slider-container d-none">

                        <h4>Articles (<span id="js-count-articles"></span>)</h4>

                        <div id="js-articles" class="m-search__results-posts"></div>

                        <button class="m-search__results-loadmore btn js-load-more-posts" post_type="post">
                            <?php _e('Show More', 'doctorpedia'); ?>
                        </button>
                    </div>

                </div>

                <div class="m-search__results-section" id="channels">

                    <div class="slider-container d-none">

                        <h4>Channel Articles (<span id="js-count-channels"></span>)</h4>

                        <div id="js-channels" class="m-search__results-posts" page="0"></div>

                        <button class="m-search__results-loadmore btn js-load-more-posts" post_type="categories">
                            <?php _e('Show More', 'doctorpedia'); ?>
                        </button>
                    </div>

                </div>

                <div class="m-search__results-section" id="apps">

                    <div class="slider-container d-none">

                        <h4>Mobile Apps (<span id="js-count-app"></span>)</h4>

                        <div id="js-app-reviews" class="m-search__results-posts"></div>

                    </div>

                </div>

                <div class="m-search__results-section">

                    <div class="slider-container d-none">

                        <h4>Other (<span id="js-count-reviews"></span>)</h4>

                        <div id="js-reviews" class="m-search__results-posts"></div>

                    </div>

                </div>

                <div class="m-search__results-section" style="position: relative">

                    <div class="slider-container container d-none">

                        <h4>Other (<span id="js-count-resources"></span>)</h4>

                        <div id="js-resources-header" class="app-review-article slider-app-review d-resources-header d-flex flex-row"></div>

                        <div id="js-resources-body" class="app-review-article slider-app-review d-flex flex-row flex-wrap <?php if (wp_is_mobile()) {
                                                                                                                                echo 'justify-content-center';
                                                                                                                            } ?>"></div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</section>