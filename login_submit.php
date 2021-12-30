<?php
    session_start();
    include 'conn.php';
    if (isset($_POST["login"]) && $_POST["username"] != '' && $_POST["password"] != ''){
        $username = $_POST["username"];
        $password = $_POST["password"];
        //decrypt password here
        $sql = "SELECT * FROM users  WHERE username = '$username' AND password = '$password'";
        $user = mysqli_query($conn, $sql);
        if (mysqli_num_rows($user)>0){
            $_SESSION["user"] = $username;
            $row = mysqli_fetch_array($user, MYSQLI_BOTH);
            $position = $row["position"];
            $_SESSION["position"] = $position;
            if ($position=="employee"){
                header("location: employee_index.php");
            }else if ($position=="head"){
                header("location: head_index.php");
            }else if ($position=="director"){
                header("location: director_index.php");
            }
        }else{
            header("location: login.php");
            //inform user that login failed
        }
    }else{
        //Nothing received
        header("location: login.php");
    }

?>