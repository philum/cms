<?php 
class wiki{

/*function curl($f){$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$f);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_USERAGENT,'');
curl_setopt($ch,CURLOPT_COOKIE,'foo=bar');
$ret=curl_exec($ch);
curl_close($ch);
return $ret;}

function xml2array($n){$ret=array();
foreach($n->childNodes as $nc)($nc->hasChildNodes())
?($n->firstChild->nodeName== $n->lastChild->nodeName&&$n->childNodes->length>1)
?$ret[$nc->nodeName][]=xml2array($item)
:$ret[$nc->nodeName]=xml2array($nc)
:$ret=$nc->nodeValue;
return $ret;}*/

/**/static function explore0($r){$ret='';
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
		elseif($val!='modifier' && $val!='modifier le code' && $val!=' | ')$ret.=$val;
		//else $ret.=$val;
		//eco($val);
		}}
return $ret;}
//$r=msql::read_b('',nod('wiki_1'));//p($r);

static function build0($p,$o){
$f=utf8enc_b($p);
if($f)$dom=fdom($f,1); $ret='';
if($dom)foreach($dom->getElementsByTagName('div') as $k=>$div)
	if($div->getAttribute('id')=='mw-content-text'){
	if($o)for($i=0;$i<3;$i++){$ret.=div('',$div->getElementsByTagName('p')->item($i)->nodeValue);}
	else $ret=self::explore($div);
	//foreach($div->childNodes as $vb)$ret.=$vb->ownerDocument->saveHTML($vb);
	//$ret=$div->ownerDocument->saveHTML($div);
	}
//eco($ret);
$ret=utf2ascii($ret);
$ret=str_replace('<h2>Sommaire</h2>','',$ret);
$ret=preg_replace('/\[.*\][,]|\[.*\]/','',$ret);
return $ret;}

//
static function explore($f){
$d=vaccum_ses($f);
$d=dom::detect($d,'mw-content-text:id:');
$jump='plainlinks metadata::|navigation:role:div|mw-editsection::div|mw-editsection::span';
$d=dom::del($d,$jump);
return $d;}

static function build($p,$o){ses::$urlsrc=$p;
[$t,$d]=conv::vacuum($p); $d=str::clean_html($d,1); $d=str::embed_links($d);
$d=str::clean_br_lite($d); $d=str::clean_punct($d); $d=conn::read($d,'noimages','');
//if($o)$d=str::kmax($d,10000);
//if(strpos($d,'<big>'))$mx='<big>'; elseif(strpos($d,'<h2>'))$mx='<h2>';
if($o)$d=strto($d,'<big>');
return $d;}

static function call($p,$o,$prm=[]){$p=$prm[0]??$p; $bt='';
if(substr($p,0,4)!='http')$p='https://fr.wikipedia.org/wiki/'.urlutf($p);
$ret=self::build($p,$o);
if($o)$bt=lj('','popup_wiki,call__3_'.ajx($p),picto('view')).' ';
$bt.=lka($p,picto('chain'));
return divc('twit',$ret).$bt;}//($o?'small':'')

static function menu($p,$o,$rid){$ret=input('inp'.$rid,$p).' ';
$ret.=lj('',$rid.'_wiki,call_inp_3__'.$rid,picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('wiki');
$bt=self::menu($p,$o,$rid); $ret='';
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>