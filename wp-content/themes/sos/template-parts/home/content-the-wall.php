<?php 
$args = array(
    'post_type' => array( 'the_wall' ),
);
$walls = new WP_Query( $args );
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
                <a href="#" class="the-wall-img"><?php the_post_thumbnail(array(410, 280)); ?></a>
                <div class="the-wall__content">
                    <div class="the-wall-des"><?php echo wp_strip_all_tags(get_the_excerpt()); ?>
                    <a href="<?php the_permalink() ?>">Read More</a>
                    </div>
                    <div class="the-wall-bottom">
                        <p><?php the_title(); ?></p>
                        <p><?php the_field('occupation'); ?></p>
                    </div>
                </div>
            </div>
            <?php 
                if($i % 2 == 0) echo '</div>';
                }
            ?> 
       
    </div>
</div>


<script>

    jQuery(document).ready(function(){
        var owl_wall = jQuery('.the-wall-home .owl-carousel');
        owl_wall.owlCarousel({
            loop: true,
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
                    margin:40
                }
            }
        })
    })
</script>
<?php } else { 
    // no posts found 
}
?>
