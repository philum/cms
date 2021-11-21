<?php
//philum_plugin_operations

//plugin_func('operations','operations_build',$p,$o);
function operations_build($p,$o){//$ret=$p.'-'.$o;
//$r=plugin('mysql',$p,$o); p($r);
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

function operations_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);//$resultant des champs
$ret=operations_build($p,$o);
return $ret;}

function operations_menu($p,$o,$rid){
$ret=input1('inp',$p,'').' '.input('ino',$o).' ';
$ret.=lj('',$rid.'_plug__2_operations_operations*j___inp|ino',picto('ok')).' ';
//$ret.=msqbt('',ses('qb').'_operations').' ';
return $ret;}

function patchlg(){$op=0;
if($op==1)qr('ALTER TABLE '.$_SESSION['qda'].' ADD `lg` VARCHAR(2) NOT NULL;');
if($op==2)$r=sql('ib,msg','qdd','kv','val="lang"'); pr($r);
if($r)foreach($r as $k=>$v)update('qda','lg',$v,'id',$k);
if($op==3)qr('update '.$_SESSION['qda'].' set lg="fr" where lg=""');
if($op==4)qr('delete from '.$_SESSION['qdd'].' where val="lang"'); reflush('qdd',1);}

//
function import_content($id){
$d=sql('msg','qdm','v','id='.$id); $idb=embed_detect($d,'[',':read]');
if(is_numeric($idb)){
$hub=sql('nod','qda','v','id='.$idb);
$ret=sql('msg','qdm','v','id='.$idb);
$ret.="\n".'['.$idb.'§'.$hub.':pub]';
update('qdm','msg',$ret,'id',$id);}
return $ret;}

function reimport(){
//$r=sql('id','qdm','rv','msg like "%::import%"',1); p($r);
//foreach($r as $k=>$v)import_get($v);
}

function toyandex($p){$qb=ses('qb'); ses('ynd','pub_yandex');
$r=explore(root().'msql/users','files',1); $n=count($r);
for($i=0;$i<$n;$i++){$rb=preg_split("/[_\.]/",$r[$i]);
	if($rb[2]!='sav' && $rb[3]!='sav')
		if($rb[0]==$qb && $rb[1]=='yandex' && $rb[2])$rc[]=$rb[2];}
//pr($rc);
foreach($rc as $k=>$v){
	$rd=msql_read('users',nod('yandex_'.$v),'','1'); //p($rd);
	foreach($rd as $kb=>$vb){$hash=md5($vb); $lg=substr($kb,0,2);
		$ex=sql('id','ynd','v','ref="art'.$v.'" and lang="'.$lg.'"','');
		if(!$ex)insert('ynd',mysqlra(['art'.$v,$hash,$vb,$lg],1));}}
}

function lang_es(){reqp('yandex'); $lg=ses('lang');
$nod='admin_restrictions';
//require('msql/lang/fr/helps_nominations.php');
$r=msql::read_b('lang/fr',$nod,'',''); //pr($r);
$rk=array_keys($r);
foreach($r as $k=>$v)$rb[]=(is_array($v)?implode('(cl)',$v):$v); //pr($rb);
$doc=implode("(nl)",$rb); $ref=substr('msq'.$nod,0,11);
$trad=yandex::com($ref,$doc,'es','fr'); //eco($trad,1);
$rc=explode("(nl)",$trad); //pr($rc);
if($rc)foreach($rk as $k=>$v)$rd[$v]=explode('(cl)',$rc[$k]); p($rd);
write_file(msql::url('lang/es',$nod),msql::dump($rd,$nod));
$bt=msqbt('lang/es',$nod);
return $bt.$ret;}

function maint_ynd(){//d41d8cd98f00b204e9800998ecf8427e
$r=sql('id,md5,txt,ref','ynd','','');
foreach($r as $k=>$v){
//correct bad md5
$hash=md5($v[2]); if($hash!=$v[1]){echo $v[0].br();
	update('ynd','md5',$hash,'id',$v[0]);}
//find doublons
//$rb[$v[1]][]=$v[0];//md5
//$rc[$hash][]=$v[0];//text
$rd[substr($v[3],3)][]=$v[3];//bad trk
}
//pr($rd);
if($rb)foreach($rb as $k=>$v){$n=count($v); //pr($v);
	if($n>1)for($i=1;$i<=$n;$i++)sqldel('ynd',$v[$i]);}
//if($rc)foreach($rc as $k=>$v){$n=count($v); if($n>1)pr($v);
	//if($n>1)for($i=1;$i<=$n;$i++)sqldel('ynd',$v[$i]);}
if($rd)foreach($rd as $k=>$v){$art=''; $trk='';
	foreach($v as $ka=>$va){
		if(substr($va,0,3)=='art')$art=1;
		if(substr($va,0,3)=='trk')$trk=1;
		if(substr($va,0,3)=='trk' && $art && $trk){
			echo $va.br();
			//qr('delete from '.$_SESSION['ynd'].' where ref="'.$va.'"');
	}}}
}

function maint_ynd2(){req('pop,art,spe');
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

function maint_ynd3(){reqp('umrec'); req('pop,art,spe');
$r=sql_b('SELECT id,md5,txt FROM pub_yandex GROUP BY md5 HAVING COUNT(md5) >1 order by id desc',''); //pr($r);
$ret=tabler($r);
//foreach($r as $k=>$v){sqldel('ynd',$v[0]);}
return $ret;}

function uclist(){
$r=$_SESSION['memcom']; //pr($r);
return implode(' ',array_keys($r));
}

function patchweb(){
$r=msql::choose('',ses('qb'),'web'); pr($r);
foreach($r as $k=>$v){
$rb=msql_read('',nod('web_'.$v),''); pr($rb);
}
return $ret;}

function test_xml($f){
$f='http://www.tlaxcala-int.org/rss_lg.asp?lg_rss=fr';
$d=get_file($f);
echo $enc=embed_detect(strtolower($d),'encoding="','"');
if(strtolower($enc)=='utf-8')$d=utf8_decode_b($d);
//echo substr_count($d,'<').'-'.substr_count($d,'>');
eco($d,1);
$r=simplexml_load_string($d);
$xml=explode("\n",$f);
if(!$r){
$rr=libxml_get_errors();
foreach($rr as $er)$ret.=display_xml_error($er,$xml);
libxml_clear_errors();
return $ret;}}

function display_xml_error($er,$xml){
$ret=$xml[$er->line-1]."\n";
$ret.=str_repeat('-',$er->column)."^\n";
switch($er->level){
	case LIBXML_ERR_WARNING:$ret.="Warning $er->code: "; break;
	case LIBXML_ERR_ERROR:$ret.="Error $er->code: "; break;
	case LIBXML_ERR_FATAL:$ret.="Fatal Error $er->code: "; break;}
$ret.=trim($er->message)."\nLine: $er->line"."\nColumn: $er->column";
if($er->file)$ret.="\nFile: $er->file";
return $ret.hr();}

function maint_pbsearch(){//maintenance pub_search
$r=sql_b('SELECT p1.id,word FROM pub_search p1 left outer join pub_search_art p2 
on p1.id=p2.ib where p2.ib is null',''); //pr($r);
foreach($r as $k=>$v)sqldel('qdsr',$v[0]);}

function test_vue(){req('pop,art,spe');
//$r=sql('msg','qdm','v','id=164064'); //pr($r);
$ret=art_read_d(164064,3);
return $ret;}

function create_mbrs(){
$r=sql('name,mbrs','qdu','',''); pr($r);
foreach($r as $k=>$v){$rb=explode_r($v,',','::');
	//if($rb)foreach($rb as $ka=>$va)sqlsav('qdh',[$k,$va[0],$v[1]]);
	} pr($rb);
return $ret;}

function create_qb(){$col='nod';//name
$r=sql('distinct('.$col.')','qda','rv',''); pr($r);
foreach($r as $k=>$v){$rb[$v]=sql('id','qdu','v',['name'=>$v],1);
	//if(!$rb[$v])sqlsav('qdu',['',$v,'','',time(),'','','','','','','','','','']);
} pr($rb);
foreach($rb as $k=>$v)$rb[$v]=sqlup('qda',[$col=>$v],$col,$k);
qr('ALTER TABLE `pub_art` CHANGE `'.$col.'` `'.$col.'` INT NOT NULL;');
return $ret;}

function create_cats(){
$r=sql('distinct(frm)','qda','rv',''); pr($r);
foreach($r as $k=>$v)$rb[$v]=sqlsav('qdd',['','cat',$v]); pr($rb);
foreach($rb as $k=>$v)$rb[$v]=sqlup('qda',['frm'=>$v],'frm',$k);
qr('ALTER TABLE `pub_art` CHANGE `frm` `frm` INT NOT NULL;');
return $ret;}

function ut8ise(){
$r=sql('*','qda','ar',''); //pr($r);
foreach($r as $k=>$v){
	foreach($v as $ka=>$va)$rb[$ka]=utf8_encode($va);
	sqlup('qda',$rb,'id',$v['id']);}pr($rb);
//qr('ALTER TABLE `pub_art` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;');
return $ret;}

function dieguez(){$ret='ok';
//$r=sql('id','qda','rv','nod="dav" and name!="dav"','');
$r=sql('idart','qdta','rv','idtag="954"','');//1000=author:dav//954=Manuel de Diéguez//994=Aline
//$r=sql_inner('id','qda','qdm','id','rv','where nod="MARIALI" and msg like "%Manuel de Diéguez%"','');
pr($r);
//foreach($r as $k=>$v)$rb[$v]=sqlup('qda',['name'=>'Manuel de Diéguez'],'id',$v,1);
return $ret;}

//plugin('operations',$p,$o)
function plug_operations($p,$o){$rid='plg'.randid();
//$bt=operations_menu($p,$o,$rid);
if(auth(6))$ret=dieguez();
return divd($rid,$ret);
}

?>