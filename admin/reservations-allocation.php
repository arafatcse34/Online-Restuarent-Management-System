<?php
	//checking connection and connecting to a database
	require_once('connection/config.php');
	//Connect to mysql server
	$con=mysqli_connect('localhost','root','','rms') or die ("unable to connect");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
 //Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		$con=mysqli_connect('localhost','root','','rms') or die ("unable to connect");
           return mysqli_real_escape_string($con,$str);
	}
	
	//Sanitize the POST values
	$ReservationID = clean($_POST['reservationid']);
	$StaffID = clean($_POST['staffid']);
	
    //define a default value for flag
    $flag_1 = 1;
 
     // update the entry
	 $sql="UPDATE reservations_details SET StaffID='$StaffID', flag='$flag_1' WHERE ReservationID='$ReservationID'";
     $result = mysqli_query($con,$sql);
     
     
     //check if query executed
     if($result) {
     // redirect back to the allocation page
     header("Location: allocation.php");
     exit();
     }
     else
     // Gives an error
     {
     die("reservation allocation failed ..." . mysqli_error());
     }
 
?>