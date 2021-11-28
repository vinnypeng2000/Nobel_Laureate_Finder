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

        <?php
            if($login_button == '') {
                echo '<div style="padding-left: 1%; padding-top:1%;">
                        <div class="card mb-3" style="max-width: 450px;">
                            <div class="row g-0">
                                <div class="col-md-4" style="padding: 0.1in;">
                                    <img src="'.$_SESSION["user_image"].'" 
                                    class="card-img-left example-card-img-responsive" />
                                </div>';
                echo        '<div class="col-md-8">
                                <div class="card-body">
                                    <h5>'.$_SESSION['user_first_name'].' '
                                    .$_SESSION['user_last_name'].'</h5>';
                echo                '<p class="card-text"><b>Email: </b> '
                                    .$_SESSION['user_email_address'].'</p>
                                </div>
                            </div>
                        </div>
                    </div>';
                
                include_once("./library.php"); // To connect to the database
                $con = new mysqli($server, $username, $password, $dbname);
                // Check connection
                if ($con->connect_error) {
                    die("Connection failed: " . $con->connect_error);
                }
                $email = $_SESSION['user_email_address'];
                $sql="SELECT id, name, time FROM user_comment NATURAL JOIN has NATURAL JOIN individual
                WHERE userEmail = '{$_SESSION['user_email_address']}'";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    echo "<table class='table'>
                            <center><caption style='caption-side:top; color:darkturquoise;'>
                            Individual</caption></center>
                            <tr>
                                <th scope='col'>Nobel ID</th>
                                <th scope='col'>Name</th>
                                <th scope='col'>Time</th>
                                <th scope='col'>Action</th>
                            </tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]." "."</td><td>"
                        .$row["time"]."</td><td>".
                        "<button type='button' class='btn btn-success'>View</button>
                        <button type='button' class='btn btn-danger'>Delete</button></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
                $con->close();
            }
            else {
                echo '<center><h1>You need to login first to see your profile!</h1></center>';
            }
        ?>

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