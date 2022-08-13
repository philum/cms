<?php //common

#popart
function popart($g1){eye(); $j='popart__x_'.$g1; $tg=get('tg')=='pagup'?1:0;
//$is=ma::is_public($g1); if(!$is)return divc('txtalert',helps('not_published'));//nms(170)// && !auth(6)
//$_SESSION['cur_div']='content'; boot::deductions($g1,'');
if($tg)$p=lj('','popup_'.$j,pictxt('popup')); else $p=lj('','pagup_'.$j,pictxt('fullscreen'));
if(rstr(144))$p.=md::prevnext_art('arts',1,$g1,$tg);
if(auth(6))$p.=lj('','popup_meta,metall___'.$g1.'_3',picto('tag',20)).lj('','popup_meta,titedt___'.$g1.'_3',picto('meta',20)).lj('','popup_edit,artform____'.$g1,picto('edit',20)).lja('',atj('editart',$g1),picto('editor',20));
$ret=art::playb($g1,3); $t=ses::r('suj'); //if(!$t)$t=ma::suj_of_id($g1);
ses::$r['popt']=etc($t,70); ses::$r['popm']=$p; ses::$r['popw']=prma('content')+20; //ses::$r['popwm']=640;
return $ret;}

#common
function search_btn($o=''){
$id='srch'; $t=nms(24); $s=12; $j='SearchT(\''.$id.'\')';
$pr=attr(['onclick'=>$j,'onkeyup'=>$j,'oncontextmenu'=>$j,'role'=>'search','size'=>'12','placeholder'=>$t]);
$ret=input0('search',$id,'',$pr);
return $o?$ret:div(atc('search').atd('ada'),$ret);}

#edit
function connbt($id,$o=''){$ret='';
$r=['h','b','i','u','s','q','k','stabilo','list','art','web','video','twitter','toggle','bt'];
$rb=msql::col('lang','connectors_basic',0,1);
if(auth(2) && !$o)$ret=upload_j($id,'trk','');
$ret.=ljb('',atjr('embedslct',['[',']',$id]),'','[]','',att('url/img'));
foreach($r as $k=>$v)$ret.=ljj('','embedslct',['[',':'.$v.']',$id],$v,$rb[$v]??$v);
//$ret.=ljj('','embedslct',['[','§(*):toggle]',$id],'toggle','[text§button:toggle]');
$r=sesmk('usrconn',0,0); if($r)foreach($r as $k=>$v)$ret.=ljj('','embedslct',['[','§1:'.$k.']',$id],$k,$v);
/*if(ses('qb')=='ummo'){
	$ret.=ljj('','embedslct',['[','§1:umcom]',$id],'umcom','id du twit');
	$ret.=togbub('mc,navs','oomo_'.$id,'oomo');}*/
$ret.=togbub('mc,navs','ascii4_'.$id,ascii(128578));
$ret.=ljj('','insert_b',['&rArr;',$id],'&rArr;');
return btn('nbp',$ret);}
function editarea($rid,$d='',$w=80,$h=16,$js='',$o=''){
return connbt($rid,$o).div('',textarea($rid,$d,$w,$h,atc('console').$js));}

#sql
function sqledt($p,$id,$x,$res=''){$rid=randid(); $ret='';
$ra=sqlcols($p); if($ra){$rk=array_columns($ra,0); $kv=implode('|',$rk);}
if($x=='x')sqldel($p,$id);
if($res)sqlup($p,array_combine($cl,ajxr($res)),'id',$id);
$r=sql('*',$p,'a',$id); //p($r);
if($cols)foreach($cols as $k=>$v)$ret.=divc('',goodarea($k,$r[$k],44));
$ret.=lj('popsav',$p.'_sqledt__x_'.$p.'_'.$id.'___'.$kv,picto('save'));
$ret.=lj('popdel',$p.'_sqledt__x_'.$p.'_'.$id.'_x__',picto('del'));
return divd($p,$ret);}

#msql
function msql_read($dr,$nod,$in='',$u=''){$f=msql::url($dr,$nod); $m='_menus_'; $r=[];
if(is_file($f))include $f; if(!isset($r)){alert('msq_er:'.$f);return;} if($u)unset($r[$m]);
unset($r[0]); $r0=current($r); if(!$r0)$r0=next($r); $n=is_array($r0)?count($r0):0;
if($r)foreach($r as $k=>$rb)foreach($rb as $kb=>$vb)$r[$k][$kb]=stripslashes_b($vb);
if($in){if(!isset($r[$in]))return; if($u=='k')return $r[$in]; elseif($n==1)return $r[$in][0];
	elseif(isset($r[$m]))return array_combine_a($r[$m],$r[$in]); else return $r[$in];}
elseif($n==1 && $u!='k')foreach($r as $k=>$v)$r[$k]=$v[0]??'';
return ($r);}//utf_r
function msql_dump($r,$p=''){$rc=[]; $ret='';
if(is_array($r))foreach($r as $k=>$v){$rb=[];
	if(is_array($v)){foreach($v as $ka=>$va)$rb[]="'".addslashes(stripslashes($va))."'";
		if($rb)$rc[]=(is_numeric($k)?$k:'"'.$k.'"').'=>['.implode(',',$rb).']';}
	else $rc[]='[\''.addslashes(stripslashes($v)).'\']';} //eco($rc);
if($rc)$ret=implode(','.n(),$rc);
return '<?php //msql/'.$p."\n".'$r=['.$ret.'];';}

function nod($d){return $_SESSION['qb'].'_'.$d;}
function msqbt($b,$p,$d='',$c=''){$u=($b?$b:'users').'_'.ajx($p).($d?':'.ajx($d):'');
return lj('grey'.($c?' '.$c:''),'popup_msql__3_'.$u,pictit('msql',$p));}

#menus
function slct_menus($r,$lk,$vf,$cs1,$cs2,$kv){$ret='';
if($r)foreach($r as $k=>$v){
if($kv=='k')$v=$k; elseif($kv=='v')$k=$v;
if($v)$ret.=lkc($vf==$k?$cs1:$cs2,$lk.$k,$v).' ';}
return $ret;}

function slctmenusj($r,$j,$vf,$sep='',$kv=''){$ret=''; $m=strpos($j,'VAR')?1:0;
foreach($r as $k=>$v){if($kv=='v')$k=$v; elseif($kv=='k')$v=$k;
	$nj=$m?str_replace('VAR',$k,$j):$j.ajx($k);
	$ret.=lj($vf==$k?'active':'',$nj,stripslashes($v)).$sep;}
return btn('nbp',$ret);}

function jump_btns($id,$v,$add,$c=''){
$r=is_array($v)?$v:explode('|',$v); $ret='';
foreach($r as $va)
$ret.=ljb($c,'jumpMenu_text',$id.'_'.ajx($va).'_'.$add,stripslashes($va)).' ';
if($ret)return btn('nbp',$ret);}

#lists
function dropmenuprep($pr,$id,$t,$opt=''){$rid=randid();//dropmenu_jb
$j='popup_usg,dropmenupop___'.ajx(addslashes($pr)).'_'.$id.'_'.$rid.'_'.$opt;
return ljp(atd('adcat'.$rid),$j,$t?$t:'...').hidden($id,$t);}

//bubslct
function mkbub($d,$c='',$s='',$o=''){
if($s=='1')$s='position:relative; text-decoration:none; display:inline-block;';
return div(atd('bub').atc($c).ats($s).atb('onclick',$o),ul($d));}
function bubslct($j,$t){$j=str_replace('_','.',$j); $ret=popbub($j,'bub',$t,'d');
return mkbub($ret,'','1','popz+=1; this.style.zIndex=popz;');}

//$ret=select_jb('inp','backup|progb|plug',$p,1,'');
function select_jb($id,$pr,$v='',$o='',$oj=''){$rid=randid();//pr='a|b|c'
$j=ajx(addslashes($pr)).'_'.$id.'_'.$rid.'_'.($oj); $t=$t?$t:picto('kdown');
if($o==1)$h=input1($id,$v,7); else $h=hidden($id,$id,$v);
return bubslct($j,$t).$h.$tb;}

#select_j //existing_list
//$f=function; $o=1:bt,$o=2:choice,$o=3:bt+choice//ty=2:outside input
function select_j($id,$f,$v='',$o='',$t='',$ty=''){$rid=randid();//hidslct_j
$hid='bt'.$id; $j=$id.'_'.$f.'_'.ajx($v).'_'.ajx($o);
$c=$v?'active':''; $t=$t?$t:($v?$v:'select...');
if($ty==1)$h=input1($id,$v,3); elseif($ty!=2)$h=hidden($id,$v); else $h='';
//return togbub('hidden',$j,$t,$c).$h; //return lj('popbt','bubble_usg,hidslct___'.$j,$t,atd($hid)).$h;
return lj('txtx','popup_hidj_'.$id.'_'.$hid.'_'.$j,$t,atd($hid)).$h;}//$hid déclenche bub

#roots
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
elseif(strpos($f,'plug/')!==false)return $h.$f;
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

function goodsrc($u){
if(substr($u,0,2)=='//')$u='http:'.$u;
if(substr($u,0,4)!='http'){
	$src=ses::$urlsrc;
	if(substr($u,0,1)!='/')$u='/'.$u;
	if($src)$u=$src.$u;}//'http://'.domain($src)
return $u;}

//clr
function colors(){return msql::read('system','edition_colors');}
function rand_clr(){$r=colors(); $rb=array_keys_r($r,0); sort($rb);
$n=rand(0,count($rb)); return $rb[$n];}
function getclrs($k='',$n=''){$k=$k?$k:$_SESSION['prmd']; $r=sesr('clrs',$k);
if(!$r)$r=boot::define_clr(); if($r)return $n?$r[$n]:$r;}
function setclrs($d,$k=''){$prmd=$k?$k:$_SESSION['prmd']; $_SESSION['clrs'][$prmd]=$d;}

#context
function setcond($cnd,$o=''){
if($cnd=='home')$r=['home',''];
if(is_numeric($cnd))$r=['art',$cnd];
elseif($cnd=='cat' or $cnd=='art')$r=[$cnd,''];
elseif(substr($cnd,0,3)=='cat')$r=['cat',substr($cnd,3)];
elseif($cnd!='all')$r=[$cnd,''];
else $r=['',''];
if($o)$_SESSION['cond']=$r; else return $r;}

function define_modc_b($vl){$r=sesr('mods',$vl); $cnd=$_SESSION['cond']; $ret=[];
if($r)foreach($r as $k=>$v)if(isset($v[3])){[$ka,$kb]=setcond($v[3]);
if($v[3]==$cnd[0].$cnd[1] or ($ka==$cnd[0] && !$kb) or ($kb && $kb==$cnd[1]) or !$v[3])$ret[$k]=$v;}
return $ret;}

#sessions
function rstr($n){return ($_SESSION['rstr'][$n]??1)?0:1;}
function auth($n){return ($_SESSION['auth']??'')>=$n?true:false;}
function prms($n){if(isset($_SESSION['prms'][$n]))return $_SESSION['prms'][$n];}
function prma($n){if(isset($_SESSION['prma'][$n]))return $_SESSION['prma'][$n];}
function prmb($n){if(isset($_SESSION['prmb'][$n]))return $_SESSION['prmb'][$n];}
function nms($d){return $_SESSION['nms'][$d]??$d;}
function nmx($r){$rb=[]; foreach($r as $k=>$v)$rb[]=nms($v); return implode(' ',$rb);}
function yesnoses($d){return $_SESSION[$d]=$_SESSION[$d]==1?0:1;}
function nbof($n,$i){if(!$n)return nms(11)."&nbsp;".nms($i); else return $n.' '.($n>1?nms($i+1):nms($i));}
function plurial($n,$i){return $n>1?nms($i+1):nms($i);}

//lang
function setlng($p){if($p && $p!='all')return $p; $lg=$_SESSION['lng']; return $lg?$lg:prmb(25);}
function voc($d,$b){$r=sesmk('msqlang',$b,0); return isset($r[$d])?$r[$d]:$d;}

#sesmk
function msqlang($d){return msql_read('lang',$d,0,1);}//helps_msql is not ::col
function usrconn(){return msql::col('',nod('connectors_1'),0,1);}
function scanplug(){return explore('plug','dirs',1);}

function conn_ref_in(){
return [':h',':h1',':h2',':h3',':h4','h5',':c',':b',':u',':i',':q',':s',':k',':e',':n',':stabilo',':pre',':code',':nh',':nb',':list',':numlist',':table',':center','video','iframe'];}
function conn_ref_out(){return sesmk('conn_ref','',0);}
function conn_ref(){return array_keys(msql_read('system','connectors_all',''));}

//store
class ses{static $r=[]; static $popadm=[]; static $urlsrc=''; static $n=0; static $nb=0;
static function res($s=''){return implode($s,self::$popadm);}
static function r($k){return self::$r[$k]??'';}}

#access
function root($d=''){return (is_dir('plug')?'':'/').$d;}//used by rss
function reqp($d){$r=sesmk('scanplug','',0);//will obs
if(is_file($f='plug/'.$d.'.php')){require_once($f); return true;}
if($r)foreach($r as $v)if(is_file($f='plug/'.$v.'/'.$d.'.php')){require_once($f); return $v;}}
function htac($d){return $_SESSION['htacc']?'/'.$d.'/':'/?'.$d.'=';}
function htacc($d){return $_SESSION['htacc']?'/':'/?'.$d.'=';}//read/id
function urlread($d){return $_SESSION['htacc']?'/'.$d:'/?read='.$d;}//read
function philum(){$srv=prms('upservr'); return $srv?http($srv):'http://philum.fr';}
function subdomain($v){if($_SESSION['sbdm']){
$r=explode('.',$_SERVER['HTTP_HOST']); $n=count($r);
return 'http://'.$v.'.'.$r[$n-2].'.'.$r[$n-1].'/';}
else return htac('hub').$v;}
function prep_host($nod){if($_SESSION['sbdm'])return subdomain($nod);
else return host().htac('hub').$nod;}
function contact($t,$c){return lj($c,'popup_tracks,form___'.ses('qb'),$t?$t:picto('mail'));}

#ajax
function ajx($v,$p=''){#dont edit!
$r=['*','_','(star)']; $a=$p?1:0; $b=$p?0:1;
if(!$p){$a=0; $b=1; $c=2; $d=0;} else{$a=1; $b=0; $c=0; $d=2;}//§=>&#167;
$ra=[$r[$a],$r[$b],'_',"\n","\r",'\'',"'",'§','#','µ','"','+','=','â‚¬','&','.',':','/','&#8617;'];
$rb=[$r[$c],$r[$d],'(und)','(nl)','(nl)','(aslash)','(quote)','(by)','(diez)','(mic)','(dquote)','(add)','(equal)','(euro)','(and)','(dot)','(ddot)','(slash)','(back)'];
if($v)$v=$p?str_replace($rb,$ra,$v):str_replace($ra,$rb,$v);
return $v;}

function decuri($d){$d=$d!=null?urldecode($d):''; $d=utf8_decode_b($d); return $d;}
function ajxg($d){$d=decuri($d); return ajx($d,1);}
function ajxr($res,$n=''){$r=explode('_',$res); $n=$n?$n:count($r);
for($i=0;$i<$n;$i++)$ret[]=isset($r[$i])?ajxg($r[$i]):''; return $ret;}
function ajxp($res,$p,$o){$r=ajxr($res);return [$r[0]??$p,$r[1]??$o];}//obs
function prmp($r,$p,$o,$ob=''){return [$r[0]??$p,$r[1]??$o,$r[2]??$ob];}

#actions
function loadjs($f,$d,$t=''){$v=ses('offon');
$h=hidden('offon'.$d,$v); $t=$t?'" title="'.$t:'';
return ljb($t.'','offon',[$f,$d],offon($v),'offonbt'.$d).$h;}
function lj_tog($n,$d,$v){return toggle('',$n.$d.'_'.$n.'_'.$d,$v).btd($n.$d,'');}
function ljbub($v,$lk,$oc='',$ov='',$id='',$tg=''){$tg=$tg?atb('target','_blank'):'';
if(!rstr(102))$ov='closepbub(this,\''.$id.'\'); clbubtim(this); '.$ov;
return '<li><a'.atb('href',$lk).atd($id).atb('onclick',$oc.' closebub(this);').atb('onmouseover',$ov).$tg.'>'.$v.'</a></li>';}

#btns
function preplink($u){$u=nohttp($u); $pos=strpos($u,'/');
if($pos===false)$pos=strpos($u,'.'); return substr($u,0,$pos);}
function prepdlink($d){[$p,$o]=opt($d,'§',2);
if(!$o or $o==$p)$o=domain($p); return [$p,$o];}
function flags(){$r=msql::read('system','edition_flags_8','',1);
foreach($r as $k=>$v)$ret[$v[2]]=$v[1]; return $ret;}
function flag($d){$r=sesmk('flags','',0); return $r[$d]??$d;}
function svg($d,$w='',$h=''){return '<img src="'.$f.'.svg" width="'.$w.'" height="'.($h?$h:$w).'" />';}
function picto($d,$s=''){if(is_numeric($s))$s='font-size:'.$s.'px;';
return span(atc('philum ic-'.$d).ats($s),'');}
function pictxt($p,$t='',$s=''){return picto($p,$s).($t?'&#8201;'.$t:'');}
function pictit($p,$t,$s=''){return span(att($t),picto($p,$s));}
function picto2($d,$o=''){return picto(pop::mime($d,$o));}
function catpic($d,$s=32){return pictxt(sesr('catpic',$d),$d,$s);}
function catpict($d,$s=32){return pictit(sesr('catpic',$d),$d,$s);}
function glyph($d,$s='',$t=''){ if(is_numeric($s))$s='font-size:'.$s.'px;';
return span(atc('glyph gl-'.$d).ats($s).att($t),'');}
function oomo($d,$s='',$t=''){if(is_numeric($s))$s='font-size:'.$s.'px;';
return span(atc('oomo oo-'.$d).ats($s).att($t),'');}
function fa($d,$s='',$t=''){if(is_numeric($s))$s='font-size:'.$s.'px;';
return span(atc('fa fa-'.$d).ats($s).att($t),'');}
function imgico($f,$t='',$h=''){return '<img src="'.$f.'"'.ats('vertical-align:-'.($h?$h:4).'px; border:0;').atb('title',$t).'/>';}
function uicon($d,$p,$o=''){return $o.'/imgb/icons/'.($p?$p:'system/philum/16/').'/'.$d.'.png';}
function icon($v,$t='',$h='',$jc=''){[$d,$p]=opt($v,'§'); $f=uicon($d,$p);
return is_file($f)?imgico($jc.$f,$t,$h):$t;}
function ico($d,$t=''){[$p,$c]=explode(':',$d); if($c=='icon')return icon($p,$t);
elseif(is_numeric($c))return icosys($p,$c); elseif($c=='svg')return svg($p);
elseif($p!==false)return picto($p); else return $t;}
function icosys($d,$s=''){$s=$s?$s:16;
return imgico('/imgb/icons/system/philum/'.$s.'/'.$d.'.png');}
function helps($d,$nd=''){$nd=$nd?$nd:'txts'; $ret=msql::val('lang','helps_'.$nd,$d);
return nl2br($ret);}//stripslashes
function hlpbt($j,$t=''){return togbub('msqa,syshlp',ajx($j),picto($t?$t:'question'),'grey');}

#params
function decompact_conn($d){$r=split_right(':',$d,1);//p§o:c
$p=split_one('§',$r[0],1); return [$p[0],$p[1],$r[1]];}
function decompact_conn_b($d){$r=split_right(':',$d,1);//p:c§b:c2//clbasic
$p=split_right('§',$r[1]?$r[0]:$d,1); return [$p[0],$p[1],$r[1]];}
function decompact_conn_c($d){$r=split_right(':',$d,1);//p:c§b//plugbt
$p=split_right('§',$r[1]?$r[1]:$d,1); return [$r[0],$p[0],$p[1]];}
function decompact_mod($d){$r=split_right('§',$d,1);//p§o:c
$p=split_right(':',$r[0],1); return [$p[0],$p[1],$r[1]];}//po,p,c
function subparams($d){[$p,$v]=opt($d,'§',2);//1/2§3
if($v)[$x,$y]=explode('/',$p); else{$v=$p; $x=''; $y='';}
return [$v,$x,$y];}
function subparams_a($d){[$v,$p]=opt($d,'§',2);//1§2/3
[$x,$y,$p,$o,$d]=opt($p,'/',5); return [$v,$x,$y,$p,$o,$d];}
function cprm($d){$n=strrpos($d,'§'); //split_one for connectors
if($n===false)return [$d,'']; else return [substr($d,0,$n),substr($d,$n+1)];}
function getconn($d){$p=''; $c=''; $xt=strtolower(strrchr($d,'.'));
$s=strrpos($d,':'); if($s!==false){$p=substr($d,0,$s); $c=substr($d,$s);}
return [$p,$c,$xt];}

#plug
function plugin($d,$p='',$o='',$ob='',$res=''){reqp($d); $fc='plug_'.$d;
if(function_exists($fc))return call_user_func($fc,$p,$o,$ob,$res);}
function plugin_func($d,$fc,$p='',$o='',$res=''){reqp($d); $fc=$fc?$fc:'plug_'.$d;
if(function_exists($fc))return call_user_func($fc,$p,$o,$res);}
function appin($a,$m,$p='',$o='',$ob=''){
if(method_exists($a,$m))return $a::$m($p,$o,$ob);}

#eye
function eye($p=''){$iq=ses('iq'); $qbd=ses('qbd');
//json::add('sys','eye',[ses('dayx')=>[$iq,$_SERVER['HTTP_HOST']]]);
$pag=implode_k($_GET,'&','='); if(get('id')=='imgc/')exit;
if($_SESSION['rstr'][22] && !auth(6)){
	$_SESSION['crwl'][$iq]=radd($_SESSION['crwl'],$iq,1); if($_SESSION['crwl'][$iq]>100)exit;}
//if($pag && $iq)insert('qdv','(NULL,"'.$iq.'","'.$qbd.'","'.is255($pag).'",NOW())');
if($pag && $iq)db::sav('qdv',['iq'=>$iq,'qb'=>$qbd,'page'=>$pag,'time'=>''],0);}

#utils
function checkupdate($n=1){return read_file2(philum().'/call/software,version/'.$n);}
function checkversion($n=1){return msql::val('system','program_version',$n);}
function cachevs($id,$n,$v,$o=''){
if(isset($_SESSION['rqt'][$id]) && is_array($_SESSION['rqt'][$id])){$_SESSION['rqt'][$id][$n]=$v;
if($o)msql::modif('',nod('cache'),$v,'val',$n,$id);}}
function forbidden_img($nm){$r=explode(' ',prmb(21));
if($r)foreach($r as $v)if($v && strpos($nm,$v)!==false)return false; return $nm;}
function antipuces($v){if(forbidden_img($v)!==false && strpos($v,'puce')===false)return $v;}

function alert($d){if(ses('dev'))Head::add('jscode',sj('popup_alert___'.ajx($d))); geta('er',$d);}
function patch_replace($bs,$in,$wh,$repl){$rq=sql('id',$bs,'q',$in.'="'.$wh.'"');
while($data=qrw($rq)){echo $data[0].'_'; //sqldel($bs,$data['id']);
update($bs,$in,$repl,'id',$data[0]);}}

function cw(){$p=ses('cur_div'); return prma($p?$p:'content');}
function cwset($d){$_SESSION['cur_div']='temp'; $_SESSION['prma']['temp']=$d;}
function active($d,$n){return $d==$n?' active':'';}

function error_report($o=''){//prms('error')//ini_set("memory_limit","1512M");
ini_set('display_errors',1); error_reporting(ses('dev')=='b'?E_ALL:6135);}

?>