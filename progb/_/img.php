<?php //a/img
class img{
static $a=__CLASS__;

static function install(){sqldb::install('img');}

static function restore($im,$id){
$dc=sql('dc','qdg','v',['ib'=>$id,'im'=>$im]);
if($dc)$dc=conn::get_image($dc,$id,3);
if($dc)return conn::place_image($dc,3,'',920,$id);}

static function rewrite($d){$im='img/'.$d;
[$w,$h,$ty]=getimagesize($im);
make_mini($im,$im,$w,$h,'');
$bt=btn('txtyl',$w.'-'.$h.':'.fsize($im));
return img($im).$bt;}

static function sz($w,$h,$w1,$h1){
$h2=($w1/$w)*$h; $w2=$w1;
if($h>$w){$w2=($h1/$h)*$w; $h2=$h1;}
return [round($w2),round($h2)];}

static function reduce($d,$o,$id=''){$im='img/'.$d;
[$wo,$ho,$ty]=getimagesize($im);
if($o){$w=$wo/2; $h=$ho/2;}
else [$w,$h]=self::sz($wo,$ho,940,940);
make_mini($im,$im,$w,$h,''); opcache_invalidate($im);
return conn::place_image($d.'?'.$w,3,'',920,$id);}

static function png2jpg($a,$id){
$b=str_replace('.png','.jpg',$a);
$in='img/'.$a; $out='img/'.$b;
if(!is_file($in))return;
[$w,$h,$ty]=getimagesize($in); if(!$w)return;
$img=imagecreatetruecolor($w,$h);
$c=imagecolorallocate($img,255,255,255); imagefill($img,0,0,$c);
$im=@imagecreatefrompng($in);
imagecopyresampled($img,$im,0,0,0,0,$w,$h,$w,$h);
imagejpeg($img,$out,100);
if($id){$sz1=fsize($in); $sz2=fsize($out);//abort if jpg is larger
	if($sz1>$sz2){conn::replaceinmsg($id,$a,$b); conn::replaceinimg($id,$a,$b);
		self::mdf($id,$a,$b); meta::putincache($id);
		unlink($in); $res=$b; ses::$adm['alert']='png destroyed ('.$sz1.'=>'.$sz2.') ';}
	else{unlink($out); $res=$a; ses::$adm['alert']='png kept ('.$sz1.'<='.$sz2.') ';}}
//return img($out.'?'.randid()).fsize($out);
return conn::place_image($res,3,'',920,$id);}

static function webp2jpg($a,$id){
$b=str_replace('.jpeg','.jpg',$a);
$b=str_replace('.webp','.jpg',$b);
$in='img/'.$a; $out='img/'.$b;
$im=@imagecreatefromwebp($in);
imagejpeg($im,$out,90);
imagedestroy($im);
if($id){conn::replaceinmsg($id,$a,$b); conn::replaceinimg($id,$a,$b);
	self::mdf($id,$a,$b); if($b!=$a)unlink($in);}
return conn::place_image($b,3,'',920,$id);}

static function batch($p=1,$l=10000){//self::install();
$min=$p*$l; $max=$min+$l; $rc=[];
$r=sql('id,img','qda','kv','id>"'.$min.'" and id<="'.$max.'"');
foreach($r as $k=>$v){$rb=explode('/',$v);
	if(is_numeric($rb[0]))unset($rb[0]);
	foreach($rb as $k=>$v)if(is_file('img/'.$v)){
		$rc[]=[$k,$v,fsize('img/'.$v),'',0];}}//self::save($k,$v,'');
return $rc;}

static function save($id,$im,$dc){//self::install();
$ex=sql('id','qdg','v',['ib'=>$id,'im'=>$im]);
if(!$ex)sqlsav('qdg',[$id,$im,$dc,0],0,1);//,fsize('img/'.$f)
//else sqlup('qdg',['ib'=>$id,'im'=>$im,'dc'=>$dc,'no'=>0],$ex);
}

static function mdf($id,$a,$b){
$ex=sql('id','qdg','v',['ib'=>$id,'im'=>$a]);
if($ex)sqlup('qdg',['im'=>$b],$ex);}

static function rm($id,$im){
$ex=sql('id','qdg','v',['ib'=>$id,'im'=>$im]);
if($ex)sqlup('qdg',['no'=>1],$ex);}

static function del($id,$im){
$ex=sql('id','qdg','v',['ib'=>$id,'im'=>$im]);
if($ex)sql::del('qdg',$ex);
conn::replaceinmsg($id,'['.$im.']','');
conn::replaceinimg($id,'/'.$im,'');
unlink('img'.$im); unlink('imgc'.$im);}

#thumbs
static function thumbname($d,$w,$h){
$nm=strto(strend($d,'/'),'.'); $xt=strend($d,'.');
return 'imgc/'.$nm.'_'.$w.'x'.$h.'.'.$xt;}

#arts
static function make_thumb($mg,$prm){$ida='img';
if(!file_exists($ida.'/'.$mg))return; $preb='';
if(substr($mg,0,4)!='http')$pre='imgc/'; else $pre='';
	if($prm=='h')$rpm='height="36" class="imgl"';
	elseif(is_numeric($prm))$rpm='title="'.ma::rqt($prm,'suj').'"';
	elseif($prm=='nl'){$rpm='class="imgl"'; $preb=host();}
	elseif($prm=='hb')$rpm='height="32" class="imgl"';
	elseif($prm=='no')$rpm='';
	elseif(!$prm)$rpm='class="imgl"';
	else{$ida=$prm;$rpm='';}
$thumb=$pre.$mg;
if((!file_exists($thumb) && $mg && $pre) or ses('rebuild_img')){
	[$w,$h]=expl('/',prmb(27)); $mode=$_SESSION['rstr'][16]?0:1;//0=outsize
	make_mini($ida.'/'.$mg,$thumb,$w,$h,$mode);}
return '<img src="'.$preb.'/'.$thumb.'" '.$rpm.'>';}

//xsmall
static function make_thumb_c($d,$size='',$s=''){
if(!$size)$size=prmb(27); [$w,$h]=explode('/',$size); $jd='';
if(strpos($d,'?'))$d=strto($d,'?'); $wo=0; $x=ses('rebuild_img');
if(substr($d,0,4)=='http')$b=substr(md5($d),0,6).'.'.strend($d,'.');
else{$b=str_replace(['users/','img/','imgb/','icons','/'],'',$d); $jd='/';}
$thumb=self::thumbname($b,$w,$h.($s?'-'.$s:''));
if(is_file($thumb) && !$x)return '<img src="'.$jd.$thumb.'">';//.'?'.randid()
if(is_file($d) or $x)make_mini($d,$thumb,$w,$h,$s);//case of tw img not detected but exists
if(is_file($thumb))return '<img src="'.$jd.$thumb.'">';}

static function imgartlk($im,$id){//[$w]=getimagesize('img/'.$im); if($w>100)
if($im && is_file('img/'.$im))return lj('','popup_popart__3_'.$id.'_3',self::make_thumb($im,$id));}

static function outputimg($r){$ret=''; if($r)foreach($r as $id=>$ra){
if($ra)foreach($ra as $k=>$im)if(is_img($im))$ret.=self::imgartlk($im,$id);}
return $ret;}

static function imgclr($im,$d,$a=''){$r=hexrgb_r($d);
if($a)return imagecolorallocatealpha($im,$r[0],$r[1],$r[2],$a);
else return imagecolorallocate($im,$r[0],$r[1],$r[2]);}

static function clrpack($im,$a=''){
$r=['ffffff','000000','ff0000','00ff00','0000ff','ffff00','00ffff','cccccc','999999','ff9900','ff0099','00ff99','0099ff','9900ff','99ff00'];
foreach($r as $k=>$v)$ret[]=self::imgclr($im,$v,$a);
return $ret;}

static function graphics($out,$w,$h,$bit,$c,$tx){$im=imagecreate($w,$h);
[$white,$black,$red,$green,$blue,$yel]=self::clrpack($im); $clr=self::imgclr($im,$c);
imagecolortransparent($im,$white); $esp=0;
if($bit){$maxdac=max($bit); $nb_bars=count($bit);
if($nb_bars<$w/2)$esp=2; $ecart=round($w/$nb_bars);
if($ecart<10)$tx='off'; $x1=0; $y1=$h-7;
foreach($bit as $k=>$v){$x2=$x1+$ecart; $vac=round($v/$maxdac*$y1);//round
	ImageFilledRectangle($im,$x1,$y1-$vac,$x2-$esp,$y1,$clr);
	if($tx=='yes'){
		imagestring($im,1,$x2-$ecart,$y1,substr($k,2),$red);
		imagestring($im,1,$x2-$ecart,$y1-$vac,$v,$yel);}
	$x1+=$ecart;}}
imagepng($im,$out);}

}
?>