<?php
//philum_plugin_clock

function uclock_needle_css($id,$sz,$clr,$w,$h){return '
	#'.$id.'{
		background:'.$clr.';
		width:'.$w.'px;
		height:'.$h.'px;
		margin:0px auto;
	}
	#'.$id.'Frame{
		width:'.$sz.'px;
		height:'.$sz.'px;
		position:absolute;
		left:calc(50% - '.($sz/2).'px);
		top:calc(50% - '.($sz/2).'px);
		transform:rotate(0deg);
		transition: all 0.2s linear;
	}';}

function clock_head(){
	$unit=15;
	$size1=$unit*10;//xee
	$size2=$unit*15;//xsi
	$size3=$unit*20;//uiw
	$size4=$unit*18;//landmark
	$hourclr='#990000';
	$minclr='#000099';
	$secclr='#009900';
	
	Head::add('csscode','
	#clockFrame{
		background:#fff;
		width:'.($size3+40).'px;
		height:'.($size3+60).'px;
		padding:10px;
		position:relative;
	}
	#clock{
		background:#fff;
		border:2px solid grey;
		width:'.$size3.'px;
		height:'.$size3.'px;
		position:absolute;
		left:calc(50% - '.($size3/2).'px);
		top:calc(50% - '.($size3/2).'px);
		border-radius:'.($size3/2).'px;
		transform:rotate(0deg) translate(0px, -2px); 
	}
	#landmark{
		border:1px solid #555;
		background:#555;
		width:1px;
		height:10px;
		margin:0px auto;
	}
	#landmarkSub{
		border:1px solid #999;
		background:#999;
		width:1px;
		height:5px;
		margin:0px auto;
	}
	#landmarkFrame{
		width:'.$size3.'px;
		height:'.$size3.'px;
		position:absolute;
		left:calc(50% - '.($size3/2).'px);
		top:calc(50% - '.($size3/2).'px);
		transform:rotate(0deg); 
	}
	#landmarkText{
		text-align:center;
		margin:0px auto;
	}
	#landmarkTextFrame{
		width:'.$size4.'px;
		height:'.$size4.'px;
		position:absolute;
		left:calc(50% - '.($size4/2).'px);
		top:calc(50% - '.($size4/2).'px);
		transform:rotate(0deg); 
	}
	#clockCenter{
		border:2px solid grey;
		background:white;
		width:16px;
		height:16px;
		position:absolute;
		left:calc(50% - 9px);
		top:calc(50% - 9px);
		border-radius:8px;
	}
	'.uclock_needle_css('needleHour',$size1,$hourclr,8,$size1/2).'
	'.uclock_needle_css('needleMin',$size2,$minclr,6,$size2/2).'
	'.uclock_needle_css('needleSec',$size3,$secclr,4,$size3/2).'
	');
	
	Head::add('jscode',clock_js());
}

function clock_js(){return '
	function clock(){
		var date=new Date();
		var time=Math.round(date.getTime()/1000);
		var day=date.getDate();
		var hour=date.getHours();
		var min=date.getMinutes();
		var sec=date.getSeconds();
		document.getElementById("digit").innerHTML=hour+":"+min+":"+sec;
		//timer=setTimeout(function(){clock()},1000);
		needlePos(hour,"needleHour");
		needlePos(min,"needleMin");
		needlePos(sec,"needleSec");
	}
	function needlePos(val,needle){
		var el=document.getElementById(needle+"Frame");
		//document.getElementById(needle)=val;
		var deg=val?val*6:360; //alert(deg);
		el.style.transform="rotate("+deg+"deg)";
	}
	setInterval(function(){clock();},1000);';}

function plug_clock($p,$o){
clock_head();
	$ret=bal('div',array('id'=>'clock'),'');
	//landmarkSub
	for($i=0;$i<60;$i++){
		$landmarkSub=bal('div',array('id'=>'landmarkSub'),'');
		$ret.=bal('div',array('id'=>'landmarkFrame','style'=>'transform: rotate('.($i*6).'deg);'),$landmarkSub);}
	//landmark
	for($i=0;$i<12;$i++){
		$landmark=bal('div',array('id'=>'landmark'),'');
		$ret.=bal('div',array('id'=>'landmarkFrame','style'=>'transform: rotate('.($i*30).'deg);'),$landmark);
		$hour=bal('div',array('id'=>'landmarkText','style'=>'transform: rotate(-'.($i*30).'deg);'),($i?$i:12));
		$ret.=bal('div',array('id'=>'landmarkTextFrame','style'=>'transform: rotate('.($i*30).'deg) translate(0px, 0px);'),$hour);}
	$needleMin=bal('div',array('id'=>'needleHour'),' ');
	$ret.=bal('div',array('id'=>'needleHourFrame'),$needleMin);
	$needleMin=bal('div',array('id'=>'needleMin'),' ');
	$ret.=bal('div',array('id'=>'needleMinFrame'),$needleMin);
	$needleSec=bal('div',array('id'=>'needleSec'),' ');
	$ret.=bal('div',array('id'=>'needleSecFrame'),$needleSec);
	$ret.=bal('div',array('id'=>'clockCenter'),'');
	$ret.=bal('div',array('id'=>'digit'),'');
	$ret.=js_code('clock();');
	$ret=bal('div',array('id'=>'clockFrame'),$ret);
return $ret;}

?>