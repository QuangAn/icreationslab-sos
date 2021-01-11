<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aei-legal
 */

get_header();
$description_content = get_field('description_content',  get_the_ID());
?>

	<main id="primary" class="site-main">
		<div class="page-header">
			<div class="feature_image_category">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
			<div class="box-des-category">
				<?php the_title( '<h1 class="page-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
				<div class="archive-description"><?= $description_content ?></div>
			</div>
		</div><!-- .page-header -->
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
