<?php
//ACF's
$title = get_sub_field('title');
$copy = get_sub_field('copy');
$button = get_sub_field('button');
$image = get_sub_field('image');
?>

<section class="m-profile-promotion">
    <div class="container-big">
        <div class="m-profile-promotion__container">
            <div class="m-profile-promotion__info">
                <?php if ($title) : ?>
                    <h3 class="m-profile-promotion__title"><?= esc_html($title); ?></h3>
                <?php endif; ?>
                <?php if ($copy) : ?>
                    <div class="m-profile-promotion__copy"><?= $copy; ?></div>
                <?php endif; ?>
                <?php if ($button) : ?>
                    <a class="m-profile-promotion__button" href="<?= esc_url($button['url']); ?>" <?= $button['target'] ? "target='{$button['target']}'" : ''; ?>>
                        <?= esc_html($button['title']); ?>
                        <?= get_svg('/img/arrow-purple.svg') ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="m-profile-promotion__media">
                <img class="m-profile-promotion__logo" src="<?php echo IMAGES . '/Logo.svg'; ?>" alt>
                <img class="m-profile-promotion__image" src="<?= esc_url($image['sizes']['large']); ?>" alt>
                <img class="m-profile-promotion__stats" src="<?php echo IMAGES . '/Stats.png'; ?>" alt>
            </div>
        </div>
    </div>
</section>