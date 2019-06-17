(function ($) {
    "use strict";
 
    $( document ).ready(function() {
    	setPanels(0);
    });

    $('#myInput').keypress(function(event){
	
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			alert('You pressed a "enter" key in textbox');	
			
			setPanels();
		}
	});
	$(".search-button").click(function(){
	  setPanels();
	});

	
	
    function setPanels(selectedCityId){
    	if(!selectedCityId){
    		var selectedCityId = $('#myUL').children('.select').find('a').attr('value');
    	}
    	
    	$.ajax({    //create an ajax request to get_coworking_panels.php
	        type: "GET",
	        url: "../php/get_coworking_panels.php",  
    		data: { cityName: selectedCityId },          
	        contentType: "text/html;charset=utf-8",
	        dataType: "html",   //expect html to be returned                
	        success: function(response){
	        	if(response == false){
	        		$("#includedContent").html("<div><h4>На жаль, немає результатів</h4></div>");
	        	}else{
	        		 $("#includedContent").html(response); 
	        	}                    
	        }
	      
	    });
    }



})(jQuery);

function goToArticle(elem){
	alert($(elem).find("a").attr("href"));
	  	window.location = $(elem).parent("div").find("a").attr("href"); 
  		
	  }
