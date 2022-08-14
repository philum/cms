<?php
session_start();
error_reporting(-1);
ini_set('display_errors',1);
if(!function_exists('p'))require('progb/lib.php');//
$_SESSION['uproot']='../users/'.ses('qb').'/downloads';//destination folder

function fsize_b($d){$u=['B','KB','MB'];
	return @round($d/pow(1024,($i=floor(log($d,1024)))),1).' '.$u[$i];}

if(isset($_FILES['myfile'])){
	$n=$_FILES['myfile']['name']; $n=strtolower($n);
	$tmp=$_FILES['myfile']['tmp_name'];
	$t=$_FILES['myfile']['type'];
	$s=fsize_b($_FILES['myfile']['size']);
	$f=$_SESSION['uproot'].'/'.$n;
	//if(is_file($tmp))echo $f;
	if(is_uploaded_file($tmp))//echo $tmp;
	//if(is_file($tmp))$d=read_file($tmp); if($d)write_file($f,$d);
	if(move_uploaded_file($tmp,$f))echo lka($f).' type: '.$t.' '.$s.br();
	//elseif(!rename($tmp,$f))echo 'error_up';
	else return 'error';
}

?>