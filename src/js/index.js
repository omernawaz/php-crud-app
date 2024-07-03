$(document).ready(function () {
    var logged = sessionStorage.getItem('logged');

    console.log(logged);

    if(logged != null)
        location.replace('./dashboard.php');
});