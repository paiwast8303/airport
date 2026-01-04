<?php 
include 'include/config.php';

$qadmin = mysqli_query($db, "SELECT * FROM `admin`");
$qrole = mysqli_query($db, "SELECT  `role` FROM `admin`");




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
                <li onclick="window.location.href='dashboard.php'" >Dashboard</li>
                <li onclick="window.location.href='manage.php'">Flights</li>
                <li onclick="window.location.href='gate_manager.php'">Gate Management</li>
                <li class="active">Admin Manager</li>
            </ul>
        </div>
        <div id="Dashboard">
            <div class="header">
                <div>
                    <h1>Control Panel</h1>
                </div>
                <button type="button" class="btn btn-primary add_f"   data-bs-toggle="modal" data-bs-target="#addsadmins" data-bs-whatever="@mdo">+ New Admin</button>
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
                            <h2>0</h2>
                            <h4>Total Staff</h4>
                        </div>
                        <div class="st-b">
                            <h2>0</h2>
                            <h4>Total Admin</h4>
                        </div>
                        <div class="st-b">
                            <h2>0</h2>
                            <h4>Active Admins</h4>
                        </div>
                        
                    </div>
                    <div>
                        <label>Role</label>
                        <select>
                            <option>All Roles</option>
                            <option>Admin</option>
                            <option>Flight Manager</option>
                            <option>Gate Agent</option>
                            <option>Staff</option>
                        </select>
                        <label>Status</label>
                        <select>
                            <option>All Status</option>
                            <option>Active</option>
                            <option>InActive</option>
                        </select>
                        <button style="margin-left: 15px; padding: 8px 12px; border-radius: 5px; background-color: #1e3c72; color: white; border: none;">Filter</button>
                        <table style="margin-top: 15px;">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
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
                                        <option value="Staff" <?php echo ($row['role'] == 'Staff') ? 'selected' : ''; ?>>Staff</option>
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
                                                      <td><?php echo $row['role']; ?></td>
                                                      <td><?php echo $row['statuss']; ?></td>
                                                      <td><?php echo $row['created_at']; ?></td>
                                                      <td>
                                                      <a href="admin_manager.php?e_id=<?php echo $row['id'];?>" type="button" class="btn btn-warning add_f" data-bs-toggle="modal" data-bs-target="#editeadmins<?php echo $row['id'];?>">Edite</a>
                                                      </td>
                                                   </tr>
                                                   <?php endwhile; ?>
                        </table>
                    </div>
                </div>
                <div id="activities" class="tab-content">
                    <div class="filters">
                        <div class="filter-g">
                            <label>Admin:</label>
                            <select id="adminFilter" >
                                <option value="">All Admins</option>
                            </select>
                        </div>
                        
                        <div class="filter-g">
                            <label>Date Range:</label>
                            <select id="dateRangeFilter">
                                <option value="">All Time</option>
                                <option value="today">Today</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                            </select>
                        </div>
                    </div>

                    <div id="activitiesContainer">
                        <table style="margin-top: 15px;">
                            <tr>
                                <th>Admin</th>
                                <th>Action</th>
                                <th>Date</th>
                            </tr>
                      
                            <tr>
                                <td>Miran</td>
                                <td>Added new flight AA123</td>
                                <td>2024-10-01</td>
                            </tr>
                            <tr>
                                <td>Paiwast</td>
                                <td>Updated gate A1 status to Closed</td>
                                <td>2024-10-02</td>
                            </tr>
                            <tr>
                                <td>Mashwd</td>
                                <td>Deleted admin user Sonia</td>
                                <td>2024-10-03</td>
                            </tr>
                        
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