
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airport Flight Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <nav>
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <div style="color: #0f172a; font-size: 1.5rem; font-weight: bold;">✈️ Airport Info</div>
            <div>
                <a href="index.html">Home</a>
                <a href="flights.html">Flights</a>
                <a href="gates.html">Gates</a>
                <a href="help.html">Help</a>
            </div>
        </div>
    </nav>

    <div id="hero">
        <div class="container">
            <h1>Welcome to Our Airport</h1>
            <p>Real-time flight information and airport services</p>
            <a href="flights.html" class="hero-btn">View Flights</a>
        </div>
    </div>

    <div class="container">
        <div id="weatherBox">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding-bottom: 15px; border-bottom: 2px solid #e5e7eb;">
                <h2 style="margin: 0;">Airport Weather Forecast</h2>
                <div id="lastUpdate"></div>
            </div>
            <!--Daskary ama maka ba json 7alm krdwa bashe weather-->
            <div id="currentWeather"></div>

            <div id="weeklyForecast"></div>

            <div id="weatherDetails">
                <div>
                    <i class="fas fa-wind"></i>
                    <div style="color: #64748b; font-size: 0.9rem;">Wind Speed</div>
                    <div id="windSpeed" style="font-weight: 600; color: #0f172a; font-size: 1.1rem;">-- km/h</div>
                </div>
                <div>
                    <i class="fas fa-tint"></i>
                    <div style="color: #64748b; font-size: 0.9rem;">Humidity</div>
                    <div id="humidity" style="font-weight: 600; color: #0f172a; font-size: 1.1rem;">--%</div>
                </div>
                <div>
                    <i class="fas fa-eye"></i>
                    <div style="color: #64748b; font-size: 0.9rem;">Visibility</div>
                    <div id="visibility" style="font-weight: 600; color: #0f172a; font-size: 1.1rem;">-- km</div>
                </div>
                <div>
                    <i class="fas fa-cloud-rain"></i>
                    <div style="color: #64748b; font-size: 0.9rem;">Precipitation</div>
                    <div id="precipitation" style="font-weight: 600; color: #0f172a; font-size: 1.1rem;">--%</div>
                </div>
            </div>
        </div>

        <div id="flightBoard">
            <h2>Live Flight Information</h2>
            
            <div id="flightTabs">
                <button class="active" onclick="switchTab('departures')">Departures</button>
                <button onclick="switchTab('arrivals')">Arrivals</button>
            </div>

            <div id="departuresContent">
                <div class="flight">
                    <div>
                        <div>KK123</div>
                        <div>Kurdistan Airlines</div>
                    </div>
                    <div>Istanbul (IST)</div>
                    <div>14:30</div>
                    <div>Gate A1</div>
                    <div style="background: rgba(22,163,74,0.2); color: #16a34a; border: 1px solid rgba(22,163,74,0.3); padding: 6px 16px; border-radius: 20px; font-weight: 600; text-align: center;">On Time</div>
                </div>

                <div class="flight">
                    <div>
                        <div>AA456</div>
                        <div>Arbat Airlines</div>
                    </div>
                    <div>Dubai (DXB)</div>
                    <div>15:45</div>
                    <div>Gate B2</div>
                    <div style="background: rgba(245,158,11,0.2); color: #f59e0b; border: 1px solid rgba(245,158,11,0.3); padding: 6px 16px; border-radius: 20px; font-weight: 600; text-align: center;">Delayed</div>
                </div>

                <div class="flight">
                    <div>
                        <div>SS789</div>
                        <div>Suli Airlines</div>
                    </div>
                    <div>Baghdad (BGW)</div>
                    <div>16:20</div>
                    <div>Gate C3</div>
                    <div style="background: rgba(37,99,235,0.2); color: #2563eb; border: 1px solid rgba(37,99,235,0.3); padding: 6px 16px; border-radius: 20px; font-weight: 600; text-align: center;">Boarding</div>
                </div>

                <div class="flight">
                    <div>
                        <div>EK901</div>
                        <div>Emirates</div>
                    </div>
                    <div>London (LHR)</div>
                    <div>18:00</div>
                    <div>Gate A5</div>
                    <div style="background: rgba(22,163,74,0.2); color: #16a34a; border: 1px solid rgba(22,163,74,0.3); padding: 6px 16px; border-radius: 20px; font-weight: 600; text-align: center;">On Time</div>
                </div>
            </div>

            <div id="arrivalsContent" style="display: none;">
                <div class="flight">
                    <div>
                        <div>TK567</div>
                        <div>Turkish Airlines</div>
                    </div>
                    <div>From Istanbul (IST)</div>
                    <div>13:45</div>
                    <div>Gate A2</div>
                    <div style="background: rgba(22,163,74,0.2); color: #16a34a; border: 1px solid rgba(22,163,74,0.3); padding: 6px 16px; border-radius: 20px; font-weight: 600; text-align: center;">Landed</div>
                </div>

                <div class="flight">
                    <div>
                        <div>QR234</div>
                        <div>Qatar Airways</div>
                    </div>
                    <div>From Doha (DOH)</div>
                    <div>14:15</div>
                    <div>Gate B3</div>
                    <div style="background: rgba(22,163,74,0.2); color: #16a34a; border: 1px solid rgba(22,163,74,0.3); padding: 6px 16px; border-radius: 20px; font-weight: 600; text-align: center;">On Time</div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <a href="flights.html" class="btn btn-primary btn-lg">View All Flights</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div>
                <h5>Contact</h5>
                <p>📞 +964 771 156 1401</p>
                <p>✉️ miran22.osman@gmail.com</p>
                <p>📍 m7adakay qrga</p>
            </div>
            <div style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 30px; padding-top: 20px; text-align: center; color: rgba(255,255,255,0.7);">
                <p>&copy; 2024 Airport Information System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let weatherData = {};

        async function loadWeather() {
            try {
                const response = await fetch('weather-data.json');
                weatherData = await response.json();
                updateWeather();
            } catch (error) {
                console.error('Error loading weather:', error);
            }
        }

        function updateWeather() {
            document.getElementById('lastUpdate').textContent = `Last updated: ${weatherData.lastUpdated}`;

            const current = weatherData.current;
            document.getElementById('currentWeather').innerHTML = `
                <div>${current.temp}°C</div>
                <div>
                    <div style="font-size: 1.5rem; margin-bottom: 10px;">${weatherData.location}</div>
                    <div style="font-size: 1.2rem; opacity: 0.9;">${current.icon} ${current.condition}</div>
                    <div>H: ${current.high || current.temp + 2}° L: ${current.low || current.temp - 2}°</div>
                </div>
            `;

            const forecast = document.getElementById('weeklyForecast');
            forecast.innerHTML = '';
            
            weatherData.weekly.forEach((day, i) => {
                const dayEl = document.createElement('div');
                dayEl.className = `day ${i === 0 ? 'active' : ''}`;
                dayEl.innerHTML = `
                    <div style="font-weight: 600; color: #0f172a; margin-bottom: 10px;">${day.day}</div>
                    <div style="font-size: 2.5rem; margin: 10px 0;">${day.icon}</div>
                    <div style="font-weight: 700; color: #1e3c72; font-size: 1.2rem;">${day.temp}°</div>
                    <div style="color: #666; font-size: 0.9rem; margin-top: 5px;">${day.condition}</div>
                `;
                
                dayEl.onclick = function() {
                    document.querySelectorAll('.day').forEach(d => d.classList.remove('active'));
                    dayEl.classList.add('active');
                    updateDay(day);
                };
                
                forecast.appendChild(dayEl);
            });

            document.getElementById('windSpeed').textContent = `${current.windSpeed} km/h`;
            document.getElementById('humidity').textContent = `${current.humidity}%`;
            document.getElementById('visibility').textContent = `${current.visibility} km`;
            document.getElementById('precipitation').textContent = `${current.precipitation}%`;
        }

        function updateDay(day) {
            document.getElementById('currentWeather').innerHTML = `
                <div>${day.temp}°C</div>
                <div>
                    <div style="font-size: 1.5rem; margin-bottom: 10px;">${weatherData.location} - ${day.day}</div>
                    <div style="font-size: 1.2rem; opacity: 0.9;">${day.icon} ${day.condition}</div>
                    <div>High: ${day.high || day.temp + 2}° Low: ${day.low || day.temp - 2}°</div>
                </div>
            `;
        }

        function switchTab(tab) {
            document.querySelectorAll('#flightTabs button').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            document.getElementById('departuresContent').style.display = 'none';
            document.getElementById('arrivalsContent').style.display = 'none';
            document.getElementById(tab + 'Content').style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', loadWeather);
    </script>
</body>
</html>