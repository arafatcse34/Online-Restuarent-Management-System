<?php require_once('connection/config.php'); ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Access Denied</title>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
  <div id="menu"><ul>
  <li><a href="index.php">Home</a></li>
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
  <h1>Access Denied</h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<div class="error">Access Denied!</div>
  <p>You don't have access to this page. <a href="login-register.php">Click Here</a> to login first or register for free. The registration won't take long:-)</p>
  </div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>