<?php
//philum_plugin_pictos

function icons_ascii($d){
$c25='&#9617;'; $c50='&#9618;'; $c75='&#9619;'; $c100='&#9608;';}

function icons_clrs(){return array('dddddd','ffffff','00ffff','ff00ff','ffff00','888','ff0000','00ff00','0000ff','000000');}

function icons_pick(){$r=icons_clrs(); $ret='';
for($i=0;$i<10;$i++){$ret.=ljb('bk'.$i,'icons_pick('.$i.')','',' ');}
return divc('pixels',$ret);}

function icons_css(){$r=icons_clrs(); $ret='';
for($i=0;$i<10;$i++){$ret.='.bk'.$i.' {background-color:#'.$r[$i].';}'."\n\t";}
return '.pixels a{float:left; border:1px solid silver; width:16px; height:16px; 
	overflow:auto;}
	.pixels a:hover, .pixel active {border:1px solid purple;}
	'.$ret;}

function icons_js(){return 'var pclr=9;
function icons_pick(n){pclr=n;}
function icons_toggle(e){
	if(e.className=="bk"+pclr)e.className="bk0"; else e.className="bk"+pclr;}
function icons_arr(id){var ret=new Array(); 
	var ob=document.getElementById("pct"+id).getElementsByTagName("a"); 
	for(i=0;i<ob.length;i++){var n=ob[i].className; ret[i]=n.substring(2);} return ret;}
function icons_rcp(id){var ret=""; var r=icons_arr(id);
	for(i=0;i<r.length;i++){ret=ret+(r[i]?r[i]:0);} return ret;}
function icons_sav(id,nw){var ret=icons_rcp(id);
	var nam=document.getElementById("pctnam"+id).value;
	SaveJ("socket_plug__4_icons_icons*sav_"+nam+"_"+ret); sav_btn("cbk"+id,"pctpanel");
	if(nw){Close("popup"); SaveJ("popup_plup__2_icons_icons*edit_"+nam);}}
function icons_build(nm,id){icons_sav(id);
	SaveJ("prw"+id+"_plug___icons_icons*build_"+nm);}
function icons_fill(id,n){if(n==1)var n=pclr;
	var ob=document.getElementById("pct"+id).getElementsByTagName("a"); 
	for(i=0;i<ob.length;i++){ob[i].className="bk"+n;}}
function icons_fill_sp(id,a){
	var ob=document.getElementById("pct"+id).getElementsByTagName("a"); 
	for(i=0;i<ob.length;i++){if(i==a)var c=ob[i].className;
		if(ob[i].className==c)ob[i].className="bk"+pclr; else var c="";}}
';}

//build
function hexdec_b($d){
for($i=0;$i<6;$i+=2){$r[]=hexdec(substr($d,$i,2));} return $r;}
//function hexdec_c($d){return array(($d>>16)&0xFF,($d>>8)&0xFF,$d&0xFF);}

function icons_graphics_pick($in){list($w,$h,$ty)=getimagesize($in);
if($ty==2){$im=imagecreatefromjpeg($in);}
elseif($ty==1){$im=imagecreatefromgif($in); imgalpha($img);}
elseif($ty==3){$im=imagecreatefrompng($in); imgalpha($img);}
for($y=0;$y<$h;$y++){for($x=0;$x<$w;$x++){
$rgb=imagecolorat($im,$x,$y); $clrs[$x][$y]=imagecolorsforindex($im,$rgb);}}
return $rgb;}

function icons_graphics($r,$w,$h,$out){
$rc=icons_clrs(); $i=0;
$im=imagecreatetruecolor($w,$h);
imagesavealpha($im,true);
imagealphablending($im,false);
$alp=imagecolorallocatealpha($im,0,0,0,127);
imagecolortransparent($im,$alp);
for($ia=0;$ia<10;$ia++){
	list($rg,$gb,$br)=hexdec_b($rc[$ia]); $clri='clr'.$ia;
	$$clri=imagecolorallocate($im,$rg,$gb,$br);}
for($y=0;$y<$h;$y++){for($x=0;$x<$w;$x++){$ri=val($r,$i); $clri='clr'.$ri;
	//list($rg,$gb,$br)=$clr[$ri];
	if($ri)imagesetpixel($im,($x),($y),$$clri);
	else imagesetpixel($im,($x),($y),$alp); $i++;}}
imagealphablending($im,true);
imagepng($im,$out);
imagedestroy($im);
}

function icons_build($k){$nm='imgb/icons/system/philum/16/'.$k.'.png'; mkdir_r($nm);
$d=msql::val('system','program_icons',$k); $r=str_split($d);
icons_graphics($r,16,16,$nm); return pictosys($k);}

//sav
function icons_sav($id,$d){$dfb['_menus_']=['data'];
$r=msql::modif('system','program_icons',[$d],'one',$dfb,$id);}

function icons_del($d){$dfb['_menus_']=['data'];
$r=msql::modif('system','program_icons','','del',$dfb,$d);
$f='imgb/icons/system/philum/16/'.$d.'.png'; if(is_file($f))unlink($f);
return icons_read();}

//edit
function ljd($d,$i){//return '<a onclick="icons_toggle(this,'.$i.')" ondragover="icons_toggle(this,'.$i.')" class="bk'.$d.'"> </a>';
return ljb('bk'.$d,'icons_toggle(this,'.$i.')','','');}

function icons_icon($d,$id){
$r=str_split($d); $n=16; $nb=$n*$n; $sz=16; $ret='';
for($i=0;$i<$nb;$i++)$ret.=ljd(val($r,$i),$i);
return div(' id="pct'.$id.'" class="pixels" style="width:'.($n*$sz+32).'px;"',$ret);}

function icons_edit($k){$id=randid();
Head::add('csscode',icons_css()); 
Head::add('jscode',icons_js());
$d=msql::val('system','program_icons',$k);
if(auth(6)){
	$ret=lj('popbt','pctpanel_plug___icons_icons*read_'.$k,picto('ok'));
	$ret.=lj('popdel','pctpanel_plug___icons_icons*del_'.$k,picto('del')).' ';
	$ret.=input('pctnam'.$id,$k);
	$ret.=ljb('popbt','icons_sav',$id.'\',\'1','save').' ';
	$ret.=ljb('popbt" id="cbk'.$id,'icons_build',$k.'\',\''.$id,picto('builders')).' ';
	$ret.=btd('prw'.$id,pictosys($k)).br();}
$ret.=ljb('popbt','icons_fill',$id.'\',\'0','empty');
$ret.=ljb('popbt','icons_fill',$id.'\',\'1','fill');
$ret.=divc('',icons_pick()).br();
if($k)$ret.=icons_icon($d,$id);
$ret.=divc('clear','');
return $ret;}

//read
function pictosys($d){$nm='?time='.randid();
return imgico('/imgb/icons/system/philum/16/'.$d.'.png'.$nm,$nm,4,root());}//'../'

function icons_read(){$id=randid();
$r=msql_read('system','program_icons','',1); ksort($r);
if($r)foreach($r as $k=>$v){$im=pictosys($k).' ';
	//icons_graphics($v,16,16,'../imgb/icons/system/philum/16/'.$k.'.png');
	$ret[]=lj('','popup_plup___icons_icons*edit_'.$k.'___injectjs',$im.$k).br();}
return onxcols($ret,'5','550');}

function plug_icons($d){$ret='';
Head::add('csscode',icons_css()); 
Head::add('jscode',icons_js());
//$ret=js_code('addjs(\'\',\''.icons_js().'\',\'\')');
//$ret=js_code(icons_js());
$ret.=lj('popbt','popup_plup___icons_icons*edit_new___injects',picto('add'));
$ret.=lj('popbt','pctpanel_plug___icons_icons*read____injects',picto('ok'));
$ret.=btd('cbk','').br();
$ret.=divb(icons_read(),'bkg','pctpanel').br();
$ret.=msqbt('system','program_icons');
return $ret;}

?>