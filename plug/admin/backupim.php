<?php
//philum_plugin_backupim (tar img)
 
function backupim_build($p,$o){
$ret=$p.'-'.$o;
return $ret;}

function backupim_f($p){$length=ses('tilen');
$min=$p*$length; $max=$min+$length;
return '_backup/imgqda_'.$min.'-'.$max.'.tar';}

function backupim_tar($f,$rc){
mkdir_r($f); if(is_file($f))unlink($f);
//$e='tar -cvf /home/nfo/_backup/img.tar /home/nfo/img'; exc($e);
if(!is_file($f) && $rc)tar::files($f,$rc,0);//1=gz
//if(!is_file($f) && $rc)tar::create($f,$rc);//less good
if(is_file($f))$ret=$f; elseif(!$rc)$ret='no'; else $ret='er';
return $ret;}

function backupim_sm($p,$o,$res=''){$length=ses('tilen'); $ret='-';
$min=$p*$length; $max=$min+$length; //if($min=0)$min=8;
$rc=scandir('img'); unset($rc[0]); unset($rc[1]);//$rc=explore('img','full');
$rc=array_slice($rc,$min,$length); //p($rc);
if($rc)foreach($rc as $v)if($v!='.' and $v!='..'){$im='img/'.$v;
	if(filesize($im)==0){$ret.=img('/'.$im); unset($im);}}//
return $ret;}

//from content
function backupim_findim($v,$xt){$r=explode($xt,$v); //echo $r[0];
if($r)foreach($r as $v){$p=strrpos($v,'['); if($p)$v=substr($v,$p+1);
	if($v)$ret[]='img/'.$v.$xt;}
return $ret;}

function backupim_copy($rc){//rmdir_r('imgd');
foreach($rc as $v)rename('img/'.$v,'imgd/'.$v);}//copy($v,'imgd/'.substr($v,4));

function backupim_jb($p,$o,$res=''){$length=ses('tilen'); //mkdir_r('imgd/');
$min=$p*$length; $max=$min+$length;
$rq=sqr('msg','qdm','where id>'.$min.' and id<'.$max);
while($r=mysqli_fetch_row($rq)){
	$rb=backupim_findim($r[0],'.jpg');
	if($rb)foreach($rb as $vb)if($vb)if(is_file($vb))$rc[]=$vb;
	$rb=backupim_findim($r[0],'.gif');
	if($rb)foreach($rb as $vb)if($vb)if(is_file($vb))$rc[]=$vb;
	$rb=backupim_findim($r[0],'.png');
	if($rb)foreach($rb as $vb)if($vb)if(is_file($vb))$rc[]=$vb;}
//p($rc);
$ret=$min.'-'.$max.' ('.count($rc).') ';
$f='_backup/img_'.$min.'-'.$max.'.tar';
//rmdir_r('_backup/');
//return backupim_copy($rc);
$ok=backupim_tar($f,$rc);
return $o?$f:lk($f,$f);}

//from dir
function backupim_ja($p,$o,$res=''){$length=ses('tilen');
$min=$p*$length; $max=$min+$length; //if($min=0)$min=8;
$rc=scandir('img'); unset($rc[0]); unset($rc[1]);//$rc=explore('img','full');
$rc=array_slice($rc,$min,$length); //p($rc);
if($rc)foreach($rc as $v)if($v!='.' and $v!='..')$rd[]='img/'.$v; //p($rd);//if(is_file('img/'.$v))
//foreach($rd as $v)if($sz=filesize($v))$re[$sz]=$v; krsort($re); pr($re);
$ret=$min.'-'.$max.' ('.count($rd).') ';
$f='_backup/img_'.$min.'-'.$max.'.tar';
//rmdir_r('_backup/');
$ok=backupim_tar($f,$rd);
return $o?$f:lk($f,$f);}

//from catalog
function backupim_j($p,$o,$res=''){$length=ses('tilen'); chrono();
$min=$p*$length; $max=$min+$length;
ses('qda','pub_art'); $rc=[];
$rq=sqr('id,img','qda','where id>"'.$min.'" and id<"'.$max.'"'); //p($r);
while($r=mysqli_fetch_row($rq)){$d=$r[1];
	//$d=recenseim($r[0]); //echo $d;
	$rb=explode('/',$d);
	if($rb)foreach($rb as $kb=>$vb)if($vb)if(is_file('img/'.$vb))$rc['img/'.$vb]=1;}
$ret=$min.'-'.$max.' ('.count($rc).') ';
$f='_backup/imgqda_'.$min.'-'.$max.'.tar.gz'; //rmdir_r('_backup/');
echo chrono($min.'-'.$max);
$ok=backupim_tar($f,array_keys($rc));
echo chrono('tar');
return $o?$f:lk($f,$f);}

//recense
function backupim_rec($p,$o){$length=ses('tilen');
$min=$p*$length; $max=$min+$length; req('ajxf'); $rc=[];
$rq=sqr('id,img','qda','where id>'.$min.' and id<'.$max); //p($r);
while($r=mysqli_fetch_row($rq)){$d=$r[1];//
	$d=recenseim($r[0],$r[1]);
	if($d!=$r[1]){update('qda','img',$d,'id',$r[0]); $rc[]=1;}}
return $min.'-updated: '.count($rc);}

//rename,store,use ref in storage,dl from srvim,replace in qda and msg
function backupim_rn($p,$o){$length=ses('tilen',5000);
$min=$p*$length; $max=$min+$length; req('ajxf'); $rc=[]; $rd=[]; $i=0;
$rq=sqr('id,img,nod','qda','where id>'.$min.' and id<'.$max); //p($r);
while($r=mysqli_fetch_row($rq)){$d=$r[1]; $ka=$r[0]; $qb=$r[2];
	$msg=sql('msg','qdm','v',$ka); $i++; $treated=0;
	$rb=explode('/',$r[1]); $ref=$rb[0]; if(!$ref or !is_numeric($ref))$ref=1;
	foreach($rb as $k=>$v)if($v && !is_numeric($v)){// && $i<1000
		$no=1; $treated=0; $thumb=''; $ok=0;
		list($hub,$id,$nm,$xx)=expl('_',$v,4); $xt=xt($v,1); $nm=strto($nm,'.');//no xt
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
			update('qda','img',$d,'id',$r[0]);}
		elseif($v && $nv!=$v){$treated=1;
			/**/$y=rename('img/'.$v,'img/'.$nv);
			img::save($ka,$nv,$v);
			$d=str_replace($v,$nv,$d);
			update('qda','img',$d,'id',$r[0]);
			$msg=str_replace($v,$nv,$msg);
			$rc[]=[$ka,$nv,$v,$no,$treated];
		}
	}
	if($treated){
		//update('qda','img',$thumb,'id',$r[0]); //$rc[]=1;
		//update('qdm','msg',$msg,'id',$r[0]);
	}
}
pr($rd);
pr($rc);
return $min.'-updated: '.count($rc);}

function backupim_rc($p){$length=ses('tilen',5000);
$min=$p*$length; $max=$min+$length; req('ajxf'); $rc=[]; $rd=[]; $i=0;
$ra=sql('im,id','qdg','kv','');
$rq=sqr('id,img,nod','qda','where id>'.$min.' and id<'.$max); //p($r);
while($r=mysqli_fetch_row($rq)){$ka=$r[0]; $d=$r[1]; $qb=$r[2];
	$rb=explode('/',$r[1]); $ref=$rb[0]; if(!$ref or !is_numeric($ref))$ref=1;
	foreach($rb as $k=>$v)if($v && !is_numeric($v)){if(val($ra,$v)==$ka)$rc[]=[$ka,$v,'',0];}}
if($rc)sqlsav2('qdg',$rc); pr($rc);
return 'ok';}

//repair error
/*function backupim_rp($p){$length=ses('tilen',5000);
$min=$p*$length; $max=$min+$length; req('ajxf'); $rc=[]; $rd=[]; $i=0;
$rq=sqr('id,ib,im,dc','qdg','where ib>'.$min.' and ib<'.$max); //p($r);
while($r=mysqli_fetch_row($rq))if($i<10){$id=$r[0]; $ib=$r[1]; $im=$r[2]; $dc=$r[3]; $i++;
	list($hub,$id,$nm)=expl('_',$dc,3); $xt=xt($dc,1); $nm=strto($nm,'.');//no xt
	if(strlen($nm)==11){echo $dc;
		$y=rename('img/'.$im,'img/'.$dc);
		sqldel('qdg',$id);
		$ims=sql('img','qda','v',$ib); $ims=str_replace($im,$dc,$ims); eco($ims);
		update('qda','img',$ims,'id',$ib);
		$msg=sql('msg','qdm','v',$ib); $msg=str_replace($im,$dc,$msg); eco($msg);
		update('qdm','msg',$msg,'id',$ib);
		}
	}
return 'ok';}*/

//unusited
function backupim_others($p,$o,$res=''){$length=ses('tilen');
$min=$p*$length; $max=$min+$length; $ra=scandir_b('img');
$f='_backup/imgqda_others_'.$p.'.tar'; if(is_file($f))unlink($f);
$rq=sqr('img','qda','');//'where id>'.$min.' and id<'.$max
while($r=mysqli_fetch_row($rq)){$rb=explode('/',$r[0]);
	if($rb)foreach($rb as $kb=>$vb)if($vb)$rc[]=$vb;}
$rd=array_diff($ra,$rc);
//$rd=array_slice($rd,$min,$length);
echo count($rd); //p($rd);
foreach($rd as $k=>$v)$re['img/'.$v]=1;
//if($o=='x')foreach($re as $k=>$v)unlink($k);
if($o=='d'){mkdir('imgx'); foreach($rd as $k=>$v)rename('img/'.$v,'imgx/'.$v);}
else $ok=backupim_tar($f,array_keys($re));
return $o?$f:lk($f,$f);}

function backupim_tarimgx(){
$f='_backup/imgx.tar.gz'; $r=scandir_r('imgx');
return backupim_tar($f,$r);} //rmdir_r('imgx');

function backupim_nb(){$rc=scandir('img'); return count($rc);}

function backupim_imgc(){$rc=scandir('imgc'); $f='_backup/imgc.tar';
$ok=backupim_tar($f,$r); return lk($f);}

function backupim_db($p,$rid){$length=10000;
$n=key($_SESSION['rqt']);
$n=ceil($n/$length); $min=$p*$length; $max=$min+$length; $ret='from '.$min.' to '.$max.': ';
for($i=1;$i<$n;$i++)$ret.=lj('',$rid.'_plug__3_backupim_backupim*db_'.$i.'_'.$rid,$i).' ';
//$ret.=img::batch($p);
return divc('nbp',$ret);}

function patchmrc(){
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

function backupim_menu($p,$o,$rid){$length=ses('tilen'); //patchmrc();
if($_SESSION['rqt'])$n=key($_SESSION['rqt']);//j
//unlink('_backup/img_0-5000.tar');
//mkdir_r('/imgb/cod');
//$n=sesmk('backupim_nb','',''); $ret=$n.' images'.br();//ja
$n=ceil($n/$length); $ret=''; //rmdir_r('backupphi');
for($i=0;$i<$n;$i++){$f=backupim_f($i);
	if(is_file($f))$c='active'; else $c='';
		//$ret.=lj($c,$rid.'_plug__3_backupim_backupim*ja_'.$i,'bak'.$i*$length,att($f)).' ';//dir
		$ret.=lj($c,$rid.'_plug__3_backupim_backupim*j_'.$i,'bak'.$i*$length,att($f)).' ';
		$ret.=lj($c,$rid.'_plug__3_backupim_backupim*rec_'.$i,'recense',att('update catalog')).' ';
		//$ret.=lj($c,$rid.'_plug__3_backupim_backupim*sm_'.$i,'sm'.$i,att('destroy 0k files')).' ';
		//$ret.=lj($c,$rid.'_plug__3_backupim_backupim*rn_'.$i,'rn',att('rename to conformity')).' ';
		//$ret.=lj($c,$rid.'_plug__3_backupim_backupim*rp_'.$i,'xxx',att('repair')).' ';
		//$ret.=lj($c,$rid.'_plug__3_backupim_backupim*rc_'.$i,'rc',att('store')).' ';
		$ret.=' | ';
	}
	$ret.=lj($c,$rid.'_plug__3_backupim_backupim*others_','orphelins').' ';
	$ret.=lj($c,$rid.'_plug__3_backupim_backupim*others_'.'_d','displace_orphs').' ';
	$ret.=lj($c,$rid.'_plug__3_backupim_backupim*tarimgx','tar_imgx').' ';
	//$ret.=lj($c,$rid.'_plug__3_backupim_backupim*others_'.'_x','kill_orphs').' ';
	//$ret.=lj($c,$rid.'_plug__3_backupim_patchmrc','patch_mrc').' ';//bad named img
	$ret.=lj($c,$rid.'_plug__3_backupim_backupim_imgc','imgc').' ';
	$ret.=lj($c,$rid.'_plug__3_backupim_backupim*db_1_'.$rid,'save in db').br();
return $ret;}

function plug_backupim($p,$o){$rid='plg'.randid();
ses('tilen',500);
if(!auth(6))return;
$bt=backupim_menu($p,$o,$rid);
//rmdir_r('imgd/'); mkdir_r('imgd/');
//echo tar::extract(img8.tar','imgd/');
return divc('nbp',$bt).divd($rid,'');}

?>