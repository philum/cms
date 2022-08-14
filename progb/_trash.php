<?php

#2208
//a/tracks

/*static function send_track($id,$nread,$local,$name,$msg,$tim,$mail,$re){
$nmsg=lka($here.'#trk'.$nread,$local?helps('trackmail'):nms(84)).br().br();
$nmsg.=ucfirst(nms(68)).': '.$name.', '.mkday($tim).br().br().conn::read($msg,'','');
$admail=$_SESSION['qbin']['adminmail'];//to_admin
$suj=$local?ma::suj_of_id($id):nms(84);
if($name!=$_SESSION['USE'])mails::send_mail('html',$admail,$suj,$nmsg,$mail,urlread($id));
if($local)$rmails=sql('mail','qdi','k','frm="'.$id.'" AND re>="1"');//deploy
$kem=sql('name','qda','v','id="'.$id.'"');//send_to_author
if($kem!=$name){$kmail=sql('mail','qdu','v','name="'.$kem.'"');
	if($admail!=$kmail)$rmails[$kmail]=1;} //sendtrk
if($rmails && $re==1)mails::batch(array_keys_b($rmails),'html',$suj,$nmsg,$mail,$id);}*/*

///b/mod
//case('player'):$ret=flash_prep('',$p); break;

/*static function rub_taxo($p,$t){$id=ses('read');
if($p==1)$p=ses('frm'); elseif($p=='art')$p=ma::ib_of_id($id);
if($p)$taxcat=supertriad_dig($p);//permanent
if($p>1){$t=lk(urlread($p),ma::suj_of_id($p)).br();
	$hie=self::collect_hierarchie_c(0,''); $taxcat=self::find_in_subarray($hie,$p);}
$t=self::build_titl($taxcat,$t,1);
if(is_array($taxcat))return $t.divc('taxonomy',md::menus_r($taxcat));}*/

#2207
//b/md///prevnext_art
	//$ret=lj($k1?'':'hide',$j.$k1.'__'.$k1,$ta).''.lj($k2?'':'hide',$j.$k2.'__'.$k2,$tb);

//boot//master_params
//$_SESSION['jbuffer']=$prms[10]?$prms[10]:'2000';//obs
///ajs.js
//var cutat=2000;//AMT buffer
///index///jscode
//'cutat='.$_SESSION['jbuffer'].';

//sys
//if(isset($_GET['switch_design']))$_SESSION['switch']=get('switch_design');

#2206
//sav
static function batchsav(){$r=$_SESSION['vac']; $rb)[]; $_SESSION['vac2']=$r;//array_reverse
if($r)foreach($r as $k=>$v){$rb[]=self:: saveart_url($v['u']); $_SESSION['dayx']=time();}
return implode(',',$rb);//ind arts
/*if($rb){$n=count($rb); $ids=implode('|',$rb);
$ret=lj('poph','popup_api,callj___id:'.$ids.',preview:2',pictxt('view',nbof($n,1)));}
else $ret=nmx([11,16]);
return $ret;*/}

//meta
/*static function reimportedt($id,$prw=1,$prm=[]){
$u=sql('mail','qda','v','id='.$id); $u=$prm[0]??$u;
return btn('',input('rmp',$u,atz(22)).lj('',$id.'_sav,reimport_rmp_3_'.$id.'_'.$prw,picto('ok')));}*/

#2205

//meta//metall
//plusieurs appels, remplacé par un json
//$j=atjr('autocomp',[$id,$ja]); $js=atk($j).atkp($j);
//$bt.=ljb('','SaveJc',implode(';',$_POST['opall']),picto('enquiry'));

//conv
//static function trap_video($v,$s){$d=self::trap_v_id($v,$s); if($d)return '['.$d.':video]';}

#2203
//utils.js
/*function publishart(id){var ob=getbyid('art'+id);
ob.className=ob.className.replace('hide','');
ajaxcall('pba'+id,'meta,priorsav__1_'+id,[],10);}*/

#2202

//rssin
/*static function load_dom0($f,$o=''){$rt=[];
$dom=fdom($f,0); $r=$dom->getElementsByTagName('item');
foreach($r as $item){$suj=''; $link=''; $guid=''; $dat=''; $pdat=''; $txt='';
	$rb=$item->getElementsByTagName('title'); if($rb[0])$suj=$rb[0]->nodeValue;
	$rb=$item->getElementsByTagName("link"); if($rb[0])$link=$rb[0]->nodeValue;;
	$rb=$item->getElementsByTagName('guid'); if($rb[0])$guid=$rb[0]->nodeValue;
	//$rb=$item->getElementsByTagName('source'); if($rb[0])$src=$rb[0]->getAttribute('url');
	$rb=$item->getElementsByTagName('date'); if($rb[0])$dat=$rb[0]->nodeValue;
	$rb=$item->getElementsByTagName('pubDate'); if($rb[0])$pdat=$rb[0]->nodeValue;
	$lnk=$link?$link:$guid; if(!$dat && $pdat)$dat=$pdat; if(is_numeric($lnk))$lnk='';
	//$rb=$item->getElementsByTagName('description'); if($rb[0])$txt=$rb[0]->nodeValue;
 	if($lnk)$rt[]=[$suj,$lnk,$dat,$txt];}
return $rt;}*/

//lib
//function get($k,$v=''){if($v)ses::$r['get'][$k]=$v; return ses::$r['get'][$k]??'';}
//function get($k,$v=''){return $_GET[$k]??$v;}//filter_input(INPUT_GET,$k);
//function getb($k,$v=''){$g=get($k); return $g?utf8_decode(urldecode($g)):$v;}//default
//function getb($k,$v=''){return get($k,$v);}//default
//function getb($k,$v=''){return ses::$r['get'][$k]??ses::$r['get'][$k]=$v;}//fill
//function sesa($d,$v){return $_SESSION[$d]=$v;}
//function sesa($k,$v=''){return $v?$_SESSION[$k]=$v:ses($k);}//assign
//function sesb($k,$v=''){return ses::$r['get'][$k]??ses::$r['get'][$k]=$v;}//fill
//function sesd($d,$v=''){return $_SESSION[$d]?$_SESSION[$d]:$v;}//

//ajax
//case('comline'):$ret=admx::comline_edit($g1,$g2,$g3,$prm); break;

//mod///m_pubart
//elseif($o=='scrold')$ret=scroll_b($r,implode('',$re),$p);
///mod_load
//elseif($o=='scrold')$ret=scroll_b($load,$ret,10);
//lib
/*function scroll_b($r,$d,$max=10,$w='',$h='',$id=''){$n=is_numeric($r)?$r:count($r);
$h=$h?$h:'calc(100vh - 100px)'; if(is_numeric($h))$h.='px';
$w=$w?$w:'calc(100% + 1px)'; if(is_numeric($w))$w.='px';
$ca='width:'.$w.'; height:'.$h.'; overflow:hidden; padding-right:1px;';
$cb=' id="scrll'.$id.'" style="width:calc(100% + 16px); overflow-y:auto; scrollbar-width:thin; height:'.$h.';"';
if($n>$max or !$n)return divs($ca,div($cb,$d)); else return $d;}*/

?>