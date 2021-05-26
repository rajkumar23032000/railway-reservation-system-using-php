<?php 
    include_once("../config.php");
    if(isset($_SESSION["email"])){
        $trainNo = $_GET["trainNo"];
        $query = "SELECT * FROM train_details WHERE train_no='$trainNo'";
        $result = mysqli_query($mysqli, $query);
        if(!$result){
            die("Failed to fetch data from db : " . mysqli_error($mysqli));
        }
        $res = mysqli_fetch_array($result);
        $ts = (int)$res['total_seats'];
        $tb = (int)$res['tickets_booked'];

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

<?php 
    if(isset($_POST['bookSeats-btn'])){
        sleep(5);
        $noOfSeats = $_POST["noOfSeats"];
        $query = "UPDATE train_details SET tickets_booked='$tb'+$noOfSeats WHERE train_no='$trainNo'";
        $result = mysqli_query($mysqli, $query);
        if(!$result){
            die("Failed to book tickets : " . mysqli_error($mysqli));
        }

        $user = $_SESSION["email"];
        date_default_timezone_set("Asia/Calcutta");
        $current_date = date('y/m/d G:i:s');
        $query2 = "INSERT INTO booking_details (train_no, email_id, no_of_seats, booked_time) VALUES ('$trainNo', '$user', '$noOfSeats', '$current_date')";
        $result2 = mysqli_query($mysqli, $query2);
        if(!$result2){
            die("Failed to update the booking_details table in DB : " . mysqli_error($mysqli));
        }

        header("Location: userAccount.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View and Book Tickets</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">    
        <link rel="stylesheet" href="../userStyles.css">
        <script src="../script.js"></script>
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
                        <a class="nav-link btn btn-dark text-light font-weight-bold" href="../signout.php">Sign Out  <i class="fas fa-sign-out-alt"></i></a>
                    </li>

                </ul>
            </div>
        </nav>

        <div class="container view-book-cont">
            <?php 
                echo "<h1><i class='fas fa-train'></i>  ".$res['train_name']."</h1>";
                echo "<p>Train Number :  ".$res['train_no']."</p>";
                echo "<i class='fas fa-calendar-day'>  ".$res['journey_date']."</i>";
                echo "<br><br>";
                echo "<i class='far fa-clock'>  ".$res['journey_timing']." Hrs</i>";
                echo "<br><br>";
                echo "<i class='fas fa-hourglass-start'>  ".$res['journey_from']."</i><span class='text-muted'>  (Starting Point)</span>";
                echo "<br><br>";
                echo "<i class='fas fa-hourglass-end'> ".$res['journey_to']."</i><span class='text-muted'>  (Destination)</span>";
                echo "<br><br>";
                echo "<i class='fas fa-chair'>  ".($ts - $tb)."</i><span class='text-muted'>  (Seats Available)</span>";
                echo "<br><br>";
                echo "<i class='fas fa-tags badge badge-danger price-tag'>  $".$res['price']."</i><span class='text-muted'>  (per ticket)</span>";
                echo "<br><br>";
            ?> 
            
            <form action="" method="post" class="book-seats-form">
                <div class="form-group">
                    <label for="">Enter number of seats</label>
                    <input type="number" class="form-control" name="noOfSeats" min="1" required>
                    <button id="book-seats-btn" name="bookSeats-btn" class="btn btn-warning btn-lg font-weight-bold my-3">Book Seats</button>
                    <h3 id="booked-success" class="text-success font-weight-bold">Booked Successfully</h3>
                </div>
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