<?php
//philum_plugin_uclock

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
		transform: rotate(0deg);
	}';}

function uclock_css(){
	$unit=15;
	$size1=$unit*10;//xee
	$size2=$unit*15;//xsi
	$size3=$unit*20;//uiw
	$size4=$unit*18;//landmark
	$xeeColor='#990000';
	$xsiColor='#000099';
	$uiwColor='#009900';
	
	return '
	.xeeColor{color:'.$xeeColor.';}
	.xsiColor{color:'.$xsiColor.';}
	.uiwColor{color:'.$uiwColor.';}
	#digit{
		position:absolute;
		margin:0px auto;
	}
	#clockFrame{
		background:#fff;
		width:'.($size3+40).'px;
		height:'.($size3+60).'px;
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
		transform: rotate(0deg) translate(0px, -2px); 
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
		transform: rotate(0deg); 
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
		transform: rotate(0deg); 
	}
	'.uclock_needle_css('landmarkXee',$size1,$xeeColor,4,10).'
	'.uclock_needle_css('needleHour',$size1,$xeeColor,8,$size1/2).'
	'.uclock_needle_css('needleMin',$size2,$xsiColor,6,$size2/2).'
	'.uclock_needle_css('needleSec',$size3,$uiwColor,4,$size3/2).'
	';}

function uclock_js(){return '
	function clock(){
		//1 uiw = 3.0921 min = 3 min + 5.552599999 sec = 185526 sec
		//1 xsi = 600.0117 uiw = 111317770.6542 sec = 1855.29617757 min
		//1 xee = 60 xsi = 6679066239.252 sec = 111317,7706542 min
		
		//26/07/2003
		var eon4=1059184800; //mktime 1448324820
		var date=new Date();
		var time=Math.round(date.getTime()/1000); //alert(time);
		//ummo timestamp
		var ummoTimestamp=time-eon4; //alert(ummoTimestamp); //389140068 sec
		var minutesLeft=ummoTimestamp/60; //alert(minutesLeft);
		var daysLeft=ummoTimestamp/60/60/24; //alert(daysLeft); //4503.9556018518515 days
		var nbSecondsByXsi=111317770.6542;
		var nbMinutesByXee=111317.7706542;
		var nbSecondsByXee=6679066239.252;
		var nbUiwByXsi=600.0117;
		//nb of xee
		var nbXee=minutesLeft/nbMinutesByXee; //alert(nbXee);
		var xee=Math.floor(nbXee); //alert(xee);
		var xeeLeft=nbXee-xee; //alert(xeeLeft);
		//nb of xsi
		var nbXsi=xeeLeft*60; //alert(nbXsi);
		var xsi=Math.floor(nbXsi); //alert(xsi);
		var xsiLeft=nbXsi-xsi; //alert(xsiLeft);
		//nb of uiw
		var nbUiw=xsiLeft*nbUiwByXsi; //alert(uiw);
		var uiw=Math.floor(nbUiw);
		
		document.getElementById("xee").innerHTML="XEE "+(Math.round(nbXee*100)/100);
		document.getElementById("xsi").innerHTML="XSI "+(Math.round(nbXsi*100)/100);
		document.getElementById("uiw").innerHTML="UIW "+(Math.round(nbUiw*100000)/100000);
		
		needlePos(xee/100,"needleHourFrame");
		needlePos(xsi,"needleMinFrame");
		needlePos(uiw/10,"needleSecFrame");
	}
	function needlePos(sec,needle){
		var el=document.getElementById(needle);
		var deg=sec*6; //alert(deg);
		el.style.transform="rotate("+deg+"deg)";
	}
	
	setInterval(function(){clock();},1000);
	
	//clock();';}

function uclock_head(){
	header_add('csscode',uclock_css());
	header_add('jscode',uclock_js());}

function plug_uclock($p,$o){//$rid='plg'.randid();
	//echo mktime(4,0,0,7,26,2003);
	uclock_head();
	if($_GET['callj'])$head=headers_r($d?$d:'plugins').'<body>';
	$ret=balise('div',array('id'=>'clock'),'');
	//landmarkUiwSub
	for($i=0;$i<60;$i++){
		$landmarkSub=balise('div',array('id'=>'landmarkSub'),'');
		$ret.=balise('div',array('id'=>'landmarkFrame','style'=>'transform: rotate('.($i*6).'deg);'),$landmarkSub);}
	//landmarkUiw
	for($i=0;$i<12;$i++){
		$landmark=balise('div',array('id'=>'landmark'),'');
		$ret.=balise('div',array('id'=>'landmarkFrame','style'=>'transform: rotate('.($i*30).'deg);'),$landmark);
		//landmarkText
		$hour=balise('div',array('id'=>'landmarkText','style'=>'transform: rotate(-'.($i*30).'deg);'),($i?$i*50:600));
		$ret.=balise('div',array('id'=>'landmarkTextFrame','style'=>'transform: rotate('.($i*30).'deg);'),$hour);}
	$needleHour=balise('div',array('id'=>'needleHour'),' ');
	$ret.=balise('div',array('id'=>'needleHourFrame'),$needleHour);
	$needleMin=balise('div',array('id'=>'needleMin'),' ');
	$ret.=balise('div',array('id'=>'needleMinFrame'),$needleMin);
	$needleSec=balise('div',array('id'=>'needleSec'),' ');
	$ret.=balise('div',array('id'=>'needleSecFrame'),$needleSec);
	//digit
	$digit=balise('span',array('id'=>'xee','class'=>'xeeColor'),'');
	$digit.=balise('span',array('id'=>'xsi','class'=>'xsiColor'),'');
	$digit.=balise('span',array('id'=>'uiw','class'=>'uiwColor'),'');
	$ret.=balise('div',array('id'=>'digit'),'Eon 4 '.$digit);
	$ret.=js_code('clock();');
	return $head.balise('div',array('id'=>'clockFrame'),$ret);
}

?>