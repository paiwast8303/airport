<?php 
include 'include/config.php';
session_start();
if($_SESSION['role']==''){
    header("Location: index.php");
    exit();
}
$roles = $_SESSION['role'];

$query = "SELECT * FROM `admin` WHERE 1=1";

if(isset($_GET['role']) || isset($_GET['status'])) {
    $query = "SELECT * FROM `admin` WHERE 1=1";
    
    if(!empty($_GET['role'])) {
        $role = mysqli_real_escape_string($db, $_GET['role']);
        $query .= " AND `role` = '$role'";
    }
    
    if(!empty($_GET['status'])) {
        $status = mysqli_real_escape_string($db, $_GET['status']);
        $query .= " AND `statuss` = '$status'";
    }
    
    $qadmin = mysqli_query($db, $query);
} else {
    $qadmin = mysqli_query($db, "SELECT * FROM `admin`");
}
$qrole = mysqli_query($db, "SELECT DISTINCT `role` FROM `admin`");
$qstatus = mysqli_query($db, "SELECT DISTINCT `statuss` FROM `admin`");

$countAdminsQuery = "SELECT COUNT(*) as count FROM `admin`";
$countAdminsResult = mysqli_query($db, $countAdminsQuery);
$totalAdmins = mysqli_fetch_assoc($countAdminsResult)['count'];

$countactiveAdminsQuery = "SELECT COUNT(*) as count FROM `admin` WHERE `statuss` = 'active'";
$countactiveAdminsResult = mysqli_query($db, $countactiveAdminsQuery);
$totalactiveAdmins = mysqli_fetch_assoc($countactiveAdminsResult)['count'];


$audit_log_query = mysqli_query($db,"SELECT * FROM `audit_log` ORDER BY `created_at` DESC" );

if(isset($_GET['filter_aut'])){
    $admin_id = mysqli_real_escape_string($db, $_GET['admin_id']);
    $date_range = mysqli_real_escape_string($db, $_GET['date_range']);

    $audit_log_query = "SELECT * FROM `audit_log` WHERE 1=1 ORDER BY `created_at` DESC";

    if(!empty($admin_id)){
        $audit_log_query .= " AND `admin_id` = '$admin_id'";
    }

    if(!empty($date_range)){
        if($date_range == 'today'){
            $audit_log_query .= " AND DATE(`created_at`) = CURDATE()";
        } elseif($date_range == 'week'){
            $audit_log_query .= " AND YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1)";
        } elseif($date_range == 'month'){
            $audit_log_query .= " AND MONTH(`created_at`) = MONTH(CURDATE()) AND YEAR(`created_at`) = YEAR(CURDATE())";
        }
    }

    $audit_log_query = mysqli_query($db, $audit_log_query);
}





?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
   <link rel="stylesheet" href="style/admin_manager.css">
</head>
<body>


  
<div class="modal fade" id="addsadmins" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="adminForm" method="POST" action="include/add_newadmin.php">
  <div class="container-fluid">
    <div class="row g-3">
        <div class="col-md-6">
            <label for="First name" class="form-label">First Name:</label>
            <input name="fname" type="text" class="form-control" id="name" >
        </div>
        <div class="col-md-6">
            <label for="Last name" class="form-label">Last Name:</label>
            <input name="lname" type="text" class="form-control" id="lastName" >
        </div>
      
        <div class="col-md-6">
            <label for="email" class="form-label">Email:</label>
            <input name="Email" type="email" class="form-control" id="email" >
        </div>
        <div class="col-md-6">
            <label for="role" class="form-label">Role:</label>
            <select name="role" class="form-control" id="role">
              <option value="superadmin">superadmin</option>
              <option value="admin">admin</option>
              <option value="Gate Manger">Gate Manger</option>
              <option value="Flight Manger">Flight Manger</option>
              <option value="Staff">Staff</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="status" class="form-label">Status:</label>
            <select name="status" class="form-control" id="status">
              <option value="active">active</option>
              <option value="disable">disable</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label">Password:</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
        </div>
        

    </div>
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button name="adds" type="submit" class="btn btn-primary" form="adminForm">Add</button>
      </div>
    </div>
  </div>
</div>
    <div id="bd">
        <div id="sidebar">
            <h2 style="text-align: center; margin-bottom: 5px;">Admin</h2>
            <hr>
            <ul>
                <li onclick="window.location.href='dashboard.php'">Dashboard</li>
                <?php if($roles == 'superadmin' || $roles == 'admin' ||  $roles == 'Flight Manger' ): ?>
                <li onclick="window.location.href='manage.php'">Flights</li>
                <?php endif; 
                 if($roles == 'superadmin' || $roles == 'admin' ||  $roles == 'Gate Manger' ): ?>
                <li onclick="window.location.href='gate_manager.php'">Gate Management</li>
                <?php endif; 
                    if($roles == 'superadmin' || $roles == 'admin'): ?>
                <li class="active">Admin Manager</li>
                <?php  endif; ?>
                <li onclick="window.location.href='include/logout.php'" class="logout">Log out</li>
            </ul>
        </div>
        <div id="Dashboard">
            <div class="header">
                <div>
                    <h1>Control Panel</h1>
                </div>
                <?php if($roles == 'superadmin'): ?>
                <button type="button" class="btn btn-primary add_f"   data-bs-toggle="modal" data-bs-target="#addsadmins" data-bs-whatever="@mdo">+ New Admin</button>
                <?php  endif; ?>
            </div>
            <div class="main-content">
            

            <div class="card">
                <div class="tabs">
                    <button class="tab-btn active" onclick="switchTab('admins')"> Manage Admins</button>
                    <button class="tab-btn" onclick="switchTab('activities')"> Activities Log</button>
                </div>
                <div id="admins" class="tab-content active">
                    <div class="st">
                    
                        <div class="st-b">
                            <h2><?php echo $totalAdmins; ?></h2>
                            <h4>Total Staff</h4>
                        </div>
                    
                        <div class="st-b">
                            <h2><?php echo $totalactiveAdmins; ?></h2>
                            <h4>Active Admins</h4>
                        </div>
                        
                    </div>
                    <div>

                    
                        <label>Role</label>
                        <form method="GET" action="">
                            <select name="role">
                                <option value="">All Roles</option>
                                <?php while($role_row = mysqli_fetch_assoc($qrole)): ?>
                                    <option value="<?php echo $role_row['role']; ?>"><?php echo ucfirst($role_row['role']); ?></option>
                                <?php endwhile; ?>
                            </select>
                            <label>Status</label>
                            <select name="status">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="disable">Disable</option>
                            </select>
                            <button type="submit" class="btn btn-primary mx-4">Filter</button>
                        </form>
                        <table style="margin-top: 15px;">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created</th>
                                <?php if($roles == 'superadmin'): ?>
                                <th>Actions</th>
                                <?php  endif; ?>
                            </tr>
                            <?php while($row = mysqli_fetch_assoc($qadmin)): ?>

                                <div class="modal fade" id="editeadmins<?php echo $row['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                 <div class="modal-header">
                                   <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                   <form id="adminFormedite<?php echo $row['id'];?>" method="POST" action="include/update_admin.php">
                              <div class="container-fluid">
                                <div class="row g-3">
                                   <div class="col-md-6">
                                      <label for="First name" class="form-label">First Name:</label>
                                      <input name="fname" type="text" class="form-control" id="name"  value="<?php echo $row['fname'] ?>">
                                   </div>
                                   <div class="col-md-6">
                                     <input name="id" type="text" class="form-control" id="lastName" value="<?php echo $row['id']; ?>"  hidden>
                                      <label for="Last name" class="form-label">Last Name:</label>
                                      <input name="lname" type="text" class="form-control" id="lastName" value="<?php echo $row['lname']; ?>">
                                   </div>
                                 
                                   <div class="col-md-6">
                                      <label for="email" class="form-label">Email:</label>
                                      <input name="Email" type="email" class="form-control" id="email" value="<?php echo $row['Email']; ?>">
                                   </div>
                                   <div class="col-md-6">
                                      <label for="role" class="form-label">Role:</label>
                                    <select name="role" class="form-control" id="role">
                                        <option value="superadmin" <?php echo ($row['role'] == 'superadmin') ? 'selected' : ''; ?>>superadmin</option>
                                        <option value="admin" <?php echo ($row['role'] == 'admin') ? 'selected' : ''; ?>>admin</option>
                                        <option value="Gate Manger" <?php echo ($row['role'] == 'Gate Manger') ? 'selected' : ''; ?>>Gate Manger</option>
                                        <option value="Flight Manger" <?php echo ($row['role'] == 'Flight Manger') ? 'selected' : ''; ?>>Flight Manger</option>
                                       
                                    </select>
                                   </div>
                                   <div class="col-md-6">
                                      <label for="status" class="form-label">Status:</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="active" <?php echo ($row['statuss'] == 'active') ? 'selected' : ''; ?>>active</option>
                                        <option value="disable" <?php echo ($row['statuss'] == 'disable') ? 'selected' : ''; ?>>disable</option>
                                    </select>
                                   </div>
                                   <div class="col-md-6">
                                      <label for="password" class="form-label">Password:</label>
                                      <input name="password" type="text" class="form-control" id="password" placeholder="Enter password" value="<?php echo $row['passwords']; ?>">
                                   </div>
                                 </div>
                              </div>
                            </form>
                                 </div>
                                 <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                   <button name="adds" type="submit" class="btn btn-danger" form="adminFormedite<?php echo $row['id'];?>">UPDATE</button>
                                 </div>
                                </div>
                              </div>
                            </div>

                               <tr>
                            <td><?php echo $row['fname'] ?></td>
                          <td><?php echo $row['lname']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                           <td><?php echo $row['role']; ?></td>
                        <td><?php echo $row['statuss']; ?></td>
                         <td><?php echo $row['created_at']; ?></td>
                         <?php if($roles == 'superadmin'): ?>
                      <td>
                    <a href="admin_manager.php?e_id=<?php echo $row['id'];?>" type="button" class="btn btn-warning add_f" data-bs-toggle="modal" data-bs-target="#editeadmins<?php echo $row['id'];?>">Edite</a>
                         </td>
                            <?php  endif; ?>
                           </tr>
                           <?php endwhile; ?>
                        </table>
                    </div>
                </div>
                <div id="activities" class="tab-content">
                    <form method="GET" action="">
                    <div class="filters">
                        <div class="filter-g">
                            <label>Admin:</label>
                            <select name="admin_id" id="adminFilter" >
                                <option value="">All Admins</option>
                                <?php
                                $adminqueery = mysqli_query($db ,"SELECT * FROM `admin`");
                                while($adminrow = mysqli_fetch_assoc($adminqueery)): ?>
                                    <option value="<?php echo $adminrow['id']; ?>"><?php echo $adminrow['fname']. " ". $adminrow['lname']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        
                        <div class="filter-g">
                            <label>Date Range:</label>
                            <select name="date_range" id="dateRangeFilter">
                                <option value="">All Time</option>
                                <option value="today">Today</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                            </select>
                        </div>
                          <button name="filter_aut" type="submit" class="btn btn-primary mx-4">Filter</button>
                    </div>
                    </form>
                   

                    <div id="activitiesContainer">
                        <table style="margin-top: 15px;">
                            <tr>
                                <th>Admin</th>
                                <th>Action</th>
                                <th>Detail</th>
                                <th>Date</th>
                            </tr>
                            <?php while($alog = mysqli_fetch_assoc($audit_log_query)): ?>
                             <tr>
                                <td><?php 
                                $admin_id = $alog['admin_id'];
                                $admin_query = mysqli_query($db, "SELECT fname FROM `admin` WHERE id = '$admin_id'");
                                $admin_row = mysqli_fetch_assoc($admin_query);
                                echo $admin_row['fname'];
                                 ?></td>
                                <td><?php echo $alog['action_type']; ?></td>
                                <td><?php echo $alog['detail']; ?></td>
                                <td><?php echo $alog['created_at']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                      
                        
                        </table>
                    </div>
            </div>
        </div>
            
        </div>
    </div>
    
        <script>
        function switchTab(tab) {

            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

            document.getElementById(tab).classList.add('active');
            event.target.classList.add('active');

            if (tab === 'activities') {
                loadActivities();
            }
        }
        </script>
            <script src="role.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>