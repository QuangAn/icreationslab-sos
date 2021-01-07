function ajaxLoadPost(url, buttonId, loadingId, gridClass, post_type, cat_id, posts_per_page) {
    var i = 0;
    jQuery(buttonId).click(function() {
        i++;
        jQuery.ajax({
            type: "post",
            url: url,
            data: {
                action: "loadpost",
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

function sticky_menu(menu, sticky) {
    if (typeof sticky === 'undefined' || !jQuery.isNumeric(sticky)) sticky = 0;
    if (jQuery(window).scrollTop() >= sticky) {
        menu.addClass("sticky");
    } else {
        menu.removeClass("sticky");
    }
}