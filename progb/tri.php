<?php
//philum_tri

#filters
//normalize
function eradic_acc($d){
$a='àáâãäçèééêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ';
$b='aaaaaceeeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY';
return strtr($d,$a,$b);}

function hardurl($d){$d=eradic_acc($d); $d=strtolower($d); $d=str_replace("&nbsp;",' ',$d);
$d=str_replace(['/','«','»',',','.',';',':','!','?','§','%','&','$','#','_','+','=','\n','\\','~','(',')','[',']','{','}'],'',$d);
$d=str_replace([' ',"'",'"'],'-',trim($d));
$d=preg_replace('/(-){2,}/','-',$d);
return $d;}

function protect_url($d,$o=''){
if($o)$r=[['--','__','_','(t)','(u)'],['(t)','(u)',' ','-','_']];
else $r=[['-','_',' ','(t)','(u)'],['(t)','(u)','_','--','__']];
return str_replace($r[0],$r[1],$d);}

function protect_utf($d){$bad=["\xe2\x80\x98","\xe2\x80\x99","\xe2\x80\x9c","\xe2\x80\x9d","\xe2\x80\x94","\xe2\x80\xa6"];//’‘“”–
$fixed=["&#8216;","&#8217;",'&#8220;','&#8221;','&mdash;','&#8230;'];
return str_replace($bad,$fixed,$d);}

function repair_latin($d){//signes %u non utf8_decodés//proviennent de htmlentitydecode non iso
return str_replace(["Å“"],["&#339;"],$d);}

//enc
function utf8_encode_a($d){
$d=str_replace('Â§','§',$d); //$d=ascii2utf8($d);//$d=utf8_encode($d);//$d=any2utf8($d,'ISO-8859-1');
return $d;}
function utf8_encode_b($d){
//if(ses('enc')=='utf-8')return utf8_encode_a($d); else
return ascii2utf8($d);}

function utf8_decode_a($d){
$ra=["â€¢",'â€"',"Â–","â€“","â€”","â€¦","â€˜","’Ã»","’Ã©","’Ã¨","’Ãª","Å“","â€¢",'â€œ',"â€","â€™","â€‰","Âœ","â€¨","Â“","Â”","Ã¢",'Ã"','Â§','Â€"','Â€™','Ã%',"Å'","Ã‰","Ã©","Ã¨","Ã","à®","à§","àª","à´",'â€&#156;','â€&#157;','à«','Â«','Â»','â€~','Ã‡','à‡','Ã‚Â£'];//,'Å½','Å¾',"€"//euro is used by mb_
$rb=["-","-","-","-","-","...","'","û","é","è","ê","&#339;","•",'"','"',"'"," ","&#339;",'','"','"','â','è','§','-',"'",'É',"Œ","É","é","è","à","î","ç","ê","ô",'"','"','ë','"','"',"'",'Ç','ç','£'];//,'&#381;','&#382;',"&euro;"
return str_replace($ra,$rb,$d);}//return utf8_decode($d);

function utf8_decode_b($d){
$d=utf82ascii($d);
//$d=utf8_decode_a($d);
return html_entity_decode_b($d);}

function ascii2utf8($d){return html_entity_decode(mb_convert_encoding($d,'UTF-8','HTML-ENTITIES'));}
function utf82ascii($d){return html_entity_decode(mb_convert_encoding($d,'HTML-ENTITIES','UTF-8'));}//kill euro
function utf82ascii2($d){return html_entity_decode(mb_convert_encoding($d,'ASCII','UTF-8'));}
function utf82ascii3($d){return mb_convert_encoding($d,'HTML-ENTITIES','UTF-8');}
function iso2ascii($d){return html_entity_decode(mb_convert_encoding($d,'HTML-ENTITIES','ISO-8859-1'));}//euro
function txt2ascii($d,$o=''){$d=html_entity_decode_b($d); return $o?utf82ascii($d):iso2ascii($d);}
//$d=any2utf8($d,detect_enc($d));
function detect_enc($d){return mb_detect_encoding($d,'UTF-8,ISO-8859-1',true);}
function any2utf8($d,$enc){return mb_convert_encoding($d,'UTF-8',$enc);}
function iconvutf8($d){return iconv('CP1257','UTF-8',$d);}
//function utfb($d){return $_SESSION['enc']=='utf-8'?utf8_decode($d):$d;}//
//function utfc($d){return mb_detect_encoding($d)=='UTF-8'?utf8_decode($d):$d;}//
//function is_utf($d){return preg_match('!!u',$d)?'utf-8':'';}
function is_utf($d){return strpos($d,'Ã')||strpos($d,'â€')||strpos($d,'Ð');}
/*function findcharset($f){$d=get_file($f); if(!$d)return; $d=strtolower($d);
return embed_detect($d,'charset=','"');}*/

function html_entity_decode_b($v){$v=str_replace("&amp;",'&',$v);
return str_replace(["&nbsp;","&ndash;","&mdash;","%27","&#8216;","&#8217;","&#174;","&#175;","&#171;","&#187;","&#8211;","&#8220;","&#8221;","&quot;","&#8230;","&#8212;","&eacute;","&agrave;","&#287;","&#305;","&#304;","&#8617;","&#147;","&#148;","e&#768;","a&#768;","e&#769;","e&#770;","&#176;","&rsquo;","&#39;","&#8239;","&#8206;","&#8201;","&hellip;","&bdquo;","&ldquo;","&lsquo;","&rsquo;","&#8203;","&#039;","&thinsp;","&ensp;","&emsp;","&#160;","&#8194;","&#8195;","&#8201;","&#8208;","&#750;","&acute;","&rdquo;",'&#xFFFD;',"&#8200;",'&#137;','&#128;','&#153;','&#156;','&#159;','&#135;','&#152;','&pound;','&#2013265929;'],[' ','-','-',"'","'","'",'«','»','«','»','-','"','"','...','','-','é','à','g','i','I','','"','"','è','à','é','ê','°',"'","'",' ',' ',' ','...','"','"',"'","'",'',"'",' ',' ',' ',' ',' ',' ',' ','-','"',"'",'"',"'",' ','%','€','™','œ','Ÿ','‡','~','£','é'],$v);}

function specialspace($d){//&#3647;//bitcoin
$r=["&nbsp;","&thinsp;","&ensp;","&emsp;","&#8200;","&#8239;"];
foreach($r as $k=>$v)$d=str_replace(html_entity_decode($v),' ',$d);
return $d;}

function addnbsp($d){
$d=str_replace(" ?","&nbsp;?",$d);
$d=str_replace(" !","&nbsp;?",$d);
$d=str_replace("« ","«&nbsp;",$d);
$d=str_replace(" »","&nbsp;»",$d);
return $d;}

function decode_unicode($d){$n=strlen($d);//%u
if(strpos($d,'%u')===false)return $d; $ret='';
for($i=0;$i<$n;$i++){$c=substr($d,$i,1);
if($c=='%'){$i++; $cb=substr($d,$i,1);
	if($cb=='u'){$i++; $cc=substr($d,$i,4); $i+=3; $ret.='&#'.hexdec($cc).';';}
	else $ret.=$c.$cb;}
else $ret.=substr($d,$i,1);}
return $ret;}

function unicode2($d){return preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/',function($match){return mb_convert_encoding(pack('H*',$match[1]),'UTF-8','UCS-2BE');},$d);}

function utflatindecode($d){
$ra=["%u201C","%u201D","%u2019","%u2026","%u0153","%u20AC","%u2013","%u2022"];
$rb=['"','"',"'","...","&#339;","€","-","•"];//oe
return str_replace($ra,$rb,$d);}

function urlenc($d,$o=''){//urlencode(utf8_encode($d))
$ra=["à","â","é","è","ê","ë","î","ï","ô","ö","û","ü","ù","’","'"];
$rb=["%C3%A0","%C3%A2","%C3%A9","%C3%A8","%C3%AA","%C3%AB","%C3%AE","%C3%AF","%C3%B4","%C3%B6","%C3%BB","%C3%BC","%C3%B9","%E2%80%99",'%E2%80%99'];
if($o)return str_replace($rb,$ra,$d); else return str_replace($ra,$rb,$d);}

function normalize($d,$rb=[]){
$ra=[' ','&nbsp;',"'",'"','-','/',',',';',':','§','%','&','$','#','_','+','=','!','?','\n','\r','\\','~','(',')','[',']','{','}','«','»'];
$d=str_replace(array_diff($ra,$rb),'',($d));//,'.'
$d=str_replace(['.JPG','.JPEG','.jpeg','.GIF','.PNG'],['.jpg','.jpg','.jpg','.gif','.png'],$d);
$d=eradic_acc($d);
return $d;}

function entities($d){return htmlentities($d,ENT_QUOTES,$_SESSION['enc']);}
function htmlentities_b($d){return str_replace(['&','<','>'],['&amp;',"&lt;","&gt;"],$d);}
function hooks($d,$o=''){$ra=['[',']','{','}']; $rb=['(hka)','(hkb)','(aca)','(acb)']; 
return $o?str_replace($rb,$ra,$d):str_replace($ra,$rb,$d);}
function strip_tags_b($d){return preg_replace('/<[^>]*>/',' ',$d);}

function clean_acc($v){//html_entity_decode_b
$ra=["’","‘",'“','”',"…","–","¨","â€™","\t"];//"<o:p>","</o:p>",'https',
$rb=["'","'",'"','"',"...","-",'"',"'",''];//'<!--','-->',"","",'http',
return str_replace($ra,$rb,$v);}

function clean_punct($d,$o=''){$d=clean_acc($d); if($o)$d=clean_punct_b($d); if($o==2)$d=clean_punct_c($d);
$ra=[' )','( ',' ,',' .',' ;',' :',' !',' ?','« ',' »','0 0','<<','>>'];
$rb=[')','(',',','.',"&nbsp;;","&nbsp;:","&nbsp;!","&nbsp;?",'«'."&nbsp;","&nbsp;".'»','0&nbsp;0','"','"'];
return str_replace($ra,$rb,$d);}

//strings
function embed_p($d){
$d=str_replace("\n\n</","</",$d); $r=explode("\n\n",$d); $ret='';
$ex='<h1<h2<h3<h4<h5<br<hr<bl<pr<di<if<fi';//<a <ob<sv<sp<bi<li<im<ta<ol<ul
foreach($r as $k=>$v){if($v=trim($v)){$cn=substr($v,0,3);
	if(strpos($ex,$cn)!==false)$ret.=$v; else $ret.='<p>'.($v).'</p>';}}
//$ret=str_replace('<p></p>','',$ret);
return $ret;}

function clean_punct_b($v){//del space after first and before last "
$nbc=substr_count($v,'"'); if($nbc%2)return $v;
$r=str_split($v); $n=count($r); $ia=2;
for($i=0;$i<$n;$i++){if(val($r,$i)=='"'){$ia=$ia==2?1:2;
	if($ia==1 && val($r,$i+1)==' ')unset($r[$i+1]);
	if($ia==2 && val($r,$i-1)==' ')unset($r[$i-1]);}}
if($r)return implode('',$r);}

function clean_punct_c($d){return str_replace("' ","'",$d);}
function clean_q($d){return str_replace(['«','»'],['"','"'],$d);}

function cleanmail($d){
$d=clean_prespace($d);
$d=str_replace("M.\n",'M. ',$d);
$d=str_replace(".\n",'.µµ',$d);
$d=str_replace("\n",'µ',$d);
$d=str_replace('µµ',"\n\n",$d);
$d=str_replace('µ',' ',$d);
return $d;}

function lowercase($v){$v=html_entity_decode($v);
$nb=strlen($v); $y=0; $ret='';
$a='ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'; $b='àáâãäçèéêëìíîïñòóôõöùúûüý';
for($i=0;$i<$nb;$i++){$k=substr($v,$i,1);
	if($y==0)$ret.=$k;
	else{$k=strtolower($k); $k=strtr($k,$a,$b); $ret.=$k;}
	if($k==' ' or $k=="&nbsp;" or $k=="'" or $k=='"' or $k=='«' or $k=='-' or $k=='[' or $k=='(')
		$y=0; else $y=1;}
return $ret;}

function delconn($d){return codeline::parse($d,'','delconn');}

//strings
function count_occurrences($msg,$d){$ret=0;
$ra=[' ',"'",'(','[','-','"',"&nbsp;"]; $rb=[' ',',','.',')','§',':',']','"',"&nbsp;"];
foreach($ra as $k=>$v)foreach($rb as $ka=>$va)$ret+=substr_count($msg,$v.$d.$va);
return $ret;}

function detect_words($msg,$d,$sg=''){$rb=[];
if($sg)$msk="/\b".$d."\b/i"; else $msk='/('.$d.')/i';
$msk=str_replace(['[',']'],['\[','\]'],$msk);
preg_match_all($msk,($msg),$r,PREG_OFFSET_CAPTURE);//preg_quote
if($r)foreach($r as $k=>$v)foreach($v as $ka=>$va)$rb[$va[1]]=$va[0]; //p($rb);//kill doublons
return $rb;}

function embed_detect($v,$s,$e,$n=0){
$posa=strpos($v,$s); $posb=false; $n=$n?$n:0;
if($posa===false){return;}//$vb=str_replace("\n",' ',$v); $posa=strpos($vb,$s);
if($posa!==false){$ns=strlen($s); if(is_numeric($ns))$posa+=$ns; $posa+=$n;
	$posb=strpos($v,$e,$posa);
	if($posb===false){$vb=str_replace("\n",' ',$v); $posb=strpos($vb,$e,$posa);}}
if($posb!==false)$ret=substr($v,$posa,$posb-$posa-$n); 
else $ret=substr($v,$posa);
return $ret;}

function prop_detect($v,$s){$posb=false;
$v=str_replace("'",'"',$v); $posa=strpos($v,$s.'="');
if($posa!==false){$posa+=strlen($s)+2; $posb=strpos($v,'"',$posa);}
if($posb!==false)return substr($v,$posa,$posb-$posa);}

//titles
function clean_title($d){$nb="&nbsp;";
//$d=htmlentities($d);//provoque erreur qui bloque save, sous utf8
$d=html_entity_decode_b($d);
$d=clean_acc($d);
$d=clean_punct_b($d);
if(rstr(104))$d=lowercase($d);
if(substr($d,-1)=='"')$d=substr($d,0,-1).$nb.'»';
if(substr($d,0,1)=='"')$d='«'.$nb.substr($d,1);
$d=str_replace(' "',' «'.$nb,$d);
$d=str_replace(['" ','"'],$nb.'» ',$d);
$d=delsp($d);
$d=clean_inclusive($d);
return trim($d);}

//correctors
function del_tables($v){
$d=codeline::parse($v,':table','correct'); 
$d=str_replace(['|','¬'],[' ',"\n"],$d);
$d=clean_br($d);//clean_prespace//repair_badn//
return $d;}

function del_qmark($v){//$v=html_entity_decode_b($v);
$r=explode("\n",$v); $n=count($r);
for($i=0;$i<$n;$i++){
	if(substr($r[$i],0,1)=='?')$r[$i]='- '.ltrim(substr($r[$i],1));
	$ret.=ltrim($r[$i])."\n";}
$ret=preg_replace("/(\?){2,}/",'',$ret);
$ret=preg_replace('/( ){2,}/',' ',$ret);
return $ret;}

function correct_widths($v){$width=prma('content');
$goodw=$width?$width:580; $goodh=round($goodw/(16/9));
$v=preg_replace('/width=\"(\d+)\"/','width="'.$goodw.'"',$v);
return preg_replace('/height=\"(\d+)\"/','height="'.$goodh.'"',$v);}

function conn_ref_in(){
return ['',':h1',':h2',':h3',':h4',':h',':h4','h5',':c',':b',':u',':i',':s',':k',':e',':q',':w',':red',':stabilo',':pre',':code',':nh',':nb',':list',':numlist',':table',':right',':center',':p'];}//':video',':iframe',':pub',':read',':import',':photo',':radio',':rech',':form',':chat',':css',':block',':module',':ajax',':image',':console',':php',':web',':plug',':petition',':umcom',':msql',
function conn_ref(){return array_keys(msql_read('system','connectors_all',''));}
function conn_ref_out(){return sesmk('conn_ref','',0);}

function stripconn($d,$o=''){
$conn=conn_ref_in();
$d=str_replace($conn,'',$d);
$d=str_replace(['[',']','¬','|','§'],' ',$d);
$d=delnl($d);
return $d;}

#cut_words
function verif_cut($karmax,$msg){$va='['; $vb=']'; 
$newnb=$karmax+strpos(substr($msg,$karmax),'<br>');
$until=strpos(substr($msg,$newnb),$vb);
if(substr_count(substr($msg,0,$newnb),$va)>substr_count(substr($msg,0,$newnb),$vb))$newnb+=$until;
return substr($msg,0,$newnb);}

function kmax_nb($kmx,$msg){
$poa=strpos(substr($msg,$kmx),'. ');
$pob=strpos(substr($msg,$kmx),"\n"); $pos=$poa<$pob?$poa+1:$pob;
if($pos!==false){$kmx+=$pos;}
$deb=substr_count(substr($msg,0,$kmx),'[');
$end=substr_count(substr($msg,0,$kmx),']');
if($deb>$end){$dif=$deb-$end;
	for($i=0;$i<$dif;$i++){
		$kmx+=strpos(substr($msg,$kmx),']')+1;
		$debb=substr_count(substr($msg,0,$kmx),'[');
		if($debb>$deb)$dif=($debb-$end);}}
return $kmx;}

function kmax($msg){
$kmx=kmax_nb($_SESSION['prmb'][3],$msg);
return substr($msg,0,$kmx);}

function firstlines($d){$r=explode("\n",$d); $rb=[];
foreach($r as $k=>$v)if(count($rb)<7 && trim($v)){
	$vb=substr($v,0,60); if(substr($v,60))$vb.='...';
	if(strlen($vb)>20)$rb[]=$vb;}
if($rb)return implode("\n",$rb);}

//links
function embed_links($msg){//oldest_function!
$msg=str_replace("\n",' µµ ',$msg); $ra=explode(' ',$msg); $r=[];
foreach($ra as $k=>$v){$a=''; $b='';
	if(substr($v,0,1)=='('){$a='('; $v=substr($v,1);}
	if(substr($v,0,1)=='-'){$a='-'; $v=substr($v,1);}
	if(substr($v,-1)=='.'){$b='.'; $v=substr($v,0,-1);}
	if(substr($v,-1)==','){$b=','; $v=substr($v,0,-1);}
	if(substr($v,-1)==')'){$b=')'.$b; $v=substr($v,0,-1);}
	if(substr($v,0,2)=='//' && strpos($v,'.'))$r[]='[http:'.$v.']';
	elseif(substr($v,0,4)=='http' && strpos($v,'[')===false)$r[]='['.$v.']';
	elseif(is_image($v) && strlen($v)>4 && strpos($v,'[')===false)$r[]='['.$v.']';
	//elseif(strpos($v,'@')!==false && strpos($v,']')===false)$r[]='['.$v.']';
	else $r[]=$a.$v.$b;}
$d=implode(' ',$r);
$d=str_replace([' µµ ','µµ'],"\n",$d);
$d=str_replace(',]','],',$d); //$d=str_replace('.]','].',$d);
$d=str_replace("\n]","]\n",$d);
//$d=str_replace('([','[(',$d);
//$d=str_replace('])',')]',$d);
return $d;}

#repairs
function clean_internaltag($msg,$o=''){$ret='';
//return codeline::parse($msg,'','delconn');
$msg=str_replace("\n","\n ",delbr($msg,"\n"));
$re=explode(' ',$msg); foreach($re as $k)
	if(strpos($k,'§')!==false){list($lin,$txt)=explode('§',$k); $ret.=$lin.' '.$txt.' ';}
	else $ret.=$k.' ';
$msg=str_replace(" \n","\n",$msg);
return stripconn($ret,$o);}

function antipirat($t){$re=explode("[-./_ ]",$t); $ratio=1.5; //nb_identical_words
foreach($re as $k){$ter[$k]+=1;}
if(count($ter)>count($re)/$ratio){return $t;}}

//del twitter things
function clean_tw($d,$o=''){
$d=codeline::parse($d,'','striptw');
$d=str_replace("\n",' ## ',$d); if(!$d)return;
$r=explode(' ',$d);
if($r)foreach($r as $k=>$v){
	if(substr($v,0,1)!='@')$rb[$k]=trim($v);}
if($rb)$d=implode(' ',$rb);
$d=str_replace(' ## ',"\n",$d);
$d=delnl($d);
$d=clean_br(trim($d));
return trim($d);}

function stupid_acc($d){$d=str_replace(['<!--[if IE]>','<!--[if IE 9]>','<!--[if !IE]>','<!--<![endif]-->','<![endif]-->','<!-->'],'',$d);//,'<!--'
$ra=["a`","a^","A`","e´","e`","e^","e¨","o^","i^","E´","´´","´","`",'<<','>>'];//,"é",'->','=>'
$rb=["à","â","A","é","è","ê","ë","ô","î","E",'"',"'","'",'«'.sep(),sep().'»'];//,"é","&rarr;","&rArr;"
return str_replace($ra,$rb,$d);}

function antipuces($v){
if(forbidden_img($v)!==false && strpos($v,'puce')===false)return $v;}

function clean_spaces($d){
$d=specialspace($d);
$d=delnl($d);
return $d;}

function clean_html($d,$o=''){
$d=clean_spaces($d);
$d=clean_acc($d);
$d=stupid_acc($d);
$d=html_entity_decode_b($d);//create pb
//$d=html_entity_decode($d);
$r=['b','i','em','strong','p'];
for($i=0;$i<4;$i++){
	$d=str_replace('<'.$r[$i].'> </'.$r[$i].'>',' ',$d);
	$d=str_replace('</'.$r[$i].'><'.$r[$i].'>','',$d);
	$d=str_replace('</'.$r[$i].'> <'.$r[$i].'>',' ',$d);
	$d=str_replace('</'.$r[$i].'>'."\n".'<'.$r[$i].'>',"\n",$d);
	$d=str_replace('</'.$r[$i].'>'."\n\n".'<'.$r[$i].'>',"\n\n",$d);}
if(!$o && substr_count($d,']')!=substr_count($d,'['))//
	$d=str_replace(['[',']'],['(',')'],$d);
//$reb=htmlspecialchars($reb);
return $d;}

function clean_balb($d){$r=['b','i','u','p'];
foreach($r as $k=>$v)$d=str_replace('<'.$v.'></'.$v.'>','',$d);
return $d;}

function del_n($d){$d=clean_prespace($d);
return str_replace(["\r","\n",'<br>','</br>','<br/>','<br />'],' ',$d);}

function clean_lines($d){$r=explode("\n",$d);
foreach($r as $v)$rb[]=trim($v);
return implode("\n",$rb);}

function clean_prespace($d){
$d=str_replace("\t",'',$d);
//$d=str_replace("\r","\n",$d);
$d=specialspace($d);
$d=str_replace("\n ","\n",$d);
$d=str_replace(" \n","\n",$d);
if(rstr(9)){
	$d=str_replace(".jpg]\n",".jpg]",$d);
	$d=str_replace(".gif]\n",".gif]",$d);
	$d=str_replace(".png]\n",".png]",$d);}
$d=str_replace("[--]\n","\n[--]",$d);
$d=delnl($d);
$d=clean_lines($d);
return $d;}

function clean_n($d){
$d=str_replace("\r","\n",$d);
$d=preg_replace('/( ){2,}/',' ',"\n",$d);
$d=preg_replace('/(\n){2,}/',"\n\n",$d);
return $d;}

function clean_br_lite($d){
$d=str_replace("\n",'µ',$d);
$d=str_replace("\r",'µ',$d);
$d=preg_replace("/(µ){2,}/",'µµ',$d);
if(substr($d,0,1)=='µ')$d=substr($d,1);
if(substr($d,0,1)=='µ')$d=substr($d,1);
if(substr($d,-1)=='µ')$d=substr($d,0,-1);
$d=str_replace('µ',"\n",$d);
$d=delnl($d);
return trim($d);}

function clean_br($d){
$d=preg_replace("/(\r\n)|(\n\r)|(\r)/","\n",$d);
$d=preg_replace('/(\n){2,}/',"\n\n",$d);
$d=clean_prespace($d);
$d=repair_badn($d);
$d=repair_badn($d);
//$d=repair_tags($d);
$r=conn_ref_out();
foreach($r as $k=>$v)$d=str_replace("\n".$v.']',$v.']',$d);
//$d=preg_replace("/(\r){2,}/","\r\r",$d);
$d=clean_br_lite($d);
//$d=clean_inclusive($d);
//$d=addnbsp($d);
return $d;}

function br_rules($d){
$d=str_replace(["\r","\n"],' ',$d);
$d=str_replace(['<br />','<br/>','</br>','<br>','<BR>'],"\n",$d);
//if(post('nobr')=='ok')$d=str_replace("\n","\n\n",$d);
//"<br />\n","\n<br />","<br>\n","\n<br>",
return $d;}

function clean_tables($d){
$d=str_replace("\r",'',$d);
$arr=["|\n","\n|","\n¬","¬\n",'¬:','¬ :'];
$arb=['|','|','¬','¬',':',':'];
return str_replace($arr,$arb,$d);}

function clean_inclusive($d){
$d=str_replace(['·','•','&bull;'],'-',$d);//
$ra=['-elle','-les','-e-s','-es-','-ne-','-te-','-nes','-es','-ne','-tes','-s','f-ves','(-)elle','(-)les','tous-toutes','ils-elles','eux-elles'];
$rb=['(-)elle','(-)les','s','','','','s','','','s','s','fs','-elle','-les','tous','ils','eux'];
$d=str_replace($ra,$rb,$d);
$ra=['.e.','.nes','.es','.ne','.e','.tes','f.ves','r.ses','.s'];
$rb=['','s','','','','s','fs','rs','s'];
$d=str_replace($ra,$rb,$d);
$ra=['(e)','(ne)']; $rb=['',''];
return str_replace($ra,$rb,$d);}

function repair_tags($d){
$arr=['| ¬','|¬','¬ ¬','¬ ]','¬]','[¬]',"[\n]",'[]',"\n:list]",'|:','¬:',"\n "];
$arb=['¬','¬','¬',']',']','','','',':list]',':',':',"\n"];
$d=str_replace($arr,$arb,$d);
$r=conn_ref_in();
foreach($r as $k=>$v){
	$d=str_replace(' '.$v.']',$v.'] ',$d);
	$d=str_replace('['."&nbsp;".$v.']','',$d);
	$d=str_replace('[ '.$v.']','',$d);
	$d=str_replace('['.$v.']','',$d);
	$d=str_replace('[.'.$v.']','.',$d);
	//$d=str_replace($v.']]',']'.$v.']',$d);
	$d=str_replace("\n".$v.']',$v.']'."\n",$d);}
if(rstr(9))$d=str_replace(".jpg]\n",'.jpg]',$d);
return $d;}

function add_comments($d){$r=explode("\n",$d); $ret='';
foreach($r as $k=>$v){$pos=strpos($v,'.jpg]');
if($pos!==false && substr($v,-1)!='.'){$t=trim(substr($v,$pos+5));
	if($t && strpos($t,'.jpg]')===false && strpos($t,':label')===false)
		$ret.=substr($v,0,$pos+5).'['.$t.':label]'."\n"; else $ret.=$v."\n";}
else $ret.=$v."\n";}
return $ret;}

function add_lines($d){
return clean_br(str_replace(['. ',".\n"],".\n\n",$d));}

function clean_list($d,$o){$ret=str_replace($o."\n",'(n)',$d);//
if(strpos($ret,"\n")!==false)return $d; else return str_replace('(n)',"\n",$d);}

function add_cols($d){return str_replace('|','(bar)',trim($d)).'|';}

function clean_pdf($s){$d=cleanmail($d); $d=clean_br($d); $d=add_lines($d); return $d;}

function stripslashes_r($r){
foreach($r as $k=>$v)$r[$k]=str_replace('\"','"',$v);
return $r;}

//footnotes
function add_anchors($d){
for($i=1;$i<200;$i++){
$types=['[['.$i.']:b]','[['.$i.']:i]','[['.$i.']]','['.$i.']','['.$i.'.]','['.$i.':e]',"\n".$i.'.'];//'|'.$i.'|'//bug table2array
$d=str_replace($types,'('.$i.')',$d);}
for($i=1;$i<200;$i++){
	$no=strpos($d,$i.':n'); $fnd='('.$i.')'; $sp=strrpos($d,$fnd);
	if($no===false){$end=str_replace($fnd,'(['.$i.':nb])',substr($d,$sp));
		$d=str_replace($fnd,'(['.$i.':nh])',substr($d,0,$sp)).$end;}}
$r=explode(':numlist]',$d); $n=count($r);
if($n>1){$d=''; for($i=0;$i<$n;$i++)if($i==$n-2)$d.=codeline::parse($r[$i].':numlist]','','num2nb'); 
elseif($i<$n-2)$d.=$r[$i].':numlist]'; else $d.=$r[$i];}
return $d;}

#transductor
function repair_badn($d){//2 fois
$d=str_replace('µ','(micro)',$d);
$d=str_replace("\n",'µ',$d);
if(rstr(9))$d=str_replace('.jpg]µ','.jpg]',$d);
$ra=[' µ','µ.','µ ','[µ',':]','] .',' ]','[ ',' )','( '];
$rb=['µ','µ','µ','µ[',']:',']. ','] ',' [',')','('];
$d=str_replace($ra,$rb,$d);
$ra=['[µ[','µ:h]','µ:b]','µ:i]','µ:u]','µ:q]','§µ','§ ','-µ','.]'];
$rb=['µ[[',':h]µ',':b]µ',':i]µ',':u]µ',':q]µ','§','§','- ','].'];
$d=str_replace($ra,$rb,$d);
$d=str_replace('µ',"\n",$d);
$d=preg_replace('/(\n){2,}/',"\n\n",$d);
$d=str_replace('(micro)','µ',$d);
return $d;}

function post_treat_repair($d){
//$d=clean_lines($d);
$d=clean_prespace($d);
//$d=antipuces($d);
$d=repair_badn($d);
$d=repair_tags($d);
$d=utflatindecode($d);
$d=clean_acc($d);
//$d=add_comments($d);
$d=clean_tables($d);
$d=clean_punct($d);
$d=clean_punct_b($d);
//$d=clean_html($d);
$d=delsp($d);
//trim($d);
return $d;}

//vacuum
function vacurl($f){$f=nohttp($f); return normalize($f);}// $f=strend($f,'/');
function vacses($f,$k='',$v=''){$u=vacurl($f);//v,t,d(data),c(cat),u(url),p(parent),b(brut)
if($v=='x' && $r=sesr('vac',$u)){sesrz('vac',$u); return val($r,$k);}
elseif($v){sesrr('vac',$u,[$k=>$v]); $_SESSION['vac'][$u]['u']=$f;}//pre_clean
return $_SESSION['vac'][$u][$k]??'';}
function vaccum_ses($f){$d=vacses($f,'b');//obso
if(strpos($d,'This page appears when Google'))return;
if(!$d){$d=get_file($f); vacses($f,'b',$d);}
return $d;}

function notintag($d,$t){
$balsansesp=preg_replace("/(\r)|(\n)|( )|(&nbsp;)/",'',$d); 
if(strpos($d,$t)===false && strpos($d,'.jpg]')===false && strpos($d,'.gif]')===false && strpos($d,'.png]')===false && $balsansesp)return true;}

function delhook($d){$d=trim($d);
if(substr($d,0,1)=='[')$d=substr($d,1);
if(substr($d,-1)==']')$d=substr($d,0,-1);
return $d;}

function urlroot($u){$h=get('urlsrc');
if($h==host() or substr($u,0,4)=='http')$h='';
if(substr($u,0,2)=='//')$h='https:';
if($h && substr($u,0,1)!='/')$u='/'.$u;
return $h.$u;}

function goodsrc($u){
if(substr($u,0,2)=='//')$u='http:'.$u;
if(substr($u,0,4)!='http'){
	$src=get('urlsrc');
	if(substr($u,0,1)!='/')$u='/'.$u;
	if($src)$u=$src.$u;}//'http://'.domain($src)
return $u;}

?>