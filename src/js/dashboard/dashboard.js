$(document).ready(function () {

    $("#edit-profile-card").hide();
    
    var user = JSON.parse(sessionStorage.getItem('user'));

    if(user == null)
        location.replace('./index.php');

    $("#btn-edit").click(function (e) { 
        e.preventDefault();
        $("#profile-card").hide();
        $("#edit-profile-card").show();
    });
});