<?php //tlex
class tlex{

static function post($p,$o,$prm=[]){
$p=$prm[0]??$p;
//require_once('plug/tiers/Telex.php');
$t=new Telex($o);
$ret=$t->post($p,$o);
return divc('txtalert',lk($ret).' '.nms(34).' '.nms(79));}

//philum::articles
static function share($p,$o,$prm=[]){$rid='plg'.randid();
$p=$prm[0]??$p; $suj=ma::suj_of_id($p);
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
	$ret.=lj('popbt',$rid.'_tlex,post_twpost___'.$k,$v[0]).' ';
else $ret.=helps('tlex');
$ret.=span(atd('strcount').atc('txtsmall'),'');
return divd($rid,$ret);}

static function home($p,$o){
$rid=randid('tlx');
ses('nbp',50); $ret='';
if(auth(6))$ret=self::share($p,$o);
return divd($rid,$ret);}
}
?>