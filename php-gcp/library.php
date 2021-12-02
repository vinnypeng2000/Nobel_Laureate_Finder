<?php
include_once('config.php');
// if((isset($_SESSION['loggedin']) && $_SESSION['loggedin'])){
if($login_button == ''){
    $email = $_SESSION['user_email_address'];
    if( in_array($_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1'))){
        $con = new mysqli('34.85.200.4', 'root', 'database4750', 'nobel_laureate');
    }else{
        $con = new mysqli(null, 'root', 'database4750', 'nobel_laureate', null, '/cloudsql/nobel-laureate-finder-332817:us-east4:nobel-laureate-finder');
    }
    // $con = new mysqli('34.85.200.4', 'root', 'database4750', 'nobel_laureate');
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql = "SELECT Email FROM dev_Email WHERE Email='$email'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)!=0){
        $username = 'root';                      // or your username
        $password = 'database4750';        // or your password
        $server = '34.85.200.4';       // projectID = cs4750, SQL instance ID = db-demo
        $dbname = 'nobel_laureate';
    }else{
        $username = 'webuser';                      // or your username
        $password = '4750';        // or your password
        $server = '34.85.200.4';       // projectID = cs4750, SQL instance ID = db-demo
        $dbname = 'nobel_laureate';
    }
    mysqli_close($con);
}else{
    $username = 'newuser';                      // or your username
    $password = '4750';        // or your password
    $server = '34.85.200.4';       // projectID = cs4750, SQL instance ID = db-demo
    $dbname = 'nobel_laureate';
}
// echo $username;
// $dsn = "mysql:unix_socket=/cloudsql/:us-east4:;dbname=nobel_laureate";
?>