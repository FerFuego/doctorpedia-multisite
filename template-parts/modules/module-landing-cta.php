<?php
    $title = get_sub_field('title');
    $copy = get_sub_field('copy');
    $button = get_sub_field('button');
?>

<section class="m-landing-cta">

    <span class="m-landing-cta__circle">

        <span class="m-landing-cta__circle m-landing-cta__circle--small"></span>

        <span class="m-landing-cta__circle m-landing-cta__circle--small"></span>

    </span>

    <div class="m-landing-cta__container container">

        <img class="m-landing-cta__icon" src="<?php echo IMAGES . '/landing/icon-doctorpedia.png'; ?>" alt="Call To Action Icon">

        <?php if($title): ?>

            <h2 class="m-landing-cta__title"><?php echo $title ?></h2>

        <?php endif; ?>

        <?php if($copy): ?>

            <p class="m-landing-cta__copy"><?php echo $copy ?></p>

        <?php endif; ?>

        <?php if($button): ?>

            <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>" class="btn-rounded js-pre-register-modal"><?php echo $button['title']; ?> <img src="<?php echo get_template_directory_uri(); ?>/img/modules/webcast/single-right-arrow-white.svg" alt></a>

        <?php endif; ?>

    </div>

</section>