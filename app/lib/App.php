<?php
class App{
	public static function open($appName,$params='',$inputs=''){$ret='';
		if(!is_array($params) && strpos($params,'{')!==false)$params=json_decode($params,true);
		if(!isset($appName))throw new Exception('No app was loaded');
		if(method_exists($appName,'headers')){$appName::headers();
			if(isset($_GET['callj']))$ret=Head::generate();}
		if(isset($params['appMethod']))$appMethod=$params['appMethod'];
		else $appMethod='content';
		if(method_exists($appName,$appMethod))$ret.=$appName::$appMethod($params,$inputs);
		return $ret;
	}
}
?>