<?php 
class geo{

static function profil_js($gps){
[$lat,$lon]=explode('/',$gps);
return "
function geo(){
if(navigator.geolocation)
	navigator.geolocation.getCurrentPosition(gps_ok,gps_ko,{enableHighAccuracy:true, timeout:10000, maximumAge:600000});
else alert('navigateur non de html5');}
function gps_ok(position){
	var geolat=position.coords.latitude;
	var geolog=position.coords.longitude;
	getbyid('gps').value=geolog+'/'+geolat;}
function gps_ko(error){switch(error.code){
	case error.PERMISSION_DENIED: alert('refus utilisateur'); break;      
	case error.POSITION_UNAVAILABLE: alert('localisation impossible'); break;
	case error.TIMEOUT: alert('pas de réponse'); break;}}
function initialize(){var mapProp={
	center:new google.maps.LatLng(".$lon.",".$lat."),
	zoom:15,
	mapTypeId:google.maps.MapTypeId.ROADMAP};
var map=new google.maps.Map(document.getElementById('googleMap'),mapProp);}

google.maps.event.addDomListener(window,'load',initialize);
";}

//http://www.awelty.fr/blog/developpement-web/php.html
//En savoir plus sur http://www.awelty.fr/blog/developpement-web/php.html
/*static function algo_gps_distance($lat,$lon,$peri){//lieux dans un périmètre donné
$formule="(6366*acos(cos(radians($lat))*cos(radians(`lat`))*cos(radians(`lon`) -radians($lon))+sin(radians($lat))*sin(radians(`lat`))))";
$sql="SELECT ville,$formule AS dist FROM villes WHERE $formule<='$peri' ORDER by dist ASC";
$r=sql::call($sql,'',1); p($r);
return $r;}*/

static function profil_townfromgps($gps){[$lat,$lon]=explode('/',$gps); $mg=6;
return sql::call('select ville from villes where lat_deg<"'.($lat+$mg).'" and lat_deg<"'.($lat-$mg).'" and lon_deg<"'.($lon+$mg).'" and lon_deg>"'.($lon-$mg).'"','v'); //p($r);
}

static function get_distance_m($lat1,$lng1,$lat2,$lng2){
$earth_radius=6378137;//Terre=sphère de 6378km de rayon
$rlo1=deg2rad($lng1); $rla1=deg2rad($lat1);
$rlo2=deg2rad($lng2); $rla2=deg2rad($lat2);
$dlo=($rlo2-$rlo1)/2; $dla=($rla2-$rla1)/2;
$a=(sin($dla)*sin($dla))+cos($rla1)*cos($rla2)*(sin($dlo)*sin($dlo));
$d=2*atan2(sqrt($a),sqrt(1-$a));
return round($earth_radius*$d).' Km';}

static function profil_distance($gpsv){//echo $gpsu;
$gpsu=sql('gps','profil','v','user="'.ses('USE').'"');
$gpsru=explode('/',$gpsu); $gpsrv=explode('/',$gpsv);
//$da=$gpsru[0]-$gpsrv[0]; $db=$gpsru[1]-$gpsrv[1];
//$r=algo_gps_distance($gpsru[0],$gpsru[1],100); 
if($gpsv && $gpsu)return get_distance_m($gpsru[1],$gpsru[0],$gpsrv[1],$gpsrv[0]);}

static function build($p,$o,$prm=[]){
$p=$prm[0]??$$p;
//$r=msql::read_b('',nod('geo_1'));//p($r);
$ret=$p.'-'.$o;
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_geo,build_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('geo');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
if(strpos($r['gps'],'/')===false)$r['gps']='0/0';
Head::add('js','http://maps.googleapis.com/maps/api/js');
Head::add('jscode',self::profil_js($r['gps']));
//$bt.=msqbt('',nod('geo_1'));
return $bt.divd($rid,$ret);}
}
?>