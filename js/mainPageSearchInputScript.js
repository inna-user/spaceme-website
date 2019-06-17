$( document ).ready(function() {
	/*$('#myInput').on('click', function () {
  		$('.search-input-list').css({"display": "block"});
	});
	$('#myInput').on('focusout', function () {
		$('.search-input-list').css({"display": "none"});
	});*/
	$("#myUL").on("click", "a", function(e){
	    e.preventDefault();
	    var $this = $(this).parent();
	    $this.addClass("select").siblings().removeClass("select");
	    $("#myInput").val($this.text());
	    hideSearchInput();
	});



	/*$('#city').on('click', function (){
		$('#myInput').val($('#city').text());
		hideSearchInput();
	});*/
	$(".card").click(function() {
		window.location = $(this).find("a").attr("href"); 
		return false;
	});

	var theDate=new Date();
	var year = theDate.getFullYear();
	$(".footer-year").text(year);
	
});

//for seach input
function searchInput() {
			    /*if($("#myInput").val()==""){  
			    	hideSearchInput();
			    	return;
			    }*/
			
	var searchElems = document.getElementsByClassName("search-input-list");
	for (var i=0;i<searchElems.length;i+=1){
  searchElems[i].style.display = 'block';
}
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}

function hideSearchInput(){
	var searchElems = document.getElementsByClassName("search-input-list");
	for (var i=0;i<searchElems.length;i+=1){
  searchElems[i].style.display = 'none';
}

	var ul = document.getElementById("myUL");
	var li = ul.getElementsByTagName('li');
	for (i = 0; i < li.length; i++) {
		 li[i].style.display = "none";
	}
	
}

$(function(){					
	var $win = $(window); // or $box parent container
	var $box = $(".search");
	var $log = $(".main-banner-content");
				
	$win.on("click.Bst", function(event){		
		if ( 
        $box.has(event.target).length == 0 //checks if descendants of $box was clicked
        && !$box.is(event.target) //checks if the $box itself was clicked
        ){
			//you clicked outside the search box
			hideSearchInput();
		} else {
			//you clicked inside the search box

			}
	});
});

/*$("#myInput").on('click', function(){
	var ul = document.getElementById("myUL");
	var li = ul.getElementsByTagName('li');
	for (i = 0; i < li.length; i++) {
		 li[i].on('click', function(){
		 	$("#myInput").value = li[i].val();
		 });
	}
});*/


 