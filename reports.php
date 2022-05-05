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
          $strlink = $_SERVER['PHP_SELF'];
          $uncutstr = strstr($strlink, 'reports.php/', FALSE);
          $cutstr = str_replace("reports.php/","",$uncutstr);

          require_once("conn.php");
          $reports = $conn->query("SELECT * FROM reports WHERE task_id = $cutstr");
          $tasks = $conn->query("SELECT * FROM tasks WHERE task_id = $cutstr");
          $task_name = "";
          if ($tasks->num_rows > 0) {
            $row1 = $tasks->fetch_assoc();
            $task_name = $row1['task_name'];
          }
        ?>

        <!-- Page content -->
        <div class="content">
          <?php
            if ($_SESSION["position"]=="employee" && ($row1['work_progress']=="Rejected" || $row1['work_progress']=="In progress")){
            ?>
              <a type="button" href="/webfinal/add_report.php/<?php echo $cutstr?>" class="btn add_task custombtn addbtn" style="margin: 20px 20px 20px 0px; float: right">Report</a>
          <?php
            }
          ?>
          <div class="table-container" style="margin-top:40px">
            <table class="table table-hover table-bordered">
                <thead class="thead">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Task</th>
                        <th scope="col">Report Description</th>
                        <th scope="col">Attachment</th>
                        <th scope="col">Submitted at</th>
                        <th scope="col">Response</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    if ($reports->num_rows > 0) {
                      while ($row = $reports->fetch_assoc()) {
                        if ($row["report_status"]=="Rejected") {
                          $color = "danger";
                        }else if ($row["report_status"]=="Waiting"){
                          $color = "secondary";
                        }
                        else if ($row["report_status"]=="Good"){
                          $color = "success";
                        }
                        else if ($row["report_status"]=="OK"){
                          $color = "primary";
                        }else if ($row["report_status"]=="Bad"){
                          $color = "warning";
                        }
                        
                  ?>
                    <tr style="transform: rotate(0);">
                        <td><?php echo $row["report_id"]?></td>
                        <td><a class="" href="/webfinal/task_details.php/<?php echo $cutstr?>"><?php echo $task_name?></a></td>
                        <td><a class="" href="/webfinal/report_details.php/<?php echo $row["report_id"]?>">Click to see details</a></td>
                        <td><a href="/webfinal/uploads/<?php echo $row['attachment']?>" download><?php echo $row["attachment"]?></a></td>
                        <td><?php echo $row["submit_date"]?></td>    
                        <td><button title="Click to see response" onclick=responseDetails(<?php echo $row['report_id']?>) class="btn btn-<?php echo $color ?>"><?php echo $row["report_status"]?></button></td>
                        <td><?php echo $row["completion_status"]?></td>
                    </tr>
                  <?php
                    $report_id = $row["report_id"];
                    $responses = $conn->query("SELECT * FROM responses WHERE report_id = $report_id");
                    if ($responses->num_rows > 0) {
                      $row2 = $responses->fetch_assoc(); 
                    
                    ?>
                    <tr class="table-danger" id="<?php echo $row["report_id"]?>">
                        <td colspan="1">Comment:</td>
                        <td colspan="2"><?php echo $row2["comment"] ?></td>
                        <td colspan="1">
                          <?php
                            if ($row2['attachment']!="" && $row2['attachment']!= NULL){
                          ?>
                            <a class="form-control input-group-lg" href="/webfinal/uploads/<?php echo $row2['attachment']?>" download><?php echo $row2["attachment"]?></a>
                          <?php
                            }
                          ?>
                        </td>
                        <td>Deadline extended to:</td>
                        <td><?php echo date("d/m/Y", strtotime($row2["deadline"]))?></td>
                    </tr>
          
                  <?php
                    }
                      }
                    }
                  ?>
                </tbody>
            </table>
          </div>
            
        </div>
    </div>
    
    <script type="text/javascript" src="/webfinal/javascripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
