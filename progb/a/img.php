<?php //philum/a/img
class img{
static $a=__CLASS__;

static function install(){
reqp('install'); $ra=install_db(); $sql=$ra['img']; qr($sql);}

static function restore($im,$id){req('pop,tri');
$dc=sql('dc','qdg','v','ib="'.$id.'" and im="'.$im.'"');
if($dc)$dc=conn::get_image($dc,$id,3);
if($dc)return conn::place_image($dc,3,'',920,$id);}

static function rewrite($d){$im='img/'.$d;
list($w,$h,$ty)=getimagesize($im);
make_mini($im,$im,$w,$h,'');
$bt=btn('txtyl',$w.'-'.$h.':'.fsize($im));
return img($im).$bt;}

static function sz($w,$h,$w1,$h1){
$h2=($w1/$w)*$h; $w2=$w1;
if($h>$w){$w2=($h1/$h)*$w; $h2=$h1;}
return [round($w2),round($h2)];}

static function reduce($d,$o){$im='img/'.$d;
list($wo,$ho,$ty)=getimagesize($im);
if($o){$w=$wo/2; $h=$ho/2;}
else list($w,$h)=self::sz($wo,$ho,940,940);
make_mini($im,$im,$w,$h,''); opcache_invalidate($im);
return conn::place_image($d.'?123',3,'',920,'');}

static function png2jpg($a,$id){
$b=str_replace('.png','.jpg',$a);
$in='img/'.$a; $out='img/'.$b;
list($w,$h,$ty)=getimagesize($in);
$img=imagecreatetruecolor($w,$h);
$c=imagecolorallocate($img,255,255,255); imagefill($img,0,0,$c);
$im=@imagecreatefrompng($in);
imagecopyresampled($img,$im,0,0,0,0,$w,$h,$w,$h);
imagejpeg($img,$out,100);
if($id){req('tri'); conn::replaceinmsg($id,$a,$b); conn::replaceinimg($id,$a,$b);
	self::mdf($id,$a,$b); unlink($in);}
return conn::place_image($b.'?123',3,'',920,'');}
//return img($out.'?'.randid()).fsize($out);}

static function batch($p=1,$l=10000){//self::install();
$min=$p*$l; $max=$min+$l; $rc=[];
$r=sql('id,img','qda','kv','id>"'.$min.'" and id<="'.$max.'"');
foreach($r as $k=>$v){$rb=explode('/',$v);
	if(is_numeric($rb[0]))unset($rb[0]);
	foreach($rb as $k=>$v)if(is_file('img/'.$v)){
		$rc[]=[$k,$v,fsize('img/'.$v),'',0];}}//self::save($k,$v,'');
return $rc;}

static function save($id,$im,$dc){//self::install();
$ex=sql('id','qdg','v','ib="'.$id.'" and im="'.$im.'"');
if(!$ex)sqlsav('qdg',[$id,$im,$dc,0]);//,fsize('img/'.$f)
//else sqlup('qdg',['ib'=>$id,'im'=>$im,'dc'=>$dc,'no'=>0],'id',$ex);
}

static function mdf($id,$a,$b){
$ex=sql('id','qdg','v','ib="'.$id.'" and im="'.$a.'"');
if($ex)sqlup('qdg',['im'=>$b],'id',$ex);}

static function rm($id,$im){
$ex=sql('id','qdg','v','ib="'.$id.'" and im="'.$im.'"');
if($ex)sqlup('qdg',['no'=>1],'id',$ex);}

static function del($id,$im){
$ex=sql('id','qdg','v','ib="'.$id.'" and im="'.$im.'"');
if($ex)sqldel('qdg',$ex); req('pop,tri');
conn::replaceinmsg($id,'['.$im.']','');
conn::replaceinimg($id,'/'.$a,'');
unlink('img'.$im); unlink('imgc'.$im);}

#thumbs
static function thumbname($d,$w,$h){
$nm=strto(strend($d,'/'),'.'); $xt=strend($d,'.');
return 'imgc/'.$nm.'_'.$w.'x'.$h.'.'.$xt;}

static function build_mini($d,$w,$h){//mode max
$im='img/'.$d; list($wo,$ho,$ty)=getimagesize($im);
list($w,$h)=self::sz($wo,$ho,$w,$h);
$imb=self::thumbname($d,$w,$h);
make_mini($im,$imb,$w,$h,''); opcache_invalidate($im);
return img($im);}

}
?>