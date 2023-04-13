<?php 
class tarim{//(tar img)
 
static function build($p,$o){
$ret=$p.'-'.$o;
return $ret;}

static function f($p){$length=ses('tilen');
$min=$p*$length; $max=$min+$length;
return '_backup/img_'.$min.'-'.$max.'.tar';}

static function tar($f,$rc){
mkdir_r($f); if(is_file($f))unlink($f);
if(!is_file($f) && $rc)tar::tarim($f,$rc);
if(is_file($f))$ret=lk($f,$f); elseif(!$rc)$ret='no'; else $ret='er';
return $ret;}

//from catalog
static function call($p,$o,$prm=[]){$length=ses('tilen');
$min=$p*$length; $max=$min+$length;
$rq=sql::com('img','qda',['>id'=>$min,'<id'=>$max]);
while($r=sql::qrw($rq)){$rb=explode('/',$r[0]); //echo $r[0];
	if($rb)foreach($rb as $kb=>$vb)if($vb)if(is_file('img/'.$vb))$rc[]='img/'.$vb;}
$ret=$min.'-'.$max.' ('.count($rc).') ';
$f='_backup/img_'.$min.'-'.$max.'.tar';
//rmdir_r('_backup/');
return self::tar($f,$rc);}

//from dir
static function call2($p,$o,$prm=[]){$length=ses('tilen');
$min=$p*$length; $max=$min+$length; //if($min=0)$min=8;
$rc=scandir('img'); unset($rc[0]); unset($rc[1]);//$rc=explore('img','full');
$rc=array_slice($rc,$min,$length); //p($rc);
if($rc)foreach($rc as $v)if($v!='.' and $v!='..')$rd[]='img/'.$v; //p($rd);//if(is_file('img/'.$v))
//foreach($rd as $v)if($sz=filesize($v))$re[$sz]=$v; krsort($re); pr($re);
$ret=$min.'-'.$max.' ('.count($rd).') ';
$f='_backup/img_'.$min.'-'.$max.'.tar';
//rmdir_r('_backup/');
return self::tar($f,$rd);
}

//from content
static function findim($v,$xt){$r=explode($xt,$v); //echo $r[0];
if($r)foreach($r as $v){$p=strrpos($v,'['); if($p)$v=substr($v,$p+1);
	if($v)$ret[]='img/'.$v.$xt;}
return $ret;}

static function copy($rc){$dr='imgd/';
rmdir_r('imgd'); mkdir_r($dr);
foreach($rc as $v)copy($v,$dr.substr($v,4));}

static function call3($p,$o,$prm=[]{$length=ses('tilen');
$min=$p*$length; $max=$min+$length;
$rq=sql::com('msg','qdm',['>id'=>$min,'<id'=>$max]);
while($r=sql::qrw($rq)){
	$rb=self::findim($r[0],'.jpg');
	if($rb)foreach($rb as $vb)if($vb)if(is_file($vb))$rc[]=$vb;
	$rb=self::findim($r[0],'.gif');
	if($rb)foreach($rb as $vb)if($vb)if(is_file($vb))$rc[]=$vb;
	$rb=self::findim($r[0],'.png');
	if($rb)foreach($rb as $vb)if($vb)if(is_file($vb))$rc[]=$vb;
	}
//p($rc);
$ret=$min.'-'.$max.' ('.count($rc).') ';
$f='_backup/img_'.$min.'-'.$max.'.tar';
//rmdir_r('_backup/');
//return self::copy($rc);
return self::tar($f,$rc);}

static function nb(){$rc=scandir('img'); return count($rc);}

static function menu($p,$o,$rid){$length=ses('tilen');
//if($_SESSION['rqt'])$n=ceil(key($_SESSION['rqt'])/$length);
$n=sesmk('tarim_nb','',''); $ret=$n.' images'.br();
$n/=$length;
for($i=0;$i<$n;$i++){
	if(is_file(self::f($i)))$c='active'; else $c='';
		$ret.=lj($c,$rid.'_tarim,call2_'.$i,$i*$length).' ';}
return $ret;}

static function home($p,$o){$rid='plg'.randid();
ses('tilen',5000);
$bt=self::menu($p,$o,$rid);
//rmdir_r('imgd/'); mkdir_r('imgd/');
//echo tar::extract(img8.tar','imgd/');
return divc('nbp',$bt).divd($rid,$ret);}
}
?>