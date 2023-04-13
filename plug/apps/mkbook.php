<?php //books

class mkbook{
static $a=__CLASS__;
//static $enc='iso-8859-1';
static $enc='UTF-8';

static function enc($d){
//return $d;
//return utf8enc($d);
return utf8enc_b($d);}

static function manifest($r,$dr,$ti=''){$n=count($r); $lg='fr';
//$t0='Oummo - Corpus principal';
$d='<?xml version="1.0" encoding="'.self::$enc.'"?>
<package unique-identifier="unique-identifier" version="3.0" xmlns="http://www.idpf.org/2007/opf" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:opf="http://www.idpf.org/2007/opf"><metadata><dc:identifier id="unique-identifier">4d07bf09-0a07-4c49-8f91-bcf5adcebad1</dc:identifier>
<dc:title>'.$ti.'</dc:title>
<dc:creator>oumo.fr</dc:creator>
<dc:language>'.$lg.'</dc:language>
<meta property="dcterms:modified">2020-08-02T10:30:44Z</meta>
<meta content="philum" name="generator"/>
</metadata><manifest>
<item href="toc.xhtml" id="toc.xhtml" media-type="application/xhtml+xml" properties="nav"/>
<item href="styles/stylesheet.css" id="stylesheet.css" media-type="text/css"/>
<item href="images/image0001.jpg" id="image0001" media-type="image/jpeg" properties="cover-image"/>
<item href="toc.ncx" id="toc.ncx" media-type="application/x-dtbncx+xml"/>';
for($i=1;$i<=$n;$i++){$ib=str_pad($i,4,0,STR_PAD_LEFT);
	$d.='<item href="sections/section'.$ib.'.xhtml" id="section'.$ib.'" media-type="application/xhtml+xml"/>';}
$d.='</manifest>
<spine toc="toc.ncx">';
for($i=1;$i<=$n;$i++){$ib=str_pad($i,4,0,STR_PAD_LEFT);
	$d.='<itemref idref="section'.$ib.'"/>';}
$d.='</spine></package>';
write_file($dr.'/content.opf',$d);
//
$d='<?xml version="1.0" encoding="'.self::$enc.'"?>
<ncx version="2005-1" xmlns="http://www.daisy.org/z3986/2005/ncx/"><head><meta content="" name="" scheme=""/></head><docTitle><text/></docTitle><navMap>';
//$d.='<navPoint class="document" id="section1" playOrder="1"><navLabel><text>Section 1</text></navLabel><content src="sections/section0001.xhtml"/></navPoint>';//section1
foreach($r as $k=>$v){$i=$k+1; $ib=str_pad($i,4,0,STR_PAD_LEFT);
	$d.='<navPoint class="document" id="section'.$i.'" playOrder="'.$i.'"><navLabel><text>'.self::enc($v[2]).'</text></navLabel><content src="sections/section'.$ib.'.xhtml"/></navPoint>';}
$d.='</navMap></ncx>';
write_file($dr.'/toc.ncx',$d);
//
$d='<?xml version="1.0" encoding="'.self::$enc.'"?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops"><head/><body><nav epub:type="toc"><ol>';
//$d.='<li><a href="sections/section0001.xhtml">Section 1</a></li>';//section1
foreach($r as $k=>$v){$i=$k+1; $ib=str_pad($i,4,0,STR_PAD_LEFT);
	$d.='<li><a href="sections/section'.$ib.'.xhtml">'.self::enc($v[2]).'</a></li>';}
$d.='</ol></nav></body></html>';
write_file($dr.'/toc.xhtml',$d);}

static function build($r,$ti=''){//rmdir_r('_datas/200802OEBPS');
$ret=''; $dy=date('ymd'); $ti=$ti?$ti:$dy;
$dr='_datas/epub'; rmdir_r($dr); //$gz=$dr.'zip'; //gz_write2();
mkdir_r($dr); mkdir_r($dr.'/OEBPS'); mkdir_r($dr.'/META-INF');
$d='<?xml version="1.0" encoding="'.self::$enc.'"?>
<container version="1.0" xmlns="urn:oasis:names:tc:opendocument:xmlns:container"><rootfiles><rootfile full-path="OEBPS/content.opf" media-type="application/oebps-package+xml"/></rootfiles></container>';
write_file($dr.'/META-INF/container.xml',$d);
$d='application/epub+zip'; write_file($dr.'/mimetype',$d);
mkdir_r($dr.'/OEBPS/images'); mkdir_r($dr.'/OEBPS/sections'); mkdir_r($dr.'/OEBPS/styles');
write_file($dr.'/OEBPS/styles/stylesheet.css',read_file('css/_global.css'));
if($r)foreach($r as $k=>$v){$i=$k+1;
	$f=$dr.'/OEBPS/sections/section'.str_pad($i,4,0,STR_PAD_LEFT).'.xhtml';
	$rt=tagb('h1',self::enc($v[2]));
	$rt.=tagb('i',date('d/m/Y',(int)$v[1])).' ';
	$rt.=tagb('b','#'.$v[0]).br();
	$txt=str_replace(':video',':videourl',$v[3]);
	$txt=codeline::parse($txt,'epub','sconn2');
	$txt=str_replace('œ','&oelig;',$txt);
	$txt=self::enc($txt);
	$txt=embed_p($txt);
	$txt=str_replace('</blockquote></p>','</p></blockquote>',$txt);
	$rt.=$txt;
	//$rt.=conn::read($v[3],3,'','1').br();
	$doc='<?xml version="1.0" encoding="'.self::$enc.'"?>
	<html xmlns="http://www.w3.org/1999/xhtml"><head><link href="../styles/stylesheet.css" rel="stylesheet" type="text/css"/></head><body xmlns:epub="http://www.idpf.org/2007/ops">'.$rt.'</body></html>';
	write_file($f,$doc);}
if($r){self::manifest($r,$dr.'/OEBPS',$ti);
	$f='_datas/books/'.$ti.'.epub';//.tar
	//$lk=tar::gzdir($f,$dr);
	$ok=tar::zip($f,$dr); //count($r).' results: '
	return lkc('txtx','/'.$f,pictxt('book2',$ti));}
else return 'no results';}

static function req($p,$lg='',$pg=0){
//sql::setutf8();
//Oaxiiboo 6,Oolga Waam,Oomo Toa,Oyagaa Ayoo Yissaa
$qda=ses('qda'); $qdm=ses('qdm'); $wh='nod="'.ses('qb').'"';
$ra=explode(',',$p); foreach($ra as $k=>$v)if(is_numeric($v))$r1[]=$v; else $r2[]=$v;
if(isset($r1))$wh.=' and '.$qda.'.id in ("'.implode('","',$r1).'")';
if(isset($r2))$wh.=' and '.$qda.'.frm in ("'.implode('","',$r2).'")';
if($lg)$wh.=' and lg="'.$lg.'"';
if($pg)$limit='limit '.(($pg-1)*20).',20'; else $limit='';
$sql='select '.$qda.'.id,day,suj,msg,lg from '.$qda.' inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id where '.$wh.' order by day asc '.$limit;//collate utf8
return sql::call($sql,'',0);}

static function req2($p,$lg=''){//***
$qda=ses('qda'); $qdm=ses('qdm'); $wh='nod="'.ses('qb').'"';
$wh.=' and '.$qda.'.re>3 and day>'.calctime(365);
if($lg)$wh.=' and lg="'.$lg.'"';
$sql='select '.$qda.'.id,day,suj,msg,lg from '.$qda.' inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id where '.$wh.' order by day asc '.$limit;//collate utf8
return sql::call($sql,'',0);}

static function req3($p){//favs
$r=sql('ib','qdf','rv','type="'.$p.'" and iq="'.ses('iq').'"');
$qda=ses('qda'); $qdm=ses('qdm'); $wh=$qda.'.id in("'.implode('","',$r).'")';
$sql='select '.$qda.'.id,day,suj,msg,lg from '.$qda.' inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id where '.$wh;
return sql::call($sql,'',0);}

static function req4($p){//art
$qda=ses('qda'); $qdm=ses('qdm'); $wh=$qda.'.id="'.$p.'"';
$sql='select '.$qda.'.id,day,suj,msg,lg from '.$qda.' inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id where '.$wh;
return sql::call($sql,'',0);}

static function req5($p,$t){
$ra=explode_k($p,',',':'); $r=[]; $rb=[]; $t=$ra['ti']??$t;
$ra=api::defaults_rq($ra); //p($ra);
$ra['preview']=3; $t=$ra['ti']??($ra['t']??''); if($t)$t=normalize($t);
if($ra)$r=api::datas($ra); //pr($r);
if($r)foreach($r as $k=>$v)$rb[]=[$v['id'],$v['day'],$v['suj'],$v['txt']??($v['msg']??''),$v['lg']];
return [$t,$rb];}

static function call($p,$o,$prm=[]){
[$p,$t]=prmp($prm,$p,$o);//,$lg,$pg
if($p=='bestyear'){$r=self::req2($p,''); $t='Articles***1Y';}
elseif($o=='favs'){$r=self::req3($p); $t=$p.'-'.date('ymd');}
elseif($o=='art'){$r=self::req4($p); $t=$r[0][2];}
elseif($o=='api'){[$t,$r]=self::req5($p,$t); $t=$t?$t:'Ebook-'.date('ymd');}
else $r=self::req($p,'',0);//req2
if($r)return self::build($r,str::hardurl($t));}

static function menu($p,$o,$rid){
$r=sql('distinct(frm)','qda','rv',['nod'=>ses('qb')]);
$ret=datalist('inp',$r,'',$s=16,$t='cat1,cat2');
//$r=sql('distinct(lg)','qda','rv',['nod'=>ses('qb')]);
//$ret.=datalist('inb',$r,'fr',$s=2,$t='lang');
//$ret.='page'.input('ing',0,'2').' ';
$ret.='title'.input('inl','').' ';
$ret.=lj('',$rid.'_mkbook,call_inp,inl',picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid(self::$a);
$bt=self::menu($p,$o,$rid);
$ret=$p?self::call($p,$o):'';
return $bt.divd($rid,$ret);}

}
?>