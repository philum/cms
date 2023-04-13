<?php 
//copy and translate an article

class translate{
static $a=__CLASS__;
static $default='';

static function oklangs($id,$id2,$lg,$lg2){
meta::utag_sav($id2,'lang'.$lg,$id);//save id of ref			
meta::utag_sav($id,'lang'.$lg2,$id2);//say to ref new translation
$es=sql('msg','qdd','v','ib="'.$id.'" AND val="langes"');//find es version
//if($es)meta::utag_sav($id2,'langes',$es);//say to ref es version
//if($es)meta::utag_sav($es,'langen',$id2);//say to esref new translation
//meta::utag_sav($id2,'related',' ');//empty related
meta::affectlgr($id);}

static function updmetas($id,$idart){$rt=[];
$ra=explode(' ','tag '.prmb(18));//todo:not works
foreach($ra as $k=>$cat){if($cat)$r=meta::read_tags($id,$cat);//idtag,tag
	foreach($r as $idtag=>$tag)$rt[$cat][]=meta::add_artag($idart,$idtag,$cat,$tag);}
return $rt;}

static function build($id,$p){$lg='fr';
$r=sql('ib,name,mail,day,nod,frm,suj,re,lu,img,thm,host,lg','qda','a',$p);
$lgref=$r['lg']; $lg=ses('lng'); $lgset=$lang.'-'.$r['lg'];//to,from
$r['suj']=trans::call('suj'.$p,$lgset,2); //p($r);
//[$a,$b]=split_right(' ',$r['suj']); $r['suj']='['.$a.'] '.$b; $r['frm'].='-EN';
$r['lg']=$lg;
if($r['ib'])$r['ib']=sql('msg','qdd','v',['ib'=>$r['ib'],'val'=>'lang'.$r['lg']]);
sqlup('qda',$r,$id);
$msg=trans::call('art'.$p,$lgset,2);//p($r); eco($msg);
//$msg=conv::call($msg,'');
sqlup('qdm',['msg'=>$msg],$id,0);
self::oklangs($p,$id,$lgref,$lg);
return $p?'ok':'';}

static function create($lang,$p){//p:id
$r=sql('ib,name,mail,day,nod,frm,suj,re,lu,img,thm,host,lg','qda','a',$p);
$lgref=$r['lg']; $lgset=$lang.'-'.$r['lg'];//to,from
$r['suj']=trans::call('suj'.$p,$lgset,2);
$r['lg']=$lang;
if($r['ib']){$ib=sql('msg','qdd','v',['ib'=>$r['ib'],'val'=>'lang'.$r['lg']]); if($ib)$r['ib']=$ib;}
$msg=trans::call('art'.$p,$lgset,2); //p($r); eco($msg);//
if($msg)$id=sqlsav('qda',$r,0,1);
if($id)$id=sql::savi('qdm',[$id,$msg]);
$rt=self::updmetas($p,$id);
self::oklangs($p,$id,$lgref,$lang);
return $p?lka($id,'ok:'.$id):'';}

static function call($p,$o,$prm=[]){$p=$prm[0]??$p;
if(is_numeric($p))$ret=self::build($p,$o);//put data in existing art 
else $ret=self::create($p,$o);//specified lang
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default;
$j=$rid.'_translate,call_inp_3__'.$p;
$ret=inputj('inp','fr',$j,'',3);
$ret.=lj('',$j,picto('ok'),att('translate')).' ';
//$ret.=lj('txtx',$rid.'_translate,repair___'.$p,'repair_txt').' ';
//$ret.=lj('txtx',$rid.'_translate,convert___'.$p,'html2conn').' ';
//$ret.=lj('txtx',$rid.'_translate,fempty___'.$p,'fill_empties').' ';
//$ret.=lj('txtx',$rid.'_translate,batch_inp___'.$p,'batch').' ';
return $ret;}

static function repair($p){
$id=sql('id','qdm','v',$p);
if(!$id)$id=sql::sav('qdm',['empty']);
return $id;}

static function convert($p){
$msg=sql('msg','qdm','v',$p);
$msg=conv::call($msg);
sql::upd('qdm',['msg'=>$msg],$p);
return 'ok';}

static function fempty($p){
$r=sql('id,ib,name,mail,day,nod,frm,suj,re,lu,img,thm,host,lg','qda','a','1');
$r['re']=0; $r['frm']='_system';
for($i=1;$i<468;$i++){
	$id=sql('id','qda','v',$i);
	if(!$id){$r['id']=$i;
		$id=sql::savi('qda',$r); echo $id.' ';
		if($id)self::repair($id);}}
return 'ok';}

static function batch($p,$o,$prm=[]){
[$p,$id]=prmp($prm,$p,$o);
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
?>