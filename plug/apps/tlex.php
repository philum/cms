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
$author=sql::inner('tag','qdt','qdta','idtag','v',['cat'=>'auteurs','idart'=>$p]);
if($author)$suj.=', '.ucfirst(nms(88)).' '.$author;
$url=host().urlread($p);
$j=atj('strcount','twpost');
$pr=['onclick'=>$j,'onkeypress'=>$j,'class'=>'console'];
$txt=host().'/'.$p;//$suj."\n\n".//philum
$ret=tag('textarea',['id'=>'twpost','cols'=>50,'rows'=>5,...$pr],$txt).br();
$ret.=btn('popbt',nms(29).' '.nms(152).' :');
$r=msql::read('',ses('qb').'_tlex','',1);
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