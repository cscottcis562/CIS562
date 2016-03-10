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

$TeamID_rsAdjustmentSchedule = "0";
if (isset($_POST['TeamID'])) {
  $TeamID_rsAdjustmentSchedule = (get_magic_quotes_gpc()) ? $_POST['TeamID'] : addslashes($_POST['TeamID']);
}
$TeamID_rsAdjustmentSchedule = "0";
if (isset($_POST['TeamID'])) {
  $TeamID_rsAdjustmentSchedule = (get_magic_quotes_gpc()) ? $_POST['TeamID'] : addslashes($_POST['TeamID']);
}
mysql_select_db($database_AYSO, $AYSO);
$query_rsAdjustmentSchedule = sprintf("SELECT CFGames.GameNumber, CFGames.GGDate, CFGames.GField, CFGames.FTime, CFGames.HomeTeamName, CFGames.HomeCoach, CFGames.HomeScore, CFGames.VisitorTeamName, CFGames.VisitorCoach, CFGames.VisitorScore, CFGames.VisitorTeamID FROM CFGames WHERE CFGames.HomeTeamID = %s OR CFGames.VisitorTeamID = %s ORDER BY CFGames.GGDate", GetSQLValueString($TeamID_rsAdjustmentSchedule, "int"),GetSQLValueString($TeamID_rsAdjustmentSchedule, "int"));
$rsAdjustmentSchedule = mysql_query($query_rsAdjustmentSchedule, $AYSO) or die(mysql_error());
$row_rsAdjustmentSchedule = mysql_fetch_assoc($rsAdjustmentSchedule);
$totalRows_rsAdjustmentSchedule = mysql_num_rows($rsAdjustmentSchedule);
?><!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>Untitled Document</title>
<link href="scores.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="setup">

	<div class="Dheader">
	  <div class="DHText">
			REGION 88<br/>
		  TEAM ZONE 2016	</div>
	</div>
	  
	  <table align="center" >
	     <tr>  
		 	<td class="outer">

<table border="0" cellpadding="3" cellspacing="0">
  <tr >
    <td class="Dth">Game</td>
    <td class="Dth">Date</td>
    <td class="Dth">Field</td>
    <td class="Dth">Time</td>
    <td class="Dth">Home Coach</td>
    <td class="Dth">Home</td>
    <td class="Dth" colspan="3">Score</td>
    <td class="Dth">Visitor</td>
    <td class="Dth">Visitor Coach</td>
  </tr>
  <?php do { ?>
    <tr>
      <td class="TbText"><?php echo $row_rsAdjustmentSchedule['GameNumber']; ?></td>
      <td class="TbText"><?php echo $row_rsAdjustmentSchedule['GGDate']; ?></td>
      <td class="TbText"><?php echo $row_rsAdjustmentSchedule['GField']; ?></td>
      <td class="TbText"><?php echo $row_rsAdjustmentSchedule['FTime']; ?></td>
      <td class="TbText"><?php echo $row_rsAdjustmentSchedule['HomeCoach']; ?></td>
      <td class="TbText"><?php echo $row_rsAdjustmentSchedule['HomeTeamName']; ?></td>
      <td class="TbText"><?php echo $row_rsAdjustmentSchedule['HomeScore']; ?></td>
      <td class="TbText">-</td>
      <td class="TbText"><?php echo $row_rsAdjustmentSchedule['VisitorScore']; ?></td>
      <td><?php echo $row_rsAdjustmentSchedule['VisitorTeamName']; ?></td>
      <td class="TbText"><?php echo $row_rsAdjustmentSchedule['VisitorCoach']; ?></td>
    </tr>
    <?php } while ($row_rsAdjustmentSchedule = mysql_fetch_assoc($rsAdjustmentSchedule)); ?>
</table>
</td>
		</tr> 
  </table>
</div>
<p>&nbsp;</p>

</body>

</html>
<?php
mysql_free_result($rsAdjustmentSchedule);
?>
