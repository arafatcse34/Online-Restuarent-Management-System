<?php
    require_once('auth.php');
?>
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
//get member id from session
$memberId=$_SESSION['SESS_MEMBER_ID']; 

//selecting all records from the food_details table. Return an error if there are no records in the table
$sql="SELECT * FROM food_details";
$foods=mysqli_query($con,$sql);


//selecting all records from the ratings table. Return an error if there are no records in the table
$sq="SELECT * FROM ratings";
$ratings=mysqli_query($con,$sq);

?>
<?php
    //retrieving all rows from the cart_details table based on flag=0
    $flag_0 = 0;
	$sql="SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'";
    $items=mysqli_query($con,$sql);
   
    //get the number of rows
    $num_items = mysqli_num_rows($items);
?>
<?php
    //retrieving all rows from the messages table
	$sql="SELECT * FROM messages";
    $messages=mysqli_query($con,$sql);
    
    //get the number of rows
    $num_messages = mysqli_num_rows($messages);
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Rating</title>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">
  <div id="menu"><ul>
  <li><a href="member-index.php">Home</a></li>
  <li><a href="foodzone.php">Food Zone</a></li>
  <li><a href="specialdeals.php">Special Deals</a></li>
  <li><a href="member-index.php">My Account</a></li>
  <li><a href="contactus.php">Contact Us</a></li>
  </ul>
  </div><center>
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
  </center>
</div>
<div id="center">
<h1>RATE US</h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<a href="member-index.php">Home</a> | <a href="cart.php">Cart[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Inbox[<?php echo $num_messages;?>]</a> | <a href="tables.php">Reserve</a> | <a href="ratings.php">Rate Us</a> | <a href="logout.php">Logout</a>
<p>&nbsp;</p>
<p>Here you can ... For more information <a href="contactus.php">Click Here</a> to contact us.
<hr>
<form name="ratingForm" id="ratingForm" method="post" action="ratings-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return ratingValidate(this)" style="text-align:center;">
    <table align="center" width="300">
        <CAPTION><h2>RATE OUR FOODS</h2></CAPTION>
            <tr>
                <td>Food</td>
                <td><select name="food" id="food">
                <option value="select">- select food -
                <?php 
                //loop through food_details table rows
                while ($row=mysqli_fetch_array($foods)){
                echo "<option value=$row[food_id]>$row[food_name]"; 
                }
                ?>
                </select></td>
            <tr>
                <td>Scale</td>
                <td><select name="scale" id="scale">
                <option value="select">- select scale -
                <?php 
                //loop through ratings table rows
                while ($row=mysqli_fetch_array($ratings)){
                echo "<option value=$row[rate_id]>$row[rate_name]"; 
                }
                ?>
                </select></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="Submit" value="Rate" /></td>
            </td>
    </table>
</form>
</div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>