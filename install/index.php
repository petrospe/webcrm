<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
Installation
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/favicon.ico" />
<style>
* { margin: 0; padding: 0; }
body,p,table,caption,tr,td { font-family: Georgia, serif; font-size: 14px; padding:0px; background-color:#c4c4c4; color: #3a3a3a;}
div { padding: 10px; text-align: center;}
.clear { clear: both; }

form { width: 406px; margin: 170px auto 0; }

legend { display: none; }

fieldset { border: 0; }

input { width: 220px; display: block; padding: 4px; margin: 0 0 10px 0; font-size: 18px;color: #3a3a3a; font-family: Georgia, serif;}

input[type=checkbox] { width: 20px; margin: 0; display: inline-block; }
					  
.button { background-color: #3a3a3a; border: 1px solid #999;
					  -moz-border-radius: 5px; padding: 5px; color: black; font-weight: bold;
					  -webkit-border-radius: 5px; font-size: 13px;  width: 70px; }

.button:hover { background: white; color: black; }
</style>
</head>
<body>
<div>
	<h1>Installation</h1>
</div>
<div>
	<h3>Welcome to installation form.</h3>
</div>
<div>
	<h3>Fill the following fields to create the database.</h3>
</div>
	<form action="install.php" method="post" name="install_form" id="commentForm">
<table>
	<caption style="color:#800517;font-size:18px;font-family: Georgia, serif;font-weight:600;">MySQL Settings</caption>
	<tr>
		<td><h2 style="margin-bottom:10px;text-align:right;">Server Name:</h2></td>
		<td><input type="text" name="servername" placeholder="localhost"/></td>
	</tr>
	<tr>
		<td><h2 style="margin-bottom:10px;text-align:right;">Root Name:</h2></td>
		<td><input type="text" name="rootname" placeholder="root"/></td>
	</tr>
	<tr>
		<td><h2 style="margin-bottom:10px;text-align:right;">Root Password:</h2></td>
		<td><input type="password" name="rootpasswd" placeholder="**********" /></td>
	</tr>
</table>
<table>
	<caption style="color:#800517;font-size: 18px;font-family: Georgia, serif;font-weight:600;">Database Settings</caption>
	<tr>
		<td><h2 style="margin-bottom:10px;text-align:right;">User Name:</h2></td>
		<td><input type="text" name="username" placeholder="dbuser"/></td>
	</tr>
	<tr>
		<td><h2 style="margin-bottom:10px;text-align:right;">Password:</h2></td>
		<td><input type="password" name="passwd" placeholder="**********" /></td>
	</tr>
	<tr>
		<td><h2 style="margin-bottom:10px;text-align:right;">Database name:</h2></td>
		<td><input type="text" name="database" placeholder="a904abMS" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input name="submit" type="submit" value="Create"></td>
	</tr>
</table>
</form>

</body>
</html>