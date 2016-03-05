<?php
//philum_plugin_bazx

function baz_x($d,$o){$st='('; $nd=')'; $in=strpos($d,$st);
if($in!==false){$deb=substr($d,0,$in);
	$out=strpos(substr($d,$in+1),$nd);
	if($out!==false){$nb_in=substr_count(substr($d,$in+1,$out),$st);
		if($nb_in>=1){
			for($i=1;$i<=$nb_in;$i++){$out_tmp=$in+1+$out+1;
				$out+=strpos(substr($d,$out_tmp),$nd)+1;
				$nb_in=substr_count(substr($d,$in+1,$out),$st);}
			$mid=substr($d,$in+1,$out);
			$mid=baz_x($mid,$o);}
		else $mid=substr($d,$in+1,$out);
		$mid=baz_u($mid);
		$end=substr($d,$in+1+$out+1);
		$end=baz_x($end,$o);}
	else $end=substr($d,$in+1);}
else $end=$d;
return ($deb.$mid.$end);}

function baz_u($d){
list($ob,$op)=split_right(':',$d);
list($od,$oq)=split_one('/',$op);
//echo $ob.'-'.$od.'-'.$oq.br();
if($oq)switch($od){
case('bal'):return bal($oq,$ob);break;
case('plug'):return plugin($oq,$ob);break;
}
else switch($op){
case('br'):return br();break;
case('b'):return bal($op,$ob);break;
case('u'):return bal($op,$ob);break;
}
return '('.$d.')';}

function baz_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);//$resultant des champs
$ret=baz_x($p,$o);
return $ret;}

function baz_m($p,$o,$rid){
$ret.=txarea('tx',$p,44,11,atc('console')).' ';
$ret.=lj('',$rid.'_plug__2_bazx_baz*j___tx',picto('reload')).' ';
return $ret;}

//plugin('baz',$p,$o)
function plug_bazx($p,$o){$rid='plg'.randid();
$bt=baz_m($p,$o,$rid); 
$ret=baz_x($p,$o);
//$bt.=msqlink('',ses('qb').'_baz');
return $bt.divd($rid,$ret);}

?>