<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sos
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'sos' ); ?></a>

	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="main-navigation">
			
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
		<button id="menu-toggle" >Menu</button>
		<div id="top-search">
			<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
				<button type="button" id="searchsubmit">
					<span></span>
					<span></span>
				</button>
			    <input type="text" value="" name="s" id="s" placeholder="Search..." />
			</form>
		</div>
		<?php if ( is_home() || is_front_page() ) { ?>
		<div id="quiz-link">
			<a href="javascript:void(0)">Quiz</a>
		</div>
		<?php } ?>
	</header><!-- #masthead -->
