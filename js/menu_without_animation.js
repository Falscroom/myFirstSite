$(document).ready(function()
{
    var ac_content = $('#ac_content');
    //////////////////////////////////////////////////
    $(window).resize(function(){
        width = $(window).width();
        ac_content.css({width:width + 'px'});
    });
    /////////////////////////////////////////////////
    function Menu_Controller() {
        return {
            itemsShow : function(items) {
                return $.Deferred(
                    function(dfd) {
                        items.each(function(index,element) {
                            $(element).animate({bottom:0 +'px'},300,dfd.resolve);
                        })
                    }
                ).promise();
            },
            itemsHide : function(items) {
                return $.Deferred(
                    function(dfd) {
                        items.each(function(index,element) {
                            $(element).animate({bottom:-70+'px'},300,dfd.resolve);
                        })
                    }
                ).promise();
            },
            hideList : function(element) {
                return $.Deferred(
                    function(dfd) {
                        element.animate({height:0 + 'px'},600,dfd.resolve);
                    }
                ).promise();
            },
            showList : function(element) {
                var item = element.firstChild.nodeValue;
                var opened = null;
                $('.ac_subitem').find('h2').each(function(index,element) {
                    if(element.firstChild.nodeValue == item) {
                        var height = $(element).parent().height();
                        opened = $(element).parent().parent();
                        opened.animate({height:height + 'px'},600);
                    }
                });
                return opened;
            }
        }
    }
    ////////////////////////////////////////////////////////////////////
    var menu = Menu_Controller();
    var opened = null;
    ///////////////////////////////////////////////////////////////////
    function showElement() {
        var current = this;
        menu.itemsHide($('.menu_items')).done(function() {
            opened = menu.showList(current);
        });
    }
    function hideElement(current) {
        menu.hideList(current).done(
            function() {
                opened = null;
               menu.itemsShow($('.menu_items'));
            }
        );
    }
    ///////////////////////////////////////////////////////////////////
    $('.menu_items').filter('div').bind('click',showElement);
    $('.ac_close').bind('click',function() {if(opened) {hideElement(opened)}});
});