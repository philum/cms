<?php 
class operations{

static function build($p,$o){//$ret=$p.'-'.$o;
$msq=new mysql('qda'); //echo $msq::$b;
$msq::read('id,day','kv','frm="oaxiiboo 6" order by day ASC');
$r=$msq::$ret;
setlocale(LC_ALL,"fr_FR");
$dr=['jan'=>'jan','fev'=>'feb','mars'=>'mar','avr.'=>'apr','mai'=>'may','juin'=>'jun','juil'=>'jul','août'=>'aug','sept'=>'sep','oct'=>'oct','nov'=>'nov','déc'=>'dec'];
foreach($r as $k=>$v){$nb++;
//14.12.28 00.50 (122)
//$suj=date('y.m.d H.i',$v).' ('.$nb.')';
//20:41 - 19 juin 2015
$suj=date("H:i - d M Y",$v); 
//$suj=strftime("%R - %e %b %G",$v); 
//$suj=date('H:i - d m Y',$v).' ('.$nb.')';
$suj=strtolower($suj);
$suj=str_replace(array_values($dr),array_keys($dr),$suj);
$suj.=' ('.$nb.')';
echo $suj.br();
//$msq->update('suj',$suj,'id',$k);
}
//p($r);
return $ret;}

static function patchlg(){$op=0;
if($op==1)qr('ALTER TABLE '.$_SESSION['qda'].' ADD `lg` VARCHAR(2) NOT NULL;');
if($op==2)$r=sql('ib,msg','qdd','kv','val="lang"'); pr($r);
if($r)foreach($r as $k=>$v)sql::upd('qda',['lg'=>$v],$k);
if($op==3)qr('update '.$_SESSION['qda'].' set lg="fr" where lg=""');
if($op==4)qr('delete from '.$_SESSION['qdd'].' where val="lang"'); sql::reflush('qdd',1);}

//
static function import_content($id){
$d=sql('msg','qdm','v','id='.$id); $idb=between($d,'[',':read]');
if(is_numeric($idb)){
$hub=sql('nod','qda','v','id='.$idb);
$ret=sql('msg','qdm','v','id='.$idb);
$ret.="\n".'['.$idb.'§'.$hub.':pub]';
sql::upd('qdm',['msg'=>$ret],$id);}
return $ret;}

static function reimport(){
//$r=sql('id','qdm','rv','msg like "%::import%"',1); p($r);
//foreach($r as $k=>$v)few::importation($v);
}

static function toyandex($p){$qb=ses('qb'); ses('ynd','pub_yandex');
$r=explore(root().'msql/users','files',1); $n=count($r);
for($i=0;$i<$n;$i++){$rb=preg_split("/[_\.]/",$r[$i]);
	if($rb[2]!='sav' && $rb[3]!='sav')
		if($rb[0]==$qb && $rb[1]=='yandex' && $rb[2])$rc[]=$rb[2];}
//pr($rc);
foreach($rc as $k=>$v){
	$rd=msql::read('users',nod('yandex_'.$v),'','1'); //p($rd);
	foreach($rd as $kb=>$vb){$hash=md5($vb); $lg=substr($kb,0,2);
		$ex=sql('id','ynd','v','ref="art'.$v.'" and lang="'.$lg.'"','');
		if(!$ex)sql::sav('ynd',['art'.$v,$hash,$vb,$lg]);}}
}

static function lang_es(){$lg=ses('lang');
$nod='admin_restrictions';
//require('msql/lang/fr/helps_nominations.php');
$r=msql::read_b('lang/fr',$nod,'',''); //pr($r);
$rk=array_keys($r);
foreach($r as $k=>$v)$rb[]=(is_array($v)?implode('(cl)',$v):$v); //pr($rb);
$doc=implode("(nl)",$rb); $ref=substr('msq'.$nod,0,11);
$trad=trans::com($ref,$doc,'es','fr'); //eco($trad,1);
$rc=explode("(nl)",$trad); //pr($rc);
if($rc)foreach($rk as $k=>$v)$rd[$v]=explode('(cl)',$rc[$k]); p($rd);
write_file(msql::url('lang/es',$nod),msql::dump($rd,$nod));
$bt=msqbt('lang/es',$nod);
return $bt.$ret;}

static function maint_ynd(){//d41d8cd98f00b204e9800998ecf8427e
$r=sql('id,md5,txt,ref','ynd','','');
foreach($r as $k=>$v){
//correct bad md5
$hash=md5($v[2]); if($hash!=$v[1]){echo $v[0].br();
	sql::upd('ynd',['md5'=>$hash],$v[0]);}
//find doublons
//$rb[$v[1]][]=$v[0];//md5
//$rc[$hash][]=$v[0];//text
$rd[substr($v[3],3)][]=$v[3];//bad trk
}
//pr($rd);
if($rb)foreach($rb as $k=>$v){$n=count($v); //pr($v);
	if($n>1)for($i=1;$i<=$n;$i++)sql::del('ynd',$v[$i]);}
//if($rc)foreach($rc as $k=>$v){$n=count($v); if($n>1)pr($v);
	//if($n>1)for($i=1;$i<=$n;$i++)sql::del('ynd',$v[$i]);}
if($rd)foreach($rd as $k=>$v){$art=''; $trk='';
	foreach($v as $ka=>$va){
		if(substr($va,0,3)=='art')$art=1;
		if(substr($va,0,3)=='trk')$trk=1;
		if(substr($va,0,3)=='trk' && $art && $trk){
			echo $va.br();
			//qr('delete from '.$_SESSION['ynd'].' where ref="'.$va.'"');
	}}}
}

static function maint_ynd2(){
$r=sql('id,txt','ynd','','');//id=3636
foreach($r as $k=>$v){$d=$v[1]; $hash1=md5($d);
	//$d=codeline::parse($d,':q','');
	/*if(strpos($d,'twitter.com/hashtag/')){
		echo $deb=strpos($d,'[https://twitter.com/hashtag/');
		$end1=strpos($d,'?',$deb);
		$end2=strpos($d,']',$deb);
		$tag=substr($d,$deb+29,$end1-$deb+30);
		$part=substr($d,$deb,$end2-$deb+1);
		$d=str_replace($part,'#'.$tag,$d);
	}*/
	$hash2=md5($d);
	if($hash1!=$hash2)
	$ret.=$v[0].br().br().$v[1].br().br().$d.br().br();
}
return $ret;}

static function maint_ynd3(){
$r=sql::call('SELECT id,md5,txt FROM pub_yandex GROUP BY md5 HAVING COUNT(md5) >1 order by id desc',''); //pr($r);
$ret=tabler($r);
//foreach($r as $k=>$v){sql::del('ynd',$v[0]);}
return $ret;}

static function uclist(){
$r=$_SESSION['memcom']; //pr($r);
return implode(' ',array_keys($r));
}

static function patchweb(){
$r=msql::choose('',ses('qb'),'web'); pr($r);
foreach($r as $k=>$v){
$rb=msql::read('',nod('web_'.$v),''); pr($rb);
}
return $ret;}

static function dieguez(){$ret='ok';
//$r=sql('id','qda','rv','nod="dav" and name!="dav"','');
$r=sql('idart','qdta','rv','idtag="954"','');//1000=author:dav//954=Manuel de Diéguez//994=Aline
//$r=sql::inner('id','qda','qdm','id','rv','nod="MARIALI" and msg like "%Manuel de Diéguez%"','');
pr($r);
//foreach($r as $k=>$v)$rb[$v]=sqlup('qda',['name'=>'Manuel de Diéguez'],['id'=>$v],1);
return $ret;}

static function test_xml($f){
$f='http://www.tlaxcala-int.org/rss_lg.asp?lg_rss=fr';
$d=get_file($f);
echo $enc=between(strtolower($d),'encoding="','"');
if(strtolower($enc)=='utf-8')$d=utf8dec_b($d);
//echo substr_count($d,'<').'-'.substr_count($d,'>');
eco($d,1);
$r=simplexml_load_string($d);
$xml=explode("\n",$f);
if(!$r){
$rr=libxml_get_errors();
foreach($rr as $er)$ret.=display_xml_error($er,$xml);
libxml_clear_errors();
return $ret;}}

static function display_xml_error($er,$xml){
$ret=$xml[$er->line-1]."\n";
$ret.=str_repeat('-',$er->column)."^\n";
switch($er->level){
	case LIBXML_ERR_WARNING:$ret.="Warning $er->code: "; break;
	case LIBXML_ERR_ERROR:$ret.="Error $er->code: "; break;
	case LIBXML_ERR_FATAL:$ret.="Fatal Error $er->code: "; break;}
$ret.=trim($er->message)."\nLine: $er->line"."\nColumn: $er->column";
if($er->file)$ret.="\nFile: $er->file";
return $ret.hr();}

static function maint_pbsearch(){//maintenance pub_search
$r=sql::call('SELECT p1.id,word FROM pub_search p1 left outer join pub_search_art p2 
on p1.id=p2.ib where p2.ib is null',''); //pr($r);
foreach($r as $k=>$v)sql::del('qdsr',$v[0]);}

static function test_vue(){
//$r=sql('msg','qdm','v','id=164064'); //pr($r);
$ret=art::playd(164064,3);
return $ret;}

static function create_mbrs(){
$r=sql('name,mbrs','qdu','',''); pr($r);
foreach($r as $k=>$v){$rb=explode_r($v,',','::');
	//if($rb)foreach($rb as $ka=>$va)sqlsav('qdh',[$k,$va[0],$v[1]]);
	} pr($rb);
return $ret;}

static function create_qb(){$col='nod';//name
$r=sql('distinct('.$col.')','qda','rv',''); pr($r);
foreach($r as $k=>$v){$rb[$v]=sql('id','qdu','v',['name'=>$v],1);
	//if(!$rb[$v])sqlsav('qdu',['',$v,'','',time(),'','','','','','','','','','']);
} pr($rb);
foreach($rb as $k=>$v)$rb[$v]=sqlup('qda',[$col=>$v],[$col=>$k]);
qr('ALTER TABLE `pub_art` CHANGE `'.$col.'` `'.$col.'` INT NOT NULL;');
return $ret;}

static function create_cats(){
$r=sql('distinct(frm)','qda','rv',''); pr($r);
foreach($r as $k=>$v)$rb[$v]=sqlsav('qdd',['','cat',$v]); pr($rb);
foreach($rb as $k=>$v)$rb[$v]=sqlup('qda',['frm'=>$v],['frm'=>$k]);
qr('ALTER TABLE `pub_art` CHANGE `frm` `frm` INT NOT NULL;');
return $ret;}

static function ut8ise($db='qda'){
//sql::dbq(['localhost','root','dev','nfo2',1]); sqldb::batchinstall(); return;
$r=sql('*',$db,'ar',['_limit'=>'1']);//
foreach($r as $k=>$v){
	foreach($v as $ka=>$va)
		//$r[$k][$ka]=utf8enc($va);
		//$r[$k][$ka]=utf8enc_b($va);
		//$r[$k][$ka]=mb_convert_encoding($va,'UTF-8','ASCII');
		//$r[$k][$ka]=mb_convert_encoding($va,'UTF-8','HTML-ENTITIES');
		$r[$k][$ka]=utf8enc(html_entity_decode($va));
		//$r[$k][$ka]=mb_convert_encoding(html_entity_decode($va),'UTF-8','HTML-ENTITIES');
	//sqlup($db,$rb,['id'=>$v['id']]);
	} //pr($rb);
//qr('ALTER TABLE `pub_art` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;');
$b=sqldb::db($db);
sql::dbq(['localhost','root','dev','nfo2',1]);
//sqldb::batchinstall();
//sqldb::install($b);
sql::sav2($b,$r,$ai=0,1);
//new::sql(['localhost','root','dev','nfo',0]);
return $ret;}

static function reform_msql_menus(){
$r=scandir_r('msql'); //pr($r);
//echo count($r);
function reform($f){
$d=read_file($f); //eco($d);
if(strpos($d,'_menus_')){
$d=str_replace('_menus_','_',$d); echo $f;
write_file($f,$d);}}
//$f='msql/system/edition_colors_sav.php';
foreach($r as $k=>$v)reform($f);}

static function table2utf($b){
$b2=$b.'2'; $db=sqldb::qb($b);
$db2=$db.'2'; ses($db2,qd($b2));
echo $b2.':';
sql::backup($db);
$r=sqldb::def($b);
sqlop::install($b.'2',$r,1);
echo 'install,';
$r=sql('*',$db,'ar',[]);
//$r=utf_r($r); //pr($r);
sql::sav2($db2,$r,0);
//sql::qr('insert into '.qd($b2).' select * from '.qd($b));
echo 'save2,';
qr(' RENAME TABLE '.ses($db).' TO '.qd($b.'1').'; ');
qr(' RENAME TABLE '.qd($b2).' TO '.qd($b).'; ');
echo 'rename';
}

static function table2utf_call($n){$n=$n?$n:1;
$r=['art','data','cat','favs','hub','ips','iqs','live','live2','mbr','meta','meta_art','meta_clust','search','search_art','stat','trk','twit','txt','umtwits','umvoc','umvoc_arts','user','web','yandex'];
self::table2utf($r[$n]);}

static function encmasl(){
$r=explore('/msql');
foreach($r as $k=>$v){
	$ru=self::murlread($msql);
	[$b,$dir,$hub,$table,$version,$def]=$ru;
	//msqa::tools($dir,$hub,'repair_enc','');
}
}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
//$ret=self::build($p,$o);
//$ret=self::$p($o);
self::ut8ise($p);
return $ret;}

static function menu($p,$o,$rid){
$ret=input('inp',$p,'').' '.input('ino',$o).' ';
$ret.=lj('',$rid.'_operations,call_inp,ino_3',picto('ok')).' ';
//$ret.=msqbt('',ses('qb').'_operations').' ';
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=self::menu($p,$o,$rid); $ret='';
//if(auth(6))$ret=dieguez();
//if(auth(6))$ret=ut8ise();
return $bt.divd($rid,$ret);}
}
?>