<?php
//philum_dir2table

function plug_dir2table($d,$p){$r=explore($d); //p($r);
list($dr,$nod)=split_right('/',$p,'');
if($r)msql_modif($dr,$nod,msq_prep($r),array('src'),'add','mdf');
$rb=msql_read($dr,$nod,''); if(!$rb)return 'error'; //p($rb); //1d_array
return make_tables('',msq_prep($rb),$csa,$csb);}

?>