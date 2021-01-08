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
	<a href="javascript:void(0)" data-id="<?php the_ID(); ?>" title="<?php the_title_attribute(); ?>"  class="history_img"><?php the_post_thumbnail('thumbnail'); ?></a>

	<div class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a data-id="'.get_the_ID().'" href="javascript:void(0)" class="history_link" rel="bookmark">', '</a></h2>' ); ?>
	</div><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
