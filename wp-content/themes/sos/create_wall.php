<?php 

    if(isset($_POST['submit-share-home'])) {
        $post_title = wp_strip_all_tags($_POST['name']);
        $occupation = $_POST['occupation'];
        $post_content = $_POST['message'];
        $post_excerpt = $post_content;
        $wall = array(
          'post_title'    => $post_title,
          'post_content'  => $post_content,
          'post_excerpt'    =>  $post_excerpt,
          'post_status'   => 'publish',
          'post_author'   => 1,
          'post_date' => date('Y-m-d H:i:s'),
          'post_type'   =>  'the_wall'
        );
         
        // Insert the post into the database
        wp_insert_post( $wall );
    }
?>