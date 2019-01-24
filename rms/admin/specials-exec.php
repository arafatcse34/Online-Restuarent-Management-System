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
    
    //setup a directory where images will be saved 
    $target = "../images/"; 
    $target = $target . basename( $_FILES['photo']['name']); 
    
    //Sanitize the POST values
    $name = clean($_POST['name']);
    $description = clean($_POST['description']);
    $price = clean($_POST['price']);
    $start_date = clean($_POST['start_date']);
    $end_date = clean($_POST['end_date']);
    $photo = clean($_FILES['photo']['name']);

    //Create INSERT query
    $qry = "INSERT INTO specials(special_name, special_description, special_price, special_start_date, special_end_date, special_photo) VALUES('$name','$description','$price','$start_date','$end_date','$photo')";
    $result = @mysqli_query($con,$qry);
    
    //Check whether the query was successful or not
    if($result) {
            //Writes the photo to the server 
         $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $target);
         
         if($moved) 
         {      
             //everything is okay
             echo "The photo ". basename( $_FILES['photo']['name']). " has been uploaded, and your information has been added to the directory"; 
         } else {  
             //Gives an error if its not okay 
             echo "Sorry, there was a problem uploading your photo. "  . $_FILES["photo"]["error"]; 
         }
        header("location: specials.php");
        exit();
    }else {
        die("Query failed " . mysqli_error());
    } 
 ?>