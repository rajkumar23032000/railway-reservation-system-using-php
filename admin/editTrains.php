<?php 
    include_once("../config.php");

    if(isset($_SESSION["admin"])){
        $email = $_SESSION["admin"];
        $result2 = mysqli_query($mysqli, "SELECT * FROM user_details WHERE email_id='$email'");
        if(!$result2){
            die("Failed to fetch username from DB " . mysqli_error($mysqli));
        }
        $res2 = mysqli_fetch_array($result2);


        $trainNo = $_GET["trainNo"];
        $query = "SELECT * FROM train_details WHERE train_no='$trainNo'";
        $result = mysqli_query($mysqli, $query);
        if(!$result){
        die("Failed to fetch data from db " . mysqli_error($mysqli));
        }
    
        $res = mysqli_fetch_array($result);
        $trainNo = $res["train_no"];
        $trainName = $res["train_name"];
        $journeyFrom = $res["journey_from"];
        $journeyTo = $res["journey_to"];
        $journeyDate = $res["journey_date"];
        $journeyTiming = $res["journey_timing"];
        $price = $res["price"];
        $totalSeats = $res["total_seats"];
    
       
    }
    else{
        header("Location: ../signin.html");
    }

    
?>

<?php
    if(isset($_POST["updateTrain"])){
        $trainNo = $_POST["trainNo"];
        $trainName = $_POST["trainName"];
        $journeyFrom = $_POST["journeyFrom"];
        $journeyTo = $_POST["journeyTo"];
        $journeyDate = $_POST["journeyDate"];
        $journeyTiming = $_POST["journeyTiming"];
        $price = $_POST["price"];
        $totalSeats = $_POST["totalSeats"];
        
        $query = "UPDATE train_details SET train_name='$trainName', journey_from='$journeyFrom', journey_to='$journeyTo', journey_date='$journeyDate', journey_timing='$journeyTiming', price='$price', total_seats='$totalSeats' WHERE train_no='$trainNo'";
        $result = mysqli_query($mysqli, $query);
        if(!$result){
            die("Failed to update train details " . mysqli_error($mysqli));
        }
       header("Location: adminHome.php");
    }

    if(isset($_POST["deleteTrain"])){
        $trainNo = $_POST["trainNo"];
        $query = "DELETE FROM train_details WHERE train_no='$trainNo'";
        $result = mysqli_query($mysqli, $query);
        if(!$result){
            die("Failed to delete train " . mysqli_error($mysqli));
        }
        header("Location: adminHome.php");
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Trains</title>
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
        <h3 class="font-weight-bold ml-4">Edit Trains</h3>
        <hr>
        <form id="addOrEdit-form" action="<?php $_PHP_SELF ?>" method="POST">
            <div class="form-group">
                <label for="">Train Number</label>
                <input type="text" class="form-control" name="trainNo" value="<?php echo $trainNo ?>" readonly>
            </div>
            <div class="form-group">
                <label for="">Train Name</label>
                <input type="text" class="form-control" name="trainName" value="<?php echo $trainName ?>" required>
            </div>
            <div class="form-group">
                <label for="">Journey From</label>
                <input type="text" class="form-control" name="journeyFrom" value="<?php echo $journeyFrom ?>" required>
            </div>
            <div class="form-group">
                <label for="">Journey To</label>
                <input type="text" class="form-control" name="journeyTo" value="<?php echo $journeyTo ?>" required>
            </div>
            <div class="form-group">
                <label for="">Journey Date</label>
                <input type="date" class="form-control" name="journeyDate" value="<?php echo $journeyDate ?>" required>
            </div>
            
            <div class="form-group">
                <label for="">Journey Timing</label>
                <input type="time" class="form-control" name="journeyTiming" value="<?php echo $journeyTiming ?>" required>
            </div>
            <div class="form-group">
                <label for="">Price</label>
                <input type="number" class="form-control" name="price" value="<?php echo $price ?>" required>
            </div>
            <div class="form-group">
                <label for="">Total Seats</label>
                <input type="number" class="form-control" name="totalSeats" value="<?php echo $totalSeats ?>" required>
            </div>
            <button type="submit" class="btn btn-success btn-block font-weight-bold" name="updateTrain">Update Train</button>
            <button type="submit" class="btn btn-danger btn-block font-weight-bold" name="deleteTrain">Delete Train</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
</body>

</html>