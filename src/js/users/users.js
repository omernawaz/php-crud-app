
function deleteUser(user_id){
    $.ajax({
        type: "POST",
        url: "../../php/actions/delete-user.php",
        data: {
            id : user_id
        },
        dataType: "json",
        success: function (response) {
            location.replace('./users.php');
            console.log(response);
        },
        error: function (response) {
            console.log(response);
        }
    });
}

function makeAdmin(user_id){
    $.ajax({
        type: "POST",
        url: "../../php/actions/make-admin.php",
        data: {
            id : user_id
        },
        dataType: "json",
        success: function (response) {
            location.replace('./users.php');
            console.log(response);
        },
        error: function (response) {
            console.log(response);
        }
    });
}

$(document).ready(function () {
    
      displayUsers();
});