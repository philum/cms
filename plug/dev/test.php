<?php
//philum_plugin_test

function test_xml($f){
$d=get_file($f);
echo $enc=embed_detect(strtolower($d),'encoding="','"');
if(strtolower($enc)=='utf-8')$d=utf8_decode_b($d);
//echo substr_count($d,'<').'-'.substr_count($d,'>');
eco($d,1);
$r=simplexml_load_string($d);

$xml=explode("\n",$f);
if(!$r){
$rr=libxml_get_errors();
foreach($rr as $er)$ret.=display_xml_error($er,$xml);
libxml_clear_errors();
return $ret;}}

function display_xml_error($er,$xml){
$ret=$xml[$er->line-1]."\n";
$ret.=str_repeat('-',$er->column)."^\n";
switch($er->level){
	case LIBXML_ERR_WARNING:$ret.="Warning $er->code: "; break;
	case LIBXML_ERR_ERROR:$ret.="Error $er->code: "; break;
	case LIBXML_ERR_FATAL:$ret.="Fatal Error $er->code: "; break;}
$ret.=trim($er->message)."\nLine: $er->line"."\nColumn: $er->column";
if($er->file)$ret .= "\nFile: $er->file";
return $ret.hr();}

function plug_test($p,$o){
$f='http://www.tlaxcala-int.org/rss_lg.asp?lg_rss=fr';
return test_xml($f);}

?>