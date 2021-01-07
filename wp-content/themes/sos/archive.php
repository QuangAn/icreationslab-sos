<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sos
 */

get_header();
?>
	<?php
		$category = get_category( get_query_var( 'cat' ) );
		$cat_id = $category->cat_ID;
		$image = get_field('feature_image', 'category_'. $cat_id);
		$description_content = get_field('description_content', 'category_'. $cat_id);
		$template = get_field('category_template', 'category_'. $cat_id);
	?>
	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<div class="page-header">
				<div class="feature_image_category">
					<img src="<?php echo $image['url']; ?>" alt="" />
				</div>
				<div class="box-des-category">
					<h1 class="page-title"><?php the_category(', '); ?></h1>
					<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
				</div>
			</div><!-- .page-header -->
			<div class="description_content_category"><?= $description_content ?></div>
			<div class="<?php echo $template; ?> template-grid template-grid-2">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				if(get_post_type() == 'post'){
					if($template == 'stories'){

						get_template_part('template-parts/content','stories');
					}
					if($template == 'full'){
						get_template_part( 'template-parts/content', 'post-full' );
					}
					if($template == 'default' || !$template){
						get_template_part( 'template-parts/content', get_post_type() );
					}
				}
				

			endwhile;

			the_posts_navigation();
			echo '</div>';
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		<div class="button" id="load-more">LOAD MORE</div>
		<script>
			jQuery(document).ready(function(){
				jQuery('#load-more').click(function(){

				});
			});
		</script>
	</main><!-- #main -->

<?php

get_footer();
