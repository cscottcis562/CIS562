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

$colname_StandingsRS = "-1";
if (isset($_GET['DivID'])) {
  $colname_StandingsRS = (get_magic_quotes_gpc()) ? $_GET['DivID'] : addslashes($_GET['DivID']);
}
mysql_select_db($database_AYSO, $AYSO);
$query_StandingsRS = sprintf("SELECT * FROM Standings3 WHERE DivID = %s ORDER BY FPts DESC, VisitorScore ASC", GetSQLValueString($colname_StandingsRS, "int"));
$StandingsRS = mysql_query($query_StandingsRS, $AYSO) or die(mysql_error());
$row_StandingsRS = mysql_fetch_assoc($StandingsRS);
$totalRows_StandingsRS = mysql_num_rows($StandingsRS);
?><!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Division Standings</title>
<link href="scores.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0">

<div class="setup">
	<div class="Dheader">
	  <div class="DHText">
			REGION 88<br/>
		  TEAM ZONE 2016	</div>
	</div>
 <table align="center" >
	     <tr>  
	 	   <td class="outer">	
<p class="Theader2"> Standings <?php echo $row_StandingsRS['DivisionName']; ?></p>
  <p class="TbText2">Click team name for schedule &amp; information.</p>
  <p class="TbText2">&nbsp;</p>
  

  <table border="0" cellpadding="3" cellspacing="0">
    <tr>
      <td class="Dth">Teams</td>
      <td class="Dth">P</td>
      <td class="Dth">W</td>
      <td class="Dth">L</td>
      <td class="Dth">D</td>
      <td class="Dth">GF</td>
      <td class="Dth">GA</td>
      <td class="Dth">AA</td>
	  <td class="Dth">Pts</td>
    </tr>
    <?php do { ?>
      <tr>
        <td class="TbText"><a class="TbTextB" href=TeamDetail.php?TeamID=<?php echo $row_StandingsRS['HomeTeamID']; ?>><?php echo $row_StandingsRS['HomeTeamName']; ?></a>&nbsp;(<?php echo $row_StandingsRS['HomeCoach']; ?>)</td>
        <td class="TbTextCenter"><?php echo $row_StandingsRS['GP']; ?></td>
        <td class="TbTextCenter"><?php echo $row_StandingsRS['W']; ?></td>
        <td class="TbTextCenter"><?php echo $row_StandingsRS['L']; ?></td>
        <td class="TbText"><?php echo $row_StandingsRS['D']; ?></td>
        <td class="TbTextCenter"><?php echo $row_StandingsRS['Goals_For']; ?></td>
        <td class="TbTextCenter"><?php echo $row_StandingsRS['VisitorScore']; ?></td>
        <td class="TbTextCenter"><?php echo $row_StandingsRS['Tadj']; ?></td>
        <td class="TbTextCenter"><?php echo $row_StandingsRS['FPts']; ?></td>
      </tr>
      <?php } while ($row_StandingsRS = mysql_fetch_assoc($StandingsRS)); ?>
  </table></td>
</tr> 
</table>
</div>
</body>

</html>
<?php
mysql_free_result($StandingsRS);
?>