<?php
class db{
static $r=[];
static $rb=[];
static $ty=['ai','aib','int','bint','sint','var','svar','mvar','bvar','var2','var11','text','long','time','psw'];
static $rt=['qdy'=>'_sys','qda'=>'art','qdm'=>'txt','qdd'=>'data','qdu'=>'user','qdi'=>'trk','qdb'=>'mbr','qdp'=>'ips','qdv'=>'live','qdv2'=>'live2','qds'=>'stat','qdt'=>'meta','qdta'=>'meta_art','qdtc'=>'meta_clust','qdtm'=>'meta_mul','qdf'=>'favs','qdsr'=>'search','qdsra'=>'search_art','ynd'=>'yandex','qdw'=>'web','qdtw'=>'twit','qdg'=>'img','qdc'=>'cat','qdk'=>'iqs'];

function construct(){self::$r=self::defs();}

static function defs(){
$r['art']=['id'=>'ai','ib'=>'int','name'=>'mvar','mail'=>'var','day'=>'int10','nod'=>'svar','frm'=>'var','suj'=>'var','re'=>'int','lu'=>'int','img'=>'var','thm'=>'var','host'=>'var','lg'=>'var2','key'=>'KEY `nod_frm` (`day`,`frm`), KEY `suj` (`suj`), KEY `nod_day` (`day`,`nod`)'];
$r['txt']=['id'=>'ai','msg'=>'text'];
//$r['cat']=['id'=>'ai','qb'=>'mvar','cat'=>'mvar','active'=>'enum(01)'];
//$r['hub']=['id'=>'ai','hub'=>'svar'];
$r['trk']=['id'=>'ai','ib'=>'int','name'=>'var','mail'=>'var','day'=>'int10','nod'=>'var','frm'=>'svar','suj'=>'var','msg'=>'text','re'=>'int','host'=>'var','key'=>'KEY `nod` (`nod`), KEY `suj_nod` (`suj`,`nod`), KEY `day_nod` (`day`,`nod`)'];
$r['user']=['id'=>'ai','name'=>'var','pass'=>'psw','mail'=>'var','day'=>'int10','clr'=>'var','ip'=>'var','rstr'=>'var','mbrs'=>'var','hub'=>'var','nbarts'=>'int','config'=>'var','struct'=>'var','dscrp'=>'var','menus'=>'var','active'=>'int','key'=>'UNIQUE KEY `one` (`name`)'];
$r['data']=['id'=>'ai','ib'=>'var','val'=>'mvar','msg'=>'var','key'=>'KEY `ib_val` (`ib`,`val`)'];
$r['live']=['id'=>'aib','iq'=>'int','qb'=>'int3','page'=>'var','time'=>'time','key'=>
'KEY `qb` (`qb`)'];
$r['live2']=['id'=>'aib','iq'=>'int','qb'=>'int3','page'=>'var','time'=>'time','key'=>
'KEY `qb` (`qb`)'];
$r['ips']=['id'=>'aib','ip'=>'var','nav'=>'var','ref'=>'var','nb'=>'int','time'=>'time','key'=>
'KEY `ip` (`ip`)'];
$r['iqs']=['id'=>'ai','iq'=>'int','ok'=>'int','usr'=>'svar','time'=>'time'];
$r['stat']=['id'=>'ai','qb'=>'var','day'=>'int10','nbu'=>'int','nbv'=>'int','key'=>'KEY `qb` (`qb`,`day`)'];
$r['meta']=['id'=>'ai','qb'=>'var','cat'=>'var','tag'=>'var'];
$r['meta_art']=['id'=>'aib','idart'=>'int','idtag'=>'int'];
$r['meta_clust']=['id'=>'aib','idtag'=>'int','word'=>'var'];
$r['meta_mul']=['id'=>'aib','idart'=>'int','tg'=>'var','lg'=>'var2'];
$r['favs']=['id'=>'aib','ib'=>'int','iq'=>'int','type'=>'svar','poll'=>'int'];
$r['search']=['id'=>'ai','word'=>'var'];
$r['search_art']=['id'=>'ai','ib'=>'int','art'=>'int','nb'=>'int'];
$r['mbr']=['id'=>'ai','name'=>'svar','hub'=>'svar','auth'=>'int'];
$r['img']=['id'=>'aib','ib'=>'int','im'=>'var','dc'=>'var','no'=>'int1'];
$r['yandex']=['id'=>'ai','ref'=>'var11','txt'=>'text','lang'=>'var2'];
$r['web']=['id'=>'ai','ib'=>'int','url'=>'var','tit'=>'varu','txt'=>'text','img'=>'var'];
$r['twit']=['id'=>'aib','ib'=>'int','twid'=>'bint','name'=>'var','screen_name'=>'var','date'=>'int10','text'=>'text','media'=>'var','reply_id'=>'bint','reply_name'=>'var','favs'=>'int','retweet'=>'int','followers'=>'int','friends'=>'int','quote_id'=>'bint','quote_name'=>'var','rewteeted'=>'bint','lang'=>'var2'];
$r['sys']=['id'=>'ai','name'=>'var','page'=>'var','maj'=>'int10','func'=>'var'];
//umm
$r['dicoen']=['id'=>'ia','mot'=>'svar'];
$r['dicofr']=['id'=>'ia','mot'=>'svar','sound'=>'var'];
$r['bdvoc']=['id'=>'ia','voc'=>'var','def'=>'bvar','snd'=>'svar','typ'=>'word/expression/name/planet/unit'];
$r['gaia']=['id'=>'ia','gid'=>'bint','ra'=>'double','dc'=>'double','parallax'=>'double','pmra'=>'double','pmdec'=>'double','mag'=>'double'];
$r['bdvoc']=['id'=>'ia','ref'=>'svar','idart'=>'int','date'=>'svar','lang'=>'2var','voc'=>'var','txt'=>'text','sound'=>'svar'];
$r['umtwits']=['ib'=>'int','twid'=>'bint','name'=>'var','screen_name'=>'var','user_id'=>'bint','date'=>'int','text'=>'var','media'=>'var','mentions'=>'var','reply_id'=>'bint','reply_name'=>'var','favs'=>'int','retweets'=>'int','followers'=>'int','friends'=>'int','quote_id'=>'bint','quote_name'=>'var','retweeted'=>'bint','lang'=>'var2'];
return $r;}

static function def($b){
if(!self::$r)self::$r=self::defs();
return self::$r[$b]??[];}

static function vrf($d,$c,$b){
if(!self::$rb)self::$rb=self::def($b);
$ty=self::$rb[$c]??''; $d=$d??'';
switch($ty){
case('ai'):return is_numeric($d)&&$d<2147483647?$d:NULL;break;//7
case('aib'):return is_numeric($d)?$d:0;break;//11
case('int'):return is_numeric($d)&&$d<=2147483647?$d:0;break;//11 <2147483647
case('int10'):return is_numeric($d)&&strlen($d)<11?$d:0;break;//10
case('int1'):return is_numeric($d)&&strlen($d)<2?$d:0;break;//1
case('int3'):return is_numeric($d)&&strlen($d)<4?$d:0;break;//3
case('int7'):return is_numeric($d)&&strlen($d)<8?$d:0;break;//7
case('bint'):return is_numeric($d)&&strlen($d)<27?$d:0;break;//26 <372036854775807
case('sint'):return is_numeric($d)&&$d<32767?$d:0;break;//smallint <65535
case('var'):return is_string($d)&&strlen($d)<256?$d:substr($d,0,255);break;//255
case('varu'):return is_string($d)&&mb_strlen($d)<256?$d:mb_substr($d,0,255);break;//255
case('svar'):return is_string($d)&&strlen($d)<26?$d:substr($d,0,25);break;//25
case('mvar'):return is_string($d)&&strlen($d)<56?$d:substr($d,0,55);break;//55
case('bvar'):return is_string($d)&&strlen($d)<1001?$d:substr($d,0,1000);break;//1000
case('var11'):return is_string($d)&&strlen($d)<12?$d:'';break;//11
case('var2'):return is_string($d)&&strlen($d)==2?$d:'';break;//2
case('text'):return strlen($d)<=16777215?$d:substr($d,0,16777215);break;//mediumtext
case('long'):return $d!=null?$d:'';break;//longtext
case('enum(01)'):return $d===0||$d===1?$d:null;break;//enum
case('psw'):return 'PASSWORD('.$d.')';break;
case('time'):return 'NOW()';break;
default:return 0;}}

static function vrfr($r,$b){$rb=[];
if($r)foreach($r as $k=>$v)$rb[$k]=self::vrf($v,$k,$b);
return $rb;}

static function sav($b,$r,$o=''){
$t=self::$rt[$b];
$rb=self::vrfr($r,$t);
return sqlsav($b,$rb,$o);}

static function savk($b,$r,$o=''){
$t=self::$rt[$b];
self::$rb=self::def($t);
$rk=self::$rb; unset($rk['id']); if(isset($rk['key']))unset($rk['key']);
$rc=array_combine($rk,$r);
$rd=self::vrfr($rc,$t);
return sqlsav($b,$rd,$o);}

}
?>