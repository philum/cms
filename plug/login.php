<?php
//philum_plugin_login 

function loged_j($usr,$rg,$t,$tl){
if($t)$ta=btn("txtsmall",$t);
if($_SESSION['USE']=='_' or !is_numeric($rg)){
$nam=nameofauthes($_SESSION["prmb"][11]);
return '<form id="login" name="form2" method="post" action="/?log=on" onKeyPress="checkEnter(event,\'login\')">'.$ta.autoclic("user",$nam,$tl,"100","txtx").' '.autoclic("password","pass","pass",$tl,"50","txtx").' '.submitj('txtx" title="log:in / nouvel utilisateur',"login","ok").' </form>';}
else return lkc("txtx","/?log=out","log_out").br();}

function plug_login($p){req('pop');
//return loged_j($_SESSION["USE"],$_SESSION["iq"],$t,10);
$w='.'.$_SERVER['HTTP_HOST'];
$in.=divc('popbt',helps('new_user')).br();
$in.=balise("input",array(1=>"text",2=>"user",3=>"lgg",8=>"log_finger('lgg');"),"").' ';
if($_SESSION["prmb"][11]>5)$in.=balise("label",array("for"=>'login',6=>15),$w).br();
else $in.=btn('" id="valid',nms(135)).br().br();
$in.=balise("input",array(1=>"text",2=>"pass"),"").' ';
$in.=balise("label",array("for"=>'pass',6=>15),nms(137)).br().br();
$in.=balise("input",array(1=>"text",2=>"mail"),"").' ';
$in.=balise("label",array("for"=>'mail',6=>15),nms(136)).br().br();
$in.=submitj('txtx',"login",nms(57));
return '<form id="login" method="post" action="" onKeyPress="checkEnter(event,\'login\')">'.$in.' </form>';}

?>