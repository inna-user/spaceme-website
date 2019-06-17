
(function ($) {
    "use strict";

     $( document ).ready(function() {
        $('#new_username').focus();
    });
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');
    var new_pass = "";

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                
                check=false;
            }
        }     
        return check;
    });


    function validate (input) {
        if($(input).attr('name') == 'new_username'){//check username 
            if($(input).val().length > 254){
                $('#wrong-new-username').text("Забагато символів. Max 254");
                $('#wrong-new-username').css('display', 'block');
                return false;
            }else if($(input).val().trim().match(/^([a-zA-ZА-Яа-яЁёЇїІіЄєҐґ0-9_\-\.]+){2,254}$/) == null){
                $('#wrong-new-username').text("Неправильний формат. Лише букви, цифри і символи: _ - . Не менше 2 символів");
                $('#wrong-new-username').css('display', 'block');
                return false;
            }else{
                $('#wrong-new-username').text("Нажаль це ім'я вже використовується");
                $('#wrong-new-username').css('display', 'none');
            }
        }

        if($(input).attr('name') == 'new_pass'){
            new_pass = $(input).val();
              if($(input).val().length > 100){
                $('#wrong-new-pass').text("Забагато символів. Max 100");
                $('#wrong-new-pass').css('display', 'block');
                return false;
            }else{
                $('#wrong-new-pass').text("Неправильний формат");
                $('#wrong-new-pass').css('display', 'none');
            }
        }

        if($(input).attr('name') == 'new_pass_confirm'){
            if($(input).val() !== new_pass){
                  $('#wrong-new-pass-confirm').css('display', 'block');
                  return false;
            }else{
                  $('#wrong-new-pass-confirm').css('display', 'none');
            }
        }  

        if($(input).attr('type') == 'email' || $(input).attr('name') == 'new_email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                $('#wrong-new-email').css('display', 'block');
                return false;
            }else{
                 $('#wrong-new-email').css('display', 'none');
            }
        }

        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    
})(jQuery);