function validate_input_login(formData){

    let email = formData.get('email');
    let pwd = formData.get('pwd');

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



function login(formData){


    formData.append('login', true);
    let action_url = '../../php/actions/login.php';

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


$(document).ready(function () {


    

    $("#login-form").submit(function (e) { 
        e.preventDefault();
        
        let formData = new FormData(this);

        if(validate_input_login(formData)){
            
            login(formData).done(function (response) {

                console.log("OK");
                let user_id = response['id'];

                $.ajax({
                    type: "POST",
                    url: "../../php/actions/get-user.php",
                    data: {
                        id: user_id
                    },
                    dataType: "json",
                    success: function (response) {
                        sessionStorage.setItem('user', JSON.stringify(response));
                        location.replace("./dashboard.php");
                    }
                });
                
            }).fail(function(error ) {

                let response = error.responseJSON;
                console.log(error);
                if(!response['email']){
                    $("#email").addClass("is-invalid");
                    $("#feedback-email").html("No user exists on this email");
                } else {
                    $("#email").removeClass("is-invalid");
                }
                if(response['email'] && !response['password']){
                    $("#pwd").addClass("is-invalid");
                    $("#feedback-pwd").html("Incorrect Password");
                } else {
                    $("#pwd").removeClass("is-invalid");
                }
            });
        }
    });
});