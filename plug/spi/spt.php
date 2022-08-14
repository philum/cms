<?php //spt
class spt{

static function css(){$ret='';
for($i=1;$i<118;$i++)$ret.='#id'.$i.':hover{background:rgba(255,255,255,0.4);}'."\n";
return $ret;}

static function clr(){return [''=>'ccc','Nonmetals'=>"92FF10",'Nobles Gasses'=>"05FFFF",'Alkali Metals'=>"FF9801",'Alkali Earth Metals'=>"BF6700",'Metalloids'=>"91C9D6",'Halogens'=>"FFFF00",'Metals'=>"ABABB0",'Transactinides'=>"C9C97A",'Lanthanides'=>"B3D7AB",'Actinides'=>"75ADAB",'undefined'=>"ffffff"];}

static function build($p,$o){
$r=msql::row('',nod('umnum'),$p,1);
return tabler($r);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$ret=hlpbt('spitable');//'spisvg','spi2'
$r=['spisvg'=>'angular','spiline'=>'linear','spitable'=>'tabular','spiatom'=>'electrons','spimol'=>'molecules','spi3d'=>'3d','spiclr'=>'mass','spianomalies'=>'anomalies','spialgo'=>'algo'];//,'spigrow'=>'electronic fills','spiangle'=>'angular','spielec'=>'transversal','spitablesvg'=>'circular'
foreach($r as $k=>$v)$ret.=lj('',$rid.'_'.$k.',home__js',$v).' ';
return divc('nbp',$ret);}

static function home($p,$o){
$rid=randid('plg'); $ret='';
$bt=self::menu($p,$o,$rid);
//$ret=self::build($p,$o);
//$bt.=msqbt('',nod('spt'));
return $bt.divd($rid,$ret);}

}
?>