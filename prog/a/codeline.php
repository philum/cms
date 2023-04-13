<?php //a/codeline
class codeline{

static function parse($msg,$op,$g){
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
			$mid=self::parse($mid,$op,$g);}
		else $mid=substr($msg,$in+1,$out);
		if($g=='template')$mid=self::template($mid,$op);
		elseif($g=='sconn')$mid=self::sconn($mid,$op);
		elseif($g=='sconn2')$mid=self::sconn2($mid,$op);
		elseif($g=='sconn3')$mid=self::sconn3($mid);
		elseif($g=='savimg')$mid=self::savimg($mid,$op);
		elseif($g=='corrfast')$mid=self::corrfast($mid,$op);
		elseif($g=='corrfastb')$mid=self::corrfastb($mid,$op);
		elseif($g=='stripconn')$mid=self::stripconn($mid,$op);
		elseif($g=='striptw')$mid=self::striptw($mid,$op);
		elseif($g=='correct')$mid=self::correct($mid,$op);
		elseif($g=='clpreview')$mid=clpreview($mid);
		elseif($g=='delconn')$mid=self::delconn($mid);
		elseif($g=='extractimg')$mid=self::extractimg($mid,$op);
		elseif($g=='conn2xhtml')$mid=xhtml::conn2xhtml($mid,$op);
		elseif($g=='extract')$mid=self::conn_extract($mid,$op);
		elseif($g=='num2nb')$mid=self::num2nb($mid,$op);
		elseif($g=='math')$mid=self::math($mid,$op);
		elseif($g=='svg')$mid=svg::conn($mid);
		elseif($g=='md')$mid=self::md($mid);
		$end=substr($msg,$in+1+$out+1);
		$end=self::parse($end,$op,$g);}
	else $end=substr($msg,$in+1);}
else $end=$msg;
if($g=='extractimg')return $mid.$end;
return $deb.$mid.$end;}//clean_nb

static function read($d){
$d=self::parse($d,'','sconn');
return nl2br($d);}

static function png2jpg($id,$o=''){
$d=sql('msg','qdm','v',$id); get('read',$id);
if(rstr(48))$d=codeline::parse($d,'webp2jpg','correct');
if($o)$d=codeline::parse($d,'forcewebp2jpg','correct');
return codeline::parse($d,'png2jpg','correct');}

#templater
static function build($d,$r){
foreach($r as $k=>$v){$va='_'.strtoupper($k); $ra[$k]=$va;
	if(!$v)$d=str_replace($va,'',$d);//del empty
	else $r[$k]=self::read($v);}
$d=str::repair_tags($d); $d=delsp($d); $d=str::clean_lines($d); $d=delnl($d);
//$d=preg_replace('/(\n){1,}/',"\n",$d);
$d=self::parse($d,'','template');//build
return str_replace($ra,$r,$d);}//return embed_p($d);

//calls with variables
static function call($d,$r){$ret='';
foreach($r as $k=>$v)$ret.=self::build($d,$v);
return $ret;}

static function call2($d,$op=''){
$ret=self::parse($d,$op,'sconn2');
$ret=embed_p($ret);
$ret=nl2br($ret);
return $ret;}

#correctors
static function correct($da,$op){
$xp=strrpos($da,':'); $c=substr($da,$xp); $d=substr($da,0,$xp);
if($op=='stripconn'){if(strpos($da,'§')!==false)$d=strend($d,'§'); return $d;}
if(substr($op,0,8)=='replconn'){[$op,$a,$b]=opt($op,'-',3);
	if(strpos($da,':'.$a)!==false)return '['.str_replace(':'.$a,':'.$b,$da).']';}
if($op=='png2jpg'){[$d,$txt]=cprm($da); $id=get('read'); $xt=is_img($d);//illogical
	if($xt=='.png' && $id)return img::png2jpg($d,$id);}
if($op=='webp2jpg'){[$d,$txt]=cprm($da); $id=get('read'); $xt=is_img($d);
	if($xt=='.webp' && $id)return img::webp2jpg($d,$id);}
if($op=='forcewebp2jpg'){[$d,$txt]=cprm($da); $id=get('read'); $xt=is_img($d);
	if($xt){$c=read_file('img/'.$d); if(strpos($c,'WEBP') or strpos($c,'JFIF')){return img::webp2jpg($d,$id);}}}
if($op=='stripimg'){[$lin,$txt]=cprm($da);
	if(!is_img($lin))return '['.$da.']';}
if($op=='stripvideo'){if($c==':video' && strpos($da,'§')===false)
	return str_replace(':video','§1:video','['.$da.']');}
if($op=='striplink'){[$lin,$txt]=cprm($da);
	if(is_numeric($lin))$lin=host().urlread($lin);
	elseif(strpos($da,'§')!=false or substr($lin,0,4)=='http')return ($txt?$txt:$lin);
	elseif($c==':pub')return ma::suj_of_id($d).' ('.host().urlread($d).') ';
	elseif($c==':figure')return $txt;}
if($c==$op){
	if($c==':table'){
		//if(get('clean_tab'))return str::del_n($d); else{}//del_n
		$d=str_replace(array('¬','|'),array("\n","\t"),$d);
		if(strpos($d,' ')!==false && strpos($d,'.jpg')===false && trim($d))
			return '['.$d.':q]';
		else return $d;}
	elseif($c==':chat')return;
	elseif($c==':list')return str_replace('|','',$d);
	//elseif($n=strrpos($d,'§'))return substr($d,0,$n);
	elseif($n=strrpos($d,'§')){$nb=strpos($d,']');
		if($nb>$n)return $d; else return substr($d,0,$n);}
	else return ($d);}
else return '['.$da.']';}

#conndefs
static function sconn_html($d,$p,$c){
switch($c){
case(':br'):return br(); break;
case(':hr'):return hr(); break;
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
case(':center'):return '<center>'.$d.'</center>';break;
case(':header'):return '<header'.$p.'>'.$d.'</header>';break;
case(':section'):return '<section'.$p.'>'.$d.'</section>';break;
case(':article'):return '<article'.$p.'>'.$d.'</article>';break;
//case(':stabilo'):return '<stabilo>'.$d.'</stabilo>';break;
case(':quote'):return '<quote>'.$d.'</quote>';break;
case(':fact'):return '<fact>'.$d.'</fact>';break;
case(':qu'):return '<q>'.$d.'</q>';break;}}

static function sconn_links($d,$xt,$b){
if(is_img($d) && strpos($d,'§')===false)return conn::place_image($d,3,$b);
[$p,$o]=cprm($d);
if(is_img($p)){//image§text
	if(is_img($o))return lk(goodroot($p),image(goodroot($o)));
	return lka(goodroot($p),goodroot($o));}
elseif(is_img($o)){//link§image
	return lka(goodroot($p),image(goodroot($o)));}
elseif(substr($p,0,1)=='/')return lka($p,$o);
elseif(substr($p,0,1)=='@')return lj('txtx','popup_twit,call__3_'.ajx($p).'_ban',$p);
elseif(strpos($p,'@'))return $p;
elseif($xt=='.pdf')return mk::pdfdoc($d,0,640);//lka($p,$o);
elseif($xt=='.mp3'){$g=goodroot($d,'1');
	//return lj('','popup_usg,audio___'.ajx($g),pictxt('music',strend($d,'/')));
	return audio($d);}
elseif($xt=='.mp4'){$g=goodroot($d,'1'); return video($g,'auto');}
elseif(strpos($p,':iframe'))return lj('','popup_conn,parser___['.ajx($p).']_3_test',pictxt('window',$o));
elseif(strpos($p,':pdf'))return lj('','popup_conn,parser___['.ajx($p).']_3_test',pictxt('window',$o));
elseif(substr($p,0,4)=='http')return rstr(111)?mk::webview($d,$b):lka($p,$o);
//elseif(strpos($p,':')){return lj('','popup_conn,parser___['.ajx($p).']_3_test',pictxt('cube',$o));}//use :bt
elseif(strpos($p,'twitter.com')!==false && strpos($p,'status/')!==false)return pop::poptwit($d);
elseif(strpos($p,'wikipedia.org')!==false)return mk::wiki($d,0);
elseif(is_numeric($p))return ma::jread('',$p,$o);}

static function sconn_app($d,$c,$xt,$o,$b){switch($c){
case(':pub'):return pop::pubart($d);break;
case(':art'):return pop::pubart($d);break;
case(':to'):return art::tracks_to($d); break;
case(':web'):return web::call($d,0,$b);break;
case(':video'):
	if($b=='epub')return video::titlk($d,'');
	return video::any($d,$b,3,''); break;
case(':videourl'):return video::titlk($d,'');break;
case(':mini'):return mk::mini_b($d,$b);break;
//case(':room'):return lj('','popup_chatxml,home___'.$d,pictxt('chat',$d)); break;//old
case(':twitter'):return pop::twitart($d,$b,'',$o); break;
case(':twapi'):return pop::twitapi($d);break;
case(':twusr'):return twit::play_usrs($d);break;
case(':bt'):return pop::btapp($d,''); break;
case(':connbt'):return pop::connbt($d,''); break;
//case(':poptwit'):return pop::poptwit($d); break;
case(':search'):return lj('popw','popup_search,home___'.ajx($d),pictxt('search',$d));break;
case(':msql'):return mk::msqcall($d,'','');break;
case(':popimg'):return mk::mini_d($d); break;
case(':quote'):return mk::quote2($d,$c); break;
case(':lang'):return mk::translate($d,3);break;
case(':toggle'):return pop::toggle_div($d,0,'');break;
case(':callquote'):return mk::callquote($d,$b,''); break;
case(':app'):[$p,$o,$fc]=unpack_conn($d); return appin($fc,'call',$p,$o); break;
case(':tag'):[$p,$o]=cprm($d); if(!$o)$o=sql('cat','qdt','v',['tag'=>$p]);
	return lj('txtx','popup_api__3_'.$o.':'.ajx($p),pictxt('tag',$p)); break;
case(':umrec'):return umrec::callint($d,''); break;
case(':caviar'):return mk::caviar($d); break;
case(':underline'):return mk::underline($d,3); break;
case(':stabilo'):return mk::stabilo($d);break;
case(':ascii'):[$p,$o]=cprm($d); return ascii($p,$o); break;
case(':oomo'):[$p,$o]=cprm($d); return oomo($p,$o); break;
case(':picto'):return picto($d); break;}
$a=substr($c,1);
if(method_exists($a,'call') && isset($a::$conn)){[$p,$o]=cprm($d); return $a::call($p,$o);}}

#wygsyg
static function sconn($da,$b,$a=''){if(!$da)return;
[$d,$c,$xt]=getconn($da); [$p,$o]=cprm($d);
$ret=self::sconn_html($p,$o,$c); if($ret)return $ret;
if($a==1){$ret=self::sconn_app($d,$c,$xt,$o,$b); if($ret)return $ret;}
switch($c){
case(':c'):return '<txtclr>'.$p.'</txtclr>';break;
case(':stabilo'):return '<stabilo>'.$p.'</stabilo>';break;
case(':color'):return mk::pub_clr($d);break;
case(':red'):return mk::pub_clr($p.'§#bd0000');break;
case(':blue'):return mk::pub_clr($p.'§#333399');break;
case(':parma'):return mk::pub_clr($p.'§#993399');break;
case(':green'):return mk::pub_clr($p.'§#339933');break;
case(':bkgclr'):return mk::pub_bkgclr($d);break;
case(':video'):return video::titlk($p,'');break;
case(':videourl'):return video::titlk($p,'');break;
case(':figure'):return pop::figure($d,'','1');break;
case(':list'):return mk::make_li($p,'ul');break;
case(':numlist'):return mk::make_li($p,'ol');break;
case(':table'):return mk::table($d);break;
case(':pre'):return tagb('pre',str::htmlentities_a($p));break;
case(':code'):return tagb('code',delbr($d));break;
case(':web'):return lka($p);break;
case(':twitter'):if($b=='epub')return pop::twitxt($p,''); else return lka($p,'twitter.com');break;
case(':div'):if($b=='epub')return strto($p,'§');break;
case(':mini'):if($b=='epub')$da=$p;break;
case(':download'):return lka($p);break;
case(':pdf'):return lka($p);break;
case(':img'):return image($p); break;
case(':w'):return lka($p); break;
case(':no'):return;break;}
//if(is_img($p))return image(goodroot($p,1));
if(is_img($da) && strpos($da,'§')===false){$im=goodroot($da,'');
	if($b=='epub'){$fb='_datas/epub/OEBPS/images/';
		if(file_exists($im) && !file_exists($fb.$da))copy($im,$fb.$da); return image('../images/'.$da);}
	else return conn::place_image($da,3,1);}//image($im);
$d=self::sconn_links($da,$xt,$b); if($d)return $d;
if($da=='--')return hr();
return '['.$da.']';}

//extended to few apps
static function sconn2($d,$b){
return self::sconn($d,$b,1);}

static function sconn3($da){
$xp=strrpos($da,':'); $c=substr($da,$xp); $d=substr($da,0,$xp);
if($c==':video')return video::lk($d);
if($d=='http'||$d=='https')return $da;
return $da;}

#correctors
static function savimg2($da,$id){
[$d,$o,$c]=unpack_conn($da); $d2=''; $o2='';
if(is_img($d) && substr($d,0,4)=='http' && !$o)$d2=conn::get_image($p,$id);
if(is_img($o) && substr($o,0,4)=='http')$o2=conn::get_image($o,$id);
$ret=$d2?$d2:$d; if($o)$ret.='§'.($o2?$o2:$o); if($c)$ret.=':'.$c;
return '['.$ret.']';}

static function savimg($da,$id){
[$p,$o]=prepdlink($da); $_SESSION['read']=$id;
if(is_img($p) && substr($p,0,4)=='http')
	return '['.conn::get_image($p,$id).(strpos($da,'§')?'§'.$o:'').']';
elseif(is_img($o)==true && substr($o,0,4)=='http')
	return '['.(strpos($da,'§')?$p.'§':'').conn::get_image($o,$id).']';
else return '['.$da.']';}

static function corrfast($da,$op){
[$d,$c]=split_one(':',$da,1);
$r=explode(' ',$op); $n=count($r);
for($i=0;$i<$n;$i++)if($c==$r[$i]){
	$hk=strrpos($d,']'); $pa=strrpos($d,'§');
	//if($pa>$hk)echo substr($d,0,$pa);
	if($pa>$hk)return substr($d,0,$pa);
	elseif($hk!==false)return $d;
	else return $d;}
return '['.$da.']';}

static function corrfastb($da,$op){
[$d,$o,$c]=unpack_conn($da);
$r=explode(' ',$op); $n=count($r);
for($i=0;$i<$n;$i++)if($c==$r[$i])return strend($d,'§');
return '['.$da.']';}

static function stripconn($da,$op){$no='';
[$d,$c]=split_one(':',$da,1);
$r=explode(' ',$op); $n=count($r);
for($i=0;$i<$n;$i++)if($c==$r[$i])$no=1;
if(!$no)return '['.$da.']';}

static function striptw($d,$op){
if(strpos($d,'//t.co')!==false)return;
if(strpos($d,'/status/')!==false)return;
if(strpos($d,':twitter'))return;
if(substr($d,0,1)=='@'){if(substr($d,-2)==':b' or substr($d,-2)==':u')return '['.$d.']'; else return;}
if(strpos($d,'twitter.com/hashtag'))return '#'.between($d,'twitter.com/hashtag/','?');
if(strpos($d,'https://twitter.com')!==false)return;
return '['.$d.']';}

static function delconn($da){
if(strpos($da,'§')!==false && strpos($da,':')===false){
	[$p,$o]=explode('§',$da); $ret='';
	if(!is_img($o) && !is_http($o))$ret=$o;
	elseif(!is_img($p) && !is_http($p))$ret=$p;
	return $ret;}
elseif(strpos($da,'§')!==false){[$p,$o]=explode('§',$da); $ret='';
	if(!is_img($o))$ret=$o; return $ret;} //if(!is_img($p))$ret.=' ('.$p.')';
elseif(!is_img($da) && strpos($da,':')===false)return $da;
[$d,$c]=split_one(':',$da,1);
if(!is_img($d)){if($d!='http')return $d; elseif($d!='http')return $c?$d:$da;}
elseif($d=='http')return $da.' ';}

static function extractimg($d,$id){
[$p,$o,$c]=unpack_conn($d);
if(is_img($p))return '/'.$p;
elseif(is_img($o))return '/'.$o;
elseif($c=='video'){$qb=ses('qb');
	//$qb=sql('name','qda','v',$id);
	$imv=$qb.'_'.$id.'_'.$p.'.jpg';
	if(is_file('img/'.$imv))return $imv;}
elseif(is_img($d))return '/'.$d;}

static function conn_extract($d,$conn){
[$p,$o,$c]=unpack_conn($d);
if($c==$conn)return $p;}

static function num2nb($d,$conn){//notefoot
[$p,$c]=split_right(':',$d,1); static $i; $rt=[];
if($c=='numlist'){$s="\n"; $r=explode($s,$p);
	foreach($r as $k=>$v)if($v){$i++; $rt[]='(['.$i.':nb]) '.trim($v);}
	return '['.implode(n(),$rt).':aside]';}
else return '['.$d.']';}

#math
static function math($d,$b){
[$p,$o,$c]=unpack_conn($d);
switch($c){
case('frac'):return tagb('mfrac',tagb('mi',$p).tagb('mi',$o)); break;
case('sup'):return tagb('msup',tagb('mi',$p).tagb('mn',$o)); break;
case('sub'):return tagb('msub',tagb('mi',$p).tagb('mn',$o)); break;
case('subsup'):$mo=is_numeric($p)?'&int;':'&dd;';
	return tagb('msubsup',tagb('mo',$mo).tagb('mn',$p).tagb('mi',$o)); break;
case('mi'):return tagb('mi',$p); break;//x
case('mo'):return tagb('mo','&'.($p=='+/-'?'PlusMinus':$p).';'); break;
case('mrow'):return tagb('mrow',$p); break;;
case('matrix'):$rt=''; $r=explode("\n",$p);
	foreach($r as $k=>$v){$rb=explode('|',$v); $d='';
		foreach($rb as $ka=>$va)$d.=tagb('mtd',$va); $rt.=tagb('mtr',$d);}
	return tag('mfenced',['open'=>'[','close'=>']'],$rt); break;
default:if(method_exists('maths',$c))return maths::$c($p,$o);break;}
return '['.$p.']';}

#.md
static function md($da){$ret='';
[$d,$c]=getconn($da); //if($c=='h')echo $c.':'.$p.' - ';//[$p,$o,$c]=unpack_conn(
switch($c){
case(':h'):$ret='# '.$d;break;
case(':h1'):$ret='# '.$d;break;
case(':h2'):$ret='## '.$d;break;
case(':h3'):$ret='### '.$d;break;
case(':h4'):$ret='#### '.$d;break;
case(':h5'):$ret='##### '.$d;break;
case(':b'):$ret='**'.$d.'**';break;
case(':i'):$ret='_'.$d.'_';break;
case(':q'):$ret='> '.$d;break;
case(':list'):$ret=str_replace("\n",'- ',$d);break;
case(':numlist'):$r=explode("\n",$d); foreach($r as $k=>$v)$ret.=$k.'. '.$v.n(); break;
case(':php'):$r=explode("\n",$d); foreach($r as $k=>$v)$ret.="\t".$v.n(); break;
case(':code'):$ret='`'.$d.'`'; break;
case('--'):$ret='`---'; break;}
if(is_img($d)){$ret='![]('.gcim($d).')';}
[$p,$o]=cprm($d);
if(substr($p,0,4)=='http' or substr($p,0,2)=='//')$ret=($o?'['.$o.']':'').'('.$p.')';
return $ret?$ret:$da;}

#templates
static function template($da,$o,$b=''){//d§p:c
[$d,$c,$xt]=getconn($da); //if(!$da)return;
[$p,$o]=cprm($d);
$ret=self::sconn_html($p,$o,$c); if($ret)return $ret;
switch($c){
//elements
case(':tag'):return tag($bal,$o,$p); break;
case(':span'):if($p)return span($o,$p); break;
case(':css'):if($p)return btn($o,$p); break;
case(':div'):if($p)return div($o,$p); break;
case(':divc'):if($p)return divc($o,$p); break;
case(':divd'):if($p)return divd($o,$p); break;
case(':clear'):return divc('clear',$p); break;
case(':grid'):if($p)return divs(gridpos($o),$p); break;
//attributs
case(':id'):return atd($p); break;
case(':class'):return atc($p); break;
case(':style'):return ats($p); break;
case(':name'):return atn($p); break;
case(':js'):return atk($p); break;
case(':itemprop'):return atb('itemprop',$p); break;
case(':font-size'):return atb('font-size',$p); break;
case(':font-family'):return atb('font-family',$p); break;
//apps
case(':txt'):return $p?$p:$o; break;
case(':url'):return lka($p,$o?$o:preplink($p)); break;
case(':hurl'):return lh($p,$o?$o:preplink($p)); break;
case(':jurl'): return lj('',$p,$o); break;
case(':link'):return md::special_link($p.'§'.$o); break;
case(':anchor'):return lkn($p); break;
case(':date'):return mkday(is_numeric($o)?$o:'',$p); break;
case(':title'):return ma::suj_of_id($p); break;
case(':read'):return ma::read_msg($o,3); break;
case(':image'):return image($p); break;
case(':thumb'):return mk::thumb_d($p,$o,''); break;
case(':picto'):return picto($p,$o); break;
//high_level
//case(':ajx'):return lj('',$o,$p); break;
case(':cut'):[$s,$e]=explode('/',$o); return between($p,$s,$e); break;
case(':split'):return explode($o,$p); break;
case(':conn'):return conn::connectors($p.':'.$o,3,'','',''); break;
case(':msql'):return mk::msqcall($p,'',''); break;
//case(':exec'):return self::exec_run($p,$o); break;
case(':core'):if(is_array($p))return call_user_func($o,$p,'',''); else{$pb=opt($p,'/',4);
	return call_user_func($o,$pb[0],$pb[1],$pb[2],$pb[3]);}break;
case(':foreach'):foreach($p as $v)$ret.=self::cbasic_exec($v,'','',$o); return $ret; break;
case(':var'):if($o)return ses::$r[$o]; break;
case(':setvar'):return self::setvar($o);break;
case(':setvars'):return self::setvars($o);break;
default:return $da;}}

static function setvar($d){$n=strpos($d,'=');
if($n!==false){$a=substr($d,0,$n); $b=substr($d,$n+1); ses::$r[$a]=$b;}}
static function setvars($d){$r=explode(',',$d); foreach($r as $v)self::setvar($v);}

static function exec_run($d,$id){$f='_datas/exec/'.$id.'.php'; mkdir_r($f);
if(!is_file($f) or auth(4))write_file($f,'<?php '.$d);
if(is_file($f))require($f); return $ret;}

#cbasic //§txtit:css§h2:html
static function cbasic_exec($d,$p,$r,$o){
[$av,$ap,$c]=unpack_conn_b($d);//v§p:c
if(strpos($av,':')!==false)$av=self::cbasic_exec($av,$p,$r,$o);//iteration
if($o==2)$av=$av?$av:$p;//param on left (no §) //strpos($ap,'_PARAM')===false
if(!is_array($av))$av=self::cbasic_vars($av,$p,$r);
if($ap)$ap=self::cbasic_vars($ap,$p,$r);
if($o==1)echo $av.'$'.$ap.':'.$c.br();
return self::template($av,$ap,$c);}

static function cbasic_if($d,$p,$r,$o){[$va,$vb]=explode('=',$d);
//if(strpos('+-*/',$vb)!==false)$vb=cbasic_mth($vb);
if(strpos($vb,':')!==false)$vb=self::cbasic_exec($vb,$p,$r,'');
else $p=self::cbasic_vars($vb,$p,$r);
if($va=='_PARAM')$p=$p&&$o?$p:$vb; else $r[$va]=$vb;
return [$p,$r];}

static function cbasic_vars($ret,$p,$r){if(is_array($r)){$i=0;
foreach($r as $k=>$v){$i++; $ret=str_replace('_'.$i,stripslashes($v),$ret);}}
$ret=str_replace('_PARAM',stripslashes($p),$ret);
return $ret;}

static function cbasic($code,$p){//eco($code);
if(is_array($code))return;
if(strpos($code,'[')!==false){if($p)$code=str_replace('_PARAM',$p,$code);
	return self::parse($code,'','template');}
$code=str_replace('--',"\n",$code);
$r=explode("\n",$code); $n=count($r); $rb=[];//self::parse($p,'',''codeline);
for($i=0;$i<$n;$i++){$sp=$r[$i]??''; $op=substr($sp,0,1); $ret='';//trim
	if($sp && strpos('+-/?!.;=',$op)!==false)$sp=substr($sp,1);
	if($op=='/' or !$op)$reb='';
	elseif($op=='?')[$p,$rb]=self::cbasic_if($sp,$p,$rb,1);
	elseif($op=='!')[$p,$rb]=self::cbasic_if($sp,$p,$rb,0);
	elseif($op=='.'){$ret=self::cbasic_exec($sp,$p,$ret,0); $ra[$i-1]='';}
	elseif($op=='+')$rb=self::cbasic_exec($sp,$p,$rb,0);
	elseif($op=='=')$p=self::cbasic_exec($sp,$p,$rb,0);
	elseif($op=='-' && $rb)$ret=self::cbasic_exec($sp,$rb,$rb,2);//
	elseif($op==';')$ret=self::cbasic_exec($sp,$p,$rb,1);
	elseif($sp=='see')p($rb);
	else $ret=self::cbasic_exec($sp,$p,$rb,0);//see
$ra[$i]=$ret;}
return implode('',$ra);}

static function mod_basic($p,$o){
$b=sesmk2('codeline','uconns',$p,0); if(!$b)$b=sesmk2('codeline','pconns',$p,0);
if(!$b && $p)return self::parse('['.$p.']','','template');
$r=['insert','update','delete','qr','write_file','file_put_contents'];
foreach($r as $v)if(strpos($p,'§'.$v)!==false)return;
//if($b && !is_array($b))return self::parse($b,'','template');
if($b && !is_array($b))return self::cbasic($b,$o);}

#refs
static function uconns($p){return msql::val('',nod('connectors'),$p);}
static function pconns($p){return msql::val('','public_connectors',$p);}

#interface
static function calli($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
if($o)return self::parse($p,'','template');
return self::parse($p,'','sconn2');}

static function home($p,$o){
$rid='plg'.randid();
$j=$rid.'_codeline,calli_inp'.$rid.',chk'.$rid;
$js=['onkeyup'=>sj($j),'onclick'=>sj($j)];
$bt=divb(checkbox_j('chk'.$rid,'','template'));
$bt.=editarea('inp'.$rid,$p,54,8,$js,1);
$ret=self::calli($p,$o);
return $bt.div(atd($rid),$ret);}

}
?>