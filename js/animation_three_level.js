/**
 * Created by Falscroom on 25.12.14.
 */
function showList() {
    var current = $(this).parents('.ac_subitem_level_three');
    var our_item = current.find('.ac_under_subitem');
    var parent = current.parents('.ac_subitem').parent();

    if(our_item.css('display')== 'none') {
        our_item.css({display:'block'});
        parent = current.parents('.ac_subitem').parent();
        parent.css({height:parent.height() + our_item.height()})
    }
    else {
        if(our_item.height() > 0) {
        our_item.css({display:'none'});
        parent = current.parents('.ac_subitem').parent();
        parent.css({height:parent.height() - our_item.height() + 10}); // Проставляет между пунктами margin при открытии :\ костыль богу костылей
    }
    }
}
function hideAll() {
    // Это не баг, а фича!
}
$(document).ready(function() {
    $('.ac_subitem_level_three > li > span').bind('click',showList);
    $('.ac_close').bind('click',hideAll);
});