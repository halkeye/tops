var firstClick = 1;
function clearAllOnFirstClick(){
    if (!firstClick) {
        return;
    }
    firstClick = 0;
    
    jQuery("#schedItemSelector td").each(function(a, obj){
        var className = jQuery(obj).attr('class');
        jQuery('.schedItem.' + className).addClass(className + 'Offline').removeClass(className);
    });
}

jQuery(document).ready(function(){
    jQuery("#schedItemSelector td").toggle(function(){
        clearAllOnFirstClick();
        var obj = jQuery(this);
        obj.addClass('selectedSchedButton');
        var className = obj.attr('class').replace(' selectedSchedButton', '');
        jQuery('.schedItem.' + className + 'Offline').removeClass(className + 'Offline').addClass(className);
    }, function(){
        var obj = jQuery(this);
        obj.removeClass('selectedSchedButton');
        var className = obj.attr('class').replace(' selectedSchedButton', '');
        jQuery('.schedItem.' + className).addClass(className + 'Offline').removeClass(className);
    });
    
});
