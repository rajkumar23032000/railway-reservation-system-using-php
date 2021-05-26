<?php
    include_once("config.php");
    if(isset($_POST["signup"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $username = $_POST["username"];
        $mobNo = $_POST["mobNo"];

        $encrypted_password = md5($password);
        $query = "INSERT INTO user_details values ('$email', '$encrypted_password', '$username', '$mobNo', 0)";
        $result = mysqli_query($mysqli, $query);
        if(!$result){
            die("Failed to SignUp " . mysqli_error($mysqli));
        }
        header("Location: signin.html");
        
    }
?>