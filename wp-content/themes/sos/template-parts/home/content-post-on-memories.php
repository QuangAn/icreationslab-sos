<?php
	$cat_id = '5';
    $args = array(
        'cat' => $cat_id,
        'post_type'     => 'post',
        'posts_per_page'=> 4,
        'meta_key'      => 'show_on_homepage',
        'meta_value'    => 'yes'
    );
	$query = new WP_Query( $args );
	$cat_name = get_cat_name($cat_id);
	$i=1;
?>

<?php if ( $query->have_posts() ) :  ?>
 <div class="memories-home">
    <div class="block-title">
        <h2><?php echo $cat_name; ?></h2>
    </div>
    <div class="block-content">
    	<?php while ( $query->have_posts() ) : $query->the_post();$i++; ?>
        <div class="memory-item">
            <a href="javascript:void(0)" data-id="<?php the_ID(); ?>" title="<?php the_title_attribute(); ?>" class="memory-img"><?php the_post_thumbnail(array(500, 500, 1)); ?></a>
            <a href="javascript:void(0)" data-id="<?php the_ID(); ?>" title="<?php the_title_attribute(); ?>" class="memory-des">
                <?php the_title(); ?>
            </a>
        </div>
       	<?php endwhile; 
		wp_reset_postdata(); ?>
    </div>
</div>
<div class="loading" id="loading-memories" style="display: none">
    <div class="loading-text">Loadding...</div>
    <div class="overlay-popup"></div>
</div>
<div id="popup-memories" class="popup-memories popup-sos">
    <div class="popup-content">
        <div id="close-popup"><span>X</span>&nbsp;&nbsp;<span>CLOSE</span></div>
        <div class="popup-inner white radios scroll-css">
            
        </div>
        <h2 class="popup-title"></h2>
    </div>
    <div class="overlay-popup"></div>
</div>
<script>

    jQuery(document).ready(function(){
        url = "<?php echo admin_url('admin-ajax.php');?>";
        ajaxPopup(".memory-img,.memory-des","post", "#loading-memories",url,'#popup-memories','memories');
    })
</script>
 <?php else : ?>
 <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
 <?php endif; ?>

