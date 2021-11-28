<html>
    <head>
        <title>Nobel Luareate Finder</title>
        <?php
        include('config.php');
        ?>
    </head>

    <body>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="./home.php" style="color:#9370DB">Nobel Luareate Finder</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./search.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./filter.php">Filter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./profile.php">Profile</a>
                </li>
            </ul>
                <?php
                if($login_button == '') {
                    echo '<div style="padding-right: 0.1in">Welcome: '.$_SESSION['user_first_name'].'</div>';
                    echo '<a href="logout.php"><img src="./media/google-logout.png" height="40" /></a>';
                }
                else {
                    echo $login_button;
                }
                ?>
            </div>
            </div>
        </nav>

        <h1>This is the search page!</h1>

        <div style="position: fixed; bottom: 0%; width: 100%;">
            <footer class="text-center bg-light">
                <div class="text-center p-2" style="font-size: 14; background-color: rgba(0, 0, 0, 0.05);">
                    &copy 2021 Copyright: Student Project for CS 4750: Database Systems. 
                University of Virginia.
                </div>
            </footer>
        </div>

    </body>
</html>