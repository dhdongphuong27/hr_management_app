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
    <?php
        require_once("conn.php");
        $strlink = $_SERVER['PHP_SELF'];
        $report_id = str_replace("/webfinal/report_details.php/","",$strlink);

        $reports = $conn->query("SELECT * FROM reports where report_id=$report_id");
        if ($reports->num_rows > 0) {
            $row = $reports->fetch_assoc();
        }
        $task_id = $row["task_id"];
        $tasks = $conn->query("SELECT * FROM tasks where task_id=$task_id");
        $row1 = $tasks->fetch_assoc();
    ?>
    <div class="">
        <!-- The sidebar -->
        <?php
            if ($_SESSION["position"]==="head"){
                include 'head_sidebar.php';
            }else if ($_SESSION["position"]==="employee"){
                include 'employee_sidebar.php';
            }
        ?>

        <!-- Page content -->
        <div class="content" style="height:100vh">
            <div  class="col-md-12">
                <div class="form-group">
                        <label for="task_name" class="col-md-4 col-form-label">Task Name:</label>
                        <p name="task_name" id="task_name" class="form-control"><?php echo $row1["task_name"]; ?></p>

                        <label for="report_description" class="col-md-4 col-form-label">Report Description:</label>
                        <p name="report_description" id="report_description" class="form-control">
                            <?php echo $row["report_description"]; ?>
                        </p>
                        
                        <div class="row">
                            <div class="col-6">
                                <label for="assigned_at" class="col-md-4 col-form-label">Submit at:</label>
                                <p name="assigned_at" id="assigned_at" class="form-control input-group-lg">
                                    <?php echo $row["submit_date"]; ?>
                                </p>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="attachment" class="col-md-4 col-form-label">Attachment:</label>
                                <a class="form-control input-group-lg" href="/webfinal/uploads/<?php echo $row['attachment']?>" download><?php echo $row["attachment"]?></a>
                            </div>
                        </div>

                        <hr>
                        
                        
                </div>
            </div>
            <?php
                if ($_SESSION["position"]=="head" && $_SESSION["department_id"]==$row1["department_id"] && $row1["work_progress"]=="Waiting"){
            ?>       
            <div class="row" style=" height: 45%">
                <div class="col-6"  style="border-right: 3px solid black;">
                    <center><h2>Approve</h2></center>
                    <div style="position: relative; top:30%">
                        <form action="/webfinal/approve_task_submit.php/<?php echo $report_id?>" method="post">
                            <div class="btn-group"  style="width:100%" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" value="Bad" id="btnradio3" autocomplete="off">
                                <label class="btn btn-outline-warning" for="btnradio3">Bad</label>

                                <input type="radio" class="btn-check" name="btnradio" value="OK" id="btnradio2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2">OK</label>

                                <input type="radio" class="btn-check" name="btnradio" value="Good" id="btnradio1" autocomplete="off" checked>
                                <label class="btn btn-outline-success" for="btnradio1">Good</label>
                                
                            </div>
                            
                            <button style="margin-top:100px" type="submit" name="approve_task" id="approve_task" class="btn custombtn report_btn">Approve this report</button>
                        </form>
                    </div>    
                </div>
                <div class="col-6">
                    <center><h2>Reject</h2></center>
                    <div class="task_response">
                        <form action="/webfinal/reject_task_submit.php/<?php echo $report_id?>" method="post">
                            <input type="hidden" name="task_id" id="task_id" value="<?php echo $cutstr ?>">
                            <div class="form-group">
                                <label for="comment"><b>Comment</b></label>
                                <textarea oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' name="comment"
                            id="comment" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="extend_deadline">Extend Deadline:</label>
                                <input type="datetime-local" id="extend_deadline" name="extend_deadline">
                            </div>
                            
                            <button style="margin-top:25px" type="submit" name="reject_task" id="reject_task" class="btn btn-danger report_btn">Reject this report</button>
                        </form>
                    </div>
                    
                </div>
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
