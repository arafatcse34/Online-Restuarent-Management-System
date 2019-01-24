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
    //selecting all records from the staff table. Return an error if there are no records in the tables
	$sql="SELECT * FROM staff";
    $staff=mysqli_query($con,$sql);
    
?>
<?php
    //get order ids from the orders_details table based on flag=0
    $flag_0 = 0;
	$sql="SELECT * FROM orders_details WHERE flag='$flag_0'";
    $orders=mysqli_query($con,$sql);
 
?>
<?php
    //get reservation ids from the reservations_details table based on flag=0
    $flag_0 = 0;
	$sql="SELECT * FROM reservations_details WHERE flag='$flag_0'";
    $reservations=mysqli_query($con,$sql);
     
?>
<?php
    //selecting all records from the staff table. Return an error if there are no records in the tables
	$sql="SELECT * FROM staff";
    $staff_1=mysqli_query($con,$sql);
    
?>
<?php
    //selecting all records from the staff table. Return an error if there are no records in the tables
	$sql="SELECT * FROM staff";
    $staff_2=mysqli_query($con,$sql);
    
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Staff</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Staff Allocation </h1>
<a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="reservations.php">Reservations</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php">Options</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table border="0" width="600" align="center">
<CAPTION><h3>STAFF LIST</h3></CAPTION>
<tr>
<th>Staff ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Street Address</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($staff)){
echo "<tr>";
echo "<td>" . $row['StaffID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['Street_Address']."</td>";
echo '<td><a href="delete-staff.php?id=' . $row['StaffID'] . '">Remove Staff</a></td>';
echo "</tr>";
}
mysqli_free_result($staff);
mysqli_close($con);
?>
</table>
<hr>
<table align="center">
<tr>
<form id="ordersAllocationForm" name="ordersAllocationForm" method="post" action="orders-allocation.php" onsubmit="return ordersAllocationValidate(this)">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0">
  <CAPTION><h3>ORDERS ALLOCATION</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
	</tr>
    <tr>
      <th width="124">Order ID</th>
      <td width="168"><font color="#FF0000">* </font><select name="orderid" id="orderid">
        <option value="select">- select one option -
        <?php 
        //loop through orders_details table rows
        while ($row=mysqli_fetch_array($orders)){
        echo "<option value=$row[order_id]>$row[order_id]"; 
        }
        ?>
        </select></td>
    </tr>
    <tr>
      <th>Staff ID</th>
      <td><font color="#FF0000">* </font><select name="staffid" id="staffid">
        <option value="select">- select one option -
        <?php 
        //loop through staff table rows
        while ($row=mysqli_fetch_array($staff_1)){
        echo "<option value=$row[StaffID]>$row[StaffID]"; 
        }
        ?>
        </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Allocate Staff" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form id="reservationsAllocationForm" name="reservationsAllocationForm" method="post" action="reservations-allocation.php" onsubmit="return reservationsAllocationValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <CAPTION><h3>RESERVATIONS ALLOCATION</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
	</tr>
    <tr>
      <th>Reservation ID </th>
      <td><font color="#FF0000">* </font><select name="reservationid" id="reservationid">
        <option value="select">- select one option -
        <?php 
        //loop through reservations_details table rows
        while ($row=mysqli_fetch_array($reservations)){
        echo "<option value=$row[ReservationID]>$row[ReservationID]"; 
        }
        ?>
        </select></td>
    </tr>
	<tr>
      <th>Staff ID </th>
      <td><font color="#FF0000">* </font><select name="staffid" id="staffid">
        <option value="select">- select one option -
        <?php 
        //loop through staff table rows
        while ($row=mysqli_fetch_array($staff_2)){
        echo "<option value=$row[StaffID]>$row[StaffID]"; 
        }
        ?>
        </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Allocate Staff" /></td>
    </tr>
  </table>
</td>
</form>
</tr>
</table>
<p>&nbsp;</p>
<hr>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>