<div class="experts">

    <div class="container" id="js-doctorDirectory">

        <?php
        // Pagination vars
        $x=0;
        $current_page = get_query_var('paged') ? (int) get_query_var('paged') : 1;
        $users_per_page = 20;
        $offset = ( $current_page * $users_per_page ) - $users_per_page;

        //--------------------------------------
        // Highlight Doctors - Doctor Directory
        //--------------------------------------

        /* for ($i = 0; $i < @count($highLightDoctors) && $highLightDoctors; $i++): $x++;
            $expert = $highLightDoctors[$i]['m-highlight-doctors__doctor'];
            set_query_var( 'x', $x );
            set_query_var( 'user', $expert );
            get_template_part( 'partials/expert-card' ); 
        endfor; */

        //----------------------------
        // Doctors - Doctor Directory
        // NOTE: user_order isnt a ACF is a table field
        //----------------------------
        global $wpdb;

        $experts = $wpdb->get_results("SELECT DISTINCT SQL_CALC_FOUND_ROWS $wpdb->users.ID, $wpdb->users.user_nicename
                    FROM $wpdb->users 
                    LEFT JOIN $wpdb->usermeta ON ( $wpdb->users.ID = $wpdb->usermeta.user_id )   
                    LEFT JOIN $wpdb->usermeta AS mt2 ON ( $wpdb->users.ID = mt2.user_id ) 
                    WHERE 1=1 
                    AND (($wpdb->usermeta.meta_key = 'hide_dd' AND $wpdb->usermeta.meta_value NOT LIKE '%check%' ) OR $wpdb->usermeta.user_id IS NULL) 
                    AND (mt2.meta_key = '{$wpdb->prefix}capabilities' AND mt2.meta_value LIKE '%\"blogger\"%' )
                    ORDER BY user_order ASC 
                    LIMIT $offset, $users_per_page", OBJECT );

        if (!empty($experts) ) :
            $total_users = $wpdb->get_var( "SELECT FOUND_ROWS();" );
            $num_pages = ceil($total_users / $users_per_page);

            //--------------------
            // Doctors Cards
            //--------------------
            foreach ($experts as $expert) : $x++;
                set_query_var( 'user', $expert );
                set_query_var( 'x', $x );
                get_template_part( 'partials/expert-card' );
            endforeach;

        else : ?>
            <h2 class="mb-5 pb-5">No experts found</h2>
        <?php endif; ?> 

    </div>

    <!---------------------
    // Paginator
    //-------------------->
    <div id="js-doctorDirectoryPaginator">
        <div class="paginator">
            <?php
                // Previous page
                if ( $current_page > 1 ) {
                    $prev_page = $current_page - 1;
                    echo '<a href="?paged='.$prev_page.'" class="page-numbers"> < </a>';
                }  

                $edge_number_count = 2;            
                $start_number = $current_page - $edge_number_count;
                $end_number = $current_page + $edge_number_count;

                if ( ($start_number - 1) < 1 ) {
                    $start_number = 1;
                    $end_number = min($num_pages, $start_number + ($edge_number_count*2));
                }
                
                if ( ($end_number + 1) > $num_pages ) {
                    $end_number = $num_pages;
                    $start_number = max(1, $num_pages - ($edge_number_count*2));
                }
                
                if ($start_number > 1) echo '<a href="?paged=1" class="page-numbers">1</a> ... ';
                
                for($i=$start_number; $i<=$end_number; $i++) {
                    if ( $i == $current_page ) echo "<span class='page-numbers current'>$i</span>";
                    else echo '<a href="?paged='.$i.'" class="page-numbers">'. $i .'</a>';
                }
                
                if ($end_number < $num_pages) echo ' ... <a href="?paged='.$num_pages.'" class="page-numbers">'. $num_pages .'</a> '; 

                // Next page
                if ( $current_page < $num_pages ) {
                    $next_page = $current_page + 1;
                    echo '<a href="?paged='.$next_page.'" class="page-numbers"> > </a>';
                }
            ?>
        </div>
    </div>

</div>