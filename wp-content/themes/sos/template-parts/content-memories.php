<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aei-legal
 */
$post_type = get_field('post_type');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"  class="story__img"><?php the_post_thumbnail('thumbnail'); ?></a>

	<div class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</div><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
