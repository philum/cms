<?php //philum/b/meteo
class meteo{
static $a=__CLASS__;

static function umenu(){
$r=['75101'=>'Paris','92012'=>'Boulogne-Billancourt','35238'=>'Rennes','59350'=>'Lille','67482'=>'Strasbourg','69381'=>'Lyon','06088'=>'Nice','13210'=>'Marseille','34172'=>'Montpellier','66136'=>'Perpignan','31555'=>'Toulouse','64102'=>'Bayonne','33063'=>'Bordeaux'];//,'29019'=>'Brest','2B033'=>'Bastia','44109'=>'Nantes','63113'=>'Clermont-Ferrand'
$j='mto_meteo,call___'; $ret='';
foreach($r as $k=>$v)$ret.=lj('',$j.$k.'_1',$v);
return divc('list',$ret);}
//return select_js($id,$r,$j,'75101');

/*{"town":"Paris 1er Arrondissement","update":"2021-03-04T08:42:37+0100","rr10":0.1,"rr1":0.1,"weather":40,"temp2m":12,"wind10m":10,"gust10m":26,"dirwind10m":312,"probarain":40,"probafog":30,"probafrost":0,"probawind70":0,"probawind100":0,"gustx":26,"iso0":"","station":"Paris (75)","temperature":["10.0","\u00b0C"],"barometer":["1022.5","hPa"],"rainfall":["0.0","mm"],"solar_radiation":["70","W/m2"],"wind_speed":["7.2","km/h"],"windchill":["8.5","\u00b0C"],"windgust_speed":["21.6","km/h"],"outside_humidity":["78","%"],"sunrise":"07:24","sunset":"18:40","diffday":4,"moon_age":20.3}*/

static function goodmoon($n=1){
$cy=29.53; $it=$cy/8; $e=round($n/$it);
$ra=[127761,127762,127763,127764,127765,127766,127767,127768,127761];
return '&#'.$ra[$e].';';}

static function render($r,$f){$ret=''; //pr($r);
$tmp=$r['temperature'][0]??''; if(!$tmp)$tmp=$r['temp2m']??'';
$n=$r['weather']; $rw=msql::find_r('','public_weather_4',$n?$n:1); list($n,$nm,$pc,$as)=$rw;
$ic=$as?$as:picto($pc);
/**/$rp=['smallclouds','localclouds','localfog','localwind','locallittlerain','localhail','localrain','localwindyrain','localstorms','localstormyrain'];
$d1=strtotime($r['sunrise']); $d2=strtotime($r['sunset']); $dt=time();
$night=$dt>$d2||$dt<$d1?1:0; if($night){if($pc=='sunshine')$pc='moon'; elseif(in_array($pc,$rp))$pc.='2'; $ic=picto($pc);}
//$ic=image('imgb/meteo/'.$ic.'.svg',32,32);
//$ri=[127785=>'orage',127784=>'neige',127783=>'bruine',127783=>'pluie',127781=>'nuage',127780=>'soleil'];//9729//b/w
//$ri=[9889=>'orage',10052=>'neige',128166=>'bruine',9748=>'pluie',9925=>'nuage',127774=>'soleil'];//color
//foreach($ri as $k=>$v)if(stripos($nm,$v)!==false)$ic='&#'.$k.';';
$nfo=$nm.' - ';
if(($v=$r['probarain'])>30)$nfo.='Probabilité de pluie : '.$v.'% - ';
if(($v=$r['probafog'])>30)$nfo.='Probabilité de brouillard : '.$v.'% - ';
if(($v=$r['probafrost'])>30)$nfo.='Probabilité de gel : '.$v.'% - ';
if(($v=$r['wind_speed'][0])>30)$nfo.='Vitesse du vent : '.$v.'Km/h - ';
if(($v=$r['windgust_speed'][0])>50)$nfo.='Rafales de vent : '.$v.'Km/h - ';
if(($v=$r['rainfall'][0])>50)$nfo.='Cumul de pluie : '.$v.'mm - ';
if(($v=$r['solar_radiation'][0])>200)$nfo.='Radiation solaire : '.$v.'W/m² - ';
$diffday=$r['diffday']>0?'+'.$r['diffday']:'-'.$r['diffday']; $nfo.='('.$diffday.' min de soleil) - ';
if(!$r['moon_age'])$r['moon_age']=1;
$nfo.=self::goodmoon($r['moon_age']).' '.$r['moon_phase'];
$ret.=lk(auth(6)?$f:'',$ic,att($nfo)).' ';//render
$ret.=togbub('meteo,umenu','',$r['town'],'txtx').' ';//$r['station']
if($tmp<0)$ic='degree0'; else $ic='degree'.(substr($tmp,0,1)+1); $ret.=picto($ic).$tmp.'&#8451; ';//°C
$ret.=picto('barometer').round($r['barometer'][0]).btn('small','hPa').' ';
$ret.=picto('humidity').$r['outside_humidity'][0].btn('small','%').' ';//'&#128167; '.
$ret.='&uarr;'.$r['sunrise'].' '.'&darr;'.$r['sunset'];//10548//10549//.' ('.$diffday.' min)'//
$ma=($r['moon_age'])/6; $mx=60; $mi=$mx/8;//&#127761;->&#127768;
for($i=0;$i<8;$i++)if($ma<$i)$mn=$i; $mo=127761+$mn; //$ret.='&#'.$mo.';';
//$phases=[1=>127761,127762,127763,127764,127765,127766,127767,127768,127761];
return divc('',$ret);}

static function build($p,$o){$ret='-'; $day=date('ymdH');
$insee=$p?$p:cookie('insee'); if(!$insee)$insee=75101;//92012
$rh=['day','insee','res']; $d='';
$r=msql::read('',nod('meteo_1'),$insee,'',$rh); //pr($r);
if($r[0]??'')if($r[0]==$day)$d=$r[1]??'';
$f='http://telex.ovh/api/meteo/uid:13,insee:'.($p?$p:$insee);
if(!$d){$d=read_file2($f); if($d!='null')msql::modif('',nod('meteo_1'),[$day,$d],'row','',$insee);}
$r=json_decode($d,true);
$r=utf_r($r,1); //pr($r);
if($r)$ret=self::render($r,$f);
else $ret=lj('','mto_meteo,build___75101','-');
return divd('mto',$ret);}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
if($o)cookie('insee',$p);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$bid='inp'.$rid;
$j=$rid.'_'.self::$a.',call__2__'.$rid.'___'.$bid;
$ret=inputj($bid,'insee',$j,'',1);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid();
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>