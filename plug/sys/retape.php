<?php
//philum_plugin_retape
//tag:system
//usage:retape arts pour désactiver rstr70

function plug_retape($p,$o){
$p=$p?$p:1000; $o=$o?$o:1; $n=$p*$o; $w='id>'.($n-$p).' AND id<'.$n;
$w='id=10';//
req('pop'); $rq=sql('id,msg','qdm','q',$w);
if($rq)while($r=mysqli_fetch_row($rq))retape($r[1],$r[0]);//echo $r[1];//
$ret=lkc('txtx','/plug/retape/'.$p.'/'.($o+1),$o+1);
return $ret;}

?>