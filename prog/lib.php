<?php
//philum_librairies

spl_autoload_register(function($a){$dr=$_SESSION['prog'].'/';
	if(is_file($f=$dr.'a/'.$a.'.php'))require_once $f;
	if(is_file($f=$dr.'b/'.$a.'.php'))require_once $f;
	if(is_file($f='plug/'.$a.'.php')){require_once($f); return;} $r=sesmk('scanplug','',0);
	if($r)foreach($r as $v)if(is_file($f='plug/'.$v.'/'.$a.'.php')){require_once($f); return;}});

#html
function p($r){print_r($r);}
function n(){return "\n";}
function br(){return "<br />";}
function hr(){return "<hr />";}
function sep(){return '&nbsp;';}
function sti(){return '&#8239';}
function thin(){return '&#8201;';}
function atb($d,$v){return $v?' '.$d.'="'.$v.'"':'';}
function atc($d){return $d?' class="'.$d.'"':'';}
function atd($d){return $d?' id="'.$d.'"':'';}
function ats($d){return $d?' style="'.$d.'"':'';}
function atn($d){return $d?' name="'.$d.'"':'';}
function ath($d){return $d?' href="'.$d.'"':'';}
function atv($d){return $d?' value="'.$d.'"':'';}
function atz($d){return $d?' size="'.$d.'"':'';}
function att($d){return $d?' title="'.$d.'"':'';}
function atk($d){return $d?' onclick="'.$d.'"':'';}
function atkp($d){return $d?' onkeyup="'.$d.'"':'';}
function atj($d,$j){return $d.'(\''.$j.'\')';}
function atjr($d,$j){return $d.'(\''.(is_array($j)?implode('\',\'',$j):$j).'\')';}
function sj($d){return $d?'SaveJ(\''.$d.'\');':'';}
function sjt($d){return $d?'SaveJtim(\''.$d.'\');':'';}
function atbb($d){[$c,$id,$s]=opt($d,'|',3); return atc($c).atd($id).ats($s);}
function attr($r){if(!$r)return; elseif(!is_array($r))return ' '.$r; $ret='';
foreach($r as $k=>$v)$ret.=atb($k,$v); return $ret;}
function ul($v){return '<ul>'.$v.'</ul>';}
function li($v){return '<li>'.$v.'</li>';}
function bal($b,$r,$v){return '<'.$b.attr($r).'>'.$v.'</'.$b.'>';}
function balb($b,$v){return '<'.$b.'>'.$v.'</'.$b.'>';}
function balc($b,$c,$v){return '<'.$b.atc($c).'>'.$v.'</'.$b.'>';}
function span($p,$v){return '<span'.$p.'>'.$v.'</span>';}
function btn($c,$v){return $c?'<span class="'.$c.'">'.$v.'</span>':$v;}
function btd($d,$v){return $d?'<span id="'.$d.'">'.$v.'</span>':$v;}
function bts($d,$v){return $d?'<span style="'.$d.'">'.$v.'</span>':$v;}
function div($p,$v){return '<div'.$p.'>'.$v.'</div>';}
function divc($c,$v){return '<div'.atc($c).'>'.$v.'</div>';}
function divd($d,$v){return '<div'.atd($d).'>'.$v.'</div>';}
function divs($s,$v){return '<div'.ats($s).'>'.$v.'</div>';}
function spanb($v,$c='',$id='',$s=''){return '<span'.atc($c).atd($id).ats($s).'>'.$v.'</span>';}
function button($c,$j,$v){return bal('button',atc($c).atb('onclick',$j),$v);}
function lk($u,$v='',$p=''){return '<a href="'.$u.'"'.$p.'>'.($v?$v:$u).'</a>';}
function lka($u,$v='',$p=''){return '<a href="'.$u.'"'.$p.'>'.($v?$v:domain($u)).'</a>';}
function lkc($c,$u,$v){return '<a href="'.$u.'"'.atc($c).'>'.$v.'</a>';}
function lkt($c,$u,$v,$p=''){return '<a href="'.$u.'"'.atc($c).$p.' target="_blank">'.($v?$v:$u).'</a>';}
function lkn($u,$v=''){return '<a name="'.$u.'">'.$v.'</a>';}
function lkh($oc,$ov,$v,$c=''){
return '<a'.atc($c).atb('onclick',$oc).atb('onmouseover',$ov).'>'.$v.'</a>';}
function llk($c,$l,$v){return balc('li',$c,lk($l,$v));}
function submitj($c,$id,$v){return button($c,'document.forms[\''.$id.'\'].submit();',$v);}
//function lj($c,$j,$v,$o=''){return '<a onclick="'.sj($j).'"'.atc($c).$o.'>'.$v.'</a>';}
function lj($c,$j,$v,$o=''){return '<a onclick="sj(this)" data-j="'.$j.'"'.atc($c).$o.'>'.$v.'</a>';}
function lj2($c,$j,$v,$o=''){return '<a onclick="sjb('.sesj::add($j).')"'.atc($c).$o.'>'.$v.'</a>';}
function lja($c,$j,$v){return '<a onclick="'.$j.'"'.atc($c).'>'.$v.'</a>';}
function ljb($c,$j,$p,$v,$id='',$o='',$a=''){
$on=$a?'onmouseover':'onclick'; if($a)$o=' onmouseout="'.atjr($j,$p).'"';
return '<a '.$on.'="'.atjr($j,$p).'"'.atc($c).atd($id).$o.'>'.$v.'</a>';}
function ljc($c,$d,$j,$v,$o='',$p=''){return lj($c,$d.'_call'.$p.'__'.($o?$o:3).'_'.$j,$v);}
function ljj($c,$j,$p,$v,$t=''){return '<a onclick="'.atjr($j,$p).'"'.atc($c).att($t).'>'.$v.'</a>';}
function ljp($p,$j,$v){return '<a onclick="'.sj($j).'"'.$p.'>'.$v.'</a>';}
function ljh($c,$j,$v){return '<a onclick="'.sj($j).'"'.atc($c).' onmouseover="'.atj('SaveJtim',$j).'; clbubtim(this);" onmouseout="clearTimeout(x); clearTimeout(xc);">'.$v.'</a>';}
function blj($c,$id,$j,$v,$o=''){return btd($id,lj($c,$id.'_'.$j,$v,$o));}
function llj($c,$j,$v,$id='',$a=''){return '<li'.atd($id).'>'.lj($c,$j,$v,'').'</li>';}
function image($d,$w='',$h='',$p=''){if(substr($d,0,4)=='img/')$d='/'.$d;
return '<img src="'.$d.'"'.atb('width',$w).atb('height',$h).' '.$p.'/>';}
function img($d,$s=''){return '<img src="'.$d.'"'.ats($s).' />';}
function rolloverimg($a,$b){return imgico($a.'" onmouseover="this.src=\''.$b.'\'" onmouseout="this.src=\''.$a.'\'');}
function etc($d,$n=400){return substr($d,0,$n).(substr($d,$n)?'...':'');}
function gridpos($d){$r=explode('-',$d); return 'grid-row:'.$r[0].'; grid-column:'.$r[1].';';}
function btim($d,$w='',$h=''){$j=str_replace('_','*',$d).'_'.$w.'_'.$h;
if(substr($d,0,4)=='plug' && root()=='')$d='/'.$d;
return lj('','popup_overim___'.$j,img(root().$d,$w));}//return ljb('','SaveBf','photo_'.$j,img($d,$w));

//ff
function tag($b,$c,$d){return '<'.$b.attr($c).'>'.$d.'</'.$b.'>';}//ff
function divb($v,$c='',$id='',$s=''){return '<div'.atc($c).atd($id).ats($s).'>'.$v.'</div>';}
function btj($t,$j,$c='',$id='',$ti=''){$r=['onclick'=>$j];//ff
	if($c)$r['class']=$c; if($id)$r['id']=$id; if($ti)$r['title']=$ti; return tag('a',$r,$t);}

#action_j
function popbt($ja,$j,$v,$c='',$m='',$o=''){
return lj($c,'popup_'.$ja.'__'.$m.'_'.$j,$v,$o);}
function toggle($c,$j,$v,$n='',$o=''){static $i; $i++; if($n=='x')$i=0;
return ljb($c,'tog_j',[$j,'bt'.$i,$n],$v,strto($j,'_').'bt'.$i,$o);}
function ljtog($c,$j,$jb,$v,$o=''){$rid=randid('bt');
return ljb($c,'tog_jb',[$j,$jb,$rid],$v,$rid,$o);}
function bubble($c,$ja,$j,$v){$id=randid();
return lj($c,'bubble_'.$ja.'__'.$id.'_'.$j,$v,atd('bt'.$id));}
function popbub($d,$j,$v,$c='',$o=''){
if(rstr(102) && !rstr(69))return panup($d,$j,$v,$c);
$id=randid();//apps+dir or call+predir//j=pre-rendered
if($d=='call' or $c)$id=($c?$c:'c').$id; $j='bubble_popbub__'.$id.'_'.$d.'_'.$j;
return llj('',$j,$v,'bb'.$id,$o);}//$o=ljh()
function panup($d,$j,$v,$c){$id=randid();
if($d=='call' or $c)$id=($c?$c:'c').$id; $j='panup_popbub__'.$id.'_'.$d.'_'.$j;
return llj('',$j,$v,'bb'.$id,'');}
function togbub($ja,$j,$v,$c='',$o='',$a=''){$id=rid($ja.$j.$v);//bub from j
return btd('bt'.$id,ljb($c,'togglebub',$ja.'__'.$id.'_'.$j,$v,'',$o,$a));}//.'_1'
function togbub2($id,$v,$t,$c='',$o='',$a=''){//full js
return btd('bt'.$id,ljb($c,'togglebub2',$id,$t,'',$o,$a)).span(atd($id).ats('display:none;'),$v);}
function togses_j($d,$t){$id=randid('tg'); $v=ses($d,$t);//unused
return lj('',$id.'_togses___'.$d,btd($id,offon($v,$t)));}
function bubjs($v,$t,$c=''){
return '<a onmouseover="bubjs(this,1)" onmouseout="bubjs(this,0)" data-tx="'.$v.'"'.atc($c).'>'.$t.'</a>';}
function bubj($j,$t,$c=''){return '<a onclick="sj(this)" data-j="popup_'.$j.'" onmouseover="bubj(this,1)" onmouseout="bubj(this,0)" data-ja="'.$j.'"'.atc($c).'>'.$t.'</a>';}
function bubj2($tx,$j,$t,$c=''){return '<a onclick="sj(this)" data-j="popup_'.$j.'" onmouseover="bubjs(this,1)" onmouseout="bubjs(this,0)" data-tx="'.$tx.'"'.atc($c).'>'.$t.'</a>';}
function togbt($v,$t){$id=randid('tg');
$ret=ljb('','toggle_block',$id,$t,'bt'.$id);
$ret.=div(atd($id).ats('display:none;'),$v);
return $ret;}
function togbth($v,$t){$id=randid('tg');
$ret=ljb('','toggle_hidden',$id,$t,'bt'.$id);
$ret.=span(atd($id),'').hidden('','hid'.$id,htmlentities($v));
return $ret;}
function togses($v,$t){$rid=randid('bt'); $c=ses($v)?'active':'';
return btn('nbp',lj($c.'" id="'.$rid,$rid.'_tog__20_'.$v,$t));}

#forms
//redo:input,hidden,placeholder,jholder($id,$v,$s,$c='')
function input($d,$v,$p=''){return '<input type="text"'.atd($d).atv($v).$p.' />';}
function inpsw($d,$v,$p=''){return '<input type="password"'.atd($d).atv($v).$p.'/>';}
function input1($d,$v,$s='',$c='',$h='',$m='',$p=''){//j
if($h)$p.=atb('placeholder',$v); else $p.=atv($v);
if($s)$p.=atz($s); if($c)$p.=atc($c); if($m)$p.=atb('maxlength',$m); 
return '<input type="text"'.atd($d).$p.'/>';}
function input0($t,$d,$v,$p=''){return '<input'.atb('type',$t).atd($d).atv($v).$p.'/>';}
function input2($n,$v,$s='',$c='',$h='',$m='',$id=''){//name
if($h)$atr=atb('placeholder',$v); else $atr=atv($v); if($id)$atr.=atd($id);
if($s)$atr.=atz($s); if($c)$atr.=atc($c); if($m)$atr.=atb('maxlength',$m); 
return '<input type="text"'.atn($n).$atr.' />';}
function inputj($d,$v,$j,$p='',$h=''){return '<input type="text" '.atd($d).atb($h?'placeholder':'value',$v).atb('data-j',$j).atb('onkeyup','checkj(event,this)').$p.' />';}
function submit($n,$v,$c=''){return '<input type="submit"'.atn($n).atv($v).atc($c).' />';}
function autoclic($n,$v,$sz,$mx,$c,$h='',$o=''){
if($h)$hl=jholder($v); else $hl=atb('placeholder',$v); $o.=atb('maxlength',$mx);
return '<input'.atb('type','text').atn($n).atd($n).$hl.atz($sz).atc($c).' '.$o.' />';}
function jholder($v){return atv($v).atb('onFocus','if(this.value==\''.$v.'\')this.value=\'\'').atb('onBlur','if(this.value==\'\')this.value=\''.$v.'\'');}
function hidden($n,$d,$v){return '<input type="hidden"'.atn($n).atd($d).atv($v).'/>';}
function checkbox($n,$v,$t,$chk=''){$ck=$chk==1?' checked="checked"':''; 
if($t)$label=label($n,$t,'txtsmall2').' ';
return bal('input',atb('type','checkbox').atn($n).atd($n).atv($v).$ck,'').$label;}
function offon($d,$t=''){return pictxt($d?'true':'false',$t,'color:#'.($d?'428a4a':'853d3d').';');}
function togon($d,$t=''){return pictxt($d?'switch-on':'switch-off',$t,$d?'color:#428a4a;':'');}
function checkbox_j($id,$v,$t='',$b='',$j=''){if($b)$b='" title="'.$b; $h=hidden($id,$id,$v?$v:0);
return ljb('small'.$b.'" id="bt'.$id,'checkbox',[$id,$t,$j],offon($v,$t)).$h.' ';}
function checkact($id,$v,$t){$c=$v?'active':'';
return ljb($c.'" id="bt'.$id,'checkact',$id,$t).hidden('',$id,$v?$v:0);}
function label($id,$t,$c='',$ida=''){
return '<label'.atb('for',$id).atc($c).atd($ida).'>'.$t.'</label>';}
function radiobtn($r,$h,$n){$ret='';
if($r)foreach($r as $k=>$v){$ck=$v==$h?' checked="checked"':''; $id=randid();
$ret.='<input type="radio"'.atn($n).atd($id).atv($v).$ck.'/>&nbsp;'.label($id,$v,'small').' ';} 
return $ret;}
function radioj($id,$r,$n){$rid=randid(); $ret='';
foreach($r as $k=>$v)$ret.=ljb($k==$n?'active':'','radioj',[$rid,$id,ajx($v),$k],$v);
return span(atd($rid).atc('nbp'),$ret);}
function radiobtj($r,$vrf,$id,$o=''){$rid=randid('rdio'); if($o)$r=array_keys($r); $ret='';
if(is_array($r))foreach($r as $k=>$v){$c=$v==$vrf?'active':'';
$ret.=ljb($c,'radiobtj',[$rid,$id,ajx($v),$k],$v);}
return span(atd($rid).atc('nbp'),$ret).hidden($id,$id,$vrf);}
function datalist($id,$r,$v,$s=16,$t='',$j=''){$ret=''; $opt=''; if($t)$ret=label($id,$t);
$p=['id'=>$id,'list'=>'dt'.$id,'size'=>$s,'value'=>$v];
if($j){$p['data-j']=$j; $p['onkeyup']='checkj(event,this)';}
$ret.=bal('input',$p,'',1);
foreach($r as $k=>$v)$opt.=bal('option',['value'=>$v],'',1);
$ret.=bal('datalist',['id'=>'dt'.$id],$opt);
return $ret;}

//edit
function connedit($id){$ret='';
$r=['h','b','i','u','s','q','k','stabilo','list','art','web','video','twitter'];
$rb=msql::col('lang','connectors_basic',0,1);
if(auth(2))$ret=upload_j($id,'trk',''); $ret.=ljb('',atjr('embed_slct',['[',']',$id]),'','[]','',att('url/img')); 
foreach($r as $k=>$v)$ret.=ljj('','embed_slct',['[',':'.$v.']',$id],$v,$rb[$v]??$v);
$ret.=ljj('','embed_slct',['[','§(*):toggle]',$id],'toggle','[text§button:toggle]');
//$r=msql::col('',nod('connectors'),0,1);
//if($r)foreach($r as $k=>$v)$ret.=ljj('','embed_slct',['[','§1:'.$k.']',$id],$k,$v);	
if($_SERVER['HTTP_HOST']=='oumo.fr'){
	$ret.=ljj('','embed_slct',['[','§1:umcom]',$id],'umcom','id du twit');
	$ret.=togbub('navs','oomo_'.$id,'oomo');}
$ret.=togbub('navs','ascii4_'.$id,ascii(128578));
$ret.=ljj('','insert_b',['&rArr;',$id],'&rArr;');
return btn('nbp',$ret);}
function textarea($id,$v,$cl='40',$rw='4',$p=''){
return '<textarea'.atn($id).atd($id).atb('cols',$cl).atb('rows',$rw).' '.$p.'>'.$v.'</textarea>';}
function diveditbt($id){
$r=['no'=>nms(72),'p'=>'normal','h1'=>'h1','h2'=>'h2','h3'=>'h3','h4'=>'h4','h5'=>'h5','fact'=>'fact'];
$ret=select(atd('wygs').atb('onchange','execom2(this.value)'),$r);
$r=['increaseFontSize'=>'size','decreaseFontSize'=>'fontsize','bold'=>'bold','italic'=>'italic','underline'=>'underline','strikeThrough'=>'strike','insertUnorderedList'=>'textlist','Indent'=>'block','Outdent'=>'unblock','stabilo'=>'highlight','createLink'=>'url'];
foreach($r as $k=>$v)$ret.=lja('',atj('execom',$k),picto($v,16));
//$ret.=bubble('','navs','ascii4','&#128578;').' ';
if(is_numeric($id))$ret.=lj('','art'.$id.'_savwyg_art'.$id.'__'.$id,picto('save2',16));
return btn('nbp',$ret);}
function divarea($id,$c,$s,$j,$d,$o=''){$ja='';
if($j)$ja=$o?atb('onblur',$j):atb('onkeydown',$j).atb('onclick',$j);
return div(atb('contenteditable','true').atd($id).atc($c).ats($s).$ja,' '.$d);}
function divedit($id,$c,$s,$j,$d){return diveditbt($id).divarea($id,$c,$s,$j,$d);}
function editarea($rid,$d='',$w=80,$h=16,$js=''){
	return connedit($rid).div('',textarea($rid,$d,$w,$h,atc('console').$js));}
function txarea1($msg){return '<textarea id="txtarea" name="msg" class="console" style="margin:0; width:100%; min-width:640px; min-height:240px;">'.$msg.'</textarea>';}
function form($go,$d){return '<form method="post" action="'.$go.'">'.$d."\n".'</form>';}
function goodarea($id,$v,$n=44,$o=''){$nb=round(strlen($v)/$n); $nb=$nb>10?10:$nb;
if(strlen($v)>$n or strpos($v,"\n")!==false)return textarea($id,$v,39,10,atb('wrap','false'));
else return input1($id,$v,36,'',$o,1000);}

//upload
function upload_j($id,$typ,$o=''){
if($o)$o=hidden('opt'.$id,'opt'.$id,$o);//send this val to upload_sav(id,typ,val)
//$dg=lja('',atj('opdrag',$id.'up'),picto('select'));
return '<form id="upl'.$id.'" action="" style="display:inline-block" method="POST" onchange="upload(\''.$id.'\')" accept-charset="utf-8"><label class="uplabel btn"><input type="file" id="upfile'.$id.'" name="upfile'.$id.'" multiple />'.hidden('typ'.$id,'typ'.$id,$typ).''.$o.picto('upload').'</label></form>'.btd($id.'up','').btd($id.'prg','').br();}

//select
function select($atr,$r,$kv='',$h='',$j=''){$ret='';
if($j)$atr['onchange']=atj('SaveJ',$j.'\'+this.value+\'');
if($r)foreach($r as $k=>$v){
	if($kv=='vv')$k=$v; elseif($kv=='kk')$v=$k;
	if($k==$h)$chk=atb('selected','selected'); else $chk='';
	if(strlen($v)>20)$v=substr($v,0,20).'...';
	$ret.=bal('option',atv($k).$chk,$v);}
return bal('select',$atr,$ret);}

function select_js($id,$r,$j='',$slct='',$o=''){$ret='';
$ra=['id'=>$id]; if($j)$ra['onchange']=atj('SaveJ',$j.'\'+this.value+\'');
if($r)foreach($r as $k=>$v){
	if($o==1)$k=is_numeric($k)?$v:$k;
	if($k==$slct)$chk='selected'; else $chk='';
	$ret.=bal('option',atv($k).$chk,$v?$v:$k);}
return bal('select',$ra,$ret);}

function bar($id,$v=50,$step=10,$min=0,$max=100,$js='jumphtml',$s='240px'){
return '<input type="range" id="'.$id.'" min="'.$min.'" max="'.$max.'" step="'.$step.'" value="'.$v.'" onchange="'.$js.'(\'lbl'.$id.'\',this.value);" style="width:'.$s.'; height:5px;" title="use mousewheel"/>'.label($id,$v,'txtx','lbl'.$id);}
function progress($n){return '<progress value="'.$n.'" max="100"></progress>';}

#headers
function meta($d,$v,$c=''){return '<meta '.$d.'="'.$v.'"'.($c?' content="'.$c.'"':'').'/>'."\n";}
function css_link($d,$m=''){$and=isset($_GET['id'])?'?'.randid():'';
if($m)$m=atb('media','only screen and (max-device-width:'.$m.'px)');
return '<link href="'.$d.$and.'" rel="stylesheet"'.$m.'/>'."\n";}
function js_link($d){$and=get('id')?'?'.randid():'';
return '<script src="'.$d.$and.'"></script>'."\n";}
function css_code($d){return '<style type="text/css">'.$d.'</style>'."\n";}
function js_code($d){return '<script type="text/javascript">'.$d.'</script>'."\n";}
function temporize($name,$func,$p){$i=randid(); return 'function '.$name.$i.'(){'.$func.' setTimeout(\''.$name.$i.'()\','.$p.');} '.$name.$i.'();';} 
function relod($v){echo js_code('window.location="'.$v.'"');}

function header_tags($r){$ret='';
if($r)foreach($r as $k=>$v){if(is_array($v))$va=current($v); switch(key($v)){
case('code'):$ret.=$va."\n"; break;
case('csslink'):$ret.=css_link($va); break;
case('jslink'):$ret.=js_link($va); break;
case('csscode'):$ret.=css_code($va); break;
case('jscode'):$ret.=js_code($va); break;
case('rel'):$ret.='<link rel="'.$v['rel'][0].'" href="'.$v['rel'][1].'">'."\n"; break;
case('meta'):$ret.=meta($va[0],$va[1],$va[2]); break;
case('name'):$ret.=meta('name',$va[0],$va[1]); break;
case('tag'):$ret.=balb($va[0],$va[1]); break;
default:$ret.=meta(key($v),$va[0],$va[1]); break;}}
return $ret;}

class Head{static $add;
static function add($k,$v){self::$add[][$k]=$v;}
static function get(){$r=self::$add; return header_tags($r);}
static function html($lg='fr'){return '<!DOCTYPE html><html lang="'.$lg.'" xml:lang="'.$lg.'">';}
static function generate($lg='fr'){return self::html($lg).balb('head',self::get());}
static function page($d,$lg){return self::generate($lg).balb('body',$d).'</html>';}}

function wpg($d,$t='',$lg='fr'){
$ret='<head><meta charset="'.ses('enc').'"><title>'.$t.'</title></head>'; $ret.=balb('body',$d);
return '<!DOCTYPE html><html lang="'.$lg.'" xml:lang="'.$lg.'">'.$ret.'</html>';}

#mysql
function connect(){require('params/_connectx.php'); return $db;}
function qd($d){return ses('qd').'_'.$d;}
function rcptb($db){if($db)return qr('SHOW TABLES FROM `'.$db.'`');}
function lstrc($rq){$rb=[]; if($rq)while($d=qrw($rq))$rb[]=$d[0];return $rb;}
function qrr($r){return mysqli_fetch_array($r);}
function qra($r){return mysqli_fetch_assoc($r);}
function qrw($r){return mysqli_fetch_row($r);}
function qrf($r){mysqli_free_result($r);}
function qrid($sql,$o=''){qr($sql,$o); return mysqli_insert_id($_SESSION['qr']);}
function qr($sql,$o=''){//chrono();
//$rq=mysqli_query($_SESSION['qr'],$sql);
$rq=$_SESSION['qr']->query($sql);
//echo chrono('rq').br();
if($o){if(mysqli_connect_errno())pr(mysqli_connect_error()); echo($sql);} return $rq;}
function qres($v){return mysqli_real_escape_string($_SESSION['qr'],stripslashes($v));}
function atm($v){return '"'.qres($v).'"';}
function atmr($r){foreach($r as $k=>$v)$ret[]=atm($v); return $ret;}
function atmrup($r){foreach($r as $k=>$v)$ret[]=$k.'='.atm($v); return $ret;}
function mysqlra($r,$o=''){$rb=atmr($r); $d=$o?'NULL,':''; if($rb)return '('.$d.implode(',',$rb).')';}
function mysqlrb($r,$o=''){foreach($r as $k=>$v)$rb[]=mysqlra($v,$o); return implode(',',$rb);}
function mysqlrup($r,$o=''){$rb=atmrup($r); $d=$o?'NULL,':''; if($rb)return $d.implode(',',$rb);}
function insert($b,$d,$o=''){return qrid('insert into '.$_SESSION[$b].' values '.$d,$o);}
function update($bs,$set,$v,$col,$id,$o=''){
qr('update '.$_SESSION[$bs].' set '.$set.'="'.qres($v).'" where '.$col.'="'.$id.'"',$o);}
function sqlcols($b){return sql_b('select COLUMN_NAME,DATA_TYPE from INFORMATION_SCHEMA.COLUMNS where table_name="'.$_SESSION[$b].'"','kv');}
function sqlsav($b,$r,$o=''){
return qrid('insert into '.$_SESSION[$b].' values '.mysqlra($r,1),$o);}
function sqlsavi($b,$r,$o=''){//with ai
return qrid('insert into '.$_SESSION[$b].' values '.mysqlra($r,0),$o);}
function sqlsav2($b,$r,$ai=0,$o=''){//multiples
return qrid('insert into '.$_SESSION[$b].' values '.mysqlrb($r,$ai),$o);}
function sqlup($b,$r,$col,$id,$o=''){
qr('update '.$_SESSION[$b].' set '.mysqlrup($r).' where '.$col.'="'.$id.'"',$o);}
function sqlup2($b,$r,$q,$o=''){
qr('update '.$_SESSION[$b].' set '.mysqlrup($r).' where '.implode(' and ',atmrup($q)).'',$o);}
function sqlsavup($b,$r,$o=''){$ex=sql('id',$b,'v',$r);
if($ex)return sqlup($b,$r,'id',$ex,$o); else return sqlsav($b,$r,$o);}
function delete($bs,$id,$o=''){qr('delete from '.$_SESSION[$bs].' where id="'.$id.'" limit 1'); if($o)reflush($bs,1);}
function sqldel($bs,$id,$cl='',$o=''){if(!$cl)$cl='id';
qr('delete from '.$_SESSION[$bs].' where '.$cl.'="'.$id.'" limit 1'); if($o=='ee')reflush($bs,1);}
function reflush($bs,$o=''){qr('alter table '.$_SESSION[$bs].' order by id');
if($o){$n=lastid($bs); if($n)resetdb($bs,$n+1);}}
function resetdb($bs,$n=1){qr('alter table '.ses($b).' auto_increment='.$n);}
function lastid($bs){$wh=$bs=='qda'?'where id>="'.last_art_id().'" ':'';
return sqb('id',$bs,'v',$wh.'order by id DESC limit 1');}
function tuples($b,$c){return qrw(qr('select count(*) as tuples, '.$c.' from '.$_SESSION[$b].' group by '.$c.' having count(*)>1 order by tuples desc'));}
function doublons($b,$c){$b=$_SESSION[$b];
return qrw(qr('SELECT COUNT(*) AS nbr_doublon, '.$c.' FROM '.$b.' GROUP BY '.$c.' HAVING COUNT(*)>1'));}
function killdoublons($b,$c){$b=$_SESSION[$b]; if(auth(6))
return qrw(qr('DELETE t1 FROM '.$b.' AS t1, '.$b.' AS t2 WHERE t1.id > t2.id AND t1.'.$c.' = t2.'.$c.''));}
function maintenance($k,$v,$b1,$b2){return sqb($k.','.$v,$b1,'kv','p1 left outer join '.ses($b2).' p2 on p1.id=p2.'.$k.' where p2.'.$k.' is null',1);}
function sqldrop($b){if(auth(6)){sqlbcp($b); qr('drop table '.ses($b));}}
function trunc($b){if(auth(6)){sqlbcp($b); qr('truncate '.ses($b)); resetdb($b);}}
function sqlex($b){$rq=qr('show tables like "'.ses($b).'"'); return mysqli_num_rows($rq)>0;}
function sqlbcp($b,$o=''){$bb='z_'.ses($b).$o; if(sqlex($bb))qr('drop table '.$bb);
qr('create table '.$bb.' like '.ses($b)); qr('insert into '.$bb.' select * from '.ses($b)); return $bb;}
function sqlrck($b){$bb='z_'.ses($b); if(sqlex($bb) && auth(6))qr('drop table '.ses($b)); else return;
qr('create table '.ses($b).' like '.$bb); qr('insert into '.ses($b).' select * from '.$bb); return $bb;}

function sqlformat($rq,$p){$ret=[];
if($p=='q')return $rq;//res
if($p=='r')return qrr($rq);//array
if($p=='a')return qra($rq);//assoc
if($p=='w')return qrw($rq);//row
if($p=='v'){$r=qrw($rq); return $r[0]??'';}
if($p=='ar'){$rb=[]; while($r=qra($rq))$rb[]=$r; return $rb;}
while($r=qrw($rq))if($r[0])switch($p){
	case('k'):$ret[$r[0]]=isset($ret[$r[0]])?$ret[$r[0]]+1:1; break;
	//case('k'):$ret[$r[0]]=radd($ret,$r[0]); break;
	case('rv'):$ret[]=$r[0]; break;//r
	case('kv'):$ret[$r[0]]=$r[1]; break;
	case('kk'):$ret[$r[0]][$r[1]]=isset($ret[$r[0]][$r[1]])?$ret[$r[0]][$r[1]]+=1:1; break;
	//case('kk'):$ret[$r[0]][$r[1]]=radd($ret[$r[0]],$r[1]); break;
	case('vv'):$ret[]=[$r[0],$r[1]]; break;
	case('kr'):$ret[$r[0]][]=$r[1]; break;
	case('kkv'):$ret[$r[0]][$r[1]]=$r[2]; break;
	case('kkk'):$ret[$r[0]][$r[1]][$r[2]]+=1; break;
	case('kvv'):$ret[$r[0]]=[$r[1],$r[2]]; break;
	case('kkr'):$ret[$r[0]][$r[1]][]=$r[2]; break;
	case('index'):$ret[$r[0]]=$r; break;
	default:$ret[]=$r; break;}
return $ret;}

function sqlr($q){$ret='';
if(is_numeric($q))return 'id='.$r;
if(isset($q['order'])){$ret.=' order by '.$q['order']; unset($q['order']);}
if(isset($q['group'])){$ret.=' group by '.$q['group'].$ret; unset($q['group']);}
if(isset($q['or'])){$ret.=' and ('.implode(' or ',atmrup($q['or'])).')'.$ret; unset($q['or']);}
if($q)$ret=implode(' and ',atmrup($q)).$ret;
return 'where '.$ret;}

function sql($d,$b,$p,$q,$z=''){if(is_numeric($q))$q='id="'.$q.'"';
if(is_array($q))$q=implode(' and ',atmrup($q));
$sql='select '.$d.' from '.$_SESSION[$b].($q?' where '.$q:'');
$rq=qr($sql); if($z)echo $sql; $ret=$p=='v'?'':[];
if($rq){$ret=sqlformat($rq,$p); qrf($rq);}
return $ret;}

function sqb($d,$b,$p,$q,$z=''){
$sql='select '.$d.' from '.$_SESSION[$b].' '.$q;
$rq=qr($sql); if($z)echo $sql; $ret=$p=='v'?'':[];
if($rq){$ret=sqlformat($rq,$p); qrf($rq);}
return $ret;}

function sqr($d,$b,$q='',$z=''){
$sql='select '.$d.' from '.$_SESSION[$b].' '.$q;
return qr($sql,$z);}

function sql2($d,$b,$p,$q,$z=''){if(is_numeric($q))$q='id="'.$q.'"';
if(is_array($q))$q=implode(' and ',atmrup($q));
$sql='select '.$d.' from '.$b.($q?' where '.$q:'');
$rq=qr($sql); if($z)echo $sql; $ret=$p=='v'?'':[];
if($rq){$ret=sqlformat($rq,$p); qrf($rq);}
return $ret;}

function sql_inner($d,$b1,$b2,$key,$p,$q,$z=''){
if(is_array($q))$q='where '.implode(' and ',atmrup($q));
if($d==$key)$d=$_SESSION[$b2].'.'.$d;
$sql='select '.$d.' from '.$_SESSION[$b1].' inner join '.$_SESSION[$b2].' 
on '.$_SESSION[$b1].'.id='.$_SESSION[$b2].'.'.$key.' '.$q;
$rq=qr($sql,$z); $ret=$p=='v'?'':[];
if($rq){$ret=sqlformat($rq,$p); if($rq)qrf($rq);}
return $ret;}

function sql_b($sql,$p,$z=''){$rq=qr($sql,$z);
if($rq){$ret=sqlformat($rq,$p); if($rq)qrf($rq); return $ret;}}

function sqledt($p,$id,$x,$res=''){$rid=randid(); $ret='';
$cols=sqlcols($p); if($cols){$cl=array_keys($cols); $kv=implode('|',$cl);}
if($x=='x')sqldel($p,$id);
if($res)sqlup($p,array_combine($cl,ajxr($res)),'id',$id);
$r=sql('*',$p,'a',$id); //p($r);
if($cols)foreach($cols as $k=>$v)$ret.=divc('',goodarea($k,$r[$k],44));
$ret.=lj('popsav',$p.'_sqledt__x_'.$p.'_'.$id.'___'.$kv,picto('save'));
$ret.=lj('popdel',$p.'_sqledt__x_'.$p.'_'.$id.'_x__',picto('del'));
return divd($p,$ret);}

#dirs
function mkdir_r($u){$nu=explode('/',$u); if(count($nu)>10)return;
if(strpos($u,'Warning')!==false)return; $ret='';
foreach($nu as $k=>$v){$ret.=$v.'/'; if(strpos($v,'.'))$v=''; 
if(!is_dir($ret) && $v){if(!mkdir($ret))echo $v.':not_created ';}}}
function rmdir_r($dr){$dir=opendir($dr); if(!auth(6))return;
while($f=readdir($dir)){$drb=$dr.'/'.$f;
if(is_dir($drb) && $f!='..' && $f!='.'){rmdir_r($drb); if(is_dir($drb))rmdir($drb);}
elseif(is_file($drb)){unlink($drb); $drb.br();}} if(is_dir($dr))rmdir($dr);}

function explore($dr,$p='',$o=''){
if(!is_dir($dr))return; $dir=opendir($dr); $ret=[];
while($f=readdir($dir))if($f!='..' && $f!='.' && $f!='_notes'){
$drb=$dr.'/'.$f; if(is_dir($drb)){
	if($p=='dirs' or $p=='all')$ret[$f]=$f;
	if(!$o)$ret[$f]=explore($drb,$p,$o);}
elseif($p=='full')$ret[]=$drb; elseif($p!='dirs')$ret[]=$f;}//if(is_file($drb))
return $ret;}

function scandir_b($d){$r=scandir($d); unset($r[0]); unset($r[1]); return $r;}
function scandir_r($d,$r=[]){$dr=opendir($d); 
while($f=readdir($dr))if($f!='..' && $f!='.'){$df=$d.'/'.$f;
	if(is_dir($df))$r=scandir_r($df,$r); else $r[]=$df;}
return $r;}

function explode_dir($r,$d,$fc){static $i; $i++; $io=0; $ret=[];
if(is_array($r)){foreach($r as $k=>$v){$io++; 
	if(is_array($v)){$ret[$k]=explode_dir($v,$d.'/'.$k,$fc);$i--;}
	else $ret[$k]=$fc($d,$k,$v,$i.'.'.$io);}}
return $ret;}
//example of user_func for explode_dir, where if(!$v):empty_dir
function func($d,$k,$f,$n){//dir,key,file,topology
if($v)return $d.'/'.$f; else return $d;}
//actions
function walk_dir($dr,$fc){
$r=explore($dr); return explode_dir($r,$dr,$fc?$fc:'func');}
function scanwalk($dr,$fc){$r=scandir_r($dr); $rb=[];
foreach($r as $k=>$v){$a=$fc($dr,$k,$v); if($a)$rb[]=$a;} return $rb;}

#files
function read_file($f){if($f)$fp=fopen($f,'r') or die('er'); $ret='';//fgets
if($fp){while(!feof($fp))$ret.=fread($fp,8192); fclose($fp);} return $ret;}
function write_file($f,$t){$h=fopen($f,'w') or die('er'); $w=false;
if($h){$w=fwrite($h,$t); fclose($h); opcache_invalidate($f);}
if($w===false)return 'error';}

function read_file2($f){if(fex1($f))return read_file($f);}
//function fex0($f){$fp=finfo_open(FILEINFO_MIME_TYPE); $d=finfo_file($fp,$f); finfo_close($fp); return $d;}
function fex1($f){return @fopen($f,'r');}
function fex2($f){$fp=curl_init($f); curl_setopt($fp,CURLOPT_NOBODY,true); curl_exec($fp);
$d=curl_getinfo($fp,CURLINFO_HTTP_CODE); curl_close($fp); return $d==200?1:0;}

function writecsv($f,$r){
file_put_contents($f,'');
if(($h=fopen($f,'r+'))!==false){
foreach($r as $k=>$v)fputcsv($h,$v); fclose($h);}}

function readcsv($f){$rb=[];
if(($h=fopen($f,'r'))!==false){$k=0;
while(($r=fgetcsv($h,'',"\t"))!==false){$nb=count($r);
for($i=0;$i<$nb;$i++)$rb[$k][]=$r[$i]; $k++;} fclose($h);}
return $rb;}

function csvfile($f,$r,$t='',$z=''){
$t=$t?pictxt('file-data',$t):pictit('file-data','csv:'.$f);
$f='_datas/'.$f.'.csv'; if(!is_file($f) or $z)writecsv($f,$r);
return lk('/'.$f,$t);}

function joinable($d){$ok=@fopen($d,'r'); if($ok){fclose($ok); return true;}}
function urlcheck($f){$r=@get_headers($f);
return is_array($r)?preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$r[0]):false;}
function urlutf($u){return urlencode(utf8_encode($u));}//urlenc()
function utf($d){return $d;}//$_SESSION['enc']=='utf-8'?utf8_encode($d):
function is_mail($d){return filter_var($d,FILTER_VALIDATE_EMAIL);}
function is_url($d){return filter_var($d,FILTER_VALIDATE_URL);}
function is_hex($d){$opts=['flags'=>FILTER_FLAG_ALLOW_HEX];
//$opts=['options'=>['default'=>'no','min_range'=>0,'max_range'=>16777215],$opts];
return filter_var('0x'.$d,FILTER_VALIDATE_INT,$opts);}

function file_get_context($f){
ini_set('user_agent','Mozilla/5.0'); $head='User-agent: Mozilla/5.0'."\n";
$r=['http'=>['method'=>'GET','header'=>$head,'ignore_errors'=>1,'request_fulluri'=>true,'max_redirects'=>0]];//,'content'=>$postdata
$context=stream_context_create($r);
//if($f && $f!='http://')$h=get_headers($f,false);//$http_response_header
//if(isset($h) && strpos($h[0],'404'))return '404:'.$f; //if(strpos($h[1],'utf-8'))$_POST['utf']=1;
if(is_url($f))return file_get_contents($f,false,$context);}

function curl_get_contents($f,$post=''){
$ch=curl_init(); curl_setopt($ch,CURLOPT_URL,$f); $er='';
//$fp=fopen($f,'wb'); curl_setopt($ch,CURLOPT_FILE,$fp);//writable src
curl_setopt($ch,CURLOPT_HTTPHEADER,[]);//['HTTP_ACCEPT: Something','HTTP_ACCEPT_LANGUAGE: fr, en, es','HTTP_CONNECTION: Something','Content-type: application/x-www-form-urlencoded','User Agent: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8']
if($post){curl_setopt($ch,CURLOPT_POST,TRUE); curl_setopt($d,CURLOPT_POSTFIELDS,$post);}
curl_setopt($ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);//open modialisation.ca
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0); curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($ch,CURLOPT_REFERER,host()); curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
//curl_setopt($ch,CURLOPT_COOKIE,true); //curl_setopt($ch,CURLOPT_REMOTE,'127.127.127.0'); 
$ret=curl_exec($ch); if($ret===false)$er=curl_errno($ch);
curl_close($ch); if(!$er)return $ret;}

function get_file($f){$ret='';
//if(!$ret)$ret=read_file($f);if(!$ret)
//if($ret)$ret=@file_get_contents($f);
if(!$ret)$ret=curl_get_contents($f); 
//if(!$ret)$ret=file_get_context($f);
//if(!$ret){$d=get_dom($f); if(is_object($d))$ret=$d->saveHTML;}
//if(!$ret){require('plug/tiers/simple_html_dom.php'); return file_get_html($f);}
//if($ret)$ret=gzdecode($ret);
return $ret;}

function dom($d){
$dom=new DomDocument;
$dom->validateOnParse=true;
$dom->preserveWhiteSpace=true;//false
libxml_use_internal_errors(true);
if($d)$dom->loadHtml($d);
return $dom;}

function get_dom($f,$o=''){$ret='';
//if(!urlcheck($f))return 'no';
if($o){$d=get_file($f); if($d)return dom($d);}//vaccum_ses
else{$dom=dom(''); $dom->loadHTMLFile($f); return $dom;}
ecko('nothing');}

function domattr($v,$p){if($v->hasAttribute($p))return $v->getAttribute($p);}

//fileinfo
function recup_fileinfo($doc){if(is_file($doc))
return date('ymd',filemtime($doc)).'-'.round(filesize($doc)/1024).'Ko';}
function ftime($f,$d=''){if(is_file($f))return date($d?$d:'ymd.Hi',filemtime($f));}
function fsize($f,$o=''){if(is_file($f))return round(filesize($f)/1024,1).($o?' Ko':'');}
function fwidth($f){if(is_file($f))return getimagesize($f);}
function frdate($d){$r=['','janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre']; return $r[$d];}
function localdate($d){$r=explode('/',date('d/m/Y',$d)); $r[1]=frdate(intval($r[1]));
return implode(' ',$r);}

//gz
function gz_file($f){$d=read_file($f); gz_write($f.'.gz',$d);}
function gz_write($f,$d){$gz=gzopen($f,'w9'); gzwrite($gz,$d,strlen($d)); gzclose($gz);}
function gz_write2($f,$d){file_put_contents($f.'.gz',gzencode($d,9));}
function gz_read($f,$o=0){$d=gzopen($f,'rb',$o); $ret='';
if($d)while(!gzeof($d))$ret.=gzread($d,1024); gzclose($d); return $ret;} 
function ungz_read($d){return implode('',gzfile($d));}
function ungz_read2($d){return gzinflate(substr($data,10,-8));}
function ungz_write($d,$f){$t=ungz_read($d); write_file($f,$t);}
function gz2im($f){$d=gz_read($f); $d=str_replace('x-gzip','x-image',$d); file_put_contents($f,$d);}//
function is_zip($f){if(strpos(mime_content_type($f),'application/x-gzip')!==false)return 1;}
function unpack_gz($f,$d){$p='plug/tar/pcl'; include_once($p.'tar.lib.php');
include_once($p.'error.lib.php'); include_once($p.'trace.lib.php'); PclTarExtract($f,$d,'','');}

//json
function json_error(){
switch(json_last_error()){
case JSON_ERROR_NONE:return 0; break;
case JSON_ERROR_DEPTH:return 1; break;//'Profondeur maximale atteinte'
case JSON_ERROR_STATE_MISMATCH:return 2; break;//'Inadéquation des modes ou underflow'
case JSON_ERROR_CTRL_CHAR:return 3; break;//'Erreur lors du contrôle des caractères'
case JSON_ERROR_SYNTAX:return 4; break;//'Erreur de syntaxe ; JSON malformé'
case JSON_ERROR_UTF8:return 5; break;//'Caractères UTF-8 malformés, erreur encodage'
default:return 6; break;}}//'Erreur inconnue'

function mkjson($r,$o=''){
//$o=$_SESSION['enc']=='utf-8'?1:0;
$rb=utf_r($r);//,$o
$ret=json_encode($rb,JSON_HEX_TAG);
$e=json_error(); if($e)$ret=json_encode(array_combine(array_keys($r),array_fill(0,count($r),$e)));
return $ret;}

function utf_r($r,$o=''){$ret=[];
if(is_array($r))foreach($r as $k=>$v){
	$k=$o?utf8_decode($k):utf8_encode($k);
	if(is_array($v))$ret[$k]=utf_r($v,$o);
	else $ret[$k]=$o?utf8_decode($v):utf8_encode($v);}
return $ret;}

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
return '<?php //philum/msql/'.$p."\n".'$r=['.$ret.'];';}

function nod($d){return $_SESSION['qb'].'_'.$d;}
function msqbt($b,$p,$d='',$c=''){$u=($b?$b:'users').'_'.ajx($p).($d?':'.ajx($d):'');
return lj('grey'.($c?' '.$c:''),'popup_msql__3_'.$u,pictit('msql',$p));}

#tables
function tabler($r,$head='',$keys='',$frame=''){$i=0; $td=''; $tr='';
if(is_array($head)){array_unshift($r,$head); $head=1;}
if(is_array($r))foreach($r as $k=>$v){$td=''; $i++; $tag=$i==1&&$head?'th':'td';
	if($keys)$td.=balb($tag,$k);
	if(is_array($v))foreach($v as $ka=>$va)$td.=balb($tag,$va);
	else $td.=balb($tag,$k).balb($tag,$v);
	if($td)$tr.=bal('tr','',$td);}//ats('valign','top')
$ret=balb('table',balb('tbody',$tr));
if($frame)$ret=divs('width:100%; height:'.($frame>1?$frame:400).'px; overflow:auto; scrollbar-width:thin;',$ret);
return $ret;}

function make_table($r,$head='',$keys='',$frame=''){return tabler($r,$head,$keys,$frame);}//old

function divtable($r,$h=''){$cr='display:table-row;'; $ret=''; $i=0;
$cc='display:table-cell; vertical-align:middle; padding:2px; '; $cs='';
if(is_array($r))foreach($r as $k=>$v){$td=''; $i++;
	if($h)$cs=$i==1?'background:rgba(255,255,255,0.4);':'';
	if(is_array($v))foreach($v as $ka=>$va)$td.=bts($cc.$cs,$va);
	if($td)$ret.=bts($cr,$td);}
return divc('small',$ret);}

function array_conn($r){foreach($r as $v)
if(is_array($v))$ret[]=implode('|',$v); else $ret[]=$v;
return implode('¬',$ret);}

//tabs
function make_tabs($r,$ud='',$c=''){
if(!$r)return; $b=0; $menu=''; $divs='';
static $i; $i++; $id='tab'.$ud.'-'.$i; $ra=array_keys($r);
$ib=ses('tbmd'.$id); if(!$ib)$ib=1; $sp=btn('txtac',' ');
foreach($r as $k=>$v){$b++; if(is_array($v))$v=implode('',$v);
	$dsp=$b==$ib?'block':'none'; $cs=$b==$ib?'txtaa':'txtab';
	$menu.=ljb($cs,'toggle_tab',[$id,$b],$k).$sp;
	if(is_array($v))$v=divc('list',onxcols($v,3,''));//implode(' ',$v);
	$divs.=div(atd('div'.$id.$b).ats('display:'.$dsp).atc($c),$v);}
return divb($menu,'','mnuab'.$id,'margin-bottom:4px').$divs;}

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

//prepared_list
function menuder_h($r,$id,$d,$j){$i=0; $rt='';
foreach($r as $k=>$v){$jx=atjr('jumpvalue',[$id,$k]).'; ';
	$jx.='active_list(\'div'.$id.'\','.$i.',\'active\',\'\'); '.$j; $i++;
	$rt.=lja($d==$k?'active':'',$jx,$v).' ';}
$ret=span(atd('div'.$id).atc('nbp'),$rt).hidden('',$id,$d);
return $ret;}

function menuderj_prep($pr,$id,$t,$opt=''){$rid=randid();//menuder_jb
$j='popup_menuder___'.ajx(addslashes($pr)).'_'.$id.'_'.$rid.'_'.$opt;
return ljp(atd('adcat'.$rid),$j,$t?$t:'...').hidden('',$id,$t);}

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
$hid='bt'.$id; $j=$id.'_'.$f.'_'.ajx($v).'_'.ajx($o).'_'.$id;
$c=$v?'active':''; $t=$t?$t:($v?$v:'select...');
if($ty==1)$h=input1($id,$v,3); elseif($ty!=2)$h=hidden($id,$id,$v); else $h='';
//return togbub('hidden',$j,$t,$c).$h;
return lj('popbt','popup_hidden__'.$hid.'_'.$j,$t,atd($hid)).$h;}//$hid déclenche bub

#dates
function mkday($d='',$p=''){if($p==1)$p=$_SESSION['prmb'][17];
return date($p?$p:'ymd',is_numeric($d)?$d:time());}
function calc_date($d){$dy=ses('daya'); $day=$dy?$dy:ses('dayx'); $m=is_numeric($d)?$d:0;
return $day-(86400*$m);}
function calctime($d){return ses('dayx')-86400*(is_numeric($d)?$d:1);}
function daysfrom($d){return round((ses('dayx')-(is_numeric($d)?$d:1))/86400);}
function mysqldate(){return date('Y-m-d h:i:s');}
function timelang($lg=''){if(!$lg or $lg=='all')$lg=prmb(25);
setlocale(LC_TIME,$lg.'_'.strtoupper($lg));}
function time_prev($d){$ret='';
$r=[0,7,30,90,365]; for($i=5;$i<25;$i++){$a=isset($r[$i-1])?$r[$i-1]:0; $r[]=$a+365;} $n=count($r);
for($i=0;$i<=$n;$i++)if(!empty($r[$i]) && $r[$i]<$d)$ret=$r[$i];
return $ret;}
function mkdts(){return $_SESSION['prmb'][17]?$_SESSION['prmb'][17]:'ymd.Hi';}
function rss_date($d){return date(mkdts(),strtotime($d));}
function time_ago($dt){$dy=time()-$dt; if($dy<86400){$fuseau=3;
$h=intval(date('H',$dy))-$fuseau; $i=intval(date('i',$dy)); $s=intval(date('s',$dy)); 
$nbh=$h>1?$h.' h ':''; $nbi=$i>0?$i.' min ':'';
return $nbh.$nbi.$nbs;} else return date(mkdts(),$dt);}
function clean_nb($d,$o=0){return number_format($d,$o,',',' ');}

function dayref($cbl){
[$d,$m,$y]=explode('-',$cbl);
return mktime(0,0,0,$m,$d,$y);}//23,59,59

function timetravel(){$r=define_digr(); $n=max(array_flip($r))/365;//365.24219
unset($r[1]); unset($r[7]); unset($r[30]); unset($r[90]); $ret=[];
if($r)foreach($r as $k=>$v)if(is_numeric($k)){$tim=calctime($k); $t=date('Y',$tim); $ret[$t]=$tim;}
return $ret;}

#builders
function on2cols($r,$w,$p){$w1=$w/$p; $w2=$w-$w1; $ret='';
$css='" style="display:table-cell; width:'.$w1.'px;';
$csb='min-width:'.$w2.'px;'; $csc='display:table-row;';
if($r)foreach($r as $k=>$v){
	$va=is_array($v)?implode('',$v):$v;
	$ret.=divs($csc,divc('txtsmall'.$css,$k).divs($csb,$va?$va:'-'));}
return $ret;}

function onxcols($re,$prm,$w,$h=''){//colonize
$nb=count($re); $i=0; $io=1; $r[$io]=''; if(!is_numeric($prm))$prm=3; $ret='';
$mid=ceil($nb/$prm); $mid=$mid==0?1:$mid; $mw=floor($w/$prm)-60;
if($h)$h=' overflow-y:auto; overflow-x:visible; scrollbar-width:thin; height:'.$h.'px;';
$css='float:left; min-width:'.$mw.'px; width:'.(floor(100/$prm)).'%;'.$h.';';
if($re)foreach($re as $k=>$v){$i++; if($i<=$mid)$r[$io].=$v;
	if($i>$io*$mid && $io<$prm){$io++; $r[$io]='';}
	if($io>1 && $i>$mid*($io-1) && $i<=$mid*$io)$r[$io].=$v;}
for($i=1;$i<=$prm;$i++)$ret.=divs($css,$r[$i]??'');
return $ret.divc('clear','');}

function scroll($r,$d,$max=10,$w='',$h='',$id=''){$h=is_numeric($h)?$h.'px':$h;
$n=is_array($r)?count($r):$r; $wa=$w?' width:'.$w.'px;':'';
$s=ats('overflow:auto; scrollbar-width:thin;'.$wa.' min-width:140px; max-height:'.($h?$h:'420px').';');
if($n>$max or !$n)return div(atd('scrll'.$id).$s,$d); else return $d;}

function scroll_b($r,$d,$max=10,$w='',$h='',$id=''){$n=is_numeric($r)?$r:count($r);
$h=$h?$h:'calc(100vh - 100px)'; if(is_numeric($h))$h.='px';
$w=$w?$w:'calc(100% + 1px)'; if(is_numeric($w))$w.='px';
$ca='width:'.$w.'; height:'.$h.'; overflow:hidden; padding-right:1px;';
$cb=' id="scrll'.$id.'" style="width:calc(100% + 16px); overflow-y:auto; scrollbar-width:thin; height:'.$h.';"';
if($n>$max or !$n)return divs($ca,div($cb,$d)); else return $d;}

#medias
function jcim($f,$o=''){$h=$o?host().'/':'';//root()
if(substr($f,0,4)!='http')return $h.(strpos($f,'/')!==false?'users/':'img/');}
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
elseif(strpos($f,'datas/')!==false)return $h.''.$f;
elseif(strpos($f,'/')!==false)return $h.'users/'.$f;
//elseif(strpos($f,'users/')===false)return $h.'users/'.$f;
else return $f;}

function iframe($d,$w='',$h=''){
list($dc,$wb,$hb,$p,$o,$d)=subparams_a($d);//url§w/h
$w=$wb?$wb:$w; $h=$hb?$hb:($h?$h:'550px'); $w=$w?$w:'100%';
if(strpos($dc,'http')===false)$f='/users/'.$dc;
$prm=atb('width',$w).atb('height',$h).atn($p).atb('seamless',$o).atb('srcdoc',$o);//
//webkitallowfullscreen mozallowfullscreen //return obj($dc,''); //allow-scripts
return bal('iframe','src="'.$dc.'" frameborder="0"'.$prm.' allowfullscreen ','');}//sandbox="allow-presentation" (will block js) referrerpolicy="origin"

function obj($d,$t,$s=''){return bal('object',atb('data',$d).atb('type',$t).ats($s).' ','');}//typemustmatch="true"

function forbidden_img($nm){$r=explode(' ',prmb(21));
if($r)foreach($r as $v)if($v && strpos($nm,$v)!==false)return false; return $nm;}

function audio($d,$id='',$t=''){list($f,$t)=cprm($d); $ret=btn('small',download($d));
return '<audio controls><source src="'.$f.'" type="audio/mpeg"></audio>'.$ret;}

function video_html($d,$w='',$h='',$o=''){
list($d,$t)=opt($d,'§'); $d=goodroot($d); $ty='type="video/'.substr(xtb($d),1).'"';
if($t)return lj('','popup_popmp4___'.ajx($d),pictxt('movie',$t!=1?$t:strend($d,'/')));
//if(!urlcheck($d))return lkt('',$d,pictxt('movie'),domain($d));
if(strpos($d,'.mp4'))$xt='mp4'; else $xt=substr(xt($d),1); if($o)$h.=' poster="'.$o.'"';
if($w)$w.='px'; else $w='100%'; if($h)$h=' height="'.$h.'px"'; else $h=' height="440px"';
return '<video src="'.$d.'" width="'.$w.'"'.$h.$ty.' controls autobuffer></video>';}//loop

#img
//force LH, cut and center
function scale_img($w,$h,$wo,$ho,$s){$hx=$wo/$w; $hy=$ho/$h; $ya=0; $yb=0; $xa=0; $xb=0;
if($s==2){$xb=($wo/2)-($w/2); $yb=($ho/2)-($h/2); $wo=$w; $ho=$h;}//center
elseif($hy>$hx && $s){$yb=($ho-($h*$hx))/2; $ho=$ho/($hy/$hx);}//reduce_h
elseif($hy<$hx && $s){$xb=($wo-($w*$hy))/2; $wo=$wo/($hx/$hy);}//reduce_w
elseif($hy<$hx){$xb=($wo-($w*$hy))/2; $wo=$wo/($hx/$hy);}//adapt_h (no_crop)
elseif($hy && $hx){$xb=0; $ho=$ho/($hy/$hx);}//adapt_w
return [$w,$h,$wo,$ho,$xb,$yb];}

function make_mini($in,$out,$w,$h,$s){
if(!is_file($in) && substr($in,0,4)!='http')return;
$w=$w?$w:140; $h=$h?$h:100; list($wo,$ho,$ty)=getimagesize($in); $xa=0; $ya=0;
list($w,$h,$wo,$ho,$xb,$yb)=scale_img($w,$h,$wo,$ho,$s);
//if(filesize($in)/1024>100000)return; //if($ho<$w or $wo<$h)return;
//if($w>=$wo && $h>=$ho){if(is_file($out))unlink($out); return $in;}
$img=imagecreatetruecolor($w,$h);
$c=imagecolorallocate($img,255,255,255); imagefill($img,0,0,$c);
if($ty==2){$im=@imagecreatefromjpeg($in);
	imagecopyresampled($img,$im,$xa,$ya,$xb,$yb,$w,$h,$wo,$ho);
	imagejpeg($img,$out,100);}
elseif($ty==1){$im=@imagecreatefromgif($in); imgalpha($img);
	imagecopyresampled($img,$im,$xa,$ya,$xb,$yb,$w,$h,$wo,$ho);
	imagegif($img,$out);}
elseif($ty==3){$im=@imagecreatefrompng($in); imgalpha($img);
	if($im)imagecopyresampled($img,$im,$xa,$ya,$xb,$yb,$w,$h,$wo,$ho);
	imagepng($img,$out);}
return $out;}

function imgalpha($img){
$c=imagecolorallocate($img,255,255,255); imagecolortransparent($img,$c);
imagealphablending($img,false); 
imagesavealpha($img,true);}

function img64($d,$m=''){$m=$m?$m:'jpeg';
return '<img src="data:image/'.$m.';base64,'.base64_encode($d).'" />';}
function imgmim($d){$typ=exif_imagetype($d); return image_type_to_mime_type($typ);}//image/jpeg
function imgmini($f){$d=exif_thumbnail($f); return img64($d);}
function imgexif($d){$r=exif_read_data($d); $ret=[];
$rb=['make','model','DateTimeOriginal','FocalLength','MaxApertureValue','ISOSpeedRatings','FocalLength','Flash'];
if($r)foreach($rb as $v)$ret[$v]=$r[$v]??'';
return $ret;}

//clrs
function colors(){return msql::read('system','edition_colors');}
function rand_clr(){$r=colors(); $rb=array_keys_r($r,0); sort($rb); 
$n=rand(0,count($rb)); return $rb[$n];}
function hexrgb_r($d){
for($i=0;$i<3;$i++)$r[]=hexdec(substr($d,$i*2,2)); return $r;}
function hexrgb($d,$o=''){$r=hexrgb_r($d);
return 'rgba('.$r[0].','.$r[1].','.$r[2].','.$o.')';}
function invert_color($p,$o){$ret='';
if($o)return hexdec($p)<8300000?'ffffff':'000000';//16777215
for($i=0;$i<3;$i++){$d=dechex(255-hexdec(substr($p,$i*2,2)));
	if(strlen($d)==1)$d='0'.$d; $ret.=$d=='0'||!$d?'00':$d;}
return $ret;}
function rgb2hex($r){$ret='';
for($i=0;$i<3;$i++){$d=dechex($r[$i]);
	if(strlen($d)==1)$d='0'.$d; $ret.=$d=='0'||!$d?'00':$d;}
return $ret;}
function hsl2rgb($h,$s,$l){
$h/=360; $s/=100; $l/=100; $r=$l;$g=$l;$b=$l;
$v=($l<=0.5)?($l*(1.0+$s)):($l+$s-$l*$s);
if($v>0){$m; $sv; $sextant; $fract; $vsf; $mid1; $mid2;
	$m=$l+$l-$v; $sv=($v-$m)/$v; $h*=6.0;
	$sextant=floor($h); $fract=$h-$sextant; $vsf=$v*$sv*$fract;
	$mid1=$m+$vsf; $mid2=$v-$vsf;
	switch($sextant){
	case 0:$r=$v; $g=$mid1; $b=$m; break;
	case 1:$r=$mid2; $g=$v; $b=$m; break;
	case 2:$r=$m; $g=$v; $b=$mid1; break;
	case 3:$r=$m; $g=$mid2; $b=$v; break;
	case 4:$r=$mid1; $g=$m; $b=$v; break;
	case 5:$r=$v; $g=$m; $b=$mid2; break;}}
return [round($r*=255),round($g*255),round($b*255)];}
function hsl2hex($h,$s,$l){$r=hsl2rgb($h,$s,$l); return rgb2hex($r);}

function getclrs($k='',$n=''){
$k=$k?$k:$_SESSION['prmd']; $r=sesr('clrs',$k); if($r)return $n?$r[$n]:$r;}
function setclrs($d,$k=''){$prmd=$k?$k:$_SESSION['prmd']; $_SESSION['clrs'][$prmd]=$d;}

#php
function stripslashes_b($d){return str_replace(["\'",'\"'],["'",'"'],$d);}
function strin($v,$s){return strpos($v,$s)!==false?true:false;}
function subtopos($d,$a,$b){return substr($d,$a,$b-$a);}
function subtostr($d,$a,$v){return substr($d,$a,strpos($d,$v,$a)-$a);}
function split_r($d,$n){return [substr($d,0,$n),substr($d,$n)];}
//str
function strprm($d,$n=0,$s='/'){$r=explode($s,$d); return $r[$n]??'';}
//function strprm($v,$s,$n){$r=explode($s,$v); return $r[$n]??'';}
function strto($v,$s){$p=strpos($v,$s); return $p!==false?substr($v,0,$p):$v;}//strto
function struntil($v,$s){$p=strrpos($v,$s); return $p!==false?substr($v,0,$p):$v;}
function strend($v,$s){$p=strrpos($v,$s); return $p!==false?substr($v,$p+strlen($s)):$v;}
function strfrom($v,$s){$p=strpos($v,$s); return $p!==false?substr($v,$p+strlen($s)):$v;}
function strnext($d,$s){return substr($d,0,nearest($d,$s));}
function split_one($s,$v,$n=''){if($n)$p=strrpos($v,$s); else $p=strpos($v,$s);
if($p!==false)return [substr($v,0,$p),substr($v,$p+1)]; else return [$v,''];}
function split_right($s,$v,$n=''){if($n)$p=strrpos($v,$s); else $p=strpos($v,$s); 
if($p!==false)return [substr($v,0,$p),substr($v,$p+1)]; else return ['',$v];}
function segment($d,$s,$e){$pa=strpos($d,$s); $ret=$d;
if($pa!==false){$pa+=strlen($s); $pb=strpos($d,$e,$pa);
	if($pb!==false)$ret=substr($d,$pa,$pb-$pa); else $ret=substr($d,$pa);} return $ret;}
function portion($d,$a,$b,$na='',$nb=''){
$pa=$na?strrpos($d,$a):strpos($d,$a); $pb=$nb?strrpos($d,$b):strpos($d,$b);
return substr($d,$pa+1,($pb-$pa-1));}
//r
function array_combine_a($a,$b){$n=count($a); $r=[];//php4
for($i=0;$i<$n;$i++)if(isset($b[$i]))$r[$a[$i]]=stripslashes($b[$i]); return $r;}
function array_combine_sub($a,$b){$rb=[];//bar_org
foreach($a as $k=>$v)if(!isset($b[$k]))$rb[$k]=$v; return $rb;}
function array_merge_b($r,$rb){
if($r && $rb)return array_merge($r,$rb); elseif($rb)return $rb; else return $r;}
function array_merge_r($a,$b){$n=count($a);
foreach($b as $k=>$v)if(!$a[$k])$a[$k]=$v; return $a;}
function array_append($r,$rb){foreach($r as $k=>$v){$vb=$rb[$k]; $n=count($vb);
for($i=0;$i<$n;$i++){$r[$k][]=$vb[$i];}} return $r;}
function array_unshift_b($r,$k,$v){$rb[$k]=$v; $rb+=$r; return $rb;}
function array_reverse_b($r,$s=''){$r=array_reverse($r,true); 
if($s)$r=array_slice($r,0,$s,true); return $r;}
function array_keys_b($r){foreach($r as $k=>$v)$rb[]=$k; return $rb;}//if($k)
function array_keys_r($r,$n,$o=''){$rb=[]; foreach($r as $k=>$v)if($v[$n]??'')$rb[$k]=$v[$n];
return $o?array_flip($rb):$rb;}
function array_col($r,$n=0){foreach($r as $k=>$v)if($v[$n])$rb[]=$v[$n]; return $rb;}
function in_array_b($d,$r){if($r)foreach($r as $k=>$v)if($v==$d)return $k;}
function in_array_p($d,$r){if($r)foreach($r as $k=>$v)if(strpos($d,$v)!==false)return 1;}
function in_array_r($r,$d,$n){if($r)foreach($r as $k=>$v)if($v[$n]==$d)return $k;}
function unset_value($r,$d){if($r)foreach($r as $k=>$v)if($v==$d)unset($r[$k]); return $r;}
function array_add_r($ra,$rb){foreach($rb as $k=>$v)
if(is_array($v))$ra[$k]=array_add_r($ra[$k],$v); else $ra[]=$v; return $ra;}
function array_walk_b($r,$func,$p1,$p2){$n=count($r);
for($i=0;$i<$n;$i++)$rb[]=call_user_func($func,$r[$i],$p1,$p2); return $rb;}
function array_part($d,$s,$n){$r=explode($s,$d); return $r[$n];}
function array_sum_r($r){$rb=[]; foreach($r as $k=>$v)$rb+=count($v); return $rb;}
function walkeach($r,$d,$p){
foreach($r as $k=>$v)$rb[]=call_user_func($d,$k,$v,$p); return $rb;}
function unset_in($r,$d,$n){if($r)foreach($r as $k=>$v)if($v[$n]==$d)unset($r[$k]);
return $r;}

function explode_r($d,$a,$b){$r=explode($a,$d);
foreach($r as $k=>$v)$rb[]=explode($b,$v); return $rb;}
function explode_k($d,$a,$b){$r=explode($a,$d); $rb=[];
foreach($r as $k=>$v){if($v){$ra=split_right($b,$v);
if(isset($ra[1]))$rb[trim($ra[0])]=trim($ra[1]);}} return $rb;}
function implode_r($r,$a,$b){$rb=[]; foreach($r as $k=>$v)if($v)$rb[]=$k.$b.implode($b,$v); 
if($rb)return implode($a,$rb);}
function implode_k($r,$a,$b){$rb=[]; foreach($r as $k=>$v)if($v)$rb[]=$k.$b.$v; 
if($rb)return implode($a,$rb);}
function implode_keys($r,$a=''){$rb=array_keys($r); if($rb)return implode($a,$rb);}

#strings
function delbr($d,$o=''){return str_replace(['<br />','<br/>','<br>'],$o,$d);}
function deln($d,$o=''){return str_replace("\n",$o,$d);}
function delr($d,$o=''){return str_replace("\r",$o,$d);}
function delnl($d){return preg_replace('/(\n){2,}/',"\n\n",$d);}
function delsp($d){return preg_replace('/( ){2,}/',' ',$d);}
function delnbsp($d){return str_replace("&nbsp;",' ',$d);}

function yesno($d){return $d?0:1;}
function rid($p,$n=6):string{return substr(md5($p),0,$n);}
function randid($p=''){return $p.substr(microtime(),2,6);}//uniqid()
function nchar($o,$n){$ret=''; for($i=0;$i<$o;$i++){$ret.=$n;}return $ret;}
function count_r($r){$n=0;
if($r)foreach($r as $k=>$v){if(is_array($v))$n+=count_r($v); else $n++;} return $n;}
function nearest($d,$s){$r=str_split($s);
foreach($r as $k=>$v)if($pos=strpos($d,$v))$ret[]=$pos;
if($ret)return min($ret); else return strlen($d);}

function xt($d,$o=0){$d=strtolower($d);
$b=strrpos($d,'.'); if($b)$d=substr($d,$b+$o);
$b=strpos($d,'?'); if($b)$d=substr($d,0,$b);
$b=strpos($d,'#'); if($b)$d=substr($d,0,$b);
$b=strpos($d,'§'); if($b)$d=substr($d,0,$b);
$b=strpos($d,' '); if($b)$d=substr($d,0,$b);
if(strlen($d)<7)return $d;}
function xtb($d,$o=0){return substr(strtolower(strrchr($d,'.')),$o);}
function is_image($d){$d=xt($d);
if(strpos($d,'.jpg')!==false or $d=='.jpg' or $d=='.png' or $d=='.gif' or $d=='.jpeg' or $d=='.webp')return 1;}
function is_http($d){if(substr($d,0,4)=='http' or substr($d,0,2)=='//')return true;}

#context
function determine_cond($cnd){
if($cnd=='home')return ['home',''];
if(is_numeric($cnd))return ['art',$cnd];
elseif($cnd=='cat' or $cnd=='art')return [$cnd,''];
elseif(substr($cnd,0,3)=='cat')return ['cat',substr($cnd,3)];
elseif($cnd!='all')return [$cnd,''];
else return ['',''];}

function define_modc_b($vl){$r=sesr('mods',$vl); $cnd=$_SESSION['cond']; $ret=[];
if($r)foreach($r as $k=>$v)if(isset($v[3])){list($ka,$kb)=determine_cond($v[3]);
if($v[3]==$cnd[0].$cnd[1] or ($ka==$cnd[0] && !$kb) or ($kb && $kb==$cnd[1]) or !$v[3])$ret[$k]=$v;}
return $ret;}
//lang
function msqlang($d){return msql_read('lang',$d,0,1);}//helps_msql is not ::col
function voc($d,$b){$r=sesmk('msqlang',$b,0); return isset($r[$d])?$r[$d]:$d;}
function setlng($p){if($p && $p!='all')return $p; $lg=$_SESSION['lng']; return $lg?$lg:prmb(25);}

#sessions
function rstr($n){return $_SESSION['rstr'][$n]?0:1;}
function auth($n){return $_SESSION['auth']>=$n?true:false;}
function prms($n){if(isset($_SESSION['prms'][$n]))return $_SESSION['prms'][$n];}
function prma($n){if(isset($_SESSION['prma'][$n]))return $_SESSION['prma'][$n];}
function prmb($n){if(isset($_SESSION['prmb'][$n]))return $_SESSION['prmb'][$n];}
function nms($d){return $_SESSION['nms'][$d]??$d;}
function nmx($r){$rb=[]; foreach($r as $k=>$v)$rb[]=nms($v); return implode(' ',$rb);}
function yesnoses($d){return $_SESSION[$d]=$_SESSION[$d]==1?0:1;}
function nbof($n,$i){if(!$n)return nms(11)."&nbsp;".nms($i); else return $n.' '.($n>1?nms($i+1):nms($i));}
function plurial($n,$i){return $n>1?nms($i+1):nms($i);}
//vars
function opt($d,$s,$n=2){$r=explode($s,$d);
for($i=0;$i<$n;$i++)$rb[]=$r[$i]??''; return $rb;}
function expl($s,$d,$n=2){$r=explode($s,$d);
for($i=0;$i<$n;$i++)$rb[]=$r[$i]??''; return $rb;}
function arr($r,$n=''){$rb=[]; $n=$n?$n:count($r); for($i=0;$i<$n;$i++)$rb[]=$r[$i]??''; return $rb;}
function val($r,$k,$o=''){return $r[$k]??$o;}
function vals($r,$ra){foreach($ra as $k=>$v)$rb[]=$r[$v]??''; return $rb;}
function valk($r,$ra){foreach($ra as $k=>$v)$rb[$v]=$r[$v]??''; return $rb;}
function valr($r,$k,$kb,$o=''){return isset($r[$k][$kb])?$r[$k][$kb]:$o;}
function get($d,$o=''){return $_GET[$d]??$o;}
function getb($d,$v=''){if($v)$_GET[$d]=$v; if(isset($_GET[$d]))return urldecode($_GET[$d]);}
function post($d,$o=''){return $_POST[$d]??$o;}
function postb($d,$v=''){if($v)$_POST[$d]=$v; if(isset($_POST[$d]))return $_POST[$d];}
function cookie($d,$v=''){if($v)setcookie($d,$v,ses('daya')+(86400*30)); return $_COOKIE[$d]??'';}
function ses($d,$v=''){if($v)$_SESSION[$d]=$v; return isset($_SESSION[$d])?$_SESSION[$d]:'';}
function sesa($d,$v){return $_SESSION[$d]=$v;}
function sesz($d){if(isset($_SESSION[$d]))unset($_SESSION[$d]);}
function sesr($d,$k,$v=''){if(!isset($_SESSION[$d]))$_SESSION[$d]=[];
if(!isset($_SESSION[$d][$k]))$_SESSION[$d][$k]='';
if($v)$_SESSION[$d][$k]=$v; return $_SESSION[$d][$k];}
function sesrr($d,$k,$v=[]){if(!isset($_SESSION[$d]))$_SESSION[$d]=[];
return $v?$_SESSION[$d][$k]=$v:($_SESSION[$d][$k]??[]);}
function sesrz($d,$k){if(array_key_exists($k,$_SESSION[$d]))unset($_SESSION[$d][$k]);}
function sesg($v,$d){$s=ses($v); $g=get($v); return $g?$g:($s?$s:$d);}
function sesif($d,$v=''){if(!isset($_SESSION[$d]))$_SESSION[$d]=$v; return $_SESSION[$d];}
function sesmk($v,$p='',$b=''){if(empty($_SESSION[$v.$p]) or $b or get('hub'))
if(function_exists($v))$_SESSION[$v.$p]=call_user_func($v,$p); return $_SESSION[$v.$p];}
function radd($r,$k,$n=1){return isset($r[$k])?$r[$k]+$n:$n;}
function vadd($r,$k,$d=1){return isset($r[$k])?$r[$k].$d:$d;}
function setpost($d,$o=''){return !isset($_POST[$d])?$_POST[$d]=$o:$_POST[$d];}
function setses($d,$o=''){return !isset($_SESSION[$d])?$_SESSION[$d]=$o:$_SESSION[$d];}

#csv
function csv2array($d){return array_map('str_getcsv',explode("\n",$d));}
function array2csv($r,$s=',',$e='"',$es='\\'){$f=fopen('php://memory','r+');
foreach($r as $k=>$v){array_unshift($v,$k); fputcsv($f,$v,$s,$e,$es);} rewind($f);
return trim(stream_get_contents($f));}

//store
class ses{static $r=[];//conn_vars
static function res($s=''){return implode($s,self::$r);}}
class sesj{static $r=[];//data-j
static function add($v){self::$r[]=$v; return count(self::$r)-1;}
static function render(){return js_code('var jr=[\''.implode('\',\'',self::$r).'\'];');}
static function read($k){return self::$r[$k];}}

#access
//function jc(){return '';}//old
function root($d=''){return (is_dir('plug')?'':'/').$d;}//used by rss
function prog(){$b=ses('dev'); return sesif('prog','prog'.$b);}
function setprog(){$b=ses('dev'); return ses('prog','prog'.$b);}
function req($d,$j=''){$r=explode(',',$d); $n=count($r); $g=root(prog());
for($i=0;$i<$n;$i++)require_once($g.'/'.$r[$i].'.php');}//once: iterative reqs
function reqp($d){$r=sesmk('scanplug','',0);//will obs
if(is_file($f='plug/'.$d.'.php')){require_once($f); return true;}
if($r)foreach($r as $v)if(is_file($f='plug/'.$v.'/'.$d.'.php')){require_once($f); return $v;}}
function https($f){return str_replace('https','http',$f);}
function http($f){return $f&&substr($f,0,4)!='http'?'http://'.$f:$f;}
function ishttp($f){return substr($f,0,4)=='http'?1:0;}
function nohttp($f){return str_replace(['http://','https://','www.'],'',$f);}
function domain($f){$f=nohttp($f); $p=strpos($f,'/'); return $p?substr($f,0,$p):$f;}//preplink
function httproot($f){$f=domain($f); $f=substr($f,0,strrpos($f,'.')); return $f;}
function findroot($u){$r=explode('/',$u); $r=array_slice($r,0,3); if($r)return implode('/',$r);}
function findnumref($d){$r=str_split($d); $ret=''; foreach($r as $v)if(is_numeric($v))$ret.=$v; return $ret;}
function utmsrc($f){
if($n=strpos($f,'?fbclid')){$nb=strpos($f,'&',$n); $e=$nb!==false?'?'.substr($f,$nb+1):''; $f=substr($f,0,$n).$e;}
return strto($f,'?utm_');}
function host(){return 'http://'.$_SERVER['HTTP_HOST'];}
function htac($d){return $_SESSION['htacc']?'/'.$d.'/':'/?'.$d.'=';}
function htacc($d){return $_SESSION['htacc']?'/':'/?'.$d.'=';}//read/id
function urlread($d){return $_SESSION['htacc']?'/'.$d:'/?read='.$d;}//read
//function urlsuj($d){return htac('read').$d;}
function philum(){$srv=prms('upservr'); return $srv?http($srv):'http://philum.fr';}
function subdomain($v){if($_SESSION['sbdm']){
$r=explode('.',$_SERVER['HTTP_HOST']); $n=count($r);
return 'http://'.$v.'.'.$r[$n-2].'.'.$r[$n-1].'/';}
else return htac('hub').$v;}
function prep_host($nod){if($_SESSION['sbdm'])return subdomain($nod);
else return host().htac('hub').$nod;}
function hostname(){$ip=isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'';
if(strstr($ip,' ')){$r=explode(' ',$ip); return $r[0];}
else return gethostbyaddr($ip);}
function mobile(){$s=isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:''; 
return stristr($s,'android') || stristr($s,'iPhone') || stristr($s,'iPad');}
function contact($t,$c){return lj($c,'popup_track___'.ses('qb'),$t?$t:picto('mail'));}

#ajax2
function bj($call,$t,$c='',$r=[]){//wait for data-jb/-prmtm/-toggle
$onc=isset($r['onclick'])?' '.$r['onclick']:''; $r['data-j']=$call; if($c)$r['class']=$c;
$r['onclick']='ajbt(this);'.$onc; //$r['onTouchStart']='ajbt(this);'.$onc;
if(ses('dev')=='b')$r['title']=radd($r,'title',$call);
return bal('a',$r,$t);}
function bjs($j){$p=explode('|',$j); if(isset($p[2]))$p[2]=_jr(explode(',',$p[2]));
return atj('ajx',implode('|',$p));}

function _jr($r){$ret=[];//tostring
if($r)foreach($r as $k=>$v)if($v)
	if(strpos($v,'=')){list($k,$v)=explode('=',$v); $ret[]=$k.'='.ajx($v);}
if($ret)return implode(',',$ret);}
function _jrb($d){$ra=['p','o','ob','oc','od'];//p1,p2...
$r=explode(',',$d); $ret=[];//mkarray
if($r)foreach($r as $k=>$v){$rb=explode(':',$v);
	if(!empty($rb[1])){
		if($rb[1]=='undefined')$ret[$ra[$k]]=ajx($rb[0],1);
		else $ret[$rb[0]]=ajx($rb[1],1);}}
return $ret;}

#ajax
function ajx($v,$p=''){#dont edit!
$r=['*','_','(star)']; $a=$p?1:0; $b=$p?0:1;
if(!$p){$a=0; $b=1; $c=2; $d=0;} else{$a=1; $b=0; $c=0; $d=2;}//§=>&#167;
$ra=[$r[$a],$r[$b],'_',"\n","\r",'\'',"'",'§','#','µ','"','+','=','€','&','.',':','/','&#8617;'];//,'[',']','@','?',"&sect",'%u',' ','<','>'
$rb=[$r[$c],$r[$d],'(und)','(nl)','(nl)','(aslash)','(quote)','(by)','(diez)','(mic)','(dquote)','(add)','(equal)','(euro)','(and)','(dot)','(ddot)','(slash)','(back)'];
//,'(hka)','(hkb)','(arob)','(qmark)','(sect)','(pu)','(space)','(htop)','(htcl)'
$ret=$p?str_replace($rb,$ra,$v):str_replace($ra,$rb,$v);
//$ret=decode_unicode($ret);
//$ret=utfb($ret);
return $ret;}

function decuri($d){$d=urldecode($d); $d=utf8_decode_b($d); return $d;}//if(ses('enc')!='utf-8'){}
function ajxg($d){//using encodeURIComponent in js, must utf8_dec
$d=$d=='memtmp'?memtmp():$d; $d=decuri($d); $d=ajx($d,1); return $d;}
function ajxr($res,$n=''){$r=explode('_',$res); $n=$n?$n:count($r);
for($i=0;$i<$n;$i++)$ret[]=isset($r[$i])?ajxg($r[$i]):''; return $ret;}
function ajxp($res,$pa,$oa){$r=ajxr($res);
return [!empty($r[0])?$r[0]:$pa,!empty($r[1])?$r[1]:$oa];}

function memtmp(){$r=$_SESSION['memtmp']??[]; $_SESSION['memtmp']=[]; 
if($r){ksort($r); return implode('',$r);}}//decuri()
/*function memtmp2(){$r=$_SESSION['mem'][$d]??[]; $_SESSION['mem'][$d]=[];
if($r){ksort($_SESSION['mem'][$d]); return implode('',$r);}*/

#actions
function loadjs($f,$d,$t=''){$v=ses('offon');
$h=hidden('','offon'.$d,$v); $t=$t?'" title="'.$t:'';
return ljb($t.'','offon',[$f,$d],offon($v),'offonbt'.$d).$h;}
function lj_tog($n,$d,$v){return toggle('',$n.$d.'_'.$n.'_'.$d,$v).btd($n.$d,'');}
function ljbub($v,$lk,$oc='',$ov='',$id='',$tg=''){$tg=$tg?atb('target','_blank'):'';
if(!rstr(102))$ov='closepbub(this,\''.$id.'\'); clbubtim(this); '.$ov;
return '<li><a'.atb('href',$lk).atd($id).atb('onclick',$oc.' closebub(this);').atb('onmouseover',$ov).$tg.'>'.$v.'</a></li>';}
function saveiec($j,$cat,$rid,$cid='',$v='',$x='',$c='',$suj=''){
$p=[$j,$cat,$rid,$cid,$x,ajx($suj)]; $h=$rid?hidden($rid,$rid,''):'';
return ljb($c,'SaveIec',$p,$v?$v:picto('download')).$h;}

#btns
function preplink($lk){$lk=nohttp($lk); $pos=strpos($lk,'/'); 
if($pos===false)$pos=strpos($lk,'.'); return substr($lk,0,$pos);}
function prepdlink($d){list($p,$o)=opt($d,'§',2);
if(!$o or $o==$p)$o=domain($p); return [$p,$o];}
function flags(){$r=msql::read('system','edition_flags_8','',1); 
foreach($r as $k=>$v)$ret[$v[2]]=$v[1]; return $ret;}
function flag($d){$r=sesmk('flags','',0); return $r[$d]??$d;}
function svg($d,$w='',$h=''){return '<img src="'.$f.'.svg" width="'.$w.'" height="'.($h?$h:$w).'" />';}
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
function imgico($f,$t='',$h=''){return '<img src="'.$f.'"'.ats('vertical-align:-'.($h?$h:4).'px; border:0;').atb('title',$t).'/>';}
function uicon($d,$p,$o=''){return $o.'/imgb/icons/'.($p?$p:'system/philum/16/').'/'.$d.'.png';}
function icon($v,$t='',$h='',$jc=''){list($d,$p)=opt($v,'§'); $f=uicon($d,$p);
return is_file($f)?imgico($jc.$f,$t,$h):$t;}
function ico($d,$t=''){list($p,$c)=explode(':',$d); if($c=='icon')return icon($p,$t); 
elseif(is_numeric($c))return icosys($p,$c); elseif($c=='svg')return svg($p);
elseif($p!==false)return picto($p); else return $t;}
function icosys($d,$s=''){$s=$s?$s:16;
return imgico('/imgb/icons/system/philum/'.$s.'/'.$d.'.png');}
function helps($d,$nd=''){$nd=$nd?$nd:'txts'; $ret=msql::val('lang','helps_'.$nd,$d);
return nl2br($ret);}//stripslashes
function hlpbt($j,$t=''){return togbub('syshelps',ajx($j),picto($t?$t:'question'),'grey');}
//ascii
function chr_b($d){return '&#'.$d.';';}
function asciinb($n){if(is_numeric($n))return chr_b(9311+$n);}
function ascii($d,$s='',$c=''){
if(is_numeric($d))return span(ats($s),chr_b($d));
if($c)$c=' '.$c; if(is_numeric($s))$s='font-size:'.$s.'px;';
return span(atc('as-'.$d.$c).ats($s),'');}
function nb($d,$o=''){$d=str_replace(['(',')','[',']'],'',$d);
if($d>20)return $o?balb('sup','('.$d.')'):balb('sup',$d.'.'); 
if($o)return "&#93".(31+$d); else return "&#93".(51+$d);}

//tags
function tri_tag($v){$r=explode(',',$v); $n=count($r);
for($i=0;$i<$n;$i++)$ret[]=trim($r[$i]); return $ret;}

#params
function decompact_conn($d){$r=split_right(':',$d,1);//p§o:c
$p=split_one('§',$r[0],1); return [$p[0],$p[1],$r[1]];}
function decompact_conn_b($d){$r=split_right(':',$d,1);//p:c§b:c2//clbasic
$p=split_right('§',$r[1]?$r[0]:$d,1); return [$p[0],$p[1],$r[1]];}
function decompact_conn_c($d){$r=split_right(':',$d,1);//p:c§b//plugbt
$p=split_right('§',$r[1]?$r[1]:$d,1); return [$r[0],$p[0],$p[1]];}
function decompact_mod($d){$r=split_right('§',$d,1);//p§o:c
$p=split_right(':',$r[0],1); return [$p[0],$p[1],$r[1]];}//po,p,c
function subparams($d){list($p,$v)=opt($d,'§',2);//1/2§3
if($v)list($x,$y)=explode('/',$p); else{$v=$p; $x=''; $y='';}
return [$v,$x,$y];}
function subparams_a($d){list($v,$p)=opt($d,'§',2);//1§2/3
list($x,$y,$p,$o,$d)=opt($p,'/',5); return [$v,$x,$y,$p,$o,$d];}
function cprm($d){$n=strrpos($d,'§'); //split_one for connectors
if($n===false)return [$d,'']; else return [substr($d,0,$n),substr($d,$n+1)];}

#plug
function plugin($d,$p='',$o='',$ob='',$res=''){reqp($d); $fc='plug_'.$d;
if(function_exists($fc))return call_user_func($fc,$p,$o,$ob,$res);}
function plugin_func($d,$fc,$p='',$o='',$res=''){reqp($d); $fc=$fc?$fc:'plug_'.$d;
if(function_exists($fc))return call_user_func($fc,$p,$o,$res);}
function appin($d,$mth,$p='',$o='',$ob=''){
if(method_exists($d,$mth))return $d::$mth($p,$o,$ob);}
function search_engine($d){return plugin_func('search','rech',$d,'10000');}
//function call_finder($p,$o){req('spe,finder'); return finder($p,$o);}

#eye
function eye($p=''){$iq=ses('iq'); $qbd=ses('qbd');
//json::add('sys','eye',[ses('dayx')=>[$iq,$_SERVER['HTTP_HOST']]]);
$pag=implode_k($_GET,'&','='); if(get('id')=='imgc/')exit;
if($_SESSION['rstr'][22] && !auth(6)){
	$_SESSION['crwl'][$iq]=radd($_SESSION['crwl'],$iq,1); if($_SESSION['crwl'][$iq]>100)exit;}
if($pag && $iq)insert('qdv','(NULL,"'.$iq.'","'.$qbd.'","'.$pag.'",NOW())');}

#utils
function exc($d){if(auth(6))shell_exec(($d));}////system//shell_exec//escapeshellcmd
function excdir(){$dr=__DIR__; $r=explode('/',$dr); return '/'.$r[1].'/'.$r[2];}
function excget($u,$f){$e='wget -P '.excdir().'/'.$u.' '.$f; exc($e);}
function scanplug(){return explore('plug','dirs',1);}
function checkupdate($n=1){return read_file2(philum().'/call/software,version/'.$n);}
function checkversion($n=1){return msql::val('system','program_version',$n);}
function secure_inputs(){if($_GET)foreach($_GET as $k=>$v){$kb=eradic_acc(utf8_decode($k)); 
	$_GET[$kb]=utf8_decode_b(urldecode($v)); if($kb!=$k)unset($_GET[$k]);}}
function cachevs($id,$n,$v,$o=''){
if(isset($_SESSION['rqt'][$id]) && is_array($_SESSION['rqt'][$id])){$_SESSION['rqt'][$id][$n]=$v;
if($o)msql::modif('',nod('cache'),$v,'val',$n,$id);}}

function genpswd($nb=8){
$v='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$^§:()[]{}°+-/*';
$r=str_split($v); $n=count($r); $ret='';
for($i=0;$i<$nb;$i++)$ret.=$r[rand(0,$n)];
return $ret;}

function alert($d){if(ses('dev'))Head::add('jscode',sj('popup_alert___'.ajx($d))); post('er',$d);}
function patch_replace($bs,$in,$wh,$repl){
$rq=sql('id',$bs,'q',$in.'="'.$wh.'"');
while($data=qrw($rq)){echo $data[0].'_'; //sqldel($bs,$data['id']);
update($bs,$in,$repl,'id',$data[0]);}}

#maths
function phi($n=32){$d=1; for($i=0;$i<$n;$i++)$d=1+(1/$d); return $d;}//dav algo :)

function ratio($r,$min,$max,$k){
$minr=min($r); $diff=max($r)-$minr; $rb=[];
foreach($r as $k=>$v)$rb[$k]=(($v-$minr)/$diff)*($max-$min)+$min;
return $rb;}

#tools
function dump($r,$o=''){$rb=[]; $i=0; if(is_array($r))foreach($r as $k=>$v){$ka='';
if(is_array($v))$va=dump($v,$o); else $va='\''.addslashes(stripslashes($v)).'\'';
if($k!=$i or $o)$ka=is_numeric($k)?$k:'\''.addslashes(stripslashes($k)).'\''; $rb[]=($ka?$ka.'=>':'').$va; $i++;}
return '['.implode(',',$rb).']';}
function cw(){$p=ses('cur_div'); return prma($p?$p:'content');}
function cwset($d){$_SESSION['cur_div']='temp'; $_SESSION['prma']['temp']=$d;}
function active($d,$n){return $d==$n?'active':'';}
function echor($r){if($r)foreach($r as $k=>$v){
$rb[]="'".$k."'=>".(is_array($v)?"['".implode("','",$v)."']":"'".$v."'");}
if($rb)return '<?php $r=['.implode(',',$rb).'];';}
function error_report($o=''){//prms('error')//ini_set("memory_limit","1512M");
ini_set('display_errors',1); error_reporting(ses('dev')=='b'?E_ALL:6135);}
function chrono($d=''){static $s; $ret=microtime(true)-($s?$s:$_SERVER['REQUEST_TIME_FLOAT']); $s=microtime(true);
if($d)return btn('txtsmall2',$d.':'.round($ret,5));}
function pr($r,$o=''){if(($o && auth(6)) or !$o)echo '<pre>'; is_object($r)?var_dump($r):print_r($r); echo '</pre>';}
function backtrace(){var_dump(debug_backtrace());}
function window($d){return div(atb('contenteditable','true').atc($c).ats('overflow:auto; height:300px;'),$d);}
function eco($d,$o=''){if(is_array($d))$d='<pre>'.print_r($d,true).'</pre>';
$ret=textarea('',htmlentities_b($d),44,12); if($o)return $ret; elseif(auth(6))echo $ret.br();}
function ecko($d){if(auth(6))echo is_array($d)?implode('-',$d):$d.br();}
function verbose($r){echo implode(br(),$r).hr();}
?>