<?php //philum/a/conn//}//dev

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

static function read_b($d,$p=''){
if($p)$d=self::connbr($d);
$ret=self::parser($d);
if(!$p)$ret=embed_p($ret);
$ret=nl2br($ret);
return $ret;}

static function connbr($msg){return $msg;
$r=[':q]',':h]',':h1]',':h2]',':h3]',':h4]',':ul]',':table]',':figure]',':video]',':php]',':photo]'];
$n=count($r);//':slider]'
for($i=0;$i<$n;$i++)$msg=str_replace($r[$i]."\n\n",$r[$i]."\n",$msg);
return $msg;}

static function retape($ret,$id){if(isset($_SESSION['rtp'.$id])){
$r=msql::ses('oldconn','system','connectors_old',1); if($r)$k=array_keys($r);
$ret=delbr($ret,"\n"); $ret=clean_br($ret); $ret=str_replace($k,$r,$ret);
if($id){update('qdm','msg',$ret,'id',$id); $_SESSION['rtp'.$id]='';}}}

static function retape_conn($c,$id){
$r=msql::ses('oldconn','system','connectors_old',1); $ret='';
if(isset($r[$c])){vadd($_SESSION,'rtp'.$id,$c.'->'.$r[$c]."\n"); return $r[$c];}
return $c;}

static function replaceinmsg($id,$a,$b,$c=''){
$d=sql('msg','qdm','v',$id); if($c)$d=str_replace($a.':'.$c,$b,$d); $d=str_replace($a,$b,$d);
$d=clean_br_lite($d); update('qdm','msg',$d,'id',$id);
if($c=='b64')update('qda','host',strlen($d),'id',$id);}

static function replaceinimg($id,$a,$b){
$d=sql('img','qda','v',$id); $d=str_replace($a,$b,$d);
update('qda','img',$d,'id',$id);}

#img
static function add_im_img($nnw,$id){
if(!$id)$id=ses('read'); if(!$id)return;
$nnw=str_replace(['users/','img/'],'',$nnw);
$d=sql('img','qda','v','id="'.$id.'"');
if(strpos($d,$nnw)===false)update('qda','img',$d.'/'.$nnw,'id',$id);}

static function add_im_msg($id,$a,$b,$c='img'){
$b=str_replace(['users/','img/'],'',$b);
self::replaceinmsg($id,$a,$b,$c);}

static function autothumb($f){
if(is_file($f)){list($w,$h)=getimagesize($f);
make_mini($f,$f,$w,$h,0);}}

static function b64img($d,$id,$o=''){if(!$id)return; $da=$d;
if(substr($d,0,22)=='data:image/png;base64,'){$d=substr($d,22);$xt='.png';}
if(substr($d,0,23)=='data:image/jpeg;base64,'){$d=substr($d,23);$xt='.jpg';}
$f=ses('qb').'_'.$id.'_'.substr(md5($d),0,6).'.jpg'; write_file('img/'.$f,base64_decode($d));
list($w)=getimagesize('img/'.$f); if(!$w){unlink('img/'.$f); echo 'x'; return;}
self::add_im_img($f,$id); self::add_im_msg($id,$da,$f,'b64'); img::save($id,$f,'b64');
return $o?'['.$f.']':$f;}

static function get_image($da,$id,$m=''){
if($m=='noimages')return '-'; if(rstr(40) && substr($da,0,4)=='http')return $da;
$xt=xt($da); $qb=$_SESSION['qb']; if($id=='test')return $da; $b64='';
if(strpos($da,';base64,'))return self::b64img($da,$id);
if(!$xt or $xt=='.php' or $xt=='.jpeg')$xt='.jpg'; $ok='';// or $xt=='.webp'
if(forbidden_img($da)===false)return;//rev
if($id){$nmw=$qb.'_'.$id.'_'.substr(md5($da),0,6).$xt;//soon, del qb
	if(get('randim'))$nmw=$qb.'_'.$id.'_'.substr(md5(rand(0,100000)),0,6).$xt;//
	if($m=='trk' && is_file('img/'.$nmw))return $nmw;//keep original name
	else{$dc=$da;
		if(strpos($dc,'Capture-'))$dc=str_replace('d?','d%E2%80%99',$dc);
		$dc=str_replace('e%CC%81','%E9',$dc);//false accent é
		$dcb=preg_replace('/-[0-9]+x[0-9]+/','',$dc);
		if($dcb!=$dc)if(is_file($dcb))$dc=$dcb;
		if(strpos($dc,' '))$dc=urlencode($dc);
		//$dc=str_replace(' ','%20',$dc);
		//$dc=htmlentities($dc);
		//if(joinable($dc))//error here stop display new art//prevent crash server
		if(strpos($da,'cadtm.org')){$nmw=$da.':jpg'; if($id)self::add_im_msg($id,$da,$nmw); return $nmw;}
		$dc=urlenc($dc);//urlutf(
		if(!$ok){$d=curl_get_contents($dc);
			if(strlen($d)>1000 && strpos($d,'Forbidden')===false && strpos($d,'<')===false){
				$er=write_file('img/'.$nmw,$d); $ok=1;
				if(is_zip('img/'.$nmw))gz2im('img/'.$nmw);}//ziped img
			if(!$ok)$ok=@copy($dc,'img/'.$nmw);}}
	if($ok && is_file('img/'.$nmw)){
		list($w,$h,$ty)=getimagesize('img/'.$nmw);//not with webp
		if(!$w && $xt='.webp')$w=fsize('img/'.$nmw,1);
		if(!$w){unlink('img/'.$nmw); return $da;}
		else{self::add_im_img($nmw,$id); self::add_im_msg($id,$da,$nmw); img::save($id,$nmw,$da);
			if(strpos($da,'cdni.rt.com'))self::autothumb('img/'.$nmw);}
		return $nmw;}
	else return $da;}
else return $da;}

static function recup_image($im){$srv=prms('srvimg');
if($srv && substr($im,0,4)!='http')$er=@copy($srv.'/img/'.$im,'img/'.$im);
elseif(is_file('imgx/'.$im)){rename('imgx/'.$im,'img/'.$im);} //self::add_im_img($da,$id);
elseif($srv=prms(15))return $im=http($srv).'/img/'.$im;
//list($w,$h)=getimagesize('img/'.$im);
return $im;}

static function place_image($da,$m,$nl,$pw=640,$id=''){
$pwb=round($pw*0.5); $br=''; $p['id']='';//rez
if($m=='noimages')return '-';
if(substr($da,0,4)=='http'){//if(eradic_acc($da)==$da)
	if(strpos($da,'Capture-'))$da=str_replace(['d?',"d'"],'d%E2%80%99',$da);
	if(strpos($da,' '))$da=urlencode($da);
	//$ok=joinable($da); if($ok)list($w,$h)=@getimagesize($da); if($w>$pw)$w=$pw; 
	return image($da,'')."\n\n";}
else $pre=jcim($da);//,1
$dca=$pre.$da; $http=''; $com=''; $p['style']=''; $w=''; $h='';
if($nl){$http=host().''; $dca=str_replace('../','',$dca);}
if(file_exists($dca))list($w,$h)=getimagesize($dca);
else{$w=''; $h=''; $da=self::recup_image($da);}
if(!$w && !$pre){$dca=$da; $w=$pwb;}
if(rstr(17))$pwb/=2;
if(rstr(9) && !$com && $w<$pwb)$p['style']='float:left; margin-right:10px;';
if($w && $w<$pwb)$p['style'].=' width:'.$w.'px;';
$p['src']=$http.'/'.$dca; if(!rstr(9) && $h>40)$br="\n\n";
$ret='<img'.attr($p).' />';
if(auth(6) && rstr(121) && !$nl){$sz=fsize($dca); $xt=xtb($da); $bt='';
	$did=strend(strto($da,'.'),'_'); 
	if($sz>1000){
		$bt.=btn('txtred',$w.'px/'.$h.'px - '.$sz.'ko');
		//$bt.=lj('txtyl',$did.'_img,rewrite__3_'.ajx($da),'rewrite');//resolve exef
		$bt.=lj('txtyl',$did.'_img,reduce__3_'.ajx($da),'reduce to 940|940');
		$bt.=lj('txtyl',$did.'_img,reduce__3_'.ajx($da).'_1','reduce by 50%');
		$bt.=lj('popdel',$did.'_img,restore__3_'.ajx($da).'_'.$id,'restore');}
	elseif($w>1000)$bt.=lj('txtyl',$did.'_img,reduce__3_'.ajx($da).'_1','reduce by 50% ('.$w.'px '.$sz.'Ko)');
	if($xt=='.png' && $sz>200)$bt.=lj('txtyl',$did.'_img,png2jpg__3_'.ajx($da).'_'.$id,'png2jpg-'.$sz);
	if($bt)$ret=divd($did,$ret.$bt);}
$j='photo_'.ajx($da).'_'.$w.'-'.$h;
if($w>$pw && $pw && !$com){
	if($nl)return $ret.$br; 
	else return ljb('','SaveBf',$j,$ret).$br;}
else return $ret.$br;}

#connectors
static function connectors($da,$m,$id='',$nl=''){
$pw=$_SESSION['prma']['content'];
$xt=strtolower(strrchr($da,'.')); $cp=strrpos($da,':');
$c=substr($da,$cp); $d=substr($da,0,$cp);
if(rstr(70))$c=self::retape_conn($c,$id);
//list($d,$p)=cprm($d);
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
case(':k'):return '<strike>'.$d.'</strike>';break;
case(':q'):return '<blockquote>'.$d.'</blockquote>';break;
case(':section'):return '<section>'.$d.'</section>';break;
case(':center'):return '<center>'.$d.'</center>';break;
case(':quote'):return '<quote>'.$d.'</quote>';break;
case(':fact'):return '<fact>'.$d.'</fact>';break;
//case(':sup'):return '<sup>'.$d.'</sup>';break;
//case(':sub'):return '<sub>'.$d.'</sub>';break;
case(':qu'):return '<q>'.$d.'</q>';break;
case(':t'):return btn('txtit',$d);break;
case(':c'):return btn('txtclr',$d);break;
case(':list'):return make_li($d,'ul');break;
case(':font'):return pub_font($d);break;
case(':size'):return pub_size($d);break;
case(':color'):return pub_clr($d);break;
case(':bkg'):return mk_bkg($d,$id);break;
case(':stabilo'):return stabilo($d);break;
case(':bkgclr'):return pub_bkgclr($d);break;
case(':red'):return pub_clr($d,'#bd0000');break;
case(':blue'):return pub_clr($d,'#333399');break;
case(':parma'):return pub_clr($d,'#993399');break;
case(':green'):return pub_clr($d,'#339933');break;
case(':numlist'):return make_li($d,'ol');break;
case(':footlist'):return footlist($d,$id);break;//
case(':link'):return special_link($d);break;
case(':w'):return wlink($d);break;
case(':css'):return pub_css($d);break;
case(':div'):return pub_div($d);break;
case(':html'):return pub_html($d);break;
case(':pub'):return pubart($d);break;
case(':art'):return pubart($d);break;
case(':url'):return pub_url($d,$id);break;
case(':read'):return openart($d);break;
case(':content'):return openart($d,1);break;
case(':photos'):return mk::photos($d,$id);break;
case(':gallery'):return mk::gallery($d,$id);break;
case(':slider'):return mk::slider($d,$id,$nl);break;
//case(':slides'):return slides($d,$id);break;
//case(':sliderJ'):return mk::sliderj($d,$id,$nl);break;
case(':jukebox'):return mk::jukebox($d,$m,$id);break;
case(':radio'):return plugin_func('radio','radio_conn',$d,'',$id);break;
case(':script'):return '<script src="'.$d.'"></script>'."\n"; break;
case(':import'):return import_art($d,$m);break;
case(':quote2'):return quote2($d,$id);break;
case(':callquote'):return callquote($d,'',$id);break;//unused
case(':articles'):return arts_mod($d,$id);break;
case(':search'):return lj('popw','popup_search___'.ajx($d),pictxt('search',$d));break;
case(':formail'):return mk::form($d,'mailform'.$id,'_formail___'.ajx($d,'').'____');break;
case(':chat'):return plugin('chat',$d?$d:$id,5);break;
case(':chatxml'):return plugin('chatxml',$d?$d:$id);break;
case(':room'):return lj('','popup_plupin__3_chatxml_'.$d,pictxt('chat',$d));break;
case(':shop'):return plugin('shop','shop',$d,$id);break;//
case(':prod'):return plugin('shop','prod',$d,$id);break;//
case(':forum'):return plugin('forum',$d?$d:$id);break;//
case(':draw'):return plugin('draw');break;
case(':icon'):return icon($d);break;
case(':right'):return divs('text-align:right;',$d);break;
case(':float'):return pub_float($d);break;
case(':clear'):return divc('clear',$d);break;
case(':table'):return mk_table($d);break;
case(':divtable'):return mk_dtable($d);break;
case(':frame'):return mk_frame($d,$m); break;
case(':underline'):return mk_underline($d,$m); break;
case(':nh'):return mk_nh($d,$id,$nl); break;
case(':nb'):return mk_nb($d,$id,$nl); break;
case(':pre'):return balb('pre',entities($d));break;
case(':code'):return balb('code',delbr($d));break;
case(':php'):return mk::progcode($d); break;
case(':console'):return divc("console",$d);break;
case(':figure'):return figure($d,$pw,$nl);break;
case(':scan'):return mk::scan_txt($d,$m);break;
case(':lang'):return mk::translate($d,$m);break;
case(':iframe'):return iframe_bt($d,$m);break;
case(':object'):return obj($d,'');break;
case(':facebook'):return facebook_bt($d);break;
case(':imgtxt'):return mk_imgtxt($d);break;
case(':imgdata'):return imgdata($d);break;
case(':download'):return download($d);break;
case(':msql'):return mk::msqcall($d,$id,'');break;
case(':module'):req('mod'); return build_mod_r($d); break;
case(':modpop'):return lj('','popup_modpop__3_'.ajx($d),picto('get')); break;
case(':ajxget'):return ajx($d); break;
case(':ajax'):return ajlk($d);break;
case(':rss_input'):return rss::call('',$d);break;
case(':twitter'):return twitart($d,$id,'',$nl);break;
case(':twapi'):return twitapi($d);break;
case(':twits'):return twits($d,$id);break;
case(':twusr'):return twit::play_usrs($d);break;
case(':pdf'):return pdfreader($d,$m); break;
case(':mp4'):return getmp4($d.'.mp4',$id); break;
case(':mp3'):return getmp3($d.'.mp3',$id); break;
case(':jpg'):return self::place_image($d,$m,$nl,$pw,$id); break;
case(':img'):return getimg($d,$id,$m,$nl,$pw); break;
case(':vid'):return getmp4($d,$id); break;
case(':audio'):return getmp3(goodroot($d),$id);break;
case(':video'):return video::any($d,$id,$m,$nl);break;
case(':play'):return video::call($d,$id,$pw,$m,$nl);break;
case(':videourl'):return video::lk($d);break;
case(':twimg'):return twit::img($d,1); break;
case(':image'):return image($d); break;
case(':exif'):return getxif($d); break;
//case(':b64'):return img64($d); break;
case(':b64'):return img('img/'.self::b64img($d,$id)); break;
case(':mini'):return mk::mini_b($d,$id);break; 
case(':thumb'):return mk::mini_d($d,$id,$nl); break;
case(':fluid'):return img_fluid($d); break;
case(':poptxt'):return call_j($d,'poptxt');break;
case(':popmsqt'):return call_j($d,'popmsqt');break;
case(':popmsql'):return call_j($d,'popmsql');break;
case(':popread'):return call_j($d,'popread');break;
case(':popart'):return pop_art($d);break;
case(':popurl'):return popurl($d); break;
case(':pop'):return call_pop($d);break;
case(':bubble_note'):return bubble_note($d,'',$nl);break;
case(':toggle_note'):return toggle_note($d,'',$nl);break;
case(':toggle_text'):return toggle_div($d,0,$nl);break;
//case(':toggle_quote'):return toggle_div($d,1,$nl);break;
case(':toggle'):return toggle_div($d,1,$nl);break;
case(':toggle_conn'):return toggle_conn($d,$nl);break;
case(':rss_art'):return rss::art($d,0,0);break;
case(':rss_read'):return rss::art($d,1,0);break;
case(':webpage'):return webpage($d);break;
case(':webview'):return webview($d,$id);break;
case(':readhtml'):return readhtml($d);break;
case('instagram'):return instagram($d,$id);break;
case(':last-update'):return lastup($d,$id);break;
case(':web'):return web::call($d,0,$id);break;
case(':wiki'):return wiki($d,0); break;
case(':dico'):return wiktionary($d,0); break;
case(':idart'):return id_of_suj($d);break;
case(':book'):return plugin('book',$d,$id); break;
case(':popbook'):return plugin('book',$d,'x'); break;
case(':petition'):return plugin('petition',$id,10); break;
case(':track'):return tracks_one($d); break;
case(':to'):return tracks_to($d); break;
case(':cols'):return mk_cols($d,$m); break;
case(':block'):return mk_block($d,$m); break;
case(':help'):return divc('twit',helps($d)); break;
case(':plan'):return mk::plan($id,$m,$d); break;
case(':artwork'):return mk_artwork($d,$m); break;
case(':look'):return mk_artlook($d); break;
case(':svg'):list($p,$o)=cprm($d); return svg::call($p,$o); break;
case(':math'):return tag('math','',codeline::parse($d,'','math')); break;
case(':plug'):list($p,$o,$fc)=decompact_conn($d); return plugin($fc,$p,$o); break;
case(':pluf'):list($fnc,$plg)=cprm($d); return plugin_func($plg,$fnc,''); break;
case(':plup'):list($p,$o,$conn)=decompact_conn($d); list($plg,$bt)=cprm($conn);//rlg
	return lj('','popup_plupin___'.$plg.'_'.ajx($p).'_'.ajx($o),$bt?$bt:$plg); break;break;
case(':app'):list($p,$o,$fc)=decompact_conn($d); return appin($fc,'call',$p,$o); break;
case(':apps'):return read_apps_link($d); break;
case(':appbt'):return btapp($d,1); break;
case(':bt'):return btapp($d,$nl); break;
case(':search'):list($d,$o)=cprm($d);
	return lj('','popup_search__3_'.ajx($d).'_',picto('search').($o?$o:$d)); break;
case(':tag'):list($p,$o)=cprm($d); if(!$o)$o='tag';
	return lj('txtx','popup_api__3_'.$o.':'.ajx($p),pictxt('tag',$p)); break;
case(':papi'):list($p,$o)=cprm($d);//relegated
	return lj('','popup_api__3_'.ajx($p),pictxt('atom',$o?$o:strend($p,':'))); break;
case(':api'): req('art'); return delbr(api::call($d)); break;
case(':contact'):return contact($d,''); break;
case(':bubble'):return bubble_menus($d,'inline');//old
case(':submenus'):return bubble_menus($d,'inline');
case(':header'):list($t,$p)=cprm($d);
	Head::add($p?$p:'code',delbr($t,"\n")); return; break;
case(':jscode'):Head::add('jscode',delbr($d,"\n")); return; break;
case(':jslink'):Head::add('jslink',delbr($d,"\n")); return; break;
case(':basic'):list($func,$var)=cprm($d); return codeline::cbasic($func,$var); break;
case(':bazx'):return plugin('bazx',$d); break;
case(':version'):return $_SESSION['philum']; break;
case(':ver'):$phi=$_SESSION['philum']; return substr($phi,0,2).'.'.substr($phi,2,2); break;
case(':picto'):list($p,$o)=cprm($d); return picto($p,$o); break;
case(':ascii'):list($p,$o)=cprm($d); return ascii($p,$o); break;
case(':glyph'):list($p,$o)=cprm($d); return glyph($p,$o); break;
case(':oomo'):list($p,$o)=cprm($d); return oomo($p,$o); break;
case(':typo'):list($p,$o)=cprm($d); return mk::typo($p,$o); break;
case(':flag'):return flag($d); break;
case(':nms'):return nms($d); break;
case(':sigle'):return '&'.$d.';'; break;
case(':caviar'):return caviar($d); break;
case(':private'): if(auth(6))return $d.' '.picto('secret'); break;
case(':dev'):if(auth(4))return $d; break;
case(':exec'):return codeline::exec_run($d,$id); break;
case(':on'):return '['.balc('code','',delbr($d)).']'; break;
case(':no'):return; break;}
if($da=='--')return hr();
elseif($xt=='.mp3'||$xt=='.m4a')return audio(goodroot($da),$id);
elseif($xt=='.m3u8')return twit::upvideo_m3u8($da);
elseif($xt=='.pdf')return pdfdoc($da,$nl,$pw);
elseif($xt=='.svg'){list($p,$w,$h)=subparams($da); return image(goodroot($p),$w,$h);}
elseif($xt=='.txt'){$dt=goodroot($da); return lkt('',$dt,strrchr($dt,'/'));}
elseif($xt=='.gz')return download($da);
elseif($xt=='.svg')return svg($da);
elseif($xt=='.mp4'||$xt=='.ogg'||$xt=='.webm'){//.h264
	if($m!=3)return lj('txtx','pagup_popvideo___'.ajx($da),pictxt('video',strend($da,'/')));
	else{list($d,$t)=cprm($da); $d=goodroot($d);
		if($t)return lkt('',$d,$t); else return getmp4($da,$id);}}
//links
$res=connlk($da,$id,$m,$nl,$pw); if($res=='-')return; if($res)return $res;
elseif(substr($da,0,1)=='@' && $tw=substr($da,1))return poptwit($da,$id,'ban',$nl);
elseif(substr($da,0,1)=='#' && $tw=substr($da,1))return poptwit($da,$id,'search');
elseif(strpos($da,'@'))return str_replace('@',picto('arobase'),$da);
//codeline_join
$cn=substr($c,1);
//if(method_exists($cn,'call'))return $cn::call($d,'');
if(method_exists($cn,'call'))return callapp($cn,$d);
//$clvr=sesmk('clvars','',0); if(isset($clvr[$cn])){$rb=decompact_conn($da); return codeline::conn($rb[0],$rb[1],$rb[2]);}
if($cn && substr($c,0,1)==':'){// && $cn!='stop' && $cn!='attr' && $cn!='rect' && $cn!='defs'
	if(reqp($cn)){$ret='';
		list($p,$o)=cprm($d); $fc='plug_'.$cn; if(function_exists($fc))$ret=$fc($p,$o);
		if($ret)return delbr($ret,"\n");}
	//user_conn
	$ret=codeline::mod_basic($cn,$d); if($ret)return $ret;}
return '['.$da.']';}
}
?>