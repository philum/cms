<?php 
class erase{

static function funcb($j,$k,$v,$n){echo $j.'/'.$v.'_'.$k.br();}
//need refresh for each depth
static function removef($j,$k,$v,$io){//echo "$j/$k ";//$io:$v/
chmod($j.'/'.$k,0777);
//if(strpos($k,'<')!==false)
//rename($j.'/'.$k,$j.'/x'); rmdir($j.'/x');
if($v)unlink($j.'/'.$v); else rmdir($j.'/'.$k);
echo "$j/$k/$v".br();}

static function home($del,$dir){
if(!auth(6))return 'no';
echo $del.'-'.$dir.'-';
	if($del)unlink($del);
	elseif($dir && strpos($dir,'/')!=false)rmdir_r($dir);
//$func='rmdir_r';
//$r=explore($dir); explode_dir($r,$dir,$func?$func:"removef"); p($r);
//walk_dir($dir,"removef");
//rmdir($dir);
//chmod($dir,0777);
if($del)return $del;
if($dir)return $dir;
return lkc('','/plug/erase.php?del=','del file');}
}
?>