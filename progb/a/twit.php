<?php 
class twit{
static $er=0;

static function headers($rid){
Head::add('jscode',"
//continuous scroll
var exs=[];
static function twlive(e){var ret=''; var ia=0;
	var scrl=pageYOffset+innerHeight;
	var home=getbyid('home').value; //var home='';
	var mnu=getbyid('".$rid."').getElementsByTagName('section');
	var load=mnu[mnu.length-4];
	var pos=getPosition(load);
	var last=mnu[mnu.length-1];
	var id=last.id;
	var idx=exs.indexOf(id);
	if(idx==-1 && scrl>pos.y){exs.push(id);
		SaveJ('".$rid."_twit,call__14_'+id+'_'+home);}}
addEvent(document,'scroll',static function(event){twlive(event)});
");}

//elements
static function card($p,$o){
$t=self::init(); $q=$t->show($p);//lookup//
$er=self::error($q); if($er)return $er; //pr($q);
$ret=self::img($q['profile_image_url'],1);
$nm=utf8dec_b($q['name']); $sn=$q['screen_name'];
//$q2=$t->credentials($q['screen_name']);
$ret.=lkt('txtx',self::lk($q['screen_name']),tagb('h2',$nm)).' ';
$ret.=lj('grey','popup_twit,call__3_'.ajx($sn).'_stream','@'.$sn).br();
$ret.=self::img($q['profile_banner_url']??'',1);
$ret.=divc('panel justy',utf8dec_b($q['description']));
$ret.=divc('frame-blue',utf8dec_b($q['location']));
$clr=$q['profile_link_color'];
$ret.=div(atc('txtcadr').ats('background-color:#'.$clr.';'),'user color theme: '.$clr);
$ret.=btn('small','id: '.$q['id']);
return divs('',$ret);}

static function banner($q,$o){
if(!isset($q['screen_name']))return;
$im=$o?self::img($q['profile_image_url'],1).' ':'';
$url=self::lk($q['screen_name']); $nm=$q['name']; $sn='@'.$q['screen_name'];//nutf8_decode_b
$desc=stripslashes($q['description']??'');
return lj('popbt','popup_twit,card__3_'.ajx($q['screen_name']).'_',$im.$nm,att($sn)).$desc;
return lkt('txtx',$url,$im.$nm);}

static function lk($u,$id=''){
$ret='https://twitter.com/'.$u;
if($id)$ret.='/status/'.$id;
return $ret;}

static function reply($q){if($id=$q['in_reply_to_status_id']){
$name=utf8dec_b($q['in_reply_to_screen_name']);
$link=lkt('txtx',self::lk($name,$id),pictxt('url',$name)).' ';
$thread=lj('txtx','popup_twit,thread__3_'.ajx($q['id']),pictxt('up','thread')).' ';
$prev=lj('txtx','popup_twit,call__3_'.ajx($q['in_reply_to_status_id']),pictxt('back','last')).' ';
return btn('txtsmall2',nmx([91,36])).' '.$link.$thread.$prev;}}

//philum::articles
static function share_video($msg){
$r=explode(':video',$msg); $n=count($r); $ret='';
if($n){for($i=0;$i<$n-1;$i++){$s=strrpos($r[$i],'[');
	if($s!==false){$d=substr($r[$i],$s+1); $p=video::providers($d); $u=video::url($d,$p); $ret.=$u.' ';}}}
return $ret;}

static function content($p){
$suj=ma::suj_of_id($p); $suj=html_entity_decode($suj);//str_replace("&nbsp;",' ',$suj);
$author=sql::inner('tag','qdt','qdta','idtag','v',['cat'=>'auteurs','idart'=>$p]);
[$cat,$source]=sql('frm,mail','qda','w',$p);
$tag=$author?$author:($source?httproot($source):$cat); //$tag=ucwords(normalize($tag));//http_root
//$utagr=sql::inner('tag','qdt','qdta','idtag','v','cat>0 and idart="'.$p.'"');
//if($utagr)$tag=implode(' #',$utagr);
$suj='['.$tag.'] '.$suj;
//$im=sql('img','qda','v',$p); if($im)$img=' '.host().pop::art_img($im,$id);
$url=host().urlread($p);
return $suj.' '.$url;}

static function share($p,$o,$prm=[]){
$rid='plg'.randid(); $p=$prm[0]??$p; $t=self::init();
$ret=self::content($p);
$j=atj('strcount','twpost');
$pr=['onclick'=>$j,'onkeypress'=>$j,'class'=>'console','id'=>'twpost','cols'=>50,'rows'=>5];
$ret=tag('textarea',$pr,$ret).br();
$r=self::apikeys(); if($r)foreach($r as $i=>$nm)
	$ret.=lj('popbt',$rid.'_twit,send_twpost___'.$i,pictxt('send',$nm)).' ';//send
$ret.=span(atd('strcount').atc('txtsmall'),'');
return divd($rid,$ret);}

static function botshare($p,$o=4){//build mini before
//$suj=ma::suj_of_id($p); $url=host().urlread($p);
$ret=self::content($p);
//$ret=html_entity_decode($ret);
$ret=htmlentities($ret);
//$ret=rawurlencode($ret);//test
return self::send($p,$o,[$ret]);}//$suj.' '.

//philum::save
static function vacuum($f){
$p=strend($f,'/'); $p=strto($p,'?');
$t=self::init(1);
$q=$t->read($p); //pr($q);
self::cache($p,0,1,$q);
setlocale(LC_TIME,prmb(25).'_'.strtoupper(prmb(25)));
//$ret['from']='@'.$q['user']['screen_name'];
$name=$q['user']['screen_name'];//'('.$q['user']['name'].') ';
$ret['suj']=$name.' '.date('d b Y - H:i',strtotime($q['created_at']));
$ret['day']=$q['created_at'];
$txt=self::oembed(self::lk($q['user']['screen_name'],$q['id']));
if($txt)[$res,$med]=self::clean($txt);
else [$res,$med]=self::clean(utf8dec_b($q['text']));
$ret['msg']=$res;
if(isset($q['entities']['media']))foreach($q['entities']['media'] as $v)
	if($vb=$v['media_url_https'])$ret['msg'].=n().n().'['.$vb.']';
return [$ret['suj'],$ret['msg'],$ret['day']];}

//config
static function slct_apikey($nd,$rid){$ret='';//$r=[1=>'dav8119',2=>'tlexfr'];
$r=self::apikeys(); if($r)foreach($r as $i=>$nm)
	$ret.=lj(active($i,$nd),$rid.'_twit,config__3_'.$i,$nm).' ';
return divc('nbp',$ret);}

static function config($nd){if(!$nd)$nd=self::apk();
$rid='plg'.randid(); $nd=ses('apk',$nd); $ret='';
$r=msql::col('',nod('twit_'.$nd),0,1);
$ret.=divc('twit',helps('twitter_oAuth')).br();
$ret.=self::slct_apikey($nd,$rid);
$ret.=input('cfg1',$r[1],60).btn('small','oauth_token').br();
$ret.=input('cfg2',$r[2],60).btn('small','oauth_token_secret').br();
$ret.=input('cfg3',$r[3],60).btn('small','oauth_consumer_key').br();
$ret.=input('cfg4',$r[4],60).btn('small','oauth_consumer_secret').br();
$ret.=hidden('cfg5',$r[5]);
$ret.=lj('popsav',$rid.'_twit,config*sav_cfg1,cfg2,cfg3,cfg4,cfg5__'.$nd.'__',nms(27));
$ret.=msqbt('',nod('twit_'.$nd)).' ';
return divd($rid,$ret);}

static function config_sav($p,$o,$r){
foreach($r as $v)$defs[]=[$v];
msql::modif('',nod('twit_'.$p),$defs,'arr');
return btn('frame-blue',helps('userforms'));}

static function apikeys(){
$r=msql::choose('',ses('qb'),'twit'); sort($r); $rb=[];
if($r)foreach($r as $k)if(is_numeric($k))$rb[$k]=msql::val('',nod('twit_'.$k),5);
return $rb;}

//edit
static function edtsav($p,$o,$ra){
$rz=self::r(); $cls=implode(',',array_keys($rz));
$rb=sql($cls,'qdtw','a','twid="'.$p.'"'); $rk=array_keys($rb); $r=array_combine($rk,$ra);
foreach($rz as $k=>$v)if(substr($v,-3)=='int' && !$r[$k])$r[$k]=0;
if($ra)sqlup('qdtw',$r,['twid'=>$p]);
return self::cache($p,$o,2);}

static function edit($p,$o){$rid=randid('tw');
$cls=implode(',',array_keys(self::r())); $ret=''; $kr=[];
$r=sql($cls,'qdtw','a',['twid'=>$p]);
if($r)foreach($r as $k=>$v){$kb=$k.$rid;
	$ret.=div('',goodarea($kb,$v,60).label($kb,$k,'small')); $kr[]=ajx($kb);}
$bt=lj('popsav',$p.'_twit,edtsav_'.implode(',',$kr).'__'.$p.'_'.$o,picto('save2'));
return divd('edt'.$p,$bt.$ret);}

//write
static function send($p,$o,$prm){
$p=$prm[0]??$p; $t=self::init($o?$o:1);
$q=$t->update(utf8enc_b($p));//
if(isset($q['errors'][0]['message'])){self::$er=1; return btn('txtyl',$q['errors'][0]['message']);}
return divc('txtalert',nms(34).' '.nms(79));}

static function post($rid){
$ret=input('twinp2','text to twit').' ';
$ret.=lj('',$rid.'_twit,send_twinp2',picto('export')).' ';
return $ret;}

static function retweet($p,$o,$prm){
$p=$prm[0]??$p; $t=self::init(); $t->retweet($p);
return divc('frame-blue','retweeted!');}

//fav
static function mkfav($id,$is){
$t=self::init();
$q=$t->like($id,$is);
$n=isset($q['favorite_count'])?$q['favorite_count']:'0';
if($n)sqlup('qdtw',['favs'=>$n],['twid'=>$id],0);
return self::btfav($id,$n,$q['favorited']);}

static function btfav($id,$n,$ok){
$s=$ok?'color:#e0245e;':''; $bt=picto('love',$s).$n;
if(!auth(6))return $bt;
return lj('','fav'.$id.'_twit,mkfav___'.$id.'_'.$ok,$bt);}

//retweet
static function mkrtw($id,$is){
$t=self::init();
$q=$t->retweet($id,$is);
$n=isset($q['retweet_count'])?$q['retweet_count']:'0';
if($n)sqlup('qdtw',['retweets'=>$n],['twid'=>$id],0);
return self::btrtw($id,$n,$q['retweeted']);}

static function btrtw($id,$n,$ok){
$s=$ok?'color:#17bf63;':''; $bt=picto('repost',$s).$n;
if(!auth(6))return $bt;
return lj('','rtw'.$id.'_twit,mkrtw___'.$id.'_'.$ok,$bt);}

static function replies($p,$id){$t=self::init();
$q=$t->read($p); if($er=self::error($q))return $er; $usr=$q['user']['screen_name'];
$q=$t->search($usr,100,$id); if($q)$r=$q['statuses'];
if($r)foreach($r as $k=>$v){
	$b=$v['in_reply_to_status_id'];
	if($b!=$p or !$b)unset($r[$k]);}
//if(!$r)$q=$t->search($usr,100,$b); pr($r);
return $r;}

static function delete($t,$p){
$q=$t->delete($p);
return btn('txtyl','tweet deleted');}

static function dump($t,$p){
$q=$t->read($p); $ret=eco($q,1);
$r=sql('*','qdtw','ar','twid='.$p.''); $ret.=eco($r,1);
$ret.=eco(self::oembed(self::lk($q['user']['screen_name'],$q['id'])),1);
return $ret;}

//threads
static function thread($t,$p){$ret=''; $reply_id=''; $q=[];
$r=sql('twid,reply_id','qdtw','w',['twid'=>$p]); if($r)[$id,$reply_id]=$r;
if(!$r){$q=$t->read($p); //if(isset($q['errors'][0])){
	$reply_id=$q['in_reply_to_status_id']??''; $id=$q['id']??'';}
if($p && $reply_id && $p!=$reply_id)$ret=self::thread($t,$reply_id);//
if(isset($id))$ret.=self::cache($id,0,0,$q);
return $ret;}

//userlist
static function usrlist($r){$t=self::init();
$n=count($r); $nb=ceil($n/100); $rb=[]; $rc=[]; $ia=0; $i=0; //$qu=$t->show($q['ids'][0]); pr($qu);
if($r)foreach($r as $v){if($i==99){$i=0; $ia++;} $rb[$ia][$i]=$v; $i++;} //pr($rb);
//$rb=array_slice($rb,0,1);//limit to 500
if($rb)foreach($rb as $v){$d=implode(',',$v); $qu=$t->lookup($d); //pr($qu);
	if($qu)foreach($qu as $k=>$vb)$rc[]=[$vb['id'],utf8dec_b($vb['screen_name']),utf8dec_b($vb['name']),utf8dec_b($vb['location']),utf8dec_b($vb['description']),$vb['profile_image_url'],$vb['protected'],$vb['verified'],$vb['followers_count'],$vb['friends_count'],$vb['following'],$vb['lang'],strtotime($vb['created_at']),$vb['profile_background_color'],$vb['profile_text_color']];}//pr($rc);
return $rc;}

static function datasav($p,$r,$d){
if($p=='oyagaaayuyisaa')$pb='OAY';
//elseif($p=='oomo_toa')$pb='OT';
//elseif($p=='oyagaa_ayuyisaa')$pb='OAY2';
else $pb=str_replace('_','-',$p);
$nm=$d.'_'.$pb.'-'.date('ymd');
//$rh=['id','name','user','location','description','img'];
$rh=['id','name','user','location','description','avatar','protected','verified','followers','friends','following','lang','created_at','bkgclr','clr'];
msql::save('users',nod($nm),$r,$rh);
return msqbt('',nod($nm)).br();}

static function usrnfo($r){$ret='';
//$rh=['id','screen_name','name','location','description','profile_image_url'];
$rh=['id','screen_name','name','location','description','profile_image_url','protected','verified','followers_count','friends_count','following','lang','created_at','profile_background_color','profile_text_color'];
if($r)foreach($r as $k=>$v){
	$rb=array_combine($rh,$v);
	$ret.=divb(self::banner($rb,1));}
return $ret;}

static function statuses($d){$rid=rid($d);//find
$r=explode(',',$d); $t=self::init(); $ra=[]; $rb=[];
$nd=nod('twusr_'.$rid); $rb=msql::read('',$nd,'',1);
if(!$rb){if(!is_numeric(array_sum($r)))$rq=$t->lookup($d);//id1,id2
else foreach($r as $k=>$v)$rq[]=$t->show($v);//usr1,usr2,id3
foreach($rq as $k=>$v)if(isset($v['id']))$rb[]=[$v['id'],utf8dec_b($v['screen_name']),utf8dec_b($v['name']),utf8dec_b($v['location']),utf8dec_b($v['description']),$v['profile_image_url']];//$q['user']['followers_count']
msql::save('users',$nd,$rb,['id','name','user','location','description','img']);}
return $rb;}

static function render_usrs($rb){//from msql
foreach($rb as $k=>$v){
$rb[$k][1]=lkt('',self::lk($v[1]),pictxt('link-out',$v[1],14));
$rb[$k][2]=lj('','popup_twit,call__3_'.ajx($v[1]).'_ban',pictxt('popup',$v[2],14));
$rb[$k][5]=img(self::getimg($v[5],1),'max-width: inherit;');}
return $rb;}

static function play_usrs($d,$o=''){$rid=rid($d);//from list of usrs
$r=self::statuses($d); $csv=csvfile($rid,$r);
$rb=self::render_usrs($r); $ret=tabler($rb);
return divc('scroll',$ret).msqbt('',nod('twusr_'.$rid)).$csv;}

//followers//retweeters
static function usrs($q,$p,$o){$ret='';
if(!isset($q['ids']))return;
$r=self::usrlist($q['ids']);//using ids
if($o=='flw')$ret=self::datasav($p,$r,'followers');
if($o=='frn')$ret=self::datasav($p,$r,'friends');
if($o=='frnb')$ret=self::datasav($p,$r,'frn');
if($r && $o!='frnb')$ret.=self::usrnfo($r);
return $ret;}

static function usrs2($q,$p,$o){static $i=0; //pr($q);//using list
foreach($q['users'] as $k=>$v)$r[]=[$v['id'],utf8dec_b($v['screen_name']),utf8dec_b($v['name']),utf8dec_b($v['location']),utf8dec_b($v['description']),$v['profile_image_url']];
if($o=='flw')$ret=self::datasav($p,$r,'followers');
if($o=='frn')$ret=self::datasav($p,$r,'friends');
if($r)$ret=self::usrnfo($r);
$cursor=$q['next_cursor']; //alert($cursor);
if($cursor){$t=self::init(); $i++;//iteration (not sav correctly)
	if($o=='flw')$qu=$t->followers2($p,$cursor); elseif($o=='frn')$qu=$t->friends2($p,$cursor);
	if($qu && $i<4)$ret.=self::usrs2($qu,$p,$o);}
return $ret;}

static function wordusrs($p){
if(strpos($p,' ')){$ra=explode(' ',$p); foreach($ra as $v){
	$qr[]='text like "%'.$v.'%"'; $qr[]='mentions like "%'.$v.'%"';}
$q=implode(' or ',$qr);}
else $q='text like "%'.$p.'%" or mentions like "%'.$p.'%" ';
$r=sql('name,screen_name','qdtw','ar',$q.'order by twid desc',0);
if($r)foreach($r as $k=>$v){$ret[$v['screen_name']]=div('',self::banner($v,0));}
if($ret)return count($ret).' results'.implode('',$ret);}

//img
static function getimg($f,$o=''){//$o='';
$xt=xt(trim($f)); if(!$xt)$xt='.jpg'; if(!$f)return;
$fb=ses('qb').'_tw_'.substr(md5($f),0,6).$xt; $x=substr($xt,1);
if(file_exists('/img/'.$fb))return host().'/img/'.$fb;// && $o==2
elseif($o && auth(4)){$d=get_file($f); if($d)write_file('img/'.$fb,$d);//$ok=copy($f,'img/'.$fb)
	if(file_exists('img/'.$fb))return host().'/img/'.$fb;}
return 'data:image/'.$x.';base64,'.base64_encode(get_file($f));}

static function img($f,$o=''){
if(is_file('img/'.$f))$im='img/'.$f;
else $im=self::getimg($f,$o);
return img($im,'max-width:640px;');}

//fulltext
static function tco($f){
if(!is_url($f))return;
$u=jumplk::build($f);
if(!$u){$r=@get_meta_tags($f); $u=$r['twitter:url']??'';}
return $u?$u:$f;}

static function clean($ret){$lk='';
if($n=strrpos($ret,"&mdash;"))$ret=substr($ret,0,$n);
if($n=strrpos($ret,'pic.twitter'))$ret=substr($ret,0,$n);
if($n=strrpos($ret,'https://t.co')){
	$lk=substr($ret,$n); if($nb=strpos($lk,' '))$lk=substr($lk,0,$nb);
	$lk=self::tco($lk); if($lk)$lk.=' ';
	$ret=substr($ret,0,$n);}
if($n=strrpos($ret,'https://buff.ly')){
	$lk=substr($ret,$n); if($nb=strpos($lk,' '))$lk=substr($lk,0,$nb);
	$lk=self::tco($lk); if($lk)$lk.=' ';
	$ret=substr($ret,0,$n);}
$ret=delbr($ret,"\n");
$ret=preg_replace('/(\n){2,}/',"\n",$ret);
return [$ret,$lk];}

static function text($f){$r=fdom($f,1);
$ret=between($r->textContent,'document.addEventListener("compositionend",n,!1))}();','document.body.className');
return trim($ret);}

static function oembed($u){
$t=self::init(); $q=$t->embed($u); //pr($q);
//$d=get_file('https://publish.twitter.com/oembed?url='.$u); $q=json_decode($d,true); //pr($q);
$txt=$q['html']??''; $nm=$q['author_name']??'';
$n=strrpos($txt,'&mdash; '.$nm); if($n!==false)$txt=mb_substr($txt,0,$n);//del end
//$txt=self::text($u);
$ret=delbr($txt,"\n");
$ret=strip_tags($ret);
$ret=utf8dec_b($ret);
return $ret;}

static function upvideo_m3u8($f){//tw_video
$xt='.m3u8'; $fa=strprm($f,4);
$fb='video/'.$fa.'_2.mp4';//already saved
//if(is_file($fb))return video('/'.$fb);
$fb='video/'.$fa.'_0'.$xt;
if(!is_file($fb))@copy($f,$fb);//first file
if(is_file($fb))$tmp=read_file($fb); else return; //eco($tmp);
$s=strrpos($tmp,'ext_tw_video');
if(!$s)$s=strrpos($tmp,'amplify_video');
$ref=trim(substr($tmp,$s));
$fb='video/'.$fa.'_1'.$xt;
$f='https://video.twimg.com/'.$ref;
if(!is_file($fb) && auth(4))@copy($f,$fb);//second file
if(is_file($fb))$tmp=read_file($fb); else return; //eco($tmp);
$s=strrpos($tmp,'ext_tw_video');
$ref=substr($tmp,$s);
$e=strrpos($ref,'#EXT-X-ENDLIST'); $ref=trim(substr($ref,0,$e));
$xt='.mp4';//$xt=xt($ref);//.ts=>.mp4
$fb='video/'.$fa.'_2'.$xt;
$lk='https://video.twimg.com/'.$ref;
return lkt('',$lk,pictxt('movie',nms(187)));//waiting solution
if(!is_file($fb))copy($lk,$fb);//video src
if(is_file($fb))return video('/'.$fb);
return lj('','popup_usg,iframe___'.ajx($fb),domain($f));}

static function upvideo_mp4($f){
$xt='.mp4'; $fb='video/'.strprm($f,4).$xt;
if(!is_file($fb) && auth(4))@copy($f,$fb);
if(is_file($fb))return video('/'.$fb);
return lj('','popup_usg,iframe___'.ajx($fb),domain($f));}

static function upvideo_ts($f){
$xt='.ts'; $fb='video/'.strprm($f,4).$xt;
if(!is_file($fb) && auth(4))@copy($f,$fb);
//if(is_file($fb))$tmp=read_file($fb); else return; eco($tmp);
return lkt('',$fb,pictxt('movie',nms(187)));
if(is_file($fb))return video('/'.$fb);
return lj('','popup_usg,iframe___'.ajx($fb),domain($f));}

static function playtxt($id){
return sql('text','qdtw','v','twid="'.$id.'"',0);}

#cache
static function play($id,$r,$q='',$o=''){
[$nm,$date,$rplid,$favs,$favd,$rtw,$rtwd,$flw,$friends,$txt,$med,$mnt,$quoid,$lg]=vals($r,['screen_name','date','reply_id','favs','favorited','retweets','retweeted','followers','friends','text','media','mentions','quote_id','lang']);
$url=self::lk($nm); $own=msql::val('',nod('twit_'.ses('apk')),5);
//$ret=lkt('popbt',$url,pictxt('tw',$nm));
$ret=self::banner($r,0).' '; $j='popup_twit,call__3_';
//if(isset($q['retweeted_status']['id']))$ret.=btn('small','(retweet)').' ';
if($rtwd)$ret.=lj('','popup_twit,call___'.$rtwd,'(retweet)').'';
//lkt('small',$url.'/status/'.$rtwd,'(retweet)').'';
if($date)$ret.=lkt('small',$url.'/status/'.$id,pictxt('chain',date('d/m/Y H:i:s',$date))).'';
//else $ret.=lkt('',$url,picto('chain'));
if($rplid)$ret.=lj('',$j.$id.'_thread',picto('topo'),att('parents')).'';
if($mnt)$ret.=lj('',$j.$id.'_mnt',picto('oversight'),att(str_replace(' ',n(),$mnt))).'';
//if($mnt)$ret.=togbub('twit,call',$id.'_mnt',picto('oversight'),att(str_replace(' ',n(),$mnt))).'';
$ret.=lj('',$j.$id.'_rpl',picto('dialog'),att('answers')).'';
//if(!$q)$q=self::read($id);
$ret.=btd('fav'.$id,self::btfav($id,$favs,$q['favorited']??'')).' ';
$ret.=btd('rtw'.$id,self::btrtw($id,$rtw,$q['retweeted']??'')).' ';
$ret.=pictxt('users',$flw.'/'.$friends).'';
$ret.=lj('',$id.'_twit,recache___'.$id,picto('reload'));
if($nm==$own)$ret.=lj('',$id.'_twit,call___'.$id.'_del',picto('del'));
if(auth(6)){$ret.=lj('','popup_twit,call___'.$id.'_eco',picto('code'));
	$ret.=lj('','popup_twit,edit___'.$id.'_eco',picto('editxt'));
	$ret.=lj('',$id.'_twit,call___'.$id.'_erz',picto('erase'));}
$ref='twt'.substr($id,-8); $lng=ses('lng');
//if($lg!=$lng)$ret.=lj('',$ref.'_trans,calltw___'.$id.'_'.$lng.'-'.$lg,picto('translate'));
if($lg!=$lng)$ret.=ljtog('','ynd'.$ref.'_trans,calltw___'.$id.'_'.$lng.'-'.$lg,'ynd'.$ref.'_twit,playtxt___'.$id,picto('language'));
//$ret.=lkt('',self::lk($nm,$id),picto('chain'));
$ret.=lkt('','plug/twit/'.$id,picto('url'));
$ret=divc('nbp',$ret);
$txt=divd('ynd'.$ref,str_replace('|','-',$txt));//nl2br
$rb=explode(' ',$med);
$vid=strpos($med,'.mp4') || strpos($med,'.m3u8')?1:0;//noim if video
if($rb)foreach($rb as $v)if($v){$v=trim($v);
	if(is_numeric($v) && $v!=$id)$txt.=self::cache($v,$id,0);
	elseif(is_img($v) && !$vid)$txt.=self::img($v,1);
	elseif(strpos($v,'format=jpg') && !$vid)$txt.=self::img($v,1);
	elseif(strpos($v,'format=png') && !$vid)$txt.=self::img($v,1);
	elseif(strpos($v,'twitter.com')){
		if(strend($v,'/')!=$id)$txt.=$quoid?'':self::cache(strend($v,'/'),ses('read'));}
	//elseif(strpos($v,'.mp4'))$txt.=video($v);
	//elseif(strpos($v,'.mp4'))$txt.=iframe($v);
	//elseif(strpos($v,'.mp4'))$txt.=lj('','popup_usg,iframe___'.ajx($v),domain($v));
	elseif(strpos($v,'.mp4'))$txt.=self::upvideo_mp4($v);
	elseif(strpos($v,'.m3u8'))$txt.=self::upvideo_m3u8($v);
	elseif(strpos($v,'.ts'))$txt.=self::upvideo_ts($v);
	elseif(strpos($v,'.mp3'))$txt.=audio($v);
	elseif(strpos($v,'.pdf'))$txt.=mk::pdfdoc($v,0,640);
	elseif(strpos($v,'t.co/'))$txt.='';//lka($v);
	elseif(substr($v,0,4)=='http')$txt.=web::call($v,'');
	else $txt.=br().video::play($v,$id,1);}
if($quoid){$txt.=br().self::cache($quoid,$id);}
//elseif($r['retweeted']){$txt.=br().self::cache($r['retweeted'],$id);}
$ret.=divc('panel',$txt);
if($o)return $ret;
return div(atc('twit trkmsg').atd($id),$ret);}

static function playxt($k){
$ra=['name','screen_name','user_id','date','text','media','mentions','reply_id','reply_name','favs','retweets','followers','friends','quote_id','quote_name','retweeted','lang'];//ib,twid,
$r=sql(implode(',',$ra),'qdtw','w','twid="'.$k.'"',0);
[$nm,$date,$rplid,$favs,$favd,$rtw,$rtwd,$flw,$friends,$txt,$med,$mnt,$quoid,$lg]=vals($r,['screen_name','date','reply_id','favs','favorited','retweets','retweeted','followers','friends','text','media','mentions','quote_id','lang']);
$url=self::lk($nm); $ret='@'.$nm;
$ret.=lkt('small',$url.'/status/'.$k,pictxt('chain',date('d/m/Y H:i:s',$date))).'';
$ret.=divc('',$txt);
return $ret;}

static function urls($r,$rtw,$id){$rb=[]; //pr($r);
if($r)foreach($r as $k=>$v){$u=$v['expanded_url'];
	if(substr($u,0,20)=='https://twitter.com/'){$id_rtw=strend($u,'/');
		if(is_numeric($id_rtw) && $id_rtw!=$rtw && $id_rtw!=$id)$rb[]=$id_rtw;}
	//elseif(substr($u,0,16)=='https://youtu.be')$rb[]=strend($u,'/');
	//elseif(substr($u,0,23)=='https://www.youtube.com')$rb[]=between($u,'v=','&');
	elseif(substr($u,0,4)=='http')$rb[]=self::tco($u);}
return $rb;}

static function medias($q){$rb=[];
//if(isset($q['entities']['media']))$r=$q['entities']['media'];
//if(isset($r))foreach($r as $k=>$v)if($v['type']=='photo')$rb[]=$v['media_url'];
if(isset($q['extended_entities'])){$r=$q['extended_entities']['media'];
if(isset($r))foreach($r as $k=>$v){
	if($v['type']=='photo' or $v['type']=='video')$rb[]=$v['media_url'];//_https
	if(isset($v['video_info']['variants'][1]['url']))$rb[]=$v['video_info']['variants'][1]['url'];}}
$rc=self::urls($q['entities']['urls'],$q['quoted_status_id']??'',$q['id']);
if($rb && $rc)$rb=array_merge($rb,$rc); elseif($rc)$rb=$rc;
if(is_array($rb)){$rb=array_flip($rb); $rb=array_flip($rb);}
return implode(' ',$rb);}

static function mentions($r){
if($r)foreach($r as $k=>$v)$rb[]=$v['screen_name'];
if(isset($rb))return implode(' ',$rb);}

static function patch_userid(){$t=self::init(); $rb=[];
$r=sql('distinct(screen_name)','qdtw','rv','user_id="0"');
foreach($r as $k=>$v){$q=$t->show($v);//if($k<500)
	sql::upd('qdtw',['user_id'=>$q['id']],['screen_name'=>$v]);}}

static function playmentions($id){$t=self::init();//self::patch_userid();
$d=sql('mentions','qdtw','v','twid="'.$id.'"'); $r=explode(' ',$d);
foreach($r as $k=>$v){$uid=sql('user_id','qdtw','v','screen_name="'.$v.'"');
	if(!$uid){$q=$t->show($v); $uid=$q['id'];}
	$rb['ids'][]=$uid;} //p($rb);
return $rb;}

static function datas($q){
//if($er=self::error($q))return $er;
$ret['name']=utf8dec_b(valr($q,'user','name'));
$ret['screen_name']=utf8dec_b(valr($q,'user','screen_name'));
$ret['user_id']=valr($q,'user','id',0);
$ret['date']=strtotime($q['created_at']);
$txt=self::oembed(self::lk(valr($q,'user','screen_name'),$q['id']));
if($txt)[$res,$med]=self::clean($txt);
else [$res,$med]=self::clean(utf8dec_b($q['text']));
$ret['text']=$res;
$md=self::medias($q);
$ret['media']=utmsrc($md?$md:$med);
$ret['mentions']=self::mentions($q['entities']['user_mentions']);
$ret['reply_id']=$q['in_reply_to_status_id']??0;
$ret['reply_name']=utf8dec_b($q['in_reply_to_screen_name']);
$ret['favs']=$q['favorite_count']??0;
$ret['retweets']=$q['retweet_count']??0;
$ret['followers']=$q['user']['followers_count']??0;
$ret['friends']=$q['user']['friends_count']??0;
$ret['quote_id']=$q['quoted_status_id']??0;
//if(!$ret['quote_id'] && $iq=$q['retweeted_status']['quoted_status_id'])$ret['quote_id']=$iq;
$ret['quote_name']=isset($q['quoted_status']['user'])?$q['quoted_status']['user']['screen_name']:'';
//if(!$ret['quote_name'] && $iq=$q['retweeted_status']['in_reply_to_screen_name'])$ret['quote_name']=$iq;
$ret['retweeted']=isset($q['retweeted_status']['id'])?$q['retweeted_status']['id']:0;
//$ret['retweeted_name']=$q['retweeted_status']['user']['screen_name'];
$ret['lang']=$q['lang'];
return $ret;}

#read
static function cache($k,$id,$o='',$q=[]){if(!$id)$id=0;
$ra=['name','screen_name','user_id','date','text','media','mentions','reply_id','reply_name','favs','retweets','followers','friends','quote_id','quote_name','retweeted','lang'];//ib,twid,
$r=sql(implode(',',$ra),'qdtw','w',['twid'=>$k],0);
if(auth(4) && ((!$r && $o!=2) or $o==1)){$r0=$r;
	$q=$q?$q:self::read($k);
	$er=self::error($q);
	if(!$er && $q)$r=self::datas($q);
	if($er)$r['text']=$er;
	elseif($r0 && $r)sqlup('qdtw',$r,['twid'=>$k],0);
	elseif($r && $k && is_numeric($k) && $id!='test'){
		$rb=array_merge(['ib'=>is_numeric($id)?$id:0,'twid'=>$k],$r); //pr($rb);
		if(auth(6))sqlsav('qdtw',$rb,0,0);}}
elseif($r){$r=array_combine($ra,$r);
	if($q){
		//$rb['mentions']=self::mentions($q['entities']['user_mentions']);
		$rb['favs']=$q['favorite_count']??0; $rb['retweets']=$q['retweet_count']??0;
		//$rb['user_id']=$q['user']['id'];
		sqlup('qdtw',$rb,['twid'=>$k],0);}}
return self::play($k,$r,$q,$o);}

static function recache($k,$id){
return self::cache($k,$id,1);}

static function stream($d,$n=''){
$rid=randid('tw'); $ret=''; $sq=[];
if(is_numeric($d))$sq['<twid']=$d; elseif($d)$sq['>date']=$d;
$sq['_order']='twid desc'; $sq['_limit']=$n?$n:100;
$r=sql('*','qdtw','ar',$sq);
if($r)foreach($r as $k=>$v)$ret.=self::play($v['twid'],$v,'','');
if($ret)$ret.=lj('',$rid.'_twit,stream__3_'.$v['twid'].'_'.$n,divc('txtcadr',picto('down')));
return $ret.divd($rid,'').divd('end','');}

static function stupids(){
return msql::col('',nod('twit_stupids',0,1));}

static function friends(){
return msql::col('',nod('twit_friends',0,1));}

static function batch($r,$o){$rid=randid('tw'); $ret='';
if($er=self::error($r))return $er;
$rx=[]; if($o=='stp')$rx=self::stupids(); elseif($o=='mdl')$rx=self::friends(); //pr($rx);
if(is_array($r)){foreach($r as $q)if(isset($q['id'])){$ok=1;
		if($o=='stp'){if(in_array($q['user']['screen_name'],$rx))$ok=0;}
		if($o=='mdl'){if(!in_array($q['user']['screen_name'],$rx))$ok=0;}
		if($ok)$ret.=self::cache($q['id'],0,'',$q);}
	if($q['id']??'')$ret.=lj('',$rid.'_twit,call_twinp_3_'.$q['id'].'_'.$o,divc('txtcadr',picto('down')));}
else return 'nothing';
return $ret.divd($rid,'').divd('end','');}

static function read($p){
if(!is_numeric($p))return;
$t=self::init(); $q=$t->read($p);
return $q;}

//economizer
static function search($p,$maxid,$o){
$rid=randid('tw');
if($o=='tl')$q='screen_name="'.$p.'" ';
elseif($dt=strtotime($p))$q='date<"'.$dt.'"';
else $q='(text like "%'.$p.'%" or mentions like "%'.$p.'%") ';
if($maxid)$q.=' and twid<="'.$maxid.'" '; $rb=[]; $minid='';
//$r=sql('*','qdtw','ar',$q.'order by twid desc limit 50',0);
$r=sql('twid','qdtw','rv',$q.'order by twid desc limit 50',0);
if($r){//foreach($r as $k=>$v)$ret.=self::play($v['twid'],$v,'',0);
	foreach($r as $k=>$v)$rb[]=['id'=>$v]; $minid=$r[0];}
return [$rb,$minid];}

static function fusr($p){
return sql('screen_name','qdtw','v','twid="'.$p.'"',0);}

static function error($q){
if(isset($q['errors']))return $q['errors'][0]['message'];}

//erase
static function erasor($id,$med,$quoid){
sql::del('qdtw',['twid'=>$id],0,1); $rb=explode(' ',$med); $txt='';
if($rb)foreach($rb as $v)if($v){$v=trim($v); $xt=xt(trim($v));
	if(is_numeric($v) && $v!=$id)$txt.=self::cache($v,$id,0);
	elseif(is_img($v) or strpos($v,'format=jpg')){if(!$xt)$xt='.jpg';
		$f=ses('qb').'_tw_'.substr(md5($v),0,6).$xt; unlink('img/'.$f);}
	elseif(strpos($v,'.mp4'))unlink('video/'.strprm($v,4).$xt);}
if($quoid)self::erasefromtwid($quoid);}

static function erasefromtwid($p){
$r=sql('twid,media,quote_id','qdtw','w',['twid'=>$p]);
if($r)self::erasor($r[0],$r[1],$r[2]);}

static function erasex($p){$p='plug'; $nbd=360; $ret='';//twid,media,quote_id
$r=sql('twid,media,quote_id','qdtw','','(text like "%'.$p.'%" or mentions like "%'.$p.'%" or name like "%'.$p.'%") and date>"'.timeago($nbd).'"');
foreach($r as $k=>$v)$ret.=self::cache($v[0],0,2);
//self::erasor($v[0],$v[1],$v[2]);
return $ret;}

//call
static function call($p,$o,$prm=[]){
$ret=''; $id=''; $q=''; $qu=''; $bt=''; $q=[];
$t=self::init(); $minid=0; $usr=$t->_usr;
if(is_numeric($p) && isset($prm[0])){$id=$p; $p=$prm[0];}
elseif($prm)[$p,$o]=prmp($prm,$p,$o);
//if($o=='stream' && $p){$minid=$p; $p='';}
if(substr($p,0,4)=='http')$p=strend($p,'/');
/**/if($p=='plug' or substr($o,0,9)=='twit/app'){
//json::add('','twit'.mkday(),[$p.':stopped',$o,$id,$minid,$prm[0],0,mkday('','His'),hostname()]);
return;}
$p=$p?$p:$usr;//msql::val('',nod('twit_'.ses('apk')),5)
$o=$o?$o:'search'; ses('twusr',$p); $n=sesif('nbp',40);
//$ret=self::banner($t->show($q['user']['screen_name']));
if(is_numeric($p)){//$q=$t->read($p);
	//if($o=='rtw')$q=$t->retweets($p,$id);
	if($o=='rtw')$qu=$t->retweeters($p,$id);
	elseif($o=='thread')$ret=self::thread($t,$p);
	elseif($o=='rpl')$q=self::replies($p,$id);
	elseif($o=='mnt')$qu=self::playmentions($p,$id);
	elseif($o=='del')$ret=self::delete($t,$p);
	elseif($o=='erz' && auth(6)){self::erasefromtwid($p); $ret='deleted';}
	elseif($o=='eco')$ret=self::dump($t,$p);
	elseif($o=='stream'){$id=$p; $p=self::fusr($p);//iterat
		$q=$t->user_timeline($p,$n,$id,$minid);}
	else $ret=self::cache($p,$id,0);}
elseif($o=='home')$q=$t->home_timeline($usr,$n,$id,'');
elseif($o=='mnt')$q=$t->mentions_timeline($usr,$n,$id,'');
elseif($o=='flw')$qu=$t->followers($p,'');//followers2
elseif($o=='frn')$qu=$t->friends($p,'');//friends2
elseif($o=='frnb')$qu=$t->friends($p,'');//friends2
elseif($o=='fav')$q=$t->favorites($p,$id);
elseif($o=='ban')$ret=self::card($p,1);
elseif($o=='erx' && auth(6))$ret=self::erasex('plug');
//elseif($o=='chat'){$q=$t->messages('list','','');}//pr($q);
elseif($o=='chat'){$q=$t->messages('new','2434088253','hello');}//echo $t->_prm; //pr($q);
//elseif($o=='chat'){$q=$t->messages('show',$id,'');}//destroy //pr($q);
//elseif($o=='mnt')$q=$t->mentions($p,$id);
elseif($o=='sql')[$q,$minid]=self::search($p,$id,'');
elseif($o=='uwd')$ret=self::wordusrs($p,1);
elseif($o=='all')$ret=self::stream('');
elseif($o=='stream'){
	//[$ret,$minid]=self::search($p,$id,'tl'); $minid=0;//patch
	$q=$t->user_timeline($p,$n,$id,$minid);}
elseif($p){$qr=[];//if($o=='search')
	//[$r,$minid]=self::search($p,$id,'');
	if(strpos($p,',')){$r=explode(',',$p);//multicall
		foreach($r as $k=>$v){$qr=$t->search($v,$n,$id,$minid);
			if(!$er=self::error($qr))$qr=$qr['statuses']; //pr($qr);
			foreach($qr as $k=>$v)if(!isset($q[$v['id']]))$q[$v['id']]=$v;} krsort($q);}
	else{$q=$t->search($p,$n,$id,$minid);//since_id not works
		if(!$er=self::error($q))$q=$q['statuses'];}}
//$rb=$t->user($r['user']['screen_name']);
if($id && $q)array_shift($q);
if($q)$ret=self::batch($q,$o);
if($qu)$ret=self::usrs($qu,$p,$o);
if(!is_numeric($p))$ret.=hidden('home',$o);
//if($o)$bt=lkt('txtx','/plug/twit/'.$p.'/'.$o,$o.': '.$p);
//if(is_array($q))json::add('','twit'.mkday(),[$p,$o,$id,$minid,$prm[0],count($q),mkday('','His'),hostname()]);
return $bt.$ret;}

static function menu($p,$o,$rid){
$j=$rid.'_twit,call_twinp_3__';
$ret=lka('/plug/twit'.($p?'/'.$p:''),picto('chain'));//.' '.$o.': '.$p
if(auth(6)){$ret.=lj('',$rid.'_twit,config__3_',picto('tools')).' ';
	$ret.=lj('',$rid.'_twit,call__3__home',picto('home'),att('timeline')).' ';
	$ret.=lj('',$j.'mnt',picto('oversight'),att('mentions')).' ';}
elseif(auth(4))$ret.=lj('',$j.'all__exs',picto('web2'),att('all')).' ';
if(auth(4))$ret.=lj('',$j.'sql',picto('enquiry'),att('sql')).' ';
if(auth(6))$ret.=inputj('twinp',$p,$j.'search').' ';
else $ret.=btn('txtcadr',$p).hidden('twinp',$p);
if(auth(4)){$ret.=lj('',$j.'search',picto('search'),att('search')).' ';
	$ret.=lj('',$j.'stream',picto('home2'),att('stream')).' ';
	$ret.=lj('',$j.'rpl',picto('dialog'),att('rpl')).' ';
	$ret.=lj('',$j.'rtw',picto('repost'),att('rtw')).' ';
	$ret.=lj('',$j.'flw',picto('users'),att('followers')).' ';
	$ret.=lj('',$j.'frn',picto('user-add'),att('friends')).' ';
	$ret.=lj('',$j.'mdl',picto('medal'),att('good friends filter')).' ';
	$ret.=lj('',$j.'stp',picto('death'),att('anti-stupids filter')).' ';
	$ret.=lj('',$rid.'_frequency,call_twinp__twits_360',picto('volume'),att('stats')).' ';}
if(auth(6))$ret.=lj('',$j.'erx',picto('rain'),att('erase plug??')).' ';
$ret.=lj('',$j.'ban',picto('img'),att('ban')).' ';
if(auth(6)){
	//$ret.=btj(picto('del'),atjr('jumpvalue',['twinp',''])).' ';
	$ret.=lj('',$j.'fav',picto('heart'),att('fav')).' ';
	$ret.=lj('',$j.'uwd',picto('ear'),att('uwd')).' ';
	$ret.=lj('','popup_twit,post___'.$rid,picto('send')).' ';
	$ret.=lj('',$j.'chat',picto('chat'),att('chat')).' ';
	$ret.=lj('',$rid.'_tweetfeed,home',picto('rss2'),att('feed')).' ';}
$ret.=hidden('exs','exs=[];');
$ret.=hlpbt('twit');
return $ret;}

static function init($n=''){$n2=sesif('apk',self::apk()); if(!$n)$n=$n2;//if(!$n)$n=2;
require_once('plug/tiers/Twitter.php'); return new Twitter($n);}

static function r(){return ['ib'=>'int','twid'=>'bint','name'=>'var','screen_name'=>'var','user_id'=>'bint','date'=>'int','text'=>'var','media'=>'var','mentions'=>'var','reply_id'=>'bint','reply_name'=>'var','favs'=>'int','retweets'=>'int','followers'=>'int','friends'=>'int','quote_id'=>'bint','quote_name'=>'var','retweeted'=>'bint','lang'=>'var'];}//geo,coordinates

static function install(){sqlop::install('twit',self::r(),0);}

static function apk(){
$d=domain(host()); $n=2;
if($d=='newsnet.fr')$n=4;
return $n;}

static function home($p,$o){$rid='tw'.randid();
//if($p=='install')self::install();
$n=self::apk(); ses('apk',$n);
ses('nbp',40); $bt='';
//self::headers($rid);//continuous scrolling
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::call($p,$o); else $ret='';
return $bt.divd($rid,$ret);}
}
?>