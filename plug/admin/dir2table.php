<?php
//philum_dir2table

function plug_dir2table($d,$p){$r=explore($d); //p($r);
list($dr,$nod)=split_right('/',$p,'');
if($r)msql::modif($dr,$nod,msql::nb($r),'add',['src'],'');
$rb=msql_read($dr,$nod,''); if(!$rb)return 'error'; //p($rb); //1d_array
return tabler(msql::nb($rb));}

?>