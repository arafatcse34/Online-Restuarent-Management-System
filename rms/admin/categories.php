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
//retrive categories from the categories table
$con=mysqli_connect('localhost','root','','rms') or die ("unable to connect");
$sql="SELECT * FROM categories";
$result=mysqli_query($con,$sql);

?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Categories</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Categories Management</h1>
<a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="reservations.php">Reservations</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php">Options</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table width="320" align="center">
<CAPTION><h3>ADD A NEW CATEGORY</h3></CAPTION>
<form name="categoryForm" id="categoryForm" action="categories-exec.php" method="post" onsubmit="return categoriesValidate(this)">
<tr>
    <th>Name</th>
    <th>Action(s)</th>
</tr>
<tr>
    <td><input type="text" name="name" class="textfield" /></td>
    <td><input type="submit" name="Submit" value="Add" /></td>
</tr>
</form>
</table>
<hr>
<table width="320" align="center">
<CAPTION><h3>AVAILABLE CATEGORIES</h3></CAPTION>
<tr>
<th>Category Name</th>
<th>Action(s)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['category_name']."</td>";
echo '<td><a href="delete-category.php?id=' . $row['category_id'] . '">Remove Category</a></td>';
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