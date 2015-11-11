<?php
//philum_plugin_gravatar
session_start();
//if(!function_exists('p'))require('../progb/lib.php');

function grav_hash($d){
return md5(strtolower(trim($d)));}

function grav_profile($h){
$str=file_get_contents('http://www.gravatar.com/'.$h.'.php');
$profile=unserialize($str);
if(is_array($profile) && isset($profile['entry']));
return $profile['entry'][0]['displayName'];}

function plug_gravatar($d,$id){//mail
$h=grav_hash($d); $size=48;
$here='http://'.$_SERVER['HTTP_HOST'].'/imgb/grav_homestar.jpg';
$grav_url='http://www.gravatar.com/avatar/'.$h.'?d='.$here.'&s='.$size;
$nm=grav_profile($h);
return image($grav_url,'" title="'.$nm.'"','');}

?>