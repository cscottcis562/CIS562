<?php require_once('Connections/AYSO.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_AYSO, $AYSO);
$query_DivisionLRS = "SELECT Distinct Teams2.DivID FROM Teams2";
$DivisionLRS = mysql_query($query_DivisionLRS, $AYSO) or die(mysql_error());
$row_DivisionLRS = mysql_fetch_assoc($DivisionLRS);
$totalRows_DivisionLRS = mysql_num_rows($DivisionLRS);
?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<form name="DivisionSelect" method="post" action="DivList.php">
<select name="Division">
  <?php
do {  
?>
  <option value="<?php echo $row_DivisionLRS['DivID']?>"<?php if (!(strcmp($row_DivisionLRS['DivID'], $row_DivisionLRS['DivID']))) {echo "selected=\"selected\"";} ?>><?php echo $row_DivisionLRS['DivID']?></option>
  <?php
} while ($row_DivisionLRS = mysql_fetch_assoc($DivisionLRS));
  $rows = mysql_num_rows($DivisionLRS);
  if($rows > 0) {
      mysql_data_seek($DivisionLRS, 0);
	  $row_DivisionLRS = mysql_fetch_assoc($DivisionLRS);
  }
?>
</select>
  <input type="submit" name="Submit" value="Submit">
</form>
</body>

</html>
<?php
mysql_free_result($DivisionLRS);
?>