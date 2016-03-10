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

$GGDate_rsScoreEntryFinal = "1-1-16";
if (isset($_POST['Date'])) {
  $GGDate_rsScoreEntryFinal = (get_magic_quotes_gpc()) ? $_POST['Date'] : addslashes($_POST['Date']);
}
$Field_rsScoreEntryFinal = "Clark";
if (isset($_POST['Field'])) {
  $Field_rsScoreEntryFinal = (get_magic_quotes_gpc()) ? $_POST['Field'] : addslashes($_POST['Field']);
}
$Ftime_rsScoreEntryFinal = "1:00 PM";
if (isset($_POST['Time'])) {
  $Ftime_rsScoreEntryFinal = (get_magic_quotes_gpc()) ? $_POST['Time'] : addslashes($_POST['Time']);
}
mysql_select_db($database_AYSO, $AYSO);
$query_rsScoreEntryFinal = sprintf("SELECT CFGames.GameNumber, CFGames.`%s`, CFGames.%s, CFGames.%s, CFGames.HomeTeamName, CFGames.HomeScore, CFGames.VisitorTeamName, CFGames.VisitorScore FROM CFGames", GetSQLValueString($Field_rsScoreEntryFinal, "text"),GetSQLValueString($GGDate_rsScoreEntryFinal, "text"),GetSQLValueString($Ftime_rsScoreEntryFinal, "text"));
$rsScoreEntryFinal = mysql_query($query_rsScoreEntryFinal, $AYSO) or die(mysql_error());
$row_rsScoreEntryFinal = mysql_fetch_assoc($rsScoreEntryFinal);
$totalRows_rsScoreEntryFinal = mysql_num_rows($rsScoreEntryFinal);
?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>

</body>

</html>
<?php
mysql_free_result($rsScoreEntryFinal);
?>