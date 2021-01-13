<?php 
$args = array(
	'post_type' => array( 'banner_main' ),
);
$banner_main = new WP_Query( $args );
if ( $banner_main->have_posts() ) { ?>
	<section class="banner banner-main">
	<div class="owl-carousel owl-theme">
		<?php
			while ( $banner_main->have_posts() ) {
				$banner_main->the_post();
		?>
		<div class="banner-item">
			<div class="banner-item__img">
				<?php the_post_thumbnail('full'); ?>
			</div>
			<?php if(get_the_content()){ ?>
			<div class="banner-item__box">
				<div class="banner-item__desciption"><?php the_content(); ?></div>
			</div>
			<?php } ?>
		</div>
		<?php } ?> 
	</div>
	</section>
	<script>
		jQuery(document).ready(function(){
			jQuery('.banner-main .owl-carousel').owlCarousel({
			    loop: true,
			    nav: false,
			    dots:true,
			    items: 1
			})
		})
	</script>
<?php } else { 
	// no posts found 
}
?>
