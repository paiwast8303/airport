<?php

include 'include/config.php';

session_start();
if($_SESSION['role']==''){
    header("Location: index.php");
    exit();
}
$roles = $_SESSION['role'];

$qgate = mysqli_query($db, "SELECT `g`.`id`, `g`.`gate`, `t`.`name`, `g`.`status` FROM `gate` as `g`
JOIN `terminal` as `t` on   `t`.`id` = `g`.`terminal_id`");
$terminal_query = mysqli_query($db, "SELECT * FROM `terminal`");
$total_gates = mysqli_num_rows($qgate);

if(isset($_POST['filter_button'])){
    $filter_terminal = $_POST['filter_terminal'];
    $filter_status = $_POST['filter_status'];

    $query_conditions = [];

    if($filter_terminal != ''){
        $query_conditions[] = "`t`.`name` = '$filter_terminal'";
    }

    if($filter_status != ''){
        $query_conditions[] = "`g`.`status` = '$filter_status'";
    }

    if(count($query_conditions) > 0){
        $where_clause = " WHERE " . implode(" AND ", $query_conditions);
        $qgate = mysqli_query($db, "SELECT `g`.`id`, `g`.`gate`, `t`.`name`, `g`.`status` FROM `gate` as `g`
        JOIN `terminal` as `t` on   `t`.`id` = `g`.`terminal_id`" . $where_clause);
    }
}
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">ADD GATE</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="modal-body">
      <form name="addGateForm" id="addGateForm" action="include/gate/add_gate.php" method="post">
  <div class="container-fluid">
    <div class="row g-3">
      <div class="col-md-6">
        <label for="gateNo" class="form-label">Gate No:</label>
        <input name="gate_name" type="text" class="form-control" id="gateNo" placeholder="e.g., A1">
      </div>
      <div class="col-md-6">
        <label for="Terminal" class="form-label">Terminal:</label>
         <select class="form-control" id="Terminal" name="Terminal">
            <option selected disabled>Select Terminal</option>
            <?php while($term = mysqli_fetch_assoc($terminal_query)): ?>
            <option value="<?php echo $term['id']; ?>"><?php echo $term['name']; ?></option>
            <?php endwhile; ?>
        </select>
      </div>
        <div class="col-md-6">
        <label for="Status" class="form-label">Status:</label>
          <select class="form-control" id="Status" name="Status">
            <option value="Available">Available</option>
            <option value="Closed">Closed</option>
            </select>
      </div>
    </div>
  </div>
</form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button form="addGateForm" type="submit" class="btn btn-primary">ADD</button>
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
                <li class="active" >Gate Management</li>
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
                        <form method="post" action="">
                            <label>Terminal</label>
                            <select name="filter_terminal">
                                <option value="">All Terminals</option>
                                <option value="Terminal1">Terminal 1</option>
                                <option value="Terminal2">Terminal 2</option>
                            </select>
                            <label>Gate status</label>
                            <select name="filter_status">
                                <option value="">All Status</option>
                                <option value="Available">Available</option>
                                <option value="Closed">Closed</option>
                            </select>
                            <button name="filter_button" type="submit" class="btn btn-primary mx-4">Filter</button>
                        </form>
                        <table style="margin-top: 15px;">
                            <tr>
                                <th>Gate No</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            <?php while($row = mysqli_fetch_assoc($qgate)): ?>

                                <div class="modal fade" id="gateupdate-id-<?php echo $row['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">UPDATE GATE</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="updategate-id-<?php echo $row['id'];?>" id="updategate-id-<?php echo $row['id'];?>" action="include/gate/update_gate.php" method="post">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
  <div class="container-fluid">
    <div class="row g-3">
        <div class="col-md-6">
            <label for="gateNo" class="form-label">Gate No:</label>
            <input name="gate_name" type="text" class="form-control" id="gateNo" placeholder="e.g., A1" value="<?php echo $row['gate']; ?>">
        </div>
        <div class="col-md-6">
            <label for="Terminal" class="form-label">Terminal:</label>
              <select name="terminal" class="form-control" id="Terminal">
               <?php 
               $terminal_query_update = mysqli_query($db, "SELECT * FROM `terminal`");
               while($term = mysqli_fetch_assoc($terminal_query_update)): ?>
               <option value="<?php echo $term['id']; ?>" <?php if ($row['name'] == $term['name']) echo 'selected'; ?>><?php echo $term['name']; ?></option>
               <?php endwhile; ?>
                </select>
        </div>
            <div class="col-md-6">
            <label for="Status" class="form-label">Status:</label>
              <select name="status" class="form-control" id="Status">
               <option value="Available" <?php if ($row['status'] == 'Available') echo 'selected'; ?>>Available</option>
                <option value="Closed" <?php if ($row['status'] == 'Closed') echo 'selected'; ?>>Closed</option>
                </select>
        </div>
    </div>
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="updategate-id-<?php echo $row['id']?>" type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
                            <tr>
                                <td><?php echo $row['gate']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                <button type="button" class="btn btn-warning add_f" data-bs-toggle="modal" data-bs-target="#gateupdate-id-<?php echo $row['id'];?>">Edit</button>
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