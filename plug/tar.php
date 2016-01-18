<?php
//philum_plugin_tar

// Adds file header to the tar file,it is used before adding file content.
// f: file resource (provided by eg. fopen)
// fa: path to file
// fb: path to file in archive, directory names must be followed by '/'
function TarAddHeader($f,$fa,$fb){
    $info=stat($fa);
    $ouid=sprintf("%6s ",decoct($info[4]));
    $ogid=sprintf("%6s ",decoct($info[5]));
    $omode=sprintf("%6s ",decoct(fileperms($fa)));
    $omtime=sprintf("%11s",decoct(filemtime($fa)));
    if(@is_dir($fa)){$type="5";
         $osize=sprintf("%11s ",decoct(0));}
    else{$type='';
         $osize=sprintf("%11s ",decoct(filesize($fa)));
         clearstatcache();}
    $dmajor=''; $dminor=''; $gname=''; $linkname=''; $magic=''; $prefix='';
    $uname=''; $version='';
    $chunkbeforeCS=pack("a100a8a8a8a12A12",$fb,$omode,$ouid,$ogid,$osize,$omtime);
    $chunkafterCS=pack("a1a100a6a2a32a32a8a8a155a12",$type,$linkname,$magic,$version,$uname,$gname,$dmajor,$dminor ,$prefix,'');

    $checksum=0;
    for($i=0; $i<148; $i++)$checksum+=ord(substr($chunkbeforeCS,$i,1));
    for($i=148; $i<156; $i++)$checksum+=ord(' ');
    for($i=156,$j=0; $i<512; $i++,$j++)$checksum+=ord(substr($chunkafterCS,$j,1));

    fwrite($f,$chunkbeforeCS,148);
    $checksum=sprintf("%6s ",decoct($checksum));
    $bdchecksum=pack("a8",$checksum);
    fwrite($f,$bdchecksum,8);
    fwrite($f,$chunkafterCS,356);
    return true;
}
// Writes file content to the tar file must be called after a TarAddHeader
// f:file resource provided by fopen
// fa: path to file
function TarWriteContents($f,$fa){
    if(@is_dir($fa))return;
    else{
        $size=filesize($fa);
        $padding=$size % 512 ? 512-$size%512 : 0;
        $f2=fopen($fa,"rb");
        while(!feof($f2))fwrite($f,fread($f2,1024*1024));
        $pstr=sprintf("a%d",$padding);
        fwrite($f,pack($pstr,''));
    }
}
// Adds 1024 byte footer at the end of the tar file
// f: file resource
function TarAddFooter($f){fwrite($f,pack('a1024',''));}

function tar($f,$r){$fp=fopen($f,'w+');
foreach($r as $v){$vb=str_replace(array('../','_public/'),'',$v);
TarAddHeader($fp,$v,$vb); TarWriteContents($fp,$v);} 
TarAddFooter($fp);
fclose($fp);}

function targz($f,$r){tar($f,$r);
$s=file_get_contents($f); 
$ok=file_put_contents($f.'.gz',gzencode($s,9));
if($ok)echo $f; unlink($f);
return $f.'.gz';}

function read_dir($dr,$o=''){$fp=opendir($dr); static $ret; static $i;
while($d=readdir($fp)){$drb=$dr.'/'.$d; $i++;
if(is_dir($drb) && $d!='..' && $d!='.' && $d!='_notes' && !$o)read_dir($drb);
elseif(is_file($drb) && $d!='.php')$ret[$i]=$drb;}
return $ret;}

function tar_com($p,$o){$rid='plg'.randid(); $id='del'.$o;
$ret.=autoclic($id,$p?$p:$o,44,1000,'',1);
$ret.=lj('popsav',$rid.'_plug__xd_del_delj_'.$o.'__'.$id,'ok').' ';
$ret.=btd($rid,'').br();
return $ret;}

function plug_tar($f,$dir){
$r=read_dir($dir); //p($r);
targz($f,$r);
return lkc('',$f,$f);}//tar_com($f,'.tar').

?>