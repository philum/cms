<?php
//philum_plugin_statsee

function statsee_j($p,$o,$res=''){if(!$p)$p=0;
//$r=sql('iq,qb,page,time','qdv','','id>'.$p.' order by id desc');
$r=sql_inner('ip,qb,page,DATE_FORMAT('.qd('live').'.time,\'%H:%i:%s\')','qdp','qdv','iq','','where '.qd('live').'.id>'.$p.' order by '.qd('live').'.id desc limit 50');//p($r);
if($r)foreach($r as $k=>$v)$ret[]=array($k,$v[3],$v[0],$v[2]);
return make_table($ret,'txtx','txtx');}

function plug_statsee($p,$o){$rid='plg'.randid(); if(!auth(6))return;
$r=sql('id','qdv','rv','id>0 order by id desc limit 50'); $p=min($r);
$j=sj($rid.'_plug__2_statsee_statsee*j_'.$p);
Head::add('jscode',temporize('sttimer',$j,3000));
return divd($rid,statsee_j($p,$o));}

?>