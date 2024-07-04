<nav class="navbar navbar-pills navbar-expand-sm bg-dark navbar-dark sticky-top">

    <div class="container-fluid justify-content-start">
        <a class="navbar-brand" href="#">
        <img src="../img/site/o-crud-logo.png" alt="Avatar Logo" style="width:40px;" class="rounded"> 
        </a>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link " href="#">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link admin-control" href="#">Edit Users</a>
            </li>
        </ul>
    </div>

    <div class="container-fluid justify-content-end text-white text-center">
        <p class = 'm-3
        ' id = 'user-greeting'></p>
        <button class='btn btn-danger' id='btn-logout'> Logout </button>
    </div>

    <script>

        $("#btn-logout").click(function (e) { 
        e.preventDefault();
        sessionStorage.removeItem('user');
        location.replace('./index.php');
    });

    </script>

</nav>