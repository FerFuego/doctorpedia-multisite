<?php
$title = get_sub_field('title');
// Get Taxonomies for slider
$args_1 = array(
    'taxonomy'      => array('categories-category'), // taxonomy name
    'orderby'       => 'id',
    'order'         => 'RAND',
    'hide_empty'    => true,
    'fields'        => 'all',
    'parent'        => 0,
    'number'        => 9, // limit to 9 categories
    'meta_key'      => 'type',
    'meta_value'    => 'specialty-area'
);
// Get Taxonomies for dropdown
$args_2 = array(
    'taxonomy'      => array('categories-category'), // taxonomy name
    'orderby'       => 'id',
    'order'         => 'ASC',
    'hide_empty'    => true,
    'fields'        => 'all',
    'parent'        => 0,
    'meta_key'      => 'type',
    'meta_value'    => 'specialty-area'
);
?>

<section class="m-explore js-explore-module">

    <div class="container-big">

        <div class="m-explore__heading">

            <?php if ($title) : ?>
                <h3 class="m-explore__title"><?= esc_html($title); ?></h3>
            <?php endif; ?>

            <div class="m-explore__search js-search-wrapper">
                <input class="m-explore__search-input js-explore-search" type="text" placeholder="<?php _e('All Specialty Areas', 'Doctorpedia'); ?>" style="cursor: pointer;" readonly>
                <button class="m-explore__search-btn js-explore-open-close-dropdown">
                    <img src="<?php echo IMAGES . '/down-arrow.svg'; ?>" alt>
                </button>
                <ul class="m-explore__search-results js-explore-results">
                    <?php 
                        $terms = get_terms($args_2);
                        foreach ( $terms as $term ) : 
                            $title = $term->name;
                            $link = get_term_link($term->term_id, 'categories-category'); 
                    ?>
                        <li><a href="<?php echo $link; ?>"><?php echo $title; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

        <div class="m-explore__cards js-explore-slider">

            <?php
            $index = 0;
            $terms = get_terms($args_1);
            foreach ( $terms as $term ) :
                $title = $term->name;
                $description = $term->description;
                $link = get_term_link($term->term_id, 'categories-category');

                switch ($index) {
                    case 0:
                        $color = 'green';
                        $index++;
                        break;
                    case 1:
                        $color = 'blue';
                        $index++;
                        break;
                    case 2:
                        $color = 'red';
                        $index++;
                        break;
                    case 3:
                        $color = 'yellow';
                        $index++;
                        break;
                    case 4:
                        $color = 'dark-green';
                        $index++;
                        break;
                    case 5:
                        $color = 'purple';
                        $index++;
                        break;
                    case 6:
                        $color = 'white';
                        $index = 0;
                        break;
                }
            ?>

                <article class="m-explore__card m-explore__card--<?= esc_attr($color); ?>">
                    <a href="<?= esc_url($link); ?>" class="m-explore__card-wrapper">
                        <h4 class="m-explore__card-title"><?= esc_html($title); ?></h4>
                        <p class="m-explore__card-description" style="-webkit-box-orient: vertical;"><?= $description; ?></p>
                        <span class="m-explore__card-cta"><?php _e('Explore', 'Doctorpedia'); ?></span>
                    </a>
                </article>

            <?php endforeach; ?>
        </div>

    </div>

</section>