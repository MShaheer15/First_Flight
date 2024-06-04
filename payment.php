<?php
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "airline_reservation_system";


$conn = mysqli_connect($server_name,$username,$password,$database_name);
if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());

}

if(isset($_POST['save']))
{
    $card_No = $_POST['Card_No'];
    $amount = $_POST['Amount'];
    $paymethod = $_POST['payment'];
    
    $sql_query = "INSERT INTO payment(Card_No,Payment_Mode,Amount)
    VALUES ('$card_No','$paymethod','$amount')";

    if (mysqli_query($conn, $sql_query))
    {
        $message = "New record created successfully";
         header("Location: payment.html?message=" . urlencode($message));
    }
    else
     {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);


}





?>
