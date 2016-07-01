<?php
//philum_plugin_msqedit

function msqdt_sav($p,$o,$res){$r=ajxr($res);
msql_modif('',ses('msqdt'),$r,'','push','');
return msqdt_build($p,$o);}

function msqdt_add($p,$o){$r=explode(',',$o); $j='editmsql_plug__x_msqedit_msqdt*sav_';
foreach($r as $k=>$v){$id='inp'.$v; $ids[]=$id; $ret.=$v.' '.input(1,$id,'','').br();}
$ret.=lj('',$j.ajx($p).'__'.implode('|',$ids),pictxt('save'));
return $ret;}

function msqdt_build($p,$o){req('msql');
$ra['_menus_']=explode(',',$o);
$r=msql_read_b('',ses('msqdt'),'','',$ra);
$murl=sesm('murl',murl('users','',ses('qb'),$p,''));
if($r)return draw_table($r,$murl,'');}

function msqdt_herit_overmenus($p,$o){
$r=sql('msg','qdd','rv','val="surcat"');
if($r)foreach($r as $k=>$v){
	list($over,$cat)=split_right('/',$v,1);
	//root,action,type,button,icon,auth
	$ra[]=array('Sections/'.$over,'/cat/'.$cat,'',$cat,'url','');}
msql_modif('',ses('msqdt'),$ra,'','add','');
return msqdt_build($p,$o);;}

function msqedit($p,$o){
$bt=lj('','popup_plup___msqedit_msqdt*add_'.ajx($p).'_'.$o,pictxt('add')).' ';
$bt.=lj('','editmsql_plug__15_msqedit_msqdt*build_'.ajx($p).'_'.$o,pictxt('refresh')).' ';
//$bt.=lj('txtx','editmsql_plug___msqedit_msqdt*herit*overmenus_'.ajx($p),'herit overmenus');
$bt.=msqlink('',ses('qb').'_'.$p);
$_SESSION['popm']=$bt;
return $bt.divd('editmsql',msqdt_build($p,$o));}

function plug_msqedit($p,$o){
ses('msqdt',ses('qb').'_'.$p);
$bt=msqedit($p,$o);
//$bt.=msqlink('',nod($p));
return $bt.$ret;}

?>