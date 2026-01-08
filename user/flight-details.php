<!DOCTYPE html>
<html lang="en">
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
        <a href="index.html">Home</a>
        <a href="flights.html" class="active">Flights</a>
        <a href="gates.html">Gates</a>
        <a href="help.html">Help</a>
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
        <div class="fs-1 fw-bold text-primary">KK123</div>
        <div class="text-muted fs-5">Kurdistan Airlines</div>
    </div>
    <span class="status on-time">On Time</span>
</div>

<div class="card-box">
<h4 class="fw-bold mb-4">Flight Route</h4>
<div class="route">
    <div class="air">
        <div class="air-code">EBL</div>
        <div class="text-muted">Erbil Airport</div>
        <div class="flight-time">14:30</div>
    </div>

    <div class="route-mid">
        ✈️
        <div class="route-line"></div>
        <strong class="text-muted">2h 15m</strong>
    </div>

    <div class="air">
        <div class="air-code">IST</div>
        <div class="text-muted">Istanbul Airport</div>
        <div class="flight-time">16:45</div>
    </div>
</div>
</div>

<div class="card-box">
<h4 class="fw-bold mb-4">Flight Information</h4>
<div class="info-grid">
    <div class="info-item"><div class="info-label">Gate</div><div class="info-value">A1</div></div>
    <div class="info-item"><div class="info-label">Terminal</div><div class="info-value">1</div></div>
    <div class="info-item"><div class="info-label">Boarding</div><div class="info-value">14:00</div></div>
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
        <strong>14:00</strong><br>Boarding Started
    </div>
</div>

<div class="timeline-item">
    <div class="timeline-dot current">✈️</div>
    <div class="timeline-content">
        <strong>14:30</strong><br>Departure
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
