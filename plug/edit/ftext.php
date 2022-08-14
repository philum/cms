<?php //stext
class ftext{
static function log(){return auth(6)?ses('qb'):'public';}

static function call($n,$b,$prm=[]){$nd=self::log();
$ra=array(mkday(),html_entity_decode_b($prm[0]??'')); //p($ra);
msql::modif('users',$nd.'_txt_'.$n,$ra,'one','',1);
return btn('txtyl','ok');}

static function home($d,$tx){$nd=self::log();
$ra=msql::row('',$nd.'_txt_ftxt',1);
$msg=stripslashes($ra[1]); $msg=html_entity_decode_b($msg);
if(!$ra && $nd)msql::modif('users',$nd.'_txt_ftxt',['day','text'],'one','',1);
$ret=lj('','bck_ftext,call_ftxt_xd_ftxt',picto('save')).' ';
$ret.=btd('bck','').hlpbt('ftext').br();
if(!$tx)$ret.=textarea('ftxt',$msg,54,12);
return btd('plgtxt',$ret);}
}
?>