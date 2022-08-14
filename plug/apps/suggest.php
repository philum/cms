<?php //suggest
class suggest{

static function sugmail($from,$f){
$dest=$_SESSION['qbin']['adminmail'];
$suj='philum - suggest_article'; $msg=$from.' suggest: '.$f;
mails::send_html($dest,$suj,$msg,$from,'');}

static function sugimport($f,$o='',$prm=[]){[$f,$o]=arr($prm);
if(substr($f,0,4)!='http')return; ses::$urlsrc=$f;
[$suj,$msg]=conv::vacuum($f,'');
if(!$suj && !$msg){[$suj,$msg,$img]=web::getmetas($f); $msg=$img.' '.$msg;}
$msg=conn::read($msg,'','test');
return balb('h1',clean_title($suj)).divc('panel justy',$msg);}

static function sugrecall(){$nod=nod('suggest'); $ret='';
$r=msql_read('',$nod,''); $js='popup_sav,batchpreview__3_';
if($r)foreach($r as $k=>$v){$j=ajx($v[2]); $lnk=lka($v[2],picto('url'));
if(!$v[1])$ret.=br().lj('popbt',$js.$j.'_'.$k,$v[0].' '.preplink($v[2])).' '.$lnk;}
return $ret;}

static function sugrapport($m){
$r=msql::read_b('',nod('suggest'),'');
if($r)foreach($r as $k=>$v){$id='';
	if($v[3])$id=sql('id','qda','v','mail="'.$v[3].'"'); 
	if($id)$art=lj('popw','popup_popart__3_'.$id.'_3',nms(89));
	$pub=$v[1]?$art:btn('popbt',nms(56)); 
	if($v[3]==$m)$ra[]=array($v[0],lka('popbt',$v[2]),$pub);}
return btn('txtcadr','rapport').br().divtable($ra);}

/*static function sugg_pad($p,$o,$prm=[]){$p=$prm[0]??$p;
$d=self::sugimport($p);
$ret.=divedit('sugpad','tab justy scroll','',$j,$d);
$ret.=lj('popsav','sugg_suggest,call_sugurl,sugnam,sugpad',nms(126)).' ';
return $ret;}*/

static function sugalx($r,$d){$md5=md5($d);
if($r)foreach($r as $k=>$v){if(md5($v[5])==$md5)return true;}}

//sugmail,sugtit,sugtxt,sugurl
static function call($v1,$v2,$ra){$nod=nod('suggest');
$dfb['_menus_']=['day','ok','url','mail','tit','msg','iq'];
$r=msql::read_b('',$nod,'','',$dfb);
$back=lj('txtx','sugg_suggest,home',picto('back'));
$alx=self::sugalx($r,$ra[2]); $rap='popup_plug___suggest_sugg*rapport_'.ajx($ra[1]);
if($ra[1] && $alx)return lj('txtyl',$rap,nms(56));
$r[]=[date('ymdHi'),'',$ra[3],$ra[0],$ra[1],$ra[2],ses('iq')]; if(isset($r[0]))$r=msql::reorder($r);
if(!$ra[0] or !$ra[1] or !$ra[2])return btn('txtyl','niet').$back;
elseif(!$alx){msql::save('',$nod,$r); if($ra[0])self::sugmail($ra[0],$ra[1]);
	return btn('txtred',helps('userforms')).$back;
	return lj('txtred','popup_sav,batchpreview__3_'.ajx($lnk),nms(56));}
else return lj('txtyl',$rap,nms(37)).$back;}

static function sugweb(){
$ret=input1('sugurl','url',30,'',1).' ';
$ret.=lj('popsav','sugtxt_suggest,sugimport_sugurl',nms(132)).' ';
return $ret;}

static function sugg_edit(){
$ret=input1('sugmail','e-mail',20,'',1);
$ret.=self::sugweb();
//$ret.=togbub('plug','suggest_sugg*web','importer du web','popbt').' ';
$ret.=hlpbt('suggest').br();
$ret.=input1('sugtit',nms(71),50,'editor',1);
$ret.=lj('popsav','sugg_suggest,call_sugmail,sugtit,sugtxt,sugurl',nms(126));
$ret.=divedit('sugtxt','editarea justy','','','');
return $ret;}

static function sugform(){
$ret=input1('sugurl','url','26','',1).' ';
$ret.=input1('sugmail','mail','14','',1).' '.hlpbt('suggest').' ';//nms(38)
$ret.=lj('popbt','sugg_suggest,sugimport_sugurl',nms(65)).' ';
$ret.=lj('popsav','sugg_suggest,call_sugmail,,,sugurl',nms(126)).' ';
return $ret;}

static function home($p){
//if(auth(6))else $ret=sugform();
$ret=self::sugg_edit();
if(auth(4))$bt=msqbt('',nod('suggest')); else $bt='';
return divd('sugg',$ret).self::sugrecall().$bt;}//sugg_pad($p,$o).//
}
?>