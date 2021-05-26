<?php
    include_once("config.php");

    if(isset($_POST["signin"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $encrypted_password = md5($password);
       /* $query = "SELECT count(*) as cntUser FROM user_details WHERE email_id='".$email."' and passwd='".$encrypted_password."'";
        $result = mysqli_query($mysqli, $query);
        if(!$result){
            die("Failed to check the login credentials with db " . mysqli_error($mysqli));
        }

        $row = mysqli_fetch_array($result);
        $count = $row["cntUser"];

        if($count > 0){
            $_SESSION["email"] = $email;
            header("Location: user/userHome.php");
        }
        else{
            sleep(3);
            header("Location: signin.html");
        } */

        $check_user_query = mysqli_query($mysqli, "SELECT * FROM user_details WHERE email_id='".$email."' and passwd='".$encrypted_password."'");
        if(!$check_user_query){
            die("Failed to check the login credentials with DB : " . mysqli_error($mysqli));
        }

        $row = mysqli_fetch_array($check_user_query);
        $em = $row["email_id"];
        $pass = $row["passwd"];
        $role = $row["role"];

        if($email==$em and $encrypted_password==$pass and $role==1){
            $_SESSION["admin"] = $email;
            header("Location: admin/adminHome.php");
        }

        elseif($email==$em and $encrypted_password==$pass and $role==0){
            $_SESSION["email"] = $email;
            header("Location: user/userHome.php");
        }
        else{
            sleep(3);
            header("Location: signin.html");
        }


        

        
    }
?>