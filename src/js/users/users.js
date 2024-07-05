
function deleteUser(user_id){
    $.ajax({
        type: "POST",
        url: "../../php/actions/user-aciton.php",
        data: {
            action: 'delete',
            id : user_id
        },
        dataType: "json",
        success: function (response) {
            clearUsers();
            displayUsers();
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
        url: "../../php/actions/user-action.php",
        data: {
            action: 'make-admin',
            id : user_id
        },
        dataType: "json",
        success: function (response) {
            clearUsers();
            displayUsers();
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