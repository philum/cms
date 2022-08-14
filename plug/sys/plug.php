<?php //plug
class plug{
static function slct(){
$r=msql_read('system','program_plugs','',1);//ksort($r);
foreach($r as $k=>$v){
	if($v[2]=='1' && !$v[3] && !$v[5] && $v[1])$rb=trimr(str_replace(' ',',',$v[1]));
	if($rb)foreach($rb as $kb=>$vb)$ret[$vb][]=lkc('','/plug/'.$k,$k);}
return divc('',make_tabs($ret));}//onxcols($ret,6,'')

static function call($p,$o,$prm=[]){
[$d,$p,$o]=prmp($prm,$p,$o);
if(method_exists($d,'home'))$ret=$d::home($p,$o);
else $ret=plugin($d,$p,$o);
return $ret;}

static function home($plg,$p,$o=''){$rid=randid('plg');
$ret=select_j('plugin','plug','','','','2').' ';
$j=$rid.'_plug,call_plugin,plugp,plugo';
$ret.=inputj('plugin',$plg,$j,'plugin').' ';
$ret.=lj('',$j,picto('ok'));
$ret.=input1('plugp',$p?$p:'param','','',1).' ';
$ret.=input1('plugo',$o?$o:'option','','',1).' ';
return $ret.divd($rid,plugin($plg,$p,$o));}
}
?>