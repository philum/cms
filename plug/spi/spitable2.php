<?php
//philum_plugin_spitable2

function spitable2_js($j,$n=1){
if(!$j)$j='spitable2_plug__2_spitable2_spitable2*j';
return 'var n='.($n?$n:1).';
addEvent(document,"DOMMouseScroll",function(){wheelcount(event,"'.$j.'")});';}

function spitable2_infos($d){
$r=msql::row('','public_atomic',$d);
if($r[0])return on2cols($r,470,5);
else return btn('txtx','Element '.$d);}

function spitable2_ring_b($rg){
if($rg==1)return [1=>44,2=>45];
elseif($rg==2)return [1=>35,2=>34,3=>43,4=>54,5=>55,6=>46];
elseif($rg==3)return [1=>36,2=>25,3=>24,4=>33,5=>42,6=>53,7=>64,8=>65,9=>56,10=>47];
elseif($rg==4)return [1=>37,2=>26,3=>15,4=>14,5=>23,6=>32,7=>41,8=>52,9=>63,10=>74,11=>75,12=>66,13=>57,14=>48];
elseif($rg==5)return [1=>38,2=>27,3=>16,4=>'05',5=>'04',6=>13,7=>22,8=>31,9=>40,10=>51,11=>62,12=>73,13=>84,14=>85,15=>76,16=>67,17=>58,18=>49];}

function spitable2_clr(){return [''=>'ccc','Nonmetals'=>'5FA92E','Nobles Gasses'=>'00D0F9','Alkali Metals'=>'FF0008','Alkali Earth Metals'=>'FF00FF','Metalloids'=>'1672B1','Halogens'=>'F6E617','Metals'=>'999999','Transactinides'=>'FF9900','Lanthanides'=>'666698','Actinides'=>'9D6568','undefined'=>'ffffff'];}

function spitable2_atom($r,$n,$max){
if(!$r)$r=[1=>'-',11=>$n]; $clr=spitable2_clr();//color:#'.invert_color($clr[$r[2]],1).';
$sty='padding:2px; background-color:#'.$clr[$r[2]].'; border:1px solid black;';
if($r[11]>$max)$sty.=' opacity:0.4;';
//$nb=divs('text-align:right',lj('','spitable2_plug___spitable2_spitable2*build_'.$r[11],$r[11]));
$bt=lj('','spitable2_plug__2_spitable2_spitable2*build_'.$n,$r[11]);
$tit=att($r[0].' ('.$r[11].')');
$ret=lj('','popup_plup___spitable2_spitable2*infos_'.$r[11],$r[1],$tit);
return divs($sty,$bt.br().$ret);
//return divs($sty,$r[11].br().lkc('','https://fr.wikipedia.org/wiki/'.$r[0],$r[1]));
//return divs($sty,$r[11].br().'[[https://fr.wikipedia.org/wiki/'.urlencode($r[0]).' '.$r[1].']]');
}

function nextsubrg($rb,$rg,$subrg){
if($subrg==1){
	for($i=1;$i<9;$i++){$ri=val($rb,$i,0);
		if($ri<$i){$rg=$i;
			$subrg=$ri+1;
			return [$rg,$subrg];}}}
else{return [$rg+1,$subrg-1];}}

function subring($r,$ra,$rb,$rg,$subrg,$n,$max){//echo $rg.':'.$subrg.'_';
$rc=spitable2_ring_b($subrg);
if($rc)foreach($rc as $k=>$v){$n++;
if($n<=220){
	list($x,$y)=split_r($v,1); $x+=1; //$y+=1;
	//if($rg>3){$x+=12; $y+=(($rg-4)*8);} else //2_rows
	$y+=(($rg-1)*10);//matrice_width
	$ra[$x][$y]=spitable2_atom($r[$n],$n,$max);}}
$rb[$rg]=$subrg;
if($n<$max){
	list($rg,$subrg)=nextsubrg($rb,$rg,$subrg);
	list($ra,$n)=subring($r,$ra,$rb,$rg,$subrg,$n,$max);}
return [$ra,$n];}

function spitable2_fams(){
$r=spitable2_clr(); $ret='';
foreach($r as $k=>$v){
	$sty='" style="padding:2px 4px; background-color:#'.$v.'; border:1px solid #000; display:inline-block; color:'.invert_color($v,1).'';
	if($k)$ret.=btn($sty,$k).' ';}
return $ret;}

function spitable2_levels($d){$ret='';
$r=[2,4,10,12,18,20,30,36,38,48,54,56,70,80,86,88,102,112,118];
foreach($r as $k=>$v){$c=$v<$d?'active':'';
	$ret.=lj($c,'spitable2_plug__2_spitable2_spitable2*j_'.$v,btn('',$v)).' ';}
return $ret;}

function spitable2_menu($d){
$j='spitable2_plug__2_spitable2_spitable2*j___spitable2x';
$ret=inputj('spitable2x',$d,$j);
$ret.=lj('txtbox',$j,picto('ok')).' ';
if($d>1)$ret.=lj('txtbox','spitable2_plug__2_spitable2_spitable2*j_'.($d-1),picto('before')).' ';
$ret.=lj('txtbox','spitable2_plug__2_spitable2_spitable2*j_'.($d+1),picto('after'));
return divc('nbp',spitable2_levels($d).br().$ret).br();}

function spitable2_build($d){$d=$d?$d:118;
$r=msql::read('','public_atomic','');
list($ra,$n)=subring($r,[],[],1,1,0,$d); //pr($ra);
return spitable2_menu($d).mktable_empty($ra);}//divs('overflow-y:auto;',)

function spitable2_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
return spitable2_build($p);}

function mktable_empty($r){//p($r);
$n=max(array_keys($r)); ksort($r); $tr='';
for($i=1;$i<=$n;$i++){$td='';
	if(val($r,$i)){$nb=max(array_keys($r[$i])); $td=''; ksort($r[$i]); 
	for($o=1;$o<=$nb;$o++)$td.=balc('td','',valr($r,$i,$o));
	$tr.=balc('tr','',$td);}}
return balc('table','',$tr);}

function plug_spitable2($p){$p=$p?$p:118;
Head::add('csscode','td{margin:0; padding:1px;}');
Head::add('jscode',spitable2_js('spitable2_plug__2_spitable2_spitable2*j',$p));
$pub=msqbt('','public_atomic','');
$ret=spitable2_build($p);
return divd('spitable2',$ret).br().spitable2_fams().br().$pub;}

?>