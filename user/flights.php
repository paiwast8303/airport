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
            <a href="index.html">Home</a>
            <a href="flights.html" class="active">Flights</a>
            <a href="gates.html">Gates</a>
            <a href="help.html">Help</a>
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
            <input type="text" class="form-control" placeholder="Search flight..." style="max-width:400px">
            <button class="btn btn-primary">Search</button>
        </div>

        <div class="d-flex gap-3 flex-wrap">
            <select class="form-select" style="max-width:200px">
                <option>All Airlines</option>
            </select>
            <select class="form-select" style="max-width:200px">
                <option>All Status</option>
            </select>
            <select class="form-select" style="max-width:200px">
                <option>All Times</option>
            </select>
        </div>
    </div>

    <!-- TABS -->
    <div class="ft-tabs">
        <button class="ft-tab active" onclick="switchTab(event,'departures')">✈️ Departures</button>
        <button class="ft-tab" onclick="switchTab(event,'arrivals')">🛬 Arrivals</button>
    </div>

    <!-- DEPARTURES -->
    <div id="departures" class="ft-cont">
        <div class="ft-card" onclick="window.location.href='flight-details.html'">
            <div class="ft-hdr">
                <div>
                    <div class="ft-num">KK123</div>
                    <div class="air">Kurdistan Airlines</div>
                </div>
                <div class="stat on-time">On Time</div>
            </div>

            <div class="ft-body">
                <div class="loc-info">
                    <div class="loc-code">EBL</div>
                    <div class="time">14:30</div>
                </div>
                <div class="ft-route">
                    ✈️
                    <div class="rt-line"></div>
                    2h 15m
                </div>
                <div class="loc-info">
                    <div class="loc-code">IST</div>
                    <div class="time">16:45</div>
                </div>
            </div>

            <div class="ft-ftr">
                <span>Gate <span class="gate">A1</span></span>
                <span>Terminal 1</span>
            </div>
        </div>
    </div>

    <!-- ARRIVALS -->
    <div id="arrivals" class="ft-cont" style="display:none;">
        <div class="ft-card" onclick="window.location.href='flight-details.html'">
            <div class="ft-hdr">
                <div>
                    <div class="ft-num">KK123</div>
                    <div class="air">Kurdistan Airlines</div>
                </div>
                <div class="stat on-time">On Time</div>
            </div>

            <div class="ft-body">
                <div class="loc-info">
                    <div class="loc-code">EBL</div>
                    <div class="time">14:30</div>
                </div>
                <div class="ft-route">
                    ✈️
                    <div class="rt-line"></div>
                    2h 15m
                </div>
                <div class="loc-info">
                    <div class="loc-code">IST</div>
                    <div class="time">16:45</div>
                </div>
            </div>

            <div class="ft-ftr">
                <span>Gate <span class="gate">A1</span></span>
                <span>Terminal 1</span>
            </div>
        </div>
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
