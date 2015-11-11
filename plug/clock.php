<?php
//philum_plugin_clock

function clock_build(){
$ret=$p.'-'.$o;
return $ret;}

function clock_circle($p){
$ret=divd('kclock',divd('khour',0));
return $ret;}

function clock_j(){
//$ret=clock_build($p,$o);
$ret=divd('kclock',1);
return $ret;}

function clock_css(){
return '
-webkit-animation: spin 1s infinite linear;
@-webkit-keyframes spin {
    0%   {-webkit-transform: rotate(0deg)}
    100% {-webkit-transform: rotate(360deg)}
}

#kclock{border:1px solid black; width:200px; height:200px; border-radius:100px;
margin:100px; text-align:center; transform: rotate(90deg); transition: 3s ease-in;
}
#khour{border:1px solid black; width:20px; height:20px; border-radius:100px;}
#kmin{border:1px solid black; width:10px; height:10px; border-radius:50px;
margin:100px 0 0 100px;}
#ksec{}
';}

function plug_clock($p,$o){$rid='plg'.randid();
$bt=header_add('csscode',clock_css());
$ret=clock_j($p,$o);
return $bt.divd($rid,$ret);}

?>