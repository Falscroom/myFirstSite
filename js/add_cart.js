function do_it() {
    var id = $(this).parents('.down_line').siblings('.input_id')[0].value;
    $.ajax({
        type: "POST",
        url: "/myFirstSite/content/add/"+id+"",
        data: {I:id},
        success: function(msg) {
            alert('Спасеба за заказ');
        }
    });
}


$(document).ready(function(){
        $('.buy').bind('click',do_it);
});