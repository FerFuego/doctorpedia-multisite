<?php

function shortcode_get_sites () {

    ob_start(); ?>
    
    <div class="container">

        <ul>

        <?php foreach ( get_sites( ['number' => 5000] ) as $site ) : 
            
            $url = str_replace('http://', '', $site->domain);
            $url = str_replace('https://', '', $url); 
            ?>

            <li><?php echo $site->blog_id . ' - ' . $site->blogname . ' - <a href="http://' . $url . '" target="_blank">' . $site->domain . '</a>' ; ?></li>
    
        <?php endforeach; ?>

        </ul>    

    </div>

    <?php return ob_get_clean();
}

add_shortcode('Custom-Sites-List','shortcode_get_sites');