<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

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

    // Form the SQL query
    $sql="SELECT id, name, year, category FROM nobel_laureate NATURAL JOIN won NATURAL JOIN nobel_prize";
    //if individual or organization selected
    if(boo($_GET['ind']) xor boo($_GET['org'])){
        //if individual selected
        if(boo($_GET['ind'])){
            $sql=$sql . " NATURAL JOIN (SELECT id, name FROM individual) AS I";
            if(!(boo($_GET['male']) xor boo($_GET['female']))){
                $sql=$sql . " WHERE id NOT IN (SELECT id FROM awarded_organization)";
            }else if(boo($_GET['male'])){
                $sql=$sql . " WHERE id IN (SELECT id FROM individual WHERE gender='Male')";
            }else{
                $sql=$sql . " WHERE id IN (SELECT id FROM individual WHERE gender='Female')";
            }
        //if organization selected
        }else{
            $sql=$sql . " NATURAL JOIN (SELECT id, name FROM awarded_organization) AS A";
            $sql=$sql . " WHERE id IN (SELECT id FROM awarded_organization)";
        }
    //if both selected or not selected, return all nobel laureate records
    }else{
        $sql=$sql . " NATURAL JOIN ((SELECT id, name FROM individual) UNION (SELECT id, name FROM awarded_organization)) AS U";
    }

    if(boo($_GET['peace'])||boo($_GET['chemistry'])||boo($_GET['literature'])||boo($_GET['physics'])||boo($_GET['medicine'])||boo($_GET['economics'])){
        if(!(boo($_GET['ind']) xor boo($_GET['org'])))
            $sql=$sql . " WHERE (";
        else
            $sql=$sql . " AND (";
        if(boo($_GET['peace'])){
            $sql=$sql . " category='Peace' OR";
        }
        if(boo($_GET['chemistry'])){
            $sql=$sql . " category='Chemistry' OR";
        }
        if(boo($_GET['literature'])){
            $sql=$sql . " category='Literature' OR";
        }
        if(boo($_GET['physics'])){
            $sql=$sql . " category='Physics' OR";
        }
        if(boo($_GET['medicine'])){
            $sql=$sql . " category='Medicine' OR";
        }
        if(boo($_GET['economics'])){
            $sql=$sql . " category='Economics' OR";
        }
        $sql=substr($sql,0,-3);
        $sql=$sql . " )";
        $sql=$sql . " AND name LIKE '%$_GET[text]%'";
    }else{
        if(!(boo($_GET['ind']) xor boo($_GET['org']))){
            if(is_numeric($_GET['text'])){
                $text = (int)$_GET['text'];
                $sql=$sql . " WHERE id=$text";
            }else
                $sql=$sql . " WHERE name LIKE '%$_GET[text]%'";
        }else{
            if(is_numeric($_GET['text'])){
                $text = (int)$_GET['text'];
                $sql=$sql . " AND id=$text";
            }else
                $sql=$sql . " AND name LIKE '%$_GET[text]%'";
        }
    }

    $s_year=$_GET["s_year"];
    $e_year=$_GET["e_year"];
    if($s_year!=""||$e_year!=""){
        if(strpos($sql,"WHERE"))
            $sql=$sql . " AND";
        else
            $sql=$sql . " WHERE";
        
        if($s_year==""){
            $e_year=(int)$e_year;
            $sql=$sql . " year<=$e_year";
        }elseif($e_year==""){
            $s_year=(int)$s_year;
            $sql=$sql . " year>=$s_year";
        }else{
            $e_year=(int)$e_year;
            $s_year=(int)$s_year;
            $sql=$sql . " year>=$s_year AND year<=$e_year";
        }
    }

    switch($_GET['sort']){
        case 1:
            $sql=$sql . " ORDER BY name ASC";
            break;
        case 2:
            $sql=$sql . " ORDER BY name DESC";
            break;
        case 3:
            $sql=$sql . " ORDER BY year ASC";
            break;
        case 4:
            $sql=$sql . " ORDER BY year DESC";
            break;
        case 5:
            $sql=$sql . " ORDER BY id ASC";
            break;
        case 6:
            $sql=$sql . " ORDER BY id DESC";
            break;
    }

    // echo $sql;

    $result=mysqli_query($con,$sql);
    if (!$result){
    die('Error: ' . mysqli_error($con));
    }
    if(mysqli_num_rows($result)==0)
        echo "No result.";
    else{
        // echo "<table border=1><th>id</th><th>name</th><th>year</th><th>category</th>\n";
        // echo "<table border=1><th>id</th><th>motivation</th><th>numComment</th>\n";
        echo "<div class='col-md-10 offset-md-1'>";
        $count = 0;
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $name = str_replace('"','',$row['name']);
            // echo "<tr><td>$row[id]</td><td><a href='detail.php?id=$row[id]'>$row[name]</a></td><td>$row[year]</td><td>$row[category]</td></tr>";
            // echo "<tr><td>$row[id]</td><td>$row[motivation]</td><td>$row[numComment]</td></tr>";
            // echo $row["id"] . " " . $row["motivation"] . " " . $row["category"];
            // echo "<br>";
            if($count % 3==0){
                // echo " <div class='card-group'>";
                // echo "
                // <div display='flex', justify-content:'space-between', style='padding-left:56px; padding-right:56px'>
                // <div class = 'card-group'>";
                echo "<br>";
                echo "<div class='row row-cols-1 row-cols-md-2 g-4'>";
            }

            echo "
            <div class='col col-md-4'>
                <a href='detail.php?id=$row[id]' style='text-decoration:none'>
                    <div class='card h-100 border-primary mb-3'>
                        <div class='card-header'>Result ID: $row[id]</div>
                        <div class='card-body text-dark'>
                            <h5 class='card-title' overflow:hidden line-height:20px height:40px>Name: $name</h5>
                            <p class='card-text'><b>Categroy:</b>$row[category], <b>Year:</b>$row[year]</p >
                        </div>
                    </div>
                </a>
            </div>
            ";

            if($count % 3==2)
                echo "</div>";
            $count=$count+1;
        }
        if($count % 3!=0)
            echo "</div>";
        // echo "</table>";
        echo "</div>";
    }

    mysqli_free_result($result);
    mysqli_close($con);

    function boo($s){
        if($s=="false")
            return false;
        return true;
    }
?>