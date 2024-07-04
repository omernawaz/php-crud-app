<?php include './inc/header.php' ?>
<?php include './inc/navbar.php' ?>

    <div class="container d-flex flex-column align-items-center p-5">
        <div class="card" id='profile-card' style="width:400px">
            <img class="card-img-top" id = 'pfp-image' src="./img/uploads/pfp_default.png" alt="Card image">

            <div class="card-body bg-dark text-white d-flex flex-column">
                <h4 class="card-title p-1" id ='username-field'>John Doe</h4>
                <p class="card-text p-1" id ='email-field'>Some example text.</p>
                <span class="badge bg-success m-3 admin-control">Admin</span>
                <button id='btn-edit' class="btn btn-danger m-3">Edit Profile</button>
            </div>

        </div>

        <div class="card" id='edit-profile-card' style="width:400px">
            <img class="card-img-top" id = 'pfp-image-edit' src="./img/uploads/pfp_default.png" alt="Card image">

            <div class="card-body bg-dark text-white d-flex flex-column">

                <form action="javascript:void(0)" method="POST" id="edit-form" enctype='multipart/form-data'>

                    <div class="mb-3 mt-3">
                        <label for="pfp" class="form-label">Change Profile Picture:</label>
                        <input id = 'pfp' type="file" name='pfp-file'>
                        <div class="invalid-feedback" id="feedback-pfp">Choose valid pfp!</div>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        <div class="invalid-feedback" id="feedback-email">Please enter an email!</div>
                    </div>

                    <div class="mb-3">
                        <label for="uname" class="form-label">Username:</label>
                        <input type="name" class="form-control" id="uname" placeholder="Enter username" name="uname">
                        <div class="invalid-feedback" id="feedback-uname">Please enter an username!</div>
                    </div>

                    <div class="mb-3">
                        <label for="new-pwd" class="form-label">Password(Leave Empty To Keep Old):</label>
                        <input type="password" class="form-control" id="new-pwd" placeholder="Enter password" name="new-pwd">
                        <div class="invalid-feedback" id="feedback-new-pwd">Please enter a password!</div>
                    </div>
                    
                    <br><hr><br>

                    <div class="mb-3">
                        <label for="pwd" class="form-label">Enter password to save:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                        <div class="invalid-feedback" id="feedback-pwd">Please enter a password!</div>
                    </div>

                    <button type = 'submit' id='btn-save' class="btn btn-danger m-3">Save Profile</button>
                </form>

            </div>

        </div>

    </div>

<script src = './js/dashboard/dashboard.js' defer></script>
<script src = './js/dashboard/dashboard-edit.js' defer></script>
<script src = './js/dashboard/populate-dashboard.js'></script>


<?php include './inc/footer.php'?>
