$(document).ready(function () {
    $("#signup-form").hide();

    $("#btn-login").click(function (e) { 
        $("#form-header").html("Log In!");
        $("#signup-form").hide();
        $("#login-form").show();
    });

    $("#btn-signup").click(function (e) { 
        $("#form-header").html("Sign Up!");
        $("#signup-form").show();
        $("#login-form").hide();
    });

});