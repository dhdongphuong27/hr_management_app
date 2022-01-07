<?php
    session_start();
    include 'conn.php';
    if (isset($_POST["save"])){
        $userid = $_SESSION["userid"];
        $target_file = "";
        if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK)
        {
            $target_dir = "./uploads/";
            $base_name = basename($_FILES["avatar"]["name"]);
            $extension = pathinfo($base_name, PATHINFO_EXTENSION);
            $file_name = strval(rand(0,10000000)) . "." . $extension;
            $target_file = $target_dir . $file_name;
            if (is_uploaded_file($_FILES['avatar']['tmp_name'])){
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
            }
    
        }
        $conn->query("UPDATE users SET profilepic = $target_file WHERE userid=$userid");
        $_SESSION["profilepic"] = $target_file;
    }
    include 'redirect.php';

?>