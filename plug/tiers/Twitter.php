<?php //https://github.com/tfairane/TwitterAPI
class Twitter{
public $_DST;
private $_method;
private $oauth_consumer_key;
private $oauth_consumer_secret;
private $oauth_nonce;
private $oauth_signature;
private $oauth_signature_method;
private $oauth_timestamp;
private $oauth_token;
private $oauth_token_secret;
private $oauth_version;
public $_usr;
public $_prm;
public $_url;

public function __construct($n=''){if(!$n)$n=1;
$r=msql::kv('',nod('twit_'.$n),'',1);//msql (hub)_twit
if(isset($r[1]))$this->oauth_token=$r[1];
if(isset($r[2]))$this->oauth_token_secret=$r[2];
if(isset($r[3]))$this->oauth_consumer_key=$r[3];
if(isset($r[4]))$this->oauth_consumer_secret=$r[4];
if(isset($r[5]))$this->_usr=$r[5];
$this->oauth_nonce=md5(rand());
$this->oauth_signature_method='HMAC-SHA1';
$this->oauth_timestamp=time();
$this->oauth_version='1.0';}

//build url
private function urlParams(){
return ['oauth_consumer_key'=>$this->oauth_consumer_key,
'oauth_nonce'=>$this->oauth_nonce,
'oauth_signature'=>$this->oauth_signature,
'oauth_signature_method'=>$this->oauth_signature_method,
'oauth_timestamp'=>$this->oauth_timestamp,
'oauth_token'=>$this->oauth_token,
'oauth_version'=>$this->oauth_version];}

private function mkprm($qr='',$sec=''){$ret='';
$r=$this->urlParams(); unset($r['oauth_signature']);
foreach($r as $k=>$v)$rt[]=$k.'='.rawurlencode($v);
$ret=implode('&',$rt);
if($qr)$ret=$qr.'&'.$ret;
if($sec)$ret.='&'.$sec;
$this->_prm=$ret;}

private function mkprm2(){$r=$this->urlParams();
foreach($r as $k=>$v)$rt[]=$k.'="'.rawurlencode($v).'"';
return implode(',',$rt);}

//webservice
private function send($url,$post){
$d=curl_init();//if(auth(6))pr($this->_DST);
curl_setopt($d,CURLOPT_URL,$url); //echo $url;
curl_setopt($d,CURLOPT_HTTPHEADER,$this->_DST);
if($post){//if(auth(6))pr($post);
curl_setopt($d,CURLOPT_POST,TRUE);
curl_setopt($d,CURLOPT_POSTFIELDS,$post);}
curl_setopt($d,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($d,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($d,CURLOPT_RETURNTRANSFER,1);
$ret=json_decode(curl_exec($d),true);
return $ret;}

//publish
public function update($id){
$this->_url='https://api.twitter.com/1.1/statuses/update.json';
$this->_method='POST';
$qr='status='.rawurlencode($id);
$this->mkprm('',$qr);
$this->gen();
return $this->send($this->_url,$qr);}

public function delete($id){
$this->_url='https://api.twitter.com/1.1/statuses/destroy/'.$id.'.json';
$this->_method='POST';
$qr='status='.rawurlencode($id);
$this->mkprm('',$qr);
$this->gen();
return $this->send($this->_url,$qr);}

public function like($id,$o=''){$mk=$o?'destroy':'create';
$this->_url='https://api.twitter.com/1.1/favorites/'.$mk.'.json';
$this->_method='POST';
$qr='id='.$id;
$this->mkprm($qr);
$this->gen();
return $this->send($this->_url,$qr);}

public function retweet($id,$o=''){$mk=$o?'unretweet':'retweet';
$this->_url='https://api.twitter.com/1.1/statuses/'.$mk.'.json';///'.$id.'
$this->_method='POST';
$qr='id='.$id;
$this->mkprm($qr);
$this->gen();
return $this->send($this->_url,$qr);}

public function login($d){
$this->_url='https://api.twitter.com/oauth/authenticate.json';
$this->_method='POST';
$qr='oauth_callback='.rawurlencode($d);
$this->mkprm($qr);
$this->gen();
return $this->send($this->_url.'?'.$qr,'');}

//follow
public function follow($id){
$this->_url='https://api.twitter.com/1.1/friendships/create.json';
$this->_method='POST';
$qr='user_id='.rawurlencode($id);
$sec='follow=true';
$this->mkprm($sec,$qr);
$this->gen();
return $this->send($this->_url,$qr.'&'.$sec);}

//show
public function show($d){
$this->_url='https://api.twitter.com/1.1/users/show.json';
$this->_method='GET';
if(is_numeric($d))$qr='user_id='.$d;
else $qr='screen_name='.rawurlencode($d);
$sec='include_email=true';
$this->mkprm($sec,$qr);
$this->gen();
return $this->send($this->_url.'?'.$qr.'&'.$sec,'');}

public function lookup($id){
$this->_url='https://api.twitter.com/1.1/users/lookup.json';
$this->_method='GET';
$qr='user_id='.rawurlencode($id);
$sec='include_email=true';
$this->mkprm('',$qr);
$this->gen();
return $this->send($this->_url.'?'.$qr,'');}

public function credentials($usr){
$this->_url='https://api.twitter.com/1.1/account/verify_credentials.json';
$this->_method='GET';
$qr='';
$sec='include_email=true';//name='.rawurlencode($usr).'&
$this->mkprm($sec,$qr);//
$this->gen();
return $this->send($this->_url.'?'.$qr.'&'.$sec,'');}//

//read
public function read($id){
$this->_url='https://api.twitter.com/1.1/statuses/show/'.$id.'.json';
$this->_method='GET';
$this->mkprm();
$this->gen();
return $this->send($this->_url,'');}

//credentials
/*public function user($id){//obsolete
$this->_url='https://api.twitter.com/1.1/account/verify_credentials/'.$id.'.json';
$this->_method='GET';
$this->mkprm();
$this->gen();
return $this->send($this->_url,'');}

public function replies($id){//obsolete
$this->_url='https://api.twitter.com/1/related_results/show/'.$id.'.json';
$this->_method='GET';
$this->mkprm();
$this->gen();
return $this->send($this->_url,'');}*/

//tl
public function home_timeline($user,$n,$max='',$min=''){//authentificated user
$this->_url='https://api.twitter.com/1.1/statuses/home_timeline.json';
$this->_method='GET';
$qr='screen_name='.rawurlencode($user);
$sec='count='.rawurlencode($n).'&include_rts=1&trim_user=1';
$sec.=$max?'&max_id='.rawurlencode($max):'';
$sec.=$min?'&since_id='.rawurlencode($min):'';
$this->mkprm('',$qr);
$this->gen(); $f=$this->_url.'?'.$qr;//.'&'.$sec
return $this->send($f,'');}

public function mentions_timeline($user,$n,$max='',$min=''){//authentificated user
$this->_url='https://api.twitter.com/1.1/statuses/mentions_timeline.json';
$this->_method='GET';
$qr='screen_name='.rawurlencode($user);
$sec='count='.rawurlencode($n).'&include_rts=1&trim_user=1';
$sec=$max?'&max_id='.rawurlencode($max):'';
$sec.=$min?'&since_id='.rawurlencode($min):'';
$this->mkprm('',$qr);//$sec
$this->gen(); $f=$this->_url.'?'.$qr;//.'&'.$sec
return $this->send($f,'');}

public function user_timeline($user,$n,$max='',$min=''){
$this->_url='https://api.twitter.com/1.1/statuses/user_timeline.json';
$this->_method='GET';
$qr='screen_name='.rawurlencode($user);
$sec='count='.rawurlencode($n).'&include_rts=1';//.'&trim_user=1'
$sec.=$max?'&max_id='.rawurlencode($max):'';
$sec.=$min?'&since_id='.rawurlencode($min):'';
$this->mkprm($sec,$qr);
$this->gen(); $f=$this->_url.'?'.$qr.'&'.$sec;
return $this->send($f,'');}

public function search($d,$n=40,$max='',$min=''){
$this->_url='https://api.twitter.com/1.1/search/tweets.json';
$this->_method='GET';
$qr='q='.rawurlencode($d).'&result_type=recents';//popular//mixed//&trim_user=1
$qr.=$min?'&since_id='.$min:'';
$sec='count='.rawurlencode($n);
$sec.=$max?'&max_id='.$max:'';
$this->mkprm($sec,$qr);
$this->gen();
return $this->send($this->_url.'?'.$qr.'&'.$sec,'');}

public function favorites($usr,$max='',$n=40){
$this->_url='https://api.twitter.com/1.1/favorites/list.json';
$this->_method='GET';
$qr='q='.rawurlencode($usr);//;//popular//mixed
$sec='count='.rawurlencode($n);
$sec.=$max?'&max_id='.rawurlencode($max):'';
$this->mkprm($sec,$qr);
$this->gen();
return $this->send($this->_url.'?'.$qr.'&'.$sec,'');}

public function retweets($id,$n=100){
$this->_url='https://api.twitter.com/1.1/statuses/retweets/'.$id.'.json';
$this->_method='GET';
$qr='count='.$n;//.'&trim_user=1'
$this->mkprm($qr);
$this->gen();
return $this->send($this->_url.'?'.$qr,'');}

public function retweeters($id,$n=100){
$this->_url='https://api.twitter.com/1.1/statuses/retweeters/ids.json';
$this->_method='GET';
$qr='id='.$id;//.'&count=100&stringify_ids=true'
$this->mkprm($qr);
$this->gen();
return $this->send($this->_url.'?'.$qr,'');}

public function mentions($n=20,$id=''){
$this->_url='https://api.twitter.com/1.1/statuses/mentions_timeline.json';
$this->_method='GET';
$qr='count='.$n;
if($id)$qr.='&since_id='.$id;//'name='.rawurlencode($d).&
$this->mkprm('',$qr);
$this->gen();
return $this->send($this->_url.'?'.$qr,'');}

public function followers($u,$cursor=''){
$this->_url='https://api.twitter.com/1.1/followers/ids.json';
$this->_method='GET';
$qr='screen_name='.rawurlencode($u);
$sec='count=500';//&skip_status=true&include_user_entities=false
if($cursor)$sec.='&cursor='.$cursor;
$this->mkprm('',$qr);
$this->gen();
return $this->send($this->_url.'?'.$qr,'');}//.'&'.$sec,

public function followers2($u,$cursor=''){
$this->_url='https://api.twitter.com/1.1/followers/list.json';
$this->_method='GET';
$qr='screen_name='.rawurlencode($u);
$sec='count=500';//&skip_status=true&include_user_entities=false
if($cursor)$sec.='&cursor='.$cursor;
$this->mkprm('',$qr);
$this->gen();
return $this->send($this->_url.'?'.$qr,'');}//.'&'.$sec,

public function friends($u,$cursor=''){
$this->_url='https://api.twitter.com/1.1/friends/ids.json';
$this->_method='GET';
$qr='screen_name='.rawurlencode($u);
$sec='count=500';//&skip_status=true&include_user_entities=false
if($cursor)$sec.='&cursor='.$cursor;
$this->mkprm('',$qr);
$this->gen();
return $this->send($this->_url.'?'.$qr,'');}//.'&'.$sec,

public function friends2($u,$cursor=''){
$this->_url='https://api.twitter.com/1.1/friends/list.json';
$this->_method='GET';
$qr='screen_name='.rawurlencode($u);
$sec='count=500';//&skip_status=true&include_user_entities=false
if($cursor)$sec.='&cursor='.$cursor;
$this->mkprm('',$qr);
$this->gen();
return $this->send($this->_url.'?'.$qr,'');}//.'&'.$sec,

public function embed($u){
$this->_url='https://publish.twitter.com/oembed';
$this->_method='GET';
$qr='url='.rawurlencode($u);
$this->mkprm($qr);
$this->gen();
return $this->send($this->_url.'?'.$qr,'');}

public function messages($o,$id='',$t=''){
$url='https://api.twitter.com/1.1/';
if($o=='list'){$u='direct_messages/events/list.json'; $m='GET'; $qr='';}
if($o=='new'){$u='direct_messages/events/new.json'; $m='POST';
//{"event": {"type": "message_create", "message_create": {"target": {"recipient_id": "RECIPIENT_USER_ID"}, "message_data": {"text": "Hello World!"}}}}
	$qr=json_encode(['event'=>['type'=>'message_create','message_create'=>['target'=>['recipient_id'=>$id],'message_data'=>['text'=>rawurlencode($t)]]]]);}
if($o=='show'){$u='direct_messages/events/show.json'; $qr='id='.$id; $m='GET';}
if($o=='destroy'){$u='direct_messages/events/destroy.json'; $qr='id='.$id; $m='GET';}
$this->_url=$url.$u;
$this->_method=$m;
$this->mkprm($qr);
$this->gen();
if($m=='POST')return $this->send($this->_url,$qr);
else return $this->send($this->_url.($qr?'?'.$qr:''),'');}

//signatures importantes pour l'OAuth
private function gen(){
$signature=rawurlencode($this->_method).'&'.rawurlencode($this->_url).'&'.rawurlencode($this->_prm);
$signing_key=rawurlencode($this->oauth_consumer_secret).'&'.rawurlencode($this->oauth_token_secret);
$this->oauth_signature=base64_encode(hash_hmac('SHA1',$signature,$signing_key,TRUE));
$this->_DST=array('Authorization: OAuth '.$this->mkprm2());}
}