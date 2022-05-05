<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:/webfinal/login.php");
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
        <div class="content">
            <div class="row">
                <div class="col-9">
                    <div style = "position: relative; top: 20%;">
                        <form action="add_task_submit.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="task_name"><b>Task Name</b></label>
                                <input type="text" class="form-control" name="task_name" id="task_name" aria-describedby="name"
                                     autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="task_description"><b>Task Description</b></label>
                                <textarea oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' name="task_description"
                            id="task_description" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="assignee_id"><b>Assign to:</b></label>
                                <select class="form-control" name="assignee_id" id="assignee_id">
                                    <?php
                                        require_once("conn.php");
                                        $department_id = $_SESSION['department_id'];
                                        $sql = "SELECT * FROM users WHERE position != 'director' AND position != 'head' AND department_id = $department_id ORDER BY fullname";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row["userid"]?>"><?php echo $row["fullname"]?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="attachment"><b>Attachment</b></label>
                                <input type="file" class="form-control" name="attachment" id="attachment" accept=".gif,.jpg,.jpeg,.png,.doc,.docx,.xlsx,.pptx,.ppt,.csv">
                            </div>
                            <div class="form-group">
                                <label for="deadline">Deadline:</label>
                                <input type="datetime-local" id="deadline" name="deadline">
                            </div>
                            <hr>
                            <button type="submit" name="add_task" id="add_btn" class="btn custombtn">Add</button>
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
