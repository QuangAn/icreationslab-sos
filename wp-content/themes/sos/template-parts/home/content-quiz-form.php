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
           <?php gravity_form( 1, false, false, false, '', false ); ?>
        </div>
        <div class="action-quiz">
            <a href="javascript:void(0)" id="quiz-back">BACK</a>
            <a href="javascript:void(0)" id="quiz-next">NEXT</a>
        </div>
    </div>
</div>

<script>
    function processBar(quiz, $count){
        jQuery('.gfield:nth-child('+ quiz +') input[type=radio]').click(function(){
            val_input = jQuery('.gfield:nth-child('+ quiz +') input[type=radio]:checked').val();
            if(val_input){
                current_bar = (quiz / $count) * 100;
                jQuery('#process-bar__current').css("width", current_bar + '%');
            }
        });
    }
    function quiz($count = 3){
        var quiz = 1;
        var current_bar = 1;
        processBar(quiz, $count);
        
        jQuery('#quiz-next').click(function(){
            val_input = jQuery('.gfield:nth-child('+ quiz +') input[type=radio]:checked').val();

            if(val_input){
                if(quiz < $count){
                    jQuery('.gfield:nth-child('+ quiz +')').hide();
                    quiz += 1;
                    jQuery('.gfield:nth-child('+ quiz +')').show();
                }
                if(quiz == $count){
                    val_input = jQuery('.gfield:nth-child('+ quiz +') input[type=radio]:checked').val();
                    if(val_input){
                        current_bar = ((quiz) / $count) * 100;
                        jQuery('#process-bar__current').css("width", current_bar + '%');
                        jQuery('#gform_submit_button_1').trigger('click');
                    }
                }
                
            }else{

            }

            processBar(quiz, $count);
        });
        jQuery('#quiz-back').click(function(){
            if(quiz > 1){
                jQuery('.gfield:nth-child('+ quiz +')').hide();
                quiz -= 1;
                jQuery('.gfield:nth-child('+ quiz +')').show();
            }
            current_bar = ((quiz) / $count) * 100;
            jQuery('#process-bar__current').css("width", current_bar + '%');
        });
    }
    jQuery('document').ready(function(){
        quiz(3);
    });
</script>