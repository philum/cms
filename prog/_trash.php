<?php

#2111

//api
/*static function build_arts0($r,$prw,$tp,$nl){$msg='';
if($prw>1 or $prw=='rch' or substr($prw,0,4)=='conn')$msg=sql('msg','qdm','v','id="'.$r['id'].'"');//msg
$r['img1']=art_img($r['img']);
return art_read_mecanics($r['id'],$r,$msg,$prw,$tp,$nl);}*/

//lib
//function mtime(){return array_sum(explode(' ',microtime()));}
//function stime(){return mtime()-$_SERVER['REQUEST_TIME_FLOAT'];}

//msql
/*function msql_intersect($d0,$d){$ra=[]; $rb=[]; $rc=[]; $re=[]; $rt=[];
$r=explode(',',$d0.','.$d); $na=count($r); $rtb=[];//echo msql_opsup($d,'intersect');
$ret=divb(substr(md5($d0.$d),0,6),'popbt'); [$dr0,$nod0]=node_decompil($d0); $nd=struntil($nod0,'_');
$ret.=textarea('msqop2',$d).lj('','editmsql_msqlops___'.ajx($d0).'_intersect___msqop2',picto('ok'));
foreach($r as $k=>$v){[$dr,$nod]=split_right('/',$v,1); if(!$dr){$dr=$dr0; $nod=$nd.'_'.$nod;}
	$r0=msql::read($dr,$nod,'',1);
	if($r0){$ra[]=array_column($r0,0); $re=array_merge($re,$r0);}else $ret.='x:'.$dr.$nod.' ';}
foreach($r as $k=>$v)foreach($ra[$k] as $ka=>$va)if($va!=$v && in_array($va,$ra[$k]))$rb[$va][]=1;//pr($rb);
foreach($rb as $k=>$v){$n=count($v); if($n>1)$rc[$k]=$n;} arsort($rc); $ret.=eco($rc,1);//pr($rc);
foreach($re as $k=>$v)if($rc[$v[0]]??'')$rt[$v[0]]=$v;//pr($rt);
foreach($rc as $k=>$v)$rtb[$k]=$rt[$k];//pr($rt);
echo $ret;
return $rtb;}*/

/*function msql_connexions($d0,$d){$ra=[]; $rb=[]; $rc=[]; $re=[]; $rt=[];
$r=explode(',',$d0.','.$d); $na=count($r); $rtb=[]; $rid=substr(md5($d0.$d),0,6);//echo msql_opsup($d,'intersect');
$ret=divb($rid,'popbt'); [$dr0,$nod0]=node_decompil($d0); $nd=struntil($nod0,'_');
$ret.=textarea('msqop2',$d).lj('','editmsql_msqlops___'.ajx($d0).'_connexions___msqop2',picto('ok'));
foreach($r as $k=>$v){[$dr,$nod]=split_right('/',$v,1); if(!$dr){$dr=$dr0; $nod=$nd.'_'.$nod;}
	$r0=msql::read($dr,$nod,'',1);
	if($r0){$ra[]=array_column($r0,0); $re=array_merge($re,$r0);}else $ret.='x:'.$dr.$nod.' ';}
foreach($r as $k=>$v)foreach($ra[$k] as $ka=>$va)if($va!=$v && in_array($va,$ra[$k]))$rb[$va][]=1;//pr($rb);
foreach($rb as $k=>$v){$n=count($v); if($n>1)$rc[$k]=$n;} arsort($rc); $ret.=eco($rc,1);//pr($rc);
foreach($re as $k=>$v)if($rc[$v[0]]??'')$rt[$v[0]]=$v;//pr($rt);
foreach($rc as $k=>$v)$rtb[$k]=$rt[$k];//pr($rt);
$nodb=nod('frn_'.$rid); $r=msql::save('',$nodb,$rtb);
foreach($rtb as $k=>$v){$pb=msql::url('',nod('frn_'.str_replace('_','-',$v[1])).'-'.date('ymd'));
	if(!is_file($pb))$ret.=twit::call($v[1],'frnb'); else echo $pb;}
echo count($rc).' results '.$ret.msqbt('',$nodb);
return $rtb;}*/

#2109

//conv

/*static function add_im_img2($nnw,$id){if(!$id)return;
$nnw=str_replace(['users/','img/'],'',$nnw);
$d=sql('img','qda','v','id="'.$id.'"');
if(strpos($d,$nnw)===false)update('qda','img',$d.'/'.$nnw,'id',$id);}*/

/*static function defcons2xss($d){$c=''; $t='';
if(strpos($d,'=')!==false){$tg=embed_detect($d,'<',' ',''); $t=embed_detect($d,' ','=',''); $c=prop_detect($d,'');} else $tg=embed_detect($d,'<','>','');
return $c.':'.$t.':'.$tg;}*/

/*static function recognize_defcon($d){//obs
$base=rstr(18)?'public':$_SESSION['qb'];
$r=msql::read('',$base.'_defcons',''); $tx=''; $tt='';
if($r)foreach($r as $k=>$v){
if($v[0])if(strpos($d,stripslashes($v[0])))$tx=stripslashes($v[0]);
if($v[2])if(strpos($d,stripslashes($v[2])))$tt=stripslashes($v[2]);}
if($tx or $tt)return [$tx,'',$tt,'','','',''];}*/

/*static function add_defcon($d){$d=domain($d);
return msqbt('',(rstr(18)?'public':$_SESSION['qb']).'_defcons',ajx($d));}*/

//conn
//case(':svg'):list($f,$w,$h)=subparams_a($d); return svg('/imgb/icons/'.$d,$w,$h); break;

//lib
/*function dump($r){$rc=[];
if(is_array($r))foreach($r as $k=>$v){$rb=[]; $k=is_numeric($k)?$k:'\''.$k.'\'';
if(is_array($v)){foreach($v as $ka=>$va){$ka=is_numeric($ka)?$ka:'\''.$ka.'\'';
	$va=is_numeric($va)?$va:'\''.addslashes(stripslashes($va)).'\''; $rb[]=$ka.'=>'.$va;}
	if($rb)$rc[]=$k.'=>['.implode(',',$rb).']';}
else $rc[]=$k.'=>'.(is_numeric($v)?$v:'\''.addslashes(stripslashes($v)).'\'');}
if(isset($rc))return '$r=['.implode(',',$rc).'];';}*/

//function findnumref($d){$r=str_split($d); $ret=''; foreach($r as $v)if(is_numeric($v))$ret.=$v; return $ret;}

#2108
//ajxf
/*function symaths(){return ['General punctuation'=>['2000','206F'],'Superscripts and subscripts'=>['2070','209F'],'Combinatorial signs for symbols'=>['20D0','20FF'],'Numerical forms'=>['2150','218F'],'Arrows'=>['2190','21ff'],'Math operators'=>['2200', '22ff'],'Miscellaneous Technical Signs/APL'=>['2300','23ff'],'Geometric Shapes'=>['25A0','25FF'],'Miscellaneous Symbols'=>['2600','26FF'],'Breakout'=>['2700','27BF'],'Miscellaneous Mathematical Symbols - A'=>['27C0', '27EF'],'Additional Arrow A'=>['27F0','27FF'],'Additional Arrow B'=>['2900','297F'],'Various Maths Symbols-B'=>['2980','29FF'],'Additional Maths Operators'=>['2A00','2AFF'],'Various symbols and arrows'=>['2B00','2BFF'],'CJC symbols and punctuation (Chinese, Japanese and Korean)'=>['3000','303F'],'Aegean numbers'=>['10100','1013F'],'Alphanumeric mathematical symbols'=>['1D400','1D7FF']];}*/

/*function asciimaths($id){$r=symaths();
$ret=lj('txtx','nvascii4_navs___ascii4_'.$id,picto('back'));
foreach($r as $k=>$v){$a=hexdec($v[0]); $b=hexdec($v[1]); $ret.=divb($k,'tit');
	for($i=$a;$i<=$b;$i++){$va='&#'.$i.'; ';
	$ret.=btj($va,atjr('insert',[$va,$id]),'ascii','',$i).' ';}}
return $ret;}*/

///navs
/*if($op=='ascii1'){$r=msql_read('system','edition_ascii_1','',1);
	foreach($r as $k=>$v){
		if(is_numeric($k))$v='&#'.$k.';'; else $v=$k;
		$ret.=ljb('','insert_b',[$v,$id],$v,'',att($k)).' ';}
	$ret.=lj('txtx','popup_plup___ascii1','table');
	//$ret.=lj('txtx','popup_navs___ascii2','conn');
	//$ret.=lj('txtx','popup_navs___ascii3','emoj');
	$ret.=lj('txtx','popup_call___ascii4_logic_'.$id,'logic');
	if(auth(6))$ret.=msqbt('system','edition_ascii_1');}
elseif($op=='ascii2'){$r=msql_read('system','edition_ascii_2','',1);
	foreach($r as $k=>$v)$ret.=ljb('','insert_b',['['.$k.':ascii]',$id],'&#'.$v.';','',att($k)).' ';
	$ret.=lj('txtx','popup_plup___asciicss','table');
	if(auth(6))$ret.=msqbt('system','edition_ascii_2');}
elseif($op=='ascii3'){$r=msql_read('system','edition_ascii_3','',1);
	foreach($r as $k=>$v)$ret.=ljb('','insert_b',[$v,$id],$v,'',att($k)).' ';
	if(auth(6))$ret.=msqbt('system','edition_ascii_3');}*/

///lib
/*function flags0(){$r=msql_read('system','edition_flags','',1); 
foreach($r as $k=>$v)$ret[$v[1]]=$v[0]; return $ret;}
function flag0($d){$r=sesmk('flags','',0);
if(isset($r[$d])){$f='imgb/icons/flags/'.$r[$d].'.gif';
	if(is_file($f))return image('/'.$f,'14'); else return '['.$r[$d].']';}}*/

#2105

//lib
//function gz_read($f){$gz=gzopen($f,'r'); $d=gzread($gz,filesize($f)); gzclose($gz); return $d;}

//art
/*function tag_maker0($id,$o=''){//$r=sesr('artags',$id); 
$r=art_tags($id); if(!$r)return; $sep="&#8239;"; $ret=[];
$ica=explode(' ',prmb(18)); $ico=explode(' ',prmb(19));
$rico=['tag'=>'tag']+array_combine($ica,$ico); $rico['utag']='like';
if($r)foreach($rico as $cat=>$ico){$rt=[]; if(is_numeric($cat))$cat='utag';
	if(isset($r[$cat]))foreach($r[$cat] as $ka=>$va)
		$rt[$ka]=lj('','popup_api__3_'.$cat.':'.ajx($ka),$ka);
	if($rt)$ret[$cat]=picto($ico,16).$sep.implode(' ',$rt);}
if($ret)return $o?$ret:implode(br(),$ret);}*/

//starmap4
/*/*static function months0(){$w=self::$w; $h=$w/2;
list($white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray)=self::$clr;
//echo mktime(1,0,0,1,1,1970);//timestamp=0
$eq=6766500;//mktime(8,35,0,3,20,1970);//7h35+1h(timestamp=0)
//$yr=mktime(1,0,0,1,1,1971);//31536000
//$yr=31556952;//3600*24*365.2425;
$yr=31557600;//official
$xp=77.19;//round($eq/$yr,3)*360;//77.190280629706
$sec=360/12;//angular month
$sec2=round($w/360,2);//projection
$rt=['Jan','Fev','Mars','Avr','Mai','Juin','Juil','Août','Sept','Oct','Nov','Dec']; $rx=[];
foreach($rt as $k=>$v){$a=180+$xp-(30*$k); if($a<0)$a+=360; $b=$a*$sec2; $rx[]=$a;
svg::line($b,0,$b,$h,$gray,'','','8');
svg::text(10,$b+4,$h-1,$v,$silver);}}

#2104

//meta
/*function match_tags0($idart,$cat,$o=''){req('tri');
$msg=prep_msg($idart); $ra=each_words($msg); arsort($ra); $ra=array_keys($ra); $rd=[]; $re=[];
$lg=sql('lg','qda','v','id="'.$idart.'"'); $rb=[];
$rn=array_flip(catag()); $n=$rn[$cat]+1;
if($lg=='en')$rb=msql::kx('',nod('tags_'.$n.$lg),0);
if(!$rb)$rb=sql('id,tag','qdt','kv','cat="'.$cat.'" order by id desc');
//if(!$lg or $lg=='fr')$rbb=msql::kv('',nod('syn_'.$n));
$rx=read_tags($idart,$cat);//existing
if($rx)$rb=array_diff($rb,$rx);//del exs
if($rb)$rd=array_intersect($rb,$ra);//detected
if($rb)foreach($rb as $k=>$v){$vb=strtolower(eradic_acc($v));
	if(!isset($rd[$k]))if(preg_match("/\b".$vb."\b/i",$msg)){// && strpos($msg,$vb)!==false
		$rd[$k]=$v; $rn=detect_words($msg,$vb,1); $re[$v]=count($rn);}}//count_occurrences($msg,$vb)
if($re){$rdb=array_flip($rd); arsort($re); foreach($re as $k=>$v)$rf[$rdb[$k]]=$k;
	foreach($rd as $k=>$v)if(!in_array($v,$rf))$rf[$k]=$v; $rd=$rf;} pr($rd); pr($re);
if($o)return [$rd,$re]; if(!$rd)return ' ';
return add_tag_btn($rd,$idart,$cat,'',$re);}*/

//app/mysql
/*static function alter($ra,$rb,$p){$n=count($ra);
//ALTER TABLE `pub_obj` ADD `com` INT NOT NULL AFTER `img`;
//ALTER TABLE `pub_meta_clust` CHANGE `idart` `idart2` INT(11); 
$rp=array_values($rb);//liste des propriétés
foreach($ra as $k=>$v){
	foreach($rb as $kb=>$vb){if($kb==$v)$after=$cur; else $cur=$kb;}
	$ret[]='"'.$v.'" '.$rp[$k].' after "'.$after.'"';}
qr('alter table '.self::$t.' '.implode(',',$ret),1);}*/

//art///tracks_read
//1green:182,205,218; 2red:202,181,194; 3blue:158,181,238; 4or=225,196,158
//if($re==2)$tks='202,181,194'; elseif($re==3)$tks='158,181,238'; elseif($re==4)$tks='225,196,158';

//utils
/*function protect_tags(d,v,o){
	if(o){
	d=strreplace("{"+v+"}","<"+v+">",d);
	d=strreplace("{/"+v+"}","</"+v+">",d);}
	else{
	d=strreplace("<"+v+">","{"+v+"}",d);
	d=strreplace("</"+v+">","{/"+v+"}",d);}
	return d;}*/

//pop
/*function find_quotes0($ret,$id,$s,$pad,$idtrk){static $dc=0;//decal because of previous results
$pad=clean_punct($pad); $l=strlen($pad); $s2=0; if($dc)$s2+=$dc*(10+strlen($idtrk));
$nh=ljb('','scrolltoob','qnb'.$s,picto('arrow-down'),'qnh'.$s,);
$s2=mb_strpos($ret,$pad,$s); if($s2)$s=$s2; $dc++;
if($s){$d1=mb_substr($ret,0,$s); $d2=mb_substr($ret,$s,$l); $d3=mb_substr($ret,$s+$l);
	$d2=preg_replace('/(\n){2,}/',br().br(),$d2);
	return $d1.$nh.'['.$d2.'§'.$idtrk.':quote2]'.$d3;}//already exists
else return $ret;}*/

/*function find_quotes1($ret,$id,$s,$pad,$idtrk){list($s,$l)=opt($s,'-'); //echo $s.'-'.$l;
echo $nh=ljb('','scrolltoob','qnb'.$s,picto('arrow-down'),'qnh'.$s);//begin wide before espected
$d1=mb_substr($ret,0,$s); $d2=mb_substr($ret,$s,$l); $d3=mb_substr($ret,$s+$l); //eco($d2);
return $d1.$nh.btn('stabilo',$d2).$d3;}*/

//utils
/*function insertnode(node){var range,html;
	if(window.getSelection && window.getSelection().getRangeAt){
		range = window.getSelection().getRangeAt(0);
		range.insertNode(node);}
	else if(document.selection && document.selection.createRange){
		range=document.selection.createRange();
		html=(node.nodeType==3)?node.data:node.outerHTML;
		range.pasteHTML(html);}}

function inserthtml(html){var range,node;
	if(window.getSelection && window.getSelection().getRangeAt){
		range = window.getSelection().getRangeAt(0);
		node = range.createContextualFragment(html);
		range.insertNode(node);}
	else if(document.selection && document.selection.createRange){
		document.selection.createRange().pasteHTML(html);}}*/

//art//prepare_tits
/*if(!$rst[124]){//jda
		list($jdp,$jdt,$jdok,$jdko)=vals($r['opts'],['jdapoll','jdatrk','approve','disapprove']);
		$rb['social'].=pictxt('vote',$jdp).' '.pictxt('chat2',$jdt).' ';
		$rb['social'].=pictxt('thumb-top',$jdok).' '.pictxt('thumb-bottom',$jdko).' ';}*/
	//$rb['social']=togbub('social',$id,picto('social')).' ';

/*static function read_x($dr,$nod,$in='',$u=''){$f=self::url($dr,$nod); $m='_menus_'; $r=[];
if(is_file($f))include $f; if(!isset($r)){alert('er:'.$f);return;} if($u)unset($r[$m]);
unset($r[0]); $r0=current($r); if(!$r0)$r0=next($r); $n=is_array($r0)?count($r0):0;
if($r)foreach($r as $k=>$rb)foreach($rb as $kb=>$vb)$r[$k][$kb]=stripslashes_b($vb);
if($in){if(!isset($r[$in]))return; if($u=='k')return $r[$in]; elseif($n==1)return $r[$in][0];
	elseif(isset($r[$m]))return array_combine_a($r[$m],$r[$in]); else return $r[$in];}//array_combine
elseif($n==1 && $u!='k')foreach($r as $k=>$v)$r[$k]=val($v,0); 
return $r;}*/

#2103

//tri
///bal_conv////div
	//elseif(strpos($bin,'spip_doc_descriptif')!==false){$taga='['; $tagb=':q]';}
	//elseif(strpos($bin,'class="b-inject m-inject-min"')!==false)$bal='';//sputnik pub
	//elseif(strpos($bin,'class="appel_don')!==false)$bal='';//bast pub
	//elseif(strpos($bin,'read-more')!==false)$bal='';//rt

//function piege_googv($v){$d=embed_detect($v,'docid=','&'); if($d)return '['.$d.':video]';}
//static function piege_ted($v){$d=embed_detect($v,'vu=','&'); if($d)return '['.$d.':video]';}

//msqlvue
/*static function inject($k,$r){//pr($r);
$nid=0; $suj='312-'.$k; $sav=0;
$tim=str_replace('@312_oay ','',$r['Respuestas']);
$tim=trim($tim); $pos=strpos($tim,' ',7); $tim=substr($tim,0,$pos); $pdt=strtotime($tim); //echo $tim; echo br();
if($pdt)ses('pdt',$pdt); else $pdt=ses('pdt')+$k;
$pos=strpos($r['Respuestas'],'<p',10); $msg=substr($r['Respuestas'],$pos); 
$msg=str_replace(':web','',$msg); echo $msg;
$name='ummo'; $qb='ummo'; $frm='312_oay'; $re=1; $img=$thm=$iq=$mail=''; $lg='en'; $ib=$sz=0;
$rw=[$ib,$name,$mail,$pdt,$qb,$frm,$suj,$re,0,$img,$thm,$sz,$lg]; p($rw);
if($sav){$nid=sqlsav('qda',$rw,1); if($nid)sqlsavi('qdm',[$nid,$msg],0);}
//trk
$ib=''; $suj=''; $msg=trim($r['Preguntas']); $msg=str_replace(':web','',$msg);
$rt=[$nid,$name,$mail,$pdt,$qb,$ib,$suj,$msg,$re,$iq,$lg]; p($rt);
if($sav && $msg && $nid){$nread=insert('qdi',mysqlra($rt,1),1); tracks::trkstatus($nread,2);}//question
return lkt('','/'.$nid,$suj);}*/

//msql
/*function import_csv0($r,$d){if(!$d)return $r; 
$ra=explode("\n",$d); //$rb['_menus_']=$r['_menus_'];
if($ra)foreach($ra as $k=>$v)$rb[]=explode("\t",str_replace("\r","\n",$v));
if($rb[0]){$rb['_menus_']=$rb[0]; unset($rb[0]);}
return $rb?$rb:$r;}*/

/*function msqdt_csv($r){$ret='';//import_csv
if($r)foreach($r as $k=>$v)foreach($v as $ka=>$va)$r[$k][$ka]=str_replace([',',"\n"],['(coma)','<br>'],$va);
if($r)foreach($r as $k=>$v)if($v)$ret.=$k.','.implode(',',$v)."\n"; return $ret;}*/

//pop
/*function links_t($t){$r=explode(' ',$t);
foreach($r as $v)if(strpos($v,':picto'))$ret.=picto($v).' '; else $ret.=$v.' '; return $ret;}*/

/*use msql slide_id
function slides($p,$id){$p=$p?normalize($p):$id;
msql::read_b('',nod('slides_'.$p),'','',['arr']);
return slides::home($p);}*/

//tri
/*function no_unused_br($d){//experiment
$ar=["]\n",".\n\n",".\n","\n\n",'µµ','gµ','µ'];
$ab=['gµ','µµ','µ',"\n",".\n\n","]\n",".\n"];
return str_replace($ar,$ab,$d);}*/

/*function clean_line($d){$r=explode("\n",$d);
if($r)foreach($r as $k=>$v)if(strpos($v,':twitter')===false)$rb[]=$v; //strpos($v,':poptwit')===false && 
if($rb)$d=implode("\n",$rb);
//$d=str_replace(':web','',$d);
return $d;}*/

//codeline
/*static function figure2($d){list($im,$t)=cprm($d);
if(strpos($im,'<img')===false)$img=image(goodroot($im)); else $img=$im;
if(!$t)return $img; else return balb('figure',$img.balb('figcaption',$t));}*/

//lib
/*function splice($r,$n){$i=0;
if($r)foreach($r as $k=>$v){$i++; if($i<$n+1)$ret[$k]=$v;} return $ret;}*/
//function inp($id,$v,$p=''){return '<input type="text"'.atd($d).atv($v).attr($p).' />';}

//twit
/*static function upvideo_0($f,$xt){//open twitter
//https://video.twimg.com/ext_tw_video/1094182177242263552/pu/vid/1280x720/pcPd6LUOqt4bs1DL.mp4?tag=6
$twv=str_replace('/','_',substr(strto($f,'?'),37,0-strlen($xt)));//-$xt//
$fb='http://socialnetwork.ovh/frame/twvideo/'.$twv.$xt;
$fa='http://socialnetwork.ovh/usr/videos/'.strprm($twv,4,'_').$xt;//.'(dot)'.substr($xt,1)
if(joinable($fa))return video_html($fa);
return lj('','popup_iframe___'.ajx($fb),picto('movie')).' '.lkt('',$f,picto('chain'));}*/

//ajx
/*function SaveD(val){var dn=val.split('_');//chat/twit
var URL=jurl()+dn[1]+'_'+dn[2]+'_'+dn[3]+'_'+dn[4]; //alert(dn[2]);
new AJAX(URL,dn[0],2); if(dn[0]=='content')Close('popup');}*/

//multipass //where was born AMT, ajax multithread
/*function SaveR(val,arr){
var dn=val.split('_'); vn=arr.split('|'); var nm='';
for(i=0;i<vn.length;i++)if(vn[i])var nm=nm+encUriJ(getbyid(vn[i]).value)+'_';
var URL=jurl()+val+'&res='+nm; var cp=2;
new AJAX(URL,dn[0]+dn[1],cp);
if(dn[3]=='del'||dn[3]=='new'||dn[3]=='sav'||dn[3]=='add')Close('popup');}*/

/*function SaveBb(val){var dn=val.split('_');//admin_config_mod
new AJAX(jurl()+val,dn[0]+dn[1]);}*/

/*function galtimer(val){SaveBb(val);
setTimeout(function(){galtimer(val)},1000);}*/

/*function SaveBe(val){var dn=val.split('_');//used by tools editor
new AJAX(jurl()+val,'popup');}*/

/*function SaveBbc(p,nm){var msx=getbyid('msgx'+p);
SaveJ('chtx'+p+'_plug__before_chatxml_chatxsav_'+p+'_'+nm+'&res='+encUriJ(msx.innerHTML));//
msx.innerHTML='';}*/

//pop
/*function bubble_note0($d,$t=''){list($v,$tb)=cprm($d); $rid=rid($d);
$t=$t?$t:$tb; sesr('temp',$rid,$v);
return togbub('text','bpop_'.$rid,$t?$t:'(*)','','',0).bts('display:none;',$v);}*/

//yandex
/*static function read0($p,$o='plain',$txt,$to=''){
$txt=self::convconn($txt); $ret='';
//$txt=str_replace(['[',']'],['µ','£'],$txt);//deepl
$r=self::cut($txt); //p($r);
if($r)foreach($r as $k=>$v){
	if(self::$motor=='yandex'){
		$rb=self::build_yandex($p,$o,$v,$to);
		$ret.=utf8_decode_b(valr($rb,'text',0));}
	elseif(self::$motor=='deepl'){
		$rb=self::build_deepl($p,$o,$v,$to);
		$ret.=utf8_decode_b($rb['translations'][1]['text']);}}
$ret=self::convhtml($ret);//
//$ret=str_replace(['µ','£'],['[',']'],$ret);//deepl
$ret=self::correct($ret);
return $ret;}*/

/*static function convconn($d){req('pop,art,spe,tri,mod');
$d=clean_tw($d,1); //$d=clean_line($d);
$d=codeline::parse($d,'','sconn');
$d=codeline::parse($d,'','sconn3'); //eco($d);
$d=conn::read($d);
//$d=str_replace(['<','>'],['(hk1)','(hk2)'],$d);
//$d=str_replace(['[',']'],['(',')'],$d);
return $d;}*/

//umrec
/*function umrec_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','umrec/umrec_r','','2').' ';
$ret.=input1('inp',$p).' ';
//$ret.=checkbox('chk','no','tags','');
//$ret.=lj('',$rid.'_plug__3_umrec_umrec*j__array_inp',picto('ok'));
$ret.=ljp(att('liste'),$rid.'_plug__3_umrec_umrec*j__list_inp',picto('filelist')).' ';
$ret.=ljp(att('tableau'),$rid.'_plug__3_umrec_umrec*j__table_inp',picto('table')).' ';
$ret.=ljp(att('tags'),$rid.'_plug__3_umrec_umrec*j__tags_inp',picto('tag')).' ';
//$ret.=ljp(att('texte'),$rid.'_plug__3_umrec_umrec*j__text_inp',picto('txt')).' ';
$ret.=ljp(att('brut'),$rid.'_plug__3_umrec_umrec*j__brut_inp',picto('txt')).' ';
return divc('',$ret).br();}*/

//umrec
/*function umrec_brut0($r){
$r['txtbrut']=str_replace(':video',':videourl',$r['txtbrut']);
$ret='['.$r['suj'].'§h2:balise]';
if($r['source'] or $r['author'])
$ret.='[['.$r['source'].':b] ['.$r['author'].':u]:div]';//['.$r['id'].':pub]
if($r['trkbrut'])$ret.='['.$r['trkbrut'].':div]';
$ret.='[['.$r['opt'].':b] ['.$r['player'].':u] ('.$r['day'].'):div]';
$ret.='['.$r['txtbrut'].':div]';
return '['.$ret.':div]';}*/

//utils
/*function autocomp2(id){var ob=getbyid(id); var k=ob.value.substr(-1); pr(k);//dnt works
	//if(k=='"')v='"';//lol
	if(k=='(')v=')';
	if(k=='[')v=']';
	if(k=='{')v='}';
	if(k=='$')v="='';";
	if(v){ob.value+=v; k='';}}*/

//umrec
/*elseif($idy){
	//if(auth(6) && $from && $idy){update('qdi','re',2,'id',$idb); 
		update('qdi','name',$from,'id',$idb);}
	$idy=clean_tw($idy,1); $idy=clean_line($idy); $idy=div('',$idy);}*/

//lib
//function mtime(){list($m,$s)=explode(' ',microtime()); return substr($s,5)+substr($m,0,-2);}
//function divb($p,$v){return '<div'.atbb($p).'>'.$v.'</div>';}

#2102

/*function goodenc($d){
$d=html_entity_decode_b($d);
$d1=utf8_decode_b($d); $no=0;
$r=['??']; foreach($r as $k=>$v)if(strpos($d,$v))$no=1;
return $no?$d:$d1;}*/

//finder
///reader
//case('.flv'):$ret.=lj('','popup_popvideo___'.ajx($f),self::pic('play',32)); break;
//case('.swf'):$ret.=self::show_swf(host().'/'.$f); break;//popswf($d);
/*static function show_swf($f){list($w,$h)=self::sizes($f);
return lj('','popup_swf___'.ajx($f).'_'.$w.'_'.$h,self::pic('play'));}*/

//video
///reader//ted
//return '<embed src="http://video.ted.com/assets/player/swf/EmbedPlayer.swf"  width="100%" height="100%" allowFullScreen="true" flashvars="vu='.$d.'&vw=100%&vh=100%&ap=0&lang='.ses('lang').'&ti='.$ti.'"></embed>';}
//rutube
//'<embed src="http://video.rutube.ru/'.$d.'" type="application/x-shockwave-flash" wmode="window" width="100%" height="auto" allowFullScreen="true">';
//elseif($p=='livestream')return iframe('http://cdn.livestream.com/embed/'.$d.'?layout=4&height='.$h.'&width='.$w.'&autoplay=false',$w,$h);

//ajax
//case('swf'):req('pop'); $t='swf'; $ret=embed_flsh($id,$va,$opt,''); break;
//case('slider'):reqp('slider'); $ret=slider_build($id,$va,$opt); break;

//pop
///connectors
//case(':slider'):return mk::slider($d,$id,$nl);break;
//case(':photo1'):return plugin('flashgallery',$d,$id);break;
//case(':swf'):return popswf($d); break;

/*function slider($d,$id,$nl){//_a
if($nl)return; list($f,$l,$h)=subparams($d);//w/h§name
$w=$w?$w:$w=cw(); $h=$h?$h:$w*(3/4);
$clrs=getclrs();
if(!$f)$nod=$id; else $nod=$f;
$fvars='&servr='.host().'/&rot='.$nod.'&clr='.$clrs[6];
$nod=str_replace('_','*',$nod); //$file='msql/gallery/'.$nod.'.php'; 
if($_SESSION['USE'])$add=lj('','popup_slider___'.$nod.'_'.$id,picto('edit'));
return embed_flsh('fla/slider.swf',$w,$h,$fvars).$add;}*/

/*function popswf($d){
list($d,$t)=cprm($d); list($dc,$w,$h)=swf_size($d); $s='';
if(!$t)$t=strend($d,'/'); $im=picto('popup'); if($im)$t=$im.' '.$t; //patch_image($dc);
if(substr($dc,0,4)!='http')$s=btn('txtsmall',round(filesize($dc)/1024).'Ko');
return lj('popbt','popup_swf___'.ajx($dc).'_'.$w.'_'.$h,$t).' '.btn('txtsmall2',$s);}*/

/*function swf_size($doc){//_a
list($dc,$w,$h)=subparams($doc);//w/h§name
if(substr($dc,-4)!='.swf')$dc.='.swf'; $dc=goodroot($dc,1);
if(!$w && is_file($dc))list($w,$h)=getimagesize($dc);
if(is_numeric($w))$w.='px'; else $w='100%';
if(is_numeric($h))$h.='px'; else $h='400px';
return [$dc,$w,$h];}*/

#flash
/*function embed_flsh($fl,$xf,$yf,$fvar){$fl=substr($fl,0,4)!='http'?'../'.$fl:$fl;
return '<embed src="'.$fl.'" width="'.$xf.'" height="'.$yf.'" wmode="transparent" FlashVars="'.$fvar.'" quality="high" allowfullscreen="true" />';}
function flash_prep($f,$id){if($f)list($movie,$l,$h)=swf_size($f);
return embed_flsh($movie,$l,$h,$fvar);}*/

//spe
/*function thumb_name($d,$w,$h){
return 'imgc/'.$_SESSION['qb'].'_'.$w.'x'.$h.'_'.$d;}*/

/*function popim_w($im,$d){$sz=read_file('http://'.$d.'/plug/microsql.php?fwidth=../'.$im);
list($w,$h)=explode('_',$sz); $imj=ajx('http://'.$d.'/'.$im);
return ljb('','SaveBf','photo_'.$imj.'_'.($w).'_'.($h).'_'.$id,picto('img'));}*/
//function popthumb($im,$s=''){return popim($im,make_thumb_c($f,$s,1));}

//pop
/*function make_mini_b0($d,$id){
list($im,$siz)=split_one('§',$d,1); if(!$siz)$siz=prmb(27);
$img=mk::thumb_d($im,$siz,$id);
return popim($im,$img,$id);}*/

//web
/*static function metas_youtube($u){
$id=strend($u,'=');
//$d=get_file(http($u)); //$d=file_get_contents(http($u));
$d=vaccum_ses(http($u),''); $dom=dom($d);//eco($d);
$ti=embed_detect($d,'<meta name="title" content="','"');
if(!$ti)$ti=embed_detect($d,'title\":\"','",');
if(!$ti)$ti=dom_detect($d,'::title');
if(!$ti)$ti=dom_detect($d,'title:name:meta');//official yt
if(!$ti)$ti=dom_detect($d,'title style-scope::h1');
//if(!$ti){req('tri'); list($ti)=vacuum(http($u));}
if($ti)$ti=utf8_decode_b(trim(strip_tags(stripslashes($ti))));
//$tx=dom_detect($d,'description:name:meta');//2 times
$tx=dom_extract($dom,'description:name:meta');
if(!$tx)$tx=embed_detect($d,'<meta name="description" content="','"');
if(!$tx)$tx=embed_detect($d,'"description":{"runs":[{"text":"','"}');
if(!$tx)$tx=dom_detect($d,'content::yt-formatted-string');
if($tx)$tx=utf8_decode_b(trim(strip_tags(stripslashes($tx))));
if(strpos($tx,'Please tell us why')!==false)$tx='';
$im='https://img.youtube.com/vi/'.$id.'/hqdefault.jpg';
$r=[etc($ti,255),etc($tx),$im];
return $r;}*/

#2101

//lib
/*function chrono($d=''){static $t; static $start; static $cum; $mtm=mtime();
$top=round(($mtm-$start),5); $start=$mtm; $ret='';
if($d!=$t){$ret=$d.': '.$top.'s'; $t=$d; $cum=0;} 
elseif($t){$cum+=$top; $ret.='start: '.$cum.'ms';}
if($d)return btn('txtsmall2',$ret).' ';}*/

/*function doublons($b,$c){$b=$_SESSION[$b];
return qrw(qr('SELECT COUNT(*) AS nbr_doublon, '.$c.' FROM '.$b.' GROUP BY '.$c.' HAVING COUNT(*)>1'));
return qrw(qr('SELECT tab1.id, tab1.url, tab2.id, tab2.url FROM '.$b.' tab1, '.$b.' tab2
WHERE tab1.'.$c.'=tab2.'.$c.'  AND tab1.id<>tab2.id 
AND tab1.id=(SELECT MAX(id) FROM pub_web tab WHERE tab.'.$c.'=tab1.'.$c.')'));}
function killdoublons($b,$c){$b=$_SESSION[$b];
return qrw(qr('DELETE t1 FROM '.$b.' AS t1, '.$b.' AS t2 WHERE t1.id > t2.id AND t1.'.$c.' = t2.'.$c.''));
return qrw(qr('DELETE FROM '.$b.' WHERE id IN
(SELECT tab2.id FROM '.$b.' tab1, '.$b.' tab2 WHERE tab1.'.$c.'=tab2.'.$c.' AND tab1.id<>tab2.id
AND tab1.id=(SELECT MAX(id) FROM '.$b.' tab WHERE tab.'.$c.'=tab1.'.$c.'))'));}*/

//function calc_date($d){return ses('daya')-86400*(is_numeric($d)?$d:1);}//

?>