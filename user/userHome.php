<?php 
    include_once("../config.php");
    if(isset($_SESSION["email"])){
        $query = "SELECT * FROM train_details";
        $result = mysqli_query($mysqli, $query);
        if(!$result){
            die("Failed to fetch data from db : " . mysqli_error($mysqli));
        }

        $email = $_SESSION["email"];
        $result2 = mysqli_query($mysqli, "SELECT * FROM user_details WHERE email_id='$email'");
        if(!$result2){
            die("Failed to fetch username from DB " . mysqli_error($mysqli));
        }
        $res2 = mysqli_fetch_array($result2);
    }
    else{
        header("Location: ../signin.html");
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!!!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../userStyles.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="userHome.php"><i class="fab fa-wizards-of-the-coast"></i>  Fantasy Rails  <i class="fas fa-dungeon"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-4">
                    <a class="nav-link btn btn-dark font-weight-bold text-light" href="#journey-cont">Journeys  <i class="fas fa-route"></i></a>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link btn btn-dark font-weight-bold text-light" href="#gallery-cont">Gallery  <i class="fas fa-images"></i></a>
                </li>
                <li class="nav-item mr-4">
                    <?php 
                        echo "<a class='nav-link btn btn-dark font-weight-bold text-light' href='userAccount.php'><i class='far fa-user-circle'></i>  ".$res2['user_name']."</a>";
                    ?>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link btn btn-dark font-weight-bold text-light" href="../signout.php">Sign Out  <i class="fas fa-sign-out-alt"></i></a>
                </li>

            </ul>
        </div>
    </nav>

    <div class="container-fluid text-center user-home-cont1">
        <div class="poster-img">

        </div>
        <div class="img-text">
            <h1 class="cont1-h1"></h1>
            <h5 class="cont1-h5">What are You Waiting For?...</h5>
            <h4 class="cont1-h4">Buy the Ticket and Take the Ride!!!</h4>
        </div>
    </div>

    
    <div class="container text-center">
        <i class="fas fa-chevron-down down-icon"></i>
    </div>

    <div class="container-fluid text-center user-home-cont2">
        <div class="poster-img2">
        </div>
        <div class="img-text">
            <h4 class="cont2-h4 text-light">LIFE IS LIKE A TRAIN TRACK, FULL OF POSSIBILITES AND HAPPINESS.</h4>
            <h2 class="cont2-h5">THE ONLY IMPOSSIBLE JOURNEY IS THE ONE YOU NEVER BEGIN...</h2>
            <h1 class="cont2-h1 text-light">Embrace the Journey!</h1>
            <p class="font-weight-light cont2-p text-danger">Scroll Down to Book Your Journey</p> 
        </div>
    </div>

    <div class="container text-center">
        <i class="fas fa-chevron-down down-icon"></i>
    </div>

    <div class="container-fluid journey-cont" id="journey-cont">
        <hr>
        <h3 class="mx-4 font-weight-bold text-muted">Available Journeys</h3>
        <hr>
        
        <div class="row">
                <?php
                    while($res = mysqli_fetch_array($result)){
                        date_default_timezone_set("Asia/Calcutta");
                        $current_date = date('Y-m-d');
                        $jd = $res['journey_date'];
                        if($current_date > $jd){
                            continue;
                        }
                        echo "<div class='col col-lg-4 col-md-6 col-sm-12 col-12'>";
                        echo "<div class='card' style='width: 23rem;'>";
                        echo "<div class='card-header'>Train Number : ".$res["train_no"]."</div>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'><i class='fas fa-train'></i>  ".$res["train_name"]."</h5>";
                        echo "<p class='card-text'>From : ".$res["journey_from"]."</p>";
                        echo "<p class='card-text'>To : ".$res["journey_to"]."</p>";
                        echo "<p class='card-text'>Date : ".$res["journey_date"]."</p>";
                        echo "<p class='card-text'>Time : ".$res["journey_timing"]." Hrs</p>";
                        echo "<a href='viewDetailsAndBook.php?trainNo=$res[train_no]' class='btn btn-dark btn-block font-weight-bold'><i class='fas fa-info-circle'></i>  View Details and Book</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                ?>
        </div>        
    </div>

    <div class="container text-center d-cont">
        <i class="fas fa-chevron-down down-icon"></i>
    </div>

    <div class="container-fluid gallery-cont" id="gallery-cont">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <hr>
            <h4 class="font-weight-bold text-muted">Experience the Journey Like Never Before</h4>
            <hr>
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="8"></li>

            </ol>
            <div class="carousel-inner">
            <div class="carousel-item active">
                    <img src="https://picsum.photos/id/478/1300/500" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/id/220/1300/500" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/id/242/1300/500" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/id/155/1300/500" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/id/190/1300/500" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/id/197/1300/500" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/id/204/1300/500" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/id/352/1300/500" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>  
    </div>

    


    <footer class="footer text-center">
        <div class="footer-content-cont">
            <p class="font-weight-bold">Connect with Us</p>
            <span>
                <a href=""><i class="fas fa-envelope mr-2 ml-2 text-light"></i></a>
                <a href=""><i class="fab fa-twitter mr-2 ml-2 text-light"></i></a>
                <a href=""><i class="fab fa-facebook mr-2 ml-2 text-light"></i></a>
                <a href=""><i class="fab fa-instagram mr-2 ml-2 text-light"></i></a>
            </span>
            <br>
            <p><i class="far fa-copyright"></i>  Copyright 2020</p>
            
        </div>
        
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../script.js"></script>
</body>

</html>