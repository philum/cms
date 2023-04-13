<?php 
class parse{
static function array_dig_a($ret,$d){
$r=explode('/',$d); echo $n=count($r);
if($n==1)return $ret[$r[0]];
if($n==2)return $ret[$r[0]][$r[1]];
if($n==3)return $ret[$r[0]][$r[1]][$r[2]];
if($n==4)return $ret[$r[0]][$r[1]][$r[2]][$r[3]];
if($n==5)return $ret[$r[0]][$r[1]][$r[2]][$r[3]][$r[4]];
if($n==6)return $ret[$r[0]][$r[1]][$r[2]][$r[3]][$r[4]][$r[5]];}

//find
static function array_dig($ret,$d){$r=explode('/',$d);
foreach($r as $v)$ret=$ret[$v];
return $ret;}

static function xml_path($r,$d){
foreach($r as $k=>$v)
	//if(is_array($v))$ret[]=self::xml_path($v,$d); else 
	if($v['balise']=='section')$ret[]=$v['article'];
return $ret;}

static function mk_attrb($d,$a,$b){//$r=explode('=',$d);
$n=substr_count($d,'='); if($n==0 or !$d)return; $d=str_replace("\n",' ',$d);
for($i=0;$i<$n;$i++){
$pos[$i]=strpos($d,'=',$pos[$i-1]+1); $da=substr($d,0,$pos[$i]); $db=substr($d,$pos[$i]+1);
$first=substr($db,1); if($first=='"')$sep='"'; elseif($first=="'")$sep="'";
$posa=strrpos($da,' '); $posb=strpos($db,'"',1);
if($posa!==false)$va=substr($da,$posa);
if($posb!==false)$vb=substr($db,1,$posb-1);
$ret[trim($va)]=trim($vb);}
//p($pos);
return $ret;}

static function ecart($v,$a,$b){$min=$a+1; $max=$b-$a-1;
return substr($v,$min,$max);}//if($min<$max)else error detected

//$before <$aa_balise> $balise </$bb_balise> $after
static function interpret_xml($v){static $i; $i++;//static $ret;
$aa=strpos($v,"<"); $ab=strpos($v,">");//aa_balise 
if($aa!==false && $ab!==false && $ab>$aa){
$before=substr($v,0,$aa);//...< //htmlentities
$aa_inner=self::ecart($v,$aa,$ab);//<...>
	$aa_end=strpos($aa_inner," ");
	if($aa_end!==false)$aa_balise=substr($aa_inner,0,$aa_end);
	else $aa_balise=$aa_inner;}
$ba=strpos($v,'</'.$aa_balise,$ab); $bb=strpos($v,">",$ba);//bb_balise
if($ba!==false && $bb!==false && $aa_balise!="" && $bb>$ba){ 
	$ba=recursearch($v,$ab,$ba,$aa_balise);//recursearch
	$bb=strpos($v,">",$ba); if($bb)$bb_balise=self::ecart($v,$ba,$bb);
	$balise=self::ecart($v,$ab,$ba);}
elseif($ab!==false)$bb=$ab;
else $bb=-1;
$after=substr($v,$bb+1);//>...
//ok,go
$ia=$i;
$aa_balise=strtolower($aa_balise); $bb_balise=strtolower($bb_balise); 
$ret[$ia]['balise']=$aa_balise;
$attrb=self::mk_attrb($aa_inner,' ','=');
if($attrb)$ret[$ia]['props']=$attrb;
//itération
if(strpos($balise,'<')!==false)$balise=self::interpret_xml($balise);
if($balise)$ret[$ia]['content']=$balise;
//sequence
if(strpos($after,'<')!==false)$retb=self::interpret_xml($after);
if($retb)$ret=array_merge_b($ret,$retb);
return $ret;}

#

static function xml_rss($r){
//$enc=strtolower(self::array_dig($r,'0/props/encoding'));
//$title=self::array_dig($r,'1/content/3/content/0/content');
//$items=self::array_dig($r,'1/content/3/content');//pr($ra);
$enc=strtolower($r['0']['props']['encoding']); if($enc=='utf-8')$utf=1;
$title=$r['1']['content']['3']['content']['0']['content'];
$items=$r['1']['content']['3']['content'];//pr($items);
foreach($items as $k=>$v){
	if(is_array(@$v['content']))//items
		foreach($v as $ka=>$va){$i++;//elems
			if(is_array($va))foreach($va as $vb){//pr($vb);
				$d=@$vb['content'];
				//$d=decode_unicode($d);
				//$d=html_entity_decode($d);
				if($utf)$d=utf8dec_b($d);
				//$d=utflatindecode($d);
				$rb[$i][@$vb['balise']]=$d;}}}
return $rb;}

static function home($f){
//$f='http://w41k.com/';
if($f)$d=get_file($f);
if($d)$r=self::interpret_xml($d);
//$r=self::xml_rss($r);
//$r=xml_html($r);
//pr($r);
return $ret;}
}
?>