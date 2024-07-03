$(document).ready(function () {
    var username = sessionStorage.getItem('username');
    var email = sessionStorage.getItem('email');
    var logged = sessionStorage.getItem('logged');
    console.log("LOG: " + username + email);

    if(logged == null || logged == false)
        location.replace('./index.php');

    $("#username-field").html("User: " + username);
    $("#email-field").html("Email: " + email);
});