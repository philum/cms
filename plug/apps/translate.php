<?php
//philum_app_translate
//copy and translate an article

class translate{
static $a=__CLASS__;
static $default='';

static function oklangs($id,$id2,$lg,$lg2){req('meta');
utag_sav($id2,'lang'.$lg,$id);//save id of ref			
utag_sav($id,'lang'.$lg2,$id2);//say to ref new translation
$es=sql('msg','qdd','v','ib="'.$id.'" AND val="langes"');//find es version
//if($es)utag_sav($id2,'langes',$es);//say to ref es version
//if($es)utag_sav($es,'langen',$id2);//say to esref new translation
//utag_sav($id2,'related',' ');//empty related
affectlgr($id);}

static function build($id,$p){$lang='fr';
$r=sql('ib,name,mail,day,nod,frm,suj,re,lu,img,thm,host,lg','qda','a','id='.$p);
$lgref=$r['lg']; if(!$lg)$lg=ses('lng'); $lgset=$lang.'-'.$r['lg'];//to,from
$r['suj']=yandex::call('suj'.$p,$lgset,2); //p($r);
//list($a,$b)=split_right(' ',$r['suj']); $r['suj']='['.$a.'] '.$b; $r['frm'].='-EN';
$r['lg']=$lang;
if($r['ib'])$r['ib']=sql('msg','qdd','v','ib="'.$r['ib'].'" AND val="lang'.$r['lg'].'"');
sqlup('qda',$r,'id',$id);
$msg=yandex::call('art'.$p,$lgset,2);//p($r); eco($msg);
//$msg=conv::call($msg,'');
sqlup('qdm',['msg'=>$msg],'id',$id,0);
self::oklangs($p,$id,$lgref,$lang);
return $p?'ok':'';}

static function create($lang,$p){req('sav');//echo $lang.'-'.$p;
$r=sql('ib,name,mail,day,nod,frm,suj,re,lu,img,thm,host,lg','qda','a','id='.$p);
$lgref=$r['lg']; $lgset=$lang.'-'.$r['lg'];//to,from
$r['suj']=yandex::call('suj'.$p,$lgset,2); //p($r);
$r['lg']=$lang;
if($r['ib'])$r['ib']=sql('msg','qdd','v','ib="'.$r['ib'].'" AND val="lang'.$r['lg'].'"');
$msg=yandex::call('art'.$p,$lgset,2); //p($r); eco($msg);//
$id=sqlsav('qda',$r);
$id=sqlsavi('qdm',[$id,$msg]);
self::oklangs($p,$id,$lgref,$lang);
return $p?lka($id,'ok:'.$id):'';}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); //echo $p.'-'.$o;
if(is_numeric($p))$ret=self::build($p,$o);//put data in existing art 
else $ret=self::create($p,$o);//specified lang
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default;
$j=$rid.'_app__3_'.self::$a.'_call__'.$p.'_inp';
$ret=inputj('inp','fr',$j,atz(3));
$ret.=lj('',$j,picto('ok'),att('translate')).' ';
//$ret.=lj('txtx',$rid.'_app__3_'.self::$a.'_repair_'.$p,'repair_txt').' ';
//$ret.=lj('txtx',$rid.'_app__3_'.self::$a.'_convert_'.$p,'html2conn').' ';
$ret.=lj('txtx',$rid.'_app__3_'.self::$a.'_fempty_'.$p,'fill_empties').' ';
//$ret.=lj('txtx',$rid.'_app__3_'.self::$a.'_batch__'.$p.'_inp','batch').' ';
return $ret;}

static function repair($p){
$id=sql('id','qdm','v','id='.$p);
if(!$id)$id=insert('qdm',mysqlra([$p,'1'],0));
return $id;}

static function convert($p){
$msg=sql('msg','qdm','v','id='.$p);
req('tri');
$msg=conv::call($msg);
update('qdm','msg',$msg,'id',$p);
return 'ok';}

static function fempty($p){
$r=sql('id,ib,name,mail,day,nod,frm,suj,re,lu,img,thm,host,lg','qda','a','id=1');
$r['re']=0; $r['frm']='_system';
for($i=1;$i<468;$i++){
	$id=sql('id','qda','v','id='.$i);
	if(!$id){$r['id']=$i;
		$id=insert('qda',mysqlra($r,0)); echo $id.' ';
		if($id)self::repair($id);}}
return 'ok';}

static function batch($p,$o,$res=''){
list($p,$id)=ajxp($res,$p,$o);
$r=sql('id','qda','rv','frm="GR" order by day asc');
foreach($r as $k=>$v){
	//echo $v.'->'.$id.br(); 
	$ret=self::build($v,$id);
	$id++;}
return 'ok';}

static function home($p,$o){
$rid=randid(self::$a); $ret='';
$bt=self::menu($p,$o,$rid);
//if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}

}

function plug_translate($p,$o){
return translate::home($p,$o);}

?>