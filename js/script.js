function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

$( document ).ready(function() {
	$(document).scrollTop(0);
	set_login_btn();

	//all for hamburger button on nav bar
	$('[class^="hamburger hamburger--collapse"]').click(function(){
		if($(this).hasClass('is-active')){
			$(this).removeClass("is-active");
			$('#menu').css({"height": "70px"});
			$('.falling-out-bar').css({"display": "none"});
		}
		else{
			 $(this).addClass("is-active");
			 $('#menu').css({"height": "auto"});
			 $('#container').css({"margin-top": "80px"});
			 $('.falling-out-bar').css({"height": "auto", "display": "block"});
		}
			
	});
	$( window ).resize(function() {
		if($('[class^="hamburger hamburger--collapse"]').hasClass('is-active')){
			$('[class^="hamburger hamburger--collapse"]').click();
		}
	});
	
	$( '.navbar-nav a' ).on( 'click', function () {
	$( '.navbar-nav' ).find( 'li.active' ).removeClass( 'active' );
	$( this ).parent( 'li' ).addClass( 'active' );
});


});


function set_login_btn(){
	is_login();

}
function is_login(){
	var UIDSession;
	$.ajax({    //create an ajax request to get_city_options.php
	    type: "GET",
	    url: "../php/check_login.php",                 
	    contentType: "text/html;charset=utf-8",
	    dataType: "html",   //expect html to be returned    
                  
	    success: function(response){     
	         UIDSession = response;   
	         if(parseInt(UIDSession)){

				$('.nav-login').html("<li class='nav-item'><a class='btn btn-outline-primary' href='#' onClick='logout();'>Вихід</a></li>");
	         	}else{
				$('.nav-login').html("<li class='nav-item'><a class='btn btn-outline-primary' href='./login_form.php'>Вхід</a></li>");
				
			}  
			
			    }
	});

}

function logout(){
	$.ajax({    //create an ajax request to get_city_options.php
	    type: "GET",
	    url: "../php/logout.php",                 
	    contentType: "text/html;charset=utf-8",
	    dataType: "html",   //expect html to be returned    
                  
	    success: function(response){     
	        alert(response);   
	        $('.nav-login').html("<li class='nav-item'><a class='btn btn-outline-primary' href='./login_form.php'>Вхід</a></li>");
	        location.reload();
		}
	});
}



	
	

