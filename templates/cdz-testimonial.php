<?php

namespace cdzLovelyTestimonials;

/*
 *	cdzTemplate: Single Testimonial
 */

$cdz_testimonial_title		= $post->post_title;
$cdz_testimonial_content	= $post->post_content;

$cdz_testimonial_author_label	= get_post_meta( $post->ID, 'cdz_testimonial_author_label', true );
$cdz_testimonial_author			= get_post_meta( $post->ID, 'cdz_testimonial_author', true );
$cdz_testimonial_website_label	= get_post_meta( $post->ID, 'cdz_testimonial_website_label', true );
$cdz_testimonial_website_url	= get_post_meta( $post->ID, 'cdz_testimonial_website_url', true );

?>

<?php get_header(); ?>

	<div id="primary" class="cdz-lovely-testimonials site-content">
		<div id="content" role="main">
			<div id="cdz_testimonial-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-header">
					<?php the_post_thumbnail( 'medium' ); ?>
					<h1 class="entry-title"><?php echo $cdz_testimonial_title; ?></h1>
				</div>

				<div class="entry-content"><p><?php echo do_shortcode( wpautop( $cdz_testimonial_content ) ); ?></p></div>

				<div class="entry-meta">
					<?php if ( $cdz_testimonial_author ) : ?>
						<p class="author">
							<i class="fa fa-user"></i>
							<span class="label"><?php echo $cdz_testimonial_author_label ? $cdz_testimonial_author_label : __( 'Author' ) . ': '; ?></span>
							<span class="text"><?php echo $cdz_testimonial_author; ?></span>
						</p>
					<?php endif; ?>
					<?php if ( $cdz_testimonial_website_url ) : ?>
						<p class="website">
							<i class="fa fa-globe"></i>
							<span class="label"><?php echo $cdz_testimonial_website_label ? $cdz_testimonial_website_label : __( 'Website' ) . ': '; ?></span>
							<span class="text"><a href="<?php echo esc_url( $cdz_testimonial_website_url ); ?>"><?php echo $cdz_testimonial_website_url; ?></a></span>
						</p>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>