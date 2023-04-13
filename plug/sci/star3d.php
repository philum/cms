<?php //star3d

class star3d{
//var datas=[["Milky Way",4.4637,-0.5061,26100,10,-221258.63,126445.65,-64240.84,white,"0","","Milky Way"],["Oomo",3.15,0.16,14.6,10,-1.21,24.49,-145.99,green,"0","","Oomo"]
static function build($p){$ret='';
//known datas
$ra=msql::read('','ummo_exo_5','',1); $rc=[];
if($ra)foreach($ra as $k=>$v)if($v[8])$rc[$v[8]]=['nm'=>$v[0],'clr'=>$v[5],'planet'=>$v[6],'nfo'=>$v[9]];
if($p=='knownstars')$p=implode(',',array_keys_r($ra,8));

$cl='hip,round(rarad,2),round(decrad,2),round(dist*3.261564,2),round(x,2)*100,round(y,2)*100,round(z,2)*100,spect,hd';
$qp=implode('","',explode(',',$p));
$r=sql::call('select '.$cl.' from hipparcos where hip in("'.$qp.'")','',0); //pr($r);
if(!$r)return;
array_unshift($r,['Sun',3.1416,0,0,0,0,0,0]);
array_unshift($r,['Yooma',3.28,0.16,14.6,0,0,0,0,0,'','','',"Oomo"]);
$rc['Yooma']=['nm'=>'Yooma','clr'=>'green','planet'=>'Oomo','nfo'=>''];
array_unshift($r,['Milky Way',4.4637,-0.5061,26100,10,0,0,0]);
$ret='//'.count($r).' stars'.n();

foreach($r as $k=>$v){
[$nm,$ad,$dc,$ds,$x,$y,$z,$sp,$hd]=arr($v,9); $hip=$nm; 
 
$dscale=10;
$scale=100000000000;
if(substr($sp,0,1)==strtolower(substr($sp,0,1))){
if(substr($sp,1,1)==strtolower(substr($sp,1,1))){$ty=substr($sp,2,1);}
else $ty=substr($sp,1,1);}
else $ty=substr($sp,0,1);

$sz=10;
/*if($ty=='M')$sz=1;
elseif($ty=='K')$sz*=1;
elseif($ty=='G')$sz*=1.2;
elseif($ty=='F')$sz*=2;
elseif($ty=='A')$sz*=10;
elseif($ty=='B')$sz*=18;
elseif($ty=='O')$sz*=38;*/

if($nm=='Sun')$sz=1;
//if($nm=='27989')$sz=100;//Betelgeuse
//if($nm=='32349')$sz=20;//Sirius
$pc=4;

/*//if($a==0 or $b==0){}
$x=(sin($a))*$ds; 
$y=(cos($b))*$ds; 
$z=sin($a-$b)*$ds;*/

/*$x=sin($ad)*cos($dc)*$ds;
$y=sin($dc)*cos($ad)*$ds;
$z=cos($ad)*cos($dc)*$ds;*/

//used
//$ds=log($ds)**2;
$x=0-sin($ad)*cos($dc)*$ds; $y=sin($dc)*$ds; $z=cos($ad)*$ds;
//[$x,$y,$z]=maths::xyz($ad,$dc,$ds,1,1);
//echo $nm.' sz='.$sz.' ds='.$ds.' x='.$x.n();
//$x=0-$x;

/*$x=0-round(sin($ad)*cos($dc)*$ds*$dscale,$pc);
$y=round(sin($dc)*$ds*$dscale,$pc);
$z=round(cos($ad)*$ds*$dscale,$pc);*/

//maths
/*$x=sin($dc)*sin($ad)*$ds; 
$y=sin($dc)*cos($ad)*$ds; 
$z=cos($dc)*$ds;*/

$x*=$dscale; $y*=$dscale; $z*=$dscale; 
$x=round($x,2); $y=round($y,2); $z=round($z,2);

switch($rc[$nm]['clr']??$nm){//violet
case('amical'):$clr='green';break;
case('inamical'):$clr='orange';break;
case('danger'):$clr='red';break;
case('neutre'):$clr='white';break;
case('indéfini'):$clr='silver';break;
default:$clr='grey';break;}
if($nm=='Sun')$clr='yellow';
if($nm=='Yooma')$clr='green';
/*elseif($nm=='Oomo' or $nm=='81693' or $nm=='88601' or $nm=='99461' or $nm=='2021')$clr='green';
elseif($nm=='116771' or $nm=='1392' or $nm=='115445' or $nm=='910' or $nm=='113421' or $nm=='113896' or $nm=='4849')$clr='orange';
elseif($nm=='37279' or $nm=='27989' or $nm=='32349')$clr='purple';
elseif($nm=='8102')$clr='red';*/

$pl=$rc[$nm]['planet']??'';

//names
if($rc[$nm]['nm']??'')$nm=$rc[$nm]['nm'];
elseif($nm=='81693')$nm='Dookaïa';
elseif($nm=='88601')$nm='70 Ophiuchi';
elseif($nm=='99461')$nm='Iox';
elseif($nm=='2021')$nm='Bet Hyi';
elseif($nm=='8102')$nm='Tau Ceti';

//lines
/*if($nm=='37279'){$dots[0]=[$x,$y,$z]; $nm='Procyon';}
if($nm=='27989'){$dots[1]=[$x,$y,$z]; $nm='Betelgeuse';}
if($nm=='32349'){$dots[2]=[$x,$y,$z]; $nm='Sirius';}*/

//nominations
//if(is_numeric($nm))$nm='HIP '.$nm;
if(!$nm)$nm='HIP'.$hip;
$rb[]='["'.$nm.'",'.$ad.','.$dc.','.$ds.','.$sz.','.$x.','.$y.','.$z.','.$clr.',"'.$sp.'","'.$hd.'","'.$hip.'","'.$pl.'"]';
//$ret.='star("'.$nm.'",'.$sz.','.$x.','.$y.','.$z.','.$clr.','.$ad.','.$dc.','.$ds.');'.n();
}
//pr($rb);
$ret.='var datas=['.implode(',',$rb).'];'.n();
$ret.='allstars(datas,1);//open label'.n();

//lines
/*
if(count($dots)==3){$ret.='var procyon_betelgueuse = BABYLON.Mesh.CreateLines("ax", [new BABYLON.Vector3('.$dots[0][0].','.$dots[0][1].','.$dots[0][2].'), new BABYLON.Vector3('.$dots[1][0].','.$dots[1][1].','.$dots[1][2].'), new BABYLON.Vector3('.$dots[2][0].','.$dots[2][1].','.$dots[2][2].'), new BABYLON.Vector3('.$dots[0][0].','.$dots[0][1].','.$dots[0][2].')], scene);'.n();*/

$ret.='
//buttons
addbt("Sun",datas);
addbt("Yooma",datas);
//addbt("Zeta Herculis",datas);
//addbt("Gliese 783",datas);
//addbt("70 Ophiuchi",datas);
//addbt("Gliese 282",datas);
//addbt("Bet Hyi",datas);
';
if(count($rb)==4)$ret.='addbt("'.$nm.'",datas);';
$ret.='screenshot("photo");';
return $ret;}

static function js($p,$o='',$prm=[]){
$p=$prm[0]??$p;
$vars=self::build($p); //eco($vars);
$bab=file_get_contents('js/bab.js');
$bab.=file_get_contents('js/bab_star.js');
$rid=('scn');//randid
return '
window.addEventListener("DOMContentLoaded",function(){
	var canvas = document.getElementById("'.$rid.'");
	var engine = new BABYLON.Engine(canvas, true);
	var createScene = function(){
	var scene = new BABYLON.Scene(engine);
	'.$bab.'
	'.$vars.'
	return scene;}
	var scene = createScene();
	engine.runRenderLoop(function(){scene.render();});
	window.addEventListener("resize", function(){engine.resize();});
});';}

static function play($p){$rid=('scn');//randid
return tag('canvas',['id'=>$rid,'class'=>'canvas'],'');}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
//$sq=star::sq($p);
//$r=star::build($p);
//$rb=array_column($r,1); $d=implode(',',$rb);
//$d=self::build($p);
$ret=self::play($p);
//$ret.=Head::generate();
return $ret;}

static function menu($p,$o,$rid){
$j=$rid.'_star3d,call_insd_jsxr';
$ret=inputj('insd','81693,99461,88601',$j).'';
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid('s3d'); $ret=''; $bt='';
Head::add('csscode','html,body{overflow:hidden; width:100%; height:100%; padding:0; margin:0;}
#'.$rid.'{width:100%; height:100%; touch-action:none;}
.canvas{width:100%; height:100%; touch-action: none;}');
//Head::add('jslink','https://preview.babylonjs.com/inspector/babylon.inspector.bundle.js');
//Head::add('jslink','https://www.babylonjs.com/hand.minified-1.2.js');
Head::add('jslink','https://preview.babylonjs.com/babylon.js');
Head::add('jslink','https://preview.babylonjs.com/gui/babylon.gui.min.js');
//Head::add('jslink','https://preview.babylonjs.com/cannon.js');
//Head::add('jslink','https://preview.babylonjs.com/oimo.js');//physics
//Head::add('jslink','/js/bab.js');
if(!$p)$bt=self::menu($p,$o,$rid);
$bt.=lkt('txtx','/app/star3d/'.$p,picto('chain'));
if($p)$ret=self::call($p,$o);
Head::add('jscode',self::js($p));
return $bt.divd($rid,$ret);}
}
?>