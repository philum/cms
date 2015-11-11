<?php
//philum_plugin_twitter 
//fast recap of used functions in differents pages
//require($pop); require($tri); require($art); //58+29+26=113ko (this=6ko)
error_reporting(6135);
session_start();

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
		else $mid=substr($msg,$in+1,$out);
		if($gouv=='codeline'){$r=decompact_conn($mid);
			$mid=codeline_b($r[0],$r[1],$r[2]);}
		//if($gouv=='connectors'){}
		if($gouv=='stripconn')$mid=strip_conn($mid,$cr);
		$end=substr($msg,$in+1+$out+1);
		$end=correct_txt_b($end,$cr,$gouv);}
	else{$end=substr($msg,$in+1);}}
else{$end=$msg;}
return ($deb.$mid.$end);}

#art
function make_template_b($ret,$p){$arr=template_vars_b();
foreach($arr as $k=>$v){if(!$p[$k])$ret=str_replace($v,'',$ret);}//del_empty
$ret=str_replace(array('_DAY','_IMG1'),array($p['day'],$p['img1']),$ret);//injections
$ret=correct_txt_b($ret,"",'codeline');//build
foreach($arr as $k=>$v)$ret=str_replace($v,$p[$k],$ret);//place
return $ret;}

function template_twitter_b(){
return '[:clear][[[_URL§[_IMG1:image]:url]§[float:left; width:54px;:style]:div] [_URL§[_AUTHOR§txtsmall:css]:url] [_DATE§txtsmall2:css] [:br][_NAME§txtx:css] _MSG[:clear]§[twitter:class][_ID:id]:div]';}

function bdt_all_b($p,$tpl){
	if($tpl=="twitter")$tmp=template_twitter_b();
return make_template_b($tmp,$p);}

function template_vars_b(){
$arr=array("id","url","author","date","img1","msg","name");
foreach($arr as $v)$ret[$v]='_'.strtoupper($v).'';
return $ret;}

#plug

//http://simplehtmldom.sourceforge.net/manual.htm#section_find
function twitter_get_user($f){
require('plug/tiers/simple_html_dom.php');
$doc=file_get_html($f);
//echo count($doc->childNodes); //GridTimeline-items
foreach($doc->find('div[class=ProfileTweet]') as $k=>$item){//echo $k;
	$msg=$item->children(1)->children(0)->innertext;//txt
//	$date=$item->find('span[class=js-short-timestamp]')->innertext; 
	$dat=$item->children(0)->children(0)->children(2);//dat
	if($dat)$date=$dat->children(0)->children(0)->innertext;
	//else $date=$item->children(0)->children(1)->children(2)->children(0)->children(0)->innertext;//retwit
	//$rtw=$item->children(0)->children(0)->children(1)->children(0)->innertext;//retwit
	if($dat)$url=$dat->children(0)->href;
	//else $url=$item->children(0)->children(1)->children(2)->children(0)->href;
	//$ret[$k]['author']=$item->children(0)->find('a',0)->href;
	$ret[$k]['author']=$item->children(0)->find('b[class=ProfileTweet-fullname]',0)->innertext;
	$name=$item->children(0)->find('span[class=ProfileTweet-screenname]',0)->innertext;
//	$ret[$k]['img1']=$item->children(0)->children(0)->children(0)->find('img')[0]->src;
	$ret[$k]['img1']=$item->children(0)->find('img')[0]->src;
	$msg=utf8_decode_b($msg); $msg=interpret_html($msg,''); $msg=embed_links($msg); 
	$msg=str_replace('# ','#',$msg); $msg=correct_txt($msg,":b",'correct'); 
	$ret[$k]['msg']=$msg;
	if($url)$ret[$k]['id']=strrchr_b($url,'/');
	$ret[$k]['date']=trim(utf8_decode_b($date));
	$ret[$k]['name']=trim(strip_tags($name));
	$ret[$k]['rtw']=trim($rtw);
	$ret[$k]['url']='https://twitter.com'.$url;}//p($ret);
return $ret;}

function twitter_sav($r,$d){
$dfb['_menus_']=array('id','date','msg','url','name','author','img','rtw');
$r=modif_vars('clients',ses('qb').'_twitter_'.normalize($d),$r,'addif',$dfb);}

function twitter_j($d,$b='',$res=''){req('tri,pop');
if($res)$d=ajxg($res); if(!$d)return btn('txtyl','empty');
$f='https://twitter.com/'.$d; 
//$f='https://twitter.com/hashtag/'.$d; 
//$f='https://twitter.com/hashtag/'.$d.'?src=hash'; 
$_GET['urlsrc']=$f;
$r=twitter_get_user($f);
if($r)foreach($r as $k=>$p){
	$rc=array('id','date','msg','url','name','author','img1','rtw');
	foreach($rc as $va)$rb[$k][]=$p[$va];//reorder
	//$p['msg']=correct_txt($p['msg'],'','sconn');
	$p['msg']=format_txt_r($p['msg'],'','');
	$ret.=bdt_all_b($p,'twitter');}
twitter_sav($rb,$d);
return $ret;}

function plug_twitter($v,$o){$ib=randid();
list($v,$p)=split_one('§',$v,1); if($p)$o=$p;
if(is_numeric($o))$o*=1000; else $o=3000;
$t=input(1,'twt'.$ib,$v,'');
$t.=lj('','twit'.$ib.'_plug__3_twitter_twitter*j___twt'.$ib,picto('reload')).' ';
$t.=btn('',lkc("",'/plugin/twitter/'.$v,picto('url'))).' ';
$t.=btn('',lkt("",'http://twitter.com/'.$v,picto('link')));
//$javs=temporize("twittimer","SaveD('twit".$ib.'_plug_twitter_twitter*j_'.$v."');",$o);
//$r=twitter_get('https://twitter.com/'.$v);
$ret=divd('twit'.$ib,twitter_j($v));
//$ret=twitter_dom('https://twitter.com/'.$v);
return $javs.$t.$ret;}//divd('scroll',)

/*
$html = file_get_html('http://www.google.com/');
foreach($html->find('img') as $element)echo $element->src . '<br>';
*/

?>