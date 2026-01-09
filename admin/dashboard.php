<?php
include 'include/config.php';

session_start();
if($_SESSION['role']==''){
    header("Location: index.php");
    exit();
}

$roles = $_SESSION['role'];

$qda = mysqli_query($db, "SELECT * FROM `admin`");

$flights = mysqli_query($db, "
    SELECT f.flight_no, f.type, f.statuss, f.dates, f.boarding_time,
           a.name AS airline_name,
           g.gate AS gate_name,
           o.name AS origin_name,
           d.name AS destination_name
    FROM flight f
    JOIN airline a ON f.airline_id = a.id
    JOIN gate g ON f.gate_id = g.id
    JOIN airport o ON f.origin_id = o.id
    JOIN airport d ON f.destination_id = d.id
    WHERE f.dates >= CURDATE()
    ORDER BY f.dates, f.boarding_time
    LIMIT 7
");

$audit_logs = mysqli_query($db, "
SELECT a.fname AS admin_id, al.action_type, al.detail, al.created_at 
FROM audit_log al
JOIN admin a ON al.admin_id = a.id
ORDER BY al.created_at DESC
LIMIT 7
");

$gate_status = mysqli_query($db, "
    SELECT g.gate,t.name AS terminal_name,g.status,f.flight_no FROM gate g
    JOIN terminal t 
        ON g.terminal_id = t.id
    LEFT JOIN flight f 
        ON g.id = f.gate_id
        AND f.dates >= CURDATE()
    ORDER BY g.gate
");

$scheduled_flights = mysqli_query($db, "
    SELECT f.flight_no, a.name AS airline_name, o.name AS origin_name, d.name AS destination_name,
           f.statuss, f.boarding_time
    FROM flight f
    JOIN airline a ON f.airline_id = a.id
    JOIN airport o ON f.origin_id = o.id
    JOIN airport d ON f.destination_id = d.id
    WHERE f.dates = CURDATE()
    ORDER BY f.boarding_time
");

$gate_assignments = mysqli_query($db, "
    SELECT f.flight_no, a.name AS airline_name, f.type, g.gate, f.boarding_time
    FROM flight f
    JOIN airline a ON f.airline_id = a.id
    JOIN gate g ON f.gate_id = g.id
    WHERE f.dates = CURDATE()
    ORDER BY f.boarding_time
");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                <?php if($roles == 'superadmin' || $roles == 'admin' ||  $roles == 'Flight Manger' ): ?>
                <li onclick="window.location.href='manage.php'">Flights</li>
                <?php endif;
                 if($roles == 'superadmin' || $roles == 'admin' ||  $roles == 'Gate Manger' ): ?>
                <li onclick="window.location.href='gate_manager.php'">Gate Management</li>
                <?php endif; 
                    if($roles == 'superadmin' || $roles == 'admin'): ?>
                <li onclick="window.location.href='admin_manager.php'">Admin Manager</li>
                <?php  endif; ?>
                <li onclick="window.location.href='include/logout.php'" class="logout">Log out</li>
            </ul>
        </div>
        <div id="Dashboard">
            <div class="header">
                <div>
                    <h1>Dashboard</h1>
                </div>
                <div>
                    <p>Welcome, <strong id="adminName"><?php echo $_SESSION['name'].' ('.$_SESSION['role'].')'; ?></strong></p>
                </div>
            </div>
            

             <div class="dashboardd">
                <div class="card">
                    <h3> Next Flights</h3>
                    <table>
                        
                            <tr>
                                <th>Flight No</th>
                                <th>Airline</th>
                                <th>Status</th>
                            </tr>
                      
                            <?php while($row = mysqli_fetch_assoc($flights)): ?>
                                  <tr>
                                <td><?php echo $row['flight_no']; ?></td>
                                <td><?php echo $row['airline_name']; ?></td>
                                <td><?php echo $row['statuss']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                        
                    </table>
                </div>
                
                <div class="card">
                    <h3> Audit Log</h3>
                    <table>
                        
                            <tr>
                                <th>Admin</th>
                                <th>Action</th>
                                <th>detail</th>
                                <th>Date</th>
                            </tr>
                       
                            <?php while($row = mysqli_fetch_assoc($audit_logs)): ?>
                                  <tr>
                                <td><?php echo $row['admin_id']; ?></td>
                                <td><?php echo $row['action_type']; ?></td>
                                <td><?php echo $row['detail']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                       
                    </table>
                </div>
                <?php if ($roles != 'Flight Manger'): ?>
                <div class="card">
    <h3>Gate Status Overview</h3>
    <table>
        <tr>
            <th>Gate</th>
            <th>Terminal</th>
            <th>Status</th>
            <th>Current Flight</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($gate_status)): ?>
        <tr>
            <td><?php echo $row['gate']; ?></td>
            <td><?php echo $row['terminal_name']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['flight_no'] ? $row['flight_no'] : '-'; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<div class="card">
    <h3>Gate Assignment Queue</h3>
    <table>
        <tr>
            <th>Flight No</th>
            <th>Airline</th>
            <th>Type</th>
            <th>Assigned Gate</th>
            <th>Time</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($gate_assignments)): ?>
        <tr>
            <td><?php echo $row['flight_no']; ?></td>
            <td><?php echo $row['airline_name']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['gate']; ?></td>
            <td><?php echo date("h:i A", strtotime($row['boarding_time'])); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php endif; ?>


            </div>
            <br>
            <?php if ($roles != 'Gate Manger'): ?>
            <div class="card">
    <h3>Scheduled Flights</h3>
    <table>
        <tr>
            <th>Flight No</th>
            <th>Airline</th>
            <th>Route</th>
            <th>Status</th>
            <th>Boarding Time</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($scheduled_flights)): ?>
        <tr>
            <td><?php echo $row['flight_no']; ?></td>
            <td><?php echo $row['airline_name']; ?></td>
            <td><?php echo $row['origin_name'] . " → " . $row['destination_name']; ?></td>
            <td><?php echo $row['statuss']; ?></td>
            <td><?php echo date("h:i A", strtotime($row['boarding_time'])); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php endif; ?>
<br>
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

 <br>
        </div>
    </div>
   
</body>
</html>