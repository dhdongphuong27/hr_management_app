<?php
    session_start();
    include 'conn.php';
    if (isset($_POST["save"])){
        $old_password = $_POST["old_password_input"];
        $password = $_POST["new_password_input"];
        $re_password = $_POST["re_password_input"];
        $userid = $_SESSION["userid"];
        $hashed_password = password_hash($username, PASSWORD_DEFAULT);
        if ($old_password != $_SESSION["password"]){
            echo "<script>alert('Old password incorrect');
                window.location.href = '/webfinal/head_index.php';
            </script>";
        }else if ($password == $re_password){
            $conn->query("UPDATE users SET password = $hashed_password WHERE userid=$userid");
            $_SESSION["password"] = $password;
            include 'redirect.php';
        }else{
            echo "<script>alert('Password do not match');
                window.location.href = '/webfinal/head_index.php';
            </script>";
        }
    }
    

?>