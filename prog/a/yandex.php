<?php
//philum/a/yandex

class yandex{
//https://tech.yandex.com/translate/doc/dg/reference/translate-docpage
//static $motor='deepl';
static $motor='yandex';

static function getkey(){
return msql::val('',nod('yandex'),1);}

static function post($url,$post){$d=curl_init();
curl_setopt($d,CURLOPT_URL,$url);
curl_setopt($d,CURLOPT_HTTPHEADER,[]);
if($post){
	curl_setopt($d,CURLOPT_POST,TRUE);
	curl_setopt($d,CURLOPT_POSTFIELDS,'text='.rawurlencode($post));}
curl_setopt($d,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0');
curl_setopt($d,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($d,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($d,CURLOPT_RETURNTRANSFER,1);
$ret=curl_exec($d); //if($ret===false)echo curl_error($d);
curl_close($d);
return $ret;}

//https://www.deepl.com/api.html
static function api($prm,$mode,$txt=''){//return ['text'=>0=>[$txt]];
$txt=utf8_encode($txt); $r=[];
//$id='enp573c2837f7lt7sg51';
//$key='AgAAAAAbqMMQAATuwcEeqCewDEHen-4Tj6PZ_8M';
if(self::$motor=='yandex'){
	if($_SERVER['HTTP_HOST']=='newsnet.fr')//newsnet
	$key='trnsl.1.1.20180424T143921Z.e47210bce651eadc.f1434d1d227b66402fc4bf8f44f82f0f85ed75b6';
	elseif($_SERVER['HTTP_HOST']=='oumo.fr')//oomo-dhoy2
	$key='trnsl.1.1.20180424T143830Z.66e290d02ce3a559.adc6066d788696b551be9734420c4ad9b7061dbc';
	//$key='trnsl.1.1.20180424T150654Z.ad62660ecf66eace.b9aae90ac4dc2fb31c0391fe393f2b84e6a14208';//oomo-dhoy
	else//tlex
	$key='trnsl.1.1.20170206T173119Z.092e1dd0a9954253.db344b1e497240fb68fd4b1f5150a3d25d9c4e95';/**/
	$prm.='&key='.$key;
	//$prm.='&text='.rawurlencode($txt);
	if(!$mode)$mode='translate';//detect//getLangs
	$u='https://translate.yandex.net/api/v1.5/tr.json/'.$mode.'?'.$prm;//old
	//$u='https://iam.api.cloud.yandex.net/iam/v1/tokens/tr.json/'.$mode.'?'.$prm;
	}
elseif(self::$motor=='deepl'){
	$key='3faee751-421b-5107-71be-ea47e8fcbe1d';
	$prm.='&auth_key='.$key;
	$prm.='&text='.rawurlencode($txt);
	$u='https://api.deepl.com/v1/translate?'.$prm;}
$ret=self::post($u,$txt);
$r=json_decode($ret,true);
if(isset($r['code']) && $r['code']=='404')$r=['text'=>$txt];//echo $r['message'];
return $r;}

static function getlangs(){$rb=[];
if(self::$motor=='yandex'){$r=self::api('','getLangs');
	foreach($r['dirs'] as $v)$rb=array_merge_b($rb,explode('-',$v));}
elseif(self::$motor=='deepl')$rb=['EN','FR','ES','IT','DE','NL','PL'];
return implode(',',$rb);}

static function detect($p,$o,$txt=''){return prmb(25);//
if(self::$motor=='yandex')$var='detect';
elseif(self::$motor=='deepl')$var='detected_source_language';
if($txt){$r=self::api('',$var,$txt); return $r['lang']??'';}
else return ses('lang');}

#translate
static function build_yandex($from,$format,$txt,$to){
if(!$to)$to=ses('lng');//$to=setlng($to);
$options=$from?'':'&options=1';
if($from)$lang=$from.'-'.$to; else $lang=$to;
$prm='lang='.$lang.'&format='.$format.$options;
$r=self::api($prm,'translate',$txt); //pr($r);
return $r;}

static function build_deepl($from,$format,$txt,$to){
if(!$to)$to=ses('lng');//$to=setlng($to);
if($from)$prm='source_lang='.strtoupper($from).'&';
$prm.='target_lang='.strtoupper($to);
$prm.='&tag_handling=xml';
$prm.='&preserve_formatting=1';
//$prm.='&split_sentences=1';//default
$r=self::api($prm,'translate',$txt);
return $r;}

static function cut($txt){
$na=2000; $nb=strlen($txt); $n=ceil($nb/$na); $r=explode(' ',$txt); $nc=0; $ret='';
if($nb>$na){foreach($r as $k=>$v){$nc+=strlen($v)+1;
	if($nc<$na)$ret.=$v.' '; else{$rb[]=$ret; $nc=0; $ret='';}}
	if($ret)$rb[]=$ret;}
else $rb[]=$txt;
return $rb;}

//tools
static function correct($d){
$ra=[":j']",':p]',':vidéo]',':efecto','[///img/',':centro]',':non]',':not]'];
$rb=[':i]',':q]',':video]','effect','[',':center]',':no]',':no]'];
return str_replace($ra,$rb,$d);}

#conv
static function convconn($d,$id=''){req('pop,art,spe,tri,mod');
//$d=clean_tw($d,0);
$d=str_replace('.jpg]','.jpg:mini]',$d);
$d=str_replace('.png]','.png:mini]',$d);
return conn::read_b($d,0);}

static function convhtml($d){req('tri');
$d=conv::interpret_html($d,'','');
$d=post_treat_repair($d); $d=clean_br($d); $d=clean_prespace($d);
return $d;}

#translate
static function read($p,$o='plain',$txt,$to=''){return $txt;}

//com
static function com($ref,$d,$to='',$from='',$z=''){
if(!$to)$to=ses('lng');//$to=setlng($to);
$ex=sql('id','ynd','v',['ref'=>$ref,'lang'=>$to],'');
if(!$from)$from=self::detect('','',$d);
if($from!=$to){
	$b=self::read($from,'html',$d,$to);
	if($b){
		if($ex)self::update($b,$ref,$to);
		else insert('ynd',mysqlra([$ref,$b,$to],1)); $d=$b;}
	else insert('ynd',mysqlra([$ref,$d,$to],1));}//save original in new lang
return $d;}

#edit
static function update($d,$ref,$lg){
//qr('update '.ses('ynd').' set txt="'.qres($d).'" where ref="'.$ref.'" and lang="'.$lg.'"');
$q=['ref'=>$ref,'lang'=>$lg];
$ex=sql('id','ynd','v',$q);
if($ex)sqlup('ynd',['txt'=>$d],'id',$ex);
else sqlsav('ynd',['ref'=>$ref,'txt'=>$d,'lang'=>$lg]);}

static function resav($ref,$setlg,$res){$ret=ajxg($res);
list($lg,$from)=opt($setlg,'-'); if($lg=='all')$lg=$from;
self::update($ret,$ref,$lg);
return self::call($ref,$setlg);}

static function redit($ref,$setlg){$id=substr($ref,3); if(!auth(6))return;
list($lg,$from)=explode('-',$setlg); if($lg=='all')$lg=$from;
$txt=sql('txt','ynd','v','ref="'.$ref.'" and lang="'.$lg.'"',0);
//$ret=lj('','ynd'.$ref.'_app__1_yandex_call_'.$ref.'_'.$setlg,picto('kleft')).' ';
$ret=lj('txtx','ynd'.$ref.'_app__1_yandex_resav_'.$ref.'_'.$setlg.'_rdt'.$ref,pictxt('save',$lg)).' ';
$ret.=editarea('rdt'.$ref,$txt,72,16);
return $ret;}

#redo
static function redo($ref,$setlg,$o='',$edt='',$um=''){
//if(!auth(6))return;
static $i; $i++; $ret=''; $retb='';
list($to,$from)=opt($setlg,'-'); $lg='';
if(!$to)$to=ses('lng');//$to=setlng($to);
$ind=substr($ref,0,3); $id=substr($ref,3);
//list($ex,$exlg)=sql('txt,lg','ynd','r','ref="'.$ref.'" and lang!="'.$to.'"');
//if(!$ret){}
if($ind=='art'){$ret=sql('msg','qdm','v','id='.$id); $lg=sql('lg','qda','v','id='.$id);}
elseif($ind=='trk')list($ret,$lg)=sql('msg,lg','qdi','w','id='.$id);
elseif($ind=='suj')list($ret,$lg)=sql('suj,lg','qda','w','id='.$id);
elseif($ind=='twt'){$rt=sql('txt,lang','qdtw','w','twid="'.$id.'"'); list($ret,$lg)=arr($rt,2);}
$ret=clean_tw($ret,1);//twits
if(!$ret)return 'empty ref'; if(!$lg)$lg=prmb(25);
//if(auth(6)){echo $i.':'.$ret.'-'.$from.'-'.$to.'-'.$o.br();}//return;
if($o && $lg!=$to){$ret=self::com($ref,$ret,$to,$lg);}//new
elseif($lg!=$to){//eco($ret);
	if(!$lg)$lg=self::detect('','',$ret);
	if($lg!=$to)$retb=self::read($lg,'html',$ret,$to);
	if($retb){$ret=$retb; self::update($ret,$ref,$to);}}
elseif($o){$id=insert('ynd',mysqlra([$ref,$ret,$lg],1),0);}
elseif($lg==$to)self::update($ret,$ref,$to);//restore original
if($i>1)return $ret?self::convconn($ret,''):'error';
if($um)return self::callum($ref,$setlg.'-1',$edt);
return self::call($ref,$setlg.'-1',$edt);}

//menulg
static function menulg($ref,$to,$from){$ret=''; $tg='ynd'.$ref; //$tg=$ref;
$r=explode(' ',prmb(26)); $id=substr($ref,3); $go='suj'.$id.',art'.$id;
$ret=lj(active($to,$from),$tg.'_yandex,call___'.$ref.'_'.$from.'-'.$from,flag($from)).' &#8658; ';
//$ret=lj(active($to,$from),$go.'_yandex,artsuj__json_'.$id.'_'.$from.'-'.$from,flag($from)).' &#8658; ';
if($r)foreach($r as $k=>$v)if($v!=$from){$c=active($v,$to);
	$ret.=lj($c,$tg.'_yandex,call___'.$ref.'_'.$v.'-'.$from,flag($v)).' ';}
	//$ret.=lj($c,$go.'_yandex,artsuj__json_'.$id.'_'.$v.'-'.$from,flag($v)).' ';
if(auth(6)){
	$ret.=lj('',$tg.'_yandex,redo___'.$ref.'_'.$to.'-'.$from,picto('refresh'));
	$ret.=lj('','popup_yandex,redit___'.$ref.'_'.$to.'-'.$from,picto('edit'));}
return divc('nbp',$ret);}

//call
static function call($ref,$setlg='',$edt=''){//edt:0=html,2=brut,1=sav
list($to,$from,$nobt)=opt($setlg,'-',3); $bt=''; //if($to=='all')$to=$from;
if(!$to)$to=ses('lng');//$to=setlng($to);
$ret=sql('txt','ynd','v','ref="'.$ref.'" and lang="'.$to.'"');
if(!$nobt)$bt=self::menulg($ref,$to,$from);
//if(!$ret && $to==$from){$ret=self::redo($ref,$setlg,1,$edt);}//$bt='';//disactivated
//if(!$ret)$ret=sql('txt','ynd','v','ref="'.$ref.'" and lang="'.$from.'"');
if(!$ret)$ret=self::redo($ref,$setlg,1,$edt);//patch
if(!$edt)$ret=self::convconn($ret,'');
if($edt==2)return $ret;//txt brut
//if($ret && $edt==1)return '['.$bt.$ret.'§ynd'.$ref.':divd]';
return btd('ynd'.$ref,$bt.$ret);}

static function artsuj($id,$setlg=''){
$r[0]=self::call('suj'.$id,$setlg.'-1');
$r[1]=self::call('art'.$id,$setlg);
return mkjson($r);}

static function play($ref,$lg){
list($to,$from)=explode('-',$setlg);
$ret=sql('txt','ynd','v','ref="'.$ref.'" and lang="'.$to.'"');
if(!$ret)$ret=self::redo($ret,$setlg);
return $ret;}

#conn
static function menuxt($ref,$to,$from){$ret='';
$r=explode(' ',prmb(26)); //$r=sql('lang','ynd','rv','ref="'.$ref.'"');
$ret=lj('',$ref.'_yandex,playxt___'.$ref.'_'.$from.'-'.$from,flag($from)).' &#8658; ';
if($r)foreach($r as $k=>$v)if($v!=$from)
	$ret.=lj('',$ref.'_yandex,playxt___'.$ref.'_'.$v.'-'.$from,flag($v)).' ';
if(auth(6)){
	$ret.=lj('',$ref.'_yandex,redoxt___'.$ref.'_'.$to.'-'.$from,picto('refresh')).' ';
	$ret.=lj('','popup_yandex,reditxt___'.$ref.'_'.$to.'-'.$from,picto('edit'));}
return divc('',$ret);}

static function resavxt($ref,$setlg,$res){
list($to,$from)=explode('-',$setlg);
$d=ajxg($res); if($d)self::update($d,$ref,$to);
return self::playxt($ref,$setlg,$d);}

static function reditxt($ref,$setlg){
list($to,$from)=explode('-',$setlg);
$d=self::original('',$ref,$to);
$ret=lj('popbt',$ref.'_yandex,resavxt___'.$ref.'_'.$setlg.'___rdt'.$ref,pictxt('save',$to)).' ';
$ret.=editarea('rdt'.$ref,$d,72,16);
return $ret;}

static function redoxt($ref,$setlg){
list($to,$from)=explode('-',$setlg);
$d=self::original('',$ref,$from);
$d=self::read($from,'html',$d,$to);
self::update($d,$ref,$to);
return self::playxt($ref,$setlg,'');}

static function playxt($ref,$setlg,$d=''){
list($to,$from)=explode('-',$setlg); if(!$to)$to=ses('lng');
if(!$d)$d=self::original('',$ref,$from);
$ret=sql('txt','ynd','v','ref="'.$ref.'" and lang="'.$to.'"');
if(!$ret){$ret=self::com($ref,$d,$to,$from,'');
	if($ret)insert('ynd',mysqlra([$ref,$ret,$to],1));}
$bt=self::menuxt($ref,$to,$from);
$ret=self::convconn($ret);
return $bt.$ret;}

static function original($d,$ref,$lg,$o=''){
$ret=sql('txt','ynd','v','ref="'.$ref.'" and lang="'.$lg.'"');
if(!$ret && $d)insert('ynd',mysqlra([$ref,self::convhtml($d),$lg],1));
if($o && $d)self::update(self::convhtml($d),$ref,$lg);
return $ret;}

static function callxt($d,$ref,$setlg,$o=''){
list($to,$from)=explode('-',$setlg);
if(!$from)$from=self::detect('','',$d);
self::original($d,$ref,$from,$o);
$ret=self::playxt($ref,$setlg,$d);
return divd($ref,$ret);}

#tw
static function calltw($id,$setlg){
list($to,$from,$o)=opt($setlg,'-',3);
$ref='twt'.substr($id,-8);
$ret=sql('txt','ynd','v','ref="'.$ref.'" and lang="'.$to.'"'); if(!$ret)$o=1;
if($o)$d=sql('text','qdtw','v','twid='.$id.'');
if($o==1){$ret=self::com($ref,$d,$to,$from); insert('ynd',mysqlra([$ref,$ret,$to],1));}
elseif($o==2)$ret=$d;
$j=$ref.'_app__1_yandex_'; $bt='';
//$bt=lj('',$j.'calltw_'.$id.'_'.$setlg.'-2',picto('before')).' ';
if(auth(6)){$bt.=lj('',$j.'calltw_'.$id.'_'.$setlg.'-1',picto('refresh')).' ';
	$bt.=lj('','popup_app__1_yandex_redit_'.$ref.'_'.$setlg,picto('edit')).' ';}
if($o==2)$bt='';
return $bt.$ret;}

#umrec
static function callum($ref,$setlg,$edt='',$ret=''){
list($to,$from)=opt($setlg,'-'); if($to=='all')$to=$from; $bt='';
if(!$to)$to=ses('lng');//$to=setlng($to);
if(!$ret)$ret=sql('txt','ynd','v','ref="'.$ref.'" and lang="'.$to.'"');
$bt='';//$bt=self::menulg($ref,$to,$from);
//if(!$ret){$bt=''; $ret=self::redo($ref,$setlg,1,$edt);}//disactivated
//if(!$ret)$ret=sql('txt','ynd','v','ref="'.$ref.'" and lang="'.$from.'"');
if(!$ret)$ret=self::redo($ref,$setlg,1,$edt,1);//patch
if(!$edt)$ret=self::convconn($ret,'');
if($edt==2)return $ret;//txt brut
if($ret)return divd('ynd'.$ref,$bt.$ret);}

//interface
static function face($p){
$rid=randid('yd');
$ret=textarea('txt',$p);
$ret.=lj('popbt',$rid.'_app__1_yandex_read___txt',nms(153).' '.self::$motor);//translate
$ret.=lj('popbt',$rid.'_app__1_yandex_detect___txt','detection');
$ret.=lj('popbt',$rid.'_app__1_yandex_getlangs','langs');
return $ret.divd($rid,'');}

static function install(){//ses('ynd','pub_yandex');//return;
mysql::install('yandex',['ref'=>'var11','txt'=>'text','lang'=>'var2'],0);}

static function home($p,$o){$rid=randid('yandex');
if($p=='install')self::install();
$ret=self::face($p,$o);
$bt.=msqbt('',nod('yandex_1'));
return $bt.divd($rid,$ret);}
}
?>