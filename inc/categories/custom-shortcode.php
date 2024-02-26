<?php

function get_categ() {
    $categories = get_terms( array(
        'taxonomy' => 'categories-category',
        'hide_empty' => true,
    ) );

    return $categories;
}

function shortcode_categories_list () {

    $categories = get_categ();

    ob_start(); ?>
    
    <div class="widget-categories-container">

        <div class="dropdown show">

            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <?php if ( wp_is_mobile() ) :?>

                    Channels

                <?php else: ?>
                    
                    Doctorpedia Channels

                <?php endif;?>

            </a>

            <div class="dropdown-menu widget-categories-menu" aria-labelledby="dropdownMenuLink">

                <div class="container">

                    <div class="widget-categories-menu__header">
    
                        <h2>
                            <?php if ( wp_is_mobile() ) :?>
                            
                                All Channels
                            
                                <?php else: ?>
                            
                                Explore All Channels
                            <?php endif;?>

                        </h2>
    
                        <a href="<?php echo esc_url( home_url( '/channels' ) ); ?>">View All</a>
                        
                    </div>
    
                    <div class="widget-categories-menu__body">
    
                        <?php foreach( get_categories( array( 'taxonomy' => 'categories-category' ) ) as $category ): ?>
        
                            <?php if ( $category->category_parent == 0 ) : ?>
    
                                <div>
    
                                    <a class="dropdown-item" href="<?php echo get_tag_link( $category->term_id ); ?>">
            
                                        <?php echo $category->name; ?>
            
                                    </a>
    
                                </div>
        
                            <?php endif; ?>
        
                        <?php endforeach; ?>
    
                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php return ob_get_clean();
}

add_shortcode('Custom-Category-List','shortcode_categories_list');