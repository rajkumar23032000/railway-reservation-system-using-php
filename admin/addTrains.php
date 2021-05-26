<?php 
    include_once("../config.php");
    if(isset($_SESSION["admin"])){
        $email = $_SESSION["admin"];
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



<?php
    if(isset($_POST["addTrains"])){
        $trainNo = mysqli_escape_string($mysqli, $_POST["trainNo"]);
        $trainName = mysqli_escape_string($mysqli, $_POST["trainName"]);
        $journeyFrom = mysqli_escape_string($mysqli, $_POST["journeyFrom"]);
        $journeyTo = mysqli_escape_string($mysqli, $_POST["journeyTo"]);
        $journeyDate = mysqli_escape_string($mysqli, $_POST["journeyDate"]);
        $journeyTiming = mysqli_escape_string($mysqli, $_POST["journeyTiming"]);
        $price = mysqli_escape_string($mysqli, $_POST["price"]);
        $totalSeats = mysqli_escape_string($mysqli, $_POST["totalSeats"]);
        
        
        $query = "INSERT INTO train_details values ('$trainNo', '$trainName', '$journeyFrom', '$journeyTo', '$journeyDate', '$journeyTiming', '$price', '$totalSeats', 0)";
        $result = mysqli_query($mysqli, $query);
        if(!$result){
            die("Failed to add train details to db " . mysqli_error($mysqli));
        }
        header("Location: adminHome.php");
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Trains</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <a class="navbar-brand" href="adminHome.php"><i class="fab fa-wizards-of-the-coast"></i> Fantasy Rails <i
                class="fas fa-dungeon"></i> (ADMIN)</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-4">
                    <a class="nav-link btn btn-dark font-weight-bold text-light" href="adminHome.php"><i class=" fas
                        fa-home"></i> Home</a>
                </li>
                
                <li class="nav-item">
                        <a class="nav-link btn btn-dark font-weight-bold text-light" href="../signout.php">Sign Out  <i class="fas fa-sign-out-alt"></i></a>
                    </li>
            </ul>
        </div>
    </nav>

    <div class="container admin-cont">
        <hr>
        <h3 class="font-weight-bold ml-4">Add Trains</h3>
        <hr>
        <form id="addOrEdit-form" method="POST">
            <div class="form-group">
                <label for="">Train Number</label>
                <input type="text" class="form-control" name="trainNo" required>
            </div>
            <div class="form-group">
                <label for="">Train Name</label>
                <input type="text" class="form-control" name="trainName" required>
            </div>
            <div class="form-group">
                <label for="">Journey From</label>
                <input type="text" class="form-control" name="journeyFrom" required>
            </div>
            <div class="form-group">
                <label for="">Journey To</label>
                <input type="text" class="form-control" name="journeyTo" required>
            </div>
            <div class="form-group">
                <label for="">Journey Date</label>
                <input type="date" class="form-control" name="journeyDate" required>
            </div>
            <div class="form-group">
                <label for="">Journey Timing</label>
                <input type="time" class="form-control" name="journeyTiming" required>
            </div>
            <div class="form-group">
                <label for="">Price</label>
                <input type="number" class="form-control" name="price" min="1" required>
            </div>
            <div class="form-group">
                <label for="">Total Seats</label>
                <input type="number" class="form-control" name="totalSeats" min="1" required>
            </div>

            <button type="submit" class="btn btn-success btn-block font-weight-bold" name="addTrains">Add Train</button>
        </form>
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
            <p><i class="far fa-copyright"></i> Copyright 2020</p>

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