<?php 
$condition_title = get_field('condition_title', $item);
$menus = get_field('navbar_websites', $item);
?>
<!-- Big Menu Conditions -->
<div class="big-menu-conditions w-100" id="js-dropdown-conditions-menu">
    <span class="big-menu-conditions__arrow-up"></span>
    <div class="big-menu-conditions__cross">
        <span></span>
        <span></span>
    </div>
    <div class="container">
        <div class="big-menu-conditions__header">
            <h2><?php echo $condition_title; ?></h2>
        </div>
        <div class="big-menu-conditions__body">
            <div class="big-menu-conditions__body__content">
                <?php if ( wp_is_mobile() ) : ?>
                    <!-- Mobile -->
                    <?php if ( $menus ) : ?>
                        <ul>
                            <?php foreach ( $menus as $menu ) : ?>
                                <?php $site = $menu['site']; ?>
                                <li><a href="<?php echo normalize_link( get_field('blog_url', $site->ID) ); ?>" class="js-site-link"><?php echo $site->post_title; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                <?php else : ?>
                    <!-- Desktop -->

                    <?php if ( $menus ) : ?>

                        <img src="<?php echo IMAGES . '/icons/stroke-prev.svg'; ?>" class="prev prev_bigmenu">

                        <div class="slider-container slick_bigmenu slider_bigmenu" id="slider_bigmenu">
                            <?php foreach ( $menus as $menu ) :
                                set_query_var('site', $menu['site']);
                                get_template_part('partials/site-card-navbar');
                            endforeach; ?>
                        </div>

                        <img src="<?php echo IMAGES . '/icons/stroke-next.svg'; ?>" class="next next_bigmenu">

                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>