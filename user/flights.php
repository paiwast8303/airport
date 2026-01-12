<?php
include 'include/config.php';

$flight_a_query1 = "
SELECT `f`.`id`, `f`.`flight_no` ,`a`.`name` AS 'airline',`p`.`code` as 'origin',`pd`.`code` as 'destination' , `f`.`departure_time`, `f`.`arrival_time` ,`g`.`gate` ,`t`.`name` ,`f`.`statuss`
FROM `flight`as `f` 
JOIN `airline` as `a` on  	`f`.`airline_id` = `a`.`id`
JOIN `airport` as `p` on `f`.`origin_id` = `p`.`id`
JOIN `airport` as `pd` on `f`.`destination_id` = `pd`.`id`
JOIN `gate` as `g`  on `f`.`gate_id` = `g`.`id`
JOIN `terminal` AS `t` ON `g`.`terminal_id` = `t`.`id`
WHERE `f`.`type` = 'departure'";
$flight_a_query2 = "
SELECT `f`.`id`, `f`.`flight_no` ,`a`.`name` AS 'airline',`p`.`code` as 'origin',`pd`.`code` as 'destination' , `f`.`departure_time`, `f`.`arrival_time` ,`g`.`gate` ,`t`.`name` ,`f`.`statuss`
FROM `flight`as `f` 
JOIN `airline` as `a` on  	`f`.`airline_id` = `a`.`id`
JOIN `airport` as `p` on `f`.`origin_id` = `p`.`id`
JOIN `airport` as `pd` on `f`.`destination_id` = `pd`.`id`
JOIN `gate` as `g`  on `f`.`gate_id` = `g`.`id`
JOIN `terminal` AS `t` ON `g`.`terminal_id` = `t`.`id`
WHERE `f`.`type` = 'arrival'";


if(isset($_POST['submitsearch'])) {
    $flightnos = mysqli_real_escape_string($dbs, $_POST['flightnos']);
    $flighttype = mysqli_real_escape_string($dbs, $_POST['flighttype']);

    if (!empty($flightnos)) {
        $flight_a_query1 .= " AND `f`.`flight_no` LIKE '%$flightnos%'";
        $flight_a_query2 .= " AND `f`.`flight_no` LIKE '%$flightnos%'";
    }

    if (!empty($flighttype)) {
        if ($flighttype === 'departure') {
            $flight_a_query2 = "SELECT * FROM `flight` WHERE 1=0"; // No arrivals
        } elseif ($flighttype === 'arrival') {
            $flight_a_query1 = "SELECT * FROM `flight` WHERE 1=0"; // No departures
        }
    }
}



$flight_a_q1 = mysqli_query($dbs ,$flight_a_query1);
$flight_a_q2 = mysqli_query($dbs ,$flight_a_query2);


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flight Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/flights.css">
</head>

<body>

<!-- NAVBAR -->
<nav>
    <div class="container d-flex justify-content-between align-items-center">
        <div style="font-size:1.5rem;font-weight:bold;">✈️ Airport Info</div>
        <div>
            <a href="index.php">Home</a>
            <a href="flights.php" class="active">Flights</a>
            <a href="gates.php">Gates</a>
            <a href="help.php">Help</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<div id="hero">
    <h1>Flight Information</h1>
    <p>Real-time flight schedules and status</p>
</div>

<div class="container">

    <!-- FILTER -->
    <div class="flt-sec">
        <h5 class="mb-3">🔍 Search & Filter Flights</h5>
        <div class="d-flex gap-2 mb-3 flex-wrap">
       <form method="post" action="flights.php">
             <input name="flightnos" type="text" class="form-control" placeholder="Search flight NO..." style="max-width:400px">
             <select name="flighttype" class="form-select" style="max-width:200px">
                <option value="">All Types</option>
                <option value="departure">Departures</option>
                <option value="arrival">Arrivals</option>
             </select>
            <button name="submitsearch" type="submit" class="btn btn-primary">Search</button>
       </form>
        </div>
    </div>

    <!-- TABS -->
    <div class="ft-tabs">
        <button class="ft-tab active" onclick="switchTab(event,'departures')">✈️ Departures</button>
        <button class="ft-tab" onclick="switchTab(event,'arrivals')">🛬 Arrivals</button>
    </div>

    <!-- DEPARTURES -->
    <div id="departures" class="ft-cont">
        <?php while($flight_a_row1 = mysqli_fetch_array($flight_a_q1)): ?>
        <div class="ft-card" onclick="window.location.href='flight-details.php?flight_id=<?php echo $flight_a_row1['id']; ?>'">
            <div class="ft-hdr">
                <div>
                    <div class="ft-num"><?php echo $flight_a_row1['flight_no']; ?></div>
                    <div class="air"><?php echo $flight_a_row1['airline']; ?></div>
                </div>
                <div class="stat on-time"><?php echo $flight_a_row1['statuss']; ?></div>
            </div>

            <div class="ft-body">
                <div class="loc-info">
                    <div class="loc-code"><?php echo $flight_a_row1['origin']; ?></div>
                    <div class="time"><?php echo $flight_a_row1['departure_time']; ?></div>
                </div>
                <div class="ft-route">
                    ✈️
                    <div class="rt-line"></div>
                   <?php 
                   $a = new DateTime($flight_a_row1['arrival_time']);
                     $b = new DateTime($flight_a_row1['departure_time']);
                   echo $a->diff($b)->format('%H:%I'); ?>
                </div>
                <div class="loc-info">
                    <div class="loc-code"><?php echo $flight_a_row1['destination']; ?></div>
                    <div class="time"><?php echo $flight_a_row1['arrival_time']; ?></div>
                </div>
            </div>

            <div class="ft-ftr">
                <span>Gate <span class="gate"><?php echo $flight_a_row1['gate']; ?></span></span>
                <span><?php echo $flight_a_row1['name']; ?></span>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <!-- ARRIVALS -->
    <div id="arrivals" class="ft-cont" style="display:none;">
        <?php while($flight_a_row2 = mysqli_fetch_array($flight_a_q2)): ?>
        <div class="ft-card" onclick="window.location.href='flight-details.php?flight_id=<?php echo $flight_a_row2['id']; ?>'">
            <div class="ft-hdr">
                <div>
                    <div class="ft-num"><?php echo $flight_a_row2['flight_no']; ?></div>
                    <div class="air"><?php echo $flight_a_row2['airline']; ?></div>
                </div>
                <div class="stat on-time"><?php echo $flight_a_row2['statuss']; ?></div>
            </div>

            <div class="ft-body">
                <div class="loc-info">
                    <div class="loc-code"><?php echo $flight_a_row2['origin']; ?></div>
                    <div class="time"><?php echo $flight_a_row2['departure_time']; ?></div>
                </div>
                <div class="ft-route">
                    ✈️
                    <div class="rt-line"></div>
                  <?php

                   $q = new DateTime($flight_a_row2['arrival_time']);
                        $r = new DateTime($flight_a_row2['departure_time']);
                     echo $q->diff($r)->format('%H:%I'); ?>
                </div>
                <div class="loc-info">
                    <div class="loc-code"><?php echo $flight_a_row2['destination']; ?></div>
                    <div class="time"><?php echo $flight_a_row2['arrival_time']; ?></div>
                </div>
            </div>

            <div class="ft-ftr">
                <span>Gate <span class="gate"><?php echo $flight_a_row2['gate']; ?></span></span>
                <span><?php echo $flight_a_row2['name']; ?></span>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

</div>

<script>
function switchTab(e, tab) {
    document.querySelectorAll('.ft-tab').forEach(b => b.classList.remove('active'));
    e.target.classList.add('active');

    document.getElementById('departures').style.display = 'none';
    document.getElementById('arrivals').style.display = 'none';
    document.getElementById(tab).style.display = 'block';
}
</script>

</body>
</html>
