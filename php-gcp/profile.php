<html>
    <head>
        <title>Nobel Laureate Finder</title>
        <?php
        include_once("./library.php"); // To connect to the database
        ?>
    </head>

    <body>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="./home.php" style="color:#9370DB">Nobel Laureate Finder</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./profile.php">Profile</a>
                </li>
                <?php
                if($username=="root")
                echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='./addPub.php'>Add Publication</a>
                    </li>
                ";
                ?>
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
                
                    if( in_array($_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1'))){
                        $con = new mysqli($server, $username, $password, $dbname);
                    }else{
                        $con = new mysqli(null, $username, $password, $dbname, null, '/cloudsql/nobel-laureate-finder-332817:us-east4:nobel-laureate-finder');
                    }
                // Check connection
                if ($con->connect_error) {
                    die("Connection failed: " . $con->connect_error);
                }
                $email = $_SESSION['user_email_address'];
                $sql1="SELECT id, name, time, content FROM user_comment NATURAL JOIN has NATURAL JOIN individual
                WHERE userEmail = '{$_SESSION['user_email_address']}'";
                $result1 = $con->query($sql1);
                if ($result1->num_rows > 0) {
                    echo "<table class='table'>
                            <caption style='caption-side:top; color:darkturquoise;'>
                            Comments - Individual</caption>
                            <tr>
                            <th scope='col' width='5%'>Nobel ID</th>
                            <th scope='col' width='20%'>Name</th>
                            <th scope='col' width='20%'>Time</th>
                            <th scope='col' width='35%'>Content</th>
                            <th scope='col' width='20%'>Action</th>
                            </tr>";
                    while($row = $result1->fetch_assoc()) {
                        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]." "."</td><td>"
                        .$row["time"]."</td><td>".$row["content"]."</td><td>".
                        "<a href='detail.php?id=".$row['id']."' class='btn btn-success'>View</a>
                        <a href='profileAction.php?edEmail=".$_SESSION['user_email_address']
                        ."&time=".$row['time']."' class='btn btn-warning'>Edit</a>
                        <a href='profileAction.php?delEmail=".$_SESSION['user_email_address']
                        ."&time=".$row['time']."' class='btn btn-danger'>
                        Delete</a></td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p style='color:darkturquoise;'>
                    Comments - Individual</p>";
                    echo "0 results";
                }

                $sql2="SELECT id, name, time, content FROM user_comment NATURAL JOIN has NATURAL JOIN
                awarded_organization WHERE userEmail = '{$_SESSION['user_email_address']}'";
                $result2 = $con->query($sql2);
                if ($result2->num_rows > 0) {
                    echo "<table class='table'>
                            <caption style='caption-side:top; color:darkturquoise;'>
                            Comments - Organization</caption>
                            <tr>
                            <th scope='col' width='5%'>Nobel ID</th>
                            <th scope='col' width='20%'>Organization Name</th>
                            <th scope='col' width='20%'>Time</th>
                            <th scope='col' width='35%'>Content</th>
                            <th scope='col' width='20%'>Action</th>
                            </tr>";
                    while($row = $result2->fetch_assoc()) {
                        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]." "."</td><td>"
                        .$row["time"]."</td><td>".$row["content"]."</td><td>".
                        "<a href='detail.php?id=".$row['id']."' class='btn btn-success'>View</a>
                        <a href='profileAction.php?edEmail=".$_SESSION['user_email_address']
                        ."&time=".$row['time']."' class='btn btn-warning'>Edit</a>
                        <a href='profileAction.php?delEmail=".$_SESSION['user_email_address']
                        ."&time=".$row['time']."' class='btn btn-danger'>
                        Delete</a></td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p style='color:darkturquoise;'>
                    Comments - Organization</p>";
                    echo "0 results";
                }

                
                mysqli_free_result($result1);
                mysqli_free_result($result2);
                $con->close();
            }
            else {
                echo '<center><h1>You need to login first to see your profile!</h1></center><br><br>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
            }
        ?>

        <div style="position: relative; bottom: 0%; width: 100%;">
            <footer class="text-center bg-light">
                <div class="text-center p-2" style="font-size: 14; background-color: rgba(0, 0, 0, 0.05);">
                    &copy 2021 Copyright: Student Project for CS 4750: Database Systems. 
                University of Virginia.
                </div>
            </footer>
        </div>

    </body>
</html>