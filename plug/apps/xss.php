<?php //xss
class xss{
static $dfb=['url','channel','title','link','descr','img','author','date','content','footer','opt','utf','rules'];

static function find($q,$ra){
$r=$q->getElementsByTagName($ra[2]);
if(!$ra[1])return $r->nodeValue;
foreach($r as $k=>$v){
	$mark=domattr($v,$ra[1]);
	if(!$ra[0])return $mark;
	if($mark==$ra[0])return $ra[1]?domattr($v,$ra[1]):$v->firstChild->nodeValue;}}

static function elements($q,$va){$vr=[];
$r=$q->getElementsByTagName($va[2]);
if($r)foreach($r as $k=>$v){$mark=domattr($v,$va[1]); if($mark==$va[0] or !$va[0])$vr[]=$v;}
return $vr;}

static function build($p,$o){$ret=''; 
$nod=nod('xss'); $r=msql::row('',$nod,$p,1); //pr($r);
$pb=http($r['url']); $q=fdom($pb,1); $vr=[]; $rb=[]; $ra=[];
if($r)foreach(self::$dfb as $k=>$v)if($v){$rz=opt($r[$v],':',4);
	if(!$rz[1])$rz[1]='class'; if(!$rz[2])$rz[2]='div'; $ra[$v]=$rz;} //pr($ra);
//if($ra)$vr=self::elements($q,$ra['channel']); //pr($vr);
if($ra)$vr=$q->getElementsByTagName($ra['channel'][2]); //pr($vr);
if($vr)foreach($vr as $k=>$v){
	foreach($r as $ka=>$va){//pr($v);
		//$rb[$k][$ka]=utf8dec_b(utf8dec_b(self::find($v,$va)));
		$rb[$k][$ka]=$va?dom::extract($v,$va):'';}} //pr($rb);
if($rb)foreach($rb as $k=>$v)if($v['title']){$rt='';
	//foreach($v as $ka=>$va)$rt.=tagb($ka,$va);
	//$ret.=tagb('channel',$rt); $rt='';
	$ret.=lj('','popup_sav,batchpreview__3_'.ajx($v['link']),pictxt('view',$v['title'])).br();
	$ret.=tagb('section',img($v['img']).$v['descr']);}
return $ret;}

static function bt($p,$o){
$nod=nod('xss'); $jurl=ajx('users/'.$nod); $pb=http($p);
$bt=lj('popbt','popup_editmsql___'.$jurl.'_'.ajx($p),picto('config'));
$bt.=lj('popbt','popup_few,seesrc___'.ajx($pb),picto('script'));
$bt.=lka($pb,picto('url'));
return divc('',$bt);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
//$r=msql::read('',nod('xss'),$p);
$u=msql::val('',nod('xss'),$p,0);
$u=nohttp($u); if(substr($u,-1)=='/')$u=substr($u,0,-1);
$ret=self::build($p,$o);
$bt=self::bt($u,$o);
return $bt.$ret;}

static function xssr(){
$r=msql::read('',nod('xss'),'',1);
if(!$r)$r=msql::save('',nod('xss'),[['','','','','','','','','','','','','']],self::$dfb);
foreach($r as $k=>$v)$rb[$k]=$v[0];
return $rb;}

static function menu($p,$o,$rid){
//$ret=select_j('inp','pclass','','xss/xssr','','2');
//$ret.=input('inp',$p).' ';
$r=self::xssr(); $ret='';
if($r)foreach($r as $k=>$v)
$ret.=lj('',$rid.'_xss,call__3_'.$k,$v).' ';
return divc('list',$ret);}

static function install($b){
ses($b,qd($b));//name of table
$r=['site'=>'var','tit'=>'var','img'=>'var','descr'=>'var','content'=>'var','footer'=>'var','day'=>'int'];
sqlop::install($b,$r,0);}

static function sav($r=[]){
return msql::modif('',nod('xss'),$r,'push',self::$dfb);}

static function home($p,$o){$rid=randid('xss');
//self::install('xss');
$bt=self::menu($p,$o,$rid);
//$ret=self::build($p,$o);
$bt.=msqbt('',nod('xss'));
return $bt.divd($rid,'');}
}
?>