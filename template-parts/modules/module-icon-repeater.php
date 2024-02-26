<section class="m-icon-repeater">

    <div class="m-icon-repeater__container custom-container">

        <?php if ( have_rows( 'm-icon-repeater__icons' ) ) :

            while ( have_rows('m-icon-repeater__icons') ) : the_row();
                //ACF 
                $icon = get_sub_field('m-icon-repeater__icon');
                $title = get_sub_field('m-icon-repeater__title');
                $copy = get_sub_field('m-icon-repeater__copy');?>

                <div class="m-icon-repeater__icon-container">

                    <?php if($icon): ?>

                        <img class="m-icon-repeater__icon" src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">

                    <?php endif; ?>

                    <?php if($title): ?>

                        <h3 class="m-icon-repeater__title"><?php echo $title; ?></h3>

                    <?php endif; ?>

                    <?php if($copy): ?>

                        <p class="m-icon-repeater__copy"><?php echo $copy; ?></p>

                    <?php endif; ?>

                </div>

            <?php endwhile;

        endif; ?>

    </div>


</section>