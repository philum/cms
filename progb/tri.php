<?php
//philum_tri 

function array_combine_sub($a,$b){//bar_org
foreach($a as $k=>$v)if(!$b[$k])$ret[$k]=$v; return $ret;}
//function is_multiple($i,$n){return $i/$n==round($i/$n)?true:false;}
//function is_odd($a){if($a/2==round($a/2))return 1;}

//correctors
function correct_txt($msg,$cr,$gouv){//g2
$st='['; $nd=']'; $deb=''; $mid=''; $end='';
$in=strpos($msg,$st);
if($in!==false){
	$deb=substr($msg,0,$in);
	$out=strpos(substr($msg,$in+1),$nd);
	if($out!==false){
		$nb_in=substr_count(substr($msg,$in+1,$out),$st);
		if($nb_in>=1){
			for($i=1;$i<=$nb_in;$i++){$out_tmp=$in+1+$out+1;
				$out+=strpos(substr($msg,$out_tmp),$nd)+1;
				$nb_in=substr_count(substr($msg,$in+1,$out),$st);}
			$mid=substr($msg,$in+1,$out);
			$mid=correct_txt($mid,$cr,$gouv);}
		else $mid=substr($msg,$in+1,$out);
		if($gouv=='savimg')$mid=corr_img($mid,$cr);
		elseif($gouv=='corrfast')$mid=corr_fast($mid,$cr);
		elseif($gouv=='stripconn')$mid=strip_conn($mid,$cr);
		elseif($gouv=='correct')$mid=correctors($mid,$cr);
		elseif($gouv=='codeline'){$r=decompact_conn($mid); 
			$mid=codeline($r[0],$r[1],$r[2]);}
		elseif($gouv=='clpreview')$mid=clpreview($mid);
		elseif($gouv=='sconn')$mid=sconn($mid);
		elseif($gouv=='delconn')$mid=del_conn($mid);
		elseif($gouv=='extractimg')$mid=extractimg($mid);
		elseif($gouv=='svg')$mid=svg_conn($mid);
		$end=substr($msg,$in+1+$out+1);
		$end=correct_txt($end,$cr,$gouv);}
	else $end=substr($msg,$in+1);}
else $end=$msg;
if($gouv=='extractimg')return $mid.$end;
return $deb.$mid.$end;}//clean_nb

function correctors($doc,$cr){$xfp=strrpos($doc,":"); 
$xf=substr($doc,$xfp); $pdoc=substr($doc,0,$xfp);
if($cr=='stripconn'){//strrchr_b($pdoc,'§')
	if(strpos($doc,'§')!=false)return $pdoc;}
if($cr=='striplink'){list($lin,$txt)=split_one("§",$doc,''); 
	if(is_numeric($lin))$lin=host().urlread($lin);
	if(strpos($doc,'§')!=false or substr($lin,0,4)=='http' or is_numeric($lin))
		return ($txt?$txt.' ('.$lin.') ':$lin);
	if($xf==':pub')return suj_of_id($pdoc).' ('.host().urlread($pdoc).') ';}
if($xf==$cr){
	if($xf==":table"){
		if($_POST['clean_tab'])return del_n($pdoc); //del_n
		else{$pdoc=str_replace(array("¬","|"),array("\n","\t"),$pdoc);
			if(strpos($pdoc,' ')!==false && strpos($pdoc,'.jpg')===false && trim($pdoc))
				return '['.$pdoc.':q]';
			else return $pdoc;}}
	elseif($xf==':chat')return;
	else return $pdoc;}
else return '['.$doc.']';}

//sconn
function sconn_defs_r($d,$xf){
list($pdb,$xfb)=split_one(':',$d,1);
if($xfb)$d=sconn_defs_r($pdb,$xfb);//join
switch($xf){
case("b"):return bal('b',$d);break;
case("i"):return bal('i',$d);break;
case("u"):return bal('u',$d);break;
case("h"):return bal('h3',$d);break;
case("h1"):return bal('h1',$d);break;
case("h2"):return bal('h2',$d);break;
case("h4"):return bal('h4',$d);break;
case("k"):return bal('strike',$d);break;
case("l"):return bal('small',$d);break;
case("e"):return bal('sup',$d);break;
case("q"):return bal('blockquote',$d,'');break;
case('c'):return btn("txtclr",$d);break;
case('s'):return btn("stabilo",$d);break;
case('r'):return pub_clr($d.'§dd0000');break;
case("list"):return make_li_b($d);break;
case("color"):return pub_clr($d); break;
case('css'):return pub_css($d);break;
case('font'):return pub_font($d);break;
case('size'):return pub_size($d);break;
case('color'):return pub_clr($d);break;
case('html'):return pub_html($d);break;
case('web'):return weblink($d); break;
default:return $d.($xf?':'.$xf:'');break;}}

function make_li_b($d){$r=explode("\n",$d);
foreach($r as $v){if(trim($v))$ret.=li(trim($v));}
if($ret)return ul($ret);}

function sconn_defs_app($d,$xf,$h=''){switch($xf){
case("pub"):return pop_art(substr($d,0,4)=='http'?$d:$d); break;//'http://'.$h.'/'.
case("video"):return popvideo($d); break;
case("room"):return call_plug('','popup','chatxml',$d,pictxt('chat',$d)); break;
case("twitter"):return call_plug('','popup','twitter',$d,pictxt('tw',$d)); break;
//case("track"):return tracks_read($d); break; //plugin_func('tracks','track_quote',$d);
case("track"):return plugin_func('tracks','track_answer',$d); break;
case("picto"):return picto($d); break;}}

function sconn($doc){//artwedit
list($pdoc,$xf)=split_one(':',$doc,1);
if($xf && $pdoc!='http'){$d=sconn_defs_r($pdoc,$xf); if($d!=$doc)return $d;}
if($xf){$d=sconn_defs_app($pdoc,$xf); if($d)return $d;}
$xt=strtolower(strrchr($doc,"."));
if($xt==".mp3"){$doc=goodroot($doc);//mp3
	return embed_flsh_obj('fla/mp3.swf',"300","40",'soundFile='.$doc);}
if($xt==".pdf")return pdfdoc($doc,'img/',$media);//pdf
if(is_image($doc) && strpos($doc,"§")===false && strpos($doc,"<")===false){//images
	$large=currentwidth()-20; $largb=round($large*0.5);
	return place_image($doc,$media,$large,$largb,"","");}
if(strpos($doc,"§") or strpos($doc,"http")!==false or strpos($doc,"@")!==false){//liens
$lk=prepdlink($doc);
if(is_image($lk[0]))return popim(goodroot($lk[0]),$lk[1]);//im§txt
elseif(is_image($lk[1])==true){//link§im
	if(is_numeric($lk[0]))$lk[0]=urlread($lk[0]);
	return lkc("",$lk[0],place_image($lk[1],$media,$large,$largb,"",""));}
elseif(strpos($lk[0],"http")!==false)return lka($lk[0],$lk[1]);
elseif(strpos($lk[0],"/")!==false)return lka(goodroot($lk[0]),$lk[1]);
elseif(substr($lk[0],0,1)=="/")return lka($lk[0],$lk[1]);
elseif(strpos($lk[0],"@")!==false && strpos($lk[0],".")!==false)
	return lkc("",'mailto:'.$lk[0],$lk[1]);
elseif(strpos($doc,"@")!==false && strpos($doc,".")!==false)
	return lkc("",'mailto:'.$doc,$doc);
elseif(is_numeric($lk[0]))return jread('',$lk[0],$lk[1]);}
return $doc;}

//miniconn
function miniconn_w($doc,$h){
list($pd,$c)=split_one(':',$doc,1);
if($c && $pd!='http'){$d=sconn_defs_r($pd,$c); if($d!=$doc)return $d;}
if($c){$d=sconn_defs_app($pd,$c,$h); if($d)return $d;}
list($p,$o)=split_one('§',$doc,1); if($o){
	if(is_numeric($p) && $o)return pop_art('http://'.$h.'/'.$p.'§'.$o);
	elseif($p && $o)return lkt('',$p,pictxt('get',$o));}
$xt=strtolower(strrchr($doc,'.'));
if($xt=='.mp3'){$j=ajx(goodroot($doc,$h));
	return lj('','popup_popmp3___'.$j,pictxt('music',strrchr_b($doc,'/')));}
if($xt=='.pdf')return pdfreader($doc);
if(is_image($doc)){$im=goodroot($doc);
	if(@is_file($im))return popim($im,picto('img')); 
	elseif(strlen($doc)>4)return popim_w($im,$h);}
if(strpos($doc,"@")!==false && strpos($doc,'.')!==false)
	return lka('mailto:'.$doc,strdeb($doc,'@'));
//if(substr($doc,0,1)=='@')return plugin_func('tracks','track_answer',substr($doc,1),'');
if(substr($doc,0,1)=='#')
	return call_plug('','popup','chatxml',substr($doc,1),pictxt('chat',substr($doc,1)));
if($pd=='http')return lkt('',$doc,pictxt('get',http_domain($doc)));
return $doc;}

function miniconn($msg,$h=''){
$vd='youtube dailymotion vimeo rutube'; $h=$h?$h:$_SERVER['HTTP_HOST'];
$msg=str_replace("\n",' && ',$msg); $r=explode(' ',$msg); $n=count($r);
for($i=0;$i<$n;$i++){$doc=$r[$i]; if(substr($doc,0,4)=='http')$rad=http_root($doc); else $rad='';
if($rad)if(strpos($vd,$rad)!==false)$doc=substr(auto_video($doc),1,-1);
if(substr($doc,0,1)=='[' or $doc=='&&' or $doc==' ')$rb[]=$doc; else $rb[]=miniconn_w($doc,$h);}
if($rb)$ret=implode(' ',$rb); $ret=str_replace(' && ',"\n",$ret);
return $ret;}

//correctors
function corr_img($doc,$id){$lk=prepdlink($doc); $_SESSION['read']=$id;
if(is_image($lk[0]) && substr($lk[0],0,4)=="http")
	return '['.vacuum_image($lk[0],$id).(strpos($doc,'§')?'§'.$lk[1]:'').']';
elseif(is_image($lk[1])==true && substr($lk[1],0,4)=="http")
	return '['.(strpos($doc,'§')?$lk[0].'§':'').vacuum_image($lk[1],$id).']';
else return '['.$doc.']';}

function corr_fast($doc,$cr){
list($pdoc,$xf)=split_one(':',$doc,1);
$r=explode(' ',$cr); $n=count($r);
for($i=0;$i<$n;$i++){if($xf==$r[$i])return $pdoc;}
return '['.$doc.']';}

function strip_conn($doc,$cr){
list($pdoc,$xf)=split_one(':',$doc,1);
if($xf!=$cr)return '['.$doc.']';}

function del_conn($doc){
list($pdoc,$xf)=split_one(':',$doc,1); 
if(strpos($doc,"§")!==false){list($p,$o)=explode("§",$doc);//p 
	if(!is_image($p))$ret=$o.' '; if(!is_image($o))$ret.='('.$p.')'; return $ret;}
if(!is_image($doc) && strpos($doc,":")===false)return ''.$doc.'';
if(!is_image($pdoc) && $pdoc!='http')return $pdoc;
if(!is_image($doc) && $pdoc!='http')return $xf?$pdoc:$doc;
if($pdoc=='http')return $doc.' ';}

function extractimg($d){if(is_image($d))return '/'.$d;}

function del_tables($v){
$ret=correct_txt($v,":table",'correct'); 
$ret=str_replace(array("¬","|"),"",$ret);
$ret=clean_br($ret);//clean_prespace//repair_badn//
return $ret;}

function del_qmark($v){//$v=html_entity_decode_b($v);
$r=explode("\n",$v); $n=count($r);
for($i=0;$i<$n;$i++){
	if(substr($r[$i],0,1)=='?')$r[$i]='- '.ltrim(substr($r[$i],1));
	$ret.=ltrim($r[$i])."\n";}
$ret=mb_ereg_replace("[?]{2,}","",$ret);
$ret=mb_ereg_replace("[ ]{2,}"," ",$ret);
return $ret;}

function correct_widths($v){$width=prma('content');
$goodw=$width?$width:580; $goodh=round($goodw/(16/9));
$v=mb_ereg_replace('width="([0-9]+)"','width="'.$goodw.'"',$v);
return mb_ereg_replace('height="([0-9]+)"','height="'.$goodh.'"',$v);}

function conn_ref_in(){
return array("",":h1",":h2",":h",":h4",":t",":c",":b",":u",":i",":s",":k",":e",":l",":q",":p",":w",":r",":pre",":code",":nh",":nb",":list",":numlist",":table",":right",":center",":video",":iframe");}
function conn_ref_out(){
//return array_keys(msql_read('system',"connectors_logic",""));
$r=conn_ref_in();
$rb=array(":read",":import",":flash",":photo",":radio",":rech",":form",":chat",":pub",":css",":/2",":/3",":module",":ajax",":img",":console",":php",":scan",":scrut",":web",":plug",":petition"); return array_merge($r,$rb);}

function clean_internaltag($msg){//return correct_txt($id,'','delconn');
$msg=str_replace("\n"," \n",delbr($msg,"\n"));
$re=explode(" ",$msg); foreach($re as $k)
	if(strpos($k,"§")!==false){
		list($lin,$txt)=explode("§",$k); $ret.=$lin.' '.$txt.' ';}
	else $ret.=$k.' ';
$msg=str_replace(" \n","\n",$msg);
return stripconn($ret);}

function stripconn($d){$conn=conn_ref_in();
$ret=str_replace($conn," ",$d);
$ret=str_replace(array('[',']','¬','|','§')," ",$ret);//
$ret=mb_ereg_replace("[ ]{2,}"," ",$ret);
return $ret;}

function parse_output($msg){
$msg=str_replace($_SESSION['qb'].'_',host().'/img/'.$_SESSION['qb'].'_',$msg); 
$msg=clean_internaltag($msg);//correct_txt($msg,'','delconn')
if(strpos($msg,"\n")===false)$msg=delbr($msg,"\n");
else{$msg=str_replace("<br>"," ",$msg);}
//$msg=trim($msg,"\x00..\x1F");
$msg=html_entity_decode($msg);
$msg=stripslashes($msg);
return $msg;}

function parse_idy($m){
$ret=str_replace(array("/?read=","&idy_","hide","#msg","erase=","X"),"",$m);
$ret=stripslashes($ret);
return $ret;}

function antipirat($t){$re=explode("[-./_ ]",$t); $ratio=1.5; //nb_identical_words
foreach($re as $k){$ter[$k]+=1;}
if(count($ter)>count($re)/$ratio){return $t;}}

#cut_words

function ecart($v,$a,$b){return substr($v,$a+1,$b-$a-1);}
function findroot($u){$nb=substr_count($u,"/"); $nu=explode("/",$u);
for($i=0;$i<$nb;$i++){$ret.=$nu[$i].'/';}
return ''.$ret;}

function verif_cut($karmax,$msg){$va="["; $vb="]"; 
$newnb=$karmax+strpos(substr($msg,$karmax),"<br>");
$until=strpos(substr($msg,$newnb),$vb);
if(substr_count(substr($msg,0,$newnb),$va)>substr_count(substr($msg,0,$newnb),$vb)){$newnb+=$until;} 
return substr($msg,0,$newnb);}

function kmax_nb($kmx,$msg){
$poa=strpos(substr($msg,$kmx),". ");
$pob=strpos(substr($msg,$kmx),"\n"); $pos=$poa<$pob?$poa+1:$pob;
//$pob=strpos(substr($msg,$kmx),"."); $pos=$pob<$pos?$pob+1:$pos;
if($pos!==false){$kmx+=$pos;}
$deb=substr_count(substr($msg,0,$kmx),"[");
$end=substr_count(substr($msg,0,$kmx),"]");
if($deb>$end){$dif=$deb-$end;
	for($i=0;$i<$dif;$i++){
	$kmx+=strpos(substr($msg,$kmx),"]")+1;
	$debb=substr_count(substr($msg,0,$kmx),"[");
	if($debb>$deb)$dif=($debb-$end);}}
if(substr_count(substr($msg,0,$kmx),"<")>substr_count(substr($msg,0,$kmx),">")){
$pos=strpos(substr($msg,$kmx),">"); $kmx+=$pos+strpos(substr($msg,$kmx+$pos+1),">")+1;}
if((substr_count(substr($msg,0,$kmx),"<"))>substr_count(substr($msg,0,$kmx),"</")){
$pos=strpos(substr($msg,$kmx),"</"); $kmx+=$pos+strpos(substr($msg,$kmx+$pos+1),">")+1;}
$pos=strpos(substr($msg,0,$kmx),"<embed");
if($pos!==false){$pob=strpos(substr($msg,$pos),">")+1; $kmx=$pos+$pob;}
$pos=strpos(substr($msg,0,$kmx),"<object");
if($pos!==false){$pob=strpos(substr($msg,$pos),"</object>")+1; $kmx+=$pos+$pob;}
$pos=strpos(substr($msg,0,$kmx),"<form");
if($pos!==false){$pob=strpos(substr($msg,$pos),"</form>")+1; $kmx+=$pos+$pob;}
return $kmx;}

function kmax($msg){
$kmx=kmax_nb($_SESSION['prmb'][3],$msg);
return substr($msg,0,$kmx);}

//security
function verif_post(){
foreach($_POST as $k=>$v){$_POST[$k]=str_replace(array("<",">"),"",$v);}}

#automatic_filters
//links
function embed_links($msg){//oldest_function!
$msg=str_replace("\n",'µµ ',$msg); $mgs=explode(" ",$msg);
foreach($mgs as $k=>$val){
	if(substr($val,0,4)=="http")$ret[]='['.$val.']';
	elseif(strpos($val,"@")!==false && strpos($val,"[")===false)$ret[]='['.$val.']';
	else $ret[]=$val;}
$re=implode(' ',$ret);
$re=str_replace(array('µµ ',' µµ','µµ'),"\n",$re);
$re=str_replace(',]','],',$re); $re=str_replace('.]','].',$re);
$re=str_replace("\n]","]\n",$re);
//$re=str_replace("([","[(",$re);
//$re=str_replace("])",")]",$re);
return $re;}

# repairs
function stupid_acc($v){return str_replace(
array("a`","a^","A`","e´","e`","e^","e¨","o^","i^","E´","´´","´"),//,"é"
array("à","â","A","é","è","ê","ë","ô","î","E",'"',"'"),$v);}//,"é"

function antipuces($v){// && strpos($v,".gif")===false
if(forbidden_img($v)!==false && (strpos($v,"puce")===false))
return $v;}

function clean_spaces($ret){
$ret=str_replace("&nbsp;"," ",$ret);
//$ret=str_replace(htmlentities(" ")," ",$ret);
//$ret=str_replace(html_entity_decode("&nbsp;")," ",$ret);
$ret=mb_ereg_replace("[ ]{2,}"," ",$ret);
return $ret;}

function pre_clean($ret){
$ret=clean_spaces($ret);
$ret=clean_acc($ret);
$ret=stupid_acc($ret);
//$ret=html_entity_decode_b($ret);
//$ret=html_entity_decode($ret);
$r=array('b','i','em','strong','p');
for($i=0;$i<4;$i++){
	$ret=str_replace('<'.$r[$i].'> </'.$r[$i].'>','',$ret);
	$ret=str_replace('</'.$r[$i].'><'.$r[$i].'>','',$ret);
	$ret=str_replace('</'.$r[$i].'> <'.$r[$i].'>',' ',$ret);
	$ret=str_replace('</'.$r[$i].'>'."\n".'<'.$r[$i].'>',"\n",$ret);
	$ret=str_replace('</'.$r[$i].'>'."\n\n".'<'.$r[$i].'>',"\n\n",$ret);}
if(substr_count($ret,"]")!=substr_count($ret,"["))
	$ret=str_replace(array("[","]"),array("(",")"),$ret);//
//$reb=htmlspecialchars($reb);
return $ret;}

function del_n($d){$d=clean_prespace($d);
return str_replace(array("\r","\n","<br>","<br/>","<br />")," ",$d);}

function clean_firstspace($re){$r=explode("\n",$re);
foreach($r as $v)$ret.=trim($v)."\n";//,"\r\t  "
//foreach($r as $v)echo eco(bal('pre',str_replace("&nbsp;","",$v)),1);
//$ret=mb_ereg_replace("[\n]{2,}","\n",$ret);
return $ret;}

function clean_prespace($ret){
$ret=str_replace("\t","",$ret);
//$ret=str_replace("\r","\n",$ret);
$ret=str_replace("&nbsp;"," ",$ret);
$ret=str_replace(html_entity_decode("&nbsp;")," ",$ret);
$ret=str_replace("&#8239;"," ",$ret);
$ret=str_replace("\n ","\n",$ret);
$ret=str_replace(" \n","\n",$ret);
//$ret=str_replace("« ?","«&nbsp;",$ret);
//$ret=str_replace("? »","&nbsp;»",$ret);
//$ret=htmlspecialchars($ret);
if(rstr(9)){
	$ret=str_replace(".jpg]\n",".jpg]",$ret);
	$ret=str_replace(".gif]\n",".gif]",$ret);
	$ret=str_replace(".png]\n",".png]",$ret);}
$ret=str_replace("[--]\n","\n[--]",$ret);
$ret=mb_ereg_replace("[ ]{2,}"," ",$ret);
$ret=clean_firstspace($ret);
return $ret;}

function clean_n($ret){
$ret=str_replace("\r","\n",$ret);
$ret=mb_ereg_replace("[ ]{2,}","\n",$ret);
$ret=mb_ereg_replace("[\n]{2,}","\n\n",$ret);
return $ret;}

function clean_br_lite($ret){
$ret=str_replace("\n","µ",$ret);
$ret=mb_ereg_replace("[µ]{2,}","µµ",$ret);
if(substr($ret,0,1)=='µ')$ret=substr($ret,1);
if(substr($ret,0,1)=='µ')$ret=substr($ret,1);
$ret=str_replace('µ',"\n",$ret);
$ret=mb_ereg_replace("[ ]{2,}"," ",$ret);
return trim($ret);}

function clean_br($ret){
$ret=mb_ereg_replace("(\r\n)|(\n\r)","\n",$ret);
$ret=mb_ereg_replace("[\n]{2,}","\n\n",$ret);
//$ret=clean_prespace($ret);
$ret=clean_prespace($ret);
$ret=repair_badn($ret);
$ret=repair_badn($ret);
	//$ret=repair_tags($ret);
	foreach(conn_ref_out() as $k=>$v)$ret=str_replace("\n".$v.']',$v.']',$ret);
//$ret=mb_ereg_replace("[\r]{2,}","\r\r",$ret);
$ret=clean_br_lite($ret);
return $ret;}

function clean_tab_c($d){
$d=str_replace("\r","",$d);
$arr=array("|\n","\n|","\n¬","¬\n","¬:","¬ :");
$arb=array("|","|","¬","¬",':',':');
return str_replace($arr,$arb,$d);}

function repair_tags($ret){
$arr=array("| ¬","|¬","¬ ¬","¬ ]","¬]","[¬]","[\n]","[]","\n:list]","[--]\n","\n ");
$arb=array("¬","¬","¬","]","]","","","",":list]","[--]","\n");
$ret=str_replace($arr,$arb,$ret);
$r=conn_ref_in();
foreach($r as $k=>$v){$ret=str_replace(' '.$v.']',$v.'] ',$ret);
	$ret=str_replace('['."&nbsp;".$v.']',"",$ret);
	$ret=str_replace('[ '.$v.']',"",$ret);
	$ret=str_replace('['.$v.']',"",$ret);
	$ret=str_replace("[.".$v.']',".",$ret);
	//$ret=str_replace("[\n".$v.']',"",$ret);
	$ret=str_replace("\n".$v.']',$v.']'."\n",$ret);}
if(rstr(9))$ret=str_replace(".jpg]\n",'.jpg]',$ret);
return $ret;}

function add_comments($d){$r=explode("\n",$d);
foreach($r as $k=>$v){$pos=strpos($v,'.jpg]');
if($pos!==false && substr($v,-1)!='.'){$t=trim(substr($v,$pos+5));
	if($t && strpos($t,'.jpg]')===false && strpos($t,'{{')===false && strpos($t,':label')===false)$ret.=substr($v,0,$pos+5).'['.$t.':label]'."\n"; else $ret.=$v."\n";}//}}
else $ret.=$v."\n";}
return $ret;}

function add_lines($ret){
return clean_br(str_replace(array(". ",".\n"),".\n\n",$ret));}

//footnotes
function add_anchors($ret){$rp=array('(',')'); 
for($i=1;$i<200;$i++){$types=array('[['.$i.']:b]','[['.$i.']:i]','[['.$i.']]','['.$i.']','['.$i.'.]','|'.$i.'|'); 
	$ret=str_replace($types,'('.$i.')',$ret);
	$ret=str_replace(array("\n".$i.'.',"\n".$i.')'),"(".$i.')',$ret);}
for($i=1;$i<200;$i++){
	$no=strpos($ret,$i.':n'); $fnd='('.$i.')'; $sp=strpos($ret,$fnd)+10;
	//if(strpos(substr($ret,$sp),$fnd)===false)$no=1;
	if($no===false)$ret=str_replace($fnd,'(['.$i.':nh])',substr($ret,0,$sp)).
	str_replace($fnd,'(['.$i.':nb])',substr($ret,$sp));}
return $ret;}

function repair_badn($ret){//2 fois
$ret=str_replace('µ','-micro',$ret);
$ret=str_replace("\n",'µ',$ret);
if(rstr(9))$ret=str_replace('.jpg]µ','.jpg]',$ret);
$arr=array(' µ','µ.','µ ','[µ',':]','] .',' ]','[ ',' )','( ');
$arb=array('µ','µ','µ','µ[',']:',']. ','] ',' [',')','(');
$ret=str_replace($arr,$arb,$ret);
$arra=array('[µ[','µ:h]','µ:b]','µ:i]','µ:u]','µ:q]','§µ','§ ','-µ');
$arrb=array('µ[[',':h]µ',':b]µ',':i]µ',':u]µ',':q]µ','§','§','- ');
$ret=str_replace($arra,$arrb,$ret);
$ret=str_replace('µ',"\n",$ret);
$ret=mb_ereg_replace("[\n]{2,}","\n\n",$ret);
$ret=str_replace('-micro','µ',$ret);
return $ret;}

//clean_mail
function convertmail($ret){
$ret=clean_prespace($ret);
$ret=str_replace("M.\n",'. ',$ret);
$ret=str_replace(".\n",'.µµ',$ret);
$ret=str_replace("\n",'µ',$ret);
$ret=mb_ereg_replace('µµ',"\n\n",$ret);
$ret=str_replace('µ',' ',$ret);
return $ret;}

function no_unused_br($ret){//experiment
$ar=array("]\n",".\n\n",".\n","\n\n","µµ","gµ","µ",);
$ab=array("gµ","µµ","µ","\n",".\n\n","]\n",".\n",);
return str_replace($ar,$ab,$ret);}

function repair_post_treat($ret){
//$ret=clean_firstspace($ret);
$ret=clean_prespace($ret);
//$ret=antipuces($ret);
$ret=repair_badn($ret);
$ret=repair_tags($ret);
$ret=utflatindecode($ret);
$ret=clean_acc($ret);
//$ret=add_comments($ret);
$ret=clean_tab_c($ret);
$ret=clean_punct($ret);
//$ret=pre_clean($ret);
//$ret=no_unused_br($ret);
$ret=mb_ereg_replace("[ ]{2,}"," ",$ret);
//trim($ret);
return $ret;}

#vacuum
function br_rules($ret){
$ret=str_replace(array("\r","\n")," ",$ret);
$ret=str_replace(array("<br />","<br/>","<br>","<BR>"),"\n",$ret);
if($_POST["nobr"]=="ok")$ret=str_replace("\n","\n\n",$ret);
//"<br />\n","\n<br />","<br>\n","\n<br>",
return $ret;}

function nodate($d){$r=explode('/',substr($d,-10));
if(is_numeric($r[0]) && is_numeric($r[1]) && is_numeric($r[2]))return substr($d,0,-11);
return $d;}

function defcon_generic(){
$r['philum']=array('<article','</article>','<h2 id="fixit">','</h2>');
$r['blogspot']=array("<div class='post-body entry-content'",'',"<h3 class='post-title entry-title' itemprop='name'>",'</h3>','',1);
$r['over-blog']=array('<div class="contenuArticle">','','<div class="divTitreArticle">','</div>','',1);
$r['wordpress']=array('<div class="post-text">','<div id="jp-post-flair" class="sharedaddy sd-rating-enabled sd-like-enabled sd-sharing-enabled">','<h1 class="post-title">','</h1>','','','linewith:About these ads');
$r['default']=array('<meta name="description" content="','"','<title>','</title>','','','');
return $r;}

function known_defcon($f,$d){$r=defcon_generic();
if(strpos($d,'name="generator" content="philum'))return $r['philum'];
if(strpos($f,'blogspot'))$ret=$r['blogspot'];
if(strpos($f,'over-blog'))$ret=$r['over-blog'];
//if(strpos($f,'wordpress'))$ret=$r['wordpress'];
if(strpos($d,$ret[0]) && strpos($d,$ret[2]))return $ret;
if(strpos($d,$r['default'][0]))return $r['default'];}

function auto_video($f,$o='',$t='',$op=''){if($t)$t='§'.$t; //$t='';
if(strpos($f,'/')===false)return '['.$f.$t.':video]';
$f=str_replace(array("http://","www."),'',$f); $fa=http_root($f); 
if(strpos($f,'#'))$f=split_only('#',$f,0,0); if(strpos($f,'?'))$f=split_only('?',$f,1,1);
$r=array('','youtube','youtu','dailymotion','vimeo','vk','livestream','google');//,'ted'
if(in_array($fa,$r))switch($fa){
	case('youtube'):$p=strpos($f,'v='); $f=substr($f,$p+2); $pe=strpos($f,'&');
		if($pe!==false)$ret=subtopos($f,0,$pe); else $ret=$f; break;
	case('youtu'):$p=strpos($f,'/'); $f=substr($f,$p+1); $pe=strpos($f,'?');
		if($pe!==false)$ret=subtopos($f,0,$pe); else $ret=$f; break;
	case('dailymotion'):$ret=embed_detect($f,'video/','-');
		if(!$ret)$ret=substr($f,strpos($f,'video/')+6); break;
	case('vimeo'):$ret=substr($f,strrpos($f,'/')+1); break;
	case('vk'):$ret=embed_detect($f,'/video','_'); break;
	case('livestream'):$ret=embed_detect($f,'com/','/'); break;
	case('rutube'):$ret=embed_detect($f,'tracks/','.'); break;}
if($ret){if($op)return $ret.':video'; //embed_btn
else return '['.$ret.$t.':'.$o.'video]';}}

function post_treat_batch($v,$t,$p){$todo=explode('|',$p);//admin/edit_msql_j
foreach($todo as $ka=>$va){list($act,$pb)=split_one(':',$va,0);//global
	if($act=='deltables' && $v)$v=del_tables($v);
	elseif($act=='delblocks' && $v)$v=correct_txt($v,':q','correct');
	elseif($act=='stripconn' && $v)$v=correct_txt($v,'stripconn','correct');
	elseif($act=='striplink' && $v)$v=correct_txt($v,'striplink','correct');
	elseif($act=='delconn' && $pb && $v)$v=correct_txt($v,':'.$pb,'correct');
	elseif($act=='cleanmail' && $v)$v=convertmail($v);
	elseif($act=='delqmark' && $v)$v=del_qmark($v);
	elseif($act=='-??')$v=str_replace('-??','-',$v);
	elseif($act=='???')$v=mb_ereg_replace("[?]{2,}","",$v);}
$r=explode("\n",$v); $nbr=count($r);
foreach($r as $k=>$v){$cur=true;//by_lines
	foreach($todo as $ka=>$va){
	list($act,$pb)=split_right(':',$va,0);
	if($cur!=false){
	if($act=='line' && $k==$pb-1)$cur=false;
	elseif($act=='del'){if($pb=='title')$pb=$t; $cur=str_replace($pb,'',$v);}
	elseif($act=='line' && $pb=='last' && $k==$nbr)$cur=false;
	elseif($act=='linewith' && strpos($v,$pb)!==false)$cur=false;
	elseif($act=='boldline' && $k==$pb-1 && $v)$cur='['.$v.':b]';
	elseif($act=='line' && $pb=='title' && $t){$vb=clean_title(pre_clean(trim($v))); $tb=$t;
		if(strpos($vb,$tb)!==false)$cur=false; else $cur=$v;}
	elseif($act=='del-link' && strpos($v,$pb)!==false)$cur=embed_detect($v,'§',']');
	elseif($act=='linenolink' && $k==$pb-1)list($no,$cur)=explode("§",substr($v,0,-1));
	else $cur=$v;}}
$ret.=$cur."\n";}
$ret=clean_br($ret);
$ret=repair_tags($ret);
$ret=utflatindecode($ret);
return trim($ret);}

function add_defcon($d){$d=http_domain($d);
return msqlink('',(rstr(18)?'public':$_SESSION['qb']).'_defcons',ajx($d));}

function stripslashes_r($r){
foreach($r as $k=>$v)$ret[$k]=str_replace('\"','"',$v);
return $ret;}

function verif_defcon($f){$f=http_domain($f);
$base=rstr(18)?'public':$_SESSION['qb'];
$r=msql_read("",$base.'_defcons',"");
if($r)foreach($r as $k=>$v){$i++;
if($f==$k)return array($k,stripslashes_r($v));}}

function converthtml($ret){
$ret=stripslashes($ret);
$ret=pre_clean($ret);
$ret=br_rules($ret);
$ret=interpret_html($ret,$_POST["jump"]);
$ret=repair_post_treat($ret);
$ret=add_anchors($ret);
$ret=clean_br($ret);
return $ret;}

function readmeta($f){$d=get_file($f);
$enc=mb_detect_encoding($d); if(strtolower($enc)=='utf-8')$d=utf8_decode_b($d);
$tit=embed_detect($d,'<meta property="og:title" content="','"');
$txt=embed_detect($d,'<meta property="og:description" content="','"');
$img=embed_detect($d,'<meta property="og:image" content="','"');
return array($tit,$txt,$img);}

function vaccum_ses($f){$fb=nohttp($f);//if(joinable($f))
//if(!$_SESSION['vacuum'][$fb])
$_SESSION['vacuum'][$fb]=get_file($f);
return $_SESSION['vacuum'][$fb];}

function vacuum($f,$sj=''){$f=https($f); $f=http($f); $f=utmsrc($f); $reb=vaccum_ses($f); 
if(!$reb){return array('nothing');$_SESSION['vacuum'][nohttp($f)]='';}
if($_POST['see'])eco($reb,1);
$encoding=embed_detect(strtolower($reb),'charset=','"');
//if(!$encoding)$encoding=mb_detect_encoding($reb);
list($defid,$defs)=verif_defcon($f);//defcons
if(!$defs)$defs=known_defcon($f,$reb);
$auv=auto_video($f); 
if(!$defs && !$auv){add_defcon($f); return array('Title',$f,$f,'','','');}
if(strtolower($encoding)=='utf-8' or $_POST['utf'] or $defs[5])$reb=utf8_decode_b($reb);
if($defs[2]){if(!$defs[3])$suj=embed_detect_c($reb,$defs[2]);//suj
	elseif($defs[3])$suj=embed_detect($reb,$defs[2],$defs[3]); 
	$suj=trim(del_n($suj)); $suj=interpret_html($suj,"ok");}
if($defs[0]){if(!$defs[1])$rec=embed_detect_c($reb,$defs[0]);//text
	elseif($defs[1])$rec=embed_detect($reb,$defs[0],$defs[1]);}
else $rec=embed_detect_c($reb,'<body');
if($defs[8]){if(!$defs[9])$opt=embed_detect_c($reb,$defs[8]);//opt
	elseif($defs[9])$opt=embed_detect($reb,$defs[8],$defs[9]);
	if($opt)$opt.=br().br();}
//if($defs[4] && $defs[4]!=1){$end=embed_detect_c($reb,$defs[4]); if($end)$end=br().br().$end;}
if($auv)$ret=$auv; else $ret=converthtml($opt.$rec.$end);
if($suj)$title=clean_title($suj);
else $title=clean_internaltag(pre_clean($sj?$sj:'Title'));
if($defs[6])$ret=post_treat_batch($ret,$title,$defs[6]);//post_treat
if($_SESSION['sugm'])$sug=sugnote();
if(!$auv)$ret.="\n\n".$sug.'['.$f.']'; //eco($rec,1);
return array($title,$ret,$rec,$defid,$defs);}

//suggest
function sugnote(){$sg=$_SESSION['sugm']; $_SESSION['sugm']='';
$r=msql_modif('users',ses('qb').'_suggest','ok',3,'val',$sg); 
$mail=$r[$sg][2]; list($m,$a)=split("@",$mail); $id=lastid('qda')+1;
$msg=lkc('',host().urlread($id),helps('suggest_ok'));
if($mail)send_mail_html($mail,nms(1).' '.nms(89),$msg,$_SESSION['qbin']['adminmail'],$id);
if($m)return '['.nms(56).' '.nms(88).' '.$m.':q]'."\n";}

#transductor

//good start for root
function partsoflink($root,$src){$ro=explode("/",$root);
if(substr($src,0,1)=="/"){$na=3;}//départ racine
else{$nb=substr_count($src,"../"); $na=count($ro)-$nb-1;}
if($na<3)$na=3;//erreurs d'adressage (../ en trop)
for($i=0;$i<$na;$i++){$rot.=$ro[$i].'/';}
return $rot;}

function b64img($d){
$f=$_SESSION['qb'].'_'.(lastid('qda')+1).'_b64.jpg';
write_file('img/'.$f,base64_decode(substr($d,strpos($d,',')+1)));
return $f;}

//link-img
function treat_link($balise,$txa){
if($txa){$tag='href='; $len=6; 
	if(substr($txa,0,1)==" ")$sp=' ';
	$txt=clean_internaltag($txa);///testing
	if(strpos($txt,'>'))$txt=substr($txt,strpos($txt,'>')+1);}
else{$tag='src='; $len=5; $im="ok";}
$root=findroot($_GET['urlsrc']?$_GET['urlsrc']:$_POST['urlsrc']);
$imnb=strpos(strtolower($balise),$tag); 
	if($imnb!==false){$imnc=substr($balise,$imnb+$len-1,1);
		if($imnc=='"' or $imnc=="'"){$bend=strpos($balise,$imnc,$imnb+$len); $nb=$len;}
		else{$bend=strpos($balise," ",$imnb+$len-1); $nb=$len-1;}}
if($bend===false){$bend=strpos($balise,'>',$imnb+$nb);}
$src=substr($balise,$imnb+$nb,$bend-$imnb-$nb);
if(strpos($balise,'popup_nbp'))$mid='['.$txt.':nh]';//philum_anchor
if(strpos($src,'base64'))$mid='['.b64img($src).']';
elseif($src){
	$src=utmsrc($src); $txt=utmsrc($txt);
	if($tag=='src=')if($pos=strpos($src,'?'))$src=substr($src,0,$pos);
	$src=str_replace(" ","%20",$src);
	$src=mb_ereg_replace("(\n)|(\t)","",$src);
	$txt=mb_ereg_replace("(\n)|(\t)","",$txt);
	if(strpos($src,"http")===false){$rot=partsoflink($root,$src);}
	if(substr($src,0,1)=="/")$src=substr($src,1);
	if(substr($src,-1)=="/")$src=substr($src,0,-1);
	if(substr($txt,0,1)=="/")$txt=substr($txt,0,-1);
	$src=str_replace("../","",$src);
	//if(!is_image($rot.$src,xt($src)) && $im)$ext=":img";
	if(strpos($src,"javascript")!==false)$src="";
	//if(strpos($balise,'cs_glossaire')!==false)$mid='['.($txa).':pop]';//dico
	if(strpos($balise,'cs_glossaire')!==false)$mid=$src;//strrchr_b($txa,'§')
	elseif($txt && $txt!=' '){$posdiez=strpos($src,'#');
		//if($tag=='src='){}
		$rt=array('youtube','youtu','dailymotion','vimeo','rutube');
		if($posdiez!==false){//$mid=$txt; //skip_anchors
			$id=prop_detect($balise,'name');
			if(!$id)$id=prop_detect($balise,"name='","'");
			if(!$id)$id=prop_detect($balise,'id');
			if(!$id)$id=embed_detect($balise,"id='","'");
			if(substr($src,$posdiez+1,2)=="nb") $mid='['.$txt.':nh]';//spip
			elseif(substr($src,$posdiez+1,2)=="nh") $mid='['.$txt.':nb]';
			if(substr($src,$posdiez+1,4)=="_ftn") $mid='['.$txt.':nh]';//symfony
			elseif(substr($src,$posdiez+1,7)=="_ftnref") $mid='['.$txt.':nb]';
			if(!$mid){if(!$txt) $mid=substr($src,$posdiez+1);
			elseif(substr($txt,0,1)=='[' or substr($txt,0,1)=='(')$mid=$txt;
			else $mid='['.$txt.']';}}//'.$rot.$src.'§
//		elseif(http_root($src)=='t')$mid='['.$rot.$src.'] ';
		elseif(in_array(http_root($src),$rt)){
			if(!is_image($txt) && !ishttp($txt)){$txb=$txt; $pop='pop';}
			$mid=auto_video($src,$pop,$txb);}
//		elseif(in_array(http_root($txt),$rt))$mid=auto_video($txt,'pop',$src);
		elseif(strpos($src,"mailto:")!==false)$mid='['.substr($src,7).'] ';
		elseif(is_image($src) && is_image($txt))$mid='['.$rot.$src.'] ';
		elseif($txt && $src && strpos($txt,$src)!==false)$mid='['.$rot.$src.'] ';
		elseif($rot.$src!=$txt){$txt=trim($txt);
			if(is_image($src)){
				if(!is_image($txt))$mid='['.$rot.$src.($txt?'§'.$txt:'').']';
				else $mid='['.$rot.$src.']';}
			elseif(strpos($txt,'...')!==false && strpos($src,str_replace('...','',$txt))!==false)$mid='['.$rot.$src.'] ';
			else $mid='['.$rot.$src.'§'.$txt.'] ';}
		else $mid='['.$rot.$src.'] '.$txb;}
	else $mid='['.$rot.$src.$ext.'] '.$txb;}
elseif($txt)$mid=$txt.' ';
return $sp.$mid;}

#html_transductor

function prep_table($balise){$balise=trim($balise);
$balise=str_replace(array("¬","|"),"-",$balise);
return del_n($balise);}

function clarify_intag($balise,$t){
$balsansesp=mb_ereg_replace("(\r)|(\n)| |&nbsp;","",$balise); 
if(strpos($balise,$t)===false && strpos($balise,".jpg]")===false && strpos($balise,".gif]")===false && strpos($balise,".png]")===false && $balsansesp)return true;}

function piegemedia($v){$pos=strpos($v,"flv");$end="flv";
if($pos===false){$pos=strpos($v,"FLV");$end="FLV";}
if($pos===false){$pos=strpos($v,".mp3");$end=".mp3";}
if($pos===false){$pos=strpos($v,".mp4");$end=".mp4";}
if($pos!==false){$deb=strrpos(substr($v,0,$pos),"http");
if($deb===false){$deb=strrpos(substr($v,0,$pos),"=");}
if($deb!==false){$bal=subtopos($v,$deb,$pos);}}
if($bal) return "\n".'['.$bal.$end.']'."\n";}

function piege_utube($v){$d=trap_v_id($v,'youtube.com/v/'); if($d)return '['.$d.':video]';}
function piege_rutube($v){$d=trap_v_id($v,'rutube.ru/'); if($d)return '['.$d.':video]';}
function piege_daily($v){$d=trap_v_id($v,'video/'); if(!$d)$d=trap_v_id($v,'swf/');
	$d=split_only('_',$d,0,0); if($d)return '['.$d.':video]';}
function piege_googv($v){$d=embed_detect($v,'docid=','&');
	if($d)return '['.$d.':video]';}
function piege_ted($v){$d=embed_detect($v,'vu=','&'); if($d)return '['.$d.':video]';}
function piege_mp3_b64($v){$d=embed_detect($v,'soundFile=','&');
	if(strpos($d,'.mp3')===false)return base64_decode($d); else return $d;}
function trap_v_id($v,$s){$e=strpos($v,'?'); 
	if($e!==false)$d=embed_detect($v,$s,'?'); else $d=embed_detect($v,$s,'"');
	$e=strpos($d,'&'); if($e!==false)$d=substr($d,0,$e); return $d;}
//function trap_video($v,$s){$d=trap_v_id($v,$s); if($d)return '['.$d.':video]';}

function dico($aa_inner,$balise){//echo $aa_inner.'- ';//dico de cadtm
$cl=embed_detect($aa_inner,'class="','"');
if($cl=='gl_mot')$_POST['popa']=$balise;
elseif($cl=='gl_dt')$_POST['popdt']=$balise;//substr($balise,0,strlen()/2)
elseif($cl=='gl_dd')$balise=str_replace('Cliquez pour plus.','',$balise);
elseif($cl=='gl_dl')$balise.='§'.($_POST['popa']?$_POST['popa']:$_POST['popdt']);
return $balise;}

function balise_converter($aa_balise,$aa_inner,$bb_balise,$balise){$br="\n";
//if(!trim($balise))return;
switch($aa_balise){// or strpos($balise,'http')!==false
case("a"): if(strpos($balise,'@')!==false)$balise=interpret_html($balise,'ok');
	else $balise=treat_link($aa_inner,$balise); break;
case("img"): $balise=treat_link($aa_inner,''); $bim=antipuces($balise);
	if($bim)$balise=$br.$br.$bim; else $balise=''; break;
//case("aside"): $balise=$br.'['.$balise.'§1:msq_graph]'.$br;break;//
case("table"): $balise=$br.$br.'['.$balise.':table]';break;
case("tr"): $balise.='¬';break;
case("td"): $balise=prep_table($balise).'|';break;
case("th"): $balise=prep_table($balise).'|';break;
case("strong"): if(clarify_intag($balise,":b]"))$balise='['.$balise.':b]'; break;
case("bold"): if(clarify_intag($balise,":b]"))$balise='['.$balise.':b]'; break;
case("em"):	if(clarify_intag($balise,":em]"))$balise='['.$balise.':i]'; break;
case("h1"): if(clarify_intag($balise,":h]"))$balise=$br.'['.$balise.':h]'.$br; break;
case("h2"): if(clarify_intag($balise,":b]"))$balise=$br.'['.$balise.':h]'.$br; break;
case("h3"): if(clarify_intag($balise,":b]"))$balise=$br.'['.$balise.':h]'.$br; break;
case("h4"): if(clarify_intag($balise,":b]"))$balise=$br.'['.$balise.':h4]'.$br; break;
case("h5"): if(clarify_intag($balise,":b]"))$balise=$br.'['.$balise.':b]'.$br; break;
case("i"): if(clarify_intag($balise,":i]"))$balise='['.$balise.':i]'; break;
case("b"): if(clarify_intag($balise,":b]"))$balise='['.$balise.':b]'; break;
case("u"): if(clarify_intag($balise,":u]"))$balise='['.$balise.':u]'; break;
case("li"): $balise.=$br.$br; break;//$balise='['.$balise.':li]';
case("ul"): $balise=$br.'['.$balise.':list]'.$br; break;
case("ol"): $balise=$br.'['.$balise.':numlist]'.$br; break;
case("strike"): $balise='['.$balise.':k]'; break;
case("sup"): $balise=' ['.$balise.':e]'; break;
case("red"): $balise=' ['.$balise.':r]'; break;
case("pre"): $balise=' ['.$balise.':pre]'; break;
case("code"): $balise=' ['.$balise.':code]'; break;
//case("hr"): $tagb="[--]"; break;
case("span"): $balise=dico($aa_inner,$balise); break;
case("div"): $taga=$br; $tagb=$br;
	if(strpos($aa_inner,'class="notes')!==false){$taga="["; $tagb=":q]";} 
	//if(strpos($aa_inner,"spip_doc_descriptif")!==false){$taga="["; $tagb=":q]";}
	break;
case("param"): if($_POST["objects"])$balise='<'.$aa_inner.'>';
	elseif(strpos($aa_inner,'soundFile'))$balise=piege_mp3_b64($aa_inner); break;
case("object"): $taga=$br; $tagb=$br; if($_POST["objects"])$balise='<object '.correct_widths($aa_inner).'>'.$balise.'</object>';
elseif(strpos($balise,"<embed")===false && strpos($balise,"[")===false){
	if(strpos($balise,".flv")!==false or strpos($balise,".mp")!==false)
		$balise=piegemedia($balise);
	elseif(strpos($aa_inner,".flv")!==false or strpos($aa_inner,".mp")!==false)
		$balise=piegemedia($aa_inner);
	elseif(strpos($aa_inner,'dailymotion')!==false)$balise=piege_daily($aa_inner);
	elseif(strpos($aa_inner,'youtube')!==false)$balise=piege_utube($aa_inner);} break;
case("embed"): $taga=$br; $tagb=$br;
if($_POST["objects"]){$balise='<'.correct_widths($aa_inner).'>';}
else{
	if(strpos($aa_inner,'dailymotion')!==false)$balise=piege_daily($aa_inner);
	elseif(strpos($aa_inner,'youtube')!==false)$balise=piege_utube($aa_inner);
	elseif(strpos($aa_inner,'rutube')!==false)$balise=piege_rutube($aa_inner);
	elseif(stristr($aa_inner,".flv")!==false or stristr($aa_inner,".mp")!==false)
		$balise=piegemedia($aa_inner);
	else $balise='<'.correct_widths($aa_inner).'>';} break; //<'.$bb_balise.'>
case("iframe"):
	if(strpos($aa_inner,'youtube.com')!==false){$d=trap_v_id($aa_inner,'embed/');
		if(!$d)$d=embed_detect($aa_inner,'/v/','&'); $balise='['.$d.':video]';}
	elseif(strpos($aa_inner,'dailymotion.com')!==false)$balise=piege_daily($aa_inner);
	elseif(strpos($aa_inner,'vimeo.com')!==false){
		$d=trap_v_id($aa_inner,'video/'); $balise='['.$d.':video]';}
	/*elseif(strpos($aa_inner,'vk.com')!==false){
		$d=trap_v_id($aa_inner,'oid='); $balise='['.$d.':video]';}*/
	else $balise='['.embed_detect($aa_inner,'src="','"').$sz.':iframe]'; break;
case("center"): $taga=$tagb=$br; break;//$balise=' ['.$balise.':center]';
case("p"): $taga=$tagb=$br; break;
case("dt"): $taga=$tagb=$br; break;
case("br"): if($_POST["nobr"]=="ok")$taga=$br; $tagb=$br; break;//
case("blockquote"):$taga="["; $tagb=":q]"; break;
case("dir"): $taga="["; $tagb=":q]"; break;}
return array($taga,$balise,$tagb);}

function balise_converter_style($balise,$aa_inner){$bse=strtolower($aa_inner);
if(strpos($bse,"bold")!==false && clarify_intag($balise,":b]"))$balise="[".$balise.":b]";
if(strpos($bse,"italic")!==false && clarify_intag($balise,":i]"))$balise="[".$balise.":i]";
if(strpos($bse,"underline")!==false && clarify_intag($balise,":u]"))
	$balise="[".$balise.":u]";
if(strpos($bse,"background-color")!==false && clarify_intag($balise,":s]"))
	$balise="[".$balise.":s]";
elseif((strpos($bse,"color:#ff0000")!==false or strpos($bse,"red")!==false or strpos($bse,"rgb(255,0,0)")!==false) && clarify_intag($balise,":c]"))$balise='['.$balise.':c]';
if(strpos($bse,"line-through;")!==false)$balise='['.$balise.':k]';
if(strpos($bse,"spip_doc_descriptif")!==false)$balise='['.$balise.':q]';
if(strpos($bse,"margin-left")!==false)$balise='['.$balise.':q]';
return $balise;}

function recursearch($v,$ab,$ba,$aa_balise){//pousse si autre balise similaire
$bb=strpos($v,">",$ba); $balise=ecart($v,$ab,$ba); 
if(strpos($balise,'<'.$aa_balise)!==false){$bab=strpos($v,'</'.$aa_balise,$ba+1);
	if($bab!==false)$ba=recursearch($v,$bb,$bab,$aa_balise);}
return $ba;}

function recursearch_b($v,$ab,$ba,$aa_balise){//réactualise le nombre de balises
$balise=ecart($v,$ab,$ba);
$nb_aa=substr_count($balise,'<'.$aa_balise);
$nb_bb=substr_count($balise,'</'.$aa_balise);
$nb=$nb_aa-$nb_bb;
if($nb>0){for($i=0;$i<$nb;$i++){$ba=strpos($v,'</'.$aa_balise,$ba+1);}
	$ba=recursearch_b($v,$ab,$ba,$aa_balise);}
return $ba;}

function embed_detect_c($v,$aa_inner){//balise entière
	$aa_end=strpos($aa_inner," ");
	if($aa_end!==false)$aa_balise=substr($aa_inner,1,$aa_end-1);
	else $aa_balise=strip_tags($aa_inner);
$aa=strpos($v,$aa_inner); 
if($aa===false){$vb=str_replace("\n",' ',$v); $aa=strpos($vb,$aa_inner);}
$ab=strpos($v,'>',$aa); $ba=strpos($v,'</'.$aa_balise.'>',$ab); 
$balise=ecart($v,$ab,$ba);
$aab=strpos($v,'<'.$aa_balise,$ab);
if($aab!==false){
	$ba=recursearch_b($v,$ab,$ba,$aa_balise);
	$balise=ecart($v,$ab,$ba);}
return $balise;}

//$before <$aa_balise> $balise </$bb_balise> $after
function interpret_html($v,$X){
$aa=strpos($v,"<"); $ab=strpos($v,">");//aa_balise 
if($aa!==false && $ab!==false && $ab>$aa){
$before=substr($v,0,$aa);//...<
$aa_inner=ecart($v,$aa,$ab);//<...>
	$aa_end=strpos($aa_inner," ");
	if($aa_end!==false){$aa_balise=substr($aa_inner,0,$aa_end);}
	else $aa_balise=$aa_inner;}
//else $before=$v;
$ba=strpos($v,'</'.$aa_balise,$ab); $bb=strpos($v,">",$ba);//bb_balise
if($ba!==false && $bb!==false && $aa_balise!="" && $bb>$ba){ 
	$ba=recursearch($v,$ab,$ba,$aa_balise);//recursearch
	$bb=strpos($v,">",$ba);
	$bb_balise=ecart($v,$ba,$bb);
	$balise=ecart($v,$ab,$ba);}
elseif($ab!==false)$bb=$ab;
else{$bb=-1;}
$after=substr($v,$bb+1);//>...
//ok,go
$aa_balise=strtolower($aa_balise); $bb_balise=strtolower($bb_balise);
if($aa_balise=="head" or $aa_balise=="style" or $aa_balise=="script")$balise="";
if($_POST["see"]){static $i; $i++; echo $i.' :: '.$aa_balise.'=>'.$bb_balise.' - ';}
//itération
if(strpos($balise,'<')!==false)$balise=interpret_html($balise,$X);//""//100909
if($X!="ok"){//else interdit l'imbrication
	if($aa_balise=='pagespeed_iframe')$aa_balise='iframe';//patch
	$ret=balise_converter($aa_balise,$aa_inner,$bb_balise,$balise);
	if($ret[1]==$balise)$ret[1]=balise_converter_style($balise,$aa_inner);
	if($ret[1]!=$balise)$balise=$ret[1];
	$taga.=$ret[0]; $tagb.=$ret[2];}
//sequential
if(strpos($after,'<')!==false)$after=interpret_html($after,$X);
$ret=$before.$taga.$balise.$tagb.$after;
return $ret;}

?>