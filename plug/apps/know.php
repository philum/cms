<?php //know
class know{

static function build($p,$o){
//$r=msql::read_b('',nod('know_1'));//p($r);
$ret=$p.'-'.$o;
return $ret;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$$p;
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_know,call_inp',picto('ok')).' ';
//create table, name cols
$ret.=lj('','popup_msqedit,call__nfo,ref,url_know*1',picto('edit')).' ';
return $ret;}

static function home($p,$o){$rid=randid('know');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
$bt.=msqbt('',nod('know_1'));
return $bt.divd($rid,$ret);}
}
?>