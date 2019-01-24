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
//selecting all records from the reservations_details table based on table ids. Return an error if there are no records in the table
$sql="SELECT members.firstname, members.lastname, reservations_details.ReservationID, reservations_details.table_id, reservations_details.Reserve_Date, reservations_details.Reserve_Time, tables.table_id, tables.table_name FROM members, reservations_details, tables WHERE members.member_id = reservations_details.member_id AND tables.table_id=reservations_details.table_id";
$tables=mysqli_query($con,$sql);


//selecting all records from the reservations_details table based on partyhall ids. Return an error if there are no records in the table
$s="SELECT members.firstname, members.lastname, reservations_details.ReservationID, reservations_details.partyhall_id, reservations_details.Reserve_Date, reservations_details.Reserve_Time, partyhalls.partyhall_id, partyhalls.partyhall_name FROM members, reservations_details, partyhalls WHERE members.member_id = reservations_details.member_id AND partyhalls.partyhall_id=reservations_details.partyhall_id";
$partyhalls=mysqli_query($con,$s);

?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Reservations</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Reservations Management </h1>
<a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="reservations.php">Reservations</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php">Options</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table border="0" width="900" align="center">
<CAPTION><h3>TABLES RESERVED</h3></CAPTION>
<tr>
<th>Reservation ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Table Name</th>
<th>Reserved Date</th>
<th>Reserved Time</th>
<th>Action(s)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($tables)){
echo "<tr>";
echo "<td>" . $row['ReservationID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['table_name']."</td>";
echo "<td>" . $row['Reserve_Date']."</td>";
echo "<td>" . $row['Reserve_Time']."</td>";
echo '<td><a href="delete-reservation.php?id=' . $row['ReservationID'] . '">Delete Reservation</a></td>';
echo "</tr>";
}
mysqli_free_result($tables);
//mysql_close($link);
?>
</table>
<hr>
<table border="0" width="900" align="center">
<CAPTION><h3>PARTY-HALLS RESERVED</h3></CAPTION>
<tr>
<th>Reservation ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>PartyHall Name</th>
<th>Reserved Date</th>
<th>Reserved Time</th>
<th>Action(s)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($partyhalls)){
echo "<tr>";
echo "<td>" . $row['ReservationID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['partyhall_name']."</td>";
echo "<td>" . $row['Reserve_Date']."</td>";
echo "<td>" . $row['Reserve_Time']."</td>";
echo '<td><a href="delete-reservation.php?id=' . $row['ReservationID'] . '">Delete Reservation</a></td>';
echo "</tr>";
}
mysqli_free_result($partyhalls);
mysqli_close($con);
?>
</table>
<hr>
</div>
<?php
	include 'footer.php';
?>
</div>
</body>
</html>