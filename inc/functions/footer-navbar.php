<?php

global $wp;

$currentRequest = $wp->request;

if(strpos($currentRequest, 'video_play') !== false
|| strpos($currentRequest, 'faqs') !== false
|| strpos($currentRequest, 'blog') !== false):

?>
    <div class="footer-navbar">
        <div class="container">
            <div class="box-container">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer',
                    ) );
                ?>
            </div>
        </div>
    </div>

<?php endif;