<?php
//philum_plugin_twit

class twit{
public static function headers(){}
}

function twit_header($rid){
Head::add('jscode',"
//continuous scroll
var exs=[];
function twlive(e){var ret=''; var ia=0;
	var scrl=pageYOffset+innerHeight;
	var home=getbyid('home').value;
	//var home='';
	var mnu=getbyid('".$rid."').getElementsByTagName('section');
	var load=mnu[mnu.length-4];
	var pos=getPosition(load);
	var last=mnu[mnu.length-1];
	var id=last.id;
	var idx=exs.indexOf(id);
	if(idx==-1 && scrl>pos.y){exs.push(id);
		SaveJ('".$rid."_plug__14_twit_twit*j_'+id+'_'+home);}}
addEvent(document,'scroll',function(event){twlive(event)});
");}

//elements
function twit_user_banner($q){$im=image($q['profile_image_url']);
$url='https://twitter.com/'.$q['screen_name']; //description
return $im.' '.lkt('txtx',$url,$q['name']);}
function twit_embed_url($d){
$d=str_replace("\n",' && ',$d); $r=explode(' ',$d);
foreach($r as $v){
	if(strncmp($v,'http',4)===0)$ret.=lka($v,$v).' '; 
	elseif(strncmp($v,'@',1)===0)$ret.=lka('https://twitter.com/'.strrchr_b($v,'@'),$v).' '; 
	else $ret.=$v.' ';}
return str_replace(' && ',br(),$ret);}
function twit_images($q){
if($q['entities']['media'])foreach($q['entities']['media'] as $v)
	if($v['type']=='photo')$ret.=br().image($v['media_url_https']);
	if($v['type']=='video')$ret.=br().auto_video($v['media_url_https']);
return $ret;}
function twit_reply($q){if($id=$q['in_reply_to_status_id']){
$name=utf8_decode($q['in_reply_to_screen_name']);
$link=lkt('txtx','https://twitter.com/'.$name.'/status/'.$id,pictxt('url',$name)).' ';
$thread=lj('txtx','popup_plup__3_twit_twit*thread_'.ajx($q['id']),pictxt('up','thread')).' ';
$previous=lj('txtx','popup_plup__3_twit_twit*build_'.ajx($q['in_reply_to_status_id']),pictxt('back','last')).' ';
return btn('txtsmall2','reply-to:').' '.$link.$thread.$previous;}}
function twit_date($q){$date=date('d/m/Y H:i:s',strtotime($q['created_at']));
return btn('txtsmall2',$date);}
function twit_from($q){$name=utf8_decode($q['user']['name']);
return lkt('txtx','https://twitter.com/'.$q['user']['screen_name'].'/status/'.$q['id'],$name);}
function twit_favorited($q){return $q['favorite_count']?pictxt('heart',$q['favorite_count']):'';}
function twit_retweeted($q){return $q['retweet_count']?pictxt('get',$q['retweet_count']):'';}

//philum::articles
function twit_share($p,$o,$res=''){$rid='plg'.randid();
list($p,$o)=ajxp($res,$p,$o); req('spe');
require_once('plug/tiers/Twitter.php');
$t=new Twitter;
$suj=suj_of_id($p);
$url=host().urlread($p);
$j=atj('strcount','twpost');
$s=atb('onclick',$j).atb('onkeypress',$j).atc('console');
$ret=balise('textarea',atd('twpost').atb('cols',40).atb('row',4).$s,$suj.' '.$url).br();
$ret.=lj('popbt',$rid.'_plug___twit_twit*post___twpost',picto('get')).' ';
$ret.=span(atd('strcount').atc('txtsmall'),'');
return divd($rid,$ret);}

//philum::save
function twit_vacuum($f){$p=strrchr_b($f,'/');
require_once('plug/tiers/Twitter.php');
$t=new Twitter;
$q=$t->read($p);
$r=twit_datas($q);
setlocale(LC_TIME,prmb(25).'_'.strtoupper(prmb(25)));
//$ret['from']='@'.$q['user']['screen_name'];
$ret['suj']=strftime('%H:%M - %d %b %Y',strtotime($q['created_at']));
$ret['day']=$q['created_at'];
$ret['msg']=clean_firstspace($r['text']);
if($q['entities']['media'])foreach($q['entities']['media'] as $v)
	$ret['msg'].="\n\n".'['.$v['media_url_https'].']';
if($r['reply-to_id']){$q=$t->read($r['reply-to_id']); $r=twit_datas($q);
	$answtxt=ucfirst(nms(91)).' '.nms(36);
	$ret['msg'].="\n\n".$answtxt.' ['.$q['id'].'§'.$r['name'].':poptwit]';}
return array($ret['suj'],$ret['msg'],$ret['day']);}

//config
function twit_config($p){$rid='plg'.randid();
$r=msql_read('',ses('qb').'_twit','',1);
$ret.=divc('track',helps('twitter_oAuth')).br();
$ret.=input(1,'cfg1',$r[1],'','',60).btn('small','oauth_token').br();
$ret.=input(1,'cfg2',$r[2],'','',60).btn('small','oauth_token_secret').br();
$ret.=input(1,'cfg3',$r[3],'','',60).btn('small','oauth_consumer_key').br();
$ret.=input(1,'cfg4',$r[4],'','',60).btn('small','oauth_consumer_secret').br();
$ret.=lj('popsav',$rid.'_plug__2_twit_twit*config*sav___cfg1|cfg2|cfg3|cfg4',nms(57));
return divd($rid,$ret);}

function twit_config_sav($p,$o,$res=''){$r=ajxr($res); 
foreach($r as $v)$defs[]=array($v);
msql_modif('',ses('qb').'_twit',$defs,'','arr','');
return btn('txtalert',helps('userforms'));}

//write
function twit_post($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
require_once('plug/tiers/Twitter.php');
$t=new Twitter;
$t->update(utf8_encode($p));
return divc('txtalert',nms(34).' '.nms(79));}

function twit_retweet($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
require_once('plug/tiers/Twitter.php');
$t=new Twitter;
$t->retweet($p);
return divc('txtalert','retweeted!');}

function twit_edit($p,$o,$rid){
$ret=input(1,'twinp2','text to twit','').' ';
$ret.=lj('',$rid.'_plug__2_twit_twit*post___twinp2',picto('export')).' ';
$ret.=lj('',$rid.'_plug__2_twit_twit*config',picto('tools')).' ';
$ret.=msqlink('',ses('qb').'_twit').' ';
return $ret;}

//datas
function twit_datas($q){
$ret['from']=twit_from($q);
$ret['date']=twit_date($q);
$ret['name']=utf8_decode($q['user']['name']);
$ret['url']='https://twitter.com/'.$q['user']['screen_name'].'/status/'.$q['id'];
$ret['reply-to_id']=$q['in_reply_to_status_id'];
$ret['reply_url']=twit_reply($q);
$ret['favs']=twit_favorited($q).' '.twit_retweeted($q);
$ret['text']=utf8_decode($q['text']);//html_entity_decode()
$ret['img']=twit_images($q);
return $ret;}

//read
function twit_read($q){$r=twit_datas($q);
$ret=$r['from'].' '.$r['date'].' '.$r['reply_url'].' '.$r['favs'];
$ret.=divc('track',twit_embed_url($r['text']));
$ret.=$r['img'];
return balise('section',atd($q['id']),$ret);}

function twit_batch($r){
foreach($r as $q)$ret.=twit_read($q);
$ret.=divd('end','');
return $ret;}

function twit_thread_up($t,$p){$q=$t->read($p);
if($p=$q['in_reply_to_status_id'])$ret=twit_thread_up($t,$p);
$ret.=twit_read($q);
return $ret;}
function twit_thread($p){
require_once('plug/tiers/Twitter.php'); $t=new Twitter;
return twit_thread_up($t,$p);}

//continuous scrolling
function twit_j($id,$home){//echo $home;
require_once('plug/tiers/Twitter.php');
$t=new Twitter;
if($home)$q=$t->home_timeline(ses('twusr'),10,$id);
else $q=$t->user_timeline(ses('twusr'),10,$id);
if($id)array_shift($q);
if($q)$ret=twit_batch($q);
$ret.=hidden('','home',$home);
return $ret;}

function twit_build($p,$o,$res=''){//req('tri');
list($p,$o)=ajxp($res,$p,$o);
$p=$p?$p:'philum_cms'; ses('twusr',$p);
require_once('plug/tiers/Twitter.php');
$t=new Twitter;
if(is_numeric($p)){$r=$t->read($p); 
$rb=$t->show($r['user']['screen_name']); $im=image($q['profile_image_url']);
//$ret=twit_user_banner().br();
$ret.=twit_read($r);}
else{
$ret=twit_batch($t->user_timeline($p,10));}
$ret.=hidden('','home',$o);
return $ret;}

function twit_menu($p,$o,$rid){
if(auth(6))$ret.=lj('',$rid.'_plug__2_twit_twit*j__home__exs',picto('home')).' ';
$ret.=input(1,'twinp',$p?$p:'twitter-user','').' ';
$ret.=lj('',$rid.'_plug__2_twit_twit*build___twinp_exs',picto('reload')).' ';
$ret.=hidden('','exs','exs=[];');
return $ret;}

function plug_twit($p,$o){$rid='plg'.randid();
twit_header($rid);
$bt=twit_menu($p,$o,$rid);
if(auth(6))$bt.=twit_edit($p,$o,$rid);
$ret=twit_build($p,$o);
return $bt.divd($rid,$ret);}

?>