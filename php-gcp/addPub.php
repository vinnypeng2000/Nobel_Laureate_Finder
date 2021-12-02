<?php
    include_once('config.php');
?>

<html>
    <head>
    <title>Nobel Laureate Finder</title>
    <head>
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
        <center><h3 style="color:darkturquoise;">Add Publications For Nobel Luareates!</h3></center>
    </div>
    <BR>
    <div style="padding: 0.1in;">
    <center><form action="addPubSubmit.php" method="post" style="width: 50%;">
    Id: <input type="text" name="id"  class="form-control">
    Publication: <input type="text" name="publications"  class="form-control"></center>
    </div>
    <center><input type="Submit" class='btn btn-info'></center>
    </form>
</body>
</html>