<?php
//philum_plugin_canvas
session_start();
error_reporting(6135);
if(!function_exists('p'))require('../progb/lib.php');

function cnvs_js($d,$id){return '
var c=document.getElementById("canvas'.$id.'");
var ctx=c.getContext("2d");
'.$d.'';}

function cnvs_com($d,$id){
$r=explode(' ',$d); $n=count($r);
for($i=0;$i<$n;$i++){list($p,$o)=split('=',$r[$i]); $ra=explode(',',$o);
switch($p){
case('line'):$ret.='ctx.fillStyle="#'.$ra[4].'"; ctx.moveTo('.$ra[0].','.$ra[1].'); ctx.lineTo('.$ra[2].','.$ra[3].'); ctx.stroke();'; break;
case('rect'):$ret.='ctx.fillStyle="#'.$ra[4].'"; ctx.fillRect('.$ra[0].','.$ra[1].','.$ra[2].','.$ra[3].'); '; break;
case('arc'):$ret.='ctx.beginPath(); ctx.arc('.$o.'*Math.PI); ctx.stroke();'; break;
case('circle'):$ret.='ctx.beginPath(); ctx.arc('.$ra[0].','.$ra[1].','.$ra[2].',0,2*Math.PI); ctx.fillStyle="#'.$ra[3].'"; ctx.stroke();'; break;
case('disk'):$ret.='ctx.beginPath(); ctx.arc('.$ra[0].','.$ra[1].','.$ra[2].',0,2*Math.PI); ctx.fillStyle="#'.$ra[3].'"; ctx.fill();'; break;
case('text'):$ret.='ctx.fillStyle="#'.$ra[5].'"; ctx.font="'.($ra[3]?$ra[3]:24).'px '.($ra[4]?$ra[4]:'Arial').'"; ctx.fillText("'.$ra[0].'",'.$ra[1].','.$ra[2].');'; break;
case('gradient'):$ret.='var grd=ctx.createLinearGradient(0,0,200,0); 
grd.addColorStop(0,"red"); grd.addColorStop(1,"white");
ctx.fillStyle=grd; ctx.fillRect(10,10,150,80);'; break;
}}
return js_code(cnvs_js($ret,$id));}

function canvas($d,$id,$s=''){
$s=$s?$s:$_SESSION['graphsz']; list($w,$h)=split('-',$s); $w=$w?$w:200; $h=$h?$h:60;
$ret=balc('canvas','" id="canvas'.$id.'" width="'.$w.'px" height="'.$h.'px" style="border:1px dotted grey;','');
$ret.=cnvs_com($d,$id);
return $ret;}

function cnvs_iframe($id,$b,$res){$d=ajxg($res);
$d=str_replace("\n",' ',$d);
return iframe('/plug/canvas.php?graphic='.$d.'&graphid='.$id.'&graphsz=420-300',440);}

function cnvs_edit($d,$id){
$d=str_replace(' ',"\n",$d); //$d=utf8_decode($d);
$ret.=lj('popbt','graph'.$id.'_plug___canvas_cnvs*iframe_'.$id.'__graphjs','see').br();
$ret.=txarea('" id="graphjs',$d,50,16);
return $ret;}

//http://www.w3schools.com/html/html5_canvas.asp
function plug_canvas($d,$s){
$id=randid(); if($s)$_SESSION['graphsz']=$s;
if(!$d)$d='rect=0,0,100,44,ff0000
rect=100,0,100,44,00ff00
disk=11,22,10,ffffff
line=20,22,80,22,00ff00
circle=100,22,20
disk=100,22,20,ffffff
line=120,22,180,22,00ff00
circle=190,22,10,000000
disk=190,22,9,ffffff
text=oeil,0,58,12,arial,ff0000
text=observé,77,58,12,arial
text=existant,158,58,12,arial';
$d=str_replace("\n",' ',$d);
$ret.=lj('popbt','popup_plup___canvas_cnvs*edit_'.ajx($d).'_'.$id,'edit');
$ret.=divd('graph'.$id,canvas($d,$id,$s));
return $ret;}

if($_GET['graphic'])echo canvas($_GET['graphic'],$_GET['graphid'],$_GET['graphsz']);

?>