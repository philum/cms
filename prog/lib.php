<?php 
spl_autoload_register(function($a){$dr='prog'.$_SESSION['dev'].'/'; $r=['_','a','b','c'];
for($i=0;$i<4;$i++)if(is_file($f=$dr.$r[$i].'/'.$a.'.php')){
	require($f); ses::$r['spl'][]=$r[$i].'/'.$a; return;}
$r=sesmk('scanplug','',0);
if($r)foreach($r as $v)if(is_file($f='plug/'.$v.'/'.$a.'.php')){
	require($f); ses::$r['spl'][]=$v.'/'.$a; return;}});

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
function ath($d){return $d?' href="'.$d.'"':'';}
function atn($d){return $d?' name="'.$d.'"':'';}
function atz($d){return $d?' size="'.$d.'"':'';}
function atv($d){return $d?' value="'.$d.'"':'';}
function ats($d){return $d?' style="'.$d.'"':'';}
function att($d){return $d?' title="'.$d.'"':'';}
function atk($d){return $d?' onclick="'.$d.'"':'';}
function atkp($d){return $d?' onkeyup="'.$d.'"':'';}
function atch($d){return $d?' onchange="'.$d.'"':'';}
function atmp($d){return $d?' onmouseup="'.$d.'"':'';}
function atmu($d){return $d?' onmouseout="'.$d.'"':'';}
function atmd($d){return $d?' onmousedown="'.$d.'"':'';}
function atmo($d){return $d?' onmouseover="'.$d.'"':'';}
function atj($d,$j){return $d.'(\''.$j.'\');';}
function atjr($d,$j){return $d.'('.implode_j($j).');';}
function sj($d){return $d?'SaveJ(\''.$d.'\');':'';}
function attr($r){if(!$r)return; if(is_string($r))return ' '.$r; $ret='';
if($r)foreach($r as $k=>$v)$ret.=atb($k,$v); return $ret;}
function ul($v,$c=''){return '<ul'.atc($c).'>'.$v.'</ul>';}
function li($v,$c=''){return '<li'.atc($c).'>'.$v.'</li>';}
function span($p,$v){return '<span'.$p.'>'.$v.'</span>';}
function btn($c,$v){return '<span'.atc($c).'>'.$v.'</span>';}
function btd($d,$v){return '<span'.atd($d).'>'.$v.'</span>';}
function bts($d,$v){return '<span'.ats($d).'>'.$v.'</span>';}
function div($p,$v){return '<div'.$p.'>'.$v.'</div>';}
function divc($c,$v){return '<div'.atc($c).'>'.$v.'</div>';}
function divd($d,$v){return '<div'.atd($d).'>'.$v.'</div>';}
function divs($s,$v){return '<div'.ats($s).'>'.$v.'</div>';}
function lk($u,$v='',$p=''){return '<a href="'.$u.'"'.$p.'>'.($v?$v:$u).'</a>';}
function lka($u,$v='',$p=''){return '<a href="'.$u.'"'.$p.'>'.($v?$v:domain($u)).'</a>';}
function lkc($c,$u,$v){return '<a href="'.$u.'"'.atc($c).'>'.$v.'</a>';}
function lkt($c,$u,$v,$p=''){return '<a href="'.$u.'"'.atc($c).$p.' target="_blank">'.($v?$v:$u).'</a>';}
function lkn($u,$v=''){return '<a name="'.$u.'">'.$v.'</a>';}
function lkh($oc,$ov,$v,$c=''){return '<a'.atc($c).atk($oc).atmo($ov).'>'.$v.'</a>';}
function llk($c,$u,$v){return li(lk($u,$v),$c);}
function lj($c,$j,$v,$p=''){return '<a onclick="sj(this)" data-j="'.$j.'"'.atc($c).$p.'>'.$v.'</a>';}
function lh($h,$v,$p=''){return '<a href="'.$h.'" onclick="return hj(this)"'.$p.'>'.$v.'</a>';}
//function lja($c,$j,$v){return '<a'.atk($j).atc($c).'>'.$v.'</a>';}
function ljb($c,$j,$p,$v,$o=''){$j=atjr($j,$p); return '<a'.atk($j).atc($c).$o.'>'.$v.'</a>';}
function ljh($c,$j,$p,$v,$o=''){$j=atjr($j,$p); return '<a'.atmo($j).atmu($j).atc($c).$o.'>'.$v.'</a>';}
function ljp($p,$j,$v){return '<a'.atk(sj($j)).' '.$p.'>'.$v.'</a>';}
function blj($c,$id,$j,$v,$o=''){return btd($id,lj($c,$id.'_'.$j,$v,$o));}
function llj($c,$j,$v,$id='',$a=''){return '<li'.atd($id).'>'.lj($c,$j,$v,'').'</li>';}
function image($d,$w='',$h='',$p=''){if(substr($d,0,4)=='img/')$d='/'.$d;
return '<img src="'.$d.'"'.atb('width',$w).atb('height',$h).' '.$p.'/>';}
function img($d,$s=''){return '<img src="'.$d.'"'.ats($s).' />';}
function rolloverimg($a,$b){
return taga('img',['src'=>$a,'onmouseover'=>'this.src=\''.$b.'\'','onmouseout'=>'this.src=\''.$a.'\'']);}
function etc($d,$n=400){if($d)return mb_substr($d,0,$n).(substr($d,$n)?'...':'');}
function gridpos($d){$r=explode('-',$d); return 'grid-row:'.$r[0].'; grid-column:'.$r[1].';';}
function btim($d,$w='',$h=''){$j=str_replace('_','*',$d).'_'.$w.'_'.$h; $rot=root(); $s=$rot?'':'/';
return lj('','popup_usg,overim___'.$j,img($rot.$s.$d,$w));}

//ff
function bj($c,$j,$v,$o=''){if(ses('dev')=='b')$o.=att($j);
return '<a onclick="bj(this)" data-bj="'.$j.'"'.atc($c).$o.'>'.$v.'</a>';}//
function tag($b,$p,$d){return '<'.$b.attr($p).'>'.$d.'</'.$b.'>';}
function taga($b,$p){return '<'.$b.attr($p).' />';}
function tagb($b,$d){return '<'.$b.'>'.$d.'</'.$b.'>';}
function tagc($b,$c,$v){return '<'.$b.atc($c).'>'.$v.'</'.$b.'>';}
function divb($v,$c='',$id='',$s=''){return '<div'.atc($c).atd($id).ats($s).'>'.$v.'</div>';}
function btj($t,$j,$c='',$id='',$p=[]){return tag('a',['onclick'=>$j,'class'=>$c,'id'=>$id]+$p,$t);}

#forms
function input($d,$v='',$s='',$p=[]){
if($p['type']??''){$ty=$p['type']; unset($p['type']);} else $ty='text';
return '<input'.attr(['type'=>$ty,'id'=>$d,'value'=>$v,'size'=>$s]+$p).' />';}
function inputb($d,$v,$s='',$h='',$m='',$p=[]){
$pr=['id'=>$d,'type'=>'text','value'=>$h==1?'':$v,'placeholder'=>$h==1?$v:$h,'size'=>$s,'maxlength'=>$m]+$p;
return '<input'.attr($pr).' />';}
function inputj($d,$v,$j,$h='',$s='',$p=[]){$js='checkj(this)';
$pr=['id'=>$d,'type'=>'text','value'=>$v,'placeholder'=>$h,'size'=>$s,'data-j'=>$j,'onkeyup'=>$js];
return taga('input',$p+$pr);}
function inpsw($d,$v,$s='',$p=[]){return inputb($d,$v,$s,'password','100',['type'=>'password']);}
function inpdate($id,$v,$min='',$max='',$o=''){$ty=$o?'datetime-local':'date';//time
return input($id,$v,'',['type'=>$ty,'min'=>$min,'max'=>$max]);}//step=1
function inpnb($id,$v,$min='',$max='',$st=1){
return input($id,$v,'',['type'=>'number','name'=>$id,'min'=>$min,'max'=>$max,'step'=>$st]);}
function inpclr($id,$v=''){return '<input'.attr(['type'=>'color','id'=>$id,'name'=>$id,'value'=>$v]).'>';}
function inpmail($id,$v='',$p=[]){return '<input'.attr(['type'=>'mail','id'=>$id,'value'=>$v,'size'=>'16','placeholder'=>'mail','maxlength'=>'100']+$p).'>';}
function inptel($id,$v,$pl='06-01-02-03'){$pr=attr(['type'=>'tel','id'=>$id,'name'=>$id,'value'=>$v,'placeholder'=>$pl,'pattern'=>"[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}"]);
return '<input'.$pr.' required>';}
function inprange($id,$v,$st=1,$min='',$max=''){
return input($id,$v,'',['type'=>'range','name'=>$id,'min'=>$min,'max'=>$max,'step'=>$st]);}
function bar($id,$v=50,$st=10,$min=0,$max=100,$js='jumphtml',$s='240px'){$js.='(\''.$id.'\',this.value)';
$pr=['type'=>'range','name'=>$id,'min'=>$min,'max'=>$max,'step'=>$st,'onchange'=>$js,'style'=>'width:'.$s.'; height:5px;','title'=>'use mousewheel'];
return input($id,$v,'',$pr).label($id,$v,'txtx','lbl'.$id);}
function progress($v='',$max=100,$t=''){return tag('progress',['value'=>$v,'max'=>$max],$t);}
function button($j,$v,$p=''){return tag('button',atk($j).attr($p),$v);}
function submit($n,$v,$c=''){return '<input type="submit"'.atn($n).atv($v).atc($c).' />';}
//function submitj($id,$v,$p=''){return button('document.forms[\''.$id.'\'].submit();',$v,$p);}

function hidden($d,$v){return '<input type="hidden"'.atd($d).atn($d).atv($v).'/>';}
function checkbox($n,$v,$t,$ck=''){$pr=['type'=>'checkbox','checked'=>$ck?'checked':''];
return input($n,$v,'',$pr).($t?label($n,$t,'txtsmall2').' ':'');}
function checkbox_j($id,$v,$t='',$ti='',$j=''){$h=hidden($id,$v?$v:0);
return ljb('small'.$ti,'checkbox',[$id,$t,$j],togon($v,$t),atd('bt'.$id).att($ti)).$h;}
function checkact($id,$v,$t){$h=hidden($id,$v?$v:0);
return ljb($v?'active':'','checkact',$id,$t,atd('bt'.$id)).$h;}
function label($id,$t,$c='',$ida=''){return '<label'.atb('for',$id).atc($c).atd($ida).'>'.$t.'</label>';}
function radio($n,$r,$h){$ret='';
if($r)foreach($r as $k=>$v){$ck=$v==$h?' checked="checked"':''; $id=randid('radio');
$ret.='<input type="radio"'.atn($n).atd($id).atv($v).$ck.'/>'.label($id,$v,'small').' ';}
return $ret;}
function radioj($id,$r,$n){$rid=randid(); $ret='';
foreach($r as $k=>$v)$ret.=ljb(active($k,$n),'radioj',[$rid,$id,ajx($v),$k],$v);
return span(atd($rid).atc('nbp'),$ret);}
function radiobtj($r,$vrf,$id,$o=''){$rid=randid('rdio'); if($o)$r=array_keys($r); $ret='';
if(is_array($r))foreach($r as $k=>$v){$c=active($v,$vrf);
$ret.=ljb($c,'radiobtj',[$rid,$id,ajx($v),$k],$v);}
return span(atd($rid).atc('nbp'),$ret).hidden($id,$vrf);}
function datalist($id,$r,$v,$s=16,$t='',$j=''){$ret=''; $opt=''; if($t)$ret=label($id,$t);
$p=['list'=>'dt'.$id]; if($j){$p['data-j']=$j; $p['onkeyup']='checkj(this)';}
$ret.=input($id,$v,$s,$p);
foreach($r as $k=>$v)$opt.=tag('option',['value'=>$v],'');
$ret.=tag('datalist',['id'=>'dt'.$id],$opt);
return $ret;}

//edit
function textarea($id,$v,$cl='40',$rw='4',$p=[]){
return tag('textarea',['id'=>$id,'cols'=>$cl,'rows'=>$rw]+$p,$v);}
function txarea1($msg){return '<textarea id="txtarea" name="msg" class="console" style="margin:0; width:100%; min-width:640px; min-height:240px;">'.$msg.'</textarea>';}
function diveditbt($id){
$r=['no'=>nms(72),'p'=>'normal','h1'=>'h1','h2'=>'h2','h3'=>'h3','h4'=>'h4','h5'=>'h5','fact'=>'fact'];
$ret=select(['id'=>'wygs','onchange'=>'execom2(this.value)'],$r);
$r=['increaseFontSize'=>'size','decreaseFontSize'=>'fontsize','bold'=>'bold','italic'=>'italic','underline'=>'underline','strikeThrough'=>'strike','insertUnorderedList'=>'textlist','Indent'=>'block','Outdent'=>'unblock','stabilo'=>'highlight','createLink'=>'url'];
foreach($r as $k=>$v)$ret.=btj(picto($v,16),atj('execom',$k));
//$ret.=bubble('','mc,navs','ascii','&#128578;').' ';
if(is_numeric($id))$ret.=lj('','art'.$id.'_mc,savwyg_art'.$id.'__'.$id.'_1',picto('save2',16));
return btn('nbp',$ret);}
function divarea($id,$d,$c='',$s='',$j='',$o=''){$ja='';
if($j)$ja=$o?atb('onblur',$j):atb('onkeydown',$j).atk($j);
return div(atb('contenteditable','true').atd($id).atc($c).ats($s).$ja,$d?$d:' ');}
function divedit($id,$c,$s,$j,$d){return diveditbt($id).divarea($id,$d,$c,$s,$j);}
function form($go,$d){return '<form method="post" action="'.$go.'">'.$d.'</form>';}
function goodarea($id,$v,$n=44,$o=''){$nb=round(strlen($v)/$n); $nb=$nb>10?10:$nb;
$h=ceil(strlen($v)/$n); $hb=substr_count($v,"\n")*16; if($hb>$h)$h=$hb;
return textarea($id,$v,$n,$h,['wrap'=>'false','onkeyup'=>atjr('areasize',['this'])]);}

//upload
function upload_j($id,$typ,$o=''){
if($o)$o=hidden('opt'.$id,$o);//send this val to uploadsav(id,typ,val)
return '<form id="upl'.$id.'" action="" style="display:inline-block" method="POST" onchange="upload(\''.$id.'\')" accept-charset="utf-8"><label class="uplabel btn"><input type="file" id="upfile'.$id.'" name="upfile'.$id.'" multiple />'.hidden('typ'.$id,$typ).$o.picto('upload').'</label></form>'.btd($id.'up','').btd($id.'prg','');}

//select
function select($ra,$r,$kv='',$h='',$j=''){$ret=''; $pr=[];
if(is_string($ra))$ra=['id'=>$ra];
if($j)$ra['onchange']=sj($j.'\'+this.value+\'');
if($r)foreach($r as $k=>$v){
	if($kv=='vv')$k=$v; elseif($kv=='kk')$v=$k;
	if($k==$h)$pr['selected']='selected'; else $pr=[];
	if(strlen($v)>20)$v=substr($v,0,20).'...';
	$ret.=tag('option',$pr+['value'=>$k],$v);}
return tag('select',$ra,$ret);}

#headers
function meta($d,$v,$c=''){return '<meta '.$d.'="'.$v.'"'.($c?' content="'.$c.'"':'').'/>'."\n";}
function csslink($d,$m=''){$and=get('id')?'?'.randid():'';
if($m)$m=atb('media','only screen and (max-device-width:'.$m.'px)');
return '<link href="'.$d.$and.'" rel="stylesheet"'.$m.'/>'."\n";}
function jslink($d){$and=get('id')?'?'.randid():'';
return '<script src="'.$d.$and.'"></script>'."\n";}
function csscode($d){return '<style type="text/css">'.$d.'</style>'."\n";}
function jscode($d){return '<script type="text/javascript">'.$d.'</script>'."\n";}
function temporize($name,$func,$p){$i=randid(); return 'function '.$name.$i.'(){'.$func.' setTimeout(\''.$name.$i.'()\','.$p.');} '.$name.$i.'();';}
function relod($v){echo jscode('window.location="'.$v.'"');}

class Head{static $add=[];
static function add($k,$v){self::$add[][$k]=$v;}
static function get(){$r=self::$add; return self::tags($r);}
static function html($lg='fr'){return '<!DOCTYPE html><html lang="'.$lg.'" xml:lang="'.$lg.'">';}
static function generate($lg='fr'){return self::html($lg).tagb('head',self::get());}
static function page($d,$lg){return self::generate($lg).tagb('body',$d).'</html>';}
static function tags($r){$ret='';
if($r)foreach($r as $k=>$v){if(is_array($v))$va=current($v); switch(key($v)){
case('code'):$ret.=$va."\n"; break;
case('csslink'):$ret.=csslink($va); break;
case('jslink'):$ret.=jslink($va); break;
case('csscode'):$ret.=csscode($va); break;
case('jscode'):$ret.=jscode($va); break;
case('rel'):$ret.='<link rel="'.$v['rel'][0].'" href="'.$v['rel'][1].'">'."\n"; break;
case('meta'):$ret.=meta($va[0],$va[1],$va[2]); break;
case('name'):$ret.=meta('name',$va[0],$va[1]); break;
case('tag'):$ret.=tagb($va[0],$va[1]); break;
default:$ret.=meta(key($v),$va[0],$va[1]); break;}}
return $ret;}}

function wpg($d,$t='',$lg='fr'){
return Head::html($lg).tagb('head',meta('charset',ses::$enc).tagb('title',$t)).tagb('body',$d).'</html>';}

#mysql
function qd($d){return ses('qd').'_'.$d;}
function connect(){require(boot::cnc());}
function sqlclose(){mysqli_close(sql::$qr);}
function qr($sql,$o=''){return sql::qr($sql,$o);}
function sqlsav($b,$r,$o='',$vrf=''){return sql::sav($b,$r,$o,$vrf);}
function sqlup($b,$r,$q,$o='',$vrf=''){return sql::upd($b,$r,$q,$o,$vrf);}
function sql($d,$b,$p,$q,$z=''){return sql::read($d,$b,$p,$q,$z);}
function sqb($d,$b,$p,$q,$z=''){return sql::read2($d,$b,$p,$q,$z);}

#dirs
function mkdir_r($u){$nu=explode('/',$u); if(count($nu)>10)return;
if(strpos($u,'Warning')!==false)return; $ret='';
foreach($nu as $k=>$v){$ret.=$v.'/'; if(strpos($v,'.'))$v='';
if(!is_dir($ret) && $v){if(!mkdir($ret))echo $v.':not_created ';}}}
function rmdir_r($dr){$dir=opendir($dr); if(!auth(6))return;
while($f=readdir($dir)){$drb=$dr.'/'.$f;
if(is_dir($drb) && $f!='..' && $f!='.'){rmdir_r($drb); if(is_dir($drb))rmdir($drb);}
elseif(is_file($drb)){unlink($drb); $drb.br();}} if(is_dir($dr))rmdir($dr);}

function scandir_b($d){$r=scandir($d); unset($r[0]); unset($r[1]); return $r;}
function scandir_r($d,$r=[]){$dr=opendir($d);
while($f=readdir($dr))if($f!='..' && $f!='.' && $f!='_notes'){$df=$d.'/'.$f;
	if(is_dir($df))$r=scandir_r($df,$r); else $r[]=$df;}
return $r;}

function explore($dr,$p='',$o=''){
if(!is_dir($dr))return []; $dir=opendir($dr); $rt=[];
while($f=readdir($dir))if($f!='..' && $f!='.' && $f!='_notes'){$drb=$dr.'/'.$f;
if(is_dir($drb)){
	if($p=='dirs' or $p=='all')$rt[$f]=$f;
	if(!$o)$rt[$f]=explore($drb,$p,$o);}
elseif($p=='full')$rt[]=$drb;
elseif($p!='dirs')$rt[]=$f;}//is_file($drb)
return $rt;}

function explode_dir($r,$d,$fc){static $i; $i++; $io=0; $rt=[];
if(is_array($r)){foreach($r as $k=>$v){$io++;
	if(is_array($v)){$rt[$k]=explode_dir($v,$d.'/'.$k,$fc);$i--;}
	else $rt[$k]=$fc($d,$k,$v,$i.'.'.$io);}}
return $rt;}
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
$f='_datas/csv/'.$f.'.csv'; mkdir_r($f); if(!is_file($f) or $z)writecsv($f,$r);
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
curl_setopt($c,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($c,CURLOPT_RETURNTRANSFER,1); curl_setopt($c,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($c,CURLOPT_SSL_VERIFYPEER,0); curl_setopt($c,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($c,CURLOPT_REFERER,host()); curl_setopt($c,CURLOPT_CONNECTTIMEOUT,2);
$ret=curl_exec($c); if($ret===false)$er=curl_errno($c);
curl_close($c); if(!$er)return $ret;}

#dom
function dom($d){
$dom=new DomDocument();//'2.0','UTF-8'
$dom->validateOnParse=true;
$dom->preserveWhiteSpace=true;//false
libxml_use_internal_errors(true);
if($d)$dom->loadHtml($d,LIBXML_HTML_NOIMPLIED|LIBXML_HTML_NODEFDTD);
return $dom;}

function fdom($f,$o=''){$ret=''; //if(!urlcheck($f))return 'no';
if($o==2){$dom=dom(''); $dom->loadHTML($f); return $dom;}
elseif($o){$d=get_file($f); $d=toutf8($d); if($d)return dom($d);}//ascii2utf8//utf2he//utf8dec//he2utf
else{$dom=dom(''); @$dom->loadHTMLFile($f,LIBXML_HTML_NOIMPLIED|LIBXML_HTML_NODEFDTD); return $dom;}
ecko('nothing');}

function domattr($v,$p){if($v->hasAttribute($p))return $v->getAttribute($p);}

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
case JSON_ERROR_STATE_MISMATCH:return 2; break;//'Inadéquation des modes ou underflow'
case JSON_ERROR_CTRL_CHAR:return 3; break;//'Erreur lors du contrôle des caractères'
case JSON_ERROR_SYNTAX:return 4; break;//'Erreur de syntaxe ; JSON malformé'
case JSON_ERROR_UTF8:return 5; break;//'Caractères UTF-8 malformés, erreur encodage'
default:return 6; break;}}//'Erreur inconnue'

function mkjson($r,$o=''){
$rb=utf_r($r);//,sql::$enc=='utf8'?1:0
$rt=json_encode($rb,JSON_HEX_TAG);
$e=json_error(); if($e)$rt=json_encode(array_combine(array_keys($r),array_fill(0,count($r),$e)));
return $rt;}

function utf_r($r,$o=''){$rt=[];
if($o==1 && ses::$enc=='utf-8')return $r;//devutf
if(is_array($r))foreach($r as $k=>$v){
	$k=$o?utf8dec_b($k):utf8enc($k);
	if(is_array($v))$rt[$k]=utf_r($v,$o);
	else $rt[$k]=$o?utf8dec_b($v):utf8enc($v);}
return $rt;}

#tables
function tabler($r,$head='',$keys='',$frame=''){$i=0; $td=''; $tr='';
if(is_array($head)){array_unshift($r,$head); $head=1;}
if(is_array($r))foreach($r as $k=>$v){$td=''; $i++; $tag=$i==1&&$head?'th':'td';
	if($keys)$td.=tagb($tag,$k);
	if(is_array($v))foreach($v as $ka=>$va)$td.=tagb($tag,$va);
	else $td.=tagb($tag,$k).tagb($tag,$v);
	if($td)$tr.=tagb('tr',$td);}//ats('valign','top')
$ret=tagb('table',tagb('tbody',$tr));
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

function rdiv($r){$rt=[];
foreach($r as $k=>$v)$rt[]=divb($v);
return implode('',$rt);}

//tabs
function tabs($r,$ud='',$c=''){
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
function utfenc($d){return iconv('ISO-8859-1','UTF-8',$d);}
function utfdec($d){return iconv('UTF-8','ISO-8859-1',$d);}
function utf8enc($d){return mb_convert_encoding($d,'UTF-8','ISO-8859-1');}
function utf8dec($d){return mb_convert_encoding($d,'ISO-8859-1','UTF-8');}
function utf8dec2($d){return mb_encode_numericentity($d,[0x80,0x10FFFF,0,~0],'UTF-8');}//good &
function utf8dec3($d){return mb_encode_numericentity($d,[0x0,0x2FFFF,0,0xFFFF],'UTF-8');}//all2he
function he2ascii($d){return mb_decode_numericentity($d,[0x0,0x2FFFF,0,0xFFFF],'UTF-8');}
function he2utf($d){return mb_convert_encoding($d,'UTF-8','HTML-ENTITIES');}
function utf2he($d){return mb_convert_encoding($d,'HTML-ENTITIES','UTF-8');}
function toutf8($d){$enc=detect_enc($d); return $enc=='UTF-8'?$d:mb_convert_encoding($d,'UTF-8',$enc);}
function noutf8($d){$enc=detect_enc($d); return $enc!='UTF-8'?$d:mb_convert_encoding($d,'UTF-8',$enc);}
function ascii2iso($d){htmlentities($d??''); $d=iconv('ASCII','ISO-8859-1',$d);
return html_entity_decode($d);}//mysql2utf8
function utf2ascii($d){$d=$d??''; $d=htmlentities($d,ENT_QUOTES,'UTF-8'); $d=utf8dec2($d);
return html_entity_decode($d);}//htmlspecialchars_decode//$d=ascii2iso($d);
function utf8enc_b($d){$d=$d??''; $d=he2utf($d); return html_entity_decode($d);}
function utf8dec_b($d){$d=utf2ascii($d); return $d; str::html_entity_decode_b($d);}//most used
function detect_enc($d){return mb_detect_encoding($d,'UTF-8,ISO-8859-1',true);}
function is_utf($d){return strpos($d,'Ã')||strpos($d,'â€')||strpos($d,'Ð')||strpos($d,'ã');}
function urlutf($u){return urlencode(utf8enc($u));}//str::urlenc()
function utf($d){return $d; sql::$enc=='utf8'?utf8enc($d):$d;}//devutf

#strings
function eradic_acc($d){
$a='àáâãäçèééêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ';
$b='aaaaaceeeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY';
return strtr($d,$a,$b);}
function normalize_alpha($d,$o=''){if(!$d)return;
$r=[' ','-','&nbsp;',"'",'"','/',',',';',':','§','%','&','$','#','_','+','=','!','?','\n','\r','\\','~','(',')','[',']','{','}','«','»']; if($o)unset($r[$o]); return str_replace($r,'',$d);}
function normalize_ext($d){if(!$d)return;
return str_replace(['.JPG','.JPEG','.jpeg','.GIF','.PNG'],['.jpg','.jpg','.jpg','.gif','.png'],$d);}
function normalize($d,$o=''){if(!$d)return;
$d=normalize_alpha($d,$o); $d=normalize_ext($d); $d=eradic_acc($d); return $d;}

#php
function stripslashes_b($d){return str_replace(["\'",'\"'],["'",'"'],$d);}
function subtopos($d,$a,$b){return substr($d,$a,$b-$a);}
function subtostr($d,$a,$v){return substr($d,$a,strpos($d,$v,$a)-$a);}
function split_r($d,$n){return [substr($d,0,$n),substr($d,$n)];}
function array_combine_b($ra,$rb){$na=count($ra); $nb=count($rb); $rt=[];
if($na==$nb)$rt=array_combine($ra,$rb); else er('ra:'.$na.',rb:'.$nb); return $rt;}
function array_merge_cols($r1,$r2){foreach($r1 as $k=>$v)$r1[$k]=[$v,$r2[$k]??'']; return $r1;}
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
function strin($d,$a,$b){return between($d,$a,$b,0,0,1);}
function isnum($d){return preg_replace("/[^0-9]/",'',$d);}
function str_slice($d,$n=1){$r=[]; $nb=strlen($d); $na=ceil($nb/$n);
for($i=0;$i<$na;$i++)$r[]=substr($d,$i*$n,$n); return $r;}
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
function unsetk($r,$d,$n){if($r)foreach($r as $k=>$v)if($v[$n]==$d)unset($r[$k]); return $r;}
function unsetif(&$r,$d){if(isset($r[$d]))unset($r[$d]);}
function trimr($v){$r=explode(',',$v); $n=count($r);
for($i=0;$i<$n;$i++)$rt[]=trim($r[$i]); return $rt;}

function explode_r($d,$a,$b){$r=explode($a,$d);
foreach($r as $k=>$v)$rb[]=explode($b,$v); return $rb;}
function explode_k($d,$a,$b){$r=explode($a,$d); $rb=[];
foreach($r as $k=>$v){if($v){$ra=split_right($b,$v);
if(!empty($ra[0]))$rb[$ra[0]]=$ra[1]; else $rb[]=$ra[1];}} return $rb;}
/*function implode_b($r,$a=''){$rb=[]; foreach($r as $k=>$v)
	if(is_array($v))$rb=array_merge($rb,implode_b($v)); else $rb[]=$v;
return implode($a,$rb);}*/
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
function randid($p=''){return $p.substr(microtime(),2,7);}//uniqid()
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
$b=strpos($d,'§'); if($b)$d=substr($d,0,$b);
$b=strpos($d,' '); if($b)$d=substr($d,0,$b);
if(strlen($d)<7)return $d;}
function xtb($d,$o=0){return substr(strtolower(strrchr($d??'','.')),$o);}
function is_img($d){$d=xt($d); if(!$d)return; $r=['.jpg','.png','.gif','.jpeg','.webp'];
for($i=0;$i<5;$i++)if(strpos($d,$r[$i])!==false)return $r[$i];}
function is_http($d){if(substr($d,0,4)=='http' or substr($d,0,2)=='//')return true;}

//vars
function opt($d,$s,$n=2){$r=explode($s,$d); for($i=0;$i<$n;$i++)$rb[]=$r[$i]??''; return $rb;}//old
function expl($s,$d,$n=2){$r=explode($s,$d); for($i=0;$i<$n;$i++)$rb[]=$r[$i]??''; return $rb;}
function impl($r,$s=''){return implode($s,$r);}
function arr($r,$n=''){$rb=[]; $n=$n?$n:count($r); for($i=0;$i<$n;$i++)$rb[]=$r[$i]??''; return $rb;}
function arb($r,$n=''){$rb=array_values($r); if($n)$rb=array_pad($rb,$n,''); return $rb;}
function arv($r,$ra){$rt=[]; foreach($r as $k=>$v)$rt[]=$v?$v:$ra[$k]; return $rt;}
function val($r,$k,$o=''){return $r[$k]??$o;}//obs
function vals($r,$ra){foreach($ra as $k=>$v)$rb[]=$r[$v]??''; return $rb;}
function valk($r,$ra){foreach($ra as $k=>$v)$rb[$v]=$r[$v]??''; return $rb;}
function valr($r,$k,$kb,$o=''){return $r[$k][$kb]??$o;}
function radd($r,$k,$n=1){return ($r[$k]??0)+$n;}
function vadd($r,$k,$d=1){return ($r[$k]??'').$d;}
function notnull($d){return is_null($d)?'':$d;}
function isint($d){return is_numeric($d) && $d<2147483647?$d:0;}
function isbint($d){return is_numeric($d)?$d:0;}
function is255($d){return strlen($d)>255?substr($d,0,255):($d??'');}
//function is255mb($d){return mb_strlen($d)>255?mb_substr($d,0,255):($d??'');}

//gets
function gets(){$g=$_GET; foreach($g as $k=>$v)ses::$r['get'][$k]=utf8dec(urldecode($v));}
function getsb(){$g=$_GET; foreach($g as $k=>$v)ses::$r['get'][$k]=urldecode($v);}
function get($k,$v=''){return !empty(ses::$r['get'][$k])?ses::$r['get'][$k]:ses::$r['get'][$k]=$v;}
//function get($k,$v=''){return ses::$r['get'][$k]??(ses::$r['get'][$k]=$v);}
function geta($k,$v){return ses::$r['get'][$k]=$v;}//assign
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
function sesmk2($a,$m,$p='',$b=''){if(empty($_SESSION[$a.$m.$p]) or $b)
if(method_exists($a,$m))$_SESSION[$a.$m.$p]=$a::$m($p); return $_SESSION[$a.$m.$p]??'';}
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
function hostname(){$ip=$_SERVER['REMOTE_ADDR']??'';
if(strstr($ip,' ')){$r=explode(' ',$ip); return $r[0];} else return gethostbyaddr($ip);}
function mobile(){$s=$_SERVER['HTTP_USER_AGENT']??'';
return stristr($s,'android') || stristr($s,'iPhone') || stristr($s,'iPad');}

#fileinfo
function recup_fileinfo($doc){if(is_file($doc))
return date('ymd',filemtime($doc)).'-'.round(filesize($doc)/1024).'Ko';}
function ftime($f,$d=''){if(is_file($f))return date($d?$d:'ymd.Hi',filemtime($f));}
function fsize($f,$o=''){if(is_file($f))return round(filesize($f)/1024,1).($o?' Ko':'');}
function fwidth($f){if(is_file($f))return getimagesize($f);}
function frdate($d){$r=['','janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre']; return $r[$d];}
function localdate($d){$r=explode('/',date('d/m/Y',$d)); $r[1]=frdate(intval($r[1]));
return implode(' ',$r);}
function ts2time($t){$nd=date('z',$t); $nh=date('H',$t)*60*60; $nm=date('i',$t)*60; $ns=date('s',$t);
return $nd*84600+$nh+$nm+$ns;}

#dates
function mkday($d='',$p=''){if($p==1)$p=$_SESSION['prmb'][17];
return date($p?$p:'ymd',is_numeric($d)?$d:time());}
function timeago($d){$dy=ses('daya'); $day=$dy?$dy:ses('dayx'); $m=is_numeric($d)?$d:0;
return $day-(86400*$m);}
function calctime($d){return ses('dayx')-86400*(is_numeric($d)?$d:1);}
function daysfrom($d){return round((ses('dayx')-(is_numeric($d)?$d:1))/86400);}
function mysqldate(){return date('Y-m-d H:i:s');}//%A%d%B%G%T
function timelang($lg=''){if(!$lg or $lg=='all')$lg=prmb(25); setlocale(LC_TIME,$lg.'_'.strtoupper($lg));}
function time_prev($d){$ret='';
$r=[0,7,30,90,365]; for($i=5;$i<25;$i++){$a=isset($r[$i-1])?$r[$i-1]:0; $r[]=$a+365;} $n=count($r);
for($i=0;$i<=$n;$i++)if(!empty($r[$i]) && $r[$i]<$d)$ret=$r[$i];
return $ret;}
function mkdts(){return $_SESSION['prmb'][17]??'ymd.Hi';}
function rss_date($d){return date(mkdts(),strtotime($d));}
function inpday($t){[$d,$m,$y]=explode('-',$t); return mktime(0,0,0,$m,$d,$y);}//23,59,59
function day2time($t){[$y,$m,$d]=str_slice($t,2); return mktime(0,0,0,$m,$d,$y);}
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
$sr='display:table-row;'; $sw2='width:'.$w2.'px;';
if($r)foreach($r as $k=>$v)
	$ret.=divs($sr,divb($k,'txtsmall grey','',$sc.$sw1).divs($sc.$sw2,$v?$v:'-'));
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
[$dc,$wb,$hb,$p,$o,$d]=subparams_a($d);//url§w/h
$w=$wb?$wb:$w; $h=$hb?$hb:($h?$h:'440px'); $w=$w?$w:'100%';
if(strpos($dc,'http')===false)$f='/users/'.$dc;
return tag('iframe',['src'=>$dc,'frameborder'=>'0','width'=>$w,'height'=>$h,'name'=>$p,'seamless'=>$o,'srcdoc'=>$o,'allowfullscreen'=>'true'],'');}
function obj($d,$t,$s=''){return tag('object',['data'=>$d,'type'=>$t,'style'=>$s],'');}
function audio($d,$id='',$t=''){[$f,$t]=cprm($d); $bt=btn('small',mk::download($d));
return '<audio controls><source src="'.$f.'" type="audio/mpeg"></audio>'.$bt;}
function video($d,$w='',$h='',$o=''){
[$d,$t]=cprm($d); $d=goodroot($d); $ty='type="video/'.substr(xtb($d),1).'"';
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
function imgexif($d){$r=exif_read_data($d); $rt=[]; $rb=['make','model','DateTimeOriginal','FocalLength','MaxApertureValue','ISOSpeedRatings','FocalLength','Flash'];
if($r)foreach($rb as $v)$rt[$v]=$r[$v]??'';
return $rt;}

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
if($d>20)return $o?tagb('sup','('.$d.')'):tagb('sup',$d.'.');
if($o)return "&#93".(31+$d); else return "&#93".(51+$d);}

#maths
function phi($n=32){$d=1; for($i=0;$i<$n;$i++)$d=1+(1/$d); return $d;}//dav algo :)
function ratio($r,$min,$max,$k){$minr=min($r); $diff=max($r)-$minr; $rb=[];
foreach($r as $k=>$v)$rb[$k]=(($v-$minr)/$diff)*($max-$min)+$min;
return $rb;}

#tools
function genpswd($nb=8){$v='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$^§:()[]{}°+-/*';
$r=str_split($v); $n=count($r); $ret=''; for($i=0;$i<$nb;$i++)$ret.=$r[rand(0,$n)]; return $ret;}
function exc($d){if(auth(6))return shell_exec(($d));}////system//shell_exec//escapeshellcmd
function excdir(){$dr=__DIR__; $r=explode('/',$dr); return '/'.$r[1].'/'.$r[2];}
function excget($u,$f){$e='wget -P '.excdir().'/'.$u.' '.$f; exc($e);}

//utils
function pr($r,$o=''){if(($o && auth(6)) or !$o){echo '<pre>'; print_r($r); echo '</pre>';}}
function vd($r){is_object($r)?var_dump($r):pr($r);}
function ret(...$r){return join(' ',$r);}
function backtrace(){var_dump(debug_backtrace());}
function dump($r,$o=''){$rb=[]; $i=0; if(is_array($r))foreach($r as $k=>$v){$ka='';
if(is_array($v))$va=dump($v,$o); else $va='\''.addslashes(stripslashes($v)).'\'';
if($k!=$i or $o)$ka=is_numeric($k)?$k:'\''.addslashes(stripslashes($k)).'\''; $rb[]=($ka?$ka.'=>':'').$va; $i++;}
return '['.implode(',',$rb).']';}
function ecko($d){if(auth(6))echo is_array($d)?implode('-',$d):$d.br();}
function echor($r){if($r)foreach($r as $k=>$v){
$rb[]="'".$k."'=>".(is_array($v)?echor($v):"'".$v."'");}
if($rb??[])return '['.implode(',',$rb).']';}
function chrono($d=''){static $s; $ret=microtime(true)-($s?$s:$_SERVER['REQUEST_TIME_FLOAT']); $s=microtime(true);
if($d)return btn('small',$d.':'.round($ret,5));}
function window($d){return div(atb('contenteditable','true').ats('overflow:auto; height:300px;'),$d);}
function eco($d,$o=''){if(is_array($d))$d='<pre>'.print_r($d,true).'</pre>';
$ret=textarea('',str::htmlentities_b($d),44,12); if($o)return $ret; elseif(auth(6))echo $ret.br();}
function verbose($r){echo implode(br(),$r).hr();}
function funcs(){pr(get_defined_functions());}
function trace(){pr(debug_backtrace());}
function er($d){ses::$er[]=$d;}

//debugdeclare(ticks=1); $calls=[]; register_tick_function('tracer');
function tracer(){global $calls; $calls[]=array_shift(debug_backtrace());}
?>