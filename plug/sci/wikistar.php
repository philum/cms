<?php //app

class wikistar{
static $conn=1;
static $a=__CLASS__;
static $default='wolf424';

static function url($p){$p=trim($p);
if(is_numeric($p))$p='hip'.$p;
//$p.='&NbIdent=1&Radius=2&Radius.unit=arcmin&submit=submit+id';
if(strpos($p,'=')===false && strpos($p,'&')===false)$pg='sim-id?Ident='; else $pg='sim-sam?Criteria=';
return 'https://fr.wikipedia.org/wiki/'.$pg.''.($p);}

static function build($u){//hip32578
$d=get_file($u); $dom=dom($d); 
$r=$dom->getElementsByTagName('table'); $n=count($r);
$rt=self::detect_table($r[3]);
$rt=self::cleanup($rt);
return $rt;}

static function cleanup($r){pr($r);
$p=explode('--',$r[0][0]);
$rb[$p[0]]=$p[1];
foreach($r as $k=>$v){
if(isset($v[1]))$v[1]=deln($v[1],' ');
$t='Origin of the objects types';
if(strpos($v[0],$t)!==false)$rb[$t]=$v[1];
if($k==2){$p=explode(' ',$v[1]);
	if($k==2)$t='ICRS'; if($k==3)$t='FK4';
	$rb['ICRS AD']=$p[0].'h'.$p[1].'m'.$p[2].'s';
	$rb['ICRS DC']=$p[3].'°'.$p[4].'"'.$p[5]."'";}
if($k==3){$p=explode(' ',$v[1]);
	$rb['FK4 AD']=$p[0].'h'.$p[1].'m'.$p[2].'s';
	$rb['FK4 DC']=$p[3].'°'.$p[4].'"'.$p[5]."'";}
if($k==4){$p=explode(' ',$v[1]);
	$rb['degAD']=$p[0].'°';
	$rb['degDC']=$p[1].'°';}
$t='Proper motions mas/yr';
if(strpos($v[0],$t)!==false){
	$p=explode(' ',$v[1]);
	$rb[$t.' AD']=$p[0];
	$rb[$t.' DC']=$p[1];}
$t='Radial velocity';
if(strpos($v[0],$t)!==false){$p=explode(' ',$v[1]); $rb[$t.' '.$p[0]]=$p[1];}
$t='Parallaxes (mas)';
if(strpos($v[0],$t)!==false){$p=explode(' ',$v[1]); $rb[$t]=$p[0];
	$rb['Distance (LY)']=maths::mas2al((float)$p[0]);}
$t='Spectral type';
if(strpos($v[0],$t)!==false){$p=explode(' ',$v[1]);
	$rb['Spectral type']=$p[0].' '.$p[1];}}
return $rb;}

static function getxt($el,$ret=''){$attr=''; $at='class';
if(!isset($el->tagName)){$el0=$el->parentNode;
	if($el0->hasAttribute($at)!=null)$attr=$el0->getAttribute($at); $tg=$el0->tagName; //echo $tg.', '.$attr.' ; ';
	if($tg!='div')//$attr!='info-tooltip' && 
	return $ret.$el->textContent;}
$el=$el->firstChild;
if($el!=null)$ret=self::getxt($el,$ret);
while(isset($el->nextSibling)){$el2=$el->nextSibling;
	$ret=self::getxt($el->nextSibling,$ret); $el=$el->nextSibling;}
return $ret;}

static function detect_table($dom){$rt=[];
if($dom)$r=$dom->getElementsByTagName('tr');
if($r)foreach($r as $k=>$v){$rt[$k]=[];
	//if($v->childNodes)foreach($v->childNodes as $kb=>$el){}
	$rb=$v->getElementsByTagName('th'); if(!$rb['length'])$rb=$v->getElementsByTagName('td');
	if($rb)foreach($rb as $kb=>$el)$rt[$k][$kb]=clean_br(self::getxt($el));}//html2conn
return $rt;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$u=self::url($p);
$bt=lkt('',$u,picto('url').domain($u)).' ';
//for($i=0;$i<$n;$i++)$bt.=lj(active($i,$o),'smbd_simbad,call___'.ajx($p).'_'.$i,$i);
$r=self::build($u);
$ret=tabler($r);
return $bt.divd('smbd',$ret);}

static function callr($p){
$p=str_replace(' ','',$p);
if(!$p)return ['00h00m',"00°00'",'0'];
$u=self::url($p);
$r=self::build($u);
return [$r['ICRS AD'],$r['ICRS DC'],$r['Distance (LY)']];}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j=$rid.'_wikistar,call_'.$inpid.'_3_'.$p.'_'.$o;
$ret=inputj($inpid,$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid(self::$a); $ret='';
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}

}
?>