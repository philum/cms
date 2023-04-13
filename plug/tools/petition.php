<?php 
class petition[

static function hlp($d){return msql::val('lang','helps_petition',$d);}

static function confirm($r,$nod,$id){$arr=$r[$_GET['confirm']];
if($arr[6]==1)return self::hlp('alert_exists'); else $arr[6]=1;
msql::modif('',$nod,$arr,$_GET['confirm']);
return divc('txtalert',self::hlp('confirm_after')).br();}

static function mail($id,$day,$mail,$name){
$title=ma::suj_of_id($id);
$msg=stripslashes(self::hlp('confirm_mail'));
$url='http://'.$_SERVER['HTTP_HOST'].'/?read='.$id.'&confirm='.$day;
$msg=str_replace(array('_NAME','_TITLE','_URL'),array($name,$title,$url),$msg);
return mail($mail,$title,$msg,'From: '.$url."\n","");}

static function insert_verif($mail){
$r=msql::read('users',nod('petition_'.ses('read')),'');
if($r)foreach($r as $k=>$v){if($v[5]==hostname() or $v[1]==$mail)return true;}}

static function insert($id,$optb,$prm=[]){$day=time();
[$name,$mail,$web,$city,$country]=arr($prm,5);
$arr=array($name,$mail,$web,$city,$country,hostname(),0);
$bk=lj('txtbox','petform_petition,form_'.$id,picto('before'));
if(self::insert_verif($mail)==true)return self::hlp('alert_exists');
if(strpos($mail,'@')===false or !$name)return $bk.' '.self::hlp('alert_value');
msql::modif('',ses('qb').'_petition_'.$id,$arr,$day);
self::mail($id,$day,$mail,$name); return nl2br(self::hlp('confirm_before'));}

static function form($id){$r=['name','mail','web','city','country']; $ret=''; $ids='';
foreach($r as $k=>$v){$ids.='pt'.$v.'|'; $ret.=inputb('pt'.$v,$v,20,'',255,[]).br();}
$sign=self::hlp('sign');
$ret.=br().lj('txtbox','petform_petition,insert_'.$ids.'__'.$id,$sign);
return divd('petform',$ret);}

static function count_valid($r){$i=0; foreach($r as $k=>$v){if($v[6]==1)$i++;} return $i;}

static function read($r,$nba,$page){$limit=($page-1)*$nba; $nbr=self::count_valid($r);
$ret=str_replace('_NB',$nbr,self::hlp('actually')).br().br();
$head=$r['_menus_']; unset($r['_menus_']); krsort($r); $id=ses('read');
//$head=explode(',',self::hlp('entries'));
$datas[]=['date',$head[0],$head[3],$head[4]];
foreach($r as $k=>$v){if($v[6]==1){$i++;
		if($v[2])$name=lkt('',$v[2],$v[0]); else $name=$v[0];
		if($i>$limit && $i<=$limit+$nba)$datas[]=array(mkday($k),$name,$v[3],$v[4]);}}
	if($nbr>$nba){$nbp=ceil($nbr/$nba); if($nbp>1){for($i=1;$i<=$nbp;$i++){$aff[$i]=$i;}}
	$pages=slctmnuj($aff,'pet'.$id.'_petition,call___'.$nba.','.$id.',',$page,' ');}
if(get('read')==$id && $id)$ret.=tabler($datas,'popbt','').br().$pages.br().br();
return $ret;}

static function call($d){
[$nba,$id,$page]=explode(',',$d); $_GET['read']=$id;//roo
$r=msql::read('',nod('petition_'.$id));
return self::read($r,$nba,$page);}

static function home($id,$p,$page=''){$p=$p?$p:10; $page=$page?$page:1;
$keys=explode(',',self::hlp('entries').',host,valid');
$defsb['_menus_']=['name','mail','web','city','country','host','valid'];
if(auth(6))$msq=msqbt('',ses('qb').'_petition_'.$id);
$nod=$_SESSION['qb'].'_petition_'.$id;
$r=msql::read_b('',$nod,'','',$defsb);
$ret=lj('txtbox','popup_petition,form___'.$id,self::hlp('sign')).$msq.br();
if(get('confirm')){$ret.=self::confirm($r,$nod,$id); $r=msql::read('users',$nod);}
if($r)$ret.=divd('pet'.$id,self::read($r,$p,$page));
return $ret;}
}
?>