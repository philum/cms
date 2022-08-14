<?php //tarim (tar img)
 
function tarim_build($p,$o){
$ret=$p.'-'.$o;
return $ret;}

function tarim_f($p){$length=ses('tilen');
$min=$p*$length; $max=$min+$length;
return '_backup/img_'.$min.'-'.$max.'.tar';}

function tarim_tar($f,$rc){
mkdir_r($f); if(is_file($f))unlink($f);
if(!is_file($f) && $rc)tar::tarim($f,$rc);
if(is_file($f))$ret=lk($f,$f); elseif(!$rc)$ret='no'; else $ret='er';
return $ret;}

//from catalog
function tarim_j($p,$o,$res=''){$length=ses('tilen');
$min=$p*$length; $max=$min+$length;
$rq=sqr('img','qda','where id>'.$min.' and id<'.$max); //p($r);
while($r=mysqli_fetch_row($rq)){$rb=explode('/',$r[0]); //echo $r[0];
	if($rb)foreach($rb as $kb=>$vb)if($vb)if(is_file('img/'.$vb))$rc[]='img/'.$vb;}
$ret=$min.'-'.$max.' ('.count($rc).') ';
$f='_backup/img_'.$min.'-'.$max.'.tar';
//rmdir_r('_backup/');
return tarim_tar($f,$rc);}

//from dir
function tarim_ja($p,$o,$res=''){$length=ses('tilen');
$min=$p*$length; $max=$min+$length; //if($min=0)$min=8;
$rc=scandir('img'); unset($rc[0]); unset($rc[1]);//$rc=explore('img','full');
$rc=array_slice($rc,$min,$length); //p($rc);
if($rc)foreach($rc as $v)if($v!='.' and $v!='..')$rd[]='img/'.$v; //p($rd);//if(is_file('img/'.$v))
//foreach($rd as $v)if($sz=filesize($v))$re[$sz]=$v; krsort($re); pr($re);
$ret=$min.'-'.$max.' ('.count($rd).') ';
$f='_backup/img_'.$min.'-'.$max.'.tar';
//rmdir_r('_backup/');
return tarim_tar($f,$rd);
}

//from content
function tarim_findim($v,$xt){$r=explode($xt,$v); //echo $r[0];
if($r)foreach($r as $v){$p=strrpos($v,'['); if($p)$v=substr($v,$p+1);
	if($v)$ret[]='img/'.$v.$xt;}
return $ret;}

function tarim_copy($rc){$dr='imgd/';
rmdir_r('imgd'); mkdir_r($dr);
foreach($rc as $v)copy($v,$dr.substr($v,4));}

function tarim_jb($p,$o,$res=''){$length=ses('tilen');
$min=$p*$length; $max=$min+$length;
$rq=sqr('msg','qdm','where id>'.$min.' and id<'.$max);
while($r=mysqli_fetch_row($rq)){
	$rb=tarim_findim($r[0],'.jpg');
	if($rb)foreach($rb as $vb)if($vb)if(is_file($vb))$rc[]=$vb;
	$rb=tarim_findim($r[0],'.gif');
	if($rb)foreach($rb as $vb)if($vb)if(is_file($vb))$rc[]=$vb;
	$rb=tarim_findim($r[0],'.png');
	if($rb)foreach($rb as $vb)if($vb)if(is_file($vb))$rc[]=$vb;
	}
//p($rc);
$ret=$min.'-'.$max.' ('.count($rc).') ';
$f='_backup/img_'.$min.'-'.$max.'.tar';
//rmdir_r('_backup/');
//return tarim_copy($rc);
return tarim_tar($f,$rc);}

function tarim_nb(){$rc=scandir('img'); return count($rc);}

function tarim_menu($p,$o,$rid){$length=ses('tilen');
//if($_SESSION['rqt'])$n=ceil(key($_SESSION['rqt'])/$length);
$n=sesmk('tarim_nb','',''); $ret=$n.' images'.br();
$n/=$length;
for($i=0;$i<$n;$i++){
	if(is_file(tarim_f($i)))$c='active'; else $c='';
		$ret.=lj($c,$rid.'_plug__3_tarim_tarim*ja_'.$i,$i*$length).' ';}
return $ret;}

function plug_tarim($p,$o){$rid='plg'.randid();
ses('tilen',5000);
$bt=tarim_menu($p,$o,$rid);
//rmdir_r('imgd/'); mkdir_r('imgd/');
//echo tar::extract(img8.tar','imgd/');
return divc('nbp',$bt).divd($rid,$ret);}

?>