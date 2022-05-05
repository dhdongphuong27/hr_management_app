<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:/webfinal/login.php");
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"></script>

    <link rel='stylesheet' href='/webfinal/stylesheets/style.css' />
  </head>
  <body>
    <?php
        require_once("conn.php");
        $strlink = $_SERVER['PHP_SELF'];
        $la_id = str_replace("/webfinal/leave_application_details.php/","",$strlink);

        $leave_applications = $conn->query("SELECT * FROM leave_applications where la_id=$la_id");
        if ($leave_applications->num_rows > 0) {
            $row = $leave_applications->fetch_assoc();
        }
        $userid = $row["userid"];
        $users = $conn->query("SELECT * FROM users where userid=$userid");
        $row1 = $users->fetch_assoc();
    ?>
    <div class="">
        <!-- The sidebar -->
        <?php
            if ($_SESSION["position"]==="head"){
                include 'head_sidebar.php';
            }else if ($_SESSION["position"]==="director"){
                include 'director_sidebar.php';
            }else{
                include 'employee_sidebar.php';
            }
        ?>

        <!-- Page content -->
        <div class="content" style="height:100vh">
            <div  class="col-md-12">
                <div class="form-group">
                    <label for="user_name" class="col-md-4 col-form-label">User Name:</label>
                    <p name="user_name" id="user_name" class="form-control"><?php echo $row1["fullname"]; ?></p>

                    <label for="reason" class="col-md-4 col-form-label">Reason:</label>
                    <p name="reason" id="reason" class="form-control">
                        <?php echo $row["reason"]; ?>
                    </p>
                    <?php
                        if ($row['attachment']!=""){
                    ?>
                        <div class="row">
                            <div class="col-3">
                                <label for="attachment" class="col-md-4 col-form-label">Attachment:</label>
                                <a class="form-control input-group-lg" href="/webfinal/uploads/<?php echo $row['attachment']?>" download><?php echo $row["attachment"]?></a>
                            </div>
                        </div>
                    <?php
                    
                        }
                    ?>
                    
                    <div class="row">
                        <div class="col-3">
                            <label for="post_on" class="col-md col-form-label">Submitted at:</label>
                            <p name="post_on" id="post_on" class="form-control input-group-lg">
                                <?php echo $row["post_on"]; ?>
                            </p>
                        </div>  
                        <div class="col-3">
                            <label for="attachment" class="col-md-4 col-form-label">Status:</label>
                            <a class="form-control input-group-lg"><?php echo $row["status"]?></a>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <?php
                if ((($_SESSION["position"]=="head" && $row["position"]=="employee"  && $_SESSION["department_id"]==$row["department_id"])|| $_SESSION["position"]=="director" && $row["position"]=="head") && $row["status"]=="waiting"){
            ?>       
            <div class="row" style="">
                <form style="display: ; width:100px; margin-left: 1000px" action="/webfinal/reject_la_submit.php/<?php echo $la_id?>" method="post">
                    <button type="submit" name="reject_la" class="btn btn-danger">Reject</button>
                </form>
                <form style="display: ; width:100px; margin-left: " action="/webfinal/approve_la_submit.php/<?php echo $la_id?>" method="post">
                    
                    <button type="submit" name="approve_la" class="btn btn-success">Approve</button>
                </form>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    
    <script type="text/javascript" src="/webfinal/javascripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
