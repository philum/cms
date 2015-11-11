<?php
//philum_plugin_ummoay

function req_arts_y($p){
$qda=$_SESSION['qda']; $qdm=$_SESSION['qdm']; $qdi=$_SESSION['qdi'];
$wh=$qda.'.frm="'.implode('" or '.$qda.'.frm="',explode(',',$p)).'"';
$sql='select '.$qda.'.id,'.$qda.'.suj,'.$qdm.'.msg,'.$qda.'.frm,'.$qdi.'.msg,'.$qda.'.thm
from '.$qda.' 
inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id  
inner join '.$qdi.' on '.$qdi.'.frm='.$qda.'.id 
where '.$wh.' 
order by '.$qda.'.day ASC';
return sql_b($sql,'','1');}

function ummoay_msg($msg){
$msg=delconn($msg);
$msg=miniconn($msg);
//$msg=embed_links($msg);
//$msg=format_txt($msg,'','');
$msg=correct_txt($msg,'','sconn');
$msg=nl2br($msg);
return $msg;}

function ummoay_template(){return '
[[[_URL§_DAY:url]§txtx:css] _SUJ [_OPEN§txtx:css] _SOCIAL§h2:balise]
[_TRACKS§[bkg:class]:div]
[_MSG§[track:class]:div][:hr][:br]';}

function ummoay_build($p,$o){
connect(); req('art,tri,pop,spe'); reqp('msqarts');
$tmp=ummoay_template();
$r=req_arts_y($p); //p($r);
if($r)foreach($r as $k=>$v){list($id,$day,$msg,$cat,$idy,$tag)=$v;
//if(strpos($day,':'))$day=clean_day_tw($day); else $day=clean_day($day);
$day=clean_day_tw($day); //echo $day.br();
list($msg,$tw)=clean_msg($msg); list($idy,$twb)=clean_msg($idy);
$msg=ummoay_msg($msg);$idy=ummoay_msg($idy); $lnk=lka(urlread($id)); $pop=popart($id,'url',$id);
$rb[$day]=array('suj'=>$cat,'day'=>mkday($day),'msg'=>$msg,'tracks'=>$idy,'url'=>urlread($id),'open'=>$pop,'social'=>lka($tw,picto('tw')),'tag'=>$tag);}
ksort($rb);
foreach($rb as $k=>$v){$rc=tri_tag($v['tag']);
	foreach($rc as $vb)$rd[$vb].=template_build($tmp,$v);}
//foreach($rb as $k=>$v)$ret.=template_build($tmp,$v);
return make_tabs($rd);}

function ummoay_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
return ummoay_build($p,$o);}

function ummoay_menu($p,$o,$rid){$ret.=input(1,'inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_ummoay_ummoay*j___inp',picto('reload')).' ';
return $ret;}

function plug_ummoay($p,$o){$rid='plg'.randid();
$p='Oaxiiboo 6,Oolga Waam,Oomo Toa,Oyagaa Ayoo Yissaa';
$bt=ummoay_menu($p,$o,$rid); $ret=ummoay_j($p,$o);
//$bt.=msqlink('',ses('qb').'_ummoay');
return $bt.divd($rid,$ret);}

?>