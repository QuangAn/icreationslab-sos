<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aei-legal
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-thumbnail">
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"  class="thumbnail__img"><?php echo get_thumb(get_the_ID(),'happening-thumb'); ?></a>
	</div>
	<div class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</div><!-- .entry-header -->
	<div class="entry-meta"><?php sos_posted_on(); ?></div>
	<div class="entry-content"><?php echo wp_strip_all_tags(get_the_excerpt()); ?></div>
</article><!-- #post-<?php the_ID(); ?> -->
