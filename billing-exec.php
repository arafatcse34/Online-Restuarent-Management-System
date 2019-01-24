<?php
	//Start session
	session_start();
	header("location: billing-success.php");
	
	//Include database connection details
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
	$StreetAddress = clean($_POST['sAddress']);
	$BoxNo = clean($_POST['box']);
	$City = clean($_POST['city']);
	$MobileNo = clean($_POST['mNumber']);
	$LandlineNo = clean($_POST['lNumber']);
	// check if the 'id' variable is set in URL

	// check if the 'id' variable is set in URL
	
	if (isset($_GET['id']))
	{
	// get id value
	$id = $_GET['id'];

	//Create INSERT query
	$qry = "INSERT INTO billing_details(member_id,Street_Address,P_O_Box_No,City,Mobile_No,Landline_No) VALUES('$id','$StreetAddress','$BoxNo','$City','$MobileNo','$LandlineNo')";
	mysqli_query($con,$qry);
	
	//redirect to billing-success page
	header("location: billing-success.php");
	}else {
		die("Adding billing information failed! Please try again after a few minutes.");
	}
?>