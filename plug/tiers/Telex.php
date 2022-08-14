<?php
class Telex{

public function __construct($id){
$d=msql::val('',nod('tlex'),$id,1);
$this->oAuth=$d;}

function post($p,$o){
$oAuth=$this->oAuth;
//$f='http://logic.ovh/api.php?app=tlxcall&mth=post&msg='.rawurlencode($p).'&prm=oAuth:'.$oAuth;
$f='http://logic.ovh/api.php?oAuth='.$oAuth.'&msg='.rawurlencode($p);
return file_get_contents($f);}

function read($p,$o){
$f='http://logic.ovh/api/call/tm:'.$p;
$d=file_get_contents($f);
return json_decode($d);}
}
?>