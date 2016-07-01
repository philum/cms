<?php
//philum_plugin_algorithmia

/* An easy way to keep in track of external processes.
* Ever wanted to execute a process in php, but you still wanted to have somewhat controll of the process ? Well.. This is a way of doing it.
* @compability: Linux only. (Windows does not work).
* @author: Peec
*/
class Process{private $pid; private $command;
public function __construct($cl=false){if($cl!=false){$this->command=$cl;$this->runCom();}}
private function runCom(){$command='nohup '.$this->command.' > /dev/null 2>&1 & echo $!';
exec($command,$op);$this->pid=(int)$op[0];}
public function setPid($pid){$this->pid=$pid;}
public function getPid(){return $this->pid;}
public function status(){$command = 'ps -p '.$this->pid;exec($command,$op);
if(!isset($op[1]))return false;else return true;}
public function start(){if($this->command!='')$this->runCom();else return true;}
public function stop(){$command = 'kill '.$this->pid;exec($command);
if($this->status()==false)return true;else return false;}}

function algrthm_call($p,$o){//$ret=new Process('ls -al'); $ret.start();
$d="curl -X POST -d '\"".$o."\"' -H 'Content-Type: application/json' -H 'Accept: application/json' -H 'Authorization: 54616cb91e47425aaa0de8368af1d131' https://api.algorithmia.com/api/".$p;
return exec($d);}

function algrthm_res($r){
if(is_array($r)){foreach($r as $k=>$v)if(!is_array($v))$r[$k]=array($v);}
else $r=array('result'=>array(nl2br(utf8_decode($r))));
return $r;}

//plugin_func('algorithmia','algrthm_build',$p,$o);
function algrthm_build($p,$o){
chrono('');
$re=algrthm_call($p,$o); 
$r=json_decode($re,true); //p($r);
if($r['error'])return $r['error']; //echo $r['duration'];
echo chrono('calgo'); //p($r['result']);
$ret=make_table(algrthm_res($r['result']));
return $ret;}

function algrthm_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);//$resultant des champs
$ret=algrthm_build($p,$o);
return $ret;}

function algrthm_menu($p,$o,$rid){
$p=$p?$p:'kenny/Factor'; $o=$o?$o:'667';
$ret=select_j('inp','pfunc','','algorithmia/algrthm_r','','2');
$ret.=input(1,'inp',$p,'').' '.input(1,'ino',$o,'');
$ret.=lj('',$rid.'_plug__3_algorithmia_algrthm*j___inp|ino',picto('reload')).' ';
return $ret;}

function algrthm_r(){
$r=array('util/Url2Text','util/Html2Text','tags/ScrapeRSS','ApacheOpenNLP/Tokenizer','opencv/ImageBinarization','ocr/RecognizeCharacters');
foreach($r as $v)$rb[$v]=$v;
return $rb;}

//plugin('algorithmia',$p,$o)
function plug_algorithmia($p,$o){$rid='plg'.randid();
$bt=algrthm_menu($p,$o,$rid); //$ret=algrthm_j($p,$o);
return $bt.divd($rid,$ret);}
//$ret.=msqlink('',ses('qb').'_algrthm').' ';

?>
