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

        $result3 = mysqli_query($mysqli, "SELECT * FROM booking_details WHERE email_id='$email' ORDER BY booked_time DESC");
        if(!$result3){
            die("Failed to fetch booked journeys from DB : " . mysqli_error($mysqli));
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
    <title>Profile</title>
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
                        <a class="nav-link btn btn-dark font-weight-bold text-light" href="userHome.php"><i class="fas fa-home"></i>  Home</a>
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

    <div class="container user-acc-cont">
        <div class="row">
            <div class="col col-lg-4 col-md-4 col-sm-12 col-12 profile-col text-center">
                <img class="profile-pic" src="https://picsum.photos/200" alt="">
                <?php
                    echo "<h3>".$res2['user_name']."</h3>"; 
                    echo "<h4 class='text-muted'>Email : ".$res2['email_id']."</h4>";
                    echo "<h4 class='text-muted'>Phn No  : ".$res2['mobile_no']."</h4>";
                    echo "<a href='editUserDetails.php?email=$email' class='btn btn-dark btn-block font-weight-bold edit-profile-btn'>Edit Profile</a>";
                ?>
                
            </div>
            <div class="col col-lg-8 col-md-8 col-sm-12 col-12">
                <hr>
                <h2 class="font-weight-bold text-muted text-center">Booked Journeys</h2>
                <hr>
                <div class="filter-cont">
                    <span class="text-muted">Filter</span>
                    <input class="" id="search" type="text" placeholder="">
                </div>
                
                <div class="row">
                    <?php
                        while($res = mysqli_fetch_array($result3)){
                            $train = $res['train_no'];
                            $result4 = mysqli_query($mysqli, "SELECT * FROM train_details WHERE train_no='$train'");
                            if(!$result4){
                                die("Failed to fetch train details : " . mysqli_error($mysqli));
                            }
                            $res4 = mysqli_fetch_array($result4);
                            date_default_timezone_set("Asia/Calcutta");
                            $current_date = date('Y-m-d');
                            $jd = $res4['journey_date'];
                            if($current_date > $jd){
                                echo "<div class='col col-lg-6 col-md-6 col-sm-12 col-12 booked-journeys-card'>";
                                echo "<div class='card bg-dark text-muted'>";
                                echo "<div class='card-header'>Train No : ".$res4['train_no']."<span class='badge badge-info'>  (No.of Tickets : ".$res['no_of_seats'].")</span></div>";
                                echo "<div class='card-body'>";
                                echo "<h5 class=''><i class='fas fa-train'></i>  ".$res4['train_name']."</h5>";
                                echo "<p>".$res4['journey_from']." ---> ".$res4['journey_to'].  " <span class='badge badge-info'>$".$res4['price']."/ticket</span></p>";
                                echo "<p><i class='fas fa-calendar-day'></i>  ".$res4['journey_date']." / <i class='far fa-clock'></i>  ".$res4['journey_timing']." Hrs</p>";
                                echo "<p>Booked on : ".$res['booked_time']." Hrs</p>";
                                echo "<p><span class='badge badge-danger journey-completed-badge'>Journey Completed</span></p>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                continue;
                            }
                            echo "<div class='col col-lg-6 col-md-6 col-sm-12 col-12 booked-journeys-card'>";
                            echo "<div class='card'>";
                            echo "<div class='card-header'>Train No : ".$res4['train_no']."<span class='badge badge-warning'>  (No.of Tickets : ".$res['no_of_seats'].")</span></div>";
                            echo "<div class='card-body'>";
                            echo "<h5 class=''><i class='fas fa-train'></i>  ".$res4['train_name']."</h5>";
                            echo "<p>".$res4['journey_from']." ---> ".$res4['journey_to'].  " <span class='badge badge-danger'>$".$res4['price']."/ticket</span></p>";
                            echo "<p><i class='fas fa-calendar-day'></i>  ".$res4['journey_date']." / <i class='far fa-clock'></i>  ".$res4['journey_timing']." Hrs</p>";
                            echo "<p>Booked on : ".$res['booked_time']." Hrs</p>";
                            echo "<p><span class='badge badge-warning journey-completed-badge'>Upcoming Journey</span></p>";
                            echo "<a class='btn btn-dark btn-block font-weight-bold' href='viewBookedDetails.php?trainNo=$train&bookedTime=".$res['booked_time']."'>Details</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        } 
                    ?>
                </div>
                
            </div>
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