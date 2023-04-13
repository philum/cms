<?php //plugin_svg
//http://www.w3schools.com/svg/svg_feoffset.asp

class svg{static $ret=[],$w=600,$h=440;
function __construct($w='',$h=''){if($w)self::$w=$w; if($h)self::$h=$h;}

static function ex(){
$d1='
[red,black,1:attr]
[10,10,30,20:rect]
[300,220,200:circle]
[100,100,40,80:line]
[100,100,40,80:ellipse]
[200/10-250/190-160/210:polygon]
[20/20-40/20-60/60-20/40-20/20:polyline]
[popup_svg,home§[20,20§hello:text]:lj]
[rand,red,2:attr][M150 0 L75 200 L225 200 Z:path]
[purple,,,,,,rotate(330-40/20):attr][10,20§hello:text]
[blue:attr][280,140,http://philum.fr§[80,20,,1§hello:text]:a]
[20,20§[20,20§hello1:tspan][green:attr][20,40§hello2:tspan]:text]
[§[f1,0,0§[SourceGraphic,15:feGaussianBlur]:filter]:defs][rand,,,,0.4:attr][300,200,200,1:circle]';
$d2='
[§[grad1,0%,0%,0%,100%§[0%,rand:stop][100%,rand:stop]:linearGradient]:defs][,,,,,,,grad1:attr][0,0,600,400:rect]
[§[grad2,0%,0%,0%,100%§[0%,red,0:stop][100%,yellow:stop]:linearGradient]:defs][,,,,,,,grad2:attr][300,120,100:circle]
[§[grad3,0%,0%,0%,100%§[0%,rand,0:stop][100%,rand:stop]:linearGradient]:defs][,,,,,,,grad3:attr][0,200,600,200:rect]
[§[f1,0,0§[SourceGraphic,15:feGaussianBlur]:filter]:defs][rand,,,,0.4:attr][300,200,200,1:circle]

[§[f1§
[SourceGraphic,offOut,10,10:feOffset]
[offOut,matrixOut,matrix,0.2-0-0-0-0-0-0-2-0-0-0-0-0-0-2-0-0-0-0-0-1-0:feColorMatrix]
[matrixOut,10,blurOut:feGaussianBlur]
[SourceGraphic,blurOut,normal:feBlend]
:filter]:defs]
[rand,,,,0.4:attr][300,120,100,f1:circle]
';
return $d2;}

static function text($sz,$x,$y,$t,$clr){
self::$ret[]='['.$clr.':attr]['.$x.','.$y.','.$sz.'§'.$t.':text]';}
static function rect($x,$y,$w,$h,$clr,$clr2='',$wb='',$o='',$id='',$op=''){if(!$clr)$clr='none';
self::$ret[]='['.$clr.','.$clr2.','.$wb.',,'.$op.':attr]['.$x.','.$y.','.$w.','.$h.','.$o.','.$id.':rect]';}
static function line($x,$y,$x2,$y2,$clr,$wb='',$o='',$ob=''){
self::$ret[]='[none,'.$clr.','.$wb.',,,'.$ob.':attr]['.$x.','.$y.','.$x2.','.$y2.','.$o.':line]';}
static function ellipse($x,$y,$w,$h,$clr,$clr2='',$wb='',$o='',$op=''){if(!$clr)$clr='none';
self::$ret[]='['.$clr.','.$clr2.','.$wb.',,'.$op.':attr]['.$x.','.$y.','.$w.','.$h.','.$o.':ellipse]';}
static function circle($x,$y,$w,$clr,$clr2='',$wb='',$o='',$op=''){if(!$clr)$clr='none';
self::$ret[]='['.$clr.','.$clr2.','.$wb.',,'.$op.':attr]['.$x.','.$y.','.$w.','.$o.':circle]';}
static function poly($r,$clr,$clr2='',$wb='',$op=''){if(!$clr)$clr='none';
self::$ret[]='['.$clr.','.$clr2.','.$wb.',,'.$op.':attr]['.implode('-',$r).':polygon]';}
static function polyline($r,$clr,$clr2='',$wb='',$op=''){if(!$clr)$clr='none';
self::$ret[]='['.$clr.','.$clr2.','.$wb.',,'.$op.':attr]['.implode('-',$r).':polyline]';}
static function path($p,$clr,$clr2='',$wb='',$op=''){if(!$clr)$clr='none';
self::$ret[]='['.$clr.','.$clr2.','.$wb.',,'.$op.':attr]['.$p.':path]';}
static function lk($x,$y,$lk,$clr,$bt='',$onc=''){if(!$clr)$clr='black';
self::$ret[]='['.$clr.':attr]['.$x.','.$y.''.$lk.','.$onc.',1§'.$bt.':a]';}
static function lj($x,$y,$sz,$clr,$j,$bt){if(!$clr)$clr='black'; if(!$sz)$sz=12;
self::$ret[]='['.$clr.':attr]['.$j.'§['.$x.','.$y.','.$sz.'§'.$bt.':text]:lj]';}
static function tog($x,$y,$sz,$clr,$ti='',$bt=''){if(!$clr)$clr='black'; if(!$sz)$sz=12;
self::$ret[]='['.$clr.':attr][['.$x.','.$y.','.$sz.'§'.$bt.':text]§'.$ti.':tog]';}
static function bub($x,$y,$sz,$clr,$tx,$bt){if(!$clr)$clr='black'; if(!$sz)$sz=12;
self::$ret[]='['.$clr.':attr]['.$tx.'§['.$x.','.$y.','.$sz.'§'.$bt.':text]:bub]';}
static function bubj($x,$y,$sz,$clr,$j,$bt){if(!$clr)$clr='black'; if(!$sz)$sz=12;
self::$ret[]='['.$clr.':attr]['.$j.'§['.$x.','.$y.','.$sz.'§'.$bt.':text]:bubj]';}
static function bubj2($x,$y,$sz,$clr,$j,$tx,$bt){if(!$clr)$clr='black'; if(!$sz)$sz=12;
self::$ret[]='['.$clr.':attr]['.$tx.','.$j.'§['.$x.','.$y.','.$sz.'§'.$bt.':text]:bubj2]';}
static function img($im,$w='',$h=''){self::$ret[]='['.$im.','.$w.','.$h.':image]';}
static function draw(){$ret=implode('',self::$ret); self::$ret=''; $ret=self::com($ret);
return tag('svg',['version'=>'1.1','xmlns'=>'http://www.w3.org/2000/svg','xmlns:xlink'=>'http://www.w3.org/1999/xlink','x'=>'0px','y'=>'0px','width'=>self::$w,'height'=>self::$h],$ret);}//,'viewBox'=>'1400 0 1400 700'

static function save($d,$t){
$f='_datas/svg/'.$t.'.svg'; mkdir_r($f);
$ret='<?xml version="1.0" ?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
'.$d;//'.csscode('body{font-family:Arial;}').'
write_file($f,$ret);
return $f;}

static function spe(){
$path_type=['M'=>'moveto','L'=>'lineto','H'=>'horizontal lineto','V'=>'vertical lineto','C'=>'curveto','S'=>'smooth curveto','Q'=>'quadratic B§zier curve','T'=>'smooth quadratic B§zier curveto','A'=>'elliptical Arc','Z'=>'closepath'];
$filters=['feBlend','feColorMatrix','feComponentTransfer','feComposite','feConvolveMatrix','feDiffuseLighting','feDisplacementMap','feFlood','feGaussianBlur','feImage','feMerge','feMorphology','feOffset','feSpecularLighting','feTile','feTurbulence','feDistantLight','fePointLight','feSpotLight'];}

static function motor(){return [
'attr'=>['fill','stroke','stroke-width','size','fill-opacity','stroke-dasharray','transform','fillurl','stroke-linecap'],////transform:rotate(30,20,40)//dash:5,5//line-cap:butt,square,round//
'circle'=>['cx','cy','r','filter'],
'rect'=>['x','y','width','height','filter','id','class'],
'ellipse'=>['cx','cy','rx','ry','filter','id','style'],
'line'=>['x1','y1','x2','y2','filter','id','style'],
'polygon'=>['points','id'],//200/10-250/190-160/210
'polyline'=>['points','id'],//20/20-40/20-60/60-20/40-20/60
'path'=>['d'],//M150 0 L75 200 L225 200 Z
'text'=>['x','y','font-size','filter','id','class'],
'tspan'=>['x','y'],
'image'=>['xlink:href','width','height'],
'a'=>['x','y','xlink:href','onclick','target'],
'js'=>['onclick','onmouseover'],
'lj'=>['onclick','onmouseover'],
'tog'=>['txt'],
'bub'=>['txt'],
'bubj'=>['j'],
'bubj2'=>['txt','j'],
'filter'=>['id','x','y'],//,'filter','value'
'feOffset'=>['in','result','dx','dy'],
'feColorMatrix'=>['in','result','type','values'],
'feGaussianBlur'=>['in','stdDeviation','result'],
'feBlend'=>['in','in2','mode'],
'linearGradient'=>['id','x1','y1','x2','y2'],
'stop'=>['offset','style','opac']];}

static function clr($d=''){
$r=sesmk('colors','',1); $rb=array_keys($r);
if($d=='rand')$d=rand(0,count($rb)-1);
return is_numeric($d)?$rb[$d]:$d;
return arr($rb,$d);}

static function prop($d){return str_replace(['/','-','_'],[',',' ','-'],$d);}

//svgconn
static function conn($d){$ra=self::motor();
[$p,$b]=split_one(':',$d,1); [$p,$v]=expl('§',$p); $rb=explode(',',$p);
if(isset($ra[$b]))$pr=array_combine_a($ra[$b],$rb); else $pr=[];
if($b=='attr'){ses('attr',$pr);$pr=[];}
elseif(ses('attr')){$pr=array_merge_b($pr,ses('attr'));$_SESSION['attr']='';}//
//if($b=='attrb'){foreach($rb as $vb){[$atb,$va]=explode('=',$vb); $pr[$atb]=$va;}ses('attr',$pr);$pr='';}
if(isset($pr['points']))$pr['points']=self::prop($pr['points']);
if(isset($pr['d']))$pr['d']=self::prop($pr['d']);
if(isset($pr['transform']))$pr['transform']=self::prop($pr['transform']);
if(isset($pr['fill']))$pr['fill']=self::clr($pr['fill']);
if(isset($pr['stroke']))$pr['stroke']=self::clr($pr['stroke']);
if(isset($pr['onclick']) && $b=='lj'){$pr['onclick']=sj(str_replace(';',',',$pr['onclick'])); $b='a';}
if(isset($pr['onclick']) && $b=='js'){$pr['onclick']=$pr['onclick']; $b='a';}
if(isset($pr['onmouseover']) && $b=='lj'){$pr['onmouseover']=sj($pr['onmouseover']); $b='a';}
if(isset($pr['onmouseover']) && $b=='js'){$pr['onmouseover']=$pr['onmouseover']; $b='a';}
if($b=='tog')return togbt($pr['txt'],$v);
if($b=='bub')return bubjs($pr['txt'],$v);
//if($b=='bubj')pr($pr);
if($b=='bubj')return bubj(str_replace(';',',',$pr['j']),$v);
if($b=='bubj2')return bubj2($pr['txt'],str_replace(';',',',$pr['j']),$v);
if(!empty($pr['fillurl'])){$pr['fill']='url(#'.$pr['fillurl'].')';$pr['fillurl']='';}
if(!empty($pr['filter']))$pr['filter']='url(#'.$pr['filter'].')';
if($b=='feColorMatrix')$pr['values']=self::prop($pr['values']);
if($b=='stop'){$pr['style']='stop-color:'.self::clr($pr['style']).'; ';
	if(isset($pr['opac']))$pr['style'].='stop-opacity:'.$pr['opac'].';';}
//echo $b.br(); pr($pr);
if($b!='attr')return tag($b,$pr,$v);}

static function com($d){
$d=deln($d); $d=str_replace("&nbsp;",' ',$d);//eco($d,1);
return codeline::parse($d,'','svg');}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
$ret=self::com($p); //eco($p);
if(!$o)$o='600/440'; [$w,$h]=expl('/',$o);
$pr=['version'=>'1.1','width'=>$w,'height'=>$h];
return tag('svg',$pr,$ret);}

static function home($p,$o){$rid='plg'.randid(); $ret='';
if(!$p){$p=self::ex();
$ret=textarea('inp',$p,74,10).' ';
$ret.=lj('',$rid.'_svg,call_inp___'.$o,picto('ok')).' ';}
return $ret.divd($rid,self::call($p,$o));}
}
?>