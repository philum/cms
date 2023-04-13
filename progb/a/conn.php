<?php //}//dev

class conn{
#syntax_system
static function parser($msg,$m='',$id='',$nl=''){
$deb='';$mid='';$end='';
$op='['; $cl=']'; $in=strpos($msg,$op);
if($in!==false){$deb=substr($msg,0,$in);
	$out=strpos(substr($msg,$in+1),$cl);
	if($out!==false){$msb=substr($msg,$in+1,$out);
		$nb_in=substr_count($msb,$op);
		if($nb_in>=1){
			for($i=1;$i<=$nb_in;$i++){$out_tmp=$in+1+$out+1;
				$out+=strpos(substr($msg,$out_tmp),$cl)+1;
				$nb_in=substr_count(substr($msg,$in+1,$out),$op);}
			$mid=substr($msg,$in+1,$out);
			$mid=self::parser($mid,$m,$id,$nl);}
		else $mid=$msb;
		$mid=self::connectors($mid,$m,$id,$nl);
		$end=substr($msg,$in+1+$out+1);
		$end=self::parser($end,$m,$id,$nl);}
	else $end=substr($msg,$in+1);}
else $end=$msg;
return $deb.$mid.$end;}

static function read($d,$m='',$id='',$nl=''){$r13=rstr(13);
//if(strpos($d,'<'))$ret=retape_html($d);
if(!$r13)$d=self::connbr($d);
$d=self::parser($d,$m,$id,$nl);
if($r13)$d=embed_p($d);
if(rstr(70))self::retape($d,$id);
$d=nl2br($d);
return $d;}

static function read2($d,$p='',$o=''){
if($p)$d=self::connbr($d);
$ret=self::parser($d);
if(!$p)$ret=embed_p($ret);
if(!$o)$ret=nl2br($ret);
return $ret;}

static function connbr($msg){return $msg;
$r=[':q]',':h]',':h1]',':h2]',':h3]',':h4]',':ul]',':ol]',':table]',':figure]',':video]',':php]',':photo]',':iframe]']; $n=count($r);
for($i=0;$i<$n;$i++)$msg=str_replace($r[$i]."\n\n",$r[$i]."\n",$msg);
return $msg;}

static function retape($ret,$id){if(isset($_SESSION['rtp'.$id])){$rk=[];
$r=msql::ses('oldconn','system','connectors_old',1); if($r)$rk=array_keys($r);
$ret=delbr($ret,"\n"); $ret=str::clean_br($ret); if($rk)$ret=str_replace($rk,$r,$ret);
if($id){sql::upd('qdm',['msg'=>$ret],$id); $_SESSION['rtp'.$id]='';}}}

static function retape_conn($c,$id){
if(!isset($_SESSION['rtp'.$id]))$_SESSION['rtp'.$id]='';
$r=msql::ses('oldconn','system','connectors_old',1); $ret='';
if(isset($r[$c])){$_SESSION['rtp'.$id].=$c.'->'.$r[$c]; return $r[$c];}
return $c;}

#img
static function replaceinimg($id,$a,$b){
$d=sql('img','qda','v',$id); $d=str_replace($a,$b,$d);
sql::upd('qda',['img'=>$d],$id);}

static function add_im_img($nnw,$id){
if(!$id)$id=ses('read'); if(!$id or $id=='test')return;
$nnw=str_replace(['users/','img/'],'',$nnw);
$d=sql('img','qda','v','id="'.$id.'"');
if(strpos($d,$nnw)===false)sql::upd('qda',['img'=>$d.'/'.$nnw],$id);}

static function replaceinmsg($id,$a,$b,$c=''){
$d=sql('msg','qdm','v',$id); if($c)$d=str_replace($a.':'.$c,$b,$d); $d=str_replace($a,$b,$d);
$d=str::clean_br_lite($d); sql::upd('qdm',['msg'=>$d],$id);//
if($c=='b64')sql::upd('qda',['host'=>strlen($d)],$id);}

static function add_im_msg($id,$a,$b,$c='img'){
$b=str_replace(['users/','img/'],'',$b);
self::replaceinmsg($id,$a,$b,$c);}

static function autothumb($f){
if(is_file($f)){[$w,$h]=getimagesize($f);
make_mini($f,$f,$w,$h,0);}}

static function b64img($d,$id,$m=''){if(!$id)return; $da=$d;
if(substr($d,0,22)=='data:image/png;base64,'){$d=substr($d,22);$xt='.png';}
if(substr($d,0,23)=='data:image/jpeg;base64,'){$d=substr($d,23);$xt='.jpg';}
$f=ses('qb').'_'.$id.'_'.substr(md5($d),0,6).'.jpg'; write_file('img/'.$f,base64_decode($d));
[$w]=getimagesize('img/'.$f); if(!$w){unlink('img/'.$f); self::add_im_msg($id,$da,'','b64'); return;}
if($id!='test'){self::add_im_img($f,$id); self::add_im_msg($id,$da,$f,'b64'); img::save($id,$f,'b64');}
return $f;}

static function recup_image($im){$srv=prms('srvimg');
if($srv && substr($im,0,4)!='http')$er=@copy($srv.'/img/'.$im,'img/'.$im);
elseif(is_file('imgx/'.$im)){rename('imgx/'.$im,'img/'.$im);} //self::add_im_img($da,$id);
elseif($srv)return $im=http($srv).'/img/'.$im;
return $im;}

static function original_img($im,$id=''){
if($id)$w=['ib'=>$id]; $w['im']=$im;
return sql('dc','qdg','v',$w);}

static function rzim($ret,$da,$dca,$id,$w,$h){
$sz=fsize($dca); $xt=xtb($da); $bt='';
$did=strend(strto($da,'.'),'_');
//if($xt=='.png')return img::png2jpg($a,$id);
if($sz>1000){
	$bt.=btn('txtred',$w.'px/'.$h.'px - '.$sz.'ko');
	//$bt.=lj('txtyl',$did.'_img,rewrite__3_'.ajx($da),'rewrite');//resolve exef
	$bt.=lj('txtyl',$did.'_img,reduce__3_'.ajx($da).'_0_'.$id,'reduce to 940|940');
	$bt.=lj('txtyl',$did.'_img,reduce__3_'.ajx($da).'_1_'.$id,'reduce by 50%');
	$bt.=lj('popdel',$did.'_img,restore__3_'.ajx($da).'_'.$id,'restore');}
elseif($w>1000)$bt.=lj('txtyl',$did.'_img,reduce__3_'.ajx($da).'_1','reduce by 50% ('.$w.'px '.$sz.'Ko)');
if($xt=='.png' && $sz>200)$bt.=lj('txtyl',$did.'_img,png2jpg__3_'.ajx($da).'_'.$id,'png2jpg-'.$sz);
if($xt=='.webp')$bt.=lj('txtyl',$did.'_img,webp2jpg__3_'.ajx($da).'_'.$id,'webp2jpg-'.$sz);
if($bt)$ret=divd($did,$ret.$bt); return $ret;}

static function get_image($da,$id,$m=''){
if($m=='noimages')return; if(rstr(40) && substr($da,0,4)=='http')return $da;
$xt=xt($da); $qb=$_SESSION['qb']; if($id=='test')return $da; $b64='';
if(strpos($da,';base64,'))return self::b64img($da,$id,$m);
if(!$xt or $xt=='.php' or $xt=='.jpeg')$xt='.jpg'; $ok='';// or $xt=='.webp'
if(forbidden_img($da)===false)return;//rev
if($id){$nmw=$qb.'_'.$id.'_'.substr(md5($da),0,6).$xt;//soon, del qb
	if(get('randim'))$nmw=$qb.'_'.$id.'_'.substr(md5(rand(0,100000)),0,6).$xt;//
	if($m=='trk' && is_file('img/'.$nmw))return $nmw;//keep original name
	else{$dc=$da;
		if(strpos($dc,'Capture-'))$dc=str_replace('d?','d%E2%80%99',$dc);
		//$dc=str_replace('e%CC%81','%E9',$dc);//false accent é
		$dcb=preg_replace('/-[0-9]+x[0-9]+/','',$dc);
		if($dcb!=$dc)if(is_file($dcb))$dc=$dcb;
		if(strpos($dc,' '))$dc=urlencode($dc);
		if(strpos($da,'cadtm.org')){$nmw=$da.':jpg'; if($id)self::add_im_msg($id,$da,$nmw); return $nmw;}
		$dc=str::urlenc($dc);//$dc=htmlentities($dc);
		if(!$ok){$d=curl_get_contents($dc);
			if($d && strlen($d)>1000 && strpos($d,'Forbidden')===false && strpos($d,'<')===false){
				$er=write_file('img/'.$nmw,$d); $ok=1;
				if(is_zip('img/'.$nmw))gz2im('img/'.$nmw);}//ziped img
			if(!$ok)$ok=@copy($dc,'img/'.$nmw);}}
	if($ok && is_file('img/'.$nmw)){
		[$w,$h,$ty]=getimagesize('img/'.$nmw);//not with webp
		if(!$w && $xt='.webp')$w=fsize('img/'.$nmw,1);
		if(!$w){unlink('img/'.$nmw); return $da;}
		else{self::add_im_img($nmw,$id); self::add_im_msg($id,$da,$nmw); img::save($id,$nmw,$da);
			if(strpos($da,'cdni.rt.com'))self::autothumb('img/'.$nmw);}
		return $nmw;}
	else return;}
else return $da;}

static function place_image($da,$m,$nl,$pw='',$id=''){
if(!$pw)$pw=$_SESSION['prma']['content'];
$pwb=round($pw*0.5); $br=''; $w=''; $p['id']='';//rez
if($m=='noimages')return ' ';
if(rstr(142))return pop::orimg($da,$id,0);//distant original
if(rstr(143))return pop::orimg($da,$id,1);//link to distant
if(substr($da??'',0,4)=='http'){//if(eradic_acc($da)==$da)
	if(strpos($da,'Capture-'))$da=str_replace("d'",'d%E2%80%99',$da);//['d?',]
	if(strpos($da,' '))$da=urlencode($da);
	//$ok=joinable($da); if($ok)[$w,$h]=arr(@getimagesize($da),2); if($w>$pw)$w=$pw;
	return image($da,'');}//."\n\n"
else $pre=jcim($da);//,1
$dca=$pre.$da; $http=''; $com=''; $p['style']=''; $w=''; $h='';
if($nl){$http=host().''; $dca=str_replace('../','',$dca);}
if(is_file($dca))[$w,$h]=getimagesize($dca); else{$w=''; $h=''; $da=self::recup_image($da);}
if(!$w && !$pre){$dca=$da; $w=$pwb;}
if(rstr(17))$pwb/=2;
//if(rstr(9) && !$com && $w<$pwb)$p['style']='float:left; margin-right:10px;';
//if($w && $w<$pwb)$p['style'].=' width:'.$w.'px;';
$p['src']=$http.'/'.$dca; //if(!rstr(9) && $h>40)$br="\n\n";
$p['title']=ses::adm('alert');
$ret='<img'.attr($p).' />';//image()
if($nl)return $ret;//.$br
if($w>$pw && $pw && !$com)$ret=ljb('','SaveBf',ajx($da).'_'.$w.'_'.$h.'_'.$id,$ret).$br;
if(auth(6) && rstr(121) && !$nl)$ret=self::rzim($ret,$da,$dca,$id,$w,$h);
return $ret;}//.$br

#connectors
static function connectors($da,$m,$id='',$nl=''){
$pw=$_SESSION['prma']['content'];
$xt=strtolower(strrchr($da,'.')); $cp=strrpos($da,':');
$c=substr($da,$cp); $d=substr($da,0,$cp);
if(rstr(70))$c=self::retape_conn($c,$id);
//[$d,$p]=cprm($d);
switch($c){
case(':br'):return br();break;
case(':p'):return '<p>'.$d.'</p>';break;
case(':u'):return '<u>'.$d.'</u>';break;
case(':i'):return '<i>'.$d.'</i>';break;
case(':b'):return '<b>'.$d.'</b>';break;
case(':h'):return '<big>'.$d.'</big>';break;
case(':h1'):return '<h1>'.$d.'</h1>';break;
case(':h2'):return '<h2>'.$d.'</h2>';break;
case(':h3'):return '<h3>'.$d.'</h3>';break;
case(':h4'):return '<h4>'.$d.'</h4>';break;
case(':h5'):return '<h5>'.$d.'</h5>';break;
case(':e'):return '<sup>'.$d.'</sup>';break;
case(':n'):return '<sub>'.$d.'</sub>';break;
case(':s'):return '<small>'.$d.'</small>';break;
case(':k'):return '<del>'.$d.'</del>';break;
case(':q'):return '<blockquote>'.$d.'</blockquote>';break;
case(':section'):return '<section>'.$d.'</section>';break;
case(':center'):return '<center>'.$d.'</center>';break;
case(':quote'):return '<quote>'.$d.'</quote>';break;
case(':aside'):return '<aside>'.$d.'</aside>';break;
case(':time'):return '<time>'.$d.'</time>';break;
case(':fact'):return '<fact>'.$d.'</fact>';break;
//case(':sup'):return '<sup>'.$d.'</sup>';break;
//case(':sub'):return '<sub>'.$d.'</sub>';break;
case(':qu'):return '<q>'.$d.'</q>';break;
case(':t'):return btn('txtit',$d);break;
case(':c'):return btn('txtclr',$d);break;
case(':list'):return mk::make_li($d,'ul');break;
case(':font'):return mk::pub_font($d);break;
case(':size'):return mk::pub_size($d);break;
case(':color'):return mk::pub_clr($d);break;
case(':bkg'):return mk::bkg($d,$id);break;
case(':stabilo'):return mk::stabilo($d);break;
case(':bkgclr'):return mk::pub_bkgclr($d);break;
case(':red'):return mk::pub_clr($d,'#bd0000');break;
case(':blue'):return mk::pub_clr($d,'#333399');break;
case(':parma'):return mk::pub_clr($d,'#993399');break;
case(':green'):return mk::pub_clr($d,'#339933');break;
case(':numlist'):return mk::make_li($d,'ol');break;
case(':right'):return divs('text-align:right;',$d);break;
case(':float'):return mk::pub_float($d);break;
case(':clear'):return divc('clear',$d);break;
case(':footlist'):return mk::footlist($d,$id);break;//
case(':link'):return md::special_link($d);break;
case(':w'):return mk::wlink($d);break;
case(':css'):return mk::pub_css($d);break;
case(':div'):return mk::pub_div($d);break;
case(':html'):return mk::pub_html($d);break;
case(':pub'):return pop::pubart($d);break;
case(':art'):return pop::pubart($d);break;
case(':url'):return mk::pub_url($d,$id);break;
case(':read'):return pop::openart($d,$m);break;
case(':content'):return pop::openart($d,3);break;
case(':import'):return ma::import_art($d,$m);break;
case(':quote2'):return mk::quote2($d,$id);break;
case(':callquote'):return mk::callquote($d,'',$id);break;//unused
case(':articles'):return pop::arts_mod($d,$id);break;
case(':search'):return lj('popw','popup_search,home___'.ajx($d),pictxt('search',$d));break;
case(':table'):return mk::table($d);break;
case(':divtable'):return mk::dtable($d);break;
case(':frame'):return mk::frame($d,$m); break;
case(':underline'):return mk::underline($d,$m); break;
case(':nh'):return mk::nh($d,$id,$nl); break;
case(':nb'):return mk::nb($d,$id,$nl); break;
case(':pre'):return tagb('pre',str::htmlentities_a($d));break;
case(':code'):return tagb('code',delbr($d));break;
case(':php'):return few::progcode($d); break;
case(':console'):return divc("console",$d);break;
case(':figure'):return pop::figure($d,$pw,$nl,$id);break;
case(':lang'):return mk::translate($d,$m);break;
case(':iframe'):return mk::iframe_bt($d,$m,$nl);break;
case(':msql'):return mk::msqcall($d,$id,'');break;
case(':module'):return mod::callmod($d); break;
case(':modpop'):return mk::modpop($d); break;
case(':twitter'):return pop::twitart($d,$id,'',$nl);break;
case(':twapi'):return pop::twitapi($d);break;
case(':twits'):return pop::twits($d,$id);break;
case(':twusr'):return twit::play_usrs($d);break;
case(':twimg'):return twit::img($d,1); break;
case(':img'):return image($d); break;
case(':jpg'):return image($d.'.jpg'); break;//old
case(':webm'):return pop::getmp4($d.'.webm',$id,rstr(145)?0:1); break;
case(':mp4'):return pop::getmp4($d.'.mp4',$id,rstr(145)?0:1); break;
case(':mp3'):return pop::getmp3($d.'.mp3',$id,rstr(145)?0:1); break;
case(':gim'):return pop::getimg($d,$id,$m,$nl,$pw); break;//onetime
case(':vid'):return pop::getmp4($d,$id,1); break;
case(':video'):return video::any($d,$id,$m,$nl);break;
case(':videourl'):return video::lk($d);break;
case(':play'):return video::call($d,$id,$pw,$m,$nl);break;
case(':audio'):return pop::getmp3(goodroot($d),$id,0);break;
case(':pdf'):return mk::pdfreader($d,$m); break;
case(':photos'):return mk::photos($d,$id);break;
case(':gallery'):return mk::gallery($d,$id);break;
case(':slider'):return mk::slider($d,$id,$nl);break;
//case(':sliderJ'):return mk::sliderj($d,$id,$nl);break;
case(':jukebox'):return mk::jukebox($d,$m,$id);break;
case(':radio'):return radio::call($d,'',$id);break;
case(':script'):return '<script src="'.$d.'"></script>'."\n"; break;
case(':formail'):return mk::form($d,'mailform'.$id.'_tracks,formail','');break;
case(':chat'):return chat::home($d?$d:$id,5);break;
case(':chatxml'):return chatxml::home($d?$d:$id);break;
case(':room'):return lj('','popup_chatxml,home___'.$d,pictxt('chat',$d));break;
case(':shop'):return cart::home('shop',$d,$id);break;//unused
case(':prod'):return cart::home('prod',$d,$id);break;//unused
case(':forum'):return forum::home($d?$d:$id);break;//unused
case(':draw'):return draw::home();break;
case(':scan'):return mk::scan_txt($d,$m);break;
case(':object'):return obj($d,'');break;
case(':imgtxt'):return mk::imgtxt($d);break;
case(':imgdata'):return pop::imgdata($d);break;
case(':download'):return mk::download($d);break;
case(':ajxget'):return ajx($d); break;//old
case(':ajax'):return pop::ajlk($d);break;//old
case(':rss_input'):return rss::build('',$d);break;
case(':facebook'):return mk::fb_bt($d);break;
case(':exif'):return pop::getxif($d); break;
//case(':b64'):return img64($d); break;
case(':b64'):return img('img/'.self::b64img($d,$id,$m)); break;
case(':mini'):return mk::mini_b($d,$id);break;
case(':thumb'):return mk::mini_d($d,$id,$nl); break;
case(':fluid'):return mk::img_fluid($d); break;
case(':poptxt'):return pop::call_j($d,'usg,poptxt');break;
case(':popfile'):return pop::call_j($d,'usg,popfile');break;
case(':popread'):return pop::call_j($d,'usg,popread');break;
case(':popmsql'):return pop::call_j($d,'usg,popmsql');break;
case(':popmsqt'):return pop::call_j($d,'usg,popmsqt');break;
case(':popart'):return pop::btart($d);break;
case(':popurl'):return mk::popurl($d); break;
case(':pop'):return pop::call_pop($d);break;
case(':bubble_note'):return pop::bubble_note($d,'',$nl);break;
case(':toggle_note'):return pop::toggle_note($d,'',$nl);break;
case(':toggle_text'):return pop::toggle_div($d,0,$nl);break;
//case(':toggle_quote'):return pop::toggle_div($d,1,$nl);break;
case(':toggle'):return pop::toggle_div($d,1,$nl);break;
case(':toggle_conn'):return pop::toggle_conn($d,$nl);break;
case(':api_read'):return mc::api_read($d);break;
case(':webpage'):return mk::webpage($d);break;
case(':webview'):return mk::webview($d,$id);break;
case(':readhtml'):return get_file(goodroot($d));break;
case('instagram'):return mk::instagram($d,$id);break;
case(':last-update'):return mk::lastup($d,$id);break;
case(':web'):return web::call($d,0,$id);break;
case(':wiki'):return mk::wiki($d,0); break;
case(':dico'):return mk::wiktionary($d,0); break;
case(':idart'):return ma::id_of_suj($d);break;
case(':book'):return book::home($d,$id); break;
case(':popbook'):return book::home($d,'x'); break;
case(':petition'):return petition::home($id,10); break;
case(':track'):return art::trkone($d); break;
case(':to'):return art::tracks_to($d); break;
case(':cols'):return mk::cols($d,$m); break;
case(':block'):return mk::block($d,$m); break;
case(':help'):return divc('twit',helps($d)); break;
case(':plan'):return mk::plan($id,$m,$d); break;
case(':artwork'):return mk::artwork($d,$m); break;
case(':look'):return mk::artlook($d); break;
case(':icon'):return icon($d);break;
case(':svg'):[$p,$o]=cprm($d); return svg::call($p,$o); break;
case(':math'):return tagb('math',codeline::parse($d,'','math')); break;
case(':app'):[$p,$o,$fc]=unpack_conn($d); return appin($fc,'home',$p,$o); break;
case(':dskbt'):return mod::read_apps_link($d); break;
case(':appbt'):return pop::btapp($d,$nl); break;
case(':connbt'):return pop::connbt($d,$nl); break;
case(':bt'):return pop::btapp($d,$nl); break;//obs
case(':search'):[$d,$o]=cprm($d);
	return lj('','popup_search,home__3_'.ajx($d).'_',picto('search').($o?$o:$d)); break;
case(':tag'):[$p,$o]=cprm($d); if(!$o)$o='tag';
	return lj('txtx','popup_api__3_'.$o.':'.ajx($p),pictxt('tag',$p)); break;
case(':papi'):[$p,$o]=cprm($d);//relegated
	return lj('','popup_api__3_'.ajx($p),pictxt('atom',$o?$o:strend($p,':'))); break;
case(':api'): return delbr(api::call($d)); break;
case(':contact'):return contact($d,''); break;
case(':bubble'):return md::bubble_menus($d,'inline');//old
case(':submenus'):return md::bubble_menus($d,'inline');
case(':header'):[$t,$p]=cprm($d);
	Head::add($p?$p:'code',delbr($t,"\n")); return; break;
case(':jscode'):Head::add('jscode',delbr($d,"\n")); return; break;
case(':jslink'):Head::add('jslink',delbr($d,"\n")); return; break;
case(':basic'):[$func,$var]=cprm($d); return codeline::cbasic($func,$var); break;
case(':template'):return codeline::parse('['.$da.']','','template'); break;
case(':version'):return $_SESSION['philum']; break;
case(':ver'):$phi=$_SESSION['philum']; return substr($phi,0,2).'.'.substr($phi,2,2); break;
case(':picto'):[$p,$o]=cprm($d); return picto($p,$o); break;
case(':ascii'):[$p,$o]=cprm($d); return ascii($p,$o); break;
case(':glyph'):[$p,$o]=cprm($d); return glyph($p,$o); break;
case(':oomo'):[$p,$o]=cprm($d); return oomo($p,$o); break;
case(':typo'):[$p,$o]=cprm($d); return mk::typo($p,$o); break;
case(':flag'):return flag($d); break;
case(':nms'):return nms($d); break;
case(':sigle'):return '&'.$d.';'; break;
case(':caviar'):return mk::caviar($d); break;
case(':private'): if(auth(6))return $d.' '.picto('secret'); break;
case(':dev'):if(auth(4))return $d; break;
case(':exec'):return codeline::exec_run($d,$id); break;
case(':on'):return '['.tagb('code',delbr($d)).']'; break;
case(':no'):return; break;
case(':ko'):return $d; break;}
if($da=='--')return hr();
elseif($xt=='.m3u8')return twit::upvideo_m3u8($da);
elseif($xt=='.pdf')return mk::pdfdoc($da,$nl,$pw);
elseif($xt=='.svg'){[$p,$w,$h]=subparams($da); return image(goodroot($p),$w,$h);}//svg($da)
elseif($xt=='.txt'){$dt=goodroot($da); return lkt('',$dt,strrchr($dt,'/'));}
elseif($xt=='.gz')return mk::download($da);
elseif($xt=='.mp3'||$xt=='.m4a')return pop::getmp3(goodroot($da),$id,rstr(145));
elseif($xt=='.mp4'||$xt=='.ogg'||$xt=='.webm'){//.h264
	if($m!=3)return lj('txtx','pagup_usg,video___'.ajx($da),pictxt('video',strend($da,'/')));
	else{[$d,$t]=cprm($da); $d=goodroot($d);
		if($t)return lkt('',$d,$t); else return pop::getmp4($da,$id,rstr(145));}}
//links
$res=self::connlk($da,$id,$m,$nl,$pw); if($res=='-')return; if($res)return $res;
$cn=substr($c,1); //echo $cn.'-';
if(method_exists($cn,'call') && isset($cn::$conn)){[$p,$o]=cprm($d); return $cn::call($p,$o);}
//if($cn){$ret=codeline::mod_basic($cn,$d); if($ret)return $ret;}
return '['.$da.']';}

static function connlk($da,$id,$m,$nl,$pw){//!
if(is_img($da) && strpos($da,'§')===false && strpos($da,'<')===false){
	if(substr($da,0,4)=='http' && $id)$da=conn::get_image($da,$id,$m);
	return conn::place_image($da,$m,$nl,$pw,$id);}
if((strpos($da,'§')!==false or strpos($da,'http')!==false) && strpos($da,'<a')===false){//secure double hooks
	[$p,$o]=cprm($da); //echo $p.'§'.$o.br();
	if(is_img($p)){//image§text
		//if(substr($p,0,4)=='http')$p=conn::get_image($p,$id,$m);
		if(is_img($o))return mk::popim($p,image(goodroot($o)),$id);//mini
		//return pop::figure($p.'§'.$o,$pw,$nl,$id);
		return mk::popim($p,pictxt('img',$o),$id);}
	elseif(is_img($o)){//link§image
		if(substr($o,0,4)=='http')$o=conn::get_image($o,$id,$m);
		if(substr($p,0,4)=='http')return lk($p,conn::place_image($o,$m,$nl,$pw,$id));
		elseif(is_numeric($p))return mk::popim($o,pictxt('img',urlread($p)),$id);
		else return $o;}
	elseif(strpos($p,'.pdf')!==false)return mk::pdfdoc($da,$nl,$pw);
	elseif(strpos($p,'wikipedia.org')!==false)return mk::wiki($da,0);
	elseif(strpos($p,'twitter.com')!==false && strpos($p,'status/')!==false)return pop::poptwit($da,'',$nl);
	elseif(strpos($p,':iframe')){if($nl)return struntil($p,':iframe');
		return lj('','popup_conn,parser___['.ajx($p).']_3_test',pictxt('window',$o));}
	elseif(substr($p,0,4)=='http')return rstr(111)&&!$nl?mk::webview($da,$id):lka($p,$o);
	/*elseif(strpos($p,':')){if($nl)return struntil($p,':'); $ic=mime(strend($p,':'),'window');//if isconn
		return lj('','popup_conn,parser___['.ajx($p).']_3_test',pictxt($ic,$o));}*/
	elseif(substr($p,0,1)=='/')return lkt('',$p,$o);
	elseif(strpos($p,'/'))return lkt('',goodroot($p),$o);
	//elseif(strpos($p,'@'))return lkt('',$p,$o?$o:domain($p));
	elseif(is_numeric($p) && strpos($o,':')===false)return ma::jread('',$p,$o);}
elseif(substr($da,0,1)=='@' && $tw=substr($da,1))return pop::poptwit($da,'ban',$nl);
elseif(substr($da,0,1)=='#' && $tw=substr($da,1))return pop::poptwit($da,'search',$nl);
//elseif(strpos($da,'@'))return str_replace('@',picto('arobase'),$da);
}//avoid plugs

}
?>