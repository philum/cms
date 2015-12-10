<?php

class Core{
	#dirs
	public static function readDir($files,$func,$vars=''){
		$ret=array();
		foreach($files as $key=>$file)
			if(is_array($file))
				$ret=array_merge($ret,self::readDir($file,$func,$vars));
			else $ret[]=call_user_func($func,$file,$vars);
		return $ret;
	}
	public static function scanDir($dir){
		$elements=scandir($dir); $ret=array();
		foreach($elements as $k=>$v){
      		if(!in_array($v,array('.','..','_notes'))){ 
				if(is_dir($dir.'/'.$v))$ret[$v]=self::scanDir($dir.'/'.$v);
				else $ret[]=$v;
			}
		}
		return $ret;
	}
	
	#strings
	public static function strExtract($value,$spliter,$position='',$segment=''){
		$pos=$position==1?strrpos($value,$spliter):strpos($value,$spliter);
		if($pos===false)return $value;
		return $segment==1?substr($value,$pos+1):substr($value,0,$pos);
	}
	
	#ajax
	public static function ajax($com,$params='',$inputs=''){
		$j=new Ajax;
		$j->setCallbackMethod('showInDivId',$com['target']);
		$j->setComponent('open',$params);
	    if(isset($inputs))$j->setInputs($inputs);
		$compute=array('class'=>$com['css'],'onclick'=>$j->getControler());
		return Html::tag('a',$compute,$com['txt']);
	}
	
	#mecanics
	public static function arrayExtract($d,$split,$separator){
		$ret='';
		$r=explode($separator,$d);
		if($r)foreach($r as $k=>$v){
			$rb=explode($split,$v);
			$ret[$rb[0]]=isset($rb[1])?$rb[1]:'';
		}
		return $ret;
	}
	
	public static function randId($prefix=''){//uniqid()
		return $prefix.substr(microtime(),2,6);}
	public static function in_array_key($va,$r){
		foreach($r as $k=>$v)if($v==$va)return $k;}

	#controls
	public static function get($d,$json=''){
		if(isset($_GET[$d]))return urldecode($_GET[$d]);}
	public static function getJson($d){
		if(isset($_GET[$d]))return json_decode($_GET[$d],true);}
	public static function post($d){
		if(isset($_POST[$d]))return $_POST[$d];}
	public static function session($d){
		if(isset($_SESSION[$d]))return $_SESSION[$d];}
	public static function setSessionFromGet($d){
		if(isset($_GET[$d]))$_SESSION[$d]=$_GET[$d];}
	
	#dev
	public static function chrono($name){$ret=''; static $start;
		if(!$name)$start=array_sum(explode(' ',microtime())); 
		else return $name.': '.round(array_sum(explode(' ',microtime()))-$start,5).'ms';}	
}
?>