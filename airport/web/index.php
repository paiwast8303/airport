<?php 

include('config/config.php');

$query_admin = mysqli_query($db,"SELECT * FROM `admin`");

$now = new DateTime();

?>



<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>airport</title>

    <link rel="stylesheet" href="style/style.css" >

</head>
<body>
    
<div id="bd">
        <div id="sidebar">
            <h2>Airport Admin</h2>
            <hr style="color: blue;">
            <ul>
                <li class="active">Dashboard</li>
                <li>Flights</li>
            </ul>
        </div>
        <div id="Dashboard">
            <div class="header">
                <div>
                    <h1>Dashboard</h1>
                </div>
                <div >
                    <p>Welcome, <strong id="adminName">Miran</strong></p>
                    <p ><?php echo $now->format('l, F j, Y'); ?></p>
                </div>
            </div>
             <div class="dashboardd">
                <div class="card">
                    <h3> Admin list</h3>
                    <table>
                        
                            <tr>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Created</th>
                            </tr>


                            <?php
                            while($row = mysqli_fetch_assoc($query_admin)):
                            ?>
                       
                            <tr>
                                <td><?php echo $row['user_name'] ?></td>
                                <td><?php echo $row['role'] ?></td>
                                <td><?php echo $row['created_at'] ?></td>
                            </tr>

                            <?php endwhile; ?>
                      
                        
                    </table>
                </div>
                
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
                                <td><span class="status-badge status-on-time">On Time</span></td>
                            </tr>
                            <tr>
                                <td>AA456</td>
                                <td>Arbat Airlines</td>
                                <td><span class="status-badge status-delayed">Delayed</span></td>
                            </tr>
                            <tr>
                                <td>SS789</td>
                                <td>suli Air Lines</td>
                                <td><span class="status-badge status-on-time">On Time</span></td>
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