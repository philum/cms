<?php //chatxml
class chatxml{
static function ses($p,$v){$d='chtxlst'.$p;
if($v=='a')return $_SESSION[$d]; else $_SESSION[$d]=$v;}

static function canal($p){
$f=upsrv().'/call/microsql/canalchat';
$ar=read_file($f); $r=explode(';',$ar);
$ret=btn('txtcadr',nms(102)).br(); $j='popup_chatxml,home__x_';
if($r)foreach($r as $k=>$v){$ret.=lj($v==$p?'active':'',$j.$v,$v).br();}
return divc('nbp',$ret);}

static function sav($p,$nm,$prm=[]){$msg=$prm[0]??''; if(is_numeric($nm))self::ses($p,'0');
$msg=str_replace([' ',"\n","&"],[':space:',':line:','(and)'],$msg);
$f=upsrv().'/call/microsql/chat/'.$p.'?name='.$nm.'&msg='.ajx(str::embed_links($msg)).'&suj='.$nm.'&host='.$_SERVER['HTTP_HOST'].'/'.ses('qb').'&admail='.$_SESSION['qbin']['adminmail'];
if($msg or is_numeric($nm))read_file($f); return self::call($p);}

static function invite($p,$to=''){
$ret=inputb('chtxvt',$to?$to:'mail','','search').' ';
$ret.=lj('','chtxinvt_chatxml,invit___'.$p.'__chtxvt',picto('kright'));
ses::$r['popt']=nms(109);
return $ret.divd('chtxinvt','');}

static function invitx($p,$w){[$w,$nm]=explode('/',$w);
$to=read_file('http://'.$w.'/call/microsql/kmail/'.$nm);
return self::invite($p,$to);}

static function invit($p,$nm,$prm=[]){$nm=ses('muse'); $to=$res=$prm[0]??'';;
$msg=str_replace('_NAME',$nm,helps('chatcall')); $url=host().'/module/chatxml/'.$p;
if($to){mails::send_txt($to,$msg,$url,$nm,''); return nms(109).' '.nms(79).'e';}
else return nms(114);}

static function nam($p,$nm,$prm=[]){$res=$rm[0]?'';
$j='popup_chatxml,home__x_'.$p.'_'.$res.'_namx'.$p;
$d=inputb('namx'.$p,'',8,'name',20,[]);
return $d.lj('popbt',$j,picto('kright'));}

static function call($p){//self::ses($p,'0');
[$r,$r1]=self::data($p); return self::read($p,$r);}

static function form($p){$nm=ses('muse');
$d=lj('txtcadr','popup_chatxml,home__x_'.$p,pictxt('reload',$p)).' ';
$d.=lj('','chtx'.$p.'_chatxml,call__13_'.$p,picto('loading')).' ';
$d.=loadjs('chatx',$p,'live').' '.hlpbt('chatxml').' ';
$d.=lj('','popup_chatxml,canal__x_'.$p,picto('rss')).' ';
$d.=lj('','popup_chatxml,invite___'.$p,picto('mail')).' ';
//$d.=lj('','chtx'.$p.'_chatxml,sav___'.$p.'_2',picto('del')).' ';
if(auth(6))$d.=msqbt('clients','chat_'.$p).' '; $d.=hlpbt('sconn').br();
if($nm)$j='chtx'.$p.'_chatxml,sav_msgx'.$p.'_before_'.$p.'_'.$nm).atjr('jumpvalue',['msgx'.$p,''];
else $j='popup__chatxmlnam__x_'.$p.'__msgx'.$p;
$sty='min-height:24px; border:1px solid #777; max-width:330px; max-height:200px; overflow-y:auto; padding:4px;';
$d.=divarea('msgx'.$p,'','track',$sty);//divedit
$d.=lj('',$j,divb(nms(28),'popsav','','width:330px;'));
return $d;}

static function data($p){$lst=self::ses($p,'a'); $r1='';
$f=upsrv().'/msql/clients/chat_'.$p; $r=microxml::call($f,$lst);
if($r){unset($r['_menus_']); $r1=$r[1]??''; if(isset($r[1]))unset($r[1]);
	$r=array_reverse_b($r,20); if($r)self::ses($p,key($r));}
return [$r,$r1];}

static function head($p,$r1){
$sty=' class="bkg" style="border-color:white; padding:4px;"'; $erz='';
if(strfrom($r1[3]??'','/')==ses('USE'))
	$erz=lj('txtsmall','chtx'.$p.'_chatxml,sav___'.$p.'_1','(x)');
$msg=$r1[2]??'';
$msg=codeline::parse($msg,'','sconn2'); 
return div($sty,$erz.nl2br(stripslashes($msg)));}

static function read($p,$r){$c='txtsmall'; $nm=ses('muse'); $use=ses('USE');
if($r)foreach($r as $k=>$v){$erz=''; $ml=''; $msg=$v[2];
if($use && ($v[1]==$nm or $p==$use))
	$erz=lj($c,'chtx'.$p.'_chatxml,sav___'.$p.'_'.$k,picto('sclose'));
if(strfrom($v[3],'/')==$use)
	$ml=lj('popbt','popup_chatxml,invitx___'.$p.'_'.ajx($v[3]),'@').'';
$bt=lkt('popbt','http://'.$v[3],$v[1]).' '.btn($c.'2',mkday($v[0],'ymd:hi'));
//$msg=codeline::parse(html_entity_decode($msg),'','sconn2');
$msg=conn::read($msg,'','');
return divc('track',$ml.$bt.$erz.br().nl2br(stripslashes($msg)));}}

static function home($p,$msg='',$prm=[]){if(!$p)return self::canal('public');
$p=normalize($p); ses('muse',$prm[0]??ses('USE')); self::ses($p,'0');
[$r,$r1]=self::data($p); $form=self::form($p); $head=self::head($p,$r1);
$sty=atd('chtx'.$p).ats('width:344px;');
return $head.$form.scroll($r,div($sty,self::read($p,$r)),5,362,'calc(100vh - 230px)');}
}
?>