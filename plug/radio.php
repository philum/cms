<?php
//philum_radio 

function radio_r($r){foreach($r as $k=>$v){
if(is_array($v)){$rt=radio_r($v); if($rt)$ret.=balc('ul','pubart',$rt);}
elseif($v)$ret.=llj('popbt','popup_radioedit__x__'.ajx($v).'',$v);}
return $ret;}

function funcradio($d,$k,$v,$n){//dir,url,file,tnb
if(substr($v,-3)=='mp3' or !$v){$ret=str_replace('users/','',$d); 
$ret=divd('rd'.$n,$lk);} return $ret;}

function radio_select(){
$r=walk_dir('users/'.$_SESSION['qb'],'funcmp3');
if($r)return radio_r($r);}

function radio_build($dr,$nod){$dr='users/'.ajx($dr,1);
$sqdir='msql/radio/'; if(!is_dir($sqdir))mkdir($sqdir);
$nod=$_SESSION['qb'].'_radio'.$_SESSION['read']; $file=$sqdir.$nod.'.php';
$ret['_menus_']=array('prog','file','length','title','txt','img');
$r=explore($dr);
if($r)foreach($r as $k=>$v){$ret[$k+1]=array('0',$dr.'/'.$v,'0',$v,'','');}
save_vars($sqdir,$nod,$ret);
return ljb("popbt","insert",'['.$nod.':radio]',"insert").' ';}

function radio_edit($nod,$dr,$md,$id=''){
$id=$id?$id:$_SESSION['read'];
$nd='radio'.$id; if(!$nod)$nod=$_SESSION['qb'].'_'.$nd;
$nodb=str_replace('_','*',$nod);
if($dr)$ret.=radio_build($dr,$nod);
$r=msql_read('radio',$nod,''); 
$ret.=msqlink('radio',$_SESSION['qb'].'_'.$nd);
if($r[$md]){foreach($r[$md] as $k=>$v){$ky.=$md.'.'.$k.'|';
	$edit.=input2('text','"id="'.$md.'.'.$k,$v).btn('txtsmall',$r['_menus_'][$k]).br();}
	$edit.=ljb('popbt','SaveR','popup_radiosav_'.$nodb.'__'.$k.'\',\''.$ky,'save');}
$ret.=divc('edit',$edit);
if($r)foreach($r as $k=>$v){foreach($v as $ka=>$va){$datas[$k][]=$va;}
	if($k!='_menus_' && $k!=$md){$datas[$k][]=ljb('popbt','SaveJ','popup_radioedit___'.$nodb.'__'.$k,'edit');}}
$ret.=make_divtable($datas);
return popup('build_playlist',$ret);}

?>