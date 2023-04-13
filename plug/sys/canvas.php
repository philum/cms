<?php //canvas
class canvas{
static $conn=1;

static function js($d,$id){return '
var c=document.getElementById("canvas'.$id.'");
var ctx=c.getContext("2d");
'.$d.'';}

static function com($d,$id){
$r=explode(' ',$d); $n=count($r);
for($i=0;$i<$n;$i++){[$p,$o]=explode('=',$r[$i]); $ra=explode(',',$o);
switch($p){
case('line'):$ret.='ctx.fillStyle="#'.$ra[4].'"; ctx.moveTo('.$ra[0].','.$ra[1].'); ctx.lineTo('.$ra[2].','.$ra[3].'); ctx.stroke();'; break;
case('rect'):$ret.='ctx.fillStyle="#'.$ra[4].'"; ctx.fillRect('.$ra[0].','.$ra[1].','.$ra[2].','.$ra[3].'); '; break;
case('arc'):$ret.='ctx.beginPath(); ctx.arc('.$o.'*Math.PI); ctx.stroke();'; break;
case('circle'):$ret.='ctx.beginPath(); ctx.arc('.$ra[0].','.$ra[1].','.$ra[2].',0,2*Math.PI); ctx.fillStyle="#'.$ra[3].'"; ctx.stroke();'; break;
case('disk'):$ret.='ctx.beginPath(); ctx.arc('.$ra[0].','.$ra[1].','.$ra[2].',0,2*Math.PI); ctx.fillStyle="#'.$ra[3].'"; ctx.fill();'; break;
case('text'):$ret.='ctx.fillStyle="#'.$ra[5].'"; ctx.font="'.($ra[3]?$ra[3]:24).'px '.($ra[4]?$ra[4]:'Arial').'"; ctx.fillText("'.$ra[0].'",'.$ra[1].','.$ra[2].');'; break;
case('gradient'):$ret.='var grd=ctx.createLinearGradient(0,0,200,0); 
grd.addColorStop(0,"red"); grd.addColorStop(1,"white");
ctx.fillStyle=grd; ctx.fillRect(10,10,150,80);'; break;}}
return jscode(self::js($ret,$id));}

static function call($d,$id,$s=''){
$s=$s?$s:$_SESSION['graphsz']; [$w,$h]=explode('-',$s); $w=$w?$w:200; $h=$h?$h:60;
$ret=tag('canvas',['id'=>'canvas'.$id,'width'=>$w.'px','height'=>$h.'px','style'=>'border:1px dotted grey;'],'');
$ret.=self::com($d,$id);
return $ret;}

static function iframe($id,$b,$prm){$d=prm[0]??'';
$d=str_replace("\n",' ',$d);
return iframe('/app/canvas/'.$d.'/'.$id.'&fz=420-300',440);}

static function edit($d,$id){
$d=str_replace(' ',"\n",$d); //$d=utf8dec_b($d);
$ret.=lj('popbt','graph'.$id.'_canvas,iframe_graphjs__'.$id,'see').br();
$ret.=textarea('',$d,50,16,['id'=>'graphjs']);
return $ret;}

static function ex(){return 'rect=0,0,100,44,ff0000
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
text=existant,158,58,12,arial';}

//http://www.w3schools.com/html/html5_canvas.asp
static function home($d,$s){
$id=randid(); if($s)$_SESSION['graphsz']=$s;
if(!$d)$d=self::ex();
$d=str_replace("\n",' ',$d);
$ret.=lj('popbt','popup_canvas,edit___'.ajx($d).'_'.$id,'edit');
$ret.=divd('graph'.$id,self::call($d,$id,$s));
return $ret;}
}
?>