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
          }else if ($_SESSION["position"]==="director"){
            include 'director_sidebar.php';
          }else{
            header("location:director_index.php");
          }
        ?>
        <?php
          require_once("conn.php");
        ?>
        <!-- Page content -->
        <div class="content pt-3">
            <button onclick=thisYearOnly() class="btn float-right btn-secondary waitFilter" style="margin: 0 20px 20px 20px">This year</button>
            
            <div class="table-container" style="margin-top:20px">
              <table class="table table-hover table-striped table-bordered">
                  <thead class="thead">
                      <tr>
                          <th class="col-1" scope="col">ID</th>
                          <th class="col-2" scope="col">Employee</th>
                          <th class="col-4" scope="col">Reason</th>
                          <th class="col-2" scope="col">Start day</th>
                          <th class="col-2" scope="col">Number of Day</th>
                          <th class="col-1" scope="col">Status</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                        if ($_SESSION['position']=="head"){
                            $department_id = $_SESSION['department_id'];
                            $userid = $_SESSION['userid'];
                            $result = $conn->query("SELECT * FROM leave_applications WHERE department_id = $department_id AND userid != $userid ORDER BY la_id DESC");
                        }else if ($_SESSION['position']=="director"){
                            $result = $conn->query("SELECT * FROM leave_applications WHERE position = 'head' ORDER BY la_id DESC");
                        }
                      
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          if ($row["status"]=='approved'){
                            $status = 'success';
                          }else if ($row["status"]=='waiting'){
                            $status = 'primary';
                          }else if ($row["status"]=='refused'){
                            $status = 'danger';
                          }
                          //get employee name
                          $userid = $row["userid"];
                          $result1 = $conn->query("SELECT * FROM users WHERE userid = $userid");
                          $row1 = $result1->fetch_assoc();
                          $employee_name = $row1["fullname"];
                          $la_id = $row["la_id"];
                    ?>
                      <tr class="table-<?php echo $status; ?> table_row <?php echo date("Y", strtotime($row["start_on"]))?>" style="transform: rotate(0);">
                          <th scope="row"><?php echo $row["la_id"]?></th>
                          <td><a class="stretched-link" href="/webfinal/leave_application_details.php/<?php echo $la_id?>"></a><?php echo $employee_name; ?></td>
                          <td><?php echo $row["reason"]?></td>
                          <td><?php echo date("d/m/Y", strtotime($row["start_on"]))?></td>
                          <td><?php echo $row["numberofdays"]?></td>
                          <td><?php echo $row["status"]?></td>
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
