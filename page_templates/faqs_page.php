<?php /* Template Name: FAQs */?>

<?php get_header('secondary'); ?>

<!-- FAQ's Layout -->
<div class="faqs-page">
    <!-- Secondary Header Module -->
    <div class="secondary-header">
        <div class="container">
            <img src="<?php echo ( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) ? get_the_post_thumbnail_url(get_the_ID(), 'full') : IMAGES .'/hand-illustration.svg'; ?>" alt="">
            <div class="page-title">
                <h1> <?php echo (get_the_title() ? get_the_title() : 'FAQs') ?></h1>
            </div>
        </div>
    </div>
    <!-- Secondary Header Module -->
<div class="large-container">
    <div class="body">
        <div class="container">

            <div class="faqs-navbar">
                <ul>
                    <li id="all" class="active">All</li>
                <?php
                    $loop = new WP_Query( array(
                        'post_type' => 'faqs_type',
                        'nopaging' => true
                    ));
                    $array = array();
                    while ( $loop -> have_posts()) : $loop->the_post();	
                        $tags = get_the_tags();
                        if ( $tags ) {
                            foreach( $tags as $tag ) {
                                $array[] = $tag->name;
                            }
                        }
                    endwhile;
                    $z=0;
                    foreach( array_unique($array) as $row){
                        printf( '<li id="tag_'.$z.'">'.$row.'</li>');
                        $z++;
                    }
                ?> 
                </ul>
            </div>

            <div class="tab-group">
            <?php 
                $loop = new WP_Query( array(
                    'post_type' => 'faqs_type',
                    'nopaging' => true
                ));
                $array = array();
                while ( $loop -> have_posts()) : $loop->the_post();	
                    $tags = get_the_tags();
                    if ( $tags ) {
                        foreach( $tags as $tag ) {
                            $array[] = $tag->slug;
                        }
                    }
                endwhile;
                $z=0;
                if($array){
                    foreach( array_unique($array) as $slug){ ?>
                        <div id="tag_<?php print $z ?>">
                            <!-- Question -->
                            <?php
                                $loop = new WP_Query( array(
                                    'post_type' => 'faqs_type',
                                    'tag' => $slug,
                                    'nopaging' => true
                                ));
                                while ( $loop -> have_posts()) : $loop->the_post();	 ?>
                                    <div class="question row">
                                        <div class="col-lg-4 col-md-12">
                                            <h2><?php the_title() ?></h2>
                                        </div>
                                        <div class="col-lg-8 col-md-12 answers">
                                            <p><?php the_content() ?>  </p>
                                        </div>
                                    </div>
                            <?php endwhile;?>
                            <!-- End Question -->
                        </div>
                    <?php $z++;
                    }
                }else{ ?>
                    <!-- If not have tags -->
                    <div id="tag_0">
                        <!-- Question -->
                        <?php
                            $loop = new WP_Query( array(
                                'post_type' => 'faqs_type',
                                'nopaging' => true
                            ));
                            while ( $loop -> have_posts()) : $loop->the_post();	 ?>
                                <div class="question row">
                                    <div class="col-lg-4 col-md-12">
                                        <h2><?php the_title() ?></h2>
                                    </div>
                                    <div class="col-lg-8 col-md-12 answers">
                                        <p><?php the_content() ?>  </p>
                                    </div>
                                </div>
                        <?php endwhile;?>
                        <!-- End Question -->
                    </div>
            <?php  } ?>
            </div>
        </div>
    </div>
</div>
<!-- FAQ's Layout -->

<?php the_post();?>

<?php the_content() ?>

<?php include(TEMPLATEPATH .'/partials/recomended-articles.php') ?>

<?php get_footer(); ?>
