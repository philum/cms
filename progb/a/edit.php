<?php
class edit{

//conn_error
static function correct($v){
$ca=substr_count($v,'['); $cb=substr_count($v,']');
if($ca>$cb){$nb=$ca-$cb; $t='"]"';}
elseif($ca<$cb){$nb=$cb-$ca; $t='"["';}
if(isset($nb))return btn('txtyl',$nb.$t.'missing');}

static function urledt($id){$b=rstr(18)?'public':$_SESSION['qb']; 
$u=is_numeric($id)?ma::rqt($id,'mail'):$id; [$k]=conv::verif_defcon($u);//
return lj('','popup_msqa,editmsql___users/'.$b.'*defcons_'.ajx($k).'_'.ajx($u),picto('config'));}

//menus
static function icon($v){$rp=sesmk('msqmimes','',0);//pictos
$r=['h'=>'big','b'=>'b','i'=>'i','u'=>'u','k'=>'strike','l'=>'small']; if(isset($r[$v]))return tagb($r[$v],$v);
if($v=='stabilo')return btn('stabilo',$v); elseif($v=='red')return bts('color:#d03b39',$v);
elseif($v=='c')return btn('txtclr',$v); elseif($v=='quo')return '&raquo;'; elseif($v=='qu')return '&raquo;';
else if($v=='nbsp')return '&#9141;'; //if($v=='--')return '&#9188;';
return isset($rp[$v])?picto($rp[$v],'16'):$v;}

static function props($id){$ret='';
$r=['html','arts','media','tools','filters','del','backup','ascii','pictos','oomo'];//,'disk','msql','codeline'
foreach($r as $k=>$v)$ret.=togbub('mc,navs',$v.'_'.$id,$v);
$ret.=lj('','popup_mc,navs___disk_','disk');
//$r=['icons','glyphs']; foreach($r as $k=>$v)$ret.=bubble('','mc,navs',$v.'_'.$id,$v);
$ret.=togbub('mc,navs','uc_'.$id,'uc');//togbub('mc,navs','sc_'.$id,'sc')
$ret.=lj('','popup_connectors,home_txtarea',picto('conn',16));
$ret.=lj('','popup_keyboard,call_txtarea',picto('keyboard',16));
return $ret.divd('edtbt','');}

static function bt($id){$ret='';
$r=msql::read('system','connectors_basic','',1);
$rh=msql::kv('lang','connectors_basic','',1);
if(ses('USE'))$ret=self::props($id);//rid used for mc,conns
foreach($r as $k=>$v){$txt=self::icon($k); $rid=''; if($k=='nl')$v[1]='\n';
	if($v[0]=='embed'){if($v[1])$v[0]='embedslct'; else $v[1]=$k; $rid=randid();}
	$ret.=btd('bt'.$rid,ljb('',$v[0],[$v[1],$rid,$id],$txt,att($rh[$k])));}
return divc('nbp',$ret.divd('scb',''));}

static function com($f,$o,$prm=[]){$u=vacurl($f);
$_SESSION['vac'][$u]['u']=$f; $_SESSION['vac'][$u]['b']=$prm[0];
return self::artform($f,'');}

//f
static function artform($link,$id){ses::$r['curdiv']='content'; $ip=hostname();
$USE=ses('USE'); $frm=ses('frm'); $suj=''; $msg=''; $alrt=''; $rid=randid('edt');
if($USE)$us=$USE; else [$us,$ml]=sql('name,mail','qdi','r','host="'.$ip.'" order by id desc limit 1');
if(!$frm)$frm='public';
if(!$id && $link && substr($link,0,4)=='http'){$link=nohttps(utmsrc($link));//vacuum
	ses::$urlsrc=$link; [$suj,$msg]=conv::vacuum($link,'');}
if(!$id)$r['urlsrc']=inputb('urlsrc',$link,16,'url','255',['onclick'=>atj('SaveI','urlsrc'),'onContextMenu'=>'SaveIt()']).btd('urledt','');
if($USE && !$id){
	$r['trkname']=hidden('trkname',$USE).hidden('trkmail','');
	$r['slcat']=select_j('frm','cat',$frm,'3',$frm,'');}
elseif(!$USE){$gn='" onkeyup="log_goodname(\'trkname\');';
	$r['trkname']=inputb('trkname'.$gn,$us,8,nms(38),'50');
	$r['trkmail']=inpmail('trkmail',$ml);}//mail
if(!$id)$r['parent']=select_j('addib','parent',rstr(10)?ses('read'):'',0,picto('topo'),1);
if(!$id && auth(3))$r['publish']=checkbox_j('pub',$_SESSION['auth']<4?0:rstr(11),nms(29));
else $r['publish']=hidden('pub',0);
if(!$id){//new
	$r['pstdat']=inpdate('pdat',date('Y-m-d\TH:i'),'2000-01-01T00:00','2040-01-01T00:00',1);
	$r['pstsuj']=inputb('suj1',$suj,'',nms(71),250,['name'=>'suj','class'=>'editor','style'=>'width:99%;']);}
if($id){$msg=sql('msg','qdm','v',$id); $alrt=self::correct($msg);}
$msg=str_replace("\r",'',$msg);//msg
$msg=str_replace(["<br />\n",'<br />','<br>'],"\n",$msg);//save
$ids='suj1,frm,urlsrc,pdat,trkname,trkmail,addib,pub';//,sub
if($id){$sav=lj('popbt','art'.$id.'_sav,editart_txtarea_id4_'.$id,picto('save'));
	$sav.=lj('popsav','txarea,art'.$id.'_sav,editart_txtarea_id4_'.$id.'_1',nms(27));}
else $sav=lj('popsav','socket_sav,createart_txtarea,'.$ids.'_'.(rstr(57)?7:9),nms(27));
//$btdt.=ljb('','captslct','preview',picto('view'),att('preview selection')).' ';
//$btdt.=lj('',$rid.'_mc,wygedt_txtarea__'.$id.'_txtarea',picto('artedit'));
$btdt=ljb('','edtmode',[$rid,$id],picto('artedit'),'edtmd').' ';
if($id)$btdt.=self::urledt($id);//defcon//sav::urledt($link)
$ret=$sav.btd('bts'.$id,'').' '.$btdt;
$ret.=implode('',$r);
$btd=sesmk2('edit','bt',$id,0).$alrt;
$btd.=divd('txarea',txarea1($msg));
$ret.=divd($rid,$btd);
//if(auth(4))$ret.=checkbox("randim","ok","rename_img",0);
return $ret;}

}
?>