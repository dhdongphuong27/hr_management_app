<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:login.php");
    }
    if ($_SESSION["position"]=="head"){
        header("location:head_index.php");
    }else if($_SESSION["position"]=="employee"){
        header("location:employee_index.php");
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
        $department_id = str_replace("/webfinal/department_details.php/","",$strlink);

        $departments = $conn->query("SELECT * FROM departments where department_id='$department_id'");
        $department_name = "";
        if ($departments->num_rows > 0) {
            $row = $departments->fetch_assoc();
        }
    ?>
    <div class="">
        <!-- The sidebar -->
        <div class="sidebar">
            <a href="/webfinal/director_index.php">How to use</a>
            <a href="/webfinal/account_management.php">Account management</a>
            <a class="active" href="/webfinal/department_management.php">Department management</a> 
            <a href="logout.php">Logout</a>
        </div>

        <!-- Page content -->
        <div class="content">
            <div style="height:100vh" class="col-md-12">
                <div style="position: relative; top: 15%;" class="form-group editForm">
                    <form method="post" action="/webfinal/edit_department_submit.php">
                        <input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
                        <label for="department_name" class="col-md-4 col-form-label">Department Name:</label>
                        <textarea name="department_name" id="department_name" class="form-control" rows="1" readonly required><?php echo $row["department_name"]; ?></textarea>
                        
                        <label for="room_id" class="col-md-4 col-form-label">Room:</label>
                        <textarea name="room_id" id="room_id" class="form-control" rows="1" readonly required><?php echo $row["room_id"]; ?></textarea>

                        <label for="department_description" class="col-md-4 col-form-label">Content:</label>
                        <textarea oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' name="department_description"
                            id="department_description" class="form-control" rows="2" readonly required><?php echo $row["department_description"]; ?></textarea>
                        
                        <label for="head_id">Head</label>
                        <select class="form-control" name="head_id" id="head_id" disabled>
                            <option value=""></option>
                            <?php
                                $result1 = $conn->query("SELECT * FROM users WHERE department_id=$department_id");
                                if ($result1->num_rows > 0) {
                                    while ($row1 = $result1->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row1["userid"]?>" <?php echo $row1["userid"]==$row["head_id"]?' selected="selected"': '' ?> ><?php echo $row1["fullname"]?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                        <hr>
                        
                        <button type="submit" name="save_department" class="btn btn-primary saveBtn">Save</button>
                    </form>   
                    <button class="btn btn-danger deleteBtn">Delete</button>     
                    <button onclick="toggleEdit(event)" class="btn btn-success editBtn">Edit</button>   
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="/webfinal/javascripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
