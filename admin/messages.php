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
//selecting all records from the messages table. Return an error if there is a problem
$sql="SELECT * FROM messages";
$result=mysqli_query($con,$sql);
 
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Messages</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Messages Management </h1>
<a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="reservations.php">Reservations</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php">Options</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<form id="messageForm" name="messageForm" method="post" action="message-exec.php" onsubmit="return messageValidate(this)">
  <table width="540" border="0" cellpadding="2" cellspacing="0" align="center">
  <CAPTION><h3>SEND A MESSAGE</h3></CAPTION>
    <tr>
      <th width="200">Subject</th>
      <td width="168"><input type="text" name="subject" id="subject" class="textfield" /></td>
    </tr>
    <tr>
      <th width="200">Message Box</th>
      <td width="168"><textarea name="txtmessage" class="textfield" rows="5" cols="60"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><input type="submit" name="Submit" value="Send Message" />
	  <input type="reset" name="Reset" value="Clear Field" /></td>
    </tr>
  </table>
</form>
<hr>
<table border="0" width="1000" align="center">
<CAPTION><h3>SENT MESSAGES</h3></CAPTION>
<tr>
<th>Message ID</th>
<th>Date Sent</th>
<th>Time Sent</th>
<th>Message Subject</th>
<th>Message Text</th>
<th>Action(s)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['message_id']."</td>";
echo "<td>" . $row['message_date']."</td>";
echo "<td>" . $row['message_time']."</td>";
echo "<td>" . $row['message_subject']."</td>";
echo "<td width='300' align='left'>" . $row['message_text']."</td>";
echo '<td><a href="delete-message.php?id=' . $row['message_id'] . '">Remove Message</a></td>';
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