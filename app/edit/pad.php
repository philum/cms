<?php

class pad{

	public static function headers(){
		Head::add('csscode','
		#txarea{
			font-size:large; 
			border:1px dotted grey; 
			padding:8px 12px; 
			width:95%; 
			height:calc(100vh - 100px); 
			overflow-y:auto;
		}');
	}
	
	#content
	public static function content($param,$inputs){
		$ret=Html::tag('a','id=ckb,class=popbt,onclick=memStorage(\'txarea_m1_res\');','restore');
		$ret.=Html::tag('a','id=ckc,class=popbt,onclick=memStorage(\'txarea_m1_sav\');','save').br();
		$ret.=Html::tag('textarea',array('id'=>'txarea'),'');
		$ret.=js_code('
		if(localStorage["m1"]!=undefined)
			document.getElementById("txarea").value=localStorage["m1"];');
		return $ret;
	}
}

?>