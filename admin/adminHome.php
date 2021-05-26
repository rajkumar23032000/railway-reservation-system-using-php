<?php
    include_once("../config.php");

    if(isset($_SESSION["admin"])){
        $query = "SELECT * FROM train_details";
        $result = mysqli_query($mysqli, $query);
        if(!$result){
            die("Failed to fetch data from db " . mysqli_error($mysqli));
        }
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
        <title>Admin - View Trains</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-light">
            <a class="navbar-brand" href="adminHome.php"><i class="fab fa-wizards-of-the-coast"></i>  Fantasy Rails  <i class="fas fa-dungeon"></i> (ADMIN)</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-dark font-weight-bold text-light" href="../signout.php">Sign Out  <i class="fas fa-sign-out-alt"></i></a>
                    </li>
                </ul>
            </div>
        </nav>    

        <div class="container admin-cont">

            <a class="btn btn-dark btn-lg font-weight-bold" href="addTrains.php"><i class="fas fa-plus"></i>  Train</a>
            <div class="row">
                <?php
                    while($res = mysqli_fetch_array($result)){
                        echo "<div class='col col-lg-4 col-md-6 col-sm-12 col-12'>";
                        echo "<div class='card' style='width: 18rem;'>";
                        echo "<div class='card-header'>Train No : ".$res["train_no"]."</div>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'><i class='fas fa-train'></i>  ".$res["train_name"]."</h5>";
                        echo "<p class='card-text'>From : ".$res["journey_from"]."</p>";
                        echo "<p class='card-text'>To : ".$res["journey_to"]."</p>";
                        echo "<p class='card-text'>Date : ".$res["journey_date"]." , ".$res["journey_timing"]." Hrs</p>";
                        echo "<p class='card-text badge badge-danger'>Price : $".$res["price"]."</p>";
                        echo "<p class='card-text '>Total Seats : ".$res["total_seats"]."</p>";
                        echo "<p class='card-text'>Seats Booked : ".$res["tickets_booked"]."</p>";
                        echo "<a href='editTrains.php?trainNo=$res[train_no]' class='btn btn-dark btn-block font-weight-bold'>Edit</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                ?>
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
    </body>
</html>