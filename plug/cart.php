<?php
//philum_plugin_cart (for shop)

function qtes($k,$v){
	if($_GET["l"]==$k){$v=$_GET["n"];$_SESSION['cart'][$k]=$v;}
	if($_GET["l"]==$k){$v=$_GET["n"];$_SESSION['cart'][$k]=$v;}
	$ret=$v.br().lkc("txtsmall",'/?plug=cart&l='.$k.'&n='.($v+1).'',"+");
	$ret.='|'.lkc("txtsmall",'/?plug=cart&l='.$k.'&n='.($v-1).'',"-");
return $ret;}

function prod_from_art($id){
$chsup=$_SESSION['prmb'][18];
	if(strpos($chsup,'price')!==false)$ch='price';
	elseif(strpos($chsup,'prix')!==false)$ch='prix';
if($ch)$prx=sql('msg','qdd','v','ib="'.$id.'" AND val="'.$ch.'"');
	if(strpos($chsup,'ref'!==false)){$ch='ref';
$ref=sql('msg','qdd','v','ib="'.$id.'" AND val="'.$ch.'"');}
	if(strpos($chsup,'stock'!==false)){$ch='stock';
$stock=sql('msg','qdd','v','ib="'.$id.'" AND val="'.$ch.'"');}
return array($prx,$ref,$stock);}

function plug_cart(){
if($_GET["del"])unset($_SESSION['cart'][$_GET["del"]]);
$ar[]=array("","r�f","titre","prix","qt�","sub_total","x");//"ancien prix","remise",
if($_SESSION['cart']){
foreach($_SESSION['cart'] as $k=>$v){
	$save.=$k.'='.$v.';'."\r";
	list($day,$frm,$tit,$amg,$nod,$tag,$lu,$re,$host,$mail,$ib)=pecho_arts($k);
	list($prx,$ref,$stock)=prod_from_art($k);//,$reduc,$descript
	$tit=lkc("txtcadr",good_url($k,'read'),$tit).''.br();
	$img=minimg($amg,1).br();
	//if($reduc){$oldprice=$prix;$prx=round($prix*($reduc/100));}
	//else{$oldprice="";$prx=$prix;}//prix
	$qte=qtes($k,$v);
	$erz=lkc('','?plug=cart&del='.$k,'x');
	$ar[]=array($img,$ref,$tit,$prx,$qte,($prx*$qte),$erz);//$oldprice,$reduc,
	$total+=$prx*$qte;}
$_SESSION["prixtotal"]=$total;
$ar[]=array("","","","","total",$total);//"","",
$tb=make_table($ar,'txtred','');
//$tb=str_replace("table",'table width="100%"',$tb);
$tb=str_replace("td",'td class="txtblc" align="center"',$tb);
//$_SESSION["commande"]=$tb;
$ret=$tb.br();
$ret.=ljb('txtbox','jumpval','ref5_command::'.$save,$_SESSION['nms'][27]).br().br();
$ret.=nl2br(make_form_fromstring('::Name=input::Adress=input::city=input::Email=input::Message=text',''));
}//enf_if_cart
else $ret=btn("txtred","empty_cart");
return $ret;}

?>