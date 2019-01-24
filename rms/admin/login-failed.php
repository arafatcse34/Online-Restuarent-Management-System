<?php
	require_once('connection/config.php');
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Failed</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Login Failed </h1>
<p align="center">&nbsp;</p>
</div>
<h4 align="center" class="err">Login Failed!</h4>
<p align="center">Please check your username and password and <a href="login-form.php">try again</a></p>
<?php include 'footer.php'; ?>
</div>
</body>
</html>
