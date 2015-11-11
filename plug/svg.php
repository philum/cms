<?php
//philum_plugin_svg
//http://www.w3schools.com/svg/svg_feoffset.asp

function svg_spe(){
$path_type=array('M'=>'moveto','L'=>'lineto','H'=>'horizontal lineto','V'=>'vertical lineto','C'=>'curveto','S'=>'smooth curveto','Q'=>'quadratic Bézier curve','T'=>'smooth quadratic Bézier curveto','A'=>'elliptical Arc','Z'=>'closepath');
$filters=array('feBlend','feColorMatrix','feComponentTransfer','feComposite','feConvolveMatrix','feDiffuseLighting','feDisplacementMap','feFlood','feGaussianBlur','feImage','feMerge','feMorphology','feOffset','feSpecularLighting','feTile','feTurbulence','feDistantLight','fePointLight','feSpotLight');}

function svg_motor(){return array(
'attr'=>array('fill','stroke','stroke-width','size','fill-opacity','stroke-dasharray','transform','fillurl'),//transform:rotate(30 20,40)//dash:5,5
'circle'=>array('cx','cy','r','filter'),
'rect'=>array('x','y','width','height','filter'),
'ellipse'=>array('cx','cy','rx','ry','filter'),
'line'=>array('x1','y1','x2','y2','filter'),
'polygon'=>array('points'),//200,10 250,190 160,210
'polyline'=>array('points'),//20,20 40,25 60,40 80,120 120,140 200,180
'path'=>array('d'),//M150 0 L75 200 L225 200 Z
'text'=>array('x','y','filter'),
'tspan'=>array('x','y'),
'a'=>array('x','y','xlink:href','onclick','target'),
'lj'=>array('x','y','onclick'),
'filter'=>array('id','x','y'),//,'filter','value'
'feOffset'=>array('in','result','dx','dy'),
'feColorMatrix'=>array('in','result','type','values'),
'feGaussianBlur'=>array('in','stdDeviation','result'),
'feBlend'=>array('in','in2','mode'),
'linearGradient'=>array('id','x1','y1','x2','y2'),
'stop'=>array('offset','style','opac'),
);}

function svg_clr($d=''){$r=mread('system/edition_colors','',1);
$rb=array_keys($r); if($d=='rand')$d=rand(0,count($rb));
return is_numeric($d)?$rb[$d]:$d;}

function svg_build_prop($d){return str_replace(array('/','-'),array(',',' '),$d);}

//svgconn
function svg_conn($d){$ra=svg_motor();
list($p,$b)=split_one(':',$d,1); list($p,$v)=split('§',$p);
$rb=explode(',',$p); $pr=array_combine_a($ra[$b],$rb);
if($b=='attr'){ses('attr',$pr);$pr='';} 
elseif(ses('attr')){$pr=array_merge_b($pr,ses('attr'));$_SESSION['attr']='';}//
//if($b=='attrb'){foreach($rb as $vb){list($atb,$va)=split('=',$vb);$pr[$atb]=$va;}ses('attr',$pr);$pr='';}
if(isset($pr['points']))$pr['points']=svg_build_prop($pr['points']);
if(isset($pr['transform']))$pr['transform']=svg_build_prop($pr['transform']);
if(isset($pr['fill']))$pr['fill']=svg_clr($pr['fill']);
if(isset($pr['stroke']))$pr['stroke']=svg_clr($pr['stroke']);
if(isset($pr['onclick']) && $b=='lj'){$pr['onclick']=sj($pr['onclick']); $b='a';}
if(@$pr['fillurl']){$pr['fill']='url(#'.$pr['fillurl'].')';$pr['fillurl']='';}
if(@$pr['filter'])$pr['filter']='url(#'.$pr['filter'].')';
if($b=='feColorMatrix')$pr['values']=svg_build_prop($pr['values']);
if($b=='stop')$pr['style']='stop-color:'.svg_clr($pr['style']).'; stop-opacity:'.$pr['opac'].';';
//echo $b.br(); pr($pr);
if($b!='attr')return balise($b,$pr,$v);}
//

function svg_com($d){if(!function_exists('correct_txt'))req('tri'); 
$d=deln($d); $d=str_replace("&nbsp;",' ',$d);//eco($d,1);
return correct_txt($d,'','svg');}

function svgc_ex(){return '
[red,black,1:attr]
[10,10,30,20:rect]
[300,220,200:circle]
[100,100,40,80:line]
[100,100,40,80:ellipse]
[200/10-250/190-160/210:polygon]
[20/20-40/20-60/60-20/40-20/20:polyline]
[,,popup_plup___svg§[20,20§hello:text]:lj]
[rand,red,2:attr][M150 0 L75 200 L225 200 Z:path]
[purple,,,,,,rotate(330-40/20):attr][10,20§hello:text]
[blue:attr][280,140,http://philum.net§[80,20,,1§hello:text]:a]
[20,20§[20,20§hello1:tspan][green:attr][20,40§hello2:tspan]:text]
[§[f1,0,0§[SourceGraphic,15:feGaussianBlur]:filter]:defs][rand,,,,0.4:attr][300,200,200,1:circle]

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
';}

function svg_j($p,$o,$res=''){list($p,$o)=ajxp($res,$p,$o);
$ret=svg_com($p); //eco($ret,1);
if(!$o)$o='600/440'; list($w,$h)=split('/',$o);
$pr=array('version'=>'1.1','width'=>$w,'height'=>$h);
return balise('svg',$pr,$ret);}

//plugin('svg',$p,$o)
function plug_svg($p,$o){$rid='plg'.randid();
$j=$rid.'_plug__2_svg_svg*j_'.ajx($p).'_'.$o.'_inp';
if(!$p)$p=svgc_ex();
$ret.=txarea('inp',$p,74,10).' ';
$ret.=lj('',$j,picto('reload')).' ';
return $ret.divd($rid,svg_j($p,$o));}

?>