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
		$template = get_field('category_template', 'category_'. $cat_id);
	?>
	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<div class="page-header">
				<div class="feature_image_category">
					<img src="<?php echo $image['url']; ?>" alt="" />
				</div>
				<div class="box-des-category">
					<h1 class="page-title"><?php the_category(', '); ?></h1>
					<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
				</div>
			</div><!-- .page-header -->
			<div class="description_content_category"><?= $description_content ?></div>
			<div class="<?php echo $template; ?> template-grid template-grid-2">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				if(get_post_type() == 'post'){
					if($template == 'stories'){

						get_template_part('template-parts/content','stories');
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
		<div id="loading-more" style="display: none;">Loading ...</div>
		<div class="button" id="load-more">LOAD MORE</div>
		<script>

			jQuery(document).ready(function(){
				post_type = "<?php echo get_post_type() ?>";
				cat_id = <?php echo $cat_id; ?>;
				posts_per_page = 2;
				ajaxLoadPost('#load-more','#loading-more','.template-grid',post_type,cat_id,posts_per_page)
			});
			function ajaxLoadPost(buttonId,loadingId,gridClass,post_type,cat_id,posts_per_page){
				var i = 0;
				jQuery(buttonId).click(function(){
					i++;
					jQuery.ajax({
						type : "post",
						url : '<?php echo admin_url('admin-ajax.php');?>',
						data : {
	                        action: "loadpost", 
	                        post_type : post_type ,
	                        cat_id : cat_id,
	                        posts_per_page: posts_per_page,
	                        offset: i*posts_per_page
	                    },
	                    context: this,
	                    beforeSend: function(){
	                        jQuery(loadingId).show();
	                    },
	                    success: function(response) {
	                        
	                        if(response.success) {
	                        	if(response.data){
	                        		jQuery(response.data).appendTo(gridClass);
	                            	jQuery(loadingId).hide();
	                        	}else{
	                        		jQuery(loadingId).hide();
	                        		jQuery(buttonId).hide();
	                        	}
	                            
	                        }
	                        else {
	                           	console.log('err');
	                        }
	                    },
	                    error: function( jqXHR, textStatus, errorThrown ){
	                     
	                        console.log( 'The following error occured: ' + textStatus, errorThrown );
	                    }
					});
					return false;
				});
			}
		</script>
	</main><!-- #main -->

<?php

get_footer();
