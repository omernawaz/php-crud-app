function updateSession(user_id){

    $.ajax({
        type: "POST",
        url: "../../php/actions/get-user.php",
        data: {
            id: user_id
        },
        dataType: "json",
        success: function (response) {
            sessionStorage.removeItem('user');
            sessionStorage.setItem('user', JSON.stringify(response));
            location.replace("./dashboard.php");
        }
    });
}

$(document).ready(function () {


    var user = JSON.parse(sessionStorage.getItem('user'));

    $("#pfp-image-edit").attr("src", user['pfp_path']);
    $("#email").attr("value", user['email']);
    $("#uname").attr("value", user['name']);



    $("#edit-form").submit(function (e) { 
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append('id', user['id']);

        $.ajax({
            type: "POST",
            url: "../../php/actions/update-user.php",
            crossDomain: true,
            data: formData,
            dataType: "json",
            contentType: "multipart/form-data",
            processData: false,
            contentType: false,
            headers: {
              "Accept": "application/json"
            }
          }).done(function(response) {
                //console.log("Success");
                //console.log(response);

                updateSession(user['id']);
                
                $("#profile-card").show();
                $("#edit-profile-card").hide();

          }).fail(function(error) {
                var errorJSON = error.responseJSON;

                if(errorJSON['status'] == 'AuthError') {
                    $("#feedback-pwd").html(errorJSON['content']);
                }
                else if(errorJSON['status'] == 'FileError') {
                    $("#feedback-pfp").html(errorJSON['content']);
                }
                else {
                }
        });
        
    });

    

    

});