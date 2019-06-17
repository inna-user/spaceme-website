(function ($) {
    "use strict";
 
    $( document ).ready(function() {
    	$.ajax({    //create an ajax request to get_city_options.php
	        type: "GET",
	        url: "../php/get_city_options.php",             
	        contentType: "text/html;charset=utf-8",
	        dataType: "html",   //expect html to be returned                
	        success: function(response){                    
	            $("#myUL").html(response); 
	            
	        }
	        
	    });
    });

})(jQuery);