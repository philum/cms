<?php
//philum_secondary_common_librairy

function hr_b(){return "<hr>\n";}
function br_b(){return "<br />\n";}
function lien_b($css,$link,$txt){
return '<a href="'.$link.'"'.($css?' class="'.$css.'"':'').'>'.$txt.'</a>';}
function btn_b($css,$txt){if($css){
return '<span class="'.$css.'">'.$txt.'</span>';}else{ return $txt;}}
function duv_b($css,$txt){if($css){
return '<div class="'.$css.'">'.$txt.'</div>';}else{ return $txt;}}
function bal_b($bal,$css,$txt){return '<'.$bal.' class="'.$css.'">'.$txt.'</'.$bal.'>';}
function relod_b($where){
echo "<script language=\"JavaScript\">\n";
echo 'window.location="'.$where.'"';
echo "</script>";}

function inputcreate_b($stl,$lst,$lts){
return '<input type="'.$stl.'" name="'.$lst.'" value="'.$lts.'">';}
function txarea_b($n,$t,$cl,$rw){return '<textarea name="'.$n.'" cols="'.$cl.'" rows="'.$rw.'" class="txtcadr" wrap="VIRTUAL">'.$t.'</textarea>';}
function formcreate_b($go,$fll){return '<form name="form" method="post" action="'.$go.'">'.$fll.'</form>';}

#files

function write_txt_b($f,$t){$h=fopen($f,"w+");
if(fwrite($h,$t)===false){$ret='error';}else{$ret=$f.' :: <a href="'.$f.'">updated</a>';}
fclose($h); return $ret;}

function scrut_txt_b($f){$fp=fopen($f,"r"); if(!$fp)return;
while(!feof($fp)){$buffer.=fread($fp, 8192);}//fgets//fgetc=chars//fread
fclose($fp); return $buffer;}

function read_file_b($f,$p){$fp=fopen($f,$p); if(!$fp){return;} 
while(!feof($fp)){$buffer.=fread($fp, 8192);}
fclose($fp); return $buffer;}

function recup_fileinfob($doc){
if(is_file($doc))return date('d-m-Y',filemtime($doc)).'-'.round(filesize($doc)/1024).'Ko';}

function scrut_dirb($dr){//file_infos
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){$drb=$dr.'/'.$f;
	if(is_dir($drb) && $f!='..' && $f!='.' && $f)$ret[$f]=scrut_dirb($drb);
	elseif(is_file($drb))$ret[$drb]=recup_fileinfob($drb);}}
return $ret;}

function scrut_dirc($dr){//file_content
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){
	if(is_dir($dr.'/'.$f) && $f!='..' && $f!='.' && $f!=''){
		$ret[$f]=scrut_dirc($dr.'/'.$f);}
	elseif(is_file($dr.'/'.$f))$ret[$f]=scrut_txt_b($dr.'/'.$f);}}
return $ret;}

function scrut_dird($dr,$func){//user_func
if(is_dir($dr)){$dir=opendir($dr);echo $dir.'  --  ';
	while($f=readdir($dir)){
	if(is_dir($dr.'/'.$f) && $f!='..' && $f!='.' && $f!=''){
		$ret[$f]=scrut_dird($dr.'/'.$f);}
	elseif(is_file($dr.'/'.$f)){$ret[$f]=call_user_func_array($func, array($dr,$f));}}}
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

function decode_date($v){list($d,$m,$y)=split("-",$v);
return mktime(0,0,0,$m,$d,$y);}

function countchars_b($v){
foreach(count_chars($v,1) as $i=>$val){$res+=$val;}//chr($i)
return $res;}
function embed_detect_b($v,$s,$e){ 
if($v && $s)$posa=strpos($v,$s);
if($posa!==false){$posa+=countchars_b($s); if($e)$posb=strpos($v,$e,$posa);}
if($posb!==false)$ret=substr($v,$posa,$posb-$posa);
elseif(!$e)$ret=substr($v,$posa);
return $ret;}

#microsql

//plug_fuctions
function witch_quote_b($v){
	if(strpos($v,"'")===false){return "'$v'";}
	elseif(strpos($v,'"')===false){return '"'.($v).'"';}
	else{return "'unused'";}}
function normaliz_b($v){return str_replace(array(" ","$"),"",$v);}
function create_page_b($t){
	return '<'."?\n".'//philum_'.$_SESSION["plug"].'_defcons'."\n\n".$t."\n?".'>';}
function dump_b($r,$p){
	foreach($r as $k=>$v){$re="";
	if($k!=$_POST["erase"]){
		foreach($v as $ka=>$va){$re.=witch_quote_b($va).',';}
	$ret.='$'.$p.'["'.$k.'"]=array('.substr($re,0,-1).');'."\n";}}
	return create_page_b($ret);}
function plug_motor_b($base,$plug,$defsb){
	if($_GET["restore"]){$sav='_sav';}
	$f=$base.$plug.$sav.'.php';
	if(file_exists($f)){require($f);return $r?$r:$$plug;}
	else{write_txt_b($f,dump_b($defsb,$plug));}}
function save_vars_b($base,$plug,$defs){
	if($_GET["sav"]){$sav='_sav';}
	if($_SESSION["auth"]>=6){
	if($defs){$valu=dump_b($defs,$plug);}
	write_txt_b($base.$plug.$sav.'.php',$valu);}}

#utils

function startstr($v,$d,$l,$p){
if($l==1)$pos=strrpos($v,$d)+1; else $pos=strpos($v,$d)+1;
if($p==1)return substr($v,$pos); else return substr($v,0,$pos);}

function getplug(){return $_GET["plug"]?'/?plug='.$_GET["plug"]:'?';}
function getplugin(){return '/plugin/'.$_GET["plug"];}

function fori($r,$d){$n=count($r);
for($i=0;$i<$n;$i++)eval($d);
return $ret;}

?>