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
        $task_id = str_replace("/webfinal/task_details.php/","",$strlink);

        $tasks = $conn->query("SELECT * FROM tasks where task_id=$task_id");
        $task_name = "";
        if ($tasks->num_rows > 0) {
            $row = $tasks->fetch_assoc();
        }
        $assignee_id = $row["assignee_id"];
        $users = $conn->query("SELECT * FROM users where userid=$assignee_id");
        $row1 = $users->fetch_assoc();
        $assignee_name = $row1["fullname"];
        $department_id = $row["department_id"];
        $departments = $conn->query("SELECT * FROM departments where department_id=$department_id");
        $row2 = $departments->fetch_assoc();
        $department_name = $row2["department_name"];
    ?>
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

        <!-- Page content -->
        <div class="content">
            <div style="height:100vh" class="col-md-12">
                <div class="form-group">
                        <label for="task_name" class="col-md-4 col-form-label">Task Name:</label>
                        <p name="task_name" id="task_name" class="form-control"><?php echo $row["task_name"]; ?></p>
                        
                        <label for="assignee_name" class="col-md-4 col-form-label">Assignee Name:</label>
                        <p name="assignee_name" id="assignee_name" class="form-control"><?php echo $assignee_name; ?></p>

                        <label for="department_name" class="col-md-4 col-form-label">Department:</label>
                        <p name="department_name" id="department_name" class="form-control">
                            <?php echo $department_name; ?>
                        </p>

                        <label for="task_description" class="col-md-4 col-form-label">Task Description:</label>
                        <p name="task_description" id="task_description" class="form-control">
                            <?php echo $row["task_description"]; ?>
                        </p>
                        
                        <div class="row">
                            <div class="col-6">
                                <label for="assigned_at" class="col-md-4 col-form-label">Assigned at:</label>
                                <p name="assigned_at" id="assigned_at" class="form-control input-group-lg">
                                    <?php echo $row["assigned_at"]; ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <label for="deadline" class="col-md-4 col-form-label">Deadline:</label>
                                <p name="deadline" id="deadline" class="form-control input-group-lg">
                                    <?php echo $row["deadline"]; ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="attachment" class="col-md-4 col-form-label">Attachment:</label>
                                <a class="form-control input-group-lg" href="/webfinal/uploads/<?php echo $row['attachment']?>" download><?php echo $row["attachment"]?></a>
                            </div>
                            <div class="col-3">
                                <?php 
                                    $status = "";
                                    if ($row["work_progress"]=="New"){
                                        $status = "primary";
                                    }else if ($row["work_progress"]=="Success"){
                                        $status = "success";
                                    }else if ($row["work_progress"]=="Canceled"){
                                        $status = "danger";
                                    }else if ($row["work_progress"]=="In progress"){
                                        $status = "info";
                                    }else if ($row["work_progress"]=="Waiting"){
                                        $status = "secondary";
                                    }else if ($row["work_progress"]=="Rejected"){
                                        $status = "warning";
                                    }
                                ?>
                                <label for="work_progress" class="col col-form-label">Work Progress:</label>
                                <button class="btn btn-<?php echo $status ?> form-control"><?php echo $row["work_progress"]?></button>
                            </div>
                        </div>

                        <hr>
                    <?php
                        if ($row["work_progress"]=="New" && $_SESSION["userid"]==$row["assignee_id"]){
                    ?>
                        <a href="/webfinal/start_task_submit.php/<?php echo $row["task_id"]; ?>" class="btn btn-success float-right" style="color:white">Start this task</a> 
                    <?php
                        }else if ($row["work_progress"]!="Canceled"){

                        
                    ?>
                        <a href="/webfinal/reports.php/<?php echo $row["task_id"]; ?>" class="btn btn-success float-right" style="color:white">View reports of this task</a>  
                    <?php
                    }
                    if ($_SESSION["position"]=="head" && $_SESSION["department_id"]==$department_id && $row["work_progress"]=="New"){
                    ?>
                        <a href="/webfinal/cancel_task.php/<?php echo $row["task_id"]; ?>" class="btn btn-danger float-left" style="color:white">Cancel this task</a>  
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="/webfinal/javascripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
