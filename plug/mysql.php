<?php
//philum_plugin_mysql

//class mysql
function mysq_modif($r,$act,$n,$ra,$nb=''){switch($act){
case('arr'):$r=$ra; break;
case('add'):$r[]=$ra; break;
case('mdf'):$r[$n]=$ra; break;
case('del'):unset($r[$n]); break;
case('mdv'):$r[$n][$nb]=$ra; break;
case('push'):array_unshift($r,$ra); break;
case('app'):foreach($ra as $k=>$v){if($n=='mdf')$r[$k]=$v;
	elseif($n=='del')unset($r[$k]); else $r[]=$v;} break;}
//if($r[0])$r=msq_reorder($r);
return $r;}

function mysql_alter($ra,$rb,$p){$n=count($ra);//pr($rb);
//ALTER TABLE `pub_obj` ADD `com` INT NOT NULL AFTER `img`;
$rp=array_values($rb);//liste des propriétés
foreach($ra as $k=>$v){
	foreach($rb as $kb=>$vb){if($kb==$v)$after=$cur; else $cur=$kb;}
	$ret[]='"'.$v.'" '.$rp[$k].' after "'.$after.'"';}
return implode(',',$ret);}

function array_diff_b($ra,$rb){
foreach($rb as $k=>$v)if(!in_array($v,$ra))$ret[$k]=$v;
return $ret;}
/*function array_diff_c($ra,$rb){
foreach($ra as $k=>$v)if(!in_array($v,$rb))$ret[$k]=$v;
return $ret;}*/

function mysql_create_cols($r){
$collate='collate latin1_general_ci';
foreach($r as $k=>$v)
	if($v=='int')$ret.='`'.$k.'` int(11),'."\n";
	elseif($v=='var')$ret.='`'.$k.'` varchar(255) '.$collate.' NOT NULL default "",';
	elseif($v=='text')$ret.='`'.$k.'` mediumtext '.$collate.' NOT NULL default "",';
return $ret;}

function mysql_create($b,$r){if(!is_array($r))return; reset($r);
return msquery('create table if not exists `'.qd($b).'` (
  `id` int(11) NOT NULL auto_increment,
  '.mysql_create_cols($r).'
  PRIMARY KEY (`id`),
  KEY (`'.key($r).'`)
) ENGINE=MyISAM collate latin1_general_ci;');}

function import_msql_index($defs){}

function import_msql($defs,$db){
if($defs['_menus_']){$index=$defs['_menus_']; unset($defs['_menus_']);
	foreach($index as $k=>$v)$index[$k]=normalize($v);}
else $index=range(1,count($defs[0]));
foreach($defs as $k=>$v)foreach($v as $ka=>$va){
	if(!$va or is_numeric($va))$ty='int'; elseif(strlen($va)>255)$ty='text'; else $ty='var';
	if(!$ra[$ka] or $ra[$ka]=='int' && $ty=='int')$ra[$ka]=$ty;
	elseif($ra[$ka]!='text' && $ty=='var')$ra[$ka]=$ty;
	elseif($ty=='text')$ra[$ka]=$ty;}
$rb=array_combine($index,$ra); //p($rb);
echo mysql_create($db,$rb);
//$nid=msquery('insert into '.qd($db).' values '.mysqlrb($defs),1);
foreach($defs as $k=>$v)$nid=msquery('insert into '.qd($db).' (id,'.implode(',',$index).') values ('.$k.','.implode(',',atmr($v)).')',1);//' on duplicate key update '.$index[0].'='.atm($v[0])
return $nid?'created':'error';}

function mysql_init($p,$r,$ok=''){
$msq=new mysql(''); $msq->table($p);
$msq->show();
$ra=$msq->ret; unset($ra['id']); $ra=array_keys($ra);//pr($ra);
$rb=array_keys($r);//pr($rb);
if($ra && $ok)if(count($ra)!=count($rb))$msq->drop();
//if($ra)$rc=array_diff_b($ra,$rb); 
//if($rc)$red=mysql_alter($rc,$r,'add'); if($red)$msq->alter($red,1); 
$msq->create($r);
return $msq->ret;}

function sq2($d,$b,$p,$q,$z=''){
$sql='select '.$d.' from '.qd($b).' '.$q;
$rq=mysql_query($sql); if($z)echo $sql;
if($rq){$ret=sqlformat($rq,$p); mysql_free_result($rq);}
return $ret;}

class mysql{private $b; private $t; public $ret;
function __construct($b){$this->b=$b; $this->t=ses($b);}
function table($b){ses($b,ses('qd').'_'.$b); $this->b=$b; $this->t=ses($b);}
function read($d,$p,$q,$bug=''){$this->ret=sql2($d,$this->b,$p,$q,$bug);}
function sql($d,$p='',$bug=''){$this->ret=sql_b($d,$p,$bug);}
function reflush(){$this->ret=reflush($this->b);}
function create($r){mysql_create($this->b,$r);}
function insert($r){$this->ret=insert($this->b,mysqlra($r));}
function update($col,$val,$wh,$row){$this->ret=update($this->b,$col,$val,$wh,$row);}
function modif($r,$act,$n,$ra,$nb=''){$this->ret=mysq_modif($r,$act,$n,$ra,$nb);}
function delete($id){delete($this->b,$id);} 
function show(){$this->ret=sql_b('show columns from '.$this->t,'kv');}
function alter($wh){mysql_query('alter table '.$this->t.' '.$wh);}
function trunc(){mysql_query('truncate '.$this->t);}
function drop(){mysql_query('drop table '.$this->t);}
function save($d){insert($this->b,$d);}}

//
function plug_mysql($p,$o,$res=''){
$msq=new mysql(''); 
if($p)$msq->table($p);
//$msq->create($r);
if($o)$msq->read('id','k',$o);
return $msq->ret;}

?>