<?php
/*
	Template Name: Page Full
*/
get_header();
$description_content = get_field('description_content',  get_the_ID());
?>

	<main id="primary" class="site-main page-full">
		<div class="page-header <?php if(!get_the_post_thumbnail()) echo 'not-feature-image' ?>">
			<?php if(get_the_post_thumbnail()) { ?>
			<div class="feature_image_category">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
			<?php } ?>
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
