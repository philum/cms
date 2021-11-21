<?php
//philum_plugin_umtimord

function umtimord_build($p,$o){
$r=sql('id,day,suj,mail','qda','','frm="'.$p.'" order by day ASC');// and re>"0"
if($r)foreach($r as $k=>$v){
	$id=$v[0]; $day=$v[1]; $suj=$v[2];
	$msg=sql('msg','qdm','v','id='.$id);
	//$msg=conn::read($msg,'','');
	$hour=date('H.i',$day);
	$date=date('y.m.d',$day);
	/*$rb=art_tags($id);
	if($rb['info']['favoris']){$nc++; $newtit='['.$d.'-Like '.$nc.'] '.$date;}
	elseif($rb['info']['retweet']){$nd++; $newtit='['.$d.'-Retweet '.$nd.'] '.$date;}
	elseif($rb['info']['status']){$ne++; $newtit='['.$d.'-Status '.$ne.'] '.$date;}
	else{$nb++; $newtit='['.$d.'-'.$nb.'] '.$date;}*/
	$rb[$hour][$date]=[popart($id,$suj),$date,divs('width:400px;',$msg)];
}
if($rb)ksort($rb);
if($rb)foreach($rb as $k=>$v){$rc[]=[$k,'',''];
	foreach($v as $ka=>$va)$rc[]=$va;}
return tabler($rc);}

function umtimord_j($p,$o,$res=''){
req('spe,pop,art');
list($p,$o)=ajxp($res,$p,$o);
$ret=umtimord_build($p,$o);
return $ret;}

function umtimord_menu($p,$o,$rid){
if(!$p)$p='Oyagaa Ayoo Yissaa';//Oomo Toa//oaxiiboo 6//
$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_umtimord_umtimord*j___inp',picto('ok')).' ';
$ret.=hlpbt('umrennum');
return $ret;}

function plug_umtimord($p,$o){$rid=randid('plg');
req('spe,pop,art');
$bt=umtimord_menu($p,$o,$rid);
if($p)$ret=umtimord_build($p,$o);
return $bt.divd($rid,$ret);}

?>