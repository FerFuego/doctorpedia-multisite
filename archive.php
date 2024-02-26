<?php get_header('2021'); ?>

<div class="simple-page archive-connatix">
    <div class="container mt-5 pt-5">
        <h2 class="page-title"><?php echo get_the_archive_title(); ?></h2>
    </div>
    <div class="blog-posts-page-container pt-0">
        <div class="background-white"></div>
        <div class="container position-relative">
            <div class="container-main">
                <div class="body">
                    <?php require_once(  __DIR__ . '/template-parts/archives/content-default.php' ); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>