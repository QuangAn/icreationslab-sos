<?php 
$posts_per_page = get_field('posts_per_page',  get_the_ID());
$args = array(
    'post_type' => array( 'the_wall' ),
    'posts_per_page'=> $posts_per_page,
);
$walls = new WP_Query( $args );
$totalwall = $walls->found_posts; 
if ( $walls->have_posts() ) { ?>
<div class="the-wall-home wall-category">
    <div class="block-content">
            <?php
                $i = 0;
                while ( $walls->have_posts() ) {
                    $i++; $walls->the_post();
            ?>
            <div class="the-wall-item">
                <a href="javascript:void(0)" data-id="<?php the_ID(); ?>" class="the-wall-img"><?php echo get_thumb(get_the_ID(),'wall-thumb'); ?></a>
                <div class="the-wall__content">
                    <div class="the-wall-des"><?php echo wp_strip_all_tags(get_the_excerpt()); ?>
                    <a href="javascript:void(0)" class="the-wall-readmore"  data-id="<?php the_ID(); ?>">Read More</a>
                    </div>
                    <div class="the-wall-bottom">
                        <p><?php the_title(); ?></p>
                        <p><?php the_field('occupation'); ?></p>
                    </div>
                </div>
            </div>
            <?php  } ?> 
       
    </div>
    <?php if($posts_per_page < $totalwall) : ?>
    <div id="loading-more" style="display: none;">Loading ...</div>
    <div class="button" id="load-more">LOAD MORE</div>
    <script>
        jQuery(document).ready(function(){
            post_type = "the_wall";
            posts_per_page = <?php echo $posts_per_page; ?>;
            url = "<?php echo admin_url('admin-ajax.php');?>";
            ajaxLoadPost(url,'#load-more','#loading-more','.wall-category .block-content',post_type,'',posts_per_page)
        });
    </script>
<?php endif; ?>
</div>
<div class="loading" id="loading-wall" style="display: none">Loadding...</div>
<div class="overlay-popup" style="display: none;"></div>
<div id="wall-popup" class="popup-custom">
    <div class="close-popup"><span>X</span>&nbsp;&nbsp;<span>CLOSE</span></div>
    <div class="popup-content"></div>
</div>
<script>

    jQuery(document).ready(function(){
        url = "<?php echo admin_url('admin-ajax.php');?>";
        ajaxPopup(".the-wall-img,.the-wall-readmore","the_wall", "#loading-wall",url);
    })
</script>
<?php } else { 
    // no posts found 
}
?>
