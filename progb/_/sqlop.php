<?php 
class sqlop{static private $b; static private $t; static public $ret;
function __construct($b){self::$b=$b; self::$t=ses($b);}
static function table($b){ses($b,qd($b)); self::$b=$b; self::$t=ses($b);}
static function read($d,$p,$q,$bug=''){self::$ret=sql($d,self::$b,$p,$q,$bug);}
static function reflush(){self::$ret=sql::reflush(self::$b);}
static function insert($r){self::$ret=sql::sav(self::$b,$r);}
static function update($col,$val,$wh,$row){self::$ret=sql::upd(self::$b,[$col=>$val],[$wh=>$row]);}
static function sqldel($id){sql::del(self::$b,$id);} 
static function show(){self::$ret=sql::call('show columns from '.self::$t,'kv');}
static function trunc(){if(auth(6))qr('truncate '.self::$t);}
static function drop(){if(auth(6))qr('drop table '.self::$t);}
static function save($r){sql::sav(self::$b,$r);}

static function modif($r,$act,$n,$ra,$nb=''){switch($act){
case('arr'):$r=$ra; break;
case('add'):$r[]=$ra; break;
case('mdf'):$r[$n]=$ra; break;
case('del'):unset($r[$n]); break;
case('mdv'):$r[$n][$nb]=$ra; break;
case('push'):array_unshift($r,$ra); break;
case('mdf'):foreach($ra as $k=>$v)$r[$k]=$v; break;
case('append'):foreach($ra as $k=>$v)$r[]=$v; break;}
return $r;}

static function import($defs,$b){$ra=[];//from msql
if($defs['_menus_']){$index=$defs['_menus_']; unset($defs['_menus_']);
	foreach($index as $k=>$v)$index[$k]=normalize($v);}
else $index=range(1,count($defs[0]));
foreach($defs as $k=>$v)foreach($v as $ka=>$va){
	if(!$va or is_numeric($va))$ty='int'; elseif(strlen($va)>255)$ty='text'; else $ty='var';
	if(!$ra[$ka] or $ra[$ka]=='int' && $ty=='int')$ra[$ka]=$ty;
	elseif($ra[$ka]!='text' && $ty=='var')$ra[$ka]=$ty;
	elseif($ty=='text')$ra[$ka]=$ty;}
$rb=array_combine($index,$ra); //p($rb);
$ret=self::create_table($b,$rb,0);
//$nid=sql::qrid('insert into '.qd($b).' values '.sql::atmrb($defs,1));
foreach($defs as $k=>$v)$nid=sql::qrid('insert into '.qd($b).' (id,'.implode(',',$index).') values ('.$k.','.implode(',',sql::atmr($v)).')');//' on duplicate key update '.$index[0].'='.sql::atm($v[0])
return $nid?'created':'error';}

static function read_cols($b){$rb=[];
$rq=qr('select COLUMN_NAME,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH from INFORMATION_SCHEMA.COLUMNS where table_name="'.sql::$db.'.'.qd($b).'"',0);
//$qb=in_array_b($b,sqldb::$rt); $rq=sql::cols($qb);
while($r=sql::qra($rq)){
	$type=$r['DATA_TYPE']; $sz=$r['CHARACTER_MAXIMUM_LENGTH']; $nm=$r['COLUMN_NAME'];
	if($nm=='id')$type=$sz==7?'ai':'aib';
	elseif($type=='int'){if($sz==2)$type='2int'; elseif($sz==7)$type='sint'; else $type='int';}
	elseif($type=='varchar'){
		if($sz==2)$type='2var'; elseif($sz<25)$type='svar'; elseif($sz>1000)$type='bvar'; else $type='var';}
	elseif($type=='longtext')$type='long';
	elseif($type=='mediumtext')$type='text';
	elseif($type=='tinytext')$type='text';
	elseif($type=='bigint')$type='bint';
	//elseif($type=='decimal')$type='dec';
	elseif($type=='double')$type='double';
	elseif($type=='float')$type='float';
	elseif($type=='json')$type='json';
	$rb[$r['COLUMN_NAME']]=$type;}
return $rb;}

static function trigger($b,$ra){$db=qd($b); $qb=sqldb::qb($b);
$rb=self::read_cols($b); $rnew=[]; $rold=[];
if(isset($rb['id']))unset($rb['id']); if(isset($rb['up']))unset($rb['up']);	
if($rb){$rnew=array_diff_assoc($ra,$rb); $rold=array_diff_assoc($rb,$ra);}//old
if($rnew or $rold){//pr([$rnew,$rold]);
	$bb=sql::backup($qb,date('ymdHis')); self::drop();
	$rtwo=array_intersect_assoc($ra,$rb);//common
	$rak=array_keys($ra); $rav=array_values($ra);
	$rnk=array_keys($rnew); $rnv=array_values($rnew); $nn=count($rnk);
	$rok=array_keys($rold); $rov=array_values($rold); $no=count($rok);
	$na=count($rnew); $nb=count($rold); $ca=array_keys($rtwo); $cb=array_keys($rtwo);
	if($na==$nb)for($i=0;$i<$nn;$i++)if($rnv[$i]==$rov[$i] or $rnv[$i]!='int'){
		$ca[]=$rnk[$i]; $cb[]=$rok[$i];}
	return 'insert into '.$db.'('.implode(',',$ca).') select '.implode(',',$cb).' from '.$bb;}}

static function create_cols($r){$ret='';
foreach($r as $k=>$v)
	if($v=='ai')$ret.='`id` int(7) NOT NULL auto_increment,';
	elseif($v=='aib')$ret.='`id` int(11) NOT NULL auto_increment,';
	elseif($v=='int')$ret.='`'.$k.'` int(11) NOT NULL,'."\n";
	elseif($v=='int10')$ret.='`'.$k.'` int(10) NOT NULL,'."\n";
	elseif($v=='int7')$ret.='`'.$k.'` int(7) NOT NULL,'."\n";
	elseif($v=='int3')$ret.='`'.$k.'` int(3) NOT NULL,'."\n";
	elseif($v=='int2')$ret.='`'.$k.'` int(2) NOT NULL,'."\n";
	elseif($v=='int1')$ret.='`'.$k.'` int(1) NOT NULL,'."\n";
	elseif($v=='bint')$ret.='`'.$k.'` bigint(36) NOT NULL,'."\n";
	elseif($v=='double')$ret.='`'.$k.'` double NOT NULL,'."\n";
	elseif($v=='psw')$ret.='`'.$k.'` varchar(255) NOT NULL,'."\n";
	elseif($v=='var')$ret.='`'.$k.'` varchar(255) NOT NULL,'."\n";
	elseif($v=='svar')$ret.='`'.$k.'` varchar(25) NOT NULL,'."\n";
	elseif($v=='mvar')$ret.='`'.$k.'` varchar(55 )NOT NULL,'."\n";
	elseif($v=='lvar')$ret.='`'.$k.'` varchar(500) NOT NULL,'."\n";
	elseif($v=='bvar')$ret.='`'.$k.'` varchar(1000) NOT NULL,'."\n";
	elseif($v=='var2')$ret.='`'.$k.'` varchar(2) NOT NULL,'."\n";
	elseif($v=='var3')$ret.='`'.$k.'` varchar(3) NOT NULL,'."\n";
	elseif($v=='var11')$ret.='`'.$k.'` varchar(11) NOT NULL,'."\n";
	elseif($v=='text')$ret.='`'.$k.'` mediumtext NOT NULL,'."\n";
	elseif($v=='long')$ret.='`'.$k.'` longtext NOT NULL,'."\n";
	elseif($v=='time')$ret.='`'.$k.'` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,';
	elseif($v=='date')$ret.='`'.$k.'` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,';
	elseif(strpos($v,'/'))$ret.='`'.$k.'` enum(\''.implode("','",explode('/',$v)).'\'),';
return $ret;}

static function create_table($b,$r,$o=''){if(!is_array($r))return;
if($b=='_sys')$db=$b; else $db=qd($b); $ret='';
if(sql::$enc=='utf8')$charset='utf8mb4_unicode_ci'; else $charset='latin1_general_ci';
//if($o)$r=['id'=>'ai']+$r;
$sql='create table if not exists `'.$db.'`(
  '.self::create_cols($r).'
  PRIMARY KEY (`id`)'.(isset($r['key'])?', '.$r['key']:'').'
) ENGINE=InnoDB collate '.$charset.';';
$req=qr($sql,0);
if($req)return $db.':ok'; else return 'er';}

static function install($b,$r,$up=''){$ret='';
$ra=self::read_cols($b);
if($up && $ra && $ra!=$r){$sql=self::trigger($b,$r); if($sql)qr($sql,1);}
elseif(!$ra && $up)$ret=self::create_table($b,$r,1);
return $ret;}

static function home($p,$o){
if($p)self::table($p);
if($o)self::read('id','k',$o);
return self::$ret;}
}
?>