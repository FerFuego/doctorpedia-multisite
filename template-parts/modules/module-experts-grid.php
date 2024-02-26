<div class="experts">
    <div class="container" id="js-doctorDirectory">
        <?php if ( have_rows( 'expert_grid' ) ) : 
            while ( have_rows('expert_grid' ) ) : the_row();
                $expert = get_sub_field('expert');
                set_query_var( 'user', $expert );
                get_template_part( 'partials/expert-card' );
            endwhile;
        endif; ?>
    </div>
    
    <div class="paginator"></div>
</div>