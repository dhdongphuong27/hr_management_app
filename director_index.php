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
    <div class="">
        <!-- The sidebar -->
        <?php
          include 'director_sidebar.php';
        ?>

        <!-- Page content -->
        <div class="content">
            <h2 class="text-center" style = "margin-top: 40px">
              How to use director's function
            </h2>
            <p style="margin-top:40px; font-size: 25px">
              This is director's main page: 
            </p>
            <p style="font-size: 23px">
              &emsp;- Employee account management functions include: <br>
              <span style="font-size: 18px">
                &emsp;&emsp;+ View a list of employees of the whole company: only show a summary of some necessary information.<br>
                &emsp;&emsp;+ When selecting a specific employee: see all details of that employee.<br>
                &emsp;&emsp;+ Reset the password for an employee back to the default value.<br>
                &emsp;&emsp;+ Add a new employee: the administrator will enter the full name, username, select the department that the employee belongs to. Each employee belongs to only one department and this information will never change.<br>
              </span>
              &emsp;- Departmental management functions include: <br>
              <span style="font-size: 18px">
                &emsp;&emsp;+ Add a new department: need to enter information such as department name, description and room number of the department.<br>
                &emsp;&emsp;+ Edit information of existing departments.<br>
                &emsp;&emsp;+ Appoint an employee to be the head of the department.<br>
              </span>
              &emsp;- Leave management functions include: <br>
              <span style="font-size: 18px">
                &emsp;&emsp;+ The leave request approver's interface will display a list of leave requests by time, the latest one coming first.<br>
                &emsp;&emsp;+ When clicking on each specific request, the approver will see detailed information (detailed description, attached file) and have the function to make one of two options: approve or not approve. <br>
              </span>

            </p>
        </div>
    </div>
    
    <script src="/webfinal/javascripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
