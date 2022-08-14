<?php //chat
class chat{
static function data($p){;
return msql::read_b('',nod('chat_'.$p),'',1,['time','name','msg']);}

static function erz($p,$erz){$nod=ses('qb').'_chat_'.$p;
msql::modif('',$nod,$erz,'del'); return self::read($p);}

static function sav($p,$nm,$msg){$nod=ses('qb').'_chat_'.$p; $ret=ajxg($msg);
if($ret)msql::modif('',$nod,[time(),$nm,embed_links($ret)],'push');
return self::read($p);}

static function nam($p,$nm,$res){
$j='popup_plug__x_chat__'.$p.'_'.substr($res,0,-1).'_nam'.$p;
$d=autoclic('" id="nam'.$p,'name',8,'20','search');
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
$d.=autoclic('" id="msg'.$p,'message',18,'1000','search');
if($nm)$j='cht'.$p.'_chat,sav___'.$p.'_'.$nm.'_msg'.$p;
else $j='popup_chat,nam__x_'.$p.'__msg'.$p;
$d.=ljb('popbt',sj($j),'',picto('kright'));
return '<form name="chat'.$p.'" action="javascript:'.sj($j).'">'.$d.'</form>';
return $ret;}

static function home($p,$msg,$res=''){
$p=$p?normalize($p):'public'; ses('muse',$res?ajxg($res):ses('USE'));
return self::form($p,$msg).divd('cht'.$p,self::read($p));}

}
?>