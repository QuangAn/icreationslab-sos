function ajaxLoadPost(url, buttonId, loadingId, gridClass, post_type, cat_id, posts_per_page,template = '') {
    var i = 0;
    jQuery(buttonId).click(function() {
        i++;
        var action = "loadpost";
        if(post_type == 'the_wall'){
            action = "loadPostWall";
        }
        if(template == 'happening'){
            action = "loadPostHappening";
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

function ajaxPopup(el,post_type, loadingId, url) {
    jQuery( "body" ).on( "click", el, function() {
        var postId = jQuery(this).attr('data-id');
        jQuery.ajax({
            type: "post",
            url: url,
            data: {
                action: "loadPostPopup",
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
                        jQuery(loadingId).hide();
                        jQuery('#wall-popup').addClass('active').find('.popup-content').append(response.data);

                    } else {
                        jQuery(loadingId).hide();
                        jQuery('.overlay-popup').hide();
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
    jQuery('.close-popup,.overlay-popup').click(function(){
        jQuery('#wall-popup').removeClass('active').find('.popup-content').html('');
        jQuery('.overlay-popup').hide();
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