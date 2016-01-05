<?php
//philum_plugin_troc

function troc_js(){return "
function geo(){
if(navigator.geolocation)
	navigator.geolocation.getCurrentPosition(gps_ok,gps_ko,{enableHighAccuracy:true, timeout:10000, maximumAge:600000});
else alert('navigateur non de html5');
}
";}

//plugin_func('troc','troc_build',$p,$o);
function troc_build($p,$o){
$ret=$p.'-'.$o;
return $ret;}

function troc_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);//$resultant des champs
$ret=troc_build($p,$o);
return $ret;}

#arrays
function troc_transtype(){
return array('échange'=>'1','don'=>'2','prêt'=>'3','location'=>'4','vente'=>'5','recherche'=>'6');}
function troc_prop_attributs($id){
$r=array('Prix neuf','Année','Auteur','Taille','Vêtements');
foreach($r as $k=>$v)$ret[$v]=$k;
$ra=sql('prop','prop','k',''); //props déjà existantes
if($ra)$ret+=$ra; //p($ret);
$rb=sql('prop','prop','k','ib="'.$id.'"'); //props déjà utilisées
if($rb)foreach($rb as $k=>$v)unset($ret[$k]);
return $ret;}

function troc_array_obj(){return array('user'=>'var','obj'=>'var','type'=>'var','txt'=>'text','img'=>'var','state'=>'int','day'=>'int');}
function troc_array_prop(){return array('ib'=>'int','prop'=>'var','attr'=>'var');}

#SAV

//insert|update
function troc_sav($id,$rid,$res){$r=ajxr($res); //p($r);
$rb=array('obj'=>$r[0],'type'=>$r[1],'state'=>$r[2],'txt'=>trim($r[3]));
foreach($rb as $k=>$v)update('obj',$k,$v,'id',$id);
$rc=array_slice($r,4);
$rk=sql('id','prop','vr','ib="'.$id.'"'); //p($rk);
if($rk)foreach($rk as $k=>$v)update('prop','attr',$rc[$k],'id',$v,1);
return troc_edit($id,$rid);}

//new_obj
function troc_create_obj($rid,$idx,$res){$obj=ajxg($res); //p($r);
$r=troc_array_obj(); unset($r['id']); foreach($r as $k=>$v)$r[$k]='';
$r['user']=ses('USE'); $r['obj']=$obj; $r['day']=mkday(); $r['state']=1;//p($r);
if($obj)$id=insert('obj',mysqlra($r)); //if(!$id)return 'error';
return troc_edit($id,$rid);}

//add prop
function troc_prop_add($id,$rid,$res){$res=ajxg($res);
$ex=sql('id','prop','v','id="'.$id.'" and prop="'.$res.'"');
if($res && !$ex)insert('prop',mysqlra(array($id,$res,'')));
return troc_edit($id,$rid);}

//del
function troc_prop_del($d,$rid,$res){
list($k,$id)=explode('-',$d);
delete('prop',$k);
return troc_edit($id,$rid);}

function troc_del($id,$rid){
if($id)delete('obj',$id); 
msquery('DELETE FROM '.$_SESSION['prop'].' WHERE ib="'.$id.'"');
return troc_add($rid);}

#EDIT
#editor
function troc_edit($id,$rid){
if($id)$ra=sql('*','obj','a','id="'.$id.'"'); //pr($ra);
//list($id,$usr,$obj,$txt,$type,$img,$state,$day)=$ra; //$id=$ra['id'];
//nom
$ret=divc('row',btn('txtx','Désignation').input(1,'objet',$ra['obj'])).br();
//type
$ret.=divc('row',btn('txtx','Type de transaction').select_j('type','pfunc',$ra['type'],'troc/troc_transtype',$ra['type'],'0')).br();
//state
//$ret.=divc('row',checkbox_j('state',$ra['state'],'Ouvert / Fermé','Etat','txtx')).br();
$ret.=hidden('','state',1);
//description
//$ret.=btn('txtx','Description');
$ret.=divc('row',divedit('cntdescrpt','track','min-height:18px; width:400px;',$j,$ra['txt'])).br();
//props
$r=sql('id,prop,attr','prop','kvv','ib="'.$id.'"'); //p($r);
if($r)foreach($r as $k=>$v){$ky[]='k'.$k; $del='';
	$del=lj('popdel',$rid.'_plug___troc_troc*prop*del_'.$k.'-'.$id.'_'.$rid,pictit('sclose','Supprimer'));
	$j=$v[0]=='valeur'?'num_finger('.$k.',5);':'';
	$bal=balise('input',array(1=>'text',3=>'k'.$k,4=>$v[1],21=>$j),'');
	$ret.=divd('',$bal.btn('txtx',$v[0]).$del).br();}
//add_prop
$ret.=select_j('propadd','pfuncb','','troc/troc_prop_attributs/'.$id,'','0').' ';
$ret.=lj('popbt',$rid.'_plug___troc_troc*prop*add_'.$id.'_'.$rid.'_propadd',pictxt('add','Ajouter un Attribut'));
//sav
if($ky)$kys=implode('|',$ky); $ret.=br().br();//.hr().br();
if($id)$ret.=divc('right',lj('popbt',$rid.'_plug___troc_troc*objects',pictxt('left','Retour à la liste')).' '.lj('popsav',$rid.'_plug___troc_troc*sav_'.$id.'_'.$rid.'_objet|type|state|cntdescrpt|'.$kys,pictxt('save','Enregistrer')).' '.lj('popdel',$rid.'_plug___troc_troc*del_'.$id.'_'.$rid,pictxt('del','Supprimer')).' '.lj('popbt',$rid.'_plug___troc_troc*edit_'.$id.'_'.$rid,pictxt('reload','Rafraîchir')));
return divc('form',$ret);}

//designation
function troc_edit_designation($id,$rid){return divc('',btn('txtx','Désignation').' '.input(1,'objet',$obj).' '.lj('popbt',$rid.'_plug___troc_troc*create*obj_'.$rid.'_'.$id.'_objet',pictxt('add','Ajouter un Troc')));}//troc_create_obj

#READ

//profil
function troc_profil($u,$o){//echo $u;
list($rid,$bck)=explode('-',$o);
reqp('profil'); $r=profil_datas($u); //p($r); //$ret.=profil_user($u).br();
$ret.=divc('',profil_avatar($r['user'])).br();
$ret.=divc('',btn('popbt',$r['user'])).br();
if($r['com'])$ret.=divc('',btn('txtx','Présentation').btn('popbt',$r['com'])).br();
$ret.=divc('',btn('txtx','Localisation').btn('popbt',profil_townfromgps($r['gps']))).br();
$ret.=divc('',btn('txtx','Distance').btn('popbt',profil_distance($r['gps']))).br();
$ret.=lj('popbt',$rid.'_plug___troc_troc*'.$bck,pictxt('left','Retour à la liste')).' '.lj('popbt',$rid.'_plug___troc_troc*profil_'.$u.'_'.$o,pictxt('reload','Rafraîchir'));
return $ret;}

//détails
function troc_read_obj($id,$o){//echo $id;
list($rid,$bck)=explode('-',$o);
$ra=sql('user,obj,type,txt','obj','a','id='.$id); //p($ra);
foreach($ra as $k=>$v)$ret.=divc('',btn('txtx',$k).btn('popbt',$v)).br();
$r=sql('id,prop,attr','prop','kvv','ib="'.$id.''); //p($r);
$ret.=make_table($r);
$ret.=lj('popbt',$rid.'_plug___troc_troc*'.$bck,pictxt('left','Retour à la liste')).' '.lj('popbt',$rid.'_plug___troc_troc*read*obj_'.$id.'_'.$o,pictxt('reload','Rafraîchir'));
return $ret;}

//player
function troc_read_table($r,$rid,$ob,$picto){
$rh=array('id','Utilisateur','Désignation','Type de transaction','Description','Etat');
if($r)foreach($r as $k=>$v){
$usr=divc('',lj('popbt',$rid.'_plug___troc_troc*profil_'.$v[1].'_'.$rid.'-offers',pictxt('user',$v[1])));
$bt=lj('popbt',$rid.'_plug___troc_troc*read*obj_'.$v[0].'_'.$rid.'-offers',pictxt('view',$v[2]));
$rt[]=array($v[0],$usr,$bt,$v[3],$v[4],offon($v[5]));}
return make_tables($rh,$rt,'txtx','txtblc');}

//offres
function troc_offers(){$rid='plg'.randid(); troc_init();
$r=sql('id,user,obj,type,txt,state','obj','','');//order by day asc
return divd($rid,troc_read_table($r,$rid,'troc*read*obj','offers'));}
//recherches
function troc_searches(){$rid='plg'.randid(); troc_init();
$r=sql('id,user,obj,type,txt,state','obj','','type="recherche"'); //p($r);
return divd($rid,troc_read_table($r,$rid,'troc*read*obj','searches'));}
//objets
function troc_objects(){$rid='plg'.randid(); troc_init();
$r=sql('id,user,obj,type,txt,state','obj','','user="'.ses('USE').'"');
return divd($rid,troc_read_table($r,$rid,'troc*edit',''));}
//new
function troc_new(){$rid='plg'.randid(); troc_init();
$ret=troc_edit_designation('',$rid);
if(!auth(2))return plugin('login');
return divd($rid,$ret);}

//init
function troc_ses(){$qd=ses('qd'); 
ses('obj',$qd.'_obj'); ses('prop',$qd.'_prop');}

//mysql_init
function troc_mysql_obj(){$p='obj'; $r=troc_array_obj();
$ret=mysql_init($p,$r,1);//1=drop table on change $r !
return $ret;}
function troc_mysql_prop(){$p='prop'; $r=troc_array_prop();
$ret=mysql_init($p,$r);
return $ret;}

function troc_init(){
reqp('mysql'); troc_ses();
ses('jscode',troc_js());
troc_mysql_obj();
troc_mysql_prop();}

//plugin('troc',$p,$o)
function plug_troc($p,$o){
$rid='plg'.randid(); 
troc_init();
//$ret=troc_add($rid);
//$ret=troc_edit('',$rid);
//$ret=troc_edit_designation('',$rid);
return divd($rid,$ret);}

?>