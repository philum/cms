<?php
//philum_plugin_uclock
//http://www.ummo-sciences.org/activ/analyses/ana26.pdf

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
	$uiwHourColor='#990099';
	
	return '
	.xeeColor{color:'.$xeeColor.';}
	.xsiColor{color:'.$xsiColor.';}
	.uiwColor{color:'.$uiwColor.';}
	.uiwHourColor{color:'.$uiwHourColor.';}
	#digit{
		position:absolute;
		margin:0px auto;
		font-size:small;
	}
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
	'.uclock_needle_css('landmarkXee',$size1,$xeeColor,4,10).'
	'.uclock_needle_css('needleXee',$size1,$xeeColor,8,$size1/2).'
	'.uclock_needle_css('needleXsi',$size2,$xsiColor,6,$size2/2).'
	'.uclock_needle_css('needleUiw',$size3,$uiwColor,4,$size3/2).'
	'.uclock_needle_css('needleHour',$size2,$uiwHourColor,4,$size3/2).'
	';}

function uclock_js(){return '
	function clock(){
		//1 uiw = 3.0921 min = 3 min + 5.552599999 sec = 185,52599999 sec
		//1 xsi = 600.0117 uiw = 111317,770648199883 sec = 1855.29617746999805 min
		//1 xee = 60 xsi = 6679066,23889199298 sec = 111317,770648199883 min
		
		//26/07/2003 from calculation
		//09/07/2003 from nr18
		var eon4=1057716000; //mktime 1448324820
		var date=new Date();
		var time=Math.round(date.getTime()/1000);
		//ummo timestamp
		var ummoTimestamp=time-eon4; //389140068 sec
		var minutesLeft=ummoTimestamp/60;
		var daysLeft=ummoTimestamp/60/60/24; //alert(daysLeft); //4503.9556018518515 days
		var nbSecondsByXsi=111317770.6542;
		var nbMinutesByXee=111317.7706542;
		var nbSecondsByXee=6679066239.252;
		var nbUiwByXsi=600.0117;
		//nb of xee
		var nbXee=minutesLeft/nbMinutesByXee;
		var xee=Math.floor(nbXee);
		var xeeLeft=nbXee-xee;
		//nb of xsi
		var nbXsi=xeeLeft*60;
		var xsi=Math.floor(nbXsi);
		var xsiLeft=nbXsi-xsi;
		//nb of uiw
		var nbUiw=xsiLeft*nbUiwByXsi;
		var uiw=Math.floor(nbUiw);
		var uiwLeft=nbUiw-uiw;
		//nb of uiwHours
		var nbUiwHours=nbUiw/25; //on 24
		var uiwHour=Math.floor(nbUiwHours); //alert(uiwHour);
		var uiwHourLeft=nbUiwHours-uiwHour;
		//nb of uiwMin
		var nbUiwMin=uiwHourLeft/24;
		var uiwMin=Math.floor(nbUiwMin);
		
		document.getElementById("xee").innerHTML="XEE "+(Math.round(nbXee*100)/100);
		document.getElementById("xsi").innerHTML="XSI "+(Math.round(nbXsi*100)/100);
		document.getElementById("uiw").innerHTML="UIW "+(Math.round(nbUiw*100)/100);
		document.getElementById("uiwHour").innerHTML=" Hour "+(Math.round(nbUiwHours*100)/100);
		
		needlePos(xee/100,"needleXeeFrame");
		needlePos(xsi,"needleXsiFrame");
		needlePos(uiw/10,"needleUiwFrame");
		needlePos(nbUiwHours*4,"needleHourFrame");
	}
	function needlePos(sec,needle){
		var el=document.getElementById(needle);
		var deg=sec*6; //alert(deg);
		el.style.transform="rotate("+deg+"deg)";
	}
	
	setInterval(function(){clock();},1000);
	
	//clock();';}

function uclock_head(){
	Head::add('csscode',uclock_css());
	Head::add('jscode',uclock_js());}

function plug_uclock($p,$o){//$rid='plg'.randid();
	//echo mktime(4,0,0,7,26,2003); //1059184800
	//echo mktime(4,0,0,7,9,2003); //1057716000


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
		$hour=balise('div',array('id'=>'landmarkText','style'=>'transform: rotate(-'.($i*30).'deg);'),($i?$i*5:60));
		$ret.=balise('div',array('id'=>'landmarkTextFrame','style'=>'transform: rotate('.($i*30).'deg);'),$hour);}
	$needleXee=balise('div',array('id'=>'needleXee'),' ');
	$ret.=balise('div',array('id'=>'needleXeeFrame'),$needleXee);
	$needleXsi=balise('div',array('id'=>'needleXsi'),' ');
	$ret.=balise('div',array('id'=>'needleXsiFrame'),$needleXsi);
	$needleUiw=balise('div',array('id'=>'needleUiw'),' ');
	$ret.=balise('div',array('id'=>'needleUiwFrame'),$needleUiw);
	$needleHour=balise('div',array('id'=>'needleHour'),' ');
	$ret.=balise('div',array('id'=>'needleHourFrame'),$needleHour);
	$ret.=balise('div',array('id'=>'clockCenter'),'');
	//digit
	$digit=balise('span',array('id'=>'xee','class'=>'xeeColor'),'').' ';
	$digit.=balise('span',array('id'=>'xsi','class'=>'xsiColor'),'').' ';
	$digit.=balise('span',array('id'=>'uiw','class'=>'uiwColor'),'').' ';
	$digit.=balise('span',array('id'=>'uiwHour','class'=>'uiwHourColor'),'').' ';
	$ret.=balise('div',array('id'=>'digit'),'Aeon 4 '.$digit);
	$ret.=js_code('clock();');
	return $head.balise('div',array('id'=>'clockFrame'),$ret);
}

?>