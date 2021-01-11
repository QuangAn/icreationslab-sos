<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sos
 */

get_header();
?>
	<?php
		$category = get_category( get_query_var( 'cat' ) );

		$cat_id = $category->cat_ID;
		$image = get_field('feature_image', 'category_'. $cat_id);
		$description_content = get_field('description_content', 'category_'. $cat_id);
		$posts_per_page = get_field('posts_per_page', 'category_'. $cat_id);
		$template = get_field('category_template', 'category_'. $cat_id);
		if($template == 'stories') $gridClass = '2';
		if($template == 'memories') $gridClass = '3';
		if($template == 'happening') $gridClass = '3 grid-default';
		if($template == 'default') $gridClass = '3';
		$args = array(
	        'cat' => $cat_id,
	        'post_type'     => 'post',
	        'posts_per_page'=> $posts_per_page
	    );
	    $query = new WP_Query( $args );
	    $totalwall = $query->found_posts; 
	?>
	<main id="primary" class="site-main">

		<?php if ( $query->have_posts() ) : ?>

			<div class="page-header <?php if(!get_the_post_thumbnail()) echo 'not-feature-image' ?>">
				<div class="feature_image_category">
					<img src="<?php echo $image['url']; ?>" alt="" />
				</div>
				<div class="box-des-category">
					<?php if($template != 'memories'){ ?>
					<h1 class="page-title"><?php  the_category(', ');  ?></h1>
					<?php }else{ ?>
						<h1 class="page-title">Walking Down Memory Lane</h1>
					<?php } ?>
					<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
				</div>
			</div><!-- .page-header -->
			<div class="description_content_category"><?= $description_content ?></div>
			<div class="<?php echo $template; ?> template-grid template-grid-<?php echo $gridClass; ?>">
			<?php
			/* Start the Loop */
			while ( $query->have_posts() ) :
				$query->the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				if(get_post_type() == 'post'){
					if($template == 'stories'){
						get_template_part('template-parts/content','stories');
					}
					if($template == 'memories'){
						get_template_part('template-parts/content','memories');

					}
					if($template == 'happening'){
						get_template_part('template-parts/content','happening');
					}
					if($template == 'full'){
						get_template_part( 'template-parts/content', 'post-full' );
					}
					if($template == 'default' || !$template){
						get_template_part( 'template-parts/content', get_post_type() );
					}
				}
				

			endwhile;

			//the_posts_navigation();
			echo '</div>';
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		<?php if($posts_per_page < $totalwall) : ?>
		<div id="loading-more" style="display: none;">Loading ...</div>
		<div class="button" id="load-more">LOAD MORE</div>
		<script>
			jQuery(document).ready(function(){
				post_type = "<?php echo get_post_type() ?>";
				cat_id = <?php echo $cat_id; ?>;
				posts_per_page = <?php echo $posts_per_page; ?>;
				url = "<?php echo admin_url('admin-ajax.php');?>";
				template = "<?php echo $template; ?>";
				ajaxLoadPost(url,'#load-more','#loading-more','.template-grid',post_type,cat_id,posts_per_page,template)
			});
		</script>
		
		<?php endif; ?>
	</main><!-- #main -->
<?php if($template == 'memories'){ ?>
		<div class="loading" id="loading-memory" style="display: none">Loadding...</div>
		<div class="overlay-popup" style="display: none;"></div>
		<div id="memory-popup" class="popup-custom">
		    <div class="close-popup"><span>X</span>&nbsp;&nbsp;<span>CLOSE</span></div>
		    <div class="popup-content"></div>
		</div>
		<script>

		    jQuery(document).ready(function(){
		        url = "<?php echo admin_url('admin-ajax.php');?>";
		        template = "<?php echo $template; ?>";
		        ajaxPopup(".history_link,.history_img","post", "#loading-memory",url,'#memory-popup',template);
		    })
		</script>
		<?php } ?>
<?php

get_footer();
