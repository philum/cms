<?php //ummtag from umoay
class umtag{
static function req_arts_y($p){
$qda=$_SESSION['qda']; $qdm=$_SESSION['qdm'];
$qdt=$_SESSION['qdt']; $qdta=$_SESSION['qdta'];
$wh=$qda.'.frm="'.implode('" or '.$qda.'.frm="',explode(',',$p)).'"';
$sql='select distinct '.$qda.'.id,'.$qda.'.day,'.$qda.'.suj,'.$qdm.'.msg,'.$qda.'.frm,'.$qda.'.thm,'.$qda.'.mail from '.$qda.' inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id where '.$wh.' order by day DESC';
return sql::call($sql,'');}

static function list_tags(){//and cat="tag"
return ma::artags('idart,tag','','kk');}

static function msg($msg){
$msg=codeline::parse($msg,'','sconn'); $msg=embed_p($msg); $msg=nl2br($msg);
return $msg;}

static function template(){return '
[[[_URL§_DAY:url]§small:css] [_SUJ§popw:css] _OPEN _SOCIAL:h2]
[_MSG§[track:class]:div]
[:clear][:br]';}

static function build($p,$o){
$tmp=self::template(); $rb=[]; $rd=[];
$r=self::req_arts_y($p); //echo $p; pr($r);
$rtg=self::list_tags(); //p($rtg);
if($r)foreach($r as $k=>$v){[$id,$day,$suj,$msg,$cat,$tag,$lk]=$v;
	//$day=clean_day_tw($day);
	$msg=conn::read($msg,'',''); 
	$lnk=lka(urlread($id)); $pop=lj('','popup_usg,trkplay___'.$id,picto('forum',16));
	$rb[$day]=['suj'=>$suj,'day'=>mkday($day,'Y/m/d'),'msg'=>$msg,'url'=>$lk,'open'=>ma::popart($id).' '.$pop,'rtg'=>val($rtg,$id)];}
krsort($rb); //pr($rb);
if($rb)foreach($rb as $k=>$v){$res=art::mktmp($tmp,$v);
	$rd[nms(100)]=vadd($rd,nms(100),$res); $rc=$v['rtg']; //pr($rc);
	if($rc)foreach($rc as $kb=>$vb)$rd[$kb]=vadd($rd,$kb,$res);}
return tabs($rd);}

static function call($p,$o,$prm=[]){
$p=$prm[0]??'';
return self::build($p,$o);}

static function menu($p,$o,$rid){$ret=input('inp',$p,54).' ';
$ret.=lj('',$rid.'_umtag,call_inp',picto('ok')).br().br();
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$p='Oomo Toa,Oyagaa Ayoo Yissaa';
$bt=self::menu($p,$o,$rid); $ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>