<?php //bazx
class bazx{
static $conn=1;
static function parse($d,$o){$st='('; $nd=')'; $in=strpos($d,$st);
if($in!==false){$deb=substr($d,0,$in);
	$out=strpos(substr($d,$in+1),$nd);
	if($out!==false){$nb_in=substr_count(substr($d,$in+1,$out),$st);
		if($nb_in>=1){
			for($i=1;$i<=$nb_in;$i++){$out_tmp=$in+1+$out+1;
				$out+=strpos(substr($d,$out_tmp),$nd)+1;
				$nb_in=substr_count(substr($d,$in+1,$out),$st);}
			$mid=substr($d,$in+1,$out);
			$mid=self::parse($mid,$o);}
		else $mid=substr($d,$in+1,$out);
		$mid=self::conn($mid);
		$end=substr($d,$in+1+$out+1);
		$end=self::parse($end,$o);}
	else $end=substr($d,$in+1);}
else $end=$d;
return ($deb.$mid.$end);}

static function conn($d){
[$ob,$op]=split_right(':',$d);
[$od,$oq]=split_one('/',$op);
//echo $ob.'-'.$od.'-'.$oq.br();
if($oq)switch($od){
case('bal'):return tagb($oq,$ob);break;
else switch($op){
case('br'):return br();break;
case('b'):return tagb($op,$ob);break;
case('u'):return tagb($op,$ob);break;}
return '('.$d.')';}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
return self::parse($p,$o);}

static function menu($p,$o,$rid){
$ret.=textarea('tx',$p,44,11,['class'=>'console']).' ';
$ret.=lj('',$rid.'_bazx,call_tx',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=self::menu($p,$o,$rid); 
$ret=self::parse($p,$o);
//$bt.=msqbt('',ses('qb').'_baz');
return $bt.divd($rid,$ret);}
}
?>