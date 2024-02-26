<div class="author-repost-profile">

    <?php if ( get_user_logged_and_blogger() ) : ?>

        <a href="#" onclick="repostModal(<?php the_ID(); ?>)" class="author-repost-link">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.6523 13.6172C15.4368 13.6172 14.3567 14.2079 13.6837 15.1172L7.88944 12.156C7.98664 11.8258 8.03906 11.4765 8.03906 11.1152C8.03906 10.6259 7.94313 10.1586 7.76943 9.73083L13.8422 6.08217C14.5198 6.87746 15.5281 7.38281 16.6523 7.38281C18.6878 7.38281 20.3438 5.72685 20.3438 3.69141C20.3438 1.65596 18.6878 0 16.6523 0C14.6169 0 12.9609 1.65596 12.9609 3.69141C12.9609 4.16186 13.0496 4.61192 13.2107 5.02605L7.12277 8.68383C6.44569 7.912 5.45266 7.42383 4.34766 7.42383C2.31221 7.42383 0.65625 9.07979 0.65625 11.1152C0.65625 13.1507 2.31221 14.8066 4.34766 14.8066C5.58313 14.8066 6.67866 14.1965 7.34906 13.2617L13.1265 16.2143C13.0189 16.5602 12.9609 16.9277 12.9609 17.3086C12.9609 19.344 14.6169 21 16.6523 21C18.6878 21 20.3438 19.344 20.3438 17.3086C20.3438 15.2732 18.6878 13.6172 16.6523 13.6172ZM16.6523 1.23047C18.0093 1.23047 19.1133 2.33445 19.1133 3.69141C19.1133 5.04837 18.0093 6.15234 16.6523 6.15234C15.2954 6.15234 14.1914 5.04837 14.1914 3.69141C14.1914 2.33445 15.2954 1.23047 16.6523 1.23047ZM4.34766 13.5762C2.9907 13.5762 1.88672 12.4722 1.88672 11.1152C1.88672 9.75827 2.9907 8.6543 4.34766 8.6543C5.70462 8.6543 6.80859 9.75827 6.80859 11.1152C6.80859 12.4722 5.70462 13.5762 4.34766 13.5762ZM16.6523 19.7695C15.2954 19.7695 14.1914 18.6656 14.1914 17.3086C14.1914 15.9516 15.2954 14.8477 16.6523 14.8477C18.0093 14.8477 19.1133 15.9516 19.1133 17.3086C19.1133 18.6656 18.0093 19.7695 16.6523 19.7695Z"/>
            </svg> 
            <span>Share</span>
        </a>

        <div id="response_repost"></div>

    <?php endif; ?>

</div>