<?php //a/json
class json{
var $dr,$nod,$f,$r;

static function nod($d){return 'usr/'.ses('qb').'/'.$d;}
static function url($dr,$nod){
$dr=$dr=='lang'?$dr.'/'.prmb(25):$dr; $dr=$dr?$dr:'usr';
return root('json/').$dr.'/'.$nod.'.json';}
static function init($f){$dr=struntil($f,'/');
if(!is_dir($dr))mkdir_r($dr); if(!is_file($f))file_put_contents($f,'');}

static function read($dr,$nod){$f=self::url($dr,$nod);
return is_file($f)?json_decode(file_get_contents($f),true):[];}
static function write($dr,$nod,$r){$f=self::url($dr,$nod); self::init($f);
file_put_contents($f,mkjson($r)); return $f;}
static function brut($dr,$nod){$f=self::url($dr,$nod); self::init($f);
return file_get_contents($f);}

static function add($dr,$nod,$row){$r=self::read($dr,$nod); $r[]=$row;
self::write($dr,$nod,$r); return $r;}
static function rm($dr,$nod,$k){$r=self::read($dr,$nod);
if(isset($r[$k]))unset($r[$k]); self::write($dr,$nod,$r); return $r;}
static function bk($dr,$nod){$r=self::read($dr,$nod); self::write($dr,$nod.'.bak',$r); return $r;}
static function rn($dr,$nod){$r=self::read($dr,$nod.'.bak'); self::write($dr,$nod,$r); return $r;}
static function del($dr,$nod){$f=self::url($dr,$nod); unlink($f);}

function see($dr,$nod){$r=self::read($dr,$nod); return tabler($r);}
function bt($dr,$nod){return lj('','popup_json,see__2_'.ajx($dr).'_'.ajx($nod),picto('see'));}
function adder($dr,$nod){$rid=randid('inp'); return input($rid,'').lj('',$rid.'_db,add__2_'.ajx($dr).'_'.ajx($nod).'___'.$rid,picto('add'));}
}
?>