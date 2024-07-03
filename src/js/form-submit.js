function validate_signup(email,name,pwd) {
    var val_url = "../php/validations/signup-validation.php";

    return $.ajax({
        type: "POST",
        url: val_url,
        data: {
            signup: true,
            email: email,
            username: name,
            password: pwd
        },
        dataType: "json",
    });
}

function validate_input_signup(email,name,pwd){

    if(email === ""){
        $("#email-s").addClass("is-invalid");
        $("#feedback-email-s").html("Please enter an email");
    } else if($("#email-s").hasClass("is-invalid")) {
        $("#email-s").removeClass("is-invalid");
    }

    if(name === ""){
        $("#uname").addClass("is-invalid");
        $("#feedback-uname-s").html("Please enter an username");
    } else if($("#uname").hasClass("is-invalid")) {
        $("#uname").removeClass("is-invalid");
    }

    if(pwd === ""){
        $("#pwd-s").addClass("is-invalid");
        $("#feedback-pwd-s").html("Please enter a password");
    } else if($("#pwd-s").hasClass("is-invalid")) {
        $("#pwd-s").removeClass("is-invalid");
    }

    if(email !== "" && name !== "" && pwd !== "")
        return true;
    else
        return false;
}

function validate_login(email,pwd){
    var val_url = "../php/validations/login-validation.php";
    
    return $.ajax({
        type: "POST",
        url: val_url,
        data: {
            login: true,
            email: email,
            password: pwd
        },
        dataType: "json",
    });
}

function validate_input_login(email,pwd){
    if(email === ""){
        $("#email").addClass("is-invalid");
        $("#feedback-email").html("Please enter an email");
    } else if($("#email").hasClass("is-invalid")) {
        $("#email").removeClass("is-invalid");
    }

    if(pwd === ""){
        $("#pwd").addClass("is-invalid");
        $("#feedback-pwd").html("Please enter a password");
    } else if($("#pwd").hasClass("is-invalid")) {
        $("#pwd").removeClass("is-invalid");
    }

    if(email !== "" && pwd !== "")
        return true;
    else
        return false;
}

function signup(email,name,pwd){
    return $.ajax({
        type: "POST",
        url: "../php/actions/signup.php",
        data: {
            signup: true,
            email: email,
            username: name,
            password: pwd
        },
        dataType: "json"
    });
}

function login(email){
    $.ajax({
        type: "POST",
        url: "../php/actions/login.php",
        data: {
            login: true,
            email: email,
        },
        dataType: "json",
        success: function(response ) {
            
            sessionStorage.setItem('logged', response['logged']);
            sessionStorage.setItem('id', response['id']);
            sessionStorage.setItem('email', response['email']);
            sessionStorage.setItem('username', response['username']);

            console.log("Login Success");
            location.replace('./dashboard.php');
        },
        error: function(err) {
            console.log("Login Error");
            console.log(err);
        }
    });
}

$(document).ready(function () {


    $("#signup-form").submit(function (e) { 
        e.preventDefault();

        var email = e.currentTarget[0].value;
        var name = e.currentTarget[1].value;
        var pwd = e.currentTarget[2].value;

        if(validate_input_signup(email,name,pwd)) {

            validate_signup(email,name,pwd).done(function (result) {

                if(!result['email']){
                    $("#email-s").addClass("is-invalid");
                    $("#feedback-email-s").html("An account already exists on this email!");
                } else {
                    $("#email-s").removeClass("is-invalid");
                }
                if(!result['name']){
                    $("#uname").addClass("is-invalid");
                    $("#feedback-uname-s").html("This username is already taken");
                } else {
                    $("#uname-s").removeClass("is-invalid");
                }

                if(result['email'] && result['name']){
                    signup(email,name,pwd).done(function(result) {
                        login(email);
                    }).fail(function(error) {
                        console.log(error);
                    });
                }

            }).fail(function(err) {
                console.log(err);
            });
        }
            
    });

    $("#login-form").submit(function (e) { 
        e.preventDefault();
        
        var email = e.currentTarget[0].value;
        var pwd = e.currentTarget[1].value;

        if(validate_input_login(email,pwd)){
            
            validate_login(email,pwd).done(function (result) {

                //console.log(result);

                if(!result['email']){
                    $("#email").addClass("is-invalid");
                    $("#feedback-email").html("No user exists on this email");
                } else {
                    $("#email").removeClass("is-invalid");
                }
                if(result['email'] && !result['password']){
                    $("#pwd").addClass("is-invalid");
                    $("#feedback-pwd").html("Incorrect Password");
                } else {
                    $("#pwd").removeClass("is-invalid");
                }

                if(result['email'] && result['password']){
                    login(email);
                }
                
            }).fail(function(error ) {
                console.log("Error");
                console.log(error);
            });
        }
    });
});