<?php
//philum_tests
session_start();
ini_set('display_errors',1);
error_reporting(-1);//E_NOTICE/E_ALL/E_STRICT
require_once('../progb/lib.php');
//http://lehollandaisvolant.net/?d=2012/07/25/18/35/32-script-denvoi-de-fichiers-minimaliste-dragndrop-pure-js

function upim_h(){
$_SESSION['uproot']='users/'.ses('qb').'/downloads';//destination folder
Head::add('csslink','../css/_admin.css');
//Head::add('jslink','../js/upload.js');
Head::add('csscode','
.upload_form_cont {border:1px solid transparent; color:#000;}
.info {background:#eee; border:1px solid #ddd; font-weight:bold; margin:20px;}
.info > div {padding:10px 15px;}
.info > h2 {padding:0 15px;}
#dropArea {background:#ddd; border:3px dashed #000; font-size:32px; height:50px; line-height:50px; margin:10px; text-align:center;}
#dropArea.hover {background:#ccc;}
#result .success, #result .failure {font-size:12px; margin-bottom:10px; padding:5px; border-radius:5px;}
#result .success {background-color:#77fc9f;}
#result .failure {background-color:#fcc577;}
}');}
upim_h();
echo Head::get();

function fsize_b($d){$u=array('B','KB','MB');
	return @round($d/pow(1024,($i=floor(log($d,1024)))),1).' '.$u[$i];}

function upload_j(){
//p($_FILES);
if(isset($_FILES['myfile']) && $_SESSION['uproot']){
	$tmp=$_FILES['myfile']['tmp_name'];
	$t=$_FILES['myfile']['type'];
	$s=fsize_b($_FILES['myfile']['size']);
	$n=$_FILES['myfile']['name']; $n=strtolower($n);
	$f=$_SESSION['uproot'].'/'.$n;
	//if(is_uploaded_file($tmp))echo $tmp;
	if(is_file($tmp))echo $f;
	//if(is_file($tmp))$d=read_file($tmp); if($d)write_file($f,$d);
	if(move_uploaded_file($tmp,$f))return lka($f).' type: '.$t.' '.$s.br();
	//elseif(!rename($tmp,$f))return ' error_up';
	else return 'error';
	}
else return 'nothing';}

function plug_upim(){
upim_h();
return '
<div class="container">
	<div class="contr"></div>
	<div class="upload_form_cont">
		<div class="info">
			<div id="dropArea">Drop Area</div>
			<div>
				<span id="count"></span>
			</div>
			<div id="result"></div>
		</div>
	</div>
</div>
<script src="../js/upload.js"></script>
';
//js_code(up_js());
}

if(!@$_GET['plug'])echo upload_j();

?>