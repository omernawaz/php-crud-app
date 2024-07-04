$(document).ready(function () {

    $(".admin-control").hide();

    var user = JSON.parse(sessionStorage.getItem('user'));

    $("#username-field").html("User: " + user['name']);
    $("#email-field").html("Email: " + user['email']);

    $("#user-greeting").html("Welcome, " + user['name'] + '!');


    if(user['is_admin'] == 1)
        $(".admin-control").show();

    $("#pfp-image").attr("src", user['pfp_path']);

    let html = `
        <div class="container-fluid justify-content-end text-white text-center">
        <p class = 'm-3' id = 'user-greeting'></p>
        <button class='btn btn-danger' id='btn-logout'> Logout </button>
        </div>
    `
    $(".navbar").append(html);
    
});