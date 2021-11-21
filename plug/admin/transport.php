<?php
//philum_plugin_transport

function transport_last($db){
return sql_b('select id from '.ts_pub($db).' order by id DESC limit 1','v');}

function transport_dumpall(){
$r=transport_tables(); foreach($r as $k=>$v)backup_dump($v);}

//distant
function transport_build($p,$o){$ret='';
if($o=='last')return transport_last($p);
reqp('backup');
if($o=='d')return backup_dump($p);//dump
if($o=='dj')return backup_json($p);//dump
if($o=='d2')return transport_dumpall($p);//dump2
elseif($o=='up')return backup_build($p,0,1);//updates
elseif(is_numeric($o))return backup_build($p,$o,0);}//inserts

function transport_tables(){return ['art','txt','trk','data','meta','meta_art','meta_clust','search','search_art','favs','twit','user','web','yandex','ips','live','live2','stat','_sys','cat','hub','mbr','img','umvoc','umvoc_arts','umtwits','bdvoc','dicoen','dicofr','dicoum','hipparcos','gaia'];}//

function ts_pub($b){$r=['art','txt','trk','data','meta','meta_art','search','search_art','poll','twit','user','web','yandex','ips','live','stat','cat','hub','mbr','img','umvoc','umvoc_arts','umtwits'];
if(in_array($b,$r))return qd($b); else return $b;}

function db_r(){
$r=['qdy'=>'_sys','qda'=>'art','qdm'=>'txt','qdd'=>'data','qdu'=>'user','qdi'=>'trk','qdb'=>'mbr','qdp'=>'ips','qdv'=>'live','qdv2'=>'live2','qds'=>'stat','qdt'=>'meta','qdta'=>'meta_art','qdtc'=>'meta_clust','qdf'=>'favs','qdsr'=>'search','qdsra'=>'search_art','ynd'=>'yandex','qdw'=>'web','qdtw'=>'twit','qdg'=>'img','qdc'=>'cat','qdk'=>'iqs'];//'qdh'=>'hub','qdt-en'=>'meta_en',
foreach($r as $k=>$v)$_SESSION[$k]='pub_'.$v;
return array_flip($r);}

function ts_db($b){$r=db_r(); return $r[$b]??$b;}

function tr_dcrpt($d){
$iv='fKxb6KW8K37/IzoScd7kcQ==';
return base64_decode(crypt::decrypt_build($d,$iv));}

function transport_srv0(){$srv=$_SERVER['HTTP_HOST'];
$r=msql::col('server','shared_servers_1',0,1);
if($srv=='oumo.fr')return ['dav','umm',tr_dcrpt($r[1]),'umm'];//srv1
if($srv=='socialnetwork.ovh')return ['dav','umm',tr_dcrpt($r[2]),'umm'];//srv2
if($srv=='newsnet.fr')return ['dav','nfo',tr_dcrpt($r[1]),'nfo'];//1
if($srv=='newsnet.ovh')return ['dav','nfo',tr_dcrpt($r[2]),'nfo'];}//2

function transport_srv(){$srv=$_SERVER['HTTP_HOST'];
$d=read_file('params/_connectx.php');
$d=embed_detect($d,'mysqli_connect(',')');
$d=str_replace("'",'',$d); $r=explode(',',$d); //pr($r);
require('params/_connectx.php');
if(auth(6))return ['dav',$db,$r[2],$db];}

//local
function transport_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); if(!auth(7))return;
list($usr,$db,$ps,$dr)=transport_srv(); $root=__DIR__; //$root='/home/'.$dr;
$srv=prms('srvimg'); if(!$srv)return 'srvimg is not set';
if($o=='all'){$dt=date('ymd');
	$u=$srv.'/call/transport/1/d'; $fa=get_file($u);//build
	//if(is_file($fa))unlink($fa);//
	if(!is_file($fa)){$e='wget -P /home/'.$dr.'/_backup '.$srv.'/'.$fa; exc($e);}
	if(is_file($fa)){
		$fb=struntil($fa,'.'); if(is_file($fb))unlink($fb);
		exc('gunzip -d /home/'.$dr.'/'.$fa);//--binary-mode -o 
		$e='mysql -u '.$usr.' -p'.$ps.' -D '.$db.' < /home/'.$dr.'/'.$fb; exc($e);
		//$e='mysql -u'.$usr.' -p'.$ps.' --default-character-set=utf8 '.$db.''; exc($e);
		//$e="SET names 'utf8'"; exc($e);
		//$e='SOURCE /home/'.$dr.'/'.$fb; exc($e);
		return 'restored';}}
$f=$srv.'/call/transport/'.$p.'/last'; $dist_maxid=get_file($f);
$maxid=transport_last($p); if($maxid=='' or $o=='d')$maxid=0;
if($o=='z' && auth(7)){sqldrop(ts_db($p));//$b=ts_pub($p); qr('drop table '.$b);//reinit
	reqp('install'); $r=install_db(); $d=$r[$p]; if($d)qr($d); $res=$p.':z';}
elseif($o=='zz' && auth(7)){$r=transport_tables();//reinstal tables
	foreach($r as $k=>$v)sqldrop(ts_db($v));//qr('drop table '.ts_pub($v));
	reqp('install'); return plug_install(ses('qd'));}
elseif($o=='json'){//dj
	$u=$srv.'/call/transport/'.$p.'/dj'; $d=get_file($u); //echo $u.';;';//build?? //.($o?$o:$maxid)
	$f='_backup/'.$p.'.json'; $u=$srv.'/'.$f;
	//if(is_file($f))unlink($f); 
	if(!is_file($f)){$e='wget -P /home/'.$dr.'/_backup '.$u; exc($e);}
	if($d=get_file($u))$r=json_decode($d,true); $er=json_error(); $r=utf_r($r,1);
	if($d && !$er){$ra=db_r(); $b=$ra[$p]; $bb=sqlbcp($b); trunc($b); sqlsav2($b,$r,1,0); $res=$b.':renoved';}}
else{//partial and complete dumps, not gziped
	//$ra=db_r(); $b=$ra[$p]; $bb=sqlbcp($b); trunc($b);
	$u=$srv.'/call/transport/'.$p.'/'.($o?$o:$maxid); $d=get_file($u);//build
	$f='_backup/'.$p.'.dump'; $u=$srv.'/'.$f;
	if(is_file($f))unlink($f); if(!is_file($f)){$e='wget -P /home/'.$dr.'/_backup '.$u; exc($e);}
	if(is_file($f)){$o=='d'?'ssh':'rq';// -t '.qd($p).'
		if($o=='ssh'){echo $e='mysql -u '.$usr.' -p'.$ps.' '.$db.' < /home/'.$dr.'/'.$f; exc($e);}
		else{$d=file_get_contents($srv.'/'.$f); if($d)qr($d);}
	$res=$maxid==$dist_maxid?'ok':$maxid.'->'.$dist_maxid;}
	//exc('rm /home/'.$dr.'/'.$f);
	//todo: del local and distant
}
return $p.'-'.$o.':'.$res.br();}

function transport_ssh($usr,$ps,$db,$dr,$f){//safety import to utf8
	$e='mysql -u '.$usr.' -p'.$ps.' --default-character-set=utf8 '.$db.''; exc($e);
	$e='SET names "utf8"'; exc($e);
	$e='SOURCE /home/'.$dr.'/'.$f.''; exc($e);}

function transport_batch($p){
$r=transport_tables(); $ret='';
foreach($r as $k=>$v)$ret.=transport_j($v,$p);
return $ret;}

function transport_utf8(){$r=transport_tables();
foreach($r as $k=>$v)
	qr('ALTER TABLE '.ts_pub($v).' CONVERT TO CHARACTER SET `utf8`;');
	//qr('ALTER TABLE '.ts_pub($v).' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;');
	//qr('update table SHOW FULL COLUMNS FROM '.ts_pub($v));
return 'ok';}

function transport_msql($p,$o){$ret='ok';
$fa='_backup/msql_'.$p.'.tar'; $rb=[];
if($o){//distant
	$r=msql::choose('users',$p,''); //pr($r);
	if(is_file($fa))unlink($fa);
	if($r)foreach($r as $k=>$v)foreach($v as $ka=>$va)
		$rb[]='msql/users/'.$p.'_'.$k.($va?'_'.$va:'').'.php'; //pr($rb);
	if($rb){tar::folder($fa,$rb); $fa=tar::gz($fa);}}
else{//local
	$srv=prms('srvimg'); $fa.='.gz';
	if(!$srv)return 'srvimg is not set';
	if(is_file($fa))unlink($fa);
	$f=$srv.'/call/transport/'.$p.'/call&fc=msql'; $ret=get_file($f);
	list($usr,$db,$ps,$dr)=transport_srv();
	$e='wget -P /home/'.$dr.'/_backup '.$srv.'/'.$fa; exc($e); //$ret=get_file($srv.'/'.$fa);
	$e='tar -zxvf /home/'.$dr.'/'.$fa;
	//echo $e='tar --extract --listed-incremental=/dev/null --file /home/'.$dr.'/'.$fa;
	if(is_file($fa))exc($e); //extract($fa);
	if(!is_file($fa))$ret='not arrived';}
return btn('txtyl',$ret);}

function transport_img($p,$o){
$ret=''; $rb=[]; $l=5000;
if($o=='call'){reqp('backupim');//distant
	ses('tilen',5000); backupim_rec($p,'');
	$ret=backupim_j($p,1);	}
elseif($o=='menu'){$r=scandir_b('img'); $nb=count($r);
	if($_SESSION['rqt'])$n=key($_SESSION['rqt']);
	$n=ceil($n/$l); $ret=''; //rmdir_r('backupphi');//not good
	for($i=0;$i<$n;$i++){$min=$i*$l; $max=$min+$l;
		$f='_backup/imgqda_'.$min.'-'.$max.'.tar.gz'; $c=is_file($f)?'active':'';
		$ret.=lj($c,$p.'_plug__3_transport_transport*img_'.$i,$i*$l).'-';
		$ret.=lj('',$p.'_plug__3_transport_transport*img_'.$i.'_untar','un').' ';}
	$ret=$nb.' files'.divc('nbp',$ret);}
elseif($o=='untar'){$min=$p*$l; $max=$min+$l;
	list($usr,$db,$ps,$dr)=transport_srv();
	$fa='_backup/imgqda_'.$min.'-'.$max.'.tar.gz';
	//$e='tar -zxvf /home/'.$dr.'/'.$fa.' /home/'.$dr.'/img/'; if(is_file($fa))exc($e);
	tar::extract($fa);
	$ret=transport_img($p,'menu');}
else{//local
	$srv=prms('srvimg');//srvmirror
	if(!$srv)return 'srvimg is not set';
//	if(is_file($fa))unlink($fa);
	$f=$srv.'/call/transport/'.$p.'/call&fc=img'; $fa=get_file($f); //echo $ret;
	list($usr,$db,$ps,$dr)=transport_srv();
	$e='wget -P /home/'.$dr.'/_backup '.$srv.'/'.$fa; exc($e); //$ret=get_file($srv.'/'.$fa);
	$e='tar -zxvf /home/'.$dr.'/'.$fa.' /home/'.$dr.'/img/';
	//echo $e='tar --extract --listed-incremental=/dev/null --file /home/'.$dr.'/'.$fa;
	//if(is_file($fa))exc($e); //extract($fa);
	if(is_file($fa))tar::extract($fa);
	if(!is_file($fa))$ret=btn('txtyl','not arrived');
	else $ret=transport_img($p,'menu');}
return $ret;}

function transport_usr($p,$o){
$ret=''; $rb=[]; $l=5000;
if($o=='call'){//distant
	$f='_backup/users_'.$p.'.tar'; $r=scandir_r('users/'.$p); //pr($r);
	if(is_file($f))return $f;//
	$ret=tar::files($f,$r,0);}
elseif($o=='menu'){$qb=ses('qb'); //$qb='shroud';
	$ret.=lj('txtx',$p.'_plug__3_transport_transport*usr_'.$qb,$qb).'-';
	$ret.=lj('txtx',$p.'_plug__3_transport_transport*usr_'.$qb.'_untar','un').' ';}
elseif($o=='untar'){
	list($usr,$db,$ps,$dr)=transport_srv();
	$fa='_backup/users_'.$p.'.tar.gz';
	//$e='tar -zxvf /home/'.$dr.'/'.$fa.' /home/'.$dr.'/img/'; if(is_file($fa))exc($e);
	tar::extract($fa);
	$ret=transport_usr($p,'menu');}
else{//local
	$srv=prms('srvimg');//srvmirror
	if(!$srv)return 'srvimg is not set';
//	if(is_file($fa))unlink($fa);
	$f=$srv.'/call/transport/'.$p.'/call&fc=usr'; $fa=get_file($f); //echo $ret;
	list($usr,$db,$ps,$dr)=transport_srv();
	$e='wget -P /home/'.$dr.'/_backup '.$srv.'/'.$fa; if(!is_file($fa))exc($e);//
	$e='tar -zxvf /home/'.$dr.'/'.$fa.' /home/'.$dr.'/img/';
	if(is_file($fa))tar::extract($fa);
	if(!is_file($fa))$ret=btn('txtyl','not arrived');
	else $ret=transport_img($p,'menu');}
return $ret;}

function transport_menu($p,$o,$rid){
$j=$rid.'_plug__3_transport_transport';
$a='contents'; $b='critical'; $c='datas';
$ra=transport_tables();
$r[$a][]=select(atd('db'),$ra,'vv','art');
if(!auth(7))return;
$r[$a][]=lj('popbt',$j.'*j___db','update recents');
$r[$a][]=lj('popsav',$j.'*j__up_db','update all');
$r[$a][]=lj('popsav',$j.'*j__d_db','dump');
$r[$a][]=lj('popdel',$j.'*j__json_db','dump via json');
$r[$a][]=lj('popdel',$j.'*j__d2_db','dump each');
$r[$a][]=lj('txtyl',$j.'*j__z_db','reinit').br();
$r[$a][]=lj('popdel',$j.'*batch_ssh','batch all recents by ssh');
$r[$a][]=lj('popdel',$j.'*batch_rq','batch all recents by rq');
//$r[$a][]=lj('popdel',$j.'*batch_json','batch all recents via json');
$r[$b][]=lj('txtyl',$j.'*j__zz_db','reinit all');
$r[$b][]=lj('txtyl',$j.'*j_1_all','dump all db');
$r[$b][]=lj('popsav',$j.'*utf8','utf8ise').br();
$r[$c][]=lj('txtred',$j.'*msql_'.ses('qb'),'msql');
$r[$c][]=lj('txtred',$j.'*img_'.$rid.'_menu','img');
$r[$c][]=lj('txtred',$j.'*usr_'.$rid.'_menu','users');
return make_tabs($r,'trs');}

function plug_transport($p,$o){$rid='trsp';
$bt=transport_menu($p,$o,$rid);
return $bt.divd($rid,'');}

?>