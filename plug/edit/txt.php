<?php
//philum_app_txt

class txt{

static function log(){return $_SESSION['auth']>6?$_SESSION['qb']:$_SESSION['USE'];}

static function del($d){$nd=self::log();
if($d)unlink('msql/users/'.$nd.'_txt_'.$d.'.php');
return btn('txtyl','deleted');}

static function paste($d){$ret=hidden('','cka','m'.$d);
$ret.=ljb('','mem_storage','txtarea_m1___cka0',picto('save2'),'cka1',att(nms(57))).' ';
$ret.=ljb('','mem_storage','txtarea_m1_1__ckb0',picto('refresh'),'ckb1',att(nms(95))).' ';
//$ret.=hlpbt('memstorage');
return btn('nbp',$ret).' ';}

static function files($nd,$tx){$ret='';
$r=msql::choose('',$nd,'txt'); if($r)asort($r); $r=array_reverse($r);
if($r)foreach($r as $k=>$i){$txt=msql::val('',$nd.'_txt_'.$i,1);
	if($txt)$ret.=lj('','plgtxt_txt,home___'.$i.'_'.$tx,$i.': '.$txt);}
return divc('list',$ret);}

//html
static function area($p,$o,$res){
if($p=='conn2html')$d=self::act('conn2html','',$res); else $d=ajxg($res);
$ret=lj('popbt','txtarea_txt,act__23_html2conn____txtareb',picto('before'));
$ret.=lj('popbt','txtarea_txt,act__23_code____txtareb',picto('code'));
$ret.=diveditbt('').' ';
$ret.=div(atb('contenteditable','true').atd('txtareb').atc('panel').ats('min-height:400px; border:1px dotted silver; margin:2px 0; padding:4px;'),$d);
return $ret;}

static function mkquotes($d){$ret=''; $r=explode("\n",$d);
foreach($r as $k=>$v)if(substr($v,0,4)=='    ')$ret.=balb('blockquote',trim($v)); else $ret.=trim($v).n();
return $ret;}

//actions
static function act($p,$o,$res){
req('pop,spe'); $ret='';
if($p=='replace')$r=ajxr($res); else $d=ajxg($res);
switch($p){
case('src'):$_GET['urlsrc']=$d; if($d)list($t,$ret,$reb)=conv::vacuum($d,'',1); break;
//case('brut'):list($t,$b,$ret)=conv::vacuum($d,''); break;
case('brut'):$ret=get_file($d); break;
case('conn2html'):$d=self::mkquotes($d); $ret=conn::read($d,0,''); break;
case('html2conn'):$ret=conv::call($d); break;
case('code'):$ret=($d); break;
case('cleanmail'):$ret=cleanmail($d); break;
case('cleanbr'):$ret=clean_br($d); break;
case('deln'):$ret=del_n($d); break;
case('striplink'):$ret=codeline::parse($d,'striplink','correct'); break;
case('cleanpunct'):$ret=clean_punct($d); break;
case('addlines'):$ret=add_lines($d); break;
case('buildarray'):$ret=plugin_func('table2array','table2array_build',$d); break;
case('txt2array'):$ret=plugin_func('buildtable','buildtable_j',$d); break;
case('dump2array'):$ret=plugin_func('buildtable','buildtable_jb',$d); break;
case('replace'):list($ret,$d1,$d2)=$r; $ret=str_replace($d1,$d2,$ret); break;
case('exec'):$ret=exec::run($d); break;
case('entities'):$ret=html_entity_decode($d); break;
case('utf8'):$ret=utf8_decode($d); break;
case('url'):$ret=urldecode($d); break;
case('lower'):$ret=lowercase($d); break;}
return $ret;}

static function btact($p,$o){$ret='';
$j='txtarea_txt,act__23_';
$r=['cleanmail','cleanbr','deln','striplink','cleanpunct','addlines','entities','utf8','url','lower','html2conn','txt2array','dump2array'];
foreach($r as $k=>$v)$ret.=lj('',$j.$v.'____txtarea',$v);
//$ret.=lj('txtx','popup_plup__2_buildtable_buildtable*j___txtarea','txt2array');
//$ret.=lj('txtx','popup_plup__2_buildtable_buildtable*jb___txtarea','dump2array');
//$ret.=lj('','popup_plup___buildtable____txtarea','buildtable').' '
$ret.=self::convbt();
$reb=textarea('repla','',15,1).' '.textarea('replb','',15,1).' ';
//$reb.=lj('popsav',$j.'replace____txtarea|repla|replb','replace');
$reb.=lja('popbt',atj('replacetxt','txtarea'),'replace').br();
$reb.=inputj('url','url',$j.'src____url','','1');//import
//$reb.=lj('popbt','txtarea_app__3_mercury_callxt___url',nms(132)).' ';
$reb.=lj('popsav',$j.'src____url',nms(132)).' ';
$reb.=lj('popbt',$j.'brut____url','brut').' ';
$reb.=lj('popbt','wyswyg_txt,area___conn2html____txtarea',picto('after'),att('conn2html'));
return divc('nbp',$ret).$reb;}

//conv
static function conv($p,$o,$res){$ret=ajxg($res);
return converts::act($ret,$p,$o);}

static function convbt(){
//$j='txtarea_txt,conv__23_';
$j='txtarea_converts,act__23_'; $ret='';
$r=['unescape','base64','ascii','binary','bin/dec','timestamp','php'];//'utf8','htmlentities','url',
//foreach($r as $v)$ret.=lj('',$j.$v.'_1_txtarea',$v);//.lj('',$j.$v.'__txtarea','-').' '
//$ret=select(atd('cnv'),$r,'vv',''); $ret.=lj('popsav',$j.'__1_txtarea','exec').' ';
$ret.=lj('txtx','popup_converts,home','converts');
$ret.=lj('txtx','popup_plup___connectors','conn');
$ret.=lj('txtx','popup_plup___sconn','sconn');
if(auth(6))$ret.=lj('txtx','popup_exec,home','exec');
$ret.=lj('txtx',$j.'x','x').' ';
return $ret;}

//call
static function call($n,$b,$res){$nd=self::log(); $rb=ajxr($res);
$rb[1]=html_entity_decode_b($rb[1]??'');
if(!$n)$n=msql::findlast('users',$nd,'txt');
msql::modif('users',$nd.'_txt_'.$n,$rb,'one','',1);
return btn('txtyl','ok');}

//mnu
static function btn($d,$nd,$tx){//version,node,
$r=msql::choose('',$nd,'txt'); $nxt=msql::nextnod($r); $ret='';
if($d){$ret.=btd('bck','').' ';
	$ret.=btd('bts',lj('popbt','bck_txt,call_tit,txtarea_xd_'.$d,nms(27))).' ';//save
	$ret.=lj('txtx','plgtxt_txt,call___'.$d.'_'.$tx,$d).' ';//reload
	$ret.=lj('','bck_txt,del__xd_'.$d.'_'.$tx,picto('del'),att(nms(43)));
	$ret.=lj('','plgtxt_txt,home____'.$tx,picto('close'),att(nms(42)));}
if($nd){
	$ret.=lj('','plgtxt_txt,home___'.$nxt.'_'.$tx,picto('add'),att(nms(44)));
	//$ret.=lj('','popup_txt,files___txt_'.$nd.'_'.$tx,picto('window'),att(nms(25)));
	$ret.=togbub('txt,files',$nd.'_'.$tx,picto('smenu'));}
if($d)$ret.=msqbt('',$nd.'_txt_'.$d);
//$ret.=lj('popsav','wyswyg_txt,area___conn2html____txtarea',picto('valid'),att('conn2html'));
//$ret.=lj('','popup_plup___txt_stx*area',picto('code'),att('wyswyg'));
return $ret;}

static function home($d,$tx){$nd=self::log(); req('art'); $msg='';
if($d)$ra=msql_read('',$nd.'_txt_'.$d,'');
if($d && is_array($ra)){$msg=stripslashes(valr($ra,1,1)); $msg=html_entity_decode_b($msg);}
if($d && !$ra && $nd)msql::modif('users',$nd.'_txt_'.$d,['title',''],'one','',1);
$ret=self::paste($d).' ';
if($d)$ret.=input1('tit',stripslashes(valr($ra,1,0))).' ';
$ret.=self::btn($d,$nd,$tx).br();
$ret.=div('',conn_edit(''));//ats('width:630px;')
$ret.=div('',self::btact('',''));
$s=ats('width:100%; min-height:360px; padding:4px 8px; margin-top:2px;');
$edt=divc('col1',textarea('txtarea',$msg,44,4,$s));
$edt.=div(atc('col2 tab'),div(atd('wyswyg'),''));
$ret.=divc('grid-pad',$edt);
$ret.=divd('bck','');
Head::add('csscode','
.tab{font-size:large; padding:6px; border:1px dotted silver; max-height:320px; word-wrap:break-word; overflow-y:auto;}
.grid-pad{grid-template-columns:auto 40%;}');
$ret.=js_code('document.getElementById(\'txtarea\').innerHTML=localStorage[\'m1\']');//Head::add('
return btd('plgtxt',$ret);}

}

?>