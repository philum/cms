<?php 
class msqedit{//used by configmod

static function save($p,$o,$res){$r=ajxr($res);
msql::modif('',nod($p),$r,'push','','');
return self::build($p,$o);}

static function add($p,$o){
$r=explode(',',$o); $ret=''; $j='editmsql_msqedit,save__x_';
foreach($r as $k=>$v){$id='inp'.$v; $ids[]=$id; $ret.=$v.' '.input($id,'','').br();}
$ret.=lj('',$j.ajx($p).'__'.implode('|',$ids),pictxt('save2'));
return $ret;}

static function build($p,$o){
$rh=explode(',',$o);
$r=msql::read('',nod($p),'','',$rh);
$murl=msqa::sesm('murl',msqa::murl('users','',ses('qb'),$p,''));
if($r)return msqa::draw_table($r,$murl,'');}

static function herit($p,$o){
$r=sql('msg','qdd','rv',['val'=>'surcat']);
if($r)foreach($r as $k=>$v){
	[$over,$cat]=split_right('/',$v,1);
	//root,action,type,button,icon,auth
	$ra[]=['Sections/'.$over,'/cat/'.$cat,'',$cat,'url',''];}
msql::modif('',nod($p),$ra,'add','','');
return self::build($p,$o);}

static function call($p,$o){
$bt=lj('','popup_msqedit,add___'.ajx($p).'_'.$o,pictxt('add')).' ';
$bt.=lj('','editmsql_msqedit,build__15_'.ajx($p).'_'.$o,pictxt('refresh')).' ';
//$bt.=lj('txtx','editmsql_msqedit,call___herit_'.ajx($p),'herit overmenus');
$bt.=msqbt('',nod($p)); ses::$r['popm']=$bt;
return $bt.divd('editmsql',self::build($p,$o));}

static function home($p,$o){return self::call($p,$o);}
}
?>