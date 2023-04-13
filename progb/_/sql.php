<?php
class sql{
static $db;
static $enc;
static $qr;

function __construct($r){if(!self::$qr)self::dbq($r);}

static function dbq($r){
self::$qr=new mysqli($r[0],$r[1],$r[2],$r[3]); self::$db=$r[3];
$enc=isset($r[4]) && $r[4]==1?'utf8':'latin1'; self::$enc=$enc;
ses::$enc=$enc=='utf8'?'utf-8':'iso-8859-1';
self::$qr->query('set names '.$enc);
self::$qr->query('set character set '.$enc);}

//job
static function qd($d){return ses('qd').'_'.$d;}
static function connect(){require(boot::cnc());}
static function sqlclose(){mysqli_close(self::$qr);}
static function qrr($r){return mysqli_fetch_array($r);}
static function qra($r){return mysqli_fetch_assoc($r);}
static function qrw($r){return mysqli_fetch_row($r);}
static function qrf($r){mysqli_free_result($r);}
static function qres($v){if($v!==null)return mysqli_real_escape_string(self::$qr,stripslashes($v));}
static function atm($v){$d=substr($v??'',0,4);
return $d=='NULL'||$d=='NOW('||$d=='PASS'?$v:'"'.self::qres($v).'"';}//!num
static function atmr($r){foreach($r as $k=>$v)$ret[]=self::atm($v); return $ret;}
static function atmrk($r){foreach($r as $k=>$v)$rt[]=$k.'='.self::atm($v); return $rt;}
static function atmra($r,$o=''){$rb=self::atmr($r); $d=$o?'NULL,':'';
if($rb)return '('.$d.implode(',',$rb).')';}
static function atmrb($r,$o=''){foreach($r as $k=>$v)$rb[]=self::atmra($v,$o); return implode(',',$rb);}
static function atmrak($r,$o=''){$rb=self::atmrk($r); if($rb)return implode(',',$rb);}
static function qr($sql,$o=0){if($o)echo $sql; $rq=self::$qr->query($sql);//$rq=mysqli_query(self::$qr,$sql);
if($o){if(mysqli_connect_errno())pr(mysqli_connect_error());} return $rq;}
static function qrid($sql,$o=''){self::qr($sql,$o); return mysqli_insert_id(self::$qr);}

//act
static function sav($b,$r,$o='',$vrf=''){
if($vrf){$r=sqldb::vrfr($r,$b); if(sqldb::$er)return;}
return self::qrid('insert into '.ses($b).' values '.self::atmra($r,1),$o);}
static function savi($b,$r,$o='',$vrf=''){if($vrf)$r=sqldb::vrfr($r,$b);//with ai
return self::qrid('insert into '.ses($b).' values '.self::atmra($r,0),$o);}
static function sav2($b,$r,$ai=0,$o=''){//multiples
return self::qrid('insert into '.ses($b).' values '.self::atmrb($r,$ai),$o);}
static function upd($b,$r,$q,$o='',$vrf=''){if($vrf)$r=sqldb::vrfr($r,$b);//sqlup
self::qr('update '.ses($b).' set '.self::atmrak($r).' '.self::where($q),$o);}
static function savup($b,$r,$o=''){$ex=self::read('id',$b,'v',$r,$o);
if($ex)return self::upd($b,$r,$ex,$o); else return self::sav($b,$r,$o);}
static function del($b,$q,$o='',$ob=''){
self::qr('delete from '.ses($b).' '.self::where($q).' limit 1',$o);
if($ob)self::reflush($b,1);}
static function del2($b,$q,$o='',$ob=''){if(auth(6))return;
self::qr('delete from '.ses($b).' '.self::where($q),$o);
if($ob)self::reflush($bs,1);}

//req
static function format($rq,$p){$rt=[];
if($p=='q')return $rq;//res
if($p=='r')return self::qrr($rq);//array
if($p=='a')return self::qra($rq);//assoc
if($p=='w')return self::qrw($rq);//row
if($p=='v'){$r=self::qrw($rq); return $r[0]??'';}
if($p=='ar'){$rb=[]; while($r=self::qra($rq))$rb[]=$r; return $rb;}
while($r=self::qrw($rq))if($r[0])switch($p){
	case('k'):$rt[$r[0]]=($rt[$r[0]]??0)+1; break;//radd($rt,$r[0])
	case('rv'):$rt[]=$r[0]; break;//r
	case('kv'):$rt[$r[0]]=$r[1]; break;
	case('kk'):$rt[$r[0]][$r[1]]=($rt[$r[0]][$r[1]]??0)+1; break;//radd($rt[$r[0]],$r[1])
	case('vv'):$rt[]=[$r[0],$r[1]]; break;
	case('kr'):$rt[$r[0]][]=$r[1]; break;
	case('kkv'):$rt[$r[0]][$r[1]]=$r[2]; break;
	case('kkk'):$rt[$r[0]][$r[1]][$r[2]]+=1; break;
	case('kvv'):$rt[$r[0]]=[$r[1],$r[2]]; break;
	case('kkr'):$rt[$r[0]][$r[1]][]=$r[2]; break;
	case('krr'):$rt[$r[0]][]=$r; break;
	case('index'):$rt[$r[0]]=$r; break;
	default:$rt[]=$r; break;}
return $rt;}

static function where($q,$o=''){$rb=[]; $rc=[]; $w='';
if(is_numeric($q))return 'where id='.self::atm($q); elseif(!$q)return;
elseif(is_string($q))return 'where '.$q;
if($q)foreach($q as $k=>$v){
	$c1=substr($k,0,1); $c2=substr($k,0,2);
	$k1=substr($k,1); $k2=substr($k,2);
	if($k=='_order')$w.=' order by '.$v;
	elseif($k=='_group')$w.=' group by '.$v;
	elseif($k=='_limit')$w.=' limit '.$v;
	elseif($k=='_code')$w.=' '.$v.' ';
	elseif($k=='or')$rc=self::where($v,1);//'or'=>['!status'=>'3','!typ'=>'0']
	elseif($k=='and')$rb+=self::where($v,1);//second iteration
	elseif($c1=='|')$rc[]=$k1.'='.self::qres($v);//or
	elseif($c1=='!')$rb[]=$k1.'!='.self::qres($v);
	elseif($c2=='>=')$rb[]=$k2.'>='.self::qres($v);
	elseif($c2=='<=')$rb[]=$k2.'<='.self::qres($v);
	elseif($c1=='>')$rb[]=$k1.'>'.self::qres($v);
	elseif($c1=='<')$rb[]=$k1.'<'.self::qres($v);
	elseif($c1=='%')$rb[]=$k1.' like "%'.self::qres($v).'%"';
	elseif($c1=='&')$rb[]=$k1.' between "'.$v[0].'" and "'.$v[1].'"';
	elseif($c1=='(')$rb[]=$k1.' in ('.implode(',',self::atmr($v)).')';
	elseif($c1==')')$rb[]=$k1.' not in ('.implode(',',self::atmr($v)).')';
	elseif($c1=='#')$rb[]='date_format('.$k1.',"%y%m%d")='.self::qres($v);
	elseif(is_array($v))$rb[]=$k.' ('.implode(',',self::atmr($v)).')';
	//elseif(is_array($v))$rb+=self::where($v,1);
	elseif(substr($v??'',0,9)=='substring')$rb[]=$v;
	//elseif(strpos($v,' in'))$rb[]=$v;
	elseif($k==='not null')$rb[]=$v.' is not null';
	elseif($k==='is null')$rb[]=$v.' is null';
	elseif(is_numeric($k))$rb[]=$v;
	else $rb[]=$k.'='.self::atm($v);}
if($rc)$rb[]='('.implode(' or ',$rc).')';
if($o)return $rb;
if($rb)$ret=implode(' and ',$rb); else return $w;
if($ret)return 'where '.$ret.$w;}

static function read($d,$b,$p,$q,$z=''){//sql
$sql='select '.$d.' from '.$_SESSION[$b].' '.self::where($q);
if($z)echo $sql; $rq=self::qr($sql); $ret=$p=='v'?'':[];
if($rq){$ret=self::format($rq,$p); self::qrf($rq);}
return $ret;}

static function read2($d,$b,$p,$q,$z=''){//no where//sqb
$sql='select '.$d.' from '.ses($b).' '.$q;
if($z)echo $sql; $rq=self::qr($sql); $ret=$p=='v'?'':[];
if($rq){$ret=self::format($rq,$p); self::qrf($rq);}
return $ret;}

static function com($d,$b,$q=[],$z=''){//sqr
$sql='select '.$d.' from '.ses($b).' '.self::where($q);
return self::qr($sql,$z);}

static function call($sql,$p='',$z=''){$rq=self::qr($sql,$z);
if($rq){$ret=self::format($rq,$p); if($rq)self::qrf($rq); return $ret;}}

static function inner($d,$b1,$b2,$k2,$p,$q,$z=''){
if($d==$k2)$d=ses($b2).'.'.$d;
$sql='select '.$d.' from '.ses($b1).' inner join '.ses($b2).'
on '.ses($b1).'.id='.ses($b2).'.'.$k2.' '.self::where($q);
$rq=self::qr($sql,$z); $ret=$p=='v'?'':[];
if($rq){$ret=self::format($rq,$p); if($rq)self::qrf($rq);}
return $ret;}

static function inner2($d,$b1,$b2,$k2,$b3,$k3,$p,$q,$z=''){
$sql='select '.$d.' from '.ses($b1).' 
inner join '.ses($b2).'on '.ses($b1).'.id='.ses($b2).'.'.$k2.'
inner join '.ses($b3).'on '.ses($b2).'.id='.ses($b3).'.'.$k3.' '.self::where($q);
$rq=self::qr($sql,$z); $ret=$p=='v'?'':[];
if($rq){$ret=self::format($rq,$p); if($rq)self::qrf($rq);}
return $ret;}

//ops
static function setutf8(){self::$qr->query('set names utf8');}
static function setlatin(){self::$qr->query('set names latin1');}
static function tables($db){return self::call('show tables from '.$db,'rv');}
static function resetdb($b,$n=1){self::qr('alter table '.ses($b).' auto_increment='.$n);}
static function drop($b){if(auth(6)){self::backup($b); self::qr('drop table '.ses($b));}}
static function trunc($b){if(auth(6)){self::backup($b); self::qr('truncate '.ses($b)); self::resetdb($b);}}
static function ex($b,$z=''){$rq=self::qr('show tables like "'.ses($b).'"',$z); return mysqli_num_rows($rq)>0;}
static function reflush($b,$o=''){self::qr('alter table '.ses($b).' order by id');
if($o){$n=ma::lastid($b); if($n)self::resetdb($b,$n+1);}}
static function tuples($b,$c){return self::call('select count(*) as tuples, '.$c.' from '.ses($b).' group by '.$c.' having count(*)>1 order by tuples desc','w');}
static function doublons($b,$c){$b=ses($b); return self::call('SELECT COUNT(*) AS nbr_doublon, '.$c.' FROM '.$b.' GROUP BY '.$c.' HAVING COUNT(*)>1','w');}
static function killdoublons($b,$c){$b=ses($b); if(auth(6))return self::call('DELETE t1 FROM '.$b.' AS t1, '.$b.' AS t2 WHERE t1.id > t2.id AND t1.'.$c.' = t2.'.$c.'','w');}
static function maintenance($k,$v,$b1,$b2){return self::read2($k.','.$v,$b1,'kv','p1 left outer join '.ses($b2).' p2 on p2.id=p1.'.$k.' where p2.id is null group by '.$k,1);}//maintenance('idtag','tag','qdta','qdt');
static function backup($b,$o=''){$bb='z_'.ses($b).$o; $b2=$b.'z'; ses($b2,$bb);
if(self::ex($b2))self::qr('drop table '.$bb);
self::qr('create table '.$bb.' like '.ses($b));
self::qr('insert into '.$bb.' select * from '.ses($b)); return $bb;}
static function rollback($b){$bb='z_'.ses($b); $b2=$b.'z'; ses($b2,$bb);
if(self::ex($b2) && auth(6))self::qr('drop table '.ses($b)); else return;
self::qr('create table '.ses($b).' like '.$bb); self::qr('insert into '.ses($b).' select * from '.$bb); return $bb;}
static function cols($b){return self::call('select COLUMN_NAME,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH from INFORMATION_SCHEMA.COLUMNS where table_name="'.ses($b).'"','rr');}

}?>