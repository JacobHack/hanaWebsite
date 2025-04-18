/*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 * 
 */
function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function(){
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast',function(){
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Register with');
    }); 
    $('.error').removeClass('alert alert-danger').html('');
}

function showLoginForm(){
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Login with');
    });       
    $('.error').removeClass('alert alert-danger').html(''); 
}

function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}

function loginAjax(){
    
    /*$.post( "/login", function( data ) {
            if(data != ""){
                window.location.replace("/home.html");            
            } else {
                shakeModal(); 
            }
    });*/ 
    /*
    var username = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    $.get( "login_register_modal.html", function( data ) {
        
        if(username == "1" && password == "1"){
            window.location.replace("/home.html");
        } else {
            shakeModal();
        } 
    });*/
   
    if (email != "" && password != "") {
        window.location.replace("/hanaWebsite/home.html");
    } else {
        shakeModal();
    }
    

/*   Simulate error message from the server   */
    //shakeModal();
    //window.location.replace(window.location.origin + "/home.html");
}

function shakeModal(){
    $('#loginModal .modal-dialog').addClass('shake');
            $('.error').addClass('alert alert-danger').html("Invalid email/password combination");
            $('input[type="password"]').val('');
            setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}

