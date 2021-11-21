<?php //philum/c
class mails{

static function prep_mail_html($suj,$v,$url){
$http=$_SERVER['HTTP_HOST']; $qb=ses('qb'); $ban=balb('h3',lk(prep_host($qb),$http));
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
$rh=['Mime-Version'=>'1.0','Content-Type'=>'text/html; charset="'.ses('enc').'"','X-Priority'=>'1','From'=>$from,'To'=>$dest,'Cc'=>'','Bcc'=>'','Reply-To'=>$from,'X-Mailer'=>'PHP/'.phpversion(),'Date'=>date('D, j M Y H:i:s')];
foreach($rh as $k=>$v)$head.=$k.': '.$v.$n;
if(mail($dest,utf($suj),utf($msg),$head))return btn('txtyl','mail_sent_to: '.$dest); 
else return btn('txtyl','not_sent');}

static function send_txt($dest,$suj,$v,$from,$url){$n="\r\n"; $v=wordwrap($v,70,$n);
$suj=html_entity_decode_b($suj); $head='From:'.$from.$n;
$msg=$v.$n.$n.prep_host(ses('qb')).$url;
if(mail($dest,utf($suj),utf($msg),$head)){return btn('txtyl','mail_sent_to: '.$dest);}}

static function send_mail($format,$to,$suj,$msg,$from,$url){
if($format=='html'){self::send_html($to,$suj,$msg,$from,$url);}
else{self::send_txt($to,$suj,$msg,$from,$url);}}

}
?>