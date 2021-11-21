<?php
//philum_plugin_msqm
define('db',$db);

function mq_edit($p,$o,$res=''){list($p,$o)=ajxp($res,$p,$o);
$r=sql('select '.$p.' from '.$o.';','');
//if($r)foreach($r as $v)$ret.=lj('','popup_plup___mysqm_mq*edit_'.$v[0],$v[0]);
return $ret;}

function mq_cols($p,$o,$res=''){list($p,$o)=ajxp($res,$p,$o); //echo $p."-".$o;
$r=sql_b('select column_name,data_type,character_maximum_length from information_schema.columns where table_name="'.$p.'" and table_schema="'.$o.'";',''); //p($r);
if($r)foreach($r as $v)//p($v);
$ret[]=array(lj('txtx','popup_plup___mysqm_mq*edit_'.$v[0],$v[0]),$v[1],$v[2]);
return tabler($ret);}

function mq_tables($p,$o,$res=''){list($p,$o)=ajxp($res,$p,$o);
$r=lstrc(rcptb($p)); 
if($r)foreach($r as $v)$ret.=lj('','mqm_plug___mysqm_mq*cols_'.ajx($v).'_'.ajx($p),$v);
//$ret=walkeach($r,'mqt_w',$p);implode('',)
return btn('list',$ret);}
//function mqt_w($k,$v,$p){return lj('','mqm_plug___mysqm_mq*cols_'.ajx($v).'_'.ajx($p),$v);}

//plugin('msqm',$p,$o)
function plug_mysqm($p,$o){$p=$p?$p:db;
$ret.=input1('inp',$p,'').' ';
$ret.=lj('','mqm_plug__2_mysqm_mq*tables___inp',picto('ok')).' ';
//$ret.=msqbt('',ses('qb').'_msqm').' ';
return $ret.divd('mqm',mq_tables($p,$o));}

?>