<?php
class Html{
	//Tag
	public static function tag($tag,$props,$txt='',$short=''){$ret='';
		if(is_string($props))
			$props=Core::arrayExtract($props,'=',',');
		if(is_array($props))
			foreach($props as $prop=>$attr)
				$ret.=self::setAttribut($prop,$attr);
		if($short)return '<'.$tag.$ret.' />'."\n";
		else return '<'.$tag.$ret.'>'.$txt.'</'.$tag.'>'."\n";
	}
	//attributs
	public static function setAttribut($attr,$prop){
		return $prop?' '.$attr.'="'.$prop.'"':'';
	}
	public static function jsInsetAttribut($func,$vars){$varJsArray='';
		if(is_array($vars)){
			foreach($vars as $var)
				$varJsArray[]=$var;
				$vars=implode('\',\'',$varJsArray);
		}
		return $func?$func.($vars?'(\''.$vars.'\')':''):'';
	}
	//select
	public static function select($optionsArray,$attrArray,$params){$ret='';
		if($optionsArray)foreach($optionsArray as $k=>$v){
			if($params['keyvalue']=='v')$k=$v; elseif($params['keyvalue']=='k')$v=$k;
			if($k==$params['selected'])$chk='selected'; else $chk='';
			$ret.=self::tag('option',array('value'=>$k,'selected'=>$chk),$v);
		}
		return self::tag('select',$attrArray,$ret);
	}
	public static function image($src,$width='',$height='',$style='',$class=''){
        return self::tag('img',array('src'=>$src,'width'=>$width,'height'=>$height,'style'=>$style,'class'=>$class),'','shortTag');
	}
}