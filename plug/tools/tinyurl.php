<?php 
class tinyurl{
static function home($u){$ch=curl_init(); $tim=5;  
curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$u);  
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$tim);  
$ret=curl_exec($ch);  
curl_close($ch);  
return $ret;}
}
?>