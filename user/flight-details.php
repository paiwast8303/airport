<?php 
include 'include/config.php';

$flight_id = isset($_GET['flight_id']) ? intval($_GET['flight_id']) : 0;
if($flight_id ==0 || !is_numeric($flight_id))
{
    header("Location: flights.php");
    exit();
}
$flight_detils = "
SELECT `f`.`id`, `f`.`flight_no` ,`f`.`boarding_time`,`p`.`name` AS 'name1',`pd`.`name` AS 'name2',`a`.`name` AS 'airline',`p`.`code` as 'origin',`pd`.`code` as 'destination' , `f`.`departure_time`, `f`.`arrival_time` ,`g`.`gate` ,`t`.`name` ,`f`.`statuss`
FROM `flight`as `f` 
JOIN `airline` as `a` on  	`f`.`airline_id` = `a`.`id`
JOIN `airport` as `p` on `f`.`origin_id` = `p`.`id`
JOIN `airport` as `pd` on `f`.`destination_id` = `pd`.`id`
JOIN `gate` as `g`  on `f`.`gate_id` = `g`.`id`
JOIN `terminal` AS `t` ON `g`.`terminal_id` = `t`.`id`
WHERE `f`.`id` = $flight_id";

$flight_detils_q = mysqli_query($dbs ,$flight_detils);
$flight_info = mysqli_fetch_assoc($flight_detils_q);

?>
<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<title>Flight Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style/flight-details.css">
</head>

<body>

<nav>
<div class="container d-flex justify-content-between align-items-center">
    <div class="fw-bold fs-4">✈️ Airport Info</div>
    <div>
        <a href="index.php">Home</a>
        <a href="flights.php" class="active">Flights</a>
        <a href="gates.php">Gates</a>
        <a href="help.php">Help</a>
    </div>
</div>
</nav>

<div id="hero">
<div class="container">
    <h1>Flight Details</h1>
    <p>Complete information about your flight</p>
</div>
</div>

<div class="container">

<div class="card-box d-flex justify-content-between align-items-center flex-wrap">
    <div>
        <div class="fs-1 fw-bold text-primary"><?php echo $flight_info['flight_no']; ?></div>
        <div class="text-muted fs-5"><?php echo $flight_info['airline']; ?></div>
    </div>
    <span class="status on-time"><?php echo $flight_info['statuss']; ?></span>
</div>

<div class="card-box">
<h4 class="fw-bold mb-4">Flight Route</h4>
<div class="route">
    <div class="air">
        <div class="air-code"><?php echo $flight_info['origin']; ?></div>
        <div class="text-muted"><?php echo $flight_info['name1']; ?></div>
        <div class="flight-time"><?php echo $flight_info['departure_time']; ?></div>
    </div>

    <div class="route-mid">
        ✈️
        <div class="route-line"></div>
        <strong class="text-muted">
            <?php 
            $r = strtotime($flight_info['arrival_time']) - strtotime($flight_info['departure_time']);
            $hours = floor($r / 3600);
            $minutes = floor(($r % 3600) / 60);
            echo "{$hours}h {$minutes}m";
            ?>
        </strong>
    </div>

    <div class="air">
        <div class="air-code"><?php echo $flight_info['destination']; ?></div>
        <div class="text-muted"><?php echo $flight_info['name2']; ?></div>
        <div class="flight-time"><?php echo $flight_info['arrival_time']; ?></div>
    </div>
</div>
</div>

<div class="card-box">
<h4 class="fw-bold mb-4">Flight Information</h4>
<div class="info-grid">
    <div class="info-item"><div class="info-label">Gate</div><div class="info-value"><?php echo $flight_info['gate']; ?></div></div>
    <div class="info-item"><div class="info-label"></div><div class="info-value"><?php echo $flight_info['name']; ?></div></div>
    <div class="info-item"><div class="info-label">Boarding</div><div class="info-value"><?php echo $flight_info['boarding_time']; ?></div></div>
</div>
</div>

<div class="card-box">
<h4 class="fw-bold mb-4">Flight Timeline</h4>

<div class="timeline-item">
    <div class="timeline-dot done">✓</div>
    <div class="timeline-content">
        <strong>13:45</strong><br>Gate Assigned
    </div>
</div>

<div class="timeline-item">
    <div class="timeline-dot done">🧳</div>
    <div class="timeline-content">
        <strong><?php echo $flight_info['boarding_time']; ?></strong><br>Boarding Started
    </div>
</div>

<div class="timeline-item">
    <div class="timeline-dot current">✈️</div>
    <div class="timeline-content">
        <strong><?php echo $flight_info['departure_time']; ?></strong><br>Departure
    </div>
</div>
</div>

<div class="text-center mb-5">
<a href="flights.html" class="btn btn-primary btn-lg">← Back to Flights</a>
</div>

</div>

<footer>
© 2024 Airport Information System
</footer>

</body>
</html>
