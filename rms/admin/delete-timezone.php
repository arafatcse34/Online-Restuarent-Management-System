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
    
    //Function to sanitize values received from the form. Prevents SQL injection
    function clean($str) {
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        $con=mysqli_connect('localhost','root','','rms') or die ("unable to connect");
           return mysqli_real_escape_string($con,$str);
    }
    
    // check if Delete is set in POST
     if (isset($_POST['Delete'])){
         // get id value of timezone and Sanitize the POST value
         $timezone_id = clean($_POST['timezone']);
         
         // delete the entry
		 $sql="DELETE FROM timezones WHERE timezone_id='$timezone_id'";
         $result = mysqli_query($con,$sql);
         
         
         // redirect back to options
         header("Location: options.php");
     }
     
         else
            // if id isn't set, redirect back to options
         {
            header("Location: options.php");
         }
?>