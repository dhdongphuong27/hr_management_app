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
            $_SESSION["department_id"] = $row["department_id"];
            $_SESSION["userid"] = $row["userid"];
            $_SESSION["password"] = $row["password"];
            $_SESSION["profilepic"] = $row["profilepic"];
            $_SESSION["fullname"] = $row["fullname"];

            include 'redirect.php';
            
            
        }else{
            header("location: login.php");
            //inform user that login failed
        }
    }else{
        //Nothing received
        header("location: login.php");
    }

?>