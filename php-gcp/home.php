<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <script src="./js/js/jquery-1.6.2.min.js" type="text/javascript"></script> 
        <script src="./js/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script> -->
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
                            text: $("#search").val(),
                            sort: $("#sort").val(),
                            s_year: $("#s_year").val(),
                            e_year: $("#e_year").val()},
                    success: function(data){
                        $('#result').html(data);	
                    }
                });
            });
            $('#submit').trigger('click');
            $('#reset').click(function() {
                $('#org').prop("checked", false);
                $('#ind').prop("checked", false);
                $('#male').prop("checked", false);
                $('#female').prop("checked", false);
                $('#peace').prop("checked", false);
                $('#chemistry').prop("checked", false);
                $('#literature').prop("checked", false);
                $('#physics').prop("checked", false);
                $('#medicine').prop("checked", false);
                $('#economics').prop("checked", false);
                $("#s_year").val("");
                $("#e_year").val("");
            })

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
                    <div id="year">
                        <h6>Year: </h6>
                        <input type="number" name="s_year" id="s_year" class="col-md-6" min=1901 max=2021><br>
                        <div class="offset-md-3">|</div>
                        <input type="number" name="e_year" id="e_year" class="col-md-6" min=1901 max=2021><br>
                        <br>
                    </div>
                    <button type="button" id="reset" class="btn btn-secondary">Reset</button>
                </div>
            </div>

            <div class="col-md-10">
                <br>
                <div style="padding-bottom:20px">
                    <div class="row">
                    <div class="col-md-3 offset-md-1">
                        <select class="form-select" aria-label="Default select example" id="sort">
                            <option selected value="1">Sort by Name: a-z</option>
                            <option value="2">Sort by Name: z-a</option>
                            <option value="3">Sort by Year: past-present</option>
                            <option value="4">Sort by Year: present-past</option>
                            <option value="5">Sort by ID: small-large</option>
                            <option value="6">Sort by ID: large-small</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                    <input class="xlarge col-md-12" id="search" name="search" placeholder="Search By Nobel Laureate Or Organization" style="padding:6px; border-radius: 5px; border-color:#79787808">
                    </div>
                    <div class="col-md-1">
                    <button type="button" id="submit" class="btn btn-primary">Search</button>
                    </div>
                    </div>
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