<?php
//philum_plugin_see_atgs 

function fthemb($req){
while(list($suj)=mysql_fetch_row($req)){
$unkill=explode(",",$suj);
foreach($unkill as $vbl){$su=trim($vbl);
if($su)$ret[$su]+=1;}}
if($ret)ksort($ret);
return $ret;}

function tg_list($r,$go){
if($r)foreach($r as $k=>$v)$ret.=lkc('popbt',htac($go).$k,$k.' ('.$v.')');
return $ret;}

function plug_tags($p,$o){req('mod,spe');
if($_GET['sources']){$r=sql('mail','qda','k',''); $go='source';//source
	foreach($r as $k=>$v){if($k!='mail' && trim($k))$reb[preplink($k)]+=1;}}
else{$cat=$p?$p:'tag';
//$reb=tags_list($cat);
$ra=sql('idtag,idart','qdta','k',''); arsort($ra);
$rb=sql('id,tag','qdt','kv','cat="'.$cat.'"'); arsort($ra);
foreach($ra as $k=>$v)if($rb[$k])$reb[str_replace(' ','&nbsp;',$rb[$k])]=$v;}
if($o)$ret=tags_cloud($reb,12,27,' ','tag');
else $ret=tg_list($reb,$go);
return divc('txtcadr',count($reb).' '.($p?$p:'Tags')).$ret;}

?>