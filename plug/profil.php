<?php
//philum_plugin_profil (for troc)

/*function mysql_values($r,$d){$ra=sesmk($d); $i=0;
foreach($ra as $k=>$v){$rb[$k]=$r[$i]; $i++;}
return $rb;}*/

//js
function profil_js($gps){
list($lat,$lon)=explode('/',$gps);
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

//plugin_func('profil','profil_build',$p,$o);
/*function profil_build($p,$o){
$ret=$p.'-'.$o;
return $ret;}*/
function squ($bs,$v,$w){}

function profil_sav($p,$o,$res){$r=ajxr($res); //p($r);
$ra=mysql_values($r,'mysql_profil'); //p($ra);
$id=sql('id','profil','v','user="'.$r[0].'"');
if($id)msquery('update '.$_SESSION['profil'].' set '.implode(',',atmrup($ra)),'').' where user="'.$r[0].'" limit 1');
else insert('profil',mysqlra($ra));
return btn('txtyl','ok');}

function profil_avatar($u){req('admin'); $f=avatar($u);
return image($f,'48','48',ats('vertical-align:0px;'));}

function profil_form($r,$o=''){
//$ret=bal('h2','My Profil :)');
$ret.=hidden('','user',ses('USE'));
//$ret.=divc('',btn('popw',ses('USE')));
$ret.=divc('',lj('txtsmall','popup_callp___admin_adm*avatar_1',btd('avatar',profil_avatar(ses('USE')))));
$ret.=divc('',input(1,'name',$r['name']).btn('popw','Nom & Prénom'));
$ret.=divc('',input(1,'com',$r['com']).btn('popw','petit commentaire (optionnel)'));
$cp=balise('input',array(1=>'text',3=>'cp',4=>$r['cp'],21=>"num_finger('cp',5);"),'');
$ret.=divc('',$cp.btn('popw','Code postal'));
$ret.=divc('',input(1,'gps',$r['gps']).ljb('popw','geo()','','GPS'));
$ret.=divc('',lj('popsav','bts_plug__xd_profil_profil*sav___user|name|com|cp|gps','Enregistrer les modifications').btd('bts',''));
$ret.=divc('','').br();
if(!get('callj'))$ret.=divb('|googleMap|height:200px;border:1px solid gray;','');
return divc('form',$ret);}//on2cols($rb,700,5)

#mysql
function mysql_profil(){
return array('user'=>'var','name'=>'var','com'=>'var','cp'=>'int','gps'=>'var','photo'=>'var','day'=>'int');}

function profil_mysql(){
reqp('mysql'); $msq=new mysql(''); $p='profil'; $msq->table($p); 
$r=mysql_profil(); $msq->create($r);
return $msq->ret;}

//load
function profil_datas($ud){
return sql('id,user,name,com,cp,gps,day','profil','r','user="'.$ud.'"');}

//http://www.awelty.fr/blog/developpement-web/php.html
//En savoir plus sur http://www.awelty.fr/blog/developpement-web/php.html
/*function algo_gps_distance($lat,$lon,$peri){//lieux dans un périmètre donné
$formule="(6366*acos(cos(radians($lat))*cos(radians(`lat`))*cos(radians(`lon`) -radians($lon))+sin(radians($lat))*sin(radians(`lat`))))";
$sql="SELECT ville,$formule AS dist FROM villes WHERE $formule<='$peri' ORDER by dist ASC";
$r=sql_b($sql,'',1); p($r);
return $r;}*/

function profil_townfromgps($gps){list($lat,$lon)=explode('/',$gps); $mg=6;
return sql_b('select ville from villes where lat_deg<"'.($lat+$mg).'" and lat_deg<"'.($lat-$mg).'" and lon_deg<"'.($lon+$mg).'" and lon_deg>"'.($lon-$mg).'"','v'); //p($r);
}

function get_distance_m($lat1,$lng1,$lat2,$lng2){
$earth_radius=6378137;//Terre=sphère de 6378km de rayon
$rlo1=deg2rad($lng1); $rla1=deg2rad($lat1);
$rlo2=deg2rad($lng2); $rla2=deg2rad($lat2);
$dlo=($rlo2-$rlo1)/2; $dla=($rla2-$rla1)/2;
$a=(sin($dla)*sin($dla))+cos($rla1)*cos($rla2)*(sin($dlo)*sin($dlo));
$d=2*atan2(sqrt($a),sqrt(1-$a));
return round($earth_radius*$d).' Km';}

function profil_distance($gpsv){//echo $gpsu;
$gpsu=sql('gps','profil','v','user="'.ses('USE').'"');
$gpsru=explode('/',$gpsu); $gpsrv=explode('/',$gpsv);
//$da=$gpsru[0]-$gpsrv[0]; $db=$gpsru[1]-$gpsrv[1];
//$r=algo_gps_distance($gpsru[0],$gpsru[1],100); 
if($gpsv && $gpsu)return get_distance_m($gpsru[1],$gpsru[0],$gpsrv[1],$gpsrv[0]);}

/*function profil_user($ud){$r=profil_datas($ud); //echo $ud; p($r);
$ret.=divc('',profil_avatar($r['user'])).br();
//$ret.=divc('',btn('txtx','Nom').btn('popbt',$r['user'])).br();
if($r['com'])$ret.=divc('',btn('txtx','Présentation').btn('popbt',$r['com'])).br();
$ret.=divc('',btn('txtx','Localisation').btn('popbt',profil_distance($r['gps']))).br();
return $ret;}*/

//plugin('profil',$p,$o)
function plug_profil($p,$o){$rid='plg'.randid(); //echo $p.'-'.$o;
profil_mysql();
$r=profil_datas(ses('USE')); //p($r);
if(strpos($r['gps'],'/')===false)$r['gps']='0/0';
Head::add('js','http://maps.googleapis.com/maps/api/js');
Head::add('jscode',profil_js($r['gps']));
//ses('jscode',profil_js($r[5]));
$ret=profil_form($r,$o);
return divd($rid,$ret);}

?>