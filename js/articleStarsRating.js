(function ($) {
    "use strict";
    var id = 0;
    var clicked = 0;
    var alreadyClicked = 0;
    $( document ).ready(function() {
        $("#score").find("span").each(function() {
        if($(this).hasClass("checked")){
            id = "#" + $(this).attr('id');
        }
    });
    });

    $('.fa.fa-star').hover(
    // Handles the mouseover
        function() {
            $(this).prevAll().addClass('checked');
            $(this).addClass('checked');
            $(this).nextAll().removeClass('checked'); 
        },
        // Handles the mouseout
        function() {
            if(clicked != 0){
                $(clicked).prevAll().addClass('checked');
                $(clicked).addClass('checked');
                $(clicked).nextAll().removeClass('checked');
                id = clicked;
                clicked = 0;     
            }else{
                $(id).prevAll().addClass('checked');
                $(id).addClass('checked');
                $(id).nextAll().removeClass('checked');
               

            }             
        }
    );

    $('.fa.fa-star').click(function(){
        if(alreadyClicked){
            clicked=0;
            alert("Ви вже поставили оцінку!");
            return;
        }
        alreadyClicked = 1;
        clicked = "#" + $(this).attr('id');  
        var starsCount = clicked.substring(clicked.indexOf('-')+1, clicked.length);
        updateStarsRating(starsCount);  
        });

    function updateStarsRating(starsCount){
        var articleId = getArticleIdParams();
        $.ajax({    //create an ajax request to get_city_options.php
            type: "GET",
            url: "../php/set_article_rating.php", 
            data: { id: articleId, starsCount: starsCount},                  
            contentType: "text/html;charset=utf-8",
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#rating").html(response); 
                
            }
            
        });
    }

    function getArticleIdParams(){
        $.urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results==null) {
               return null;
            }
            return decodeURI(results[1]) || 0;
        }
        id = decodeURIComponent($.urlParam('id'));
        if(id){
            return id;
        }else{
            return 1;
        }
    }

})(jQuery);
