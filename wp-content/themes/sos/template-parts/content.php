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
	
	<div class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</div><!-- .entry-header -->
	<div class="entry-meta"><?php sos_posted_on(); ?></div>
	<div class="entry-thumbnail">
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"  class="thumbnail__img"><?php the_post_thumbnail('full'); ?></a>
	</div>
	<div class="entry-content"><?php the_content(); ?></div>
</article><!-- #post-<?php the_ID(); ?> -->
