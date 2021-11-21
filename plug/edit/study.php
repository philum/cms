<?php
//philum_plugin_study

function study_sav($p,$o,$res=''){
list($nod,$row,$col)=explode('-',$p);
$ret=ajxg($res); $d=deln($ret); $d=delr($d); $d=delbr($d,"\n"); 
//eco($d,1);//$ret=utf82ascii($ret);
msql::modif('',nod('study_'.$nod),$d,'shot',trim($col),trim($row));
return $ret;}

function study_read($r,$p=1){req('pop,spe');
$s='border:1px dotted silver; width:22vw; min-height:22px;';
foreach($r as $k=>$v){
	if(auth(3) && $k!='_menus_')for($i=0;$i<4;$i++){//nb of columns to add
		$j='stda'.$k.$i.'_plug___study_study*sav_'.$p.'-'.$k.'-'.$i.'__stda'.$k.$i;
		//$bt=lj('',$j,picto('save')).' ';.$bt
		$t=isset($v[$i])?$v[$i]:'';//stripslashes
		$t=codeline::parse($t,'','sconn'); //$t=htmlentities($t);
		$t=nl2br($t);
		if($i==0)$v[$i]=divc('track',$t);
		else $v[$i]=divarea('stda'.$k.$i,'track',$s,sj($j),$t,1);}
	$rb[]=array($v[0],$v[1],$v[2],$v[3]);}
return tabler($rb,'txtbox');}

function study_j($p,$rid){req('spe,pop');
//$bt=study_menu($p,$rid);
$bt=pubart($p);
$r=msql_read('',nod('study_'.$p));
return $bt.study_read($r,$p);}

function study_hash($d,$p){
$d=str_replace('.<','. <',$d);
$d=str_replace(array('<p>','</p>','<br>','<br />'),'',$d);
$d=str_replace(array('. ',".\n"),'#nl#',$d);
$d=str_replace("\n",'#nl#',$d);
$r=explode('#nl#',$d);
foreach($r as $v)if($v)$rb[]=[trim(addslashes($v)).'.','','',''];
$rb=msql::save('',nod('study_'.$p),$rb,['text','description','commentaires','references']);
return study_read($rb,$p);}

function study_build($p,$o,$res=''){
$id=ajxg($res);
$d=sql('msg','qdm','v','id='.$id);
if(is_array($d))return 'no';
$d=codeline::parse($d,'','delconn');
$ret=study_hash($d,$id);
return $ret;}

function study_input($p,$o){
$next=msql::findlast('',ses('qb'),'study');
$j=$p.'_plug___study_study*build_'.$next.'__stdy';
$ret=inputj('stdy','id of art',$j,'','1');
$ret.=lj('poph',$j,picto('ok'));
//$ret.=divarea('stdy','tab justy','border:1px dotted silver; min-height:22px;',$j,'');
return $ret;}

function study_menu($p,$rid){$ret='';
$r=msql::choose('',ses('qb'),'study'); if($r)sort($r);//$v==$p?'active':
if($r)foreach($r as $v)$ret.=lj($p==$v?'active':'',$rid.'_plug___study_study*j_'.$v.'_'.$rid,$v);
return btn('nbp',$ret).' ';}

function plug_study($p,$o){$rid=randid('plg');
Head::add('jscode','function stydiv(d){}'); $bt=''; $ret='';
if(auth(4))$bt=lj('',$rid.'_plup___study_study*input_'.$rid,picto('add')).' ';
if(auth(4))$bt.=msqbt('',nod('study_'.$p)).' ';
$bt.=hlpbt('study');
if($p)$ret=study_j($p,$rid);
else $bt.=study_menu($p,$rid);
return $bt.divd($rid,$ret);}

?>