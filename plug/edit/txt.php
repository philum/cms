<?php 
class txt{

static function log(){return ses('auth')>6?ses('qb'):ses('USE');}

static function del($d){$nd=self::log();
if($d)unlink('msql/users/'.$nd.'_txt_'.$d.'.php');
return btn('txtyl','deleted');}

static function paste($d){$ret=hidden('cka','m'.$d);
$ret.=ljb('','mem_storage','txtarea_m1___cka0',picto('save2'),atd('cka1').att(nms(27))).' ';
$ret.=ljb('','mem_storage','txtarea_m1_1__ckb0',picto('refresh'),atd('ckb1').att(nms(95))).' ';
//$ret.=hlpbt('memstorage');
return btn('nbp',$ret).' ';}

static function files($nd,$tx){$ret='';
$r=msql::choose('',$nd,'txt'); if($r)asort($r); $r=array_reverse($r);
if($r)foreach($r as $k=>$i){$txt=msql::val('',$nd.'_txt_'.$i,1);
	if($txt)$ret.=lj('','plgtxt_txt,home___'.$i.'_'.$tx,$i.': '.$txt);}
return divc('list',$ret);}

//html
static function area($p,$o,$prm){[$d]=$prm;
if($p=='conn2html')$d=self::act('conn2html','',$prm);
$ret=lj('popbt','txtarea_txt,act_txtareb_23_html2conn',picto('before'));
$ret.=lj('popbt','txtarea_txt,act_txtareb_23_code',picto('code'));
$ret.=diveditbt('').' ';
$ret.=div(atb('contenteditable','true').atd('txtareb').atc('panel').ats('min-height:400px; border:1px dotted silver; margin:2px 0; padding:4px;'),$d);
return $ret;}

static function mkquotes($d){$ret=''; $r=explode("\n",$d);
foreach($r as $k=>$v)if(substr($v,0,4)=='    ')$ret.=tagb('blockquote',trim($v)); else $ret.=trim($v).n();
return $ret;}

//actions
static function act($p,$o,$prm){
[$d,$d1,$d2]=arr($prm,3); $ret='';
switch($p){
case('src'):ses::$urlsrc=$d; if($d)[$t,$ret,$reb]=conv::vacuum($d,'',1); break;
//case('brut'):[$t,$b,$ret]=conv::vacuum($d,''); break;
case('brut'):$ret=get_file($d); break;
case('conn2html'):$d=self::mkquotes($d); $ret=conn::read($d,0,''); break;
case('html2conn'):$ret=conv::call($d); break;
case('code'):$ret=($d); break;
case('cleanmail'):$ret=str::cleanmail($d); break;
case('cleanbr'):$ret=str::clean_br($d); break;
case('deln'):$ret=str::del_n($d); break;
case('striplink'):$ret=codeline::parse($d,'striplink','correct'); break;
case('cleanpunct'):$ret=str::clean_punct($d); break;
case('addlines'):$ret=mc::add_lines($d); break;
case('txt2array'):$ret=buildtable::call($d); break;
case('dump2array'):$ret=buildtable::jb($d); break;
case('replace'):$ret=str_replace($d1,$d2,$d); break;
case('exec'):$ret=exec::run($d); break;
case('entities'):$ret=html_entity_decode($d); break;
case('utf8'):$ret=utf8dec_b($d); break;
case('url'):$ret=urldecode($d); break;
case('lower'):$ret=str::lowercase($d); break;}
return $ret;}

static function repl($p,$o){
$ret=textarea('repla','',15,1).' '.textarea('replb','',15,1).' ';
$ret.=lj('popsav','txtarea_txt,act_txtarea,repla,replb_23_replace','replace');
//$ret.=btj('replace',atjr('replacetxt',['txtarea','repla','replb'])'popbt',);
return $ret;}

static function btact($p,$o){$ret='';
$r=['cleanmail','cleanbr','deln','striplink','cleanpunct','addlines','entities','utf8','url','lower','html2conn','txt2array','dump2array'];
foreach($r as $k=>$v)$ret.=lj('','txtarea_txt,act_txtarea_23_'.$v,$v);
$ret=lj('','popup_converts,home','converts');
$ret.=lj('','popup_connectors,home','conn');
$ret.=lj('','popup_sconn,home','sconn');
$ret.=lj('','popup_vue,home','vue');
if(auth(6))$ret.=lj('','popup_exec,home','exec');
$ret.=toggle('','rpl_txt,repl','replace');
$ret.=lj('','txtarea_converts,act__23_x','x').' ';
$reb=divd('rpl','');
$reb.=inputj('url','','txtarea_txt,act_url_23_src','url');//import
$reb.=lj('popsav','txtarea_txt,act_url_23_src',nms(132)).' ';
$reb.=lj('popbt','txtarea_txt,act_url_23_brut','brut').' ';
$reb.=lj('popbt','wyswyg_txt,area_txtarea_3_conn2html',picto('after'),att('conn2html'));
return divc('nbp',$ret).$reb;}

//call
static function call($n,$b,$prm){$nd=self::log();
if(!$n)$n=msql::findlast('users',$nd,'txt');
msql::modif('users',$nd.'_txt_'.$n,$prm,'one','',1);
return btn('txtyl','ok');}

//mnu
static function btn($d,$nd,$tx){//version,node,
$r=msql::choose('',$nd,'txt'); $nxt=msql::nextnod($r); $ret='';
if($d){$ret.=btd('bck','').' ';
	$ret.=lj('popbt','bck_txt,call_tit,txtarea_xd_'.$d,nms(27)).' ';//save
	$ret.=lj('txtx','plgtxt_txt,call___'.$d.'_'.$tx,$d).' ';//reload
	$ret.=lj('','bck_txt,del__xd_'.$d.'_'.$tx,picto('del'),att(nms(43)));
	$ret.=lj('','plgtxt_txt,home____'.$tx,picto('close'),att(nms(42)));}
if($nd){
	$ret.=lj('','plgtxt_txt,home___'.$nxt.'_'.$tx,picto('add'),att(nms(44)));
	$ret.=togbub('txt,files',$nd.'_'.$tx,picto('smenu'));}
if($d)$ret.=msqbt('',$nd.'_txt_'.$d);
return $ret;}

static function home($d,$tx){$nd=self::log(); $msg='';
if($d)$ra=msql::read('',$nd.'_txt_'.$d,'');
if($d && is_array($ra)){$msg=stripslashes(valr($ra,1,1)); $msg=str::html_entity_decode_b($msg);}
if($d && !$ra && $nd)msql::modif('users',$nd.'_txt_'.$d,['title',''],'one','',1);
$ret=self::paste($d).' ';
if($d)$ret.=input('tit',stripslashes(valr($ra,1,0))).' ';
$ret.=self::btn($d,$nd,$tx).br();
$ret.=div('',edit::bt(''));//ats('width:630px;')
$ret.=div('',self::btact('',''));
$s='width:100%; min-height:360px; padding:4px 8px; margin-top:2px;';
$edt=divc('col1',textarea('txtarea',$msg,44,4,['style'=>$s]));
$edt.=div(atc('col2 tab'),div(atd('wyswyg'),''));
$ret.=divc('grid-pad',$edt);
$ret.=divd('bck','');
Head::add('csscode','
.tab{font-size:large; padding:6px; border:1px dotted silver; max-height:320px; word-wrap:break-word; overflow-y:auto;}
.grid-pad{grid-template-columns:auto 40%;}');
$ret.=jscode('document.getElementById(\'txtarea\').innerHTML=localStorage[\'m1\']');//Head::add('
return btd('plgtxt',$ret);}

}
?>