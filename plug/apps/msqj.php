<?php //app
class msqj{

static function build($p,$o){
$p=str_replace('|','/',$p);
[$dr,$nd]=msqa::murlvars($p);
header('Content-Type: text/json');
return msql::json($dr,$nd);}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
return self::build($p,$o);}

static function home($p,$o){
return self::call($p,$o);}
}
?>