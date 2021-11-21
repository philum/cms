<?php
//philum_second_lib

/*function lien_b($css,$link,$txt){
return '<a href="'.$link.'"'.($css?' class="'.$css.'"':'').'>'.$txt.'</a>';}*/

#files
function scrut_txt_b($f){$fp=fopen($f,'r'); if(!$fp)return; $ret='';
while(!feof($fp)){$ret.=fread($fp, 8192);}//fgets//fgetc=chars//fread
fclose($fp); return $ret;}

function recup_fileinfob($doc){
if(is_file($doc))return date('d-m-Y',filemtime($doc)).'-'.round(filesize($doc)/1024).'Ko';}

function scrut_dirb($dr){$ret=[];//dev
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){$drb=$dr.'/'.$f;
	if(is_dir($drb) && $f!='..' && $f!='.' && $f)$ret[$f]=scrut_dirb($drb);
	elseif(is_file($drb))$ret[$drb]=recup_fileinfob($drb);}}
return $ret;}

/*function scrut_files_only($dr){$ret=[];
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){if(is_file($dr.'/'.$f))$ret[$f]=1;}}
return $ret;}*/

function explode_dirc($rep,$j,$func){
static $i; $i++; $io=0; $ret='';
if(is_array($rep)){
foreach($rep as $k=>$v){$io++;
	if(!is_array($v)){$ret.=call_user_func_array($func,array($j,$k,$v,$i.'_'.$io));}
	else{$ret.=explode_dirc($v,$j.'/'.$k,$func);$i--;}}
return $ret;}}

/*function explode_dird($rep,$j){//distrib
static $i; $i++; $io=0; $ret=[];
if(is_array($rep))foreach($rep as $k=>$v){$io++;
	if(!is_array($v) && !is_numeric($k))$ret[$k]=$i.'_'.$io;
	else{$ret+=explode_dird($v,$k);$i--;}}
return $ret;}*/

?>