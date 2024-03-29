<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:/webfinal/login.php");
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
        <?php
          $strlink = $_SERVER['PHP_SELF'];
          $uncutstr = strstr($strlink, 'add_report.php/', FALSE);
          $cutstr = str_replace("add_report.php/","",$uncutstr);
        ?>
        <!-- Page content -->
        <div class="content">
            <div class="row">
                <div class="col-9">
                    <div class="form_container">
                        <form action="/webfinal/add_report_submit.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="task_id" id="task_id" value="<?php echo $cutstr ?>">
                            <div class="form-group">
                                <label for="report_description"><b>Report Description</b></label>
                                <textarea oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' name="report_description"
                            id="report_description" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="attachment"><b>Attachment</b></label>
                                <input type="file" class="form-control" name="attachment" id="attachment" accept=".gif,.jpg,.jpeg,.png,.doc,.docx,.xlsx,.pptx,.ppt,.csv">
                            </div>
                            <hr>
                            <button type="submit" name="add_report" id="add_btn" class="btn custombtn">Submit report</button>
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
