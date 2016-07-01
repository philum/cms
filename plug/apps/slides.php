<?php
//philum_plugin_slides

class slides{

static function draw($r){
foreach($r as $k=>$v){if($v['txt'])$ret.=li($k.') '.stripslashes_b($v['txt']));
	if($v['r'])$ret.=ul(self::draw($v['r']));}
return ul($ret);}

//nb_pages_j($r,$jx,$n)
static function slide($r,$p,$rid){
$j=$rid.'_class___slides_j_'; $v=$r[$p];
if($r[$p-1])$bt1=lj('',$j.($p-1).'_'.$rid.'_inp',pictxt('left',($p-1))).' ';
if($r[$p+1])$bt2=lj('',$j.($p+1).'_'.$rid.'_inp',pictxt('right',($p+1))).' ';
$bt=divc('',$bt1.$bt2);
$ret=nl2br(stripslashes_b($v[0]));
$cell=div(ats('margin:auto;'),$ret);
$ret=$bt.div(atc('book').ats('display:flex; min-height:300px; width:94%;'),$cell);
return $ret;}

static function build($p,$rid){if(!$p)$p=1;
$r=msql_read_b('',ses('nodslid'),'',1);
if($r)$ret=self::slide($r,$p,$rid);
$bt=self::menu($p,$o,$rid);
return $bt.$ret;}

static function j($p,$o,$res=''){
//list($p,$o)=ajxp($res,$p?$p:1,$o);
if(!$p)$p=ajxg($res);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$ret=inp('inp',$p?$p:1).' ';
$ret.=lj('',$rid.'_app___slides_j__'.$rid.'_inp',picto('reload')).' ';
if(auth(6)){
	$ret.=lj('','popup_plupin___msqedit_slides*'.$p.'_val',picto('edit')).' ';
	$j='popup_msqledit___users_'.ajx(ses('nodslid')).'_';
	$ret.=lj('',$j.$p.'_1',picto('editxt')).' ';
	$ret.=lj('','popup_plup___msqedit_msqdt*add_slides*'.$p.'_val',picto('add')).' ';}
return divc('',$ret);}

}

function plug_slides($p,$o){$rid=randid('tpo'); $p=$p?$p:1;
$_SESSION['nodslid']=nod('slides_'.$p);
Head::add('csscode','.book a, .book:hover .philum{color:white;}');
$ret=slides::build($o,$rid);
return divd($rid,delbr($ret,"\n"));}

?>