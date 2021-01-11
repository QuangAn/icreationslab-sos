<?php 
/*
	Template Name: The Wall
*/
	get_header();	
	$description_content = get_field('description_content',  get_the_ID());
?>
<main class="page-wall page-full">
	<div class="page-header <?php if(!get_the_post_thumbnail()) echo 'not-feature-image' ?>">
		<div class="feature_image_category">
			<?php the_post_thumbnail( 'full' ); ?>
		</div>
		<div class="box-des-category">
			<?php the_title( '<h1 class="page-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
			<div class="archive-description"><?php the_content(); ?></div>
		</div>
	</div><!-- .page-header -->
	<div class="description_content_category"><?= $description_content ?></div>
	<?php get_template_part('template-parts/content','the-wall'); ?>
	<?php get_template_part('template-parts/home/content','share-your-thoughts'); ?>
</main>
<?php get_footer(); ?>