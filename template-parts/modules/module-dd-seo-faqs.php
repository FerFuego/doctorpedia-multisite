<?php $section_title = get_sub_field('title');  ?>

<div class="cf-faqs cf-faqs--margin">
    <div class="cf-faqs__container">

        <?php if ( $section_title ) : ?>
            <div class="cf-faqs__header">
                <h2 class="cf-faqs__title"><?php echo $section_title; ?></h2>
            </div>
        <?php endif; ?>

        <div class="cf-faqs__body">
            <div class="cf-faqs__wrapper js-faqs__faq-wrapper" id="post_faqs">
                <?php if ( have_rows( 'faqs' ) ) : 
                    while ( have_rows('faqs' ) ) : the_row();
                        get_template_part( 'partials/faq-card' );
                    endwhile;
                endif; ?>                
            </div>
        </div>

    </div>
</div>