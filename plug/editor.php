<?php
//philum_transductor 
session_start();

//function lienjx($c,$p,$j,$t){return lkc($c,'javascript:'.atj($p,$j),$t);}
function txareacb($d,$c){
$ret.=btd('edtc" style="display:none;',txareac_btns());
$ret.=div(atb('contenteditable','false').atd('txtareb').atc($c).atb('onclick','editab(1)'),$d).br();
return $ret;}

function plug_editor($reset=''){secure_inputs();
if($_SESSION["dev"]=="dev" or $_SESSION["dev"]=="lab")$g="b";
req('pop,spe,art,tri');
header_add('csscode','.tabc{border:1px dotted grey;padding:10px;min-height:25px;width:550px;}');
header_add('jscode','
function SaveIcpb(){//convert
	var opt=document.getElementById("txtareb").innerHTML;
	document.getElementById("txt").value=opt;
	SaveJ("txtarea_convhtml_txtareb_4");
	toggle_tab(\'tab-1\',2);}
function editab(p){
	var act=document.getElementById("edt").className;
	if(act=="txtx" || p==1){var arr=[true,"on","txtred",""];}
	else{var arr=[false,"off","txtx","none"];}
	document.getElementById("txtareb").contentEditable=arr[0];
	document.getElementById("txtareb").designMode="arr[1]"; void 0;
	document.getElementById("txtareb").focus;
	document.getElementById("edt").className=arr[2];
	document.getElementById("edtc").style.display=arr[3];}
');
//header_add('rel',array('shortcut icon',uicon('copy_16','edit2','/')));

$out["head"].=div(atd('popup').ats('position:fixed;'),'');
$out["head"].=hidden('','socket','');

if($_GET['switch_defcon'])$_SESSION['rstr'][18]=$_SESSION['rstr'][18]==0?1:0;
$basedefs=$_SESSION['rstr'][18]==0?'public':$_SESSION['qb'];
if($reset=='reset_cache'){$_SESSION['vacuum']='';}

####

if($_GET["urlsrc"]){$urlsrc=$_GET["urlsrc"];
	$_GET["urlsrc"]=$urlsrc=strdeb($urlsrc,'?utm_source');
	$urlsrc=str_replace("$","?",$urlsrc);
	foreach($_GET as $k=>$v)if($k=="rssurl")$urlsrc=$v;
		elseif($k!='urlsrc')$urlsrc.='&'.$k.'='.$v;}
if($_POST["urlsrc"]){$urlsrc=$_POST["urlsrc"];// && $_POST["txt"]==""
	$_POST["urlsrc"]=$urlsrc=strdeb($urlsrc,'?utm_source');}
if($_POST["suj"])$title=$_POST["suj"];
if(strpos($urlsrc,"http")===false && $urlsrc)$urlsrc='http://'.$urlsrc;

if($urlsrc && $_POST["txt"]=="")
	list($title,$reb,$ret,$defid,$defs)=vacuum($urlsrc,"");
//echo txarea('',$ret,20,4);

####
//see h-number in html(mnu)
$tabnam='tbmdtab-1';
if($_POST["urlsrc"] or $_POST["txt"] or $_POST["txb"]){
	$_SESSION[$tabnam]='2'; $npb=$_SESSION['npnb'];}//current open_file
elseif($_POST["urlsrc"] && !$_POST["txt"])$_SESSION[$tabnam]='1';
//else $_SESSION[$tabnam]='0';//current_tab

if($_POST["txt"])$ret=stripslashes($_POST['txt']);//html
if($_POST["txb"])$reb=stripslashes($_POST['txb']);//conn
if($_POST["title"])$title=stripslashes($_POST['title']);
if($_POST["convent"])$ret=html_entity_decode($ret);
if($_POST["convutf"])$ret=utf8_decode($ret);
if($_POST["convurl"])$ret=urldecode($ret);
if($_POST["urlencode"])$ret=urlencode($ret);
if($_POST["ucfirst"])$reb=ucfirst(strtolower($reb));//strtoupper

if($ret && !$reb){
	//if(!strpos($ret,'<br />') && strpos($ret,"\r"))$ret=nl2br($ret);
	$reb=converthtml(($ret));//htmlentities //htmlspecialchars
	$reb=html_entity_decode_b($reb);
	$reb=html_entity_decode($reb);
	$reb=convertmail($reb);
	$reb=embed_links($reb);}
elseif(!$ret)$ret=format_txt(stripslashes($reb),0,"");//if(!$ret)
$ree=clean_br($ret);

#edit

//transformers
if($_POST['repla']){
if($_POST['rec_prg']){
$reb=ereg_replace(stripslashes($_POST['repla']),stripslashes($_POST['replb']),$reb);}
else{$reb=str_replace(stripslashes($_POST['repla']),stripslashes($_POST['replb']),$reb);}}
if($_POST['del_tab']){$reb=del_tables($reb);}
//if($_POST['conn_to_del']){$reb=correct_txt($reb,$_POST['conn_to_del'],'correct');
//	$reb=str_replace(array("¬","|"),"",$reb); $reb=clean_br($reb);}
if($_POST['del_n']=="ok"){$reb=del_n($reb);}
if($_POST['clean_mail']){$reb=convertmail($reb);}
if($_POST["clean_punct"]){$reb=clean_punct($reb);}
if($_POST["add_punct"]=="ok"){$reb=add_lines($reb);}
if($_POST['clean_br'] or $urlsrc){$reb=clean_br($reb);}

/*----------------------*///import

if($_SESSION["dev"])$dv=' '.btn('txtsmall',$_SESSION["dev"]);
$out['head'].=lkc("txtx","/plug/editor",picto('editxt',16).$dv).' ';//'&#8362;'

//defcons
if(!$defid){$defid=str_replace(array('http://','www.'),'',$urlsrc);
	$defid=substr($defid,0,strpos($defid,'/'));}
$defcon.=msqlink('users',$basedefs.'_defcons');
if($_SESSION['rstr'][18]==1 && $_SESSION['auth']>4){
	$defcon.=lkc("txtblc",'?switch_defcon==',"switch").' ';
	$defcon.=lkt("txtblc",'/msql/users/'.$basedefs.'_defcons&append=users/public_defcons',"herit_from_public").' ';
	$defcon.=lkt("txtblc",'/msql/users/public_defcons&append=users/'.$_SESSION["qb"].'_defcons',"inform_public").' ';}
else $defcon.=btn('txtsmall','public_defcons').' ';
if($defid)$defcon.=lj("txtred",'popup_editmsql___users/'.$basedefs.'*defcons_'.$defid,"edit");

$otab['html'].='<form id="form1" name="coded" method="post" action="/plug/editor">';
$otab['html'].=ljb('txtbox','document.coded.txt.select()','','::');
$otab['html'].=submitj('txtbox','codeb','convert').' ';
$otab['html'].=input2("text","urlsrc",$urlsrc,'" size="36').' ';
if($urlsrc)$otab['html'].=lkt('txtx',$urlsrc,'go').' ';
$otab['html'].=br();
$otab['html'].='<textarea name="txt" id="txt" class="console" rows="21" cols="61">'.($ret).'</textarea>'.br();//htmlentities
$otab['html'].=$defcon.' ';
$otab['html'].=checkbox("objects","ok","objects",0).' ';
//$otab['html'].=checkbox("jump","ok","not_convert",0).br();
$otab['html'].=checkbox("nobr","ok","br",0);
$otab['html'].=checkbox("convent","ok","entities",0).' ';
$otab['html'].=checkbox("convutf","ok","utf8",0).' ';
$otab['html'].=checkbox("convurl","ok","url",0).' ';
$otab['html'].=checkbox("see","ok","show_work",0).br();
$otab['html'].=lkt("txtblc","/plug/converts","conversions").' ';
$otab['html'].=lkt("txtblc","/plug/notepad","notepad").' ';
$otab['html'].=lkt("txtblc","/plug/ifram","iframe").' ';
$otab['html'].=lkc('txtblc','/plug/editor/reset_cache','reset_cache').' ';
$otab['html'].='</form>';

//notepad
if($_SESSION['USE']){require_once("stext.php"); 
	$otab['connectors'].=divs('position:absolute; right:0; top:0;',plug_stext($npb,1));}
$otab['connectors'].=btn('txtit',$title);
$otab['connectors'].='<form name="converted" method="post" action="">';
$otab['connectors'].=ljb('txtbox','document.converted.txb.select()','','::');
$otab['connectors'].=submitj('txtbox','converted','modif').' ';
$otab["connectors"].=div('',conn_correct($reb));//local_reparation
$otab['connectors'].=div(ats('width:630px;'),conn_edit(""));
$otab['connectors'].=input(0,'title',$title,'');
$otab['connectors'].='<textarea name="txb" id="txtarea" class="tab" rows="16" cols="68" wrap="VIRTUAL" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);" ondblclick="storeCaret(this);" onChange="clip.setText(this.value)">'.($reb).'</textarea><br>';
$otab['connectors'].='<div class="txtsmall2">';
$otab['connectors'].=$defcon.' ';
$otab['connectors'].=checkbox("clean_mail","ok","clean_mail",0).' ';
$otab['connectors'].=checkbox("clean_br","ok","clean_br",0).' ';
$otab['connectors'].=checkbox("del_n","ok","del_nl",0).' ';
$otab['connectors'].=checkbox("add_punct","ok","add_nl",0).' ';
$otab['connectors'].=checkbox("clean_punct","ok","typo_rules",0).' ';
$otab['connectors'].=checkbox("del_tab","ok","del_tables",0).' ';
$otab['connectors'].=checkbox("ucfirst","ok","ucfirst",0).' ';
//$otab['connectors'].='<label>delete:</label>'.balise("select",array(2=>"conn_to_del",5=>"txtblc"),batch_defil_kv(connectors_reference_lite(),"","vv")).' ';
$otab['connectors'].='</div>';
$otab['connectors'].=divc('txtsmall2','replace by:').''.txarea("repla",$_POST['repla'],15,1).' '.txarea("replb",$_POST['replb'],15,1).' '.checkbox("rec_prg","ok","preg",0);
$otab['connectors'].='</form>';
$otab['connectors'].=lkt("txtblc","../plugin/converts","converts").' ';
$otab['connectors'].=lkt("txtblc","../plugin/notepad","notepad").' ';

//wysiwyg
//if($title)$otab["render"].=btn("txtit",$title).br();
$otab['render'].=btd('bts',ljb('txtbox','SaveIcpb()','','convert')).' ';
$otab['render'].=ljb('txtx" id="edt','editab(0)','','editable').' ';
$otab['render'].=txareacb($ree,'tabc panel justy');
$otab['render'].=btd('bts',ljb('txtbox','SaveIcpb()','','convert')).' ';
$otab['render'].=ljb('txtx" id="edt','editab(0)','','editable').' ';

$otab['render'].=divd('popup','')."\n";
$otab['render'].=divd('popw','')."\n";
$otab['render'].=hidden('','socket','');

$out["end"].='</body>'."\n".'</html>';
return implode("",$out).make_tabs($otab);}

if(!$_GET["plug"])
	echo plug_editor();

?>