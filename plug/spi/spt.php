<?php
//philum_plugin_spt

class spt{

static function css(){$ret='';
for($i=1;$i<118;$i++)$ret.='#id'.$i.':hover{background:rgba(255,255,255,0.4);}'."\n";
return $ret;}

static function clr(){return array(''=>'ccc','Nonmetals'=>"92FF10",'Nobles Gasses'=>"05FFFF",'Alkali Metals'=>"FF9801",'Alkali Earth Metals'=>"BF6700",'Metalloids'=>"91C9D6",'Halogens'=>"FFFF00",'Metals'=>"ABABB0",'Transactinides'=>"C9C97A",'Lanthanides'=>"B3D7AB",'Actinides'=>"75ADAB",'undefined'=>"ffffff");}

}

function spt_build($p,$o){
$r=msql::row('',nod('umnum'),$p,1);
return tabler($r);}

function spt_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=spt_build($p,$o);
return $ret;}

function spt_menu($p,$o,$rid){
$ret=hlpbt('spitable');//'spisvg','spi2'
$r=['spisvg2'=>'angular','spiline2'=>'linear','spiatom'=>'electrons','spimol'=>'molecules','spi3d'=>'3d','spiclr'=>'mass','spianomalies'=>'anomalies','spialgo'=>'algo'];//,'spitable'=>'tabular','spigrow'=>'electronic fills','spiangle'=>'angular','spielec'=>'transversal','spitablesvg'=>'circular'
foreach($r as $k=>$v)$ret.=lj('',$rid.'_plug___'.$k.'_____injectjs',$v).' ';
return divc('nbp',$ret);}

function plug_spt($p,$o){$rid=randid('plg');
$bt=spt_menu($p,$o,$rid);
//$ret=spt_build($p,$o);
//$bt.=msqbt('',nod('spt'));
return $bt.divd($rid,$ret);}

?>