<?php //umespdf
class umespdf{

static function dlscans(){
$u='https://www.ummo-sciences.org/es/scan/';
//$r=scandir_r($u); pr($r);
$dr='_users/ummo/origin/';
/*$ftp_user_name='ummo'; $ftp_user_pass=''; $r=[];
$ftp=ftp_connect('ummo-sciences.org');
$res=ftp_login($ftp,$ftp_user_name,$ftp_user_pass);
if($ftp)$r=ftp_nlist($ftp,$u);
if($r)foreach($r as $v)if($v!='.' && $v!='..'){$f=$dr.$v; $fa=$u.'/'.$v;
$dl=ftp_get($ftp,$f,$fa,FTP_ASCII);}*/

$r=msql::read('','ummo_es_4');
foreach($r as $k=>$v)$rb[]=between($v[1],'[','§',0,1);
foreach($rb as $k=>$v)if(substr($v,-3)=='pdf')$rc[]=$v;
//pr($rc);
$dr='users/ummo/origin/';
foreach($rc as $k=>$f){
echo $fb=strend($f,'scan-');
//copy($f,$dr.$fb);
$rt[]=$fb;
}
pr($rt);
//msql::save('','ummo_es_5',$rt);

}

static function call($p,$o){
//if($o=='dlscans')return self::dlscans();
$id=$p?$p:ses('read');
$d=sql('suj','qda','v','id='.$id);
$vrf=between($d,'[',']'); $ret='';
$r=msql::read('',nod('es_3'),'');
$r=msql::tri($r,0,$vrf); if($r)$r=current($r);
if(!isset($r[0]))return;
if(!empty($r[1])){
	if(strpos($r[1],"\n")){$rb=explode("\n",$r[1]);
		foreach($rb as $k=>$v)if($v)$ret.=lj('','popup_iframe___'.ajx($v),pictxt('pdf','original')).' ';}
	else $ret.=lj('','popup_usg,iframe___'.ajx($r[1]),pictxt('pdf','original')).' ';}
if(!empty($r[2]))$ret.=lkt('',$r[2],flag('es').'['.$vrf.']');
//if($r[1])$ret.=lkt('',$r[1],pictxt('pdf','original'));
if($ret)return btn('txtcadr','Original').br().btn('txtx',$ret);}

static function home($p,$o){return self::call($p,$o);}
}
?>