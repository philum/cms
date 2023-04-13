<?php 
class score{
static $a=__CLASS__;
static $default='';
static $r=['jdapoll'=>'soutiens','jdatrk'=>'commentaires','approve'=>'approbations','disapprove'=>'désapprobations','nbtags'=>'nombre de tags','tagweight'=>'popularité des tags','nbwords'=>'nombre de mots','wordweight'=>'popularité des mots','likes'=>'likes','faisability'=>'faisabilité','efficiency'=>'efficacité','relevance'=>'pertinence'];//'poll'=>'jugement','agree'=>'appréciation'

static function pivot_array($r){$rb=[];
foreach($r as $k=>$v){foreach($v as $ka=>$va)$rb[$ka][$k]=$va;}
return $rb;}

static function build($ra,$cat){$limit='limit 10000';
//$r=msql::read_b('',nod(self::$a.'_1'));//p($r);
$qda=ses('qda'); $add=ses('qdd'); $qdf=ses('qdf'); $qdt=ses('qdt'); $qdta=ses('qdta');
foreach($ra as $k=>$v){switch($k){
//case('cat'):$r[$k]=sql('id','qdk','kv','frm="'.$v.'"'); break;
case('jdapoll'):$r[$k]=sql('ib,msg','qdd','kv','val="jdapoll" order by cast(msg as unsigned integer) desc '.$limit); break;
case('jdatrk'):$r[$k]=sql('ib,msg','qdd','kv','val="jdatrk" order by cast(msg as unsigned integer) desc '.$limit); break;
case('approve'):$r[$k]=sql('ib,msg','qdd','kv','val="approve" order by cast(msg as unsigned integer) desc '.$limit); break;
case('disapprove'):$r[$k]=sql('ib,msg','qdd','kv','val="disapprove" order by cast(msg as unsigned integer) desc'); break;//no limit
case('nbtags'):$r[$k]=sqb('idart,count(idtag) as nb','qdta','kv','inner join pub_meta on pub_meta.id=pub_meta_art.idtag where cat="tag" group by idart order by nb desc '.$limit); break;
case('tagweight'):$rd=[]; $re=[];
	//nb art by tag
	$rb=sqb('idtag,count(idart) as nb','qdta','kv','inner join pub_meta on pub_meta.id=pub_meta_art.idtag where cat="tag" group by idtag order by nb desc'); //pr($rb);
	//tags pour chaque art
	$rc=sqb('idart,idtag','qdta','kr','inner join pub_meta on pub_meta.id=pub_meta_art.idtag where cat="tag"'); //pr($rc);
	//nombre d'occurrence de chaque tag
	foreach($rc as $kb=>$v)foreach($v as $ka=>$va)$rd[$kb][$va]=$rb[$va]; //pr($rd);
	//célébrité moyenne de chaque tag
	foreach($rd as $kb=>$v)$re[$kb]=array_sum($v)/count($v); //pr($re);
	$r[$k]=$re; break;
case('nbwords'):$r[$k]=sqb('idart,count(idtag) as nb','qdta','kv','inner join pub_meta on pub_meta.id=pub_meta_art.idtag where cat="mot" group by idart order by nb desc '.$limit); break;
case('wordweight'):$rd=[]; $re=[];
	//nb art by tag
	$rb=sqb('idtag,count(idart) as nb','qdta','kv','inner join pub_meta on pub_meta.id=pub_meta_art.idtag where cat="mot" group by idtag order by nb desc'); //pr($rb);
	//tags pour chaque art
	$rc=sqb('idart,idtag','qdta','kr','inner join pub_meta on pub_meta.id=pub_meta_art.idtag where cat="mot"'); //pr($rc);
	//nombre d'occurrence de chaque tag
	foreach($rc as $kb=>$v)foreach($v as $ka=>$va)$rd[$kb][$va]=$rb[$va]; //pr($rd);
	foreach($rd as $kb=>$v)$re[$kb]=array_sum($v)/count($v); //pr($re);
	$r[$k]=$re; break;
case('likes'):$r[$k]=sql('ib,sum(poll) as nb','qdf','kv','type="like" group by ib order by nb desc '.$limit); break;
case('poll'): $r[$k]=sql('ib,avg(poll)','qdf','kv','type="poll" '.$limit); break;
case('agree'): $r[$k]=sql('ib,avg(poll) as nb','kv','kv','type="agree" group by ib order by nb desc '.$limit); break;
case('faisability'):$r[$k]=sql('ib,sum(poll) as nb','qdf','kv','type="Faisabilité" group by ib order by nb desc '.$limit); break;
case('efficiency'):$r[$k]=sql('ib,sum(poll) as nb','qdf','kv','type="Efficacité" group by ib order by nb desc '.$limit); break;
case('relevance'):$r[$k]=sql('ib,sum(poll) as nb','qdf','kv','type="Efficacité" group by ib order by nb desc '.$limit); break;}}
//pr($r);
//pr($r['approve']);

#limit to cats and valid
if($cat)$w=' and frm="'.$cat.'"'; else $w='';
$rok=sql('id','qda','k','re>0'.$w); //pr($rok);
//$ri=array_intersect(array_keys($rd),$rok);
//$rdb=[]; foreach($ri as $k=>$v)$rdb[$v]=$rd[$v]; $rd=$rdb; pr($rd);

#great table
$rc=[];
foreach($ra as $k=>$v)if($r[$k] && $v){$rb=$r[$k];
	$min=min($rb); $max=max($rb); $diff=$max-$min;
	foreach($rb as $ka=>$va)if(isset($rok[$ka])){//
		$res=(($va-$min)/$diff);//*$v
		if($k=='disapprove')$res=1-$res;
		$rc[$ka][$k]=$res;}}
//pr($rc);

//csv-rc
/**/
$re=[]; $rab=['id']; $rab+=$ra; $re[]=array_keys($rab);
foreach($rc as $k=>$v){$re[$k][]=$k;
	foreach($ra as $ka=>$va)$re[$k][]=val($v,$ka);}
$bt=csvfile('scores_rates',$re,'rates','',1);
//pr($re);

#moyenne=somme/qté de coefs (5*2+10*1=20/3)
$rd=[];
$coefs=array_sum($ra); //$nbprm=count($ra);
//foreach($rc as $k=>$v)$rd[$k]=array_sum($v)/$coefs; //pr($rd); //$coefs
foreach($rc as $k=>$v){$re=[];
	foreach($v as $ka=>$va)$re[]=$va*$ra[$ka];
	$rd[$k]=array_sum($re)/$coefs;}//
//pr($rd);

#bornes
$min=min($rd); $max=max($rd); $diff=$max-$min;
foreach($rd as $k=>$v)$rd[$k]=$diff?round((($v-$min)/$diff)*100,2):0;
arsort($rd);
//pr($rd);

#render
//$ret=tabler($rc);
$f='scores_'.normalize(strfrom($cat,') ')).'_'.implode('-',$ra);
$rav=[]; foreach(self::$r as $k=>$v)$rav[$v]=$ra[$k];//french cols
$rb=[]; $rb[]=['config',implode_k($rav,',','=')]; $rb[]=['id','rating'];
foreach($rd as $k=>$v)$rb[]=[$k,$v];
$bt.=csvfile($f,$rb,'csv','',1);

//arts
ses('score',$rd);//get('score','1');
$ret=ma::output_arts($rd,'score','art');
return $bt.divc('content',$ret);}

static function call($p,$o,$ra=[]){
$cat=$ra[0]; unset($ra[0]);
$r=array_combine(array_keys(self::$r),$ra); //p($r);
$ret=self::build($r,$cat);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j=$rid.'_score,call_cat,'; $ret='';
$cats=sql('distinct(frm)','qda','rv',''); array_unshift($cats,'');
$ret.=select(['id'=>'cat'],$cats,'vv','').br();
foreach(self::$r as $k=>$v)$ret.=bar($k,0,10,0,100,'jumphtml','240px').' '.btn('txtx',$v).br();
//$ret=inputj($inpid,$p,$j);
$ret.=lj('',$j.implode(',',array_keys(self::$r)),picto('ok')).' ';
//$ret.=msqbt('',nod(self::$a.'_1'));
return $ret;}

static function home($p,$o){
$rid=randid(self::$a);
$bt=self::menu($p,$o,$rid);
$ret='';
return $bt.divd($rid,$ret);}

}
?>