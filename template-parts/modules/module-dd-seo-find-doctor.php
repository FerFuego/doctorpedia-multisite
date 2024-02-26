<?php $section_title = get_sub_field('title'); ?>

<div class="seo-find-doctors">
    <div class="seo-find-doctors__container">

        <?php if ( $section_title ) : ?>
            <div class="seo-find-doctors__header">
                <h2 class="seo-find-doctors__title"><?php echo $section_title; ?></h2>
            </div>
        <?php endif; ?>

        <div class="tabs">
            <div class="tabs__container">
                <div class="tabs__list" id="tab-button">
                <?php if ( have_rows( 'tab' ) ) : 
                    while ( have_rows('tab' ) ) : the_row(); ?>

                        <li class="tab-item">
                            <a class="tab-item__link" href="#<?php echo sanitize_title( get_sub_field('title') ); ?>"><?php echo get_sub_field('title'); ?></a>
                        </li>

                        <?php endwhile;
                    endif; ?>
                </div>
            </div>

            <?php if ( have_rows( 'tab' ) ) : 
                while ( have_rows('tab' ) ) : the_row(); ?>

                    <div id="<?php echo sanitize_title( get_sub_field('title') ); ?>" class="tab-content">
                        <?php if ( have_rows( 'doctors_links' ) ) : 
                            while ( have_rows('doctors_links' ) ) : the_row(); ?>

                                <a class="tab-content__link" 
                                    href="<?php echo get_sub_field('link')['url']; ?>" 
                                    target="<?php echo get_sub_field('link')['target']; ?>">
                                        <?php echo get_sub_field('link')['title']; ?>
                                </a>

                        <?php endwhile;
                        endif; ?>
                    </div>

            <?php endwhile;
            endif; ?>
        </div>

    </div>
</div>