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
	<?php
		if($post_type == 'video') {
			$youtube_link = get_field('youtube_link');
            $youtube_id = getYoutubeIdFromUrl($youtube_link); 
	 ?>
	 <div class="our-story-img youtube-thumb"><img src="https://i1.ytimg.com/vi/<?php echo $youtube_id; ?>/maxresdefault.jpg" alt="" /></div>
	<div class="youtube-video">
        <div class="iframe-youtube">
            <div class="close-youtube"><span>X</span>&nbsp;&nbsp;<span>CLOSE</span></div>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            
        </div>
        <div class="overlay-youtube"></div>
    </div>
    <script>
        jQuery(document).ready(function(){
            jQuery('.youtube-thumb').click(function(){
                jQuery(this).next().addClass('active');
            });
            jQuery('.overlay-youtube').click(function(){
                jQuery(this).parent().removeClass('active');
            })
            jQuery('.close-youtube').click(function(){
                jQuery(this).parent().parent().removeClass('active');
            })
        });
    </script>
    <?php 
	}else{
		$thumbnail = get_thumb(get_the_ID(),'category-thumb');
	 ?>
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"  class="story__img"><?php echo $thumbnail; ?></a>
	<?php } ?>
	<div class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</div><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
