<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?> 
<?php
error_reporting(E_ALL);
 ini_set("display_errors",1);

$id=$_GET['id'];
require "config.php";

$query1=mysql_query("SELECT id, full_name, user_name, user_email, joined, country, user_activated FROM users WHERE id =$id");
$row=mysql_fetch_array($query1);
$formVars = array();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>User Update</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<link href= "css/adminsettingsstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#commentForm").validate();
  });
</script>
<script type="text/javascript">
<!--
function un_check(){
for (var i = 0; i < document.frmactive.elements.length; i++) {
var e = document.frmactive.elements[i];
if ((e.name != 'allbox') && (e.type == 'checkbox')) {
e.checked = document.frmactive.allbox.checked;
}}}
//-->
</script>
</head>
<body>
<div id="stylized" class="myform">
<h3>User Details</h3>
<form method="post" action="updateuser2.php" id="commentForm">
<table>
<tr>
<td><font color="blue">Full Name:</font></td>
<td><input type="text" name="full_name" value="<?php echo $row['full_name']; ?>" size="50" class="required" /></td>
</tr>
<tr>
<td><font color="blue">Username:</font></td>
<td><input type="text" name="user_name" value="<?php echo $row['user_name']; ?>" size="50" class="required" /></td>
</tr>
<tr>
<td><font color="blue">User Email:</font></td>
<td><input type="text" name="user_email" value="<?php echo $row['user_email']; ?>" size="50" class="required" /></td>
</tr>
<tr>
<td><font color="blue">Country:</font></td>
<td><select name="country">
<option value="<?php echo $row['country']; ?>"><?php echo $row['country']; ?></option>
            <option value="Afghanistan">Afghanistan</option>
            <option value="Albania">Albania</option>
            <option value="Algeria">Algeria</option>
            <option value="Andorra">Andorra</option>
            <option value="Angola">Angola</option>
            <option value="Anguila">Anguila</option>
            <option value="Antarctica">Antarctica</option>
            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
            <option value="Argentina">Argentina</option>
            <option value="Armenia ">Armenia </option>
            <option value="Aruba">Aruba</option>
            <option value="Australia">Australia</option>
            <option value="Austria">Austria</option>
            <option value="Azerbaidjan">Azerbaidjan</option>
            <option value="Bahamas">Bahamas</option>
            <option value="Bahrain">Bahrain</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Barbados">Barbados</option>
            <option value="Belarus">Belarus</option>
            <option value="Belgium">Belgium</option>
            <option value="Belize">Belize</option>
            <option value="Bermuda">Bermuda</option>
            <option value="Bhutan">Bhutan</option>
            <option value="Bolivia">Bolivia</option>
            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
            <option value="Brazil">Brazil</option>
            <option value="Brunei">Brunei</option>
            <option value="Bulgaria">Bulgaria</option>
            <option value="Cambodia">Cambodia</option>
            <option value="Cameroon">Cameroon</option>
            <option value="Canada">Canada</option>
            <option value="Cape Verde">Cape Verde</option>
            <option value="Cayman Islands">Cayman Islands</option>
            <option value="Chile">Chile</option>
            <option value="China">China</option>
            <option value="Christmans Islands">Christmans Islands</option>
            <option value="Cocos Island">Cocos Island</option>
            <option value="Colombia">Colombia</option>
            <option value="Cook Islands">Cook Islands</option>
            <option value="Costa Rica">Costa Rica</option>
            <option value="Cote d Ivore">Cote d Ivore</option>
            <option value="Croatia">Croatia</option>
            <option value="Cuba">Cuba</option>
            <option value="Cyprus">Cyprus</option>
            <option value="Czech Republic">Czech Republic</option>
            <option value="Denmark">Denmark</option>
            <option value="Dominica">Dominica</option>
            <option value="Dominican Republic">Dominican Republic</option>
            <option value="Ecuador">Ecuador</option>
            <option value="Egypt">Egypt</option>
            <option value="El Salvador">El Salvador</option>
            <option value="Estonia">Estonia</option>
            <option value="Falkland Islands">Falkland Islands</option>
            <option value="Faroe Islands">Faroe Islands</option>
            <option value="Fiji">Fiji</option>
            <option value="Finland">Finland</option>
            <option value="France">France</option>
            <option value="French Guyana">French Guyana</option>
            <option value="French Polynesia">French Polynesia</option>
            <option value="Gabon">Gabon</option>
            <option value="Germany">Germany</option>
            <option value="Gibraltar">Gibraltar</option>
            <option value="Georgia">Georgia</option>
            <option value="Ghana">Ghana</option>
            <option value="Greece">Greece</option>
            <option value="Greenland">Greenland</option>
            <option value="Grenada">Grenada</option>
            <option value="Guadeloupe">Guadeloupe</option>
            <option value="Guatemala">Guatemala</option>
            <option value="Guinea-Bissau">Guinea-Bissau</option>
            <option value="Guinea">Guinea</option>
            <option value="Haiti">Haiti</option>
            <option value="Honduras">Honduras</option>
            <option value="Hong Kong">Hong Kong</option>
            <option value="Hungary">Hungary</option>
            <option value="Iceland">Iceland</option>
            <option value="India">India</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Iran">Iran</option>
            <option value="Iraq">Iraq</option>
            <option value="Ireland">Ireland</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Jamaica">Jamaica</option>
            <option value="Japan">Japan</option>
            <option value="Jordan">Jordan</option>
            <option value="Kazakhstan">Kazakhstan</option>
            <option value="Kenya">Kenya</option>
            <option value="Kiribati ">Kiribati </option>
            <option value="Kosovo">Kosovo</option>
            <option value="Kuwait">Kuwait</option>
            <option value="Kyrgyzstan">Kyrgyzstan</option>
            <option value="Lao People's Democratic Republic">Lao People's Democratic 
            Republic</option>
            <option value="Latvia">Latvia</option>
            <option value="Lebanon">Lebanon</option>
            <option value="Libya">Libya</option>
            <option value="Liechtenstein">Liechtenstein</option>
            <option value="Lithuania">Lithuania</option>
            <option value="Luxembourg">Luxembourg</option>
            <option value="Macedonia">Macedonia</option>
            <option value="Madagascar">Madagascar</option>
            <option value="Malawi">Malawi</option>
            <option value="Malaysia ">Malaysia </option>
            <option value="Maldives">Maldives</option>
            <option value="Mali">Mali</option>
            <option value="Malta">Malta</option>
            <option value="Marocco">Marocco</option>
            <option value="Marshall Islands">Marshall Islands</option>
            <option value="Mauritania">Mauritania</option>
            <option value="Mauritius">Mauritius</option>
            <option value="Mexico">Mexico</option>
            <option value="Micronesia">Micronesia</option>
            <option value="Moldavia">Moldavia</option>
            <option value="Monaco">Monaco</option>
            <option value="Montenegro">Montenegro</option>
            <option value="Mongolia">Mongolia</option>
            <option value="Myanmar">Myanmar</option>
            <option value="Nauru">Nauru</option>
            <option value="Nepal">Nepal</option>
            <option value="Netherlands Antilles">Netherlands Antilles</option>
            <option value="Netherlands">Netherlands</option>
            <option value="New Zealand">New Zealand</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Niue">Niue</option>
            <option value="North Korea">North Korea</option>
            <option value="Norway">Norway</option>
            <option value="Oman">Oman</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Palestine">Palestine</option>
            <option value="Palau">Palau</option>
            <option value="Panama">Panama</option>
            <option value="Papua New Guinea">Papua New Guinea</option>
            <option value="Paraguay">Paraguay</option>
            <option value="Peru ">Peru </option>
            <option value="Philippines">Philippines</option>
            <option value="Poland">Poland</option>
            <option value="Portugal ">Portugal </option>
            <option value="Puerto Rico">Puerto Rico</option>
            <option value="Qatar">Qatar</option>
            <option value="Republic of Korea Reunion">Republic of Korea Reunion</option>
            <option value="Romania">Romania</option>
            <option value="Russia">Russia</option>
            <option value="Saint Helena">Saint Helena</option>
            <option value="Saint kitts and nevis">Saint kitts and nevis</option>
            <option value="Saint Lucia">Saint Lucia</option>
            <option value="Samoa">Samoa</option>
            <option value="San Marino">San Marino</option>
            <option value="Saudi Arabia">Saudi Arabia</option>
            <option value="Senegal">Senegal</option>
            <option value="Servia">Servia</option>
            <option value="Seychelles">Seychelles</option>
            <option value="Singapore">Singapore</option>
            <option value="Slovakia">Slovakia</option>
            <option value="Slovenia">Slovenia</option>
            <option value="Solomon Islands">Solomon Islands</option>
            <option value="South Africa">South Africa</option>
            <option value="Spain">Spain</option>
            <option value="Sri Lanka">Sri Lanka</option>
            <option value="St.Pierre and Miquelon">St.Pierre and Miquelon</option>
            <option value="St.Vincent and the Grenadines">St.Vincent and the Grenadines</option>
            <option value="Sudan">Sudan</option>
            <option value="Suriname">Suriname</option>
            <option value="Sweden">Sweden</option>
            <option value="Switzerland">Switzerland</option>
            <option value="Syria">Syria</option>
            <option value="Taiwan ">Taiwan </option>
            <option value="Tajikistan">Tajikistan</option>
            <option value="Tanzania">Tanzania</option>
            <option value="Thailand">Thailand</option>
            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
            <option value="Tunisia">Tunisia</option>
            <option value="Turkey">Turkey</option>
            <option value="Turkmenistan">Turkmenistan</option>
            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
            <option value="Uganda">Uganda</option>
            <option value="Ukraine">Ukraine</option>
            <option value="UAE">UAE</option>
            <option value="UK">UK</option>
            <option value="USA">USA</option>
            <option value="Uruguay">Uruguay</option>
            <option value="Uzbekistan">Uzbekistan</option>
            <option value="Vanuatu">Vanuatu</option>
            <option value="Vatican City">Vatican City</option>
            <option value="Vietnam">Vietnam</option>
            <option value="Virgin Islands (GB)">Virgin Islands (GB)</option>
            <option value="Virgin Islands (U.S.) ">Virgin Islands (U.S.) </option>
            <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
            <option value="Yemen">Yemen</option>
          </select>
</td>
</tr>
<tr>
<?php
if ($row['user_activated'] == "0")
{
echo "<td>Active
<input type='checkbox' name='lite' value='1' />
</td>";
}
if ($row['user_activated'] == "1")
{
echo "<td>Active
<input type='checkbox' name='lite' value='1' checked='checked' />
</td>";
}
?>
</tr>
<tr>
<td><input type="hidden" name="id" value="<?php echo $row['id']; ?>" /></td>
</tr>
<?php
$query2=mysql_query("SELECT id, moduleid, modview, modviewcode, permit FROM useraccess WHERE userid=$id");
$num_rows = mysql_num_rows($query2);
if($num_rows == "0")
{
$uid=$id;
echo"</form>";
echo"<form method='post' action='createuserpermissions.php' id='CreateForm'>";
echo"<input type='hidden' name='uid' value='$uid' />";
echo"<input type='submit' value='Create Permissions' class='button' />";
echo"<input type='button' value='Back' onclick='document.location = 'adminsettings.php';' class='button' />";
echo"</form>";
exit;
}

?>
</table>
<input type="submit" value="Submit" class="button" />
<input type="button" value="Back" onclick="document.location = 'adminsettings.php';" class="button" />
</form>
<?php

if(isset($_POST['checkbox'])){$checkbox = $_POST['checkbox'];
if(isset($_POST['activate'])?$activate = $_POST["activate"]:$deactivate = $_POST["deactivate"])
$qid = "('" . implode( "','", $checkbox ) . "');" ;
$qsql="UPDATE useraccess SET permit = '".(isset($activate)?'1':'0')."' WHERE id IN $qid" ;
$qresult = mysql_query($qsql) or die(mysql_error());
}
 
$qsql="SELECT id, moduleid, modview, modviewcode, permit FROM useraccess WHERE userid=$id";
$qresult=mysql_query($qsql);

$qcount=mysql_num_rows($qresult);
?>
<h3>Update User Access</h3>
<table width="400" border="0" cellspacing="1" cellpadding="0">
<tr>
<td><form name="frmactive" method="post" action="">
<table width="400" border="0" cellpadding="3" cellspacing="1">
<tr>
<td colspan="5"><input name="activate" type="submit" id="activate" value="Activate" />
<input name="deactivate" type="submit" id="deactivate" value="Deactivate" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td colspan="4"><strong>Update User Access</strong> </td>
</tr><tr>
<td align="center"><input type="checkbox" name="allbox" title="Select or Deselct ALL" style="background-color:#ccc;" /></td>
<td align="center"><strong>Viewer</strong></td>
<td align="center"><strong>Permit</strong></td>
</tr>
<?php
while($rows=mysql_fetch_array($qresult)){
?>
<tr>
<td align="center"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $rows['id']; ?>" /></td>
<td><?php echo $rows['modview']; ?></td>
<?php
if($rows['permit'] == "1")
{
echo"<td>Yes</td>";
}
else if($rows['permit'] == "0")
{
echo"<td>No</td>";
}
?>
</tr>
<?php
}
?>
<tr>
<td colspan="5" align="center">&nbsp;</td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</div>
</body>
</html>