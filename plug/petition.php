<?php
//philum_petition 

function pet_hlp($d){return msql_read('lang','helps_petition',$d);}

function pet_confirm($r,$nod,$id){$arr=$r[$_GET['confirm']];
if($arr[6]==1)return pet_hlp('alert_exists'); else $arr[6]=1;
modif_vars('users',$nod,$arr,$_GET['confirm']);
return divc('txtalert',pet_hlp('confirm_after')).br();}

function pet_mail($id,$day,$mail,$name){$title=suj_of_id($id);
$msg=stripslashes(pet_hlp('confirm_mail'));
$url='http://'.$_SERVER['HTTP_HOST'].'/?read='.$id.'&confirm='.$day;
$msg=str_replace(array('_NAME','_TITLE','_URL'),array($name,$title,$url),$msg);
return mail($mail,$title,$msg,'From: '.$url."\n","");}

function pet_insert_verif($mail){
$r=msql_read('users',$_SESSION['qb'].'_petition_'.$_SESSION['read'],'');
if($r)foreach($r as $k=>$v){if($v[5]==hostname() or $v[1]==$mail)return true;}}

function pet_insert($id,$optb,$res){$day=time();
list($name,$mail,$web,$city,$country)=ajxr($res);
$arr=array($name,$mail,$web,$city,$country,hostname(),0);
$bk=lj('txtbox','petform_plug___petition_pet*form_'.$id,picto('left'));
if(pet_insert_verif($mail)==true)return pet_hlp('alert_exists');
if(strpos($mail,'@')===false or !$name)return $bk.' '.pet_hlp('alert_value');
modif_vars('users',ses('qb').'_petition_'.$id,$arr,$day);
pet_mail($id,$day,$mail,$name); return nl2br(pet_hlp('confirm_before'));}

function pet_form($id){$r=array('name','mail','web','city','country');
foreach($r as $k=>$v){$ids.='pt'.$v.'|'; $ret.=autoclic('" id="pt'.$v,$v,20,255,'').br();}
$sign=pet_hlp('sign');
$ret.=br().lj('txtbox','petform_plug___petition_pet*insert_'.$id.'__'.$ids,$sign);
return divd('petform',$ret);}

function pet_count_valid($r){foreach($r as $k=>$v){if($v[6]==1)$i++;} return $i;}

function pet_read($r,$nba,$page){$limit=($page-1)*$nba; $nbr=pet_count_valid($r);
$ret=str_replace('_NB',$nbr,pet_hlp('actually')).br().br();
$head=$r['_menus_']; unset($r['_menus_']); krsort($r); $id=$_SESSION['read'];
//$head=explode(',',pet_hlp('entries'));
$datas[]=array('date',$head[0],$head[3],$head[4]);
foreach($r as $k=>$v){if($v[6]==1){$i++;
		if($v[2])$name=lkt('',$v[2],$v[0]); else $name=$v[0];
		if($i>$limit && $i<=$limit+$nba)$datas[]=array(mkday($k),$name,$v[3],$v[4]);}}
	if($nbr>$nba){$nbp=ceil($nbr/$nba); if($nbp>1){for($i=1;$i<=$nbp;$i++){$aff[$i]=$i;}}
	$pages=slctmenusj($aff,'pet'.$id.'_plug___petition_pet*j_'.$nba.'|'.$id.'|',$page,' ');}
if($_GET['read']==$id && $id)$ret.=make_table($datas,'popbt','').br().$pages.br().br();
return $ret;}

function pet_j($d){list($nba,$id,$page)=explode('|',$d); $_GET["read"]=$id;
$r=msql_read('users',$_SESSION['qb'].'_petition_'.$id);
return pet_read($r,$nba,$page);}

function plug_petition($id,$p,$page=''){$p=$p?$p:10; $page=$page?$page:1;
$keys=explode(',',pet_hlp('entries').',host,valid');
$defsb['_menus_']=array('name','mail','web','city','country','host','valid');
if(auth(6))$msq=msqlink('',ses('qb').'_petition_'.$id);
$nod=$_SESSION['qb'].'_petition_'.$id;
$r=read_vars('msql/users/',$nod,$defsb);
$ret=lj('txtbox','popup_plup___petition_pet*form_'.$id,pet_hlp('sign')).$msq.br();
if($_GET['confirm']){$ret.=pet_confirm($r,$nod,$id); $r=msql_read('users',$nod);}
if($r)$ret.=divd('pet'.$id,pet_read($r,$p,$page));
return $ret;}

?>