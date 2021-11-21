<?php
//philum_plugin_see_tags 

function fthemb($req){
while(list($suj)=mysqli_fetch_row($req)){
$unkill=explode(',',$suj);
foreach($unkill as $vbl){$su=trim($vbl);
if($su)$ret[$su]+=1;}}
if($ret)ksort($ret);
return $ret;}

function tg_list($r,$go){$ret=''; if($r)ksort($r);
if($r)foreach($r as $k=>$v)$ret.=lkc('',htac($go).$k,$k.' ('.$v.')');
return divc('list',$ret);}

function plug_tags($p,$o){req('mod,spe');
if(substr($p,-1)=='/')$p=substr($p,0,-1);
if(get('sources')){$r=sql('mail','qda','k',''); $go='source';//source
	foreach($r as $k=>$v){if($k!='mail' && trim($k))$reb[preplink($k)]+=1;}}
else{$cat=$p?$p:'tag'; $go='';
	//$reb=tags_list($cat);
	$ra=sql('idtag,idart','qdta','k',''); arsort($ra);
	$rb=sql('id,tag','qdt','kv','cat="'.$cat.'"'); arsort($ra);
	foreach($ra as $k=>$v)if(isset($rb[$k]))$reb[$rb[$k]]=$v;}
if($o)$ret=tags_cloud($reb,12,27,' ',$cat);
else $ret=tg_list($reb,$go);
if($o)$b=pictxt('ascending',nms(178)); else $b=pictxt('numlist',nms(156));
$bt=lkc('popbt','/plugin/tags/'.$p.($o?'':'/1'),$b);
return divc('txtcadr',count($reb).' '.($p?$p:'Tags')).$bt.br().$ret;}

?>