<?php
class dir2table{
static function home($d,$p){$r=explore($d); //p($r);
[$dr,$nod]=split_right('/',$p,'');
if($r)msql::modif($dr,$nod,msql::nb($r),'add',['src'],'');
$rb=msql::read($dr,$nod,''); if(!$rb)return 'error'; //p($rb); //1d_array
return tabler(msql::nb($rb));}
}
?>