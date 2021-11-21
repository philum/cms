<?php
//philum_plugin_bazic

function baz_x($d,$o){$st='('; $nd=')'; $in=strpos($d,$st);
if($in!==false){$deb=substr($d,0,$in);
	$out=strpos(substr($d,$in+1),$nd);
	if($out!==false){$nb_in=substr_count(substr($d,$in+1,$out),$st);
		if($nb_in>=1){
			for($i=1;$i<=$nb_in;$i++){$out_tmp=$in+1+$out+1;
				$out+=strpos(substr($d,$out_tmp),$nd)+1;
				$nb_in=substr_count(substr($d,$in+1,$out),$st);}
			$mid=substr($d,$in+1,$out);
			$mid=codeline::parse($mid,$o);}
		else $mid=substr($d,$in+1,$out);
		$mid=baz_ic($mid);
		$end=substr($d,$in+1+$out+1);
		$end=baz_x($end,$o);}
	else $end=substr($d,$in+1);}
else $end=$d;
return ($deb.$mid.$end);}

function baz_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);//$resultant des champs
$ret=baz_x($p,$o);
return $ret;}

function baz_m($p,$o,$rid){
$ret.=textarea('','tx',$p,60,20).' ';
$ret.=lj('',$rid.'_plug__2_bazic_baz*j___tx',picto('ok')).' ';
return $ret;}

//plugin('baz',$p,$o)
function plug_bazic($p,$o){$rid='plg'.randid();
$bt=baz_m($p,$o,$rid); 
$ret=baz_x($p,$o);
//$bt.=msqbt('',ses('qb').'_baz');
return $bt.divd($rid,$ret);}

?>