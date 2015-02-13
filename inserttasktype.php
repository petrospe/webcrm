<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
require "config.php";
?>
<html>
<head><title>Task Type Insert</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href= "css/adminsettingsstyle.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
function show_alert()
{
alert("The form data will be added to your database.");
}
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#commentForm").validate();
  });
</script>
</head>
<body>
<div id="stylized" class="myform">
<!-------------begin form------------>
<h3>New Task Type Insert</h3>
<FORM ACTION="tasktypeindb.php" METHOD="POST" NAME="inserttasktype_form" id="commentForm">
<TABLE>
<TR><TD><h4>Task Type Informations</h4></TD></TR>
<TR>
<TD><font size="2", type="bold">Task Type Name</font></TD>
</TR>
<TR>
<TD><a href="#selector"><input type="text" name="tasktypename" class="required" size="80"></a></TD>
</TR>
<TR>
<TD><font size="2", type="bold">International Name</font></TD>
</TR>
<TR>
<TD><input type="text" name="inttasktypename" size="80"></TD>
</TR>
</table>
<table>
<TR>
<TD><font size="2", type="bold">Extra Field 1</font></TD>
<TD><font size="2", type="bold">SQL Query for Extra Field 1</font></TD>
</TR>
<TR>
<TD><input type="text" name="extrafield1" size="50"></TD>
<TD><input type="text" name="queryfield1" size="50"></TD>
</TR>    
<TR>
 <TD><font size="2", type="bold">Extra Field 2</font></TD>
<TD><font size="2", type="bold">SQL Query for Extra Field 2</font></TD>
 </TR>
 <TR>
 <TD><input type="text" name="extrafield2" size="50"></TD>
<TD><input type="text" name="queryfield2" size="50"></TD>
 </TR>     
<TR>
 <TD><font size="2", type="bold">Extra Field 3</font></TD>
<TD><font size="2", type="bold">SQL Query for Extra Field 3</font></TD>
 </TR>
 <TR>
 <TD><input type="text" name="extrafield3" size="50"></TD>
<TD><input type="text" name="queryfield3" size="50"></TD>
 </TR>    
<TR>
 <TD><font size="2", type="bold">Extra Field 4</font></TD>
<TD><font size="2", type="bold">SQL Query for Extra Field 4</font></TD>
 </TR>
 <TR>
 <TD><input type="text" name="extrafield4" size="50"></TD>
<TD><input type="text" name="queryfield4" size="50"></TD>
 </TR>    
<TR>
 <TD><font size="2", type="bold">Extra Field 5</font></TD>
<TD><font size="2", type="bold">SQL Query for Extra Field 5</font></TD>
 </TR>
 <TR>
 <TD><input type="text" name="extrafield5" size="50"></TD>
<TD><input type="text" name="queryfield5" size="50"></TD>
 </TR>    
<TR>
 <TD><font size="2", type="bold">Extra Field 6</font></TD>
<TD><font size="2", type="bold">SQL Query for Extra Field 6</font></TD>
 </TR>
 <TR>
 <TD><input type="text" name="extrafield6" size="50"></TD>
<TD><input type="text" name="queryfield6" size="50"></TD>
 </TR>
<TR>
 <TD><font size="2", type="bold">Extra Field 7</font></TD>
<TD><font size="2", type="bold">SQL Query for Extra Field 7</font></TD>
 </TR>
 <TR>
 <TD><input type="text" name="extrafield7" size="50"></TD>
<TD><input type="text" name="queryfield7" size="50"></TD>
 </TR>
<TR>
 <TD><font size="2", type="bold">Extra Field 8</font></TD>
<TD><font size="2", type="bold">SQL Query for Extra Field 8</font></TD>
 </TR>
 <TR>
 <TD><input type="text" name="extrafield8" size="50"></TD>
<TD><input type="text" name="queryfield8" size="50"></TD>
 </TR>
<TR>
 <TD><font size="2", type="bold">Extra Field 9</font></TD>
<TD><font size="2", type="bold">SQL Query for Extra Field 9</font></TD>
 </TR>
 <TR>
 <TD><input type="text" name="extrafield9" size="50"></TD>
<TD><input type="text" name="queryfield9" size="50"></TD>
 </TR>
<TR>
 <TD><font size="2", type="bold">Extra Field 10</font></TD>
<TD><font size="2", type="bold">SQL Query for Extra Field 10</font></TD>
 </TR>
 <TR>
 <TD><input type="text" name="extrafield10" size="50"></TD>
<TD><input type="text" name="queryfield10" size="50"></TD>
 </TR>    
</TABLE>
<br>
<table>
<tr>
<th><input type="submit" value="Insert" name="Submit" onclick="show_alert()" class="button"></th>
<th><input type="reset" value="Reset" name="Reset" class="button"></th>
</FORM>
<th><INPUT TYPE="button" VALUE="Back" onClick="document.location = 'adminsettings.php';" class="button"></th>
</tr>
</table>
<!-------------end form------------>
</body>
<html>
