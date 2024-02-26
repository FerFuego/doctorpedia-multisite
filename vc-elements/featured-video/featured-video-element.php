<?php
/* Element Description: VC FeaturedVideo*/
 
// Element Class 
class vcFeaturedVideo extends WPBakeryShortCode {
	 
	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'vc_featuredVideo_mapping' ) );
		add_shortcode( 'vc_featuredVideo', array( $this, 'vc_featuredVideo_html' ) );
	}
	 
	// Element Mapping
	public function vc_featuredVideo_mapping() {
		 
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
				return;
		}
			
		// Map the block with vc_map()
		vc_map( 

			array(
				'name' => __('Featured Video', 'text-domain'),
				'base' => 'vc_featuredVideo',
				'description' => __('Featured Video Module', 'text-domain'), 
				'category' => __('DoctorPedia Elements', 'text-domain'),   
				'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',            
				'params' => array(   
					array(
						'type' => 'attach_image',
						'holder' => 'img',
						'class' => 'title-class',
						'heading' => __( 'Background Image', 'text-domain' ),
						'param_name' => 'background',
						'value' => '',
						'description' => __( '', 'text-domain' ),
						'dependency' => array(
							'element' => 'source',
							'value' => 'media_library',
						),
						'admin_label' => false,
						'group' => 'General',
					),
					array(
						'type' => 'textfield',
						'holder' => '',
						'class' => 'title-class',
						'heading' => __( 'Section Title', 'text-domain' ),
						'param_name' => 'section_title',
						'value' => __( '', 'text-domain' ),
						'description' => __( '', 'text-domain' ),
						'admin_label' => false,
						'weight' => 0,
						'group' => 'General',
					),  
					array(
						'type' => 'textfield',
						'holder' => '',
						'class' => 'title-class',
						'heading' => __( 'Video Title', 'text-domain' ),
						'param_name' => 'title',
						'value' => __( '', 'text-domain' ),
						'description' => __( '', 'text-domain' ),
						'admin_label' => false,
						'weight' => 0,
						'group' => 'General',
					), 
					array(
						'type' => 'textarea',
						'holder' => '',
						'class' => 'title-class',
						'heading' => __( 'Subtitle', 'text-domain' ),
						'param_name' => 'subtitle',
						'value' => __( '', 'text-domain' ),
						'description' => __( '', 'text-domain' ),
						'admin_label' => false,
						'weight' => 0,
						'group' => 'General',
					),
					array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Video Type', 'text-domain' ),
                        'param_name' => 'video_type',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => array(
                            __('Select the type'),
                            __('Connatix'),
                            __('Vimeo'),
                        ),
                    ),
					array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Vimeo Link Video", "my-text-domain" ),
                        "param_name" => "link_video",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Vimeo video", "my-text-domain" ),
                        'group' => 'Vimeo',
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __( "Vimeo Link Video", "my-text-domain" ),
						"param_name" => "link_video_mobile",
						"value" => '', 
						"description" => __( "Copy & Paste the link of the Vimeo video", "my-text-domain" ),
						'group' => 'Vimeo',
					),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Connatix script id", "my-text-domain" ),
                        "param_name" => "script_id",
                        "value" => '', 
                        "description" => __( "Copy & Paste the Connatix script id", "my-text-domain" ),
                        'group' => 'Connatix',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Player_id Connatix", "my-text-domain" ),
                        "param_name" => "player_id",
                        "value" => '', 
                        "description" => __( "Copy & Paste the playerId of the Connatix code", "my-text-domain" ),
                        'group' => 'Connatix',
                    )
				)
			)
		);                           
		
	} 
	 
	 
	// Element HTML
	public function vc_featuredVideo_html( $atts ) {

		$attributes = vc_map_get_attributes($this->getShortCode(), $atts);
		 // Params extraction
		extract(
			shortcode_atts(
				array(
					'background'   => '',
					'section_title'   => '',
					'title'   => '',
					'video_type' => '',
					'link_video' => '',
					'script_id' => '',
					'player_id' => '',
					'link_video_mobile' => '',
					'subtitle' => ''
				), 
				$atts
			)
		);

		$image = wp_get_attachment_image_src($background, 'full');    
		
		return $this->BlockHTML($image, $background, $video_type, $script_id, $section_title, $title, $link_video, $player_id, $link_video_mobile, $subtitle);
	} 

	public function BlockHTML($image, $background, $video_type, $script_id, $section_title, $title, $link_video, $player_id, $link_video_mobile, $subtitle){ 
		$rand = rand('999','9999');
		ob_start(); ?>
		<!-- Feature Video Module VC -->
		<div class="container featured-video <?php echo ( $video_type == 'Connatix' ) ? 'fvideo-connatix-container' : null; ?>">
			<h1 class="featured-title"><?php echo $section_title ?></h1>
			<div class="featured-video-module video-module-vc js-video-module-vc <?php echo ( $video_type == 'Connatix' ) ? 'fvideo-connatix-container__subcontainer' : null; ?>">
				<div class="video-wrapper 
				<?php echo ( ( $video_type != 'Connatix' ) && ( have_rows('call_to_action', 'option')) ) ? 'video-wrapper-limit-width' : ''; ?> 
				<?php echo ( $video_type == 'Connatix' ) ? 'fvideo-connatix-container__video-wrapper' : null; ?>">

					<?php if ( $video_type == 'Connatix' ) : ?>
							
						<!-- Connatix -->
						<div id="connatix-fvideo">

							<script>!function(n){if(!window.cnx){window.cnx={},window.cnx.cmd=[];var t=n.createElement('iframe');t.display='none',t.onload=function(){var n=t.contentWindow.document;c=n.createElement('script'),c.src='//cd.connatix.com/connatix.player.js',c.setAttribute('async','1'),c.setAttribute('type','text/javascript'),n.body.appendChild(c)},n.head.appendChild(t)}}(document);</script>

							<script id="<?php echo $script_id; ?>"></script>

							<!-- CTA buttons right video -->
							<?php if( have_rows('call_to_action', 'option') ): ?>
								<div class="video-wrapper-section__sidebar">
									<?php while( have_rows('call_to_action', 'option') ): the_row(); ?>
										<div class="video-wrapper-section__sidebar__box">
											<p><?php the_sub_field('title'); ?></p>
											<a href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>"><?php echo get_sub_field('link')['title']; ?></a>
										</div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>

						</div>

					<?php else : ?>

						<iframe id="iframe-featured-video-<?php echo $rand; ?>" class="video d-block" src=<?php echo "$link_video"; ?> frameborder="0" allow="autoplay"></iframe>

						<div class="network-skip-intro add-bottom-solution d-none" id="js-skip-intro-featured-video-<?php echo $rand; ?>">
							<button class="skip-intro" id="js-skip-intro-featured-video-<?php echo $rand; ?>">Skip Intro</button>
						</div>

						<!-- Video CTA -->
						<?php if( have_rows('call_to_action', 'option') ): ?>
							<div class="video-wrapper-section__sidebar">
								<?php while( have_rows('call_to_action', 'option') ): the_row(); ?>
									<div class="video-wrapper-section__sidebar__box">
										<p><?php the_sub_field('title'); ?></p>
										<a href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>"><?php echo get_sub_field('link')['title']; ?></a>
									</div>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					
					<?php endif; ?>
					
				</div>
				
				<div class="network-share-call-to-action d-none" id="js-share-call-to-action-featured-video-<?php echo $rand; ?>">
					<img class="icon-open icon-share-featured-video"  src="<?php print IMAGES; ?>/icons/share-video.svg" alt="">
				</div>

				<div class="network-share" id="js-network-share-featured-video-<?php echo $rand; ?>">
					<div class="network-share__social-media d-none" id="js-social-media-featured-video-<?php echo $rand; ?>">
						<img class="icon-close icon-close-featured-video" id="js-close-share-featured-video-<?php echo $rand; ?>" src="<?php print IMAGES; ?>/icons/close-share.svg" alt="">
						<div class="network-share__social-media__content">
							<h3 class="text-white">Share This Video</h3>
							<hr>
							<?php echo do_shortcode('[easy-social-share]'); ?>
						</div>
					</div>
				</div>
					
				<div class="video-placeholder video-wrapper-section-featured-video" style="background-image:url(<?php echo $image[0] ?>)">
					<div class="title-and-button-container">
						<?php if(!empty($title)): ?>
							<span><?php echo $title ?></span>
						<?php endif ?>
						
						<button class="play-video-btn" id="fv-play-button-<?php echo $rand; ?>">
							<img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
						</button>
					</div>
						<?php if(!empty($subtitle)): ?>
							<div class="category-container"> 
								<div class="category d-none d-md-flex">
									<div class="body">                                        
										<p><?php echo $subtitle ?></p>
									</div>
								</div>
							</div>                            
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>

		<script>
			$("document").ready(function() {

				<?php if ( $video_type == 'Connatix' ) : ?>

					var width = $('#connatix-fvideo').width();
					var height = ( width / 16 ) * 9;

					$('#connatix-fvideo').css({
						'height' : height + 'px',
						'min-height' : height + 'px'
					});

					$('#fv-play-button-<?php echo $rand; ?>').click(function(){
						$(this).closest(".js-video-module-vc").addClass("video-module--state-play");
						$(this).parent().parent().fadeOut("slow");

						$('#' + '<?php echo $script_id; ?>' ).html( 
							cnx.cmd.push(function() { 
								cnx({ 
									playerId: '<?php echo $player_id; ?>'
								}).render( '<?php echo $script_id; ?>' ); 
							}) 
						);

						$('#connatix-fvideo').css({'height': 'auto'}); //important don't delete
						
						$('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').removeClass('d-none');

						var width = $('#connatix-fvideo').width();
						$('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').css({'width':width+'px'});
						$('#js-skip-intro-featured-video-<?php echo $rand; ?>').css({'width':width+'px'});

					})  

					// open network-share 
					$('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').click( function() {
						$('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').addClass('d-none');
						$('#js-social-media-featured-video-<?php echo $rand; ?>').removeClass('d-none');
						var width = $('#connatix-fvideo').width();
						var height = $('#connatix-fvideo').height();
						$('#js-social-media-featured-video-<?php echo $rand; ?>').css({'width':width+'px', 'height':height+'px'});
					});

					// close network-share
					$('#js-close-share-featured-video-<?php echo $rand; ?>').click( function() {
						$('#js-social-media-featured-video-<?php echo $rand; ?>').addClass('d-none');
						$('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').removeClass('d-none');
					});

				<?php else : ?>

					var iframe_section = $("#iframe-featured-video-<?php echo $rand; ?>")[0];
					var player = new Vimeo.Player(iframe_section);
					var i = 0;
					var skip = 5;
				
					$('#fv-play-button-<?php echo $rand; ?>').click(function(){
						$(this).closest(".js-video-module-vc").addClass("video-module--state-play");
						$(this).parent().parent().fadeOut("slow");
						$(this).parent().parent().siblings(".video-wrapper-section-featured-video").children( "iframe" ).click();
						
						$('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').removeClass('d-none');
						$('#js-skip-intro-featured-video-<?php echo $rand; ?>').removeClass('d-none');

						player.play()

						var width = $("#iframe-featured-video-<?php echo $rand; ?>").width();
						$('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').css({'width':width+'px'});
						$('#js-skip-intro-featured-video-<?php echo $rand; ?>').css({'width':width+'px'});

						var item = $("#iframe-featured-video-<?php echo $rand; ?>").attr('data-id');
						$('#' + item).css({'opacity':'1'});
					})  
				
					// Button pause
					$('.video-wrapper-section-featured-video .close-video-btn').click(function(){
						$('.video-wrapper-section .play-video-btn').parent().fadeIn('slow');
						$('#video-trascript').hide('slow');
						$( this ).parent().siblings( '.video-wrapper-section' ).children( 'iframe' ).click();
						player.pause();
					});

					// Open network-share 
					$('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').click( function() {
						$('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').addClass('d-none');
						$('#js-social-media-featured-video-<?php echo $rand; ?>').removeClass('d-none');
						var width = $("#iframe-featured-video-<?php echo $rand; ?>").width();
						var height = $("#iframe-featured-video-<?php echo $rand; ?>").height();
						$('#js-social-media-featured-video-<?php echo $rand; ?>').css({'width':width+'px', 'height':height+'px'});
						player.pause();
					});

					// Close network-share
					$('#js-close-share-featured-video-<?php echo $rand; ?>').click( function() {
						$('#js-social-media-featured-video-<?php echo $rand; ?>').addClass('d-none');
						$('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').removeClass('d-none');
						player.play();
					});

					// Skip intro
					$('#js-skip-intro-featured-video-<?php echo $rand; ?>').click( function () {
						//set time in 5 seg to skip intro
						player.setCurrentTime( skip ).then( function (seconds) {
							$('#js-skip-intro-featured-video-<?php echo $rand; ?>').hide('slow');
						});
					});

					$('#js-social-media-featured-video-<?php echo $rand; ?>').click(function(e) {
                        if(e.target !== this) {
                            return;
                        }
                        $('#js-social-media-featured-video-<?php echo $rand; ?>').addClass('d-none');
                        $('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').removeClass('d-none');
                        player.play();
                    });

					player.on('play', function() {
						$('#js-social-media-featured-video-<?php echo $rand; ?>').addClass('d-none');
						$('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').removeClass('d-none');
					});

					player.on('pause', function() {
						$('#js-share-call-to-action-featured-video-<?php echo $rand; ?>').addClass('d-none');
						$('#js-social-media-featured-video-<?php echo $rand; ?>').removeClass('d-none');
						var width = $("#iframe-featured-video-<?php echo $rand; ?>").width();
						var height = $("#iframe-featured-video-<?php echo $rand; ?>").height();
						$('#js-social-media-featured-video-<?php echo $rand; ?>').css({'width':width+'px', 'height':height+'px'});
					});

					player.on('progress', function( data ) {
						player.getCurrentTime().then(function(seconds) {
							if( seconds > 5 ) {
								$('#js-skip-intro-featured-video-<?php echo $rand; ?>').hide('slow');
							}
						});
					});

				<?php endif; ?>

			});
		</script>
		<!-- End Feature Video Module VC  -->
	<?php 
		return ob_get_clean();
	}
	 
} // End Element Class

 
// Element Class Init
new vcFeaturedVideo();

?>
