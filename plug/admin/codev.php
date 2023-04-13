<?php 
class codev{
static function find_end($ret,$start,$a,$b){
	$posa=strpos($ret,$start);
	$posb=strpos($ret,'}',$posa);
	$temp=subtopos($ret,$posa,$posb);
	$nbop=substr_count($temp,'{');
	for($i=1;$i<$nbop;$i++){$posb=strpos($ret,'}',$posb+1);
		$temp=subtopos($ret,$posa,$posb);
		$nbop=substr_count($temp,'{');}
	return subtopos($ret,$posa,$posb+1);}

static function func_sav($fa,$z,$prm){//from dev
if(!auth(6))return 'no';
if($fa)[$dr,$pg,$fc]=explode('|',$fa);
$f=$dr.'/'.$pg.'.php'; $va=$prm[0]??'';
if(is_file($f)){
	$d=read_file($f);
	$od=self::find_end($d,'static function '.$fc.'(','{','}');
	$d=str_replace($od,$va,$d); //echo textarea('',$t,40,20);
		//$d=str_replace("\r","\n",$d);
	echo write_file($f,$d);}
return btn('txtyl','saved');}

static function codsav($p,$o,$prm){$d=$prm[0]??$p;
if($p)[$dr,$pg,$fc]=explode('|',$p);
$f=($dr=='plug'?''.$dr:'progb').'/'.$pg; 
if($fc)return self::func_sav($p,'',$prm);
$d='<'.'?php'."\n".$d."\n".'?'.'>'; 
if($_SESSION['auth']>6){
	write_file($f,$d);
	return btn('txtyl','saved');}}

static function home($p,$o,$fc=''){
$dr=$p.'/'; $oa=$o.'.php'; $d='';
if(!is_file($dr.$oa))$oa=$o.'.js'; $sav='save: '.$oa;
if($p)$d=read_file($dr.$oa);
$d=str_replace(array('<'.'?php'."\n","\n".'?'.'>','<'.'?php','?'.'>'),'',$d);
if($fc)$d=self::find_end($d,'static function '.$fc.'(','{','}');
//$ret=textarea('txt',htmlentities($d),52,26,['class'=>'console']).br();
$ret=lj('','codev_codev,home___'.$p.'_'.$o.'_'.$fc,picto('ok')).' ';
$ret.=lj('popsav','cbk_codev,codsav_txt_xd_'.$p.'|'.ajx($oa).'|'.ajx($fc),$sav).btd('cbk','').br();
$ret.='<textarea id="txt" class="console" style="min-width:550px; min-height:320px;">'.($d).'</textarea>';//htmlentities
return divd('codev',$ret);}
}
?>