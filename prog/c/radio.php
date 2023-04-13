<?php 

class radio{
static $a=__CLASS__;
static $default='';

static function r($r){$ret='';
foreach($r as $k=>$v){
if(is_array($v)){$rt=self::r($v); if($rt)$ret.=tagc('ul','pubart',$rt);}
elseif($v)$ret.=llj('popbt','popup_radio,edit__x__'.ajx($v).'',$v);}
return $ret;}

static function funcradio($d,$k,$v,$n){//dir,url,file,tnb
if(substr($v,-3)=='mp3' or !$v){$ret=str_replace('users/','',$d); $ret=divd('rd'.$n,$ret);}
return $ret;}

static function select(){
$r=walk_dir('users/'.$_SESSION['qb'],'funcmp3');
if($r)return self::r($r);}

static function build($dr,$nod){$dr='users/'.ajx($dr,1);
$sqdir='msql/radio/'; if(!is_dir($sqdir))mkdir($sqdir);
$nod=nod('radio'.ses('read')); $file=$sqdir.$nod.'.php';
$ret['_menus_']=['prog','file','length','title','txt','img'];
$r=explore($dr);
if($r)foreach($r as $k=>$v){
	$length=round(filesize($dr.'/'.$v)/1024000);
	$ret[$k+1]=['0',$dr.'/'.$v,$length,$v,'',''];}
msql::save('radio',$nod,$ret);
return ljb('popbt','insert','['.$nod.':radio]','insert').' ';}

static function song($d,$p){
return msql::val('radio',$d,$p,1);}

static function play($g1,$g2,$g3){
return audio(self::song($g1,$g2),$g3);}

static function call($d,$p,$id){$ret='';
if(strpos($d,'/'))$nod=nod('radio'.$id); else $nod=$d;
$r=msql::read_b('radio',$nod,'',1); $rid=randid('rad');
if($r)foreach($r as $k=>$v){if($k==$p)$f=$v[1];
	$ret.=lj('',$rid.'_radio,play___'.ajx($nod).'_'.$k,$v[3]).br();}
if(!$r && strpos($d,'/'))$dr=$d; else $dr='';
if(auth(4))$add=lj('','popup_radio,edit___'.$nod.'_'.ajx($dr).'__'.$id,picto('edit'));
return divb(audio($r[1][1],$rid),'nbp',$rid).$add.$ret;}

static function edit($nod,$dr,$md,$id=''){
$id=$id?$id:ses('read'); $ret=''; $edit=''; $datas=[]; $ky='';
$nd='radio'.$id; if(!$nod)$nod=$_SESSION['qb'].'_'.$nd;
$nodb=str_replace('_','*',$nod);
if($dr)$ret.=self::build($dr,$nod);
$r=msql_read('radio',$nod,''); 
$ret.=msqbt('radio',$_SESSION['qb'].'_'.$nd);
if(isset($r[$md])){foreach($r[$md] as $k=>$v){$ky.=$md.'.'.$k.'|';
	$edit.=input($md.'.'.$k,$v).btn('txtsmall',$r['_menus_'][$k]).br();}
	$edit.=lj('popbt','popup_radio,edit___'.$nodb.'__'.$k.'__'.$ky,'save');}
$ret.=divc('edit',$edit);
if($r)foreach($r as $k=>$v){foreach($v as $ka=>$va){$datas[$k][]=$va;}
	if($k!='_menus_' && $k!=$md){$datas[$k][]=lj('popbt','popup_radio,edit___'.$nodb.'__'.$k,'edit');}}
$ret.=divtable($datas);
ses::$r['popt']='build_playlist';
return $ret;}

}
?>