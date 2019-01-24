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
//retrive promotions from the specials table
$sql="SELECT * FROM specials";
$result=mysqli_query($con,$sql);

?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
	$sql="SELECT * FROM currencies WHERE flag='$flag_1'";
    $currencies=mysqli_query($con,$sql);
     
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Specials</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Specials Management </h1>
<a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="reservations.php">Reservations</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php">Options</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table width="850" align="center">
<CAPTION><h3>MANAGE PROMOTIONS</h3></CAPTION>
<form name="specialsForm" id="specialsForm" action="specials-exec.php" method="post" enctype="multipart/form-data" onsubmit="return specialsValidate(this)">
<tr>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Photo</th>
    <th>Action</th>
</tr>
<tr>
    <td><input type="text" name="name" id="name" class="textfield" /></td>
    <td><textarea name="description" id="description" class="textfield" rows="2" cols="15"></textarea></td>
    <td><input type="text" name="price" id="price" class="textfield" /></td>
    <td><input type="date" name="start_date" id="start_date" class="textfield" /></td>
    <td><input type="date" name="end_date" id="end_date" class="textfield" /></td>
    <td><input type="file" name="photo" id="photo"/></td>
    <td><input type="submit" name="Submit" value="Add" /></td>
</tr>
</form>
</table>
<hr>
<table width="950" align="center">
<CAPTION><h3>PROMOTIONS LIST</h3></CAPTION>
<tr>
<th>Promo Photo</th>
<th>Promo Name</th>
<th>Promo Description</th>
<th>Promo Price</th>
<th>Start Date</th>
<th>End Date</th>
<th>Action(s)</th>
</tr>

<?php
//loop through all table rows
$symbol=mysqli_fetch_assoc($currencies); //gets active currency
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo '<td><img src=../images/'. $row['special_photo']. ' width="80" height="70"></td>';
echo "<td>" . $row['special_name']."</td>";
echo "<td width='180' align='left'>" . $row['special_description']."</td>";
echo "<td>" . $symbol['currency_symbol']. "" . $row['special_price']."</td>";
echo "<td>" . $row['special_start_date']."</td>";
echo "<td>" . $row['special_end_date']."</td>";
echo '<td><a href="delete-special.php?id=' . $row['special_id'] . '">Remove Promo</a></td>';
echo "</tr>";
}
mysqli_free_result($result);
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