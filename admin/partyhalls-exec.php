<?php
    //Start session
    session_start();
    
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
    $name = clean($_POST['name']);

    //Create INSERT query
    $qry = "INSERT INTO partyhalls(partyhall_name) VALUES('$name')";
    $result = @mysqli_query($con,$qry);
    
    //Check whether the query was successful or not
    if($result) {
        header("location: options.php");
        exit();
    }else {
        die("Query failed " . mysqli_error());
    }
 ?>