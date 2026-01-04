<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html, body {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        }

        *{
            margin: 0;
        }

        #bd{
            display: flex;
            height: 100%;
        }

        #sidebar{
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 20px;
            width: 220px;
            height: 100%;
            position: fixed;
        }

#sidebar ul {
    padding-left: 0;
    margin-top: 20px;
}

#sidebar ul li {
    list-style: none;
    padding: 12px 15px;
    width: auto;
    border-radius: 8px;
    margin: 8px 0;
    margin-bottom: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

#sidebar ul li:hover ,#sidebar ul li.active  {
    background: rgba(255, 255, 255, 0.25);
    transform: translateX(5px);
}

.panel{
    margin-left: 275px;
    width: 100%;
    padding: 30px;

}

.header {
            padding: 20px 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .add_f{
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        border-radius: 5px;
        padding: 8px;
        }

        .add_f:hover{
                        transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(42, 82, 152, 0.4);

        }
        .cont{
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: auto;
        }
        select{
            padding: 8px;
            border-radius: 10px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table th {
            background: #f5f6fa;
            border-bottom: 2px solid #ddd;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #1e3c72;
        }

        table td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
        }
    </style>
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
        <form>
  <div class="container-fluid">
    <div class="row g-3">
      <div class="col-md-6">
        <label for="flightNo" class="form-label">Flight No:</label>
        <input type="text" class="form-control" id="flightNo" placeholder="e.g., AA123">
      </div>
      <div class="col-md-6">
        <label for="airline" class="form-label">Airline:</label>
        <select class="form-control" id="airline">
          <option value="">Select Airline</option>
          <option value="airline1">Airline 1</option>
          <option value="airline2">Airline 2</option>
          <option value="airline3">Airline 3</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="flightType" class="form-label">Flight Type:</label>
        <select class="form-control" id="flightType">
          <option value="">Select Type</option>
          <option value="arrival">Arrival</option>
          <option value="departure">Departure</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="gate" class="form-label">Gate:</label>
        <select class="form-control" id="gate">
          <option value="">Select Gate</option>
          <option value="A1">Gate A1</option>
          <option value="B2">Gate B2</option>
          <option value="C3">Gate C3</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="origin" class="form-label">Origin:</label>
        <input type="text" class="form-control" id="origin" placeholder="e.g., JFK">
      </div>
      <div class="col-md-6">
        <label for="destination" class="form-label">Destination:</label>
        <input type="text" class="form-control" id="destination" placeholder="e.g., LAX">
      </div>
      <div class="col-md-6">
        <label for="status" class="form-label">Status:</label>
        <select class="form-control" id="status">
          <option value="">Select Status</option>
          <option value="on-time">On Time</option>
          <option value="delayed">Delayed</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="date" class="form-label">Date:</label>
        <input type="date" class="form-control" id="date">
      </div>
      <div class="col-md-6">
        <label for="time" class="form-label">Time:</label>
        <input type="time" class="form-control" id="time">
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
                <li class="active">Flights</li>
                <li onclick="window.location.href='gate_manager.php'">Gate Management</li>
                <li onclick="window.location.href='admin_manager.php'">Admin Manager</li>
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
               <form>
                <label>Filter by Status</label>
                <select>
                    <option>All Status</option>
                    <option>Delayed</option>
                </select>
                 <label style="margin-left: 18px;">Filter by Type</label>
                <select>
                    <option>All Type</option>
                    <option>Arrival</option>
                    <option>departure</option>
                </select>
                <button style="margin-left: 15px; padding: 8px 12px; border-radius: 5px; background-color: #1e3c72; color: white; border: none;">Filter</button>
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
                        <th>Time</th>
                        
                        <th>Actions</th>
                    </tr>
                    <tr>
                        <td>AA123</td>
                        <td>Airline 1</td>
                        <td>Arrival</td>
                        <td>A1</td>
                        <td>JFK</td>
                        <td>LAX</td>
                        <td>On Time</td>
                        <td>2024-10-01</td>
                        <td>14:30</td>
                        
                        <td>
                        <div  style="display: flex; flex-direction: column; gap: 5px;">
                            <button style="background: none; border: none; color: rgb(8, 164, 255); font-size: 24px;">✎</button>
                            <button style="background: none; border: none; font-size: 24px;">🗑️</button>
                        </div>
                        </td>
                    </tr>
                    
                </table>
               </form>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="role.js"></script>
</body>
</html>