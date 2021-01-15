<?php 
$args = array(
    'post_type' => array( 'the_wall' ),
    'post_status' => 'publish',
    'meta_key'      => 'show_on_homepage',
     'meta_value'    => 'yes'
);
$walls = new WP_Query( $args );
$totalwall = $walls->found_posts; 
if ( $walls->have_posts() ) { ?>
<div class="the-wall-home">
    <div class="block-title">
        <h2>The Wall</h2>
    </div>
    <div class="block-content owl-carousel owl-theme">
            <?php
                $i = 0;
                while ( $walls->have_posts() ) {
                    $i++;
                    $walls->the_post();
                    if($i % 2 != 0) echo '<div class="group-item">';
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
            <?php 
                if($i % 2 == 0 || $totalwall == $i) echo '</div>';
                }
            ?> 
       
    </div>
</div>
<div class="loading" id="loading-wall" style="display: none">
    <div class="loading-text">Loadding...</div>
    <div class="overlay-popup"></div>
</div>
    
<div id="popup-wall" class="popup-sos">
    <div class="popup-content fix-height">
        <div id="close-popup"><span>X</span>&nbsp;&nbsp;<span>CLOSE</span></div>
        <div class="popup-inner radios scroll-css">
            
        </div>
        <div class="overlay-popup"></div>
    </div>
</div>
<script>

    jQuery(document).ready(function(){
        url = "<?php echo admin_url('admin-ajax.php');?>";
        ajaxPopup(".the-wall-img,.the-wall-readmore","the_wall", "#loading-wall",url,'#popup-wall');

        var owl_wall = jQuery('.the-wall-home .owl-carousel');
        owl_wall.owlCarousel({
            loop: false,
            nav: false,
            dots:true,
            items:2,
            responsive:{
                0:{
                    items:1
                },
                768:{
                    items:2,
                    margin:15
                },
                1024:{
                    margin:30
                }
            }
        })
    })
</script>
<?php } else { 
    // no posts found 
}
?>
