<?php //twice
class twice{
static function ra2deg($d){//00h00m
$ad1=substr($d,0,2); $ad2=substr($d,3,2);
return round($ad1/24*360+$ad2/60,4);}

static function dec2deg($d){//+00°00'
$ad1=(int) mb_substr($d,0,3); $ad2=mb_substr($d,4,2);
return round($ad1+($ad2/60)/100,4);}

static function build($p,$o){
$a=0.1; $rb=[];
//$ra=star::home('dc > -23.432, dc < -21.82, ra > 255.25, ra < 270.83, dist < 100'); pr($ra);
$r=msql::row('','ummo_exo_twice',$p);
if($r)foreach($r as $k=>$v){$res=''; $n='';
	$dc=self::ra2deg($v[1]);
	$req='ra > '.($dc-$a).', ra < '.($dc+$a).', dc > '.($v[2]-$a).', dc < '.($v[2]+$a).'';//, dist < 100
	$rc=star::build($req);
	if($rc){$rd=array_keys_r($rc,1); array_shift($rd); if($rd)$res=implode(',',$rd); $n=count($rd);}
	$rb[]=[$v[0],$dc,$v[2],$n,$res];}
return tabler($rb);}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
$ret=self::build($p,$o);
return $ret;}

static function r(){
return ['aa'=>'a','bb'=>'b'];}

static function menu($p,$o,$rid){
$ret=select_j('inp','pclass','','twice/r','','2');
//$ret.=togbub('twice,r','',btn('popbt','select...'));
$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_twice,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
//$bt.=msqbt('',nod('twice'));
return $bt.divd($rid,$ret);}
}
?>