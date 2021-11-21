<?php //philum/a/msql
class msql{
static $dr,$nod,$f,$r;
static $m='_menus_';

static function nod($d){return ses('qb').'_'.$d;}
static function url($dr,$nod,$o=''){if($o)$nod.='_sav';
$dr=$dr=='lang'?$dr.'/'.prmb(25):$dr; $dr=$dr?$dr:'users';
return root('msql/').$dr.'/'.$nod.'.php';}
//static function patch($f,$r,$nod){write_file($f,self::dump($r,$nod));}
static function conformity($r){foreach($r as $k=>$v)$r[$k]=[$v]; return $r;}

static function menus($r){$ret=[];
if(isset($r['_menus_']))return $r['_menus_']; $n=count($r); if($r)$r=current($r);
if(is_array($r))foreach($r as $k=>$v)$ret['_menus_'][]=$k; return $ret;}

static function dump($r,$p=''){$rc=[]; $ret='';
if(is_array($r))foreach($r as $k=>$v){$rb=[];
	if(is_array($v)){foreach($v as $ka=>$va)$rb[]="'".addslashes(stripslashes($va))."'";
		if($rb)$rc[]=(is_numeric($k)?$k:'"'.$k.'"').'=>['.implode(',',$rb).']';}
	else $rc[]='[\''.addslashes(stripslashes($v)).'\']';} //eco($rc);
if($rc)$ret=implode(','.n(),$rc);
return '<?php //philum/msql/'.$p."\n".'$r=['.$ret.'];';}

static function del($dr,$nod){$f=msql::url($dr,$nod); if(is_file($f) && auth(6))unlink($f);}

static function save($dr,$nod,$r,$rh=[]){if(!$r)$r=[];
if($rh && !isset($r['_menus_']))$r=['_menus_'=>$rh]+$r; if(isset($r[0]))$r=self::reorder($r);
$f=self::url($dr,$nod); $d=self::dump($r,$nod); write_file($f,$d);
return $r;}

static function array_push_after($ra,$rb,$p){
if(is_int($p))$r=array_merge(array_slice($ra,0,$p+1),$rb,array_slice($ra,$p+1));
elseif($ra)foreach($ra as $k=>$v){$r[$k]=$v; if($k==$p)$r=array_merge($r,$rb);} return $r;}

static function modif($dr,$nod,$ra,$act,$rh=[],$n=''){
if(!$dr)$dr='users'; $r=self::read($dr,$nod,'','',$rh);
if($act=='one')$r[$n]=$ra;
elseif($act=='arr'){$r=$ra; if($rh)array_unshift($r,$rh);}
elseif($act=='push')$r[]=array_values($ra);
elseif($act=='row'){$r[$n]=array_values($ra);}
elseif($act=='del')unset($r[$n?$n:$ra]);
elseif($act=='val')$r[$n][$rh]=$ra;
elseif($act=='shot')$r[$n][$rh?$rh:0]=$ra;
elseif($act=='after')$r=self::array_push_after($r,$ra,$n);//??
elseif($act=='next'){$nx=self::nextentry($r); $r[$nx]=$ra;}
elseif($act=='add'){foreach($ra as $k=>$v)$r[]=$v;}
elseif($act=='mdf'){foreach($ra as $k=>$v)$r[$k]=$v;}
elseif($act=='mdfv'){foreach($ra as $k=>$v)if($v)$r[$k]=[$v];}
elseif($act=='mdfk'){foreach($r as $k=>$v)if($k==$ra)$rb[$rh]=$v; else $rb[$k]=$v; $r=$rb;}
elseif(substr($act,0,1)=='@'){$n=substr($act,1); $nx=self::nextentry($r);
	if($r)foreach($r as $k=>$v){$rb[$k]=$v; if($k==$n)$rb[$nx]=$ra;} $r=$rb;}
//elseif(is_numeric($n))foreach($r as $k=>$v){if($v[$n]==$ra[$n] && $v[$n]){
//	if($act=='mdf')$r[$k]=$ra; elseif($act=='del')unset($r[$k]);}}
elseif($act)$r[$act]=$ra;
if(isset($r[0]))$r=self::reorder($r); if(isset($rb))$rb+=$r; else $rb=$r;
self::save($dr,$nod,$rb);
//json::write($dr,$nod,$r);
return $rb;}

static function read($dr,$nod,$in='',$u='',$rh=[]){$f=self::url($dr,$nod);
if(is_file($f))include $f; elseif($rh)self::save($dr,$nod,[],$rh); $m='_menus_';
if(isset($r)){foreach($r as $k=>$rb)foreach($rb as $kb=>$vb)$r[$k][$kb]=stripslashes_b($vb);
if($u && isset($r[$m]))unset($r[$m]);
return isset($r[$in])?$r[$in]:$r;}}

static function read_b($dr,$nod,$in='',$u='',$rh=[]){$f=self::url($dr,$nod);
if(is_file($f))include $f; elseif($rh)self::save($dr,$nod,[],$rh); $m='_menus_';
if(isset($r)){if($u && isset($r[$m]))unset($r[$m]);
return isset($r[$in])?$r[$in]:$r;}}

static function row($dr,$nod,$in,$o=''){$f=self::url($dr,$nod);
if(is_file($f))include $f; $m='_menus_'; if(!isset($r[$in]))return;
if($o && isset($r[$m]))return array_combine_a($r[$m],$r[$in]);
return $r[$in];}

static function col($dr,$nod,$n=0,$u=''){$f=self::url($dr,$nod);
if(is_file($f))include $f; $m='_menus_'; $rb=[];
if(isset($r)){if($u && isset($r[$m]))unset($r[$m]);
foreach($r as $k=>$v)$r[$k]=stripslashes_b($v[$n]??'');}
return $r;}

static function val($dr,$nod,$in,$k=0){$f=self::url($dr,$nod);
if(is_file($f))include $f; if(!isset($r[$in]))return; else $r=$r[$in];
if(!isset($r[$k]))return; else return stripslashes_b($r[$k]);}

static function create($dr,$nod,$r,$rb){
if($r)foreach($r as $k=>$v)if(!is_array($v))$r[$k]=[$v]; $f=self::url($dr,$nod);
if(!is_file($f))return self::save($dr,$nod,$r,$rb);}

static function add($dr,$nod,$rb,$rh=[],$key=''){
$r=self::read($dr,$nod,'','',$rh); if($key)$r+=$rb; else $r[]=$rb;
return self::save($dr,$nod,$r);}

//select
static function choose($dr,$pr,$nd){$ret=[];
$r=explore(root('msql/').($dr?$dr:'users'),'',1); if(!$r)return; $n=count($r);
for($i=0;$i<$n;$i++){$rb=preg_split("/[_\.]/",$r[$i]);
if(!empty($rb[2]) && $rb[2]!='sav' && (empty($rb[3]) or $rb[3]!='sav')){
	if($pr && $rb[0]==$pr && !$nd && $rb[1] && $rb[2]!='php')$ret[$rb[1]][]=$rb[2];
	elseif($pr && $rb[0]==$pr && $rb[1]==$nd && $rb[2]!='php')$ret[]=$rb[2];//versions
	elseif(!$pr && $nd){if($rb[1]==$nd)$ret[]=$rb[0].'_'.$rb[1];}
	elseif(!$pr)$ret[]=$rb[0].'_'.$rb[1];}}
return $ret;}

static function findlast($dr,$pr,$nod){//next table
$r=self::choose($dr,$pr,$nod); return self::nextnod($r);}//
static function nextnod($r){if($r){$mx=max($r); asort($r); $i=0;
foreach($r as $v){$i++; if($v!=$i)return $i;} return $mx+1;} return 1;}
static function nextentry($r){if($r){ksort($r); $i=0; $n=isset($r['_menus_'])?1:0;//next free
foreach($r as $k=>$v){$i++; if(!isset($r[$i-$n]) && is_numeric($k))return $i-$n;}
$rb=array_keys($r); $max=max($rb); return is_numeric($max)?$max+1:1;}}
static function exists($dr,$nod){$f=self::url($dr,$nod); if(is_file($f))return true;}
/*static function exentry($dr,$nod,$k){$f=self::url($dr,$nod);
if(is_file($f))include $f; if(isset($r[$k]))return true;}*/

static function goodtable($d){//table_line�col
[$dn,$vn]=opt($d,'�'); [$dr,$da]=split_one('/',$dn);
if(!$da){$da=$dr;$dr='';} [$nd,$bs,$va,$op]=opt($da,'_',4);
if($op){$da=$nd.'_'.$bs.'_'.$va; $r=self::read($dr,$da,$op);}
if($da && !isset($r))$r=self::read($dr,$da);
if(!$r)$r=self::read($dr,$nd.'_'.$bs,$va);
return $vn?$r[$vn]:$r;}

static function goodtable_b($d){$da=''; $row=''; $ob=0; $dr='';//table�line|col
if(strpos($d,'/'))[$dr,$p]=split_one('/',$d); else $p=$d;
if(strpos($p,'�'))[$p,$row]=opt($p,'�'); else $row='';//row
if(strpos($row,'|'))[$row,$col]=opt($row,'|'); else $col='';//col
[$bs,$nd,$nb]=opt($p,'_',3);
if($nb)$da=$bs.'_'.$nd.'_'.$nb; else $da=$bs.'_'.$nd;
if($row)$r=msql::row($dr,$da,$row,0); else $r=msql::read($dr,$da);//is_numeric($col)?0:1
if($row)$r=$r[$row]??$r; if(isset($col))$r=$r[$col]??$r; return $r;}

static function where($dr,$nod,$rq,$rh=[]){$r=self::read($dr,$nod,'',1,$rh); $rb=[]; $rc=[];
if($r)foreach($r as $k=>$v)foreach($rq as $ka=>$va)if(($v[$ka]??'')===$va)$rb[$k][$ka]=1; $n=count($rq);
if($rb)foreach($rb as $k=>$v)if(count($v)==$n)$rc[]=$r[$k];
return $rc;}

static function where_assoc($dr,$nod,$q,$rh=[]){
$r=self::read($dr,$nod,'','',$rh); $rb=[]; $m='_menus_';
if($r)foreach($r as $k=>$v){$v=array_combine_a($r[$m],$v);
	foreach($q as $ka=>$va)if($v[$ka]==$va)$rb[]=$v;}
return $rb;}

static function assoc($dr,$nod){$r=self::read($dr,$nod,'',0); $m='_menus_'; $rb=[]; $rh=$r[$m]??''; 
if($r)foreach($r as $k=>$v)foreach($v as $ka=>$va)$rb[$k][$rh[$ka]]=$va; return $rb;}
static function select($dr,$nod,$d,$n=0){$r=self::read($dr,$nod,'',1); $rb=[];
if($r)foreach($r as $k=>$v)if($v[$n]==$d)$rb[$k]=$v; return $rb;}
static function strip($dr,$nod){$r=self::read($dr,$nod,'',1);
if($r)foreach($r as $k=>$v)foreach($v as $ka=>$va)$r[$k][$ka]=stripslashes($va); return $k;}
static function prep($b,$d){$r=self::read($b,$d,'',1); $rb=[];
if($r)foreach($r as $k=>[$ka,$va])$rb[$ka][$k]=$va; return $rb;}

static function kv($b,$d,$rh=[]){$r=self::read($b,$d,'',1,$rh); $rb=[];
if($r)foreach($r as $k=>[$ka,$va])$rb[$ka]=$va; return $rb;}
static function kx($b,$d,$n=0,$rh=[]){$r=self::read($b,$d,'',1,$rh); $rb=[];//like col
if($r)foreach($r as $k=>$v)$rb[$k]=$v[$n]; return $rb;}
static function kn($b,$d,$n=0,$n2=1,$rh=[]){$r=self::read($b,$d,'',1,$rh); $rb=[];
if($r)foreach($r as $k=>$v)$rb[$v[$n]]=$v[$n2]; return $rb;}
static function find_k($dr,$nod,$d,$n=0){$r=self::read($dr,$nod,'',1);
if($r)foreach($r as $k=>$v)if($v[$n]==$d)return $k;}
static function find_r($dr,$nod,$d,$n=0,$o=''){$r=self::read($dr,$nod);//like row
if($r)foreach($r as $k=>$v)if($v[$n]==$d)$in=$k; if(!isset($in))return; $m='_menus_';
if($o && isset($r[$m]))return array_combine_a($r[$m],$r[$in]); else return $r[$in];}

static function format($r){foreach($r as $k=>$v)$r[$k]=[$v]; return $r;}
static function clb($r,$n){$rb=[]; foreach($r as $k=>$v)$rb[$k]=$v[$n]; return $rb;}
static function cat($r,$n){$rb=[]; foreach($r as $k=>$v)$rb[$v[$n]??$v]=$k; return $rb;}
static function tri($r,$n,$d){$rb=[]; foreach($r as $k=>$v)if($v[$n]==$d)$rb[$k]=$v; return $rb;}
static function sort($r,$n,$o=''){$rb=array_keys_r($r,$n); if($o)arsort($rb); else asort($rb);
foreach($rb as $k=>$v)$rb[$k]=$r[$k]; return $rb;}
static function order($r,$n){$b='_menus_'; $i=0; if(isset($r[$b])){$rb[$b]=$r[$b]; unset($r[$b]);}
$rc=self::clb($r,$n); arsort($rc); foreach($rc as $k=>$v)$rb[]=$r[$k]; return $rb;}
static function reorder($r){$b='_menus_'; $i=0; if(isset($r[$b])){$rb[$b]=$r[$b]; unset($r[$b]);}
foreach($r as $k=>$v){$i++; $rb[$i]=$v;} return $rb;}
static function move($r,$ka,$va){$rk=$r[$ka]; unset($r[$ka]); $i=0;
foreach($r as $k=>$v){if($k==$va){$rb[$i]=$rk; $i++;} 
if($k=='_menus_')$rb[$k]=$v; else $rb[$i]=$v; $i++;} return $rb;}
static function displace($r,$id,$to){if($id==$to)return $r; $rk=$r[$id]; unset($r[$id]);
foreach($r as $k=>$v){if($k==$to)$rb[$id]=$rk; $rb[$k]=$v;} return $rb;}
static function walk($r,$n,$fn,$p){foreach($r as $k=>$v){$r[$k][$n]=$fn($k,$v[$n],$v,$p);} return $r;}
static function walk_k($r,$fn){foreach($r as $k=>$v){$kb=$fn($k,$v); $rb[$kb]=$v;} return $rb;}
static function nb($r){foreach($r as $k=>$v){$i++; $rb[$i]=[$v];} return $rb;}//prep
static function prevnext($r,$d){$keys=array_keys($r);
foreach($keys as $k=>$v)if($v==$d)return [$keys[$k-1],$keys[$k+1]];}
static function copy($da,$na,$db,$nb){
$r=self::read($da,$na); self::save($db,$nb,$r); return $r;}
static function num($dr,$nod,$d){$r=self::read($dr,$nod);//n
foreach($r as $k=>$v){$i++; if($k==$d)return $i;}}
static function push($dr,$nod,$r){if(!is_array($r))$r=[$r];
return self::modif($dr,$nod,$r,'push');}
static function append($ra,$d){[$a,$b]=split_right('/',$d,1);
$r=self::read($a,$b); foreach($r as $k=>$v)if(!$ra[$k])$ra[$k]=$v; return $ra;}
static function reverse($r){$rh=val($r,'_menus_'); if($rh)unset($r['_menus_']);
if($r){$r=array_reverse($r); array_unshift($r,$rh);} return $r;}
static function merge($r,$dr,$nd){$rb=self::read($dr,$nd,'',1); return array_merge_b($r,$rb);}
static function ses($v,$dr,$nod,$u){
return $_SESSION[$v]=isset($_SESSION[$v])?$_SESSION[$v]:self::read($dr,$nod,'',$u);}
static function json($dr,$nod,$in='',$u=''){$r=self::read($dr,$nod,$in,$u); return mkjson($r);}

function bt($b,$p,$d='',$c=''){$u=($b?$b:'users').'_'.ajx($p).($d?':'.ajx($d):'');
return lj('grey'.($c?' '.$c:''),'popup_msql__3_'.$u,pictit('msql2',$p));}

}
?>