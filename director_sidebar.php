<div class="sidebar">
    <div class="d-flex justify-content-center sidebar_header">
        
        <div class="sidebar-header-avt">
            <img id="avt" src="<?php echo $_SESSION["profilepic"]?>" class="avatar-primary border border-dark rounded-circle" />
        </div>
    </div>
    <div style="color: white; padding: 10px; word-wrap: break-word; margin-bottom:30px">
        <h4 id="username" class="text-center font-weight-light" style="margin-bottom: 0.5rem;">
            <?php echo $_SESSION["fullname"]?>
        </h4>
        <h6 id="username" class="text-center font-weight-light" style="margin-bottom: 0.5rem;">
            <?php echo $_SESSION["position"]?>
        </h6>
    </div>
    <a href="/webfinal/director_index.php">Main page</a>
    <a href="/webfinal/account_management.php">Account management</a>
    <a href="/webfinal/department_management.php">Department management</a> 
    <a href="/webfinal/leave_management.php">Leave management</a>
    <a href="/webfinal/logout.php">Logout</a>
</div>