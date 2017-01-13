(function ($) {
    'use strict';

    var oldMethod = $.datepicker._generateMonthYearHeader;
    $.datepicker._generateMonthYearHeader = function(){
        var html = $("<div />").html(oldMethod.apply(this,arguments));
        var monthselect = html.find(".ui-datepicker-month");
        monthselect.insertAfter(monthselect.next());
        return html.html();
    };

    $.datepicker.setDefaults({
	    changeMonth: true,
	    changeYear: true
	});

}(jQuery));

/**
 * Universal jQuery ajax settings
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function(xhr){
        
    },
    error : function(jqXHR, textStatus, errorThrown) {
        
    },
    complete: function(xhr, status) {
        
    }
});