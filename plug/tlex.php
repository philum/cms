<?php
//philum_plugin_tlex

class tlex{
public static function headers(){}
}

function tlex_post($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
require_once('plug/tiers/Telex.php'); $t=new Telex($o);
$ret=$t->post($p,$o);
return divc('txtalert',lk($ret).' '.nms(34).' '.nms(79));}

//philum::articles
function tlex_share($p,$o,$res=''){$rid='plg'.randid();
list($p,$o)=ajxp($res,$p,$o); req('spe');
$suj=suj_of_id($p);
$author=sql_inner('tag','qdt','qdta','idtag','v','where cat="auteurs" and idart="'.$p.'"');
if($author)$suj.=', '.ucfirst(nms(88)).' '.$author;
$url=host().urlread($p);
$j=atj('strcount','twpost');
$s=atb('onclick',$j).atb('onkeypress',$j).atc('console');
$txt=host().'/'.$p;//$suj."\n\n".//philum
$ret=bal('textarea',atd('twpost').atb('cols',50).atb('rows',5).$s,$txt).br();
$ret.=btn('popbt',nms(29).' '.nms(152).' :');
$r=msql_read('',ses('qb').'_tlex','',1);
if($r)foreach($r as $k=>$v)
	$ret.=lj('popbt',$rid.'_plug___tlex_tlex*post__'.$k.'_twpost',$v[0]).' ';
else $ret.=helps('tlex');
$ret.=span(atd('strcount').atc('txtsmall'),'');
return divd($rid,$ret);}

function plug_tlex($p,$o){$rid='plg'.randid();
ses('nbp',50);
tlex_header($rid);
$bt=tlex_menu($p,$o,$rid);
if(auth(6))$bt.=tlex_edit($p,$o,$rid);
$ret=tlex_build($p,$o);
return $bt.divd($rid,$ret);}

?>