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
    $user_name = $_POST['username'];
    $fullname = $_POST['fullname'];
    $date_of_birth = $_POST['dob'];
    $address = $_POST['Address'];
    $age = $_POST['Age'];
    $contact_num = $_POST['Connum'];
    $gender = $_POST['gender'];

    $sql_query = "INSERT INTO user_details(User_Name,Full_Name,age,gender,Full_Address,Date_of_Birth,Contact_No)
    VALUES ('$user_name','$fullname','$age','$gender','$address','$date_of_birth','$contact_num')";

    if (mysqli_query($conn, $sql_query))
    {
        $message = "New record created successfully";
         header("Location: register.html?message=" . urlencode($message));
    }
    else
     {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);


}





?>
