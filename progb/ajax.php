<?php //ajax_hangar
error_report();
getsb(); //pr(ses::$r['get']);
if(rstr(22))boot::block_crawls();
if(!isset($_SESSION['dayx']))boot::reboot();
$res=get('res'); $callj=get('callj');
$r=ajxr($callj,5); [$app,$g1,$g2,$g3,$g4]=$r;
$ret=''; $p1=''; $t=$app; $s='';
$sz=get('sz'); $tg=get('tg'); //$dn2=get('dn2');
$prm=$_POST??[]; if($prm){$prm=utf_r($prm,1); $prm=delr_r($prm); [$p1,$p2]=arb($prm,2);}

function popup($d,$t){$s='';
$w=ses::$r['popw']??cw(); if($w)$s='max-width:'.($w+36).'px;'; $t=ses::$r['popt']??$t;
//$w=ses::$r['popwm']??''; if($w)$s.=' min-width:'.$w.'px;';
//$w=ses::$r['pophm']??''; if($w)$s.=' min-height:'.$w.'px;';
$popb=ljb('','Close','popup',picto('close')).lja('','poprepos()',picto('ktop')).lja('','reduce()',picto('less')).lja('','fixelem()',picto('fix')).ses::r('popm').' ';
$popa=div(atd('popa').atc('popa'),$popb.balb('small',$t));//.atb('onmousedown','noslct(0);')
return div(atc('popup').ats($s),$popa.div(atd('popu').atc('popu'),$d));}

function pagup($d,$t){$t=ses::$r['popt']??$t; $w=ses::$r['popw']??cw(); $m=ses::r('popm');
return divs('margin:auto; max-width:'.$w.'px;',div(atd('popa').atc('popa'),ljb('','Close','popup',picto('close')).$m.balb('small',$t)).div(atd('popu'),$d));}

function tit($a,$b){if($b=='home')return $a; $k=$a.'::'.$b;
$r=['art::trkone'=>65,'tracks::form'=>21,'meta::catslct'=>9,'usg::popartmod'=>39,'usg::playmod'=>187,'conn::read2'=>65,'usg::trkplay'=>22,'tracks::redit'=>107,'sav::batchpreview'=>65,'deploy::home'=>28,'art::social'=>47,'mails::sendart'=>28,'apps::deskroot'=>196,'finder::home'=>197,'search::home'=>24];
return isset($r[$k])?nms($r[$k]):$b;}

#load
if(strpos($app,',')){[$a,$b]=explode(',',$app);
if($res)$ret=$a::$b($g1,$g2,$res);//
elseif($prm)$ret=$a::$b($g1,$g2,$prm);
else $ret=$a::$b($g1,$g2,$g3,$g4);
$t=tit($a,$b);
if(is_array($ret))$ret=mkjson($ret);}

elseif($_a=get('_a')){[$a,$b]=explode(',',$_a); $g=explode(',',get('_g'));//new canal
if(!method_exists($a,$b))$ret='nothing';
else $ret=$a::$b($g,$prm); //json::add('','fc',$r);
$t=tit($a,$b);
if(is_array($ret))$ret=mkjson($ret);}

#private
if($_SESSION['auth']>1 && !$ret)switch($app){
//admin
case('admin'):$ret=adm::call($g1,$g2,$g3); break;
case('modsav'):$ret=admx::modsav($g1,$g2,$g3,$prm); break;
case('submds'):$ret=admx::submds($g1,$g2,$g3,$g4,$prm); break;
case('sqledt'):$ret=sqledt($g1,$g2,$g3,$res); $t=$g1; break;
//msql
case('msqledit'):$ret=msqa::mdfcol($g1,$g2,$g3,$prm); break;
case('msqlops'):$ret=msqa::msqlops($g1,$g2,$g3,$g4,$prm); break;
case('msqlmodif'):$ret=msqa::msqlmdf($g1,$g2,$g3,$g4,$prm); break;
case('msql'):$ret=msqa::msqlopen($g1,$g2,$g3,$g4); break;
case('mktable'):$ret=mc::mktc($g1,$g2,$g3,$prm); break;}

#public
if(!$ret)switch($app){
//readers
case('art'):$ret=art::playc($g1,$g2,$g3); break;
case('popart'):$ret=popart($g1); break;
case('api'):$ret=api::call($g1,$g2,$g3,$g4); $t=$g1; break;
case('api2'):$ret=api::call($p1,$g1,$g2,$g3); $t=$g1; break;//$p1
//case('search'):$ret=search::home($g1,$g2,$prm); $t=nms(24); break;
//desk
case('deskroot'):$ret=apps::deskroot($g1,$g2,$g3,$g4); break;//desktop
case('deskico'):$ret=apps::deskico($g1); break;//desk
case('deskbkg'):$ret=apps::deskbkg(); break;//deskcss
case('deskload'):$ret=apps::deskload($g1); break;
case('deskoff'):$ret=apps::deskoff($g1,$g2); break;
case('site'):$ret=usg::site($g1,$g2); break;
//call
case('plugin'):if($g1)$ret=plugin($g1,$g2,$g3,$g4,$res); $t=$g1; break;
case('plug'):$ret=plugin_func($g1,$g2,$g3,$g4,$res); $t=$g1; break;
case('app'):$ret=$g1::$g2($g3,$g4,$res); $t=$g1; break;//obs
case('obj'):$d=new $g1($g2,$g3); $ret=$d($g4,$res); $t=$g1; break;//unused
//sys
case('hidj'):$ret=usg::hidslct($g1,$g2,$g3,$g4,$prm); break;
case('chkj'):$ret=usg::chkslct($g1,$g2,$g3,$g4,$prm); $t=$g2; break;
case('alert'):$ret=divc('',picto('alert').' '.$g1); break;
case('rebuild'):$ret=boot::rebuild(); break;
case('reset'):boot::reboot(); break;
//actions
case('lang'):usg::putses('lang',$g1); ses('lng',$g1!='all'?$g1:prmb(25)); break;
case('sesmake'):usg::putses($p1?$p1:$g2,$g1); break;
case('session'):$ret=$_SESSION[$g1]; break;
case('offon'):$ret=offon($g1); break;
case('tog'):$ret=yesnoses($g1); break;
case('togses'):$ret=offon(yesnoses($g1)); break;
case('slctmod'):boot::select_mods(yesnoses('slctm')?$g1:''); break;
case('dev'):usg::putses('dev',$g1); break;
case('jump'):$ret=divc('console',$g1); if($g2)$t=$g2; break;
case('lj'):$ret=$lj($g3,$g1,$g2); $t=$g2; break;
case('ret'):$ret=$g1; break;}

if($app=='call'){if($res)[$s,$h]=opt($res,'-'); $ret=$g2($g3,$g4,$res);}
if($app=='plug')ses::$r['popm']=lkt('','/plug/'.$g1.'/'.$g2,picto('url')).' ';

if($tg=='popup')$ret=popup($ret,$t,$s);
elseif($tg=='pagup')$ret=pagup($ret,$t);

echo $ret;
mysqli_close($_SESSION['qr']);
?>