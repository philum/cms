<?php

class clock{
//translate(0px, 60px)
	public static function headers(){
		Head::add('csscode','
		#clock{
			border:2px solid grey;
			width:140px;
			height:140px;
			position:absolute;
			left:calc(50% - 70px);
			top:calc(50% - 70px);
			border-radius:70px;
			transform: rotate(0deg) translate(0px, -2px); 
		}
		#landmark{
			border:1px solid #555;
			background:#555;
			width:1px;
			height:10px;
			margin:0px auto;
		}
		#landmarkFrame{
			width:140px;
			height:140px;
			position:absolute;
			left:calc(50% - 70px);
			top:calc(50% - 70px);
			transform: rotate(0deg); 
		}
		#landmarkText{
			text-align:center;
			margin:0px auto;
		}
		#landmarkTextFrame{
			width:110px;
			height:110px;
			position:absolute;
			left:calc(50% - 55px);
			top:calc(50% - 55px);
			transform: rotate(0deg); 
		}
		#needleHour{
			background:#555;
			border:0px solid grey;
			width:4px;
			height:50px;
			margin:0px auto;
		}
		#needleHourFrame{
			border:0px solid grey;
			width:100px;
			height:100px;
			position:absolute;
			left:calc(50% - 50px);
			top:calc(50% - 50px);
			transform: rotate(0deg); 
			/*transition: all 0.2s linear;*/
		}
		#needleMin{
			background:#888;
			border:0px solid grey;
			width:4px;
			height:60px;
			margin:0px auto;
		}
		#needleMinFrame{
			border:0px solid grey;
			width:120px;
			height:120px;
			position:absolute;
			left:calc(50% - 60px);
			top:calc(50% - 60px);
			transform: rotate(0deg); 
			/*transition: all 0.2s linear;*/
		}
		#needleSec{
			background:#bbb;
			border:0px solid grey;
			width:4px;
			height:70px;
			margin:0px auto;
		}
		#needleSecFrame{
			border:0px solid grey;
			width:140px;
			height:140px;
			position:absolute;
			left:calc(50% - 70px);
			top:calc(50% - 70px);
			transform: rotate(0deg); 
			/*transition: all 0.5s ease-in-out;*/
		}
		');
		Head::add('jscode','
		function clock(){
			var date=new Date();
			var time=Math.round(date.getTime()/1000); //alert(time);
			var day=date.getDate(); //alert(day);
			var hour=date.getHours(); //alert(hour);
			var min=date.getMinutes(); //alert(min);
			var sec=date.getSeconds(); //alert(sec);
			document.getElementById("result").innerHTML=hour+":"+min+":"+sec;
			//timer=setTimeout(function(){clock()},1000);
			needlePos(hour,"needleHourFrame");
			needlePos(min,"needleMinFrame");
			needlePos(sec,"needleSecFrame");
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
		for($i=0;$i<12;$i++){
			$landmark=Html::tag('div',array('id'=>'landmark'),'');
			$ret.=Html::tag('div',array('id'=>'landmarkFrame','style'=>'transform: rotate('.($i*30).'deg);'),$landmark);
			$hour=Html::tag('div',array('id'=>'landmarkText','style'=>'transform: rotate(-'.($i*30).'deg);'),($i?$i:12));
			$ret.=Html::tag('div',array('id'=>'landmarkTextFrame','style'=>'transform: rotate('.($i*30).'deg) translate(0px, 0px);'),$hour);}
		$needleMin=Html::tag('div',array('id'=>'needleHour'),' ');
		$ret.=Html::tag('div',array('id'=>'needleHourFrame'),$needleMin);
		$needleMin=Html::tag('div',array('id'=>'needleMin'),' ');
		$ret.=Html::tag('div',array('id'=>'needleMinFrame'),$needleMin);
		$needleSec=Html::tag('div',array('id'=>'needleSec'),' ');
		$ret.=Html::tag('div',array('id'=>'needleSecFrame'),$needleSec);
		$ret.=Html::tag('div',array('id'=>'result'),'');
		$ret.=Head::jsCode('clock();');
		return $ret;
	}
}

?>