<?php
#philum_pop/

function connlk($da,$id,$m,$nl,$pw){
if(is_image($da) && strpos($da,'§')===false && strpos($da,'<')===false){
	if(substr($da,0,4)=='http' && $id)$da=conn::get_image($da,$id,$m);
	return conn::place_image($da,$m,$nl,$pw,$id);}
if((strpos($da,'§')!==false or strpos($da,'http')!==false) && strpos($da,'<a')===false){//secure double hooks
	list($p,$o)=cprm($da); //echo $p.'§'.$o.br();
	if(is_image($p)){//image§text
		if(substr($p,0,4)=='http')$p=conn::get_image($p,$id,$m);
		if(is_image($o))return popim($p,image(goodroot($o)),$id);//mini
		return popim($p,pictxt('img',$o),$id);
		return figure($p.'§'.$o,$pw,$nl);}
	elseif(is_image($o)){//link§image
		if(substr($o,0,4)=='http')$o=conn::get_image($o,$id,$m);
		if(substr($p,0,4)=='http')return lk($p,conn::place_image($o,$m,$nl,$pw,$id));
		elseif(is_numeric($p))return popim($o,pictxt('img',urlread($p)),$id);
		else return $o;}
	elseif(strpos($p,'.pdf')!==false)return pdfdoc($da,$nl,$pw);
	elseif(strpos($p,'wikipedia.org')!==false)return wiki($da,0);
	elseif(strpos($p,'twitter.com')!==false && strpos($p,'status/')!==false)return poptwit($da,$id,'',$nl);
	elseif(strpos($p,':iframe')){if($nl)return struntil($p,':iframe');
		return lj('','popup_popconn___['.ajx($p).']_'.ajx($o),pictxt('window',$o));}
	elseif(substr($p,0,4)=='http')return rstr(111)&&!$nl?webview($da,$id):lka($p,$o);
	/*elseif(strpos($p,':')){if($nl)return struntil($p,':'); $ic=mime(strend($p,':'),'window');//if isconn
		return lj('','popup_popconn___['.ajx($p).']_'.ajx($o),pictxt($ic,$o));}*/
	elseif(substr($p,0,1)=='/')return lkt('',$p,$o);
	elseif(strpos($p,'/'))return lkt('',goodroot($p),$o);
	elseif(strpos($p,'@'))return lkt('',$p,$o?$o:domain($p));
	elseif(is_numeric($p) && strpos($o,':')===false)return jread('',$p,$o);}}//avoid plugs

function callapp($a,$d){[$p,$o]=cprm($d);//btopen
//return lj('txtx','popup_'.$a.',call___'.ajx($p),picto2($a,'cube').'&#8201;'.($t==1?$p:$t)).'';}
return $a::call($p,$o);}

function btapp($d,$nl=''){
list($p,$o,$c)=decompact_conn($d); list($c,$ob)=cprm($c);//p§o:c§ob
$ic=mime($c,'cube'); $t=pictxt($ic,$ob?$ob:$c); if($ob==1)$t=picto('url');
$u='/app/'.$c; if($p){$u.='/'.$p; if($o)$u.='/'.$o;} if($nl)return lkt('',$u,$t);;
return lj('','popup_popconn___['.ajx($p.($o?'§'.$o:'').':'.$c).']_'.ajx($ob),$t).' '.lkt('',$u,picto('chain'));}

#conn_functions
function clvars(){return array_flip(explode(' ','br html div span size clear id class style name txt url jurl anchor date title cut split'));}//:img:exec:conn
function uconns($p){return msql::val('',nod('connectors'),$p);}
function pconns($p){return msql::val('','public_connectors',$p);}

function figure($d,$pw,$nl){
list($im,$t)=cprm($d); $img=''; $pre=jcim($im,$nl); $ret='';
if(is_image($pre.$im) && strpos($im,'<')===false){
	if(is_file($pre.$im)){list($w,$h)=getimagesize($pre.$im); $img=img($pre.$im);
		if($w>$pw && !$nl)$ret=ljb('','SaveBf','photo_'.ajx($im).'_'.$w.'_'.$h,$img);
		else $ret=image($pre.$im);}
	else{$im=conn::recup_image($im); $pre=jcim($im,$nl); if($im)$ret=img($pre.$im);}}
else $ret=$im;
return balb('figure',$ret.balb('figcaption',$t));}

function pubart($d){list($v,$p)=split_one('§',$d,1);
if($p==1 or $p==2 or $p==3)return art_read_b($v,$p);
elseif($p==4)return delbr(pub_art($v),'');
elseif($p)return popart($v,$p);
elseif(!is_numeric($v)){$id=id_of_urlsuj($v);
	if(!is_numeric($id))return '['.$v.']';
	else return popart($id,$v);}
elseif(is_numeric($v))return jread('',$v,suj_of_id($v));}

function pdfdoc($da,$nl='',$pw=640){
list($p,$o)=prepdlink($da); $p=goodroot($p);
if(is_image($o))$im=conn::place_image($o,'',$nl,$pw,''); else $im='';
if($nl)return lkt('',$p,$im?$im:$o);
$lk=lkt('',$p,$o?$o:picto('pdf'));
return lj('','popup_poppdf__xr_'.ajx($p).'_'.ajx($o).'__autowidth',$im?$im:picto('pdf')).' '.$lk;}

function pdfreader_j($d,$s='',$o=''){//return iframe($d,$s);
//if($o)return iframe('http://docs.google.com/viewer?url='.urlencode($d).'&embedded=true',$s);
return obj($d,'application/pdf',$s?'width:920px; height:550px;':'');}

function pdfreader($d,$prw){if(substr($d,-3)!='pdf')$d.='.pdf';
if(substr($d,0,4)!='http')$d=host().'/users/'.$d; //$hlp=hlpbt('pdf');.$hlp
list($d,$t)=cprm($d);
if($prw==3 && !$t)return pdfreader_j($d).lk($d,pictxt('pdf',domain($d)));
if(!$t or $t==1)$t=domain($d);
return lk($d,picto('pdf')). ' '.lj('','popup_poppdf__15_'.ajx($d).'_'.ajx($t).'__autowidth',$t);}

function mk_bkg($v,$id){list($d,$p)=cprm($v); if(!$p){$p=$d; $d='';}
if($p)$mg=$p; else{$imgs=sql('img','qda','v','id='.$id); $mg=art_img($imgs,$id);}
$f=goodroot($mg,1);
if(file_exists($f))list($w,$h)=getimagesize($f);
return divs('background-image: url(/img/'.$mg.'); background-repeat:no-repeat;  background-position:center center; background-size:cover; background-attachment:fixed; height:90%;',$d);}//'.$h.'px

function mk_cols($d,$m){list($p,$o)=cprm($d);
if($m>2)return columns($p,$o); else return $p;}

function mk_block($d,$m){list($p,$o)=cprm($d); if(!$o)$o=3;
if($m<3)return $p; if($o<10)$sz=ceil(100/$o).'%'; else $sz=$o.'px';
return divs('display:inline-block; width:'.$sz.'px; margin:0 10px;',$p);}

function mk_artwork($d,$m=''){
if(!$d)return; $nbo=0; $n=','; $r=explode(',',$d.$n); $ret='';// or $m<3
foreach($r as $k=>$v){$nb=substr_count($v,'-'); $id=substr($v,$nb);
	if($id){$ret.=openart($id.'§'.bal('h'.$nb,'',suj_of_id($id)));}}
return $ret;}

function mk_artlook($d){list($p,$o)=cprm($d);
return lj('','popup_artlook___'.$p.'_'.ajx($o).'_1',pictxt('enquiry',$o));}

function mk_frame($d,$m){
list($d,$c)=cprm($d); if(!$c)$c='red'; //if($m<3)return $d;
return divs('padding:6px; border:1px solid '.$c,$d);}

function mk_underline($d,$m){$sty='1px solid';
list($d,$c)=cprm($d); if(!$c)$c='red'; //if($m<3)return $d;
if($c=='double'){$sty='3px double'; $c='black';}
return bts('border-bottom:'.$sty.' '.$c,$d);}

function mk_nh($d,$id,$nl){static $i; $i++;//.'-'.$i
if(!$nl)return togbub('nbp',$d.'-'.$i.'_'.$id,$d,'',atn('nh'.$d),0);//over
else return '<a href="#nb'.$d.'" name="nh'.$d.'">'.$d.'</a>';}

function mk_nb($d,$id,$nl){
if(!$nl)return lk(urlread($id).'#nh'.$d,$d,atn('nb'.$d).atc('note'));
else return '<a href="#nh'.$d.'" name="nb'.$d.'">'.$d.'</a>';}

function nb_dwnl($f){$nmf=normalize($f);
if(strrpos($nmf,"/")!==false)$nmf=substr($nmf,strrpos($nmf,"/")+1);
if(strrpos($nmf,".")!==false)$nmf=substr($nmf,0,strrpos($nmf,"."));
$nmf='_datas/'.ses('qb').'_'.$nmf.'.txt';
if(is_file($nmf)){$nb=read_file($nmf);
return btn("txtsmall",':: '.$nb.' downloads');}}

function download($d){//$f=goodroot($f);//root_security
list($d,$t)=split_one('§',$d); list($f,$nm)=prepdlink($d); $nm=$t?$t:strend($d,'/');
if(!is_file($f))$g='img/'.$f; if(!is_file($f))$f='users/'.$f;
if(is_http($d))return lkc('small',$d,pictxt('chain',$nm));
elseif(is_file($f)){$size=' '.btn('small','('.fsize($f,1).')'); $nbd=nb_dwnl($f);
	return lk('plug/download/'.base64_encode($f),pictxt('download',$nm)).$size.$nbd;}//.' '.$nm
else return btn('small',$nm.' (file not exists)');}

function make_li($d,$ul){$ret='';
//list($d,$n)=cprm($d); //atb('start',$n)
if(strpos($d,'|'))$r=explode('|',$d); else $r=explode("\n\n",$d);
foreach($r as $v){if(substr($v,0,1)=='-')$v=substr($v,1);
	if(strpos($v,'<li'))$ret.=$v; elseif(trim($v))$ret.=li(trim($v));}
if($ret)return balb($ul,$ret);}

function footlist($d,$id){$i=1;
if(strpos($d,'|'))$r=explode('|',$d); else $r=explode("\n",$d);
foreach($r as $k=>$v)if(trim($v)){$v=trim($v); if(substr($v,0,1)=='-')$v=substr($v,1);
	$ret.='['.lka(urlread($id).'#nh'.$i.'" name="nb'.$i,$i).'] '.$v.br(); $i++;}
if($ret)return balb('footer',$ret);}

function imgsize($imp){if(is_file($imp))return getimagesize($imp);}
function pub_css($d){list($d,$o)=cprm($d); return btn($o,$d);}
function pub_div($d){list($d,$o)=cprm($d); return divc($o,$d);}
function pub_font($d){list($d,$o)=cprm($d); return bts('font-family:'.$o,$d);}
function pub_float($d){list($d,$o)=cprm($d); return divs('float:'.($o?'right':'left'),$d);}
function pub_clr($d,$o=''){if(!$o)list($d,$o)=cprm($d); return bts('color:'.$o,$d);}
function pub_bkgclr($d){list($d,$o)=cprm($d); return bts('background-color:'.$o,$d);}
function pub_size($d){list($d,$o)=cprm($d);
$sty='font-size:'.$o.'px; line-height:'.round($o*1.2).'px;';
return bal('font',ats($sty),$d);}
function pub_html($d){list($p,$o)=split_right('§',$d); $r=explode_k($o,' ','=');
$ra=['css'=>'class','font'=>'font-family','size'=>'font-size']; $rb=colors(); $atb='';
foreach($r as $k=>$v){if($k=='color')$v=$rb[$v]?$rb[$v]:'#'.$v;
	$atb.=(isset($ra[$k])?$ra[$k]:$k).':'.$v.'; ';}
return bts($atb,$p);}
function pub_url($d,$id){list($p,$o)=prepdlink($d);
if(is_image($o))return popim($o,$p,$id);
return lk($p,$o);}
function stabilo($d){list($d,$o)=cprm($d);
if($o=='orange')$o='#ffc478'; elseif($o=='blue')$o='#78fffa';
elseif($o=='green')$o='#a1ff78'; elseif(!$o)$o='rgba(255,230,0,0.8)';
return bts('color:black; background-color:'.$o,$d);}

function arts_mod($v,$id){
list($p,$t,$d,$o,$ch,$hd,$tp)=explode('/',$v);
$load=api::mod_arts_row($p); unset($load[$id]);
$ret=mod_load($load,'',$t,$d,$o,1,$prw,$tp,$id);
return $ret;}

function caviar($d){$n=strlen($d); $ret='';
for($i=0;$i<$n;$i++)$ret.=substr($d,$i,1)==' '?' ':"&blk34;";//&block;
return $ret;}

function mk_imgtxt($v){list($p,$o)=cprm($v);
return plugin('imgtxt',$p,$o,'');}

function webview($d,$id){list($u,$v)=cprm($d); $lk=lka($u,$v);
return togbub('web,call',ajx($u).'_0_'.$id,picto('acquire')).sep().$lk;}

function wiki($d,$o){list($u,$v)=cprm($d);
if($o)return wiki::call($u,1);
if(substr($u,0,4)!='http')$u='https://fr.wikipedia.org/wiki/'.urlutf($u);
return togbub('app','wiki_call_'.ajx($u).'_1',picto('wiki2')).' '.lka($u,$v);}

function wiktionary($d,$o){list($u,$v)=cprm($d);
if($v=='1')return wiktionary::call($u,1);
else return togbub('app','wiktionary_call_'.ajx($u).'_1',picto('wiki')).' '.lka($u,$v);}

function webpage($u){list($u,$v)=cprm($u); $t=$v?$v:preplink($u);
return lj('txtcadr','popup_webpage___'.ajx($u),picto('get').$t);}//sugg_import

function wlink($d){list($p,$t)=cprm($d);
return lkt('',goodroot($p),$t?$t:preplink($p));}

//iframes
function iframe_bt($d,$m){list($u,$o)=cprm($d);
if($m==3 && !$o)return iframe($d,cw()).lkc('small',$u,domain($u)).br();
else return lj('txtx','popup_iframe__3_'.ajx($d).'_iframe',pictxt('window',nms(194))).' '.lkt('',$d,picto('url'));}

function facebook_call($u){req('tri');
$d=curl_get_contents($u); $d=utf8_decode_b($d); //eco($d);
//if(strpos($u,'facebook.com/plugins/video')!==false)return obj($u,'video/mp4');//streaming local
$ret=conv::html_detect($d,'<div class="_5pcr userContentWrapper"');
if(!$ret)$ret=html_detect($d,'<p class="_1q3v">');
$ret.=div('',lkt('txtx',$u,pictxt('link',domain($u))));
return divc('panel justy',$ret);}

function facebook_bt($u){
//if(strpos($u,'facebook.com/plugins/video')!==false)return fbvideo($u);
if(strpos($u,'facebook.com/plugins/video')!==false)return lkt('txtx',$u,pictxt('movie',domain($u)));
return lj('txtx','popup_facebook__3_'.ajx($u),pictxt('fb2',domain($u)));
return lkt('txtx',$u,pictxt('fb2',domain($u)));}

function readhtml($d){$f=goodroot($d);
return get_file($f);}

//toggles
function openart($p,$o=''){list($p,$t)=cprm($p); $rid=randid('opart');
if($t)return toggle('',$rid.'_art_'.$p.'_3',$t).divd($rid,'');
return read_msg($p,'inner');}

function call_j($f,$d){list($f,$lk)=cprm($f);
if(is_numeric($f))$lk=pictxt('get',suj_of_id($f)); else $f=goodroot($f);
return lj('','popup_'.$d.'___'.ajx($f),$lk);}

function call_pop($d){list($v,$k)=cprm($d); $rid=randid('bpop'); 
if(strpos($k,"\n"))$k=strto($k,"\n"); sesr('temp',$k,$v);
return ljp(atd('bt'.$rid),'popup_text___'.$rid.'_'.ajx($k),$k.' '.picto('get'));}

function bubble_note($d,$t='',$nl=''){
list($v,$tb)=cprm($d);
$rid=rid($d); $t=$t?$t:($tb?$tb:'(*)');
if($nl)return '['.$t.': '.$v.']';
return togbub2($rid,$v,$t,'','',1);}

function toggle_note($d,$t='',$nl=''){
list($v,$tb)=cprm($d); $rid=rid($d); $t=$t?$t:$tb;
$div=span(atd($rid).atc('twit panel').ats('display:none;'),$v);
if($nl)return '['.$t.': '.$v.']';
return ljb('','toggle_block',$rid,$t?$t:'(*)','bt'.$rid).$div;}

function toggle_div($d,$o,$nl=''){list($v,$t)=cprm($d);
if($o)$v=balb('blockquote',$v); if($nl)return balb('h4',$t).$v;
return togbt($v,pictxt('lys',$t));}

function toggle_conn($d,$nl){list($id,$t)=cprm($d); $rid=rid('jop');
if(is_numeric($id)){$j='_art_'.$id.'_3'; $t=$t?$t:suj_of_id($id);} else $j='_conn_'.$p.'['.$id.']';
return toggle('',$rid.$j,$t?$t:nms(25)).' '.btd($rid,'');}

function popurl($d){
return lj('','popup_vacuum__3_'.ajx(nohttp($d)),preplink($d).' '.picto('get'));}

function pop_art($d){list($id,$t)=split_one('§',$d);
if(substr($d,0,4)=='http')$j='popup_rssart__3_'.ajx($id).'_1';
else $j='popup_popart__3_'.$id.'_3'; $t=$t?$t:suj_of_id($id);
return lj('popbt',$j,pictxt('articles',$t?$t:preplink($d)));}

//lk
function pictoconn($t){
list($t,$ico)=opt($t,':'); if($ico=='picto')$t=picto($t); return $t;}
function poplk($d,$id){list($lk,$t)=split_right('§',$d,1); 
return ljp(att($tb),$id.'_ajxlnk___'.ajx($lk),pictoconn($t));}
function toglk($d){list($lk,$t)=split_right('§',$d,1);
return togbub('ajxlnk',ajx($lk),pictoconn($t));}
function ajlk($d){list($p,$o)=cprm($d);
return lj('popbt',$p,$o);}

function vacuum_video($da,$id){
if(substr($da,0,4)!='http')return $da;
list($d,$t)=split_one('§',$da,1);
$xt=xt($d); $qb=$_SESSION['qb']; $nmw=$d; $dc='';
if($id){$nmw=$qb.'_'.$id.'_'.substr(md5($d),0,6).$xt; $dc=$d; $dc=urlenc($dc);}
if(!is_file('video/'.$nmw) && $dc){@copy($dc,'video/'.$nmw);}//conn::replaceinmsg($id,$d,$nmw,'vid');
if(is_file('video/'.$nmw))return 'video/'.$nmw.($t?'§'.$t:'');
else return $da;}

function getmp4($d,$id){$d=vacuum_video($d,$id); return video_html($d);}
function getmp3($d,$id){$d=vacuum_video($d,$id); return audio($d);}
function getimg($d,$id,$m,$nl,$pw){$im=conn::get_image($d,$id,$m);
return conn::place_image($im,$m,$nl,$pw,$id);}
function getxif($d){$d=gcim($d); $r=imgexif($d); return img('/'.$d).tabler($r);}
function imgdata($d){list($d,$xt)=cprm($d); if(!$xt)$xt='jpeg';
return img('data:image/'.$xt.';base64,'.base64_encode($d));}

//twitter
function msqtwit($d,$id){
$r=msql::read_b('',$d,'',1); $rb=[]; $img='';
if($r)foreach($r as $k=>$v){
	$im=make_thumb_c($v[5],'48/48',1); if($im)$img='[img:var]'; else $img='[[img:var]:distimg]';
	$rb[$k]=['img'=>$im?$im:$v[5],'name'=>$v[2],'screen'=>$v[1],'txt'=>stripslashes($v[4])];}
$tmp='['.$img.' [name:var] (@[screen:var]) [[txt:var]:small]$trkmsg:divc]';//
$ret=vue::call($tmp,$rb);
return divc('scroll',$ret);}

function twits($d,$id){$r=explode(' ',$d); $ret='';
if($r)foreach($r as $k=>$v)if(is_numeric($v))$ret.=twit::cache($v,$id);
return $ret;}

function twitapi($d){
list($p,$o)=cprm($d);
return twit::call($p,$o);}

function poptwit($d,$id,$o='',$nl=''){list($n,$nm)=cprm($d);
if(substr($n,-8)=='/photo/1')$n=substr($n,0,-8);
//{$im=twit::getimg($n,1); return popim($im,pictxt('img',$nm));}
if(strpos($n,'/'))$n=strend($n,'/'); if(strpos($n,'?'))$n=strto($n,'?'); $bt=$nm?$nm:$n;
$o=$o?$o:'ban'; if(is_numeric($n))$o='tweet';
elseif(substr($n,0,1)=='@')$o='ban'; elseif(substr($n,0,1)=='#')$o='search';//stream
//if($o=='ban')$bt=pictxt('arobase',$bt); elseif($o=='search')$bt=pictxt('diez',$bt); else 
if($o=='tweet')$bt=pictxt('tw',$bt,16);
return lj('txtx','popup_app__3_twit_call_'.ajx($n).'_'.$o,$bt);}

function twitart($d,$id,$ty='',$nl=''){list($k,$nm)=cprm($d);
if(substr($k,0,4)=='http')$k=strend($k,'/'); if($nm==1)$nm=$k;
if($nm=='thread')return twitapi($d);
if($nm=='users')return twit::play_usrs($d);
if(strpos($k,' '))return twits($d,$id);
if($nm or !is_numeric($k))return poptwit($k.'§'.$nm,$id,$ty,$nl);
if($nl)return lka($k);
if($k)return twit::cache($k,$id);}

function twitxt($d,$id,$tx=''){list($k,$nm)=cprm($d);//totest
if(substr($k,0,4)=='http')$k=strend($k,'/'); if($nm==1)$nm=$k;
if($tx)return twit::playxt($k);
if($k)return lk(twit::lk($k,$id));}

function instagram($d,$id){
$ret='https://www.instagram.com/p/'.$d;
return $ret;}

//date
function lastup($v,$id){
$d=sesr('opts',$id); if(!$d)$d=art_opts($id);
if(!$d){$d=time(); req('meta'); utag_sav($id,'',$d);}// or $_GET['callj']
if($d)return btn('txtsmall2',nms(118).' : '.mkday($d,1));}

function mk_table($d){
list($d,$o)=cprm($d); $s='¬';
if($o=='div')return mk_dtable($d);
if(strpos($d,'¬')===false or $o=='esc')$s="\n";
$r=explode($s,$d); foreach($r as $k=>$v)$ret[]=explode('|',$v);
return tabler($ret,$o==1?1:'','');}

function mk_dtable($d){$r=explode("\n",$d); $rc=[];
foreach($r as $k=>$v){$rb=explode('|',$v); $rt=[];
foreach($rb as $ka=>$va)$rt[]=$va; $rc[]=$rt;}
return divtable($rc);}

//photos
function popim($im,$v,$id=''){$w=''; $h=''; $img=goodroot($im);//ajxf
//if(is_file($img))list($w,$h)=getimagesize($img);
return ljb('','SaveBf','photo_'.ajx($im).'___'.$id,$v);}

function good_src($d,$id){//goodroot()
if(!$d)$d=$id; $src='img/'; $r=[]; if(strpos($d,"\n")!==false)$d=str_replace("\n",'',$d);
if(strpos($d,',')!==false)$r=explode(',',$d);
elseif(strpos($d,'/')!==false){if(substr($d,-1)!='/')$d.='/'; $src='users/'.$d; $r=explore($src,'files',1);}
elseif(is_numeric($d)){$ims=sql('img','qda','v','id="'.$d.'"'); $r=explode('/',substr($ims,1));}
else $r=[$d];
return [$r,$src];}

//fluid
function img_fluid($d){
list($im,$h)=split_one('§',$d,1); $h=is_numeric($h)?$h:200; $im=goodroot($im);
$s='height:'.$h.'px; background-image:url(/'.$im.'); background-size:cover; background-attachment:fixed;';
return div(ats($s),'');}

#quotes
//called by art_read_c
function find_quotes($d,$id,$s,$pad,$l2){static $dc=0;//decal because of previous results
$d=htmlentities($d);
$d=str_replace("&laquo;",'«',$d); $d=str_replace("&raquo;",'»',$d); $d=str_replace("&nbsp;",' ',$d);
$d=html_entity_decode($d); //$pad=clean_punct($pad);
$l=mb_strlen($pad); $s2=0; if($dc)$s+=$dc*$l2;//lenght to add
$s2=mb_strpos($d,$pad,$s); if(!$s2)$s2=strpos($d,$pad,$s); if(!$s2)$s2=strpos($d,$pad);
if($s2){$d1=mb_substr($d,0,$s2); $d2=mb_substr($d,$s2,$l); $d3=mb_substr($d,$s2+$l);}
else{$d1=$d; $d2=''; $d3='';} $dc++; 
return [$d1,$d2,$d3];}

function apply_quote2($d,$id,$s,$pad,$idtrk){
$nh=ljb('','scrolltoob','qnb'.$s,picto('arrow-down'),'qnh'.$s);
list($d1,$d2,$d3)=find_quotes($d,$id,$s,$pad,10+strlen($idtrk)+strlen($nh));
if($d2){$d2=preg_replace('/(\n){2,}/',br().br(),$d2);
	return $d1.'['.$d2.'§'.$idtrk.':quote2]'.$nh.$d3;}
else return $d;}

//highlight begin
function allquotes($id){
$msg=sql('msg','qdm','v','id="'.$id.'"');
$r=sql('id,name,msg','qdi','','ib="'.$id.'"');
if($r)foreach($r as $k=>$v){$rb=explode(':callquote]',$v[2]); $n=count($rb);
	if($n>1){foreach($rb as $ka=>$va){$s1=strrpos($va,'['); $va=substr($va,$s1+1); list($p,$s)=cprm($va);
		if($s)$msg=apply_quote2($msg,$id,$s,$p,$v[0]);}}}
return div(atb('ondblclick','useslct(this,\''.$id.'\')'),conn::read($msg,3,$id,''));}

//ephemeral conn
function quote2($d,$id){list($p,$o)=cprm($d); return stabilo($p);//from art, built by find_quotes 
return togbub('quotrk',$id.'_'.$o.'_'.ajx($p),$p,'stabilo',att('notes'));}

//called by quote2
function quotrk($id,$s,$pad){//todo
$r=sql('id,name,msg','qdi','','ib="'.$id.'"');
if($r)foreach($r as $k=>$v){$rb=explode(':callquote]',$v[2]); $n=count($rb);
	if($n>1){foreach($rb as $ka=>$va){$s1=strrpos($va,'['); $va=substr($va,$s1+1); list($p,$s2)=cprm($va);
		if($s==$s2)return $p;}}}}

//quotes in trk
function callquote($d,$idtrk,$id){
if(!$id)$id=sql('ib','qdi','v',$idtrk);
if(!$idtrk)$idtrk=sql('id','qda','v',$id);
list($p,$o)=cprm($d);//from track, go to art_read_c
$nb=ljb('','callquote',[$id,$o,ajx($p),$idtrk],picto('arrow-top'),'qnb'.$o);
return bal('blockquote','',$p.' '.$nb);}//find_quotes

//xltags
function xltags($id,$conn,$msg=''){if(!$msg)$msg=sql('msg','qdm','v','id="'.$id.'"');
return div(atb('ondblclick','xltags(this,\''.$id.'\',\''.$conn.'\')'),conn::read($msg,3,$id,''));}

function xltag_slct($id){$r=['fact','quote','stabilo']; $j2='art'.$id.'_art___'.$id.'_3_1'; $bt='';//'all',
foreach($r as $k=>$v)$bt.=ljtog('','art'.$id.'_xltags___'.$id.'_'.$v,$j2,$v).' ';
return divc('list',$bt);}

function slct_conn($id,$pad,$s,$conn){if($conn)return apply_conn($id,$pad,$s,$conn);
$r=['q','fact','quote','stabilo','red','blue','parma','green'];
$ret=divc('trkmsg',$pad); $bt=''; $p=ajx($pad);
foreach($r as $k=>$v)$bt.=lj('','art'.$id.'_applyconn__x_'.$id.'_'.$p.'_'.$s.'_'.$v,$v);
return $ret.divc('nbp',$bt);}

function apply_conn($id,$pad,$s,$conn){$msg=sql('msg','qdm','v','id="'.$id.'"');
list($d1,$d2,$d3)=find_quotes($msg,$id,$s,$pad,3+strlen($conn));
if($d2){$msg=$d1.'['.$d2.':'.$conn.']'.$d3; sqlup('qdm',['msg'=>$msg],'id',$id);}
return xltags($id,$conn,$msg);}

?>