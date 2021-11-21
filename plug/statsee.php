<?php
//philum_plugin_statsee

function statsee_j($p,$o,$res=''){if(!$p)$p=0; $o=100; $ret=[];
//$r=sql('iq,qb,page,time','qdv','','id>'.$p.' order by id desc');
$r=sql_inner('ip,qb,page,DATE_FORMAT('.qd('live').'.time,\'%H:%i:%s\')','qdp','qdv','iq','','where '.qd('live').'.id>'.($p).' order by '.qd('live').'.id desc limit '.$o);
if($r)foreach($r as $k=>$v)$ret[]=[$k,$v[3],$v[0],$v[2]];
return tabler($ret,'txtx','txtx');}

function plug_statsee($p,$o){
$rid='plg'.randid(); if(!auth(6))return; $o=$p?$p:100;
$p=sqb('id','qdv','v','order by id desc limit 1');
$j=sj($rid.'_plug__2_statsee_statsee*j_'.$p.'_'.$o);
Head::add('jscode',temporize('sttimer',$j,3000));
return divd($rid,statsee_j($p,$o));}

?>