<?php
//philum_plugin_bincode

function bin_answ(){return ['aa'=>'001011010111','am'=>'000000100101','ab'=>'101000100111','ba'=>'110101111110','bm'=>'000000100111','bb'=>'100101110011'];}

//char to bin
function c2b_find($r,$d,$v,$k){$n=strpos($d,$v); $nb=strlen($v);
if($n!==false){$rb=[];
	for($i=$n;$i<$n+$nb;$i++)$rb[]=val($r,$i);
	return $k.' matched: {'.implode(' ',$rb).'}'.br();}
else return $k.': nothing '.br();}

function cartobin($p,$o,$id){
$ret=''; $ok=''; $r=[];
if(is_numeric($id))$d=sql('msg','qdm','v','id='.$id);
else $d=$p;
//$d=str_replace(['&nbsp;',"'",'"','-','/',',',';',':','$','#','_','+','=','!','?','\n','\r','\\','~','(',')','[',']','{','}','«','»'],'',($d));//'.','§','%','&',
//$ret=bal('code','','algo: foreach(explode(' ',$d) as $v)$ret.=strlen($v)%2;');
$rb=bin_answ(); //pr($rb);
foreach($rb as $k=>$v)$rc[]=[$k,$v];
$ok=tabler($rc);
if($d)$r=explode(' ',$d);
if($r){foreach($r as $k=>$v)$ret.=strlen($v)%2;
msql::modif('',nod('carbin'),[$ret],'one','',$id);}
if($r)foreach($rb as $k=>$v)$ok.=c2b_find($r,$ret,$v,$k);
if($ok)foreach($rb as $k=>$v)$ret=str_replace($v,btn('stabilo',$v),$ret);
return $ok.divs('word-wrap:break-word;',$ret);}

function char2bin($p){$j='cr2bn_plug___bincode_cartobin___c2b';
$ret=inputj('c2b','178',$j).lj('',$j,picto('ok'));
$ret.=msqbt('',nod('carbin'));
return $ret.divd('cr2bn',cartobin('','',$p));}

//decode
function txt2bin($p,$o,$res){
list($p,$o)=ajxp($res,$p,$o);
$r=explode(' ',$p); $ret='';
if($r)foreach($r as $k=>$v)$ret.=strlen($v)%2;
return $ret;}

function chardecod($p){$j='cr2bn_plug___bincode_wordstobin___c2b';
$ret=inputj('c2b','hello world',$j,60).lj('',$j,picto('ok'));
$ret.=msqbt('',nod('carbin'));
return $ret.divd('cr2bn',wordstobin('','',$p));}

//algo
function bc_menu($p,$rid){
$ret=input('inp1',$p);
$ret.=lj('popsav',$rid.'_plug__2_bincode_bin2txt__'.$rid.'_inp1','bin=>text').br();
$ret.=textarea('inp2',$p,40,4);
$ret.=lj('popsav',$rid.'_plug__2_bincode_txt2bin__'.$rid.'_inp2','text=>bin').' ';
return $ret;}

//load
function plug_bincode($p,$o){
$rid=randid('bc');
$bt=bc_menu($p,$rid);
if(is_numeric($p))$ret=bin2txt($p);
elseif($p)$ret=$ret=txt2bin($p);
else $ret='';
return $bt.divd($rid,'');
}
?>