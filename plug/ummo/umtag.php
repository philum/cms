<?php
//philum_plugin_ummtag from umoay

function req_arts_y($p){
$qda=$_SESSION['qda']; $qdm=$_SESSION['qdm'];
$qdt=$_SESSION['qdt']; $qdta=$_SESSION['qdta'];
$wh=$qda.'.frm="'.implode('" or '.$qda.'.frm="',explode(',',$p)).'"';
$sql='select distinct '.$qda.'.id,'.$qda.'.day,'.$qda.'.suj,'.$qdm.'.msg,'.$qda.'.frm,'.$qda.'.thm,'.$qda.'.mail from '.$qda.' inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id where '.$wh.' order by day DESC';
return sql_b($sql,'');}

function list_tags(){//and cat="tag"
return artags('idart,tag','','kk');}

function ummoay_msg($msg){
$msg=codeline::parse($msg,'','sconn'); $msg=embed_p($msg); $msg=nl2br($msg);
return $msg;}

function ummoay_template(){return '
[[[_URL§_DAY:url]§small:css] [_SUJ§popw:css] _OPEN _SOCIAL:h2]
[_MSG§[track:class]:div]
[:clear][:br]';}

function ummoay_build($p,$o){
req('art,pop,spe'); reqp('msqarts');
$tmp=ummoay_template(); $rb=[]; $rd=[];
$r=req_arts_y($p); //echo $p; pr($r);
$rtg=list_tags(); //p($rtg);
if($r)foreach($r as $k=>$v){list($id,$day,$suj,$msg,$cat,$tag,$lk)=$v;
	//$day=clean_day_tw($day);
	$msg=conn::read($msg,'',''); 
	$lnk=lka(urlread($id)); $pop=lj('','popup_trckpop___'.$id,picto('forum',16));
	$rb[$day]=['suj'=>$suj,'day'=>mkday($day,'Y/m/d'),'msg'=>$msg,'url'=>$lk,'open'=>popart($id).' '.$pop,'rtg'=>val($rtg,$id)];}
krsort($rb); //pr($rb);
if($rb)foreach($rb as $k=>$v){$res=template_build($tmp,$v);
	$rd[nms(100)]=vadd($rd,nms(100),$res); $rc=$v['rtg']; //pr($rc);
	if($rc)foreach($rc as $kb=>$vb)$rd[$kb]=vadd($rd,$kb,$res);}
return make_tabs($rd);}

function ummoay_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
return ummoay_build($p,$o);}

function ummoay_menu($p,$o,$rid){$ret=input1('inp',$p,54).' ';
$ret.=lj('',$rid.'_plug__2_ummoay_ummoay*j___inp',picto('ok')).br().br();
return $ret;}

function plug_umtag($p,$o){$rid='plg'.randid();
$p='Oomo Toa,Oyagaa Ayoo Yissaa';
$bt=ummoay_menu($p,$o,$rid); $ret=ummoay_j($p,$o);
return $bt.divd($rid,$ret);}

?>