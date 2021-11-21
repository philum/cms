<?php
//philum_plugin_umlikes

function umlikes_build($p,$o){
$qda=ses('qda'); $qdm=ses('qdm'); $qdi=ses('qdi'); $qdta=ses('qdta');
$idtag=sql('id','qdt','v',['tag'=>'favoris']);
if($p=='All')$p='Oaxiiboo 6,Oolga Waam,Oomo Toa,Oyagaa Ayoo Yissaa';
$wh=$qda.'.frm in ("'.implode('","',explode(',',$p)).'")';
$sql='select '.$qda.'.id,day,name,suj,'.$qdm.'.msg,mail,lg from '.$qda.' 
inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id 
inner join '.$qdta.' on '.$qdta.'.idart='.$qda.'.id and '.$qdta.'.idtag='.$idtag.' 
where '.$wh.' order by day asc';
return sql_b($sql,'',0);}

function umlikes_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); $ret=[]; req('pop,art,spe');
$r=umlikes_build($p,$o); $lang='es';
if($r)foreach($r as $k=>$v){
	list($id,$day,$nam,$suj,$msg,$lk,$lg)=$v;
	if($lg!=$lang)$msb=yandex::callum('art'.$id,$lang.'-'.$lg,2); else $msb='';
	$msg=codeline::parse($msg,'','sconn');//conn::read($msg,3);
	$msb=codeline::parse($msb,'','sconn');
	$dt=lka($lk,date('d/m/Y',$day));
	$suj=substr($suj,1,-1);
	$ret[]=[$suj,'@'.$nam.' '.$dt.br().$msg,$msb];}
$ret=tabler($ret);
$f='_datas/umlikes.htm'; write_file($f,$ret); $bt=lk($f);
return $bt.$ret;}

function umlikes_r(){//option/value
return ['Oyagaa Ayoo Yissaa'=>'OAY','Oomo Toa'=>'OT'];}

function umlikes_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','umlikes/umlikes_r','','2');
//$ret.=togbub('plug','umlikes_umlikes*r',btn('popbt','select...'));
$j=$rid.'_plug__2_umlikes_umlikes*j__'.$rid.'_inp';
$ret.=inputj('inp',$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
//$ret.=lj('','popup_plupin___msqedit_umlikes*1_id,val',picto('edit')).' ';
return $ret;}

function plug_umlikes($p,$o){$rid=randid('plg');
$bt=umlikes_menu($p,$o,$rid);
$ret=$p?umlikes_j($p,$o):'';
return $bt.divd($rid,$ret);}

?>