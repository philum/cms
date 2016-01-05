<?php
//philum_plugin_rss_output 
//askable_rss (used by flash)
session_start();
$prg='../prog';
if($_SESSION['dev']=='dev' or $_SESSION['dev']=='lab')$prg.='b';
require($prg.'/art.php');
require($prg.'/pop.php');
require($prg.'/mod.php');
require($prg.'/spe.php');
require($prg.'/tri.php');
require($prg.'/lib.php');
require('sys.php');

function flux_data(){$qb=$_SESSION['qb'];
$qda=$_SESSION['qda'];$qdm=$_SESSION['qdm'];$_SESSION['nl']='nlb';
$qba='WHERE nod="'.$qb.'"'; $prw=$_GET['preview'];
if($_GET['read']){$qba='WHERE id="'.$_GET['read'].'"';}
elseif($_GET['tag']){$qba='WHERE thm LIKE "%'.$_GET['tag'].'%"';}
if($_GET['topic'])$frma='AND frm="'.$_GET['topic'].'"';
if($_GET['order'])$ordr=str_replace("_"," ",$_GET['order']); else $ordr='day DESC';
if($_SESSION['dayb'] && $_GET['read']=="")$sqlimit='AND day > '.$_SESSION['dayb'];
	$sql="SELECT id,mail,day,suj,frm,thm,img,re FROM $qda $qba $frma $sqlimit ORDER BY $ordr";
	$rq=mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	while($data=mysql_fetch_array($rq)){if($data['re']){
		if($prw){$msg=rse("msg",$qdm.' WHERE id = "'.$data["id"].'"');
		if($_GET['brut'] && strpos($msg,':import'))
			$msg=sql('msg','qdm','v','id="'.embed_detect($msg,'[',':import]','').'"');
		if(!$_GET['brut'])$msg=format_txt_r($msg,"nlb","");
		else{$msg=str_replace('['.$qb.'/','['.host().'/users/'.$qb.'/',$msg);
			$msg=str_replace('['.$qb,'['.host().'/img/'.$qb,$msg);
			$msg=str_replace('[users','['.host().'/users',$msg);}
		if($prw!="full")$msg=kmax($msg);
		$msg=str_replace("imgl","",$msg);
		//$msg=nl2br($msg);
		$http='http://'.$_SERVER['HTTP_HOST'];
		$msg=str_replace("../img/",$http.'/img/',$msg);
		$msg=str_replace("../imgb/",$http.'/imgb/',$msg);
		$msg=str_replace("../imgc/",$http.'/imgc/',$msg);
		$msg=str_replace("../users/",$http.'/users/',$msg);
		$msg=str_replace('href="/','href="'.$http.'/',$msg);
		$msg=str_replace('img src="img','img src="'.$http.'/img',$msg);
		$msg=str_replace('img src="imgb','img src="'.$http.'/imgb',$msg);
		$msg=str_replace('img src="imgc','img src="'.$http.'/imgc',$msg);
		$msg=str_replace('img src="users/','img src="'.$http.'/users/',$msg);
		$msg=parse_msg_xml($msg);}
	//array('date','cat','title','img','hub','tag','lu','author','lenght','url','ib')
	$ret[$data['id']]=array(0=>$data["day"],1=>$data["frm"],2=>$data["suj"],3=>$data['img'],4=>$data["mail"],5=>$data["thm"],12=>$msg);}}
$_SESSION['nl']='';
return $ret;}
	
function flux_xml($id,$data){
	$url='http://'.$_SERVER['HTTP_HOST'].'/'.$id.''; 
	$xml.="<item>\n";
	$xml.="<title>".parse_msg_xml($data[2])."</title>\n";
	$xml.="<link>".$url."</link>\n";
	$xml.="<description>"."\n";
	$xml.=$data[12]."\n";
	$xml.="</description>"."\n";
	$xml.='<guid isPermaLink="true">'.$url.'</guid>'."\n";
	//$xml.="<dc:format>text/html</dc:format>"."|n"; //rss0
	//$xml.="<author>".$data[7]."</author>\n";
	//$xml.="<date>".date("r",$data[0])."</date>\n";
	$xml.="<pubDate>".date("r",$data[0])."</pubDate>\n";
	$xml.="<category>".parse_msg_xml($data[1]).'</category>'."\n"; 
	$xml.="<source>".parse_msg_xml($data[4])."</source>\n";
	$xml.="<tags>".parse_msg_xml($data[5])."</tags>\n";
	$xml.="<id>".$id."</id>\n";
	$xml.="<img>".$data[3]."</img>\n";
	/*	if($data[3]){$xml.="<image><url>".$gmi."</url>
		<title>".$data[2]."</title><link>".$url."</link></image>\n";}*/
	$xml.="</item>"."\n\n";
return $xml;}

//
if($_GET['preview'])$data=flux_data();
else $data=msql_read('',$_SESSION['qb'].'_cache','',1); 

if(is_array($data))foreach($data as $k=>$v)$dscrp.=flux_xml($k,$v);

$nb_arts=count($data); $last_art=$v;
$nb_days=round((time()-($v[0]?$v[0]:$v['day']))/86400);

$varlist="variables: hub/read/tag/topic/order(day DESC)/preview(yes-full)/nbj(number)/brut/";
//header("Content-Type: text/xml"); 
$xml= '<'.'?xml version="1.0" encoding="iso-8859-1" ?'.">\n"; // standalone="yes"
$xml.='<rss version="2.0">'."\n"; 
//$xml.=' xml:lang="fr" xmlns:content="http://purl.org/rss/1.0/modules/content/"';
$xml.='<channel>'."\n"; 
$xml.='<title>http://'.$_SERVER['HTTP_HOST'].'/'.$_SESSION['qb'].'</title>'."\n"; 
$xml.='<link>http://'.$_SERVER['HTTP_HOST'].'/'.$_SESSION['qb'].'/</link>'."\n";
if($nb_arts>1)$rsst=$nb_arts.' articles depuis '.$nb_days.' jours :: 
'.$varlist; else $rsst='flux protocolaire interplateformes';
$xml.='<description>'.$rsst.' </description>'."\n";
$xml.='<language>fr</language>'."\n"; 
$xml.='<generator>philum</generator>'."\n\n"; 
//$xml.='<copyright>philum</copyright>'."\n"; 
$xml.=$dscrp."\n";
$xml.='</channel>'."\n"; 
$xml.='</rss>'."\n"; 
$xml.='</xml>'."\n"; 

echo $xml;

//eye 
//eye('rss');

?>