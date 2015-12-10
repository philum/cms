<?php

class pray{

	private static $appDb='ummo/pray/1511';
	private static $nbDays=8;
	private static $startDate='14 nov 2015';

	public static function headers(){
		Head::add('csscode','
	.minibtn{padding:4px; font-size:smaller;}
	.minicon{display:inline-block; width:90%; height:32px; background:#eee; border:1px solid grey;}
	.minicon.active {background:lightgreen; border:1px solid green;}
	.minicon:hover{background:white;}
	.minicon.active:hover {background:palegreen;}');
	}
	
	static function annonce(){
		$ret='Que les causes des crimes soient mis au jour, et les coupables dénoncés.
		Que les crimes de la finance soient dénoncés.
		Qu\'émergent les conditions pour une société plus juste.
		Que les hommes vivent dans la fraternité.';
		return Build::addPtags($ret);
	}
	
	static function dataUsr(){
		return array('u1'=>'dav','u2'=>'did','u3'=>'ger','u4'=>'jfd','u5'=>'flo','u6'=>'cri','u7'=>'can','u8'=>'ced');
	}
	
	static function dataInit(){echo 'reset';
		$r=self::dataUsr();
		foreach($r as $k=>$v)$ret[]=array($k,0);
		Data::write(self::$appDb,$ret);
		return $ret;
	}
	
	static function dataDays(){$ret[0]=''; $nb=self::$nbDays;
		$firstDay=strtotime(self::$startDate);
		for($i=1;$i<$nb;$i++){
			$ret[]=strftime('%a %d',$firstDay+(86400*$i));
		}
		return $ret;
	}

	public static function userNameFromId(){
		$rusr=self::dataUsr();
		$uid=Core::session('prayusr');
		return isset($rusr[$uid])?$rusr[$uid]:'';
	}

	public static function uidNameFromName($usrName){
		$r=self::dataUsr();
		foreach($r as $k=>$v)if($v==$usrName)return $k;
	}

	public static function exists($appDb,$uid,$day){
		foreach($appDb as $k=>$v)if($v[0]==$uid && $v[1]==$day)return $k;
	}

	public static function save($params,$inputs){
		$uid=$params['v1']; $day=$params['v2'];
		$r=Data::read(self::$appDb); 
		if(isset($r))$id=self::exists($r,$uid,$day);
		if(isset($id))unset($r[$id]); else $r[]=array($uid,$day);
		Data::write(self::$appDb,$r);
		return self::build();
	}
	
	static function saveFromGet($params){//p($params);
		$r=Data::read(self::$appDb); //p($r);
		if(isset($params['name']))$uid=self::uidNameFromName($params['name']);
		if(isset($uid))$_SESSION['prayusr']=$uid;
		if(isset($params['day']))$day=$params['day'];
		if(isset($params['reset']))self::dataInit(); //reset base
		if(isset($r,$uid,$day))$id=self::exists($r,$uid,$day);
		if(!isset($id) && isset($uid) && isset($day))
			Data::add(self::$appDb,array($uid,$day));
	}

	public static function btn($uid,$day,$act){$c=$act?' active':'';
		if($uid!=Core::session('prayusr'))
			return Html::tag('span','class=minicon opac'.$c,' ');
		$com=array('target'=>Core::session('prayid'),'txt'=>' ','css'=>'minicon'.$c);
		$params=array('appName'=>'pray','appMethod'=>'save','v1'=>$uid,'v2'=>$day);
		$inputs=array('inp'=>'placeholder');
		return Core::ajax($com,$params,$inputs);
	}

	public static function fill($r){$ret=''; $nb=self::$nbDays;
		for($i=1;$i<$nb;$i++)$ret[$i]=isset($r[$i])?1:0;
		return $ret;}
	
	public static function pointer(){
		if($userName=self::userNameFromId())
			return Html::tag('a',array('href'=>'/pray:name='.$userName.',day=','class'=>'btn'),'urlPointer').' ';
	}

	public static function build(){
		//Data::del(self::$appDb);
		$r=Data::read(self::$appDb); //p($r);
		$rusr=self::dataUsr(); //p($rusr);
		$uid=Core::session('prayusr');
		if($uid)$userName=$rusr[$uid];
		if(isset($r))foreach($r as $k=>$v)$ra[$v[0]][$v[1]]=1;//collect rows
		foreach($rusr as $k=>$v)$row[$k]=self::fill(@$ra[$k]);//fill empties //$rusr[$k]
		$rb[0]=self::dataDays();//headers
		if(isset($ra))foreach($row as $k=>$v){
			foreach($v as $ka=>$va)
				$rb[$k][$ka]=self::btn($k,$ka,$va); //pr($rb);
				$key=Html::tag('span','class=minibtn',$k==$uid?$userName:$k);
				array_unshift($rb[$k],$key);
			}
		if(isset($rb))return Build::table($rb,'minibtn','',1).self::pointer();
	}

	public static function login($params,$inputs){
		$rusr=self::dataUsr();
		if($key=Core::in_array_key($inputs['inp'],$rusr)){
			$_SESSION['prayusr']=$key;
			$ret='loged: '.Core::session('prayusr');
		}
		else $ret='unknown user';
		return self::build();//$ret.
	}

	public static function log(){
		$com=array('target'=>Core::session('prayid'),'txt'=>'ok','css'=>'btn');
		$params=array('appName'=>'pray','appMethod'=>'login');
		$inputs=array('inp'=>'placeholder');
		return Core::ajax($com,$params,$inputs);
	}

	public static function popup(){
		$j=new Ajax;
		$j->setCallbackMethod('showInPopup','');
		$j->setComponent('open',array('appName'=>'pray','appMethod'=>'annonce'));
		return Html::tag('a',array('class'=>'btn','onclick'=>$j->getControler()),'Read Text');
	}
	
	#content
	public static function content($params,$inputs){
	    $_SESSION['prayid']=Core::randId('priv');
		if(isset($params))self::saveFromGet($params);
		$login=Html::tag('input','id=inp,placeholder=uid','',1).self::log().' ';
		$table=Html::tag('div',array('id'=>Core::session('prayid'),'style'=>'height:400px;'),self::build());
		$content=self::popup();
		$btns=Html::tag('a',array('href'=>'/pray:reset=1','class'=>'btn'),'reset db');
		$footer=Html::tag('div','class=small','users: '.implode(' - ',self::dataUsr()));
	    return $login.$btns.$content.$table.$footer;//
	}
}

?>