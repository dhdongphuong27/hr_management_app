<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:login.php");
    }
    include 'head_only.php';
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
          include 'head_sidebar.php';
        ?>

        <!-- Page content -->
        <div class="content pt-3">
            <a type="button" href="/webfinal/add_task.php" class="btn add_task custombtn addbtn">Add Task</a>
            <button onclick=waitingTaskOnly() class="btn add_task btn-secondary addbtn" style="margin-right: 20px">Waiting task only</button>
            <div class="table-container" style="margin-top:20px">
              <table class="table table-hover table-striped table-bordered">
                  <thead class="thead">
                      <tr>
                          <th class="col-1" scope="col">ID</th>
                          <th scope="col">Task Name</th>
                          <th class="col-2" scope="col">Description</th>
                          <th class="col-3" scope="col">Assignee</th>
                          <th scope="col">Attachment</th>
                          <th scope="col">Deadline</th>
                          <th scope="col">Work Progress</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                      require_once("conn.php");
                      $department_id = $_SESSION['department_id'];
                      $sql = "SELECT * FROM tasks WHERE department_id = $department_id";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          //get assignee name
                          $assignee_id = $row['assignee_id'];
                          $users = $conn->query("SELECT * FROM users where userid='$assignee_id'");
                          $assignee_name = "";
                          if ($users->num_rows > 0) {
                            $row1 = $users->fetch_assoc();
                            $assignee_name = $row1['fullname'];
                          }
                    ?>
                      <tr class="<?php echo $row["work_progress"] ?> table_row" style="transform: rotate(0);">
                          <th scope="row"><?php echo $row["task_id"]?></th>
                          <td><?php echo $row["task_name"]?></td>
                          <td><a class="stretched-link" href="/webfinal/task_details.php/<?php echo $row["task_id"]?>">Click to see details</a></td>
                          <td><?php echo $assignee_name?></td>
                          <td><a href="/webfinal/uploads/<?php echo $row['attachment']?>" download><?php echo $row["attachment"]?></a></td>
                          <td><?php echo date("h:m, d/m/Y", strtotime($row["deadline"]))?></td>
                          <td><?php echo $row["work_progress"] ?></td>
                      </tr>
                    <?php
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
