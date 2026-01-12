<?php
include 'include/config.php';

$gateterminal1 = mysqli_query($dbs , "SELECT * FROM `gate` WHERE `terminal_id` = 1");
$gateterminal2 = mysqli_query($dbs , "SELECT * FROM `gate` WHERE `terminal_id` = 2");


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gates & Terminals</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style/gates.css">
</head>

<body>

<!-- NAVBAR -->
<nav>
    <div class="container d-flex justify-content-between align-items-center">
        <div style="font-size: 1.5rem; font-weight: bold;">✈️ Airport Info</div>
        <div>
            <a href="index.php">Home</a>
            <a href="flights.php">Flights</a>
            <a href="gates.php" class="active">Gates</a>
            <a href="help.php">Help</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<div id="hero">
    <div class="container">
        <h1>Gates & Terminals</h1>
        <p>Live gate availability and terminal services</p>
    </div>
</div>

<div class="container">
    <div class="terminal-tabs">

        <div class="tab-buttons">
            <button class="terminal-tab active" onclick="switchTerminal(event,'terminal1')">Terminal 1</button>
            <button class="terminal-tab" onclick="switchTerminal(event,'terminal2')">Terminal 2</button>
        </div>

        <!-- TERMINAL 1 -->
        <div id="terminal1-content">
            <h4 class="mb-3">Concourse A</h4>
            <div class="gate-grid">
                <?php while($gate1 = mysqli_fetch_assoc($gateterminal1)):?>
                <div class="gate-card available">
                    <div class="gate-number"><?php echo $gate1['gate']?></div>
                    <div class="gate-status"><?php echo $gate1['status']?></div>
                </div>
                <?php endwhile; ?>
            </div>

            <div class="facilities-section">
                <h5>Terminal 1 Facilities</h5>
                <div class="facilities-grid">
                    <div class="facility-card">🍽️ Restaurants</div>
                    <div class="facility-card">📶 Free Wi-Fi</div>
                    <div class="facility-card">🛍️ Duty Free</div>
                    <div class="facility-card">♿ Accessibility</div>
                </div>
            </div>
        </div>

        <!-- TERMINAL 2 -->
        <div id="terminal2-content" style="display:none;">
            <h4 class="mb-3">Concourse B</h4>
            <div class="gate-grid">
                <?php while($gate2 = mysqli_fetch_assoc($gateterminal2)):?>
                <div class="gate-card available">
                    <div class="gate-number"><?php echo $gate2['gate']?></div>
                    <div class="gate-status"><?php echo $gate2['status']?></div>
                </div>
                <?php endwhile; ?>
            </div>

            <div class="facilities-section">
                <h5>Terminal 2 Facilities</h5>
                <div class="facilities-grid">
                    <div class="facility-card">☕ Coffee Shops</div>
                    <div class="facility-card">🔌 Charging</div>
                    <div class="facility-card">🙏 Prayer Room</div>
                    <div class="facility-card">🚻 Restrooms</div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function switchTerminal(event, terminal) {
    document.querySelectorAll('.terminal-tab').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    document.getElementById('terminal1-content').style.display = 'none';
    document.getElementById('terminal2-content').style.display = 'none';

    document.getElementById(terminal + '-content').style.display = 'block';
}
</script>

</body>
</html>
