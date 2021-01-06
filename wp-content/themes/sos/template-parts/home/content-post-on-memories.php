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
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="memory-img"><?php the_post_thumbnail(array(500, 500, 1)); ?></a>
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="memory-des">
                <?php the_title(); ?>
            </a>
        </div>
       	<?php endwhile; 
		wp_reset_postdata(); ?>
    </div>
</div>
 <?php else : ?>
 <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
 <?php endif; ?>

