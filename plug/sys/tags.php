<?php //see_tags
class tags{
static function fthemb($req){
while([$suj]=sql::qrw($req)){
$unkill=explode(',',$suj);
foreach($unkill as $vbl){$su=trim($vbl);
if($su)$ret[$su]+=1;}}
if($ret)ksort($ret);
return $ret;}

static function tglist($r,$p){$ret=''; if($r)arsort($r);
if($r)foreach($r as $k=>$v)$ret.=lkc('',htac($p).$k,$k.' ('.$v.')');
return divc('list',$ret);}

static function call($p,$o,$rid){
if(substr($p,-1)=='/')$p=substr($p,0,-1); $rb=[]; $nbj=365;
if($p=='sources'){$r=sql('mail','qda','k','');
	foreach($r as $k=>$v){if($k!='mail' && trim($k)){$d=preplink($k); $rb[$d]=radd($rb,$d);}}}
else{$p=$p?$p:'tag'; $rb=$r=ma::tags_list_nb($p,$nbj);}
if($o)$ret=md::tags_cloud($p,12,27,$rb);
else $ret=self::tglist($rb,$p);
if($o)$t=pictxt('descending',nms(178)); else $t=pictxt('numlist',nms(156));
$bt=lj('',$rid.'_tags,call__3_'.$p.'_'.($o?'':'1').'_'.$rid,$t);
return divc('txtcadr',count($rb).' '.$p.' ('.$nbj.' '.nms(4).')').$bt.br().$ret;}

static function home($p,$o){
$rid=randid('tags');
$ret=self::call($p,$o,$rid);
return divd($rid,$ret);}
}
?>