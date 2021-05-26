<?php 
    include_once("../config.php");
    if(isset($_SESSION["email"])){
        $email = $_GET["email"];
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
    if(isset($_POST["edit-profile-btn"])){
        $username = $_POST["username"];
        $phnNo = $_POST["phnNo"];
        $update_profile_query = mysqli_query($mysqli, "UPDATE user_details SET user_name='$username', mobile_no='$phnNo' WHERE email_id='$email'");
        if(!$update_profile_query){
            die("Failed to update user details in DB : " . mysqli_error($mysqli));
        }
        header("Location: userAccount.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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

        <div class="container edit-profile-cont">
            <hr>
            <h3 class="font-weight-bold text-muted text-center">Edit your Profile</h3>
            <hr>
            <form action="" method="post" class="edit-details-form m-5">
                <div class="form-group">
                    <label class="font-weight-bold" for="">Username</label>
                    <?php
                    echo "<input type='text' class='form-control' name='username' value=".$res2['user_name'].">";
                    ?>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="">Phone Number</label>
                    <?php
                    echo "<input type='number' class='form-control' min='1' name='phnNo' value=".$res2['mobile_no'].">";
                    ?>
                </div>
                <button name="edit-profile-btn" class="btn btn-warning btn-lg font-weight-bold">Confirm</button>
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

</body>
</html>