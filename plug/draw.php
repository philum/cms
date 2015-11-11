<?php
//philum_plugin_draw
session_start();
error_reporting(6135);
if(!function_exists('p'))require('../progb/lib.php');

function draw_js(){return '
$(document).ready(function(){
	var color="#000"; 
	var painting=false; 
	var started=false; 
	var width_brush=5; 
	var canvas=$("#canvas"); 
	var cursorX, cursorY; 
	var restoreCanvasArray=[]; 
	var restoreCanvasIndex=0; 
	var context=canvas[0].getContext("2d");
	context.lineJoin="round"; context.lineCap="round";
	canvas.mousedown(function(e){painting=true;
		cursorX=(e.pageX-this.offsetLeft);
		cursorY=(e.pageY-this.offsetTop);});
	$(this).mouseup(function(){painting=false; started=false;});
	canvas.mousemove(function(e){
		if (painting){
			cursorX=(e.pageX-this.offsetLeft); 
			cursorY=(e.pageY-this.offsetTop);
			drawLine();}});
	function drawLine(){
		if (!started){
			context.beginPath();
			context.moveTo(cursorX, cursorY);
			started=true;} 
		else{
			context.lineTo(cursorX, cursorY);
			context.strokeStyle=color;
			context.lineWidth=width_brush;
			context.stroke();}}
	function clear_canvas(){
		context.clearRect(0,0, canvas.width(), canvas.height());}
	$("#couleurs a").each(function(){
		$(this).css("background", $(this).attr("data-couleur"));
		$(this).click(function(){
			color=$(this).attr("data-couleur");
			$("#couleurs a").removeAttr("class", "");
			$(this).attr("class", "actif");
			return false;});});
	$("#largeurs_pinceau input").change(function(){
		if (!isNaN($(this).val())){
			width_brush=$(this).val();
			$("#output").html($(this).val() + " pixels");}});
	$("#reset").click(function(){
		clear_canvas();
		$("#largeur_pinceau").attr("value", 5);
		width_brush=5;
		$("#output").html("5 pixels");});
	$("#save").click(function(){
		var canvas_tmp=document.getElementById("canvas");
		window.location=canvas_tmp.toDataURL("image/png");
		//insert("["+canvas_tmp.toDataURL()+":img]"); Close("popup");
		//SaveJ("popup_plup___draw_draw*save_"+canvas_tmp.toDataURL());
		//alert(canvas_tmp.toDataURL());
		});});
';}

function draw_save($d){$f='img/draw_temp.png'; //$d.='=';
//echo txarea('',$d,20,10);//(substr($d,22));
write_file($f,base64_decode(substr($d,22)));
return image($f);}

function draw_css(){return '#canvas{border:1px solid #999; margin:0; display:block; background:#fff; cursor:crosshair;}
#couleurs{list-style:none; margin:0; padding:0;}
#couleurs li{display:inline-block; border-radius:50%;}
#couleurs a{display:inline-block; width:10px; height:10px; margin-right:10px; text-indent:-4000px; overflow:hidden;}
#couleurs a.actif{width:20px; height:20px;}';}

function plug_draw($w,$h){if(!$w)$w=400;//currentwidth();
$ret.=js_link('/js/jquery.js'); //$_SESSION['headr'].=
$ret.=js_code(draw_js());
$ret.=css_code(draw_css());
$ret.=balc('canvas','" id="canvas" width="'.$w.'px" height="'.$h.'px','');
$r=array('black','white','blue','green','yellow','orange','brown','red','indigo','violet','pink','cyan'); $n=count($r);
for($i=0;$i<$n;$i++){
	$c='" style="background: none repeat scroll 0% 0% '.$r[$i].';" data-couleur="'.$r[$i];
	$cl.=balc('li','',lka($c,$r[$i]));}
$ret.=balc('ul','" id="couleurs',$cl);
$inp=label('largeur_pinceau','','','width');
$inp.=input('range','largeur_pinceau',5,'" min="2" max="20" size=1');
//$inp.=balc('output','" id="output','pixels');
$inp.=input('reset','reset','reset','');
$inp.=input('button','save','save','');
$ret.='<form id="largeurs_pinceau">'.$inp.'</form>';
return $ret;}

?>