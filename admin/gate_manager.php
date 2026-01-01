<?php

include 'include/config.php';

$qgate = mysqli_query($db, "SELECT `g`.`gate`, `t`.`name` FROM `gate` as `g`
JOIN `terminal` as `t` on   `t`.`id` = `g`.`terminal_id`");

$total_gates = mysqli_num_rows($qgate);



?>




<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GATE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style/gate.css">
</head>
<body>
    
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
  <div class="container-fluid">
    <div class="row g-3">
        <div class="col-md-6">
            <label for="gateNo" class="form-label">Gate No:</label>
            <input type="text" class="form-control" id="gateNo" placeholder="e.g., A1">
        </div>
        <div class="col-md-6">
            <label for="Terminal" class="form-label">Terminal:</label>
            <input type="text" class="form-control" id="Terminal" placeholder="e.g., Terminal 1">
        </div>
    </div>
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
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
                <li class="active">Gate Management</li>
                <li onclick="window.location.href='admin_manager.html'">Admin Manager</li>
            </ul>
        </div>
        <div id="Dashboard">
            <div class="header">
                <div>
                    <h1>Gates</h1>
                </div>
                <button type="button" class="btn btn-primary add_f"   data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">+ Add Gate</button>
            </div>
            <div class="main-content">
            

            <div class="card">
                
            
                    <div class="st">
                        <div class="st-b">
                            <h2><?php echo $total_gates; ?></h2>
                            <h4>Total Gates</h4>
                        </div>
                        <div class="st-b">
                            <h2>0</h2>
                            <h4>Total Available</h4>
                        </div>
                        <div class="st-b">
                            <h2>0</h2>
                            <h4>Occupied</h4>
                        </div>
                        <div class="st-b">
                            <h2>0</h2>
                            <h4>Maintenance</h4>
                        </div>
                    </div>
                    <div>
                        <label>Terminal</label>
                        <select>
                            <option>All Terminals</option>
                            <option>Terminal 1</option>
                            <option>Terminal 2</option>
                        </select>
                        <label>Gate status</label>
                        <select>
                            <option>All Status</option>
                            <option>Available</option>
                            <option>Close</option>
                        </select>
                        <table style="margin-top: 15px;">
                            <tr>
                                <th>Gate No</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            <?php while($row = mysqli_fetch_assoc($qgate)): ?>
                            <tr>
                               
                                <td><?php echo $row['gate']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>Available</td>
                                <td>
                                    <select>
                                        <option>Available</option>
                                        <option>Close</option>
                                        <option>Maintenance</option>
                                    </select>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                    </div>
                </div>
                   
            </div>
        </div>
            
        </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script src="role.js"></script>

    </body>
</html>