<?php 

class proposal{

static function valid($p){$r=str_split(md5($p)); $n=0; $rb=[];
//$ra=array_flip(str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxwz0123456789'));
if($r)foreach($r as $k=>$v)if(is_numeric($v) && count($rb)<7)$rb[]=$v; return implode('',$rb);}

static function del($p,$o){
if(!auth(6))return;
$b='proposal'; $nod=nod($b); $nodb=nod($b.'_'.$p);
unlink(msql::url('',$nodb));
msql::modif('',$nod,$p,'del');
return self::stream($p,$o);}

static function delok($p,$o){
return lj('popdel',$o.'_proposal,del__3_'.$p.'_'.$o,pictxt('alert','delete all!?'));}

static function rm($p,$o){
[$rid,$k]=explode('-',$o);
$nod=nod('proposal_'.$p);
msql::modif('',$nod,$k,'del');
return self::call($p,$rid);}

static function id($p){$nod=nod('proposal');
$r=msql::read_b('',$nod,'',1,['usr','tit','day']);
if($r)$k=in_array_r($r,$p,1);
if(!$k)$r=msql::push('',$nod,[cookie('use'),$p,date('ymd')]);
if($r)$k=in_array_r($r,$p,1);
return $k;}

static function t($k){$nod=nod('proposal');
if($k)$r=msql::read_b('',$nod,$k);
if(isset($r))return $r[1]??'';}

static function save($p,$o,$res){
[$txt,$usr]=ajxr($res);
cookie('use',$usr);
$nod=nod('proposal_'.$p);
if($p && $usr && $txt)msql::push('',$nod,[$usr,$txt,date('ymd')]);
elseif(!$usr)return 'usr?'; elseif(!$txt)return 'txt?';
return self::call($p,$o);}

static function build($p,$o,$ord,$r){$ret=''; $rt=[]; $rb=[]; $rc=[];
$j=$o.'_proposal,save__3_'.$p.'_'.$o.'_inp1|inp2';
$usr=cookie('use'); if(!$usr)$usr=ses('USE'); $day=date('ymd'); //$usr='dav';
$ret=lj('popbt '.active($ord,1),$o.'_proposal,call__3_'.$p.'_'.$o.';1','score');
$ret.=lj('popbt '.active($ord,2),$o.'_proposal,call__3_'.$p.'_'.$o.';2','date');
$inp2=!$usr||auth(6)?inputj('inp2',$usr,$j,'user',8):hidden('inp2',$usr).btn('txtx',$usr);
$ret.=inputj('inp1','',$j,'msg',48).$inp2.lj('popbt',$j,picto('save'));
if(auth(6))$ret.=lj('',$o.'_proposal,delok__3_'.$p.'_'.$o,picto('del'));
if(auth(6))$ret.=msqbt('',nod('proposal_'.$p)); $ret.=hlpbt('purpose');
$rf=sql('ib,poll','qdf','v',['type'=>'agree','iq'=>ses('iq')]);
if($r)foreach($r as $k=>$v){$id=self::valid($p.$v[1]); $edt=art::favs_edt($id,'agree',$rf[$id]??''); $del='';
	if($v[0]==$usr && $v[2]==$day)$del=lj('',$o.'_proposal,rm__3_'.$p.'_'.$o.'-'.$k,picto('del'));
	if(!empty($v[3]))$del.=' '.picto('valid');
	if($ord==2)$rb[$k]=$v[2];
	else $rb[$k]=sql('count(id)','qdf','v','ib="'.$id.'" and type="agree"');
	$tit='#'.$k.' '.$v[0].' ('.$v[2].')';
	$rc[]=['tit'=>$tit,'edt'=>$edt,'del'=>$del,'txt'=>$v[1],'id'=>$k];
	$rt[$k]=divc('track',btn('popbt',$tit.' '.$edt.' '.$del).divc('panel',$v[1]));}
if($rb){arsort($rb); foreach($rb as $k=>$v)$ret.=$rt[$k];}
//$tmp='[[[_tit _edt _del§popbt:spanc]:div]_txt§[track:class][_id:id]:div]';
$tmp='[[[{tit} {edt} {del}§popbt:spanc]:div]{txt}§[track:class][{id}:id]:div]';
//return vue::call($tmp,$rc);
return $ret;}

static function call($p,$o){$ord='';
if(strpos($o,';')){$ro=explode(';',$o); $o=$ro[0]; $ord=$ro[1];}
$bt=lj('',$o.'_proposal,call___'.$p.'_'.$o,self::t($p));
if(auth(4))$bt.=lj('',$o.'_proposal,home____'.$o,picto('back'));
$ret=divc('txtcadr',$bt);
if($p)$r=msql::read('',nod('proposal_'.$p),'',1,['name','txt','date']);//p($r);
//if($ord==2)$r=msql::order($r,2);
$ret.=self::build($p,$o,$ord,$r);
return $ret;}

static function add($p,$o,$prm=[]){$p=$prm[0]??$p;
$b='proposal'; $nod=nod($b);
$id=self::id($p);
$nodb=nod($b.'_'.$id);
if($p && !$id)msql::push('',$nod,[cookie('use'),$p,date('ymd'),'']);
return self::call(self::id($p),$o);}

static function menu($p,$rid){
$b='proposal'; $nod=nod($b); $rt=[];
$ret=msqbt('',$nod);
$ret.=input('inp',$p);
$ret.=lj('popbt',$rid.'_proposal,add_inp_3__'.$rid,pictxt('add','new job'));
$ret.=lj('popbt',$rid.'_proposal,stream____'.$rid,picto('menu'));
return div('',$ret);}

static function stream($p,$rid){
$b='proposal'; $nod=nod($b); $rt=[];
$r=msql::read_b('',$nod,'',1,['usr','tit','day']);
if($r)foreach($r as $k=>$v)$rt[]=lj('popbt',$rid.'_proposal,call___'.$k.'_'.$rid,$v[1]);
if($rt)return divc('list',implode($rt));}

static function home($p,$o){
$rid=$o?$o:randid('purp'); $bt=''; $ret='';
if(!$p && !$o)$bt=self::menu($p,$rid);
if($p)$ret=self::call(self::id($p),$rid);
else $ret=self::stream($p,$rid);
return $bt.divd($rid,$ret);}

}

?>