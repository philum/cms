<?php // Auteur: Olivier Fabre                                                     //
// Email:  sub01@wanadoo.fr                                                  //
// Web:                                                                      //
// ------------------------------------------------------------------------- //
/// File name : dump.php
/// DUMPING d'une DATABASE - STRUCTURE et DATA
/// Script PHP realisé par Olivier FABRE
/// Dumping de la database : dump.php
/// Dumping possible d'une seule table :
/// dump.php?tb=xxx ou xxx est le nom de la table
///////////////////
require("params/_connectx.php");
///////////////////
/**/
if($_SESSION["auth"]==7 && $_GET["dw"]){
@set_time_limit(600);
@mysqli_connect($host,$user,$pass)
or die("Impossible de se connecter - Pb sur le 'Hostname' ou sur le 'User' ".
"ou sur le 'Password'");
@mysqli_select_db($db)
or die("Impossible de se connecter - Pb sur le 'Nom de la Data Base'");
if($tb){ header("Content-disposition: filename=$tb.sql");}
else{ header("Content-disposition: filename=$output.sql");}
header("Content-type: application/octetstream");
header("Pragma: no-cache");
header("Expires: 0");
function get_table_def($db,$table,$crlf){
global $drop;
$schema_create="";
if(!empty($drop))
$schema_create .= "DROP TABLE IF EXISTS $table;$crlf";
$schema_create .= "CREATE TABLE $table ($crlf";
$result=mysqli_db_query($db,"SHOW FIELDS FROM $table") or mysqli_die();
while($row=mysqli_fetch_array($result)){
$schema_create .= "   $row[Field] $row[Type]";
if(isset($row["Default"]) 
&& (!empty($row["Default"]) || $row["Default"]== "0"))
$schema_create .= " DEFAULT '$row[Default]'";
if($row["Null"] != "YES")
$schema_create .= " NOT NULL";
if($row["Extra"] != "")
$schema_create .= " $row[Extra]";
$schema_create .= ",$crlf";}
$schema_create=ereg_replace(",".$crlf."$","",$schema_create);
$result=mysqli_db_query($db,"SHOW KEYS FROM $table") or mysqli_die();
while($row=mysqli_fetch_array($result)){
$kname=$row['Key_name'];
if(($kname != "PRIMARY") && ($row['Non_unique']== 0))
$kname="UNIQUE|$kname";
if(!isset($index[$kname]))
$index[$kname]=array();
$index[$kname][]=$row['Column_name'];}
while([$x,$columns]=@each($index)){
$schema_create .= ",$crlf";
if($x== "PRIMARY")
$schema_create .= " PRIMARY KEY (" . implode($columns,",") . ")";
elseif(substr($x,0,6)== "UNIQUE")
$schema_create .= " UNIQUE ".substr($x,7)." (".implode($columns,",").")";
else
$schema_create .= " KEY $x (" . implode($columns,",") . ")";}
$schema_create .= "$crlf)";
return (stripslashes($schema_create));}
function get_table_content($db,$table,$handler){
$result=mysqli_db_query($db,"SELECT * FROM $table") or mysqli_die();
$i=0;
while($row=mysqli_fetch_row($result)){
$table_list="(";
for($j=0; $j<mysqli_num_fields($result);$j++)
$table_list .= mysqli_field_name($result,$j).",";
$table_list=substr($table_list,0,-2);
$table_list .= ")";
if(isset($GLOBALS["showcolumns"]))
$schema_insert="INSERT INTO $table $table_list VALUES (";
else
$schema_insert="INSERT INTO $table VALUES (";
for($j=0; $j<mysqli_num_fields($result);$j++){
if(!isset($row[$j]))
$schema_insert .= " NULL,";
elseif($row[$j] != "")
$schema_insert .= " '".addslashes($row[$j])."',";
else
$schema_insert .= " '',";}
$schema_insert=ereg_replace(",$","",$schema_insert);
$schema_insert .= ")";
$handler(trim($schema_insert));
$i++;}
return (true);}
function my_handler($sql_insert){
global $crlf,$asfile;
echo "$sql_insert;$crlf";}
$crlf="\n";
$strTableStructure="Table structure for table";
$strDumpingData="Dumping data for table";
$tables=mysqli_list_tables($db);
$num_tables=@mysqli_numrows($tables);
$i=0;
while($i < $num_tables){ 
$table=mysqli_tablename($tables,$i);
if($tb){
if($table== $tb){
print $crlf;
print "# --------------------------------------------------------$crlf";
print "#$crlf";
print "# $strTableStructure '$table'$crlf";
print "#$crlf";
print $crlf;
echo get_table_def($db,$table,$crlf).";$crlf$crlf";
print "#$crlf";
print "# $strDumpingData '$table'$crlf";
print "#$crlf";
print $crlf;
get_table_content($db,$table,"my_handler");
exit ;}}
else{
print $crlf;
print "# --------------------------------------------------------$crlf";
print "#$crlf";
print "# $strTableStructure '$table'$crlf";
print "#$crlf";
print $crlf;
echo get_table_def($db,$table,$crlf).";$crlf$crlf";
print "#$crlf";
print "# $strDumpingData '$table'$crlf";
print "#$crlf";
print $crlf;
get_table_content($db,$table,"my_handler");}
$i++;}
mysqli_close();}

?>