<?php
//philum_app_jda

class jda{
static $a=__CLASS__;
static $default='';

static function build($p,$o){
//$r=msql::read_b('',nod(self::$a.'_1'));//p($r);
$ret=$p.'-'.$o;
return $ret;}

static function cats(){ses('qdc','pub_cat');
$cats=[2=>"Métro, boulot, robot : quel monde du travail voulons-nous ?",
3=>"A consommer avec modération : vers une société de la sobriété ?",
4=>"Des liens plutôt que des biens: comment retisser des solidarités ?",
5=>"Éducation et jeunesse : comment construire une société apprenante ?",
6=>"L’homme face à la machine : peut-on humaniser le numérique ?",
7=>"Une démocratie plus ouverte : comment partager le pouvoir ?",
8=>"L’avenir de nos territoires : quel nouveau contrat pour les renforcer et préserver leur diversité ?",
9=>"L’Europe dans le monde” : comment recréer une solidarité européenne et internationale ?",
11=>"Notre richesse est invisible: comment mieux évaluer le bien-commun ?",
12=>"Le nerf de la guerre : quel financement & quel nouveau partage des richesses",
13=>'Hackathon',
15=>'Autres thèmes',
16=>"Le plus important, c’est la santé : quel système de santé demain ?"];
foreach($cats as $k=>$v)sqlsavi('qdc',[$k,$v,1],1);} 

static function import(){
$r=sql_b('select * from jdap ',''); //pr($r);
$rk=sql_b('select COLUMN_NAME,DATA_TYPE from INFORMATION_SCHEMA.COLUMNS where table_name="jdap"','kv');
//pr($rk);
$cats=[2=>'2) Travail',3=>'3) Consommation',4=>'4) Social',5=>'5) Education',6=>'6) Numérique',7=>'7) Démocratie',8=>'8) Territoires',9=>'9) Europe',11=>'10) Communs',12=>'11) Economie',13=>'13) Hackathon',15=>'12) Autres',16=>'1) Santé'];
req('spe'); $max=lastid('qda'); if(!$max)$max=0; echo $max.': ';
$rb=[]; $rc=[]; $rd=[];	
foreach($r as $k=>$v){
	list($id,$ida,$catid,$suj,$msg,$votes,$voters,$nbcomments,$date,$source)=$v;
	if($ida>$max){
		$frm=$cats[$catid];
		//$msg=conv::call($msg);
		$msg=embed_links($msg);
		$time=strtotime($date); $sz=strlen($msg); $suj=stripslashes($suj);
		$rb[]=[$ida,'','',$source,$time,'gov',$frm,$suj,1,0,'','',$sz,''];
		sqlsav('qdd',[$ida,'jdapoll',$votes]);
		sqlsav('qdd',[$ida,'jdatrk',$nbcomments]);
		$rc[]=[$ida,$msg];}
	else{
		sqlup2('qdd',['msg'=>$votes],['ib'=>$ida,'val'=>'jdapoll']);
		sqlup2('qdd',['msg'=>$nbcomments],['ib'=>$ida,'val'=>'jdatrk']);}
}
//pr($rb);
if($rb)sqlsav2('qda',$rb); if($rc)sqlsav2('qdm',$rc);
$n=count($rb); $ret=$n;
//if($n>100)$r=array_chunk($r,100);
//$ret=tabler($r);
return $ret;}

static function reapply(){
req('meta,spe,art');
$n=1; $l=300; $max=$l*$n; $min=$max-$l; $limit='limit '.$min.','.$max;
$r=sqb('tag,cat','qdt','kv',$limit); $rn=[]; //pr($r);
foreach($r as $k=>$v){
	//'search_t%C3%A9l%C3%A9travail__----1&res=___'
	search::home($k,'','----1','');
	//'socket_savtagall__xc_mot_télétravail_télétravail'
	$rn[]=savtagall($v,$k,$k);
}
if(!$rn)return 'nothing';
return array_sum($rn);}

static function emblnk(){req('tri');
$r=sql('id,msg','qdm','kv','');
foreach($r as $k=>$v){$msg=embed_links($v); update('qdm','msg',$msg,'id',$k);}
return count($r);}

static function scores(){
$r=sql_b('select * from jdap ',''); 
foreach($r as $k=>$v){
	list($id,$ida,$catid,$suj,$msg,$votes,$voters,$nbcomments,$date,$source)=$v;
	//sqlsav('qdd',[$ida,'jdapoll',$votes]);
	//sqlsav('qdd',[$ida,'jdatrk',$nbcomments]);
	sqlup2('qdd',['msg'=>$votes],['ib'=>$ida,'val'=>'jdapoll']);
	sqlup2('qdd',['msg'=>$nbcomments],['ib'=>$ida,'val'=>'jdatrk']);
	}
return count($r);}

static function del(){
$ra=sql_b('select ida from jdap','rv');
$rb=sql_b('select id from pub_art','rv');
$r=array_diff($ra,$rb); pr($r);
foreach($r as $k=>$v){
	list($id,$ida,$catid,$suj,$msg,$votes,$voters,$nbcomments,$date,$source)=$v;
	//sqlup2('qdd',['msg'=>$nbcomments],['ib'=>$ida,'val'=>'jdatrk']);
	}
return count($r);}

static function likes(){//from comments id qdi
$r=sql('id,ib,suj','qdi','',''); $rb=[]; $rc=[]; //pr($r);
foreach($r as $k=>$v){list($id,$ida,$note)=$v;
	if($note==1)$rb[$ida][]=1; elseif($note==-1)$rc[$ida][]=1;
	sqlsavup('qdf',['ib'=>$id,'iq'=>1,'type'=>'trkagree','poll'=>$note]);}
foreach($rb as $k=>$v){$score=count($v); echo $k.'-'.$score.br();
	sqlsavup('qdd',['ib'=>$k,'val'=>'approve','msg'=>$score]);}
foreach($rc as $k=>$v){$score=count($v);
	sqlsavup('qdd',['ib'=>$k,'val'=>'disapprove','msg'=>$score]);}
return count($r);}

#
static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); $ret='';
if(auth(6))$ret=self::$p($o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j=$rid.'_app__3_'.self::$a.'_call_';
//$ret=inputj($inpid,$p,$j);
$ret=lj('',$j.'import',picto('import')).' ';
$ret.=lj('',$j.'reapply',picto('tag')).' ';
$ret.=lj('',$j.'emblnk',picto('url')).' ';
//$ret.=lj('',$j.'scores',picto('joker')).' ';
$ret.=lj('',$j.'likes',picto('thumb-up')).' ';
$ret.=lj('',$j.'del',picto('del')).' ';
return $ret;}

static function install($b){
//ses($b,qd($b));//name of table
//1=drop table on change $r !
$r=['tit'=>'var','txt'=>'text','day'=>'sint'];
mysql::install($b,$r,0);}

static function home($p,$o){
$rid=randid(self::$a);
//self::install(self::$a);
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}

}

function plug_jda($p,$o){
return jda::home($p,$o);}

?>