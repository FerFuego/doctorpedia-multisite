<?php
    $header = get_sub_field('title_section');
    $headerCta = get_sub_field('call_to_action');
    $channels_tabs = get_sub_field('channels_tabs');
?>
<section class="channels container" id="js-featuredChannelsModule">

    <div class="channels__header">
        <h2><?php echo $header; ?></h2>
        <?php if ( $headerCta ) : ?>
            <a href="<?php echo $headerCta['url']; ?>" target="<?php echo $headerCta['target']; ?>">
                <?php echo $headerCta['title']; ?>
                <img src="<?php echo get_template_directory_uri()?>/img/modules/channels/single-right-arrow-blue.svg" alt="">
            </a>
        <?php endif; ?>
    </div>

    <div class="channels__navbar">
        <?php if ( @count($channels_tabs) > 0 ) : 
                foreach ( $channels_tabs as $tab ) : ?>
                    <a href="javascript:;" onclick="changeTabPanel(this,'<?php echo strtolower(str_replace([' ','\''],['',''], $tab['title'])); ?>')"><?php echo $tab['title']; ?></a>
            <?php endforeach;
        endif; ?>
    </div>

    <div class="channels__body d-flex">

        <?php if ( @count($channels_tabs) > 0 ) : $y=0;
                foreach ( $channels_tabs as $tab ) : $x=0; 
                
                    $tab_channel = $tab['channels']; ?>

                    <div class="channels__body__tabpanel js-tabsPanels <?php echo ($y==0) ? 'active' : ''; ?>"  id="<?php echo strtolower(str_replace([' ','\''],['',''], $tab['title'])); ?>">

                        <?php if ( @count($tab_channel) > 0 ) :
                                foreach ( $tab_channel as $channel ) :
                                
                                    $channel = $channel['channel'];
                                    
                                    if ($x==0) : ?>

                                        <!-- Channel Big Card -->
                                        <div class="channel-card channel-card--big">
                                            <!-- Img Container -->
                                            <div class="channel-card__img-container channel-card__img-container--big lazy" style="background-image:url( <?php echo get_the_post_thumbnail_url( $channel->ID, 'full'); ?>)">
                                                <h5 class="channel-card__tag">Featured</h5>
                                                <img class="channel-card__star" src="<?php echo IMAGES; ?>/blogging/blogging-star.svg" alt="Star">
                                            </div>
                                            
                                            <!-- Content -->
                                            <div class="channel-card__content-container">
                                                <h2 class="channel-card__title"><?php echo $channel->post_title; ?></h2>
                                                <p class="channel-card__copy"><?php echo $channel->post_excerpt; ?></p>
                                                <a class="channel-card__link read-more" href="<?php echo get_post_permalink( $channel->ID ); ?>">Read More</a>
                                            </div>  
                                            
                                        </div>
                                        <!-- End Channel Big Card -->

                                        <div class="channels__right-column">

                                    <?php else : ?>
                                        
                                        <!-- Channel Card -->
                                        <div class="channel-card">
                                            
                                            <div class="channel-card__img-container lazy" style="background-image:url(<?php echo get_the_post_thumbnail_url( $channel->ID, 'large'); ?>)">
                                                <h5 class="channel-card__tag">Latest</h5>
                                            </div>

                                            <div class="channel-card__content-container">
                                                <h2 class="channel-card__title"><?php echo $channel->post_title; ?></h2>
                                                <a class="channel-card__link read-more" href="<?php echo get_post_permalink( $channel->ID ); ?>">Read More</a>
                                            </div>

                                        </div>
                                        <!-- End Channel Card -->
                        

                                    <?php endif; $x++;

                                endforeach; ?>

                            </div> <!-- End channels__right-column -->

                        <?php endif; $y++; ?>

                    </div>

            <?php endforeach;
        endif; ?>

    </div>

</section>