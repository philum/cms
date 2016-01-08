<?php
//philum_second_lib

function lien_b($css,$link,$txt){
return '<a href="'.$link.'"'.($css?' class="'.$css.'"':'').'>'.$txt.'</a>';}

#files
function scrut_txt_b($f){$fp=fopen($f,"r"); if(!$fp)return;
while(!feof($fp)){$buffer.=fread($fp, 8192);}//fgets//fgetc=chars//fread
fclose($fp); return $buffer;}

function read_file_b($f,$p){$fp=fopen($f,$p); if(!$fp){return;} 
while(!feof($fp)){$buffer.=fread($fp, 8192);}
fclose($fp); return $buffer;}

function recup_fileinfob($doc){
if(is_file($doc))return date('d-m-Y',filemtime($doc)).'-'.round(filesize($doc)/1024).'Ko';}

function scrut_dirb($dr){//dev
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){$drb=$dr.'/'.$f;
	if(is_dir($drb) && $f!='..' && $f!='.' && $f)$ret[$f]=scrut_dirb($drb);
	elseif(is_file($drb))$ret[$drb]=recup_fileinfob($drb);}}
return $ret;}

function scrut_files_only($dr){
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){if(is_file($dr.'/'.$f))$ret[$f]=1;}}
return $ret;}

function explode_dirc($rep,$j,$func){//cod2base,codeview,playlist
static $i; $i++;
if(is_array($rep)){
foreach($rep as $k=>$v){$io++;
	if(!is_array($v)){$ret.=call_user_func_array($func,array($j,$k,$v,$i.'_'.$io));}
	else{$ret.=explode_dirc($v,$j.'/'.$k,$func);$i--;}}
return $ret;}}

function explode_dird($rep,$j){//distrib
static $i; $i++; $ret[]="";
if(is_array($rep)){
foreach($rep as $k=>$v){$io++;
	if(!is_array($v) && !is_numeric($k)){$ret[$k]=$i.'_'.$io;}
	else{$ret+=explode_dird($v,$k);$i--;}}
return $ret;}}

#mechanics

function countchars_b($v){
foreach(count_chars($v,1) as $i=>$val){$res+=$val;}//chr($i)
return $res;}
function embed_detect_b($v,$s,$e){ 
if($v && $s)$posa=strpos($v,$s);
if($posa!==false){$posa+=countchars_b($s); if($e)$posb=strpos($v,$e,$posa);}
if($posb!==false)$ret=substr($v,$posa,$posb-$posa);
elseif(!$e)$ret=substr($v,$posa);
return $ret;}

?>