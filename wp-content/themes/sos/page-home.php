<?php 
/*
	Template Name: Home Page
*/
	get_header();
?>
<main class="page-home page-full">
	<?php get_template_part('template-parts/home/content','banner'); ?>
	<?php get_template_part('template-parts/home/content','post-on-memories'); ?>
	<?php get_template_part('template-parts/home/content','post-on-stories'); ?>
	<?php get_template_part('template-parts/home/content','the-wall'); ?>
	<?php get_template_part('template-parts/home/content','share-your-thoughts'); ?>
	<?php get_template_part('template-parts/home/content','quiz-form'); ?>
</main>
<?php get_footer(); ?>