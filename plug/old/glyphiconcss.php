<?php //glyphiconcss

function glyphiconcss_bt($d){return span(atc('glyph gl-'.$d),'').br();}

function glyphiconcss_demo($p){
return $p.':'.glyphiconcss_bt($p);}

function glyphiconcss_j($p,$o,$res=''){
[$p,$o]=ajxp($res,$p,$o);
$ret=glyphiconcss_demo($p,$o);
return $ret;}

function glyphiconcss_all($p,$o,$res=''){
$r=msql_read('system','edition_glyphes_1','',1);
foreach($r as $k=>$v)$rb[$k]=hexdec($v); asort($rb);
foreach($rb as $k=>$v)$ret.=span(att($k),glyph($k,24)).' ';
return $ret;}

function glyphiconcss_rebuild($p,$o,$res=''){
$d=file_get_contents('css/_glyphs.css');
$r=explode("\n",$d);
if($r)foreach($r as $v)if(substr($v,0,1)=='.'){
	$k=substr($v,4,strpos($v,':')-4);
	$vb=subtopos($v,strpos($v,'content:"')+9,strpos($v,'";}'));
	$rb[$k]=[$vb];}
//p($rb);
//if($rb)foreach($rb as $v)$ret.=glyph($v);
msql::save('system','edition_glyphes_1',$rb,[]);
return $ret;}

function glyphiconcss_build($p,$o){
$f='css/_glyphs.css';
$r=msql_read('system','edition_glyphes_1','',1);
$ret='@font-face {font-family: "glyph"; src: url("/fonts/Glyphicons-regular.eot?iefix") format("eot"), url("/fonts/Glyphicons-regular.woff?v15.'.date('ymdhi').'") format("woff"), url("/fonts/Glyphicons-regular.ttf") format("truetype");}
.glyph{font-family:"glyph"; position:relative; top:1px; display:inline-block; font-style:normal; font-weight:400; line-height:1; -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale;}'."\n";
//, url("/fonts/Glyphicons-regular.svg#gly") format("svg")
foreach($r as $k=>$v)
	$ret.='.gl-'.$k.':before{content:"\\'.$vs.'";}'."\n";
write_file($f,$ret);
return lka('/'.$f);}

function glyphiconcss_menu($p,$o,$rid){$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_glyphiconcss_glyphiconcss*j___inp',picto('ok')).' ';
$ret.=lj('',$rid.'_plug__2_glyphiconcss_glyphiconcss*all___inp',picto('eye')).' ';
//$ret.=lj('',$rid.'_plug__2_glyphiconcss_glyphiconcss*build',picto('save')).' ';
//$ret.=lj('',$rid.'_plug__2_glyphiconcss_glyphiconcss*rebuild',picto('up')).' ';
return $ret;}

function plug_glyphiconcss($p,$o){$rid=randid('plg');
Head::add('csslink','/css/_glyphs.css');
$bt=glyphiconcss_menu($p,$o,$rid);
$bt.=msqbt('system','edition_glyphes_1');
//$ret.=glyphiconcss_build($p,$o);
return $bt.divd($rid,$ret);}

?>