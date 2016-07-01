<?php
//philum_plugin_poll

function poll_j($p,$o,$res=''){
list($ex,$poll)=sql('id,poll','qdpl','r','ib="'.$p.'" and iq="'.ses('iq').'"');
if($poll==$o)$o='0';
if($ex)update('qdpl','poll',$o,'id',$ex);
else insert('qdpl','("","'.$p.'","'.ses('iq').'","'.$o.'")');
return poll_menu($p,$o);}

function poll_read($id){
$ret=sql('poll,id','qdpl','k','ib="'.$id.'"');
return $ret;}

function poll_score($id){$r=poll_read($id); $nc=$r[1]+$r[2];
$balance=$r[1]<$r[2]?2:1; $ico=$balance==2?'sad':'smile';
$poll=sql('poll','qdpl','v','ib="'.$id.'" and iq="'.ses('iq').'"');
if($poll)$sty='color:orange;'; elseif($nc)$sty='color:black;';
return togbub('plugin','poll_'.$id,pictxt($ico,$nc,$sty),'');}

function poll_menu($id,$poll=''){$r=poll_read($id); $nc=$r[1]+$r[2];
if($nc && $r[1])$va=round($r[1]/$nc,2)*100; else $va=0;
if($nc && $r[2])$vb=round($r[2]/$nc,2)*100; else $vb=0;
if(!$poll)$poll=sql('poll','qdpl','v','ib="'.$id.'" and iq="'.ses('iq').'"');
$j='poll'.$id.'_plug___poll_poll*j_'.$id;
$ret.=lj($poll==1?'active':'',$j.'_1',pictxt('smile',$va.'%')).' ';
$ret.=lj($poll==2?'active':'',$j.'_2',pictxt('sad',$vb.'%')).' ';
$ret.=lj('small','pll'.$id.'_plug___poll_poll*score_'.$id,nbof($nc,143));
return divc('nbp',$ret);}

function poll_init(){
$db=plugin_func('install','install_db',ses('qd'));
if($db['_poll'])mysql_query($db['_poll']) or die($db['_poll']);}

function plug_poll($p,$o){
if($p=='init')poll_init();
if($p)$ret=poll_menu($p);
return span(atd('poll'.$p).atc('small'),$ret);}

?>