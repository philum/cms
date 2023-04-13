<?php 
class mails{

//send art
static function sendart($id,$o,$prm){
$http=host(); $htacc=urlread($id);
[$txt,$from,$to,$suj]=$prm;
if(strpos($to,'@')!==false){
$suj=sql('suj','qda','v','id="'.$id.'"');
$msg=divc('panel justy',$txt);
$msg.=lkc('',$http.$htacc,tagb('h2',$suj));
$msg.=divc('panel justy',ma::read_msg($id,'nlb'));
self::send_mail('html',$to,$suj,$msg,$from?$from:hostname(),$htacc);
return btn('popbt',nms(34).' '.nms(79).' '.nms(36).': '.$to);}
else return btn('popdel','error:'.$to);}

static function slct($id){$r=mail_mails(); $ret='';
if($_SESSION['auth']<3)$r=[$_SESSION['qbin']['adminmail']=>1];
if($r){ksort($r); foreach($r as $k=>$v){
	$ret.=ljb('txtx','jumpvalue',[$id,$k,1],strto($k,'@')).' ';}
return divc('nbp',$ret);}}

static function form($id){
$ids='vmsg'.$id.',vmfrom'.$id.',vmto'.$id.',vmsg'.$id;
$ret=lj('popsav','vsd'.$id.'_mails,sendart_'.$ids.'__'.$id,nms(28));
if(ses('USE'))$ret.=hidden('vmfrom'.$id,sesr('qbin','adminmail'));
else{$ret.=label('vmfrom'.$id,ucfirst(nms(68)).':','popw').' ';
$ret.=input('vmfrom'.$id,24).br();}
if(auth(4))$ret.=lj('txtbox','popup_mails,slct_vmto'.$id,nms(36));
else $ret.=btn('txtx',nms(36));
$ret.=inpmail('vmto'.$id,'to');
$ret.=divb(inpmail('vmsuj'.$id,'email'));
$ret.=divb(textarea('vmsg'.$id,'',44,2));
return divd('vsd'.$id,$ret);}

//send track
static function batch($r,$format,$suj,$msg,$from,$lk){$ret='';
if($r)foreach($r as $k=>$v){if($v){$ret.=btn("txtyl",$v);
self::send_mail($format,$v,$suj,$msg,$from,$lk);}}
return $ret;}

static function sendtrk($id){
$sender=$_SESSION['qbin']['adminmail'];//i.
[$name,$day,$idt,$msg]=sql('name,day,frm,msg','qdi','r',$id);
$by=helps('trackmail'); $msg=conn::read($msg,'',$idt)."\n\n";
$msg=nl2br($by."\n\n".'By: '.$name.', '.mkday($day)."\n\n".$msg);
$suj=sql('suj','qda','v',$idt);
$rmails=sql('mail','qdi','k','frm="'.$idt.'"');
if($rmails)$r=array_keys_b($rmails);
if(isset($r))self::batch($r,'html',$suj,$msg,$sender,$id);}

//meca
static function datas($o=''){
$r=msql_read('',nod('mails'),'',1); $rt=[];
if($r)foreach($r as $k=>$v){if($v[2])$rt[$v[0]]=$v[1].'<'.$v[0].'>';}
return $o?implode(",\n",$rt):$rt;}

static function prep_mail_html($suj,$v,$url){
$http=$_SERVER['HTTP_HOST']; $qb=ses('qb'); $ban=tagb('h3',lk(prep_host($qb),$http));
$css=$qb.'_'.'design_'.$_SESSION['prmd'].'.css';
if(strpos($url,'http')===false)$url='http://'.$http.'/'.$url;
return '<html><head><title>'.$suj.'</title>
<link href="http://'.$http.'/css/_global.css" rel="stylesheet" type="text/css">
<link href="http://'.$http.'/css/_pictos.css" rel="stylesheet" type="text/css">
<link href="http://'.$http.'/css/'.$css.'" rel="stylesheet" type="text/css">
</head><body>'.$ban.divs('margin:10px;',stripslashes($v)).'<br><br>'.
lkc('txtx',$url,$url).'</body></html>';}

static function send_html($dest,$suj,$v,$from,$url){
$msg=self::prep_mail_html($suj,$v,$url); $n="\r\n";
$admail=$_SESSION['qbin']['adminmail']; $head='';
$dest=$dest?$dest:$admail; $from=$from?$from:$admail;
$rh=['Mime-Version'=>'1.0','Content-Type'=>'text/html; charset="'.ses::$enc.'"','X-Priority'=>'1','From'=>$from,'To'=>$dest,'Cc'=>'','Bcc'=>'','Reply-To'=>$from,'X-Mailer'=>'PHP/'.phpversion(),'Date'=>date('D, j M Y H:i:s')];
foreach($rh as $k=>$v)$head.=$k.': '.$v.$n;
if(mail($dest,utf($suj),utf($msg),$head))return btn('txtyl','mail_sent_to: '.$dest); 
else return btn('txtyl','not_sent');}

static function send_txt($dest,$suj,$v,$from,$url){$n="\r\n"; $v=wordwrap($v,70,$n);
$suj=str::html_entity_decode_b($suj); $head='From:'.$from.$n;
$msg=$v.$n.$n.prep_host(ses('qb')).$url;
if(mail($dest,utf($suj),utf($msg),$head)){return btn('txtyl','mail_sent_to: '.$dest);}}

static function send_mail($format,$to,$suj,$msg,$from,$url){
if($format=='html'){self::send_html($to,$suj,$msg,$from,$url);}
else{self::send_txt($to,$suj,$msg,$from,$url);}}

static function send_user_mail($id,$lgtxt){//send_to_author
$sender=$_SESSION['qbin']["adminmail"];
[$kem,$suj]=sql('name,suj','qda','r','id="'.$id.'"');
if($kem!=$_SESSION['USE']){
$nmsg=helps($lgtxt);//.br().br().$suj
	$kmail=sql('mail','qdu','v','name="'.$kem.'"');
	if($kmail!=$_SESSION['qbin']["adminmail"])
		self::send_html($kmail,$suj,nl2br($nmsg),$sender,urlread($id));}}

}
?>