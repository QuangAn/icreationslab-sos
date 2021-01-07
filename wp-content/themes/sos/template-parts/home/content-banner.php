<?php 
$args = array(
	'post_type' => array( 'banner' ),
);
$banner = new WP_Query( $args );
if ( $banner->have_posts() ) { ?>
	<section class="banner">
	<div class="owl-carousel owl-theme">
		<?php
			while ( $banner->have_posts() ) {
				$banner->the_post();
		?>
		<div class="banner-item">
			<div class="banner-item__img">
				<?php the_post_thumbnail('full'); ?>
			</div>
			<div class="banner-item__box">
				<h4><?php the_title(); ?></h4>
				<div class="banner-item__desciption"><?php the_content(); ?></div>
			</div>
		</div>
		<?php } ?> 
	</div>
	</section>
	<script>
		jQuery(document).ready(function(){
			jQuery('.banner .owl-carousel').owlCarousel({
			    loop: true,
			    nav: true,
			    dots:false,
			    items: 1
			})
		})
	</script>
<?php } else { 
	// no posts found 
}
?>
