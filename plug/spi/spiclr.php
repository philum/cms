<?php
//philum_app_spiclr

class spiclr{

static function infos($d){
$r=msql::row('','public_atomic',$d);
if($r[0])return on2cols($r,470,5);
else return btn('txtx','Element '.$d);}

static function mkclr($val){
$d=dechex(255-round($val));
return 'ff'.$d.$d;}

static function colors(){
if(!$col)return array(''=>'ccc','Nonmetals'=>"92FF10",'Nobles Gasses'=>"05FFFF",'Alkali Metals'=>"FF9801",'Alkali Earth Metals'=>"BF6700",'Metalloids'=>"91C9D6",'Halogens'=>"FFFF00",'Metals'=>"ABABB0",'Transactinides'=>"C9C97A",'Lanthanides'=>"B3D7AB",'Actinides'=>"75ADAB",'undefined'=>"ffffff");}

static function clr($r,$col){
if(!$col)return self::colors();
else $ra=array_keys_r($r,$col);
unset($ra['N/A']); unset($ra['_menus_']);
$ra=array_flip($ra); //unset($ra['']);
$ra=array_flip($ra);
$min=0; $diff=0; $rb=[];
foreach($ra as $k=>$v)
//if(strpos($v,'@')===false && strpos($v,'�')===false){if(intval($v)<$min)$min=$v;}
$ra[$k]=str_replace(',','.',$v);
//if(!$min)
$min=min($ra); $max=max($ra);
if($min)$diff=$max-$min; 
if($diff)$ratio=255/$diff; //pr($ra);
foreach($ra as $k=>$v)if(strpos($v,'@')===false && strpos($v,'�')===false){	
	//echo $k.':'.$v.'_'.$min.br();
	if($ratio)$rb[$k]=self::mkclr(($v-$min)*$ratio);} //pr($rb);
return $rb;}

/*static function fams(){$r=self::colors();
foreach($r as $k=>$v)if($k)$ret.=bts('font-size:12px; padding:2px 4px; background-color:#'.$v.'; border:1px solid #000; display:inline-block; color:'.invert_color($v,1),$k).' ';
return $ret;}*/

static function levels($d){$ret='';
$r=array(2,4,10,12,18,20,30,36,38,48,54,56,70,80,86,88,102,112,118);
foreach($r as $k=>$v){$c=$v<=$d?'active':'';
	$ret.=lj($c,'spiclr_app__2_spiclr_table_'.$v,btn('',$v)).' ';}
return $ret;}

static function menu($d){$d=$d?$d:118;
$ret=input1('spiclrx',$d,'','','1').' ';
$ret.=lj('txtbox','spiclr_app__2_spiclr_call___spiclrx','ok').' ';
if($d>1)$ret.=lj('txtbox','spiclr_app__2_spiclr_call_'.($d-1),picto('before')).' ';
$ret.=lj('txtbox','spiclr_app__2_spiclr_call_'.($d+1),picto('after')).' ';
$ret.=hlpbt('spitable');
$ret.=msqbt('','public_atomic','').br();
$ret.=self::levels($d);
return divc('nbp',$ret).br();}

static function atom($r,$n,$clr,$o,$ob){
$sty='display:inline-block; width:60px; padding:2px; background-color:#'.$clr.'; border:1px solid grey; font-size:12px;'; if($o)$sty.=' opacity:0.4;'; if($ob)$sty.=' border-color:red;';
$ret=lj('','spiclr_app___spiclr_call_'.$n,$n).' :: ';
$ret.=lj('" title="'.$r[0].'-'.$r[9],'popup_plup___spiclr_spiclr*infos_'.$n,$r[1]);
return divs($sty,$ret);}

//build
static function nextsubrg($rb,$rg,$subrg){
if($subrg==1){
	for($i=1;$i<9;$i++){$ri=val($rb,$i,0);
		if($ri<$i){$rg=$i;
			$subrg=$ri+1;
			return array($rg,$subrg);}}}
else{return array($rg+1,$subrg-1);}}

static function subring($r,$ra,$rb,$rg,$subrg,$n,$max,$rp){
$rs=array(1=>2,6,10,14,18,22); $rsn=$rs[$subrg];
$rga=array(2=>2,8,18,32,48,64);
$fill=val($rp,$rg-1); $npos=val($rga,$subrg);//npos=ring limit, begin count at
$clr=self::clr($r,9);//6,8,9,10,11
if($rsn)for($i=1;$i<=$rsn;$i++){$n++; $npos++;
	if($n<=220){$o=0; $ob=0; if($n==$max)$ob=1;
		if($max>118)$o=$n>$max?1:0; elseif($npos>$fill)$o=1;
		$d=self::atom(val($r,$n),$n,val($clr,$n),$o,$ob);
		if(isset($ra[$rg][$subrg]))$ra[$rg][$subrg].=$d; else $ra[$rg][$subrg]=$d;}}
$rb[$rg]=$subrg;
if($n<($max>118?$max:118)){
	list($rg,$subrg)=self::nextsubrg($rb,$rg,$subrg);
	list($ra,$n)=self::subring($r,$ra,$rb,$rg,$subrg,$n,$max,$rp);}
return array($ra,$n);}

static function table($d){
$ret=self::menu($d);
$r=msql::read('','public_atomic','');
$rp=explode('-',$r[$d][3]);
$rgnm=array(1=>'k','l','m','n','o','p','q','r','s');
//$rsnm=array(1=>'s','p','d','f','5','6','7');
list($ra,$n)=self::subring($r,[],[],1,1,0,$d,$rp);
foreach($ra as $k=>$v){$ret.=divs('margin:10px;',implode(br(),$v));}//$rgnm[$k].
return $ret;}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=spiclr::table($p,$o);
return $ret;}

}

function plug_spiclr($d){if(!$d)$d=118;
$ret=spiclr::table($d);
$pub=divc('small','SpiTable-Davy@2016');
return divd('spiclr',$ret).br().$pub;}

?>