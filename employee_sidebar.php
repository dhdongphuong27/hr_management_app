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
            <?php
                include 'conn.php';
                $dep_id = $_SESSION["department_id"];
                $deps = $conn->query("SELECT * FROM departments where department_id='$dep_id'");
                $dep_row = $deps->fetch_assoc();
                $dep_name = $dep_row['department_name'];
            ?>
            <span style="text-transform: capitalize;"><?php echo $_SESSION["position"]?></span> of <?php echo $dep_name?>
        </h6>
    </div>
    <a href="/webfinal/employee_index.php">Task management</a>
    <a href="/webfinal/employee_information.php">Personal infomation</a>
    <a href="/webfinal/worker_leave_management.php">Leave applications</a> 
    <a href="/webfinal/logout.php">Logout</a>
</div>