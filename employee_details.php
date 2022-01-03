<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:login.php");
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
    <?php
        require_once("conn.php");
        $strlink = $_SERVER['PHP_SELF'];
        $userid = str_replace("/webfinal/employee_details.php/","",$strlink);

        $users = $conn->query("SELECT * FROM users where userid='$userid'");
        if ($users->num_rows > 0) {
            $row = $users->fetch_assoc();
        }
        $department_id = $row['department_id'];
        $departments = $conn->query("SELECT * FROM departments where department_id=$department_id");
        if ($departments->num_rows > 0) {
            $row1 = $departments->fetch_assoc();
        }
        $department_name = $row1['department_name'];
    ?>
    <div class="">
        <!-- The sidebar -->
        <?php
          include 'director_sidebar.php';
        ?>

        <!-- Page content -->
        <div class="content">
            <div style="height:100vh" class="col-md-12">
                <div style="position: relative; top: 15%;" class="form-group editForm">
                    
                  <label for="user_name" class="col-md-4 col-form-label">User Name:</label>
                  <p name="user_name" id="user_name" class="form-control"><?php echo $row["username"]; ?></p>
                  
                  <label for="fullname" class="col-md-4 col-form-label">Full name:</label>
                  <p name="fullname" id="fullname" class="form-control"><?php echo $row["fullname"]; ?></p>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="password" class="col-md-4 col-form-label">Password:</label>
                      <p name="password" id="password" class="form-control" ><?php echo $row["password"]; ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="department" class="col-md-4 col-form-label">Department:</label>
                      <p name="department" id="department" class="form-control" ><?php echo $department_name; ?></p>
                    </div>
                    <div class="col-md-6">
                      <label for="department" class="col-md-4 col-form-label">Position:</label>
                      <p name="department" id="department" class="form-control" ><?php echo $row["position"]; ?></p>
                    </div>
                  </div> 

                  
                  <hr>    
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="/webfinal/javascripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
