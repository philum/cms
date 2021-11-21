<?php
//philum_plugin_profil

//js
function profil_js($gps){
if($gps)list($lat,$lon)=explode('/',$gps); else{$lat=2.23; $lon=48.83;}
return "
function geo(){
	if(navigator.geolocation)
		navigator.geolocation.getCurrentPosition(gps_ok,gps_ko,{enableHighAccuracy:true, timeout:10000, maximumAge:600000});
	else console.log('navigateur non html5');}
function gps_ok(position){
	var geolat=position.coords.latitude;
	var geolog=position.coords.longitude;
	getbyid('gps').value=geolog+'/'+geolat;}
function gps_ko(error){switch(error.code){
	case error.PERMISSION_DENIED: console.log('refus utilisateur'); break;      
	case error.POSITION_UNAVAILABLE: console.log('localisation impossible'); break;
	case error.TIMEOUT: console.log('pas de réponse'); break;}}
function initialize(){var mapProp={
	center:new google.maps.LatLng(".$lon.",".$lat."),zoom:15,
	mapTypeId:google.maps.MapTypeId.ROADMAP};
	var map=new google.maps.Map(document.getElementById('googleMap'),mapProp);}
include('http://maps.googleapis.com/maps/api/js',function(){
	google.maps.event.addDomListener(window,'load',initialize);});
";}

//plugin_func('profil','profil_build',$p,$o);
/*function profil_build($p,$o){
$ret=$p.'-'.$o;
return $ret;}*/
function squ($bs,$v,$w){}

function profil_sav($p,$o,$res){$r=ajxr($res);
$rb=sesmk('mysqli_profil'); $i=0;
if($rb)foreach($rb as $k=>$v){$ra[$k]=$r[$i]; $i++;}
$id=sql('id','profil','v','user="'.$r[0].'"');
if($id)qr('update '.qd('profil').' set '.implode(',',atmrup($ra,'')).' where user="'.$r[0].'" limit 1');
else insert('profil',mysqlra($ra,1));
return btn('txtyl','ok');}

function profil_avatar($u){req('admin'); $f=avatar($u);
return image('/'.$f,'48','48',ats('vertical-align:0px;'));}

function profil_form($r,$o=''){
//$ret=balb('h2','','My Profil :)');
$ret=hidden('','user',ses('USE'));
//$ret.=divc('',btn('popw',ses('USE')));
$ret.=divc('',lj('txtsmall','popup_callp___admin_adm*avatar_1',btd('avatar',profil_avatar(ses('USE')))));
$ret.=divc('',input1('name',val($r,'name')).btn('popw','identité'));
$ret.=divc('',input1('com',val($r,'com')).btn('popw','présentation'));
$ret.=hidden('cp','cp','0');
//$cp=bal('input',array('type'=>'text','id'=>'cp','value'=>$r['cp'],'onkeyup'=>"num_finger('cp',5);"),'');
//$ret.=divc('',$cp.btn('popw','Code postal'));
$ret.=divc('',input1('gps',$r['gps']).ljb('popw','geo()','','GPS'));
$ret.=divc('',lj('popsav','bts_plug__xd_profil_profil*sav___user|name|com|cp|gps',nms(57)).btd('bts',''));
$ret.=divc('','').br();
if(!get('callj'))$ret.=divb('','','googleMap','height:200px;border:1px solid gray');
return divc('form',$ret);}//on2cols($rb,700,5)

#mysql
function mysqli_profil(){
return array('user'=>'var','name'=>'var','com'=>'var','cp'=>'int','gps'=>'var','photo'=>'var','day'=>'int');}

function profile_init($b){ses($b,qd($b));
mysql::install($b,mysqli_profil(),0);}

//load
function profil_datas($ud){
return sql('id,user,name,com,cp,gps,day','profil','r','user="'.$ud.'"');}

/*function profil_user($ud){$r=profil_datas($ud); //echo $ud; p($r);
$ret.=divc('',profil_avatar($r['user'])).br();
//$ret.=divc('',btn('txtx','Nom').btn('popbt',$r['user'])).br();
if($r['com'])$ret.=divc('',btn('txtx','Présentation').btn('popbt',$r['com'])).br();
$ret.=divc('',btn('txtx','Localisation').btn('popbt',profil_distance($r['gps']))).br();
return $ret;}*/

//plugin('profil',$p,$o)
function plug_profil($p,$o){$rid='plg'.randid(); //echo $p.'-'.$o;
profile_init('profil');
$r=profil_datas(ses('USE')); //p($r);
if(strpos($r['gps'],'/')===false)$r['gps']='0/0';
//Head::add('js','http://maps.googleapis.com/maps/api/js');
Head::add('jscode',profil_js($r['gps']));
$ret=profil_form($r,$o);
//$ret.=js_code(profil_js($r[5]));
return divd($rid,$ret);}

?>