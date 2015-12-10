<?php

/*
dates to nb days:
http://www.lecalendrier.fr/nombre-de-jours-entre-deux-dates
10/08/2003=eon 3, xee 5967
eon 4 = 26/07/2003 (5952 days later)
23/11/2015 = 4504 days later = eon 4, 
*/

class uclock{
//translate(0px, 60px)
	function needle_css($id,$sz,$clr,$w,$h){return '
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
	
	public static function headers(){
		$unit=15;
		$size1=$unit*10;//xee
		$size2=$unit*15;//xsi
		$size3=$unit*20;//uiw
		$size4=$unit*18;//landmark
		$xeeColor='#990000';
		$xsiColor='#000099';
		$uiwColor='#009900';
		
		Head::add('csscode','
			.xeeColor{color:'.$xeeColor.';}
			.xsiColor{color:'.$xsiColor.';}
			.uiwColor{color:'.$uiwColor.';}
			#digit{
				position:absolute;
				margin:0px auto;
			}
			#clockFrame{
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
			'.self::needle_css('landmarkXee',$size1,$xeeColor,4,10).'
			'.self::needle_css('needleHour',$size1,$xeeColor,8,$size1/2).'
			'.self::needle_css('needleMin',$size2,$xsiColor,6,$size2/2).'
			'.self::needle_css('needleSec',$size3,$uiwColor,4,$size3/2).'
		');
		Head::add('jscode','
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
		
		//clock();
		');
	}
	
	#content
	public static function content($param,$inputs){
		$landmark='';
		$ret=Html::tag('div',array('id'=>'clock'),'');
		//landmarkUiwSub
		for($i=0;$i<60;$i++){
			$landmarkSub=Html::tag('div',array('id'=>'landmarkSub'),'');
			$ret.=Html::tag('div',array('id'=>'landmarkFrame','style'=>'transform: rotate('.($i*6).'deg);'),$landmarkSub);}
		//landmarkUiw
		for($i=0;$i<12;$i++){
			$landmark=Html::tag('div',array('id'=>'landmark'),'');
			$ret.=Html::tag('div',array('id'=>'landmarkFrame','style'=>'transform: rotate('.($i*30).'deg);'),$landmark);
			//landmarkText
			$hour=Html::tag('div',array('id'=>'landmarkText','style'=>'transform: rotate(-'.($i*30).'deg);'),($i?$i*50:600));
			$ret.=Html::tag('div',array('id'=>'landmarkTextFrame','style'=>'transform: rotate('.($i*30).'deg);'),$hour);}
		//landmarkXee
		/*for($i=0;$i<12;$i++){
			$landmarkSub=Html::tag('div',array('id'=>'landmarkXee'),'');
			$ret.=Html::tag('div',array('id'=>'landmarkXeeFrame','style'=>'transform: rotate('.($i*30).'deg);'),$landmarkSub);}*/
		$needleHour=Html::tag('div',array('id'=>'needleHour'),' ');
		$ret.=Html::tag('div',array('id'=>'needleHourFrame'),$needleHour);
		$needleMin=Html::tag('div',array('id'=>'needleMin'),' ');
		$ret.=Html::tag('div',array('id'=>'needleMinFrame'),$needleMin);
		$needleSec=Html::tag('div',array('id'=>'needleSec'),' ');
		$ret.=Html::tag('div',array('id'=>'needleSecFrame'),$needleSec);
		$ret.=Html::tag('div',array('id'=>'clockCenter'),'');
		//digit
		$digit=Html::tag('span',array('id'=>'xee','class'=>'xeeColor'),'');
		$digit.=Html::tag('span',array('id'=>'xsi','class'=>'xsiColor'),'');
		$digit.=Html::tag('span',array('id'=>'uiw','class'=>'uiwColor'),'');
		$ret.=Html::tag('div',array('id'=>'digit'),'Eon 4 '.$digit);
		$ret.=js_code('clock();');
		//echo mktime(4,0,0,7,26,2003);
		return Html::tag('div',array('id'=>'clockFrame'),$ret);
	}
}

?>