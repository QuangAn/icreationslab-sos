<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sos
 */

get_header();

?>
<?php 
		global $post;
		$categories = get_the_category($post->ID);
		$cat_id = $categories[0]->cat_ID;
		$description = $categories[0]->description;
		$name = $categories[0]->name;
		$image = get_field('feature_image', 'category_'. $cat_id);
		$show_sidebar = get_field('show_sidebar');
	?>
<div class="page-header">
	<div class="feature_image_category">
		<img src="<?php echo $image['url']; ?>" alt="" />
	</div>
	<div class="box-des-category">
		<h1 class="page-title"><?=  $name;  ?></h1>
		<div class="archive-description"><?= $description ?></div>
	</div>
</div>	
<div class="sigle-main-content">
	
	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );


			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

		endwhile; // End of the loop.
		?>
	</main><!-- #main -->
	<?php $show_sidebar == 'yes' ? get_sidebar() : ''; ?>
</div>
<?php
get_footer();
