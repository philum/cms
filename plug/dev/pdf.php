<?php //pdf

function make_list_arts($v){
$der=explode("~",$v);
foreach($der as $va){
[$vaa,$vab]=explode("=",$va);
switch($vaa){
	case("dya"):if($vab)$wh.='AND day < "'.($vab).'" '; break;
	case("dyb"):if($vab)$wh.='AND day > "'.($vab).'" '; break;
	case("cat"):if($vab)$wh.='AND frm="'.$vab.'" '; break;
	case("nocat"):if($vab)$wh.='AND frm!="'.$vab.'" '; break;
	case("tag"):if($vab)$wh.='AND thm LIKE "%'.$vab.'%" ';  break;
	case("notag"):if($vab)$notag[$vab]=true; break;
	case("order"):if($vab)$ord=$vab; break;}}
$ordr='day '.($ord?$ord:"DESC");
$sql='WHERE nod="'.$_SESSION['qb'].'" AND frm!="_system" AND re=1 '.$wh.' ORDER BY '.$ordr.' '.$whb;
$rq=sqr('id,frm,thm','qda',$sql);
if($rq){while($data=mysqli_fetch_array($rq)){$stop=false;
	$tags=explode(",",$data["thm"]); $id=$data["id"];
	if($tags) foreach($tags as $vb){if($notag[trim($vb)]==true){$stop=true;}}
	if(!$stop)$ret[$id]=$prw;}
return $ret;}}

function arts_menus($dya,$dyb){$cs='txtblc';
$ret.=divc('txtcadr','build_pdf_book').br();
$dya=$dya?$dya:time(); $dyb=$dyb?$dyb:0;
$sq='WHERE nod="'.$_SESSION['qb'].'" and day<'.$dya.' and day>'.$dyb.' AND re="1"';
$rq=sqr('id,frm,thm,day','qda',$sq);
while($data=mysqli_fetch_array($rq)){
	$dt['cat'][ajx($data['frm'],'')]+=1;
	//$tags=explode(',',ajx($data['thm'],''));
	//foreach($tags as $k=>$v){$dt['tag'][ltrim($v)]+=1;}//tri_tags($r)
	if($data['day']<$mind)$mind=$data['day'];
	if($data['day']>$maxd)$maxd=$data['day'];}
$ret.='from '.input1('dyb',date('d/m/Y',$mind),'',$cs).' ';
$ret.='to '.input1('dya',date('d/m/Y',$maxd),'',$cs).br().br();
if($dt['cat'])$cts=implode('|',array_keys_b($dt['cat']));
//if($dt['tag'])$tgs=implode('|',array_keys_b($dt['tag']));
$ret.='cats: '.input1('cts','').' ';
$ret.=jump_btns('cts',$cts,',').br();
$ret.='no-cats: '.input1('nct','').' ';
$ret.=jump_btns('nct',$cts,',').br();
$ret.='tags: '.input1('tgs','').' ';
$ret.=jump_btns('tgs',$tgs,',').br();
$ret.='no-tags: '.input1('ntg','').' ';
$ret.=jump_btns('ntg',$tgs,',').br();
$ret.='order: '.input1('urd','').' ';
$ret.=jump_btns('ord','ASC|DESC','').br();
$ret.=ljb('txtbox','SaveJ','call_plug___pdf_build*call___dya|dyb|cts|nct|tgs|ntg|ord','call');
return $ret.br().br();}

function data_arts($r){
$wh=implode('" or id="',array_keys_b($r));//echo 
$rq=sqr('id,suj,day,frm,thm','qda','where id="'.$wh.'"');
while($data=mysqli_fetch_array($rq)){$ret[$data['id']]=array($data['suj'],date('ymd',$data['day']),$data['frm'],$data['thm']);} //p($ret);
return tabler($ret,'','');}

function little_split($v){$unkill=explode(",",$v);
	foreach($unkill as $su){$su=trim($su);
	if($su && $su!=" ")$ret[$su]+=$v;}
return $ret;}

function tri_tags($r){if(is_array($r)){foreach($r as $k=>$v){$rb=trimr($k);
foreach($rb as $ka=>$va)if($va)$ret[$va]+=$v;}} return $ret;}

function build_call(){//echo $_GET['nom'];
$r=['dya','dyb','cat','nocat','tag','notag','order'];
$cll=explode("~",$_SESSION['call']);
$get=explode("_",$_GET['nom']);
foreach($r as $k=>$v){if($k){
	$rb=tri_tags($r);
	if($get[$k])$cl[$v]=ajx($get[$k],1); //else $cl[$v]=$cll[$k];
	if($k==0 or $k==1)$cl[$v]=strtotime($cl[$v]);}}
foreach($cl as $k=>$v){$cal.=$k.'='.$v.'~';}
$_SESSION['call']=$cal;
$mart=make_list_arts($cal);
//p($mart);
$ids=implode('|',$mart);
$bpd=ljb('txtbox','SaveJ','call_plug___pdf_produce*pdf___'.$ids,'build');
return data_arts($mart).br().$bpd;
}

function produce_pdf(){
include("pdf/phpToPDF.php");
$PDF = new phpToPDF();

$PDF->AddPage();
$PDF->SetFont("Arial","B",16);
$PDF->Text(40,10,"Uniquement un texte");
$PDF->Output();
//$PDF->Output("test.pdf","F");

// affiche le document test.PDF dans une iframe.
/*echo '
	<iframe src="test.pdf" width="100%" height="100%">
	[Your browser does <em>not</em> support <code>iframe</code>,
	or has been configured not to display inline frames.
	You can access <a href="./test.PDF">the document</a>
	via a link though.]</iframe>
';*/
}
function plug_pdf($p,$o){
$_SESSION['call']='';
if(!$_GET['nom']){
	Head::add('csslink','../css/_admin.css');
	Head::add('jslink','../progb/ajx.js');
	$ret=Head::get();}
$ret.=arts_menus($dya,$dyb);
$ret.=divd('call','');
$ret.=divd('pdf','');
return $ret;}

?>