<?php //gaia
class gaia{

static function build($p){
$p=strtolower(str_replace(["&#nbsp;","\n","\t",','],',',$p));
$p=preg_replace('/( ){2,}/',' ',$p);
$pr=explode(',',$p); $sq=[]; $rb=[]; $w='';
if($pr)foreach($pr as $k=>$v){$t=''; $n=''; $v=trim($v);
	if(strpos($v,'<')){[$t,$n]=explode('<',$v); $s=0; $t=trim($t); $n=trim($n);}
	elseif(strpos($v,'>')){[$t,$n]=explode('>',$v); $s=1; $t=trim($t); $n=trim($n);}
	elseif(is_numeric($v))$n=trim($v);
	if($t=='ra' && $n)$sq['ra'][]=($s?'>':'<').($n);//gaia ra is on 360?
	elseif($t=='dc' && $n)$sq['dc'][]=($s?'>':'<').$n;
	elseif($t=='dist' && $n)$sq['ds'][]=($s?'<':'>').bcdiv(1,$n,10);//parallax
	elseif(is_numeric($n))$sq['gid'][]=$n;}//p($sq);
if($sq['gid']??'')$wr['or'][]='gid in("'.implode('","',$sq['gid']).'")';
if($sq['ra']??'')$wr['and'][]='ra'.implode(' and ra',$sq['ra']).'';
if($sq['dc']??'')$wr['and'][]='dc'.implode(' and dc',$sq['dc']).'';
if($sq['ds']??'')$wr['and'][]='parallax'.implode(' and parallax',$sq['ds']).'';//p($wr);
if($wr['and']??'')$w=implode(' and ',$wr['and']);
if($wr['or']??'')$w=implode(' or ',$wr['or']);
$cols=['gid','ra','dc','parallax','mag'];
$r=sql::call('select '.implode(',',$cols).' from gaia where '.$w.' order by ra asc limit 500','',0);//auth(6)?1:
if($r)foreach($r as $k=>$v){
	$rb[$k][0]=$v[0];
	$rb[$k][1]=maths::deg2ra($v[1]);
	$rb[$k][2]=maths::deg2dec($v[2]);
	if($v[3]<0)$v[3]=0-$v[3];
	$rb[$k][3]=maths::pc2al(bcdiv(1,$v[3],10)*1000);
	$rb[$k][4]=$v[4];}//p($r);
if($rb){
	$rh=['gid (Gaia ID)','RA (h-m-s)','dec (d-m-s)','dist (al)','mag'];
	array_unshift($rb,$rh);}
return $rb;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
$r=self::build($p,$o);
if($r)return scroll($r,tabler($r,1),20);
else return btn('txtyl',nms(11).' '.nms(16));}

static function menu($p,$o,$rid){$ret=input('inp'.$rid,$p,61).' ';
$ret.=lj('',$rid.'_gaia,call_inp_'.$o.$rid,picto('ok')).' ';
$ret.=hlpbt('gaia');
return $ret;}

static function home($p,$o){
$rid=randid('gaia'); $ret='';
//$o add cols to results
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::call($p,$o);
//$bt.=msqbt('',nod('gaia_1'));
return $bt.divd($rid,$ret);}

}
?>