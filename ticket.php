<?php
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "airline_reservation_system";

$conn = new mysqli($server_name, $username, $password, $database_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchQuery = '';
if(isset($_GET['search'])){
    $searchQuery = $_GET['search'];
    $sql = "SELECT * FROM flight WHERE Flight_No LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $searchQuery . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM flight";
    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Bookings</title>
    <link rel="icon" href="./files/logo.png">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Style the select field */
        .regiser-form{
            width: 1000px;
            height: 400px;
        }
        select {
            background-color: rgb(26, 25, 25);
            width: 575px;
            color: white;
            border: none;
            border-radius: 10px;
            
            padding: 22px;
            font-size: 16px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="white" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
            background-repeat: no-repeat;
            background-position-x: 100%;
            background-position-y: 50%;
        }

        /* Remove the default arrow for different browsers */
        select::-ms-expand {
            display: none;
        }

        /* Style the options */
        option {
            background-color: black;
            color: white;
        }

        /* Optional: style the form and label */
        form {
            max-width: 1000px
            margin: 0 auto;
            padding: 20px;
            
            border-radius: 8px;
            height: 400px;
        }

        label {
            color: white;
            font-size: 18px;
            display: block;
            margin-bottom: 10px;
        }
       
        input{
            width: 450px;
        }
        button{
            width: 75px;
            height: 65px;
            background-color: rgb(21,74,74);;
            border: none;
            padding: 15px;
            border-radius: 10px;
            padding-top: 17px;
        }
        button:hover{
            background-color: transparent;
            color: white;
            border: 2px solid rgb(21,74,74);;
        }
        button a{
            text-decoration: none;
            color: rgb(0, 0, 0);
        }
        /* Adjusted CSS for the form and table */

.regiser-form {
    width: 1000px;
    height: 400px;
    margin: 0 auto;
}

form {
    margin-top: 20px; /* Added margin-top to separate form from heading */
}

input[type="text"] {
    width: 575px;
    padding: 15px;
    font-size: 16px;
    border: none;
    border-radius: 10px;
    margin-right: 10px; /* Added margin-right for spacing */
}

button {
    width: 75px;
    height: 65px;
    background-color: rgb(21, 74, 74);
    border: none;
    padding: 15px;
    border-radius: 10px;
    padding-top: 17px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px; /* Added margin-top for spacing */
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: black;
}

tr:nth-child(even) {
    background-color: black;
}

tr:hover {
    background-color: rgb(21,74,74);
}

    
    </style>
</head>
<body class="register-body">

    <nav>
        <img src="./files/logo.png" class="logo" alt="Logo" title="FirstFlight Travels">

        <ul class="navbar">
            <li>
                <a href="./index.html">Home</a>
                <a href="./register.html">Register</a>
                <a href="./flight.html">Bookings</a>
                
                <a href="./ticket.html">Ticket</a>
                <a href="./payment.html">Payment</a>
                
            </li>
        </ul>
    </nav>

    <section class="registration">
        <div class="register-form">
          <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search <span>Flight</span></h1>
            <form method="get">
             <input type="text" name="search" placeholder="Search Flight No..." value="<?php echo htmlspecialchars($searchQuery); ?>">
             <button type="submit"><i class="fas fa-search" style="color: white;"></i></button>
             <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Flight Number</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Arrival Time</th>
                    <th>Departure Time</th>
                    <th>AirLine Name</th>
                    <th>Number of seats</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Flight_No']); ?></td>
                        <td><?php echo htmlspecialchars($row['Source']); ?></td>
                        <td><?php echo htmlspecialchars($row['Destination']); ?></td>
                        <td><?php echo htmlspecialchars($row['Arrival_Time']); ?></td>
                        <td><?php echo htmlspecialchars($row['Departure_Time']); ?></td>
                        <td><?php echo htmlspecialchars($row['Airline_Name']); ?></td>
                        <td><?php echo htmlspecialchars($row['Num_of_seats']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </form>
    </div>
    </section>

<!-- Footer -->

<section class="footer">
    <div class="foot">
        <div class="footer-content">
            
            <div class="footlinks">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="./register.html">Register</a></li>
                    <li><a href="./about.html">About Us</a></li>
                    <li><a href="./contact.html">Contact Us</a></li>
                </ul>
            </div>

            <div class="footlinks">
                <h4>Connect</h4>
                <div class="social">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#" ><i class='bx bxl-instagram' ></i></a>
                    <a href="#"><i class='bx bxl-twitter' ></i></a>
                    <a href="https://www.linkedin.com/in/shaheer-siddiqui-714412247" target="_blank"><i class='bx bxl-linkedin' ></i></a>
                    <a href="#"><i class='bx bxl-youtube' ></i></a>
                    <a href="#"><i class='bx bxl-wordpress' ></i></a>
                    <a href="https://github.com/MShaheer15"><i class='bx bxl-github'></i></a>
                </div>
            </div>
            
        </div>
    </div>

    <div class="end">
        <p>Thank You For visiting Our Website.</p>
</section>

<!-- Javascript -->
<script>
    function validateform(){ 
        var tel=document.getElementById("phonenum").value;  

        if(tel.length<10){  
            alert("Phone number must be of atleast 10 digits!");  
            return false;  
        } else if(isNaN(tel)){
            alert("Phone number should not include character!");
            return false;
        }
        return true;
}  
</script>
<script>
    // function displayFlightDetails() {
    //     document.getElementById('flight-details').innerHTML = "<p>Flight No: ${data.flight_no}</p> <p>Airline: ${data.airline}</p><p>Departure: ${data.departure}</p><p>Arrival: ${data.arrival}</p><p>Departure Time: ${data.departure_time}</p><p>Arrival Time: ${data.arrival_time}</p><p>Status: ${data.status}</p>"
    // }
//     document.getElementById('flight-search-form').addEventListener('submit', function(event) {
//         event.preventDefault();

//         const formData = new FormData(this);
//         const flightNo = formData.get('flight_no');

//         fetch('ticket.php', {
//             method: 'POST',
//             body: formData
//         })
//         .then(response => response.json())
//         .then(data => {
//             const detailsDiv = document.getElementById('flight-details');
//             detailsDiv.style.display = 'block';
//             if (data.error) {
          
//             } else {
//                 detailsDiv.innerHTML = `
//                     <p>Flight No: ${data.flight_no}</p>
//                     <p>Airline: ${data.airline}</p>
//                     <p>Departure: ${data.departure}</p>
//                     <p>Arrival: ${data.arrival}</p>
//                     <p>Departure Time: ${data.departure_time}</p>
//                     <p>Arrival Time: ${data.arrival_time}</p>
//                     <p>Status: ${data.status}</p>
//                 `;
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//         });
//         detailsDiv.innerHTML = `<p>${data.error}</p>`;
//     });
// </script>
  <!-- <script>
    document.getElementById('flight-search-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const formData = new FormData(this);

        fetch('ticket.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const detailsDiv = document.getElementById('flight-details');
            detailsDiv.style.display = 'block';
            if (data.error) {
                detailsDiv.innerHTML = `<p>${data.error}</p>`;
            } else {
                detailsDiv.innerHTML = `
                    <p>Flight No: ${data.Flight_No}</p>
                    <p>Airline: ${data.Airline}</p>
                    <p>Departure: ${data.Departure}</p>
                    <p>Arrival: ${data.Arrival}</p>
                    <p>Departure Time: ${data.Departure_Time}</p>
                    <p>Arrival Time: ${data.Arrival_Time}</p>
                    <p>Status: ${data.Status}</p>
                `;
            }
        })
        .catch(error => { -->
            <!-- console.error('Error:', error);
        });
    });
</script> -->
</body>
</html>
