<?php 
class rssin{
static $mth=0;
//1
static function datas_old($data,$t,$r){//lit_rss
if(strpos($data,'<item')===false)$t='entry';
$tmp=preg_split("/<\/?".$t.">/",$data);//html_entity_decode
foreach($r as $v){$tmp2=preg_split("/<\/?".$v.">/",$tmp[0]); $ret[0][]=@$tmp2[1];}
for($i=1;$i<sizeof($tmp)-1;$i+=1){
	if($r){foreach($r as $v){
	if($v=='image')$ret[$i][]=between($tmp[$i],'type="image/png" href="','"','');
	else{$tmp2=preg_split("/<\/?".$v.">/",$tmp[$i]);
		if(isset($tmp2[1]))$tmp2[1]=str_replace(['<![CDATA[',']]>',''],'',$tmp2[1]);
	if(isset($tmp2[1]))$ret[$i][]=html_entity_decode($tmp2[1]);}}}}
return $ret;}

static function read_old($f,$t,$r){$d=get_file($f);
$d=str_replace([' isPermaLink="false"',' rel="stylesheet"',' type="text/css"'],'',$d??''); 
return self::datas_old($d,$t,$r);}

//2
static function read_xml($f){
$rss=@simplexml_load_file($f); //pr($rss);
if(!$rss)return; //p($rss);
$xml=$rss->channel->item; if(!$xml)$xml=$rss->channel->entry;
if(!$xml)$xml=$rss->items; if(!$xml)$xml=$rss->feed; if(!$xml)$xml=$rss->entry;
return $xml?$xml:$rss;}

static function load_xml($f,$o=''){
$xml=self::read_xml($f); $ret=[];
if($xml)foreach($xml as $k=>$v){
$va=($v->title); $dat=$v->pubDate; if(!$dat)$dat=$v->updated; if(!$dat)$dat=$v->date; $txt='';
$lnk=$v->link; if(strpos($lnk,'feedproxy'))$lnk=$v->guid;
//if($v->comments)$lnk=strto($v->comments,'#');
if(!$lnk)$lnk=$v->link[0]['href']??''; 
if(!$lnk)$lnk=$v->childnode['href']??'';
if(is_object($lnk) && $v->link['href'])$lnk=$v->link['href'];
if(strpos($lnk,'feedproxy'))$lnk=self::feedproxy($lnk);
//if(substr($lnk,0,1)=='/')$lnk=http(domain($f)).$lnk;
if(!$dat){$dc=$v->children('http://purl.org/dc/elements/1.1/'); $dat=$dc->date;}
//if($v->content)$txt=$v->content; elseif($v->description)$txt=$v->description; else $txt=$v->summary;//content
//if(is_utf($va))$va=utf8dec_b($va); if($txt)$txt=($txt);
$ret[]=[$va,$lnk,$dat,$txt];}//utfenc
return $ret;}

static function feedproxy($f){
if(substr($f,0,2)=='//')$f='http:'.$f; $d=get_file($f);
$enc=between(strtolower($d),'charset=','"','');
if(strtolower($enc)=='utf-8')$d=utf8dec_b($d);
$s='<meta property="og:url" content="'; if(strpos($d,$s))return between($d,$s,'"');
$s="<link rel='canonical' href='"; if(strpos($d,$s))return between($d,$s,"'");}

//3
static function load_dom($f,$o=''){$rt=[]; if(!$f)return $rt;
$dom=fdom($f,0); $r=$dom->getElementsByTagName('item');
foreach($r as $item){$suj=''; $lnk=''; $com=''; $guid=''; $dat=''; $pdat=''; $txt='';
	foreach($item->childNodes as $child){$nod=$child->nodeName;
	switch($nod){
	case('title'):$suj=$child->nodeValue; break;
	case('link'):$lnk=$child->nodeValue; break;
	case('guid'):$guid=$child->nodeValue; break;
	case('comments'):$com=$child->nodeValue; break;
	case('date'):$dat=$child->nodeValue; break;
	case('pubDate'):$pdat=$child->nodeValue; break;}
	//case('description'):$txt=$child->nodeValue; break;
	if(!$lnk && $com)$lnk=strto($com,'#'); //if(!$lnk && $guid)$lnk=$guid;
	if(is_numeric($lnk))$lnk=''; if(!$dat && $pdat)$dat=$pdat;}
 	if($lnk)$rt[]=[$suj,$lnk,$dat,$txt];}
return $rt;}

//pop
static function rssin_old($f){self::$mth=3;
$rss=self::read_old($f,'item',['title','link','guid','pubDate']); $nb=count($rss); $i=0;
if(is_array($rss))for($i=1;$i<=$nb;$i++){[$va,$lnk,$guid,$date]=arr(val($rss,$i),4);
	if(!$lnk)$lnk=$guid;
	$ret[]=[$va,$lnk,$date,''];}
return $ret;}

static function rssin_xml($f){self::$mth=2;
$rss=self::load_xml($f); $ret=[];
if($rss)foreach($rss as $k=>$v){[$va,$lnk,$dat,$txt]=$v; 
	if($dat)$dat=rss_date($dat); //$va=utf8dec_b($va);
	$ret[]=[$va,$lnk,$dat,$txt];}
return $ret;}

static function rssin_dom($f){self::$mth=1;
$rss=self::load_dom($f); $ret=[];
if($rss)foreach($rss as $k=>$v){
	[$va,$lnk,$dat,$txt]=$v; 
	if($dat)$dat=rss_date($dat);
	$ret[]=[$va,$lnk,$dat,$txt];}
return $ret;}

//load
static function recognize_article($f,$d,$alx){$d=str::clean_title($d);
if(is_string($f) && isset($alx[$f]))return $alx[$f]; 
elseif(isset($alx[$d]))return $alx[$d];
elseif(isset($alx[substr($f??'',7)]))return $alx[substr($f,7)];
$id=sql('id','qda','v','nod="'.ses('qb').'" and mail="'.$f.'" LIMIT 1');
if(!$id)$id=sql('id','qda','v','nod="'.ses('qb').'" and suj like "%'.$d.'%" LIMIT 1');
return $id;}

static function alx(){//already_exists, suj&url
$r=$_SESSION['rqt']??[]; $ret=[];
if($r)foreach($r as $k=>$v){$ret[$v[2]]=$k; $ret[$v[9]]=$k;}
return $ret;}

static function load($f,$mth=2){$r=[];
$alx=self::alx();//sesmk2('rssin','alx');
$ret=[];
switch($mth){
	case(1):$r=self::rssin_dom($f);break;
	case(2):$r=self::rssin_xml($f);break;
	case(3):$r=self::rssin_old($f);break;
	default: $r=self::rssin_dom($f);//1
		if(!$r)$r=self::rssin_xml($f);//2
		if(!$r)$r=self::rssin_old($f);//3
	break;}
if($r)foreach($r as $k=>$v){[$suj,$lnk,$dat,$txt]=arr($v,4);
	$suj=utf8dec_b($suj); $suj=trim(str::del_n(strip_tags($suj)));
	$suj=str::clean_title($suj); $lnk=utmsrc($lnk); 
	//if(strpos($lnk,'feedproxy'))$lnk=self::feedproxy($lnk);
	//if(strpos($lnk,'spip.'))$lnk=strto($lnk,'spip.').strend($lnk,'/spip');
	$id=self::recognize_article($lnk,$suj,$alx);
	$ret[]=[$suj,$lnk,$dat,$id,$txt];}
return $ret;}

static function lk($k,$v,$f){$mth=self::$mth;
$ret=lj('','popup_plugin___rssin_'.ajx($v),picto('get'));
$ret.=lj('','adc_sav,batchprep__3_'.ajx($v),picto('update'));
$ret.=lj('','popup_msqledit___users_'.ses('qb').'*rssurl_'.$k.'_2',picto('flag'));
$ret.=lj(active($mth,1),'rsj'.$k.'_rssin,call_3__'.$k.'-1_'.ajx($f),'1');
$ret.=lj(active($mth,2),'rsj'.$k.'_rssin,call_3__'.$k.'-2_'.ajx($f),'2');
$ret.=lj(active($mth,3),'rsj'.$k.'_rssin,call_3__'.$k.'-3_'.ajx($f),'3');
$ret.=lkt('txtsmall2',$f,picto('rss'));
$ret.=chrono('time');
return $ret;}

static function call($kn,$u){//rssin
[$kn,$mth]=expl('-',$kn,2); chrono();
[$f,$o]=prepdlink($u); $f=http($f); $i=0; $ret=''; //$mth=2;
$r=self::load($f,$mth); $nb=count($r); //$ret=hidden('addop',1);
foreach($r as $k=>$v){$btc=''; [$va,$lnk,$dat,$id,$txt]=$v; $i++;
	if($id)$btc.=ma::popart($id).' '; $lnj=ajx($lnk);
	$btc.=lj('','popup_sav,batchpreview__3_'.$lnj,picto('view'));//,att(htmlentities($txt))
	if(auth(4) && !$id){$mem=vacses($lnk,'b')?'ok':picto('add');
		$btc.=ljp(atd('ars'.$i),'ars'.$i.'_sav,batch___'.$lnj.'_p',$mem);}
	if(!$id)$btc.=lj('','popup_search,home__3_'.ajx($va).'_',picto('search'));
$btc.=lkt('',$lnk,picto('url')); $btc.=btn('txtsmall',$dat);
if($va)$ret.=divc('',$btc.' '.$va);}//$id?'hide':
$ret=scroll($nb,$ret,22,'');
$bt=self::lk($kn,$u,$f);
return $bt.tagc('ul','panel',$ret);}

static function xss(){return self::menu(3).xss::home('','');}
static function twss(){return self::menu(3).twss::home('','');}

static function menu($p,$n=3){
$bt=msqbt('',nod($p)).' '; $n=3;//
for($i=1;$i<=$n;$i++)$bt.=lj('txtsmall','rssj_rssin,home___'.$p.'_'.$i,$i).' ';
$bt.=lj('txtsmall','rssj_rssin,xss___'.$p.'','xss').' ';
$bt.=lj('txtsmall','rssj_rssin,twss___'.$p.'','twss').' ';
return $bt;}

static function home($p,$o=''){$ret=[];//rssj
$r=msql::read('',nod($p),'',1); $bt='';
if($r)foreach($r as $k=>$v){$v3=isset($v[3])?$v[3]:''; $ro[]=$v3;
	if($o && $o==$v3)$d=self::call($k,$v[0]); else $d='';
	if($d)$c=' active'; else $c='';
	if(isset($v[0]))$ret[$v[2]][]=toggle($c,'rsj'.$k.'_rssin,call___'.$k.'_'.ajx($v[0]),$v[1]??preplink($v[0])).' '.btd('rsj'.$k,$d).br();}
if(auth(6))$bt=self::menu($p,max($ro));
$ret=tabs($ret,'rss','nbp');
if($o)return $ret;
return $bt.divd('rssj',$ret);}

}
?>