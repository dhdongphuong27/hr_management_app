<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:/webfinal/login.php");
    }
    include 'director_only.php';
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
          include 'director_sidebar.php';
        ?>

        <!-- Page content -->
        <div class="content">
            <a  style="margin: 20px 20px 20px 20px" type="button" href="/webfinal/add_department.php" class="btn add_department custombtn addbtn">Add department</a>
            <table class="table table-hover table-striped table-bordered">
                <thead class="thead">
                    <tr>
                        <th  scope="col">ID</th>
                        <th class="col-2" scope="col">Department name</th>
                        <th class="col-1" scope="col">Room</th>
                        <th class="col-6" scope="col">Description</th>
                        <th class="col-3"scope="col">Header</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    require_once("conn.php");
                    $sql = "SELECT * FROM departments ORDER BY department_id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                  ?>
                    <tr style="transform: rotate(0);">
                        <th scope="row"><?php echo $row["department_id"]?><a class="stretched-link" href="department_details.php/<?php echo $row["department_id"];?>"></th>
                        <td><?php echo $row["department_name"]?></td>
                        <td><?php echo $row["room_id"]?></td>
                        <td><?php
                              $shortened_description = substr($row["department_description"],0,69);
                              $shortened_description .= ". . .";
                              echo strlen($row["department_description"])>69?$shortened_description:$row["department_description"] ?>
                        </td>
                        <td>
                          <?php
                            //get header name
                            $head_id = $row['head_id'];
                            $users = $conn->query("SELECT * FROM users where userid='$head_id'");
                            $head_name = "";
                            if ($users->num_rows > 0) {
                              $row1 = $users->fetch_assoc();
                              $head_name = $row1['fullname'];
                            }
                            echo $head_name;
                          ?>
                        </td>
                    </tr>
                  <?php
                      }
                    }
                  ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="/webfinal/javascripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
