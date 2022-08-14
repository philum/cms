<?php //source

function plug_source($d){
$jc=$_GET['plug']?'plug/':'';
$t=read_file($jc.$d.'.php');
return textarea('',$t,50,20);}

?>