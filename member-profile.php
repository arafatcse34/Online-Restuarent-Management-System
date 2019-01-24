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
<title>My Profile</title>
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
<h1>My Profile</h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<a href="member-index.php">Home</a> | <a href="cart.php">Cart[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Inbox[<?php echo $num_messages;?>]</a> | <a href="tables.php">Table Reserve</a>| <a href="partyhalls.php">Party-Halls</a> | <a href="ratings.php">Rate Us</a> |  <a href="logout.php">Logout</a>
<p>&nbsp;</p>
<p>Here you can change your password and also add a billing or delivery address. The delivery address will be used to bill your food orders as well as providing us with details on where to deliver your food. For more information <a href="contactus.php">Click Here</a> to contact us.</p>
<hr>
<table width="870">
<tr>
<form id="updateForm" name="updateForm" method="post" action="update-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return updateValidate(this)">
<td>
  <table width="350" align="center" border="0" cellpadding="2" cellspacing="0">
  <CAPTION><h2>CHANGE YOUR PASSWORD</h2></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
	</tr>
    <tr>
      <th width="124">Old Password</th>
      <td width="168"><font color="#FF0000">* </font><input name="opassword" type="password" class="textfield" id="opassword" /></td>
    </tr>
    <tr>
      <th>New Password</th>
      <td><font color="#FF0000">* </font><input name="npassword" type="password" class="textfield" id="npassword" /></td>
    </tr>
    <tr>
      <th>Confirm New Password </th>
      <td><font color="#FF0000">* </font><input name="cpassword" type="password" class="textfield" id="cpassword" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Change" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form id="billingForm" name="billingForm" method="post" action="billing-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return billingValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <CAPTION><h2>ADD DELIVERY/BILLING ADDRESS</h2></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
	</tr>
    <tr>
      <th>Street Address </th>
      <td><font color="#FF0000">* </font><input name="sAddress" type="text" class="textfield" id="sAddress" /></td>
    </tr>
	<tr>
      <th>P.O. Box No </th>
      <td><font color="#FF0000">* </font><input name="box" type="text" class="textfield" id="box" /></td>
    </tr>
    <tr>
      <th>City </th>
      <td><font color="#FF0000">* </font><input name="city" type="text" class="textfield" id="city" /></td>
    </tr>
    <tr>
      <th width="124">Mobile No</th>
      <td width="168"><font color="#FF0000">* </font><input name="mNumber" type="text" class="textfield" id="mNumber" /></td>
    </tr>
    <tr>
      <th>Landline No</th>
      <td>&nbsp;&nbsp;&nbsp;<input name="lNumber" type="text" class="textfield" id="lNumber" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Add" /></td>
    </tr>
  </table>
</td>
</form>
</tr>
</table>
<p>&nbsp;</p>
</div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>