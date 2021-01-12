<?php
/**
 * sos functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sos
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'sos_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sos_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on sos, use a find and replace
		 * to change 'sos' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sos', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'sos' ),
			)
		);
		register_nav_menus(
			array(
				'menu-2' => esc_html__( 'Footer', 'sos' ),
			)
		);
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'sos_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'sos_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sos_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sos_content_width', 640 );
}
add_action( 'after_setup_theme', 'sos_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sos_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'sos' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'sos' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Search Sidebar', 'sos' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'sos' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar', 'sos' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Add widgets here.', 'sos' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title" style="display:none">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'sos_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sos_scripts() {
	wp_enqueue_style( 'sos-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'sos-style', 'rtl', 'replace' );
	wp_enqueue_style('owl-css', get_template_directory_uri().'/css/owl.carousel.min.css');
	wp_enqueue_style('owl-theme-css', get_template_directory_uri().'/css/owl.theme.default.min.css');
	wp_enqueue_style('animate-css', get_template_directory_uri().'/css/animate.css');

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.5.1.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'owl', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'sos-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sos_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}




function create_banner_type() {

	$labels = array(
		'name'                  => 'Banners',
		'singular_name'         => 'Banner',
		'menu_name'             => 'Banners',
		'name_admin_bar'        => 'Banners',
		'archives'              => 'Item Archives',
		'attributes'            => 'Item Attributes',
		'parent_item_colon'     => 'Parent Item:',
		'all_items'             => 'All Banners',
		'add_new_item'          => 'Add New Item',
		'add_new'               => 'Add New',
		'new_item'              => 'New Item',
		'edit_item'             => 'Edit Item',
		'update_item'           => 'Update Item',
		'view_item'             => 'View Item',
		'view_items'            => 'View Items',
		'search_items'          => 'Search Item',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into item',
		'uploaded_to_this_item' => 'Uploaded to this item',
		'items_list'            => 'Items list',
		'items_list_navigation' => 'Items list navigation',
		'filter_items_list'     => 'Filter items list',
	);
	$args = array(
		'label'                 => 'Banner',
		'description'           => 'Banner Homepage',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-gallery',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'query_var'             => 'banner',
		'rewrite'               => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'banner', $args );

}
add_action( 'init', 'create_banner_type', 0 );




// Register Custom Post Type
function the_wall() {

	$labels = array(
		'name'                  => _x( 'The Walls', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'The Wall', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'The Wall', 'text_domain' ),
		'name_admin_bar'        => __( 'The Wall', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'The Wall', 'text_domain' ),
		'description'           => __( 'The Wall', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail','excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-users',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'the_wall', $args );

}
add_action( 'init', 'the_wall', 0 );
function getYoutubeIdFromUrl($url) {
    $parts = parse_url($url);
    if(isset($parts['query'])){
        parse_str($parts['query'], $qs);
        if(isset($qs['v'])){
            return $qs['v'];
        }else if(isset($qs['vi'])){
            return $qs['vi'];
        }
    }
    if(isset($parts['path'])){
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path)-1];
    }
    return false;
}
function excerpt($limit,$content) {
  $excerpt = explode(' ', $content, $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt);
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
if ( function_exists( 'add_image_size' ) ) {
 add_image_size( 'category-thumb', 779, 438, true);
 add_image_size( 'wall-thumb', 820, 560, true);
 add_image_size( 'happening-thumb', 535, 605, true);
}
function get_thumb($post_id,$thumb_type){
	
	$thumbnailid = get_post_meta($post_id, '_thumbnail_id', true);
	$url = wp_get_attachment_image_src($thumbnailid,$thumb_type, true);
	$thumbnail=$url['0']; 
	return '<img src="'.$thumbnail.'" />';
}

add_action( 'wp_ajax_loadPostPopup', 'loadPostPopup_init' );
add_action( 'wp_ajax_nopriv_loadPostPopup', 'loadPostPopup_init' );
function loadPostPopup_init(){
	ob_start();
	$postId = (isset($_POST['postId']))?esc_attr($_POST['postId']) : '';
	$post_type = (isset($_POST['post_type']))?esc_attr($_POST['post_type']) : '';
	$args = array(
        'p' => $postId,
        'post_type'     => $post_type,
        
    );
    $query = new WP_Query($args);
    $post = $query->get_posts();

?>
	<div class="the-wall-item">
	    <a href="javascript:void(0)" class="the-wall-img-popup"><?php echo get_thumb($post[0]->ID,'full'); ?></a>
	    <div class="the-wall__content">
	        <div class="the-wall-des"><?php echo $post[0]->post_content; ?>
	        </div>
	        <div class="the-wall-bottom">
	            <p><?php echo $post[0]->post_title; ?></p>
	            <p><?php the_field('occupation',$post[0]->ID); ?></p>
	        </div>
	    </div>
	</div>
<?php
    wp_reset_query();

    $result = ob_get_clean(); 
    wp_send_json_success($result);
    die();

}




add_action( 'wp_ajax_loadPostPopupMemories', 'loadPostPopupMemories_init' );
add_action( 'wp_ajax_nopriv_loadPostPopupMemories', 'loadPostPopupMemories_init' );
function loadPostPopupMemories_init(){
	ob_start();
	$postId = (isset($_POST['postId']))?esc_attr($_POST['postId']) : '';
	$post_type = (isset($_POST['post_type']))?esc_attr($_POST['post_type']) : '';
	$args = array(
        'p' => $postId,
        'post_type'     => $post_type,
        
    );
    $query = new WP_Query($args);
    while($query->have_posts()):$query->the_post();

?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<a href="javascript:void(0)" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('full'); ?></a>
	</article><!-- #post-<?php the_ID(); ?> -->
	<script>
		jQuery(document).ready(function(){
 			jQuery('.popup-title').html("<?php the_title() ?>");
		});
	</script>
<?php
	endwhile;
    wp_reset_query();

    $result = ob_get_clean(); 
    wp_send_json_success($result);
    die();

}





add_action( 'wp_ajax_loadpost', 'loadpost_init' );
add_action( 'wp_ajax_nopriv_loadpost', 'loadpost_init' );
function loadpost_init() {
 	ob_start();
    $cat_id = (isset($_POST['cat_id']))?esc_attr($_POST['cat_id']) : '';
    $posts_per_page = (isset($_POST['posts_per_page']))?esc_attr($_POST['posts_per_page']) : '';
    $offset = (isset($_POST['offset']))?esc_attr($_POST['offset']) : '';
    $args = array(
        'cat' => $cat_id,
        'post_type'     => 'post',
        'posts_per_page'=> $posts_per_page,
        'offset'	=> $offset,
        'orderby' 	=>'modified',
        'order'	=>	'ASC'
        
    );
    $query = new WP_Query($args);
    if($query->have_posts()):
        while($query->have_posts()):$query->the_post();
        	$post_type = get_field('post_type');

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if($post_type == 'video') {
			$youtube_link = get_field('youtube_link');
            $youtube_id = getYoutubeIdFromUrl($youtube_link); 
	 ?>
	 <div class="our-story-img youtube-thumb"><img src="https://i1.ytimg.com/vi/<?php echo $youtube_id; ?>/maxresdefault.jpg" alt="" /></div>
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
    <?php 
	}else{
		if($cat_id == '5') $thumbnail = the_post_thumbnail('thumbnail');
		else $thumbnail = the_post_thumbnail('category-thumb');
	 ?>
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"  class="story__img"><?php echo $thumbnail; ?></a>
	<?php } ?>
	<div class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</div><!-- .entry-header -->

</article>
<?php
        endwhile;
    endif; wp_reset_query();

    $result = ob_get_clean(); 
    wp_send_json_success($result);
    die();
}






add_action( 'wp_ajax_loadPostHappening', 'loadPostHappening_init' );
add_action( 'wp_ajax_nopriv_loadPostHappening', 'loadPostHappening_init' );
function loadPostHappening_init() {
 	ob_start();
    $cat_id = (isset($_POST['cat_id']))?esc_attr($_POST['cat_id']) : '';
    $posts_per_page = (isset($_POST['posts_per_page']))?esc_attr($_POST['posts_per_page']) : '';
    $offset = (isset($_POST['offset']))?esc_attr($_POST['offset']) : '';
    $args = array(
        'cat' => $cat_id,
        'post_type'     => 'post',
        'posts_per_page'=> $posts_per_page,
        'offset'	=> $offset,
        'orderby' 	=>'modified',
        'order'	=>	'ASC'
        
    );
    $query = new WP_Query($args);
    if($query->have_posts()):
        while($query->have_posts()):$query->the_post();
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"  class="thumbnail__img"><?php echo get_thumb(get_the_ID(),'happening-thumb'); ?></a>
		</div>
		<div class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</div><!-- .entry-header -->
		<div class="entry-meta"><?php sos_posted_on(); ?></div>
		<div class="entry-content"><?php echo wp_strip_all_tags(get_the_excerpt()); ?></div>
	</article><!-- #post-<?php the_ID(); ?> -->
<?php
        endwhile;
    endif; wp_reset_query();

    $result = ob_get_clean(); 
    wp_send_json_success($result);
    die();
}




add_action( 'wp_ajax_loadPostWall', 'loadPostWall_init' );
add_action( 'wp_ajax_nopriv_loadPostWall', 'loadPostWall_init' );
function loadPostWall_init() {
 	ob_start();
 	$post_type = (isset($_POST['post_type']))?esc_attr($_POST['post_type']) : '';
    $posts_per_page = (isset($_POST['posts_per_page']))?esc_attr($_POST['posts_per_page']) : '';
    $offset = (isset($_POST['offset']))?esc_attr($_POST['offset']) : '';
    $args = array(
        'post_type'     => $post_type,
        'posts_per_page'=> $posts_per_page,
        'offset'	=> $offset,
        'orderby' 	=>'modified',
        'order'	=>	'ASC'
        
    );
    $query = new WP_Query($args);
    if($query->have_posts()):
        while($query->have_posts()):$query->the_post();
        	$post_type = get_field('post_type');

?>
<div class="the-wall-item">
    <a href="javascript:void(0)" data-id="<?php the_ID(); ?>" class="the-wall-img-popup"><?php echo get_thumb(get_the_ID(),'wall-thumb'); ?></a>
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
        endwhile;
    endif; wp_reset_query();

    $result = ob_get_clean(); 
    wp_send_json_success($result);
    die();
}



add_action( 'gform_after_submission', 'custom_action_after_apc', 10, 2 );
function custom_action_after_apc(){
	add_filter('body_class', 'my_plugin_body_class');
}
function my_plugin_body_class($classes) {
    $classes[] = 'gform-success';
    return $classes;
}

function arrayNested($arr_a,$arr_b) {
    $c=[];
    for ($i = 0; $i <= count($arr_a); $i++){
        if (isset($arr_a[$i])) {
            $c[] = $arr_a[$i];
        }
        if (isset($arr_b[$i])) {
            $c[] = $arr_b[$i];
        }
    }
    return $c;
}