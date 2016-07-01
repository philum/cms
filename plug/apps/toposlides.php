<?php
//philum_plugin_toposlides

class toposlides{

static function displace($r,$a,$b){$add=0;
$rb['_menus_']=array('ib','val','to');
$move=$r[$a]; unset($r[$a]);
foreach($r as $k=>$v){if($k==$b){$rb[$k]=$move; $add=1;}
	if($k>=$a){$add=0; $v[0]=$b;}
	if($add && $v[0]>=$b)$v[0]+=1;
	$rb[$k+$add]=$v;}
msql_modif('',ses('topo'),$rb,'','arr','');
return $rb;}

static function draw($r){
foreach($r as $k=>$v){if($v['txt'])$ret.=li($k.') '.stripslashes_b($v['txt']));
	if($v['r'])$ret.=ul(self::draw($v['r']));}
return ul($ret);}

static function desc($r,$p){
foreach($r as $k=>$v)
	if($v[0]==$p){$ret[$k]['txt']=$v[1]; $ret[$k]['r']=self::desc($r,$k);}
return $ret;}

static function slide($r,$p,$rid){
$j=$rid.'_class___toposlides_j_'; $v=$r[$p];
if($v[0])$bt1=lj('',$j.$v[0].'_'.$rid.'_inp',pictxt('left',$v[0])).' ';//parent
if($v[2])$bt3=lj('',$j.$v[2].'_'.$rid.'_inp',pictxt('down',$v[2])).' ';//end
foreach($r as $ka=>$va){
	if($va[2]==$p)$bt2=lj('',$j.$ka.'_'.$rid.'_inp',pictxt('up',$ka)).' ';//begin
	if($va[0]==$p)$bt4.=lj('',$j.$ka.'_'.$rid.'_inp',pictxt('right',$ka)).' ';}
$bt=divc('',$bt1.$bt2.$bt3.$bt4.$bt0);
//$cell=div(atc('imgl').ats('width:36px'),$bt1.$bt2.$bt3.$bt4);
$ret=nl2br(stripslashes_b($v[1]));
$cell=div(ats('margin:auto;'),$ret);
$ret=$bt.div(atc('book').ats('display:flex; min-height:300px; width:94%;'),$cell);
return $ret;}

static function order($r){
foreach($r as $k=>$v)$rb[$v[0]][]=$k; if($rb)ksort($rb); //p($rb);
foreach($rb as $k=>$v){sort($v); foreach($v as $vb)$rc[$vb]=$r[$vb];} //p($rc);
return $rc;}

static function build0($p,$rid){if(!$p)$p=1;
$r=msql_read_b('',ses('topo'),'',1);
if($r)$r=self::order($r);
if($r)$r=self::desc($r,$p);
if($r)$ret=self::draw($r);
return $ret;}

static function build($p,$rid){if(!$p)$p=1;
$r=msql_read_b('',ses('topo'),'',1);
//if($r)$r=self::displace($r,54,8);
if($r)$ret=self::slide($r,$p,$rid);
$bt=self::menu($p,$o,$rid);
return $bt.$ret;}

static function j($p,$o,$res=''){
//list($p,$o)=ajxp($res,$p?$p:1,$o);
if(!$p)$p=ajxg($res);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$ret=inp('inp',$p?$p:1).' ';
$ret.=lj('',$rid.'_app___toposlides_j__'.$rid.'_inp',picto('reload')).' ';
if(auth(6)){
	$ret.=lj('','popup_plupin___msqedit_toposlides*'.$p.'_ib,val,to',picto('edit')).' ';
	$j='popup_msqledit___users_'.ajx(ses('topo')).'_';
	$ret.=lj('',$j.$p.'_1',picto('editxt')).' ';
	$ret.=lj('','popup_plup___msqedit_msqdt*add_toposlides*'.$p.'_ib,val,to',picto('add')).' ';}
return divc('',$ret);}

}

function plug_toposlides($p,$o){$rid=randid('tpo'); $p=$p?$p:1;
$_SESSION['topo']=nod('toposlides_'.$p);
Head::add('csscode','.book a, .book .philum, .book:hover .philum{color:white;}');
$ret=toposlides::build($o,$rid);
return divd($rid,delbr($ret,"\n"));}

?>