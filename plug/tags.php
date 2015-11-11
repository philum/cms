<?php
//philum_plugin_see_atgs 
session_start();

function fthemb($req){
while(list($suj)=mysql_fetch_row($req)){
$unkill=explode(",",$suj);
foreach($unkill as $vbl){$su=trim($vbl);
if($su!="" && $su!="*" && $su!="**"){$ret[$su]+=1;}}}
ksort($ret);
return $ret;}

function plug_tags($p,$o){connect(); req('mod');
if($_GET["sources"]){$r=sql('mail','qda','k',''); $go='source';//source
	foreach($r as $k=>$v){if($k!='mail' && trim($k))$reb[preplink($k)]+=1;}}
elseif($p){$req=res("msg",$_SESSION['qdd'].' WHERE qb="'.$_SESSION['qb'].'" AND cat="tables" AND val="'.$tb.'"');$go='usertag';}
else{$req=res("thm",$_SESSION['qda'].''); $go='tag';}
if($req)$reb=fthemb($req);
//foreach($reb as $k=>$v){$re[$k]=log($v);}
$ret=tags_cloud($reb,12,27," ",$go);
return divc("txtit",count($reb).' '.($tb?$tb:'Tags')).br().divc("tab panel",$ret);}

?>