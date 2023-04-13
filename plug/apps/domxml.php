<?php //dom

class domxml{

static function curl($f){$ch=curl_init();
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
return $ret;}

/*static function dom2array($n,&$a,$dom){static $depth=0; static $sz='';
if($cn=$n->firstChild){while($cn){if($cn->nodeType==XML_TEXT_NODE)$sz.=$cn->nodeValue;
elseif($cn->nodeType==XML_ELEMENT_NODE){$b=1; if($cn->hasChildNodes()){$depth++;
if($dom->myHeadings($cn,$a)){if($sz){array_push($a,$sz); $sz='';}}$depth--;}}
$cn=$cn->nextSibling;}
return $b;}}*/

/*static function test(){
$dom = new DOMDocument('1.0','UTF-8');
$dom->loadHTML('<html><body><div><p>p1</p><p>p2</p></div></body></html>');   
$node = $dom->getElementsByTagName('div')->item(0);   
$outerHTML = $node->ownerDocument->saveHTML($node);   
$innerHTML = '';
foreach ($node->childNodes as $childNode)
	$innerHTML.=$childNode->ownerDocument->saveHTML($childNode);
echo '<h2>outerHTML: </h2>';
echo htmlspecialchars($outerHTML);
echo '<h2>innerHTML: </h2>';
echo htmlspecialchars($innerHTML);}*/

/*
	/*
	for($i=0;$i<$pa->length;++$i){
		$pb=trim($pa->item($i)->nodevalue);
		if($pb=='<br>'||$pb=='<br></br>'||$pb=='')
			$div->removeChild($div->getElementsByTagName('p')->item($i));}*/
	//foreach($div->getElementsByTagName('p') as $pa){}
	/*
	$pa=$div->getElementsByTagName('p');
	for($i=0;$i<$pa->length;++$i){
		$pb=trim($pa->item($i)->nodevalue);
		if($pb=='<br>'||$pb=='<br></br>'||$pb=='')$del[]=
			$div->removeChild($div->getElementsByTagName('p')->item($i));}*/
	/*		
	$pb=trim($pa->nodeValue);
	while($pb=='<br>' || $pb=='<br></br>' || $pb=='')//
		if($pa){
		$div->parentNode->removeChild($pa);
		$pa=$div->getElementsByTagName('p')->item(0);
		$pb=trim($pa->nodeValue);}*/
	/*try{foreach($pa as $va){$pb=trim($va->nodeValue);
		if($pb=='<br>'||$pb=='<br></br>'||$pb=='')$div->removeChild($va);}}
	catch(Exception $e){$ret.=''; alert($e);}
	//$ret=self::explore($div);
	//self::myTextNode($div,$a,$dom);
	//try{foreach($div->childNodes as $va){$ret.=tagb($va->tagName($i),$va->nodeValue); pr($va);}}
	//catch(Exception $e){$ret.='';}*/
	
	//echo $div->length; pr($div);
	//if($o)$ret=$pb->item(0)->nodeValue.n();//first line
	//else foreach($div->getElementsByTagName('p') as $v)$ret.=$v->nodeValue.n();
	//else $ret=$div->ownerDocument->saveHTML($div);
/*
	try{foreach($div->getElementsByTagName('div') as $kb=>$vb)
		if($vb->getAttribute('id')=='toc')$div->removeChild($vb);}
	catch(Exception $e){$ret.='';}
	try{foreach($div->getElementsByTagName('span') as $vb)
		if($vb->getAttribute('className')=='mw-editsection')$div->removeChild($vb);}
	catch(Exception $e){$ret.='';}
*/

static function explore($r){
foreach($r->childNodes as $k=>$v){
	if($v->hasChildNodes()){
		//$attr=$v->getAttribute('href');
		$tag=$v->tagName; //echo $tag.br();
		$val=$v->nodeValue;
		$a=$tag=='a'?ath($v->getAttribute('href')):'';
		if($tag && $val)$ret.=tag($tag,$a,self::explore($v));
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
		//modifier le code
		//$a=$tag=='a'?ath($v->parentNode->getAttribute('href')):'';
		//if($tag=='br')$ret.=br();
		//$ret.=$v->nodeValue;
		//$ret.=tag($tag,$a,$val);
		//if($tag)$ret.=tag($tag,$a,$v->nodeValue);
		//else 
		elseif($val!='modifier' && $val!='modifier le code' && $val!=' | ')$ret.=$val;
		//else $ret.=$val;
		//eco($val);
		}}
return $ret;}

//$r=msql::read_b('',nod('dom_1'));//p($r);
static function build($f,$o){
//self::test();
//echo $f='https://fr.dompedia.org/wiki/'.$p;
//$d=get_file($f); $d=utf8dec_b($d);
//$o=0;
$dom=fdom($f); //pr($dom);
if($dom)foreach($dom->getElementsByTagName('div') as $k=>$div)
	if($div->getAttribute('id')=='mw-content-text'){//pr($div);
	if($o)for($i=0;$i<3;$i++)$ret.=div('',$div->getElementsByTagName('p')->item($i)->nodeValue);
	else $ret=self::explore($div);
	//foreach($div->childNodes as $vb)$ret.=$vb->ownerDocument->saveHTML($vb);
	//$ret=$div->ownerDocument->saveHTML($div);
	}
//eco($ret);
$ret=utf2ascii($ret);
$ret=str_replace('<h2>Sommaire</h2>','',$ret);
$ret=preg_replace('/\[.*\][,]|\[.*\]/','',$ret);
return $ret;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$$p;
if(substr($p,0,4)!='http')$p='https://fr.wikipedia.org/wiki/'.$p;
$ret=self::build($p,$o);
if($o)$bt=lj('','popup_dom,call___'.ajx($p),picto('view')).' ';
$bt.=lka($p,picto('chain'));
return divc('twit small',$ret).$bt;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_dom,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('dom');
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
//$bt.=msqbt('',nod('dom_1'));
return $bt.divd($rid,$ret);}

}

?>