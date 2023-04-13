<?php 
class icons{

static function ascii($d){
$c25='&#9617;'; $c50='&#9618;'; $c75='&#9619;'; $c100='&#9608;';}

static function clrs(){return ['dddddd','ffffff','00ffff','ff00ff','ffff00','888','ff0000','00ff00','0000ff','000000'];}

static function pick(){$r=self::clrs(); $ret='';
for($i=0;$i<10;$i++){$ret.=btj(' ','icons_pick('.$i.')','bk'.$i);}
return divc('pixels',$ret);}

static function css(){$r=self::clrs(); $ret='';
for($i=0;$i<10;$i++){$ret.='.bk'.$i.' {background-color:#'.$r[$i].';}'."\n\t";}
return '.pixels a{float:left; border:1px solid silver; width:16px; height:16px; 
	overflow:auto;}
	.pixels a:hover, .pixel active {border:1px solid purple;}
	'.$ret;}

static function js(){return 'var pclr=9;
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
	SaveJ("socket_icons,sav__4_"+nam+"_"+ret); sav_btn("cbk"+id,"pctpanel");
	if(nw){Close("popup"); SaveJ("popup_icons,edit__2_"+nam);}}
function icons_build(nm,id){icons_sav(id);
	SaveJ("prw"+id+"_icons,build___"+nm);}
function icons_fill(id,n){if(n==1)var n=pclr;
	var ob=document.getElementById("pct"+id).getElementsByTagName("a"); 
	for(i=0;i<ob.length;i++){ob[i].className="bk"+n;}}
function icons_fill_sp(id,a){
	var ob=document.getElementById("pct"+id).getElementsByTagName("a"); 
	for(i=0;i<ob.length;i++){if(i==a)var c=ob[i].className;
		if(ob[i].className==c)ob[i].className="bk"+pclr; else var c="";}}
';}

//build
static function hexdec($d){
for($i=0;$i<6;$i+=2){$r[]=hexdec(substr($d,$i,2));} return $r;}
//static function hexdec_c($d){return array(($d>>16)&0xFF,($d>>8)&0xFF,$d&0xFF);}

static function graphics_pick($in){[$w,$h,$ty]=getimagesize($in);
if($ty==2){$im=imagecreatefromjpeg($in);}
elseif($ty==1){$im=imagecreatefromgif($in); imgalpha($img);}
elseif($ty==3){$im=imagecreatefrompng($in); imgalpha($img);}
for($y=0;$y<$h;$y++){for($x=0;$x<$w;$x++){
$rgb=imagecolorat($im,$x,$y); $clrs[$x][$y]=imagecolorsforindex($im,$rgb);}}
return $rgb;}

static function graphics($r,$w,$h,$out){
$rc=self::clrs(); $i=0;
$im=imagecreatetruecolor($w,$h);
imagesavealpha($im,true);
imagealphablending($im,false);
$alp=imagecolorallocatealpha($im,0,0,0,127);
imagecolortransparent($im,$alp);
for($ia=0;$ia<10;$ia++){
	[$rg,$gb,$br]=self::hexdec($rc[$ia]); $clri='clr'.$ia;
	$$clri=imagecolorallocate($im,$rg,$gb,$br);}
for($y=0;$y<$h;$y++){for($x=0;$x<$w;$x++){$ri=val($r,$i); $clri='clr'.$ri;
	//[$rg,$gb,$br]=$clr[$ri];
	if($ri)imagesetpixel($im,($x),($y),$$clri);
	else imagesetpixel($im,($x),($y),$alp); $i++;}}
imagealphablending($im,true);
imagepng($im,$out);
imagedestroy($im);
}

static function build($k){$nm='imgb/icons/system/philum/16/'.$k.'.png'; mkdir_r($nm);
$d=msql::val('system','program_icons',$k); $r=str_split($d);
self::graphics($r,16,16,$nm); return self::pictosys($k);}

//sav
static function sav($id,$d){$dfb['_menus_']=['data'];
$r=msql::modif('system','program_icons',[$d],'one',$dfb,$id);}

static function del($d){$dfb['_menus_']=['data'];
$r=msql::modif('system','program_icons','','del',$dfb,$d);
$f='imgb/icons/system/philum/16/'.$d.'.png'; if(is_file($f))unlink($f);
return self::read();}

//edit
static function ljd($d,$i){//return '<a onclick="icons_toggle(this,'.$i.')" ondragover="icons_toggle(this,'.$i.')" class="bk'.$d.'"> </a>';
return btj($i,'icons_toggle(this,'.$i.')','bk'.$d);}

static function icon($d,$id){
$r=str_split($d); $n=16; $nb=$n*$n; $sz=16; $ret='';
for($i=0;$i<$nb;$i++)$ret.=self::ljd(val($r,$i),$i);
return div(' id="pct'.$id.'" class="pixels" style="width:'.($n*$sz+32).'px;"',$ret);}

static function edit($k){$id=randid();
Head::add('csscode',self::css()); 
Head::add('jscode',self::js());
$d=msql::val('system','program_icons',$k);
if(auth(6)){
	$ret=lj('popbt','pctpanel_icons,read___'.$k,picto('ok'));
	$ret.=lj('popdel','pctpanel_icons,del___'.$k,picto('del')).' ';
	$ret.=input('pctnam'.$id,$k);
	$ret.=ljb('popbt','icons_sav',[$id,'1'],'save').' ';
	$ret.=ljb('popbt" id="cbk'.$id,'icons_build',[$k,$id],picto('builders')).' ';
	$ret.=btd('prw'.$id,self::pictosys($k)).br();}
$ret.=ljb('popbt','icons_fill',[$id,'0'],'empty');
$ret.=ljb('popbt','icons_fill',[$id,'1'],'fill');
$ret.=divc('',self::pick()).br();
if($k)$ret.=self::icon($d,$id);
$ret.=divc('clear','');
return $ret;}

//read
static function pictosys($d){$nm='?time='.randid();
return imgico('/imgb/icons/system/philum/16/'.$d.'.png'.$nm,$nm,4,root());}//'../'

static function read(){$id=randid();
$r=msql::read('system','program_icons','',1); ksort($r);
if($r)foreach($r as $k=>$v){$im=self::pictosys($k).' ';
	//self::graphics($v,16,16,'../imgb/icons/system/philum/16/'.$k.'.png');
	$ret[]=lj('','popup_icons,edit__js_'.$k,$im.$k).br();}
return onxcols($ret,'5','550');}

static function home($d){$ret='';
Head::add('csscode',self::css()); 
Head::add('jscode',self::js());
//$ret=jscode('addjs(\'\',\''.self::js().'\',\'\')');
$ret=jscode(self::js()).csscode(self::css());
$ret.=lj('popbt','popup_icons,edit__js_new',picto('add'));
$ret.=lj('popbt','pctpanel_icons,read __js',picto('ok'));
$ret.=btd('cbk','').br();
$ret.=divb(self::read(),'bkg','pctpanel').br();
$ret.=msqbt('system','program_icons');
return $ret;}
}
?>