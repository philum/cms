<?php 
class apicom{

static function form($p,$id,$a){$ret='';
$ra=explode_k($p,',',':'); $tgs=prmb(18).' utag';
$ut=explode(' ',$tgs);
if($a==1)foreach($ut as $v)if($v)$rt[$v]='word1|word2';
$r=msql::read('system','edition_apicom');
$rh=msql::kv('lang','edition_apicom');
foreach($r as $k=>$v)if($v[1]==$a)$rt[$k]=$v[0];
foreach($rt as $k=>$v){$val=$ra[$k]??'';
	$pr['onclick']=atjr('apijumptoarea',['inp'.$k,$id]);
	$pr['onkeyup']=atjr('apijumptoarea',['inp'.$k,$id]);
	$pr['placeholder']=$v;
	if($k=='cat')$bt=togbub('hidj','inp'.$k.'_cat_'.ajx($val),'category');
	elseif(strpos($tgs,$k)!==false)$bt=togbub('hidj','inp'.$k.'_tag_'.ajx($val).'_'.ajx($k),$k);
	//select_j('inp'.$k,'tag',$k,$k,'','2');
	elseif($k=='folder')$bt=togbub('hidj','inp'.$k.'_vfld_'.ajx($val).'_'.ajx($k),$k);
	//select_j('inp'.$k,'vfld',$k,$k,'','2');
	else $bt=$k;
	$btn=tag('span',['class'=>'small','title'=>$rh[$k]??''],$bt);
	$ret.=div('',input('inp'.$k,$val,'',$pr).' '.$btn);}
$bt=lj('','apcf_apicom,form___'.ajx($p).'_'.$id.'_'.($a==1?2:1),picto('exchange'));
return $bt.$ret;}

static function build($p,$id,$a=1){
$p=str_replace(';',',',$p);
$ret=self::form($p,$id,$a);
return divb($ret,'cols','apcf');}

static function search($p,$id){//eco($p);
$ra=['search','title','cat','nocat','tag','folder','lang','date','priority'];
$ut=explode(' ',prmb(18).' utag');
foreach($ut as $v)if($v)$r[$v]='word1|word2';
$r=msql::read('system','edition_apicom');
$rb=valk($r,$ra);
return self::form($rb,$p,$id);}

static function call($p,$o,$prm=[]){$p=$prm[0]??$p;
return api::call($p,$o);}

static function area($p,$id){
return tag('textarea',['onclick'=>'apijumptoinputs()','onkeyup'=>'apijumptoinputs()','id'=>$id,'cols'=>64,'rows'=>4],$p);}

static function menu($p,$o,$rid){if($o && $o!=1)$rid=$o; $ret='';
if(!$p)$p='hub:'.ses('qb').',minday:'.ses('nbj').',nbyp:'.prmb(6);
$rb=msql::read('lang','helps_api','',1);
$ret=self::area($p,'inp').' ';
$ret.=lj('',$rid.'_apicom,call_inp',picto('ok')).' ';
$ret.=hlpbt('api').' ';
//$ret.=ljb('','apijumpall',implode_k($r,',',':'),picto('after')).br();
$ret.=divd('loadself','');
$rt=self::build($p,'inp');
$ret.=div(atc('cols').ats('width:620px;'),$rt);
return $ret;}

static function home($p,$o){$rid='plg'.randid();
//Head::add('jscode',self::js($p,$o));
if($o)$bt=self::menu($p,$o,$rid).br();
//else $bt=toggle('',$rid.'2_apicom,menu___'.ajx($p).'_'.$rid,picto('menu'));
else $bt=lj('','popup_apicom,menu___'.ajx($p).'_'.$rid,picto('menu'));
if($p)$ret=self::call($p,''); else $ret='';
return $bt.divd($rid,$ret);}
}
?>