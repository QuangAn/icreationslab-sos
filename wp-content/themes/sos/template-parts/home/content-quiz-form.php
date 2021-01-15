<?php 
    $quiz = GFAPI::get_form(1);
    $fields = $quiz['fields'];
?>

<div class="quiz">
    <div class="block-title">
        <h2><?= $quiz['title'] ?></h2>
        <div class="sub-title"><?= $quiz['description'] ?></div>
    </div>
    <div class="block-content">
        <div class="process-bar"><span id="process-bar__current"></span></div>
        <div class="quiz-content">
           <?php gravity_form( 1, false, false, true, '', true ); ?>

        </div>
        <div class="action-quiz">
            <a href="javascript:void(0)" id="quiz-back">BACK</a>
            <a href="javascript:void(0)" id="quiz-next">NEXT</a>
        </div>
    </div>
</div>

<script>
    jQuery('document').ready(function(){
        quiz(jQuery('#gform_fields_1 >li').size());
    });
</script>