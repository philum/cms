<?php //hexagon

class hexagon{

static function make($r,$type,$clr,$bdr){$rb=[];
foreach($r as $k=>$v)$rb[]=implode('/',$v);
return '['.$clr.','.$bdr.':attr]['.implode('-',$rb).':'.$type.']';}

static function repos($r,$x,$y,$sz){$rb=[];
foreach($r as $k=>$v)$rb[]=[$v[0]*$sz+$x,$v[1]*$sz+$y];
return $rb;}

static function hexa($n){$rb=[]; $angle=2*pi()/$n; //$p[0]=[1,1]; 
for($i=0;$i<=$n;$i++){
	$px=round(sin($angle*$i),2);
	$py=round(cos($angle*$i),2);
	$rb[$i]=[$px,$py];}
return $rb;}

static function sections($r,$n,$w,$clr,$bdr){$ret='';
$origin=[$w,$w]; $o=implode('/',$origin);
for($i=0;$i<=$n;$i++){$id='poly'.$n.'-'.$i;
	$a=implode('/',$r[$i]); $b=implode('/',isset($r[$i+1])?$r[$i+1]:$r[0]);
	$rb=[$o,$a,$b,$o];
	$ret.='['.$clr.','.$bdr.':attr]'.'['.implode('-',$rb).','.$id.':polygon]';}
return $ret;}

static function section1($r,$n,$w,$clr,$bdr){$ret='';
$origin=[$w,$w]; $o=implode('/',$origin);
$a=implode('/',$r[0]); $b=implode('/',$r[1]); $c=implode('/',$r[2]); $rb=[$o,$a,$b,$c,$o];
$ret.='['.$clr.','.$bdr.':attr]'.'['.implode('-',$rb).',poly1-1:polygon]';
$a=implode('/',$r[2]); $b=implode('/',$r[3]); $c=implode('/',$r[0]); $rb=[$o,$a,$b,$c,$o];
$ret.='['.$clr.','.$bdr.':attr]'.'['.implode('-',$rb).',poly1-2:polygon]';
return $ret;}

static function ring($n,$sz,$w,$h,$clr,$bdr){$rb=[];
$r=self::hexa($n,$w,$h,$sz);
$r=self::repos($r,$w,$h,$sz); //pr($r);
if($n==4)$d=self::section1($r,$n,$w,$clr,$bdr);
else $d=self::sections($r,$n,$w,$clr,$bdr);
return $d;}

static function build($p,$o){
//$r=msql::read_b('',nod('hexagon_1'));//p($r);
if(strpos($o,';'))[$n,$w,$h,$sz]=opt($o,';',2);
$w=640; $h=$w; $n=10; $sz=300;
//$r=self::hexa($n,$w/2,$h/2,sz);
//$r=self::repos($r,$w/2,$h/2,$sz); //pr($r);
//$d=self::make($r,'polygon','white','black');
$d=self::ring(18,300,$w/2,$h/2,'#666698','black');
$d.=self::ring(14,240,$w/2,$h/2,'#9D6568','black');
$d.=self::ring(10,180,$w/2,$h/2,'#FF9900','black');
$d.=self::ring(6,120,$w/2,$h/2,'#F6E617','black');
$d.=self::ring(4,60,$w/2,$h/2,'#FF0008','black');/**/
$ret=svg::home($d,$w.'/'.$h);
return $ret;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$$p;
$ret=self::build($p,$o);
return $bt.$ret;}

static function menu($p,$o,$rid){
$j=$rid.'_hexagon_call_inp';
$ret=inputj('inp',$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('hexagon');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
//$bt.=msqbt('',nod('hexagon_1'));
return $bt.divd($rid,$ret);}

}

?>