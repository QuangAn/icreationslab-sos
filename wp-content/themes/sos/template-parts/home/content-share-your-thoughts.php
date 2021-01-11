<?php 
    if(isset($_POST['submit-share-home'])) {
        $post_title = wp_strip_all_tags($_POST['post_title']);
        $occupation = wp_strip_all_tags($_POST['occupation']);
        $post_content = $_POST['message'];
        $post_excerpt = excerpt('200', wp_strip_all_tags($post_content));
        $wall = array(
          'post_title'    => $post_title,
          'post_content'  => $post_content,
          'post_excerpt'    =>  $post_excerpt,
          'post_status'   => 'Pending',
          'post_author'   => 1,
          'post_date' => date('Y-m-d H:i:s'),
          'post_type'   =>  'the_wall'
        );
         
        // Insert the post into the database
       $wall_id =  wp_insert_post( $wall );
       update_field('occupation', $occupation, $wall_id);
    }
?>
<div class="share-your-thoughts">
    <div class="block-title">
        <h2>Share Your Thoughts</h2>
    </div>
    <div class="block-content">
        <form name="create_wall" action="./" method="POST">
            <div class="control input">
                <input type="text" name="post_title" placeholder="Name" required />
            </div>
            <div class="control input">
                <input type="text" name="occupation" placeholder="Occupation" required />
            </div>
            <div class="control textarea">
                <textarea name="message"placeholder="Message" required></textarea>
                <div class="max-input">Max 150 characters</div>
            </div>
            <div class="action">
                <button type="submit" name="submit-share-home" value="submit-share-home" id="submit-share-home">SUBMIT</button>
            </div>
        </form>
        <?php if($wall_id) { 
            echo '<div class="created_wall">Thank you for having created !</div>';
        } ?>
    </div>
</div>
<?php if($wall_id) {  ?>
<script>
   jQuery(document).ready(function(){
     jQuery('html, body').animate({
                scrollTop: jQuery(".share-your-thoughts").offset().top
    }, 500);
   });
</script>
<?php } ?>