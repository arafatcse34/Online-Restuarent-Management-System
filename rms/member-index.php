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

//selecting all records from the orders_details table. Return an error if there are no records in the table
$sql=("SELECT * FROM orders_details,cart_details,food_details,categories,quantities,members WHERE members.member_id='$memberId' AND orders_details.member_id='$memberId' AND orders_details.cart_id=cart_details.cart_id AND cart_details.food_id=food_details.food_id AND food_details.food_category=categories.category_id AND cart_details.quantity_id=quantities.quantity_id");
$result=mysqli_query($con,$sql);
 
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
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
	$sql="SELECT * FROM currencies WHERE flag='$flag_1'";
    $currencies=mysqli_query($con,$sql);
    
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Member Home</title>
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
  </div>
  <center>
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
  </center>
</div>
<div id="center">
<h1>Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?></h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<a href="member-profile.php">My Profile</a> | <a href="cart.php">Cart[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Inbox[<?php echo $num_messages;?>]</a> | <a href="tables.php">Table Reserve</a>  | <a href="partyhalls.php">Party-Halls</a> | <a href="ratings.php">Rate Us</a> |  <a href="logout.php">Logout</a>
<p>&nbsp;</p>
<p>Here you can view order history and delete old orders from your account. Invoices can be viewed from the order history. You can also make table reservations in your account. For more information <a href="contactus.php">Click Here</a> to contact us.
<h3><a href="foodzone.php">Order More Food!</a></h3>
<hr>
<table border="0" width="910" style="text-align:center;">
<CAPTION><h2>ORDER HISTORY</h2></CAPTION>
<tr>
<th>Order ID</th>
<th>Food Photo</th>
<th>Food Name</th>
<th>Food Category</th>
<th>Food Price</th>
<th>Quantity</th>
<th>Total Cost</th>
<th>Delivery Date</th>
<th>Action(s)</th>
</tr>

<?php
//loop through all table rows
$symbol=mysqli_fetch_assoc($currencies); //gets active currency
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['order_id']."</td>";
echo '<td><a href=images/'. $row['food_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['food_photo']. ' width="80" height="70"></a></td>';
echo "<td>" . $row['food_name']."</td>";
echo "<td>" . $row['category_name']."</td>";
echo "<td>" . $symbol['currency_symbol']. "" . $row['food_price']."</td>";
echo "<td>" . $row['quantity_value']."</td>";
echo "<td>" . $symbol['currency_symbol']. "" . $row['total']."</td>";
echo "<td>" . $row['delivery_date']."</td>";
echo '<td><a href="delete-order.php?id=' . $row['order_id'] . '">Cancel Order</a></td>';
echo "</tr>";
}
mysqli_free_result($result);
mysqli_close($con);
?>
</table>
</div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>
