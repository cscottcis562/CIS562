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

$colname_DivListsRS = "-1";
if (isset($_GET['Division'])) {
  $colname_DivListsRS = (get_magic_quotes_gpc()) ? $_GET['Division'] : addslashes($_GET['Division']);
}
mysql_select_db($database_AYSO, $AYSO);
$query_DivListsRS = sprintf("SELECT * FROM Teams2 WHERE DivID = %s ORDER BY CoachName ASC", GetSQLValueString($colname_DivListsRS, "int"));
$DivListsRS = mysql_query($query_DivListsRS, $AYSO) or die(mysql_error());
$row_DivListsRS = mysql_fetch_assoc($DivListsRS);
$totalRows_DivListsRS = mysql_num_rows($DivListsRS);

$colname_DcRS = "-1";
if (isset($_GET['Division'])) {
  $colname_DcRS = (get_magic_quotes_gpc()) ? $_GET['Division'] : addslashes($_GET['Division']);
}
mysql_select_db($database_AYSO, $AYSO);
$query_DcRS = sprintf("SELECT DivisionName, DCName FROM Divisions WHERE DivID = %s", GetSQLValueString($colname_DcRS, "int"));
$DcRS = mysql_query($query_DcRS, $AYSO) or die(mysql_error());
$row_DcRS = mysql_fetch_assoc($DcRS);
$totalRows_DcRS = mysql_num_rows($DcRS);
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Untitled Document</title>
<link href="scores.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0">
<div class="setup">
	<div class="Dheader"><link href="scores.css">

	  <div class="DHText">
			REGION 88<br/>
		  TEAM ZONE 2016	</div>
	</div>
 <table align="center" >
	     <tr>  
		 	<td class="outer">	
<p class="Theader2"><?php echo $row_DcRS['DivisionName']; ?><br>
  Division Coordinator:&nbsp;<?php echo $row_DcRS['DCName']; ?></p>
  <p class="TbText2">Click team name for schedule &amp; information.<br>
    Click coach name to send email.</p>
<table class="TbText" align="center" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td class="Dth">TEAM # </td>
    <td class="Dth">TEAM NAME</td>
    <td class="Dth">COACH</td>
    <td class="Dth"></td>
    </tr>
  <?php do { ?>
    <tr>
      <td class="TbText"><?php echo $row_DivListsRS['TeamID']; ?></td>
      <td class="TbTextB"><a href="Tdetail.php?Teamid=<?php echo $row_DivListsRS['TeamID']; ?>"><?php echo $row_DivListsRS['TeamName']; ?></a></td>
      <td class="TbText"><a href="mailto:<?php echo $row_DivListsRS['CoachEmail']; ?>"><?php echo $row_DivListsRS['CoachName']; ?></a></td>
      <td class="TbText"></td>
      </tr>
    <?php } while ($row_DivListsRS = mysql_fetch_assoc($DivListsRS)); ?>
</table>
</td>
</tr> 
</table>
</body>

</html>
<?php
mysql_free_result($DivListsRS);

mysql_free_result($DcRS);
?>