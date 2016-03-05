<?php
//philum_plugin_shop (not tested)

function affiche_prod($v,$id){
if(!is_numeric($v))$v=id_of_suj($v);
list($day,$frm,$suj,$img,$nod,$thm,$lu,$re)=pecho_arts($v);
$p["suj"]=$suj; $p["img"]=first_img($img); 
$p["thumb"]=make_thumb(first_img($img),"no");
$p["id"]=$v; $p["sty"]="panel";
$chsup=explode(" ",$_SESSION['prmb'][18]);
foreach($chsup as $cat){
	$va=sql('msg','qdd','v','ib="'.$v.'" AND val="'.$cat.'"');
	$ct=$cat=='prix'?'price':$cat;
	if($va) $p[$ct]=$cat.': '.trim($va);}
$p["add2cart"]=ljb("txtbox","SaveJ",'cart_shop___'.$v,"add");
return template($p,'products');}

function products($r,$id){
foreach($r as $k=>$v){$ret.=affiche_prod($k,$id);}
return divd('shopplace',$ret).divc("clear","");}

//product
function product($ref,$id){
if(strpos($ref,",")!==false){
	$r=array_flip(explode(",",$ref));
	$ret=products($r,$id);}
else $ret=affiche_prod($ref,$id);
return $ret;}

//shopping
function shopping($d,$id){
if(!is_numeric($d))$d=id_of_suj($d);
if($d)$r=sql('id','qda','k','nod="'.$_SESSION['qb'].'" AND ib="'.$d.'"');
if($r)return products($r,$id);}

function plug_shop($a,$p,$o){
if($a=='prod')return product($p,$o);
if($a=='shop')return shopping($p,$o);}

?>