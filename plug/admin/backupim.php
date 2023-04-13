<?php //backupim (tar img)
class backupim{
static $length=1000;

static function build($p,$o){
$ret=$p.'-'.$o;
return $ret;}

static function f($p){$length=self::$length;
$min=$p*$length; $max=$min+$length;
return '_backup/imgqda_'.$min.'-'.$max.'.tar';}

static function tar($f,$rc){
mkdir_r($f); if(is_file($f))unlink($f);
//$e='tar -cvf /home/nfo/_backup/img.tar /home/nfo/img'; exc($e);
if(!is_file($f) && $rc)tar::files($f,$rc,0);//1=gz
//if(!is_file($f) && $rc)tar::create($f,$rc);//less good
if(is_file($f))$ret=$f; elseif(!$rc)$ret='no'; else $ret='er';
return $ret;}

static function sm($p,$o){$length=self::$length; $ret='-';
$min=$p*$length; $max=$min+$length; //if($min=0)$min=8;
$rc=scandir('img'); unset($rc[0]); unset($rc[1]);//$rc=explore('img','full');
$rc=array_slice($rc,$min,$length); //p($rc);
if($rc)foreach($rc as $v)if($v!='.' and $v!='..'){$im='img/'.$v;
	if(filesize($im)==0){$ret.=img('/'.$im); unset($im);}}//
return $ret;}

//from content
static function findim($v,$xt){$r=explode($xt,$v); //echo $r[0];
if($r)foreach($r as $v){$p=strrpos($v,'['); if($p)$v=substr($v,$p+1);
	if($v)$ret[]='img/'.$v.$xt;}
return $ret;}

static function copy($rc){//rmdir_r('imgd');
foreach($rc as $v)rename('img/'.$v,'imgd/'.$v);}//copy($v,'imgd/'.substr($v,4));

static function jb($p,$o){$length=self::$length; //mkdir_r('imgd/');
$min=$p*$length; $max=$min+$length;
$rq=sql::com('msg','qdm',['>id'=>$min,'<id'=>$max]);
while($r=sql::qrw($rq)){
	$rb=self::findim($r[0],'.jpg');
	if($rb)foreach($rb as $vb)if($vb)if(is_file($vb))$rc[]=$vb;
	$rb=self::findim($r[0],'.gif');
	if($rb)foreach($rb as $vb)if($vb)if(is_file($vb))$rc[]=$vb;
	$rb=self::findim($r[0],'.png');
	if($rb)foreach($rb as $vb)if($vb)if(is_file($vb))$rc[]=$vb;}
//p($rc);
$ret=$min.'-'.$max.' ('.count($rc).') ';
$f='_backup/img_'.$min.'-'.$max.'.tar';
//rmdir_r('_backup/');
//return self::copy($rc);
$ok=self::tar($f,$rc);
return $o?$f:lk($f,$f);}

//from dir
static function ja($p,$o){$length=self::$length;
$min=$p*$length; $max=$min+$length; //if($min=0)$min=8;
$rc=scandir('img'); unset($rc[0]); unset($rc[1]);//$rc=explore('img','full');
$rc=array_slice($rc,$min,$length); //p($rc);
if($rc)foreach($rc as $v)if($v!='.' and $v!='..')$rd[]='img/'.$v; //p($rd);//if(is_file('img/'.$v))
//foreach($rd as $v)if($sz=filesize($v))$re[$sz]=$v; krsort($re); pr($re);
$ret=$min.'-'.$max.' ('.count($rd).') ';
$f='_backup/img_'.$min.'-'.$max.'.tar';
//rmdir_r('_backup/');
$ok=self::tar($f,$rd);
return $o?$f:lk($f,$f);}

//from catalog
static function call($p,$o,$prm=[]){
$length=self::$length; chrono();
$min=$p*$length; $max=$min+$length;
ses('qda','pub_art'); $rc=[];
$rq=sql::com('id,img','qda',['>id'=>$min,'<id'=>$max]);
while($r=sql::qrw($rq)){$d=$r[1];
	//$d=sav::recenseim($r[0]); //echo $d;
	$rb=explode('/',$d);
	if($rb)foreach($rb as $kb=>$vb)if($vb)if(is_file('img/'.$vb))$rc['img/'.$vb]=1;}
$ret=$min.'-'.$max.' ('.count($rc).') ';
$f='_backup/imgqda_'.$min.'-'.$max.'.tar.gz'; //rmdir_r('_backup/');
echo chrono($min.'-'.$max);
$ok=self::tar($f,array_keys($rc));
echo chrono('tar');
return $o?$f:lk($f,$f);}

//recense
static function rec($p,$o){$length=self::$length;
$min=$p*$length; $max=$min+$length; $rc=[];
$rq=sql::com('id,img','qda',['>id'=>$min,'<id'=>$max]);
while($r=sql::qrw($rq)){$d=$r[1];//
	$d=sav::recenseim($r[0],$r[1]);
	if($d!=$r[1]){sql::upd('qda',['img'=>$d],$r[0]); $rc[]=1;}}
return $min.'-updated: '.count($rc);}

//rename,store,use ref in storage,dl from srvim,replace in qda and msg
static function rn($p,$o){$length=5000;//self::$length
$min=$p*$length; $max=$min+$length; $rc=[]; $rd=[]; $i=0;
$rq=sql::com('id,img,nod','qda',['>id'=>$min,'<id'=>$max]); //p($r);
while($r=sql::qrw($rq)){$d=$r[1]; $ka=$r[0]; $qb=$r[2];
	$msg=sql('msg','qdm','v',$ka); $i++; $treated=0;
	$rb=explode('/',$r[1]); $ref=$rb[0]; if(!$ref or !is_numeric($ref))$ref=1;
	foreach($rb as $k=>$v)if($v && !is_numeric($v)){// && $i<1000
		$no=1; $treated=0; $thumb=''; $ok=0;
		[$hub,$id,$nm,$xx]=expl('_',$v,4); $xt=xt($v,1); $nm=strto($nm,'.');//no xt
		preg_match('/[0-9a-f]+$/',$nm,$matches);
		if(is_numeric($id) && (strlen($nm)==6 or strlen($nm)==11) && !$xx 
			&& $matches[0]==$nm){$nv=$v; $ok=1;}//11=video//hexa
		elseif(is_numeric($id))$nv=$qb.'_'.$id.'_'.substr(md5($v),0,6).'.'.$xt;
		else $nv=$qb.'_'.$ka.'_'.substr(md5($v),0,6).'.'.$xt;
		if($k==$ref)$thumb=$nv;//sqlup('qda','img',$nv,$ka);
		//$treated=sql('im','qdg','v','im="'.$nv.'"');
		if(!is_file('img/'.$v)){//srvimg
			$srv=prms('srvimg'); copy($srv.'/img/'.$v,'img/'.$v);}
		if(!is_file('img/'.$v)){//other arts using already batched img
			$v2=sql('im','qdg','v','dc="'.$v.'"'); if($v2)$nv=$v2;}
		if($v && is_file('img/'.$v) && filesize('img/'.$v)<10){unlink('img/'.$v);
			if(is_file('imgc/'.$v))unlink('imgc/'.$v); 
			$d=str_replace($v,'',$d); img::del($id,$v); $rd[]=[$ka,$v];
			sql::upd('qda',['img'=>$d],$r[0]);}
		elseif($v && $nv!=$v){$treated=1;
			/**/$y=rename('img/'.$v,'img/'.$nv);
			img::save($ka,$nv,$v);
			$d=str_replace($v,$nv,$d);
			sql::upd('qda',['img'=>$d],$r[0]);
			$msg=str_replace($v,$nv,$msg);
			$rc[]=[$ka,$nv,$v,$no,$treated];
		}
	}
	if($treated){
		//sql::upd('qda',['img'=>$thumb],$r[0]); //$rc[]=1;
		//sql::upd('qdm',['msg'=>$msg],$r[0]);
	}
}
pr($rd);
pr($rc);
return $min.'-updated: '.count($rc);}

static function rc($p){$length=5000;//self::$length
$min=$p*$length; $max=$min+$length; $rc=[]; $rd=[]; $i=0;
$ra=sql('im,id','qdg','kv','');
$rq=sql::com('id,img,nod','qda',['>id'=>$min,'<id'=>$max]); //p($r);
while($r=sql::qrw($rq)){$ka=$r[0]; $d=$r[1]; $qb=$r[2];
	$rb=explode('/',$r[1]); $ref=$rb[0]; if(!$ref or !is_numeric($ref))$ref=1;
	foreach($rb as $k=>$v)if($v && !is_numeric($v)){if(val($ra,$v)==$ka)$rc[]=[$ka,$v,'',0];}}
if($rc)sqlsav2('qdg',$rc); pr($rc);
return 'ok';}

//repair error
/*static function backupim_rp($p){$length=5000;//self::$length
$min=$p*$length; $max=$min+$length; $rc=[]; $rd=[]; $i=0;
$rq=sql::com('id,ib,im,dc','qdg',['>ib'=>$min,'<ib'=>$max]); //p($r);
while($r=sql::qrw($rq))if($i<10){$id=$r[0]; $ib=$r[1]; $im=$r[2]; $dc=$r[3]; $i++;
	[$hub,$id,$nm]=expl('_',$dc,3); $xt=xt($dc,1); $nm=strto($nm,'.');//no xt
	if(strlen($nm)==11){echo $dc;
		$y=rename('img/'.$im,'img/'.$dc);
		sql::del('qdg',$id);
		$ims=sql('img','qda','v',$ib); $ims=str_replace($im,$dc,$ims); eco($ims);
		sql::upd('qda',['img'=>$ims],$ib);
		$msg=sql('msg','qdm','v',$ib); $msg=str_replace($im,$dc,$msg); eco($msg);
		sql::upd('qdm',['msg'=>$msg],$ib);
		}
	}
return 'ok';}*/

//unusited
static function others($p,$o){$length=self::$length;
$min=$p*$length; $max=$min+$length; $ra=scandir_b('img');
$f='_backup/imgqda_others_'.$p.'.tar'; if(is_file($f))unlink($f);
$rq=sql::com('img','qda','');//['>id'=>$min,'<id'=>$max]
while($r=sql::qrw($rq)){$rb=explode('/',$r[0]);
	if($rb)foreach($rb as $kb=>$vb)if($vb)$rc[]=$vb;}
$rd=array_diff($ra,$rc);
//$rd=array_slice($rd,$min,$length);
echo count($rd); //p($rd);
foreach($rd as $k=>$v)$re['img/'.$v]=1;
//if($o=='x')foreach($re as $k=>$v)unlink($k);
if($o=='d'){mkdir('imgx'); foreach($rd as $k=>$v)rename('img/'.$v,'imgx/'.$v);}
else $ok=self::tar($f,array_keys($re));
return $o?$f:lk($f,$f);}

static function tarimgx(){
$f='_backup/imgx.tar.gz'; $r=scandir_r('imgx');
return self::tar($f,$r);} //rmdir_r('imgx');

static function nb(){$rc=scandir('img'); return count($rc);}

static function imgc(){$r=scandir('imgc'); $f='_backup/imgc.tar';
$ok=self::tar($f,$r); return lk($f);}

static function db($p,$rid){$length=10000;
$n=key($_SESSION['rqt']);
$n=ceil($n/$length); $min=$p*$length; $max=$min+$length; $ret='from '.$min.' to '.$max.': ';
for($i=1;$i<$n;$i++)$ret.=lj('',$rid.'_backupim,db___'.$i.'_'.$rid,$i).' ';
//$ret.=img::batch($p);
return divc('nbp',$ret);}

static function patchmrc(){
//$d='newsnet_mrcreseauinternational.netunsenateurrusseaccuselesetatsunisdeprepareruncoupdetatsoftauve';
//$d='newsnet_mrcreseauinternational.netunempirediaboliquedefauxdrapeaux_f3dcdb.jpg';
//$ra=[$d];
$ra=scandir('imgx'); $i=0; //mkdir_r('/imgx');
foreach($ra as $k=>$v){
	if(substr($v,0,11)=='newsnet_mrc'){$i++;
		if(substr($v,-4)=='.png')$xt='.png'; else $xt='.jpg';
		$kurl=substr($v,11); if($n=strpos($kurl,'_'))$kurl=substr($kurl,0,$n);
		$nn='newsnet_mrc_'.substr(md5($v),0,6).$xt;
		rename('imgx/'.$v,'imgx/'.$nn);}}
return 'ok:'.$i;}

static function menu($p,$o,$rid){$length=self::$length; //self::patchmrc();
if($_SESSION['rqt'])$n=key($_SESSION['rqt']);//j
//unlink('_backup/img_0-5000.tar');
//mkdir_r('/imgb/cod');
//$n=sesmk('backupim_nb','',''); $ret=$n.' images'.br();//ja
$n=ceil($n/$length); $ret=''; //rmdir_r('backupphi');
for($i=0;$i<$n;$i++){$f=self::f($i);
	if(is_file($f))$c='active'; else $c='';
		//$ret.=lj($c,$rid.'_backupim,ja___'.$i,'bak'.$i*$length,att($f)).' ';//dir
		$ret.=lj($c,$rid.'_backupim,call___'.$i,'bak'.$i*$length,att($f)).' ';
		$ret.=lj($c,$rid.'_backupim,rec___'.$i,'recense',att('update catalog')).' ';
		//$ret.=lj($c,$rid.'_backupim,sm___'.$i,'sm'.$i,att('destroy 0k files')).' ';
		//$ret.=lj($c,$rid.'_backupim,rn___'.$i,'rn',att('rename to conformity')).' ';
		//$ret.=lj($c,$rid.'_backupim,rp___'.$i,'xxx',att('repair')).' ';
		//$ret.=lj($c,$rid.'_backupim,rc___'.$i,'rc',att('store')).' ';
		$ret.=' | ';
	}
	$ret.=lj($c,$rid.'_backupim,others___','orphelins').' ';
	$ret.=lj($c,$rid.'_backupim,others___'.'_d','displace_orphs').' ';
	$ret.=lj($c,$rid.'_backupim,tarimgx','tar_imgx').' ';
	//$ret.=lj($c,$rid.'_backupim,others___'.'_x','kill_orphs').' ';
	//$ret.=lj($c,$rid.'_backupim,patchmrc','patch_mrc').' ';//bad named img
	$ret.=lj($c,$rid.'_backupim,imgc','imgc').' ';
	$ret.=lj($c,$rid.'_backupim,db___1_'.$rid,'save in db').br();
return $ret;}

static function home($p,$o){$rid='plg'.randid();
if(!auth(6))return;
$bt=self::menu($p,$o,$rid);
//rmdir_r('imgd/'); mkdir_r('imgd/');
//echo tar::extract(img8.tar','imgd/');
return divc('nbp',$bt).divd($rid,'');}
}
?>