<?php
$faq_title = get_sub_field('title_faq');
$faq_description = get_sub_field('description');
?>

<?php //if ( $faq_title && $faq_description ) : ?>

    <div class="faq-card js-faqs__faq faq-card--bg-opaque">
        <div class="faq-card__title-container">

            <h3 class="faq-card__title"><?php echo $faq_title; ?></h3>

            <div class="faq-card__icon">
                <img class="faq-card__img" src="<?php echo IMAGES . '/crowdfunding/down-arrow.svg'; ?>" alt="crowdfunding">
            </div>

        </div>

        <div class="faq-card__description faq-card__description--line-height js-faqs__faq-description" style="display: none;">
            <?php echo $faq_description; ?>
        </div>
    </div>

<?php //endif; ?>