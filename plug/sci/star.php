<?php //star
class star{
static $conn=1;
static $default='81693,99461,88601';

static function req($sq){$ret='';
if($sq['hip']??'')$ret.='hip'.implode(',hip',$sq['hip']).',';
if($sq['hd']??'')$ret.='hd'.implode(',hd',$sq['hd']).',';
if($sq['ra']??[])$ret.='ra>'.substr($sq['ra'][0],1).',ra<'.substr($sq['ra'][1],1).',';
if($sq['dc']??[])$ret.='dc>'.substr($sq['dc'][0],1).',dc<'.substr($sq['dc'][1],1).',';
if($sq['ds'][0]??'')$ret.='dist'.$sq['ds'][0].',';
if($sq['ds'][1]??'')$ret.='dist'.$sq['ds'][1].',';
return btn('txtx','Query: '.input('',$ret,'48'));}

static function simbad($sq){$ret='';
if($sq['hip']??''){$hip=$sq['hip'][0]; $ret='hip'.$hip; }
if($sq['hd']??''){$hd=$sq['hd'][0]; $ret='hd'.$hd;}
if($ret && count($sq)==1)return lj('txtx','popup_simbad,call___'.$ret,pictxt('stars','Simbad'));
if(isset($sq['ra']) && count($sq['ra'])==2)$ret.='ra>'.(substr($sq['ra'][0],1)).'&ra<'.(substr($sq['ra'][1],1));
if(isset($sq['dc']) && count($sq['dc'])==2)$ret.='&dec>'.substr($sq['dc'][0],1).'&dec<'.substr($sq['dc'][1],1);
//if($sq['ds']??[])$ret.='&plx<'.maths::pc2mas(substr($sq['ds'][0],1)).'&plx>'.maths::pc2mas(substr($sq['ds'][1],1));
if($sq['ds']??[])$ret.='&Distance.unit=pc&Distance.distance>'.maths::al2pc(substr($sq['ds'][0],1));
if($sq['ds'][1]??'')$ret.='&Distance.distance<'.maths::al2pc(substr($sq['ds'][1],1)).'';
return lkt('txtx',simbad::url($ret),pictxt('url','simbad (id)'));}//.' '.input('',$ret)

//http://simbad.u-strasbg.fr/simbad/sim-coo?Coord=10h30+%2B12d20&Radius=15&Radius.unit=arcmin
static function simbad2($sq){$f='';
$ra=substr($sq['ra'][0]??'',1); $dc=substr($sq['dc'][0]??'',1); if(!$ra)return;
$f.='Coord='.maths::deg2ra($ra).maths::deg2dec($dc);
$f.='&Radius='.($sq['radius']??'15').'&Radius.unit=arcmin';
return lkt('txtx','http://simbad.u-strasbg.fr/simbad/sim-coo?'.($f),pictxt('url','simbad (coords)')).' ';}

static function esa($sq){
//http://sky.esa.int/?target=288.94440614809827 70.24341933163889
//http://aladin.unistra.fr/AladinLite/?target=16 45 4.185-43 58 32.44&fov=10.99&survey=P/DSS2/color
}

static function info($p,$o){$pb=$p;
if($o=='hd')$n=1; else $n=8;//hip
if($p=='Oomo'){$p='Yooma'; $n=0;}
if($p=='Galactic center'){$p='Agitarius A'; $n=0;}
$ret=self::call($p,2);
$r=msql::find('','ummo_exo_5',$p,$n,1); if($r)$ret.=tabler($r);
$r=msql::find('','ummo_aliens_5',$r['HD'],0,1); if($r)$ret.=tag('blockquote','',nl2br($r['infos']));
$ret.=lj('txtx','popup_starvue,call___'.$pb,pictxt('target','vue')).' ';
$ret.=lj('txtx','popup_simbad,call___'.$pb,pictxt('stars','Simbad'));
//$ret.=self::simbad('hd'.$pb);
return $ret;}

static function infosrq($sq){
$r=json_decode($sq,true);
$bt=self::req($r).br();
return $bt;}

static function sq($p){
$p=str_replace(["\n","\t","&#nbsp;",' '],'',strtolower($p));
$pr=explode(',',$p); $sq=[]; $verb=0; $n='';
if($pr)foreach($pr as $k=>$v){$t=''; $n='';
	if(strpos($v,'<')){[$t,$n]=explode('<',$v); $s=-1;}
	elseif(strpos($v,'>')){[$t,$n]=explode('>',$v); $s=1;}
	elseif(strpos($v,'=')){[$t,$n]=explode('=',$v); $s=0; if($t=='verbose')$n='';}
	elseif(substr($v,0,2)=='hd'){$t='hd'; $n=substr($v,2);}
	elseif(substr($v,0,3)=='hip'){$t='hip'; $n=substr($v,3);}
	elseif(is_numeric($v)){$t='hip'; $n=$v;}
	elseif($v=='yooma'){$t='hip'; $n=999999;}
	if($t=='hd')$sq['hd'][]=$n;
	elseif($t=='hip')$sq['hip'][]=$n;
	elseif($t=='ra' && $n){
		if(substr($n,-1)=='d' or substr($n,-1)=='°')$n=substr($n,0,-1);
		else $n*=15;//hours2deg
		$sq['ra'][]=($s==1?'>':($s==-1?'<':'=')).(is_numeric($n)?$n:maths::ra2deg($n));}
	elseif($t=='dc' && $n)$sq['dc'][]=($s==1?'>':($s==-1?'<':'=')).(is_numeric($n)?$n:maths::dec2deg($n));
	elseif($t=='dist' && $n){$sq['ds'][]=($s==1?'>':($s==-1?'<':'=')).$n;}
	elseif($t=='radius'){
		if(substr($n,-3)=='rad')$n=rad2deg(substr($n,0,-3));
		elseif(substr($n,-3)=='mas')$n=maths::mas2deg(substr($n,0,-3));
		elseif(substr($n,-1)=='d' or substr($n,-1)=='°')$n=substr($n,0,-1);
		elseif(substr($n,-1)=='m')$n=maths::ra2deg('00h'.str_pad(substr($n,0,-1),2,0,STR_PAD_LEFT).'m');
		elseif(substr($n,-1)=='h')$n=maths::ra2deg(str_pad(substr($n,0,-1),2,0,STR_PAD_LEFT).'h00m');
		elseif(!is_numeric($n))$n=maths::ra2deg($n);
		$sq['radius']=$n;}
	elseif(is_numeric($n))$sq['hip'][]=$n;
	elseif($v=='verbose')$sq['verbose']=1;}// or $t=='margin'
$sq=self::bounds($sq);
return $sq;}

static function bounds($sq){
if(isset($sq['radius'])){$ra=''; $dc=''; $n=$sq['radius'];
	if(!isset($sq['ra'][0])){$w='';
		if(isset($sq['hip'][0])){$w='hip="'.sql::qres($sq['hip'][0]).'"'; unset($sq['hip']);}
		if(isset($sq['hd'][0])){$w='hd="'.sql::qres($sq['hd'][0]).'"'; unset($sq['hd']);}
		if($w)[$ra,$dc]=sql::call('select ra,dc from hipparcos where '.$w,'w',0); if($ra)$ra*=15;}
	else{$ra=substr($sq['ra'][0],1); $dc=$sq['dc'][0]??0; if($dc)$dc=substr($dc,1);}
	if($ra){$sq['ra'][0]='>'.($ra-$n); $sq['ra'][1]='<'.($ra+$n);}
	if($dc){$sq['dc'][0]='>'.($dc-$n); $sq['dc'][1]='<'.($dc+$n);}
	$ds=$sq['ds'][0]??0; $ds=substr($ds,1); if($ds && substr($ds,0,1=='=')){
		$sq['ds'][0]='>'.($ds-$n); $sq['ds'][1]='<'.($ds+$n);}
	$mg=$sq['mg'][0]??0; $mg=substr($mg,1); if($mg){
		$sq['mg'][0]='>'.($mg-$n); $sq['mg'][1]='<'.($mg+$n);}}
if(isset($sq['verbose']))pr($sq); //if(auth(6))pr($sq);//
return $sq;}

static function build($sq,$o=''){$r=[]; $wr=[]; $w='';
if($sq)foreach($sq as $k=>$v){
	if($k=='ra')foreach($v as $ka=>$va)$sq[$k][$ka]=substr($va,0,1).substr($va,1)/15;//hipparcos ra is on 24h
	if($k=='ds')foreach($v as $ka=>$va)$sq[$k][$ka]=substr($va,0,1).maths::al2pc(substr($va,1));}
if($hip=val($sq,'hip'))$wr['or'][]='hip in("'.implode('","',$hip).'")';
if($hd=val($sq,'hd'))$wr['or'][]='hd in("'.implode('","',$hd).'")';
if($ra=val($sq,'ra'))$wr['and'][]='ra'.implode(' and ra',$ra);
if($dc=val($sq,'dc'))$wr['and'][]='dc'.implode(' and dc',$dc);
if($ds=val($sq,'ds'))$wr['and'][]='dist'.implode(' and dist',$ds);
if($mg=val($sq,'mg'))$wr['and'][]='mag'.implode(' and mag',$ds); //p($wr);
if($and=val($wr,'and'))$w=implode(' and ',$and);
if($or=val($wr,'or'))$w=implode(' or ',$or);
$cols=['hd','hip','rarad','decrad','dist','spect','mag'];
if($o)array_push($cols,'lum','ra','dc');
if($w)$r=sql::call('select '.implode(',',$cols).' from hipparcos where '.$w.'','',0);//auth(6)?1:
if($r)foreach($r as $k=>$v){//if(round($v[4])<99999)
	$r[$k][2]=maths::deg2ra(rad2deg($v[2]));//
	$r[$k][3]=maths::deg2dec(rad2deg($v[3]));//
	$r[$k][4]=$v[4]==100000?'extragalactic':maths::pc2al($v[4]);
	if($o){
		$r[$k][6]=round($v[6],4);
		$r[$k][7]=round($v[7],4);
		$r[$k][8]=round($v[8],4);}}//p($r);
return $r;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
if(strpos($p,'§')!==false){[$p,$t]=cprm($p);//obsolete
	return lj('txtx','popup_star,call___'.ajx($p).'_'.$o,pictxt('stars',$t==1?$p:$t)).'';}
if($o && $o!=2)return lj('txtx','popup_star,call___'.ajx($p),pictxt('stars',$o==1?$p:$o)).'';
$sq=self::sq($p); if(!$sq)return 'no star found in Hipparcos catalog';
$r=self::build($sq,$o);
$bt=lj('txtx','popup_star,infosrq___'.ajx(json_encode($sq)),picto('info2').nbof(count($r),16)).' ';
$bt.=self::simbad($sq).' ';
$bt.=self::simbad2($sq);
$rb=array_column($r,1); $p=implode(',',$rb);
$bt.=lj('txtx','popup_starmap4,build___'.$p,pictxt('map','map2d')).' ';
$bt.=lj('txtx','popup_starmap2,build___'.$p,pictxt('map','map3d')).' ';
$bt.=lj('txtx','popup_iframe__xr_/app/star3d/'.$p.'___autosize',pictxt('galaxy2','3d'));
if($o==2)$bt='';//starinfos
if($r){
	$rh=['hd','hip','RA (h-m-s)','dec (d-m-s)','dist (al)','spect','mag'];
	if($o)array_push($rh,'lum','RA (deg)','DEC (deg)');
	array_unshift($r,$rh);
	return scroll($r,tabler($r,1),20,526,526).$bt;}
else return btn('popdel',nms(11).' '.nms(16)).$bt;}

static function menu($p,$o,$rid){
$j=$rid.'_star,call_inp'.$rid.'_2__'.$o;
$ret=inputj('inp'.$rid,$p?$p:self::$default,$j,'',61).' ';
$ret.=lj('',$j,picto('ok')).' ';
$ret.=hlpbt('star');
return $ret;}

static function home($p,$o){
$rid=randid('star'); $ret='';
//$o add cols to results
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::call($p,$o);
//$bt.=msqbt('',nod('star_1'));
return $bt.divd($rid,$ret);}
}
?>