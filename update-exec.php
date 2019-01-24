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
	$OldPassword = clean($_POST['opassword']);
	$NewPassword = clean($_POST['npassword']);
	$ConfirmNewPassword = clean($_POST['cpassword']);
	
     // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
         // get id value
         $id = $_GET['id'];
         
         // update the entry
		 $sql="UPDATE members SET passwd='".md5($_POST['npassword'])."' WHERE member_id='$id' AND passwd='".md5($_POST['opassword'])."'";
         $result = mysqli_query($con,$sql);
         or die("Password changing failed! Please try again after a few minutes"); 
         
         if($result){
             // redirect back to the member profile
             header("Location: member-profile.php");
         }
         else{
            header("Location: reset-failed.php"); // failed to update password
         }
     }
     else
     // if id isn't set, give an error
     {
        die("Password changing failed! Please try again after a few minutes");
     } 
?>