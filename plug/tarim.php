<?php
//philum_plugin_tarim (tar img)

function tarim_build($p,$o){
$ret=$p.'-'.$o;
return $ret;}

function tarim_f($p){$length=ses('tilen');
$min=$p*$length; $max=$min+$length;
return 'users/'.ses('qb').'/backup/img_'.$min.'-'.$max.'.tar';}

function tarim_j($p,$o,$res=''){$length=ses('tilen');
$min=$p*$length; $max=$min+$length;
$rq=sq('img','qda','where id>'.$min.' and id<'.$max); //p($r);
while($r=mysql_fetch_row($rq)){$rb=explode('/',$r[0]); //echo $r[0];
	if($rb)foreach($rb as $kb=>$vb)if($vb)if(is_file('img/'.$vb))$rc[]='img/'.$vb;}
$ret=$min.'-'.$max.' ('.count($rc).') ';
$f='users/'.ses('qb').'/backup/img_'.$min.'-'.$max.'.tar';
//rmdir_r('users/'.ses('qb').'/backup/');
mkdir_r($f);
//unlink('users/'.ses('qb').'/backup/img_0-500.tar');
//unlink('users/'.ses('qb').'/backup/img_500-1000.tar');
if(is_file($f))unlink($f);
if(!is_file($f) && $rc)plugin_func('tar','tar',$f,$rc);
if(is_file($f))$ret.=lka($fb); elseif(!$rc)$ret.='no'; else $ret.='er';
return $ret;}

function tarim_menu($p,$o,$rid){$length=ses('tilen');
if($_SESSION['rqt'])$n=ceil(key($_SESSION['rqt'])/$length);
for($i=0;$i<$n;$i++){
	if(is_file(tarim_f($i)))$c='active'; else $c='';
		$ret.=lj($c,$rid.'_plug__3_tarim_tarim*j_'.$i,$i*$length).' ';}
return $ret;}

function plug_tarim($p,$o){$rid='plg'.randid();
ses('tilen',10000);
$bt=tarim_menu($p,$o,$rid);
return divc('nbp',$bt).divd($rid,$ret);}

?>