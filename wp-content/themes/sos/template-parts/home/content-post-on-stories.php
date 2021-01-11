<?php
	$cat_id = '3';
    $args = array(
        'cat' => $cat_id,
        'post_type'     => 'post',
        'posts_per_page'=> 6,
        'meta_key'      => 'show_on_homepage',
        'meta_value'    => 'yes'
    );
	$query = new WP_Query( $args );
	$cat_name = get_cat_name($cat_id);
	$i=1;
?>

<?php if ( $query->have_posts() ) :  ?>
<div class="our-stories-home">
    <div class="block-title">
        <h2><?php echo $cat_name; ?></h2>
    </div>
    <div class="block-content">
    	<?php 
        while ( $query->have_posts() ) : $query->the_post();
            $i++; 
            $post_type = get_field('post_type');
        ?>
        <div class="our-story">
            <?php 
             $thumbnail = get_thumb(get_the_ID(),'wall-thumb');
            if($post_type == 'video') : 
                $youtube_link = get_field('youtube_link');
                $youtube_id = getYoutubeIdFromUrl($youtube_link);
               
            ?>
                <div class="our-story-img youtube-thumb">
                    <?php if(has_post_thumbnail()) echo $thumbnail; else{   ?>
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
            <?php else : ?>
            <div class="our-story-img"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="our-story__des"><?php echo $thumbnail ?></a></div>
            <div class="our-story__content">
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="our-story__des">
                        <?php the_title(); ?>
                    </a>
            </div>
            <?php endif; ?>
        </div>
       	<?php endwhile; 
		wp_reset_postdata(); ?>
    </div>
</div>
 <?php else : ?>
 <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
 <?php endif; ?>

