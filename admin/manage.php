<?php 
include('include/config.php');
session_start();
if($_SESSION['role']=='' || $_SESSION['role']== null || $_SESSION['role']== 'Gate Manger'){
    header("Location: index.php");
    exit();
}
$roles = $_SESSION['role'];

$qgate = mysqli_query($db, "SELECT * FROM `gate`");

$fl_query_filter = "SELECT f.flight_no, f.type, f.statuss, f.dates, f.boarding_time,f.departure_time,f.arrival_time,
           a.name AS airline_name,
           g.gate AS gate_name,
           o.name AS origin_name,
           d.name AS destination_name
    FROM flight f
    JOIN airline a ON f.airline_id = a.id
    JOIN gate g ON f.gate_id = g.id
    JOIN airport o ON f.origin_id = o.id
    JOIN airport d ON f.destination_id = d.id";

if (isset($_POST['filter_button'])) {
    $type_filter = $_POST['type_filter'];

    $conditions = [];
    if (!empty($type_filter)) {
        $conditions[] = "f.type = '$type_filter'";
    }

    if (count($conditions) > 0) {
        $fl_query_filter .= " WHERE " . implode(" AND ", $conditions);
    }
}
$flights = mysqli_query($db, "$fl_query_filter 
");

$oairport = mysqli_query($db, "SELECT * FROM `airport`");
$dairport = mysqli_query($db, "SELECT * FROM `airport`");
$airlines = mysqli_query($db, "SELECT * FROM `airline`");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="style/manage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
        <form id="manage_add" action="include/flight_manage.php" method="post">
  <div class="container-fluid">
    <div class="row g-3">
      <div class="col-md-6">
        <label for="flightNo" class="form-label">Flight No:</label>
        <input name="flight_no" type="text" class="form-control" id="flightNo" placeholder="e.g., AA123">
      </div>
      <div class="col-md-6">
        <label for="airline" class="form-label">Airline:</label>
        <select name="airline_id" class="form-control" id="airline">
          <option value="">Select Airline</option>
          <?php while($row = mysqli_fetch_assoc($airlines)): ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="flightType" class="form-label">Flight Type:</label>
        <select name="type" class="form-control" id="flightType">
          <option value="">Select Type</option>
          <option value="arrival">Arrival</option>
          <option value="departure">Departure</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="gate" class="form-label">Gate:</label>
        <select name="gate_id" class="form-control" id="gate">
          <option value="">Select Gate</option>
          <?php while($row = mysqli_fetch_assoc($qgate)): ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['gate']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="origin" class="form-label">Origin:</label>
        <select name="origin_id" class="form-control" id="origin">
          <option value="">Select Origin</option>
          <?php while($row = mysqli_fetch_assoc($oairport)): ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="destination" class="form-label">Destination:</label>
        <select name="destination_id" class="form-control" id="destination">
          <option value="">Select Destination</option>
          <?php while($row = mysqli_fetch_assoc($dairport)): ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="status" class="form-label">Status:</label>
        <select name="statuss" class="form-control" id="status">
          <option value="">Select Status</option>
          <option value="scheduled">scheduled</option>
          <option value="ontime">ontime</option>
          <option value="delayed">delayed</option>
          <option value="cancelled">cancelled</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="date" class="form-label">Date:</label>
        <input name="date" type="date" class="form-control" id="date" value="<?php echo date('Y-m-d'); ?>">
      </div>
      <div class="col-md-6">
        <label for="time" class="form-label">boarding_time:</label>
        <input name="boarding_time" type="time" class="form-control" id="time">
      </div>
      
      <div class="col-md-6">
        <label for="departureTime" class="form-label">Departure Time:</label>
        <input name="departure_time" type="time" class="form-control" id="departureTime" >
      </div>
      <div class="col-md-6">
        <label for="arrivalTime" class="form-label">Arrival Time:</label>
        <input name="arrival_time" type="time" class="form-control" id="arrivalTime" >
      </div>
    </div>
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="manage_add" name="submit_add" type="submit" class="btn btn-primary">Submit</button>
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
                <li class="active" >Flights</li>
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
        <div class="panel">
            <div class="header">
                <div>
                    <h1>Manage Flight</h1>
                </div>
                       <button type="button" class="btn btn-primary add_f"  data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">+ Add Flight</button>

            </div>
            <div class="cont">
              <form action="manage.php" method="post"> 
                 <label style="margin-left: 18px;">Filter by Type</label>
                <select name="type_filter">
                    <option value="">All Type</option>
                    <option value="arrival">Arrival</option>
                    <option value="departure">departure</option>
                </select>
                <button name="filter_button" type="submit" class="btn btn-primary mx-4">Filter</button>
                </form>
                <table style="margin-top: 15px;">
                    <tr>
                        <th>Flight_No</th>
                        <th>AirLine</th>
                        <th>Flight_Type</th>
                        <th>Gate</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>boarding_time</th>
                        <th>departure_time</th>
                        <th>arrival_time</th>
                        
                        <th>Actions</th>
                    </tr>
                    <?php while($row_1 = mysqli_fetch_assoc($flights)): ?>
    <div class="modal fade" id="updatefl<?php echo $row_1['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Flight</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="manageupdate<?php echo $row_1['id'];?>" name="update_flight-id-<?php echo $row_1['id'];?>" action="include/flight_manage.php" method="post">
  <div class="container-fluid">
    <div class="row g-3">
      <div class="col-md-6">
        <label for="flightNo" class="form-label">Flight No:</label>
        <input name="flight_no" type="text" class="form-control" id="flightNo" placeholder="e.g., AA123" value="<?php echo $row_1['flight_no']; ?>">
      </div>
      <div class="col-md-6">
        <label for="airline" class="form-label">Airline:</label>
        <select name="airline_id" class="form-control" id="airline">
          <option value="<?php echo $row_1['airline_id']; ?>"><?php echo $row_1['airline_name']; ?>  </option>
           <?php
           $airlines2 = mysqli_query($db, "SELECT * FROM `airline`");
            while($row_2 = mysqli_fetch_assoc($airlines2)): ?>
          <option value="<?php echo $row_2['id']; ?>"><?php echo $row_2['name']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="flightType" class="form-label">Flight Type:</label>
        <select name="type" class="form-control" id="flightType">
          <option value="">Select Type</option>
          <option value="arrival" <?php echo ($row_1['type'] == 'arrival') ? 'selected' : ''; ?>>Arrival</option>
          <option value="departure" <?php echo ($row_1['type'] == 'departure') ? 'selected' : ''; ?>>Departure</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="gate" class="form-label">Gate:</label>
        <select name="gate_id" class="form-control" id="gate">
          <option value="<?php echo $row_1['gate_id']; ?>"><?php echo $row_1['gate_name']; ?></option>
          <?php $qgate2 = mysqli_query($db, "SELECT * FROM `gate`");
          while($row = mysqli_fetch_assoc($qgate2)): ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['gate']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="origin" class="form-label">Origin:</lab2el>
        <select name="origin_id" class="form-control" id="origin" >
          <option value="<?php echo $row_1['origin_id']; ?>"><?php echo $row_1['origin_name']; ?></option>
          <?php
            $oairport2 = mysqli_query($db, "SELECT * FROM `airport`");
           while($row = mysqli_fetch_assoc($oairport2)): ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="destination" class="form-label">Destination:</label>
        <select name="destination_id" class="form-control" id="destination">
          <option value="<?php echo $row_1['destination_id']; ?>"><?php echo $row_1['destination_name']; ?></option>
          <?php 
            $dairport2 = mysqli_query($db, "SELECT * FROM `airport`");
          while($row = mysqli_fetch_assoc($dairport2)): ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="status" class="form-label">Status:</label>
        <select name="statuss" class="form-control" id="status">
          <option value="">Select Status</option>
          <option value="scheduled" <?php echo ($row_1['statuss'] == 'scheduled') ? 'selected' : ''; ?>>scheduled</option>
          <option value="ontime" <?php echo ($row_1['statuss'] == 'ontime') ? 'selected' : ''; ?>>ontime</option>
          <option value="delayed" <?php echo ($row_1['statuss'] == 'delayed') ? 'selected' : ''; ?>>delayed</option>
          <option value="cancelled" <?php echo ($row_1['statuss'] == 'cancelled') ? 'selected' : ''; ?>>cancelled</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="date" class="form-label">Date:</label>
        <input  name="date" type="date" class="form-control" id="date" value="<?php echo $row_1['dates']; ?>">
      </div>
      <div class="col-md-6">
        <label for="time" class="form-label">boarding_time:</label>
        <input name="boarding_time" type="time" class="form-control" id="time" value="<?php echo $row_1['boarding_time']; ?>">
      </div>
      
      <div class="col-md-6">
        <label for="departureTime" class="form-label">Departure Time:</label>
        <input name="departure_time" type="time" class="form-control" id="departureTime" value="<?php echo $row_1['departure_time']; ?>">
      </div>
      <div class="col-md-6">
        <label for="arrivalTime" class="form-label">Arrival Time:</label>
        <input name="arrival_time" type="time" class="form-control" id="arrivalTime"  value="<?php echo $row_1['arrival_time']; ?>">
      </div>
    </div>
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="manageupdate<?php echo $row_1['id'];?>" name="submit_update" type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
                      <tr>
                          <td><?php echo $row_1['flight_no']; ?></td>
                          <td><?php echo $row_1['airline_name']; ?></td> 
                          <td><?php echo $row_1['type']; ?></td>
                          <td><?php echo $row_1['gate_name']; ?></td> 
                          <td><?php echo $row_1['origin_name']; ?></td> 
                          <td><?php echo $row_1['destination_name']; ?></td> 
                          <td><?php echo $row_1['statuss']; ?></td>
                          <td><?php echo $row_1['dates']; ?></td>
                          <td><?php echo $row_1['boarding_time']; ?></td>
                          <td><?php echo $row_1['departure_time']; ?></td>
                          <td><?php echo $row_1['arrival_time']; ?></td>
                          <td>
                            <div style="display: flex; flex-direction: column; gap: 5px;">
                              <button style="background: none; border: none; color: rgb(8, 164, 255); font-size: 24px;" type="button" class="btn btn-primary add_f"  data-bs-toggle="modal" data-bs-target="#updatefl<?php echo $row_1['id']; ?>" data-bs-whatever="@mdo">✎</button>
                              
                            </div>
                          </td>
                      </tr>
                    <?php endwhile; ?>
                </table>
               
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="role.js"></script>
</body>
</html>