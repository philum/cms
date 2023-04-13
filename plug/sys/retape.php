<?php 
#retape arts pour désactiver rstr70
class retape{

static function home($p,$o){
$p=$p?$p:1000; $o=$o?$o:1; $n=$p*$o; $w='id>'.($n-$p).' AND id<'.$n;
$w='id=10';//
$rq=sql('id,msg','qdm','q',$w);
if($rq)while($r=sql::qrw($rq))retape($r[1],$r[0]);//echo $r[1];//
$ret=lkc('txtx','/app/retape/'.$p.'/'.($o+1),$o+1);
return $ret;}
}
?>