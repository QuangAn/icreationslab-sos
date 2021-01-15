function ajaxLoadPost(url, buttonId, loadingId, gridClass, post_type, cat_id, posts_per_page, template = '') {
    var i = 0;
    jQuery(buttonId).click(function() {
        i++;
        var action = "loadpost";
        if (post_type == 'the_wall') {
            action = "loadPostWall";
        }
        if (template == 'happening') {
            action = "loadPostHappening";
        }
        if (template == 'memories') {
            action = "loadpostMemories";
        }

        jQuery.ajax({
            type: "post",
            url: url,
            data: {
                action: action,
                post_type: post_type,
                cat_id: cat_id,
                posts_per_page: posts_per_page,
                offset: i * posts_per_page
            },
            context: this,
            beforeSend: function() {
                jQuery(loadingId).show();
            },
            success: function(response) {

                if (response.success) {
                    if (response.data) {
                        jQuery(response.data).appendTo(gridClass);
                        jQuery(loadingId).hide();
                    } else {
                        jQuery(loadingId).hide();
                        jQuery(buttonId).hide();
                    }

                } else {
                    console.log('err');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {

                console.log('The following error occured: ' + textStatus, errorThrown);
            }
        });
        return false;
    });
}

function ajaxPopup(el, post_type, loadingId, url, parentEl = '.popup-sos', template = '') {
    jQuery("body").on("click", el, function() {
        var postId = jQuery(this).attr('data-id');
        var action = "loadPostPopup";

        if (template == 'memories') {
            action = "loadPostPopupMemories";
        }

        jQuery.ajax({
            type: "post",
            url: url,
            data: {
                action: action,
                post_type: post_type,
                postId: postId,
            },
            context: this,
            beforeSend: function() {
                jQuery(loadingId).show();
                jQuery('.overlay-popup').show();
            },
            success: function(response) {

                if (response.success) {
                    if (response.data) {
                        jQuery(parentEl).addClass('active').find('.popup-inner').append(response.data);
                        jQuery(loadingId).hide();
                    } else {
                        jQuery(loadingId).hide();
                    }

                } else {
                    console.log('err');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {

                console.log('The following error occured: ' + textStatus, errorThrown);
            }
        });
        return false;
    });
    jQuery('#close-popup,.overlay-popup').click(function() {
        jQuery(parentEl).removeClass('active').find('.popup-inner').html('');
        jQuery(loadingId).hide();
    });

}

function sticky_menu(menu, sticky) {
    if (typeof sticky === 'undefined' || !jQuery.isNumeric(sticky)) sticky = 0;
    if (jQuery(window).scrollTop() >= sticky) {
        menu.addClass("sticky");
    } else {
        menu.removeClass("sticky");
    }
}

function scrollToHash(url, self) {
    if (url) var hash = url.substring(url.indexOf('#'));
    else var hash = window.location.hash;
    jQuery('ul.sub-menu li').removeClass('current-menu-item');
    jQuery(self).parent().addClass('current-menu-item');
    if (hash) {
        var scrollTop = jQuery(hash).offset().top;
        jQuery('body,html').animate({ scrollTop: (scrollTop - 25) }, 1000);
        jQuery("a[href$='" + hash + "']").parent().addClass('current-menu-item');
    }
}

function processBar(quiz, $count) {
    jQuery('.gfield:nth-child(' + quiz + ') input[type=radio]').click(function() {
        val_input = jQuery('.gfield:nth-child(' + quiz + ') input[type=radio]:checked').val();

        if (val_input) {
            current_bar = (quiz / $count) * 100;
            jQuery('#process-bar__current').css("width", current_bar + '%');
        }
    });
}

function quiz($count = 3) {
    var quiz = 1;
    var current_bar = 1;
    processBar(quiz, $count);

    jQuery('#quiz-next').click(function() {
        val_input = jQuery('.gfield:nth-child(' + quiz + ') input[type=radio]:checked').val();

        if (val_input) {
            if (quiz < $count) {
                jQuery('.gfield:nth-child(' + quiz + ')').hide();
                quiz += 1;
                jQuery('.gfield:nth-child(' + quiz + ')').show();
                val_input = jQuery('.gfield:nth-child(' + quiz + ') input[type=radio]:checked').val();

                if (val_input) {
                    current_bar = (quiz / $count) * 100;
                    jQuery('#process-bar__current').css("width", current_bar + '%');
                }
            }
            if (quiz == $count) {
                val_input = jQuery('.gfield:nth-child(' + quiz + ') input[type=radio]:checked').val();
                if (val_input) {
                    current_bar = ((quiz) / $count) * 100;
                    jQuery('#process-bar__current').css("width", current_bar + '%');
                    jQuery('#gform_submit_button_1').trigger('click');
                }
            }

        } else {

        }

        processBar(quiz, $count);
    });
    jQuery('#quiz-back').click(function() {
        if (quiz > 1) {
            jQuery('.gfield:nth-child(' + quiz + ')').hide();
            quiz -= 1;
            jQuery('.gfield:nth-child(' + quiz + ')').show();
        }
        current_bar = (quiz / $count) * 100;
        jQuery('#process-bar__current').css("width", current_bar + '%');
    });
    jQuery(document).on('gform_confirmation_loaded', function(event, formId) {
        jQuery("body").addClass('gform-success');
        var quiz_score = jQuery('#quiz_score').text();
        var quiz_text = '';
        if (quiz_score == 0) quiz_text = 'E';
        if (quiz_score == 1 || quiz_score == 2) quiz_text = 'D';
        if (quiz_score == 3 || quiz_score == 4) quiz_text = 'C';
        if (quiz_score == 5 || quiz_score == 6) quiz_text = 'B';
        if (quiz_score == 7 || quiz_score == 8) quiz_text = 'A SOS seafarer';
        if (quiz_score == 9 || quiz_score == 10) quiz_text = 'A+ SOS seafarer';
        jQuery('#quiz_score').text(quiz_text);
    });
}
jQuery(document).ready(function() {
    var menu = jQuery("header#masthead");
    if (menu.length) {
        var sticky = menu.offset().top + 1;
        sticky_menu(menu, sticky);
        jQuery(window).on('scroll', function() {
            sticky_menu(menu, sticky);
        });
    }

    jQuery('#searchsubmit').click(function() {
        jQuery('#searchform input#s').toggleClass('active');
        jQuery('#searchform').toggleClass('active');

    });
    jQuery('body').click(function(e) {
        if (jQuery(e.target).closest("#searchform input#s,#searchsubmit").length === 0) {
            jQuery('#searchform input#s').removeClass('active');
            jQuery('#searchform').removeClass('active');
        }

    });


    jQuery('#menu-toggle').click(function() {
        jQuery('#site-navigation').toggleClass('toggled');
    })

    jQuery('#quiz-link').click(function() {
        jQuery('html, body').animate({
            scrollTop: jQuery(".quiz").offset().top
        }, 500);
    });

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
    scrollToHash();
    jQuery('ul.sub-menu a').click(function() {
        var url = jQuery(this).attr('href');
        scrollToHash(url, this);
    });
});