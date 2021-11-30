<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <script src="./js/js/jquery-1.6.2.min.js" type="text/javascript"></script> 
        <script src="./js/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script>
        $(document).ready(function() {
            $('#submit').click(function() {
                $.ajax({
                    url: 'search.php', 
                    data: { org: $("#org").is(":checked"),
                            ind: $("#ind").is(":checked"),
                            male: $("#male").is(":checked"),
                            female: $("#female").is(":checked"),
                            peace: $("#peace").is(":checked"),
                            chemistry: $("#chemistry").is(":checked"),
                            literature: $("#literature").is(":checked"),
                            physics: $("#physics").is(":checked"),
                            medicine: $("#medicine").is(":checked"),
                            economics: $("#economics").is(":checked"),
                            text: $("#search").val()},
                    success: function(data){
                        $('#result').html(data);	
                    }
                });
            });
            $('#submit').trigger('click');

            //logic for gender filter
            $('#gender').hide();
            $('#type').change(function(){
                if(document.getElementById('ind').checked&&!document.getElementById('org').checked){
                    $('#gender').show();
                }else{
                    $('#gender').hide();
                    $('#male').prop("checked", false);      //uncheck the checkbox
                    $('#female').prop("checked", false);
                }
            });
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

        <!-- <div class="input-group">
            <input class="xlarge form-control" id="search" name="search" placeholder="Search By Nobel Laureate Or Organization">
            <div class="input-group-append">
                <button type="button" id="submit" class="btn btn-primary">Search</button>
            </div>
        </div><br> -->

        <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="filter" style="background:#00000008; border-right: 0.5px black"; >
            <!-- <div class="col-md-2" id="filter"> -->
                <!-- <div display="block" margin-left="auto" margin-right="auto"> -->
                <br><br>
                <div class="col-md-6 offset-md-3">
                    <div id="type">
                        <h6>Laureate Type: </h6>
                        <input type="checkbox" name="org" id="org" value="Org">Organization<br>
                        <input type="checkbox" name="ind" id="ind" value="Ind">Individual<br>
                        <br>
                    </div>
                    <div id="gender">
                        <h6>Gender: </h6>
                        <input type="checkbox" name="male" id="male" value="Male">Male<br>  
                        <input type="checkbox" name="female" id="female" value="Female">Female<br>  
                        <br>   
                    </div>
                    <div id="category">
                        <h6>Category: </h6>
                        <input type="checkbox" name="peace" id="peace" value="Peace">Peace<br>  
                        <input type="checkbox" name="chemistry" id="chemistry" value="Chemistry">Chemistry<br>  
                        <input type="checkbox" name="literature" id="literature" value="Literature">Literature<br>  
                        <input type="checkbox" name="physics" id="physics" value="Physics">Physics<br>  
                        <input type="checkbox" name="medicine" id="medicine" value="Medicine">Medicine<br>  
                        <input type="checkbox" name="economics" id="economics" value="Economics">Economics<br>   
                        <br>  
                    </div>
                </div>
            </div>

            <div class="col-md-10">
                <br>
                <div style="padding-bottom:20px">
                    <input class="xlarge col-md-7 offset-md-1" id="search" name="search" placeholder="Search By Nobel Laureate Or Organization" style="padding:6px; border-radius: 5px; border-color:#79787808">
                    <button type="button" id="submit" class="btn btn-primary col-md-1 offset-md-1">Search</button>
                </div>
                <div  id="result"></div>
            </div>
        </div>
        </div>

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