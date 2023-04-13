<?php 
class umnum{
static function search($p,$o,$prm=[]){
$d=sql('msg','qdm','v','id='.$p); $rt=[]; $i=0;
$r=str_split($d);
foreach($r as $k=>$v){
	if(is_numeric($v))$rt[$i].=$v;
	else $i++;}
return tabler($rt);}

static function build($p,$o){
$r=msql::row('',nod('umnum'),$p,1);
return tabler($r);}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$j=$rid.'_umnum,call_inp';
$ret=inputj('inp',$p,$j).' ';
$ret.=lj('',$j,picto('ok')).' ';
$ret.=lj('','popup_msqedit,call___umnum*1_num,val,art',picto('edit')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid); $ret='';
//$ret=self::build($p,$o);
$bt.=msqbt('',nod('umnum'));
return $bt.divd($rid,$ret);}
}
?>