<?php
//philum_app_msqedit

class msqedit{

static function save($p,$o,$res){$r=ajxr($res);
msql::modif('',nod($p),$r,'push','','');
return self::build($p,$o);}

static function add($p,$o){
$r=explode(',',$o); $ret=''; $j='editmsql_msqedit,save__x_';
foreach($r as $k=>$v){$id='inp'.$v; $ids[]=$id; $ret.=$v.' '.input1($id,'','').br();}
$ret.=lj('',$j.ajx($p).'__'.implode('|',$ids),pictxt('save2'));
return $ret;}

static function build($p,$o){req('msql');
$ra['_menus_']=explode(',',$o);
$r=msql::read('',nod($p),'','',$ra);
$murl=sesm('murl',murl('users','',ses('qb'),$p,''));
if(count($r)>1)return draw_table($r,$murl,'');}

static function herit($p,$o){
$r=sql('msg','qdd','rv','val="surcat"');
if($r)foreach($r as $k=>$v){
	list($over,$cat)=split_right('/',$v,1);
	//root,action,type,button,icon,auth
	$ra[]=array('Sections/'.$over,'/cat/'.$cat,'',$cat,'url','');}
msql::modif('',nod($p),$ra,'add','','');
return self::build($p,$o);}

static function call($p,$o){
$bt=lj('','popup_msqedit,add___'.ajx($p).'_'.$o,pictxt('add')).' ';
$bt.=lj('','editmsql_msqedit,build__15_'.ajx($p).'_'.$o,pictxt('refresh')).' ';
//$bt.=lj('txtx','editmsql_msqedit,herit___'.ajx($p),'herit overmenus');
$bt.=msqbt('',nod($p));
$_SESSION['popm']=$bt;
return $bt.divd('editmsql',self::build($p,$o));}
}

function plug_msqedit($p,$o){
return msqedit::call($p,$o);}

?>