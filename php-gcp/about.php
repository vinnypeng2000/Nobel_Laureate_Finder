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

        <div style="padding-left: 0.1in; padding-top: 0.1in;">
            <h1 style="color:darkturquoise;">About Nobel Finder</h1>
        </div>
        <div class="col-sm-12" style="padding-left: 1%; padding-right: 1%;">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">CS 4750 - Fall 2021</h5>
                <p class="card-text">This web application is created by 4 undergraduate students for 
                    CS 4750: Database Systems in fall 2021. It is a final course project that 
                    integrates SQL with PHP, bootstrap, and Google Cloud Platform. The software allows 
                    users to search for specific nobel luareates, filter through them based on 
                    parameters, add new publications, and post reviews for them. If you want to learn 
                    more about us, please refer to our personal links below.
                </p>
                <a href="https://storage.googleapis.com/cs4750f21/syllabus.html" class="card-link">
                    About this course</a>
                </div>
            </div>
        </div>

        <div style="padding-left: 0.1in; padding-top: 0.1in;">
        <h1 style="color:darkturquoise;">Team</h1>
        </div>
        <div class="container-fluid"><div class="row">
        <div class="col-sm-3">
            <div class="card" style="width: 18rem; height: 13rem;">
                <div class="card-body">
                <h5 class="card-title">Vinny Peng</h5>
                <h6 class="card-subtitle mb-2 text-muted">Third-Year CS + History</h6>
                <p class="card-text">Hello, I am interested in software development, game
                    development, AI, HCI, etc.
                </p>
                <a href="https://github.com/vinnypeng2000" class="card-link">GitHub</a>
                <a href="https://www.linkedin.com/in/vinnypeng1116/" class="card-link">LinkedIn</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="width: 18rem; height: 13rem;">
                <div class="card-body">
                <h5 class="card-title">Haowen Xu</h5>
                <h6 class="card-subtitle mb-2 text-muted">Third-Year CS + Econ</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">GitHub</a>
                <a href="#" class="card-link">LinkedIn</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="width: 18rem; height: 13rem;">
                <div class="card-body">
                <h5 class="card-title">Tianyang Chen</h5>
                <h6 class="card-subtitle mb-2 text-muted">Third-Year CS + ???</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">GitHub</a>
                <a href="#" class="card-link">LinkedIn</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title">Haotian Ren</h5>
                <h6 class="card-subtitle mb-2 text-muted">Third-Year CPE + ???</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">GitHub</a>
                <a href="#" class="card-link">LinkedIn</a>
                </div>
            </div>
        </div>
        </div></div>

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