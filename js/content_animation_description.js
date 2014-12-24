$(document).ready(function() {
    function ShowIt() {
        var current = $(this).parent().find('.description');
        current.stop().animate({opacity:1},600);
        current.css({zIndex:1});
    }
    function HideIt() {
        var current = $(this).parent();
        current.stop().animate({opacity:0},600);
        setTimeout(function() {current.css({zIndex:'-1'});},600)

    }
    $('.horizontal_line').bind('click',ShowIt);
    $('.close_description').bind('click',HideIt);


});
