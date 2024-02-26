<?php

/**
 * ACF's
 */
$title = get_sub_field('title');
$copy = get_sub_field('copy');
$channels = get_sub_field('interest_channels');
$allChannels = get_sub_field('all_channels_page');

/**
 * Admin taxonomy acf fliter located  inc/functions/custom-taxonomy-acf.php
 */
?>

<section class="m-interest-channels">

    <div class="container-big">

        <div class="m-interest-channels__container">

            <?php if ($title) : ?>
                <h3 class="m-interest-channels__title"><?= esc_html($title); ?></h3>
            <?php endif; ?>

            <?php if ($copy) : ?>
                <p class="m-interest-channels__copy"><?= esc_html($copy); ?></p>
            <?php endif; ?>

            <div class="m-interest-channels__channels">

                <article class="m-interest-channels__popular">
                    <?php
                    $popularId = $channels[0];
                    $titlePopular =  get_term($popularId)->name;
                    $linkPopular = get_term_link($popularId);
                    $img = get_field('featured_image', 'categories-category_' . $popularId);
                    ?>

                    <span class="m-interest-channels__popular-highlight">
                        <img src="<?php echo IMAGES . '/star.svg'; ?>" alt="star">
                        <?php _e('POPULAR CHANNEL', 'Doctorpedia'); ?>
                    </span>

                    <img class="m-interest-channels__popular-img" src="<?= esc_url($img['sizes']['large']) ?>" alt="<?= esc_attr($img['alt']) ?>">

                    <h4 class="m-interest-channels__popular-title"><?= esc_html($titlePopular); ?></h4>

                    <a class="m-interest-channels__popular-cta" href="<?= esc_url($linkPopular); ?>"><?php _e('Explore', 'Doctorpedia'); ?></a>

                </article>

                <aside class="m-interest-channels__aside">

                    <h5 class="m-interest-channels__aside-title"><?php _e('All Channels', 'Doctorpedia') ?></h5>

                    <div class="m-interest-channels__aside-list">

                        <?php foreach ($channels as $key => $channel) :
                            $titleChannel =  get_term($channel)->name;
                            $linkChannel = get_term_link($channel);
                            $img = get_field('featured_image', 'categories-category_' . $channel);
                        ?>
                            <article class="m-interest-channels__channel">
                                <a href="<?= esc_url($linkChannel); ?>">
                                    <img class="m-interest-channels__channel-img" src="<?= esc_url($img['sizes']['medium']) ?>" alt="<?= esc_attr($img['alt']) ?>">
                                    <h5 class="m-interest-channels__channel-title"><?= esc_html($titleChannel); ?></h5>
                                    <img class="m-interest-channels__channel-cta" src="<?php echo IMAGES . '/right-grey.png'; ?>" alt="">
                                </a>
                            </article>
                        <?php endforeach; ?>

                        <?php if ($allChannels) : ?>
                            <a class="m-interest-channels__all-channels" href="<?= esc_url($allChannels['url']); ?>" target="<?= esc_attr($allChannels['target']) ?>">
                                <?= esc_html($allChannels['title']); ?>
                                <img src="<?php echo IMAGES . '/right-pink-arrow.png'; ?>" alt>
                            </a>
                        <?php endif; ?>
                    </div>
                </aside>

            </div>

        </div>

    </div>

</section>