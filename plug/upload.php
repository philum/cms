<?php
//philum_plug-in_upload
session_start();

function upurlsav($dr,$o,$u){$u=ajxg($u);
if(!is_image($u))return'no'; $ret=get_file($u); $nm=strrchr($u,'/');
$f='users/'.$dr.'/'.$nm; write_file($f,$ret);
return 'ok';}

function upurl($p,$id){req('ajxf');
return assistant($id,'SaveJ',$id.'upurl_plug___upload_upurlsav_'.ajx($p).'__'.$id,'http://','');}

//gb: banim,avnim,bkgim,edit_css,disk
function up_form($go,$p){
$go=str_replace(array('*','(and)','(slash)','(equal)'),array('_','&','/','='),$go);
if($p)$chk='<input type="checkbox" name="imatop" id="imatop" value="ok" checked="1"  class="txtsmall2"/><label for="imatop" class="txtsmall2">top</label><input type="checkbox" name="imnot" id="imnot" value="ok" class="txtsmall2"/> <label for="imnot" class="txtsmall2">not</label>';
$ret='<link href="../css/_global.css" rel="stylesheet" type="text/css">';
$ret.='<form name="form1" method="post" action="../ajax.php?callj=upload&'.$go.'&chk='.$p.'&im=on" enctype="multipart/form-data" style="margin:0; padding:0;">
<input type="file" name="fichier" class="txtbox" style="width:86px; padding:0; margin:0;" />
<input type="submit" value="upload" class="txtx" /></form>';
//'.nms(28).'//opdir='.$go.'&mode='.$gb.''.$chk.'
return $ret;}

function up_iframe($d,$p){
return '<iframe src="/plug/upload.php?open==&go='.ajx($d).'&chk='.$p.'" frameborder="0" margin="0" hspace="0" scrolling="no" style="width:300px; height:26px;"></iframe>';}

function up_back($d){return '<a href="'.$d.'" target="_parent" class="txtx">refresh</a>';}

function upload_sav($d,$p){req('sav'); $id=ses('read'); if($id)req('pop');
$ret=css_link('/css/_global.css').js_link('/prog/ajx.js').js_link('/prog/utils.js');
$_POST["imnot"]=1; list($er,$url)=save_img(); $t=$er?$er:'saved'; 
//foreach($_GET as $k=>$v)if($k=='opdir' or $k=='mode' or $k=='read')$lk.='&'.$k.'='.$v;
//$tb=$t?strrchr_b($t,'/'):'empty';
$ret.=up_form($_GET['go'],$_GET['chk']);
if($_GET['chk'])$ret.=up_back(urlread($id));
//if($_GET['mode']=="banim")$ret.=up_back('/?admin=banner');
return $ret;}

function plug_upload($d,$p){
if($_GET['im'])return upload_sav($d,$p); else return up_iframe($d,$p);}

if($_GET['open'] && $_SESSION['auth']>4)echo up_form($_GET['go'],$_GET['chk']);

?>