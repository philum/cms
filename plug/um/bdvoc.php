<?php //bdvoc
class bdvoc{

static function sav($v,$o){//echo $p.'-'.$o;
[$id,$pos]=explode('-',$o);
$idvoc=umwords::ex($v);//
if(!$idvoc){$idvoc=sql::sav('qdvoc',['voc'=>$v]); $ret='saved '.$v.' ';}
else $ret='word exists ';
$ex=umwords::exart($idvoc,$id,$pos);//
if($idvoc && !$ex){$rb=['idvoc'=>$idvoc,'idart'=>$id,'pos'=>$pos];
	$nid=sql::sav('qdvoc_b',$rb);}
else return 'already exists';
return $ret.'added in '.$idvoc.'-'.$nid;}

static function play($r,$p,$o){static $i; $i++;
if($i==1)$rb[]=['vocable','context','lang','ref','0'];
if($r)foreach($r as $k=>$v){
	[$id,$voc,$idart,$ref,$sound,$txt,$lg]=$v; $voc=trim($voc);
	$lv=levenshtein($p,$voc);
	//$lk=ma::popart($idart,$ref);
	$lk=lj('','popup_art,look___'.$idart.'_'.ajx($voc).'_1',pictxt('article',$ref));
	$bt=lj('txtx','popup_bdvoc,see___'.ajx($voc).'_',$voc);
	if(auth(6))$edt=lj('','popup_sqledt___bdvoc_'.$id,picto('editxt'));
	$rb[]=[$bt,$txt,$lg,$lk,$lv,$edt];}
if($o){foreach($rb as $k=>$v)$rc[$v[4]][]=$k; ksort($rc); //p($rc);
	foreach($rc as $k=>$v)foreach($v as $kb=>$vb)$rd[]=$rb[$vb]; $rb=$rd;}
return $rb;}

//soundex,metaphone,levenshtein
static function see($p,$o,$prm=[]){
$rid='bdv'.randid();
ses('bdvoc','bdvoc');
$p=$prm[0]??$p;
if($o){$sound=sql('sound','bdvoc','v','voc="'.$p.'"');
	if(!$sound)$sound=soundex($p); $wh='sound="'.$sound.'"';}
else $wh='voc="'.$p.'"';//.' and lang="'.ses('lang').'"'
$r=sql('id,voc,idart,ref,sound,txt,lang','bdvoc','rr',$wh); //p($r);
if(!$r)$r=sql('id,voc,idart,ref,sound,txt,lang','bdvoc','rr','voc like "%'.$p.'%"');
$rb=self::play($r,$p,$o); $n=count($rb)-1;
$ret=btn('txtx',$n.' '.plurial($n,16)).' ';
//$ret.=lj('',$rid.'_bdvoc,see_-15_'.ajx($p).'_1_',picto('sound'));
$ret.=tabler($rb,1);
return divd($rid,$ret);}

static function build($p,$o){
$ratio=50; $min=($o-1)*$ratio; $wh=$o?'limit '.$limit=$min.', '.($min+$ratio):'';
$r=sqb('id,voc,lang,sound','bdvoc','rr','group by voc order by voc '.$wh);
if($r)foreach($r as $k=>$v){
	[$id,$voc,$lg,$sd]=$v;
	//$lk=ma::popart($idart,$ref);
	$bt=lj('txtx','popup_bdvoc,see___'.ajx($voc).'__',$voc);
	//$edt=lj('','popup_bdvoc,sav__xx_'.$id.'_'.ajx($voc).'_',picto('editxt'));
	$rb[]=[$lg,$bt];}//,$sd,soundex($voc)
return $rb;}

static function pg($p,$o){
$n=sqb('count(distinct(voc))','bdvoc','v','');
$ret=pop::btpages(50,$o?$o:1,$n,'bdv_bdvoc,call___'.ajx($p).'_');
return $ret;}

static function call($p,$o,$prm){
$p=$prm[0]??$p;
$r=self::build($p,$o);
$ret=self::pg($p,$o);
$ret.=tabler($r);
return $ret;}

static function menu($p,$o,$rid){
$j=$rid.'_bdvoc,see_inpbdv_1';
$ret=inputj('inpbdv',$p,$j).' ';
$ret.=lj('',$j,picto('ok')).' ';
$ret.=lj('',$rid.'_bdvoc,see_inpbdv_1',pictxt('sound',nms(179))).' ';
//$n=sqb('count(distinct(voc))','bdvoc','v','');
//$ret.=btn('txtxt',$n.' vocables').' ';
return $ret;}

static function arts(){
$r=sql('id,ref','bdvoc','kv','idart=0');
if($r)foreach($r as $k=>$v){
	$id=sql('id','qda','v','suj like "%['.$v.']%" and re="1" and lg="fr"');
	if($id){sql::upd('bdvoc',['idart'=>$id],$k); echo $v.':'.$id.'-';}}
return count($r);}

static function home($p,$o){$rid='bdv';
ses('bdvoc','bdvoc');
$bt=self::menu($p,$o,$rid);
//if(auth(6))echo self::arts();
if($p)$ret=self::see($p,$o);
else $ret='';//self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>