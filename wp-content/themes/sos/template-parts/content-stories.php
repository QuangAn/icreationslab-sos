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
        $thumbnail = get_thumb(get_the_ID(),'category-thumb');
		if($post_type == 'video') {
			$youtube_link = get_field('youtube_link');
            $youtube_id = getYoutubeIdFromUrl($youtube_link);
	 ?>
	 <div class="our-story-img youtube-thumb">
        <?php if(has_post_thumbnail()){  ?>
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"  class="story__img"><?php echo $thumbnail; ?></a>
        <?php }else{  ?>
        <img src="https://i1.ytimg.com/vi/<?php echo $youtube_id; ?>/maxresdefault.jpg" alt="" />
        <?php } ?>
    </div>
	<div class="youtube-video">
        <div class="iframe-youtube">
            <div class="close-youtube"><span>X</span>&nbsp;&nbsp;<span>CLOSE</span></div>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            
        </div>
        <div class="overlay-youtube"></div>
    </div>
    
    <div class="entry-header">
        <?php the_title( '<h2 class="entry-title"><a class="youtube-link" href="javascript:void(0)" rel="bookmark">', '</a></h2>' ); ?>
    </div><!-- .entry-header -->
    <script>
        jQuery(document).ready(function(){
            jQuery('.youtube-thumb').click(function(){
                jQuery(this).next().addClass('active');
            });
            jQuery('.youtube-link').click(function(){
                jQuery(this).parent().parent().prev().addClass('active');
            });
            jQuery('.overlay-youtube').click(function(){
                jQuery(this).parent().removeClass('active');
            })
            jQuery('.close-youtube').click(function(){
                jQuery(this).parent().parent().removeClass('active');
            })
        });
    </script>
    <?php }else{ ?>
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"  class="story__img"><?php echo $thumbnail; ?></a>
        <div class="entry-header">
            <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
        </div><!-- .entry-header -->
	<?php } ?>
</article><!-- #post-<?php the_ID(); ?> -->
