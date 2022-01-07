<?php
            require_once("conn.php");
            $userid = $_SESSION["userid"];

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
        <!-- Page content -->
        <div class="content">
            <div style="height:100vh" class="col-md-12">
                <div style="position: relative; top: 15%;" class="form-group editForm">
                  <label for="user_name" class="col-md-4 col-form-label">User Name:</label>
                  <p name="user_name" id="user_name" class="form-control"><?php echo $row["username"]; ?></p>
                  
                  <label for="fullname" class="col-md-4 col-form-label">Full name:</label>
                  <p name="fullname" id="fullname" class="form-control"><?php echo $row["fullname"]; ?></p>
                  <div class="row form-group form_change_password" style="display: none">
                    
                    <form action="/webfinal/change_password.php" method="post">
                      <div class="col-md-5 form-group">
                        <label for="old_password_input" class="">Old Password:</label>
                        <input type="password" required type="text" name="old_password_input" id="old_password_input" class="form-control">
                      </div>
                      <div class="col-md-5 form-group">
                        <label for="new_password_input" class="">New Password:</label>
                        <input type="password" required type="text" name="new_password_input" id="new_password_input" class="form-control">
                      </div>
                      <div class="col-md-5 form-group">
                        <label for="re_password_input" class="">Re-enter new password:</label>
                        <input type="password" required type="text" name="re_password_input" id="re_password_input" class="form-control">
                      </div>
                      <button type="submit" name="save" class="btn btn-success">Save password</button>
                    </form>
                  </div>
                  <div class="row password_row">
                    <div class="col-md-3">
                      <button onclick="toggleChangePwdForm()" type="button" class="btn btn-primary form-control">Change password</button>
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
                  <form action="/webfinal/change_profile_pic.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-4">
                        <label for="avatar" class="col-form-label">Change profile picture</label>
                        <input required type="file" name="avatar" id="avatar" class="form-control" accept=".gif,.jpg,.png,.jpeg,.svg">
                      </div>
                      <div class="col-md-1">
                        <label for="save" class="col-md-4 col-form-label">.</label>
                        <button name="save" type="submit" class="btn btn-success form-control">Save</button>
                      </div>
                    </div>
                  </form>
                  <hr>    
                </div>
            </div>
        </div>