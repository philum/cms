<?php
//philum_plugin_twitter 
//fast recap of used functions in differents pages
//require($pop); require($tri); require($art); //58+29+26=113ko (this=6ko)
error_reporting(6135);
session_start();
/*
#pop
//codeline
function codeline_b($v,$p,$c){//v§p:c //v:c
switch($c){
//elements
case('br'): return br(); break;
case('balise'): if($p){list($bal,$id,$css)=explode('|',$p);
	return balc($bal,$css.($id?'" id="'.$id:''),$v);} break;
case('html'): if($p && $v)return balc($p,'',$v); break;
case('div'): if($v)return div($p,$v); break;
case('css'): if(trim($v))return btn($p,$v); break;//
case('size'): return balc("font",'" size="'.$p,$v); break;
case('clear'): return divc($c,$v); break;
//attributs
case('id'): return atb($c,$v); break;
case('class'): return atb($c,$v); break;
case('style'): return atb($c,$v); break;
case('name'): return atb($c,$v); break;
//apps
case('text'): return $v?$v:$p; break;
case('url'): return lka($v,$p?$p:preplink($v)); break;
case('link'): $r=define_link($v.'§'.$p); return lka($r[1].$r[2],$r[3]); break;
case('anchor'): return '<a name="'.$v.'"></a>'; break;
case('date'): return date($p,is_numeric($v)?$v:time()); break;
case('title'): return suj_of_id($v); break;
case('read'): return read_msg($v,$p); break;
case('image'): return image($v,'',''); break;
default:return $v;}}

function correct_txt_b($msg,$cr,$gouv){//g2
$st="["; $nd="]";
$in=strpos($msg,$st);
if($in!==false){
	$deb=substr($msg,0,$in);
	$out=strpos(substr($msg,$in+1),$nd);
	if($out!==false){
		$nb_in=substr_count(substr($msg,$in+1,$out),$st);
		if($nb_in>=1){
			for($i=1;$i<=$nb_in;$i++){$out_tmp=$in+1+$out+1;
				$out+=strpos(substr($msg,$out_tmp),$nd)+1;
			$nb_in=substr_count(substr($msg,$in+1,$out),$st);}
			$mid=substr($msg,$in+1,$out);
			$mid=correct_txt_b($mid,$cr,$gouv);}
		else{$mid=substr($msg,$in+1,$out);}
		if($gouv=='codeline'){$r=decompact_conn($mid);
			$mid=codeline_b($r[0],$r[1],$r[2]);}
		$end=substr($msg,$in+1+$out+1);
		$end=correct_txt_b($end,$cr,$gouv);}
	else{$end=substr($msg,$in+1);}}
else{$end=$msg;}
return ($deb.$mid.$end);}

#art
function bdt_all_b($p,$tpl){
	if($tpl=="twitter")$tmp=template_twit_b();
return make_template_b($tmp,$p);}

function template_twit_b(){
return '[[_URL§[_IMG1:image]:url]§[float:left; width:54px; margin:6px 0 0 0:style]:div] [[_URL§[_AUTHOR§txtsmall:css]:url] _SUJ[:br][_DATE§txtsmall2:css][:clear]§[twitter:class][_ID:id]:div]';}

function make_template_b($ret,$p){$arr=default_art_template_b();
foreach($arr as $k=>$v){if(!$p[$k])$ret=str_replace($v,'',$ret);}//del_empty
$ret=str_replace(array('_DAY','_IMG1'),array($p['day'],$p['img1']),$ret);//injections
$ret=correct_txt_b($ret,"",'codeline');//build
foreach($arr as $k=>$v){$ret=str_replace($v,$p[$k],$ret);}//place
return $ret;}

function default_art_template_b(){
$arr=array("artedit","pid","id","url","edit","back","avatar","author","date","day","nbarts","tag","usertags","words","search","parent","pager","rss","social","open","tracks","source","lenght","lang","opt","sty","addclr","add2cart","price","suj","artmod","thumb","img1","bkg","msg","trkbk");
foreach($arr as $v){$ret[$v]='_'.strtoupper($v).'';}
return $ret;}*/

//twitter
/*function twit_links($d){$d=str_replace("\n"," ",$d);
$r=explode(" ",$d); $tw='http://twitter.com/';
foreach($r as $k=>$v){
if(strstr(',;:!?./§',substr($v,-1))!==false){$v=substr($v,0,-1); $vb=substr($v,-1);}
else $vb='';
if(substr($v,0,4)=="http")$ret[]=lkt('txtx',$v,preplink($v)).$vb;
elseif(substr($v,0,1)=="@")$ret[]=lkt('txtsmall2',$tw.substr($v,1),$v).$vb;
elseif(substr($v,0,1)=="#")$ret[]=lkt('txtsmall2',$tw.'#!/search?q=%23'.substr($v,1),$v).$vb;
else $ret[]=$v;}
return implode(' ',$ret);}*/

/*function twit_j($v,$b,$res){if($res)$v=substr($res,0,-1);
if(!$v)return btn('txtalert','empty');
//$lk='http://search.twitter.com/search.atom?q='.$v;
//$lk='http://twitrss.me/twit_user_to_rss/?user='.$v;
$lk='https://twitter.com/'.$v;
//$rss=simplexml_load_file($lk); //simplexml_load_string
$rss=read_rss($lk,"entry",array("id","published","title","author","image"));//"content"
$nb=sizeof($rss);
for($i=1;$i<$nb;$i++){
	if($rss[$i][2]){
	$p["id"]=substr($rss[$i][0],28);
	$p["date"]=rss_date($rss[$i][1]);
	$p["img1"]=$rss[$i][4];
	$p["suj"]=twit_links($rss[$i][2]);
	$author=embed_detect($rss[$i][3],"<name>"," ",'');
	$p["url"]='http://twitter.com/'.$author;
	$p["author"]=$author;
	$ret.=bdt_all_b($p,'twitter');}}
return $ret;}*/

#plug

function array_dig($ret,$d){
$r=explode('/',$d); echo $n=count($r);
if($n==1)return $ret[$r[0]];
if($n==2)return $ret[$r[0]][$r[1]];
if($n==3)return $ret[$r[0]][$r[1]][$r[2]];
if($n==4)return $ret[$r[0]][$r[1]][$r[2]][$r[3]];
if($n==5)return $ret[$r[0]][$r[1]][$r[2]][$r[3]][$r[4]];
if($n==6)return $ret[$r[0]][$r[1]][$r[2]][$r[3]][$r[4]][$r[5]];}

//ope
function mk_attrb($d,$a,$b){//$r=explode('=',$d);
$n=substr_count($d,'='); if($n==0 or !$d)return; $d=str_replace("\n",' ',$d);
for($i=0;$i<$n;$i++){
$pos[$i]=strpos($d,'=',$pos[$i-1]+1); $da=substr($d,0,$pos[$i]); $db=substr($d,$pos[$i]+1);
$first=substr($db,1); if($first=='"')$sep='"'; elseif($first=="'")$sep="'";
$posa=strrpos($da,' '); $posb=strpos($db,'"',1);
if($posa!==false)$va=substr($da,$posa);
if($posb!==false)$vb=substr($db,1,$posb-1);
$ret[trim($va)]=trim($vb);}
//p($pos);
return $ret;}

//$before <$aa_balise> $balise </$bb_balise> $after
function interpret_xml($v){static $i; $i++;//static $ret;
$aa=strpos($v,"<"); $ab=strpos($v,">");//aa_balise 
if($aa!==false && $ab!==false && $ab>$aa){
$before=substr($v,0,$aa);//...< //htmlentities
$aa_inner=ecart($v,$aa,$ab);//<...>
	$aa_end=strpos($aa_inner," ");
	if($aa_end!==false)$aa_balise=substr($aa_inner,0,$aa_end);
	else $aa_balise=$aa_inner;}
$ba=strpos($v,'</'.$aa_balise,$ab); $bb=strpos($v,">",$ba);//bb_balise
if($ba!==false && $bb!==false && $aa_balise!="" && $bb>$ba){ 
	$ba=recursearch($v,$ab,$ba,$aa_balise);//recursearch
	$bb=strpos($v,">",$ba); if($bb)$bb_balise=ecart($v,$ba,$bb);
	$balise=ecart($v,$ab,$ba);}
elseif($ab!==false)$bb=$ab;
else $bb=-1;
$after=substr($v,$bb+1);//>...
//ok,go
$ia=$i;
$aa_balise=strtolower($aa_balise); $bb_balise=strtolower($bb_balise); 
$ret[$ia]['balise']=$aa_balise;
$attrb=mk_attrb($aa_inner,' ','=');
if($attrb)$ret[$ia]['props']=$attrb;
//itération
if(strpos($balise,'<')!==false)$balise=interpret_xml($balise);
if($balise)$ret[$ia]['content']=$balise;
//sequence
if(strpos($after,'<')!==false)$retb=interpret_xml($after);
if($retb)$ret=array_merge_b($ret,$retb);
return $ret;}

/*function xml_rss($r){
//$enc=strtolower(array_dig($r,'0/props/encoding'));
//$title=array_dig($r,'1/content/3/content/0/content');
//$items=array_dig($r,'1/content/3/content');//pr($ra);
echo $enc=strtolower($r['0']['props']['encoding']); if($enc=='utf-8')$utf=1;
$title=$r['1']['content']['3']['content']['0']['content'];
$items=$r['1']['content']['3']['content'];//pr($items);
foreach($items as $k=>$v){
	if(is_array(@$v['content']))//items
		foreach($v as $ka=>$va){$i++;//elems
			if(is_array($va))foreach($va as $vb){//pr($vb);
				$d=@$vb['content'];
				//$d=unescape($d);
				//$d=html_entity_decode($d);
				if($utf)$d=utf8_decode($d);
				//$d=utflatindecode($d);
				$rb[$i][@$vb['balise']]=$d;}}}
return $rb;}

function xml_path($r,$d){
foreach($r as $k=>$v)
	//if(is_array($v))$ret[]=xml_path($v,$d); else 
	if($v['balise']=='section')$ret[]=$v['article'];
return $ret;}

function xml_html($r){
echo $enc=strtolower($r['0']['props']['encoding']); if($enc=='utf-8')$utf=1;
$items=$r['1']['content']['3']['content'];//pr($items);???
foreach($items as $k=>$v){}
return $r;}*/

function twit_url($d,$p){
$a='AKfycbz2PyB3-YiTbXwuCKZjdz9NS0XyA3GD-TeAXYLHsLDPF-nTfCk';
$f='https://script.google.com/macros/s/'.$a.'/exec';
//Twitter Timeline of user @labnol
$r['user']=$f.'?action=timeline&q='.$d;
//Twitter Favorites of user @labnol
$r['favs']=$f.'?action=favorites&q='.$d;
//Twitter List labnol/friends-in-india
$r['list']=$f.'?action=list&q='.$d.'/'.$o;
//Twitter Search for New York
$r['search']=$f.'?action=search&q='.urlencode($d);
return $r[$p];}

function twit_read($f){
req('tri');
//$d=@file_get_contents($f);
$d=get_file($f); //echo txarea('',$d,60,10);
//$d=embed_detect_c($d,'<body');
//$d=html_entity_decode($d);
//$r=interpret_xml($d); //pr($r);
//$r=xml_rss($r);
//$r=xml_html($r);
pr($r);
//return $ret;
}

/*ini_set("user_agent","Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
ini_set("max_execution_time", 0);
ini_set("memory_limit", "10000M");*/

function twit_xml($f){
$r=simplexml_load_file($f); //p($r);
//$xml=$r->channel->item; if(!$xml)$xml=$r->channel->entry; //p($xml); //$nb=count($xml);
//$xml=array_dig($r,'html/body/div[3]');//pr($ra);
//$xml=$r->body->div;
//$xml=$r->xpath('sparent[@attr=value]//element');
//$r=file_get_html($f);

/*//loadhtml
$html=file_get_contents($f);
$doc=new DOMDocument();
$doc->loadHTML($html);*/
  
//$xml=$r->xpath('//div[@class=entry]');
foreach($r as $k=>$v){
	//echo $v->nodeValue;
	//echo $v[0].br();
	p($v); echo hr();
	//if($v['class']=='content')$ret=(string)$v;
	//$va=utf8_decode($v->title); $lnk=$v->link; $guid=$v->guid;
	//echo $va.'-'.$lnk.'-'.hr();
	//echo $v->description.hr();
	}
return $ret;
}

function twit_dom($f){
$r=new DOMDocument();
//$r->strictErrorChecking=FALSE;
//libxml_use_internal_errors(true);
//$d=file_get_contents($f); $r->loadHTML($d); $xml=simplexml_import_dom($r);//'<?phpxml encoding="UTF-8">'.
$r->loadHTMLFile($f); //p($r->childNodes->firstChild->nextSibling);

foreach($r->childNodes as $item)//dirty fix
	if($item->nodeType == XML_PI_NODE)$r->removeChild($item);//remove hack
$r->encoding='iso-8859-1';//insert proper

//echo $r->saveHTML();
//$xml=$r->xpath('//div[@class=content]'); echo $v[0].br();

foreach($r->childNodes as $k=>$item){
	p($item);
	//$ret.=$item->firstChild->nextSibling->textContent;//nextSibling
	//$ret.=$item->nodeValue;
	//$ret.=$item->nodeName;
	//$ret.=$item->hasAttributes()?$item->getAttribute('id'):'';
	
/*foreach($item->childNodes as $v){
	$ret.=$v->nodeValue;
}*/
	//$ret.=$item->textContent;
	//p($r->childNodes);//
	$ret.=hr();
	}
echo utf8_decode_b($ret);
}

/*
childNodes
getElementsByTagName('img');
$img = $dom->getElementsByTagName('img')->item(0);
echo $img->attributes->getNamedItem("src")->value;
*/

function twit_tmp($r){
if($r)foreach($r as $k=>$p){
	$rc=array('id','date','msg','url','name','author','img1','rtw');
	foreach($rc as $va)$rb[$k][]=$p[$va];//reorder
	//$p['msg']=correct_txt($p['msg'],'','sconn');
	$p['msg']=format_txt_r($p['msg'],'','');
	$ret.=bdt_all_b($p,'twitter');}
return $ret;}

function twit_get($f){
require('tiers/simple_html_dom.php');
$doc=file_get_html($f); //p($doc);
echo count($doc->childNodes); //GridTimeline-items
//$xml=$doc->find('div[class=entry]');
foreach($doc as $k=>$item){echo $k.br();
	//$ret[$k]['txt']=$item->children(1)->innertext;//txt
	//$ret[$k]['dat']=$item->children(0)->children(1)->innertext;
	//$ret[$k]['url']=$item->children(0)->children(0)->href;
	//$ret[$k]['name']=$item->children(0)->find('a',0)->href;
	//echo utf8_decode_b($div);
	echo $item->innertext;
	echo hr();
	}
p($ret);
return $ret;}

function plug_twit($v,$o){$ib=randid();
list($v,$p)=split_one('§',$v,1); if($p)$o=$p;
if(is_numeric($o))$o*=1000; else $o=3000;
$t=input(1,'twt'.$ib,$v,'txtcadr').' ';
$t.=lj('txtcadr','twit'.$ib.'_plug__2_twit_twit*j___twt'.$ib,picto('reload'));
$t.=btn('txtcadr',lkt("",'http://twitter.com/'.$v,picto('link')));
//$javs=temporize("twittimer","SaveD('twit".$ib.'_plug_twit_twit*j_'.$v."');",$o);
//$ret=divd('twit'.$ib,twit_j($v,'','')); $ret='stream closed';

$f=twit_url($v,'search');
$ret=twit_read($f);
//$ret=twit_xml($f);
//$ret=twit_dom($f);
//$ret=twit_get($f);
//$ret=twit_tmp($ret);
return $javs.$t.$ret;}//divd('scroll',)

?>