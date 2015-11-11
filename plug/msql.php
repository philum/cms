<?php
//philum_plugin_msql
session_start();
error_reporting(6135);

//class msql
function msq_modif($r,$act,$n,$ra,$nb=''){switch($act){
case('arr'):$r=$ra; break;
case('add'):$r[]=$ra; break;
case('mdf'):$r[$n]=$ra; break;
case('del'):unset($r[$n]); break;
case('mdv'):$r[$n][$nb]=$ra; break;
case('menus'):$r['_menus_']=$ra; break;
case('push'):array_push($r,$ra); break;
case('app'):foreach($ra as $k=>$v){if($n=='mdf')$r[$k]=$v;
	elseif($n=='del')unset($r[$k]); else $r[]=$v;} break;}
if($r[0])$r=msq_reorder($r);
return $r;}

function msq_invert($r){$ra=$r['_menus_']; unset($r['_menus_']);
krsort($r,SORT_NUMERIC); array_unshift($r,$ra); return $r;}

function read_msql($dr,$nod,$p='',$u=''){$f=msq_f($dr,$nod);
if(is_file($f))include($f); if(!$r)return; if($p=='x')unset($r['_menus_']); 
if($p && $r[$p]){if($u=='y')return array_combine_a($r['_menus_'],$r[$p]);
	elseif($u!==0)return $r[$p][$u]; else return $r[$p];}
elseif($p=='k'){foreach($r as $k=>$v)$ret[$k]=stripslashes($v[$u]); return $ret;}
elseif($p=='i')return msq_invert($r); else return $r;}

class msql{var $dr; var $nod; public $f; var $dmp; var $ret;
function __construct($d,$nd){$this->dr=$d; $this->nod=$nd; return $this->f=msq_f($d,$nd);}
function def($d,$nd){$this->dr=$d; $this->nod=ses('qb').'_'.$nd; $this->f=msq_f($d,$this->nod);}
function dump($r){$this->dmp=dump($r,$this->nod);}
function format(){$this->ret=msq_format($this->ret);}
function load($h=''){if(is_file($this->f))require($this->f); return $this->ret=$r;}
function read($p='',$u='',$ra=''){$this->ret=read_msql($this->dr,$this->nod,$p,$u);}
function reflush(){$this->ret=msq_reorder($this->ret);}
function modif($act,$n,$ra,$nb=''){$this->ret=msq_modif($this->ret,$act,$n,$ra,$nb);}
function save($r=''){$this->dump($r?$r:$this->ret); write_file($this->f,$this->dmp);}
function create($ra){$this->ret=array('_menus_'=>$ra); $this->dump($this->ret); 
	if(!is_file($this->f))$this->save();}}

/*$msq=new msql;
$msq->def('','public_mods_1','','');
//$msq->create(array(1,2,3));
$msq->read();
$msq->modif('app','mdf',$r);
$r=$msq->ret;*/

///plugin/msql/users/public_mods_1
function plug_msql($dr,$nod,$in='',$no='',$act='',$n='',$ra='',$nb=''){return;
$msq=new msql; $msq->def($dr,$nod,$in,$no);
$msq->read(); if($act)$msq->modif($act,$n,$ra);
return $msq->ret;}

?>