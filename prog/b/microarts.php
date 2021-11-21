<?php
//philum/b/microarts

class microarts{
static $default='';
static $nbp=10;

static function del($p,$o){
$rid='mia'.normalize($p);
if(is_numeric($o))delete('qdi',$o);
else return lj('popdel',$rid.'_microarts,del___'.ajx($p).'_'.substr($o,1),pictxt('del',nms(76).'?'));
return self::call($p,1);}

static function resav($p,$o,$res){
list($msg,$o)=ajxp($res,$p,$o);
if(is_numeric($o))sqlup('qdi',['msg'=>$msg],'id',$o);
return self::call($p,1);}

static function edit($p,$o){$ret='';
$msg=sql('msg','qdi','v','id='.$o); $rid='mia'.normalize($p); $xid=rid($p);
$ret=lj('txtblc',$rid.'_microarts,resav___'.ajx($p).'_'.$o.'___'.$xid,picto('save2'));
$ret.=editarea($xid,$msg,64,8);
return $ret;}

static function save($p,$o,$res=''){$ret='';
list($msg,$o)=ajxp($res,$p,$o); req('tri,pop,art');
$msg=strip_tags($msg); $msg=repair_latin($msg); $msg=embed_links($msg);
$r=[0,ses('USE'),'',date('ymd'),ses('qb'),'microart',$p,$msg,0,ses('iq'),'']; //pr($r);
$nid=insert('qdi',mysqlra($r,1));
return self::call($p,1);}

static function create($p,$o){$ret=''; $rid='mia'.normalize($p);
$ret=lj('',$rid.'_microarts,save__3_'.ajx($p).'____minp',picto('save')).' ';
$ret.=editarea('minp','',64,8);
return $ret;}

static function tmp(){
//return '[[[tit:var]$popbt:spanc] [edt:var] [del:var]:div][[txt:var]$[track:class][[id:var]:id]:div]';
return '[[{tit}§popbt:spanc] {edt} {del}:div][{txt}§[track:class][{id}:id]:div]';
return '[[_tit§popbt:spanc] _edt _del:div][_txt§[track:class][_id:id]:div]';}

static function read($v,$p){$id=$v[0];
if(auth(6)){$del=lj('',$id.'_microarts,del___'.ajx($p).'_x'.$id,picto('del')).btd('x'.$id,'');
	$edt=lj('','popup_microarts,edit___'.ajx($p).'_'.$id,picto('edit'));}
$txt=conn::read($v[2]);
return ['tit'=>$v[1],'del'=>$del,'edt'=>$edt,'txt'=>$txt,'id'=>$id];}

static function one($p,$id){
$r=sql('id,day,msg,name','qdi','','id="'.$id.'"');
$rb[]=read($r,$p); $tmp=self::tmp();
return $bt.vue::call($tmp,$rb);}

static function build($p,$o=1){$rid='mia'.normalize($p);
req('pop,spe'); $ret=''; $edt=''; $del=''; $rb=[]; if(!$o)$o=1;
$r=sql('id,day,msg,name','qdi','','nod="'.ses('qb').'" and frm="microart" and suj="'.$p.'" order by id desc');
if(!$r)return divc('txtred',nms(11).' '.nms(16));
$min=($o-1)*self::$nbp; $max=$o*self::$nbp;
foreach($r as $k=>$v)if($k>=$min && $k<$max)$rb[]=self::read($v,$p);
$tmp=self::tmp();
$bt=btpages(self::$nbp,$o,count($r),$rid.'_microarts,call___'.ajx($p).'_');
return $bt.vue::call($tmp,$rb);}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); $bt=''; $rid='mia'.normalize($p);
//if(strpos($o,';'))list($o,$ord)=opt($o,';',2);
if(auth(6)){$bt=lj('popbt',$rid.'_microarts,nav___',picto('menu'));
	$bt.=lj('popbt','popup_microarts,create__13_'.ajx($p),picto('add'));
	$bt.=lj('popbt',$rid.'_microarts,call___'.ajx($p).'_1',picto('refresh'));}
$ret=self::build($p,$o);
return $bt.$ret;}

static function menu(){
return $r;}

static function nav($p,$o,$rid){
if(!$p)$p=self::$default; //$rid='mia'.normalize($p);
$r=sql('distinct(suj)','qdi','rv','frm="microart" and nod="'.ses('qb').'" order by suj');
$j=$rid.'_microarts,call__3___inp';
//$ret=inputj('inp',$p,$j);
$ret=datalist('inp',$r,$p,16,'',$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='mia'.normalize($p);
$bt=self::nav($p,$o,$rid); if($p)$bt='';
$ret=self::call($p,$o);
return divd($rid,$bt.$ret);}
}

?>