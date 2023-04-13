<?php //slides

class slides{

static function draw($r){
foreach($r as $k=>$v){if($v['txt'])$ret.=li($k.') '.stripslashes_b($v['txt']));
	if($v['r'])$ret.=ul(self::draw($v['r']));}
return ul($ret);}

//nb_pages_j($r,$jx,$n)
static function slide($r,$p,$rid){
$j=$rid.'_slides,call_inp__'; $v=$r[$p]??'';
if(isset($r[$p-1]))$bt1=lj('',$j.($p-1).'_'.$rid,pictxt('before',($p-1))).' ';
else $bt1=btn('grey',picto('before'));
if(isset($r[$p+1]))$bt2=lj('',$j.($p+1).'_'.$rid,pictxt('after',($p+1))).' ';
else $bt2=btn('grey',picto('after'));
$bt=divc('',$bt1.$bt2);
$ret=nl2br(stripslashes_b($v[0]??''));
$cell=div(ats('margin:auto;'),$ret);
$ret=$bt.div(atc('book').ats('display:flex; min-height:300px; width:94%;'),$cell);
return $ret;}

static function build($p,$rid){if(!$p)$p=1;
$r=msql::read_b('',nod(ses('nodslid')),'',1,['val']);
$ret=self::slide($r,$p,$rid);
$bt=self::menu($p,'',$rid);
return $bt.$ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p?$p:1).' '; $nod=ses('nodslid');
$ret.=lj('',$rid.'_slides,call_inp___'.$rid,picto('ok')).' ';
if(auth(6)){
	$ret.=lj('','popup_msqedit,'.ajx($nod).'___val',picto('edit')).' ';
	$ret.=lj('','popup_msqledit___users/'.ajx(nod($nod)).'_'.$p.'_0',picto('editxt')).' ';
	$ret.=lj('','popup_msqedit,msqdt*add___'.ajx($nod).'_val',picto('add')).' ';}
$ret.=msqbt('',$nod);
return divc('',$ret);}

static function home($p,$o){$rid=randid('tpo'); $p=$p?$p:1;
$_SESSION['nodslid']='slides_'.$p;
Head::add('csscode','.book a, .book:hover .philum{color:white;}');
$ret=self::build($o,$rid);
return divd($rid,delbr($ret,"\n"));}
}
?>