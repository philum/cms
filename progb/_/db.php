<?php 
class db{
static $dr,$nod,$f,$r;
static $m='_menus_';

static function url($dr,$nod,$o=''){if($o)$nod.='_sav';
$dr=$dr=='lang'?$dr.'/'.prmb(25):$dr; $dr=$dr?$dr:'users';
return root('msql/').$dr.'/'.$nod.'.php';}
//static function patch_m($f,$r,$nod){write_file($f,self::dump($r,$nod));}
static function conformity($r){foreach($r as $k=>$v)$r[$k]=[$v]; return $r;}

static function menus($r){$rt=[];
if(isset($r['_menus_']))return $r['_menus_']; if($r)$r=current($r); $n=count($r);
return $rt['_menus_']array_fill(0,$n,'');
if(is_array($r))foreach($r as $k=>$v)$rt['_menus_'][]=$k; return $rt;}

static function dump($r,$p=''){$rc=[]; $ret='';
if(is_array($r))foreach($r as $k=>$v){$rb=[];
	if(is_array($v)){foreach($v as $ka=>$va)$rb[]="'".($va?addslashes(stripslashes($va)):'')."'";
		if($rb)$rc[]=('"'.$k.'"').'=>['.implode(',',$rb).']';}
	else $rc[$k]=('"'.$k.'"').'=>[\''.($v?addslashes(stripslashes($v)):'').'\']';}
if($rc)$ret=implode(','.n(),$rc);
return '<?php //msql/'.$p."\n".'$r=['.$ret.'];';}

static function del($dr,$nod){$f=self::url($dr,$nod); if(is_file($f) && auth(6))unlink($f);}

static function save($dr,$nod,$r,$rh=[]){if(!$r)$r=[];
if($rh && !isset($r['_menus_']))$r=array_merge(['_menus_'=>$rh],$r); if(isset($r[0]))$r=self::reorder($r);
$f=self::url($dr,$nod); $d=self::dump($r,$nod); write_file($f,$d); return $r;}

static function array_push_after($ra,$rb,$p){
if(is_int($p))$r=array_merge(array_slice($ra,0,$p+1),$rb,array_slice($ra,$p+1));
elseif($ra)foreach($ra as $k=>$v){$r[$k]=$v; if($k==$p)$r=array_merge($r,$rb);} return $r;}

static function modif($dr,$nod,$ra,$act,$rh=[],$n=''){
if(!$dr)$dr='users'; $r=self::read($dr,$nod,'','',$rh);
if($act=='one')$r[$n]=$ra;
elseif($act=='arr'){$r=$ra; if($rh)$r=array_merge(['_menus_'=>$rh],$r);}
elseif($act=='push')$r[]=array_values($ra);
elseif($act=='row')$r[$n]=array_values($ra);
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

static function include($f){}//verif integrity
static function rollback($f){}

static function read($dr,$nod,$in='',$u='',$rh=[]){$f=self::url($dr,$nod);
if(is_file($f))include $f; elseif($rh)$r=self::save($dr,$nod,[],$rh); $m='_menus_';
if(isset($r)){foreach($r as $k=>$rb)foreach($rb as $kb=>$vb)$r[$k][$kb]=stripslashes($vb);
if($u && isset($r[$m]))unset($r[$m]);
return $r[$in]??$r;}}

static function read_b($dr,$nod,$in='',$u='',$rh=[]){$f=self::url($dr,$nod);
if(is_file($f))include $f; elseif($rh)$r=self::save($dr,$nod,[],$rh); $m='_menus_';
if(isset($r)){if($u && isset($r[$m]))unset($r[$m]);
return $r[$in]??$r;}}

static function row($dr,$nod,$in,$o=''){$f=self::url($dr,$nod);//assoc
if(is_file($f))include $f; $m='_menus_'; if(!isset($r[$in]))return;
if($o && isset($r[$m]))return array_combine_a($r[$m],$r[$in]);
return $r[$in];}

static function col($dr,$nod,$n=0,$u=1){$f=self::url($dr,$nod);
if(is_file($f))include $f; $m='_menus_'; $rb=[];
if(isset($r)){if($u && isset($r[$m]))unset($r[$m]);
if($r)foreach($r as $k=>$v)$rb[$k]=stripslashes_b($v[$n]??'');}
return $rb;}

static function val($dr,$nod,$in,$k=0){$f=self::url($dr,$nod);
if(is_file($f))include $f; if(!isset($r[$in]))return; else $r=$r[$in];
if(!isset($r[$k]))return; else return stripslashes_b($r[$k]);}

static function add($dr,$nod,$rb,$rh=[],$key=''){
$r=self::read($dr,$nod,'','',$rh); if($key)$r+=$rb; else $r[]=$rb;
return self::save($dr,$nod,$r);}

static function create($dr,$nod,$r,$rb){
if($r)foreach($r as $k=>$v)if(!is_array($v))$r[$k]=[$v]; $f=self::url($dr,$nod);
if(!is_file($f))return self::save($dr,$nod,$r,$rb);}

//select
static function choose($dr,$pr,$nd){$rt=[];
$r=explore(root('msql/').($dr?$dr:'users'),'',1); if(!$r)return; $n=count($r);
for($i=0;$i<$n;$i++){$rb=preg_split("/[_\.]/",$r[$i]);
if(!empty($rb[2]) && $rb[2]!='sav' && (empty($rb[3]) or $rb[3]!='sav')){
	if($pr && $rb[0]==$pr && !$nd && $rb[1] && $rb[2]!='php')$rt[$rb[1]][]=$rb[2];
	elseif($pr && $rb[0]==$pr && $rb[1]==$nd && $rb[2]!='php')$rt[]=$rb[2];//versions
	elseif(!$pr && $nd){if($rb[1]==$nd)$rt[]=$rb[0].'_'.$rb[1];}
	elseif(!$pr)$rt[]=$rb[0].'_'.$rb[1];}}
return $rt;}

static function findlast($dr,$pr,$nod){//next table
$r=self::choose($dr,$pr,$nod); return self::nextnod($r);}//
static function nextnod($r){if($r){$mx=max($r); asort($r); $i=0;
foreach($r as $v){$i++; if($v!=$i)return $i;} return $mx+1;} return 1;}
static function nextentry($r){if(!$r)return; ksort($r); $i=0; $n=isset($r['_menus_'])?1:0;//next free
foreach($r as $k=>$v){$i++; if(!isset($r[$i-$n]) && is_numeric($k))return $i-$n;}
if($n)unset($r['_menus_']); $rb=array_keys($r); $max=$rb?(int)max($rb)+1:1; return $max;}
static function exists($dr,$nod){$f=self::url($dr,$nod); if(is_file($f))return true;}
/*static function exentry($dr,$nod,$k){$f=self::url($dr,$nod);
if(is_file($f))include $f; if(isset($r[$k]))return true;}*/

static function goodtable($d){//table_line§col
[$dn,$vn]=cprm($d); [$dr,$da]=split_one('/',$dn);
if(!$da){$da=$dr;$dr='';} [$nd,$bs,$va,$op]=expl('_',$da,4);
if($op){$da=$nd.'_'.$bs.'_'.$va; $r=self::read($dr,$da,$op);}
if($da && !isset($r))$r=self::read($dr,$da);
if(!$r)$r=self::read($dr,$nd.'_'.$bs,$va);
return $vn?$r[$vn]:$r;}

static function goodtable_b($d){$da=''; $row=''; $ob=0; $dr='';//table§line|col
if(strpos($d,'/'))[$dr,$p]=split_one('/',$d); else $p=$d;
if(strpos($p,'§'))[$p,$row]=expl('§',$p); else $row='';//row
if(strpos($row,'|'))[$row,$col]=expl('|',$row); else $col='';//col
[$bs,$nd,$nb]=expl('_',$p,3);
if($nb)$da=$bs.'_'.$nd.'_'.$nb; else $da=$bs.'_'.$nd;
if($row)$r=self::row($dr,$da,$row,0); else $r=self::read($dr,$da);//is_numeric($col)?0:1
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
if($r)foreach($r as $k=>$v)foreach($v as $ka=>$va)if($rh[$ka]??'')$rb[$k][$rh[$ka]]=$va; return $rb;}
static function select($dr,$nod,$d,$n=0){$r=self::read($dr,$nod,'',1); $rb=[];
if($r)foreach($r as $k=>$v)if($v[$n]==$d)$rb[$k]=$v; return $rb;}
static function strip($dr,$nod){$r=self::read($dr,$nod,'',1);
if($r)foreach($r as $k=>$v)foreach($v as $ka=>$va)$r[$k][$ka]=stripslashes($va); return $k;}
static function prep($b,$d){$r=self::read($b,$d,'',1); $rb=[];
if($r)foreach($r as $k=>[$ka,$va])$rb[$ka][$k]=$va; return $rb;}
static function two($b,$d,$rh=[]){$r=self::read($b,$d,'',1,$rh); $rb=[];
if($r)foreach($r as $k=>[$ka,$va])$rb[$ka]=$va; return $rb;}

static function kv($b,$d,$u=1){return self::col($b,$d,0,$u);}
static function kx($b,$d,$n=0,$rh=[]){$r=self::read($b,$d,'',1,$rh); $rb=[];//like col
if($r)foreach($r as $k=>$v)$rb[$k]=$v[$n]; return $rb;}
static function kn($b,$d,$n=0,$n2=1,$rh=[]){$r=self::read($b,$d,'',1,$rh); $rb=[];
if($r)foreach($r as $k=>$v)$rb[$v[$n]]=$v[$n2]; return $rb;}
static function find_k($dr,$nod,$d,$n=0){$r=self::read($dr,$nod,'',1);
if($r)foreach($r as $k=>$v)if($v[$n]==$d)return $k;}
static function find($dr,$nod,$d,$n=0,$o=''){$r=self::read($dr,$nod);//like row
if($r)foreach($r as $k=>$v)if($v[$n]==$d)$in=$k; if(!isset($in))return; $m='_menus_';
if($o && isset($r[$m]))return array_combine_a($r[$m],$r[$in]); else return $r[$in];}

//filters
static function format($r){foreach($r as $k=>$v)$r[$k]=[$v]; return $r;}
static function clb($r,$n){$rb=[]; foreach($r as $k=>$v)$rb[$k]=$v[$n]; return $rb;}
static function cat($r,$n,$o=''){$rb=[]; foreach($r as $k=>$v)$rb[$v[$n]??$v]=$k; return $o?array_flip($rb):$rb;}
static function tri($r,$n,$d){$rt=[]; foreach($r as $k=>$v)if($v[$n]==$d)$rt[$k]=$v; return $rt;}
static function sort($r,$n,$o=''){$rt=array_keys_r($r,$n); if($o)arsort($rt); else asort($rt);
foreach($rt as $k=>$v)$rt[$k]=$r[$k]; return $rt;}
static function order($r,$n){$b='_menus_'; $i=0; if(isset($r[$b])){$rt[$b]=$r[$b]; unset($r[$b]);}
$rc=self::clb($r,$n); arsort($rc); foreach($rc as $k=>$v)$rt[]=$r[$k]; return $rt;}
static function reorder($r){$b='_menus_'; $i=0; if(isset($r[$b])){$rt[$b]=$r[$b]; unset($r[$b]);}
foreach($r as $k=>$v){$i++; $rt[$i]=$v;} return $rt;}
static function move($r,$id,$to){$rk=$r[$id]; unset($r[$id]); $i=0; $rt=[];
foreach($r as $k=>$v){if($k==$to){$i++; $rt[$i]=$rk;} $i++; $rt[$k=='_menus_'?$k:$i]=$v;} return $rt;}
static function moveafter($r,$id,$to){$rk=$r[$id]; unset($r[$id]); $i=0; $rt=[];
foreach($r as $k=>$v){$i++; $rt[$k=='_menus_'?$k:$i]=$v; if($k==$to){$i++; $rt[$i]=$rk;}} return $rt;}
static function displace($r,$id,$to){if($id==$to)return $r; $rk=$r[$id]; unset($r[$id]); $rt=[];
foreach($r as $k=>$v){if($k==$to)$rt[$id]=$rk; $rt[$k]=$v;} return $rt;}
static function walk($r,$n,$fn,$p){foreach($r as $k=>$v){$r[$k][$n]=$fn($k,$v[$n],$v,$p);} return $r;}
static function walk_k($r,$fn){foreach($r as $k=>$v){$kb=$fn($k,$v); $rt[$kb]=$v;} return $rt;}
static function nb($r){$i=0; foreach($r as $k=>$v){$i++; $rt[$i]=[$v];} return $rt;}//prep
static function prevnext($r,$d){$keys=array_keys($r);
foreach($keys as $k=>$v)if($v==$d)return [$keys[$k-1],$keys[$k+1]];}
static function copy($da,$na,$db,$nb){
$r=self::read($da,$na); self::save($db,$nb,$r); return $r;}
static function num($dr,$nod,$d){$r=self::read($dr,$nod); $i=0;
foreach($r as $k=>$v){$i++; if($k==$d)return $i;}}
static function push($dr,$nod,$r){if(!is_array($r))$r=[$r];
return self::modif($dr,$nod,$r,'push');}
static function append($ra,$d){[$a,$b]=split_right('/',$d,1);
$r=self::read($a,$b); foreach($r as $k=>$v)if(!$ra[$k])$ra[$k]=$v; return $ra;}
static function reverse($r){$rh=val($r,'_menus_'); if($rh)unset($r['_menus_']);
if($r){$r=array_reverse($r); array_unshift($r,$rh);} return $r;}
static function merge($r,$dr,$nd){$rt=self::read($dr,$nd,'',1); return array_merge_b($r,$rt);}
static function ses($v,$dr,$nod,$u){return $_SESSION[$v]=$_SESSION[$v]??self::col($dr,$nod,0);}
static function json($dr,$nod,$in='',$u=''){$r=self::read($dr,$nod,$in,$u); return mkjson($r);}
static function bt($b,$p,$d=''){$u=($b?$b:'users').'_'.ajx($p).($d?'-'.ajx($d):'');
return lj('grey','popup_msql__3_'.$u,pictit('msql2',$p));}
}
?>