<?php
include 'include/config.php';

session_start();

$roles = $_SESSION['role'];

$qda = mysqli_query($db, "SELECT * FROM `admin`")




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href="style/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
    
    <div id="bd">
        <div id="sidebar">
            <h2 style="text-align: center; margin-bottom: 5px;">Admin</h2>
            <hr>
            <ul>
                <li class="active">Dashboard</li>
                <li onclick="window.location.href='manage.php'">Flights</li>
                <li onclick="window.location.href='gate_manager.php'">Gate Management</li>
                <li onclick="window.location.href='admin_manager.php'">Admin Manager</li>
                <li class="logout">Log out</li>
            </ul>
        </div>
        <div id="Dashboard">
            <div class="header">
                <div>
                    <h1>Dashboard</h1>
                </div>
                <div>
                    <p>Welcome, <strong id="adminName"><?php echo $_SESSION['name']; ?></strong></p>
                </div>
            </div>
            <?php 
            if($roles == 'superadmin' || $roles == 'admin'):
         
            ?>
                        <div class="card">
                    <h3> Admin list</h3>
                    <table>
                        
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created</th>
                            </tr>
                            <?php while($row = mysqli_fetch_assoc($qda)): ?>
                                  <tr>
                                <td><?php echo $row['fname']." ". $row['lname']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['role']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                            </tr>
                        <?php endwhile; ?>


         
                    </table>
                </div>
                <?php 
                endif; ?>

             <div class="dashboardd">
                <div class="card">
                    <h3> Next Flights</h3>
                    <table>
                        
                            <tr>
                                <th>Flight No</th>
                                <th>Airline</th>
                                <th>Status</th>
                            </tr>
                      
                            <tr>
                                <td>KK123</td>
                                <td>Kurdistan Airlines</td>
                                <td>On Time</td>
                            </tr>
                            <tr>
                                <td>AA456</td>
                                <td>Arbat Airlines</td>
                                <td>Delayed</td>
                            </tr>
                            <tr>
                                <td>SS789</td>
                                <td>suli Air Lines</td>
                                <td>On Time</td>
                            </tr>
                        
                    </table>
                </div>
                
                <div class="card">
                    <h3> Audit Log</h3>
                    <table>
                        
                            <tr>
                                <th>Admin</th>
                                <th>Action</th>
                                <th>Date</th>
                            </tr>
                       
                            <tr>
                                <td>Miran</td>
                                <td>Updated flight AA123 status</td>
                                <td>2024-03-25 14:30</td>
                            </tr>
                            <tr>
                                <td>miran</td>
                                <td>Added new flight UA789</td>
                                <td>2024-03-25 11:15</td>
                            </tr>
                            <tr>
                                <td>Mira</td>
                                <td>deleted flight DL456</td>
                                <td>2024-03-25 09:45</td>
                            </tr>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>

   
</body>
</html>