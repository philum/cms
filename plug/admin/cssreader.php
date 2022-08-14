<?php
class cssreader{
static function pic($d){return '<span title="'.$d.'" class="philum ic-'.$d.'"></span>';}

static function home(){
$d=file_get_contents('css/_pictos.css');
$r=explode("\n",$d); $ret='';
if($r)foreach($r as $v)if(substr($v,0,1)=='.')$rb[]=substr($v,4,strpos($v,':')-4);
if($rb)foreach($rb as $v)$ret.=self::pic($v);
return $ret;}
}
echo cssreader::home();
?>