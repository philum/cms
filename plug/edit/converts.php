<?php
//philum_plugin_converts

function setlocalvar($local,$defaut){
if($_GET[$local]!=""){$ret=$_GET[$local]; $_SESSION[$local]=$ret;}
elseif(!isset($_SESSION[$local])){$ret=$defaut; $_SESSION[$local]=$ret;}
else{$ret=$_SESSION[$local];}
return $ret;}

function bin2ascii($v,$flip){$ra=array("0000000"=>"NUL","0000001"=>"SOH","0000010"=>"STX","0000011"=>"ETX","0000100"=>"EOT","0000101"=>"ENQ","0000110"=>"ACK","0000111"=>"BEL","0001000"=>"BS","0001001"=>"HT","0001010"=>"LF","0001011"=>"VT","0001100"=>"FF","0001101"=>"CR","0001110"=>"SO","0001111"=>"SI","0010000"=>"DLE","0010001"=>"DC1","0010010"=>"DC2","0010011"=>"DC3","0010100"=>"DC4","0010101"=>"NAK","0010110"=>"SYN","0010111"=>"ETB","0011000"=>"CAN","0011001"=>"EM","0011010"=>"SUB","0011011"=>"ESC","0011100"=>"FS","0011101"=>"GS","0011110"=>"RS","0011111"=>"US","0100000"=>"SP","0100001"=>"&nbsp;!","0100010"=>'"',"0100011"=>"#","0100100"=>"$","0100101"=>"&nbsp;%","0100110"=>"&amp;","0100111"=>"'","0101000"=>"(","0101001"=>")","0101010"=>"*","0101011"=>"+","0101100"=>",","0101101"=>"-","0101110"=>".","0101111"=>"/","0110000"=>"0","0110001"=>"1","0110010"=>"2","0110011"=>"3","0110100"=>"4","0110101"=>"5","0110110"=>"6","0110111"=>"7","0111000"=>"8","0111001"=>"9","0111010"=>"&nbsp;:","0111011"=>"&nbsp;;","0111100"=>"&lt;","0111101"=>"=","0111110"=>"&gt;","0111111"=>"&nbsp;?","1000000"=>"@","1000001"=>"A","1000010"=>"B","1000011"=>"C","1000100"=>"D","1000101"=>"E","1000110"=>"F","1000111"=>"G","1001000"=>"H","1001001"=>"I","1001010"=>"J","1001011"=>"K","1001100"=>"L","1001101"=>"M","1001110"=>"N","1001111"=>"O","1010000"=>"P","1010001"=>"Q","1010010"=>"R","1010011"=>"S","1010100"=>"T","1010101"=>"U","1010110"=>"V","1010111"=>"W","1011000"=>"X","1011001"=>"Y","1011010"=>"Z","1011011"=>"[","1011100"=>"\\","1011101"=>"]","1011110"=>"^","1011111"=>"_","1100000"=>"`","1100001"=>"a","1100010"=>"b","1100011"=>"c","1100100"=>"d","1100101"=>"e","1100110"=>"f","1100111"=>"g","1101000"=>"h","1101001"=>"i","1101010"=>"j","1101011"=>"k","1101100"=>"l","1101101"=>"m","1101110"=>"n","1101111"=>"o","1110000"=>"p","1110001"=>"q","1110010"=>"r","1110011"=>"s","1110100"=>"t","1110101"=>"u","1110110"=>"v","1110111"=>"w","1111000"=>"x","1111001"=>"y","1111010"=>"z","1111011"=>"{","1111100"=>"|","1111101"=>"}","1111110"=>"~","1111111"=>"DEL");
$v=str_replace("\r",' ',$v);
$r=explode(' ',$v);
if($flip)$ra=array_flip($ra);
foreach($r as $v)$ret.=$ra[$v]?$ra[$v]:'['.$v.']';
return $ret;}

function clean_code($d){
$d=str_replace("\r","\n",$d);
$d=ereg_replace("[\n]{2,}","\n",$d);
$ara=array("  ",'( ',' (',' )',') ',' .',' .',' > ',' < ',' =','= '," \n","\n ","{\n","\n{","\n}",', ',' {',' }','{ ','} ','if (','else (','// ');
$arb=array("\t",'(','(',')',')','.','.','>','<','=','=',"\n","\n",'{','{','}',',','{','}','{','}','if(','else(','//');
$d=ereg_replace("[ ]{2,}"," ",$d);
return str_replace($ara,$arb,$d);}

function conv_codage($txt,$d,$enc){
if($d=='utf8')$ret=$enc?utf8_encode(utf8_encode($txt)):utf8_decode_b($txt);
elseif($d=='base64')$ret=$enc?base64_encode($txt):base64_decode($txt);
elseif($d=='htmlentities')$ret=$enc?htmlentities($txt,ENT_QUOTES,'ISO-8859-15',false):html_entity_decode($txt);
elseif($d=='url')$ret=$enc?urlencode($txt):urldecode($txt);
elseif($d=='unescape')$ret=$enc?$ret:unescape($txt,"");
elseif($d=='ascii'){if(!$enc)$ret=$txt; else 
	foreach(explode(';',$txt) as $v)if($v)$ret.=($v.';')."\r";}
elseif($d=='binary')$ret=bin2ascii($txt,$enc?1:'');
elseif($d=='bin')$ret=$enc?decbin($txt):bindec($txt);
elseif($d=='timestamp')$ret=$enc?strtotime($txt):date('d/m/Y H:i:s',$txt);
elseif($d=='php')$ret=clean_code($txt);
return htmlentities(stripslashes($ret));}

function conv_j($p,$o,$res=''){
$ret=conv_codage(ajxg($res),$p,$o);
return $ret;}

function conv_menu($p,$o,$rid){
$r=array("utf8","htmlentities","url","unescape","base64","ascii","binary","bin/dec","timestamp");
foreach($r as $v){
	$ret.=lj('txtx',$rid.'_plug__2_converts_conv*j_'.$v.'_1_inp1',$v.'-encode').' ';
	$ret.=lj('txtblc',$rid.'_plug__2_converts_conv*j_'.$v.'__inp1',$v.'-decode').' ';}
$r=array("php");
foreach($r as $v)
	$ret.=lj('txtx',$rid.'_plug__2_converts_conv*j_'.$v.'_1_inp1',$v).' ';
$ret.=br().txarea('inp1',$p,64,8,atc('console')).' ';
return $ret;}

function plug_converts($p){$rid='plg'.randid();
$bt=conv_menu($p,$o,$rid);
$ret=conv_j($p,$o);
return $bt.div(atd($rid).atc(''),$ret);}
?>