<?php //common

//class core{static function com($a,$b,$c,$d){return $a($b,$c,$d);}}

#store
class ses{static $r=[]; static $adm=[]; static $st=[]; static $er=[];
static $urlsrc=''; static $loader=''; static $enc=''; static $n=0; static $nb=0;
static function adm($k){return self::$adm[$k]??'';}
static function r($k){return self::$r[$k]??'';}
static function er($v){return self::$er[]=$v;}}

#popart
function popart($g1){eye(); $j='popart__x_'.$g1; $tg=get('tg')=='pagup'?1:0;
//$is=ma::is_public($g1); if(!$is)return divc('frame-red',helps('not_published'));//nms(170)// && !auth(6)
//ses::$r['curdiv']='content'; boot::deductions($g1,'');
if($g1=='last')$g1=ma::lastart();
if($tg)$p=lj('','popup_'.$j,pictxt('popup')); else $p=lj('','pagup_'.$j,pictxt('fullscreen'));
if(rstr(144))$p.=md::prevnext_art('arts',1,$g1,$tg);
if(auth(6))$p.=lj('','popup_meta,metall___'.$g1.'_3',picto('tag',20)).lj('','popup_meta,titedt___'.$g1.'_3',picto('meta',20)).lj('','popup_edit,artform____'.$g1,picto('edit',20)).btj(picto('editor',20),atj('editart',$g1));
$ret=art::playb($g1,3); $t=ses::r('suj'); //if(!$t)$t=ma::suj_of_id($g1);
ses::$r['popt']=etc($t,70); ses::$r['popm']=$p; ses::$r['popw']=prma('content')+20; //ses::$r['popwm']=640;
return $ret;}

#common
function search_btn($o=''){
$id='srch'; $t=nms(24); $s=12; $j=atj('SearchT',$id);
$ret=input($id,'',12,['type'=>'search','onclick'=>$j,'onkeyup'=>$j,'oncontextmenu'=>$j,'role'=>'search','placeholder'=>$t]);
return $o?$ret:div(atc('search').atd('ada'),$ret);}

#edit
function connbt($id,$o=''){$ret='';
$r=['h','b','i','u','s','q','k'];//,'list','stabilo','art','web','video','twitter'
$rb=msql::col('lang','connectors_basic',0,1);
if(auth(2) && !$o)$ret=upload_j($id,'trk','').' ';
$ret.=ljb('','embedslct',['[',']',$id],'[]',att('url/img'));
foreach($r as $k=>$v)$ret.=ljb('','embedslct',['[',':'.$v.']',$id],$v,att($rb[$v]??$v));
$r=['stabilo'=>'highlight','art'=>'article','web'=>'web2','video'=>'video','twitter'=>'tw'];//'h'=>'big','b'=>'bold','i'=>'italic','u'=>'underline','s'=>'fontsize','q'=>'quote2','k'=>'strike','list'=>'textlist',,'toggle'=>'bubble','appbt'=>'window'
foreach($r as $k=>$v)$ret.=ljb('','embedslct',['[',':'.$k.']',$id],picto($v,16),att($rb[$k]??$k));
$r=sesmk('usrconn','',0);
if($r)foreach($r as $k=>$v)$ret.=ljb('','embedslct',['[','§1:'.$k.']',$id],$k,att($v));
//$ret.=togbub('mc,navs','trk_'.$id,'...');
$ret.=togbub('mc,navs','ascii_'.$id,ascii(128578));
return btn('nbp',$ret);}

function editarea($rid,$d='',$w=80,$h=16,$js=[],$o=''){$ret=connbt($rid,$o);
//$ret.=lj('','popup_tracks,preview_'.$rid,picto('view'),att(nms(65))).' ';;
$ret.=divb(textarea($rid,$d,$w,$h,['class'=>'console']+$js));
return $ret;}

#msql
function msql_read($dr,$nod,$in='',$u=''){$f=msql::url($dr,$nod); $m='_menus_'; $r=[];//old
if(is_file($f))include $f; if(!isset($r)){alert('msq_er:'.$f);return;} if($u)unset($r[$m]);
unset($r[0]); $r0=current($r); if(!$r0)$r0=next($r); $n=is_array($r0)?count($r0):0;
if($r)foreach($r as $k=>$rb)foreach($rb as $kb=>$vb)$r[$k][$kb]=stripslashes_b($vb);
if($in){if(!isset($r[$in]))return; if($u=='k')return $r[$in]; elseif($n==1)return $r[$in][0];
	elseif(isset($r[$m]))return array_combine_a($r[$m],$r[$in]); else return $r[$in];}
elseif($n==1 && $u!='k')foreach($r as $k=>$v)$r[$k]=$v[0]??'';
return ($r);}//utf_r

function nod($d){return $_SESSION['qb'].'_'.$d;}
function msqbt($b,$p,$d=''){if($d)return msqedt($b,$p,$d);
$u=($b?$b:'users').'_'.ajx($p).($d?'~'.ajx($d):'');
return lj('grey','popup_msql__3_'.$u,pictit('msql',$p));}
function msqedt($b,$p,$d=''){$u=($b?$b:'users').'/'.ajx($p).($d?'_'.ajx($d):'');
return lj('grey','popup_msqa,editmsql___'.$u,pictit('msql2',$p));}

#forms
function slctmnu($r,$lk,$vf,$cs1,$cs2,$kv){$ret='';
if($r)foreach($r as $k=>$v){
if($kv=='k')$v=$k; elseif($kv=='v')$k=$v;
if($v)$ret.=lkc($vf==$k?$cs1:$cs2,$lk.$k,$v).' ';}
return $ret;}

function slctmnuj($r,$j,$vf,$sep='',$kv=''){$ret=''; $m=strpos($j,'VAR')?1:0;
foreach($r as $k=>$v){if($kv=='v')$k=$v; elseif($kv=='k')$v=$k;
	$nj=$m?str_replace('VAR',$k,$j):$j.ajx($k);
	$ret.=lj(active($vf,$k),$nj,stripslashes($v)).$sep;}
return btn('nbp',$ret);}

function jump_btns($id,$v,$o=''){
$r=is_array($v)?$v:explode('|',$v); $ret='';
foreach($r as $va)$ret.=ljb('','jumpMenu_text',$id.'_'.ajx($va).'_'.$o,stripslashes($va)).' ';
if($ret)return btn('nbp',$ret);}

#toggles
function dropmenu($pr,$id,$t,$opt=''){$rid=randid('bpop');//dropmenu_jb
$j='popup_usg,dropmenupop__bt'.$rid.'_'.ajx(addslashes($pr)).'_'.$id.'_'.$rid.'_'.$opt;
return lj('',$j,$t?$t:'...',atd('adcat'.$rid)).hidden($id,$t).btd('bt'.$rid,'');}
function jumpmenu($pr,$id,$t){$j='tg'.$id.'_usg,jumpmenu___'.ajx($pr).'_'.$id.'_'.ajx($t);
return toggle('popbt',$j,btd('bt'.$id,$t?$t:'...'),'',atd('a'.$id)).hidden($id,$t).btd('tg'.$id,'');}
function toggle($c,$j,$v,$n='',$o=''){static $i; $i++; if($n=='x')$i=0;
return ljb($c,'tog_j',[$j.'_'.$i,'bt'.$i,$n],$v,atd(strto($j,'_').'bt'.$i).$o);}
function ljtog($c,$j,$jb,$v,$o=''){$rid=randid('bt');
return ljb($c,'tog_jb',[$j,$jb,$rid],$v,atd($rid).$o);}
function lj_tog($n,$d,$v){return toggle('txtx',$n.$d.'_'.$n.'___'.$d,$v).btd($n.$d,'');}//unused
function bubble($c,$ja,$j,$v){$id=randid();
return lj($c,'bubble_'.$ja.'__'.$id.'_'.$j,$v,atd('bt'.$id));}
function popbub($d,$j,$v,$c='',$o=''){$id=randid();//apps+dir or call+predir//j=pre-rendered
if(rstr(102) && !rstr(69))return panup($d,$j,$v,$c);
if($d=='call' or $c)$id=($c?$c:'c').$id; $j='bubble_bubs,root__'.$id.'_'.$d.'_'.$j;
return llj('',$j,$v,'bb'.$id,$o);}
function panup($d,$j,$v,$c){$id=randid();
if($d=='call' or $c)$id=($c?$c:'c').$id; $j='panup_bubs,root__'.$id.'_'.$d.'_'.$j;
return llj('',$j,$v,'bb'.$id,'');}
function togbub($ja,$j,$v,$c='',$o='',$a=''){$id=rid($ja.$j.$v);//bub from j
return btd('bt'.$id,ljb($c,'togglebub',$ja.'__'.$id.'_'.$j,$v,$o,$a));}//.'_1'
function togbub2($id,$v,$t,$c='',$o='',$a=''){//full js
return btd('bt'.$id,ljb($c,'togglebub2',$id,$t,$o,$a)).span(atd($id).ats('display:none;'),$v);}
function togses_j($d,$t){$id=randid('tg'); $v=ses($d,$t);//unused
return lj('',$id.'_togses___'.$d,btd($id,offon($v,$t)));}
function bubjs($v,$t,$c=''){
return '<a onmouseover="bubjs(this,1)" onmouseout="bubjs(this,0)" data-tx="'.$v.'"'.atc($c).'>'.$t.'</a>';}
function bubj($j,$t,$c=''){return '<a onclick="sj(this)" data-j="popup_'.$j.'" onmouseover="bubj(this,1)" onmouseout="bubj(this,0)" data-ja="'.$j.'"'.atc($c).'>'.$t.'</a>';}
function bubj2($tx,$j,$t,$c=''){return '<a onclick="sj(this)" data-j="popup_'.$j.'" onmouseover="bubjs(this,1)" onmouseout="bubjs(this,0)" data-tx="'.$tx.'"'.atc($c).'>'.$t.'</a>';}
function togbt($v,$t){$id=randid('tg'); $ret=ljb('','toggle_block',$id,$t,atd('bt'.$id));
$ret.=divb($v,'',$id,'display:none;'); return $ret;}
function togbth($v,$t){$id=randid('tg');
$ret=ljb('','toggle_hidden',$id,$t,atd('bt'.$id));
$ret.=span(atd($id),'').hidden('hid'.$id,htmlentities($v));
return $ret;}
function togses($v,$t){$rid=randid('bt'); $c=ses($v)?'active':'';
return btn('nbp',lj($c,$rid.'_tog__20_'.$v,$t,atd($rid)));}
function swapbt($jr,$v,$ic=0,$o=0){$a=yesno($o);
$p0=atjr('swapbt',[$o,'this',$ic]); $p1=atjr('swapbt',[$a,'this',$ic]);
$p=atb('data-bt0',$v[0]).atb('data-bt1',$v[1]).atmo($p1).atmu($p0);
return lj('',$jr[$a],$ic?picto($v[$o],16):$v[$o],$p);}
function inputses($k,$v){$j=$k.'p_sesmake_'.$k.'p__'.ajx($k);
return input($k.'p',$v,4,['onkeyup'=>'checkj(this)','data-j'=>$j]);}

function loadjs($f,$d,$t=''){$v=ses('offon'); $h=hidden('offon'.$d,$v); $t=$t?'" title="'.$t:'';
return ljb($t,'offon',[$f,$d],offon($v),'offonbt'.$d).$h;}
function ljbub($v,$lk,$oc='',$ov='',$id='',$tg=''){$tg=$tg?atb('target','_blank'):'';
if(!rstr(102))$ov='closepbub(this,\''.$id.'\'); clbubtim(this); '.$ov;
return '<li><a'.ath($lk).atd($id).atk($oc.' closebub(this);').atmo($ov).$tg.'>'.$v.'</a></li>';}

function offon($d,$t=''){return pictxt($d?'true':'false',$t,'color:#'.($d?'428a4a':'853d3d').';');}
function togon($d,$t=''){return pictxt($d?'switch-on':'switch-off',$t,$d?'color:#428a4a;':'');}

#slct
function mkbub($d,$c='',$s='',$o=''){
if($s=='1')$s='position:relative; text-decoration:none; display:inline-block;';
return div(atd('bub').atc($c).ats($s).atk($o),ul($d));}
function bubslct($j,$t){$j=str_replace('_','.',$j); $ret=popbub($j,'bub',$t,'d');
return mkbub($ret,'','1','popz+=1; this.style.zIndex=popz;');}

//$ret=select_jb('inp','backup|progb|plug',$p,1,'');
function select_jb($id,$pr,$v='',$o='',$oj=''){$rid=randid();//pr='a|b|c'
$j=ajx(addslashes($pr)).'_'.$id.'_'.$rid.'_'.($oj); $t=picto('kdown');
if($o==1)$h=input($id,$v,7); else $h=hidden($id,$id,$v);
return bubslct($j,$t).$h.$t;}

//select_j //existing_list
//$f=function; $o=1:bt,$o=2:choice,$o=3:bt+choice//ty=2:outside input
function select_j($id,$f,$v='',$o='',$t='',$ty=''){$rid=randid();//hidslct_j
$hid='bt'.$id; $j=$id.'_'.$f.'_'.ajx($v).'_'.ajx($o);
$c=$v?'active':''; $t=$t?$t:($v?$v:'select...');
if($ty==1)$h=input($id,$v,3); elseif($ty!=2)$h=hidden($id,$v); else $h='';
//return togbub('hidj',$j,$t,$c).$h; //return lj('popbt','bubble_usg,hidslct___'.$j,$t,atd($hid)).$h;
return lj('txtx','popup_hidj_'.$id.'_'.$hid.'_'.$j,$t,atd($hid)).$h;}//$hid déclenche bub

function slct_cases($id,$f,$v='',$o='',$t=''){$rid=randid();//hidslct
$c=$v?' active':''; $t=$t?$t:($v?$v:'...'); $h=hidden($id,$v);
$hid='bt'.$id; $j=$id.'_'.$f.'_'.ajx($v).'_'.ajx($o);
return lj('txtx'.$c,'popup_chkj_'.$id.'_'.$hid.'_'.$j,$t,atd($hid)).$h;}

#roots
function root($d=''){return (is_dir('plug')?'':'/').$d;}//used by rss
function htac($d){return $_SESSION['htacc']?'/'.$d.'/':'/?'.$d.'=';}
function htacc($d){return $_SESSION['htacc']?'/':'/?'.$d.'=';}//read/id
function urlread($d){return $_SESSION['htacc']?'/'.$d:'/?read='.$d;}//read
function upsrv(){$srv=prms('srvup'); return $srv?http($srv):'http://philum.fr';}
function srvmir(){return http(prms('srvmirror'));}
function subdomain($v){if($_SESSION['sbdm']){
$r=explode('.',$_SERVER['HTTP_HOST']); $n=count($r);
return 'http://'.$v.'.'.$r[$n-2].'.'.$r[$n-1].'/';}
else return htac('hub').$v;}
function prep_host($nod){if($_SESSION['sbdm'])return subdomain($nod);
else return host().htac('hub').$nod;}
function contact($t,$c){return lj($c,'popup_tracks,form___'.ses('qb'),$t?$t:picto('mail'));}

function jcim($f,$o=''){$h=$o?host().'/':'';//root()
if(substr($f??'',0,4)!='http')return $h.(strpos($f??'','/')!==false?'users/':'img/');}
function gcim($im,$o=''){return jcim($im,$o).$im;}

function goodroot($f,$h=''){//jcim()
if($h==1)$h=host().'/'; elseif($h)$h=http($h).'/'; //else $h=root();
if(substr($f,0,4)=='http')return $f;
elseif(substr($f,0,1)=='/')return substr($f,1);
elseif(substr($f,0,3)=='../')return $f;
elseif(strpos($f,'/')===false)return $h.'img/'.$f;
elseif(strpos($f,'img/')!==false)return $h.$f;
elseif(strpos($f,'app/')!==false)return $h.$f;
elseif(substr($f,0,6)=='video/')return $h.''.$f;
elseif(substr($f,0,6)=='/video')return $h.''.$f;
elseif(strpos($f,'video/')!==false)return $h.'users/'.$f;
elseif(strpos($f,'_datas/')!==false)return '/'.$h.''.$f;
elseif(strpos($f,'/')!==false)return $h.'users/'.$f;
else return $f;}

function urlroot($u){$h=ses::$urlsrc;
if($h==host() or substr($u,0,4)=='http')$h='';
if(substr($u,0,2)=='//')$h='https:';
if($h && substr($u,0,1)!='/')$u='/'.$u;
return $h.$u;}

function goodsrc($u){if(!$u)return;
if(substr($u,0,2)=='//')$u='http:'.$u;
if(strpos($u,'?'))$u=strto($u,'?');
if(substr($u,0,4)!='http'){
	$src=ses::$urlsrc;
	if(substr($u,0,1)!='/')$u='/'.$u;
	if($src)$u=$src.$u;}//'http://'.domain($src)
return $u;}

#conn
function embed_p($d){
$d=str_replace("\n\n</","</",$d); $r=explode("\n\n",$d); $ret='';
$ex='<h1<h2<h3<h4<h5<br<hr<bl<pr<di<if<fi';//<a <ob<sv<sp<bi<li<im<ta<ol<ul
foreach($r as $k=>$v){if($v=trim($v)){$cn=substr($v,0,3);
	if(strpos($ex,$cn)!==false)$ret.=$v; else $ret.='<p>'.($v).'</p>';}}
return $ret;}

#clr
function colors(){return msql::read('system','edition_colors');}
function rand_clr(){$r=colors(); $rb=array_keys_r($r,0); sort($rb);
$n=rand(0,count($rb)); return $rb[$n];}
function getclrs($k='',$n=''){$k=$k?$k:ses('prmd'); $r=sesr('clrs',$k);
if(!$r)$r=boot::define_clr(); if($r)return $n?$r[$n]:$r;}
function setclrs($d,$k=''){$prmd=$k?$k:ses('prmd'); $_SESSION['clrs'][$prmd]=$d;}

#sessions
function rstr($n){return ($_SESSION['rstr'][$n]??1)?0:1;}
function auth($n){return ($_SESSION['auth']??'')>=$n?true:false;}
function prms($n){return $_SESSION['prms'][$n]??'';}
function prma($n){return $_SESSION['prma'][$n]??'';}
function prmb($n){return $_SESSION['prmb'][$n]??'';}
function nms($d){return $_SESSION['nms'][$d]??$d;}
function nmx($r){$rb=[]; foreach($r as $k=>$v)$rb[]=nms($v); return implode(' ',$rb);}
function yesnoses($d){return $_SESSION[$d]=$_SESSION[$d]==1?0:1;}
function nbof($n,$i){if(!$n)return nms(11)."&nbsp;".nms($i); else return $n.' '.($n>1?nms($i+1):nms($i));}
function plurial($n,$i){return $n>1?nms($i+1):nms($i);}

//lang
function setlng($p){if($p && $p!='all')return $p; $lg=$_SESSION['lng']; return $lg?$lg:prmb(25);}
function voc($d,$b='helps_voc'){$r=sesmk('msqlang',$b,0); return $r[$d][0]??$d;}

//sesmk
//function catpic(){return msql::two('',nod('pictocat'),'',1);}
function msqlang($d){return msql::read('lang',$d,0,1);}
function usrconn(){return msql::kv('',nod('connectors_1'));}
function scanplug(){return explore('plug','dirs',1);}

//mimes
function msqmimes(){return msql::kv('system','edition_mimes');}
function mime($d,$o='less'){$r=sesmk('msqmimes','',0); return $r[$d]??$o;}
function mimes($d,$t='',$sz=''){$ta=mime($d,$t);
if($ta && $ta!='less')$t=$ta; if(!$t)$t='file'; if($t)return picto($t,$sz);}

function conn_ref_in(){
return [':h',':h1',':h2',':h3',':h4','h5',':c',':b',':u',':i',':q',':s',':k',':e',':n',':stabilo',':pre',':code',':nh',':nb',':list',':numlist',':table',':center','video','iframe'];}
function conn_ref_out(){return sesmk('conn_ref','',0);}
function conn_ref(){return array_keys(msql_read('system','connectors_all',''));}

#ajax
function ajx($v,$p=''){#dont edit!
$r=['*','_','(star)']; $a=$p?1:0; $b=$p?0:1; $c=$p?0:2; $d=$p?2:0;
$ra=[$r[$a],$r[$b],'_','&','+',"'",'"'];//,':','#','’','“','”','/'
$rb=[$r[$c],$r[$d],'(und)','(and)','(add)','(quote)','(dquote)'];//,'(ddot)','(diez)','(quote)','(dquote)','(dquote)','(slash)'
if($v)$v=$p?str_replace($rb,$ra,$v):str_replace($ra,$rb,$v);
return $v;}

function decuri($d){$d=$d!=null?urldecode($d):''; return $d;}// $d=utf8dec_b($d); //ajx::encUri(
function ajxg($d){$d=decuri($d); return ajx($d,1);}//
function ajxr($res,$n=''){$r=explode('_',$res); $n=$n?$n:count($r);
for($i=0;$i<$n;$i++)$ret[]=isset($r[$i])?ajxg($r[$i]):''; return $ret;}
function ajxp($res,$p,$o){$r=ajxr($res);return [$r[0]??$p,$r[1]??$o];}//obs
function prmp($r,$p,$o,$ob=''){return [$r[0]??$p,$r[1]??$o,$r[2]??$ob];}

#btns
function preplink($u){$u=nohttp($u); $pos=strpos($u,'/');
if($pos===false)$pos=strpos($u,'.'); return substr($u,0,$pos);}
function prepdlink($d){[$p,$o]=cprm($d);
if(!$o or $o==$p)$o=domain($p); return [$p,$o];}
function flags(){$r=msql::read('system','edition_flags_8','',1);
foreach($r as $k=>$v)$ret[$v[2]]=$v[1]; return $ret;}
function flag($d){$r=sesmk('flags','',0); return $r[$d]??$d;}
function svg($f,$w='',$h=''){return '<img src="'.$f.'.svg" width="'.$w.'" height="'.($h?$h:$w).'" />';}
function picto($d,$s=''){if(is_numeric($s))$s='font-size:'.$s.'px;';
return span(atc('philum ic-'.$d).ats($s),'');}
function pictxt($p,$t='',$s=''){return picto($p,$s).($t?'&#8201;'.$t:'');}
function pictit($p,$t,$s=''){return span(att($t),picto($p,$s));}
function picto2($d,$o=''){return picto(mime($d,$o));}
function catpic($d,$s=32){return pictxt(sesr('catpic',$d),$d,$s);}
function catpict($d,$s=32){return pictit(sesr('catpic',$d),$d,$s);}
function glyph($d,$s='',$t=''){ if(is_numeric($s))$s='font-size:'.$s.'px;';
return span(atc('glyph gl-'.$d).ats($s).att($t),'');}
function oomo($d,$s='',$t=''){if(is_numeric($s))$s='font-size:'.$s.'px;';
return span(atc('oomo oo-'.$d).ats($s).att($t),'');}
function fa($d,$s='',$t=''){if(is_numeric($s))$s='font-size:'.$s.'px;';
return span(atc('fa fa-'.$d).ats($s).att($t),'');}
function imgico($f,$sz='',$t=''){if(!$sz)$sz=4;
return taga('img',['src'=>$f,'style'=>'vertical-align:-'.$sz.'px; border:0;','title'=>$t]);}
function uicon($d,$p,$o=''){return $o.'/imgb/icons/'.($p?$p:'system/philum/16/').'/'.$d.'.png';}
function icon($v,$t='',$h='',$jc=''){[$d,$p]=opt($v,'§'); $f=uicon($d,$p);
return is_file($f)?imgico($jc.$f,$h,$t):$t;}
function ico($d,$t=''){[$p,$c]=explode(':',$d); if($c=='icon')return icon($p,$t);
elseif(is_numeric($c))return icosys($p,$c); elseif($c=='svg')return svg($p);
elseif($p!==false)return picto($p); else return $t;}
function icosys($d,$s=''){$s=$s?$s:16; return img('/imgb/icons/system/philum/'.$s.'/'.$d.'.png');}
function helps($d,$nd=''){$nd=$nd?$nd:'txts'; $ret=msql::val('lang','helps_'.$nd,$d);
return $ret?nl2br($ret):'';}//stripslashes
function hlpbt($j,$t=''){return togbub('msqa,syshlp',ajx($j),picto($t?$t:'question',18),'grey');}

#cmd
function unpack_conn($d){$r=split_right(':',$d,1);//p§o:c
$p=split_one('§',$r[0],1); return [$p[0],$p[1],$r[1]];}
function unpack_conn_b($d){$r=split_right(':',$d,1);//p:c§b:c2//clbasic,menusj
$p=split_right('§',$r[0],1); return [$p[0],$p[1],$r[1]];}
function unpack_mod($d){$r=split_right('§',$d,1);//p:c§o
$p=split_right(':',$r[0],1); return [$p[0],$p[1],$r[1]];}
function subparams($d){[$p,$v]=cprm($d);//p1/p2§p
if($v)[$x,$y]=explode('/',$p); else{$v=$p; $x=''; $y='';} return [$v,$x,$y];}
function subparams_a($d){[$v,$p]=cprm($d);//p§p1/p2
[$x,$y,$p,$o,$d]=opt($p,'/',5); return [$v,$x,$y,$p,$o,$d];}
function cprm($d){$n=strrpos($d,'§'); //goodpar($d)
if($n===false)return [$d,'']; else return [substr($d,0,$n),substr($d,$n+1)];}
function getconn($d){$p=''; $c=''; $xt=strtolower(strrchr($d,'.'));
$s=strrpos($d,':'); if($s!==false){$p=substr($d,0,$s); $c=substr($d,$s);}
return [$p,$c,$xt];}
function connmod($d){$r=split_one('§',$d,1);//a:p1,b:p2§bt:c
$ra=split_one(':',$r[1],1); $rb=explode_k($r[0],',',':');
if(!$r[1] && strpos($r[0],',')===false)$rb=expl(':',$r[0]);//bridge2old
if($ra[0])$rb['bt']=$ra[0]; if($ra[1])$rb['m']=$ra[1];
if($rb[0]??'')$rb['p']=$rb[0]; if($rb[1]??'')$rb['m']=$rb[1]; return $rb;}
function goodpar($d){return str_replace('Â§','§',$d??'');}

#vacuum
function vacurl($f){$f=nohttp($f); return normalize($f);}// $f=strend($f,'/');
function vacses($f,$k='',$v=''){$u=vacurl($f);//v,t,d(data),c(cat),u(url),p(parent),b(brut)
if($v=='x' && $r=sesr('vac',$u)){sesrz('vac',$u); return val($r,$k);}
elseif($v){sesrr('vac',$u,[$k=>$v]); $_SESSION['vac'][$u]['u']=$f;}//pre_clean
return $_SESSION['vac'][$u][$k]??'';}
function vaccum_ses($f){$d=vacses($f,'b');//obso
if(strpos($d,'This page appears when Google'))return;
if(!$d){$d=get_file($f); vacses($f,'b',$d);}
return $d;}

#app
function appin($a,$m,$p='',$o='',$ob=''){
if(method_exists($a,$m))return $a::$m($p,$o,$ob);}

#eye
function eye($p=''){$iq=ses('iq'); $qbd=ses('qbd');
//json::add('sys','eye',[ses('dayx')=>[$iq,$_SERVER['HTTP_HOST']]]);
$pag=implode_k(ses::$r['get'],'&','='); if(get('id')=='imgc/')exit;
if($_SESSION['rstr'][22] && !auth(6)){
	$_SESSION['crwl'][$iq]=radd($_SESSION['crwl'],$iq,1); if($_SESSION['crwl'][$iq]>100)exit;}
if($pag && $iq)sql::sav('qdv',['iq'=>$iq,'qb'=>$qbd,'page'=>$pag,'time'=>mysqldate()],0,0);}

#utils
function checkupdate($n=1){return read_file2(upsrv().'/call/software,version/'.$n);}
function checkupdate2(){return file_get_contents(upsrv().'/version.txt');}
function checkversion($n=1){return msql::val('system','program_version',$n);}
function forbidden_img($nm){$r=explode(' ',prmb(21));
if($r)foreach($r as $v)if($v && strpos($nm,$v)!==false)return false; return $nm;}
function antipuces($v){if(forbidden_img($v)!==false && strpos($v,'puce')===false)return $v;}
function cachevs($id,$n,$v,$o=''){
if(isset($_SESSION['rqt'][$id]) && is_array($_SESSION['rqt'][$id])){$_SESSION['rqt'][$id][$n]=$v;
if($o)msql::modif('',nod('cache'),$v,'val',$n,$id);}}

function alert($d){if(ses('dev'))Head::add('jscode',sj('popup_alert___'.ajx($d))); geta('er',$d);}
function patch_replace($bs,$in,$wh,$repl){$rq=sql('id',$bs,'q',$in.'="'.$wh.'"');
while($data=sql::qrw($rq)){echo $data[0].'_'; //sql::del($bs,$data['id']);
sql::upd($bs,[$in=>$repl],['id'=>$data[0]]);}}

function cw(){$p=ses::r('curdiv'); return prma($p?$p:'content');}
function cwset($d){ses::$r['curdiv']='temp'; $_SESSION['prma']['temp']=$d;}
function active($d,$n){return $d==$n?' active':'';}

function error_report($o=''){//prms('error')//ini_set("memory_limit","1512M");
error_reporting(ses('dev')=='b'?E_ALL:6135);}

?>