<?php //plugin_tar

class tar{
static function tarhead($f,$fa,$fb){
$info=stat($fa);
$ouid=sprintf("%6s ",decoct($info[4]));
$ogid=sprintf("%6s ",decoct($info[5]));
$omode=sprintf("%6s ",decoct(fileperms($fa)));
$omtime=sprintf("%11s",decoct(filemtime($fa)));
if(@is_dir($fa)){$type="5"; $osize=sprintf("%11s ",decoct(0));}
else{$type=''; $osize=sprintf("%11s ",decoct(filesize($fa))); clearstatcache();}
$dmajor=''; $dminor=''; $gname=''; $linkname=''; $magic=''; $prefix=''; $uname=''; $version='';
$chunkbeforeCS=pack("a100a8a8a8a12A12",$fb,$omode,$ouid,$ogid,$osize,$omtime);
$chunkafterCS=pack("a1a100a6a2a32a32a8a8a155a12",$type,$linkname,$magic,$version,$uname,$gname,$dmajor,$dminor,$prefix,''); $checksum=0;
for($i=0;$i<148;$i++)$checksum+=ord(substr($chunkbeforeCS,$i,1));
for($i=148;$i<156;$i++)$checksum+=ord(' ');
for($i=156,$j=0;$i<512;$i++,$j++)$checksum+=ord(substr($chunkafterCS,$j,1));
fwrite($f,$chunkbeforeCS,148);
$checksum=sprintf("%6s ",decoct($checksum));
$bdchecksum=pack("a8",$checksum);
fwrite($f,$bdchecksum,8);
fwrite($f,$chunkafterCS,356);
return true;}

static function tarcontent($f,$fa){
if(@is_dir($fa))return;
else{
	$size=filesize($fa);
	$padding=$size%512?512-$size%512:0;
	$f2=fopen($fa,'rb');
	if($f2)while(!feof($f2))fwrite($f,fread($f2,1024*1024));
	$pstr=sprintf("a%d",$padding);
	fwrite($f,pack($pstr,''));}}

static function tarfooter($f){fwrite($f,pack('a1024',''));}

static function addfile($fp,$f,$fb){
self::tarhead($fp,$f,$f); self::tarcontent($fp,$f);}

static function folder($f,$r){
mkdir_r($f); $fp=fopen($f,'w+');
foreach($r as $v)self::addfile($fp,$v,$v);
self::tarfooter($fp);
fclose($fp);}

static function addir($f,$dr){
$a=new PharData($f);//.tar
$r=scandir_r($dr);
foreach($r as $k=>$v)$a->addFile($v);
$a->compress(Phar::GZ);
//$pgz=$phar->convertToExecutable(Phar::TAR,Phar::GZ);//makes myphar.phar.tar.gz
//$p->decompress(); // creates /path/to/my.tar from .tar.gz
//$a->extractTo('/third/path',null,true);//extract all files, and overwrite
//iterator
//$a->buildFromIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dr)),$dr);
return $f.'.gz';}

static function gz($f){
$s=file_get_contents($f); 
$ok=file_put_contents($f.'.gz',gzencode($s,9));
if($ok)unlink($f);
return $f.'.gz';}

static function scan($dr,$o=''){$fp=opendir($dr); static $i; $ret=array();
while($d=readdir($fp)){$drb=$dr.'/'.$d; $i++;
if(is_dir($drb) && $d!='..' && $d!='.' && $d!='_notes' && !$o)
	$ret=array_merge($ret,self::scan($drb));
elseif(is_file($drb) && $d!='.php')$ret[$i]=$drb;}
return $ret;}

static function gzdir($f,$dr){
$r=self::scan($dr);
self::folder($f,$r);
$f=self::gz($f);
return lk('/'.$f);}

static function files($f,$list,$o=''){
set_time_limit(120);
if(is_file($f))unlink($f);
if(substr($f,-3)=='.gz'){$o=1; $f=substr($f,0,-3);}
if(!is_array($list))return;
$fp=fopen($f,'w+');
foreach($list as $v){
	if(is_dir($v)){$r=self::scan($v);
		foreach($r as $vb)self::addfile($fp,$vb,$vb);}
	elseif(is_file($v))self::addfile($fp,$v,$v);}
self::tarfooter($fp); fclose($fp);
if($o==1)$f=self::gz($f);
return $f;}

static function zip($fb,$f){
if(!extension_loaded('zip')||!file_exists($f))return false;
$zip=new ZipArchive();
if(!$zip->open($fb,ZIPARCHIVE::CREATE))return false;
$f=str_replace('\\','/',realpath($f));
if(is_dir($f)===true){
$r=new RecursiveIteratorIterator(new RecursiveDirectoryIterator($f),RecursiveIteratorIterator::SELF_FIRST);
foreach($r as $file){
	$file=str_replace('\\','/',$file);
	//Ignore "." and ".." folders
	if(in_array(substr($file,strrpos($file,'/')+1),['.','..']))continue;
	$file=realpath($file);
	if(is_dir($file)===true)$zip->addEmptyDir(str_replace($f.'/','',$file.'/'));
	elseif(is_file($file)===true)$zip->addFromString(str_replace($f.'/','',$file),file_get_contents($file));}}
elseif(is_file($f)===true)$zip->addFromString(basename($f),file_get_contents($f));
return $zip->close();}

static function zip0($f,$dr){//folder included
$z=new ZipArchive();
$z->open($f,ZIPARCHIVE::CREATE);
$z->addEmptyDir($dr);
self::folderToZip($f,$z,strlen("$f/"));
$z->close();}

static function com($p,$o){
$rid='plg'.randid(); $id='del'.$o;
$j=$rid.'_tar,gzdir____'.$o.'___'.$id;
$bt=inputj($id,'',$j,$p);
$bt.=lj('popsav',$j,'ok').' ';
return $bt.divd($rid,'');}

static function req(){
require('plug/tar/pclerror.lib.php');
require('plug/tar/pcltrace.lib.php');
require('plug/tar/pcltar.lib.php');}

static function extract($f,$to='/'){self::req();
PclTarExtract($f,$to,'',''); return $f;}

static function untar($f){$dr=__DIR__;
if(strpos($dr,'\\'))$r=explode('\\',str_replace('C:\laragon\www\nfo','',$dr));
else $r=explode('/',$dr);
$dr='/'.$r[1].'/'.$r[2];
$e='chmod -R 777 '.$dr; exc($e); //chmod('',0777);
$e='tar -zxvf '.$dr.'/'.$f.''; exc($e);}

static function create($f,$r){self::req();
PclTarCreate($f,$r,'',''); return $f;}

static function home($f,$dr){
if($f && $dr)return self::gzdir($f,$dr);
return self::com($f,'.tar');}
}
?>