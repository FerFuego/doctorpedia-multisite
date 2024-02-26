<div class="footbar ocultar">

    <div class="footbar__slideup">

        <a href="<?php echo esc_url( home_url( 'doctor-platform/my-articles/' ) ); ?>" class="footbar__slideup-item">Article</a>

        <a href="<?php echo esc_url( home_url( 'doctor-platform/my-blogs/' ) ); ?>" class="footbar__slideup-item">Blog</a>

        <a href="<?php echo esc_url( home_url( 'doctor-platform/app-reviews/' ) ); ?>" class="footbar__slideup-item">Review</a>

        <a href="<?php echo esc_url( home_url( 'doctor-platform/videos/' ) ); ?>" class="footbar__slideup-item">Video</a>

    </div>

    <div class="footbar__container">

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footbar__item"><img src="<?php echo get_template_directory_uri(); ?>/img/public-profile/home_icon.svg" alt="home"></a>

        <a href="javascript:;" onclick="footbarToggle();" class="footbar__item footbar__cta"><img src="<?php echo get_template_directory_uri(); ?>/img/public-profile/add_post_btn.svg" alt="home"></a>

        <a href="<?php echo get_user_blog_data()['link']; ?>" class="footbar__item"><img src="<?php echo get_template_directory_uri(); ?>/img/public-profile/profile_icon.svg" alt="home"></a>

    </div>
    
</div>