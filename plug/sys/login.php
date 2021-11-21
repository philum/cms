<?php
//philum_plugin_login 

function loged_j($usr,$rg,$t,$tl){
if($t)$ta=btn('txtsmall',$t); echo $_SESSION['USE'];
if(!$_SESSION['USE']){// or !is_numeric($rg)
$nam=nameofauthes($_SESSION['prmb'][11]);
return '<form id="login" name="form2" method="post" action="/?log=on" onKeyPress="checkEnter(event,\'login\')">'.$ta.autoclic('user',$nam,$tl,'100','txtx').' '.autoclic('password','pass','pass',$tl,'50','txtx').' '.submitj('txtx" title="log:in / nouvel utilisateur',"login","ok").' </form>';}
else return lkc('txtx',"/?log=out","log_out").br();}

function plug_login($p){req('pop');
return login::form($_SESSION['USE'],$_SESSION['iq'],$p);
//return loged_j($_SESSION['USE'],$_SESSION['iq'],$t,10);
//$w='.'.$_SERVER['HTTP_HOST'];
//$ret=divc('txtcadr',helps('new_user')).br();
$ret=bal('input',array('type'=>'text','name'=>'user','id'=>'lgg','onKeyPress'=>"log_finger('lgg');"),'').' ';
if($_SESSION['prmb'][11]>5)$ret.=bal('label',array('for'=>'login','size'=>15),nms(135)).br();
else $ret.=btn('" id="valid',nms(135)).br().br();
$ret.=bal('input',array('type'=>'text','name'=>'pass'),'').' ';
$ret.=bal('label',array('for'=>'pass','size'=>15),nms(137)).br();
$ret.=bal('input',array('type'=>'text','name'=>'mail'),'').' ';
$ret.=bal('label',array('for'=>'mail','size'=>15),nms(136)).br().br();
$ret.=submitj('popsav','login',nms(57));
return '<form id="login" method="post" action="" onKeyPress="checkEnter(event,\'login\')">'.$ret.' </form>';}

?>