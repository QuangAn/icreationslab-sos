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
                        console.log(response.data);
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
    jQuery('#searchform input#s').blur(function() {
        jQuery(this).removeClass('active');
        jQuery('#searchform').removeClass('active');
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
});