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
//selecting all records from the members table. Return an error if there are no records in the tables
$sql="SELECT * FROM members";
$result=mysqli_query($con,$sql);
 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Members</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Members Management </h1>
<a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="reservations.php">Reservations</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php">Options</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table border="0" width="620" align="center">
<CAPTION><h3>MEMBERS LIST</h3></CAPTION>
<tr>
<th>Member ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['member_id']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['login']."</td>";
echo '<td><a href="delete-member.php?id=' . $row['member_id'] . '">Remove Member</a></td>';
echo "</tr>";
}
mysqli_free_result($result);
mysqli_close($con);
?>
</table>
<hr>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>