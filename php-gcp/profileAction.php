<html>
    <head>
        <title>Nobel Luareate Finder</title>
        <?php
        include_once("./library.php"); // To connect to the database
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
        $con = new mysqli($server, $username, $password, $dbname);
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }   

        date_default_timezone_set('America/New_York');
        $date = date('Y-m-d H:i:s', time());

        if (isset($_GET['delEmail'])) {
            $email = $_GET['delEmail'];
            $time = $_GET['time'];
            $sql = "DELETE FROM has WHERE userEmail='{$email}' AND time='{$time}'";
            $sql1 = "DELETE FROM user_comment WHERE userEmail='{$email}' AND time='{$time}'";
            if (!mysqli_query($con,$sql)) {
                die('Error: ' . mysqli_error($con));
            }
            if (!mysqli_query($con,$sql1)) {
                die('Error: ' . mysqli_error($con));
            }
            echo "<center><h2>Successfully Deleted Comment</h2></center>";
            echo "<center><a href='./profile.php' class='btn btn-success'>Back To Profile</a></center>";
            echo "<br>";
            mysqli_close($con);
        }

        if (isset($_GET['edEmail'])) {
            $email = $_GET['edEmail'];
            $time = $_GET['time'];
            echo "<center><h2>Edit Your Comment</h2></center>";
            echo "
            <form action='' method='post' style='padding: 0.2in'>
                <textarea class='xlarge col-md-6 offset-md-3' 
                    name='newComment' rows=5 planceholder='fk'>
                </textarea>
                <br><br>
              <center><input type='submit' value='Submit' class='btn btn-primary' /></center>
            </form>";
            if (isset($_POST['newComment'])) {
                $sql = "UPDATE user_comment SET content = '{$_POST['newComment']}', time='{$date}' 
                WHERE userEmail='{$email}' AND time='{$time}'";
                $sql1 = "UPDATE has SET time='{$date}' WHERE userEmail='{$email}' AND time='{$time}'";
                if (!mysqli_query($con,$sql)) {
                    die('Error: ' . mysqli_error($con));
                }
                if (!mysqli_query($con,$sql1)) {
                    die('Error: ' . mysqli_error($con));
                }
                echo "<center><h2>Successfully Updated Comment</h2></center>";
                echo "<center><a href='./profile.php' 
                class='btn btn-success'>Back To Profile</a></center>";
                echo "<br>";
                mysqli_close($con);
            }
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