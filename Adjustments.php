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

$colname_GamesAdj = "-1";
if (isset($_GET['HomeTeamID'])) {
  $colname_GamesAdj = (get_magic_quotes_gpc()) ? $_GET['HomeTeamID'] : addslashes($_GET['HomeTeamID']);
}
mysql_select_db($database_AYSO, $AYSO);
$query_GamesAdj = sprintf("SELECT * FROM Games WHERE HomeTeamName or VisitorTeamName = %s", GetSQLValueString($colname_GamesAdj, "int"));
$GamesAdj = mysql_query($query_GamesAdj, $AYSO) or die(mysql_error());
$row_GamesAdj = mysql_fetch_assoc($GamesAdj);
$totalRows_GamesAdj = mysql_num_rows($GamesAdj);
?><!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/html5.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="EditRegion3" -->Adjustments

  <p>&nbsp;</p>
  <p>
    <script language="JavaScript">
TCN_contents=new Array();
TCN_tempArray=new Array();
TCN_counter=0;
function TCN_addContent(str){
	TCN_contents[TCN_counter]=str;
	TCN_counter++;
}
function TCN_split(){
	TCN_arrayValues = new Array();
	for(i=0;i<TCN_contents.length;i++){
		TCN_arrayValues[i]=TCN_contents[i].split(separator);
		TCN_tempArray[0]=TCN_arrayValues;
	}
}
function TCN_makeSelValueGroup(){
	TCN_selValueGroup=new Array();
	var args=TCN_makeSelValueGroup.arguments;
	for(i=0;i<args.length;i++){
		TCN_selValueGroup[i]=args[i];
		TCN_tempArray[i]=new Array();
	}
}
function TCN_makeComboGroup(){
	TCN_comboGroup=new Array();
	var args=TCN_makeComboGroup.arguments;
	for(i=0;i<args.length;i++) TCN_comboGroup[i]=findObj(args[i]);
}
function TCN_setDefault(){
	for (i=TCN_selValueGroup.length-1;i>=0;i--){
		if(TCN_selValueGroup[i]!=""){
			for(j=0;j<TCN_contents.length;j++){
				if(TCN_arrayValues[j][(i*2)+1]==TCN_selValueGroup[i]){
					for(k=i;k>=0;k--){
						if(TCN_selValueGroup[k]=="") TCN_selValueGroup[k]=TCN_arrayValues[j][(k*2)+1];
					}
				}
			}
		}
	}
}
function TCN_loadMenu(daIndex){
	var selectionMade=false;
	daArray=TCN_tempArray[daIndex];
	TCN_comboGroup[daIndex].options.length=0;
	for(i=0;i<daArray.length;i++){
		existe=false;
		for(j=0;j<TCN_comboGroup[daIndex].options.length;j++){
			if(daArray[i][(daIndex*2)+1]==TCN_comboGroup[daIndex].options[j].value) existe=true;
		}
		if(existe==false){
			lastValue=TCN_comboGroup[daIndex].options.length;
			TCN_comboGroup[daIndex].options[TCN_comboGroup[daIndex].options.length]=new Option(daArray[i][daIndex*2],daArray[i][(daIndex*2)+1]);
			if(TCN_selValueGroup[daIndex]==TCN_comboGroup[daIndex].options[lastValue].value){
				TCN_comboGroup[daIndex].options[lastValue].selected=true;
				selectionMade=true;
			}
		}
	}
	if(selectionMade==false) TCN_comboGroup[daIndex].options[0].selected=true;
}	
function TCN_reload(from){
	if(!from){
		TCN_split();
		TCN_setDefault();
		TCN_loadMenu(0);
		TCN_reload(TCN_comboGroup[0]);
	}else{
		for(j=0; j<TCN_comboGroup.length; j++){
			if(TCN_comboGroup[j]==from) index=j+1;
		}
		if(index<TCN_comboGroup.length){
			TCN_tempArray[index].length=0;
			for(i=0;i<TCN_comboGroup[index-1].options.length;i++){
				if(TCN_comboGroup[index-1].options[i].selected==true){
					for(j=0;j<TCN_tempArray[index-1].length;j++){
						if(TCN_comboGroup[index-1].options[i].value==TCN_tempArray[index-1][j][(index*2)-1]) TCN_tempArray[index][TCN_tempArray[index].length]=TCN_tempArray[index-1][j];
					}
				}
			}
		TCN_loadMenu(index);
		TCN_reload(TCN_comboGroup[index]);
		}
	}
}
function findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
TCN_makeSelValueGroup("Select Division","Select Team");
TCN_makeComboGroup("Division","Team");
 var separator="+#+";
<?php do{?>
TCN_addContent("<?php echo $row_GamesAdj['DivisionName']; ?>+#+<?php echo $row_GamesAdj['DivID']; ?>+#+<?php echo $row_GamesAdj['HomeTeamName']; ?>+#+<?php echo $row_GamesAdj['HomeTeamID']; ?>");
<?php } while ($row_GamesAdj = mysql_fetch_assoc($GamesAdj)); ?>
TCN_reload();

    </script>
    </p><form name="form1" method="post" action="">
  <table width="270" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>Division</td>
      <td><select name="Division" id="Division" onChange="TCN_reload(this)">
        <option selected value="" <?php if (!(strcmp("", $row_GamesAdj['DivID']))) {echo "selected=\"selected\"";} ?>>Select Division</option>
        <?php
do {  
?>
        <option value="<?php echo $row_GamesAdj['DivID']?>"<?php if (!(strcmp($row_GamesAdj['DivID'], $row_GamesAdj['DivID']))) {echo "selected=\"selected\"";} ?>><?php echo $row_GamesAdj['DivisionName']?></option>
        <?php
} while ($row_GamesAdj = mysql_fetch_assoc($GamesAdj));
  $rows = mysql_num_rows($GamesAdj);
  if($rows > 0) {
      mysql_data_seek($GamesAdj, 0);
	  $row_GamesAdj = mysql_fetch_assoc($GamesAdj);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>Team</td>
      <td><select name="Team" id="Team" onChange="TCN_reload(this)">
        <option selected value="" <?php if (!(strcmp("", $row_GamesAdj['HomeTeamName']))) {echo "selected=\"selected\"";} ?>>Select Team</option>
        <?php
do {  
?>
        <option value="<?php echo $row_GamesAdj['HomeTeamName']?>"<?php if (!(strcmp($row_GamesAdj['HomeTeamName'], $row_GamesAdj['HomeTeamName']))) {echo "selected=\"selected\"";} ?>><?php echo $row_GamesAdj['HomeTeamName']?></option>
        <?php
} while ($row_GamesAdj = mysql_fetch_assoc($GamesAdj));
  $rows = mysql_num_rows($GamesAdj);
  if($rows > 0) {
      mysql_data_seek($GamesAdj, 0);
	  $row_GamesAdj = mysql_fetch_assoc($GamesAdj);
  }
?>
      </select></td>
    </tr>
  </table>
</form>
<!-- InstanceEndEditable -->
</body>

<!-- InstanceEnd --></html>
<?php
mysql_free_result($GamesAdj);
?>