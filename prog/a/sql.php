<?php
class sql{
static private $psw:
static private $qr;

function __construct(){
	if(!self::qr)self::qr=ses('qr');}

//static function dqb(){return ses('qr');}

//'localhost','root','1H03qpv9V','nfo'
private function cn(){
[$host,$name,$psw,$db]=$prmc;
$qr=mysqli_connect($host,$name,$psw,$db);
$qr->query('SET NAMES latin1');
return $qr;}

/*
public function pdo($r){[$host,$user,$pass,$db]=cn;
return self::$dbq??self::$dbq=new PDO('mysql:dbname='.$db.';host='.$host,$user,$pass,
[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND=>'SET CHARACTER SET UTF8']);}//,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ

static function call($d,$b,$p='',$q='',$z=''){
$d=self::rqcols($d,$b); $q=self::setq($q,$b); $ret=[]; if($p=='v')$ret='';
$rq=$this->$dbq->query('select '.$d.' from '.$b.' '.$q);
return $stmt->fetchAll(\PDO::FETCH_ASSOC);}*/

/*
$stmt=$conn->prepare("INSERT INTO MyGuests (firstname,lastname,email) VALUES (?,?,?)");
$stmt->bind_param("sss",$firstname,$lastname,$email);
$firstname="John";
$lastname="Doe";
$email="john@example.com";
$stmt->execute();
*/
/*bind_param
    i - integer
    d - double
    s - string
    b - BLOB
*/

function qr($sql,$o=''){$rq=$_SESSION['qr']->query($sql);//$rq=mysqli_query($_SESSION['qr'],$sql);
if($o){if(mysqli_connect_errno())pr(mysqli_connect_error()); echo($sql);} return $rq;}
function qres($v){if($v!==null)return mysqli_real_escape_string($_SESSION['qr'],stripslashes($v));}
function atm($v){return '"'.qres($v).'"';}//is_numeric($v)?(int)$v:
function atmr($r){foreach($r as $k=>$v)$ret[]=atm($v); return $ret;}
function atmrup($r){foreach($r as $k=>$v)$ret[]=$k.'='.atm($v); return $ret;}

static function com($d,$b,$p,$q,$z=''){
if(is_array($q))$q=implode(' and ',atmrup($q));
$sql='select '.$d.' from '.$_SESSION[$b].($q?' where '.$q:'');
$rq=qr($sql); if($z)echo $sql; $ret=$p=='v'?'':[];
if($rq){$ret=sqlformat($rq,$p); qrf($rq);}
return $ret;}

/*static function sav($b,$r,$o=''){
$qr=ses($qr);
$t=db::$rt[$b];
$ra=db::def($b);
$rk=array_keys($ra); aaray_shift($rk);
$sql='insert into '.$t.' ('.implode(',',$rk).') VALUES ('.implode(',',array_fill(0,count($r),'?')).')';
$stmt=$qr->prepare($sql);
$stmt->bind_param('sss',$firstname,$lastname,$email);
$firstname="John";
$lastname="Doe";
$email="john@example.com";
$stmt->execute();
return qrid('insert into '.$_SESSION[$b].' values '.mysqlra($r,1),$o);
}*/


}?>