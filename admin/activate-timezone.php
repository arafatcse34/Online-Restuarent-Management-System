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
    
    if(isset($_POST['Update'])){
        //define default values for flag_0 and flag_1
        $flag_0 = 0;
        $flag_1 = 1;
        
        //check whether their is an active currency
		$sql="SELECT * FROM timezones WHERE flag='$flag_1'";
        $qry=mysqli_query($con,$sql);
        if(mysql_num_rows($qry)>0){
            $row=mysqli_fetch_assoc($qry);
            $timezone_id=$row['timezone_id'];
            // update the entry with a deactivation flag
			$q="UPDATE timezones SET flag='$flag_0' WHERE timezone_id='$timezone_id'";
            $result = mysqli_query($con,$q);
            
            
                //Perform activation of another timezone
                
                    //Sanitize the POST values
                    $timezone_id = clean($_POST['timezone']);
             
                 // update the entry with an activation flag
				 $z="UPDATE timezones SET flag='$flag_1' WHERE timezone_id='$timezone_id'";
                 $result = mysqli_query($con,$z);
                
                 
                 //check if query executed
                 if($result) {
                     // redirect back to the options page
                     header("Location: options.php");
                     exit();
                 }
                 else
                 // Gives an error
                 {
                    die("activating a timezone failed ..." . mysqli_error());
                 }
        }
            else{
                    //Sanitize the POST values
                    $timezone_id = clean($_POST['timezone']);
             
                 // update the entry with an activation flag
				 $sql="UPDATE timezones SET flag='$flag_1' WHERE timezone_id='$timezone_id'";
                 $result = mysqli_query($con,$sql);
                 
                 
                 //check if query executed
                 if($result) {
                 // redirect back to the options page
                 header("Location: options.php");
                 exit();
                 }
                 else
                 // Gives an error
                 {
                 die("activating a timezone failed ..." . mysqli_error());
                 }
            }
    }
?>