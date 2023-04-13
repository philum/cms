<?php //popular constructors
class pop{

#admin
static function m_system(){$auth=$_SESSION['auth']; $id=ses('read');
$rst=ses('rstr'); $top=!$rst[69]?'':'d'; $hv=1;
$ra=[0=>prmb(8),1=>'loading',2=>'admin',3=>'desktop',4=>'download',5=>'search',6=>'articles',7=>'add',8=>'link',9=>'language',10=>'time',11=>'circle-full',12=>'circle-empty',13=>'list',14=>'user',15=>'menu']; 
foreach($ra as $k=>$v)$ico[$k]=picto($v);
$ret['home']=popbub('home','',$ico[0],$top,$hv);//if(!$rst[20])
if(!$rst[94])$ret['menuB']=popbub('menubub','',$ico[15],$top,$hv);
if(!$rst[95])$ret['menuO']=popbub('overcat','',$ico[15],$top,$hv);
if(!$rst[51])$ret['desk']=popbub('desk','',$ico[3],$top,$hv);
if($auth>4){
	if(!$rst[120])$ret['admin']=popbub('fadm','fastmenu',$ico[2],$top,$hv);
	else $ret['admin']=popbub('fadm','fastmenu2',$ico[2],$top,$hv);}
if(!$rst[75]){
	if($top)$ret['search']=search_btn(1);
	else $ret['search']=popbub('call','search',$ico[5],$top,$hv);}
if($auth>1){
	if(!$rst[83])$ret['ucom']=popbub('call','ucom',$ico[8],$top,$hv);
	if($auth>3 && !$rst[76])$ret['batch']=popbub('call','batch',$ico[4],$top,$hv);}
if($auth>2){
	if(!$rst[79])$ret['addurl']=popbub('call','addart',$ico[7],$top,$hv);
	//if(!$rst[79])$ret['addurl']=llj('','bubble_sav,addart',$ico[7]);
	else $ret['addart']=li(btj($ico[7],sj('popup_edit,artform').' closebub(this);'));}
if(!$rst[81])$ret['favs']=llj('','popup_favs,home',picto('bookmark2'));//favs
if(!$rst[80])$ret['arts']=popbub('','arts',$ico[6],$top,$hv);//arts
if(!$rst[82])$ret['lang']=popbub('lang','lang',$ico[9],$top,$hv);//lang
if(abs(ses('dayx')-ses('daya'))>86400 or !$rst[84])//back_in_time
	$ret['time']=popbub('timetravel','',$ico[10],$top,$hv);//archives
if(!$rst[48]){if($top)$nm=' '.btn('small',ses('USE'));//usr
	$ret['user']=popbub('user','',$ico[14],$top,$hv);}//user on prm1=app user, on prm2=bubfast
if($id && !$rst[89])$ret['seek']=popbub('seek','',$ico[13],$top,$hv);//metas
if($id && auth(6)){
	$tag=lj('','popup_meta,metall___'.$id.'_3',picto('tag'));
	$tit=lj('','popup_meta,titedt___'.$id.'_3',picto('meta'));
	$edt=lj('','popup_edit,artform____'.$id.'__autosize',picto('edit'));
	$edt2=btj(picto('editor'),atj('editart',$id));
	//if(!$rst[1])$trk=li(lj('','popup_tracks,form___'.$id,picto('forum')));
	$ret['edit']=li($tag).li($tit).li($edt).tag('li',['id'=>'adt2'.$id],$edt2);}//.$trk
$dev=ses('dev'); $ic=$dev=='b'||$dev=='c'?$ico[11]:$ico[12];
if(auth(6) or $dev)$ret['dev']=popbub('dev','dev',$ic,$top,$hv);//dev
$ret['fixit']=span(atd('fixtit').atc('etc'),' ');
ses::$adm+=$ret;}

//poplinks
static function popadmin(){
$top=rstr(69)?'':'d'; $ret=''; $rta=''; $rtb='';
if(get('admin')){$top='d';
	$hom=popbub('adhome','',picto('phi2'),$top,1);
	$rta=$hom.adm::menus();}
elseif(get('msql')){$top='d'; $rta=msqa::menusj('');}
else foreach(ses::$adm as $k=>$v){
	if(strstr('cache design hub alert log chrono srch timetravel',$k))$rtb.=btn('popbt',$v).' '; 
	elseif($k=='er')$rtb.=btn('popdel',implode(';',$v)).' '; 
	else $rta.=$v;}
$css=$top?'inline':''; ses::$adm=[];
if(!ses('iqa'))$rta.=boot::cookie_accept();
if($rta)$ret=mkbub($rta,$css,'','this.style.zIndex=popz+1;');
if($rtb)$ret.=bts('position:fixed; right:0;',$rtb);//
//if($rtb)$ret.=mkbub($rtb,$css,'left:50%;right:0;
if($top)Head::add('csscode','#page{padding-top:28px;}');
else Head::add('csscode','#page{margin-left:28px;}');
return $ret;}

#articles
static function btapp($d,$nl=''){
[$p,$o,$c]=unpack_conn($d); [$c,$ob]=cprm($c);//p§o:c§ob
$ic=mime($c,'cube'); $t=pictxt($ic,$ob?$ob:$c); if($ob==1)$t=picto('url');
$u='/app/'.$c; if($p){$u.='/'.$p; if($o)$u.='/'.$o;} if($nl)return lkt('',$u,$t); if(!$ob)$ob='conn';
return lj('','popup_'.$c.',home__3_'.ajx($p).'_'.ajx($o),$t).' '.lkt('',$u,picto('chain'));}

static function connbt($d,$nl=''){
[$p,$o,$c]=unpack_conn($d); [$c,$ob]=cprm($c);//p§o:c§ob
$ic=mime($c,'cube'); $t=pictxt($ic,$ob?$ob:$c); if($ob==1)$t=picto('url');
$u='/app/'.$c; if($p){$u.='/'.$p; if($o)$u.='/'.$o;} if($nl)return lkt('',$u,$t); if(!$ob)$ob='conn';
return lj('','popup_conn,parser__3_['.ajx($p.($o?'§'.$o:'').':'.$c).']_3_test',$t).' '.lkt('',$u,picto('chain'));}

static function orimg($im,$id,$o){
$dc=conn::original_img($im,$id);
if(!$dc)return picto('img2');
if($o)return lkt('',$dc,picto('img2'));
return image($dc);}

static function figure($d,$pw,$nl,$id=''){
if(rstr(142) && !auth(6))return self::orimg($d,$id,0);
if(rstr(143))return self::orimg($d,$id,1);
[$im,$t]=cprm($d); $img=''; $pre=jcim($im,$nl); $ret='';
if(is_img($pre.$im) && strpos($im,'<')===false){
	if(is_file($pre.$im)){[$w,$h]=getimagesize($pre.$im); $img=img($pre.$im);
		if($w>$pw && !$nl)$ret=ljb('','SaveBf',ajx($im).'_'.$w.'_'.$h.'_'.$id,$img);
		else $ret=image($pre.$im);
		if(auth(6) && rstr(121) && !$nl)$ret=conn::rzim($ret,$im,$pre.$im,$id,$w,$h);}
	else{$im=conn::recup_image($im); $pre=jcim($im,$nl); if($im)$ret=img($pre.$im);}}
else $ret=$im;
return tagb('figure',$ret.tagb('figcaption',$t));}

static function pubart($d){[$v,$p]=split_one('§',$d,1);//plug
if($p==1 or $p==2 or $p==3)return art::playb($v,$p);
elseif($p==4)return delbr(mod::pub_art($v),'');
elseif($p)return ma::popart($v,$p);
elseif(!is_numeric($v)){$id=ma::id_of_urlsuj($v);
	if(!is_numeric($id))return '['.$v.']';
	else return ma::popart($id,$v);}
elseif(is_numeric($v))return ma::jread('',$v,ma::suj_of_id($v));}

static function arts_mod($v,$id){
[$p,$t,$d,$o,$ch,$hd,$tp]=explode('/',$v);
$load=api::mod_arts_row($p); unset($load[$id]);
$ret=mod::mod_load($load,$t,$d,$o,1,3,$tp,$id,'');
return $ret;}

#toggles
static function openart($p,$m=''){[$p,$t]=cprm($p); $rid=randid('opart');
if($t)return toggle('',$rid.'_art,playc___'.$p.'_3',$t).divd($rid,'');
return ma::read_msg($p,$m==3?'inner':$m);}

static function call_j($f,$d){[$f,$lk]=cprm($f);
if(is_numeric($f))$lk=pictxt('get',ma::suj_of_id($f)); else $f=goodroot($f);
return lj('','popup_'.$d.'___'.ajx($f),$lk);}

static function call_pop($d){[$v,$k]=cprm($d); $rid=randid('bpop'); 
if(strpos($k,"\n"))$k=strto($k,"\n"); sesr('delaytxt',$k,$v);
return lj('','popup_usg,poptxt___'.ajx($k),$k.' '.picto('get'),atd('bt'.$rid));}

static function bubble_note($d,$t='',$nl=''){
[$v,$tb]=cprm($d);
$rid=rid($d); $t=$t?$t:($tb?$tb:'(*)');
if($nl)return '['.$t.': '.$v.']';
return togbub2($rid,$v,$t,'','',1);}

static function toggle_note($d,$t='',$nl=''){
[$v,$tb]=cprm($d); $rid=rid($d); $t=$t?$t:$tb;
$div=span(atd($rid).atc('twit panel').ats('display:none;'),$v);
if($nl)return '['.$t.': '.$v.']';
return ljb('','toggle_block',$rid,$t?$t:'(*)',atd('bt'.$rid)).$div;}

static function toggle_div($d,$o,$nl=''){[$v,$t]=cprm($d);
if($o)$v=tagb('blockquote',$v); if($nl)return tagb('h4',$t).$v;
return togbt($v,pictxt('lys',$t));}

static function toggle_conn($d,$nl){[$id,$t]=cprm($d); $rid=rid('jop');
if(is_numeric($id)){$j='_art,playc___'.$id.'_3'; $t=$t?$t:ma::suj_of_id($id);}
else $j='_conn,read_'.$d.'['.$id.']';
return toggle('',$rid.$j,$t?$t:nms(25)).' '.btd($rid,'');}

static function btart($d){[$id,$t]=split_one('§',$d);//conn
if(substr($d,0,4)=='http')$j='popup_mc,api*read__3_'.ajx($id).'_1';
else $j='popup_popart__3_'.$id.'_3'; $t=$t?$t:ma::suj_of_id($id);
return lj('popbt',$j,pictxt('articles',!$t&&$d?preplink($d):$t));}

#lk
static function pictoconn($t){
[$t,$ico]=opt($t,':'); if($ico=='picto')$t=picto($t); return $t;}
static function poplk($d,$id){[$lk,$t]=split_right('§',$d,1); 
return ljp(att($t),$id.'_mod,callmod___'.ajx($lk),self::pictoconn($t));}
static function toglk($d){[$lk,$t]=split_right('§',$d,1);
return togbub('mod,callmod',ajx($lk),self::pictoconn($t));}
static function ajlk($d){[$p,$o]=cprm($d);
return lj('popbt',$p,$o);}

static function vacuum_media($da,$id){
if(substr($da,0,4)!='http')return $da;
[$d,$t]=split_one('§',$da,1);
$xt=xt($d); $qb=$_SESSION['qb']; $nmw=$d; $dc='';
if($id){$nmw=$qb.'_'.$id.'_'.substr(md5($d),0,6).$xt; $dc=$d; $dc=str::urlenc($dc);}
if(!is_file('video/'.$nmw) && $dc){@copy($dc,'video/'.$nmw);}//conn::replaceinmsg($id,$d,$nmw,'vid');
if(is_file('video/'.$nmw)){$sz=fsize('video/'.$nmw);
	if($sz>50000){ses::$adm['alert']='media: '.$sz;//exclude from importation
		conn::replaceinmsg($id,$da,str_replace('.mp4',':mp4',$da));}
	return 'video/'.$nmw.($t?'§'.$t:'');}
else return $da;}

static function getmp4($d,$id,$o=1){if($o)$d=self::vacuum_media($d,$id); return video($d);}
static function getmp3($d,$id,$o=1){if($o)$d=self::vacuum_media($d,$id); return audio($d);}
static function getimg($d,$id,$m,$nl,$pw){$im=conn::get_image($d,$id,$m);
return conn::place_image($im,$m,$nl,$pw,$id);}
static function getxif($d){$d=gcim($d); $r=imgexif($d); return img('/'.$d).tabler($r);}
static function imgdata($d){[$d,$xt]=cprm($d); if(!$xt)$xt='jpeg';
return img('data:image/'.$xt.';base64,'.base64_encode($d));}

#pages
static function btpages_nb($nbp,$pg){
$cases=5; $left=$pg-1; $right=$nbp-$pg; $r[1]=1; $r[$nbp]=1;
for($i=0;$i<$left;$i++){$r[$pg-$i]=1; $i*=2;}
for($i=0;$i<$right;$i++){$r[$pg+$i]=1; $i*=2;}
if($r)ksort($r);
return $r;}

static function btpages($nbyp,$pg,$nbarts,$j){$ret='';
if($nbarts>$nbyp){$nbp=ceil($nbarts/$nbyp); if($nbp)$rp=self::btpages_nb($nbp,$pg);}
if(isset($rp))foreach($rp as $k=>$v)$ret.=lj($k==$pg?'active':'',$j.ajx($k),$k).' ';
if($ret)return btn('nbp',$ret);}

#dig
static function define_digr(){$n=ma::maxyears()+5;//25=20y
if($digr=ses('digr'))return $digr; $rt=[];
if(prmb(16)=='auto')$dy=ses('nbj'); else $dy=ma::maxdays();
$r=[1,7,30,90,365]; for($i=5;$i<$n;$i++)$r[]=$r[$i-1]+365;
for($i=0;$i<$n;$i++)if($r[$i]<=$dy)$rt[$r[$i]]=$r[$i]<365?$r[$i]:($r[$i]/365);
$_SESSION['digr']=$rt;
return $rt;}

static function dig_it_j_nb($r,$n){$nb=count($r); $i=0; $rb=[]; $na=10; $a=0;
foreach($r as $k=>$v){$i++; if($k==$n)$a=$i;} $i=0;
foreach($r as $k=>$v){$i++; if($i>$a-$na && $i<$a+$na)$rb[$k]=$v;}
return $rb;}

static function dig_it_j($n,$j){$r=self::define_digr(); $ra=self::dig_it_j_nb($r,$n);//most_read,trk
if(!isset($ra[$n]))$ra[$n]=$n>365?round($n/365,2):$n; $nprev=time_prev($n);
$ra[$n].=' '.($n<365?plurial($ra[$n],3):plurial($ra[$n],7));
if($n!=1 && $n!=7)$ra[$n]=val($ra,$nprev).' '.nms(36).' '.$ra[$n];//from
if($n>365)$ra[$n]=date('Y',timeago($n));//from
//return self::btpages(1,$n,count($r),$j);
return slctmnuj($ra,$j,$n);}//divc('float:right;',)

static function timetravel(){$r=self::define_digr(); $n=max(array_flip($r))/365;//365.24219
unset($r[1]); unset($r[7]); unset($r[30]); unset($r[90]); $ret=[];
if($r)foreach($r as $k=>$v)if(is_numeric($k)){$tim=calctime($k); $t=date('Y',$tim); $ret[$t]=$tim;}
return $ret;}

#builders
static function columns($re,$o,$id='',$b=''){
$ret=is_array($re)?implode('',$re):$re;
if($o>10)$s='auto '.$o.'px;'; else $s=(is_numeric($o)?$o:3).' auto;';
$sty='columns:'.$s.'; column-gap:16px:';
return div(atd($id).atc('cols'.$b).ats($sty),$ret);}

#img
static function art_img($d,$id='',$n=''){if(!$d)return;
$r=explode('/',$d); $n=$n?$n:$r[0]; if($n===0)return; $srv=prms('srvimg');
if(is_numeric($n) && isset($r[$n]))$rb[1]=$r[$n];
elseif($r)foreach($r as $k=>$v)if(is_file('img/'.$v)){
	[$w,$h]=@getimagesize('img/'.$v); if($w>220 && $h>120 && $w<6400){$rb[$w]=$v; $rk[$w]=$k;}}
	elseif($v && !is_numeric($v) && $srv && is_file($srv.'/img/'.$v))copy($srv.'/img/'.$v,'img/'.$v);
if(isset($rb)){krsort($rb); $ret=current($rb);
	if(!$n && $id && $ret)sql::upd('qda',['img'=>$rk[key($rb)].$d],$id);
	return $ret;}}

static function minimg($amg,$prm){if($prm=='no')return; $mg=self::art_img($amg); 
if($mg)return img::make_thumb($mg,$prm); elseif(rstr(87))return self::mini_empty($prm);}

static function mini_empty($prm){
[$w,$h]=explode('/',prmb(27)); $out='/imgc/'.ses('qb').'_empty.jpg';
$clr=getclrs('',1); if($prm=='nl'||!$prm)$c=atc('imgl');
if(!file_exists($out) or ses('rebuild_img'))img::graphics($out,$w,$h,'',$clr,'');
return image($out,'','',$c);}

#twitter
static function twits($d,$id){$r=explode(' ',$d); $ret='';
if($r)foreach($r as $k=>$v)if(is_numeric($v))$ret.=twit::cache($v,$id);
return $ret;}

static function twitapi($d){[$p,$o]=cprm($d);
return twit::call($p,$o);}

static function poptwit($d,$o='',$nl=''){[$n,$nm]=cprm($d);
if(substr($n,-8)=='/photo/1')$n=substr($n,0,-8);
//{$im=twit::getimg($n,1); return mk::popim($im,pictxt('img',$nm));}
if(strpos($n,'/'))$n=strend($n,'/'); if(strpos($n,'?'))$n=strto($n,'?'); $bt=$nm?$nm:$n;
$o=$o?$o:'ban'; if(is_numeric($n))$o='tweet';
elseif(substr($n,0,1)=='@')$o='ban'; elseif(substr($n,0,1)=='#')$o='search';//stream
//if($o=='ban')$bt=pictxt('arobase',$bt); elseif($o=='search')$bt=pictxt('diez',$bt); else 
if($o=='tweet')$bt=pictxt('tw',$bt,16);
return lj('txtx','popup_twit,call__3_'.ajx($n).'_'.$o,$bt);}

static function twitart($d,$id,$ty='',$nl=''){[$k,$nm]=cprm($d);
if(substr($k,0,4)=='http')$k=strend($k,'/'); if($nm==1)$nm=$k;
if($nm=='thread')return self::twitapi($d);
if($nm=='users')return twit::play_usrs($d);
if(strpos($k,' '))return self::twits($d,$id);
if($nm or !is_numeric($k))return self::poptwit($k.'§'.$nm,$ty,$nl);
if($nl)return lka($k);
if($k)return twit::cache($k,$id);}

static function twitxt($d,$id,$tx=''){[$k,$nm]=cprm($d);//totest
if(substr($k,0,4)=='http')$k=strend($k,'/'); if($nm==1)$nm=$k;
if($tx)return twit::playxt($k);
if($k)return lk(twit::lk($k,$id));}

}
?>