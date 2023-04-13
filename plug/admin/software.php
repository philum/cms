<?php //software

class software{
static function version($n){
return checkversion($n);}

//'/call/software,give/app-tar
static function give($p){$f=str_replace('-','/',$p);
$r=explode('/',$f); if($r[0]!='params')
return base64_encode(file_get_contents($f));}

static function patch($p=''){$ret='';
$r=msql::read('system','program_patches','',1);
$rb=msql::col('server','program_patches',0,1);
if($r)foreach($r as $k=>$v)if(!val($rb,$k))$ret.=lj('','popup_software,patch___'.$k,$k);
if($ret)$ret=btn('txtyl','patch needed: '.$ret);
if($p && !$rb[$p]){
	$ret=lj('txtalert','upd_software,state',$r[$p][0].': '.$r[$p][1]);
	$ret.=patchs::home($r[$p][0]);
	msql::modif('server','program_patches',1,'shot',0,$p);}
return $ret;}

static function tabler($r){
return divc('scroll',tabler($r[0],['updated']).tabler($r[1],['created']).tabler($r[2],['deleted']));}
static function details(){$r=json::read('srv','upd'); if($r)return self::tabler($r);}
static function rapport($r){return lj('txtalert','updb_pubdate,call',count($r[0]).' files updated, '.count($r[1]).' files created, '.count($r[2]).' files deleted');}
static function notes(){$r=msql::read('system','program_updates_'.date('ym'),'',1);
$r=array_reverse($r); return tabler($r);}

static function state($p=''){$ret='';
$localver=checkversion(2); $distver=checkupdate(2); if($p)$localver=$distver;
$f=json::url('srv','upd'); $date=ftime($f,'ymd.Hi');
if($p)$r[]=btn('txtcadr',helps('softwareupdated'));
elseif(prms('aupdate'))$r[]=btn('txtx',helps('updateno'));
elseif($localver==$distver)$r[]=btn('txtcadr',helps('update_ok'));
elseif($localver<$distver)$r[]=lj('popsav','upd_software,call',pictxt('update',nms(59)));
$r[]=helps('softwarever').': '.$localver;
$r[]=helps('softwaredist').': '.$distver;
//$r[]=helps('lastupdate').$date;
//$r[]='diff date: '.round($distver-$localver,4);
$r[]=self::patch();
foreach($r as $k=>$v)$ret.=divc('',$v);
return $ret;}

static function dirs(){return ['progb','prog','plug','msql/system','msql/server','msql/lang','msql/design','msql/users','js','css','fonts','gdf','json/system','imgb/icons','imgb/avatar','imgb/usr','pub'];}
static function files(){
return ['ajax.php','app.php','call.php','index.php','plug.php','install.php'];}

static function exceptions($dr,$f){$no=0;
if($dr=='msql/design' or $dr=='msql/users')if(strpos($f,$dr.'/public')===false)$no=1;
if($dr=='css')if(strpos($f,$dr.'/_')===false && strpos($f,$dr.'/public')===false)$no=1;
if(strpos($f,'_sav'))$no=1;
return $no;}

static function datas($dr,$k,$f){$no=self::exceptions($dr,$f);
if(!$no)return [$f,ftime($f)];}//,fsize($f)

static function recense($dr){$r=scandir_r($dr); $rb=[];
foreach($r as $k=>$v)if(!self::exceptions($dr,$v))$rb[$v]=ftime($v); return $rb;}

static function build($p=''){$rb=[];
$r=self::files(); foreach($r as $k=>$v)$rb[$v]=$rb[$v]=ftime($v);
$r=self::dirs(); foreach($r as $k=>$v)$rb+=self::recense($v);
if($p==2)$ra=json::read('srv','software');
json::write('srv','software',$rb);
if($p==1){header('Content-Type: text/json');
	return json::brut('srv','software');}
if($p==2){
	tar::files('_backup/philum.tar.gz',array_keys($rb));//phar
	return array_diff($ra,$rb);}
return $rb;}

static function compare($ra,$rb){$rc=[]; $rd=[]; $re=[];
foreach($ra as $k=>$v)if(!isset($rb[$k]))$re[]=$k;//del
foreach($rb as $k=>$v)if(!isset($ra[$k]))$rd[]=$k;//new
foreach($ra as $k=>$v)if(isset($rb[$k]) && $v<$rb[$k])$rc[]=$k;//update
return [$rc,$rd,$re];}

static function archive($u){//u:calling server
$f=http($u).'/'.json::url('srv','upd');
$d=file_get_contents($f);
$r=json_decode($d,true);
if($r)$r=array_merge($r[0],$r[1]);
$f='_backup/upd.tar.gz';//work file
return tar::files($f,$r);}

static function call($p=''){$ret=''; $rb=[]; $rc=[];
$ra=self::build();//local files
//if(prms('aupdate'))return;
$f=upsrv().'/call/software,build/1';
$d=file_get_contents($f);
if($d)$rb=json_decode($d,true);//dist files
if($rb)$rc=self::compare($ra,$rb);
if($rc)foreach($rc[2] as $k=>$v)unlink($v);//old files
json::write('srv','upd',$rc);//needed files
$f=upsrv().'/call/software,archive/'.nohttp(host());//distant will build archive
$fa=file_get_contents($f); $fb='_backup/upd.tar.gz'; copy(upsrv().'/'.$fa,$fb);
tar::untar($fb,'');//install files
return divd('updb',self::state($p).self::rapport($rc).self::tabler($rc));}

static function home($p){//autoload
$bt=msqbt('system','program_updates_'.date('ym'));
$bt.=lj('txtx','upd_software,state',pictxt('update','update'));
$bt.=lj('txtx','upd_software,details',pictxt('elements',helps('updatedetails')));
$bt.=lj('txtx','upd_software,notes',pictxt('txt',helps('updatenotes')));
if(auth(7))$bt.=lj('txtx','upd_dev2prod,call',pictxt('upload','push'));
if(auth(7))$bt.=lj('txtx','upd_pubdate,call',pictxt('export','publish site'));
if($p)$ret=self::call($p); else $ret=self::state();
return $bt.divd('upd',$ret);}
}
?>