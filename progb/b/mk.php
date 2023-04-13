<?php //mk for conns
class mk{

static function pub_css($d){[$d,$o]=cprm($d); return btn($o,$d);}
static function pub_div($d){[$d,$o]=cprm($d); return divc($o,$d);}
static function pub_font($d){[$d,$o]=cprm($d); return bts('font-family:'.$o,$d);}
static function pub_float($d){[$d,$o]=cprm($d); return divs('float:'.($o?'right':'left'),$d);}
static function pub_clr($d,$o=''){if(!$o)[$d,$o]=cprm($d); return bts('color:'.$o,$d);}
static function pub_bkgclr($d){[$d,$o]=cprm($d); return bts('background-color:'.$o,$d);}
static function pub_size($d){[$d,$o]=cprm($d); $s='font-size:'.$o.'px; line-height:'.round($o*1.2).'px;';
return tag('font',['style'=>$s],$d);}
static function pub_html($d){[$p,$o]=split_right('§',$d); $r=explode_k($o,' ','=');
$ra=['css'=>'class','font'=>'font-family','size'=>'font-size']; $rb=colors(); $atb='';
foreach($r as $k=>$v){if($k=='color')$v=$rb[$v]?$rb[$v]:'#'.$v; $atb.=(isset($ra[$k])?$ra[$k]:$k).':'.$v.'; ';}
return bts($atb,$p);}
static function pub_url($d,$id){[$p,$o]=prepdlink($d);
if(is_img($o))return self::popim($o,$p,$id);
return lk($p,$o);}
static function stabilo($d){[$d,$o]=cprm($d);
if($o=='orange')$o='#ffc478'; elseif($o=='blue')$o='#78fffa';
elseif($o=='green')$o='#a1ff78'; elseif(!$o)$o='rgba(255,230,0,0.8)';
return bts('color:black; background-color:'.$o,$d);}
static function caviar($d){$n=strlen($d); $ret='';
for($i=0;$i<$n;$i++)$ret.=substr($d,$i,1)==' '?' ':"&blk34;";//&block;
return $ret;}
static function imgtxt($v){[$p,$o]=cprm($v);
return imgtxt::home($p,$o,'');}
static function webview($d,$id){[$u,$v]=cprm($d); $lk=lka($u,$v);
return togbub('web,call',ajx($u).'_0_'.$id,picto('acquire')).sep().$lk;}

static function wiki($d,$o){[$u,$v]=cprm($d);
if($o)return wiki::call($u,1);
if(substr($u,0,4)!='http')$u='https://fr.wikipedia.org/wiki/'.urlutf($u);
return togbub('wiki,call',ajx($u).'_1',picto('wiki2')).' '.lka($u,$v);}

static function wiktionary($d,$o){[$u,$v]=cprm($d);
if($v=='1')return wiktionary::call($u,1);
else return togbub('wiktionary,call',ajx($u).'_1',picto('wiki')).' '.lka($u,$v);}

static function webpage($u){[$u,$v]=cprm($u); $t=$v?$v:preplink($u);
return lj('txtcadr','popup_suggest,sugimport___'.ajx($u),picto('get').$t);}//sugg_import

static function wlink($d){[$p,$t]=cprm($d);
return lkt('',goodroot($p),$t?$t:preplink($p));}

static function download($d,$t=''){//$f=goodroot($f);//root_security
if(strpos($d,'§'))[$d,$t]=split_one('§',$d); [$f,$nm]=prepdlink($d); if($t==1)$t=strend($d,'/');
if(!is_file($f))$g='img/'.$f; if(!is_file($f))$f='users/'.$f;
if(is_http($d))return lkc('small',$d,pictxt('chain',$t));//$nm
elseif(is_file($f)){$size=' '.btn('small','('.fsize($f,1).')'); $nbd=self::nbdwnl($f);
	return lk('app/download/'.base64_encode($f),pictxt('download',$t)).$size.$nbd;}//.' '.$nm
else return btn('small',$nm.' (file not exists)');}

static function make_li($d,$ul){$ret='';
//[$d,$n]=cprm($d); //atb('start',$n)
if(strpos($d,'¬'))$r=explode('¬',$d); else $r=explode("\n",$d);
foreach($r as $v){if(substr($v,0,1)=='-')$v=substr($v,1); $v=trim($v);
	if(strpos($v,'<li')!==false)$ret.=$v; elseif($v)$ret.=li($v);}
if($ret)return tagb($ul,$ret);}

static function footlist($d,$id){$i=1; $ret='';
if(strpos($d,'|'))$r=explode('|',$d); else $r=explode("\n",$d);
foreach($r as $k=>$v)if(trim($v)){$v=trim($v); if(substr($v,0,1)=='-')$v=substr($v,1);
	$ret.='['.lka(urlread($id).'#nh'.$i.'" name="nb'.$i,$i).'] '.$v.br(); $i++;}
if($ret)return tagb('footer',$ret);}

static function iframe_bt($d,$m,$nl){
[$u,$t]=cprm($d); $t=$t==1?nms(194):$t; $bt=lkt('',$u,picto('url'));
if($nl)return lk($u);
elseif($m==3 && !$t)return iframe($d,'100%','').lkc('small',$u,domain($u)).br();
else return lj('txtx','popup_usg,iframe__3_'.ajx($u),pictxt('window',$t)).' '.$bt;}

static function fb_bt($u){
if(strpos($u,'facebook.com/plugins/video')!==false)return lkt('txtx',$u,pictxt('movie',domain($u)));
return lj('txtx','popup_usg,fbcall__3_'.ajx($u),pictxt('fb2',domain($u)));
return lkt('txtx',$u,pictxt('fb2',domain($u)));}

static function instagram($d,$id){
return 'https://www.instagram.com/p/'.$d;}

static function popurl($d){
return lj('','popup_sav,batchpreview__3_'.ajx(nohttp($d)),preplink($d).' '.picto('get'));}

static function img_fluid($d){
[$im,$h]=split_one('§',$d,1); $h=is_numeric($h)?$h:200; $im=goodroot($im);
$s='height:'.$h.'px; background-image:url(/'.$im.'); background-size:cover; background-attachment:fixed;';
return div(ats($s),'');}

static function lastup($v,$id){
$r=art::metart($id); $d=$r['lastup']??'';
if(!$d){$d=time(); meta::utag_sav($id,'lastup',$d);}
if($d)return btn('txtsmall2',nms(118).' : '.mkday($d,1));}

static function table($d){
[$d,$o]=cprm($d); $s='¬';
if($o=='div')return self::dtable($d);
if(strpos($d,'¬')===false && $o=='no')$s='¬';
elseif(strpos($d,'¬')===false or $o=='esc')$s="\n";
$r=explode($s,$d); foreach($r as $k=>$v)$ret[]=explode('|',$v);
return tabler($ret,$o==1?1:'','');}

static function dtable($d){$r=explode("\n",$d); $rc=[];
foreach($r as $k=>$v){$rb=explode('|',$v); $rt=[];
foreach($rb as $ka=>$va)$rt[]=$va; $rc[]=$rt;}
return divtable($rc);}

static function pdfdoc($da,$nl='',$pw=640){
[$p,$o]=prepdlink($da); $p=goodroot($p);
if(is_img($o))$im=conn::place_image($o,'',$nl,$pw,''); else $im='';
if($nl)return lkt('',$p,$im?$im:$o);
$lk=lkt('',$p,$o?$o:picto('pdf'));
return lj('','popup_mk,pdfreader__xr_'.ajx($p).'_'.ajx($o).'__autowidth',$im?$im:picto('pdf')).' '.$lk;}

static function pdfplayer($d,$s=''){if(!$s)$s=get('sz');
return obj($d,'application/pdf',$s?'width:920px; height:640px;':'');}

static function pdfreader($d,$prw){[$d,$t]=cprm($d);
if(substr($d,-3)!='pdf')$d.='.pdf';
if(substr($d,0,4)!='http')$d=host().'/users/'.$d; //$hlp=hlpbt('pdf');.$hlp
if($prw==3 && !$t)return self::pdfplayer($d).lk($d,pictxt('pdf',domain($d)));
if(!$t or $t==1)$t=domain($d);
return lk($d,picto('pdf')). ' '.lj('','popup_mk,pdfplayer__15_'.ajx($d).'_'.ajx($t).'__autowidth',$t);}

static function bkg($v,$id){[$d,$p]=cprm($v); if(!$p){$p=$d; $d='';}
if($p)$mg=$p; else{$imgs=sql('img','qda','v',$id); $mg=pop::art_img($imgs,$id);}
$f=goodroot($mg,1);
if(file_exists($f))[$w,$h]=getimagesize($f);
return divs('background-image: url(/img/'.$mg.'); background-repeat:no-repeat;  background-position:center center; background-size:cover; background-attachment:fixed; height:90%;',$d);}//'.$h.'px

static function cols($d,$m){[$p,$o]=cprm($d);
if($m>2)return pop::columns($p,$o); else return $p;}

static function block($d,$m){[$p,$o]=cprm($d); if(!$o)$o=3;
if($m<3)return $p; if($o<10)$sz=ceil(100/$o).'%'; else $sz=$o.'px';
return divs('display:inline-block; width:'.$sz.'px; margin:0 10px;',$p);}

static function artwork($d,$m=''){
if(!$d)return; $nbo=0; $n=','; $r=explode(',',$d.$n); $ret='';// or $m<3
foreach($r as $k=>$v){$nb=substr_count($v,'-'); $id=substr($v,$nb);
	if($id){$ret.=pop::openart($id.'§'.tagb('h'.$nb,ma::suj_of_id($id)));}}
return $ret;}

static function artlook($d){[$p,$o]=cprm($d);
return lj('','popup_art,look___'.$p.'_'.ajx($o).'_1',pictxt('enquiry',$o));}

static function frame($d,$m){
[$d,$c]=cprm($d); if(!$c)$c='red'; //if($m<3)return $d;
$r=['white','blue','green','cyan','yellow','purple','orange','black'];
if(in_array($c,$r))return divc('frame-'.$c,$d);
return divs('padding:6px; border:1px solid '.$c,$d);}

static function underline($d,$m){$sty='1px solid';
[$d,$c]=cprm($d); if(!$c)$c='red'; //if($m<3)return $d;
if($c=='double'){$sty='3px double'; $c='black';}
return bts('border-bottom:'.$sty.' '.$c,$d);}

static function nh($d,$id,$nl){static $i; $i++;//.'-'.$i
if(!$nl)return togbub('usg,nbp',$d.'-'.$i.'_'.$id,$d,'',atn('nh'.$d),0);//over
else return '<a href="#nb'.$d.'" id="nh'.$d.'">'.$d.'</a>';}

static function nb($d,$id,$nl){
if(!$nl)return lk(urlread($id).'#nh'.$d,$d,atn('nb'.$d).atc('note'));
else return '<a href="#nh'.$d.'" id="nb'.$d.'">'.$d.'</a>';}

static function nbdwnl($f){$f=normalize($f);
if(strrpos($f,"/")!==false)$f=substr($f,strrpos($f,"/")+1);
if(strrpos($f,".")!==false)$f=substr($f,0,strrpos($f,"."));
$f='_datas/dl/'.nod($f).'.txt'; mkdir_r($f);
if(is_file($f)){$nb=read_file($f); return btn("txtsmall",':: '.$nb.' downloads');}}

#mecanics
static function plan($id,$m,$d,$lk=''){
[$t,$o]=cprm($d); if($t==1)$t=''; if($t)$t=btn('txtcadr',$t);
if(!is_numeric($id) or $m<3)return;
$d=sql('msg','qdm','v','id="'.$id.'"');
$r=explode("\n",$d); $ret=[]; $rb=[]; $rt=[]; $n1=0; $n2=0; $n3=0; $n4=0;
foreach($r as $k=>$v)switch(substr($v,-3)){
	case('h1]'):$rb[0][$k]=1; $rt[$k]=str::stripconn($v); $n1=$k; break;
	case('h2]'):$rb[$n1][$k]=1; $rt[$k]=str::stripconn($v); $n2=$k; break;
	case(':h]'):$rb[$n1][$k]=1; $rt[$k]=str::stripconn($v); $n2=$k; break;
	case('h3]'):$rb[$n2][$k]=1; $rt[$k]=str::stripconn($v); $n3=$k; break;
	case('h4]'):$rb[$n3][$k]=1; $rt[$k]=str::stripconn($v); $n4=$k; break;
	case('h5]'):$rb[$n4][$k]=1; $rt[$k]=str::stripconn($v); break;}
if(!isset($rb))return; $ret=self::taxonomy($rb,1);
if($lk && $rt)foreach($rt as $k=>$v)$rt[$k]=lk('/'.$id.'#h'.$k,$v);
if($o)return $t.divc('ulnone',self::make_ulb($ret[0],$rt,'ul'));
if($ret[0]??'' and is_array($ret[0]))return $t.divc('topology',self::make_ul($ret[0],$rt,'ol'));}

//mk_plan
static function make_ul($r,$rt,$ul='',$o=''){$ret='';
if($r)foreach($r as $k=>$v){$bt=$rt[$k]??'';
	if(is_array($v))$bt.=self::make_ul($v,$rt,$ul,$o);
	$ret.=tag('li',['type'=>$o],$bt);}
return tagb($ul,$ret);}

static function make_ulb($r,$rt,$ul='',$o=''){$ret=''; $i=0;//topologic
foreach($r as $k=>$v){$bt=$rt[$k]; $i++;
	if(is_array($v))$bt.=self::make_ulb($v,$rt,$ul,($o?$o.'.':'').$i.'');
	$ret.=tagb('li',($o?$o.'.':'').$i.'. '.$bt);}
return tagb($ul,$ret);}

//taxonomy
static function taxo_clean(&$r,$rb){
if($rb)foreach($rb as $k=>$v)if(isset($r[$v]))unset($r[$v]);}

static function taxo_find(&$rx,$ra,$rb){$rt=[]; $rx=[];
foreach($rb as $k=>$v){
	if(isset($ra[$k])){
		if(is_array($ra[$k]))
			$rt[$k]=self::taxo_find($rx,$ra,$ra[$k]);
		else $rt[$k]=$ra[$k];
		$rx[]=$k;}
	else $rt[$k]=$v;}
return [$rx,$rt];}

//$r[idp][id]=1
static function taxonomy($r){$ra=$r; $rx=''; $rt=[];
foreach($r as $k=>$v){
	if(is_array($v))
		$rt[$k]=self::taxo_find($rx,$ra,$v);
	else $rt[$k]=$v;}
self::taxo_clean($rt,$rx);
return $rt;}

static function typo($d,$o){$ret='';
$ra=str_split($d); $n=count($ra);
$rb=msql::read('system','edition_ascii_8');
if(!is_numeric($o)){$k=in_array_r($rb,$o,1); $o=$rb[$k][0];} $na=$rb[$o][0];
$rd=array_flip(str_split('ARCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'));
foreach($ra as $k=>$v)if(is_numeric($v))$ret.=asciinb($v);
else $ret.=strpos(' ?./§,;:!$*',$v)!==false?$v:chr_b($na+$rd[$v]);
return $ret;}

static function scan_txt($d,$m){
[$f,$t]=split_one('§',$d,1); $ret='';
$f=goodroot($f); $tb=strend($f,'/'); if($t && $t!=1)$tb=$t;
if($m<3 or $t)return lj('txtx','popup_mk,scan*txt___'.ajx($f).'_3',pictxt('doc',$tb));
else{$ret=read_file($f); if($t==1)$ret=conn::read(conv::call($ret),'','');}
return $ret."\n\n".lkt('txtx',$f,$tb);}

static function translate($d,$m){if($m<3)return $d;
[$d,$lg]=cprm($d,'§');
$lng=ses('lng'); $setlg=$lng.'-'.$lg; $ref=rid($d,11);
$ret=trans::callxt($d,$ref,$setlg,0);
return divc('trkmsg',$ret);}

//:msql
static function msqplay($r,$o=''){
$head=isset($r['_menus_'])?array_shift($r):'';
if(is_array($r)){
	if($o)$r=array_reverse($r);
	$ret=tabler($r,$head);
	return scroll($r,$ret,20,'',640);}
return $r;}

static function msqcall($com,$id,$o){
if(strpos($com,'§'))[$d,$p]=split_one('§',$com,1); else $d=$com; if(isset($p))$o=$p;
if(strpos($o,'|'))[$oa,$ob]=opt($o,'|'); else{$oa=$o; $ob='';}
switch($oa){
	case('pop'):return self::microread_pop($d); break;
	case('tmp'):return self::microread($d); break;
	case('conn'):return self::msqconn($d,$id,$ob); break;
	case('last'):return self::msqlasts($d,$ob); break;
	case('count'):return self::msqcount($d); break;
	case('bin'):return self::msqbin($d); break;
	case('graph'):return self::msqgraph($d); break;
	case('data'):return self::msqdata($d,$id); break;
	case('form'):return microform::home($d,$id); break;
	case('twit'):return self::msqtwit($d,$id); break;
	case('twusr'):return self::msqusrs($d,$id); break;}
[$b,$nd]=split_right('/',$d);
$r=msql::goodtable_b($com); $bt=msqbt($b,$nd).csvfile($com,$r);
if(is_array($r))return self::msqplay($r,$o).$bt; else return $r;}

static function msqtwit($d,$id){
$r=msql::read_b('',$d,'',1); $rb=[]; $img='';
if($r)foreach($r as $k=>$v){
	$im=img::make_thumb_c($v[5],'48/48',1); if($im)$img='[img:var]'; else $img='[[img:var]:distimg]';
	$rb[$k]=['img'=>$im?$im:$v[5],'name'=>$v[2],'screen'=>$v[1],'txt'=>stripslashes($v[4])];}
$tmp='['.$img.' [name:var] (@[screen:var]) [[txt:var]:small]$trkmsg:divc]';//
$ret=vue::call($tmp,$rb);
return divc('scroll',$ret);}

static function microread_pop($d){[$p,$o]=cprm($d);
return lj('','popup_msql___'.ajx($p),pictxt('msql2',$o));}

static function msqconn($d,$id,$ob){$bt='';
[$d,$p]=split_one('§',$d);
$r=msql::goodtable($d);
[$b,$nd]=split_right('/',$d);
if(auth(6))$bt=msqbt($b,$nd);
if($r)foreach($r as $k=>$v)foreach($v as $kb=>$vb)$r[$k][$kb]=conn::parser(str::embed_links($vb));
return self::msqplay($r,$ob).$bt;}

static function msqlasts($d,$ob){[$d,$l]=split_one('§',$d,1);
$r=msql::goodtable($d); $n=count($r); $l=$l?$l:10; $l*=-1;
$r=array_slice($r,$l,$n,true); arsort($r);
return self::msqplay($r,$ob);}

static function msqcount($d){$r=msql::goodtable($d);
$n=count($r); if($n)return $n-1;}

static function msqbin($d){
$r=msql::goodtable($d);
$ima=picto('no'); $imb=picto('valid');
if(is_array($r)){
foreach($r as $k=>$v){
	if(is_array($v)){foreach($v as $ka=>$va){
		if($va=='0')$r[$k][$ka]=$ima; elseif($va==1)$r[$k][$ka]=$imb;}}
	else{if($v==0)$r[$k]=$ima; elseif($v==1)$r[$k]=$imb;}}
return tabler($r,1);}}

static function msqgraph($d){static $n; $n++; $i=0; $pw=prma('content');
[$da,$rep]=split_one('§',$d,1); [$nd,$bs,$va,$op]=explode('_',$da);
if($bs){$nd=$nd?$nd:ses('qb');}else{$nd=ses('qb'); $bs=$d;}
$r=msql::goodtable($da); $menu=$r['_menus_']; unset($r['_menus_']);
if($r && $rep)foreach($r as $k=>$v){$i++; $bit[$k]=$v[$rep];}
elseif($r && $op){foreach($r as $k=>$v){$i++; $bit[$k]=$v;}}
$output='/imgc/'.ses('qd').'_'.ses('read').'_graph_'.$n.'.png';
img::graphics($output,$pw,140,$bit,getclrs('',7),'yes');///
if(get('read'))return image($output,'','" style="border:0;')."\n";}

static function microread($d){[$nod,$tmp]=cprm($d);
return msqlvue::call($nod,$tmp);}

static function msqdata($d,$id){
[$v,$k]=split_right('§',$d); $k=$k?$k:1;
if($v){$ra=[$v];
	if($k){$msg=sql('msg','qdm','v',$id);
	$msg=str_replace($d.':msq_data',$k.':msq_data',$msg);
	sql::upd('qdm',['msg'=>$msg],$id);}
$r=msql::create('art_'.$id,$ra,['txt'],$k); return $r[$k][0];}
else $ret=msql::row('',nod('art_'.$id),$k);
if(auth(3))$ret.=msqbt('',ses('qb').'_art_'.$id,$k);
return $ret;}

static function msqusrs($d,$o=''){
[$d,$p]=split_one('§',$d);
$r=msql::goodtable($d);
[$b,$nd]=split_right('/',$d);
if(auth(6))$bt=msqbt($b,$nd); $csv=csvfile($b.$nd,$r);
$rb=twit::render_usrs($r); $ret=tabler($rb);
return divc('scroll',$ret).msqbt('',$nd).$csv;}

//:thumb
static function thumb_d($im,$sz,$id){//web,vue,codeline
[$w,$h]=opt($sz,'/'); if(!$w)$w=cw();
if(substr($im,0,4)=='http')$imn=ses('qb').'_'.$id.'_'.substr(md5($sz),0,6).xt($im);
elseif(strpos($im,'/')!==false)$imn=str_replace('/','',$im); else $imn=$im;
$imb=img::thumbname($imn,$w,$h); $im=goodroot($im);
if(is_file($im) or substr($im,0,4)=='http'){$lmt='';//$_SESSION['rstr'][16];
	if(!file_exists($imb) or ses('rebuild_img'))make_mini($im,$imb,$w,$h,$lmt);
	return image($imb,$w,$h);}
else return picto('img',48);}

static function mini_d($da,$id,$nl){//im§w/h//conn_thumb//codeline
[$v,$p]=split_one('§',$da,1); $img=self::thumb_d($v,$p,$id);
if($nl)return image(goodroot($v),cw(),'');
else return self::popim($v,$img,$id);}

//:mini
static function mini_b($d,$id){//mode w/h max//adlin
[$im,$sz]=split_one('§',$d,1); if(!$sz)$sz='320/320';//prmb(27);
[$w,$h]=explode('/',$sz); [$wo,$ho,$ty]=getimagesize('img/'.$im);
[$w,$h]=img::sz($wo,$ho,$w,$h); $imb=img::thumbname($im,$w,$h);
if(!file_exists($imb) or ses('rebuild_img'))make_mini('img/'.$im,$imb,$w,$h,'');
return self::popim($im,img('/'.$imb),$id);}

//citation
static function citations($d,$c){$d=str_replace("&nbsp;",' ',htmlentities($d));
if($c=='i'){$d=str_replace('&laquo; ','§ [',$d); $d=str_replace(' &raquo;',':i] §',$d);}
if($c=='q'){$d=str_replace('&laquo; ','[§ ',$d); $d=str_replace(' &raquo;',' §:q]',$d);}
$d=str_replace('§ ',"§&nbsp;",$d); $d=str_replace(' §',"&nbsp;§",$d); $d=str_replace(':q].','.:q]',$d);
return html_entity_decode($d);}

//:photos
static function thumb_b($f,$id){$xt=xt($f); $w=200; $h=140;
$imb=img::thumbname(str_replace('/','',$f),$w,$h);
if(!file_exists($imb) or ses('rebuild_img'))make_mini($f,$imb,$w,$h,$_SESSION['rstr'][16]);
return ljb('','SaveBf',ajx($f).'___'.$id,img($imb));}

static function popim($im,$v,$id=''){$w=''; $h=''; $img=goodroot($im);
return ljb('','SaveBf',ajx($im).'___'.$id,$v);}

static function photos($da,$id){
[$r,$src]=self::good_src($da,$id); $ret='';
if(is_array($r))foreach($r as $k=>$v){$xt=xt($v);
	if(!$src)$dir=jcim($v); else $dir=$src;
	if($xt=='jpg' or $xt=='gif' or $xt=='png')$ret.=self::thumb_b($dir.$v,$id);}
return $ret;}

//:gallery
static function gallery($d,$id){
[$r,$src]=self::good_src($d,$id); $ret='';
if($r){rsort($r); foreach($r as $k=>$v){$f=$src.'/'.$v; if(is_file($f))$ret.=image($f);}}
return $ret;}

static function good_src($d,$id){//goodroot()
if(!$d)$d=$id; $src='img/'; $r=[]; if(strpos($d,"\n")!==false)$d=str_replace("\n",'',$d);
if(strpos($d,',')!==false)$r=explode(',',$d);
elseif(strpos($d,'/')!==false){if(substr($d,-1)!='/')$d.='/'; $src='users/'.$d; $r=explore($src,'files',1);}
elseif(is_numeric($d)){$ims=sql('img','qda','v','id="'.$d.'"'); $r=explode('/',substr($ims,1));}
else $r=[$d];
return [$r,$src];}

//:sliderj//old
static function sliderj($d,$id,$nl){if($nl)return;
[$f,$o]=split_one('§',$d,1);
return sliderJ::home($f,$id,$o);}//

static function sliderslct($da,$id,$d){$w=''; $h=''; $pw='';//to revise
[$id,$idn]=explode('-',$id); $dcb=ajx($da,''); $mp='impos'.$idn;
[$r,$src]=self::good_src($da,$id); $nb=count($r);
if(is_numeric($d))$_SESSION[$mp]=$d;
	elseif($d=='next')$_SESSION[$mp]++; elseif($d=='prev')$_SESSION[$mp]--;
if($_SESSION[$mp]>=$nb)$_SESSION[$mp]=0;
if($_SESSION[$mp]<0)$_SESSION[$mp]=$nb-1;
if(!$src)$dir=jcim($r[$_SESSION[$mp]]); else $dir=$src;
if(!isset($r[$_SESSION[$mp]]))return 1;
$im=$dir.$r[$_SESSION[$mp]]; $img=image($im,$pw,'');
if(is_file($im))[$w,$h]=getimagesize($im);
if($w>$pw)$ret=ljb('','SaveBf',ajx($im).'_'.($w).'_'.($h),$img);
else $ret=$img;
return $ret;}

//:slider
static function slider($da,$id,$nl){static $i; $i++; $rid='sldr'.$id.'-'.$i;
$j=$rid.'_mk,sliderslct___'.$id.'-'.$i.'_'.ajx($da,''); $_SESSION['impos'.$i]=0; if($nl)return;
$ret=divc('',lj('popbt',$j.'_prev',picto('kleft')).lj('popbt',$j.'_next',picto('kright')));
$img=self::sliderslct($da,$id.'-'.$i,0); if($img==1)return;
$ret.=divd($rid,$img);
return $ret;}

//:juke
static function jukebox($f,$m,$id){[$f,$t]=cprm($f);
if($m<3)return lj('','popup_mk,jukebox___'.ajx($f).'_3',pictxt('music',$t?$t:'Jukebox'));
$r=explore('users/'.$f); $ret=''; $rb=[];
if($r)foreach($r as $k=>$v)$rb[ftime('users/'.$f.'/'.$v)]=$v; if($rb)krsort($rb);
if($rb)foreach($rb as $k=>$v)$ret.=lj('','juke'.$id.'_call___pop_audio_'.ajx('users/'.$f.'/'.$v).'§'.ajx($v).'_'.$id,ascii('speaker').' '.$v);//pictxt('music',$v)
$bt=divd('juke'.$id,audio('users/'.$f.'/'.$r[0],$id,$r[0]));
return $bt.divc('list',$ret);}

//:modpop
static function modpop($d){
return lj('','popup_mod,callmod__3_'.ajx($d),picto('get'));}

//:form
//$d='date=date,choix1/choix2=list,entr§e1,entr§e2,message=text,image=upload,mail=mail,ok=button';
static function form($d,$tg,$p=''){
$prod=explode(',',$d); $n=count($prod); $ret=''; $ia=0;
for($i=0;$i<$n;$i++){[$val,$type]=explode('=',$prod[$i]); $vb=normalize($val);
if($type=='check'){$chk='chk'.($ia++); $hn[]=$chk;} elseif($type!='button')$hn[]=$vb;
switch($type){
	case('text'):$ret.=textarea($vb,'',44,8);break;
	case('check'):$ret.=checkbox($chk,'no','',''); break;
	case('hidden'):$ret.=hidden($vb,$val);break;
	case('uniqid'):$ret.=hidden($vb,ses('iq'));break;
	case('list'):$ret.=select(['id'=>$vb],explode('/',$val),'vv'); break;
	case('date'):$ret.=hidden($vb,mkday('','ymd.his')); break;
	case('upload'):$ret.=inputb($vb,'url','',1); break;
	case('button'):$btn=$val;break;
	case('mail'):$ret.=inputb($vb,'','20',$val,'',['onkeyup'=>'num_mail(\''.$vb.'\');']); break;
	default:$ret.=inputb($vb,'',20,'',255,['name'=>$val]);break;}
if($type!='button' && $type!='date' && $type!='hidden' && $type!='uniqid')
	$ret.=' '.label($vb,$val,'txtsmall2').br();}
$ret.=lj('popsav',$tg.'_'.implode(',',$hn).'__'.$p,$btn?$btn:picto('ok'));
return divd($tg,$ret);}

#quotes
//called by art_read_c
static function find_quotes($d,$id,$s,$pad,$l2){static $dc=0;//decal because of previous results
$d=htmlentities($d);
$d=str_replace("&laquo;",'§',$d); $d=str_replace("&raquo;",'§',$d); $d=str_replace("&nbsp;",' ',$d);
$d=html_entity_decode($d); //$pad=str::clean_punct($pad);
$l=mb_strlen($pad); $s2=0; if($dc)$s+=$dc*$l2;//lenght to add
$s2=mb_strpos($d,$pad,$s); if(!$s2)$s2=strpos($d,$pad,$s); if(!$s2)$s2=strpos($d,$pad);
if($s2){$d1=mb_substr($d,0,$s2); $d2=mb_substr($d,$s2,$l); $d3=mb_substr($d,$s2+$l);}
else{$d1=$d; $d2=''; $d3='';} $dc++;
return [$d1,$d2,$d3];}

static function apply_quote2($d,$id,$s,$pad,$idtrk){
$nh=ljb('','scrolltoob','qnb'.$s,picto('arrow-down'),atd('qnh'.$s));
[$d1,$d2,$d3]=self::find_quotes($d,$id,$s,$pad,10+strlen($idtrk)+strlen($nh));
if($d2){$d2=preg_replace('/(\n){2,}/',br().br(),$d2);
	return $d1.'['.$d2.'§'.$idtrk.':quote2]'.$nh.$d3;}
else return $d;}

//highlight begin
static function allquotes($id){
$msg=sql('msg','qdm','v','id="'.$id.'"');
$r=sql('id,name,msg','qdi','','ib="'.$id.'"');
if($r)foreach($r as $k=>$v){$rb=explode(':callquote]',$v[2]); $n=count($rb);
	if($n>1){foreach($rb as $ka=>$va){$s1=strrpos($va,'['); $va=substr($va,$s1+1); [$p,$s]=cprm($va);
		if($s)$msg=self::apply_quote2($msg,$id,$s,$p,$v[0]);}}}
return div(atb('ondblclick','useslct(this,\''.$id.'\')'),conn::read($msg,3,$id,''));}

//ephemeral conn
static function quote2($d,$id){[$p,$o]=cprm($d); return self::stabilo($p);//from art, built by find_quotes
return togbub('mk,quotrk',$id.'_'.$o.'_'.ajx($p),$p,'stabilo',att('notes'));}

//called by quote2
static function quotrk($id,$s,$pad){//todo
$r=sql('id,name,msg','qdi','','ib="'.$id.'"');
if($r)foreach($r as $k=>$v){$rb=explode(':callquote]',$v[2]); $n=count($rb);
	if($n>1){foreach($rb as $ka=>$va){$s1=strrpos($va,'['); $va=substr($va,$s1+1); [$p,$s2]=cprm($va);
		if($s==$s2)return $p;}}}}

//quotes in trk
static function callquote($d,$idtrk,$id){
if(!$id)$id=sql('ib','qdi','v',$idtrk);
if(!$idtrk)$idtrk=sql('id','qda','v',$id);
[$p,$o]=cprm($d);//from track, go to art_read_c
$nb=ljb('','callquote',[$id,$o,ajx($p),$idtrk],picto('arrow-top'),atd('qnb'.$o));
return tagb('blockquote',$p.' '.$nb);}//find_quotes

//xltags
static function xltags($id,$conn,$msg=''){if(!$msg)$msg=sql('msg','qdm','v','id="'.$id.'"');
return div(atb('ondblclick','xltags(this,\''.$id.'\',\''.$conn.'\')'),conn::read($msg,3,$id,''));}

static function xltagslct($id){$r=['fact','quote','stabilo'];
$j2='art'.$id.'_art,playq___'.$id.'_3_1'; $bt='';//'all',
foreach($r as $k=>$v)$bt.=ljtog('','art'.$id.'_mk,xltags___'.$id.'_'.$v,$j2,$v).' ';
return divc('list',$bt);}

static function slctconn($id,$pad,$s,$conn){if($conn)return self::applyconn($id,$pad,$s,$conn);
$r=['q','fact','quote','stabilo','red','blue','parma','green'];
$ret=divc('trkmsg',$pad); $bt=''; $p=ajx($pad);
foreach($r as $k=>$v)$bt.=lj('','art'.$id.'_mk,applyconn__x_'.$id.'_'.$p.'_'.$s.'_'.$v,$v);
return $ret.divc('nbp',$bt);}

static function applyconn($id,$pad,$s,$conn){$msg=sql('msg','qdm','v','id="'.$id.'"');
[$d1,$d2,$d3]=self::find_quotes($msg,$id,$s,$pad,3+strlen($conn));
if($d2){$msg=$d1.'['.$d2.':'.$conn.']'.$d3; sqlup('qdm',['msg'=>$msg],$id);}
return self::xltags($id,$conn,$msg);}

}
?>