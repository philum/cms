<?php //tri

#filters
function hardurl($d){$d=eradic_acc($d); $d=strtolower($d); $d=str_replace("&nbsp;",' ',$d);
$d=str_replace(['/','«','»',',','.',';',':','!','?','§','%','&','$','#','_','+','=','\n','\\','~','(',')','[',']','{','}'],'',$d);
$d=str_replace([' ',"'",'"'],'-',trim($d));
$d=preg_replace('/(-){2,}/','-',$d);
return $d;}

function protect_url($d,$o=''){
if($o)$r=[['--','__','_','(t)','(u)'],['(t)','(u)',' ','-','_']];
else $r=[['-','_',' ','(t)','(u)'],['(t)','(u)','_','--','__']];
if($d)return str_replace($r[0],$r[1],$d);}

/**/function repair_latin($d){//from htmlentitydecode non iso
return str_replace("Å“","&#339;",$d);}

#enc
function detect_enc($d){return mb_detect_encoding($d,'UTF-8,ISO-8859-1',true);}
function is_utf($d){return strpos($d,'Ã')||strpos($d,'â€')||strpos($d,'Ð')||strpos($d,'ã');}

function utf8_decode_a($d){
$ra=["â€¢",'â€"',"Â–","â€“","â€”","â€¦","â€˜","’Ã»","’Ã©","’Ã¨","’Ãª","Å“",
"â€¢",'â€œ',"â€","â€™","â€‰","Âœ","â€¨","Â“","Â”","Ã¢",'Ã"','Â§',
'Â€"','Â€™','Ã%',"Å'","Ã‰","Ã©","Ã¨","Ã","à®","à§","àª","à´",
'â€&#156;','â€&#157;','à«','Â«','Â»','â€~','Ã‡','à‡','Ã‚Â£'];//,'Å½','Å¾',"€"//euro is used by mb_
$rb=["-","-","-","-","-","...","'","û","é","è","ê","&#339;"
,"•",'"','"',"'"," ","&#339;",'','"','"','â','è','§',
'-',"'",'É',"Œ","É","é","è","à","î","ç","ê","ô",
'"','"','ë','"','"',"'",'Ç','ç','£'];//,'&#381;','&#382;',"&euro;"
return str_replace($ra,$rb,$d);}//return utf8_decode($d);

function html_entity_decode_b($v){$v=str_replace('&amp;','&',$v??'');//14
$ra=['&nbsp;','&ndash;','&mdash;',"%27",'&#8216;','&#8217;','&#174;','&#175;','&#171;','&#187;','&#8211;','&#8220;',
'&#8221;','&quot;','&#8230;','&#8212;','&eacute;','&agrave;','&#287;','&#305;','&#304;','&#8617;','&#147;','&#148;',
'e&#768;','a&#768;','e&#769;','e&#770;','&#176;','&rsquo;','&#39;','&#8239;','&#8206;','&#8201;','&hellip;','&bdquo;',
'&ldquo;','&lsquo;','&rsquo;','&#8203;','&#039;','&thinsp;','&ensp;','&emsp;','&#160;','&#8194;','&#8195;','&#8201;',
'&#8208;','&#750;','&acute;','&rdquo;','&#xFFFD;','&#8200;','&#137;','&#128;','&#153;','&#156;','&#159;','&#135;',
'&#152;','&pound;','&#2013265929;'];
$rb=[' ','-','-',"'","'","'",'«','»','«','»','-','"',
'"','"','','-','é','à','g','i','I','','"','"',
'è','à','é','ê','°',"'","'",' ',' ',' ','...','"',
'"',"'","'",'',"'",' ',' ',' ',' ',' ',' ',' ',
'-','"',"'",'"',"'",' ','%','€','™','œ','Ÿ','‡',
'~','£','é'];
return str_replace($ra,$rb,$v);}

function specialspace($d){//&#3647;//bitcoin
$r=["&nbsp;","&thinsp;","&ensp;","&emsp;","&#8200;","&#8239;"];
foreach($r as $k=>$v)$d=str_replace(html_entity_decode($v),' ',$d);
return $d;}

function decode_unicode($d){
if(!$d)return; $n=strlen($d);//%u
if(strpos($d,'%u')===false)return $d; $ret='';
for($i=0;$i<$n;$i++){$c=substr($d,$i,1);
if($c=='%'){$i++; $cb=substr($d,$i,1);
	if($cb=='u'){$i++; $cc=substr($d,$i,4); $i+=3; $ret.='&#'.hexdec($cc).';';}
	else $ret.=$c.$cb;}
else $ret.=substr($d,$i,1);}
return $ret;}

function utflatindecode($d){if(!$d)return;
$ra=["%u201C","%u201D","%u2019","%u2026","%u0153","%u20AC","%u2013","%u2022"];
$rb=['"','"',"'","...","&#339;","€","-","•"];//oe
return str_replace($ra,$rb,$d);}

function urlenc($d,$o=''){//urlencode(utf8_encode($d))
$ra=["à","â","é","è","ê","ë","î","ï","ô","ö","û","ü","ù","’","'"];
$rb=["%C3%A0","%C3%A2","%C3%A9","%C3%A8","%C3%AA","%C3%AB","%C3%AE","%C3%AF","%C3%B4","%C3%B6","%C3%BB","%C3%BC","%C3%B9","%E2%80%99",'%E2%80%99'];
if($o)return str_replace($rb,$ra,$d); else return str_replace($ra,$rb,$d);}

function htmlentities_a($d){return htmlentities($d,ENT_QUOTES,$_SESSION['enc']);}
function htmlentities_b($d){return str_replace(['&','<','>'],['&amp;',"&lt;","&gt;"],$d);}
function hooks($d,$o=''){$ra=['[',']','{','}']; $rb=['(hka)','(hkb)','(aca)','(acb)'];
return $o?str_replace($rb,$ra,$d):str_replace($ra,$rb,$d);}

function clean_acc($v){//html_entity_decode_b
$ra=["’","‘",'“','”',"…","–","¨","â€™","\t"];//"<o:p>","</o:p>",'https',
$rb=["'","'",'"','"',"...","-",'"',"'",''];//'<!--','-->',"","",'http',
if($v)return str_replace($ra,$rb,$v);}

function clean_punct($d,$o=''){if(!$d)return;
$d=clean_acc($d); if($o)$d=clean_punct_b($d); if($o==2)$d=clean_punct_c($d);
$ra=[' )','( ',' ,',' .',' ;',' :',' !',' ?','« ',' »','0 0','<<','>>'];
$rb=[')','(',',','.',"&nbsp;;","&nbsp;:","&nbsp;!","&nbsp;?",'«'."&nbsp;","&nbsp;".'»','0&nbsp;0','"','"'];
return str_replace($ra,$rb,$d);}

function clean_punct_b($v){if(!$v)return;//del space after first and before last " //"
$nbc=substr_count($v,'"'); if($nbc%2)return $v;
$r=str_split($v); $n=count($r); $ia=2;
for($i=0;$i<$n;$i++){if(val($r,$i)=='"'){$ia=$ia==2?1:2;
	if($ia==1 && val($r,$i+1)==' ')unset($r[$i+1]);
	if($ia==2 && val($r,$i-1)==' ')unset($r[$i-1]);}}
if($r)return implode('',$r);}

function clean_punct_c($d){return str_replace("' ","'",$d);}

function cleanmail($d){
$d=clean_prespace($d);
$d=str_replace("M.\n",'M. ',$d);
$d=str_replace(".\n",'.µµ',$d);
$d=str_replace("\n",'µ',$d);
$d=str_replace('µµ',"\n\n",$d);
$d=str_replace('µ',' ',$d);
return $d;}

function lowercase($v){if(!$v)return;
$v=html_entity_decode($v); $nb=strlen($v); $y=0; $ret='';
$a='ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'; $b='àáâãäçèéêëìíîïñòóôõöùúûüý';
for($i=0;$i<$nb;$i++){$k=substr($v,$i,1);
	if($y==0)$ret.=$k;
	else{$k=strtolower($k); $k=strtr($k,$a,$b); $ret.=$k;}
	if($k==' ' or $k=="&nbsp;" or $k=="'" or $k=='"' or $k=='«' or $k=='-' or $k=='[' or $k=='(')
		$y=0; else $y=1;}
return $ret;}

#detect
function detect_words($msg,$d,$sg=''){$rb=[]; $d=strend($d,'/');
if($sg)$msk="/\b".$d."\b/i"; else $msk='/('.$d.')/i';
$msk=str_replace(['[',']'],['\[','\]'],$msk);
preg_match_all($msk,$msg,$r,PREG_OFFSET_CAPTURE);//preg_quote
if($r)foreach($r as $k=>$v)foreach($v as $ka=>$va)$rb[$va[1]]=$va[0]; //p($rb);//kill doublons
return $rb;}

function embed_detect($v,$a,$b,$n=0){
$pa=strpos($v,$a); $pb=false; $n=$n?$n:0; if($pa===false)return;
else{$ns=strlen($a); $pa+=$ns; $pa+=$n; $pb=strpos($v,$b,$pa);
	if($pb===false){$vb=str_replace("\n",' ',$v); $pb=strpos($vb,$b,$pa);}}//used for defcons
if($pb!==false)$ret=substr($v,$pa,$pb-$pa-$n);
else $ret=substr($v,$pa);
return $ret;}

function prop_detect($d,$s){$pb=false;
if(strpos($d,"='"))$d=str_replace(["'=","' "],['"=','" '],$d); 
$pa=strpos($d,$s.'="');
if($pa!==false){$pa+=strlen($s)+2; $pb=strpos($d,'"',$pa);}
if($pb!==false)return substr($d,$pa,$pb-$pa);}

//titles
function clean_title($d){
if(!$d)return; $nb="&nbsp;";
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

#correctors
function stripconn($d,$o=''){
$conn=conn_ref_in();
$d=str_replace($conn,'',$d);
$d=str_replace(['[',']','¬','|','§'],' ',$d);
$d=delnl($d);
return $d;}

//links
function embed_links($msg=''){//oldest_function!//19
$msg=str_replace("\n",' µµ ',$msg); $ra=explode(' ',$msg); $r=[];
foreach($ra as $k=>$v){$a=''; $b='';
	if(substr($v,0,1)=='('){$a='('; $v=substr($v,1);}
	if(substr($v,0,1)=='-'){$a='-'; $v=substr($v,1);}
	if(substr($v,-1)=='.'){$b='.'; $v=substr($v,0,-1);}
	if(substr($v,-1)==','){$b=','; $v=substr($v,0,-1);}
	if(substr($v,-1)==')'){$b=')'.$b; $v=substr($v,0,-1);}
	if(substr($v,0,2)=='//' && strpos($v,'.'))$r[]='[http:'.$v.']';
	elseif(substr($v,0,4)=='http' && strpos($v,'[')===false){
		if(is_img($v) && strlen($v)>4)$r[]='['.$v.']';
		else $r[]='['.$v.']';}
	//elseif(strpos($v,'@')!==false && strpos($v,']')===false)$r[]='['.$v.']';
	else $r[]=$a.$v.$b;}
$d=implode(' ',$r);
$d=str_replace([' µµ ','µµ'],"\n",$d);
$d=str_replace(',]','],',$d); //$d=str_replace('.]','].',$d);
$d=str_replace("\n]","]\n",$d);
//$d=str_replace('([','[(',$d);
//$d=str_replace('])',')]',$d);
return $d;}

#cuts
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

#repairs
function clean_internaltag($msg,$o=''){$ret='';
//return codeline::parse($msg,'','delconn');
$msg=str_replace("\n","\n ",delbr($msg,"\n"));
$re=explode(' ',$msg); foreach($re as $k)
	if(strpos($k,'§')!==false){[$lin,$txt]=explode('§',$k); $ret.=$lin.' '.$txt.' ';}
	else $ret.=$k.' ';
$msg=str_replace(" \n","\n",$msg);
return stripconn($ret,$o);}

function stupid_acc($d){
$d=str_replace(['<!--[if IE]>','<!--[if IE 9]>','<!--[if !IE]>','<!--<![endif]-->','<![endif]-->','<!-->'],'',$d??'');//,'<!--'
$ra=["a`","a^","A`","e´","e`","e^","e¨","o^","i^","E´","´´","´","`",'<<','>>'];//,"é",'->','=>'
$rb=["à","â","A","é","è","ê","ë","ô","î","E",'"',"'","'",'«'.sep(),sep().'»'];//,"é","&rarr;","&rArr;"
return str_replace($ra,$rb,$d);}

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

function del_n($d,$s=' '){$d=clean_prespace($d); if(!$d)return '';
$ret=str_replace(["\r","\n",'<br>','<br/>','<br />','</br>'],$s,$d);
return preg_replace('/( ){2,}/',' ',$ret);}

function clean_lines($d){if(!$d)return '';
$r=explode("\n",$d);
foreach($r as $v)$rb[]=trim($v);
return implode("\n",$rb);}

function clean_prespace($d){if(!$d)return '';
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
//$r=conn_ref_out();
$r=conn_ref_in();
foreach($r as $k=>$v)$d=str_replace("\n".$v.']',$v.']',$d);
$d=clean_br_lite($d);
return $d;}

function br_rules($d){
$d=str_replace(["\r","\n"],' ',$d);
$d=str_replace(['<br />','<br/>','</br>','<br>','<BR>'],"\n",$d);
return $d;}

function clean_tables($d){
$d=str_replace("\r",'',$d??'');
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

function repair_tags($d){if(!$d)return;
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

function embed_p($d){
$d=str_replace("\n\n</","</",$d); $r=explode("\n\n",$d); $ret='';
$ex='<h1<h2<h3<h4<h5<br<hr<bl<pr<di<if<fi';//<a <ob<sv<sp<bi<li<im<ta<ol<ul
foreach($r as $k=>$v){if($v=trim($v)){$cn=substr($v,0,3);
	if(strpos($ex,$cn)!==false)$ret.=$v; else $ret.='<p>'.($v).'</p>';}}
return $ret;}

function delconn($d){return codeline::parse($d,'','delconn');}

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
$d=clean_prespace($d);
$d=repair_badn($d);
$d=repair_tags($d);
$d=utflatindecode($d);
$d=clean_acc($d);
$d=clean_tables($d);
$d=clean_punct($d);
$d=clean_punct_b($d);
$d=delsp($d);
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

?>