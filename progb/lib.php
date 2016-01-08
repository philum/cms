<?php
//philum_librairies 

#html
function p($r){print_r($r);}
function br(){return "<br />";}
function hr(){return "<hr />";}
function sep(){return '&nbsp;';}
function atb($d,$v){return $v?' '.$d.'="'.$v.'"':'';}
function atc($d){return $d?' class="'.$d.'"':'';}
function atd($d){return $d?' id="'.$d.'"':'';}
function ats($d){return $d?' style="'.$d.'"':'';}
function atn($d){return $d?' name="'.$d.'"':'';}
function atv($d){return $d?' value="'.$d.'"':'';}
function atz($d){return $d?' size="'.$d.'"':'';}
function att($d){return $d?' title="'.$d.'"':'';}
function atj($d,$j){return $d.'(\''.$j.'\')';}
function atjb($r){return implode('\',\'',$r);}
function sj($d){return $d?'SaveJ(\''.$d.'\');':'';}
function atbb($d){$r=explode('|',$d); return atc($r[0]).atd($r[1]).ats($r[2]);}
function atr($r){foreach($r as $k=>$v)$ret.=atb($k,$v); return $ret;}
function ul($v){return '<ul>'.$v.'</ul>';}
function li($v){return '<li>'.$v.'</li>';}
function bal($b,$v){return '<'.$b.'>'.$v.'</'.$b.'>';}
function balc($b,$c,$v){return '<'.$b.atc($c).'>'.$v.'</'.$b.'>';}
function balb($b,$p,$v){return '<'.$b.($p?' '.$p:'').'>'.$v.'</'.$b.'>';}
function balise($b,$r,$v){return '<'.$b.attr($r).'>'.$v.'</'.$b.'>';}
function span($p,$v){return '<span'.$p.'>'.$v.'</span>';}
function btn($c,$v){return $c?'<span class="'.$c.'">'.$v.'</span>':$v;}
function btd($d,$v){return $d?'<span id="'.$d.'">'.$v.'</span>':$v;}
function bts($d,$v){return $d?'<span style="'.$d.'">'.$v.'</span>':$v;}
function div($p,$v){return '<div '.$p.'>'.$v.'</div>';}
function divr($p,$v){return '<div'.attr($p).'>'.$v.'</div>';}
function divb($p,$v){return '<div'.atbb($p).'>'.$v.'</div>';}
function divc($c,$v){return '<div'.atc($c).'>'.$v.'</div>';}
function divd($d,$v){return '<div'.atd($d).'>'.$v.'</div>';}
function divs($s,$v){return '<div'.ats($s).'>'.$v.'</div>';}
function button($c,$j,$v){return balb('button',atc($c).atb('onclick',$j),$v);}
function lk($l,$p,$v){return '<a href="'.$l.'"'.$p.'>'.$v.'</a>';}
function lka($l,$v=''){return '<a href="'.$l.'">'.($v?$v:strrchr_b($l,'/')).'</a>';}
function lkc($c,$l,$v){return '<a href="'.$l.'"'.atc($c).'>'.$v.'</a>';}
function lkt($c,$l,$v){return '<a href="'.$l.'"'.atc($c).' target="_blank">'.$v.'</a>';}
function lkh($oc,$ov,$v,$c=''){
return '<a'.atc($c).atb('onclick',$oc).atb('onmouseover',$ov).'>'.$v.'</a>';}
function llk($c,$l,$v){return balc("li",$c,lka($l,$v));}
function submitj($c,$id,$v){return button($c,'document.forms[\''.$id.'\'].submit();',$v);}
function lj($c,$j,$v,$o=''){if($o)return ljh($c,$j,$v);
return '<a onclick="'.atj('SaveJ',$j).'"'.atc($c).$o.'>'.$v.'</a>';}
function lja($c,$j,$v){return '<a onclick="'.$j.'"'.atc($c).'>'.$v.'</a>';}
function ljb($c,$p,$j,$v,$a=''){$on=$a?'onmouseover':'onclick';
return '<a '.$on.'="'.atj($p,$j).'"'.atc($c).'>'.$v.'</a>';}
function ljc($c,$d,$j,$v,$o='',$p=''){return lj($c,$d.'_call'.$p.'__'.($o?$o:3).'_'.$j,$v);}
function ljh($c,$j,$v){return '<a onclick="'.sj($j).'"'.atc($c).' onmouseover="'.atj('SaveJtim',$j).'; clbubtim(this);" onmouseout="clearTimeout(x); clearTimeout(xc);">'.$v.'</a>';}
function blj($c,$id,$j,$v){return btd($id,lj($c,$id.'_'.$j,$v));}
function llj($c,$j,$v,$id='',$a=''){return '<li'.atd($id).'>'.lj($c,$j,$v,$a).'</li>';}
function image($d,$w='',$h='',$p=''){
return '<img id="rez" src="'.$d.'"'.atb('width',$w).atb('height',$h).' '.$p.'/>';}
function img($d){return '<img id="rez" src="'.$d.'" style="max-width:100%;" />';}
function rolloverimg($a,$b){return imgico($a.'" onmouseover="this.src=\''.$b.'\'" onmouseout="this.src=\''.$a.'\'');}
function etc($d,$n){return substr($d,0,$n).(substr($d,$n)?'...':'');}
function asciinb($n){return '&#'.(9311+$n).';';}

//atb
function attr($r){if(!is_array($r))return $r;
$ra=array(1=>'type',2=>'name',3=>'id',4=>'value',5=>'class',6=>'size',7=>'maxlength',8=>'onKeyPress',9=>'cols',10=>'rows',11=>'wrap',12=>'action',13=>'method',14=>'for',15=>'onchange',16=>'style',17=>'onclick',18=>'onmouseover',19=>'onmouseout',20=>'onblur',21=>'onkeyup',22=>'ondblclick',23=>'placeholder');
foreach($r as $k=>$v)$ret[]=atb($ra[$k]?$ra[$k]:$k,$v); return implode('',$ret);}

#action_j
function toggle($c,$j,$v,$n=''){static $i; $i++; if($n=='x')$i=0;
$cl=$c.'" id="'.strdeb($j,'_').'bt'.$i;
return ljb($cl,'tog_j',$j.'\',\'bt'.$i.'\',\''.$n,$v);}
function bubble($c,$ja,$j,$v){$id=randid();//rename
return lj($c.'" id="bt'.$id,'popup_'.$ja.'__'.$id.'_'.$j,$v);}
function popbub($d,$j,$v,$c='',$o=''){$id=randid();//apps+dir or call+predir//j=pre-rendered
if($d=='call' or $c)$id=($c?$c:'c').$id; $j='bubble_popbub__'.$id.'_'.$d.'_'.$j;
return llj('',$j,$v,'bb'.$id,$o);}
function togbub($ja,$j,$v,$c='',$o=''){$id=randid();
return span(atd('bt'.$id).atc($c),ljb('','toggle_bub',$ja.'__'.$id.'_'.$j,$v,$o));}//.'_1'
function togses($v,$t){$rid='bt'.randid(); $c=ses($v)?'active':'';
return btn('nbp',lj($c.'" id="'.$rid,$rid.'_tog__20_'.$v,$t));}
function togses_j($d,$t){$id='oo'.randid(); $v=ses($d);//unused
return lj('',$id.'_togses___'.$d,btd($id,offon($v)).$t);}

#forms
function input($t,$d,$v,$c='',$h='',$sz=''){//id_only
	if($t===0)$t='hidden'; elseif($t==1)$t='text'; elseif($t==2)$t='button';
	if($h)$atr=atb('placeholder',$v); else $atr=atv($v); if($sz)$atr.=atb('size',$sz);
	return '<input'.atb('type',$t).atd($d).atc($c).$atr.'/>';}
function input1($d,$v,$sz='',$c=''){//id_only
	return '<input'.atb('type','text').atd($d).atv($v).atb('size',$sz).atc($c).'/>';}
function input2($t,$n,$v,$c=''){if($t==1)$t='text';//name_only
	return '<input type="'.$t.'"'.atb('name',$n).atv($v).atc($c).atb('size',strlen($v)).' />';}
function autoclic($n,$v,$sz,$mx,$c,$h=''){
	if($h)$hl=jholder($v); else $hl=atb('placeholder',$v);
	return '<input'.atb('type','text').atb('name',$n).atd($n).$hl.atb('size',$sz).atb('maxlength',$mx).atc($c).' />';}
function jholder($v){return atv($v).atb('onFocus','if(this.value==\''.$v.'\')this.value=\'\'').atb('onBlur','if(this.value==\'\')this.value=\''.$v.'\'');}
function hidden($n,$d,$v){return '<input type="hidden"'.atb('name',$n).atd($d).atv($v).'/>';}
function checkbox($n,$v,$t,$chk){if($chk==1)$ck.=' checked="checked"'; 
	if($t)$label=label($n,'txtsmall2','',$t).' '; return balb('input',atb('type','checkbox').atb('name',$n).atd($n).atv($v).$ck,'').$label;}
function offon($d){return picto($d?'true':'false','color:#'.($d?'428a4a':'853d3d').';');}
function checkbox_j($id,$v,$t='',$b='',$c=''){
	if($t)$t=btn('small',$t); if($b)$b='" title="'.$b;
	return ljb($c.$b.'" id="bt'.$id,'checkbox',$id,offon($v)).$t.hidden($id,$id,$v?$v:0);}
function checkbob($id,$v,$a,$b){$j=$id.'|'.$a.'|'.$b; $t=$v?$b:$a;//unused
	return ljb('popbt" id="bt'.$id,'checkbob',$j,$t).hidden('',$id,$v?$v:0);}
function checkact($id,$v,$t){$c=$v?'popw':'popbt';
	return ljb($c.'" id="bt'.$id,'checkact',$id,$t).hidden('',$id,$v?$v:0);}
function label($id,$c,$s,$t){
	return '<label'.atb('for',$id).atc($c).ats($s).'>'.$t.'</label>';}
function radiobtn($r,$h,$n){if($r)foreach($r as $k=>$v){$ck=$v==$h?' checked="checked"':'';
	$ret.='<input type="radio"'.atd($n).atv($v).$ck.'/>'.btn('txtsmall2',$v).' ';} return $ret;}
function radiobtj($r,$vrf,$id,$o=''){$rid='rdio'.randid(); if($o)$r=array_keys($r);
if(is_array($r))foreach($r as $k=>$v){$c=$v==$vrf?'active':'';
	$ret.=ljb($c,'radioj',$rid.'\',\''.$id.'\',\''.ajx($v).'\',\''.$k,$v);}
return span(atd($rid).atc('nbp'),$ret).hidden($id,$id,$vrf);}
function txarea($n,$d,$cl,$rw,$c=''){return '<textarea name="'.$n.'" id="'.$n.'" cols="'.$cl.'" rows="'.$rw.'" class="'.$c.'">'.$d.'</textarea>';}
function txareac_btns(){$r=array('bold'=>picto('b'),'italic'=>picto('i'),'underline'=>picto('u'),'insertUnorderedList'=>picto('list'),'Indent'=>picto('block'),'Outdent'=>picto('unblock')); 
foreach($r as $k=>$v)$ret.=button('','document.execCommand(\''.$k.'\',false,null);',$v).'';
return divc('',$ret);}
function txareac($id,$c,$s,$j,$d){return div(atb('contenteditable','true').atd($id).atc($c).ats($s).atb('onkeydown',$j).atb('onclick',$j),' '.$d);}
function divedit($id,$c,$s,$j,$d){return txareac_btns().txareac($id,$c,$s,$j,$d);}
function txarea1($msg){return '<textarea id="txtarea" name="msg" class="console" style="margin:0; width:100%; height:300px;" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyDown="storeCaret(this);">'.$msg.'</textarea>';}
function form($go,$d){return '<form method="post" action="'.$go.'">'.$d."\n".'</form>';}
function goodarea($v,$id,$css,$j,$n){$nb=round(strlen($v)/70); $nb=$nb>20?20:$nb;
if(strlen($v)>$n or strpos($v,"\n")!==false)return balise('textarea',array(2=>$id,3=>$id,5=>$css,9=>($n-4),10=>$nb,11=>'false',22=>$jv),$v); else return balise('input',array(1=>'text',2=>$id,3=>$id,4=>$v,5=>$css,6=>$n,7=>1000,8=>$j),'');}
function goodarea_b($v,$id,$c,$j,$n,$h){$s=ceil(strlen($v)/$n); if($s>5)$s=5;
$c='" style="height:'.(($s?$s:1)*$h).'px;" onkeyup="goodheight(this,'.($n).','.$h.');';
if($j)$c.='" onclick="'.$j; return txarea($id,$v,$n,'1',$c);}
function imgform($here,$d,$t=''){$t=$t?'" title="'.$t:'';
return '<form name="form1" method="post" action="'.$here.'&im=on" enctype="multipart/form-data"><input name="fichier" type="file" class="txtsmall" size="1" border="0" />'.input('submit','Submit'.$t,'',nms(28)).'</form>';}// '.$d.'
function upload($d,$p){return plugin('upload',$d,$p);}//dir,mode
function upload_btn($id,$j,$t){return blj('txtx',$id,'upload___'.$j,$t);}

function select($atr,$r,$kv,$h=''){
if($r)foreach($r as $k=>$v){
	if($kv=='vv')$k=$v; elseif($kv=='kk')$v=$k;
	if($k==$h)$chk=atb('selected','selected'); else $chk='';
	if(strlen($v)>20)$v=substr($v,0,20).'...';
	$ret.=balise('option',atv($k).$chk,$v);}
return balise('select',$atr,$ret);}

#headers
function header_html(){return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html lang="fr" xml:lang="fr">';}
function meta($d,$v,$c=''){return '<meta '.$d.'="'.$v.'"'.($c?' content="'.$c.'"':'').'>'."\n";}
function css_link($d,$m=''){$and=@$_GET['id']?'?'.randid():'';
if($m)$m=atb('media','only screen and (max-device-width:'.$m.'px)"');
return '<link href="'.$d.$and.'" rel="stylesheet"'.$m.'>'."\n";}
function js_link($d){$and=($_GET['id']?'?'.randid():'');
return '<script src="'.$d.$and.'"></script>'."\n";}
function css_code($d){return '<style type="text/css">'.$d.'</style>'."\n";}
function js_code($d){return '<script type="text/javascript">'.$d.'</script>'."\n";}
function temporize($name,$func,$p){$i=randid(); return js_code('function '.$name.$i.'(){'.$func.' setTimeout(\''.$name.$i.'()\','.$p.');} '.$name.$i.'();');} 
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
case('tag'):$ret.=bal($va[0],$va[1]); break;
default:$ret.=meta(key($v),$va[0],$va[1]); break;}}
return $ret;}

class Head{static $add;
public static function add($k,$v){self::$add[][$k]=$v;}
public static function get(){$r=self::$add; return header_tags($r);}
public static function generate(){return header_html().bal('head',self::get());}}

#mysql
function connect(){require('params/_connectx.php');}
function rcptb($db){if($db)return mysql_query('SHOW TABLES FROM `'.$db.'`');}
function lstrc($rq){if($rq)while($d=mysql_fetch_row($rq))$qp[]=$d[0];return $qp;}
//function qw($p,$b){return 'select '.$p.' from '.$_SESSION[$b];}
function qrr($r){if($r)return mysql_fetch_array($r);}
function qra($r){if($r)return mysql_fetch_assoc($r);}
function qrw($r){if($r)return mysql_fetch_row($r);}
function res($p,$b){return mysql_query('select '.$p.' from '.$b);}
//function ser($p,$b){return qrr(res($p,$b,$q));}
function rse($p,$b){$r=qrw(res($p,$b,$q)); return $r[0];}//codeview//master_params
function msquery($sql,$o=''){$req=mysql_query($sql) or die(mysql_error());
if($o)return mysql_insert_id();}
function mysql_values($r,$d){$ra=sesmk($d); $i=0;
foreach($ra as $k=>$v){$rb[$k]=$r[$i]; $i++;} return $rb;}
function insert($b,$d){return msquery('insert into '.$_SESSION[$b].' values '.$d,1);}
function update($bs,$in,$v,$col,$id){msquery('update '.$_SESSION[$bs].' set '.$in.'="'.$v.'" where '.$col.'="'.$id.'"');}
function delete($bs,$id,$o=''){msquery('delete from '.$_SESSION[$bs].' where id="'.$id.'" limit 1'); if($o)reflush($bs,1);}
function reflush($bs,$o=''){msquery('alter table '.$_SESSION[$bs].' order by id');
if($o)msquery('alter table '.$_SESSION[$bs].' AUTO_INCREMENT='.(lastid($bs)+1));}
function lastid($bs){if($bs=='qda')$wh='id>="'.last_art_rqt().'"';
return sql('id',$bs,'v',$wh.' order by id DESC limit 1');}

function atmres($v){return mysql_real_escape_string(stripslashes($v));}
function atm($v){return '"'.atmres($v).'"';}
function atmr($r){foreach($r as $k=>$v)$ret[]=atm($v); return $ret;}
function atmrup($r){foreach($r as $k=>$v)$ret[]=$k.'='.atm($v); return $ret;}
function mysqlra($r){$rb=atmr($r); return '("",'.implode(',',$rb).')';}
function mysqlrb($r){foreach($r as $k=>$v)$rb[]=mysqlra($v); return implode(',',$rb);}

function sq($d,$b,$q=''){return mysql_query('select '.$d.' from '.$_SESSION[$b].' '.$q);}

function sqlformat($rq,$p){
if($p=='q')return $rq;//res
if($p=='r')return qrr($rq);//ser
if($p=='a')return qra($rq);
if($p=='v'){$r=qrw($rq); return $r[0];}//rse
while($r=mysql_fetch_row($rq))if($r[0])switch($p){
	case('k'):$ret[$r[0]]+=1; break;//sre
	case('vr'):$ret[]=$r[0]; break;
	case('kv'):$ret[$r[0]]=$r[1]; break;
	case('kk'):$ret[$r[0]][$r[1]]+=1; break;
	case('vv'):$ret[]=array($r[0],$r[1]); break;
	case('kr'):$ret[$r[0]][]=$r[1]; break;
	case('kkv'):$ret[$r[0]][$r[1]]=$r[2]; break;
	case('kkk'):$ret[$r[0]][$r[1]][$r[2]]+=1; break;
	case('kvv'):$ret[$r[0]]=array($r[1],$r[2]); break;
	case('kkr'):$ret[$r[0]][$r[1]][]=$r[2]; break;
	case('index'):$ret[array_shift($r)]=$r; break;
	default:$ret[]=$r; break;}
return $ret;}

//sql('id','qda','r','id=""');
function sql($d,$b,$p,$q,$z=''){
$sql='select '.$d.' from '.$_SESSION[$b].($q?' where '.$q:'');
$rq=mysql_query($sql); if($z)echo $sql;
if($rq){$ret=sqlformat($rq,$p); mysql_free_result($rq);}
return $ret;}

function sql_b($sql,$p,$z=''){//$sql=qw($s,$b).$q
if(!$z)$rq=mysql_query($sql); else $rq=mysql_query($sql) or die(mysql_error());
if($rq){$ret=sqlformat($rq,$p); if($rq)mysql_free_result($rq);}
if($z)echo $sql;
return $ret;}

function sql_inner($d,$b1,$b2,$key,$p,$q,$z=''){
$sql='select '.$d.' from '.$_SESSION[$b1].' inner join '.$_SESSION[$b2].' 
on '.$_SESSION[$b1].'.id='.$_SESSION[$b2].'.'.$key.' '.($q?'where '.$q:'');
if(!$z)$rq=mysql_query($sql); else $rq=mysql_query($sql) or die(mysql_error());
if($rq){$ret=sqlformat($rq,$p); if($rq)mysql_free_result($rq);}
if($z)echo $sql;
return $ret;}

#dirs
function mkdir_r($u){$nu=explode("/",$u); if(count($nu)>10)return;
if(strpos($u,'Warning')!==false)return;
foreach($nu as $k=>$v){$ret.=$v.'/'; if(strpos($v,'.'))$v=''; 
if(!is_dir($rep.$ret) && $v){if(!mkdir($rep.$ret))echo $v.':not_created ';}}}
function rmdir_r($dr){$dir=opendir($dr); if(!auth(6))return;
while($f=readdir($dir)){echo $drb=$dr.'/'.$f;
if(is_dir($drb) && $f!='..' && $f!='.'){rmdir_r($drb); rmdir($drb);}
elseif(is_file($drb))unlink($drb);} rmdir($dr);}

function explore($dr,$p='',$o=''){if(!is_dir($dr))return;
$dir=opendir($dr); while($f=readdir($dir)){$drb=$dr.'/'.$f;
if(is_dir($drb) && $f!='..' && $f!='.' && $f!='_notes'){
	if($p=='dirs' or $p=='all')$ret[$f]=$f;
	if(!$o)$ret[$f]=explore($drb,$p,$o);}
if($p!='dirs')if(is_file($drb))$ret[]=$f;}
return $ret;}

function explode_dir($r,$d,$func){static $i; $i++;
if(is_array($r)){foreach($r as $k=>$v){$io++; 
	if(is_array($v)){$ret[$k]=explode_dir($v,$d.'/'.$k,$func);$i--;}
	else $ret[$k]=call_user_func_array($func,array($d,$k,$v,$i.'.'.$io));}}
return $ret;}
//example of user_func for explode_dir, where if(!$v):empty_dir
function func($d,$k,$f,$n){//dir,key,file,topology
if($v)return $d.'/'.$f; else return $d;}
//actions
function walk_dir($dr,$func){
$r=explore($dr); return explode_dir($r,$dr,$func?$func:"func");}

#files
function read_file($f){if($f)$fp=fopen($f,"r");//fgets
if($fp){while(!feof($fp))$ret.=fread($fp,8192); fclose($fp);} return $ret;}
function write_file($f,$t){$h=fopen($f,"w+");
$w=fwrite($h,$t); fclose($h); if($w===false)return 'error';}

function get_file($f){
$ret=@file_get_contents($f);
//if(!$ret)$ret=read_file($f);
if(!$ret)$ret=file_get_context($f);
if(!$ret)$ret=curl_get_contents($f);
//if($ret)$ret=gzdecode($ret);
return $ret;}

function file_get_context($f){
ini_set("user_agent","Mozilla/5.0"); $head='User-agent: Mozilla/5.0'."\n";
$r=array('http'=>array('method'=>"GET",'header'=>$head,'ignore_errors'=>1,'request_fulluri'=>true,'max_redirects'=>0));//,'content'=>$postdata
$context=stream_context_create($r);
//$h=get_headers($f,false);//$http_response_header
if(strpos($h[0],'404'))return '404'; if(strpos($h[1],'utf-8'))$_POST['utf']=1;
return file_get_contents($f,false,$context);}

function curl_get_contents($f){$ch=curl_init($f); //curl_setopt($ch,CURLOPT_URL,$f);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('HTTP_ACCEPT: Something','HTTP_ACCEPT_LANGUAGE: fr, en, es','HTTP_CONNECTION: Something','Content-type: application/x-www-form-urlencoded','User Agent: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'));//
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0); curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
$ret=curl_exec($ch); curl_close($ch); return $ret;}

function joinable($d){$ok=@fopen($d,'r'); if($ok){fclose($ok); return true;}}
//function joinable($d){$ok=@file_get_contents($d); if($ok)return true;}

//fileinfo
function recup_fileinfo($doc){if(is_file($doc))
return date('ymd',filemtime($doc)).'-'.round(filesize($doc)/1024).'Ko';}
function ftime($f,$d=''){if(is_file($f))return date($d?$d:'ymd.Hi',filemtime($f));}
function fsize($f){if(is_file($f))return round(filesize($f)/1024,1).' Ko';}
function fwidth($f){if(is_file($f))return getimagesize($f);}

//gz
function gz_create($f,$fb){$t=read_file($f);
$gz=gzopen($fb,'w9'); gzwrite($gz,$t,strlen($t)); gzclose($gz);}
function gz_write($d,$f){$t=implode("",gzfile($d)); write_file($f,$t);}
function unpack_gz($f,$d){$p='plug/tar/pcl'; include_once($p.'tar.lib.php');
include_once($p.'error.lib.php'); include_once($p.'trace.lib.php');
PclTarExtract($f,$d,'','');}

#db
function db_f($dr,$nod){if($dr=='users' or !$dr)$dr='usr';
return 'db/'.$dr.'/'.str_replace('_','/',$nod).'.txt';}
function db_init($f){$dr=str_extract('/',$f,1,0);
if(!is_dir($dr))mkdir_r($dr); if(!is_file($f))write_file($f,'');}
function db_add($f,$row){db_init($f); $r=db_read($f); $r[]=$row; db_write($f,$r);}
function db_write($f,$r){db_init($f); //pr($r);
//echo txarea('',json_encode($r,JSON_HEX_QUOT||JSON_HEX_APOS),40,10); 
write_file($f,json_encode($r));}
function db_read($f){return json_decode(file_get_contents($f),true);}//db_init($f); 

#microsql
//plug:18//prog:7
function dump($r,$p){if(is_array($r)){foreach($r as $k=>$v){$re="";
if($k!=$_POST["erase"] or $k=="_menus_"){
if(is_array($v))foreach($v as $ka=>$va)$re.="'".addslashes(stripslashes($va))."'".',';
$ret.='$r['.(is_numeric($k)?$k:'"'.$k.'"').']=array('.substr($re,0,-1).');'."\n";}}}
return '<'."?php\n//philum_microsql_$p\n$ret\n?".'>';}

//function msq_patch($f,$r,$nod){write_file($f,dump($r,$nod));}
function msq_menus($r){if(isset($r['_menus_']))return $r['_menus_']; $n=count($r);
foreach($r as $k=>$v)$ret['_menus_'][]=$k; return $ret;}

//plug:3//prog:38
function save_vars($dr,$nod,$r){
if($r && $nod && auth(3))return write_file($dr.$nod.'.php',dump($r,$nod));}

//plug:17//prog:17
function read_vars($dr,$nod,$defsb){$f=$dr.$nod.'.php'; 
if(is_file($f)){require $f; return $r;}
elseif($defsb)echo save_vars($dr,$nod,$defsb);
return $defsb;}

//plug:11//prog:5
function msql_save($dr,$nod,$r,$h=''){
if($h){$rb['_menus_']=$h; $r=$rb+$r;}
write_file(msq_f($dr,$nod),dump($r,$nod));}

//plug:3//prog:2
function msql_read_b($dr,$nod,$in='',$u='',$ra=''){$f=msq_f($dr,$nod);
//db_write(db_f($dr,$nod),$r);
if(is_file($f))require $f; elseif($ra)msql_save($dr,$nod,$ra);
if($u)unset($r['_menus_']); if($r)return $in?$r[$in]:$r;}

//plug:21//prog:17
function modif_vars($dr,$nod,$arr,$k,$dfb=''){$bs=root().'msql/';
if(!$dfb && is_array($arr))$dfb=msq_menus($arr);
if($nod)$r=msql_read_b($dr,$nod,'','',$dfb);
if($k=="mdf")foreach($arr as $ka=>$va)if($ka=='push')$r[]=$va; else $r[$ka]=$va;
elseif($k=="add")foreach($arr as $ka=>$va)$r[]=$va;
elseif($k=="addon")foreach($arr as $ka=>$va)$r[]=array($va);
elseif($k=="addif"){if($r)$rk=array_keys_r($r,0,'k');
	if($arr)foreach($arr as $ka=>$va)if(!$rk[$va[0]])$r[]=$va;}
elseif($k=="push")$r[]=$arr; elseif($k=="shift")array_unshift($r,$arr); 
elseif($k=="del")unset($r[$arr]); elseif($k=="repl")$r=$arr; elseif($k)$r[$k]=$arr; 
if($r[0] && array_sum(array_keys($r))>0)$r=msq_reorder($r);
msql_save($dr,$nod,$r);
//db_write(db_f($dr,$nod),$r);
return $r;}

//plug:22/prog:20
function msql_modif($dr,$nod,$defs,$dfb,$act,$n){if(!$dr)$dr='users';
$bs='msql/'; $m='_menus_'; $r=msql_read_b($dr,$nod,'','',$dfb);
if($act=='one')$r[$n]=$defs; elseif($act=='shot')$r[$n][$dfb?$dfb:0]=$defs; 
elseif($act=='del')unset($r[$n]); elseif($act=='val')$r[$n][$dfb]=$defs; 
elseif($act=='push')$r[]=$defs; elseif($act=='arr')$r=$defs;
elseif($act=='after')$r=array_push_after($r,$defs,$n);
elseif(is_numeric($n))foreach($r as $k=>$v){if($v[$n]==$defs[$n] && $v[$n]){//refer
	if($act=='mdf')$r[$k]=$defs;}}// elseif($act=='del')unset($r[$k]);
elseif($act=='add'){foreach($defs as $k=>$v){//batch 
	if($n=='mdf')$rb[$k]=$v; else $r[]=$v;} if($rb)$r=$rb;}
if($r[0])$r=msq_reorder($r); if($ra)$ra+=$r; else $ra=$r;
save_vars($bs.$dr.'/',$nod,$ra);//need auth
//db_write(db_f($dr,$nod),$r);
return $ra;}

//plug:93//prog:157
//$fb=db_f($dr,$nod); //$r=db_read($fb); if(!$r)$is=1; if($is) //db_write($fb,$r); 
function msql_read($dr,$nod,$in='',$u=''){$f=msq_f($dr,$nod); $m='_menus_';
if(is_file($f))require $f; if(!$r)return; if($u)unset($r[$m]);
unset($r[0]); $r0=current($r); if(!$r0)$r0=next($r); $n=count($r0);
if($in){if(!$r[$in])return; if($u=='k')return $r[$in];
	elseif($n==1)return stripslashes_b($r[$in][0]); 
	elseif($r[$m])return array_combine_a($r[$m],$r[$in]); else return $r[$in];}
elseif($n==1 && $u!='k')foreach($r as $k=>$v)$ret[$k]=stripslashes_b($v[0]);
elseif(!$r[$in])$ret=$r; 
return $ret;}

//plug:0//prog:3
function msq_create($d,$r,$rb,$k){$dfb['_menus_']=$rb;
foreach($r as $k=>$v)if(!is_array($v))$r[$k]=array($v);
if($r)return modif_vars('users',ses('qb').'_'.$d,$r,$k,$dfb);}

//plug:1//prog:0
function msq_where($dr,$nod,$n,$d,$o=''){$r=msql_read_b($dr,$nod);
if($r)foreach($r as $k=>$v)if($v[$n]==$d)$ret[]=$v; 
if($ret)return $o?array_shift($ret):$ret;}

//plug:5//prog:5
function msq_choose($dr,$pr,$nd){
$r=explore(root().'msql/'.($dr?$dr:'users'),'files',1); $n=count($r);
for($i=0;$i<$n;$i++){$rb=split("[_.]",$r[$i]);//let .php
if($rb[2]!='sav' && $rb[3]!='sav'){
	if($pr && $rb[0]==$pr && !$nd && $rb[1])$ret[$rb[1]][]=$rb[2];
	elseif($pr && $rb[0]==$pr && $rb[1]==$nd && ($rb[2]))$ret[]=$rb[2];//versions
	elseif(!$pr && $nd){if($rb[1]==$nd)$ret[]=$rb[0].'_'.$rb[1];}
	elseif(!$pr)$ret[]=$rb[0].'_'.$rb[1];}}
return $ret;}

function msq_find_last($dr,$pr,$nod){//next table
$r=msq_choose($dr,$pr,$nod); return msq_find_next($r);}
function msq_find_next($r){if($r){$mx=max($r); asort($r);
foreach($r as $v){$i++; if($v!=$i)return $i;}} return $mx+1;}
function msq_findnext_entry($r,$n){ksort($r);//next free
foreach($r as $k=>$v){$i++; if(!$r[$i-$n] && is_numeric($k))return $i-$n;}
return max(array_keys($r))+1;}

function msq_goodtable($d){
list($dn,$vn)=split("ß",$d); list($dr,$da)=split_one("/",$dn);
if(!$da){$da=$dr;$dr='';} list($nd,$bs,$va,$op)=split("_",$da);
if($op){$da=$nd.'_'.$bs.'_'.$va; $r=msql_read($dr,$da,$op);}
if($da && !$r)$r=msql_read($dr,$da);
if(!$r)$r=msql_read($dr,$nd.'_'.$bs,$va);
return $vn?$r[$vn]:$r;}

function msql_read_prep($b,$d){$r=msql_read($b,$d,"",1);//categories
if($r)foreach($r as $k=>$v)$ret[$v[0]][$k]=$v[1]; return $ret;}
function msq_format($r){foreach($r as $k=>$v)$r[$k]=array($v); return $r;}
function msq_cat($r,$n){foreach($r as $k=>$v)@$ret[$v[$n]?$v[$n]:$v]=$k; return $ret;}//
function msq_tri($r,$n,$vrf){foreach($r as $k=>$v)if($v[$n]==$vrf)$ret[$k]=$v;return $ret;}
function msq_sort($r,$n,$i){$rb=array_keys_r($r,$n); if($i)arsort($rb); else asort($rb);
foreach($rb as $k=>$v)$ret[$k]=$r[$k]; return $ret;}
function msq_reorder($r){if($r['_menus_'])$rb['_menus_']=array_shift($r);
foreach($r as $k=>$v){$i++; $ret[$i]=$v;}
if($ret && $rb)$rb+=$ret; elseif($ret)$rb=$ret; return $rb;}
function msq_move($r,$ka,$va){$rk=$r[$ka]; unset($r[$ka]);
foreach($r as $k=>$v){if($k==$va){$ra[$i]=$rk; $i++;} 
if($k=='_menus_')$ra['_menus_']=$v; else $ra[$i]=$v; $i++;} return $ra;}
function msq_walk($r,$n,$func,$p){
foreach($r as $k=>$v){$r[$k][$n]=call_user_func($func,$k,$v[$n],$v,$p);} return $r;}
function msq_walk_k($r,$func){
foreach($r as $k=>$v){$kb=call_user_func($func,$k,$v); $ret[$kb]=$v;} return $ret;}
function msq_prep($r){foreach($r as $k=>$v){$i++; $ret[$i]=array($v);} return $ret;}
function msq_prevnext($r,$d){$keys=array_keys($r);
foreach($keys as $k=>$v)if($v==$d)return array($keys[$k-1],$keys[$k+1]);}
function msq_copy($da,$na,$db,$nb){
$r=msql_read_b($da,$na); save_vars('msql/'.$db.'/',$nb,$r); return $r;}
function msq_n($dr,$nod,$d){$r=msql_read_b($dr,$nod);
foreach($r as $k=>$v){$i++; if($k==$d)return $i;}}
function msq_append($defs,$d){list($a,$b)=split_right('/',$d,1);
$r=msql_read_b($dr,$nod); foreach($r as $k=>$v)if(!$defs[$k])$defs[$k]=$v;
return $defs;}
function msq_merge($r,$dr,$nd){$rb=msql_read_b($dr,$nd,'',1);
return array_merge_b($r,$rb);}
function msq_ses($v,$dr,$nod,$u){
return $_SESSION[$v]=$_SESSION[$v]?$_SESSION[$v]:msql_read($dr,$nod,'',$u);}

function msq_data($d,$o=''){$d=stripslashes_b($d);
if(strpos($d,'<')!==false or strpos($d,'>')!==false)$d=entities($d);//$d=parse($d);
if($o)$d=nl2br($d); return $d;}

function msq_f($dr,$nod){$dr=$dr=='lang'?$dr.'/'.prmb(25):$dr; $dr=$dr?$dr:"users";
return root().'msql/'.$dr.'/'.$nod.'.php';}

#tables
function make_table($r,$csa='',$csb=''){
if(is_array($r))foreach($r as $k=>$v){$td=''; $i++; $cs=$i==1?$csa:$csb;
	if(is_array($v))foreach($v as $ka=>$va)$td.=balc('td',$cs,$va);
	if($td)$tr.=balc('tr','" valign="top',$td);}
return balc('table','',$tr);}

function make_divtable($r,$h=''){$cr='display:table-row;';
$cc=$cs.'display:table-cell; vertical-align:middle; padding:2px; '; 
if(is_array($r))foreach($r as $k=>$v){$td=''; $i++; 
	if($h)$cs=$i==1?'background:rgba(255,255,255,0.4);':'';
	if(is_array($v))foreach($v as $ka=>$va)$td.=bts($cc.$cs,$va);
	if($td)$ret.=bts($cr,$td);}
return $ret;}

function make_tables($rt,$r,$csa,$csb,$o=''){
if(is_array($rt))foreach($rt as $k=>$v)$td.=balc('td',$csa,$v);
$tr=balc('tr',$csa,$td);
if($r)foreach($r as $k=>$v){$td=$o?balc('td',$csb,$k):'';
	if(is_array($v))foreach($v as $ka=>$va)$td.=balc('td',$csb,$va);
	else $td.=balc('td',$csb,$v);
$tr.=balc('tr','',$td);}
return balc('table','" align="top',$tr);}

function array_conn($r){foreach($r as $v)
if(is_array($v))$ret[]=implode('|',$v); else $ret[]=$v;
return implode('¨',$ret);}

//tabs
function make_tabs($r,$ud='',$c=''){if(!$r)return; //$i=randid();
static $i; $i++; $id='tab'.$ud.'-'.$i; $ra=array_keys($r);
$ib=$_SESSION['tbmd'.$id]; if(!$ib)$ib=1; $sp=btn('txtac',' ');
foreach($r as $k=>$v){$b++; 
	$dsp=$b==$ib?'block':'none'; $cs=$b==$ib?'txtaa':'txtab';
	$menu.=ljb($cs,'toggle_tab',$id.'\',\''.$b,$k).$sp;
	if(is_array($v))$v=divc('list',onxcols($v,3,''));//implode(' ',$v);
	if($v)$divs.=div(atd('div'.$id.$b).ats('display:'.$dsp).atc($c),$v);}
return divb('|mnuab'.$id.'|margin-bottom:4px;',$menu).$divs;}

#menus
function slct_menus($r,$lk,$vf,$cs1,$cs2,$kv){
foreach($r as $k=>$v){
if($kv=="k")$v=$k; elseif($kv=="v")$k=$v; 
if($v)$ret.=lkc($vf==$k?$cs1:$cs2,$lk.$k,$v).' ';}
return $ret;}
function slct_menus_tags($r,$lk,$vf,$ct,$csa,$kv){
foreach($r as $k=>$v){
if($kv=="k")$v=$k; elseif($kv=="v")$k=$v; 
if($ct=="nb" && $v>1)$nb=' ('.$v.')'; else $nb="";
$css=$vf==$k?$csa.' active':$csa;
if($k)$ret.=llk($css,$lk.$k,$k.$nb);}//#li
return $ret;}
function slctmenusj($r,$j,$vf,$sep,$kv=''){
foreach($r as $k=>$v)if($k && $k!="_system")
	$ret.=lj($vf==$k?'active':'',$j.ajx($k,''),stripslashes($kv?$v:$k)).$sep;
return divc('nbp',$ret);}
function slctmenusja($r,$j,$vf){foreach($r as $k=>$v)
	$ret.=lj($vf==$k?'active':'',$j.ajx($k,''),$v);
return $ret;}
function slctmenus_sj($r,$go,$vf){
foreach($r as $k=>$v)$ret.=lj($vf==$k?'active':'',str_replace('VAR',$k,$go),$v).' ';
return divc('nbp',$ret);}
function jump_btns($id,$v,$add,$c=''){$r=is_array($v)?$v:explode('|',$v); 
foreach($r as $va)
$ret.=ljb($c,'jumpMenu_text',$id.'_'.ajx($va).'_'.$add,stripslashes($va)).' ';
if($ret)return btn('nbp',$ret);}

//prepared_list
function menuder_h($r,$id,$d,$j){$i=0;
foreach($r as $k=>$v){$jx='jumpvalue(\''.$id.'_'.addslashes($k).'\'); ';
	$jx.='active_list(\'div'.$id.'\','.$i.',\'active\',\'\'); '.$j; $i++;
	$rt.=ljb($d==$k?'active':'',$jx,'',$v).' ';}
$ret.=span(atd('div'.$id).atc('nbp'),$rt).hidden('',$id,$d);
return $ret;}

function menuderj_prep($pr,$id,$t,$opt=''){$rid=randid();//menuder_jb
$j='popup_menuder___'.ajx(addslashes($pr)).'_'.$id.'_'.$rid.'_'.$opt;
return lj('txtbox" id="adcat'.$rid,$j,$t?$t:picto('wait')).hidden('',$id,$t);}

//bubslct
function mkbub($d,$c='',$s='',$o=''){
return div(atd('bub').atc($c).ats($s).atb('onclick',$o),ul($d));}
function bubslct($j,$t){$j=str_replace('_','.',$j); $ret=popbub($j,'bub',$t,'d');
$s='position:relative; display:inline-block;'; $o='popz+=1; this.style.zIndex=popz;';
return mkbub($ret,'',$s,$o);}

function select_jp($id,$f,$v='',$o='',$t=''){
$j=$id.'_'.$f.'_'.ajx($v).'_'.ajx($o).'_'.$id; $h=input1($id,$v,3);
return lj('popbt','popup_hidden___'.$j,$t).$h;}

//$ret=select_jb('inp','backup|progb|plug',$p,1,'');
function select_jb($id,$pr,$v='',$o='',$oj=''){$rid=randid();//pr='a|b|c'
$j=ajx(addslashes($pr)).'_'.$id.'_'.$rid.'_'.($oj); $t=$t?$t:picto('kdown');
if($o==1)$h=input1($id,$v,'',7); else $h=hidden($id,$id,$v);
return bubslct($j,$t).$h.$tb;}

#select_j //existing_list
//$f=function; $o=1:bt,$o=2:choice,$o=3:bt+choice//ty=2:outside input
function select_j($id,$f,$v='',$o='',$t='',$ty=''){$rid=randid();//hidslct_j
$hid='bt'.$id; $j=$id.'_'.$f.'_'.ajx($v).'_'.ajx($o).'_'.$id; 
$c=$v&&!$t?'popw':'popbt'; $t=$t?$t:($v?$v:picto('wait')); 
if($ty==1)$h=input1($id,$v,3); elseif($ty!=2)$h=hidden($id,$id,$v);
return lj($c.'" id="'.$hid,'popup_hidden__'.$hid.'_'.$j,$t).$h;}//$hid dÈclenche bub

function msql_slct($id,$k,$murl){
return select_j($id.$k,'msqlc','',$murl,'','2');}

#rss
function read_rss_data($data,$t,$r){//lit_rss
if(strpos($data,'<item')===false)$t='entry';
$tmp=preg_split("/<\/?".$t.">/",($data));//html_entity_decode
foreach($r as $v){$tmp2=preg_split("/<\/?".$v.">/",$tmp[0]); $ret[0][]=@$tmp2[1];}
for($i=1;$i<sizeof($tmp)-1;$i+=1){
	if($r){foreach($r as $v){
	if($v=='image')$ret[$i][]=embed_detect($tmp[$i],'type="image/png" href="','"','');
	else{$tmp2=preg_split("/<\/?".$v.">/",$tmp[$i]);
		$tmp2[1]=str_replace(array('<![CDATA[',']]>',''),'',$tmp2[1]);
	$ret[$i][]=html_entity_decode($tmp2[1]);}}}}
return $ret;}

function read_rss($f,$t,$r){$d=get_file($f);
$enc=embed_detect(strtolower($d),'encoding="','"',"");
if(strtolower($enc)=="utf-8")$d=utf8_decode_b($d);
$d=str_replace(array(' isPermaLink="false"',' rel="stylesheet"',' type="text/css"'),'',$d); 
return read_rss_data($d,$t,$r);}

function read_xml($f){////if(!joinable($f))return;
$rss=@simplexml_load_file($f); 
if(!$rss){$rss=@simplexml_load_string(get_file($f));}
if(!$rss)return; //p($rss->channel);
$xml=$rss->channel->item; if(!$xml)$xml=$rss->channel->entry;
if(!$xml)$xml=$rss->items; if(!$xml)$xml=$rss->entry;
return $xml;}

function load_xml($f,$o=''){$xml=read_xml($f); if($xml)foreach($xml as $k=>$v){
	$va=utf8_decode_b($v->title); $dat=$v->pubDate; if(!$dat)$dat=$v->updated;
	$lnk=$v->link; if(!$lnk)$lnk=$v->guid; if(!$lnk)$lnk=$v->link[0]['href']; 
	if(!$lnk)$lnk=$v->childnode['href'];
	if(!$dat){$dc=$v->children('http://purl.org/dc/elements/1.1/'); $dat=$dc->date;}
	if($o)$txt=utf8_decode_b($v->description); $ret[]=array($va,$lnk,$dat,$txt);}
return $ret;}

//rss_dates
function mkdts(){return $_SESSION['prmb'][17]?$_SESSION['prmb'][17]:"ymd.Hi";}
function rss_date($date){return date(mkdts(),rss_time($date));}
function rss_time($date){if(strpos($date,',')){//Mon, 01 Aug 2011 09:34:34 GMT+00:00
list($mon,$day,$month,$year,$hour,$gmt)=explode(' ',$date); 
$decal=substr(str_replace('GMT','',$gmt),0,2)-2; $decal*=3600;
return strtotime($day.' '.$month.' '.$year);}
elseif(ereg("^[0-9]",$date) and  ereg("(([[:digit:]]|-)*)T(([[:digit:]]|:)*)[^[:digit:]].*",$date,$temp))return strtotime($temp[1].' '.$temp[3])+$decal;}//2011-05-27T17:31:28Z

#dates
function mkday($d='',$p=''){if($p==1)$p=$_SESSION['prmb'][17];
	return date($p?$p:'ymd',$d?$d:time());}
function calc_date($d){return ses('daya')-86400*$d;}
function calctime($d){return ses('dayx')-86400*$d;}
function mtime(){list($u,$s)=explode(" ",microtime()); return ($u+$s);}
function timelang(){setlocale(LC_TIME,prmb(25).'_'.strtoupper(prmb(25)));}
function time_prev($d){//search
$r=array(0,7,30,90,365); for($i=5;$i<20;$i++)$r[]=$r[$i-1]+365; $n=count($r);
for($i=0;$i<=$n;$i++)if($r[$i] && $r[$i]<$d)$ret=$r[$i];
return $ret;}
function time_ago($dt){$dy=time()-$dt; if($dy<86400){$fuseau=3;
$h=intval(date('H',$dy))-$fuseau; $i=intval(date('i',$dy)); $s=intval(date('s',$dy)); 
$nbh=$h>1?$h.' h ':""; $nbi=$i>0?$i.' min ':""; //$nbs=$i<=1?$s.'s ':"";
return $nbh.$nbi.$nbs;} else return date(mkdts(),$dt);}

function timetravel(){$r=define_digr(); $n=max(array_flip($r))/365;
unset($r[1]); unset($r[7]); unset($r[30]); unset($r[90]);
foreach($r as $k=>$v){$tim=calctime($k); $t=date('Y',$tim); $ret[$t]=$tim;}
return $ret;}

#builders
function on2cols($r,$w,$p){$w1=$w/$p; $w2=$w-$w1;
$css='" style="display:table-cell; width:'.$w1.'px;';
$csb='width:'.$w2.'px;'; $csc='display:table-row; line-height:150%;';
if($r)foreach($r as $k=>$v){$ret.=divs($csc,divc('txtsmall'.$css,$k).divs($csb,$v?$v:'-'));}
return $ret;}

function onxcols($re,$prm,$w,$h=''){//colonize
$nb=count($re); $io=1; if(!is_numeric($prm))$prm=3;
$mid=ceil($nb/$prm); $mid=$mid==0?1:$mid; $mw=floor($w/$prm)-60;
if($h)$h=' overflow-y:auto; overflow-x:visible; height:'.$h.'px;';
$css='float:left; min-width:'.$mw.'px; width:'.(floor(100/$prm)).'%;'.$h.';';
if($re)foreach($re as $k=>$v){$i++; if($i<=$mid)$r[$io].=$v; if($i>$io*$mid && $io<$prm)$io++;
	if($io>1 && $i>$mid*($io-1) && $i<=$mid*$io)$r[$io].=$v;}
for($i=1;$i<=$prm;$i++)$ret.=divs($css,$r[$i]);
return $ret.divc('clear','');}

function scroll($r,$d,$n,$w='',$h=''){
$max=is_numeric($r)?$r:count($r); if($w)$wa='min-width:'.$w.'px; ';
$cb='id="scroll" style="overflow-y:scroll; '.$wa.'max-height:'.($h?$h:400).'px;"';
if($max>$n)return div($cb,$d); else return $d;}

function scroll_b($r,$d,$n,$w='',$h='',$id=''){$h=$h?$h:400;
$max=is_numeric($r)?$r:count($r); $w=$w?$w:prma('content');
$ca='width:calc(100% + 1px); height:'.$h.'px; overflow:hidden; padding-right:1px;';
$cb='id="scrll'.$id.'" style="width:calc(100% + 16px); overflow:auto; height:'.$h.'px;"';
if($max>$n)return divs($ca,div($cb,$d)); else return $d;}

function iframe($d,$w='',$h=''){
list($dc,$wb,$hb,$p,$o,$d)=subparams_a($d);//urlßw/h
$w=$wb?$wb:$w; $h=$hb?$hb:($h?$h:'50%'); $w=$w?$w:'100%'; //$w=$h='';
if(strpos($dc,"http")===false)$f='users/'.$dc; //alert($w.'/'.$h);
$prm=atb('width',$w).atb('height',$h).atb('name',$p).atb('seamless',$o).atb('srcdoc',$o);//
return balb('iframe','src="'.$dc.'" frameborder="0"'.$prm.' webkitallowfullscreen mozallowfullscreen allowfullscreen','');}

#filters
//normalize
function eradic_acc($d){
$a='‡·‚„‰ÁËÈÈÍÎÏÌÓÔÒÚÛÙıˆ˘˙˚¸˝ˇ¿¡¬√ƒ«»… ÀÃÕŒœ—“”‘’÷Ÿ⁄€‹›';
$b='aaaaaceeeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY';
//return str_replace(strsplit($a),strsplit($b),$d);
return strtr($d,$a,$b);}

function protect_utf($d){$bad=array("\xe2\x80\x98","\xe2\x80\x99","\xe2\x80\x9c","\xe2\x80\x9d","\xe2\x80\x94","\xe2\x80\xa6");//íëìîñ
$fixed=array("&#8216;","&#8217;",'&#8220;','&#8221;','&mdash;','&#8230;');
return str_replace($bad,$fixed,$d);}

function repair_latin($d){//signes %u non utf8_decodÈs//proviennent de htmlentitydecode non iso
return str_replace(array("≈ì"),array("&#339;"),$d);}

function utf8_decode_b($d){//$d=clean_acc($d); //$d=html_entity_decode_b($d);
//return iconv("UTF-8","ISO-8859-1//TRANSLIT",$d);
$ra=array("‚Ä¢",'‚Ä"',"¬ñ","‚Äì","‚Äî","‚Ä¶",'‚Äô',"‚Äò","í√ª","í√©","í√®","í√™","≈ì","‚Ä¢","‚Äú","‚Äù","‚Äô","‚Äâ","¬ú","‚Ä®","¬ì","¬î");//,"≈'","√â","√©","√®","√","‡Æ","‡ß","‡™","‡¥"
$rb=array("-","-","-","-","-","...","'","'","˚","È","Ë","Í","&#339;","ï",'"','"',"'"," ","ú",'','"','"');//,"å","…","È","Ë","‡","Ó","Á","Í","Ù"
$d=str_replace($ra,$rb,$d); //$d=protect_utf($d); $d=clean_acc($d);
return utf8_decode($d);}

function html_entity_decode_b($v){$v=str_replace("&amp;","&",$v);
return str_replace(array("&nbsp;","&ndash;","%27","&#8216;","&#8217;","&#174;","&#175;","&#171;","&#187;","&#8211;","&#8220;","&#8221;","&quot;","&#8230;","&mdash;","&#8212;","&eacute;","&agrave;","&#287;","&#305;","&#304;","&#8617;","&#147;","&#148;","e&#768;","a&#768;","e&#769;","e&#770;","&#176;","&rsquo;","&#39;","&#8239;","&#8206;","&#8201;","&hellip;","&bdquo;","&ldquo;","&lsquo;","&rsquo;","&#8203;","&#039;","&thinsp;","&ensp;","&emsp;","&#160;","&#8194;","&#8195;","&#8201;","&#8208;"),array(" ","-","'","'","'","´","ª","´","ª","-",'"','"','"',"...","",'-',"È","‡","g","i","I","<-",'"','"',"Ë","‡","È","Í","∞","'","'"," "," "," ","...",'"','"',"'","'","","'"," "," "," "," "," "," "," ","-"),$v);}
//&#3647;//bitcoin

function unescape($d){$n=strlen($d);//%u
if(strpos($d,'%u')===false)return $d;
for($i=0;$i<$n;$i++){$c=substr($d,$i,1);
if($c=='%'){$i++; $cb=substr($d,$i,1);
	if($cb=='u'){$i++; $cc=substr($d,$i,4); $i+=3; $ret.='&#'.hexdec($cc).';';}
	else $ret.=$c.$cb;}
else $ret.=substr($d,$i,1);}
return $ret;}

function utflatindecode($d){
$arr=array("%u201C","%u201D","%u2019","%u2026","%u0153","%u20AC","%u2013");
$arb=array('"','"',"'","...","&#339;","Ä","-");//oe
return str_replace($arr,$arb,$d);}

function urlutf($d,$p){//url_encode(utf8_encode($d))
$in=array("‡","‚","È","Ë","Í","Î","Ó","Ô","Ù","ˆ","˚","¸","˘","ï");
$out=array("%C3%A0","%C3%A2","%C3%A9","%C3%A8","%C3%AA","%C3%AB","%C3%AE","%C3%AF","%C3%B4","%C3%B6","%C3%BB","%C3%BC","%C3%B9","%u2022");
if($p)return str_replace($in,$out,$d);
else return str_replace($out,$in,$d);}

function normalize($d){
$d=str_replace(array(" ","'",'"',"?","/","ß",",",";",":","!","%","&","$","#","_","+","=","!","\n","\r","\0","[\]","~","(",")","[","]",'{','}',"´","ª","&nbsp;"),"",($d));//,"-","."
$d=eradic_acc($d);
$d=str_replace(array(".JPG",".JPEG",".jpeg",".GIF",".PNG"),
array(".jpg",".jpg",".jpg",".gif",".png"),$d);
return $d;}

function entities($d){return htmlentities($d,ENT_QUOTES,$_SESSION['enc']);}
function parse($v){return str_replace(array("&","<",">"),array('&amp;',"&lt;","&gt;"),$v);}
function strip_tags_b($d){return preg_replace('/<[^>]*>/',' ',$d);}

function clean_acc($v){//html_entity_decode_b
$ra=array("í","ë",'ì','î',"Ö","ñ","®","‚Äô","\t");//"<o:p>","</o:p>",'https',
$rb=array("'","'",'"','"',"...","-",'"',"'","");//'<!--','-->',"","",'http',
return str_replace($ra,$rb,$v);}

function clean_punct($in){$ret=clean_acc($in);
$poub=array(" )","( "," ,"," ."," ;"," :",' !'," ?","´ "," ª",'0 0');//" '",
$pouc=array(")","(",",",".","&nbsp;;","&nbsp;:","&nbsp;!","&nbsp;?","´&nbsp;","&nbsp;ª",'0&nbsp;0');//"´","ª"//"<<",">>"
return str_replace($poub,$pouc,$ret);}

function clean_punct_b($v){
$nbc=substr_count($v,'"'); if($nbc/2!=round($nbc/2))return $v;
$r=strsplit($v); $n=count($r); $ia=2;
for($i=0;$i<$n;$i++){if($r[$i]=='"'){$ia=$ia==2?1:2;
	if($ia==1 && $r[$i+1]==" ")unset($r[$i+1]);
	if($ia==2 && $r[$i-1]==" ")unset($r[$i-1]);}}
if($r)return implode("",$r);}

function lowercase($v){$nb=strlen($v);
for($i=0;$i<$nb;$i++){$k=substr($v,$i,1);
	if($y==0)$ret.=$k; else{$k=strtolower($k);
		$ret.=strtr($k,'¿¡¬√ƒ«»… ÀÃÕŒœ—“”‘’÷Ÿ⁄€‹›','‡·‚„‰ÁËÈÍÎÏÌÓÔÒÚÛÙıˆ˘˙˚¸˝');}
	if($k==' ' or $k=="&nbsp;" or $k=="'" or $k=='"' or $k=='´')$y=0; else $y=1;}
return $ret;}

function delbr($d,$o){return str_replace(array('<br />','<br/>','<br>'),$o,$d);}
function deln($d,$o=''){return str_replace("\n",$o,$d);}
function delconn($d){return str_replace(array('[',']'),'',$d);}

//strings
function embed_detect($v,$s,$e,$n=''){$posa=strpos($v,$s); 
if($posa===false){$vb=str_replace("\n",' ',$v); $posa=strpos($vb,$s);}
if($posa!==false){$posa+=strlen($s)+$n; $posb=strpos($v,$e,$posa);
	if($posb===false){$vb=str_replace("\n",' ',$v); $posb=strpos($vb,$e,$posa);}}
if($posb!==false)$ret=substr($v,$posa,$posb-$posa-$n); else $ret=substr($v,$posa);
return $ret;}
function prop_detect($v,$s){$posa=strpos($v,$s.'="');
if($posa!==false){$posa+=strlen($s)+2; $posb=strpos($v,'"',$posa);}
if($posb!==false)return substr($v,$posa,$posb-$posa);}

//titles
function clean_title($d){$nb="&nbsp;";
$d=clean_acc($d); $d=utflatindecode($d); $d=html_entity_decode_b($d);
$d=str_replace('´'.$nb,'"',$d); $d=str_replace('ª'.$nb,'"',$d); $d=str_replace($nb,'',$d);
$d=clean_punct_b($d); $d=lowercase($d);
if(substr($d,-1)=='"')$d=substr($d,0,-1).$nb.'ª';
if(substr($d,0,1)=='"')$d='´'.$nb.substr($d,1);
$d=str_replace(' "',' ´'.$nb,$d);
$d=str_replace(array('" ','"'),$nb.'ª ',$d);
$d=ereg_replace("[ ]{2,}",' ',$d);
$d=clean_punct($d);
$d=unescape($d);
//$d=nodate($d);
return trim($d);}

#img
//force LH, cut and center
function scale_img($w,$h,$wo,$ho,$s){$hx=$wo/$w; $hy=$ho/$h;
if($s==2){$xb=($wo/2)-($w/2); $yb=($ho/2)-($h/2); $wo=$w; $ho=$h;}
elseif($hy<$hx && $s){$yb=($ho-($h*$hx))/2; $ho=$ho/($hy/$hx);}//reduce_h (no_crop)
elseif($hy>$hx && $s){$xb=($wo-($w*$hy))/2; $wo=$wo/($hx/$hy);}//reduce_w
elseif($hy<$hx){$xb=($wo-($w*$hy))/2; $wo=$wo/($hx/$hy);}//adapt_h
elseif($hy && $hx){$xb=0; $ho=$ho/($hy/$hx);}//adapt_w
//else{$w=$wo/$hy;}//float_width
//echo $wo.'--'.$ho.br();
return array($w,$h,$wo,$ho,$xb,$yb);}

function make_mini($in,$out,$w,$h,$s){
$w=$w?$w:140; $h=$h?$h:100; list($wo,$ho,$ty)=getimagesize($in); 
list($w,$h,$wo,$ho,$xb,$yb)=scale_img($w,$h,$wo,$ho,$s);
if(is_file($in))if(filesize($in)/1024>5000)return; //if($ho<$w or $wo<$h)return;
//if($w>=$wo && $h>=$ho){if(is_file($out))unlink($out); return $in;}
$img=imagecreatetruecolor($w,$h);
if($ty==2){$im=imagecreatefromjpeg($in);
	imagecopyresampled($img,$im,$xa,$ya,$xb,$yb,$w,$h,$wo,$ho);
	imagejpeg($img,$out,100);}
elseif($ty==1){$im=imagecreatefromgif($in); imgalpha($img);
	imagecopyresampled($img,$im,$xa,$ya,$xb,$yb,$w,$h,$wo,$ho);
	imagegif($img,$out);}
elseif($ty==3){$im=imagecreatefrompng($in); imgalpha($img);
	imagecopyresampled($img,$im,$xa,$ya,$xb,$yb,$w,$h,$wo,$ho);
	imagepng($img,$out);}
return $out;}

function imgalpha($img){//imagefilledrectangle($im,0,0,$w,$h,$wh);
$c=imagecolorallocate($img,255,255,255); imagecolortransparent($img,$c);
imagealphablending($img,false); imagesavealpha($img,true);}

//clrs
function colors($d=''){return msql_read('system','edition_colors',$d,1);}
function rand_clr(){$r=colors(); $rb=array_keys_r($r,0); sort($rb); 
$n=rand(0,count($rb)); return $rb[$n];}
function hexrgb_r($d){
for($i=0;$i<3;$i++)$r[]=hexdec(substr($d,$i*2,2)); return $r;}
function hexrgb($d,$o=''){$r=hexrgb_r($d);
return 'rgba('.$r[0].','.$r[1].','.$r[2].','.$o.')';}
function invert_color($p,$o){
if($o)return hexdec($p)<8300000?'ffffff':'000000';
for($i=0;$i<3;$i++){$d=dechex(255-hexdec(substr($p,$i*2,2))); $ret.=$d=='0'?'00':$d;}
return $ret;}
	
#mails
function mails_list(){
$r=msql_read('',$_SESSION['qb'].'_mails','',1);
if($r)foreach($r as $k=>$v){if($v[1])$ret[$k]=$v[0].'<'.$k.'>';}
return $ret;}
function recup_mails_tosend(){$r=mails_list();
if($r)return implode(",\n",$r);}

function prep_mail_html($suj,$v,$url){
	$http=$_SERVER['HTTP_HOST']; $qb=ses('qb'); $ban=bal("h3",lka(prep_host($qb),$http));
	$css=$qb.'_'.'design_'.$_SESSION['prmd'].'.css';
	if(strpos($url,'http')===false)$url='http://'.$http.'/'.$url;
	return '<html><head><title>'.$suj.'</title>
	<link href="http://'.$http.'/css/_global.css" rel="stylesheet" type="text/css">
	<link href="http://'.$http.'/css/'.$css.'" rel="stylesheet" type="text/css">
	</head><body>'.$ban.divs('margin:10px;',stripslashes($v)).'<br><br>'.
	lkc('txtx',$url,$url).'</body></html>';}
function send_mail_html($dest,$suj,$v,$from,$url){
	$msg=prep_mail_html($suj,$v,$url); 
	$admail=$_SESSION['qbin']['adminmail'];
	$dest=$dest?$dest:$admail; $from=$from?$from:$admail;
	$date=date("D, j M Y H:i:s"); $tet="From: $from \n";// -0600
	$tet.="Cc: \n"; $tet.="Bcc: \n"; $tet.="Reply-To: $from \n";
	$tet.="X-Mailer: PHP/".phpversion()."\n" ; $tet.="Date: $date \n";
	$tet.='Content-Type: text/html; charset="iso-8859-1"';
	if(mail($dest,$suj,$msg,$tet))return btn("txtyl",'mail_sent_to: '.$dest); 
	else return btn("txtyl","not_sent");}
function send_mail_txt($dest,$suj,$v,$from,$url){
	$suj=html_entity_decode_b($suj); $tet="From: $from"."\n";
	$msg="\n\n".$suj."\n\n".($v)."\n\n".'Source: '.prep_host(ses('qb')).$url;
	if(mail($dest,$suj,$msg,$tet)){return btn("txtyl",'mail_sent_to: '.$dest);}}
function send_mail($format,$to,$suj,$msg,$from,$url){
	if($format=="html"){send_mail_html($to,$suj,$msg,$from,$url);}
	else{send_mail_txt($to,$suj,$msg,$from,$url);}}
function contact($t,$c){return lj($c,'popup_track___'.ses('qb'),$t?$t:picto('mail'));}

#php
function stripslashes_b($d){return str_replace(array("\'",'\"'),array("'",'"'),$d);}
function strin($v,$s){return strpos($v,$s)!==false?true:false;}
function strchr_b($v,$s){return substr(strchr($v,$s),1);}
function strrchr_b($v,$s){return substr(strrchr($v,$s),1);}
function substrpos($d,$s){return substr($d,0,strpos($d,$s));}
//function substrrpos($d,$s){return substr($d,0,strrpos($d,$s));}
function subtopos($ret,$a,$b){return substr($ret,$a,($b-$a));}
function split_r($d,$n){return array(substr($d,0,$n),substr($d,$n));}
//conn
function strprm($d,$n='',$s=''){$r=explode($s?$s:'/',$d); return $r[$n?$n:0];}
function strdeb($v,$s){$p=strpos($v,$s); return $p!==false?substr($v,0,$p):$v;}
function str_until($d,$s){return substr($d,0,nearest($d,$s));}
function split_one($s,$v,$n=''){if($n)$p=strrpos($v,$s); else $p=strpos($v,$s);
if($p!==false)return array(substr($v,0,$p),substr($v,$p+1)); else return array($v,'');}
function split_right($s,$v,$n=''){if($n)$p=strrpos($v,$s); else $p=strpos($v,$s); 
if($p!==false)return array(substr($v,0,$p),substr($v,$p+1)); else return array('',$v);}
function str_extract($s,$v,$p='',$t=''){//00,10,01,11(pos,part)
$pos=$p==1?strrpos($v,$s):strpos($v,$s); if($pos===false)return $v;
return $t==1?substr($v,$pos+1):substr($v,0,$pos);}
function strsplit($v){$nb=strlen($v);//php4
for($i=0;$i<$nb;$i++)$ret[]=substr($v,$i,1); return $ret;}
//r
function array_combine_a($a,$b){$n=count($a);//php4
for($i=0;$i<$n;$i++)$r[$a[$i]]=stripslashes($b[$i]); return $r;}
function array_merge_b($r,$rb){
if($r && $rb)return array_merge($r,$rb); elseif($rb)return $rb; else return $r;}
function array_merge_r($a,$b){$n=count($a);
foreach($b as $k=>$v)if(!$a[$k])$a[$k]=$v; return $a;}
function array_unshift_b(&$r,$k,$v){$ret[$k]=$v; $ret+=$r; return $ret;}
function array_reverse_b($r,$s=''){$ra=array_keys($r); $ra=array_reverse($ra); 
if($s)$ra=array_splice($ra,0,$s); foreach($ra as $k=>$v)$rb[$v]=$r[$v]; return $rb;}
function array_keys_b($r){foreach($r as $k=>$v)if($k)$ret[]=$k; return $ret;}
function array_keys_r($r,$n,$o=''){foreach($r as $k=>$v)if($v[$n])$ret[$k]=$v[$n];//
return $o?array_flip($ret):$ret;}
function in_array_b($va,$r){foreach($r as $k=>$v)if($v==$va)return $k;}
function in_array_r($r,$d,$n){if($r)foreach($r as $k=>$v)if($v[$n]==$d)return $k;}
function array_add_r($ra,$rb){foreach($rb as $k=>$v)
if(is_array($v))$ra[$k]=array_add_r($ra[$k],$v); else $ra[]=$v; return $ra;}
function array_walk_b($r,$func,$p1,$p2){$n=count($r);
for($i=0;$i<$n;$i++)$ret[]=call_user_func($func,$r[$i],$p1,$p2); return $ret;}
function array_part($d,$s,$n){$r=explode($s,$d); return $r[$n];}
function walkeach($r,$d,$p){
foreach($r as $k=>$v)$ret[]=call_user_func($d,$k,$v,$p); return $ret;}
function unset_in($r,$d,$n){if($r)foreach($r as $k=>$v)if($v[$n]==$d)unset($r[$k]);
return $r;}

function array_push_after($ra,$rb,$p){
if(is_int($p))$r=array_merge(array_slice($ra,0,$p+1),$rb,array_slice($ra,$p+1));
else foreach($ra as $k=>$v){$r[$k]=$v; if($k==$p)$r=array_merge($r,$rb);} return $r;}

function explode_r($d,$a,$b){$r=explode($a,$d);
foreach($r as $k=>$v)$ret[]=explode($b,$v); 
return $ret;}
function explode_k($d,$a,$b){$r=explode($a,$d);
foreach($r as $k=>$v){list($va,$vb)=explode($b,$v); if($v)$ret[trim($va)]=trim($vb);} 
return $ret;}
function implode_k($r,$a,$b){foreach($r as $k=>$v)$ret[]=$k.$a.$v; 
return implode($b,$ret);}

#strings
function yesno($d){return $d?'':1;}
function randid($p=''){return $p.substr(microtime(),2,6);}//uniqid()
function nchar($o,$n){for($i=0;$i<$o;$i++){$ret.=$n;}return $ret;}
function splice($r,$n){
if($r)foreach($r as $k=>$v){$i++; if($i<$n+1)$ret[$k]=$v;} return $ret;}
function count_r($r){
if($r)foreach($r as $k=>$v){if(is_array($v))$n+=count_r($v); else $n++;} return $n;}
function nearest($d,$s){$r=str_split($s);
foreach($r as $k=>$v)if($pos=strpos($d,$v))$ret[]=$pos;
if($ret)return min($ret); else return strlen($d);}

function xt($v){$a=strrpos($v,'.'); $b=strrpos($v,'?');
if($b)$v=substr($v,0,$b); if($a)return strtolower(substr($v,$a));}
function xtb($v){return strtolower(substr($v,-4));}
function is_image($d){$xt=xt($d); //if($xt=='.JPG')echo $d.br();
if(strpos($d,'.jpg') or $xt=='.jpg' or $xt=='.png' or $xt=='.gif' or $xt=='.jpeg')return true;}
function determine_cond($cnd){
if($cnd=='home')return array('home','');
if(is_numeric($cnd))return array('art',$cnd);
elseif($cnd=='cat' or $cnd=='art')return array($cnd,'');
elseif($cnd!='all')return array('cat',$cnd);
else return array('','');}

#sessions
function rstr($n){return $_SESSION['rstr'][$n]=='0'?1:0;}
function auth($n){return $_SESSION['auth']>=$n?true:false;}
function prms($n){return $_SESSION['prms'][$n];}
function prma($n){return $_SESSION['prma'][$n];}
function prmb($n){return $_SESSION['prmb'][$n];}
function nms($d){return $_SESSION['nms'][$d];}
function yesnoses($d){return $_SESSION[$d]=$_SESSION[$d]?0:1;}
//ses
function define_s($v,$d){$_SESSION[$v]=isset($_GET[$v])?$_GET[$v]:$_SESSION[$v];
return $_SESSION[$v]=$_SESSION[$v]?$_SESSION[$v]:$d;}
function getorpost($v,$d){$d=$_GET[$v]?($_GET[$v]):$d; //urldecode
return $_POST[$v]?$_POST[$v]:$d;}
function get($v){if(isset($_GET[$v]))return urldecode($_GET[$v]);}
function geta($v,$d){return $_GET[$v]?$_GET[$v]:$d;}
function post($d,$v=''){if($v)$_POST[$d]=$v; else return $_POST[$d];}
function ses($d,$v=''){if($v)$_SESSION[$d]=$v; return $_SESSION[$d];}
function sesr($d,$k,$v=''){return $v?$_SESSION[$d][$k]=$v:$_SESSION[$d][$k];}
function sesone($v,$p=''){if($p)return $_SESSION[$v]=$p;
$p=$_SESSION[$v]; $_SESSION[$v]=''; return $p;}
function sesmk($v,$p='',$b=''){if(!$_SESSION[$v] or $b or $_GET['id'])
$_SESSION[$v]=call_user_func($v,$p); return $_SESSION[$v];}
function sesf($v,$p='',$b=''){if(!$_SESSION[$v.$p] or $b or $_GET['id'])
$_SESSION[$v.$p]=call_user_func($v,$p); return $_SESSION[$v]=$_SESSION[$v.$p];}
class ses{static $ret; static function add($k,$v){self::$ret[$k]=$v;}}

#access
//function jc(){return '';}//old
function root(){return is_dir('plug')?'':'../';}
function prog($b='',$o=''){return ses('prog',$o?'prog'.$b.'/':'');}
function https($f){return str_replace('https','http',$f);}
function http($f){return substr($f,0,4)!='http'?'http://'.$f:$f;}
function ishttp($f){return substr($f,0,4)=='http'?1:0;}
function nohttp($f){return str_replace(array('http://','https://','www.'),'',$f);}
function http_domain($f){$f=nohttp($f); return substr($f,0,strpos($f,'/'));}//preplink
function http_root($f){$f=http_domain($f); $f=substr($f,0,strrpos($f,'.')); return $f;}
function findroot_b($u){return substr($u,0,strpos($u,"/",8));}
function utmsrc($f){return strdeb($f,'?utm');}
function host(){return 'http://'.$_SERVER['HTTP_HOST'];}
function htac($d){return $_SESSION['htacc']?'/'.$d.'/':'/?'.$d.'=';}
function htacc($d){return $_SESSION['htacc']?'/':'/?'.$d.'=';}//read/id
function urlread($d){return $_SESSION['htacc']?'/'.$d:'/?read='.$d;}//read
function philum(){$srv=prms('upservr'); return $srv?http($srv):'http://philum.net';}
function good_url($id,$v){return urlread($id);}//rstr(38)?htac('read').hardurl($v):
function subdom($v){if($_SESSION['sbdm']){
$r=explode('.',$_SERVER['HTTP_HOST']); $n=count($r);
return 'http://'.$v.'.'.$r[$n-2].'.'.$r[$n-1].'/';}
else return htacc('id').$v;}
function prep_host($nod){if($_SESSION['sbdm'])return subdom($nod);
else return host().htacc('id').$nod;}
function hostname(){return gethostbyaddr($_SERVER['REMOTE_ADDR']);}
function mobile(){$s=$_SERVER['HTTP_USER_AGENT']; 
return stristr($s,'android') || stristr($s,'iPhone') || stristr($s,'iPad');}

function feedproxy($f){
if(substr($f,0,2)=='//')$f='http:'.$f; $d=get_file($f);
$enc=embed_detect(strtolower($d),"charset=",'"',"");
if(strtolower($enc)=="utf-8")$d=utf8_decode_b($d); //eco($d,1);
$s='<meta property="og:url" content="'; if(strpos($d,$s))return embed_detect($d,$s,'"','');
$s="<link rel='canonical' href='"; if(strpos($d,$s))return embed_detect($d,$s,"'",'');}

#ajax
function ajx($v,$p=''){#dont edit!
$r=array('*','_','(star)'); $a=$p?1:0; $b=$p?0:1;
if(!$p){$a=0; $b=1; $c=2; $d=0;} else{$a=1; $b=0; $c=0; $d=2;}
$ra=array($r[$a],$r[$b],'\'',"'",'#','"','+','=','&',"&sect",'?','.',':','/','%u');
$rb=array($r[$c],$r[$d],'(aslash)','(quote)','(diez)','(dquote)','(add)','(equal)','(and)','(sect)','(qmark)','(dot)','(ddot)','(slash)','(pu)');
$ret=$p?str_replace($rb,$ra,$v):str_replace($ra,$rb,$v);
return $p?unescape($ret):$ret;}

function ajxr($res){$r=explode("_",$res);
foreach($r as $k=>$v)$ret[]=($v=='memtmp'?memtmp():ajx($v,1)); return $ret;}
function ajxg($d){return $d=='memtmp'?memtmp():ajx($d,1);}
function ajxp($res,$pa,$oa){list($p,$o)=ajxr($res); return array($p?$p:$pa,$o?$o:$oa);}

function memtmp(){if($_SESSION['memtmp']){ksort($_SESSION['memtmp']); 
$ret=implode('',$_SESSION['memtmp']); $_SESSION['memtmp']='';}
$ret=ajx($ret,1); return $ret;}//$ret=unescape($ret); 

function core($f,$p,$v1,$v2,$v3,$v4){require_once($f);
return call_user_func($p?$p:$f,$v1,$v2,$v3,$v4);}

#actions
function loadjs($f,$d,$t=''){$v=$_SESSION['offon'];
$h=hidden('','offon'.$d,$v); $t=$t?'" title="'.$t:'';
return ljb($t.'" id="offonbt'.$d,'offon',$f.'\',\''.$d,offon($v)).$h;}
function lj_tog($n,$d,$v){return toggle('',$n.$d.'_'.$n.'_'.$d,$v).btd($n.$d,'');}
function ljbub($v,$lk,$oc='',$ov='',$id='',$tg=''){$tg=$tg?atb('target','_blank'):'';
$ocb='closebub(this);'; $ovb='closepbub(this,\''.$id.'\'); clbubtim(this);';
return '<li><a'.atb('href',$lk).atd($id).atb('onclick',$oc.';'.$ocb).atb('onmouseover',$ovb.$ov).$tg.'>'.$v.'</a></li>';}
function saveiec($j,$cat,$rid,$cid='',$v='',$x='',$c='',$suj=''){
$p=atjb(array($j,$cat,$rid,$cid,$x,ajx($suj)));
return ljb($c,'SaveIec',$p,$v?$v:picto('download')).($rid?hidden($rid,$rid,''):'');}
function btn_switch($d,$g,$l,$v){$csa='txtyl'; $csb='txtx';
if($_GET[$d])$_SESSION[$d]=$_GET[$d]==$csb?$g:''; $css=$_SESSION[$d]?$csa:$csb;
return lkc($css,$l.'&'.$d.'='.$css,$v).' ';}

#btns
function plink($f){return lkt('popbt',$f,preplink($f));}
function preplink($lk){$lk=nohttp($lk); $pos=strpos($lk,"/"); 
if($pos===false)$pos=strpos($lk,"."); return substr($lk,0,$pos);}
function prepdlink($val){list($k,$v)=explode("ß",$val);
if($v=="" or $v==$k)$v=http_domain($k); return array($k,$v);}//preplink
function nbof($n,$i){if(!$n)return nms(11)."&nbsp;".nms($i); 
else return $n.' '.($n>1?nms($i+1):nms($i));}
function plurial($n,$i){return $n>1?nms($i+1):nms($i);}
function flags(){$r=msql_read('system','edition_flags','',1); 
foreach($r as $k=>$v)$ret[$v[1]]=$v[0]; return $ret;}
function flag($d){$r=sesmk('flags','','');
if($r[$d])return image('imgb/icons/flags/'.$r[$d].'.gif','14');}
function ascii($d,$n=''){if(!$n)return '&#'.$d.';'; return balise('font',array(16=>'font-size:'.$n.'px; line-geight:'.$n.'px;'),'&#'.$d.';');}
function svg($d){list($f,$w,$h)=subparams_a($d);
return '<img src="'.'/imgb/icons/'.$f.'.svg'.'" width="'.$w.'" height="'.($h?$h:$w).'" />';}
function picto($d,$s='',$c=''){$dc=$_SESSION['picto'][$d];//atb('title',$d).
if(is_numeric($s))$s='font-size:'.$s.'px;'; if($c)$c=' '.$c;
if($dc)return span(atc('philum'.$c).ats($s),$dc);}
function pictxt($p,$t='',$s=''){return picto($p,$s).($t?'&nbsp;'.$t:'');}
function pictit($p,$t,$s=''){return span(att($t),picto($p,$s));}
function imgico($f,$t='',$h=''){return '<img src="'.$f.'"'.ats('vertical-align:-'.($h?$h:4).'px; border:0;').atb('title',$t).'/>';}
function uicon($d,$p,$o=''){return $o.'imgb/icons/'.($p?$p:'system/philum/16/').'/'.$d.'.png';}
function icon($v,$t='',$h='',$jc=''){list($d,$p)=explode('ß',$v); $f=uicon($d,$p);
return is_file($f)?imgico($jc.$f,$t,$h):$t;}
function ico($d,$t=''){list($p,$c)=explode(':',$d); if($c=='icon')return icon($p,$t); 
elseif(is_numeric($c))return icosys($p,$c); elseif($c=='svg')return svg($p);
elseif($p!==false)return picto($p); else return $t;}
function callico($d,$t='',$s='',$c=''){$b=$_SESSION['icons'][$d];
if($b)return ico($b,$t?$t:$d); else return picto($d,$c.($s?' font-size:'.$s.'px;':''));}
function icosys($d,$s=''){$s=$s?$s:16;
return imgico('imgb/icons/system/philum/'.$s.'/'.$d.'.png');}
function helps($d,$nd=''){$nd=$nd?$nd:'txts';
return nl2br(stripslashes(msql_read('lang','helps_'.$nd,$d)));}
function hlpbt($j,$t=''){return togbub('syshelps',ajx($j),picto($t?$t:'help'),'grey');}
function msqlink($b,$p,$d='',$c=''){$u=($b?$b:'users').'_'.ajx($p).($d?':'.ajx($d):'');
return lj('grey'.($c?' '.$c:''),'popup_msql__3_'.$u,pictit('msql',$p));}

//tags
function tri_tag($v){$r=explode(',',$v); $n=count($r);
for($i=0;$i<$n;$i++)$ret[]=trim($r[$i]); return $ret;}

#params
/*function compact_val($r,$a,$b){
foreach($r as $k=>$v){$ret.=$k.$b.urldecode($v).$a;} return $ret;}*/
function decompact_conn($d){$r=split_right(':',$d,1); $p=explode('ß',$r[0]);
return array($p[0],$p[1],$r[1]);}//1ß2:3
function decompact_conn_b($d){$r=split_right(':',$d,1);//1:2ß3//clbasic
$p=split_right('ß',$r[1]?$r[0]:$p,1); return array($p[0],$p[1],$r[1]);}
function decompact_mod($d){$r=split_right('ß',$d,1); $p=split_right(':',$r[0],1);
return array($p[0],$p[1],$r[1]);}
function subparams($d){list($p,$v)=split('ß',$d);//1/2ß3
if($v)list($x,$y)=explode('/',$p); else $v=$p;
return array($v,$x,$y);}
function subparams_a($d){list($v,$p)=split('ß',$d);//1ß2/3
if($p)list($x,$y,$p,$o,$d)=explode("/",$p);
return array($v,$x,$y,$p,$o,$d);}
function good_param($d){//split_right for connectors
$n=strrpos($d,'ß'); if($n===false)return array($d,''); $p=substr($d,$n+1);
if(strpos($p,']'))return array($d,''); else return array(substr($d,0,$n),$p);}

#plug
//$r=array($tar,'plug',$id,$x,$plug,$func,$v1,$v2,$mv);
function isplug($d){return is_file('plug/'.$d.'.php');}
function clplug_j($d,$a='',$b=''){return 'popup_plup___'.$d.'_plug*'.$d.'_'.$a.'_'.$b;}
function call_func($c,$r,$v){return lj($c,implode('_',$r),$v);}
function call_plug_f($c,$t,$pl,$f,$p,$v){$po=$t=='popup'?'plup':'plug';
return lj($c,$t.'_'.$po.'__3_'.$pl.'_'.$pl.'*'.$f.'_'.$p,$v);}
function call_plug($c,$t,$f,$p,$v){$pl=$t=='popup'?'plup':'plug';
return lj($c,$t.'_'.$pl.'__3_'.$f.'_plug*'.$f.'_'.$p,$v?$v:$p);}

function plugin($d,$p='',$o='',$ob='',$res=''){reqp($d);
if(strpos($d,'/'))$d=strchr_b($d,'/'); $fc='plug_'.$d;
if(function_exists($fc))return call_user_func($fc,$p,$o,$ob,$res);}
function plugin_func($d,$fc,$p='',$o='',$res=''){reqp($d); $fc=$fc?$fc:'plug_'.$d;
if(function_exists($fc))return call_user_func($fc,$p,$o,$res);}
function plug_core($d,$p='',$o='',$res=''){reqp($d);
return call_user_func($d,$p,$o,$res);}
function search_engine($d){return plug_core('search','rech',$d,'30','');}
function call_finder($p,$o){req('spe,finder'); return finder($p,$o);}

#app
function loadapp($d){$r=explore('app','dirs');//p($r);
foreach($r as $k=>$v){$f='app/'.$k.'/'.$d.'.php'; 
if(file_exists($f))require_once $f;}}

function openapp($d,$p=''){loadapp($d);
$content=App::open($d,$p);
$ret=Head::generate();
return $ret.$content;}

#eye
function eye($p=''){$pag=save_get(); $iq=ses('iq');
if($pag && $iq)insert('qdv','("","'.$iq.'","'.ses('qbd').'","'.$pag.'",NOW())');}

#utils
function exc($d){if(auth(6))system(($d));}//escapeshellcmd
function req($d,$j=''){$r=explode(',',$d); $n=count($r); $g=prog();//if($j)
for($i=0;$i<$n;$i++)require_once(root().$g.$r[$i].'.php');}//once: iterative reqs
function reqp($d){$f='plug/'.$d.'.php'; if(is_file($f))require_once($f);}
function checkupdate(){return read_file(philum().'/_public/plug/distribution.php?version==');}
function checkversion(){return msql_read('system','program_version',1);}
function utf($d){return $_SESSION['enc']=='utf-8'?utf8_encode($d):$d;}
function utfb($d){return $_SESSION['enc']=='utf-8'?utf8_decode($d):$d;}
function secure_inputs(){
if($_GET)foreach($_GET as $k=>$v)$_GET[eradic_acc($k)]=utf8_decode(urldecode($v));
if($_POST)foreach($_POST as $k=>$v)$_POST[$k]=utfb($v);}

function alert($d){Head::add('jscode',sj('popup_alert___'.ajx($d)));}
function patch_replace($bs,$in,$wh,$repl){
$rq=sql('id',$bs,'q',$in.'="'.$wh.'"');
while($data=mysql_fetch_row($rq)){//delete($bs,$data['id']);
echo $data[0].'_'; update($bs,$in,$repl,"id",$data[0]);}}

#design
function currentwidth(){$p=$_SESSION['cur_div']; return @$_SESSION['prma'][$p?$p:'content'];}
function curwidth_set($d){$_SESSION['cur_div']='temp'; $_SESSION['prma']['temp']=$d;}
function active($d,$n){return $d==$n?'active':'';}

function error_report(){//prms('error')//ini_set("memory_limit","1512M");
ini_set('display_errors',1); error_reporting(6135);}//E_ALL
function chrono($d=''){static $t; static $start; static $cum;
$top=round((mtime()-$start)*1000,5); $start=mtime(); 
if($d!=$t){$ret=$d.': '.$top.'ms'; $t=$d; $cum=0;} 
elseif($t && $t==$d){$cum+=$top; $ret.='start: '.$cum.'ms';}
if($ret)return btn('txtsmall2',$ret).' ';}
function pr($r){echo '<pre>'; print_r($r); echo '</pre>';}
function window($d){return div(atb('contenteditable','true').atc($c).ats('overflow:auto; height:300px;'),$d);}
function eco($d,$o=''){if(is_array($d))p($d); elseif($o=='d')echo window($d);
elseif($o==1)echo txarea('',parse($d),44,8).br(); else echo $o.':'.$d.br();}
function verbose($r){echo implode(br(),$r).hr();}
?>