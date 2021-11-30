<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <script src="./js/js/jquery-1.6.2.min.js" type="text/javascript"></script> 
        <script src="./js/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script>

        // $.urlParam = function(name){
        //     var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        //     return results[1] || 0;
        // }
        var id = <?php
            $id = $_GET['id'];
            echo $id;
        ?>;


        $(document).ready(function() {
            $('#submit').click(function() {
                $.ajax({
                    url: 'addComment.php', 
                    data: { id: id,
                            text: $("#addComment").val()},
                    success: function(data){
                        $('#userComment').html(data);	
                    }
                });
            });
            // $('#submit').trigger('click');
        });
        </script>
        <?php
            include('config.php');
        ?>
    </head>
    <body>
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
    </body>
</html>

<?php
    include_once("./library.php"); // To connect to the database
    $con = new mysqli($server, $username, $password, $dbname);
    // Check connection
    if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $id = (int)$_GET['id'];
    // echo $id;

    $sql="SELECT * FROM awarded_organization WHERE id=$id";

    $result=mysqli_query($con,$sql);
    if (!$result){
    die('Error: ' . mysqli_error($con));
    }
    if(mysqli_num_rows($result)==0){
        // get deathDate if it exists
        $sql="SELECT * FROM died WHERE id = $id";
        $result=mysqli_query($con,$sql);
        $deathDate = "";
        if(mysqli_num_rows($result)!=0)
            $deathDate = mysqli_fetch_array($result,MYSQLI_ASSOC)["deathDate"];
        
        // get orgName if it exists
        $sql="SELECT * FROM member_of WHERE id = $id";
        $result=mysqli_query($con,$sql);
        $orgName = "";
        if(mysqli_num_rows($result)!=0)
            $orgName = mysqli_fetch_array($result,MYSQLI_ASSOC)["orgName"];

        // get publications
        $sql="SELECT publications FROM individual_publication WHERE id = $id";
        $result=mysqli_query($con,$sql);
        $b = false;
        $pubs = "";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            if($b){
                $pubs = $pubs . ", ";
            }
            $pubs = $pubs . $row["publications"];
            $b = true;
        }

        //get user comments
        $sql="SELECT content, time FROM user_comment NATURAL JOIN has WHERE id = $id";
        $result=mysqli_query($con,$sql);
        $comments = "";
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $c = $row["content"];
            $t = $row["time"];
            $comments = $comments . "<div>$t: $c</div><br>";
        }
                
        // get other info
        $sql="SELECT NL.id, I.name, I.birthDate, I.city, I.country, NL.motivation, NP.category, NP.year, W.prizeShare
        FROM individual I NATURAL JOIN nobel_laureate NL NATURAL JOIN won W NATURAL JOIN nobel_prize NP
        WHERE NL.ID = $id";

        $result=mysqli_query($con,$sql);
        if (!$result){
        die('Error: ' . mysqli_error($con));
        }
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $city = str_replace('"','',$row['city']);
            $name = str_replace('"','',$row['name']);
            echo "
            <div class='col-md-6 offset-md-3' style='padding-top:80px'>
                <h4> $name </h4>
                <div class='card mb-3'>
               
                    <div class='row g-0'>
                        <div class='col-md-6'>    
                            <div class='card-body'>
                                <p class='card-text'><b>ID:</b> $row[id]</p >
                                <p class='card-text'><b>Year:</b> $row[year]</p >
                                <p class='card-text'><b>Category:</b> $row[category]</p >
                                <p class='card-text'><b>Organization:</b> $orgName</p >
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='card-body'>
                                <p class='card-text'><b>Prize Share:</b> $row[prizeShare]</p >
                                <p class='card-text'><b>Born:</b> $row[birthDate]</p >
                                <p class='card-text'><b>Died:</b> $deathDate</p >
                                <p class='card-text'><b>Hometown:</b> $city, $row[country]</p >
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class='card-body'>
                                <p class='card-text'> <b>Motivation: </b>$row[motivation] </p>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class='card-body'>
                                <p class='card-text'> <b>Publications: </b>$pubs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id='userComment'>
                $comments
            </div>
            ";
            echo "<br>";
        }
    }
    else{
        //get user comments
        $sql="SELECT content, time FROM user_comment NATURAL JOIN has WHERE id = $id";
        $result=mysqli_query($con,$sql);
        $comments = "";
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $c = $row["content"];
            $t = $row["time"];
            $comments = $comments . "<div>$t: $c</div><br>";
        }

        $sql="SELECT  NL.id, AO.name, NL.motivation, NP.category, NP.year, W.prizeShare
        FROM awarded_organization AO NATURAL JOIN nobel_laureate NL NATURAL JOIN won W NATURAL JOIN nobel_prize NP
        WHERE NL.ID = $id";

        $result=mysqli_query($con,$sql);
        if (!$result){
        die('Error: ' . mysqli_error($con));
        }
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
        // echo "<tr><td>$row[id]</td><td>$row[motivation]</td><td>$row[numComment]</td></tr>";
            $name = str_replace('"','',$row['name']);
            echo "
                <div class='col-md-6 offset-md-3' style='padding-top:80px'>
                    <h4> $name </h4>
                    <div class='card mb-3'>
                
                        <div class='row g-0'>
                            <div class='col-md-6'>    
                                <div class='card-body'>
                                    <p class='card-text'><b>ID:</b> $row[id]</p >
                                    <p class='card-text'><b>Prize Share:</b> $row[prizeShare]</p >
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='card-body'>
                                    <p class='card-text'><b>Year:</b> $row[year]</p >
                                    <p class='card-text'><b>Category:</b> $row[category]</p >
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='card-body'>
                                    <p class='card-text'> <b>Motivation: </b>$row[motivation] </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id='userComment'>
                    $comments
                </div>
            ";
            echo "<br>";
        }
    }

    // echo $sql;
    
    mysqli_free_result($result);
    mysqli_close($con);

    function test(){
        echo "hello";
    }

?>

<html>
    <!-- <div id="userComment"></div> -->
    <textarea class="xlarge col-md-6 offset-md-3" id="addComment" rows=5 placeholder="Write a comment"></textarea><br>
    <button type="button" id="submit"> Button </button>
</html>