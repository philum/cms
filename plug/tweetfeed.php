<?php
//philum_plugin_tweetfeed

function tweetfeed_tlex($minid){reqp('tlex'); $ret='';
$r=api::callj('priority:4,preview:1,idlist:1,order:id asc,minid:'.$minid,'','');
if($r)foreach($r as $k=>$v)$ret.=tlex_post(host().'/'.$k,1);
return $ret;}

function tweetfeed_read(){
req('mod,art,pop,spe',1);
$ret=build_modules('tweetfeed','');
return $ret;}

function tweetfeed_build($minid){$rc=[];
$w=',idlist:1,order:id asc'; if(is_numeric($minid))$w.=',minid:'.$minid; //echo $w;
$r=define_modc_b('tweetfeed');
if($r)foreach($r as $k=>$v){$rb=api::callj($v[1].$w,'','');//p($rb);
	if($v[0]=='api_arts' && $rb)foreach($rb as $ka=>$va)$rc[]=$ka;}
return $rc;}

function tweetfeed_batch($p,$o,$res=''){
req('adminx,spe'); $rok=[]; $vx=0;
$f='_datas/twfeed.txt'; $minid=$res?$res:read_file($f);
if(!is_file($f))write_file($f,'');
$r=tweetfeed_build($minid);//p($r);
if($r)foreach($r as $k=>$v){$rok[]=$v.': '.twit::botshare($v,4); sleep(1);}//apikey:4
if($r)$vx=max($r); if($vx>$minid)write_file($f,$vx);
//$ret=helps('tweetfeed_ok').' :: ';
$ret=divc('',count($r).' tweets have been sent');
if($rok)$ret.=implode(br(),$rok);
$ret.=tweetfeed_tlex($minid);
return $ret;}

function tweetfeed_menu($rid){$ret=input('inp','').' ';
$ret.=lj('',$rid.'_plug__3_tweetfeed_tweetfeed*batch___inp',picto('ok'));
return $ret;}

function plug_tweetfeed($d){$rid=randid();
req('adminx,spe'); $t='tweetfeed'; $voc=helps($t);
$r['batch']=lj('popsav',$rid.'_plug__3_'.$t.'_'.$t.'*batch',nms(28)).' ';
$r['batch'].=lj('txtbox',$rid.'_plug__3_tweetfeed_tweetfeed*read',nms(65)).' ';
$r['batch'].=lj('txtx',$rid.'____','x').' ';
$r['edit']=divd('modules'.$t,console::block($t,1)).hlpbt($t.'_help');
$r['from']=tweetfeed_menu($rid);
return make_tabs($r,'nl').divd($rid,'');}

?>