<?php
//philum_plugin_ummoay

function req_arts_y($p){
$qda=$_SESSION['qda']; $qdm=$_SESSION['qdm']; $qdi=$_SESSION['qdi'];
$qdt=$_SESSION['qdt']; $qdta=$_SESSION['qdta'];
$wh=$qda.'.frm="'.implode('" or '.$qda.'.frm="',explode(',',$p)).'"';
$sql='select distinct '.$qda.'.id,'.$qda.'.suj,'.$qdm.'.msg,'.$qda.'.frm,'.$qda.'.thm,'.$qda.'.mail from '.$qda.' 
inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id  
where '.$wh.' 
order by day DESC';//group by '.$qda.'.id 
return sql_b($sql,'');}

function list_tags(){
return artags('idart,tag','and cat="tag"','kk');}

function req_art_track($id){
return sql('msg','qdi','v','frm="'.$id.'" order by day ASC');}

function ummoay_msg($msg){
$msg=correct_br($msg); $msg=miniconn($msg);
$msg=correct_txt($msg,'','sconn'); $msg=embed_p($msg); $msg=nl2br($msg);
//$msg=delconn($msg);//$msg=embed_links($msg);
//$msg=format_txt($msg,'','');
//$msg=correct_txt($msg,'','sconn');
//$msg=nl2br($msg);
return $msg;}

function ummoay_template(){return '
[[[_URL§_DAY:url]§txtx:css] [_SUJ§txtblc:css] _OPEN _SOCIAL§h2:balise]
[_TRACKS§[track bkg:class]:div]
[_MSG§[track:class]:div][:clear][:br]';}

function ummoay_build($p,$o){
req('art,tri,pop,spe'); reqp('msqarts');
$tmp=ummoay_template();
$r=req_arts_y($p); //p($r);
$rtg=list_tags(); //pr($rtg);
if($r)foreach($r as $k=>$v){list($id,$day,$msg,$cat,$tag,$lk)=$v;
//if(strpos($day,':'))$day=clean_day_tw($day); else $day=clean_day($day);
$day=clean_day_tw($day); //echo $day.br();
//list($msg,$tw)=clean_msg($msg); list($idy,$twb)=clean_msg($idy);
$msg=format_txt($msg,'',''); 
$lnk=lka(urlread($id)); $pop=popart($id,'articles').' '.lka(urlread($id),picto('link'));
$idy=req_art_track($id); $idy=ummoay_msg($idy);
$rb[$day]=array('suj'=>$cat,'day'=>mkday($day,'Y/m/d'),'msg'=>$msg,'tracks'=>$idy,'url'=>urlread($id),'open'=>$pop,'social'=>lka($lk,picto('tw')),'tag'=>$rc=$rtg[$id]);}
krsort($rb);
foreach($rb as $k=>$v){
	$rd[nms(100)].=template_build($tmp,$v);
	$rc=$v['tag']; //p($rc);
	if($rc)foreach($rc as $kb=>$vb)$rd[$kb].=template_build($tmp,$v);}
//foreach($rb as $k=>$v)$ret.=template_build($tmp,$v);
return make_tabs($rd);}

function ummoay_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
return ummoay_build($p,$o);}

function ummoay_menu($p,$o,$rid){$ret.=input(1,'inp',$p,'','','54').' ';
$ret.=lj('',$rid.'_plug__2_ummoay_ummoay*j___inp',picto('reload')).br().br();
return $ret;}

function plug_umoay($p,$o){$rid='plg'.randid();
$p='Oomo Toa,Oyagaa Ayoo Yissaa';
$bt=ummoay_menu($p,$o,$rid); $ret=ummoay_j($p,$o);
//$bt.=msqlink('',ses('qb').'_ummoay');
return $bt.divd($rid,$ret);}

?>