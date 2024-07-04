<?php include './inc/header.php'; ?>

    <div class="container-fluid p-5 my-5 text-white text-center" >
        <img src= "./img/site/o-crud-logo.png" class="img-thumbnail" width="200px" height="100px">
        <h2 class ="pt-5"> Welcome To O Crud </h2>
        
    </div>


    <div class="container d-flex flex-column align-items-center 
    text-white mt-4 p-5 rounded-4 w-25 border-0" style="background-image: url('./img//design/bg-gradient-black.jpg');">
        
        <h3 id = "form-header"> Log In Or Sign Up! </h3>

        <div class="btn-group w-75 p-4">
            <button type="button" class="btn btn-danger my-1" id='btn-login'>Log In</button>
            <button type="button" class="btn btn-danger my-1" id='btn-signup'>Sign Up</button>
        </div>

        <form action="javascript:void(0)" method="POST" id="login-form">
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                <div class="invalid-feedback" id="feedback-email">Please enter a password!</div>

            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                <div class="invalid-feedback" id="feedback-pwd">Please enter a password!</div>

            </div>
            <button type="submit" class="btn btn-danger">Submit</button>
        </form>  

        <form action="javascript:void(0)" method="POST" id="signup-form">
            <div class="mb-3 mt-3">
                <label for="email-s" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email-s" placeholder="Enter email" name="email">
                <div class="invalid-feedback" id="feedback-email-s">Please enter an email!</div>
            </div>
            <div class="mb-3">
                <label for="uname" class="form-label">Username:</label>
                <input type="name" class="form-control" id="uname" placeholder="Enter username" name="uname">
                <div class="invalid-feedback" id="feedback-uname-s">Please enter an username!</div>
            </div>
            <div class="mb-3">
                <label for="pwd-s" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pwd-s" placeholder="Enter password" name="pwd">
                <div class="invalid-feedback" id="feedback-pwd-s">Please enter a password!</div>
            </div>
            <button type="submit" class="btn btn-danger">Submit</button>
        </form>
        
    </div>

<script src = './js/index/index.js'></script>
<script src = './js/index/signup.js'></script>
<script src = './js/index/login.js'></script>
<?php include './inc/footer.php'?>
