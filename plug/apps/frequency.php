<?php //frequency

class frequency{
static $a=__CLASS__;
static $default='';

static function graph($r){$ret='';
$mx=max($r); $w=620; $ratio=$w/$mx; $rb=[];
foreach($r as $k=>$v){$rb[]=[$k,div(ats('width:'.round($v*$ratio).'px; border:1px solid gray; display:inline-block;').atc('bkg'),$v)];}
return tabler($rb);}

static function twits($p,$o){$w=''; $n=10000; $rb=[]; $rc=[];
if($p){$w='where mentions like "%'.$p.'%"'; if($o)$w.=' and date>"'.timeago($o).'"';}
$r=sqb('id,date','qdtw','kv',$w.' order by twid desc limit '.$n);
if($r)foreach($r as $k=>$v)if($v){$day=date('ymd',$v); $rb[$day][]=1;}
if($rb)foreach($rb as $k=>$v)$rc[$k]=count($v);
return self::graph($rc);}
/*
static function tags($p,$o){$w; $rb=[]; $rc=[];
if($o)$w=' and date>"'.timeago($o).'"';
$r=sql::inner('tag,count(idart)','qdt','qdtg','idtag','kv','tag="'.$p.'" '.$w);
if($r)foreach($r as $k=>$v)if($v){$day=date('ymd',$v); $rb[$day][]=1;}
if($rb)foreach($rb as $k=>$v)$rc[$k]=count($v);
return self::graph($rc);}*/

static function arts($p,$o){$rb=[]; $cat=$o?'frm="'.$o.'" and ':'';
$r=sql('id,day','qda','kv',$cat.'nod="'.ses('qb').'" and day>"'.timeago($o).'" limit 1000');
if($r)foreach($r as $k=>$v)if($v){$day=date('ymd',$v); $rb[$day]=isset($rb[$day])?$rb[$day]+1:1;}
if($rb)return self::graph($rb);}

static function stats($p,$o){$rb=[]; $cat=$o?'frm="'.$o.'" and ':'';
$r=sql('id,day','qda','kv',$cat.'nod="'.ses('qb').'" order by day asc'); //Oyagaa Ayoo Yissaa
if($r)foreach($r as $k=>$v)if($v){$day=date('ymd',$v); $rb[$day]=isset($rb[$day])?$rb[$day]+1:1;}
if($rb)return json_encode($rb);}

static function dist($p,$o){$rb=[]; $cat=$o?'frm="'.$o.'" and ':'';
//$r=sql('id,day','qda','kv',$cat.'nod="'.ses('qb').'" order by day asc'); //Oyagaa Ayoo Yissaa
//$r=sql('id,day','qda','kv','(frm="312oay") and day>"'.timeago(365).'" order by day desc');
//$r=sql('id,day','qda','kv','(frm="Oyagaa Ayoo Yissaa") and day>"'.timeago(365).'" order by day desc');
$r=sql('id,day','qda','kv','(frm="Oyagaa Ayoo Yissaa" or frm="312oay") order by day desc');
$old=time(); $dist=0; $rb=[]; $rd=[];
if($r)foreach($r as $k=>$v){
	$dist=$old-$v; 
	$rb[$k]=$dist; 
	$rd[$k]=$old;
	$old=$v; }
arsort($rb); //pr($rb);
$rc[]=['temps écoulé','id','date','depuis'];
foreach($rb as $k=>$v)$rc[]=[self::elapsed_time($rd[$k],$r[$k]),pop::pubart($k),date('Y-m-d',$rd[$k]),date('Y-m-d',$r[$k])];
return tabler($rc);}

static function elapsed_time($d1,$d2=''){$rt=[]; if(!$d2)$d2=time();
$t1=new DateTime(); $t2=new DateTime(); $t1->setTimestamp($d1); $t2->setTimestamp($d2);
$diff=$t1->diff($t2); $n=$diff->format('%d');
$ra=$n>0?['year','month','day']:['hour','minute','second'];
$ty=$n>0?'%y-%m-%d':'%h-%i-%s'; $res=$diff->format($ty); $rb=explode('-',$res);
foreach($rb as $k=>$v)if($v)$rt[]=$v.' '.$ra[$k].($v>1?'s':'');
return implode(', ',$rt);}

static function build($p,$o){
[$a,$b]=arr($p,',',2); $r=[];
if($b && method_exists($a,$b))$r=$a::$b($p);
elseif(function_exists($a))$r=$p($o);
if($r)return self::graph($rc);}

static function call($p,$o,$q=[]){$ret=''; $p=$q[0]??$p; //ecko($o); //pr($q);
if($p=='twits')$ret=self::twits($q,$o);
if($p=='arts')$ret=self::arts($q,$o);
if($p=='stats')$ret=self::stats($q,$o);
if($p=='dist')$ret=self::dist($q,$o);
elseif(function_exists($o))$ret=$p($q,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default;
$j=$rid.'_frequency,call_inp_3_'.$p;
$ret=inputj('inp',$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid(self::$a);
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}

?>