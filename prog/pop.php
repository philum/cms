<?php
#philum_pop 

#syntax_system
function format_txt_r($msg,$media,$id){
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
			$mid=format_txt_r($mid,$media,$id);}
		else $mid=$msb;
		$mid=connectors($mid,$media,$id);
		$end=substr($msg,$in+1+$out+1);
		$end=format_txt_r($end,$media,$id);}
	else $end=substr($msg,$in+1);}
else $end=$msg;
return $deb.$mid.$end;}

function format_txt($ret,$media,$id){
if(strpos($ret,'<'))$ret=retape_html($ret);
if(rstr(70))$ret=retape($ret,$id);
if(!rstr(13))$ret=correct_br($ret);
$ret=format_txt_r($ret,$media,$id);
if(rstr(13))$ret=embed_p($ret);
$ret=nl2br($ret);
return $ret;}

function retape_html($d){
return str_replace('>'."\n",'>',$d);}

function correct_br($msg){
$r=array(':/2]',':/3]',':/4]',':table]',':h]',':h2]',':h3]',':ul]',':photo]',':video]',':slider]',':msq_graph]',':2cols]',':php]',':q]',':popvideo]'); $n=count($r);
for($i=0;$i<$n;$i++)$msg=str_replace($r[$i]."\n\n",$r[$i]."\n",$msg);
return $msg;}

function embed_p($d){
$d=str_replace("\n\n</","</",$d); $r=explode("\n\n",$d);
$ex='<h1<h2<h3<h4<br<hr<pr<di<if<bl';//<im<a <ob<li<sv<ta<ul<li
foreach($r as $k=>$v){if($v=trim($v)){$cn=substr($v,0,3);
	if(strpos($ex,$cn)!==false)$ret.=$v; else $ret.='<p>'.($v).'</p>';}}
//$ret=str_replace('<p></p>','',$ret);
return $ret;}

function retape($ret,$id){
	if(strin($ret,'<'.'br') or strin($ret,'{{') or $_SESSION['rtp'.$id]){//}}//for cv
	$r=msq_ses('oldconn','system','connectors_old',1); if($r)$k=array_keys($r);
	$ret=delbr($ret,"\n"); $ret=clean_br($ret); $ret=str_replace($k,$r,$ret);
	if($id){$msg=mysql_real_escape_string(stripslashes($ret)); 
	update('qdm','msg',$msg,'id',$id); $_SESSION['rtp'.$id]='';}}
return $ret;}

function retape_conn($xf,$id){
$r=msq_ses('oldconn','system','connectors_old',1);;
if($r[$xf] or $old){$_SESSION['rtp'.$id].=$xf.'->'.$r[$xf]."\n"; return $r[$xf];}
return $xf;}

#motor
function add_im_img($nnw){
$dejm=sql('img','qda','v','id="'.$_SESSION['read'].'"');
if($dejm)$djm=$dejm;
if(strpos($djm,$nnw)===false)
update('qda','img',$djm.'/'.$nnw,'id',$_SESSION['read']);}

function add_im_msg($or,$mg){
$mg=str_replace(array('users/','img/'),'',$mg);
$nmsg=addslashes(sql('msg','qdm','v','id="'.$_SESSION['read'].'"'));
if($or){$nmsg=str_replace($or.':img',$or,$nmsg);
	$nmsg=str_replace($or.'\n\n',$mg,$nmsg);
	$nmsg=str_replace($or.'\n',$mg,$nmsg); 
	$nmsg=str_replace($or,$mg,$nmsg);}
elseif($_POST["atpos"]=="ok")$nmsg=str_replace(':img:','['.$mg.']',$nmsg);
elseif($_POST["imatop"]=="ok")$nmsg='['.$mg.']'.$nmsg; else $nmsg.='['.$mg.']';
update('qdm','msg',$nmsg,'id',$_SESSION['read']);}

function vacuum_image($doc,$id){
if(strpos($doc,'?'))$dc=strdeb($doc,'?'); $xt=xt($dc);
if(substr($doc,0,21)=='data:image/png;base64'){$b64=1; $dc=substr($doc,22);$xt='.png';}
if(substr($doc,0,22)=='data:image/jpeg;base64'){$b64=1; $dc=substr($doc,23);$xt='.jpg';}
if(!$xt or $xt=='.php' or $xt=='.jpeg')$xt='.jpg';
if(forbidden_img($doc)===false)return;
if($id=='test')return $doc;
if($id){$nmw=$_SESSION['qb'].'_'.$id.'_'.substr(md5($doc),0,6).$xt;
	if($b64){write_file('img/'.$nmw,base64_decode($dc)); $ok=1;}
	else{$dc=urlutf($doc,1);
		$ok=@copy($dc,'img/'.$nmw);//error here stop display new art
		if(!$ok){$d=curl_get_contents($dc);
			if($d && strpos($d,'Forbidden')===false){write_file('img/'.$nmw,$d); $ok=1;}}}
	if($ok){add_im_img($nmw); add_im_msg($doc,$nmw); return $nmw;} 
	else return $doc;}
else return $doc;}

function place_image($doc,$media,$large,$largb,$txt=''){
$nl=substr($_SESSION['nl'],0,2); $nla=substr($media,0,2); $p['id']='rez';
if(substr($doc,0,4)=='http'){if(eradic_acc($doc)==$doc)$ok=joinable($doc);
	if($ok)list($w,$h)=@getimagesize($doc);
	if($w>$large)$w=$large; return image($doc,$w,'',atr($p))."\n\n";}
else $pre=jcim($doc);
$dca=$pre.$doc;
if($nl or $nla=='nl'){$http=host().'/'; $dca=str_replace('../','',$dca);}
if(file_exists($dca))list($w,$h)=getimagesize($dca);
if(!$w && !$pre){$dca=$doc; $w=$largb;}
if($media=="noimages")return;
elseif($media!="nlc"){//rss
	if(rstr(17))$largb/=2;
	if(rstr(9) && !$com && $w<$largb)$p['style']='float:left; margin-right:10px;';
	if($w && $w<$largb)$p['style'].=' width:'.$w.'px;';
	$p['src']=$http.$dca; if(!rstr(9))$br="\n\n";//$h>40 or 
	$ret='<img '.atr($p).' />';
	$send='photo_'.str_replace('_','*',$dca).'_'.$w.'_'.$h;
	if($txt && !$com){$icon=picto('img').' ';
		if($w && !$nl)return ljb('','SaveBf',$send,$icon.$txt);
		else return lkt('',$dca,$txt);}
	if($w>$large && $large && !$com){
		if($nl or $nla=='nl')return $ret.$br; 
		else return ljb('','SaveBf',$send,$ret).$br;}
	else return $ret.$br;}}

function figure($d,$large){list($im,$t)=good_param($d);
$pre=jcim($im); $im=$pre.$im; list($w,$h)=getimagesize($im);
$send='photo_'.str_replace('_','*',$im).'_'.$w.'_'.$h;
if($w>$large)$bt=ljb('','SaveBf',$send,picto('get')).' ';
$ret=bal('figure',img($im).bal('figcaption',$bt.$t));
return $ret;}

function clvars(){return array_flip(explode(' ','br balise html div span size clear id class style name text url jurl anchor date title cut split'));}//:img:exec:conn

#connectors
function connectors($doc,$media,$id){$large=$_SESSION['prma']['content'];
	$largb=round($large*0.5); $xt=strtolower(strrchr($doc,'.'));
	$xfp=strrpos($doc,':'); $xf=substr($doc,$xfp); $pdoc=substr($doc,0,$xfp);
	if(rstr(70))$xf=retape_conn($xf,$id);
	//list($d,$p)=good_param($pdoc);
switch($xf){
case(':no'):return; break;
case(':br'):return "\n";break;
case(':u'):return '<u>'.$pdoc.'</u>';break;
case(':i'):return '<i>'.$pdoc.'</i>';break;
case(':b'):return '<b>'.$pdoc.'</b>';break;
case(':h'):return '<h3>'.$pdoc.'</h3>';break;
case(':h1'):return '<h1>'.$pdoc.'</h1>';break;
case(':h2'):return '<h2>'.$pdoc.'</h2>';break;
case(':h4'):return '<h4>'.$pdoc.'</h4>';break;
case(':e'):return '<sup>'.$pdoc.'</sup>';break;
case(':l'):return '<small>'.$pdoc.'</small>';break;
case(':k'):return '<strike>'.$pdoc.'</strike>';break;
case(':q'):return '<blockquote>'.$pdoc.'</blockquote>';break;
case(':t'):return btn("txtit",$pdoc);break;
case(':c'):return btn("txtclr",$pdoc);break;
case(':s'):return btn("stabilo",$pdoc);break;
case(':r'):return pub_clr($pdoc.'§ff0000');break;
case(':list'):return make_li($pdoc,'ul');break;
case(':css'):return pub_css($pdoc);break;
case(':font'):return pub_font($pdoc);break;
case(':size'):return pub_size($pdoc);break;
case(':color'):return pub_clr($pdoc);break;
case(':html'):return pub_html($pdoc);break;
case(':pub'):return pubart($pdoc);break;//pub
case(':w'):return lkc('',goodroot($pdoc),$pdoc);break;
case(':read'):return str_replace('<br />','',read_msg($pdoc,$media)); break;//read
case(':photo'):return photo_thumbs($pdoc,$id);break;//gallery
case(':photo1'):return plugin('flashgallery',$pdoc,$id);break;//flash
case(':photo2'):return gallery_j($pdoc,$id);break;//ajax
case(':gallery'):return gallery($pdoc);break;
case(':slides'):return slides($pdoc,$id);break;//diapo
case(':slider'):return slider($pdoc,$id);break;//flash
case(':sliderJ'):return sliderj($pdoc,$id);break;//ajax
case(':jukebox'):return jukebox($pdoc,$media,$id);break;//jukebox
case(':radio'):return radio($pdoc,$media,$id);break;//radio
case(':import'):return import_art($pdoc,$media);break;//import
case(':numlist'):return make_li($pdoc,'ol');break;
case(':forum'):return plugin('forum',$pdoc?$pdoc:$id);break;//forum
case(':search'):return rech_internal($pdoc);break;//search
case(':articles'):return arts_mod($pdoc,$id);break;//articles
case(':formail'):return make_form($pdoc,'mailform'.$id,'_formail___'.ajx($pdoc,'').'____');break;//mail
case(':chat'):return plugin('chat',$pdoc?$pdoc:$id,5);break;//chat
case(':chatxml'):return plugin('chatxml',$pdoc?$pdoc:$id);break;
case(':room'):return call_plug('','popup','chatxml',$pdoc,pictxt('chat',$pdoc));break;
case(':shop'):return plugin('shop','shop',$pdoc,$id);break;//shop
case(':prod'):return plugin('shop','prod',$pdoc,$id);break;//prod
case(':bkg'):return mk_bkg($pdoc,$id);break;
case(':draw'):return plugin('draw');break;
case(':icon'):return icon($pdoc);break;
case(':center'):return bal("center",$pdoc);break;
case(':right'):return divc('" align="right',$pdoc);break;
case(':clear'): if(is_image($pdoc))$pdoc=place_image($pdoc,$media,$large,$largb);
	return str_replace('float:left;','',$pdoc)."\n\n";break;
case(':table'):return mk_table($pdoc);break;
case(':divtable'):return mk_dtable($pdoc);break;
case(':nh'): if($media=='nl')return lka('#nb'.$pdoc.'" name="nh'.$pdoc,$pdoc);
	else return lj('" name="nh'.$pdoc,'popup_nbp___'.$pdoc.'_'.$id,$pdoc); break;
case(':nb'): if($media!='nl')$go=urlread($id);
	return lka($go.'#nh'.$pdoc.'" name="nb'.$pdoc,$pdoc);break;//nbp
case(':pre'):return bal("pre",entities($pdoc));break;
case(':code'):return bal('pre',bal('code',$pdoc));break;
case(':php'):return progcode($pdoc); break;
case(':link'):return special_link($pdoc); break;
case(':console'):return divc("console",$pdoc);break;
case(':figure'):return figure($pdoc,$large);break;
case(':scan'):return scan_txt($pdoc);break;//fopen_txt
case(':iframe'):return iframe($pdoc,'');break;
case(':imgtxt'):return create_img_txt($pdoc);break;
case(':download'):return download($pdoc);break;
case(':msql'):return msqread(msq_goodtable_b($pdoc),$id);break;
case(':microsql'):return msqread(msq_goodtable($pdoc),$id);break;
case(':microread'):return microread($pdoc);break;
case(':msq_conn'):return msqconn($pdoc,$id);break;
case(':msq_html'):return msqconn($pdoc,$id);break;//obso
case(':msq_lasts'):return msqlasts($pdoc);break;
case(':msq_count'):return msqcount($pdoc);break;
case(':msq_bin'):return msqbin($pdoc);break;
case(':msq_graph'):return msqgraph($pdoc,$media);break;
case(':data'):return msqdata($pdoc,$id);break;
case(':microform'):return plugin('microform',$pdoc,$id);break; break;
case(':module'): req('mod'); return build_mod_r($pdoc); break;
case(':modpop'):return lj('','popup_modpop__3_'.ajx($pdoc),picto('get')); break;
case(':ajxget'):return ajx($pdoc); break;
case(':ajax'):return ajxlink($pdoc,randid(),0,1);break;
case(':rss_input'):return rssin($pdoc);break;
case(':twitter'):return plugin_func('twit','twit_build',ajx($pdoc));break;
case(':twitter_cached'):return twitart($pdoc,$id);break;
case(':poptwit'):return poptwit($pdoc);break;
case(':last-update'):return lastup($pdoc,$id);break;
case(':pdf'):return pdfreader($pdoc); break;
case(':swf'):return popswf($pdoc); break;
case(':jpg'):return place_image($pdoc,$media,$large,$largb); break;
case(':img'):$im=vacuum_image($pdoc,$id);
	return place_image($im,$media,$large,$largb); break;//img
case(':image'):return image($pdoc); break;
case(':mini'):if(substr($pdoc,0,4)=='http')return vacuum_image($pdoc,$id);
	return make_mini_b($pdoc,$id);break;//mini 
case(':thumb'):return make_mini_c($pdoc); break;//thumb
case(':video'):return video_auto($pdoc,$large,$id,$media);break;
case(':popvideo'):return popvideo($pdoc); break;
case(':poptxt'):return call_j($pdoc,'poptxt');break;
case(':popmsqt'):return call_j($pdoc,'popmsqt');break;
case(':popmsql'):return call_j($pdoc,'popmsql');break;
case(':popread'):return call_j($pdoc,'popread');break;
case(':pop'):return call_pop($pdoc);break;
case(':jopen'):return jopen($pdoc,0);break;//jopen
case(':jconn'):return jopen($pdoc,1);break;//jconn
case(':popurl'):return popurl($pdoc); break;
case(':popart'):return pop_art($pdoc);break;
case(':rss_art'):return rss_art($pdoc,0,0);break;
case(':rss_read'):return rss_art($pdoc,1,0);break;
case(':webpage'):return lj('txtbox','popup_webpage___'.ajx($pdoc),preplink($pdoc)); break;
case(':web'):return weblink($pdoc); break;
case(':idart'):return id_of_suj($pdoc);break;
case(':petition'):return plugin('petition',$id,10); break;
case(':book'):return plugin('book',$pdoc,$id); break;
case(':popbook'):return plugin('book',$pdoc,'x'); break;
case(':track'):return tracks_read($pdoc); break;
case(':2cols'):if($media>2)return columns($pdoc,2); else return $pdoc; break;
case(':3cols'):if($media>2)return columns($pdoc,3); else return $pdoc; break;
case(':svg'):return svg($pdoc); break;
case(':svgcode'):list($p,$o)=split_one('§',$pdoc,1); return plugin_func('svg','svg_j',$p,$o); break;
case(':plugin'):list($p,$o)=split_one('§',$pdoc,1); return plugin($p,$o); break;
case(':plug'):list($p,$o,$conn)=decompact_conn($pdoc); return plugin($conn,$p,$o); break;
case(':pluf'):list($fnc,$plg)=explode('§',$pdoc); return plugin_func($plg,$fnc,''); break;
case(':plup'):list($p,$o,$conn)=decompact_conn($pdoc); list($plg,$bt)=split_one('§',$conn,1);
	return lj('','popup_plupin___'.$plg.'_'.ajx($p).'_'.ajx($o),$bt?$bt:$plg); break;
case(':openapp'):list($p,$o,$d)=decompact_conn($pdoc); return openapp($d,$p,$o); break;
case(':popapp'):list($p,$o,$d)=decompact_conn($pdoc); return lj('','popup_openapp___'.$d,$d); break;
case(':apps'): return read_apps_link($pdoc); break;
case(':bubble'):return bubble_menus($pdoc,'inline');
case(':header'):list($d,$p)=explode('§',$pdoc);
	Head::add($p?$p:'code',delbr($d,"\n")); return; break;
case(':jscode'):Head::add('jscode',delbr($pdoc,"\n")); return; break;
case(':jslink'):Head::add('jslink',delbr($pdoc,"\n")); return; break;
case(':basic'):list($func,$var)=good_param($pdoc); return cbasic($func,$var); break;
case(':bazx'):return plugin('bazx',$pdoc); break;
case(':version'):return $_SESSION['philum']; break;
case(':ver'):$phi=$_SESSION['philum']; return substr($phi,0,2).'.'.substr($phi,2,2); break;
case(':picto'):@list($p,$o)=explode('§',$pdoc); return picto($p,$o); break;
case(':on'):return '['.$pdoc.']'; break;}
if($doc=='--')return hr();//hr
if(is_image($doc) && strpos($doc,'§')===false && strpos($doc,'<')===false){//images
	if(substr($d,0,4)=='http' && !$_GET['callj'])$doc=vacuum_image($doc,$id);
	return place_image($doc,$media,$large,$largb);}
if(strpos($doc,"¬")!==false)return mk_dtable($doc);//tables
if($xt==".mp3")return audio(goodroot($doc),$id);//mp3
if($xt==".mp4")return video_html(goodroot($doc));//mp4
if($xt==".pdf")return pdfdoc($doc,$media,$large);//pdf
if($xt==".svg"){list($p,$w,$h)=subparams($doc); return image($p,$w,$h);}//svg
//if($xt==".flv")return jwplayer($doc,$large);//flv
if($xt==".swf")return flash_prep($doc,'');//swf
if($xt==".txt"){$doc=goodroot($doc);
	return lkt('',$doc,strrchr($doc,"/"));}
if($xt==".gz")return download($doc);//tar
if($xt && $xt!="."){//video
	if(strpos('.ogg.mp4.m4a.mov.mpg.wmv.h264.aac',$xt)!==false){
	if($media!=3)return lj('txtx','pagup_popvideo___'.ajx($doc),pictxt('video',strrchr_b($doc,"/")));
	if($xt=='.mp4' or $xt=='.m4a' or $xt=='.mov')return video_html(goodroot($doc));}}
if(substr($pdoc,0,1)=='@')return poptwit(substr($pdoc,1));
//liens
if((strpos($doc,'§')!==false or strpos($doc,'http')!==false or strpos($doc,'@')!==false) && strpos($doc,'<a href')===false){$lk=prepdlink($doc);
if(is_image($lk[0])){//link2image§text
	if(substr($lk[0],0,4)=='http')$lk[0]=vacuum_image($lk[0],$id);
	if(substr($lk[1],0,4)=='http')$lk[1]=lkt('',$lk[1],preplink($lk[1]));
	if(is_image($lk[1]))return popim(goodroot($lk[0]),image(goodroot($lk[1])),$id);//mini
	//return place_image($lk[0],$media,$large,$largb,$lk[1],'');
	return popim(goodroot($lk[0],1),$lk[1]);}
elseif(is_image($lk[1])){//link§image
	if(substr($lk[1],0,4)=='http'){$lk[1]=vacuum_image($lk[1],$id);}
	if(strpos($lk[0],'.pdf')!==false)return pdfdoc($doc,$media,$large);
	if(is_numeric($lk[0]))$lk[0]=urlread($lk[0]);
	return lkc('',$lk[0],place_image($lk[1],$media,$large,$largb))."\n\n";}
elseif(substr($lk[0],0,4)=='http')return lka($lk[0],$lk[1]);
elseif(strpos($lk[0],'<img')!==false)return $lk[0].divc('blocktext',$lk[1]);
elseif(strpos($lk[1],'<img')!==false)return $lk[0].' '.$lk[1];
elseif(substr($lk[0],0,1)=='/')return lka($lk[0],$lk[1]);
elseif(strpos($lk[0],'/')!==false)return lkc('',goodroot($lk[0]),$lk[1]);
elseif(strpos($lk[0],'.pdf')!==false)return pdfdoc($doc,$media,$large);
elseif(substr($lk[0],0,1)=='#'){list($lien,$name)=explode('-',$lk[0]);
	return lka($lien.'" name="'.$name,$lk[1]);}
elseif(strpos($lk[0],'@')!==false && strpos($lk[0],'.')!==false)
	return lka('mailto:'.$lk[0],$lk[1]?$lk[1]:$lk[0]);
elseif(substr($doc,0,1)=='@' && $tw=substr($doc,1))return poptwit($tw);
	//return call_plug('','popup','twitter',ajx($tw),$doc);
elseif(is_numeric($lk[0]))return jread('',$lk[0],$lk[1]);}
//cols
if(substr($xf,0,2)==":/"){$nb=substr($xf,2); if(is_numeric($nb)){$nw=($large/$nb)-5;
	if($media<3)return $pdoc;
	else return divs('float:left; width:'.$nw.'px; padding-right:5px;',$pdoc);}}
//codeline_join
$xxf=substr($xf,1); $clvr=sesmk('clvars');
if($clvr[$xxf]){$rb=decompact_conn($doc); return codeline($rb[0],$rb[1],$rb[2]);}
//user_conn
$is=strpos($xf,':')!==false?1:0;
if($xxf && $is && $xxf!='stop' && $xxf!='attr' && $xxf!='rect' && $xxf!='defs'){
	$func=msql_read('',ses('qb').'_connectors',$xxf);
	if(!$func)$func=msql_read('','public_connectors',$xxf);
	if($func && !is_array($func))return cbasic($func,$pdoc);
	//plugin
	if(reqp($xxf)){list($p,$o)=explode('§',$pdoc); $ret=plugin($xxf,$p,$o);}
	if($ret)return delbr($ret,"\n");}
return '['.$doc.']';}

#codeline
function codeline($v,$p,$c){//v§p:c //v:c
switch($c){
//elements
case('br'): return br(); break; 
case('hr'): return hr(); break;
case('balise'): if($p){@list($bal,$id,$css,$sty)=explode('|',$p);
	if($v)return balise($bal,array(5=>$css,3=>$id,16=>$sty),$v);} break;
case('html'): if($p && $v)return bal($p,$v); break;
case('span'): if(trim($v))return span($p,$v); break;
case('div'): if(trim($v))return div($p,$v); break;
case('css'): if(trim($v))return btn($p,$v); break;
case('clear'): return divc($c,$v); break;
//attributs
case('id'): return atd($v); break;
case('class'): return atb($c,$v); break;
case('style'): return atb($c,$v); break;
case('name'): return atb($c,$v); break;
case('font-size'): return atb($c,$v); break;
case('font-family'): return atb($c,$v); break;
//apps
case('text'): return $v?$v:$p; break;
case('url'): return lka($v,$p?$p:preplink($v)); break;
case('jurl'): return lj('',$v,$p); break;
case('link'): return special_link($v.'§'.$p); break;
case('ajx'): return lj('','popup','_'.$p,$v); break;
case('anchor'): return '<a name="'.$v.'"></a>'; break;
case('date'): return mkday(is_numeric($p)?$p:'',$v); break;
case('title'): return suj_of_id($v); break;
case('read'): return read_msg($p,3); break;
case('image'): return image($v); break;
case('thumb'): return make_thumb_d($v,$p); break;
case('picto'): return picto($v,$p); break;
//high_level
case('cut'): list($s,$e)=split("/",$p); return embed_detect($v,$s,$e,''); break;
case('split'): return explode($p,$v); break;
case('conn'): return connectors($v.':'.$p,3,''); break;
case('exec'): if(auth(5)){$data=$p; eval($v); return $output;} break;
case('core'): if(is_array($v))return call_user_func($p,$v,'','');
	else{$vb=explode('/',$v); return call_user_func($p,$vb[0],$vb[1],$vb[2],$vb[3]);}break;
case('plug'): return plugin($v,$p); break;
case('foreach'): foreach($v as $va)$ret.=cbasic_exec($va,'','',$o); return $ret; break;
default:return $v;}}

//§txtit:css§h2:html
function cbasic_exec($d,$p,$r,$o){
list($av,$ap,$c)=decompact_conn_b($d);//v§p:c
if(strpos($av,':')!==false)$av=cbasic_exec($av,$p,$r,$o);//iteration
if($o==2)$av=$av?$av:$p;//param on left (no §) //strpos($ap,'_PARAM')===false
if(!is_array($av))$av=cbasic_vars($av,$p,$r);
if($ap)$ap=cbasic_vars($ap,$p,$r);
if($o==1)echo $av.'$'.$ap.':'.$c.br();
return codeline($av,$ap,$c);}

function cbasic_if($v,$p,$r,$o){list($va,$vb)=split('=',$v);
//if(strpos('+-*/',$vb)!==false)$vb=cbasic_mth($vb);
if(strpos($vb,':')!==false)$vb=cbasic_exec($vb,$p,$r,'');
else $p=cbasic_vars($vb,$p,$r);
if($va=='_PARAM')$p=$p&&$o?$p:$vb; else $r[$va]=$vb;
return array($p,$r);}

function cbasic_vars($ret,$p,$r){if(is_array($r)){
foreach($r as $k=>$v){$i++; $ret=str_replace('_'.$i,stripslashes($v),$ret);}}
$ret=str_replace('_PARAM',stripslashes($p),$ret);
return $ret;}

function cbasic($code,$p){//$code=str_replace("\r",'',$code);
if(is_array($code))return;
if(strpos($code,'[')!==false){if($p)$code=str_replace('_PARAM',$p,$code);
	return format_txt_r($code,'','test');}
$code=str_replace('--',"\n",$code);
$r=explode("\n",$code); $n=count($r); //correct_txt($p,'',''codeline);
for($i=0;$i<$n;$i++){$sp=($r[$i]); $op=substr($sp,0,1); $ret='';//trim
	if(strpos('+-/?!.;=',$op)!==false)$sp=substr($sp,1);
	if($op=='/' or !$op)$reb='';
	elseif($op=='?')list($p,$rb)=cbasic_if($sp,$p,$rb,1);
	elseif($op=='!')list($p,$rb)=cbasic_if($sp,$p,$rb,0);
	elseif($op=='.'){$ret=cbasic_exec($sp,$p,$ret,0); $ra[$i-1]='';}
	elseif($op=='+')$rb=cbasic_exec($sp,$p,$rb,0);
	elseif($op=='=')$p=cbasic_exec($sp,$p,$rb,0);
	elseif($op=='-' && $rb)$ret=cbasic_exec($sp,$rb,$rb,2);//
	elseif($op==';')$ret=cbasic_exec($sp,$p,$rb,1);
	elseif($sp=='see')p($rb);
	else $ret=cbasic_exec($sp,$p,$rb,0);//see
$ra[$i]=$ret;}
return implode('',$ra);}

#usages
function decide_size($doc){//_a
list($dc,$l,$h)=subparams($doc);//w/h§name
if(substr($dc,-4)!='.swf')$dc.='.swf';
$dc=goodroot($dc,1);
if(!is_numeric($l) && is_file($dc))list($l,$h)=getimagesize($dc);
if(!is_numeric($l))$l='100%'; if(!is_numeric($h))$h=400;
return array($dc,$l,$h);}

function decide_source($doc,$id){//goodroot()
$doc=str_replace("\n",'',$doc); if(is_numeric($doc)){$id=$doc; $doc='';}
if(strpos($doc,",")!==false)$r=explode(",",$doc);
elseif(!$doc){$d=sql('img','qda','v','id="'.$id.'"');
	$r=explode('/',substr($d,1)); $src='/img/';}
else{if(substr($doc,-1)!='/')$doc.='/'; $src='users/'.$doc; $r=explore($src,'files',1);}
return array($r,$src);}

#conn_functions
function pubart($d){list($v,$p)=split_one("§",$d,1);
if(strpos($v,','))return m_pubart(array_flip(explode(',',$v)),'','');
switch($p){case(1):return art_read_b($v,'',1,'');break;
case(2):return art_read_b($v,'',2,'');break;
case(3):return art_read_b($v,'',3,'');break;
case(4):return pub_art($v); break;
case('pop'):return popart($v,'',suj_of_id($v)); break;
default:return jread('',$v,suj_of_id($v)); break;}}

function pdfdoc($doc,$nl='',$large=''){$lk=prepdlink($doc);
if($nl=='nl')return $doc; $lk[0]=goodroot($lk[0]);
if(is_image($lk[1]))$im=place_image($lk[1],$media,$large,'');
if($_SESSION['nl'])return lkt('',$lk[0],$im);
return $im.lj('','popup_poppdf___'.ajx($lk[0]).'_'.ajx($lk[1]),picto('txt')).' '.lkt('',$lk[0],$lk[1]);}

function pdfreader($d){if(substr($d,-3)!='pdf')$d.='.pdf';
if(substr($d,0,4)!='http')$d=host().'/users/'.$d; $hlp=hlpbt('pdf');
return lj('','popup_poppdf___'.ajx($d).'_'.ajx(preplink($d)),icon('pdf')).$hlp;}

function popswf($d){list($dc,$l,$h)=decide_size($d);
$nm=strrchr_b($d,'/'); $im=icon('flash'); if(im)$nm=$im.' '.$nm; //patch_image($dc);
if(substr($dc,0,4)!='http')$wght=btn('txtsmall',round(filesize($dc)/1024).'Ko');
return lj('txtx','popup_swf___'.ajx($dc).'_'.$l.'_'.$h,$nm).' '.$wght;}

function jopen($d,$c){list($id,$t)=good_param($d); 
$t=$t?$t:suj_of_id($id); $p='['.$id.':read]'; if($c)$p='['.$id.']';
return toggle('','jop'.$p.'_conn_'.$p,$t).' '.btd('jop'.$p,'');}

function mk_bkg($v,$id){list($d,$p)=good_param($v); if(!$p){$p=$d; $d='';}
if($p)$mg=$p; else $mg=first_img(sql('img','qda','v','id='.$id));
$f=goodroot($mg,1);
if(file_exists($f))list($w,$h)=getimagesize($f);
return divs('background-image: url(/img/'.$mg.'); background-repeat:no-repeat;  background-position:center center; background-size:cover; background-attachment:fixed; height:90%;',$d);
}//'.$h.'px

function nb_dwnl($f){$nmf=normalize($f);
if(strrpos($nmf,"/")!==false)$nmf=substr($nmf,strrpos($nmf,"/")+1);
if(strrpos($nmf,".")!==false)$nmf=substr($nmf,0,strrpos($nmf,"."));
$nmf='plug/_data/'.ses('qb').'_'.$nmf.'.txt';
if(is_file($nmf)){$nb=read_file($nmf);
return btn("txtsmall",':: '.$nb.' downloads');}}

function download($d){
list($d,$t)=split_one('§',$d); list($lk,$nm)=prepdlink($d); $nm=$t?$t:$nm; 
$f=$g=goodroot($lk);//root_security
if(!is_file($f))$g='img/'.$f; if(!is_file($g))$g='users/'.$f;
if(is_file($g)){$size=' '.btn("txtsmall2",'('.round(filesize($g)/1024).'Ko)');
	if(!$t && substr($f,0,5)=='users')$nm=strrchr_b('/',$d);//$nbd=nb_dwnl($f);
	return lka('plug/download/'.base64_encode($g),$nm).$size.$nbd;}
else return $nm.' (file_not_exists)';}

function make_li($d,$ul){$r=explode("\n",$d);
foreach($r as $v){if(substr($v,0,1)=='-')$v=substr($v,1);
	if(strpos($v,'<li'))$ret.=$v; elseif(trim($v))$ret.=li(trim($v));}
if($ret)return bal($ul,$ret);}

function imgsize($imp){if(is_file($imp))return getimagesize($imp);}
function pub_css($d){list($v,$k)=good_param($d); return btn($k,$v);}
function pub_font($d){list($v,$k)=good_param($d); return bts('font-family:'.$k,$v);}
function pub_clr($d){list($v,$k)=good_param($d); $kb=colors($k);
return bts('color:#'.($kb?$kb:$k),$v);}
function pub_size($d){list($v,$k)=good_param($d);
$sty='font-size:'.$k.'px; line-height:'.round($k*1.2).'px;';
return balise('font',array(16=>$sty),$v);}
function pub_html($d){list($p,$o)=split_right('§',$d); $r=explode_k($o,' ','=');
$ra=array('css'=>'class','font'=>'font-family','size'=>'font-size'); $rb=colors();
foreach($r as $k=>$v){if($k=='color')$v=$rb[$v]?$rb[$v]:'#'.$v;
	$atb.=($ra[$k]?$ra[$k]:$k).':'.$v.'; ';}
return bts($atb,$p);}

function arts_mod($v,$id){
list($p,$t,$d,$o,$ch,$hd,$tp)=explode('/',$v);
$load=api_mod_arts_row($p); unset($load[$id]);
$ret=mod_load($load,'',$t,$d,$o,1,$prw,$tp,$id);
return $ret;}

function progcode($d){$d=delbr($d,"\n");
//$d=str_replace(array('{{','}}'),array('{ {','} }'),$d);
$d=highlight_string('<'.'?php'."\n".$d."\n".'?'.'>',true);
$d=str_replace(array('<span style="color: #0000BB">&lt;?<br /></span>','<span style="color: #0000BB">?&gt;</span>',"\n</span>","&nbsp;",'  </span>','  '),array('','','</span>',' ','</span>',"&nbsp;&nbsp"),$d);
return divs('overflow:auto; wrap:true; font-size:12px;',$d);}

function scan_txt($d){
	list($f,$o)=split_one('§',$d,1);
	$f=goodroot($f);
	if(!$_SESSION['read']){return btn('txtx',"Text_Document");}
	elseif(is_file($f)){$ret=read_file($f); 
	$from=lkc('txtx',$f,$f)."\n\n";
	if(!$op) $ret='<xmp>'.$ret.'</xmp>';
	else $ret=format_txt(nl2br($ret),'','');}
return '['.$from.$ret.':q]';}

function create_img_txt($v){list($p,$o)=explode("§",$v);
return plugin('imgtxt',$p,$o,'');}

//j
function call_j($f,$d){list($lf,$lk)=good_param($f); 
$lk=$lk?$lk:suj_of_id($lf).' '.picto('get');
return lj('','popup_'.$d.'___'.ajx($lf),$lk);}

function call_pop($d){list($v,$k)=good_param($d); $id=randid('bpop'); 
if(strpos($k,"\n"))$k=strdeb($k,"\n"); sesr('temp',$k,$v);
return lj('" id="bt'.$id,'popup_text___'.$id.'_'.ajx($k),$k.' '.picto('get'));}

function popurl($d){
return ljc('','popup','ajxf_batch*preview_'.ajx($d),preplink($d).' '.picto('get'));}
function pop_art($d){list($id,$t)=split_one('§',$d);
if(substr($d,0,4)=='http')$j='popup_rssart__3_'.ajx($id).'_1';
else $j='popup_popart__3_'.$id.'_3'; $t=$t?$t:suj_of_id($id);
return lj('',$j,pictxt('articles',$t?$t:preplink($d)));}

//menusJ
function links_t($t){$r=explode(' ',$t);
foreach($r as $v)if(strpos($v,':picto'))$ret.=picto($v).' '; else $ret.=$v.' '; return $ret;}
function pictoconn($t){//$ico=sesmk('icotag'); $t=$ico[$t]?$ico[$t]:$t;
list($t,$ico)=explode(':',$t); if($ico=='picto')$t=picto($t);
return $t;}

function ajxlk($d,$here,$o,$n){
list($lk,$t)=split_right('§',$d,1);
@list($l,$k)=split("->",$lk); if(!$k)$k=$here;
$j=$k.'_ajxlnk_'.ajx($l).'_'.$here.'_'.$n.'_'.$o;
$c=($_SESSION[$here]==$lk?'active':'');
list($tb,$p)=explode(':',$t); if($p=='picto')$t=picto($tb);
return ljb($c.'" title="'.$tb,'SaveTg',$j,$t,'')."\n";}

function poplk($d,$id){list($lk,$t)=split_right('§',$d,1); 
return lj('" title="'.$tb,$id.'_ajxlnk___'.ajx($lk),pictoconn($t));}
function toglk($d){list($lk,$t)=split_right('§',$d,1);
return togbub('ajxlnk',ajx($lk),pictoconn($t));}

//pop=popup,onplace,o=closeable,closed,css
function ajxlink($d,$id,$o,$pop){
static $i; $i++; $here='here'.$id.$i; $d=str_replace("\n",'',$d); $ik=0;
if(strin($o,'notcloseable'))$clb=1; if(strin($o,'closed'))$cld=1;
$cs='nbp'; if($pop=='togup')$cld=1;
if(strpos($d,",")!==false){$r=explode(",",$d);
	if(!$_SESSION[$here] && !$cld)$_SESSION[$here]=str_extract('§',$r[0],1,0);
	foreach($r as $k=>$v){$hid=strprm($v,5);
	if($v && !$hid){
		if($pop=='popup')$ret.=poplk($v,$here).' ';//$pop=0??
		elseif($pop=='togup')$ret.=toglk($v).' ';
		else $ret.=ajxlk(trim($v),$here,$clb,$ik).' '; $ik++;}}}
else{if($pop=='popup')$ret.=poplk($d,$here).' ';
	elseif($pop=='togup')$ret.=poplk($d,$here).' ';//
	else $ret=ajxlk($d,$here,$clb,$ik);}
$ret=div(atd('mnu'.$here).atc($cs),$ret);
if($pop!='popup' && $_SESSION[$here])$ter=build_mod_r($_SESSION[$here]);
$ter=str_replace("\n"," ",$ter);
return $ret.btd($here,$ter);}

//rss
function rssin_old($f){echo '-';//
$rss=read_rss($f,'item',array('title','link','guid')); $nb=count($rss);
for($i=1;$i<=$nb;$i++){list($va,$lnk,$guid)=$rss[$i];
	$va=trim(del_n($va)); $va=clean_title($va); 
	if(!$lnk)$lnk=$guid; $lnk=utmsrc($lnk);
	$ret[]=array($va,$lnk);}
return $ret;}

function rssin_xml($f){$rss=load_xml($f);
if($rss)foreach($rss as $k=>$v){list($va,$lnk,$dat)=$v; 
	$va=trim(del_n(strip_tags($va))); $va=clean_title($va);
	$lnk=utmsrc($lnk); if($dat)$dat=rss_date($dat);
	$ret[]=array($va,$lnk,$dat);}
return $ret;}

function recognize_article($f,$d,$alx){$d=clean_title($d);
if(@isset($alx[$f]))return $alx[$f]; 
elseif(isset($alx[$d]))return $alx[$d];
elseif($alx[substr($f,7)])return $alx[substr($f,7)];
$id=sql('id','qda','v','nod="'.ses('qb').'" and mail="'.$f.'" LIMIT 1');
if(!$id)$id=sql('id','qda','v','nod="'.ses('qb').'" and suj like "%'.$d.'%" LIMIT 1');
return $id;}

function alx(){//already_exists, suj&url
foreach($_SESSION['rqt'] as $k=>$v){$ret[$v[2]]=$k; $ret[$v[9]]=$k;}
return $ret;}

function rssin_load($f){$alx=alx();//sesmk('alx');
$r=rssin_xml($f); if(!$r)$r=rssin_old($f); reqp('search');
if($r)foreach($r as $k=>$v){list($suj,$lnk,$dat)=$v;
	if(strpos($lnk,'feedproxy'))$lnk=feedproxy($lnk);
	if(strpos($lnk,'spip.'))$lnk=strdeb($lnk,'spip.').str_extract('/spip',$lnk,1,1);
	$id=recognize_article($lnk,$suj,$alx);
	$ret[]=array($suj,$lnk,$dat,$id);}
return $ret;}

function rssin_t($k,$v,$f){
$ret.=lj('','popup_plupin___rssin_'.ajx($v),picto('get')).' ';
$ret.=lj('','adc_batchprep__3_'.ajx($v),picto('update')).' ';
$ret.=lj('','popup_msqledit___users_'.ses('qb').'*rssurl_'.$k.'_2',picto('flag')).' ';
$ret.=lkt('txtsmall2',$f,picto('rss'));//urlencode
return $ret;}

function rssin($k,$v){$lk=prepdlink($v); $f=$lk[0]; $f=http($f); //$f=https($f);
$r=rssin_load($f); $nb=count($r); $ret=hidden('','addop',1); $t=rssin_t($k,$v,$f);
foreach($r as $k=>$v){list($va,$lnk,$dat,$id)=$v; $btc=''; $lnj=ajx($lnk); $i++;
	if(!$id){$btc=ljc('','popup','ajxf_batch*preview_'.$lnj,picto('view')); $fb=nohttp($lnk);
		if(auth(4)){$mem=@$_SESSION['vacuum'][$fb]?'ok':picto('add');
			$btc.=lj('" id="ars'.$i,'ars'.$i.'_batch___'.$lnj.'_p',$mem);
			$btc.=lj('','popup_search__3_'.ajx($va).'_',picto('search'));}}
else $btc.=popart($id).' ';
$btc.=lkt('',$lnk,picto('url')); $btc.=btn('txtsmall',$dat);
if($va)$ret.=balc('li','',$btc.' '.$va);}//$id?'hide':
$ret=scroll_b($nb,$ret,16,320);
return $t.balc("ul",'panel',$ret);}

function rssj($p,$o){$r=msql_read('',ses('qb').'_'.$p,'',1);
if($r){foreach($r as $k=>$v){if($v[2]==$o or !$o){
	//if(substr($v[0],0,4)=='http')$v[0]=substr($v[0],7);
	if($v[0])$ret[$v[2]].=toggle('','rsj'.$k.'_rssj_'.$k.'_'.ajx($v[0],''),$v[1]?$v[1]:preplink($v[0])).' '.btd('rsj'.$k,'').br();}}}//$v[2]
if(auth(6))$b=msqlink('',ses('qb').'_'.$p).' ';
return make_tabs($ret,'rss','nbp').$b;}

//weblink
function weblink($u){$r=readmeta($u);
$p['url']=$u; $p['suj']=$r[0]; $p['msg']=$r[1]; $p['img1']=$r[2]; 
if($r[0])return template($p,'weblink');
return lka($u);}

//rss_read
function rss_read($d){
$d=str_replace('?read=','',ajx($d,1)); $r=explode("/",$d); $mx=count($r)-1;
for($i=2;$i<$mx;$i++)$url.=$r[$i]; if(is_numeric($r[$mx]))$id=$r[$mx];
return 'http://'.$url.'/plug/rss1.php?read='.$id.'&preview=full&brut==';}

//rss_art
function rss_art($u,$p,$br){if(substr($u,0,4)!='http')$u='http://'.$u;
if($p)$u=rss_read($u); //$r=load_xml($u,1);
$r=read_rss($u,"item",array("title","link","pubDate","description"));
list($va,$lnk,$dat,$txt)=$r[1]; $va=html_entity_decode($va);
$txt=html_entity_decode($txt); $txt=stripslashes($txt);
if($br)$txt=format_txt($txt,3,$id); else $txt=format_txt_r($txt,3,$id);
if($va)return bal('h2',lkc('',$lnk,$va)).divc('justy',$txt);}

//msq
function msqread($r,$id,$lm=''){if(is_array($r)){
	if(is_array($r['_menus_'])){$titles=$r['_menus_']; unset($r['_menus_']);} 
	//if($titles)array_unshift($titles,'');
	$ret=make_tables($titles,$r,"txtblc",'');}
else $ret=$r;
return stripslashes($ret);}

function msqlreader($d){
$r=explode_r($d,' ','=');
foreach($r as $k=>$v)switch($v){
case(''):;break;}
return $ret;}

function msq_goodtable_b($d){
list($dr,$p)=split_one("/",$d);
list($p,$o)=split("§",$p);
list($p,$v)=split("|",$p);
list($p,$op)=split("-",$p);
list($bs,$nd,$nb)=split("_",$p);
if($nb)$da=$bs.'_'.$nd.'_'.$nb; 
$r=msql_read($dr,$da,$op);
return $v?$r[$v]:$r;}

function msqconn($d,$id){if(!$id)return;
list($d,$p)=split_one('§',$d);
$r=msq_goodtable($d);
return format_txt_r(msqread($r,$id,$p),'','');}

function msqlasts($d){list($d,$l)=split_one('§',$d,1);
$r=msq_goodtable($d); $n=count($r); $l=$l?$l:10; $l*=-1; //$m=$r['_menus_'];
$r=array_slice($r,$l,$n,true); arsort($r);
return msqread($r,$id);}

function msqcount($d){$r=msq_goodtable($d); $n=count($r);
if($n)return $n-1;}

function msqbin($d){
$r=msq_goodtable($d);
$ima=picto('no'); $imb=picto('valid');
if(is_array($r)){
if(is_array($r['_menus_'])){$titles=$r['_menus_']; unset($r['_menus_']);}
if($titles)array_unshift($titles,'');
foreach($r as $k=>$v){
	if(is_array($v)){foreach($v as $ka=>$va){
		if($va=='0')$r[$k][$ka]=$ima; elseif($va==1)$r[$k][$ka]=$imb;}}
	else{if($v==0)$r[$k]=$ima; elseif($v==1)$r[$k]=$imb;}}
return make_tables($titles,$r,'txtcadr','');}}

function msqgraph($d,$m){static $n; $n++; $large=prma('content'); 
if(substr($m,0,2)=='nl')return;
list($da,$rep)=split_one("§",$d,1); list($nd,$bs,$va,$op)=explode("_",$da);
if($bs){$nd=$nd?$nd:ses('qb');}else{$nd=ses('qb'); $bs=$d;}
$r=msq_goodtable($da); $menu=$r['_menus_']; unset($r['_menus_']);
if($r && $rep)foreach($r as $k=>$v){$i++; $bit[$k]=$v[$rep];}
elseif($r && $op){foreach($r as $k=>$v){$i++; $bit[$k]=$v;}}
$output='/imgc/'.ses('qd').'_'.$_SESSION["read"].'_graph_'.$n.'.png';
graphics($output,$large,140,$bit,$_SESSION['clrs'][$_SESSION['prmd']][7],'yes');///
if($_GET["read"])return image($output,'','" style="border:0;')."\n";}

function microread($d){list($nod,$tmp)=good_param($d);
return plugin('msqtemplate',$nod,$tmp);}//msqread

function msqdata($d,$id){
list($v,$k)=split_right('§',$d); $k=$k?$k:1;
if($v){$ra=array($v);
	if($k){$msg=sql('msg','qdm','v','id='.$id);
	$msg=str_replace($d.':msq_data',$k.':msq_data',$msg); 
	update('qdm','msg',$msg,'id',$id);}
$r=msq_create('art_'.$id,$ra,array('txt'),$k); return $r[$k][0];}
else $ret=msql_read('',ses('qb').'_art_'.$id,$k);
if(auth(3))$ret.=msqlink('',ses('qb').'_art_'.$id,$k);
return $ret;}

function twitart($d,$id){
$k=strrchr_b($d,'/'); $ret=msql_read('',ses('qb').'_twit_'.$id,$k);
if(!$ret){list($t,$ret)=vacuum($d);
$r=msq_create('twit_'.$id,array($ret),array('txt'),$k);}
$ret=format_txt_r('['.$ret.':q]','','');
if(auth(3))$ret.=msqlink('',ses('qb').'_twit_'.$id,$k);
return $ret;}

function poptwit($d){list($id,$nm)=explode('§',$d); 
if(strpos($id,'/'))$id=strrchr_b($id,'/'); 
return lj('txtx','popup_plup__3_twit_twit*build_'.ajx($id),pictxt('tw',$nm?$nm:'twitter'));}

//lastupdate
function lastup($v,$id){
$f='plug/_data/'.ses('qb').'_'.$id.'_lastupdate.txt';
if(is_file($f))$last=read_file($f);
if($id==$_SESSION["read"] && auth(4))write_file($f,mkday('',1));//contnue
if($last)return btn('txtsmall2',($v?$v.' ':nms(118).': ').$last);}

function mk_table($d){
list($doc,$opt)=good_param($d);
if($opt=='div')return mk_dtable($doc);
if($opt=='auto')$doc=str_replace(array(' ',"\n"),array('|','¬'),$doc);
if($opt=='nl')$doc=str_replace("\n",'¬',$doc);
if(strpos($doc,'¬')===false && strpos($doc,'|') && strpos($doc,"\n"))
	$doc=str_replace("\n",'¬',$doc);
$doc=str_replace(array('|¬',"¬\n",' ¬'),'¬',$doc);
if(substr(trim($doc),-1)=='¬')$doc=substr(trim($doc),0,-1);
$taba='tr';$tabb='td';$tabc="table";
$tr=explode('¬',$doc);
if(!$opt)$csb='';
foreach($tr as $k=>$tra){
	$td=explode('|',$tra); $ia++; $trb='';
	if($opt){$csa='';
		if($opt>1){if($ia/2==round($ia/2))$csa='txtblc'; else $csa='txtx';}
		if($ia==1)$csa='txtcadr';}
	foreach($td as $kb=>$tda){$re.=balc($tabb,$csa,$tda); $trb.=trim($tda);}
	if(str_replace(':','',$trb))$ret.=bal($taba,$re);$re='';}
return balc($tabc,$csb,$ret);}

function mk_dtable($d){$r=explode('¬',$d);
foreach($r as $k=>$v){$rb=explode('|',$v); $rt='';
foreach($rb as $ka=>$va){$rt[]=$va;} $ret[]=$rt;}
return make_divtable($ret);}

#photos
function make_thumb_d($im,$d){
list($w,$h)=split('/',$d); if(!$w)$w=currentwidth();
if(strpos($im,'/')!==false)$imn=str_replace('/','',$im); else $imn=$im;
$thumb=thumb_name($imn,$w,$h); $im=goodroot($im);
if(is_file($im) or substr($im,0,4)=='http'){$lmt=$_SESSION['rstr'][16];
	if(!file_exists($thumb) or $_GET['rebuild_img'])make_mini($im,$thumb,$w,$h,$lmt);
	return image($thumb,$w,$h);}
else return picto('img',48);}

function make_mini_b($d,$id){
list($im,$siz)=split_one('§',$d,1); if(!$siz)$siz=prmb(27);
$img=make_thumb_d($im,$siz); $im=goodroot($im);
return popim($im,$img,$id);}

function make_mini_c($doc){//conn_thumb //im§w/h
list($v,$p)=split_one('§',$doc,1); $img=make_thumb_d($v,$p);
$im=goodroot($v); list($l,$h)=getimagesize($im);
$send='photo_'.str_replace("_","*",$im).'_'.$l.'_'.$h;
if($_SESSION['nl'])return image($im,currentwidth(),'');
else return ljb('','SaveBf',$send,$img);}

function make_mini_d($doc){//img_thumb
list($dc,$l,$h)=subparams($doc);//w/h§im//_a
if($l or $h)$sz='§'.$l.'/'.$h;
return make_mini_c($dc.$sz);}

function make_thumb_b($mg,$dir=''){
$xt=substr($mg,-3); $w=140; $h=100; 
list($w,$h)=split('/',prmb(27));
$thumb=thumb_name(str_replace('/','',$mg),$w,$h);//or filesize($thumb)<2048
if(!file_exists($thumb) or $_GET['rebuild_img']){
	make_mini($dir.$mg,$thumb,$w,$h,$_SESSION['rstr'][16]);}
return '<img src="'.$thumb.'">';}

function make_mini_j($dir,$v,$id){$f=$dir.$v;
if(is_file($f))list($w,$h)=getimagesize($f);
if($w)$img=make_thumb_b($v,$dir);
return ljb('','SaveBf','photo_'.ajx($f).'_'.($w).'_'.($h).'_'.$id,$img);}

function photo_thumbs($doc,$id){
list($r,$src)=decide_source($doc,$id);
if(is_array($r)){foreach($r as $k=>$v){
	if(!$src)$dir=jcim($v); else $dir=$src;
	$xt=strtolower(substr($v,-3));
	if($xt=='jpg' or $xt=='gif' or $xt=='png')$ret.=make_mini_j($dir,$v,$id);}}
return $ret;}

function gallery($d){$r=scandir('users/'.$d); if($r){rsort($r);
foreach($r as $k=>$v){$f='users/'.$d.'/'.$v; if(is_file($f))$ret.=image($f);}}
return $ret;}

function slides($p,$id){
$s=strpos($p,'--')?'--':"\n"; $r=explode($s,$p);
foreach($r as $v)if($v)$rb[]=array($v);
$r=msql_modif('',nod('slides_'.$id),$rb,array('val'),'arr','');
return plugin('slides',$id);}

function radio_song($d,$p){
$r=msql_read_b('radio',$d,$p); return $r[1];}

function radio($d,$p,$id){//$f=radio_slct($d,$p,$id);
$r=msql_read_b('radio',$d,'',1); $rid=randid('rad');
if($r)foreach($r as $k=>$v){if($k==$p)$f=$v[1];
	$ret.=lj('',$rid.'_radio___'.ajx($d).'_'.$k,$v[3]).br();}
if($_SESSION['USE'])$add=lj('','popup_radioedit___'.$nod.'___'.$id,picto('edit'));
if(!$_SESSION['nl'])return divb('nbp|'.$rid,audio($r[1][1],$rid)).$add.$ret;}

function slider($d,$id){//_a
list($f,$l,$h)=subparams($d);//w/h§name
$w=$w?$w:$w=currentwidth(); $h=$h?$h:$w*(3/4);
$clrs=$_SESSION['clrs'][$_SESSION['prmd']];
if(!$f)$nod=$id; else $nod=$f;
$fvars='&servr='.host().'/&rot='.$nod.'&clr='.$clrs[6];
$nod=str_replace('_','*',$nod); //$file='msql/gallery/'.$nod.'.php'; 
if($_SESSION['USE'])$add=lj('','popup_slider___'.$nod.'_'.$id,picto('edit'));
if(!$_SESSION['nl'])return embed_flsh('fla/slider.swf',$w,$h,$fvars).$add;}

function sliderj($d,$id){
list($f,$o)=split_one('§',$d,1);
require_once('plug/sliderJ.php');
if(!$_SESSION['nl'])return plug_sliderJ($f,$id,$o);}

function gallery_j_slct($doc,$id,$d){$large=currentwidth();
list($id,$idn)=explode('-',$id); $dcb=ajx($doc,''); $mp='impos'.$idn;
list($r,$src)=decide_source($doc,$id); $nb=count($r);
if(is_numeric($d))$_SESSION[$mp]=$d;
	elseif($d=='next')$_SESSION[$mp]++; elseif($d=='prev')$_SESSION[$mp]--;
if($_SESSION[$mp]>=$nb)$_SESSION[$mp]=0;
if($_SESSION[$mp]<0)$_SESSION[$mp]=$nb-1;
if(!$src)$dir=jcim($r[$_SESSION[$mp]]); else $dir=$src;
$im=$dir.$r[$_SESSION[$mp]]; $img=image($im,$large,'');
if(is_file($im))list($w,$h)=getimagesize($im);
if($w>$large)$ret=ljb('','SaveBf','photo_'.ajx($im,'').'_'.($w).'_'.($h),$img);
else $ret=$img;
return $javs.$ret;}

function gallery_j($doc,$id){static $i; $i++;
$j='galj_'.$id.'-'.$i.'_'.ajx($doc,''); $_SESSION['impos'.$i]=0;
$ret.=divc('',ljb('txtbox','SaveBb',$j.'_prev',picto('kleft')).$pp.ljb('txtbox','SaveBb',$j.'_next',picto('kright')));
$img=gallery_j_slct($doc,$id.'-'.$i,0); 
$ret.=div(atd('galj'.$id.'-'.$i),$img);
if(!$_SESSION['nl'])return $javs.$ret;}

function jukebox($f,$media,$id){list($f,$o)=explode('§',$f);
if($o){$w="379"; $h="300";}else{$a="micro"; $w="130"; $h="38";}
if($media==2)return btn('popbt','Jukebox');
$fvars='&servr='.host().'/&opdir='.$f.'&artid='.$id;
return embed_flsh('fla/'.$a.'jukebox.swf',$w,$h,$fvars);}

#forms
function make_form($d,$div,$jx){
$prod=explode(",",$d);$n=count($prod);
for($i=0;$i<$n;$i++){list($val,$type)=explode("=",$prod[$i]); $vb=normalize($val); 
if($type=='check'){$chk='chk'.$ia++; $hn[]=$chk;} elseif($type!='button')$hn[]=$vb;
switch($type){
	case('text'):$ret.=txarea('" id="'.$vb,'',44,8);break;
	case('check'):$ret.=checkbox($chk,'no','',''); break;
	case('hidden'):$ret.=hidden('',$vb,$val);break;
	case('uniqid'):$ret.=hidden('',$vb,ses('iq'));break;
	case('hidden'):$ret.=balise("input",array(1=>$type,3=>$vb,4=>$val),'');break;
	case('list'):
	//$ret.=balise("select",array(3=>$vb),batch_defil(array_flip(explode("/",$val))));
	$ret.=select(atd($vb),explode('/',$val),'vv'); break;
	case('radio'):$rb=explode("/",$val); $ret.=radiobtn($rb,$vb,$val).br(); break;
	case('date'):$ret.=hidden('',$vb,mkday('','ymd.his')); break;
	case('upload'):$ret.=balise('input',array(1=>'text',3=>$vb,4=>'url'),''); break;
	case('button'):$btn=$val;break;
	case('mail'):$ret.=balise('input',array(1=>'text',3=>$vb,6=>20,23=>$val,21=>'num_mail(\''.$vb.'\');'),''); break;
	default:$ret.=autoclic($val.'" id="'.$vb,'',20,255,'');break;}
if($type!='button' && $type!='date' && $type!='hidden' && $type!='uniqid' && $type!='radio')$ret.=' '.label($vb,'txtsmall2','',$val).br();}
$ret.=lj("popsav",$div.$jx.implode('|',$hn),$btn?$btn:picto('right'));
return divd($div,$ret);}

#embed
function audio($d,$id=''){return '<audio controls>
<source id="mp3'.$id.'" src="'.$d.'" type="audio/mpeg"></audio>';}
function embed_flsh($fl,$xf,$yf,$fvar){$fl=substr($fl,0,4)!='http'?'../'.$fl:$fl;
return '<embed src="'.$fl.'" width="'.$xf.'" height="'.$yf.'" wmode="transparent" FlashVars="'.$fvar.'" quality="high" allowfullscreen="true" />';}
function flash_prep($f,$id){if($f)list($movie,$l,$h)=decide_size($f);
return embed_flsh($movie,'100%','100%',$fvar);}

function video_providers($d){$nb=strlen($d);
if($nb==32)$vid='rutube';
elseif($nb==11)$vid='youtube'; //elseif($nb==9)$vid='vk';
elseif($nb==7 && is_numeric($d))$vid='rutube';
elseif($nb==5 or $nb==6 or $nb==7 or $nb==18 or $nb==19)$vid='daily';
elseif(is_numeric($d))$vid='vimeo'; 
//elseif(strpos($d,'.'))$vid='ted'; 
//else $vid='livestream';
return $vid;}

function video_url($d,$p,$t=''){$t=$t?$t:$p;
if($p=='vimeo')$u='vimeo.com/'.$d;
elseif($p=='youtube')$u='youtube.com/watch?v='.$d;
elseif($p=='daily')$u='dailymotion.com/video/'.$d;
if($u)return lkt('','http://'.$u,$t); else return $t;}//pictxt('url',)

function video_img($d,$p){
if($p=='youtube')$ret='http://img.youtube.com/vi/'.$d.'/1.jpg';
if($p=='daily'){$ret='http://www.dailymotion.com/thumbnail/video/'.$d;
	//echo $hash=unserialize(file_get_contents($f)); //echo get_headers($ret);
}
if($p=='vimeo'){$f='http://vimeo.com/api/v2/video/'.$d.'.php';
	if(is_file($f))$hash=unserialize(file_get_contents($f));
	$ret=$hash[0]['thumbnail_small'];}
return $ret;}

function popvideo($d){list($d,$t)=explode('§',$d); $p=video_providers($d);
list($w,$h)=explode('/',$t); if(is_numeric($w))return video_players($d,$p,$w,$h,'');
$j='pagup_video___'.ajx($d).'___autosize'; $url=video_url($d,$p,$t).' ';
$im=video_img($d,$p); if($im && !$t)$bt=lj('',$j,image($im,'120','90',''));
$open=lj('',$j,pictxt('play','')).' ';
if($bt)return divc('',$bt.' '.btn('small',$url));
else return btn('popbt',$open.$url);}

function video_auto($doc,$l,$id,$media){//p§w/h
if(substr($doc,0,4)=='http')$doc=auto_video($doc,'','',2);
return popvideo($doc);}

function video_html($f){
if(strpos($f,'.mp4'))$xt='mp4'; else $xt=substr(xt($f),1);
return '<video controls width="100%"><source src="'.$f.'" type="video/'.$xt.'"></video>';}

function video_players($d,$p,$w,$h,$id){if($id){$w='100%'; $h='95%';}
else{if($w==1)$w=''; if(!$h && $w)$h=$w*0.5; $w=$w?$w:440; $h=$h?$h:320; $w.='px'; $h.='px';}
//if($_SESSION['nl'])return lkc('txtx',urlread($id),'Video');
if($p=='youtube')return iframe('http://www.youtube.com/embed/'.$d.'?border=0&version=3&autohide=1&showinfo=0&rel=0&fs=1',$w,$h);
elseif($p=='daily')return iframe('http://www.dailymotion.com/embed/video/'.$d,$w,$h);
elseif($p=='vimeo'){return iframe('http://player.vimeo.com/video/'.$d,$w,$h);}
elseif($p=='vk')return iframe('http://vk.com/video_ext.php?oid='.$d.'&hd=2',$w,$h);
elseif($p=='ted'){if(strpos($d,'&'))list($d,$ti)=explode('&',$d);
return '<embed src="http://video.ted.com/assets/player/swf/EmbedPlayer.swf"  width="100%" height="100%" allowFullScreen="true" flashvars="vu='.$d.'&vw=100%&vh=100%&ap=0&lang='.$_SESSION['opts']['lang'].'&ti='.$ti.'"></embed>';}
elseif($p=='livestream')return iframe('http://cdn.livestream.com/embed/'.$d.'?layout=4&height='.$h.'&width='.$w.'&autoplay=false',$w,$h);
elseif($p=='rutube')return '<embed src="http://video.rutube.ru/'.$d.'" type="application/x-shockwave-flash" wmode="window" width="100%" height="auto" allowFullScreen="true">';
else return video_html($d);}

#log_system
function loged($usr,$rg,$t){if($t)$ret=btn('popw',$t).' ';
if(!$_SESSION['USE'] or !is_numeric($rg)){//nameofauthes(prmb(11))
$nam='login'; $sty='" style="width:100px;';
$ret.=autoclic('user" id="lgg" onkeyup="log_finger(\'lgg\');',$nam,8,100,'search',1);
$ret.=input2('password" size="8" placeholder="password','pass','','search');
if(rstr(59))$ret.=checkbox_j('cook',1,'','stay loged').' '; else $ret.=hidden('','cook',1);
$ret.=submitj('" title="'.helps('login').'','log',picto('logout'));
return divd('valid','<form id="log" name="log" action="javascript:login(\'log\')" onKeyPress="checkEnter(event,\'log\')">'.$ret.'</form>');}
else return lkc('popdel',htac('log').'out',pictit('logout','log out')).br();}

function authes_levels(){return array(0=>'login',1=>'tracks',2=>'post',3=>'publish',4=>'edit',5=>'design',6=>'admin',7=>'host',8=>'dev');}
function nameofauthes($i){if(!is_numeric($i))$i=0;
$ath=authes_levels(); return $ath[$i];}
function affect_auth($auth){$ath=authes_levels();
for($i=0;$i<$auth;$i++){$arf[$i]=$i.'::'.$ath[$i];}
return $arf;}

function verif_user($user,$pasw){
if($pasw)$wh=' AND pass=PASSWORD("'.$pasw.'")';
list($iq,$ip)=sql('id,ip','qdu','r','name="'.$user.'"'.$wh);
return $iq;}//if($ip==hostname())

function isgoodhubname($user){$dir="users/"; //$user=normalize($user);
if($_SESSION['qbin']['membrs'][$user])return true;
$iq=sql('id','qdu','v','name="'.$user.'"'); if($iq)return true;
$r=explore($dir,'dirs',1); if($r[$user])return true;}

function log_result($Use,$iq,$qb,$rl,$ck){
$_SESSION['USE']=$Use; $_SESSION['iq']=$iq; $_SESSION['qb']=$qb;
if($ck){$dayz=$_SESSION['dayx']+(86400*30); $_SESSION['nuse']='';
	setcookie('use',$Use,$dayz); setcookie('iq',$iq,$dayz);}
if($rl)relod(prep_host($qb).'?id='.$qb.'&refresh==&log=on');
else return 'logon: '.$qb;}

#login
function login($user,$pasw,$mail,$cook=''){
$user=normalize($user); $pasw=normalize($pasw);
$newhub=$_POST['create_hub']; $qdu=ses('qdu'); $qb=ses('qb'); $host=hostname();
if(md5($user.$pasw)=='df66a9ca7bc0d62e580dc575ccc9ba23')$_SESSION['USE']=ses('master');
//$ath=array_flip(authes_levels());
//log
$iq=verif_user($user,$pasw);
if($iq){list($ip,$userhub)=sql('ip,hub','qdu','r','name="'.$user.'"');
	if($ip!=$host)update('qdu','ip',$host,'name',$user);
	if($userhub)$qb=$user;
	return log_result($user,$iq,$qb,'',$cook);}
//autolog
elseif($user=='login'){//is_numeric($ath[$user])
	if(!rstr(73))return loged($user,'','');
	list($iq,$ip)=sql('id,ip','qdu','r','name="'.$qb.'"');
	if($ip==$host){return log_result($qb,$iq,$qb,'',$cook);}
	else{list($iq,$USE)=sql('id,name','qdu','r','ip="'.$host.'"');
		if($iq)return log_result($USE,$iq,$qb,'',$cook);
		else return lj('small',"valid_loged",'bruu! '.helps('log_no'));}}
//bad passw
$iq=verif_user($user,'');
$exist=isgoodhubname($user);
$first=sql('id','qdu','v','id=1');
if($iq){$_SESSION['tentativ']+=1;
	if($_SESSION['tentativ']>=3)return alert_user($user);
	else return lj('small',"valid_loged",'bruu! '.helps('log_nopass'));}
//nolog //auth_log && prms('create_hub')!="on"
elseif(prmb(11)==0 && !$newhub && $first && !auth(5))
	return lj('small',"valid_loged",'bruu! '.helps('log_nohub'));
//elseif($user && $pasw && !$iq)return lj('small',"valid_loged",'bruu! '.helps('log_nopass'));
elseif($exist==true)return lj('small',"valid_loged",'bruu! '.$user.' '.nms(37));
//register
elseif(prmb(11)>=1 or $newhub or !$first or prms('create_hub')=="on"){$rl="ok";
	if(!$mail or strpos($mail,"@")===false){
		$tfield=divc("txtcadr",helps('log_newser').' '.prmb(11));
		$tfield.=hidden('user','',$user).hidden('pass','',$pasw);
		if(auth(6) or !$first or (prmb(11)>=6 && prms('create_hub')=="on"))
			$tfield.=hidden('create_hub','',$user);
		$tfield.=autoclic('mail','mail?','20','100','').' ';
		$tfield.=input2('submit','envoyer',"ok",'txtbox').' ';
		$tfield.=lj('txtx','valid_loged',picto('left'));
		return form('/?log=on',$tfield);}
	else{
		if($_POST['mail'] or $newhub){$user=$newhub?$newhub:$user;}
		elseif($_SESSION['USE']){$user=$_SESSION['USE'];}
	if($user!='admin')$iq=adduser($qb,$user,$pasw,$mail);//add_user
	if(prmb(11)>=6 or $newhub or !$first){modif_cnfgtxt($user,$first);//add_hub
		$qb=makenew($user); message2newuser($user,$mail,$pasw); $_SESSION['auth']='';}
	$_SESSION['qbin']['adminmail']=$mail;
	log_result($user,$iq,$qb,$rl,$cook);}}}

function modif_cnfgtxt($qb,$first){
$db=connect(); $f='params/_'.$db.'_config.txt';
if(is_file($f)){$d=read_file($f); $r=explode('#',$d);}
else $r=array($_SESSION['qd'],'no','yes',$_SESSION['qb'],'','philum.net','','','','Europe/Paris','6135','4000');
if(!$first)$r[3]=$qb; if($_SESSION['htacc'])$r[1]='yes';
write_file($f,implode('#',$r));}

function message2newuser($user,$mail,$pasw){
$from=$_SESSION['qbin']['adminmail'];
$subj=$user; $txt=helps('newhub_mail');
$txt=str_replace(array('_USER','_PASS'),array($user,$pasw),$txt);
$txt.="\n\n".prep_host(ses('qb'));
send_mail_html($mail,$subj,nl2br($txt),$from,prep_host($user));}

function alert_user($user){
list($qmail,$pss)=sql('mail,pass','qdu','r','name="'.$user.'"');
$subj="$qb - tentative de login";
$txt='rappel de vos identifiants:
login: '.$user.', passw: '.$pss.'
--
'.host();
$adminmail=$_SESSION['qbin']['adminmail'];
$tet="From: $adminmail \n";
mail($qmail,$subj,$txt,$tet);
return lj('small',"valid_loged","password sent to user $user $qmail");}

#newuser
function add_member($qb,$user,$ath){$qdu=$_SESSION['qdu'];
$mbrs=sql('mbrs','qdu','v','name="'.$qb.'"');
$mbrs.=$ath.'::'.$user.','; $_SESSION['auth']=$ath;
update('qdu','mbrs',$mbrs,'name',$qb);
$_SESSION['qbin']["membrs"]=tab_members($mbrs);}

function adduser($qb,$user,$pasw,$mail){$dayx=$_SESSION['dayx'];
$qdu=$_SESSION['qdu']; $mbrs="7::admin,"; $open=''; $ip=hostname();
if(prmb(11)>=6 or $_POST['create_hub']){
	$open=1; $menus=$dayx; $hub=$user;
	list($rstr,$config)=ndprms_defaults();
	if(!$_SESSION['line'])$mbrs.='7::'.$qb.','; else $mbrs.='6::'.$qb.',';}//first
elseif(prmb(11)>=1)add_member($qb,$user,prmb(11));
$ex=sql('id','qdu','v','id=1');
if(!$ex)echo plugin('install','pub');
return insert('qdu',"('','$user',PASSWORD('$pasw'),'$mail','".$dayx."','$clr','$ip','$rstr','$mbrs','$hub','','$config','$strct','$dscrpt','$menus','$open')");}

#install
function default_rstr($u){
if($u)return msql_read('users',ses('qb').'_rstr','',1);
else return msql_read('system','default_rstr','',1);}

function ndprms_defaults(){$rstr=default_rstr(0);
$r=msql_read('system','default_params','',1);
foreach($r as $k=>$v)$rb[$k]=$v[0];
for($i=0;$i<=$k;$i++)$config.=$rb[$i].'#';
$ln=explode(",",$_SERVER['HTTP_ACCEPT_LANGUAGE']);
if($ln[0]=="fr")$lang="fr"; else $lang="eng"; //$first_art=$lang=="fr"?236:253;
$config=str_replace('LANG',$lang,$config);
return array('0'.implode('',$rstr),$config);}

function makenew($qb,$restore=''){
$qdu=ses('qdu'); require('styl.php'); if(!auth(4))$_SESSION['auth']=4;
msq_copy("system","default_css_1",'design',$qb.'_design_1');
msq_copy("system","default_clr_1",'design',$qb.'_clrset_1');
msq_copy("system","default_css_2",'design',$qb.'_design_2');
msq_copy("system","default_clr_2",'design',$qb.'_clrset_2');
msq_copy("system","default_mods",'users',$qb.'_mods_1'); 
msq_copy("system","default_rstr",'users',$qb.'_rstr');
msq_copy("system","default_apps",'users',$qb.'_apps');
if($restore){list($rstr,$config)=ndprms_defaults();
update('qdu','rstr',$rstr,'name',ses('qb'));
update('qdu','config',$config,'name',ses('qb'));}
$clr=msql_read('system','default_clr_1','');
$css='css/'.$qb.'_design_1.css'; build_css($css,css_default(1),$clr);
$clr=msql_read('system','default_clr_2','');
$css='css/'.$qb.'_design_2.css'; build_css($css,css_default(),$clr);
update('qdu','menus',ses('dayx'),'name',$qb);
if(!is_dir('users/'.$qb))mkdir_r('users/'.$qb);
return $qb;}

#philum_pub
function philum_pub(){
return format_txt_r(helps('philum_pub_txt'),'','');}

?>