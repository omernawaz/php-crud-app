function validate_input_signup(formData){

    let email = formData.get('email');
    let name = formData.get('uname');
    let pwd = formData.get('pwd');


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

function signup(formData){

    formData.append('action', 'signup');
    let action_url = '../../php/actions/user-action.php';

    return $.ajax({
        type: "POST",
        url: action_url,
        crossDomain: true,
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
          "Accept": "application/json"
        }
      })
}

function displayError_S(error){

    let response = error.responseJSON;
    console.log(error);

    if(!response['email']){
        $("#email-s").addClass("is-invalid");
        $("#feedback-email-s").html("Email Is Already Taken!");
    } else {
        $("#email-s").removeClass("is-invalid");
    }

    if(!response['name']){
        $("#uname").addClass("is-invalid");
        $("#feedback-uname-s").html("Username Is Already Taken!");
    } else {
        $("#uname").removeClass("is-invalid");
    }
}

$(document).ready(function () {
    $("#signup-form").submit(function (e) { 
        e.preventDefault();

        formData = new FormData(this);

        if(validate_input_signup(formData)) {

            signup(formData).done(function (response) {

                sessionStorage.setItem('user', JSON.stringify(response));
                location.replace("./dashboard.php");

            }).fail(function (error) {
                displayError_S(error);
            });
        }
            
    });
});