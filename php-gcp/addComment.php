<?php
    include_once("./library.php"); // To connect to the database
    if( in_array($_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1'))){
        $con = new mysqli($server, $username, $password, $dbname);
    }else{
        $con = new mysqli(null, $username, $password, $dbname, null, '/cloudsql/nobel-laureate-finder-332817:us-east4:nobel-laureate-finder');
    }
    // Check connection
    if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    date_default_timezone_set('America/New_York');
    $date = date('Y-m-d H:i:s', time());

    $id = (int)$_GET['id'];

    $stmt = $con->stmt_init();
	if($stmt->prepare("INSERT INTO user_comment values(?,?,?)") or die("<br/>Error Building Query!<br/>" . mysqli_error($con))) {
		$stmt->bind_param("sss", $_SESSION['user_email_address'], $date, $_GET["text"]);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
	}
	else {
		$stmt->close();
	}	

    $stmt = $con->stmt_init();
	if($stmt->prepare("INSERT INTO has values(?,?,?)") or die("<br/>Error Building Query!<br/>" . mysqli_error($con))) {
		$stmt->bind_param("iss", $id, $_SESSION['user_email_address'], $date);   
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
	}
	else {
		$stmt->close();
	}	

    // $id = (int)$_GET['id'];

    // $sql="INSERT INTO user_comment VALUES('" . $_SESSION['user_email_address'] . "','" . $date . "','" . $_GET['text'] . "')";
    // $result = mysqli_query($con,$sql);
    // if (!$result){
    //     die('Error: ' . mysqli_error($con));
    //     }

    // $sql="INSERT INTO has VALUES('" . $id . "','" . $_SESSION['user_email_address'] . "','" . $date ."')";
    // $result = mysqli_query($con,$sql);
    // if (!$result){
    //     die('Error: ' . mysqli_error($con));
    //     }

    $sql="SELECT content, time, userEmail FROM user_comment NATURAL JOIN has WHERE id = $id";
    $result=mysqli_query($con,$sql);
    echo "<table class='table'>
        <caption style='caption-side:top; color:darkturquoise;'>
        Comments</caption>
        <tr>
            <th scope='col' width='20%'>Time</th>
            <th scope='col' width='60%'>Content</th>
            <th scope='col' width='20%'>User</th>
        </tr>";
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $c = $row["content"];
        $t = $row["time"];
        $u = $row["userEmail"];
        echo "<tr><td>".$t."</td><td>".$c."</td><td>".$u."</td></tr>";
    }
    echo "</table>";

    mysqli_free_result($result);
    $con->close();
    // mysqli_close($con);

?>