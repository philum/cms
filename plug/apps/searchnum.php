<?php //searchnum
class searchnum{

static function detect_from_art($p){
$d=sql('msg','qdm','v','id='.$p);
$r=str_split($d);
foreach($r as $k=>$v){
	if(is_numeric($vb))$ret[$i].=$vb;
	else $i++;}
return $ret;}

static function detect_num($r){
foreach($r as $k=>$v){
	$rb=str_split($v);
	foreach($rb as $kb=>$vb){
		if(is_numeric($vb))$ret[$k][$i].=$vb;
		else $i++;}}
return $ret;}

static function build($p,$o){
$minid=0; $maxid=ma::lastart(); 
$na=$maxid-$minid; $nb=100; $n=ceil($na/$nb); $n=1;//
//echo 'start:'.$minid.'-end:'.$maxid.'-loops:'.$n.br();
for($i=0;$i<$n;$i++){$min=$minid+$nb*$i; $max=$min+$nb;
	$r=sql('id,msg','qdm','kv','id>'.$min.' and id<='.$max); //p($r);
	$ret=self::detect_num($r);}
return $ret;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$$p;
if($p)$ret=self::detect_from_art($p);
$ret=self::build($p,$o);
pr($ret);
//return tabler($ret);
}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_searchnum,call_inp',picto('ok')).' ';
$ret.=lj('','popup_msqedit,call_id,num,val__searchnum*1',picto('edit'));
return $ret;}

static function home($p,$o){$rid=randid('searchnum');
$bt=self::menu($p,$o,$rid);
//$ret=self::build($p,$o);
//$bt.=msqbt('',nod('searchnum_1'));
return $bt.divd($rid,$ret);}
}
?>