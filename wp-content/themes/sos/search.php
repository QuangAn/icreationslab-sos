<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package sos
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
			<?php 
				global $wp_query;
				$count = $wp_query->found_posts;
			   $not_singular = $count > 1 ? $count.' results' : $count.' result';
			?>
			<div class="page-header">
				<div class="feature_image_category">
					<?php dynamic_sidebar('sidebar-2') ?>
				</div>
				
			</div><!-- .page-header -->
			<div class="description_content_search"><?= $not_singular." found for '".get_search_query()."'" ?></div>
			<?php
			/* Start the Loop */
			echo '<div class="collection-search">';
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;
			echo '</div>';
			wp_pagenavi();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
