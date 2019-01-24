<?php
    //Start session
    session_start();
    
	//checking connection and connecting to a database
	require_once('connection/config.php');
	//Connect to mysql server
	$con=mysqli_connect('localhost','root','','rms') or die ("unable to connect");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
     // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
         // get id value
         $id = $_GET['id'];
         
         // delete the entry
		 $sql="DELETE FROM members WHERE member_id='$id'";
         $result = mysqli_query($con,$sql);
         
         
         // redirect back to the accounts page
         header("Location: accounts.php");
     }
     else
        // if id isn't set, redirect back to the accounts page
     {
        header("Location: accounts.php");
     }
 
?>