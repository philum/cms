<?php
//philum_plugin_codev

/*function memtmp_b(){if($_SESSION['memtmp']){ksort($_SESSION['memtmp']); 
$ret=implode('',$_SESSION['memtmp']); $_SESSION['memtmp']='';}
$ret=ajx($ret,1); return $ret;}// $ret=unescape($ret);

function ajxg_b($d){$ret=substr($d,0,-1); 
return $ret=='memtmp'?memtmp_b():ajx($ret,1);}*/

function find_end($ret,$start,$a,$b){
	$posa=strpos($ret,$start);
	$posb=strpos($ret,'}',$posa);
	$temp=subtopos($ret,$posa,$posb);
	$nbop=substr_count($temp,'{');
	for($i=1;$i<$nbop;$i++){$posb=strpos($ret,'}',$posb+1);
		$temp=subtopos($ret,$posa,$posb);
		$nbop=substr_count($temp,'{');}
	return subtopos($ret,$posa,$posb+1);}

function func_sav($fa,$z,$res){//from dev
if(!auth(6))return 'no';
if($fa)list($dr,$pg,$fc)=explode('|',$fa);
$f=$dr.'/'.$pg.'.php'; $va=ajxg($res);;
if(is_file($f)){//echo $fab;
	$d=read_file($f);
	$od=find_end($d,'function '.$fc.'(','{','}');
	$d=str_replace($od,$va,$d); //echo txarea('',$t,40,20);
		//$d=str_replace("\r","\n",$d);
	echo write_file($f,$d);}
return btn('txtyl','saved');}

function codsav($p,$o,$res){$d=ajxg($res); //echo $p;
if($p)list($dr,$pg,$fc)=explode("|",$p);
$f=($dr=='plug'?''.$dr:'progb').'/'.$pg; 
if($fc)return func_sav($p,'',$res);
$d='<'.'?php'."\n".$d."\n".'?'.'>'; 
if($_SESSION['auth']>6){
	write_file($f,$d);
	return btn('txtyl','saved');}}

function plug_codev($p,$o,$fc=''){ //echo $fc;
$dr=($p=='plug'?$p:'progb').'/'; $oa=$o.'.php'; 
if(!is_file($dr.$oa))$oa=$o.'.js'; $sav='save: '.$oa;
if($p)$d=read_file($dr.$oa);
$d=str_replace(array('<'.'?php'."\n","\n".'?'.'>','<'.'?php','?'.'>'),'',$d);
if($fc)$d=find_end($d,'function '.$fc.'(','{','}');
//$ret.=txarea('txt',htmlentities($d),52,26,'console').br();
$ret.=lj('','codev_plugin___codev_'.$p.'_'.$o.'_'.$fc,picto('reload')).' ';
$ret.=btd('bts',lj('popsav','cbk_plug__xd_codev_codsav_'.$p.'|'.ajx($oa).'|'.ajx($fc).'__txt',$sav)).btd('cbk','').br();
$ret.='<textarea id="txt" class="console" style="min-width:550px; min-height:320px;">'.($d).'</textarea>';//htmlentities
return divd('codev',$ret);}

?>