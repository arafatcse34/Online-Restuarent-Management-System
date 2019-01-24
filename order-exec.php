<?php
	//Start session
	//session_start();
	
	require_once('auth.php');
	
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
    
    //get member_id from session
    $member_id = $_SESSION['SESS_MEMBER_ID'];
    
    //checks whether the member has a billing address setup
    //get the billing_id from the billing_details table based on the member_id in auth.php
	$sql="SELECT * FROM billing_details WHERE member_id='$member_id'";
    $qry_select=mysqli_query($con,$sql);
    
    
    if(mysqli_num_rows($qry_select)>0 && isset($_GET['id'])){
	
	        //get cart_id
	        $id = $_GET['id'];
            
	        //define default values for flag_0 and flag_1
            $flag_0 = 0;
            $flag_1 = 1;
            
            //retrive a timezone from the timezones table
			$sql="SELECT * FROM timezones WHERE flag='$flag_1'";
            $timezones=mysqli_query($con,$sql);
            
            
            $row=mysqli_fetch_assoc($timezones); //gets retrieved row
            
            $active_reference = $row['timezone_reference']; //gets active timezone
            
           // date_default_timezone_set($active_reference); //sets the default timezone for use
            
            $time_stamp = date("H:i:s"); //gets the current time
            
            $delivery_date = date("Y-m-d"); //gets the current date
	        
	        //storing the billing_id into a variable
	        $row=mysqli_fetch_array($qry_select);
	        $billing_id=$row['billing_id'];

	        $staff = 4;
	        
	        //Create INSERT query
	        $qry_create = "INSERT INTO orders_details(member_id,billing_id,cart_id,delivery_date,staffID,flag,time_stamp) VALUES('$member_id','$billing_id','$id','$delivery_date','$staff','$flag_0','$time_stamp')";
	        mysqli_query($con,$qry_create);
            
            //Create UPDATE query (updates flag value in the cart_details table)
	        $qry_update = "UPDATE cart_details SET flag='$flag_1' WHERE cart_id='$id' AND member_id='$member_id'";
            mysqli_query($con,$qry_update);
            
	        header("location: member-index.php");
		    
    }else {
	        header("location: billing-alternative.php"); //redirects to billing-alternative.php if not setup
	    }
?>