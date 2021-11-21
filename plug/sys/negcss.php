<?php
//philum_plugin_invertcss

function plug_negcss($p,$o){
if($n=$_SESSION['prmb'][5])$nod=ses(qb).'_auto';
else $nod=ses(qb).'_design_'.$_SESSION['prmd'];
$f='css/'.$nod.'_neg.css'; $tima=ftime('css/'.$nod.'.css','ymdhi'); $timb=ftime($f,'ymdhi'); 
if($tima>$timb){req('styl');
	if($n=$_SESSION['prmb'][5]){
		if($n<4)$r=msql_read('system','default_css_'.$n);
		elseif(is_numeric($n))$r=msql_read('design','public_design_'.$n);}
	else $r=msql_read('design',$nod);
	$clr=$_SESSION['clrs'][$_SESSION['prmd']]; 
	foreach($clr as $k=>$v)if($v)$klr[$k]=invert_color($v,0);
	$_SESSION['clrs'][$_SESSION['prmd']]=$klr;
	build_css($f,$r);}}

?>