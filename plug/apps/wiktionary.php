<?php //wiktionary

class wiktionary{

/*static function curl($f){$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$f);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_USERAGENT,'');
curl_setopt($ch,CURLOPT_COOKIE,'foo=bar');
$ret=curl_exec($ch);
curl_close($ch);
return $ret;}

static function xml2array($n){$ret=array();
foreach($n->childNodes as $nc)($nc->hasChildNodes())
?($n->firstChild->nodeName== $n->lastChild->nodeName&&$n->childNodes->length>1)
?$ret[$nc->nodeName][]=xml2array($item)
:$ret[$nc->nodeName]=xml2array($nc)
:$ret=$nc->nodeValue;
return $ret;}*/

static function explore($r){
foreach($r->childNodes as $k=>$v){
	if($v->hasChildNodes()){
		//$attr=$v->getAttribute('href');
		$tag=$v->tagName; //echo $tag.br();
		$val=$v->nodeValue;
		$a=$tag=='a'?ath($v->getAttribute('href')):'';
		if($tag && $val)$ret.=bal($tag,$a,self::explore($v));
		else $ret.=$val;
		}
	else{//pr($v);
		$va=$v->parentNode;
		$val=$v->nodeValue;
		$tag=$va->tagName;
		$id=$va->getAttribute('id');
		$css=$va->getAttribute('className');
		//echo $tag.'-'.$id.'-'.$css.br();
		if($tag=='div' && $id=='toc')$r->removeChild($v);
		elseif($tag=='div' && $css=='infobox_v3')$r->removeChild($v);
		elseif($tag=='span' && $css=='mw-editsection')$r->removeChild($v);//
		//elseif($tag=='span' && $val=='modifier le code')$r->removeChild($v);
		elseif($tag=='table')$r->removeChild($v);
		elseif($tag=='sup')$r->removeChild($v);
		//elseif($tag=='br')$r->removeChild($v);
		elseif($val!='modifier' && $val!='modifier le code' && $val!=' | ')$ret.=$val;
		//else $ret.=$val;
		//eco($val);
		}}
return $ret;}

static function build($p,$o){
$d=curl_get_contents($p);
$ret=html_detect($d,'<ol>');
$ret=utf82ascii($ret);
$ret=strip_tags($ret,''); //eco($ret);
$ret=nl2br($ret);
return $ret;}

static function call($p,$o,$res=''){
[$p,$o]=ajxp($res,$p,$o);
if(substr($p,0,4)!='http')$p='https://fr.wiktionary.org/wiki/'.$p;
$ret=self::build($p,$o); $bt='';
if($o)$bt=lj('','popup_app__3_wiktionary_call_'.ajx($p),picto('view')).' ';
$bt.=lka($p,picto('chain'));
return divc('twit '.($o?'small':''),$ret).$bt;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_app__3_wiktionary_call___inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('wiki');
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::call($p,$o);
return $bt.divd($rid,$ret);}

}

?>