<?php
    include_once("./library.php"); // To connect to the database
?>
<html>
    <head>
        <title>Nobel Laureate Finder</title>
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
    if( in_array($_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1'))){
        $con = new mysqli($server, $username, $password, $dbname);
    }else{
        $con = new mysqli(null, $username, $password, $dbname, null, '/cloudsql/nobel-laureate-finder-332817:us-east4:nobel-laureate-finder');
    }
 // Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 // Form the SQL query (an INSERT query)
 $sql="INSERT INTO individual_publication (id, publications)
 VALUES
 ('$_POST[id]','$_POST[publications]')";

 if (!mysqli_query($con,$sql))
 {
 die('Error: ' . mysqli_error($con));
 }
 echo "<div style='padding-top: 0.1in;'><center>
 <h3 style='color:darkturquoise;'>Added $_POST[publications] for nobel luareate $_POST[id]</h3></center></div>"; // Output to user
 mysqli_close($con);
?>

<div style="padding:10px">
    <center><a href="./profile.php" class="btn btn-info"> Back To Profile </a></center>
</div>

</body>
</html>