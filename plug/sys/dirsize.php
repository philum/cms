<?php 
class dirsize{
static function home($dr){$r=scandir_r($dr); $n=0;
if($r)foreach($r as $k=>$v)if($v!='_trash.php')$n+=filesize($v);
return round($n/1024);}
}
?>