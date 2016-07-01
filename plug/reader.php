<?php
//philum_plugin_reader

function readerurl($a,$b,$f){$f=ajxg($f); req('tri,pop');
if($f)list($suj,$ret,$rec,$defid,$defs)=vacuum($f,'');
$ret=format_txt_r($ret,'3','');
$ret=nl2br(embed_p($ret));
return bal('h2',$suj).$ret;}

function plug_reader($d){
//$ret=input(1,'furl',$d?$d:'Url','');
$ret=autoclic('furl','Url','44','1000" id="furl','');
$ret.=lj('txtbox','ifru_plug___reader_readerurl___furl',"&#9658;");
$ret.=divd('ifru','');
return $ret;}

?>