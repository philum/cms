<?php //chat
class chat{
static function data($p){;
return msql::read_b('',nod('chat_'.$p),'',1,['time','name','msg']);}

static function erz($p,$erz){$nod=ses('qb').'_chat_'.$p;
msql::modif('',$nod,$erz,'del'); return self::read($p);}

static function sav($p,$nm,$prm=[]){$nod=ses('qb').'_chat_'.$p; $msg=$prm[0]??'';;
if($ret)msql::modif('',$nod,[time(),$nm,embed_links($msg)],'push');
return self::read($p);}

static function nam($p,$nm,$prm=[]){$res=$prm[0]??'';
$j='popup_chat,home_nam'.$p.'_x_chat__'.$p.'_'.ajx($res);
$d=inputb('nam'.$p,'',8,'name',20,[]);
return $d.lj('popbt',$j,picto('kright'));}

static function read($p){$nm=ses('muse'); $c='txtsmall'; $r=self::data($p); $ret='';
if($r){$r=array_reverse_b($r,50); $ret='';
foreach($r as $k=>$v){$erz=''; $msg=$v[2];
	if($nm==$v[1] or auth(6))$erz=lj($c,'cht'.$p.'_cha,erz___'.$p.'_'.$k,'(x)');
	$bt=btn('popbt',$v[1]).' '.btn($c.'2',mkday($v[0],'ymd:Hi')).$erz;
	//$msg=codeline::parse($msg,'','sconn2');
	$msg=conn::read($msg,'','');
	$ret.=divc('track',$bt.$msg);}}
return scroll($r,$ret,7);}

static function form($p,$msg){$nm=ses('muse');
$d=lj('popbt','cht'.$p.'_chat,read___'.$p,picto('reload'),att('#'.$p));
$d.=inputb('msg'.$p,'',18,'message',1000,[]);
if($nm)$j='cht'.$p.'_chat,sav_msg'.$p.'__'.$p.'_'.$nm;
else $j='popup_chat,nam_msg'.$p.'_x_'.$p;
$d.=lj('popbt',$j,picto('kright'));
return '<form name="chat'.$p.'" action="javascript:'.sj($j).'">'.$d.'</form>';
return $ret;}

static function home($p,$msg,$prm=[]){
$p=$p?normalize($p):'public'; ses('muse',$pr[0]??ses('USE'));
return self::form($p,$msg).divd('cht'.$p,self::read($p));}

}
?>