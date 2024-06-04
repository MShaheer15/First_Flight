<?php
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "airline_reservation_system";

$conn = mysqli_connect($server_name, $username, $password, $database_name);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

if (isset($_POST['save'])) {
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $deptime = $_POST['deptime'];
    $arrtime = $_POST['arrtime'];
    $seats = $_POST['seats'];
    $airline = $_POST['airline'];
    $seat_no = $_POST['seat_no'];
    $contact_no = $_POST['contact'];
    $flight_no = $_POST['flight'];

    // Start a transaction
    mysqli_begin_transaction($conn);

    try {
        // Insert into flight table
        $sql_query1 = "INSERT INTO flight (Flight_No, Source, Destination, Arrival_Time, Departure_time, Airline_Name, Num_of_seats) 
                       VALUES ('$flight_no', '$source', '$destination', '$arrtime', '$deptime', '$airline', '$seats')";

        if (mysqli_query($conn, $sql_query1)) {
            // Insert into airline table
            $sql_query2 = "INSERT INTO airline (Airline_ID, Airline_Name, Contact_No) 
                           VALUES ('$flight_no', '$airline', '$contact_no')";
            
            if (mysqli_query($conn, $sql_query2)) {
                // Insert into ticket table
                $sql_query3 = "INSERT INTO ticket (Flight_No,Source, Destination, Seat_No) 
                               VALUES ('$flight_no','$source', '$destination', '$seat_no')";

                if (mysqli_query($conn, $sql_query3)) {
                    // Commit transaction
                    mysqli_commit($conn);
                    $message = "New records created successfully";
                    header("Location: flight.html?message=" . urlencode($message));
                } else {
                    throw new Exception("Error: " . $sql_query3 . "<br>" . mysqli_error($conn));
                }
            } else {
                throw new Exception("Error: " . $sql_query2 . "<br>" . mysqli_error($conn));
            }
        } else {
            throw new Exception("Error: " . $sql_query1 . "<br>" . mysqli_error($conn));
        }
    } catch (Exception $e) {
        // Rollback transaction if any query fails
        mysqli_rollback($conn);
        echo $e->getMessage();
    }

    mysqli_close($conn);
}
?>
