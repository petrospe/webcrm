<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<link href= "css/persontablestyle.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="60" > 
</head>
<div style='background-color: #AFC7C7; width:100%; height:100pix; padding:4px; border:solid 2px #5E767E;'>
<body>
<?php
  // Get the search variable from URL

  $var1 = $_GET['q'] ;

echo "<h4>Person results</h4>";
echo "<p>Go <a href='#' onClick='self.close();'>Back</a></p>";

require "config.php";

$result = mysql_query( "SELECT p.id as id, p.descr as Name, at.descr as Attribute, p.occupation as Occupation, p.company as Company, p.street1 as Address, p.city1 as City, p.zipcode1 as TK, p.phone1 as Tel1, p.phone2 as Tel2, p.mobile as Cellphone, p.fax as Fax, pn.descr as notes, p.email as email, p.website as website, p.street2 as street2, p.personextra1 as city2, p.personextra2 as zipcode2, p.phone3 as phone3, p.afm as afm, p.personextra3 as IC, d.descr as doy
FROM person p 
left join personnotes pn on pn.personid = p.id
left join attributes at on at.id = p.attributeid
left join doy d on d.id = p.doyid
where isdeleted = 0 and p.id = '$var1'")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);
print "$num_rows records.<P>";

echo"<table border='1'>
<tr>
<th>Name</th>
<th>Attribute</th>
<th>Occupation</th>
<th>Company</th>
<th>Address</th>
<th>City</th>
<th>Postal Code</th>
<th>Phone 1</th>
<th>Phone 2</th>
<th>Cellphone</th>
<th>Fax</th>
<th>Notes</th>
<th>Email</th>
<th>Website</th>
<th>Street 2</th>
<th>City 2</th>
<th>Postal Code 2</th>
<th>Phone 3</th>
<th>Tax Reg. No</th>
<th>Inland Revenue</th>
<th>IC or Passport</th>
</tr>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateperson3.php?pid=" . $row['id'] . "' target='_blank'>".$row['Name']."</a></td>";
  echo "<td>" . $row['Attribute'] . "</td>";
  echo "<td>" . $row['Occupation'] . "</td>";
  echo "<td>" . $row['Company'] . "</td>";
  echo "<td>" . $row['Address'] . "</td>";
  echo "<td>" . $row['City'] . "</td>";
  echo "<td>" . $row['TK'] . "</td>";
  echo "<td>" . $row['Tel1'] . "</td>";
  echo "<td>" . $row['Tel2'] . "</td>";
  echo "<td>" . $row['Cellphone'] . "</td>";
  echo "<td>" . $row['Fax'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . $row['website'] . "</td>";
  echo "<td>" . $row['street2'] . "</td>";
  echo "<td>" . $row['city2'] . "</td>";
  echo "<td>" . $row['zipcode2'] . "</td>";
  echo "<td>" . $row['phone3'] . "</td>";
  echo "<td>" . $row['afm'] . "</td>";
  echo "<td>" . $row['doy'] . "</td>";
  echo "<td>" . $row['IC'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

'mysql_close';
?>
<p>Return to :
<p><INPUT TYPE="BUTTON" style="height: 25px; width: 100px" VALUE="Person" ONCLICK="window.location.href ='person.php'"; return false">
<INPUT TYPE="BUTTON" style="height: 25px; width: 100px" VALUE="Matters" ONCLICK="window.location.href ='matters.php'"; return false">
<INPUT TYPE="BUTTON" style="height: 25px; width: 100px" VALUE="Tasks" ONCLICK="window.location.href ='tasks.php'"; return false">
<INPUT TYPE="BUTTON" style="height: 25px; width: 100px" VALUE="Billing" ONCLICK="window.location.href ='billing.php'"; return false">
<INPUT TYPE="BUTTON" style="height: 25px; width: 100px" VALUE="Documents" ONCLICK="window.location.href ='documents.php'"; return false">
</div>
</body>
</html>
