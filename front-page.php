<?php
/**
 * Front Page
 *
 * @package 	Storytelling PR
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
**/

add_action( 'wp_enqueue_scripts', 'spr_enqueue_slick' );
wp_enqueue_script( 'home-slider-init', get_stylesheet_directory_uri() . "/js/slick-home.js", array( 'slider' ), CHILD_THEME_VERSION, true );
wp_enqueue_script( 'smooth-scroll', get_stylesheet_directory_uri() . "/js/smooth-scroll.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action( 'genesis_after_header', 'is_home_hero', 10 );
function is_home_hero() { 
	if( have_rows('home_slides') ) { ?>

	<div class="home-hero">
		<div class="home-slides">

		<?php while( have_rows('home_slides') ): the_row(); 
			$image = get_sub_field('image');
			$size = 'full';
			$credit = get_sub_field('credit_line');
			?>

			<div class="home-slide">
				<?php echo wp_get_attachment_image( $image, $size ); ?>
				<?php if ($credit) { echo '<div class="credit">' . $credit . '</div>'; }?>
			</div><?php 

			endwhile; ?>
		</div>
		<div class="hero-overlay">
			<div class="wrap">

				<?php
				$logo = get_field('logo_overlay');
				$logo_size = 'full';
				$link = get_field('cta_link');
				$link_text = get_field('cta_link_text');

				?>

				<div class="logo">
					<?php echo wp_get_attachment_image( $logo, $logo_size ); ?>
				</div>
				<div class="cta">
					<a class="button" href="<?php echo esc_url( $link ); ?>"><?php echo $link_text; ?></a>
				</div>
				<div class="scroller">
					<a href="#genesis-content"><i class="fas fa-arrow-down"></i></a>
				</div>
			</div>
		</div>
</div>

<?php }
}

genesis();