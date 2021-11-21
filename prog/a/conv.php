<?php

class conv{

static function dom_tmp($d,$o){
//return dom::extract_batch($d,$o);
return dom::detect($d,$o);}

#vacuum//see:editmsql_defcons
static function post_treat($v,$t,$p){$todo=explode('|',$p); $ret='';//admin/editmsql
foreach($todo as $ka=>$va){list($act,$pb)=split_one(':',$va,0);//global
	if($act=='deltables' && $v)$v=del_tables($v);
	elseif($act=='delblocks' && $v)$v=codeline::parse($v,':q','correct');
	elseif($act=='stripconn' && $v)$v=codeline::parse($v,'stripconn','correct');
	elseif($act=='striplink' && $v)$v=codeline::parse($v,'striplink','correct');
	elseif($act=='delconn' && $pb && $v)$v=codeline::parse($v,':'.$pb,'correct');
	elseif($act=='replconn' && $pb && $v)$v=codeline::parse($v,'replconn-'.$pb,'correct');
	elseif($act=='cleanmail' && $v)$v=cleanmail($v);
	//elseif($act=='cleanmini' && $v)$v=cleanmini($v);//todo
	elseif($act=='delqmark' && $v)$v=del_qmark($v);
	elseif($act=='unify-h' && $v)$v=str_replace([':h1',':h2',':h3',':h4',':h5'],':h',$v);
	elseif($act=='del'){if($pb=='title')$pb=$t; $v=str_replace($pb,'',$v);}
	elseif($act=='-??')$v=str_replace('-??','-',$v);
	elseif($act=='???')$v=preg_replace("/(\?){2,}/",'',$v);}
$r=explode("\n",$v); $nbr=count($r); $no=0;
foreach($r as $k=>$v){$cur=true;//by_lines
	foreach($todo as $ka=>$va){
	list($act,$pb)=split_right(':',$va,0);
	if($cur!=false){
	if($act=='line' && is_numeric($pb) && $k==$pb-1)$cur=false;
	elseif($act=='line' && $pb=='last' && $k==$nbr-1)$cur=false;
	elseif($act=='line' && $pb=='title' && $t){$vb=clean_title(clean_html(trim($v),1)); $tb=$t;
		if(strpos($vb,$tb)!==false)$cur=false; else $cur=$v;}
	elseif($act=='linewith' && strpos($v,$pb)!==false)$cur=false;//utf8 pb
	elseif($act=='boldline' && $k==$pb-1 && $v)$cur='['.$v.':b]';
	elseif($act=='del-link' && strpos($v,$pb)!==false)$cur=embed_detect($v,'�',']');
	elseif($act=='linenolink' && $k==$pb-1)list($no,$cur)=explode('�',substr($v,0,-1));
	elseif($act=='since' && strpos($v,$pb)!==false){$cur=false; $no=1;}
	elseif($act=='to' && strpos($v,$pb)!==false){$cur=false; $no=0;}
	elseif($no)$cur=false;
	else $cur=$v;}}
$ret.=$cur."\n";}
$ret=clean_br($ret);
$ret=repair_tags($ret);
$ret=utflatindecode($ret);
return trim($ret);}

//defcon
static function known_defcon($d){$tx=''; $tt='';
if(strpos($d,'name="generator" content="philum'))return ['::article','','::h1','','','','','','',''];
$r=msql::col('','public_defcons_tx',0,1); if($r)foreach($r as $k=>$v)if(dom::detect($d,$v) && !$tx)$tx=$v;
$r=msql::col('','public_defcons_tt',0,1); if($r)foreach($r as $k=>$v)if(dom::detect($d,$v) && !$tt)$tt=$v;
return [$tx,'',$tt,'','','','','','','',''];}

static function recognize_defcon($f){$d=vaccum_ses($f);
return self::known_defcon($d);}

static function add_defcon($f,$d){$fb=domain($f); $rw=self::known_defcon($d);
if($rw)msql::modif('',(rstr(18)?'public':$_SESSION['qb']).'_defcons',$rw,'row',[],$fb);
return $rw;}

static function vacuum_json($d){
/*$sc=embed_detect($d,'<script type="application/ld+json">','</script>');*/
$r=json_decode($d,true); $er=json_error(); if($er)return $er;
$ti=$r['title']??''; $tx=$r['content']??'';
$ti=utf8_decode_b($ti); $tx=utf8_decode_b($tx); $tx=self::call($tx);
return [$ti,$tx,''];}

static function verif_defcon($f){$f=domain($f);
$base=rstr(18)?'public':$_SESSION['qb'];
$r=msql::read('',$base.'_defcons','');
if($r)foreach($r as $k=>$v)if($f==$k)return [$k,stripslashes_r($v)];}

#transductor
static function call($d,$h=''){
$h=$h?$h:rstr(137);
//$d=stripslashes($d);
$d=clean_html($d);
//$d=clean_inclusive($d);
//$d=str_replace('<-','',$d);//&#8617;
$d=br_rules($d);
//$d=dom::cleanimg($d); echo($d).n().n();
//$d=dom::detect($d,'::img');
//$dom=dom($d); $rb=dom::dom2conn($dom); pr($rb);
//$d=str_replace('�','&pound;',$d); eco(d);
$d=self::interpret_html($d,'',$h);
$d=post_treat_repair($d);
//$d=add_anchors($d);
$d=clean_br($d);
return $d;}

static function vacuum_philum($f){$id=strend($f,'/');
$f='http://newsnet.fr/apicom/id:'.$id.',json:1';//,conn:1
$d=read_file($f); $r=json_decode($d,true); $ra=utf_r($r[$id],1);
return [$ra['title'],$ra['content']];}

static function vacuum($f,$sj='',$h=''){//$f=https($f);
$f=http($f); $f=utmsrc($f); $f=urlenc($f); $enc='';
$reb=vaccum_ses($f); if(!$reb){vacses($f,'b','x'); return ['','','','',''];}
//$reb=get_file($f); if(!$reb)return ['nothing',''];
//$rea=strtolower($reb); $rea=str_replace('CHARSET','charset',$reb);
if(strpos($reb,'utf-8') or strpos($reb,'UTF-8'))$enc='utf-8';
if(!$enc)$enc=embed_detect($reb,'charset="','"');
if(!$enc)$enc=mb_detect_encoding($reb,'UTF-8,ISO-8859-1',true);
list($defid,$defs)=self::verif_defcon($f);//defcons
if(substr($reb,0,1)=='{')return self::vacuum_json($reb);
//if(strpos($reb,'name="generator" content="philum'))return self::vacuum_philum($f);
$auv=video::detect($f);//,'pop'
if(!$defs && !$auv)$defs=self::add_defcon($f,$reb);
//if($defs)return ['Title',$f,$f,'','',''];
//$dom=dom($reb); //$rec=dom::detect($dom,'::body'); //eco($reb);
if(strtolower($enc)=='utf-8' or $defs[5])$reb=utf8_decode_b($reb);//trouble dom::detect
if(!empty($defs[2])){//suj
	if(strpos($defs[2],':')!==false)$suj=dom::detect($reb,$defs[2]);
	//if(strpos($defs[2],':')!==false)$suj=dom::extract($dom,$defs[2]);
	elseif(empty($defs[3]))$suj=self::html_detect($reb,$defs[2]);
	else $suj=embed_detect($reb,$defs[2],$defs[3]);
	$suj=trim(del_n($suj)); $suj=self::interpret_html($suj,'ok','');}
else list($suj,$rec,$img)=web::metas($f,$reb);
if(!empty($defs[0])){//content
	if(strpos($defs[0],':')!==false)$rec=dom::detect($reb,$defs[0]);
	//if(strpos($defs[2],':')!==false)$rec=dom::extract($dom,$defs[0]);
	elseif(empty($defs[1]))$rec=self::html_detect($reb,$defs[0]);
	else $rec=embed_detect($reb,$defs[0],$defs[1]);}
elseif(strpos($reb,'<body')!==false)$rec=self::html_detect($reb,'<body');
if(!empty($defs[8])){//header
	if(strpos($defs[8],':')!==false)$opt=dom::detect($reb,$defs[8]);
	//if(strpos($defs[2],':')!==false)$opt=dom::extract($dom,$defs[8]);
	elseif(empty($defs[9]))$opt=self::html_detect($reb,$defs[8]);
	else $opt=embed_detect($reb,$defs[8],$defs[9]);
	if($opt)$rec=$opt.br().$rec;}
if(!empty($defs[4]) && $defs[4]!=1){//footer
	if(strpos($defs[4],':')!==false)$rec.=dom::detect($reb,$defs[4]);
	//if(strpos($defs[2],':')!==false)$rec.=dom::extract($dom,$defs[4]);
	elseif(strpos($reb,$defs[4])!==false)$rec.=br().br().self::html_detect($reb,$defs[4]);}
if(!empty($defs[10]))$rec=dom::del($rec,$defs[10]);//jump_div
//if(!empty($defs[10]))$rec=dom::com($rec,'del',$defs[10]);//jump_div
if($auv){$ret=$auv;//video
	$rb=web::read($f,1); $suj=$rb[0]; $rec=$rb[1];//if(!$rec)if(!$suj)
	if($rec)$ret.=n().n().strip_tags($rec);}
elseif(strpos($f,'twitter.com'))list($suj,$ret,$day)=twit::vacuum($f);
else $ret=self::call($rec,$h);
//if(strpos($reb,'application/ld+json')){list($ti,$tx)=self::vacuum_json($reb); $ret=$ti.'--'.$tx; echo 'json';}
if($suj)$title=clean_title($suj);
else $title=$sj?clean_title(clean_internaltag(clean_html($sj,1))):'Title';
if($defs[6]??'')$ret=self::post_treat($ret,$title,$defs[6]);//post_treat
if(ses('sugm'))$sug=self::sugnote(); else $sug='';
if(!$auv)$ret.="\n\n".$sug.'['.$f.']'; //eco($rec);
return [$title,$ret,$rec,$defid,$defs];}

//suggest
static function sugnote(){$sg=$_SESSION['sugm']; $_SESSION['sugm']='';
$r=msql::modif('',ses('qb').'_suggest','ok','val',1,$sg); 
$mail=$r[$sg][3]; list($m,$a)=opt($mail,'@'); $id=lastid('qda')+1;
$msg=lkc('',host().urlread($id),helps('suggest_ok'));
if($mail)mails::send_html($mail,nmx([1,89]),$msg,$_SESSION['qbin']['adminmail'],$id);
if($m)return '['.nmx([56,88]).' '.$m.':q]'."\n";}

//link-img
static function treat_link($bin,$txa){
$sp='';$sp2='';$mid='';$txt='';$txb='';$bend='';$tag='';$len=0;$nb=0;$dz='';$imnb=0;
if($txa){$tag='href='; $len=6;
	if(substr($txa,0,1)==' ')$sp=' '; if(substr($txa,-1,1)==' ')$sp2=' ';
	$txt=clean_internaltag($txa);//is_image($txa)?$txa:/testing
	if($n=strpos($txt,'>'))$txt=substr($txt,$n+1);}
//elseif(strpos($bin,'srcset')){$tag='srcset'; $len=7; $im='ok';}
//elseif(strpos($bin,'data-orig-file=')!==false){$tag='data-orig-file='; $len=16; $im='ok';}
elseif(strpos($bin,'src=')!==false){$tag='src='; $len=5; $im='ok';}
else return $txa;//things with onclick
$root=findroot(get('urlsrc')); if($root==host())$root='';
$imnb=strpos(strtolower($bin),$tag); if($imnb===false)return $txa;//$imnb=0;
if($imnb!==false && $bin){$imnc=substr($bin,$imnb+$len-1,1); $le=$imnb+$len;
	//if($tag=='srcset'){$bend=strpos($bin,' ',$imnb+$len); $nb=$len+2;}
	if($imnc=='"' or $imnc=="'" or $imnc==' '){$bend=strpos($bin,$imnc,$le); $nb=$len;}
	elseif($bin && $le-1<=strlen($bin)){$bend=strpos($bin,' ',$le-1); $nb=$len-1;}
	else{$bin=''; $bend=''; $imnb=0; $nb=0; $bend=0;}}
if($bend===false && strlen($bin)>=$imnb+$nb)$bend=strpos($bin,'>',$imnb+$nb);
$src=substr($bin,$imnb+$nb,$bend-$imnb-$nb);
if(strpos($bin,'popup_nbp'))$mid='['.$txt.':nh]';//philum_anchor
elseif(strpos($src,'base64') && !$im)$mid='['.($src).':b64]';//self::b64img
elseif($src){
	if(substr($src,0,19)=='data:image/svg+xml,')return;
	$src=preg_replace("/(\n)|(\t)/",'',$src); if($txt)$txt=preg_replace("/(\n)|(\t)/",'',$txt);
	if(strpos($src,'#')!==false)$dz=strend(trim($src),'#'); 
	$src=utmsrc(trim($src));
	$txt=utmsrc($txt); $srcim=is_image($src); if($srcim)$src=str_replace(' ','%20',$src);
	//if($srcim)$src=strto($src,'?');
	//if($tag=='src=')if($pos=strpos($src,'?'))$src=substr($src,0,$pos);
	//$src=str_replace(' ',"%20",$src);//cr�e in�galit�
	if(substr($src,0,2)=='//' && strpos($src,'.'))$src='http:'.$src;
	if(strpos($src,'http')===false && $root)$rot=self::urlroot($root,$src); else $rot='';
	//if($rot==host())$rot='';
	$delroot=host(); $nr=strlen($delroot);//wygsav figure
	if(substr($src,0,$nr)==$delroot)$src=substr($src,$nr);
	if(!$rot && substr($src,0,4)=='img/')$src=substr($src,4);
	if(!$rot && substr($src,0,5)=='/img/')$src=substr($src,5);
	//if(!$rot && substr($src,0,4)=='img/')$src=substr($src,4);
	if(substr($src,0,1)=='/')$src=substr($src,1);
	if(substr($src,-1)=='/')$src=substr($src,0,-1);
	if(substr($txt,0,1)=='/')$txt=substr($txt,0,-1);
	if(strpos($txt,'../')!==false)$src=str_replace('../','',$src);
	if(substr($txt,0,6)=='users/')$src=substr($src,6);
	if($srcim && is_image($txa))return '['.$rot.$src.']';
	if(strpos($src,'javascript')!==false)$src='';
	//if(strpos($bin,'cs_glossaire')!==false)$mid='['.($txa).':pop]';//dico
	//echo $srcim.'-'.$rot.$src.'-'.$txt.br();
	if(strpos($bin,'cs_glossaire')!==false)$mid=$txa;//strend($txa,'�')
	if(!$srcim && !is_url($rot.$src))return $txt;
	elseif($dz=='outil_sommaire')$mid=$txa;//cadtm
	elseif($srcim && !$txt)$mid='['.$rot.$src.'] ';//href to img
	elseif(trim($txt)){$sp='';
		if(substr($txt,-1,1)==' '){$txt=substr($txt,0,-1); $sp=' ';}
		if(substr($txt,-1,1)=='/')$txt=substr($txt,0,-1);
		$rt=['youtube.com/watch','youtu.be','dailymotion.com','vimeo.com','rutube.com'];
		if($dz){//anchors
			//$num=findnumref($dz);
			//$rnh=['nb','_ftn','_edn','fn','footnote_','foot_','sym','ref-'];//nh
			//$rnb=['nh','_ftnref','_ednref','fnref','footnoteref_','easy-footnote','note_','anc','xref-ref-'];//nb
			if(substr($dz,0,2)=='nb')$mid=' ['.$txt.':nh]';//spip
			elseif(substr($dz,0,2)=='nh')$mid='['.$txt.':nb] ';
			elseif(substr($dz,0,4)=='_ftn')$mid=' ['.$txt.':nh]';//symfony
			elseif(substr($dz,0,7)=='_ftnref')$mid='['.$txt.':nb] ';
			elseif(substr($dz,0,4)=='_edn')$mid=' ['.$txt.':nh]';
			elseif(substr($dz,0,7)=='_ednref')$mid='['.$txt.':nb] ';
			elseif(substr($dz,0,2)=='fn')$mid=' ['.$txt.':nh]';
			elseif(substr($dz,0,5)=='fnref')$mid='['.$txt.':nb] ';
			elseif(substr($dz,0,9)=='footnote_')$mid=' ['.substr($dz,9).':nh]';//unz.com
			elseif(substr($dz,0,12)=='footnoteref_')$mid='['.$txt.':nb] ';
			elseif(substr($dz,0,13)=='easy-footnote')$mid='['.embed_detect($txt,'<sup>','</sup>').':nb] ';//ri
			elseif(substr($dz,0,5)=='note_')$mid='['.$txt.':nb] ';//rare
			elseif(substr($dz,0,5)=='foot_')$mid=' ['.$txt.':nh]';
			elseif(substr($src,-3)=='sym')$mid='['.$txt.':nh] ';//openoffice
			elseif(substr($src,-3)=='anc')$mid=' ['.$txt.':nb]';
			elseif(substr($dz,0,4)=='ref-')$mid='['.substr($dz,4).':nh] ';//ucpress.edu
			elseif(substr($dz,0,9)=='xref-ref-')$mid=' ['.subtostr($dz,9,'-').':nb]';
			if(!$mid){if(!$txt)$mid=substr($dz,0);
				elseif(substr($txt,0,1)=='[' or substr($txt,0,1)=='(')$mid=$txt;
				elseif($txt && $src!=$txt)$mid='['.$rot.$src.'�'.$txt.']';
				else $mid='['.$txt.']';}
			if(strto(trim($src),'#')==$root)$mid=$txt;}
//		elseif(httproot($src)=='t')$mid='['.$rot.$src.'] ';
		elseif(in_array_p($src,$rt)){$txt=trim($txt); //video
			if(!is_image($txt) && !is_url($txt))$txb=$txt;// && !ishttp($txt)
			$mid=video::detect($src,1,$txb);}
//		elseif(in_array(httproot($txt),$rt))$mid=video::detect($txt,'pop',$src);
		elseif(strpos($src,'mailto:')!==false)$mid='['.substr($src,7).']';
		elseif($srcim && is_image($txt))$mid='['.$rot.$src.']';
		elseif($txt && $src && $txt==$src)$mid='['.$rot.$src.']';
		elseif($txt && $src && strpos(str_replace('...','',$txt),$src))$mid='['.$rot.$src.']';
		elseif($rot.$src!=$txt){
			if($srcim){
				if(!is_image($txt) && $txt!='https')$mid='['.$rot.$src.($txt?'�'.$txt:'').']';
				else $mid='['.$rot.$src.'�'.$txt.']';}
			elseif(domain($txt)==domain($rot.$src))$mid='['.$rot.$src.'] ';
			else $mid='['.$rot.$src.'�'.$txt.']';}
		else $mid='['.$rot.$src.'] '.$txb;}
	else $mid='['.$rot.$src.'] '.$txb;}
elseif($txt)$mid=$txt.' ';
return $sp.$mid.$sp2;}

#lnks
static function treat_links2($bin,$b){}

#imgs
static function treat_img($bin,$b,$o=''){$im='';
//$b=self::treat_link($bin,''); $b=antipuces($b); if($b)return n().n().$b; else return;
//$b=prop_detect($bin,'src'); if(substr($b,0,2)=='//')$b='http:'.$b;
if(strpos($bin,'data-src="'))$im=embed_detect($bin,'data-src="','"');
elseif(strpos($bin,'src="'))$im=embed_detect($bin,'src="','"');
//elseif(strpos($bin,'src=\''))$im=embed_detect($bin,'src=\'','\'');
elseif(strpos($bin,'srcset'))$im=embed_detect($bin,'srcset="',' ');
//elseif(strpos($bin,'data-orig-file'))$im=embed_detect($bin,'data-orig-file="','"');
elseif(strpos($bin,'data-original'))$im=embed_detect($bin,'data-original="','"'); if(!$im)return;
if(strpos($im,';base64'))return '['.($im).':b64]';//self::b64img
if(substr($im,0,19)=='data:image/svg+xml,')return;
$root=findroot(get('urlsrc')); if($root==host())$root='';
if(substr($im,0,2)=='//')$rot='https:';
elseif(substr($im,0,4)!='http' && $root)$rot=self::urlroot($root,$im); else $rot='';
//if(!is_image($b))$b=$b.':img';
$im=self::cleanmini($im);//ri
$delroot=host(); $nr=strlen($delroot);//wygsav figure
if(substr($im,0,$nr)==$delroot)$im=substr($im,$nr);
if(!$rot && substr($im,0,4)=='img/')$im=substr($im,4);
if(!$rot && substr($im,0,5)=='/img/')$im=substr($im,5);
//if(strpos($im,' '))$im=urlencode($im);
if(strpos($im,' '))$im=str_replace(' ','%20',$im);
$im=antipuces($im);
if($o)return $rot.$im;
return '['.$rot.$im.']'.n().n();}

#html_transductor
static function prep_table($d){$d=trim($d);
return str_replace(['�','|'],'-',$d);}

static function piegemedia($v){$pos=strpos($v,'.mp3');$end='.mp3';
if($pos===false){$pos=strpos($v,'.mp4');$end='.mp4';}
if($pos!==false){$deb=strrpos(substr($v,0,$pos),'http');
	if($deb===false){$deb=strrpos(substr($v,0,$pos),'=');}
	if($deb!==false){$bal=subtopos($v,$deb,$pos);}}
if($bal) return "\n".'['.$bal.$end.']'."\n";}

static function piege_utube($v){$d=self::trap_v_id($v,'youtube.com/v/'); if($d)return '['.$d.':video]';}
static function piege_utub2($v){$d=self::trap_v_id($v,'youtu.be/'); if($d)return '['.$d.':video]';}
static function piege_rutube($v){$d=self::trap_v_id($v,'rutube.ru/'); if($d)return '['.$d.':video]';}
static function piege_daily($v){$d=self::trap_v_id($v,'video/'); $d=strto($d,'_'); if($d)return '['.$d.':video]';}
static function piege_mp3_b64($v){$d=embed_detect($v,'soundFile=','&');
	if(strpos($d,'.mp3')===false)return base64_decode($d); else return $d;}
static function trap_v_id($v,$s){$e=strpos($v,'?'); 
	if($e!==false)$d=embed_detect($v,$s,'?'); else $d=embed_detect($v,$s,'"');
	$e=strpos($d,'&'); if($e!==false)$d=substr($d,0,$e); return $d;}
//static function trap_video($v,$s){$d=self::trap_v_id($v,$s); if($d)return '['.$d.':video]';}

static function dico($bin,$bal){//dico de cadtm
$cl=embed_detect($bin,'class="','"');
if($cl=='gl_dt')$bal='';
elseif($cl=='gl_dd')$bal='';
elseif($cl=='gl_dl')$bal='';
if(strpos($bin,'display:none')===false)
return $bal;}

static function urlroot($root,$src){
$ro=explode('/',$root); $ret='';
if(substr($src,0,1)=='/')$na=3;//d�part racine
else{$nb=substr_count($src,'../'); $na=count($ro)-$nb-1;}
//if(substr($src,0,2)=='//')return $root.$src;//d�part racine
if($na<3)$na=3;//erreurs d'adressage (../ en trop)
for($i=0;$i<$na;$i++)$ret.=val($ro,$i).'/';
return $ret;}

static function cleanmini($d){//ri renvoie des mini
if(strpos($d,'-') && strpos($d,'x'))list($f,$xt)=split_one('.',$d,1); else return $d;
$ls=strend($f,'-'); list($w,$h)=expl('x',$ls);
if(is_numeric($w) && is_numeric($h))$f=struntil($f,'-');// && $w<320
return $f.'.'.$xt;}

static function b64img($d){
return substr($d,strpos($d,',')+1);}

static function bal_conv($ba,$bin,$bb,$b,$h){
static $dd; static $dt; static $dl; static $fig;
$n="\n"; $taga=''; $tagb='';//echo $ba.' '.$bb.' '.$b.$n.$n;
switch($ba){
case('a'):$b=self::treat_link($bin,$b); break;
case('img'):$b=self::treat_img($bin,$b,$fig); break;
case('blockquote'):
	if(strpos($bin,'twitter-')!==false){$d=embed_detect($b,'status/','�'); if(strpos($d,'?'))$d=strto($d,'?');}
	if(isset($d))$b='['.$d.':twitter]'.$n;
	elseif(notintag($b,':q]'))$b=$n.$n.'['.$b.':q]'.$n.$n; break;
//case('picture'):$b=prop_detect($bin,'src'); break;
case('p'):$b=$n.$n.$b.$n.$n; break;
case('strong'):if(notintag($b,':b]'))$b='['.$b.':b]'; break;
case('bold'):if(notintag($b,':b]'))$b='['.$b.':b]'; break;
case('em'):	if(notintag($b,':em]'))$b='['.$b.':i]'; break;
case('h1'):if(notintag($b,':b]'))$b=$n.$n.'['.$b.':'.($h?'h1':'h').']'.$n.$n; break;
case('h2'):if(notintag($b,':b]'))$b=$n.$n.'['.$b.':'.($h?'h2':'h').']'.$n.$n; break;
case('h3'):if(notintag($b,':b]'))$b=$n.$n.'['.$b.':'.($h?'h3':'h').']'.$n.$n; break;
case('h4'):if(notintag($b,':b]'))$b=$n.$n.'['.$b.':'.($h?'h4':'h').']'.$n.$n; break;
case('h5'):if(notintag($b,':b]'))$b=$n.$n.'['.$b.':'.($h?'h5':'h').']'.$n.$n; break;
case('i'):if(notintag($b,':i]'))$b='['.$b.':i]'; break;
case('b'):if(notintag($b,':b]'))$b='['.$b.':b]'; break;
case('u'):if(notintag($b,':u]'))$b='['.$b.':u]'; break;
case('q'):if(notintag($b,':q]'))$b='['.$b.':qu]'; break;
case('td'):$b=self::prep_table($b).'|'; break;
case('th'):$b=self::prep_table($b).'|'; break;
case('tr'):$b=trim($b).'�'.$n; break;
case('table'):$b=$n.$n.'['.clean_list($b,'�').':table]'; break;
case('li'):$b=trim($b); $b=deln($b,' '); $b.=$n.$n; break;//if(strpos($b,"\n"))$b.='|';
case('ul'):$b=$n.'['.$b.':list]'.$n; break;//clean_list($b,'|')
case('ol'):$b=$n.'['.$b.':numlist]'.$n; break;//clean_list($b,'|')
case('strike'):$b='['.$b.':k]'; break;
case('small'):$b='['.$b.':s]'; break;
case('big'):$b='['.$b.':h]'; break;
case('sup'):$b='['.$b.':e]'; break;
case('pre'):$b='['.$b.':pre]'; break;
case('code'):$b='['.$b.':code]'; break;
case('center'):$b='['.$b.':center]'; break;
case('red'):$b='['.$b.':r]'; break;//wyg
case('txtclr'):$b='['.$b.':c]'; break;//wyg
case('fact'):$b='['.$b.':fact]'; break;//xlhtml
case('quote'):$b='['.$b.':quote]'; break;//xlhtml
case('stabilo'):$b='['.$b.':stabilo]'; break;//wyg
case('p'):$taga=$n; $tagb=$n; break;
case('dir'):$b=$n.'['.$b.':q]'; break;
case('br'):if(post('nobr')=='ok')$taga=$n; $tagb=$n; break;
case('hr'):$tagb='[--]'; break;
case('span'):$b=self::dico($bin,$b); break;
case('div'):$taga=$n.$n; $tagb=$n.$n;//$taga=$n; 
	if(strpos($bin,'class="notes')!==false){$taga='['; $tagb=':q]';}
	break;
case('dt'):if(is_image(delhook($b)))$dt=trim($b); else $dd=trim($b); $b=''; break;//dl(dt.dd)
case('dd'):$dd=trim($b).''; $b=''; break;
case('dl')://prevent double img from <a<img
	if(strpos($dt,'�')){list($oa,$ob)=explode('�',delhook($dt)); if(is_image($oa))$dt=$oa; else $dt=$ob;}
	if($dd && $dt)$b=$n.'['.delhook($dt).'�'.$dd.':figure]'.$n;//delhook
	elseif($dt)$b=$n.$dt.$n; elseif($dd)$b=$n.$dd.$n;
	$dt=''; $dd=''; break;
case('figure'):if($fig){
	if(strpos($b,':video')===false && is_image($b)){$b=delhook($b); if(strpos($b,'�'))$b=strto($b,'�');}
	$b=$n.$n.'['.trim($b).'�'.$fig.':figure]'.$n.$n; $fig='';} break;
case('figcaption'):if(!$fig)$fig=trim($b); if(is_image($fig))$fig=delhook($b); $b='';break;//stripconn()
//case('aside'):$b=$n.'['.$b.'�1:msq_graph]'.$n; break;
//case('source'):$bim=self::treat_link($bin,'');//inside audio
	//if($bim)$b=$n.$n.$bim.$n.$n; else $b=''; break;
case('source'):$u=embed_detect($bin,'src="','"');
	if($u)$b='['.goodsrc($u).']'; break;
case('video'):$u=embed_detect($bin,'src="','"');
	if($u)$b='['.goodsrc($u).':video]'; break;
case('audio'):$u=embed_detect($bin,'src="','"');
	if($u)$b='['.goodsrc($u).':audio]'; break;
case('param'):if(strpos($bin,'soundFile'))$b=self::piege_mp3_b64($bin); break;
case('script'):$b=''; break;
//case('noscript'):$b=''; break;//self::treat_link($bin,'');
case('embed'):$taga=$n; $tagb=$n;
	if(strpos($bin,'dailymotion')!==false)$b=self::piege_daily($bin);
	elseif(strpos($bin,'youtube')!==false)$b=self::piege_utube($bin);
	elseif(strpos($bin,'youtu.be')!==false)$b=self::piege_utub2($bin);
	elseif(strpos($bin,'rutube')!==false)$b=self::piege_rutube($bin);
	elseif(strstr($bin,'.mp')!==false)$b=self::piegemedia($bin);
	else $b='<'.correct_widths($bin).'>'; break;
case('iframe'):
	if(strpos($bin,'data-tweet-id')!==false){
		$d=embed_detect($bin,'data-tweet-id="','"'); $b='['.$d.':twitter]';}
	elseif(strpos($bin,'youtube.com')!==false){$d=self::trap_v_id($bin,'embed/');
		if(!$d)$d=embed_detect($bin,'/v/','&'); $b=$n.$n.'['.$d.':video]';}
	elseif(strpos($bin,'dailymotion.com')!==false)$b=self::piege_daily($bin);
	elseif(strpos($bin,'vimeo.com')!==false){
		$d=self::trap_v_id($bin,'video/'); $b='['.$d.':video]';}
	elseif(strpos($bin,'facebook.com/plugins')!==false){
		$d=embed_detect($bin,'src="','"'); $b='['.$d.':facebook]';}
	else{$u=embed_detect($bin,'src="','"'); $u=goodsrc($u);
		$b='['.$u.':iframe]'; break;}}//['.$u.']�[194:nms]
return [$taga,$b,$tagb];}

static function bal_conv_style($b,$bin){$bse=strtolower($bin);
if(strpos($bse,'bold')!==false && notintag($b,':b]'))$b='['.$b.':b]';
elseif(strpos($bse,'italic')!==false && notintag($b,':i]'))$b='['.$b.':i]';
elseif(strpos($bse,'underline')!==false && notintag($b,':u]'))
	$b='['.$b.':u]';
elseif((strpos($bse,'color:#ff0000')!==false or strpos($bse,':red')!==false or strpos($bse,'rgb(255,0,0)')!==false) && notintag($b,':c]'))$b='['.$b.':c]';
elseif(strpos($bse,'background-color')!==false && notintag($b,':bkgclr]')){
	$n=strpos($bse,'background-color:'); $nb=strpos($bse,';',$n); $s=$nb!==false?$s=';':'"';
	$color=embed_detect($bse,'background-color:',$s);
	if(substr($color,0,1)=='#' && strlen($color)==7)$b='['.$b.'�'.$color.':bkgclr]';}
elseif(strpos($bse,'color')!==false && notintag($b,':color]')){
	$n=strpos($bse,'color:'); $nb=strpos($bse,';',$n); $s=$nb!==false?$s=';':'"';
	$color=embed_detect($bse,'color:',$s);
	if(substr($color,0,1)=='#' && strlen($color)==7 && $color!='#000000'){
		if($color=='#d03b39' or $color=='#FF0000')$b='['.$b.':red]';
		else $b='['.$b.'�'.$color.':color]';}}
elseif(strpos($bse,'line-through;')!==false)$b='['.$b.':k]';
elseif(strpos($bse,'spip_doc_descriptif')!==false)$b='['.$b.':q]';
elseif(strpos($bse,'ndtref')!==false)$b='['.$b.':parma]';
elseif(strpos($bse,'ndwref')!==false)$b='['.$b.':green]';
elseif(strpos($bse,'class="ndt"')!==false)$b='['.$b.'�(NdT):bubble_note]';
elseif(strpos($bse,'class="ndw"')!==false)$b='['.$b.'�(NdW):bubble_note]';
elseif(strpos($bse,'class="tdef"')!==false)$b='['.$b.'�red:underline]';
elseif(strpos($bse,'class="udouble"')!==false)$b='['.$b.'�double:underline]';
//elseif(strpos($bse,'margin-left')!==false)$b='['.$b.':q]';
return $b;}

static function ecart($v,$a,$b){$min=$a+1; $max=$b-$a-1; if($a<$b+1)
return substr($v,$min,$max);}//if($min<$max)else error detected

static function recursearch($v,$ab,$ba,$aa_bal){//pousse si autre balise similaire
$bb=strpos($v,'>',$ba); $bal=self::ecart($v,$ab,$ba); 
if(strpos($bal,'<'.$aa_bal)!==false){$bab=strpos($v,'</'.$aa_bal,$ba+1);
	if($bab!==false)$ba=self::recursearch($v,$bb,$bab,$aa_bal);}
return $ba;}

static function recursearch_b($v,$ab,$ba,$aa_bal){//r�actualise le nombre de balises
$bal=self::ecart($v,$ab,$ba);
$nb_aa=substr_count($bal,'<'.$aa_bal);
$nb_bb=substr_count($bal,'</'.$aa_bal);
$nb=$nb_aa-$nb_bb;
if($nb>0){for($i=0;$i<$nb;$i++){$ba=strpos($v,'</'.$aa_bal,$ba+1);}
	$ba=self::recursearch_b($v,$ab,$ba,$aa_bal);}
return $ba;}

static function html_detect($v,$aa_in){//balise enti�re
$aa_end=strpos($aa_in,' '); $ba=''; $bal='';
if($aa_end!==false)$aa_bal=substr($aa_in,1,$aa_end-1);
else $aa_bal=str_replace(['<','>'],'',$aa_in);
$aa=strpos($v,$aa_in);
if($aa===false){$vb=str_replace("\n",' ',$v); $aa=strpos($vb,$aa_in);}
if($aa===false)return;
$ab=strpos($v,'>',$aa); 
if(strpos($v,'</'.$aa_bal.'>'))$ba=strpos($v,'</'.$aa_bal.'>',$ab); 
if($ba)$bal=self::ecart($v,$ab,$ba);
$aab=strpos($v,'<'.$aa_bal,$ab);
if($aab!==false && $ba){
	$ba=self::recursearch_b($v,$ab,$ba,$aa_bal);//!
	$bal=self::ecart($v,$ab,$ba);}
return $bal;}

static function until_error($d){
$ba=strpos($d,'<'); $bb=strpos($d,'>'); $db=substr($d,0,$ba);
if($ba!==false && $bb!==false){$v=substr($d,$ba,$bb-$ba+1);
	if(substr_count($v,'<')!=substr_count($v,'>'))return $db;
	else $v=$db.$v.self::until_error(substr($d,$bb+1));}
else $v=$db;
return $v;}

//$before <$ba> $bal </$bb> $after
static function interpret_html($v,$X,$h){//<:aa,>:ab,</:ba,>:bb;
if(substr_count($v,'<')!=substr_count($v,'>'))$v=self::until_error($v);
list($ba,$bb,$aa_bal,$aa_in,$bb_bal,$bal,$taga,$tagb,$before,$after)=['','','','','','','','','',''];
$aa=strpos($v,'<'); $ab=strpos($v,'>');//aa_bal 
if($aa!==false && $ab!==false && $ab>$aa){
$before=substr($v,0,$aa);//...<
$aa_in=self::ecart($v,$aa,$ab);//<...>
	$aa_end=strpos($aa_in,' ');
	if($aa_end!==false){$aa_bal=substr($aa_in,0,$aa_end);}
	else $aa_bal=$aa_in;}
//else $before=$v;
$ba=strpos($v,'</'.$aa_bal,$ab); $bb=strpos($v,'>',$ba);//bb_bal
if($ba!==false && $bb!==false && $aa_bal && $bb>$ba){
	$ba=self::recursearch($v,$ab,$ba,$aa_bal);
	$bb=strpos($v,'>',$ba);
	$bb_bal=self::ecart($v,$ba,$bb);
	$bal=self::ecart($v,$ab,$ba);}
elseif($ab!==false)$bb=$ab;
else{$bb=-1;}
if($bb)$after=substr($v,$bb+1);//>...
else $after='';
//ok,go
$aa_bal=strtolower($aa_bal); $bb_bal=strtolower($bb_bal);
if($aa_bal=='head' or $aa_bal=='style' or $aa_bal=='script')$bal='';
//static $i; $i++; echo $i.' :: '.$aa_bal.'=>'.$bb_bal.' - ';
//it�ration
if(strpos($bal,'<')!==false)$bal=self::interpret_html($bal,$X,$h);//100909
if($X!='ok'){//else interdit l'imbrication
	if($aa_bal=='pagespeed_iframe')$aa_bal='iframe';//patch
	$ret=self::bal_conv($aa_bal,$aa_in,$bb_bal,$bal,$h); //echo($ret[1]).n();
	if($ret[1]==$bal)$bal=self::bal_conv_style($bal,$aa_in);
	else $bal=$ret[1];
	$taga.=$ret[0]; $tagb.=$ret[2];}
//sequential
if(strpos($after,'<')!==false)$after=self::interpret_html($after,$X,$h);
$ret=$before.$taga.$bal.$tagb.$after;
return $ret;}

}
?>