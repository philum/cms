<?php
//philum_plugin_csswidth
#type array

function csswidth_sav($p='',$o='',$res=''){list($p,$o)=ajxr($res);
return $ret;}

//ready to apply
/*function obtain_set_width($defs,$div,$attr){
$m_large_x=obtain_values($defs,array($div),$attr,";");
	list($h,$d,$b,$g)=obtain_set($m_large_x); 
	if(!$d && !$b && !$g)$ret=$h*2; elseif($g===false)$ret=$d*2; else $ret=$d+$g;
return $ret;}*/

function obtain_widths($defs){//see informe_config_widths
$left=obtain_values($defs,array("#leftbar"),"width:",";");
$right=obtain_values($defs,array("#rightbar"),"width:",";");
$page=obtain_values($defs,array("#page"),"width:",";");
$cr+=obtain_css_widths($defs,array("#page"),"padding:");
$cr+=obtain_css_widths($defs,array("#content"),"margin:");
$cr+=obtain_css_widths($defs,array("#content"),"padding:");//is inside
$l_large=str_replace('px','',$left);
$r_large=str_replace('px','',$right);
$t_large=str_replace('px','',$page);
$m_large=$t_large-($l_large+$r_large+$cr);
return array($l_large,$m_large,$r_large,$t_large);}

function f_inp_widths($defs){$set='text" size="3';
list($l_large,$m_large,$r_large,$t_large)=obtain_widths($defs);
	$t.=btn("txtnoir",'leftbar '.input2($set,'l_large',$l_large,"")).' ';
	$t.=btn("txtnoir",'content '.$m_large.'px').' ';
	$t.=btn("txtnoir",'rightbar '.input2($set,'r_large',$r_large,"")).' ';
	$t.=btn("txtnoir",'page '.input2($set,'t_total',$t_large,"")).' ';
	$t.=input2('submit','save',"apply_widths","").' ';
	$t.=checkbox('saveblocks','ok','apply (mods_'.prmb(1).')',0).' ';
	$t.=hlpbt('designwidths').br();
$inp=$t.br();
return form('/?admin=css',$inp);}

function inform_blocks($p){
$r=explode(" ",$_SESSION['prma']['blocks']);
foreach($r as $k=>$v){
	if($v=="leftbar" && ($p=="lr" or $p=="l"))$rt[]=$v;
	elseif($v=="rightbar" && ($p=="lr" or $p=="r"))$rt[]=$v;
	else $rt[]=str_replace(array('leftbar','rightbar'),'',$v);}
$ret=implode(' ',$rt);
if(strpos($ret,'leftbar')!==false && $p=="r")$ret=str_replace('leftbar ','',$ret);
if(strpos($ret,'rightbar')!==false && $p=="l")$ret=str_replace('rightbar ','',$ret);
if(strpos($ret,'leftbar')===false && ($p=="lr" or $p=="l"))$ret=str_replace('menu','menu leftbar',$ret);
if(strpos($ret,'rightbar')===false && ($p=="lr" or $p=="r"))$ret=str_replace('content','rightbar content',$ret);
return $ret;}

function informe_config_widths($defs,$lw,$mw,$rw,$tw){//inner_values!=css_values
if($lw && $rw) $rblc="lr"; elseif($lw) $rblc="l"; elseif($rw) $rblc="r";
//$cr=obtain_css_widths($defs,array("#content"),"margin:");//see obtain_widths
//$cr+=obtain_css_widths($defs,array("#content"),"padding:");
$cr+=obtain_css_widths($defs,array('',".justy"),"padding:");
$cr+=obtain_css_widths($defs,array('',".justy"),"margin:");
if(strpos($_SESSION['prma']['blocks'],'leftbar')){
$cr2=obtain_css_widths($defs,array("#leftbar"),"padding:");
$cr2+=obtain_css_widths($defs,array("#leftbar"),"margin:");}
if(strpos($_SESSION['prma']['blocks'],'rightbar')){
$cr3=obtain_css_widths($defs,array("#rightbar"),"padding:");
$cr3+=obtain_css_widths($defs,array("#rightbar"),"margin:");}
$cr=obtain_css_widths($defs,array('',".panel"),"padding:");
	if($lw)$lw-=$cr+$cr2; if($rw)$rw-=$cr+$cr3;
$cr4=obtain_css_widths($defs,array("#banner"),"padding:");
$cr4+=obtain_css_widths($defs,array("#banner"),"margin:");
$nod=$_SESSION['modsnod']; $cnd=$_SESSION['cond']; $cndb=$cnd[0].$cnd[1];
$r=define_mods_cond_b('system');
foreach($r as $k=>$v){$presence[$v[0]]=1;}
if(!$presence['leftbar'] && $lw)$r[]=array('leftbar',$lw,'',$cndb,'','','','');
if(!$presence['rightbar'] && $rw)$r[]=array('rightbar',$rw,'',$cndb,'','','',''); 
foreach($r as $k=>$v){
	if($_SESSION['cr_mod']){
		if($_SESSION['cr_mob'] && $cndb!=$v[3])$v[3]=$cndb;
		elseif($cnd[0]!=$v[3]){$v[3]=$cnd[0]; $k='push';}}
	if($v[0]=='content' && $mw)$val=$mw-cr;
	elseif($v[0]=='banner')$val=$mw-$cr4;
	elseif($v[0]=='leftbar')$val=$lw;
	elseif($v[0]=='rightbar')$val=$rw;
	elseif($v[0]=='blocks' && $_SESSION['prma']['blocks'])$val=inform_blocks($rblc);
	elseif($v[0]=='design')$val=$_SESSION['desgn'];
	else $val=false;
	if($val!==false){$v[1]=$val; $_SESSION['prma'][$v[0]]=$val;
	if($k=='push')$_SESSION['mods']['system'][]=$v; else $_SESSION['mods']['system'][$k]=$v;
	array_unshift($v,'system');
	if($_POST["saveblocks"]=="ok" or $_GET["apply"])modif_vars('users',$nod,$v,$k);}}}

function obtain_m_width_onfly($defs,$lw,$tw,$rw){
$cr=obtain_css_widths($defs,array("#content"),"margin:");
$cr+=obtain_css_widths($defs,array("#content"),"padding:");
if(strpos($_SESSION['prma']['blocks'],'leftbar'))
$cr+=obtain_css_widths($defs,array("#leftbar"),"margin:");
if(strpos($_SESSION['prma']['blocks'],'rightbar'))
$cr+=obtain_css_widths($defs,array("#rightbar"),"margin:");
return $tw-($lw+$rw+$cr);}

function modif_values($defs,$css,$newval,$vl,$vb){
$k=find_value($defs,$css); $val=$defs[$k][6];
$old=embed_detect($val,$vl,$vb,"");
$defs[$k][6]=str_replace($vl.$old.$vb,$vl.$newval.$vb,$val);
return $defs;}

function defs_widths($defs,$lw,$tw,$rw){
$mnu_dives=array("#leftbar","#page","#rightbar");
$mnu_large=array($lw,$tw?$tw.'px':'auto',$rw);
foreach($mnu_dives as $i=>$v){if($mnu_large[$i])
	$defs=modif_values($defs,array($v),$mnu_large[$i],"width:",";");}
$defs=modif_values($defs,array("#content"),$lw,"left:","px");
$defs=modif_values($defs,array("#content"),$rw,"right:","px");
	$m_large=obtain_m_width_onfly($defs,$lw,$tw,$rw);
	//$defs=modif_values($defs,array("#content"),($m_large?$m_large.'px':'auto'),"width:",";");
informe_config_widths($defs,$lw,$m_large,$rw,$tw);
return $defs;}

function defs_csswidths($defs){
return defs_widths($defs,$_POST["l_large"],$_POST["t_total"],$_POST["r_large"]);}

function plug_csswidth($p,$o){return $p;}

?>