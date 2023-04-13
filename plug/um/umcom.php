<?php //umcom
class umcom{
static $conn=1;

static function bt($p,$o){
if($o==1)$o=is_numeric($p)?ma::suj_of_id($p):$p;//p§o
return lj('','popup_umrec,home___'.$p,pictxt('cube',$o));}

static function call($p,$o,$prm=[]){$p=$prm[0]??$p;
if($p=='last')$p=umrec::req_last('All');
if(!is_numeric($p))$p=ma::id_of_urlsuj('['.$p.']');
//$_SESSION['memcom'][$p]+=1;
if(!$p)return 'nothing';
if(!rstr(8))$com='com2'; else $com='com';
if($o)return self::bt($p,$o);
$ret=umrec::call($p,$o,$com); $ret=delbr($ret);
if(!rstr(8))return tagb('blockquote',$ret);
$bt=divc('right',lkt('','/app/umcom/'.$p,picto('chain')));
return tagb('blockquote',divd('umrec'.$p,$ret));}//$bt.

static function menu($p,$o,$rid){
$j=$rid.'_umcom,call_inp';
$ret=inputj('inp',$p,$j).' ';
$ret.=lj('',$j,picto('ok'));
return divc('',$ret).br();}

static function home($p,$o){
//if(strpos($p,'§'))[$p,$t]=explode('§',$p); else $t='';
//ummo_aliens_4
if(strpos($p,'_')){$ret=''; $r=msql::col('',$p,0);
	foreach($r as $k=>$v)if($v)$ret.=self::home($v,$o); return $ret;}
if(strpos($p,',')){$ret=''; $r=explode(',',$p);
	foreach($r as $k=>$v)$ret.=self::home($v,$o); return $ret;}
if($p=='last')$p=umrec::req_last('All');
if(!is_numeric($p) && $p && !$o)$p=ma::id_of_urlsuj('['.$p.']');
//if(!$p)$p=ses('read');
$rid='umcom'.$p; $bt=''; $ret='';
if(!$p)$bt=self::menu($p,$o,$rid);
//elseif($t)return lj('','popup_umcom,home___'.ajx($p),$t);
elseif($o)return self::bt($p,$o);
else $ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>