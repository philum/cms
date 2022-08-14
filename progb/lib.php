<?php //librairies

spl_autoload_register(function($a){$dr='prog'.$_SESSION['dev'].'/'; $r=['a','b','c'];//,'d','p','q','u'
	for($i=0;$i<3;$i++)if(is_file($f=$dr.$r[$i].'/'.$a.'.php')){require($f); ses::$r['spl'][]=$r[$i].'/'.$a; return;}
	$r=sesmk('scanplug','',0);
	if($r)foreach($r as $v)if(is_file($f='plug/'.$v.'/'.$a.'.php')){require($f); ses::$r['spl'][]=$v.'/'.$a; return;}});

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
function atch($d){return $d?' onchange="'.$d.'"':'';}
function atmp($d){return $d?' onmouseup="'.$d.'"':'';}
function atj($d,$j){return $d.'(\''.$j.'\');';}
function atjr($d,$j){return $d.'('.implode_j($j).');';}
function sj($d){return $d?'SaveJ(\''.$d.'\');':'';}
function sjt($d){return $d?'SaveJtim(\''.$d.'\');':'';}
function atbb($d){[$c,$id,$s]=opt($d,'|',3); return atc($c).atd($id).ats($s);}
function attr($r){if(!is_array($r))return ' '.$r; $ret='';
if($r)foreach($r as $k=>$v)$ret.=atb($k,$v); return $ret;}
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
function lj($c,$j,$v,$o=''){return '<a onclick="sj(this)" data-j="'.$j.'"'.atc($c).$o.'>'.$v.'</a>';}
function bj($c,$j,$v,$o=''){if(ses('dev')=='b')$o.=att($j);
return '<a onclick="bj(this)" data-bj="'.$j.'"'.atc($c).$o.'>'.$v.'</a>';}//
function lja($c,$j,$v){return '<a onclick="'.$j.'"'.atc($c).'>'.$v.'</a>';}
function ljb($c,$j,$p,$v,$id='',$o='',$a=''){if($p)$j=atjr($j,$p);
$on=$a?'onmouseover':'onclick'; if($a)$o=' onmouseout="'.$j.'"';
return '<a '.$on.'="'.$j.'"'.atc($c).atd($id).$o.'>'.$v.'</a>';}
function ljj($c,$j,$p,$v,$t=''){return '<a onclick="'.atjr($j,$p).'"'.atc($c).att($t).'>'.$v.'</a>';}
function ljp($p,$j,$v){return '<a onclick="'.sj($j).'"'.$p.'>'.$v.'</a>';}
function ljh($c,$j,$v){return '<a onclick="'.sj($j).'"'.atc($c).' onmouseover="'.atj('SaveJtim',$j).'; clbubtim(this);" onmouseout="clearTimeout(x); clearTimeout(xc);">'.$v.'</a>';}
function blj($c,$id,$j,$v,$o=''){return btd($id,lj($c,$id.'_'.$j,$v,$o));}
function llj($c,$j,$v,$id='',$a=''){return '<li'.atd($id).'>'.lj($c,$j,$v,'').'</li>';}
function image($d,$w='',$h='',$p=''){if(substr($d,0,4)=='img/')$d='/'.$d;
return '<img src="'.$d.'"'.atb('width',$w).atb('height',$h).' '.$p.'/>';}
function img($d,$s=''){return '<img src="'.$d.'"'.ats($s).' />';}
function rolloverimg($a,$b){return imgico($a.'" onmouseover="this.src=\''.$b.'\'" onmouseout="this.src=\''.$a.'\'');}
function etc($d,$n=400){if($d)return mb_substr($d,0,$n).(substr($d,$n)?'...':'');}
function gridpos($d){$r=explode('-',$d); return 'grid-row:'.$r[0].'; grid-column:'.$r[1].';';}
function btim($d,$w='',$h=''){$j=str_replace('_','*',$d).'_'.$w.'_'.$h; $rot=root(); $s=$rot?'':'/';
return lj('','popup_usg,overim___'.$j,img($rot.$s.$d,$w));}

//ff
function tag($b,$c,$d=''){return '<'.$b.attr($c).'>'.($d?$d.'</'.$b.'>':'');}//ff
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
if($d=='call' or $c)$id=($c?$c:'c').$id; $j='bubble_bubs,root__'.$id.'_'.$d.'_'.$j;
return llj('',$j,$v,'bb'.$id,$o);}//$o=ljh()
function panup($d,$j,$v,$c){$id=randid();
if($d=='call' or $c)$id=($c?$c:'c').$id; $j='panup_bubs,root__'.$id.'_'.$d.'_'.$j;
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
$ret.=span(atd($id),'').hidden('hid'.$id,htmlentities($v));
return $ret;}
function togses($v,$t){$rid=randid('bt'); $c=ses($v)?'active':'';
return btn('nbp',lj($c.'" id="'.$rid,$rid.'_tog__20_'.$v,$t));}

#forms
//redo:input,hidden,placeholder,jholder($id,$v,$s,$c='')
function input($d,$v,$p=''){return '<input type="text"'.atd($d).atv($v).$p.' />';}
function inpsw($d,$v,$p=''){return '<input type="password"'.atd($d).atv($v).$p.'/>';}
function input0($t,$d,$v,$p=''){return '<input'.atb('type',$t).atd($d).atv($v).$p.'/>';}
function input1($d,$v,$s='',$ty='',$h='',$m='',$p=[]){if(!$ty)$ty='text';
$pr=['type'=>$ty,'id'=>$d,'placeholder'=>$h==1?$v:$h,'value'=>$h==1?'':$v,'size'=>$s,'maxlength'=>$m]+$p;
return tag('input',$pr);}
function input2($n,$v,$s='',$c='',$h='',$m='',$id=''){//name
$pr=['type'=>'text','name'=>$n,'id'=>$id,$h?'placeholder':'value'=>$v,'size'=>$s,'class'=>$c,'maxlength'=>$m];
return tag('input',$pr);}
function inpdate($id,$v,$min='',$max='',$o=''){$ty=$o?'datetime-local':'date';//time
$pr=['type'=>$ty,'id'=>$id,'name'=>$id,'value'=>$v,'min'=>$min,'max'=>$max];//step=1
return tag('input',$pr);}
function inpnb($id,$v,$min='',$max='',$st=1){
$pr=['type'=>'number','id'=>$id,'name'=>$id,'value'=>$v,'min'=>$min,'max'=>$max,'step'=>$st];
return tag('input',$pr);}
function inpclr($id,$v=''){return '<input'.attr(['type'=>'color','id'=>$id,'name'=>$id,'value'=>$v]).'>';}
function inpmail($id){return '<input'.attr(['type'=>'mail','id'=>$id,'name'=>$id]).'>';}
function inptel($id,$v,$pl='06-01-02-03'){$pr=attr(['type'=>'tel','id'=>$id,'name'=>$id,'value'=>$v,'placeholder'=>$pl,'pattern'=>"[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}"]);
return '<input'.$pr.' required>';}
function inprange($id,$v,$st=1,$min='',$max=''){
$pr=['type'=>'range','id'=>$id,'name'=>$id,'value'=>$v,'min'=>$min,'max'=>$max,'step'=>$st];
return tag('input',$pr);}
function bar($id,$v=50,$st=10,$min=0,$max=100,$js='jumphtml',$s='240px'){
$js.='(\''.$id.'\',this.value)'; $pr=['type'=>'range','id'=>$id,'name'=>$id,'value'=>$v,'min'=>$min,'max'=>$max,'step'=>$st,'onchange'=>$js,'style'=>'width:'.$s.'; height:5px;','title'=>'use mousewheel'];
return tag('input',$pr).label($id,$v,'txtx','lbl'.$id);}
function progress($v='',$max=100,$t=''){return tag('progress',['value'=>$v,'max'=>$max],$t);}

function inputj($d,$v,$j,$h='',$p='',$ty='text'){if($h && !$v)$pr=atb('placeholder',$h); else $pr=atv($v);
return '<input type="'.$ty.'"'.atd($d).$pr.atb('data-j',$j).atb('onkeyup','checkj(event,this)').$p.' />';}
function submit($n,$v,$c=''){return '<input type="submit"'.atn($n).atv($v).atc($c).' />';}
function autoclic($n,$v,$sz,$mx,$c,$h='',$o=''){
if($h)$hl=jholder($v); else $hl=atb('placeholder',$v); $o.=atb('maxlength',$mx);
return '<input'.atb('type','text').atn($n).atd($n).$hl.atz($sz).atc($c).' '.$o.' />';}
function jholder($v){return atv($v).atb('onFocus','if(this.value==\''.$v.'\')this.value=\'\'').atb('onBlur','if(this.value==\'\')this.value=\''.$v.'\'');}
function hidden($d,$v){return '<input type="hidden"'.atd($d).atn($d).atv($v).'/>';}
function checkbox($n,$v,$t,$ck=''){$atr=['id'=>$n,'type'=>'checkbox','value'=>$v,'checked'=>$ck?'checked':''];
return tag('input',$atr,'',1).($t?label($n,$t,'txtsmall2').' ':'');}
function offon($d,$t=''){return pictxt($d?'true':'false',$t,'color:#'.($d?'428a4a':'853d3d').';');}
function togon($d,$t=''){return pictxt($d?'switch-on':'switch-off',$t,$d?'color:#428a4a;':'');}
function checkbox_j($id,$v,$t='',$b='',$j=''){if($b)$b='" title="'.$b; $h=hidden($id,$v?$v:0);
return ljb('small'.$b,'checkbox',[$id,$t,$j],offon($v,$t),'bt'.$id).$h.' ';}
function checkact($id,$v,$t){$c=$v?'active':'';
return ljb($c.'" id="bt'.$id,'checkact',$id,$t).hidden($id,$v?$v:0);}
function label($id,$t,$c='',$ida=''){
return '<label'.atb('for',$id).atc($c).atd($ida).'>'.$t.'</label>';}
function radio($n,$r,$h){$ret='';
if($r)foreach($r as $k=>$v){$ck=$v==$h?' checked="checked"':''; $id=randid('radio');
$ret.='<input type="radio"'.atn($n).atd($id).atv($v).$ck.'/>'.label($id,$v,'small').' ';}
return $ret;}
function radioj($id,$r,$n){$rid=randid(); $ret='';
foreach($r as $k=>$v)$ret.=ljb($k==$n?'active':'','radioj',[$rid,$id,ajx($v),$k],$v);
return span(atd($rid).atc('nbp'),$ret);}
function radiobtj($r,$vrf,$id,$o=''){$rid=randid('rdio'); if($o)$r=array_keys($r); $ret='';
if(is_array($r))foreach($r as $k=>$v){$c=$v==$vrf?'active':'';
$ret.=ljb($c,'radiobtj',[$rid,$id,ajx($v),$k],$v);}
return span(atd($rid).atc('nbp'),$ret).hidden($id,$vrf);}
function datalist($id,$r,$v,$s=16,$t='',$j=''){$ret=''; $opt=''; if($t)$ret=label($id,$t);
$p=['id'=>$id,'list'=>'dt'.$id,'size'=>$s,'value'=>$v];
if($j){$p['data-j']=$j; $p['onkeyup']='checkj(event,this)';}
$ret.=bal('input',$p,'',1);
foreach($r as $k=>$v)$opt.=bal('option',['value'=>$v],'',1);
$ret.=bal('datalist',['id'=>'dt'.$id],$opt);
return $ret;}

//edit
function textarea($id,$v,$cl='40',$rw='4',$p=''){
return '<textarea'.atn($id).atd($id).atb('cols',$cl).atb('rows',$rw).' '.$p.'>'.$v.'</textarea>';}
function txarea1($msg){return '<textarea id="txtarea" name="msg" class="console" style="margin:0; width:100%; min-width:640px; min-height:240px;">'.$msg.'</textarea>';}
function diveditbt($id){
$r=['no'=>nms(72),'p'=>'normal','h1'=>'h1','h2'=>'h2','h3'=>'h3','h4'=>'h4','h5'=>'h5','fact'=>'fact'];
$ret=select(atd('wygs').atb('onchange','execom2(this.value)'),$r);
$r=['increaseFontSize'=>'size','decreaseFontSize'=>'fontsize','bold'=>'bold','italic'=>'italic','underline'=>'underline','strikeThrough'=>'strike','insertUnorderedList'=>'textlist','Indent'=>'block','Outdent'=>'unblock','stabilo'=>'highlight','createLink'=>'url'];
foreach($r as $k=>$v)$ret.=lja('',atj('execom',$k),picto($v,16));
//$ret.=bubble('','mc,navs','ascii4','&#128578;').' ';
if(is_numeric($id))$ret.=lj('','art'.$id.'_mc,savwyg_art'.$id.'__'.$id.'_1',picto('save2',16));
return btn('nbp',$ret);}
function divarea($id,$d,$c='',$s='',$j='',$o=''){$ja='';
if($j)$ja=$o?atb('onblur',$j):atb('onkeydown',$j).atb('onclick',$j);
return div(atb('contenteditable','true').atd($id).atc($c).ats($s).$ja,$d?$d:' ');}
function divedit($id,$c,$s,$j,$d){return diveditbt($id).divarea($id,$d,$c,$s,$j);}
function form($go,$d){return '<form method="post" action="'.$go.'">'.$d."\n".'</form>';}
function goodarea($id,$v,$n=44,$o=''){$nb=round(strlen($v)/$n); $nb=$nb>10?10:$nb;
if(strlen($v)>$n or strpos($v,"\n")!==false)return textarea($id,$v,39,10,atb('wrap','false'));
else return input1($id,$v,36,'',$o,1000);}

//upload
function upload_j($id,$typ,$o=''){
if($o)$o=hidden('opt'.$id,$o);//send this val to uploadsav(id,typ,val)
//$dg=lja('',atj('opdrag',$id.'up'),picto('select'));
return '<form id="upl'.$id.'" action="" style="display:inline-block" method="POST" onchange="upload(\''.$id.'\')" accept-charset="utf-8"><label class="uplabel btn"><input type="file" id="upfile'.$id.'" name="upfile'.$id.'" multiple />'.hidden('typ'.$id,$typ).''.$o.picto('upload').'</label></form>'.btd($id.'up','').btd($id.'prg','').br();}

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

#headers
function meta($d,$v,$c=''){return '<meta '.$d.'="'.$v.'"'.($c?' content="'.$c.'"':'').'/>'."\n";}
function csslink($d,$m=''){$and=isset($_GET['id'])?'?'.randid():'';
if($m)$m=atb('media','only screen and (max-device-width:'.$m.'px)');
return '<link href="'.$d.$and.'" rel="stylesheet"'.$m.'/>'."\n";}
function jslink($d){$and=get('id')?'?'.randid():'';
return '<script src="'.$d.$and.'"></script>'."\n";}
function csscode($d){return '<style type="text/css">'.$d.'</style>'."\n";}
function jscode($d){return '<script type="text/javascript">'.$d.'</script>'."\n";}
function temporize($name,$func,$p){$i=randid(); return 'function '.$name.$i.'(){'.$func.' setTimeout(\''.$name.$i.'()\','.$p.');} '.$name.$i.'();';}
function relod($v){echo jscode('window.location="'.$v.'"');}

function header_tags($r){$ret='';
if($r)foreach($r as $k=>$v){if(is_array($v))$va=current($v); switch(key($v)){
case('code'):$ret.=$va."\n"; break;
case('csslink'):$ret.=csslink($va); break;
case('jslink'):$ret.=jslink($va); break;
case('csscode'):$ret.=csscode($va); break;
case('jscode'):$ret.=jscode($va); break;
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
function rcptb($db){if($db)return qr('show tables from `'.$db.'`');}
function setutf8(){$_SESSION['qr']->query('SET NAMES utf8');}
function setlatin(){$_SESSION['qr']->query('SET NAMES latin1');}
function lstrc($rq){$rb=[]; if($rq)while($d=qrw($rq))$rb[]=$d[0];return $rb;}
function qrr($r){return mysqli_fetch_array($r);}
function qra($r){return mysqli_fetch_assoc($r);}
function qrw($r){return mysqli_fetch_row($r);}
function qrf($r){mysqli_free_result($r);}
function qrid($sql,$o=''){qr($sql,$o); return mysqli_insert_id($_SESSION['qr']);}
function qr($sql,$o=''){$rq=$_SESSION['qr']->query($sql);//$rq=mysqli_query($_SESSION['qr'],$sql);
if($o){if(mysqli_connect_errno())pr(mysqli_connect_error()); echo($sql);} return $rq;}
function qres($v){if($v!==null)return mysqli_real_escape_string($_SESSION['qr'],stripslashes($v));}
function atm($v){$d=substr($v??'',0,4); return $d=='NULL'||$d=='NOW('||$d=='PASS'?$v:'"'.qres($v).'"';}
function atmr($r){foreach($r as $k=>$v)$ret[]=atm($v); return $ret;}
function atmrup($r){foreach($r as $k=>$v)$rt[]=$k.'='.atm($v); return $rt;}
function mysqlra($r,$o=''){$rb=atmr($r); $d=$o?'NULL,':''; if($rb)return '('.$d.implode(',',$rb).')';}
function mysqlrb($r,$o=''){foreach($r as $k=>$v)$rb[]=mysqlra($v,$o); return implode(',',$rb);}
function mysqlrup($r,$o=''){$rb=atmrup($r); if($rb)return implode(',',$rb);}
function insert($b,$d,$o=''){return qrid('insert into '.$_SESSION[$b].' values '.$d,$o);}
function update($bs,$set,$v,$col,$id,$o=''){
qr('update '.$_SESSION[$bs].' set '.$set.'="'.qres($v).'" where '.$col.'="'.$id.'"',$o);}
function sqlcols($b){return sql_b('select COLUMN_NAME,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH from INFORMATION_SCHEMA.COLUMNS where table_name="'.$_SESSION[$b].'"','rr');}
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
if($o){$n=ma::lastid($bs); if($n)resetdb($bs,$n+1);}}
function resetdb($b,$n=1){qr('alter table '.ses($b).' auto_increment='.$n);}
function tuples($b,$c){return qrw(qr('select count(*) as tuples, '.$c.' from '.$_SESSION[$b].' group by '.$c.' having count(*)>1 order by tuples desc'));}
function doublons($b,$c){$b=$_SESSION[$b];
return qrw(qr('SELECT COUNT(*) AS nbr_doublon, '.$c.' FROM '.$b.' GROUP BY '.$c.' HAVING COUNT(*)>1'));}
function killdoublons($b,$c){$b=$_SESSION[$b]; if(auth(6))
return qrw(qr('DELETE t1 FROM '.$b.' AS t1, '.$b.' AS t2 WHERE t1.id > t2.id AND t1.'.$c.' = t2.'.$c.''));}
function maintenance($k,$v,$b1,$b2){return sqb($k.','.$v,$b1,'kv','p1 left outer join '.ses($b2).' p2 on p2.id=p1.'.$k.' where p2.id is null group by '.$k,1);}//maintenance('idtag','tag','qdta','qdt');
function sqldrop($b){if(auth(6)){sqlbcp($b); qr('drop table '.ses($b));}}
function trunc($b){if(auth(6)){sqlbcp($b); qr('truncate '.ses($b)); resetdb($b);}}
function sqlex($b,$z=''){$rq=qr('show tables like "'.ses($b).'"',$z); return mysqli_num_rows($rq)>0;}
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

function sqlr($q){$ret=''; $or=0;
if(is_numeric($q))return 'id='.atm($q);
if(isset($q['_order'])){$ret.=' order by '.$q['order']; unset($q['_order']);}
if(isset($q['_group'])){$ret.=' group by '.$q['group']; unset($q['_group']);}
if(isset($q['_limit'])){$ret.=' limit '.$q['_limit']; unset($q['_limit']);}
if(isset($q['or'])){$ret=' ('.implode(' or ',atmrup($q['or'])).')'.$ret; unset($q['or']); $or=1;}
if($q)$ret=implode(' and ',atmrup($q)).($or?' and ':'').$ret;
return $ret;}

function sql($d,$b,$p,$q,$z=''){
if(is_numeric($q))$q=['id'=>$q];
if(is_array($q))$q=implode(' and ',atmrup($q));//$q=sqlr($q);
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

function sql2($d,$b,$p,$q,$z=''){if(is_numeric($q))$q=['id'=>$q];
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
if(!is_dir($dr))return 'no'; $dir=opendir($dr); $ret=[];
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
function func($d,$k,$f,$n){//dir,key,file,topology
if($f)return $d.'/'.$f; else return $d;}
//actions
function walk_dir($dr,$fc){
$r=explore($dr); return explode_dir($r,$dr,$fc?$fc:'func');}
function scanwalk($dr,$fc){$r=scandir_r($dr); $rb=[];
foreach($r as $k=>$v){$a=$fc($dr,$k,$v); if($a)$rb[]=$a;} return $rb;}

#files
function get_file($f){return curl_get_contents($f);}
function read_file($f){$fp=false; if($f)$fp=fopen($f,'r') or die('er'); $ret='';//fgets
if($fp){while(!feof($fp))$ret.=fread($fp,8192); fclose($fp);} return $ret;}
function write_file($f,$t){$h=fopen($f,'w') or die('er'); $w=false;
if($h){$w=fwrite($h,$t); fclose($h); if(!ses('localsrv'))opcache_invalidate($f);}
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
function is_mail($d){return filter_var($d,FILTER_VALIDATE_EMAIL);}
function is_url($d){return filter_var($d,FILTER_VALIDATE_URL);}
function is_hex($d){$opts=['flags'=>FILTER_FLAG_ALLOW_HEX];
return filter_var('0x'.$d,FILTER_VALIDATE_INT,$opts);}

function file_get_context($f){
ini_set('user_agent','Mozilla/5.0'); $head='User-agent: Mozilla/5.0'."\n";
$r=['http'=>['method'=>'GET','header'=>$head,'ignore_errors'=>1,'request_fulluri'=>true,'max_redirects'=>0,'follow_location'=>false]];
$context=stream_context_create($r);
if(is_url($f))return file_get_contents($f,false,$context);}

function curl_get_contents($f,$post=''){
$c=curl_init(); curl_setopt($c,CURLOPT_URL,$f); $er='';
curl_setopt($c,CURLOPT_HTTPHEADER,[]);
if($post){curl_setopt($c,CURLOPT_POST,TRUE); curl_setopt($c,CURLOPT_POSTFIELDS,$post);}
curl_setopt($c,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);//open modialisation.ca
curl_setopt($c,CURLOPT_RETURNTRANSFER,1); curl_setopt($c,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($c,CURLOPT_SSL_VERIFYPEER,0); curl_setopt($c,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($c,CURLOPT_REFERER,host()); curl_setopt($c,CURLOPT_CONNECTTIMEOUT,2);
$ret=curl_exec($c); if($ret===false)$er=curl_errno($c);
curl_close($c); if(!$er)return $ret;}

#dom
function dom($d){
$dom=new DomDocument('2.0','UTF-8');
$dom->validateOnParse=true;
$dom->preserveWhiteSpace=true;//false
libxml_use_internal_errors(true);
if($d)$dom->loadHtml($d,LIBXML_HTML_NOIMPLIED|LIBXML_HTML_NODEFDTD);
return $dom;}

function fdom($f,$o=''){$ret=''; //if(!urlcheck($f))return 'no';
if($o){$d=get_file($f); $d=ascii2utf8($d); if($d)return dom($d);}//vaccum_ses
else{$dom=dom(''); @$dom->loadHTMLFile($f,LIBXML_HTML_NOIMPLIED|LIBXML_HTML_NODEFDTD); return $dom;}
ecko('nothing');}

function domattr($v,$p){if($v->hasAttribute($p))return $v->getAttribute($p);}

//fileinfo
function recup_fileinfo($doc){if(is_file($doc))
return date('ymd',filemtime($doc)).'-'.round(filesize($doc)/1024).'Ko';}
function ftime($f,$d=''){if(is_file($f))return date($d?$d:'ymd.Hi',filemtime($f));}
function fsize($f,$o=''){if(is_file($f))return round(filesize($f)/1024,1).($o?' Ko':'');}
function fwidth($f){if(is_file($f))return getimagesize($f);}
function frdate($d){$r=['','janvier','fÈvrier','mars','avril','mai','juin','juillet','ao˚t','septembre','octobre','novembre','dÈcembre']; return $r[$d];}
function localdate($d){$r=explode('/',date('d/m/Y',$d)); $r[1]=frdate(intval($r[1]));
return implode(' ',$r);}
function ts2time($t){$nd=date('z',$t); $nh=date('H',$t)*60*60; $nm=date('i',$t)*60; $ns=date('s',$t);
return $nd*84600+$nh+$nm+$ns;}

//gz
function gz_file($f){$d=read_file($f); gz_write($f.'.gz',$d);}
function gz_write($f,$d){$gz=gzopen($f,'w9'); gzwrite($gz,$d,strlen($d)); gzclose($gz);}
function gz_write2($f,$d){file_put_contents($f.'.gz',gzencode($d,9));}
function gz_read($f,$o=0){$d=gzopen($f,'rb',$o); $ret='';
if($d)while(!gzeof($d))$ret.=gzread($d,1024); gzclose($d); return $ret;}
function ungz_read($d){return implode('',gzfile($d));}
function ungz_read2($d){return gzinflate(substr($d,10,-8));}
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
case JSON_ERROR_STATE_MISMATCH:return 2; break;//'InadÈquation des modes ou underflow'
case JSON_ERROR_CTRL_CHAR:return 3; break;//'Erreur lors du contrÙle des caractËres'
case JSON_ERROR_SYNTAX:return 4; break;//'Erreur de syntaxe ; JSON malformÈ'
case JSON_ERROR_UTF8:return 5; break;//'CaractËres UTF-8 malformÈs, erreur encodage'
default:return 6; break;}}//'Erreur inconnue'

function mkjson($r,$o=''){
//$o=$_SESSION['enc']=='utf-8'?1:0;
$rb=utf_r($r);//,$o
$ret=json_encode($rb,JSON_HEX_TAG);
$e=json_error(); if($e)$ret=json_encode(array_combine(array_keys($r),array_fill(0,count($r),$e)));
return $ret;}

function utf_r($r,$o=''){$ret=[];
if(is_array($r))foreach($r as $k=>$v){
	$k=$o?utf8_decode_b($k):utf8_encode($k);
	if(is_array($v))$ret[$k]=utf_r($v,$o);
	else $ret[$k]=$o?utf8_decode_b($v):utf8_encode($v);}
return $ret;}

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

function divtable($r,$h=''){$cr='display:table-row;'; $ret=''; $i=0;
$cc='display:table-cell; vertical-align:middle; padding:2px; '; $cs='';
if(is_array($r))foreach($r as $k=>$v){$td=''; $i++;
	if($h)$cs=$i==1?'background:rgba(255,255,255,0.4);':'';
	if(is_array($v))foreach($v as $ka=>$va)$td.=bts($cc.$cs,$va);
	if($td)$ret.=bts($cr,$td);}
return divc('small',$ret);}

function play_r($r){$ret='';
if(is_array($r))foreach($r as $k=>$v)
	if(is_array($v))$ret.=li($k).play_r($v);
	else $ret.=li($k.':'.$v);
return ul($ret);}

//tabs
function make_tabs($r,$ud='',$c=''){
if(!$r)return; $b=0; $menu=''; $divs='';
static $i; $i++; $id='tab'.$ud.'-'.$i; $ra=array_keys($r);
$ib=ses('tbmd'.$id); if(!$ib)$ib=1; $sp=btn('txtac',' ');
foreach($r as $k=>$v){$b++; if(is_array($v))$v=join('',$v);
	$dsp=$b==$ib?'block':'none'; $cs=$b==$ib?'txtaa':'txtab';
	$menu.=ljb($cs,'toggle_tab',[$id,$b],$k).$sp;
	if(is_array($v))$v=divc('list',onxcols($v,3,''));//implode(' ',$v);
	$divs.=div(atd('div'.$id.$b).ats('display:'.$dsp).atc($c),$v);}
return divb($menu,'','mnuab'.$id,'margin-bottom:4px').$divs;}

#unicode
function urlutf($u){return urlencode(utf8_encode($u));}//urlenc()
function utf($d){return $d;}//$_SESSION['enc']=='utf-8'?utf8_encode($d):
function utf8_encode_b($d){return ascii2utf8($d);}
function utf8_decode_b($d){$d=utf82ascii($d); return html_entity_decode_b($d);}
function utf82ascii($d){return html_entity_decode(mb_convert_encoding($d??'','HTML-ENTITIES','UTF-8'));}//kill euro
function ascii2utf8($d){return html_entity_decode(mb_convert_encoding($d??'','UTF-8','HTML-ENTITIES'));}
function ascii2iso($d){return html_entity_decode(mb_convert_encoding($d??'','ISO-8859-1','ASCII'));}//mysql2utf8

#strings
function eradic_acc($d){
$a='‡·‚„‰ÁËÈÈÍÎÏÌÓÔÒÚÛÙıˆ˘˙˚¸˝ˇ¿¡¬√ƒ«»… ÀÃÕŒœ—“”‘’÷Ÿ⁄€‹›';
$b='aaaaaceeeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY';
return strtr($d,$a,$b);}
function normalize_alpha($d,$o=''){if(!$d)return;
$r=[' ','-','&nbsp;',"'",'"','/',',',';',':','ß','%','&','$','#','_','+','=','!','?','\n','\r','\\','~','(',')','[',']','{','}','´','ª']; if($o)unset($r[$o]); return str_replace($r,'',$d);}
function normalize_ext($d){if(!$d)return;
return str_replace(['.JPG','.JPEG','.jpeg','.GIF','.PNG'],['.jpg','.jpg','.jpg','.gif','.png'],$d);}
function normalize($d,$o=''){if(!$d)return;
$d=normalize_alpha($d,$o); $d=normalize_ext($d); $d=eradic_acc($d); return $d;}

#php
function stripslashes_b($d){return str_replace(["\'",'\"'],["'",'"'],$d);}
function subtopos($d,$a,$b){return substr($d,$a,$b-$a);}
function subtostr($d,$a,$v){return substr($d,$a,strpos($d,$v,$a)-$a);}
function split_r($d,$n){return [substr($d,0,$n),substr($d,$n)];}
//str
function strprm($d,$n=0,$s='/'){$r=explode($s,$d??''); return $r[$n]??'';}
function strto($v,$s){$p=strpos($v??'',$s); return $p!==false?substr($v,0,$p):$v;}
function struntil($v,$s){$p=strrpos($v??'',$s); return $p!==false?substr($v,0,$p):$v;}
function strfrom($v,$s){$p=strpos($v??'',$s); return $p!==false?substr($v,$p+strlen($s)):$v;}
function strend($v,$s){$p=strrpos($v??'',$s); return $p!==false?substr($v,$p+strlen($s)):$v;}
function strnext($d,$s){return substr($d,0,nearest($d,$s));}
function split_one($s,$v,$n=''){if($n)$p=strrpos($v,$s); else $p=strpos($v,$s);
if($p!==false)return [substr($v,0,$p),substr($v,$p+1)]; else return [$v,''];}
function split_right($s,$v,$n=''){if($n)$p=strrpos($v,$s); else $p=strpos($v,$s);
if($p!==false)return [substr($v,0,$p),substr($v,$p+1)]; else return ['',$v];}
function between($d,$a,$b,$na='',$nb='',$o=''){$pa=$na?strrpos($d,$a):strpos($d,$a);
if($pa!==false){$pa+=strlen($a); $pb=$nb?strrpos($d,$b,$pa):strpos($d,$b,$pa);
	if($pb!==false)return substr($d,$pa,$pb-$pa); elseif($o)return substr($d,$pa);}}
function segment($d,$a,$b){return between($d,$a,$b,0,0,1);}
function isnum($d){return preg_replace("/[^0-9]/",'',$d);}
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
function in_array_k($d,$r){foreach($r as $k=>$v)if(isset($v[$d]))return true;}
function in_array_p($d,$r){if($r)foreach($r as $k=>$v)if(strpos($d,$v)!==false)return 1;}
function in_array_r($r,$d,$n){if($r)foreach($r as $k=>$v)if($v[$n]==$d)return $k;}
function unset_value($r,$d){if($r)foreach($r as $k=>$v)if($v==$d)unset($r[$k]); return $r;}
function array_add_r($ra,$rb){foreach($rb as $k=>$v)
if(is_array($v))$ra[$k]=array_add_r($ra[$k],$v); else $ra[]=$v; return $ra;}
function array_part($d,$s,$n){$r=explode($s,$d); return $r[$n];}
function array_sum_r($r){$rb=[]; foreach($r as $k=>$v)$rb+=count($v); return $rb;}
function array_walk_b($r,$fc,$p1,$p2){$n=count($r);
for($i=0;$i<$n;$i++)$rb[]=$fc($r[$i],$p1,$p2); return $rb;}
function walkeach($r,$fc,$p){foreach($r as $k=>$v)$rb[]=$fc($k,$v,$p); return $rb;}
function unset_in($r,$d,$n){if($r)foreach($r as $k=>$v)if($v[$n]==$d)unset($r[$k]); return $r;}
function trimr($v){$r=explode(',',$v); $n=count($r);
for($i=0;$i<$n;$i++)$ret[]=trim($r[$i]); return $ret;}

function explode_r($d,$a,$b){$r=explode($a,$d);
foreach($r as $k=>$v)$rb[]=explode($b,$v); return $rb;}
function explode_k($d,$a,$b){$r=explode($a,$d); $rb=[];
foreach($r as $k=>$v){if($v){$ra=split_right($b,$v);
if(isset($ra[1]))$rb[trim($ra[0])]=trim($ra[1]);}} return $rb;}
function implode_r($r,$a,$b){$rb=[]; foreach($r as $k=>$v)if($v)$rb[]=$k.$b.implode($b,$v);
if($rb)return implode($a,$rb);}
function implode_k($r,$a,$b){$rb=[]; foreach($r as $k=>$v)if($v)$rb[]=$k.$b.$v;
if($rb)return implode($a,$rb);}
function implode_j($d){$rb=[]; if(!is_array($d))$r[]=$d; else $r=$d;
foreach($r as $k=>$v)if($v=='this' or $v=='event')$rb[]=$v; else $rb[]='\''.$v.'\'';
if($rb)return implode(',',$rb);}
function implode_keys($r,$a=''){$rb=array_keys($r); if($rb)return implode($a,$rb);}

#filters
function delbr($d,$o=''){return str_replace(['<br />','<br/>','<br>'],$o,$d??'');}
function deln($d,$o=''){return str_replace("\n",$o,$d??'');}
function delr($d,$o=''){return str_replace("\r",$o,$d??'');}
function delnl($d){return preg_replace('/(\n){2,}/',"\n\n",$d??'');}
function delsp($d){return preg_replace('/( ){2,}/',' ',$d??'');}
function delnbsp($d){return str_replace("&nbsp;",' ',$d??'');}
function delr_r($r){foreach($r as $k=>$v)$r[$k]=delr($v); return $r;}

function yesno($d){return $d?0:1;}
function rid($p,$n=6){return substr(md5($p),2,$n);}
function randid($p=''){return $p.substr(microtime(),2,6);}//uniqid()
function nchar($o,$n){$ret=''; for($i=0;$i<$o;$i++){$ret.=$n;}return $ret;}
function count_r($r){$n=0;
if($r)foreach($r as $k=>$v){if(is_array($v))$n+=count_r($v); else $n++;} return $n;}
function nearest($d,$s){$r=str_split($s); $rt=[];
foreach($r as $k=>$v)if($pos=strpos($d,$v))$rt[]=$pos;
if($rt)return min($rt); else return strlen($d);}

function xt($d,$o=0){$d=strtolower($d??'');
$b=strrpos($d,'.'); if($b)$d=substr($d,$b+$o);
$b=strpos($d,'?'); if($b)$d=substr($d,0,$b);
$b=strpos($d,'#'); if($b)$d=substr($d,0,$b);
$b=strpos($d,'ß'); if($b)$d=substr($d,0,$b);
$b=strpos($d,' '); if($b)$d=substr($d,0,$b);
if(strlen($d)<7)return $d;}
function xtb($d,$o=0){return substr(strtolower(strrchr($d??'','.')),$o);}
function is_img($d){$d=xt($d); if(!$d)return; $r=['.jpg','.png','.gif','.jpeg','.webp'];
for($i=0;$i<5;$i++)if(strpos($d,$r[$i])!==false)return 1;}
function is_http($d){if(substr($d,0,4)=='http' or substr($d,0,2)=='//')return true;}

//vars
function opt($d,$s,$n=2){$r=explode($s,$d); for($i=0;$i<$n;$i++)$rb[]=$r[$i]??''; return $rb;}//old
function expl($s,$d,$n=2){$r=explode($s,$d); for($i=0;$i<$n;$i++)$rb[]=$r[$i]??''; return $rb;}
function impl($r,$s=''){return implode($s,$r);}
function arr($r,$n=''){$rb=[]; $n=$n?$n:count($r); for($i=0;$i<$n;$i++)$rb[]=$r[$i]??''; return $rb;}
function arb($r,$n=''){$rb=array_values($r); if($n)$rb=array_pad($rb,$n,''); return $rb;}
function ark($r){$rb=[]; foreach($r as $k=>$v)$rb[]=$v; return $rb;}
function val($r,$k,$o=''){return $r[$k]??$o;}
function vals($r,$ra){foreach($ra as $k=>$v)$rb[]=$r[$v]??''; return $rb;}
function valk($r,$ra){foreach($ra as $k=>$v)$rb[$v]=$r[$v]??''; return $rb;}
function valr($r,$k,$kb,$o=''){return isset($r[$k][$kb])?$r[$k][$kb]:$o;}
function radd($r,$k,$n=1){return isset($r[$k])?$r[$k]+$n:$n;}
function vadd($r,$k,$d=1){return isset($r[$k])?$r[$k].$d:$d;}
function notnull($d){return is_null($d)?'':$d;}
function isint($d){return is_numeric($d) && $d<2147483647?$d:0;}
function isbint($d){return is_numeric($d)?$d:0;}
function is255($d){return strlen($d)>255?substr($d,0,255):($d??'');}
//function is255mb($d){return mb_strlen($d)>255?mb_substr($d,0,255):($d??'');}

//gets
function gets(){$g=$_GET; foreach($g as $k=>$v)ses::$r['get'][$k]=utf8_decode(urldecode($v));}
function getsb(){$g=$_GET; foreach($g as $k=>$v)ses::$r['get'][$k]=urldecode($v);}
function get($k,$v=''){return !empty(ses::$r['get'][$k])?ses::$r['get'][$k]:ses::$r['get'][$k]=$v;}
function geta($k,$v=''){return $v?ses::$r['get'][$k]=$v:get($k);}//assign
function getz($k){ses::$r['get'][$k]='';}
function post($k,$v=''){return $_POST[$k]??$_POST[$k]=$v;}
function cookie($d,$v=''){if($v)setcookie($d,$v,ses('daya')+(86400*30)); return $_COOKIE[$d]??'';}
function ses($d,$v=null){if(isset($v))$_SESSION[$d]=$v; return $_SESSION[$d]??'';}//assign
function sesb($k,$v=''){return ses::$r['get'][$k]??ses::$r['get'][$k]=$v;}
function sesz($d){if(isset($_SESSION[$d]))unset($_SESSION[$d]);}
function sesr($d,$k,$v=''){if(!isset($_SESSION[$d]))$_SESSION[$d]=[];
if(!isset($_SESSION[$d][$k]))$_SESSION[$d][$k]='';
if($v)$_SESSION[$d][$k]=$v; return $_SESSION[$d][$k];}
function sesrr($d,$k,$v=[]){if(!isset($_SESSION[$d]))$_SESSION[$d]=[];
return $v?$_SESSION[$d][$k]=$v:($_SESSION[$d][$k]??[]);}
function sesrz($d,$k){if(array_key_exists($k,$_SESSION[$d]))unset($_SESSION[$d][$k]);}
function sesg($v,$d){$s=ses($v); $g=get($v); return $g?$g:($s?$s:$d);}
function sesif($d,$v=''){if(!isset($_SESSION[$d]))$_SESSION[$d]=$v; return $_SESSION[$d];}
function sesmk($v,$p='',$b=''){if(!isset($_SESSION[$v.$p]) or $b)
if(function_exists($v))$_SESSION[$v.$p]=call_user_func($v,$p); return $_SESSION[$v.$p]??'';}
function sesmk2($a,$m,$p='',$b=''){if(empty($_SESSION[$a.$m]) or $b)
if(method_exists($a,$m))$_SESSION[$a.$m]=$a::$m($p); return $_SESSION[$a.$m]??'';}
function setses($d,$o=''){return !isset($_SESSION[$d])?$_SESSION[$d]=$o:$_SESSION[$d];}

#csv
function csv2array($d){return array_map('str_getcsv',explode("\n",$d));}
function array2csv($r,$s=',',$e='"',$es='\\'){$f=fopen('php://memory','r+');
foreach($r as $k=>$v){array_unshift($v,$k); fputcsv($f,$v,$s,$e,$es);} rewind($f);
return trim(stream_get_contents($f));}

#access
function https($f){return str_replace('http:','https:',$f);}
function nohttps($f){return str_replace('https','http',$f);}
function http($f){return $f&&substr($f,0,4)!='http'?'http://'.$f:$f;}
function ishttp($f){return substr($f,0,4)=='http'?1:0;}
function nohttp($f){if($f)return str_replace(['http://','https://','www.'],'',$f);}
function domain($f){$f=nohttp($f); $p=strpos($f??'','/'); return $p?substr($f,0,$p):$f;}//preplink
function httproot($f){$f=domain($f); $f=substr($f,0,strrpos($f,'.')); return $f;}
function findroot($u){$r=explode('/',$u); $r=array_slice($r,0,3); if($r)return implode('/',$r);}
function utmsrc($f){if(!$f)return;
if($n=strpos($f,'?fbclid')){$nb=strpos($f,'&',$n); $e=$nb!==false?'?'.substr($f,$nb+1):''; $f=substr($f,0,$n).$e;}
return strto($f,'?utm_');}
function host(){return 'http://'.$_SERVER['HTTP_HOST'];}
function hostname(){$ip=isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'';
if(strstr($ip,' ')){$r=explode(' ',$ip); return $r[0];} else return gethostbyaddr($ip);}
function mobile(){$s=isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'';
return stristr($s,'android') || stristr($s,'iPhone') || stristr($s,'iPad');}

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
function dayref($cbl){[$d,$m,$y]=explode('-',$cbl); return mktime(0,0,0,$m,$d,$y);}//23,59,59
function time_ago($dt){$dy=time()-$dt; if($dy<86400){$fuseau=3;
$h=intval(date('H',$dy))-$fuseau; $i=intval(date('i',$dy)); $s=intval(date('s',$dy));
$nbh=$h>1?$h.' h ':''; $nbi=$i>0?$i.' min ':''; return $nbh.$nbi;} else return date(mkdts(),$dt);}
function clean_nb($d,$o=0){return number_format($d,$o,',',' ');}

function elapsed_time($d1,$d2=''){$rt=[]; if(!$d2)$d2=time();
$t1=new DateTime(); $t2=new DateTime(); $t1->setTimestamp($d1); $t2->setTimestamp($d2);
$diff=$t1->diff($t2); $n=$diff->format('%d');
$ra=$n>0?['year','month','day']:['hour','minute','second'];
$ty=$n>0?'%y-%m-%d':'%h-%i-%s'; $res=$diff->format($ty); $rb=explode('-',$res);
foreach($rb as $k=>$v)if($v)$rt[]=$v.' '.$ra[$k].($v>1?'s':'');
return implode(', ',$rt);}

#builders
function scroll($r,$d,$max=10,$w='',$h='',$id=''){$h=is_numeric($h)?$h.'px':$h;
$n=is_array($r)?count($r):$r; $wa=$w?' width:'.$w.'px;':'';
$s=ats('overflow:auto; scrollbar-width:thin;'.$wa.' min-width:140px; max-height:'.($h?$h:'420px').';');
if($n>$max or !$n)return div(atd('scrll'.$id).$s,$d); else return $d;}

function on2cols($r,$w,$p){$w1=round($w/$p); $w2=round($w-$w1); $ret='';
$sc='display:table-cell; '; $sw1='width:'.$w1.'px;';
$sr='display:table-row;'; $sw2='min-width:'.$w2.'px;';
if($r)foreach($r as $k=>$v)
	$ret.=divs($sr,divb($k,'txtsmall','',$sc.$sw1).divs($sc.$sw2,$v?$v:'-'));
return divs('display:table;',$ret);}

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

#medias
function iframe($d,$w='',$h=''){
[$dc,$wb,$hb,$p,$o,$d]=subparams_a($d);//urlßw/h
$w=$wb?$wb:$w; $h=$hb?$hb:($h?$h:'440px'); $w=$w?$w:'100%';
if(strpos($dc,'http')===false)$f='/users/'.$dc;
$prm=atb('width',$w).atb('height',$h).atn($p).atb('seamless',$o).atb('srcdoc',$o);
return bal('iframe','src="'.$dc.'" frameborder="0"'.$prm.' allowfullscreen ','');}
function obj($d,$t,$s=''){return bal('object',atb('data',$d).atb('type',$t).ats($s).' ','');}
function audio($d,$id='',$t=''){[$f,$t]=cprm($d); $bt=btn('small',mk::download($d));
return '<audio controls><source src="'.$f.'" type="audio/mpeg"></audio>'.$bt;}
function video($d,$w='',$h='',$o=''){
[$d,$t]=opt($d,'ß'); $d=goodroot($d); $ty='type="video/'.substr(xtb($d),1).'"';
if($t)return lj('','popup_usg,video___'.ajx($d),pictxt('movie',$t!=1?$t:strend($d,'/')));
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
return [round($w),round($h),round($wo),round($ho),round($xb),round($yb)];}

function make_mini($in,$out,$w,$h,$s){
if(!is_file($in) && substr($in,0,4)!='http')return;
$w=$w?$w:140; $h=$h?$h:100; [$wo,$ho,$ty]=getimagesize($in); $xa=0; $ya=0;
[$w,$h,$wo,$ho,$xb,$yb]=scale_img($w,$h,$wo,$ho,$s);
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
if($v>0){$m=''; $sv=''; $sextant=''; $fract=''; $vsf=''; $mid1=''; $mid2='';
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

#maths
function phi($n=32){$d=1; for($i=0;$i<$n;$i++)$d=1+(1/$d); return $d;}//dav algo :)
function ratio($r,$min,$max,$k){$minr=min($r); $diff=max($r)-$minr; $rb=[];
foreach($r as $k=>$v)$rb[$k]=(($v-$minr)/$diff)*($max-$min)+$min;
return $rb;}

#tools
function genpswd($nb=8){$v='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$^ß:()[]{}∞+-/*';
$r=str_split($v); $n=count($r); $ret=''; for($i=0;$i<$nb;$i++)$ret.=$r[rand(0,$n)]; return $ret;}
function exc($d){if(auth(6))return shell_exec(($d));}////system//shell_exec//escapeshellcmd
function excdir(){$dr=__DIR__; $r=explode('/',$dr); return '/'.$r[1].'/'.$r[2];}
function excget($u,$f){$e='wget -P '.excdir().'/'.$u.' '.$f; exc($e);}

//utils
function pr($r,$o=''){if(($o && auth(6)) or !$o){echo '<pre>'; print_r($r); echo '</pre>';}}
function vd($r){is_object($r)?var_dump($r):pr($r);}
function backtrace(){var_dump(debug_backtrace());}
function dump($r,$o=''){$rb=[]; $i=0; if(is_array($r))foreach($r as $k=>$v){$ka='';
if(is_array($v))$va=dump($v,$o); else $va='\''.addslashes(stripslashes($v)).'\'';
if($k!=$i or $o)$ka=is_numeric($k)?$k:'\''.addslashes(stripslashes($k)).'\''; $rb[]=($ka?$ka.'=>':'').$va; $i++;}
return '['.implode(',',$rb).']';}
function ecko($d){if(auth(6))echo is_array($d)?implode('-',$d):$d.br();}
function echor($r){if($r)foreach($r as $k=>$v){
$rb[]="'".$k."'=>".(is_array($v)?"['".implode("','",$v)."']":"'".$v."'");}
if($rb)return '<?php $r=['.implode(',',$rb).'];';}
function chrono($d=''){static $s; $ret=microtime(true)-($s?$s:$_SERVER['REQUEST_TIME_FLOAT']); $s=microtime(true);
if($d)return btn('small',$d.':'.round($ret,5));}
function window($d){return div(atb('contenteditable','true').ats('overflow:auto; height:300px;'),$d);}
function eco($d,$o=''){if(is_array($d))$d='<pre>'.print_r($d,true).'</pre>';
$ret=textarea('',htmlentities_b($d),44,12); if($o)return $ret; elseif(auth(6))echo $ret.br();}
function verbose($r){echo implode(br(),$r).hr();}
?>