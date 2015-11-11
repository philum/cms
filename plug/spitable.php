<?php
//philum_plugin_spitable
session_start();
error_reporting(6135);
if(!function_exists('p'))require('../progb/lib.php');

function spi_infos($d){
$r=msql_read('','public_atomic',$d);
if($r['Nom'])return on2cols($r,470,5);
else return btn('txtx','Element '.$d);}

function spi_ring_b($rg){
if($rg==1)return array(1=>44,2=>45);
elseif($rg==2)return array(1=>35,2=>34,3=>43,4=>54,5=>55,6=>46);
elseif($rg==3)return array(1=>36,2=>25,3=>24,4=>33,5=>42,6=>53,7=>64,8=>65,9=>56,10=>47);
elseif($rg==4)return array(1=>37,2=>26,3=>15,4=>14,5=>23,6=>32,7=>41,8=>52,9=>63,10=>74,11=>75,12=>66,13=>57,14=>48);
elseif($rg==5)return array(1=>38,2=>27,3=>16,4=>'05',5=>'04',6=>13,7=>22,8=>31,9=>40,10=>51,11=>62,12=>73,13=>84,14=>85,15=>76,16=>67,17=>58,18=>49);}

function spi_classes(){return array(''=>'ccc','Nonmetals'=>"5FA92E",'Nobles Gasses'=>"00D0F9",'Alkali Metals'=>"FF0008",'Alkali Earth Metals'=>"FF00FF",'Metalloids'=>"1672B1",'Halogens'=>"F6E617",'Metals'=>"999999",'Transactinides'=>"FF9900",'Lanthanides'=>"666698",'Actinides'=>"9D6568",'undefined'=>"ffffff");}

function spi_atom($r,$n,$max){
if(!$r)$r=array(1=>'-',11=>$n); $clr=spi_classes();//color:#'.invert_color($clr[$r[2]],1).';
$sty='padding:2px; background-color:#'.$clr[$r[2]].'; border:1px solid #000;';
if($r[11]>$max)$sty.=' opacity:0.4;';
//$nb=divs('text-align:right',lj('','spi_plug___spitable_spi*table_'.$r[11],$r[11]));
return lj('" title="'.$r[0].' ('.$r[11].')','popup_plup___spitable_spi*infos_'.$r[11],divs($sty,$r[11].br().$r[1]));}

function nextsubrg($rb,$rg,$subrg){
if($subrg==1){
	for($i=1;$i<9;$i++){
		if($rb[$i]<$i){$rg=$i;
			$subrg=$rb[$i]+1;
			return array($rg,$subrg);}}}
else{return array($rg+1,$subrg-1);}}

function subring($r,$ra,$rb,$rg,$subrg,$n,$max){//echo $rg.':'.$subrg.'_';
$rc=spi_ring_b($subrg);
if($rc)foreach($rc as $k=>$v){$n++;
if($n<=220){
	list($x,$y)=split_r($v,1); $x+=1; //$y+=1;
	//if($rg>3){$x+=12; $y+=(($rg-4)*8);} else //2_rows
	$y+=(($rg-1)*10);//matrice_width
	$ra[$x][$y]=spi_atom($r[$n],$n,$max);}}
$rb[$rg]=$subrg;
if($n<$max){
	list($rg,$subrg)=nextsubrg($rb,$rg,$subrg);
	list($ra,$n)=subring($r,$ra,$rb,$rg,$subrg,$n,$max);}
return array($ra,$n);}

function spi_fams(){$r=spi_classes();
foreach($r as $k=>$v){
	$sty='txtsmall" style="padding:2px 4px; background-color:#'.$v.'; border:1px solid #000; display:inline-block; color:'.invert_color($v,1).'';
	if($k)$ret.=btn($sty,$k).' ';}
return $ret;}

function spi_levels($d){$r=array(2,4,10,12,18,20,30,36,38,48,54,56,70,80,86,88,102,112,118);
foreach($r as $k=>$v){$c=$v<$d?'active':'';
	$ret.=lj($c,'spi_plug__2_spitable_spi*table_'.$v,btn($sty,$v)).' ';}
return $ret;}

function spi_menu($d){$d=$d?$d:118;
if($d>1)$ret=lj('txtbox','spi_plug__2_spitable_spi*table_'.($d-1),picto('left')).' ';
$ret.=input(1,'spix',$d,'','','1').' ';
$ret.=lj('txtbox','spi_plug__2_spitable_spi*table_'.($d+1),picto('right')).' ';
$ret.=lj('txtbox','spi_plug__2_spitable_spi*table___spix','set');
return divc('nbp',spi_levels($d).' '.$ret).br();}

function spi_table($d){$d=$d?$d:118;
$r=msql_read('','public_atomic','');
list($ra,$n)=subring($r,$ra,$rb,1,1,$n,$d); //pr($ra);
return spi_menu($d).mktable_empty($ra);}//divs('overflow-y:auto;',)

function mktable_empty($r){//p($r);
$n=max(array_keys($r)); ksort($r); 
for($i=1;$i<=$n;$i++){
	if(is_array($r[$i])){$nb=max(array_keys($r[$i])); $td=''; ksort($r[$i]); 
	for($o=1;$o<=$nb;$o++)$td.=balc('td','',$r[$i][$o]);
	$tr.=balc('tr','',$td);}}
return balc("table",'',$tr);}

function plug_spitable($d){
//echo js_code('document.onkeydown="if(event.keyCode == 39);');
$pub=msqlink('','public_atomic','');
$ret=spi_table($d);
return divd('spi',$ret).br().spi_fams().br().$pub;}

?>