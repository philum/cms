<?php //countfiles
class countfiles{
static $conn=1;

static function call($d,$k,$f,$n){//dir,key,file,topology
if($v)return $d.'/'.$f; else return $d;}

static function home($d){$r=explore($d,'files',1);
if($r)foreach($r as $k=>$v){if(is_array($v))$ret+=count($v); else $ret+=1;}
return $ret;}
}
?>