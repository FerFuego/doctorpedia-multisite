<!-- Specialty Areas -->
<?php 
$condition_title = get_field('condition_title', $item);
$menus = get_field('navbar_specialty_areas', $item);
?>
<div class="big-menu-channels w-40" id="js-dropdown-specialty-areas">
    <span class="big-menu-conditions__arrow-up"></span>
    <div class="container">
        <div class="big-menu-channels__header">
            <h2><?php echo $condition_title; ?></h2>
        </div>
        <div class="big-menu-channels__body">
            <div class="big-menu-channels__body__content">
                <?php if ( $menus ) : ?>
                <ul>
                    <?php foreach ( $menus as $m ) :
                        $term = $m['areas'];
                        $title = $term->name;
                        $link = get_term_link($term->term_id, 'categories-category');
                        ?>
                        <li id="menu-item-<?php echo $term->term_id; ?>" class="menu-item menu-item-type-taxonomy menu-item-object-categories-category current-menu-item menu-item-<?php echo $term->term_id; ?>">
                            <a class="js-site-link" href="<?php echo $link; ?>" aria-current="page"><?php echo $title; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>