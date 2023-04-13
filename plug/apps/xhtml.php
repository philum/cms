<?php //xhtml

//x2c
/*class DOMNodeRecursiveIterator extends ArrayIterator implements RecursiveIterator{
public function __construct(DOMNodeList $node_list){$nodes=[];
	foreach($node_list as $node)$nodes[]=$node;
	parent::__construct($nodes);}
public function getRecursiveIterator(){
	return new RecursiveIteratorIterator($this,RecursiveIteratorIterator::SELF_FIRST);}
public function hasChildren(){return $this->current()->hasChildNodes();}
public function getChildren(){return new self($this->current()->childNodes);}}
*/
    /*if($dom_element->hasAttributes()){
      $object_element->attributes=array();
        foreach($dom_element->attributes as $attName=>$dom_attribute){
          $object_element->attributes[$attName]=$dom_attribute->value;
        }
    }*/
class xhtml{
static $a=__CLASS__;
static $default='';

static function r(){
//content is p
$ra=['b','i','u','e','s','k','q','p','t','c','qu','h1','h2','h3','h4','h5','red','blue','parma','list','numlist','table','right','float','pre','link','w','code','on','no'];
$rb=['stabilo','font','size','color','pub','art','url','css','div','html','bkg','bkgclr','underline'];
//content is o
$rc=['figure','twitter','umcom'];
return [$ra,$rb,$rc];}

//c2x
static function conn2xhtml($d){
[$p,$o,$c]=unpack_conn($d); //echo $p.'-'.$o.'-'.$c;
[$ra,$rb,$rc]=self::r();
if(in_array($c,$ra) or in_array($c,$rb) or strpos($p,'<')!==false)$ret=tag($c,['o'=>$o],$p);
elseif(in_array($c,$rc) or is_img($p) or substr($p,0,4)=='http')$ret=tag($c,['p'=>$p],$o);
else $ret=tag($c,['p'=>$p,'o'=>$o],'');
return $ret;}

static function read($dom){$ret='';//if(is_object($v)
[$ra,$rb,$rc]=self::r(); static $i; $i++; echo $i.';';
$racine=$dom->documentElement; $racine->nodeValue.'--';
foreach($dom->childNodes as $v){//pr($v);
	if($v->childNodes->length>1)$t=self::read($v);
	else $t=$v->nodeValue;
	$c=$v->nodeName;
	$p=domattr($v,'p');
	$o=domattr($v,'o');
	//echo $p.'§'.$o.':'.$c.'/'.$t.br();
	if(in_array($c,$ra) or in_array($c,$rb))$p=$t;
	elseif(in_array($c,$rc))$o=$t;
	///if($t)$ret.='['.$t.':'.$c.']';
	//if(in_array($c,$rb))$ret.='['.$t.':'.$c.']';
	$ret.='['.$p.($o?'§'.$o:'').':'.$c.']';}
return $ret;}

static function xhtml2conn($d){
//$dom=dom($d);
$dom=new DomDocument(); $dom->loadXML($d);
[$ra,$rb,$rc]=self::r();
$ret=self::read($dom);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o); $ret='';
if($o=='c2x')$ret=div('',codeline::parse($p,$o,'conn2xhtml'));
if($o=='x2c')$ret=self::xhtml2conn($p);
return eco($ret,1);}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default;
$ret=textarea('inp',$p,40,4,['class'=>'console']).br();
$ret.=lj('popbt',$rid.'_xhtml,call_inp___c2x',pictxt('output','conn2xhtml')).' ';
$ret.=lj('popbt',$rid.'_xhtml,call_inp___x2c',pictxt('input','xhtml2conn')).' ';
return $ret;}

static function home($p,$o){
$rid=randid(self::$a);
$bt=self::menu($p,$o,$rid);
return $bt.divd($rid,'');}

}
?>