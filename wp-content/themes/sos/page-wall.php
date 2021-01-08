<?php 
/*
	Template Name: The Wall
*/
	get_header();	
?>
<main>
	<div class="page-header">
		<div class="feature_image_category">
			<?php the_post_thumbnail( 'full' ); ?>
		</div>
		<div class="box-des-category">
			<?php the_title( '<h1 class="page-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
			<div class="archive-description"><?php the_content(); ?></div>
		</div>
	</div><!-- .page-header -->
	<?php get_template_part('template-parts/home/content','the-wall'); ?>
	<?php get_template_part('template-parts/home/content','share-your-thoughts'); ?>
</main>
<?php get_footer(); ?>