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
	
	<div class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</div><!-- .entry-header -->
	<div class="entry-meta"><?php sos_posted_on(); ?></div>
	<?php if($post_type == 'video') {
			$youtube_link = get_field('youtube_link');
            $youtube_id = getYoutubeIdFromUrl($youtube_link);
	 ?>
		<div class="iframe-youtube-single">
           <iframe width="100%" height="500" src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            
        </div>
	<?php }else{ ?>
	<div class="entry-thumbnail">
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"  class="thumbnail__img"><?php the_post_thumbnail('full'); ?></a>
	</div>
	<?php } ?>
	<div class="entry-content"><?php the_content(); ?></div>
</article><!-- #post-<?php the_ID(); ?> -->
