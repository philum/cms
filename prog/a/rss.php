<?php //philum/a/rss
class rss{

//lib
static function datas($data,$t,$r){//lit_rss
if(strpos($data,'<item')===false)$t='entry';
$tmp=preg_split("/<\/?".$t.">/",$data);//html_entity_decode
foreach($r as $v){$tmp2=preg_split("/<\/?".$v.">/",$tmp[0]); $ret[0][]=@$tmp2[1];}
for($i=1;$i<sizeof($tmp)-1;$i+=1){
	if($r){foreach($r as $v){
	if($v=='image')$ret[$i][]=embed_detect($tmp[$i],'type="image/png" href="','"','');
	else{$tmp2=preg_split("/<\/?".$v.">/",$tmp[$i]);
		if(isset($tmp2[1]))$tmp2[1]=str_replace(['<![CDATA[',']]>',''],'',$tmp2[1]);
	if(isset($tmp2[1]))$ret[$i][]=html_entity_decode($tmp2[1]);}}}}
return $ret;}

static function read_rss($f,$t,$r){$d=get_file($f);
$enc=strtolower(embed_detect($d,'encoding="','"',''));
if($enc=='utf-8' && ses('enc')=='utf-8')$d=utf8_decode_a($d);//if()
elseif(ses('enc')=='utf-8')$d=utf8_decode_b($d);//utfb
$d=str_replace([' isPermaLink="false"',' rel="stylesheet"',' type="text/css"'],'',$d); 
return self::datas($d,$t,$r);}

static function read_xml($f){////if(!joinable($f))return;
//$d=get_file($f); $enc=strtolower(embed_detect($d,'encoding="','"'));
//if($enc=='utf-8')//if(ses('enc')=='utf-8')$d=utf8_decode_a($d); else 
//if(ses('enc')!='utf-8')$d=utf8_decode_b($d);
//$rss=@simplexml_load_string($d); //p($rss);
//require('plug/tiers/simple_html_dom.php');
//$d=get_dom($f);
$rss=@simplexml_load_file($f); //pr($rss);
if(!$rss)return; //p($rss);
$xml=$rss->channel->item; if(!$xml)$xml=$rss->channel->entry;
if(!$xml)$xml=$rss->items; if(!$xml)$xml=$rss->feed; if(!$xml)$xml=$rss->entry;
return $xml?$xml:$rss;}

static function load_xml($f,$o=''){
$xml=self::read_xml($f); $ret=[];
if($xml)foreach($xml as $k=>$v){
$va=utf8_decode_b($v->title); $dat=$v->pubDate; if(!$dat)$dat=$v->updated;
$lnk=$v->link; if(strpos($lnk,'feedproxy'))$lnk=$v->guid;
//if($v->comments)$lnk=strto($v->comments,'#');
if(!$lnk)$lnk=$v->link[0]['href']; 
if(!$lnk)$lnk=$v->childnode['href'];
if(is_object($lnk) && $v->link['href'])$lnk=$v->link['href'];
//if($v->link[0])$lnk=$v->link[0]['href']; //pr($lnk);
//if(!$lnk)$lnk=$v->link['href'][0]; 
//if(!$lnk)$lnk=$v[1]['href'];
if(substr($lnk,0,1)=='/')$lnk=http(domain($f)).$lnk;
if(!$dat){$dc=$v->children('http://purl.org/dc/elements/1.1/'); $dat=$dc->date;}
if($v->content)$txt=$v->content; elseif($v->description)$txt=$v->description; else $txt=$v->summary;//content
if($txt)$txt=utf8_decode_b($txt);
$ret[]=[$va,$lnk,$dat,$txt];}//utfenc
return $ret;}

//pop
static function rssin_old($f){echo '-';//
$rss=self::read_rss($f,'item',['title','link','guid','pubDate']); $nb=count($rss); $i=0;
if(is_array($rss))for($i=1;$i<=$nb;$i++){list($va,$lnk,$guid,$date)=arr(val($rss,$i),4);
	$va=trim(del_n($va)); $va=clean_title($va); 
	if(!$lnk)$lnk=$guid; $lnk=utmsrc($lnk);
	$ret[]=[$va,$lnk,$date,''];}
return $ret;}

static function rssin_xml($f){$rss=self::load_xml($f); $ret=[];
if($rss)foreach($rss as $k=>$v){list($va,$lnk,$dat,$txt)=$v; 
	$va=trim(del_n(strip_tags($va))); $va=clean_title($va);
	$lnk=utmsrc($lnk); if($dat)$dat=rss_date($dat);
	$ret[]=[$va,$lnk,$dat,$txt];}
return $ret;}

static function recognize_article($f,$d,$alx){$d=clean_title($d);
if(is_string($f) && isset($alx[$f]))return $alx[$f]; 
elseif(isset($alx[$d]))return $alx[$d];
elseif(isset($alx[substr($f,7)]))return $alx[substr($f,7)];
$id=sql('id','qda','v','nod="'.ses('qb').'" and mail="'.$f.'" LIMIT 1');
if(!$id)$id=sql('id','qda','v','nod="'.ses('qb').'" and suj like "%'.$d.'%" LIMIT 1');
return $id;}

static function alx(){//already_exists, suj&url
$r=$_SESSION['rqt']??[]; $ret=[];
if($r)foreach($r as $k=>$v){$ret[$v[2]]=$k; $ret[$v[9]]=$k;}
return $ret;}

static function feedproxy($f){
if(substr($f,0,2)=='//')$f='http:'.$f; $d=get_file($f);
$enc=embed_detect(strtolower($d),'charset=','"','');
if(strtolower($enc)=='utf-8')$d=utf8_decode_b($d); //eco($d,1);
$s='<meta property="og:url" content="'; if(strpos($d,$s))return embed_detect($d,$s,'"','');
$s="<link rel='canonical' href='"; if(strpos($d,$s))return embed_detect($d,$s,"'",'');}

static function load($f){$alx=self::alx();//sesmk('alx');
$r=self::rssin_xml($f); if(!$r)$r=self::rssin_old($f);
if($r)foreach($r as $k=>$v){list($suj,$lnk,$dat,$txt)=arr($v,4);
	if(strpos($lnk,'feedproxy'))$lnk=self::feedproxy($lnk);
	//if(ses('enc')!='utf-8')$suj=utf8_decode_b($suj);
	//if(strpos($lnk,'spip.'))$lnk=strto($lnk,'spip.').strend($lnk,'/spip');
	$id=self::recognize_article($lnk,$suj,$alx);
	$ret[]=[$suj,$lnk,$dat,$id,$txt];}
return $ret;}

static function lk($k,$v,$f){
$ret=lj('','popup_plupin___rssin_'.ajx($v),picto('get')).' ';
$ret.=lj('','adc_batchprep__3_'.ajx($v),picto('update')).' ';
$ret.=lj('','popup_msqledit___users_'.ses('qb').'*rssurl_'.$k.'_2',picto('flag')).' ';
$ret.=lkt('txtsmall2',$f,picto('rss'));
return $ret;}

static function call($k,$v){//rssin
list($p,$o)=prepdlink($v); $f=$p; $f=http($f); $i=0; chrono();
$r=self::load($f); $nb=count($r); $ret=hidden('','addop',1); $t=self::lk($k,$v,$f);
foreach($r as $k=>$v){$btc=''; list($va,$lnk,$dat,$id,$txt)=$v; $i++;
	if($id)$btc.=popart($id).' '; $lnj=ajx($lnk);
	$btc.=lj('','popup_vacuum__3_'.$lnj,picto('view'));//,att(htmlentities($txt))
	if(auth(4) && !$id){$mem=vacses($lnk,'b')?'ok':picto('add');
		$btc.=ljp(atd('ars'.$i),'ars'.$i.'_batch___'.$lnj.'_p',$mem);}
	if(!$id)$btc.=lj('','popup_search__3_'.ajx($va).'_',picto('search'));
$btc.=lkt('',$lnk,picto('url')); $btc.=btn('txtsmall',$dat);
if($va)$ret.=divc('',$btc.' '.$va);}//$id?'hide':
$ret=scroll_b($nb,$ret,22,'');
return $t.chrono('time').balc('ul','panel',$ret);}

static function menu($p,$n=3){
$bt=msqbt('',nod($p)).' '; $n=3;//
for($i=1;$i<=$n;$i++)$bt.=lj('txtsmall','rssj_rssjb___'.$p.'_'.$i,$i).' ';
$bt.=lj('txtsmall','rssj_rss,xss___'.$p.'','xss').' ';
$bt.=lj('txtsmall','rssj_rss,twss___'.$p.'','twss').' ';
//$bt.=lj('txtsmall','rssj_app___xss','xss');
return $bt;}

static function xss(){
return self::menu(3).xss::home('','');}

static function twss(){
return self::menu(3).twss::home('','');}

static function home($p,$o){$ret=[];//rssj
$r=msql_read('',nod($p),'',1); $bt='';
if($r)foreach($r as $k=>$v){$v3=isset($v[3])?$v[3]:''; $ro[]=$v3;
	if($o && $o==$v3)$d=self::call($k,$v[0]); else $d='';
	if($d)$c=' active'; else $c='';
	if(isset($v[0]))$ret[$v[2]][]=toggle($c,'rsj'.$k.'_rssj_'.$k.'_'.ajx($v[0],''),isset($v[1])?$v[1]:preplink($v[0])).' '.btd('rsj'.$k,$d).br();}
if(auth(6))$bt=self::menu($p,max($ro));
return $bt.make_tabs($ret,'rss','nbp');}

//read
static function read($d){$url=''; $id='';
$d=str_replace('?read=','',ajx($d,1)); $r=explode('/',$d); $mx=count($r)-1;
for($i=2;$i<$mx;$i++)$url.=$r[$i]; if(is_numeric($r[$mx]))$id=$r[$mx];
return 'http://'.$url.'/apicom/id:'.$id.',json:1,nl:1';}//,conn:1

static function art($u,$p,$br){
$u=http($u); $lnk=$u; $id=strend($u,'/');
if($p)$u=self::read($u); $d=get_file($u);
$r=json_decode($d,true); //eco($r);
list($t,$dat,$txt)=vals($r[$id],['title','time','content']);
$t=utf8_decode($t); $t=html_entity_decode($t);
$txt=utf8_decode($txt); $txt=html_entity_decode($txt);
//$txt=conn::parser($txt,3,'');
if($t)return balb('h2',lkc('',$lnk,$t)).divc('',$txt);}

static function output($p,$o){
$p=$p?$p:sesr('prms','default_hub'); $o=$o?$o:2;//prw
return plugin('rssxml',$p,$o);}

}
?>