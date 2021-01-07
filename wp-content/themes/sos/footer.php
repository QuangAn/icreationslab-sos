<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sos
 */

?>

  <footer class="footer-content">
      <div class="footer-logo">
          <a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer-logo.png" alt="" /></a>
      </div>
      <div class="social-footer">
          <h3 class="social-title">FOLLOW US</h3>
          <div class="social-footer__content">
              <a href="#"><span>FACEBOOK</span></a>
              <a href="#"><span>INSTAGRAM</span></a>
          </div>
      </div>
      <nav id="footer-navigation">
      
      <?php
      wp_nav_menu(
        array(
          'theme_location' => 'menu-2',
          'menu_id'        => 'footer-menu',
        )
      );
      ?>
    </nav><!-- #site-navigation -->
      <div class="copy-right">
          <span>COPYRIGHT @ 2020 SINGAPORE ORGANISATION OF SEAMEN. ALL RIGHTS RESERVED. </span>
          <a href=#>WEB DESIGN BY ICEATIONSLAB</a>
      </div>
  </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
<div id="back_top"></div>
<script>
  jQuery(document).ready(function(){
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 300) {
            jQuery('#back_top').fadeIn();
        } else {
            jQuery('#back_top').fadeOut();
        }
    });
    jQuery('#back_top').click(function() {
      jQuery('body,html').animate({ scrollTop: 0 }, 1000);
    });
  });
</script>
</body>
</html>
