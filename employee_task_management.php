<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:login.php");
    }
    include 'employee_only.php';
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
          include 'employee_sidebar.php';
        ?>

        <!-- Page content -->
        <div class="content">
            <table class="table table-hover table-striped table-bordered">
                <thead class="thead">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Task Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Attachment</th>
                        <th scope="col">Assign at</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Work Progress</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    require_once("conn.php");
                    $userid = $_SESSION['userid'];
                    $sql = "SELECT * FROM tasks WHERE assignee_id = $userid";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
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
                    <tr style="transform: rotate(0);" class="table-<?php echo $status; ?>">
                        <th scope="row"><?php echo $row["task_id"]?></th>
                        <td><a class="stretched-link" href="/webfinal/task_details.php/<?php echo $row["task_id"]?>"><?php echo $row["task_name"]?></a></td>
                        <td><?php echo $row["task_description"]?></td>
                        <td><a href="/webfinal/uploads/<?php echo $row['attachment']?>" download><?php echo $row["attachment"]?></a></td>
                        <td>31/12/2021</td>
                        <td>31/01/2022</td>
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
    
    <script type="text/javascript" src="javascripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
