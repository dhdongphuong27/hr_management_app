<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:login.php");
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
    <div class="">
        <!-- The sidebar -->
        <?php
          if ($_SESSION["position"]==="head"){
            include 'head_sidebar.php';
          }else if ($_SESSION["position"]==="employee"){
            include 'employee_sidebar.php';
          }else{
            header("location:director_index.php");
          }
        ?>
        <?php
          require_once("conn.php");
          $userid = $_SESSION["userid"];
          $current_year = date("Y");
          $result0 = $conn->query("SELECT SUM(numberofdays) FROM leave_applications WHERE userid = $userid AND YEAR(start_on) = $current_year AND status = 'approved'");
          if ($result0->num_rows > 0) {
            $row0 = $result0->fetch_assoc();
            $days = $row0["SUM(numberofdays)"];
          }
          if ($days==""){
            $days = "0";
          }
          $approver = "";
          if ($_SESSION["position"]=="head"){
            $total = 15;
            $approver = "director";
          }else{
            $total = 12;
            $approver = "department head";
          }
          $result = $conn->query("SELECT * FROM leave_applications WHERE userid = $userid ORDER BY la_id DESC LIMIT 1");
          if ($result->num_rows > 0){
            $last_leave_application = $result->fetch_assoc();
            $post_on = new DateTime($last_leave_application["post_on"]);
            $now = new DateTime();
            if ($last_leave_application["status"]=="waiting"){
                echo "<script>alert('You have already submit a leave application, please wait for $approver to response')
                    window.location.href = '/webfinal/worker_leave_management.php';
                </script>";
            }
                    
            $abs_diff = $post_on->diff($now)->format("%a");
            if ($abs_diff<7){
                $days_left_till_next_applicaiton = 7-$abs_diff;
                echo "<script>alert('You have to wait for $days_left_till_next_applicaiton days to submit the next leave application')
                    window.location.href = '/webfinal/worker_leave_management.php';
                </script>";
            }
            
            //echo "<script>alert($abs_diff)</script>";
          }
        ?>

        <!-- Page content -->
        <div class="content">
            <div class="row">
                <div class="col-9">
                    <h4 style="margin-top: 20px">Add leave application</h4>
                    <div style = "position: relative; top: 20%;">
                        <form action="add_leave_application_submit.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="reason"><b>Reason for leave</b></label>
                                <input type="text" class="form-control" name="reason" id="reason" aria-describedby="name"
                                     autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="numberofdays"><b>Select number of leave days</b></label>
                                <select class="form-control" name="numberofdays" id="numberofdays">
                                    <?php
                                        $numberofdaysleft = $total-$days;
                                        for ($i = 1; $i <= $numberofdaysleft; $i++){

                                    ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                        
                                        }
                                    
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start from:</label>
                                <input type="date" id="start_date" name="start_date">
                            </div>
                            <div class="form-group">
                                <label for="attachment"><b>Attachment</b></label>
                                <input type="file" class="form-control" name="attachment" id="attachment" accept=".gif,.jpg,.jpeg,.png,.doc,.docx,.xlsx,.pptx,.ppt,.csv">
                            </div>
                            <hr>
                            <button type="submit" name="add_leave_application" id="add_leave_application" class="btn custombtn">Add</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        </div>
    </div>
    
    <script src="/webfinal/javascripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
