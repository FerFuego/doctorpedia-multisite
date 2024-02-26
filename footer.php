<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package doctorpedia_theme
 */
?>

<!-- FootBar Public Profile Mobile-->
<?php if ( is_user_logged_in() && validate_user( get_current_user_id() ) && wp_is_mobile() ) :
	get_template_part('template-parts/authors/footbar');
endif; ?>
<!-- End FootBar -->

</div>
</div><!-- End Large Container -->

<?php include(TEMPLATEPATH .'/inc/functions/footer-navbar.php') ?>

<!-- Footer -->
<footer>
	<div class="container">
		<a href="<?php echo esc_url( home_url() ); ?>">
			<img src="<?php echo (get_field('footer__icon','option')) ? get_field('footer__icon','option')['url'] : IMAGES.'/icons/doctorpedia-logo.svg'; ?>" class="logo" alt="Doctorpedia Logo">
		</a>
		<?php echo get_field('footer__copy','option'); ?>
	</div>
	<div class="container copy">
		<span>© <?php echo date('Y'); ?> Doctorpedia™</span>
		<a href="mailto:<?php the_field('email_contact','option');?>" target="_blank"><?php the_field('email_contact','option') ?></a>
		<ul>
			<?php if (get_field('social','option')) :
				foreach (get_field('social','option') as $social) : 
					if (isset($social['social__link'])) : ?>
						<li>
							<a href="<?php echo $social['social__link']['url']; ?>" target="<?php echo $social['social__link']['target']; ?>">
								<?php if (isset($social['social__icon'])) : ?>
									<img src="<?php echo $social['social__icon']['url']; ?>">
								<?php endif; ?>
							</a>
						</li>
					<?php endif;
				endforeach;
			endif; ?>
		</ul>
	</div>
</footer>
<!-- End Footer -->

<!-- ###################################### -->
<?php echo get_field('tracking_codes_footer', 'option'); ?>
<!-- ###################################### -->

<?php wp_footer(); ?>
</body>
</html>